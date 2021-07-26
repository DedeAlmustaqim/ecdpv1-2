<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		if ($this->session->userdata('akses') == '1') {
		} else {
			redirect('login');
		}
		$this->load->library('template');
		//MODEL

		$this->load->helper('string');
		$this->load->library('form_validation');
		$this->load->model('m_master');
		$this->load->library('datatables');
	}


	public function index()
	{
		$this->load->library('template');
		$data['judul'] = "Kelola User";
		$this->template->konten('master/user', $data);
		//var_dump($data);
	}

	

	public function json_admin()
	{
		$data = $this->m_master->json_admin();
		header('Content-Type: application/json');
		echo $data;
	}

	public function json_op($id)
	{
		$data = $this->m_master->json_op($id);
		header('Content-Type: application/json');
		echo $data;
	}

	private function validasi_form_unit()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('nm_user', 'nm_user', 'trim|required');
		$this->form_validation->set_rules('nip_user', 'nip_user', 'trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
		$this->form_validation->set_rules('email_user', 'email_user', 'trim|required');
		$this->form_validation->set_rules('hak_akses', 'hak_akses', 'trim|required');

		return $this->form_validation->run();
	}
	public function tambah_user()
	{
		$this->load->helper(['form', 'string']);

		if ($this->validasi_form_unit()) {
			$username      = $this->input->post('username', true);
			$nm_user      = $this->input->post('nm_user', true);
			$nip_user      = $this->input->post('nip_user', true);
			$email_user      = $this->input->post('email_user', true);
			$hak_akses      = $this->input->post('hak_akses', true);

			$data = array(
				'id_user'        => random_string('alnum', 16),
				'username'        => $username,
				'password'        => md5("ecdpPN"),
				'nama'        => $nm_user,
				'nip'        => $nip_user,
				'email'        => $email_user,
				'id_akses'        => $hak_akses,
				'created_at'       => date('Y-m-d H:i:s'),
			);
			$this->m_master->insert_admin($data);
			echo json_encode($data);
		} else {
			show_404();
		}
	}

	private function validasi_edit_user()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_user', 'id_user', 'trim|required');
		$this->form_validation->set_rules('username_edit', 'username_edit', 'trim|required');
		$this->form_validation->set_rules('nm_user_edit', 'nm_user_edit', 'trim|required');
		$this->form_validation->set_rules('nip_user_edit', 'nip_user_edit', 'trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');
		$this->form_validation->set_rules('email_user_edit', 'email_user_edit', 'trim|required');
		$this->form_validation->set_rules('hak_akses_edit', 'hak_akses_edit', 'trim|required');

		return $this->form_validation->run();
	}
	public function edit_user()
	{
		$this->load->helper(['form', 'string']);

		if ($this->validasi_edit_user()) {
			$id_user    = $this->input->post('id_user', true);
			$username_edit      = $this->input->post('username_edit', true);
			$nm_user_edit      = $this->input->post('nm_user_edit', true);
			$nip_user_edit      = $this->input->post('nip_user_edit', true);
			$email_user_edit      = $this->input->post('email_user_edit', true);
			$hak_akses_edit      = $this->input->post('hak_akses_edit', true);

			$data = array(
				'username'        => $username_edit,
				'nama'        => $nm_user_edit,
				'nip'        => $nip_user_edit,
				'email'        => $email_user_edit,
				'id_akses'        => $hak_akses_edit,
				'updated_at'       => date('Y-m-d H:i:s'),
			);
			$this->m_master->update_user($data, $id_user);
			echo json_encode($data);
		} else {
			show_404();
		}
	}

	private function val_reset_pass()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');

		return $this->form_validation->run();
	}
	public function reset_pass()
	{
		$this->load->helper(['form', 'string']);

		if ($this->val_reset_pass()) {
			$id = $this->input->post('id');
			$data = array(
				'password'        => md5("ecdpPN"),
				
			);
			$this->m_master->reset_pass($data, $id);
			echo json_encode($data);
		} else {
			show_404();
		}
	}

	public function get_user($id)
    {
        $row = $this->m_master->get_user($id);
        if ($row) {
            $data = array(
                'id_user' => $row->id_user,
                'id_akses' => $row->id_akses,
                'username' => $row->username,
                'nama' => $row->nama,
                'nip' => $row->nip,
                'email' => $row->email,
              
            );
        } else {
            echo "data kosong";
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }
	
	public function delete($id)
    {
        $this->db->where('id_user', $id);
        $result = $this->db->delete('admin');
        return $result;
	}
	
	private function cek_tambah_op()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_unit_op', 'id_unit_op', 'trim|required');
		$this->form_validation->set_rules('username_op', 'username_op', 'trim|required');
		$this->form_validation->set_rules('nama_op', 'nama_op', 'trim|required');
		$this->form_validation->set_rules('nip_op', 'nip_op', 'trim|required');
		$this->form_validation->set_rules('email_op', 'email_op', 'trim|required');
		
		return $this->form_validation->run();
	}

	public function tambah_op()
	{

		if ($this->cek_tambah_op()) {
			$id_unit  		= $this->input->post('id_unit_op', true);
			$username  		= $this->input->post('username_op', true);
			$nama			= $this->input->post('nama_op', true);
			$nip			= $this->input->post('nip_op', true);
			$email  		= $this->input->post('email_op', true);
			
			$data = array(
				'id_user'       	=> random_string('alnum', 25),
				'id_akses'        		=> "4",
				'id_unit'    			=> $id_unit,
				'username'    			=> $username,
				'password'    	=> md5("PNtamianglayang"),
				'nama'    	=> $nama,
				'nrp_nip'    	=> $nip,
				'email'    	=> $email,
				'created_at' => date('Y-m-d H:i:s')

			);
			$this->m_master->insert_op($data);
			$array = array(
				'success' => 'sukses'
			);

			echo json_encode($array);
		} else {
			redirect('master/unit');
		}
	}

	private function cek_delete_op()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		
		return $this->form_validation->run();
	}
	public function delete_op()
	{
		if ($this->cek_delete_op()) {
			$id = $this->input->post('id');
			
			$this->db->where('id_user', $id);
			$this->db->delete('tbl_user');
		
		} else {
			redirect('master/unit');
		}
	}

	private function validasi_pass()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pass', 'pass', 'trim|required|min_length[8]|max_length[20]');
		$this->form_validation->set_rules('pass2', 'pass2', 'required|matches[pass]');

		return $this->form_validation->run();
	}
	public function ubah_pass()
	{
		$this->load->helper(['form', 'string']);

		if ($this->validasi_pass()) {
			$id      = $this->session->userdata('ses_id');
			$pass      = $this->input->post('pass', true);

			if (($this->session->userdata('akses') != 4)) {
				$data = array(
					'password'        => md5($pass),
				);
				$this->m_master->ubah_pass_admin($data, $id);
				echo json_encode($data);
			} else  {
				$data = array(
					'password'        => md5($pass),
				);
				$this->m_master->ubah_pass_user($data, $id);
				echo json_encode($data);
			}
		} else {
			redirect('unit');
		}
	}
}
