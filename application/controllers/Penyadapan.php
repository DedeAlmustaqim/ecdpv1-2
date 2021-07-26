<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyadapan extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();
		if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2') || ($this->session->userdata('akses') == '3') || ($this->session->userdata('akses') == '4')) {
		} else {
			redirect('login');
		}

		$this->load->library('template');
		//MODEL

		$this->load->helper('string');
		$this->load->library('form_validation');
		$this->load->model('m_master');
		$this->load->model('m_pd');
		$this->load->library('datatables');
	}

	//INDEX PG
	public function index()
	{
		$this->load->library('template');
		$data['judul'] = "Penyadapan";
		$data['unit'] = $this->m_master->tampil_unit();
		$this->template->konten('penyadapan/pd', $data);
		//var_dump($data);
	}

	public function json_pd()
	{
		$data = $this->m_pd->json();
		header('Content-Type: application/json');
		echo $data;
	}

	private function cek_verif()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		return $this->form_validation->run();
	}
	public function verif()
	{
		if ($this->cek_verif()) {
			$data = array(
				'validasi'        => 1,
				'verif_date'        => date('Y-m-d H:i:s'),
				'verif_by'        => $this->session->userdata('ses_nm'),

			);
			$this->m_pd->valid($data);

			echo json_encode($data);
		} else {
			redirect('penyelidikan');
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
		if ($this->cek_buka_valid()) {
			
			$data = array(
				'verif_doc'        => null,
				'validasi'        => 1,
			);
			$this->m_pd->valid($data);
			unlink(FCPATH . 'file/pd/' . $this->input->post('edoc'));

			echo json_encode($data);
		} else {
			show_404();
		}
	}
	//VALIDASI
	public function valid()
	{

		$this->load->helper(['form', 'string']);
		$id      	= $this->input->post('id_verif_pd', true);
		$verif = $_FILES['verif_pd']['name'];

		$config['upload_path']          = 'file/pd/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $verif);
		$ext = strtolower(end($x));
		$config['file_name'] = $id . "_verif_pd." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$verif_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('verif_pd')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$data = array('verif_pd' => $this->upload->data());
			$data = array(

				'verif_doc'    		=> $verif_name,
				'validasi'        => 2,
				'verif_by'        => $this->session->userdata('ses_nm'),
				'verif_date'        => date('Y-m-d H:i:s'),
			);
			$this->m_pd->update($data, $id);
			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
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
		$edoc = $this->input->post('edoc');
		if ($this->cek_buka_verif()) {
			$data = array(
				'validasi'        => 0,
				'verif_date'        => null,
			);
			$this->m_pd->valid($data);
			echo json_encode($data);
			unlink(FCPATH . 'file/pd/' . $edoc);

		} else {
			show_404();
		}
	}


	//LIHAT PENYELIDIKAN 
	public function get_pd($id)
	{
		$row = $this->m_pd->get_pd($id);
		if ($row) {
			$data = array(
				'id_smohon_pd' 	=> $row->id_smohon_pd,
				'no_smohon_pd' 	=> $row->no_smohon_pd,
				'device' 	=> $row->device,
				'jk_start' 	=> $row->jk_start,
				'jk_end' 	=> $row->jk_end,
				'lokasi_pd' 	=> $row->lokasi_pd,
				'id_unit' 	=> $row->id_unit,
				'nm_unit' 	=> $row->nm_unit,
				'tgl1' 	=> $row->tgl1,
				'bl1' 	=> $row->bln1,
				'ta1' 	=> $row->ta1,
				'tgl2' 	=> $row->tgl2,
				'bl2' 	=> $row->bln2,
				'ta2' 	=> $row->ta2,
				'nm_unit' 	=> $row->nm_unit,
				'nm_unit' 	=> $row->nm_unit,
				'nm_unit' 	=> $row->nm_unit,
				'nm_unit' 	=> $row->nm_unit,
				'edoc_s_mohon' 	=> $row->edoc_s_mohon,
				'edoc_lap_pol_intel' 	=> $row->edoc_lap_pol_intel,
				'validasi' 	=> $row->validasi,

			);
		} else {
			echo "data kosong";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function tambah_pd()
	{
		$image_data = array();
		$document_data = array();

		$this->load->helper(['form', 'string']);
		$this->load->library('upload');

		$id      	= random_string('alnum', 25);


		$edoc_s_mohon = $_FILES['edoc1']['name'];

		$config1['upload_path']          = 'file/pd/';
		$config1['allowed_types']        = 'pdf';
		$x1 = explode(".", $edoc_s_mohon);
		$ext1 = strtolower(end($x1));
		$config1['file_name'] = $id . "_s_mohon." . $ext1;
		$config1['overwrite']            = true;
		$config1['max_size']             = 5024; // 1MB
		$edoc1_name = $config1['file_name'];
		$this->upload->initialize($config1);

		// process image upload first
		if (!$this->upload->do_upload('edoc1')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		}
		// image was uploaded properly, continue
		else {
			$image_data = $this->upload->data();
			$edoc_lap_pol_intel = $_FILES['edoc2']['name'];

			$config2['upload_path']          = 'file/pd/';
			$config2['allowed_types']        = 'pdf';
			$x2 = explode(".", $edoc_lap_pol_intel);
			$ext2 = strtolower(end($x2));
			$config2['file_name'] = $id . "_s_lap." . $ext2;
			$config2['overwrite']            = true;
			$config2['max_size']             = 5024; // 1MB
			$edoc2_name = $config2['file_name'];
			$this->upload->initialize($config2);

			if (!$this->upload->do_upload('edoc1')) {
				$array = array(
					'error'   => true,
				);
				echo json_encode($array);
			} else {

				$document_data = $this->upload->data();
				$no_srt_pd  		= $this->input->post('no_srt_pd', true);
				$unit_pd  		= $this->input->post('unit_pd', true);
				$perangkat_pd  	= $this->input->post('perangkat_pd', true);
				$tgl1  		= $this->input->post('tgl1', true);
				$bln1  		= $this->input->post('bln1', true);
				$ta1  		= $this->input->post('ta1', true);
				$tgl2  		= $this->input->post('tgl2', true);
				$bln2  		= $this->input->post('bln2', true);
				$ta2  		= $this->input->post('ta2', true);
				$lokasi_pd  		= $this->input->post('lokasi_pd', true);
				$data = array(
					'id_smohon_pd'       	=> $id,
					'no_smohon_pd'        	=> $no_srt_pd,
					'id_unit'    			=> $unit_pd,
					'device'    			=> $perangkat_pd,
					'jk_start'    		=> $ta1 . "-" . $bln1 . "-" . $tgl1,
					'jk_end'    		=> $ta2 . "-" . $bln2 . "-" . $tgl2,
					'lokasi_pd'    		=> $lokasi_pd,
					'edoc_s_mohon'    		=> $edoc1_name,
					'edoc_lap_pol_intel'    => $edoc2_name,
					'create_by_pd'       		=> $this->session->userdata('ses_nm'),
					'created_at_pd'       		=> date('Y-m-d H:i:s'),
				);
				$this->m_pd->insert($data);
				$array = array(
					'success' => 'sukses'
				);

				echo json_encode($array);
			}
		}
	}

	public function edit_pd()
	{
        $id = $this->input->post('id_smohon_pd');
        $no_srt_pd_edit = $this->input->post('no_srt_pd_edit');
        $unit_pd_edit = $this->input->post('unit_pd_edit');
        $perangkat_pd_edit = $this->input->post('perangkat_pd_edit');
        $tgl1_edit = $this->input->post('tgl1_edit');
        $bln1_edit = $this->input->post('bln1_edit');
		$ta1_edit = $this->input->post('ta1_edit');
		$tgl2_edit = $this->input->post('tgl2_edit');
        $bln2_edit = $this->input->post('bln2_edit');
        $ta2_edit = $this->input->post('ta2_edit');
        $lokasi_pd_edit = $this->input->post('lokasi_pd_edit');

		$data = array(
			'no_smohon_pd'       	=> $no_srt_pd_edit,
			'id_unit'        		=> $unit_pd_edit,
			'device'    			=> $perangkat_pd_edit,
			'jk_start'    		=> $ta1_edit . "-" . $bln1_edit . "-" . $tgl1_edit,
			'jk_end'    		=> $ta2_edit . "-" . $bln2_edit . "-" . $tgl2_edit,
			'lokasi_pd'    			=> $lokasi_pd_edit,
			'update_by_pd'       		=> $this->session->userdata('ses_nm'),
			'updated_at_pd'       		=> date('Y-m-d H:i:s'),
		);
		$this->m_pd->update($data, $id);
		$array = array(
			'success' => 'sukses'
		);

		echo json_encode($array);
	}
	
	public function reupload_smohon()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc1      	= $this->input->post('id_pd', true);
		$edoc1 = $_FILES['edoc1_pd_edit']['name'];

		$config['upload_path']          = 'file/pd/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc1);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc1 . "_s_mohon." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc1_pd_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc1_pd_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	public function reupload_lap_pol_intel()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc2      	= $this->input->post('id_pd2', true);
		$edoc2 = $_FILES['edoc2_pd_edit']['name'];

		$config['upload_path']          = 'file/pd/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc2);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc2 . "_s_lap." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc2_pd_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc2_pd_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	private function cek_delete_pd()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		$this->form_validation->set_rules('smohon', 's_mohon', 'trim|required');
		$this->form_validation->set_rules('lap', 'lap', 'trim|required');
		return $this->form_validation->run();
	}
	public function delete_pd()
	{
		if ($this->cek_delete_pd()) {
			$this->load->helper('file');
			$id = $this->input->post('id');
			$smohon = $this->input->post('smohon');
			$lap = $this->input->post('lap');
			$this->db->where('id_smohon_pd', $id);
			$this->db->delete('tbl_pd');
			unlink(FCPATH . 'file/pd/' . $smohon);
			unlink(FCPATH . 'file/pd/' . $lap);
			die;
		} else {
			redirect('penyelidikan');
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
}
