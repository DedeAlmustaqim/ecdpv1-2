<?php
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('template');
        $this->load->library('session');
        $this->load->helper(array('captcha', 'url', 'form'));
    }

    public function buat_captcha()
	{
		$vals = array(
		'img_path' => './captcha/',
		'img_url' => base_url().'captcha/',
		'font_path' => './font/timesbd.ttf',
		'img_width' => '150',
		'img_height' => 30,
		'expiration' => 60
		);
		$cap = create_captcha($vals);
		return $cap;
    }
    public function cek_captcha($input)
	{
		if($input === $this->session->userdata('kode_captcha')){
			return TRUE;
		} else {
			$this->form_validation->set_message('cek_captcha', '%s yang anda input salah!');
			return FALSE;
		}
	}

    function index()
    {
        if ($this->session->userdata('masuk', true)) {
            redirect('dashboard');
        }

        $data['title'] = 'Form Captcha';
		$cap = $this->buat_captcha();
		$data['cap_img'] = $cap['image'];

        

        $data['judul'] = "Login";
        
        //$this->load->view('login', $data);
        var_dump($data);
    }

    private function validasi_login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_captcha', 'Kode Captcha', 'required|callback_cek_captcha');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        return $this->form_validation->run();
    }
    function auth()
    {
        if ($this->validasi_login()) {
            $username = htmlspecialchars($this->input->post('username', true), ENT_QUOTES);
            $password = htmlspecialchars($this->input->post('password', true), ENT_QUOTES);
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> true) {
                echo $this->session->set_flashdata('cap', 'Gunakan Recaptcha');
                redirect('login');
            }


            $cek_admin = $this->login_model->auth_admin($username, $password);

            if ($cek_admin->num_rows() > 0) { //jika login sebagai dosen
                $data = $cek_admin->row_array();
                $this->db->where('id_user', $data['id_user']);
                $this->db->update('admin', array('last_login' => date('Y-m-d H:i:s')));
                $this->session->set_userdata('masuk', true);
                if ($data['id_akses'] == '1') { //Akses admin
                    $this->session->set_userdata('akses', '1');
                    $this->session->set_userdata('hak_akses', 'Super Administrator');
                    $this->session->set_userdata('ses_id', $data['id_admin']);
                    $this->session->set_userdata('ses_user', $data['username']);
                    $this->session->set_userdata('ses_nm', $data['nama']);
                    $this->session->set_userdata('disclaimer', '1');
                    redirect('dashboard');
                } else if ($data['id_akses'] == '2') { //
                    $this->session->set_userdata('akses', '2');
                    $this->session->set_userdata('hak_akses', 'Administrator');
                    $this->session->set_userdata('ses_id', $data['id_admin']);
                    $this->session->set_userdata('ses_user', $data['username']);
                    $this->session->set_userdata('ses_nm', $data['nama']);
                    redirect('dashboard');
                } else if ($data['id_akses'] == '3') { //
                    $this->session->set_userdata('akses', '3');
                    $this->session->set_userdata('hak_akses', 'Verifikator');
                    $this->session->set_userdata('ses_id', $data['id_admin']);
                    $this->session->set_userdata('ses_user', $data['username']);
                    $this->session->set_userdata('ses_nm', $data['nama']);
                    redirect('dashboard');
                }
            } else {
                $cek_user = $this->login_model->auth_user($username, $password);
                if ($cek_user->num_rows() > 0) {
                    $data = $cek_user->row_array();
                    $this->db->where('id_user', $data['id_user']);
                    $this->db->update('tbl_user', array('last_login' => date('Y-m-d H:i:s')));
                    $this->session->set_userdata('akses', '4');
                    $this->session->set_userdata('hak_akses', 'Operator Unit');
                    $this->session->set_userdata('ses_id', $data['id_user']);
                    $this->session->set_userdata('ses_id_unit', $data['id_unit']);
                    $this->session->set_userdata('ses_nm_unit', $data['nm_unit']);
                    $this->session->set_userdata('ses_user', $data['username']);
                    $this->session->set_userdata('ses_nm', $data['nama']);
                    echo $this->session->set_flashdata('msg', 'Selamat Datang');
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('no_user', 'Username / Password Salah ');
                    redirect('login');
                }
            }
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('login');
        redirect($url);
    }
}
