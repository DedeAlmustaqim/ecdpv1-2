<?php
defined('BASEPATH') or exit('No direct script access allowed');

class master extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();
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
		$data['judul'] = "Bagian";
		$this->template->konten('master/master', $data);
		//var_dump($data);
	}

	public function unit()
	{
		$this->load->library('template');
		$data['judul'] = "Master - Unit";
		$this->template->konten('master/unit', $data);
	}

	public function json_unit()
	{
		$data = $this->m_master->json_unit();
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
		$this->form_validation->set_rules('nm_unit', 'nm_unit', 'trim|required');
		$this->form_validation->set_rules('nm_pimpinan', 'nm_pimpinan', 'trim|required');
		$this->form_validation->set_rules('nrp_nip', 'nrp_nip', 'trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');

		return $this->form_validation->run();
	}
	public function tambah_unit()
	{
		$this->load->helper(['form', 'string']);

		if ($this->validasi_form_unit()) {
			$nm_unit      = $this->input->post('nm_unit', true);
			$nm_pimpinan      = $this->input->post('nm_pimpinan', true);
			$nrp_nip      = $this->input->post('nrp_nip', true);

			$data = array(
				'id_unit'        => random_string('alnum', 16),
				'nm_unit'        => $nm_unit,
				'nm_pimpinan'        => $nm_pimpinan,
				'nrp_nip'        => $nrp_nip,
				'created_at'       => date('Y-m-d H:i:s'),
			);
			$this->m_master->insert_unit($data);
			echo json_encode($data);
		} else {
			redirect('master/unit');
		}
	}

	private function validasi_form_unit_edit()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_unit', 'id_unit', 'trim|required');
		$this->form_validation->set_rules('nm_unit_edit', 'nm_unit_edit', 'trim|required');
		$this->form_validation->set_rules('nm_pimpinan_edit', 'nm_pimpinan_edit', 'trim|required');
		$this->form_validation->set_rules('nrp_nip_edit', 'nrp_nip_edit', 'trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]');

		return $this->form_validation->run();
	}
	public function edit_unit()
	{
		$this->load->helper(['form', 'string']);

		if ($this->validasi_form_unit_edit()) {
			$id_unit      = $this->input->post('id_unit', true);
			$nm_unit_edit      = $this->input->post('nm_unit_edit', true);
			$nm_pimpinan_edit      = $this->input->post('nm_pimpinan_edit', true);
			$nrp_nip_edit      = $this->input->post('nrp_nip_edit', true);

			$data = array(
				'nm_unit'        => $nm_unit_edit,
				'nm_pimpinan'        => $nm_pimpinan_edit,
				'nrp_nip'        => $nrp_nip_edit,
				'updated_at'       => date('Y-m-d H:i:s'),
			);
			$this->m_master->update_unit($data, $id_unit);
			echo json_encode($data);
		} else {
			redirect('master/unit');
		}
	}

	public function get_id_unit($id)
    {
        $row = $this->m_master->get_by_id_unit($id);
        if ($row) {
            $data = array(
                'id_unit' => $row->id_unit,
                'nm_unit' => $row->nm_unit,
                'nm_pimpinan' => $row->nm_pimpinan,
                'nrp_nip' => $row->nrp_nip,
            );
        } else {
            echo "data kosong";
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }
	
	public function delete_unit($id)
    {
        $this->db->where('id_unit', $id);
        $result = $this->db->delete('tbl_unit');
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
