<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ijinsita_p extends CI_Controller
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
		$this->load->model('m_ijinsita_p');
		$this->load->library('datatables');
	}

	//INDEX PG
	public function index()
	{
		$this->load->library('template');
		$data['judul'] = "Penyitaan - Ijin Sita ";
		$data['unit'] = $this->m_master->tampil_unit();
		$this->template->konten('penyitaan/ijin_sita_p', $data);
		//var_dump($data);
	}



	public function json()
	{
		$data = $this->m_ijinsita_p->json();
		header('Content-Type: application/json');
		echo $data;
	}

	public function json_brg_sita($id)
	{
		$data = $this->m_ijinsita_p->json_brg_sita($id);
		header('Content-Type: application/json');
		echo $data;
	}

	//VALIDASI
	public function valid()
	{

		$this->load->helper(['form', 'string']);
		$id      	= $this->input->post('id_verif_sita_p', true);
		$verif = $_FILES['verif_sita_p']['name'];

		$config['upload_path']          = 'file/st/ijinsita_p';
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

		if (!$this->upload->do_upload('verif_sita_p')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$data = array('verif_sita_p' => $this->upload->data());
			$data = array(

				'verif_doc'    		=> $verif_name,
				'validasi'        => 2,
				'verif_by'        => $this->session->userdata('ses_nm'),
				'verif_date'        => date('Y-m-d H:i:s'),
			);
			$this->m_ijinsita_p->verif($data, $id);
			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
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
				'verif_by'       		=> $this->session->userdata('ses_nm'),

			);
			$this->m_ijinsita_p->valid($data);

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
			);
			$this->m_ijinsita_p->valid($data);
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
			$this->m_ijinsita_p->valid($data);
			unlink(FCPATH . 'file/st/ijinsita' . $edoc);
			echo json_encode($data);
		} else {
			show_404();
		}
	}


	//LIHAT PENYELIDIKAN 
	public function get_id_ijin_sita($id)
	{
		$row = $this->m_ijinsita_p->get_id_ijin_sita($id);
		if ($row) {
			$data = array(
				'id_ijin_sita' 	=> $row->id_ijin_sita,
				'no_smohon_sita' 	=> $row->no_smohon_sita,
				'nm_unit' 	=> $row->nm_unit,
				'id_unit' 	=> $row->id_unit,
				'validasi' 	=> $row->validasi,
				'edoc_smohon' 	=> $row->edoc_smohon,
				'edoc_lap_pol_intel' 	=> $row->edoc_lap_pol_intel,
				'edoc_sprint_sidik' 	=> $row->edoc_sprint_sidik,
				'edoc_sprint_sita' 	=> $row->edoc_sprint_sita,
				'edoc_sp' 	=> $row->edoc_sp,
				'created_at_sita' 	=> $row->created_at_sita,

			);
		} else {
			echo "data kosong";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}


	public function tambah_st()
	{
		$file1 = array();
		$file2 = array();
		$file3 = array();
		$file4 = array();


		$this->load->helper(['form', 'string']);
		$this->load->library('upload');

		$id      	= random_string('alnum', 25);


		$edoc1 = $_FILES['edoc_st1_p']['name'];

		$config1['upload_path']          = 'file/st/ijinsita_p/';
		$config1['allowed_types']        = 'pdf';
		$x1 = explode(".", $edoc1);
		$ext1 = strtolower(end($x1));
		$config1['file_name'] = $id . "_s_mohon." . $ext1;
		$config1['overwrite']            = true;
		$config1['max_size']             = 3072; // 1MB
		$edoc1_name = $config1['file_name'];
		$this->upload->initialize($config1);

		// process image upload first
		if (!$this->upload->do_upload('edoc_st1_p')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		}
		// image was uploaded properly, continue
		else {
			$file1 = $this->upload->data();
			$edoc2 = $_FILES['edoc_st2_p']['name'];

			$config2['upload_path']          = 'file/st/ijinsita_p/';
			$config2['allowed_types']        = 'pdf';
			$x2 = explode(".", $edoc2);
			$ext2 = strtolower(end($x2));
			$config2['file_name'] = $id . "_s_lap." . $ext2;
			$config2['overwrite']            = true;
			$config2['max_size']             = 3072; // 1MB
			$edoc2_name = $config2['file_name'];
			$this->upload->initialize($config2);

			if (!$this->upload->do_upload('edoc_st2_p')) {
				$array = array(
					'error'   => true,
				);
				echo json_encode($array);
			} else {
				$file2 = $this->upload->data();
				$edoc3 = $_FILES['edoc_st3_p']['name'];

				$config3['upload_path']          = 'file/st/ijinsita_p/';
				$config3['allowed_types']        = 'pdf';
				$x3 = explode(".", $edoc3);
				$ext3 = strtolower(end($x3));
				$config3['file_name'] = $id . "_sprint_sidik." . $ext3;
				$config3['overwrite']            = true;
				$config3['max_size']             = 3072; // 1MB
				$edoc3_name = $config3['file_name'];
				$this->upload->initialize($config3);

				if (!$this->upload->do_upload('edoc_st3_p')) {
					$array = array(
						'error'   => true,
					);
					echo json_encode($array);
				} else {
					$file3 = $this->upload->data();
					$edoc4 = $_FILES['edoc_st4_p']['name'];

					$config4['upload_path']          = 'file/st/ijinsita_p/';
					$config4['allowed_types']        = 'pdf';
					$x4 = explode(".", $edoc4);
					$ext3 = strtolower(end($x4));
					$config4['file_name'] = $id . "_perintah." . $ext3;
					$config4['overwrite']            = true;
					$config4['max_size']             = 3072; // 1MB
					$edoc4_name = $config4['file_name'];
					$this->upload->initialize($config4);

					if (!$this->upload->do_upload('edoc_st4_p')) {
						$array = array(
							'error'   => true,
						);
						echo json_encode($array);
					} else {
						$file4 = $this->upload->data();
						$edoc5 = $_FILES['edoc_st5_p']['name'];

						$config5['upload_path']          = 'file/st/ijinsita_p/';
						$config5['allowed_types']        = 'pdf';
						$x5 = explode(".", $edoc5);
						$ext5 = strtolower(end($x5));
						$config5['file_name'] = $id . "_sprint_sita." . $ext5;
						$config5['overwrite']            = true;
						$config5['max_size']             = 3072; // 1MB
						$edoc5_name = $config5['file_name'];
						$this->upload->initialize($config5);

						if (!$this->upload->do_upload('edoc_st5_p')) {
							$array = array(
								'error'   => true,
							);
							echo json_encode($array);
						} else {
							$no_smohon_sita  		= $this->input->post('no_smohon_sita_p', true);
							$unit_st 			= $this->input->post('unit_st_p', true);

							$data = array(
								'id_ijin_sita'       			=> $id,
								'no_smohon_sita'        	=> $no_smohon_sita,
								'id_unit'    			=> $unit_st,

								'edoc_smohon'    		=> $edoc1_name,
								'edoc_lap_pol_intel'    => $edoc2_name,
								'edoc_sprint_sidik'    	=> $edoc3_name,
								'edoc_sp'    			=> $edoc4_name,
								'edoc_sprint_sita'    			=> $edoc5_name,
								'create_by_sita'       	=> $this->session->userdata('ses_nm'),
								'created_at_sita'       	=> date('Y-m-d H:i:s'),
							);
							$this->m_ijinsita_p->insert($data);
							$array = array(
								'success' => 'sukses'
							);

							echo json_encode($array);
						}
					}
				}
			}
		}
	}

	public function edit_st()
	{
		$valid = $this->input->post('validasi_st');
		$id = $this->input->post('id_ijin_sita_edit');

		$no_smohon_sita_edit  		= $this->input->post('no_smohon_sita_edit_p', true);
		$unit_st_edit  		= $this->input->post('unit_st_edit_p', true);

		$data = array(
			'no_smohon_sita'       	=> $no_smohon_sita_edit,
			'id_unit'        		=> $unit_st_edit,

			'update_by_sita'       		=> $this->session->userdata('ses_nm'),
			'updated_at_sita'       		=> date('Y-m-d H:i:s'),
		);
		$this->m_ijinsita_p->update($data);
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

		$config['upload_path']          = 'file/st/ijinsita_p/';
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

		$config['upload_path']          = 'file/st/ijinsita_p/';
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

		$config['upload_path']          = 'file/st/ijinsita_p/';
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

		$config['upload_path']          = 'file/st/ijinsita_p/';
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

	private function cek_delete_st()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		$this->form_validation->set_rules('smohon', 's_mohon', 'trim|required');
		$this->form_validation->set_rules('lap', 'lap', 'trim|required');
		$this->form_validation->set_rules('penetapan', 'penetapan', 'trim|required');
		$this->form_validation->set_rules('sp', 'sp', 'trim|required');
		return $this->form_validation->run();
	}
	public function delete_st()
	{
		if ($this->cek_delete_st()) {
			$this->load->helper('file');
			$id = $this->input->post('id');
			$smohon = $this->input->post('smohon');
			$lap = $this->input->post('lap');
			$penetapan = $this->input->post('penetapan');
			$sp = $this->input->post('sp');
			$this->db->where('id_ijin_sita', $id);
			$this->db->delete('tbl_ijinsita_p');
			unlink(FCPATH . 'file/st/ijinsita_p/' . $smohon);
			unlink(FCPATH . 'file/st/ijinsita_p/' . $lap);
			unlink(FCPATH . 'file/st/ijinsita_p/' . $penetapan);
			unlink(FCPATH . 'file/st/ijinsita_p/' . $sp);
			die;
		} else {
			echo "error";
		}
	}

	private function cek_delete_brg()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');

		return $this->form_validation->run();
	}
	public function delete_brg()
	{
		if ($this->cek_delete_brg()) {
			$this->load->helper('file');
			$id = $this->input->post('id');

			$this->db->where('id_brg_ijin_sita', $id);
			$this->db->delete('tbl_brg_ijin_sita_p');
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

	private function cek_tambah_brg()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_ijin_sita', 'id_ijin_sita', 'trim|required');
		$this->form_validation->set_rules('nm_brg', 'nm_brg', 'trim|required');
		$this->form_validation->set_rules('jml', 'jml', 'trim|required');
		$this->form_validation->set_rules('lokasi_sita', 'lokasi_sita', 'trim|required');
		$this->form_validation->set_rules('plk_sita', 'plk_sita', 'trim|required');
		$this->form_validation->set_rules('pemilik', 'pemilik', 'trim|required');
		$this->form_validation->set_rules('ket', 'ket', 'trim|required');
		return $this->form_validation->run();
	}

	public function tambah_brg()
	{

		if ($this->cek_tambah_brg()) {
			$id_ijin_sita  		= $this->input->post('id_ijin_sita', true);
			$nm_brg  		= $this->input->post('nm_brg', true);
			$jml  	= $this->input->post('jml', true);
			$lokasi_sita  	= $this->input->post('lokasi_sita', true);
			$plk_sita  		= $this->input->post('plk_sita', true);
			$pemilik  		= $this->input->post('pemilik', true);
			$ket  		= $this->input->post('ket', true);
			$data = array(
				'id_brg_ijin_sita'       	=> random_string('alnum', 25),
				'id_ijin_sita'        		=> $id_ijin_sita,
				'nm_brg'    			=> $nm_brg,
				'jml'    			=> $jml,
				'lokasi_sita'    	=> $lokasi_sita,
				'plk_sita'    	=> $plk_sita,
				'pemilik'    	=> $pemilik,
				'ket'    	=> $ket,

			);
			$this->m_ijinsita_p->insert_brg($data);
			$array = array(
				'success' => 'sukses'
			);

			echo json_encode($array);
		} else {
			show_404();
		}
	}
}
