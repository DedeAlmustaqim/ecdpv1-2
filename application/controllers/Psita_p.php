<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Psita_p extends CI_Controller
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
		$this->load->model('m_psita_p');
		$this->load->library('datatables');
	}

	//INDEX PG
	public function index()
	{
		$this->load->library('template');
		$data['judul'] = "Penyitaan - Persetujuan Sita";
		$data['unit'] = $this->m_master->tampil_unit();
		$this->template->konten('penyitaan/persetujuan_sita_p', $data);
		//var_dump($data);
	}

	public function json_psita()
	{
		$data = $this->m_psita_p->json_psita();
		header('Content-Type: application/json');
		echo $data;
	}

	public function json_brg_psita($id)
	{
		$data = $this->m_psita_p->json_brg_psita($id);
		header('Content-Type: application/json');
		echo $data;
	}

	//VALIDASI
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
			$this->m_psita_p->valid($data);

			echo json_encode($data);
		} else {
			echo "error";
		}
	}
	public function valid()
	{

		$this->load->helper(['form', 'string']);
		$id      	= $this->input->post('id_verif_pst_p', true);
		$verif = $_FILES['verif_pst']['name'];

		$config['upload_path']          = 'file/st/psita_p';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $verif);
		$ext = strtolower(end($x));
		$config['file_name'] = $id . "_verif_pst." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$verif_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('verif_pst')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$data = array('verif_pst' => $this->upload->data());
			$data = array(

				'verif_doc'    		=> $verif_name,
				'validasi'        => 2,
				'verif_by'        => $this->session->userdata('ses_nm'),
				'verif_date'        => date('Y-m-d H:i:s'),
			);
			$this->m_psita_p->verif($data, $id);
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

		if ($this->cek_buka_verif()) {
			$data = array(
				'validasi'        => 0,
				'verif_date'        => null,
			);
			$this->m_psita_p->valid($data);
			echo json_encode($data);
		} else {
			redirect('psita');
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
		$edoc= $this->input->post('edoc');

		if ($this->cek_buka_valid()) {
			$data = array(
				'validasi'        => 1,
				'verif_doc'        => null,
			);
			$this->m_psita_p->valid($data);
			unlink(FCPATH . 'file/st/psita_p/' . $edoc);
			echo json_encode($data);

		} else {
			echo "error";
		}
	}


	//LIHAT PENYELIDIKAN 
	public function get_id_psita($id)
	{
		$row = $this->m_psita_p->get_id_psita($id);
		if ($row) {
			$data = array(
				'id_psita' 	=> $row->id_psita,
				'no_smohon_psita' 	=> $row->no_smohon_psita,
				'nm_unit' 	=> $row->nm_unit,
				'id_unit' 	=> $row->id_unit,
				'validasi' 	=> $row->validasi,
				'edoc_smohon' 	=> $row->edoc_smohon,
				'edoc_lap_pol_intel' 	=> $row->edoc_lap_pol_intel,
				'edoc_penetapan' 	=> $row->edoc_penetapan,
				'edoc_spdp' 	=> $row->edoc_spdp,
				'edoc_p_sita' 	=> $row->edoc_p_sita,
				'edoc_ba' 	=> $row->edoc_ba,
				'edoc_ttbs' 	=> $row->edoc_ttbs,
				'edoc_sprindik' 	=> $row->edoc_sprindik,
				'created_at_psita' 	=> $row->created_at_psita,

			);
		} else {
			echo "data kosong";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}


	public function tambah_pst()
	{
		$file1 = array();
		$file2 = array();
		$file3 = array();
		$file4 = array();
		$file5 = array();
		$file6 = array();
		$file7 = array();


		$this->load->helper(['form', 'string']);
		$this->load->library('upload');

		$id      	= random_string('alnum', 25);


		$edoc1 = $_FILES['edoc_pst1']['name'];

		$config1['upload_path']          = 'file/st/psita_p/';
		$config1['allowed_types']        = 'pdf';
		$x1 = explode(".", $edoc1);
		$ext1 = strtolower(end($x1));
		$config1['file_name'] = $id . "_s_mohon." . $ext1;
		$config1['overwrite']            = true;
		$config1['max_size']             = 3072; // 1MB
		$edoc1_name = $config1['file_name'];
		$this->upload->initialize($config1);

		// process image upload first
		if (!$this->upload->do_upload('edoc_pst1')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		}
		// image was uploaded properly, continue
		else {
			$file1 = $this->upload->data();
			$edoc2 = $_FILES['edoc_pst2']['name'];

			$config2['upload_path']          = 'file/st/psita_p/';
			$config2['allowed_types']        = 'pdf';
			$x2 = explode(".", $edoc2);
			$ext2 = strtolower(end($x2));
			$config2['file_name'] = $id . "_s_lap." . $ext2;
			$config2['overwrite']            = true;
			$config2['max_size']             = 3072; // 1MB
			$edoc2_name = $config2['file_name'];
			$this->upload->initialize($config2);

			if (!$this->upload->do_upload('edoc_pst2')) {
				$array = array(
					'error'   => true,
				);
				echo json_encode($array);
			} else {
				$file2 = $this->upload->data();
				$edoc3 = $_FILES['edoc_pst3']['name'];

				$config3['upload_path']          = 'file/st/psita_p/';
				$config3['allowed_types']        = 'pdf';
				$x3 = explode(".", $edoc3);
				$ext3 = strtolower(end($x3));
				$config3['file_name'] = $id . "_pen_tersangka." . $ext3;
				$config3['overwrite']            = true;
				$config3['max_size']             = 3072; // 1MB
				$edoc3_name = $config3['file_name'];
				$this->upload->initialize($config3);

				if (!$this->upload->do_upload('edoc_pst3')) {
					$array = array(
						'error'   => true,
					);
					echo json_encode($array);
				} else {
						$file3 = $this->upload->data();
					
						$edoc5 = $_FILES['edoc_pst5']['name'];

						$config5['upload_path']          = 'file/st/psita_p/';
						$config5['allowed_types']        = 'pdf';
						$x5 = explode(".", $edoc5);
						$ext5 = strtolower(end($x5));
						$config5['file_name'] = $id . "_perintah." . $ext5;
						$config5['overwrite']            = true;
						$config5['max_size']             = 3072; // 1MB
						$edoc5_name = $config5['file_name'];
						$this->upload->initialize($config5);

						if (!$this->upload->do_upload('edoc_pst5')) {
							$array = array(
								'error'   => true,
							);
							echo json_encode($array);
						} else {
							$file5 = $this->upload->data();
							$edoc6 = $_FILES['edoc_pst6']['name'];

							$config6['upload_path']          = 'file/st/psita_p/';
							$config6['allowed_types']        = 'pdf';
							$x6 = explode(".", $edoc6);
							$ext6 = strtolower(end($x6));
							$config6['file_name'] = $id . "_ba." . $ext6;
							$config6['overwrite']            = true;
							$config6['max_size']             = 3072; // 1MB
							$edoc6_name = $config6['file_name'];
							$this->upload->initialize($config6);

							if (!$this->upload->do_upload('edoc_pst6')) {
								$array = array(
									'error'   => true,
								);
								echo json_encode($array);
							} else {
								$file6 = $this->upload->data();
								$edoc7 = $_FILES['edoc_pst7']['name'];

								$config7['upload_path']          = 'file/st/psita_p/';
								$config7['allowed_types']        = 'pdf';
								$x7 = explode(".", $edoc7);
								$ext7 = strtolower(end($x7));
								$config7['file_name'] = $id . "_ttba." . $ext7;
								$config7['overwrite']            = true;
								$config7['max_size']             = 3072; // 1MB
								$edoc7_name = $config7['file_name'];
								$this->upload->initialize($config7);


								if (!$this->upload->do_upload('edoc_pst7')) {
									$array = array('error'   => true,);
									echo json_encode($array);
								} else {

									$file7 = $this->upload->data();
									$edoc8 = $_FILES['edoc_pst8']['name'];

									$config8['upload_path']          = 'file/st/psita_p/';
									$config8['allowed_types']        = 'pdf';
									$x8 = explode(".", $edoc8);
									$ext8 = strtolower(end($x8));
									$config8['file_name'] = $id . "_sprindik." . $ext8;
									$config8['overwrite']            = true;
									$config8['max_size']             = 3072; // 1MB
									$edoc8_name = $config8['file_name'];
									$this->upload->initialize($config8);

									if (!$this->upload->do_upload('edoc_pst8')) {
										$array = array('error'   => true,);
										echo json_encode($array);
									} else {
										$file8 = $this->upload->data();
										$no_smohon_psita  		= $this->input->post('no_smohon_psita', true);
										$unit_pst 			= $this->input->post('unit_pst', true);
										$data = array(
											'id_psita'       		=> $id,
											'no_smohon_psita'       => $no_smohon_psita,
											'id_unit'    			=> $unit_pst,
											'edoc_smohon'    		=> $edoc1_name,
											'edoc_lap_pol_intel'    => $edoc2_name,
											'edoc_penetapan'    	=> $edoc3_name,
											'edoc_p_sita'    		=> $edoc5_name,
											'edoc_ba'    			=> $edoc6_name,
											'edoc_ttbs'    			=> $edoc7_name,
											'edoc_sprindik'    			=> $edoc8_name,
											'create_by_psita'       => $this->session->userdata('ses_nm'),
											'created_at_psita'       => date('Y-m-d H:i:s'),
										);
										$this->m_psita_p->insert($data);
										$array = array('success' => 'sukses');
										echo json_encode($array);
									}
								}
							}
						
					}
				}
			}
		}
	}

	public function edit_pst()
	{
		$valid = $this->input->post('validasi_pst');
		$id = $this->input->post('id_psita_edit');

		$this->db->where('validasi', $valid);
		$this->db->where('id_psita', $id);
		$q = $this->db->get('tbl_psita');

		if ($q->num_rows() > 1) {

			redirect('psita');
		}

		$no_smohon_psita_edit  		= $this->input->post('no_smohon_psita_edit', true);
		$unit_pst_edit  		= $this->input->post('unit_pst_edit', true);

		$data = array(
			'no_smohon_psita'       	=> $no_smohon_psita_edit,
			'id_unit'        		=> $unit_pst_edit,

			'update_by_psita'       		=> $this->session->userdata('ses_nm'),
			'updated_at_psita'       		=> date('Y-m-d H:i:s'),
		);
		$this->m_psita_p->update($data);
		$array = array(
			'success' => 'sukses'
		);

		echo json_encode($array);
	}

	public function reupload_smohon()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc1      	= $this->input->post('id_edoc1', true);
		$edoc1 = $_FILES['edoc1_pst_edit']['name'];

		$config['upload_path']          = 'file/st/psita_p/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc1);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc1 . "_s_mohon." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc1_pst_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc1_pst_edit' => $this->upload->data());

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
		$edoc2 = $_FILES['edoc2_pst_edit']['name'];

		$config['upload_path']          = 'file/st/psita_p/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc2);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc2 . "_s_lap." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc2_pst_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc2_pst_edit' => $this->upload->data());

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
		$edoc3 = $_FILES['edoc3_pst_edit']['name'];

		$config['upload_path']          = 'file/st/psita_p/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc3);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc3 . "_pen_tersangka." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc3_pst_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc3_pst_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	public function reupload_spdp()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc4      	= $this->input->post('id_edoc4', true);
		$edoc4 = $_FILES['edoc4_pst_edit']['name'];

		$config['upload_path']          = 'file/st/psita_p/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc4);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc4 . "_spdp." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc4_pst_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc4_pst_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	public function reupload_sp()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc5      	= $this->input->post('id_edoc5', true);
		$edoc5 = $_FILES['edoc5_pst_edit']['name'];

		$config['upload_path']          = 'file/st/psita_p/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc5);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc5 . "_perintah." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc5_pst_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc5_pst_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	public function reupload_ba()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc6      	= $this->input->post('id_edoc6', true);
		$edoc6 = $_FILES['edoc6_pst_edit']['name'];

		$config['upload_path']          = 'file/st/psita_p/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc6);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc6 . "_ba." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc6_pst_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc6_pst_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	public function reupload_ttbs()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc7      	= $this->input->post('id_edoc7', true);
		$edoc7 = $_FILES['edoc7_pst_edit']['name'];

		$config['upload_path']          = 'file/st/psita_p/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc7);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc7 . "_ttba." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc7_pst_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc7_pst_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	public function reupload_sprindik()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc8      	= $this->input->post('id_edoc8', true);
		$edoc8 = $_FILES['edoc8_pst_edit']['name'];

		$config['upload_path']          = 'file/st/psita_p/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc8);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc8 . "_sprindik." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc8_pst_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc8_pst_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	private function cek_delete_pst()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		$this->form_validation->set_rules('smohon', 's_mohon', 'trim|required');
		$this->form_validation->set_rules('lap', 'lap', 'trim|required');
		$this->form_validation->set_rules('penetapan', 'penetapan', 'trim|required');
		$this->form_validation->set_rules('sp', 'sp', 'trim|required');
		$this->form_validation->set_rules('ba', 'ba', 'trim|required');
		$this->form_validation->set_rules('ttba', 'ttba', 'trim|required');
		$this->form_validation->set_rules('sprindik', 'sprindik', 'trim|required');
		return $this->form_validation->run();
	}
	public function delete_pst()
	{
		if ($this->cek_delete_pst()) {
			$this->load->helper('file');
			$id = $this->input->post('id');
			$smohon = $this->input->post('smohon');
			$lap = $this->input->post('lap');
			$penetapan = $this->input->post('penetapan');
			$sp = $this->input->post('sp');
			$ba = $this->input->post('ba');
			$ttba = $this->input->post('ttba');
			$sprindik = $this->input->post('sprindik');
			$this->db->where('id_psita', $id);
			$this->db->delete('tbl_psita_p');
			unlink(FCPATH . 'file/st/psita_p/' . $smohon);
			unlink(FCPATH . 'file/st/psita_p/' . $lap);
			unlink(FCPATH . 'file/st/psita_p/' . $penetapan);
			unlink(FCPATH . 'file/st/psita_p/' . $sp);
			unlink(FCPATH . 'file/st/psita_p/' . $ba);
			unlink(FCPATH . 'file/st/psita_p/' . $ttba);
			unlink(FCPATH . 'file/st/psita_p/' . $sprindik);

			die;
		} else {
			redirect('psita_p');
		}
	}

	private function cek_delete_brg()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');

		return $this->form_validation->run();
	}
	public function delete_brg_pst()
	{
		if ($this->cek_delete_brg()) {
			$this->load->helper('file');
			$id = $this->input->post('id');

			$this->db->where('id_brg_psita', $id);
			$this->db->delete('tbl_brg_psita_p');
		} else {
			redirect('psita');
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
		$this->form_validation->set_rules('id_psita', 'id_psita', 'trim|required');
		$this->form_validation->set_rules('nm_brg', 'nm_brg', 'trim|required');
		$this->form_validation->set_rules('jml', 'jml', 'trim|required');
		$this->form_validation->set_rules('lokasi_sita', 'lokasi_sita', 'trim|required');
		$this->form_validation->set_rules('plk_sita', 'plk_sita', 'trim|required');
		$this->form_validation->set_rules('pemilik', 'pemilik', 'trim|required');
		$this->form_validation->set_rules('ket', 'ket', 'trim|required');
		return $this->form_validation->run();
	}

	public function tambah_brg_pst()
	{

		if ($this->cek_tambah_brg()) {
			$id_psita  		= $this->input->post('id_psita', true);
			$nm_brg  		= $this->input->post('nm_brg', true);
			$jml  	= $this->input->post('jml', true);
			$lokasi_sita  	= $this->input->post('lokasi_sita', true);
			$plk_sita  		= $this->input->post('plk_sita', true);
			$pemilik  		= $this->input->post('pemilik', true);
			$ket  		= $this->input->post('ket', true);
			$data = array(
				'id_brg_psita'       	=> random_string('alnum', 25),
				'id_psita'        		=> $id_psita,
				'nm_brg'    			=> $nm_brg,
				'jml'    			=> $jml,
				'lokasi_sita'    	=> $lokasi_sita,
				'plk_sita'    	=> $plk_sita,
				'pemilik'    	=> $pemilik,
				'ket'    	=> $ket,

			);
			$this->m_psita_p->insert_brg($data);
			$array = array(
				'success' => 'sukses'
			);

			echo json_encode($array);
		} else {
			redirect('psita');
		}
	}
}
