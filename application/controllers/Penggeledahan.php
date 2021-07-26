<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penggeledahan extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();
		$this->load->library('template');
		//MODEL

		$this->load->helper('string');
		$this->load->library('form_validation');
		$this->load->model('m_master');
		$this->load->model('m_pg');
		$this->load->library('datatables');
	}

	//INDEX PG
	public function index()
	{
		$this->load->library('template');
		$data['judul'] = "Penggeledahan";
		$data['unit'] = $this->m_master->tampil_unit();
		$this->template->konten('penggeledahan/penggeledahan', $data);
		//var_dump($data);
	}

	public function json_pg()
	{
		$data = $this->m_pg->json_pg();
		header('Content-Type: application/json');
		echo $data;
	}
	private function validasi_form_pg()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('no_srt_pg', 'no_srt_pg', 'trim|required');
		$this->form_validation->set_rules('unit', 'unit', 'trim|required');

		return $this->form_validation->run();
	}
	public function tambah_pg()
	{
		$this->load->helper(['form', 'string']);

		if ($this->validasi_form_pg()) {
			$no_srt_pg      = $this->input->post('no_srt_pg', true);
			$unit      		= $this->input->post('unit', true);

			$data = array(
				'id_ijin_pg'        => random_string('alnum', 16),
				'no_srt'        	=> $no_srt_pg,
				'id_unit'        	=> $unit,
				'created_at'       	=> date('Y-m-d H:i:s'),
			);
			$this->m_pg->insert_pg($data);
			echo json_encode($data);
		} else {
			redirect('penggeledahan');
		}
	}

	private function validasi_form_edit_pg()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_ijin_pg_edit', 'id_ijin_pg_edit', 'trim|required');
		$this->form_validation->set_rules('no_srt_pg_edit', 'no_srt_pg_edit', 'trim|required');
		$this->form_validation->set_rules('unit_edit', 'unit_edit', 'trim|required');

		return $this->form_validation->run();
	}
	public function edit_pg()
	{
		$this->load->helper(['form', 'string']);

		if ($this->validasi_form_edit_pg()) {
			$no_srt_pg_edit      = $this->input->post('no_srt_pg_edit', true);
			$unit_edit      		= $this->input->post('unit_edit', true);

			$data = array(
				'no_srt'        	=> $no_srt_pg_edit,
				'id_unit'        	=> $unit_edit,
				'updated_at'       	=> date('Y-m-d H:i:s'),
			);
			$this->m_pg->update_pg($data);
			echo json_encode($data);
		} else {
			redirect('penggeledahan');
		}
	}

	public function kunci_pg()
	{
		$data = array(
			'status'        => 1,
		);
		$this->m_pg->kunci_pg($data);
		echo json_encode($data);
	}

	public function buka_kunci_pg()
	{
		$data = array(
			'status'        => 0,
		);
		$this->m_pg->buka_kunci_pg($data);
		echo json_encode($data);
	}

	public function delete_pg($id)
	{
		$this->db->where('id_ijin_pg', $id);
		$result = $this->db->delete('tbl_pg');
		return $result;
	}

	//PENYELIDKAN
	public function penyelidikan($id)
	{
		$this->load->library('template');
		$row = $this->m_pg->get_by_id($id);
		if ($row) {
			$data = array(
				'judul'     	=>   "Tambah Data Penyelidikan",
				'id_ijin_pg' 	=> $row->id_ijin_pg,
				'no_srt' 		=> $row->no_srt,
			);
		} else {
			echo "data kosong";
		}
		$this->template->konten('penggeledahan/penyelidikan', $data);
		//var_dump($data);
	}
	//PENYELIDKAN
	public function re_upload_penyelidikan($id)
	{
		$this->load->library('template');
		$row = $this->m_pg->get_by_id($id);
		if ($row) {
			$data = array(
				'judul'     	=>   "Tahap Penyelidikan",
				'id_ijin_pg' 	=> $row->id_ijin_pg,
				'no_srt' 		=> $row->no_srt,
			);
		} else {
			echo "data kosong";
		}
		$this->template->konten('penggeledahan/re_upload_penyelidikan', $data);
		//var_dump($data);
	}

	public function re_upload_penyidikan($id)
	{
		$this->load->library('template');
		$row = $this->m_pg->get_by_id($id);
		if ($row) {
			$data = array(
				'judul'     	=>   "Upload Ulang Berkas Penyidikan",
				'id_ijin_pg' 	=> $row->id_ijin_pg,
				'no_srt' 		=> $row->no_srt,
			);
		} else {
			echo "data kosong";
		}
		$this->template->konten('penggeledahan/re_upload_penyidikan', $data);
		//var_dump($data);
	}
	//LIHAT PENYELIDIKAN 
	public function get_id_penyelidikan($id)
	{
		$row = $this->m_pg->get_by_id_penyelidikan($id);
		if ($row) {
			$data = array(
				'id_ijin_pg' 	=> $row->id_ijin_pg,
				'no_srt' 		=> $row->no_srt,
				'jns_srt' 		=> $row->jns_srt,
				'jns_geledah' 		=> $row->jns_geledah,
				'lokasi' 		=> $row->lokasi,
				'pemilik_lok' 		=> $row->pemilik_lok,
				'edoc_pnyldk' 		=> $row->edoc_pnyldk,
			);
		} else {
			echo "data kosong";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	private function validasi_form_penyelidikan()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_pg', 'id_pg', 'trim|required');
		$this->form_validation->set_rules('nmr_srt', 'nmr_srt', 'trim|required');
		$this->form_validation->set_rules('jns_srt', 'jns_srt', 'trim|required');
		$this->form_validation->set_rules('jns_geledah', 'jns_geledah', 'trim|required');
		$this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
		$this->form_validation->set_rules('pemilik_lok', 'pemilik_lok', 'trim|required');
		//$this->form_validation->set_rules('edoc_pnyldk', 'edoc_pnyldk', 'trim|required');

		return $this->form_validation->run();
	}
	public function tambah_penyelidikan()
	{

		$this->load->helper(['form', 'string']);

		$id_pg      	= $this->input->post('id_pg', true);
		$edoc_pnyldk = $_FILES['edoc_pnyldk']['name'];

		$config['upload_path']          = 'file/penyelidikan/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc_pnyldk);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_pg . "." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$edoc_pnyldk_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc_pnyldk')) {
			$this->session->set_flashdata('gagal', 'Format berkas tidak sesuai atau melebihi ukuran masksimal ');
			redirect('penggeledahan/penyelidikan/' . $id_pg);
		} else {
			if ($this->validasi_form_penyelidikan()) {
				$id_pg      	= $this->input->post('id_pg', true);
				$jns_srt  		= $this->input->post('jns_srt', true);
				$nmr_srt  		= $this->input->post('nmr_srt', true);
				$jns_geledah  	= $this->input->post('jns_geledah', true);
				$lokasi  		= $this->input->post('lokasi', true);
				$pemilik_lok  	= $this->input->post('pemilik_lok', true);

				$data = array('edoc_pnyldk' => $this->upload->data());
				$data = array(
					'id_penyelidikan'       => random_string('alnum', 16),
					'id_ijin_pg'        	=> $id_pg,
					'jns_srt'    			=> $jns_srt,
					'no_srt'    			=> $nmr_srt,
					'jns_geledah'    		=> $jns_geledah,
					'lokasi'    			=> $lokasi,
					'pemilik_lok'    		=> $pemilik_lok,
					'edoc_pnyldk'    		=> $edoc_pnyldk_name,
					'created_at'       		=> date('Y-m-d H:i:s'),
				);
				$this->m_pg->insert_penyelidikan($data);
				//echo json_encode($data);
				redirect('penggeledahan');
			} else {
				redirect('penggeledahan/penyelidikan' . $id_pg);
			}
		}
	}

	public function reupload_penyelidikan()
	{

		$this->load->helper(['form', 'string']);

		$id_pg      	= $this->input->post('id_pg', true);
		$edoc_pnyldk = $_FILES['edoc_pnyldk']['name'];

		$config['upload_path']          = 'file/penyelidikan/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc_pnyldk);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_pg . "." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$edoc_pnyldk_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc_pnyldk')) {
			$this->session->set_flashdata('gagal', 'Format berkas tidak sesuai atau melebihi ukuran masksimal ');
			redirect('penggeledahan/re_upload_penyelidikan/' . $id_pg);
		} else {
			$data = array('edoc_pnyldk' => $this->upload->data());
			$data = array(

				'edoc_pnyldk'    		=> $edoc_pnyldk_name,
				'created_at'       		=> date('Y-m-d H:i:s'),
			);
			$this->m_pg->update_penyelidikan($data);
			//echo json_encode($data);
			redirect('penggeledahan');
		}
	}

	public function reupload_penyidikan()
	{

		$this->load->helper(['form', 'string']);

		$id_pg_pydk      	= $this->input->post('id_pg_pydk', true);
		$edoc_pydk = $_FILES['edoc_pydk']['name'];

		$config['upload_path']          = 'file/penyidikan/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc_pydk);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_pg_pydk . "." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$edoc_pydk_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc_pydk')) {
			$this->session->set_flashdata('gagal', 'Format berkas tidak sesuai atau melebihi ukuran masksimal ');
			redirect('penggeledahan/re_upload_penyidikan/' . $id_pg_pydk);
		} else {
			$data = array('edoc_pydk' => $this->upload->data());
			$data = array(

				'edoc_pydk'    		=> $edoc_pydk_name,
				'created_at'       		=> date('Y-m-d H:i:s'),
			);
			$this->m_pg->update_penyidikan($data);
			//echo json_encode($data);
			redirect('penggeledahan');
		}
	}

	public function delete_penyelidikan()
	{
		$this->load->helper('file');
		$id = $this->input->post('id');
		$edoc = $this->input->post('edoc');
		$this->db->where('id_ijin_pg', $id);
		$this->db->delete('tbl_penyelidikan');
		unlink(FCPATH . 'file/penyelidikan/' . $edoc);
		die;
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



	public function get_id_penyidikan($id)
	{
		$row = $this->m_pg->get_by_id_penyidikan($id);
		if ($row) {
			$data = array(
				'id_ijin_pg' 	=> $row->id_ijin_pg,
				'no_srt_pydk' 		=> $row->no_srt_pydk,
				'jns_srt_pydk' 		=> $row->jns_srt_pydk,
				'jns_geledah_pydk' 		=> $row->jns_geledah_pydk,
				'lokasi_pydk' 		=> $row->lokasi_pydk,
				'pemilik_lok_pydk' 		=> $row->pemilik_lok_pydk,
				'nik_pydk' 		=> $row->nik_pydk,
				't_lahir_pydk' 		=> $row->t_lahir_pydk,
				'tgl_lahir_pydk' 		=> $row->tgl_lahir_pydk,
				'j_kelamin_pydk' 		=> $row->pemilik_lok_pydk,
				'agama_pydk' 		=> $row->agama_pydk,
				'pekerjaan_pydk' 		=> $row->pekerjaan_pydk,
				'kebangsaan_pydk' 		=> $row->kebangsaan_pydk,
				'edoc_pydk' 		=> $row->edoc_pydk,
			);
		} else {
			echo "data kosong";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	private function validasi_form_penyelidikan_edit()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_pg', 'id_pg', 'trim|required');
		$this->form_validation->set_rules('nmr_srt', 'nmr_srt', 'trim|required');
		$this->form_validation->set_rules('jns_srt', 'jns_srt', 'trim|required');
		$this->form_validation->set_rules('jns_geledah', 'jns_geledah', 'trim|required');
		$this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
		$this->form_validation->set_rules('pemilik_lok', 'pemilik_lok', 'trim|required');
		//$this->form_validation->set_rules('edoc_pnyldk', 'edoc_pnyldk', 'trim|required');

		return $this->form_validation->run();
	}

	public function edit_penyelidikan()
	{
		$id_pg      	= $this->input->post('id_pg', true);

		if ($this->validasi_form_penyelidikan_edit()) {
			$jns_srt  		= $this->input->post('jns_srt', true);
			$nmr_srt  		= $this->input->post('nmr_srt', true);
			$jns_geledah  	= $this->input->post('jns_geledah', true);
			$lokasi  		= $this->input->post('lokasi', true);
			$pemilik_lok  	= $this->input->post('pemilik_lok', true);

			$data = array(
				'jns_srt'    			=> $jns_srt,
				'no_srt'    			=> $nmr_srt,
				'jns_geledah'    		=> $jns_geledah,
				'lokasi'    			=> $lokasi,
				'pemilik_lok'    		=> $pemilik_lok,
				'created_at'       		=> date('Y-m-d H:i:s'),
			);
			$this->m_pg->update_penyelidikan($data);
			//echo json_encode($data);
			redirect('penggeledahan');
		} else {
			redirect('penggeledahan/penyelidikan_edit/' . $id_pg);
		}
	}



	//PENYIDIKAN
	public function penyidikan($id)
	{
		$this->load->library('template');
		$row = $this->m_pg->get_by_id($id);
		if ($row) {
			$data = array(
				'judul'     	=> "Tahap Penyidikan",
				'id_ijin_pg' 	=> $row->id_ijin_pg,
				'no_srt' 		=> $row->no_srt,
			);
		} else {
			echo "data kosong";
		}
		$this->template->konten('penggeledahan/penyidikan', $data);
		//var_dump($data);

	}
	// EDIT PENYIDIKAN
	public function penyidikan_edit($id)
	{
		$this->load->library('template');
		$row = $this->m_pg->get_by_id_penyidikan($id);
		if ($row) {
			$data = array(
				'judul'     	=>   "Edit Penyidikan",
				'id_ijin_pg' 	=> $row->id_ijin_pg,
				'no_srt_pydk' 	=> $row->no_srt_pydk,
				'jns_srt_pydk' 	=> $row->jns_srt_pydk,
				'jns_geledah_pydk' 	=> $row->jns_geledah_pydk,
				'lokasi_pydk' 	=> $row->lokasi_pydk,
				'pemilik_lok_pydk' 	=> $row->pemilik_lok_pydk,
				'nik_pydk' 	=> $row->nik_pydk,
				't_lahir_pydk' 	=> $row->t_lahir_pydk,
				'tgl_lahir_pydk' 	=> $row->tgl_lahir_pydk,
				'date_lahir_pydk' 	=> $row->date_lahir_pydk,
				'j_kelamin_pydk' 	=> $row->j_kelamin_pydk,
				'agama_pydk' 	=> $row->agama_pydk,
				'pekerjaan_pydk' 	=> $row->pekerjaan_pydk,
				'kebangsaan_pydk' 	=> $row->kebangsaan_pydk,

			);
		} else {
			echo "data kosong";
		}
		$this->template->konten('penggeledahan/penyidikan_edit', $data);
		//var_dump($data);
	}
	private function validasi_form_penyidikan()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_pg_pydk', 'id_pg_pydk', 'trim|required');
		$this->form_validation->set_rules('nmr_srt_pydk', 'nmr_srt_pydk', 'trim|required');
		$this->form_validation->set_rules('jns_srt_pydk', 'jns_srt_pydk', 'trim|required');
		$this->form_validation->set_rules('jns_geledah_pydk', 'jns_geledah_pydk', 'trim|required');
		$this->form_validation->set_rules('lokasi_pydk', 'lokasi_pydk', 'trim|required');
		$this->form_validation->set_rules('pemilik_lok_pydk', 'pemilik_lok_pydk', 'trim|required');
		$this->form_validation->set_rules('nik_pydk', 'nik_pydk', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir_pydk', 'tgl_lahir_pydk', 'trim|required');
		$this->form_validation->set_rules('j_kelamin_pydk', 'j_kelamin_pydk', 'trim|required');
		$this->form_validation->set_rules('agama_pydk', 'agama_pydk', 'trim|required');
		$this->form_validation->set_rules('pekerjaan_pydk', 'pekerjaan_pydk', 'trim|required');
		$this->form_validation->set_rules('kebangsaan_pydk', 'kebangsaan_pydk	', 'trim|required');

		return $this->form_validation->run();
	}
	public function tambah_penyidikan()
	{
		$this->load->helper(['form', 'string']);

		$id_pg_pydk      	= $this->input->post('id_pg_pydk', true);
		$edoc_pydk = $_FILES['edoc_pydk']['name'];

		$config['upload_path']          = 'file/penyidikan';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc_pydk);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_pg_pydk . "." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$edoc_pydk_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya

		if (!$this->upload->do_upload('edoc_pydk')) {
			$this->session->set_flashdata('gagal_pydk', 'Format berkas tidak sesuai atau melebihi ukuran masksimal');
			redirect('penggeledahan/penyidikan/' . $id_pg_pydk);
		} else {
			if ($this->validasi_form_penyidikan()) {
				$id_pg_pydk      	= $this->input->post('id_pg_pydk', true);
				$nmr_srt_pydk  		= $this->input->post('nmr_srt_pydk', true);
				$jns_srt_pydk  		= $this->input->post('jns_srt_pydk', true);
				$jns_geledah_pydk  	= $this->input->post('jns_geledah_pydk', true);
				$lokasi_pydk  		= $this->input->post('lokasi_pydk', true);
				$pemilik_lok_pydk  	= $this->input->post('pemilik_lok_pydk', true);
				$nik_pydk  			= $this->input->post('nik_pydk', true);
				$tgl_lahir_pydk  	= $this->input->post('tgl_lahir_pydk', true);
				$t_lahir_pydk  		= $this->input->post('t_lahir_pydk', true);
				$j_kelamin_pydk  	= $this->input->post('j_kelamin_pydk', true);
				$agama_pydk  		= $this->input->post('agama_pydk', true);
				$pekerjaan_pydk  	= $this->input->post('pekerjaan_pydk', true);
				$kebangsaan_pydk  	= $this->input->post('kebangsaan_pydk', true);

				$data = array('edoc_pydk' => $this->upload->data());
				$data = array(
					'id_penyidikan'        	=> random_string('alnum', 16),
					'id_ijin_pg'        	=> $id_pg_pydk,
					'no_srt_pydk'    		=> $nmr_srt_pydk,
					'jns_srt_pydk'    		=> $jns_srt_pydk,
					'jns_geledah_pydk'    	=> $jns_geledah_pydk,
					'lokasi_pydk'    		=> $lokasi_pydk,
					'pemilik_lok_pydk'    	=> $pemilik_lok_pydk,
					'nik_pydk'    			=> $nik_pydk,
					't_lahir_pydk'    		=> $t_lahir_pydk,
					'tgl_lahir_pydk'    	=> $tgl_lahir_pydk,
					'j_kelamin_pydk'    	=> $j_kelamin_pydk,
					'agama_pydk'    		=> $agama_pydk,
					'pekerjaan_pydk'    	=> $pekerjaan_pydk,
					'kebangsaan_pydk'    	=> $kebangsaan_pydk,
					'edoc_pydk'    			=> $edoc_pydk_name,
					'created_at'       		=> date('Y-m-d H:i:s'),
				);
				$this->m_pg->insert_penyidikan($data);
				//echo json_encode($data);
				redirect('penggeledahan');
			} else {
				redirect('penggeledahan/penyidikan' . $id_pg_pydk);
			}
		}
	}

	private function validasi_form_edit_penyidikan()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_pg_pydk', 'id_pg_pydk', 'trim|required');
		$this->form_validation->set_rules('nmr_srt_pydk', 'nmr_srt_pydk', 'trim|required');
		$this->form_validation->set_rules('jns_srt_pydk', 'jns_srt_pydk', 'trim|required');
		$this->form_validation->set_rules('jns_geledah_pydk', 'jns_geledah_pydk', 'trim|required');
		$this->form_validation->set_rules('lokasi_pydk', 'lokasi_pydk', 'trim|required');
		$this->form_validation->set_rules('pemilik_lok_pydk', 'pemilik_lok_pydk', 'trim|required');
		$this->form_validation->set_rules('nik_pydk', 'nik_pydk', 'trim|required');
		//$this->form_validation->set_rules('tgl_lahir_pydk', 'tgl_lahir_pydk', 'trim|required');
		$this->form_validation->set_rules('j_kelamin_pydk', 'j_kelamin_pydk', 'trim|required');
		$this->form_validation->set_rules('agama_pydk', 'agama_pydk', 'trim|required');
		$this->form_validation->set_rules('pekerjaan_pydk', 'pekerjaan_pydk', 'trim|required');
		$this->form_validation->set_rules('kebangsaan_pydk', 'kebangsaan_pydk	', 'trim|required');

		return $this->form_validation->run();
	}
	public function edit_penyidikan()
	{
		$this->load->helper(['form', 'string']);

		$id_pg_pydk      	= $this->input->post('id_pg_pydk', true);


		if ($this->validasi_form_edit_penyidikan()) {
			$id_pg_pydk      	= $this->input->post('id_pg_pydk', true);
			$nmr_srt_pydk  		= $this->input->post('nmr_srt_pydk', true);
			$jns_srt_pydk  		= $this->input->post('jns_srt_pydk', true);
			$jns_geledah_pydk  	= $this->input->post('jns_geledah_pydk', true);
			$lokasi_pydk  		= $this->input->post('lokasi_pydk', true);
			$pemilik_lok_pydk  	= $this->input->post('pemilik_lok_pydk', true);
			$nik_pydk  			= $this->input->post('nik_pydk', true);
			//$tgl_lahir_pydk  	= $this->input->post('tgl_lahir_pydk', true);
			$t_lahir_pydk  		= $this->input->post('t_lahir_pydk', true);
			$j_kelamin_pydk  	= $this->input->post('j_kelamin_pydk', true);
			$agama_pydk  		= $this->input->post('agama_pydk', true);
			$pekerjaan_pydk  	= $this->input->post('pekerjaan_pydk', true);
			$kebangsaan_pydk  	= $this->input->post('kebangsaan_pydk', true);

			$data = array(
				'id_penyidikan'        	=> random_string('alnum', 16),
				'id_ijin_pg'        	=> $id_pg_pydk,
				'no_srt_pydk'    		=> $nmr_srt_pydk,
				'jns_srt_pydk'    		=> $jns_srt_pydk,
				'jns_geledah_pydk'    	=> $jns_geledah_pydk,
				'lokasi_pydk'    		=> $lokasi_pydk,
				'pemilik_lok_pydk'    	=> $pemilik_lok_pydk,
				'nik_pydk'    			=> $nik_pydk,
				't_lahir_pydk'    		=> $t_lahir_pydk,
				//'tgl_lahir_pydk'    	=> $tgl_lahir_pydk,
				'j_kelamin_pydk'    	=> $j_kelamin_pydk,
				'agama_pydk'    		=> $agama_pydk,
				'pekerjaan_pydk'    	=> $pekerjaan_pydk,
				'kebangsaan_pydk'    	=> $kebangsaan_pydk,
				'created_at'       		=> date('Y-m-d H:i:s'),
			);
			$this->m_pg->update_penyidikan($data);
			//echo json_encode($data);
			redirect('penggeledahan');
		} else {
			redirect('penggeledahan/penyidikan_edit/' . $id_pg_pydk);
		}
	}


	public function delete_penyidikan()
	{
		$this->load->helper('file');
		$id = $this->input->post('id');
		$edoc = $this->input->post('edoc');
		$this->db->where('id_ijin_pg', $id);
		$this->db->delete('tbl_penyidikan');
		unlink(FCPATH . 'file/penyidikan/' . $edoc);
		die;
	}
}
