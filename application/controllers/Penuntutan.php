<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penuntutan extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();
		if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2') || ($this->session->userdata('akses') == '3') || ($this->session->userdata('akses') == '4') || ($this->session->userdata('akses') == '5')) {
		} else {
			redirect('login');
		}

		$this->load->library('template');
		//MODEL

		$this->load->helper('string');
		$this->load->library('form_validation');
		$this->load->model('m_master');
		$this->load->model('m_penuntutan');
		$this->load->library('datatables');
	}

	//INDEX PG
	public function index()
	{
		$this->load->library('template');
		$data['judul'] = "Penuntutan";
		$data['unit'] = $this->m_master->tampil_unit();
		$this->template->konten('penuntutan/penuntutan', $data);
		//var_dump($data);
	}



	public function json_pn()
	{
		$data = $this->m_penuntutan->json_pn();
		header('Content-Type: application/json');
		echo $data;
	}


	public function json_tdw($id)
	{
		$data = $this->m_penuntutan->json_tdw($id);
		header('Content-Type: application/json');
		echo $data;
	}

	public function json_brg_sita($id)
	{
		$data = $this->m_ijinsita->json_brg_sita($id);
		header('Content-Type: application/json');
		echo $data;
	}

	//VALIDASI
	public function valid()
	{

		$this->load->helper(['form', 'string']);
		$id      	= $this->input->post('id_verif_sita', true);
		$verif = $_FILES['verif_sita']['name'];

		$config['upload_path']          = 'file/st/ijinsita';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $verif);
		$ext = strtolower(end($x));
		$config['file_name'] = $id . "_verif_sita." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$verif_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('verif_sita')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$data = array('verif_sita' => $this->upload->data());
			$data = array(

				'verif_doc'    		=> $verif_name,
				'validasi'        => 2,
				'verif_by'        => $this->session->userdata('ses_nm'),
				'verif_date'        => date('Y-m-d H:i:s'),
			);
			$this->m_ijinsita->verif($data, $id);
			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}
	private function cek_verif()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_pn_verif', 'id_pn_verif', 'trim|required');
		$this->form_validation->set_rules('no_perkara', 'no_perkara', 'trim|required');
		return $this->form_validation->run();
	}
	public function verif()
	{
		$id = $this->input->post('id_pn_verif');
		$no_per = $this->input->post('no_perkara');
		if ($this->cek_verif()) {
			$data = array(
				'validasi'        => 1,
				'no_perkara'        => $no_per,
				'verif_date'        => date('Y-m-d H:i:s'),
				'verif_by'       		=> $this->session->userdata('ses_nm'),

			);
			$this->m_penuntutan->verif($data, $id);

			echo json_encode($data);
		} else {
			show_404();
		}
	}

	private function cek_buka_verif()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		return $this->form_validation->run();
	}
	public function buka_verif()
	{

		if ($this->cek_buka_verif()) {
			$data = array(
				'validasi'        => 0,
				'verif_date'        => null,
				'no_perkara'        => null,
			);
			$this->m_penuntutan->valid($data);
			echo json_encode($data);
		} else {
			show_404();
		}
	}

	private function cek_buka_valid()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		return $this->form_validation->run();
	}
	public function buka_valid()
	{
		$edoc = $this->input->post('edoc');

		if ($this->cek_buka_valid()) {
			$data = array(
				'validasi'        => 1,
				'verif_doc'        => null,
			);
			$this->m_ijinsita->valid($data);
			unlink(FCPATH . 'file/st/ijinsita' . $edoc);
			echo json_encode($data);
		} else {
			redirect('ijinsita');
		}
	}


	

	public function tambah_pn()
	{
		$file1 = array();
		$file2 = array();
		$file3 = array();
		$file4 = array();


		$this->load->helper(['form', 'string']);
		$this->load->library('upload');

		$id      	= random_string('alnum', 25);


		$edoc1 = $_FILES['edoc_pn1']['name'];

		$config1['upload_path']          = 'file/pn/';
		$config1['allowed_types']        = 'pdf';
		$x1 = explode(".", $edoc1);
		$ext1 = strtolower(end($x1));
		$config1['file_name'] = $id . "_pelimpahan." . $ext1;
		$config1['overwrite']            = true;
		$config1['max_size']             = 3072; // 1MB
		$edoc1_name = $config1['file_name'];
		$this->upload->initialize($config1);

		// process image upload first
		if (!$this->upload->do_upload('edoc_pn1')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		}
		// image was uploaded properly, continue
		else {
			$file1 = $this->upload->data();
			$edoc2 = $_FILES['edoc_pn2']['name'];

			$config2['upload_path']          = 'file/pn/';
			$config2['allowed_types']        = 'doc|docx|word';
			$x2 = explode(".", $edoc2);
			$ext2 = strtolower(end($x2));
			$config2['file_name'] = $id . "dakwaan." . $ext2;
			$config2['overwrite']            = true;
			$config2['max_size']             = 3072; // 1MB
			$edoc2_name = $config2['file_name'];
			$this->upload->initialize($config2);

			if (!$this->upload->do_upload('edoc_pn2')) {
				$array = array(
					'error'   => true,
				);
				echo json_encode($array);
			} else {

				$file2 = $this->upload->data();

				$unit_pn  		= $this->input->post('unit_pn', true);
				$no_bab 		= $this->input->post('no_bab', true);
				$no_pelimpahan 		= $this->input->post('no_pelimpahan', true);
				$no_srt_dakwaan 		= $this->input->post('no_srt_dakwaan', true);

				$data = array(
					'id_pn'       			=> $id,
					'id_unit'       			=> $unit_pn,
					'no_bab'        	=> $no_bab,
					'no_pelimpahan'    			=> $no_pelimpahan,
					'no_srt_dakwaan'    			=> $no_srt_dakwaan,

					'edoc_pelimpahan'    		=> $edoc1_name,
					'edoc_dakwaan'    => $edoc2_name,
					'create_by_pn'       	=> $this->session->userdata('ses_nm'),
					'created_at_pn'       	=> date('Y-m-d H:i:s'),
				);
				$this->m_penuntutan->insert($data);
				$array = array(
					'success' => 'sukses'
				);

				echo json_encode($array);
			}
		}
	}

	public function edit_st()
	{
		$valid = $this->input->post('validasi_st');
		$id = $this->input->post('id_ijin_sita_edit');

		$this->db->where('validasi', $valid);
		$this->db->where('id_ijin_sita', $id);
		$q = $this->db->get('tbl_ijinsita');

		if ($q->num_rows() > 1) {

			redirect('ijinsita');
		}

		$no_smohon_sita_edit  		= $this->input->post('no_smohon_sita_edit', true);
		$unit_st_edit  		= $this->input->post('unit_st_edit', true);

		$data = array(
			'no_smohon_sita'       	=> $no_smohon_sita_edit,
			'id_unit'        		=> $unit_st_edit,

			'update_by_sita'       		=> $this->session->userdata('ses_nm'),
			'updated_at_sita'       		=> date('Y-m-d H:i:s'),
		);
		$this->m_ijinsita->update($data);
		$array = array(
			'success' => 'sukses'
		);

		echo json_encode($array);
	}

	public function reupload_smohon()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc1      	= $this->input->post('id_edoc1', true);
		$edoc1 = $_FILES['edoc1_st_edit']['name'];

		$config['upload_path']          = 'file/st/ijinsita/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc1);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc1 . "_s_mohon." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc1_st_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc1_st_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	public function reupload_lap_pol_intel()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc2      	= $this->input->post('id_edoc2', true);
		$edoc2 = $_FILES['edoc2_st_edit']['name'];

		$config['upload_path']          = 'file/st/ijinsita/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc2);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc2 . "_s_lap." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc2_st_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc2_st_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	public function reupload_penetapan()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc3      	= $this->input->post('id_edoc3', true);
		$edoc3 = $_FILES['edoc3_st_edit']['name'];

		$config['upload_path']          = 'file/st/ijinsita/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc3);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc3 . "_pen_tersangka." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc3_st_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc3_st_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	public function reupload_sp()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc4      	= $this->input->post('id_edoc4', true);
		$edoc4 = $_FILES['edoc4_st_edit']['name'];

		$config['upload_path']          = 'file/st/ijinsita/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc4);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc4 . "_perintah." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc4_st_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc4_st_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	private function cek_delete_pn()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		$this->form_validation->set_rules('edoc1', 'edoc1', 'trim|required');
		$this->form_validation->set_rules('edoc2', 'edoc12', 'trim|required');

		return $this->form_validation->run();
	}
	public function delete_pn()
	{
		if ($this->cek_delete_pn()) {
			$this->load->helper('file');
			$id = $this->input->post('id');
			$edoc1 = $this->input->post('edoc1');
			$edoc2 = $this->input->post('edoc2');

			$this->db->where('id_pn', $id);
			$this->db->delete('tbl_penuntutan');
			unlink(FCPATH . 'file/pn/' . $edoc1);
			unlink(FCPATH . 'file/pn/' . $edoc2);

			die;
		} else {
			show_404();
		}
	}

	private function cek_delete_tdw()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');

		return $this->form_validation->run();
	}
	public function delete_tdw()
	{
		if ($this->cek_delete_tdw()) {
			$this->load->helper('file');
			$id = $this->input->post('id');

			$this->db->where('id_tdw', $id);
			$this->db->delete('tbl_tdw');
		} else {
			show_404();
		}
	}

	// EDIT PENYELIDIKAN
	public function penyelidikan_edit($id)
	{
		$this->load->library('template');
		$row = $this->m_pg->get_by_id_penyelidikan($id);
		if ($row) {
			$data = array(
				'judul'     	=>   "Edit Data Penyelidikan",
				'id_ijin_pg' 	=> $row->id_ijin_pg,
				'no_srt' 		=> $row->no_srt,
				'jns_srt' 		=> $row->jns_srt,
				'jns_geledah' 		=> $row->jns_geledah,
				'lokasi' 		=> $row->lokasi,
				'pemilik_lok' 		=> $row->pemilik_lok,
			);
		} else {
			echo "data kosong";
		}
		$this->template->konten('penggeledahan/penyelidikan_edit', $data);
		//var_dump($data);
	}

	private function cek_tambah_tdw()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_pn_tdw', 'id_pn_tdw', 'trim|required');
		$this->form_validation->set_rules('nm_tdw', 'nm_tdw', 'trim|required');
		$this->form_validation->set_rules('nik_tdw', 'nik_tdw', 'trim|required');
		$this->form_validation->set_rules('t_lahir_tdw', 't_lahir_tdw', 'trim|required');
		$this->form_validation->set_rules('tgl_tdw', 'tgl_tdw', 'trim|required');
		$this->form_validation->set_rules('bln_tdw', 'bln_tdw', 'trim|required');
		$this->form_validation->set_rules('ta_tdw', 'ta_tdw', 'trim|required');
		$this->form_validation->set_rules('jk_tdw', 'jk_tdw', 'trim|required');
		$this->form_validation->set_rules('alamat_tdw', 'alamat_tdw', 'trim|required');
		$this->form_validation->set_rules('agama_tdw', 'agama_tdw', 'trim|required');
		$this->form_validation->set_rules('pekerjaan_tdw', 'pekerjaan_tdw', 'trim|required');
		$this->form_validation->set_rules('kebangsaan_tdw', 'kebangsaan_tdw', 'trim|required');
		return $this->form_validation->run();
	}

	public function tambah_tdw()
	{

		if ($this->cek_tambah_tdw()) {
			$id_pn  		= $this->input->post('id_pn_tdw', true);
			$nm_tdw  		= $this->input->post('nm_tdw', true);
			$nik_tdw  	= $this->input->post('nik_tdw', true);
			$t_lahir_tdw  	= $this->input->post('t_lahir_tdw', true);
			$bln_tdw  		= $this->input->post('bln_tdw', true);
			$tgl_tdw  		= $this->input->post('tgl_tdw', true);
			$ta_tdw  		= $this->input->post('ta_tdw', true);
			$jk_tdw  		= $this->input->post('jk_tdw', true);
			$alamat_tdw  		= $this->input->post('alamat_tdw', true);
			$agama_tdw  		= $this->input->post('agama_tdw', true);
			$pekerjaan_tdw  		= $this->input->post('pekerjaan_tdw', true);
			$kebangsaan_tdw  		= $this->input->post('kebangsaan_tdw', true);
			$data = array(
				'id_tdw'       	=> random_string('alnum', 25),
				'id_pn'        		=> $id_pn,
				'nm_tdw'    			=> $nm_tdw,
				'nik_tdw'    			=> $nik_tdw,
				't_lahir_tdw'    	=> $t_lahir_tdw,
				'tgl_lahir_tdw'    		=> $ta_tdw . "-" . $bln_tdw . "-" . $tgl_tdw,
				'jk_tdw'    	=> $jk_tdw,
				'alamat_tdw'    	=> $alamat_tdw,
				'agama_tdw'    	=> $agama_tdw,
				'pekerjaan_tdw'    	=> $pekerjaan_tdw,
				'kebangsaan_tdw'    	=> $kebangsaan_tdw,

			);

			$this->m_penuntutan->insert_tdw($data);
		} else {
			show_404();
		}
	}
}
