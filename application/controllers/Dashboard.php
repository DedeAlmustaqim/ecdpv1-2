<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends CI_Controller {
	public function __construct()
	{

		parent::__construct();
		if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2') || ($this->session->userdata('akses') == '3') || ($this->session->userdata('akses') == '4') || ($this->session->userdata('akses') == '5'))  {
		} else {
			redirect('login');
		}
		$this->load->library('template');
	
	}
	public function index()
	{
		$data['judul'] = "Dashboard";
		$this->template->konten('dashboard', $data);
		//var_dump($data);
	}

	public function count()
	{
		$penyelidikan = $this->db->query('SELECT * FROM tbl_penyelidikan');
		$penyidikan = $this->db->query('SELECT * FROM tbl_penyidikan');
		$ijinsita = $this->db->query('SELECT * FROM tbl_ijinsita');
		$psita = $this->db->query('SELECT * FROM tbl_psita');
		$penahanan = $this->db->query('SELECT * FROM tbl_penahanan');
		$pd = $this->db->query('SELECT * FROM tbl_pd');
		
		$data['data1'] = $penyelidikan->num_rows();
		$data['data2'] = $penyidikan->num_rows();
		$data['data3'] = $ijinsita->num_rows();
		$data['data4'] = $psita->num_rows();
		$data['data5'] = $penahanan->num_rows();
		$data['data6'] = $pd->num_rows();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	


}
