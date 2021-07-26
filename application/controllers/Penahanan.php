<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penahanan extends CI_Controller
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
		$this->load->model('m_psita');
		$this->load->model('m_penahanan');
		$this->load->library('datatables');
	}

	//INDEX PG
	public function index()
	{
		$this->load->library('template');
		$data['judul'] = "Penahanan - Penyidik";
		$data['unit'] = $this->m_master->tampil_unit();
		$this->template->konten('penahanan/penahanan', $data);
		//var_dump($data);
	}

	public function json_penahanan()
	{
		$data = $this->m_penahanan->json_penahanan();
		header('Content-Type: application/json');
		echo $data;
	}

	public function json_brg_psita($id)
	{
		$data = $this->m_psita->json_brg_psita($id);
		header('Content-Type: application/json');
		echo $data;
	}

	//VALIDASI
	public function valid()
	{

		$this->load->helper(['form', 'string']);
		$id      	= $this->input->post('id_verif_ph', true);
		$verif = $_FILES['verif_ph']['name'];

		$config['upload_path']          = 'file/ph';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $verif);
		$ext = strtolower(end($x));
		$config['file_name'] = $id . "_verif_ph." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$verif_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('verif_ph')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$data = array('verif_ph' => $this->upload->data());
			$data = array(

				'verif_doc'    		=> $verif_name,
				'validasi'        => 2,
				'verif_by'        => $this->session->userdata('ses_nm'),
				'verif_date'        => date('Y-m-d H:i:s'),
			);
			$this->m_penahanan->verif($data, $id);
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
			$this->m_penahanan->valid($data);

			echo json_encode($data);
		} else {
			echo "error";
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
				'validasi'        => 1,
				'verif_doc'        => null,
			);
			$this->m_penahanan->valid($data);
			echo json_encode($data);
			unlink(FCPATH . 'file/ph/' . $this->input->post('edoc'));

		} else {
			echo "error";
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
			$this->m_penahanan->valid($data);
			echo json_encode($data);
		} else {
			show_404();
		}
	}

	//LIHAT PENYELIDIKAN 
	public function get_ph($id)
	{
		$row = $this->m_penahanan->get_ph($id);
		if ($row) {
			$data = array(
				'id_penahanan' 	=> $row->id_penahanan,
				'no_smohon_ph' 	=> $row->no_smohon_ph,
				'nm_unit' 	=> $row->nm_unit,
				'id_unit' 	=> $row->id_unit,
				'validasi' 	=> $row->validasi,
				'jns_ph' 	=> $row->jns_ph,
				'nm_ph' 	=> $row->nm_ph,
				'nik_ph' 	=> $row->nik_ph,
				't_lahir_ph' 	=> $row->t_lahir_ph,
				'ta' 	=> $row->ta,
				'bln' 	=> $row->bln,
				'tgl' 	=> $row->tgl,
				'tgl_lahir_ph' 	=>shortdate_indo($row->tgl_lahir_ph),
				'jk_ph' 	=> $row->jk_ph,
				'alamat_ph' 	=> $row->alamat_ph,
				'agama_ph' 	=> $row->agama_ph,
				'pekerjaan_ph' 	=> $row->pekerjaan_ph,
				'kebangsaan_ph' 	=> $row->kebangsaan_ph,
				'validasi' 	=> $row->validasi,
				'edoc_permohonan_ph' 	=> $row->edoc_permohonan_ph,
				'edoc_lap_pol_intel' 	=> $row->edoc_lap_pol_intel,
				'edoc_penetapan_ter' 	=> $row->edoc_penetapan_ter,
				'edoc_spdp' 	=> $row->edoc_spdp,
				
				'created_at_ph' 	=> $row->created_at_ph,

			);
		} else {
			echo "data kosong";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}


	public function tambah_penahanan()
	{
		$file1 = array();
		$file2 = array();
		$file3 = array();
		$file4 = array();



		$this->load->helper(['form', 'string']);
		$this->load->library('upload');

		$id      	= random_string('alnum', 25);


		$edoc1 = $_FILES['edoc_p1']['name'];

		$config1['upload_path']          = 'file/ph/';
		$config1['allowed_types']        = 'pdf';
		$x1 = explode(".", $edoc1);
		$ext1 = strtolower(end($x1));
		$config1['file_name'] = $id . "_s_mohon." . $ext1;
		$config1['overwrite']            = true;
		$config1['max_size']             = 3072; // 1MB
		$edoc1_name = $config1['file_name'];
		$this->upload->initialize($config1);

		// process image upload first
		if (!$this->upload->do_upload('edoc_p1')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		}
		// image was uploaded properly, continue
		else {
			$file1 = $this->upload->data();
			$edoc2 = $_FILES['edoc_p2']['name'];

			$config2['upload_path']          = 'file/ph/';
			$config2['allowed_types']        = 'pdf';
			$x2 = explode(".", $edoc2);
			$ext2 = strtolower(end($x2));
			$config2['file_name'] = $id . "_s_lap." . $ext2;
			$config2['overwrite']            = true;
			$config2['max_size']             = 3072; // 1MB
			$edoc2_name = $config2['file_name'];
			$this->upload->initialize($config2);

			if (!$this->upload->do_upload('edoc_p2')) {
				$array = array(
					'error'   => true,
				);
				echo json_encode($array);
			} else {
				$file2 = $this->upload->data();
				$edoc3 = $_FILES['edoc_p3']['name'];

				$config3['upload_path']          = 'file/ph/';
				$config3['allowed_types']        = 'pdf';
				$x3 = explode(".", $edoc3);
				$ext3 = strtolower(end($x3));
				$config3['file_name'] = $id . "_pen_tersangka." . $ext3;
				$config3['overwrite']            = true;
				$config3['max_size']             = 3072; // 1MB
				$edoc3_name = $config3['file_name'];
				$this->upload->initialize($config3);

				if (!$this->upload->do_upload('edoc_p3')) {
					$array = array(
						'error'   => true,
					);
					echo json_encode($array);
				} else {
					$file3 = $this->upload->data();
					$edoc4 = $_FILES['edoc_p4']['name'];

					$config4['upload_path']          = 'file/ph/';
					$config4['allowed_types']        = 'pdf';
					$x4 = explode(".", $edoc4);
					$ext4 = strtolower(end($x4));
					$config4['file_name'] = $id . "_spdp." . $ext4;
					$config4['overwrite']            = true;
					$config4['max_size']             = 3072; // 1MB
					$edoc4_name = $config4['file_name'];
					$this->upload->initialize($config4);

					if (!$this->upload->do_upload('edoc_p4')) {
						$array = array(
							'error'   => true,
						);
						echo json_encode($array);
					} else {
						$file4 = $this->upload->data();
						$edoc5 = $_FILES['edoc_p5']['name'];

						$config5['upload_path']          = 'file/ph/';
						$config5['allowed_types']        = 'pdf';
						$x5 = explode(".", $edoc5);
						$ext5 = strtolower(end($x5));
						$config5['file_name'] = $id . "_resume." . $ext5;
						$config5['overwrite']            = true;
						$config5['max_size']             = 5024; // 1MB
						$edoc5_name = $config4['file_name'];
						$no_smohon_ph  		= $this->input->post('no_smohon_ph', true);
						$unit_ph 			= $this->input->post('unit_ph', true);
						$jns_ph  			= $this->input->post('jns_ph', true);
						$nm_ph  			= $this->input->post('nm_ph', true);
						$nik_ph  			= $this->input->post('nik_ph', true);
						$t_lahir_ph  		= $this->input->post('t_lahir_ph', true);
						$tgl  				= $this->input->post('tgl', true);
						$bln  				= $this->input->post('bln', true);
						$ta  				= $this->input->post('ta', true);
						$jk_ph  			= $this->input->post('jk_ph', true);
						$alamat_ph  		= $this->input->post('alamat_ph', true);
						$agama_ph  			= $this->input->post('agama_ph', true);
						$pekerjaan_ph  		= $this->input->post('agama_ph', true);
						$kebangsaan_ph  	= $this->input->post('kebangsaan_ph', true);

						if (!$this->upload->do_upload('edoc_p4')) {
							$array = array(
								'error'   => true,
							);
							echo json_encode($array);
						} else {
							$file5 = $this->upload->data();
							$data = array(
								'id_penahanan'       			=> $id,
								'no_smohon_ph'        	=> $no_smohon_ph,
								'id_unit'    			=> $unit_ph,
								'jns_ph'    			=> $jns_ph,
								'nm_ph'    			=> $nm_ph,
								'nik_ph'    			=> $nik_ph,
								't_lahir_ph'    		=> $t_lahir_ph,
								'tgl_lahir_ph'    		=> $ta . "-" . $bln . "-" . $tgl,
								'jk_ph'    				=> $jk_ph,
								'alamat_ph'    			=> $alamat_ph,
								'agama_ph'    			=> $agama_ph,
								'pekerjaan_ph'    		=> $pekerjaan_ph,
								'kebangsaan_ph'    		=> $kebangsaan_ph,
								'edoc_permohonan_ph'    		=> $edoc1_name,
								'edoc_lap_pol_intel'    => $edoc2_name,
								'edoc_penetapan_ter'    	=> $edoc3_name,
								'edoc_spdp'    			=> $edoc4_name,
								'edoc_resume'    			=> $edoc5_name,
								'create_by_ph'       	=> $this->session->userdata('ses_nm'),
								'created_at_ph'       	=> date('Y-m-d H:i:s'),
							);
							$this->m_penahanan->insert($data);
							$array = array('success' => 'sukses');
							echo json_encode($array);
						}

						
					}
				}
			}
		}
	}

	public function edit_ph()
	{
		

		$id_ph  		= $this->input->post('id_ph', true);
		$no_smohon_ph_edit  		= $this->input->post('no_smohon_ph_edit', true);
		$unit_ph_edit  		= $this->input->post('unit_ph_edit', true);
		$jns_ph_edit  		= $this->input->post('jns_ph_edit', true);
		$nm_ph_edit  		= $this->input->post('nm_ph_edit', true);
		$nik_ph_edit  		= $this->input->post('nik_ph_edit', true);
		$t_lahir_ph_edit  		= $this->input->post('t_lahir_ph_edit', true);
		$tgl_edit  		= $this->input->post('tgl_edit', true);
		$bln_edit  		= $this->input->post('bln_edit', true);
		$ta_edit  		= $this->input->post('ta_edit', true);
		$jk_ph_edit  		= $this->input->post('jk_ph_edit', true);
		$alamat_ph_edit  		= $this->input->post('alamat_ph_edit', true);
		$agama_ph_edit  		= $this->input->post('agama_ph_edit', true);
		$pekerjaan_ph_edit  		= $this->input->post('pekerjaan_ph_edit', true);
		$kebangsaan_ph_edit  		= $this->input->post('kebangsaan_ph_edit', true);

		$data = array(
			'no_smohon_ph'        	=> $no_smohon_ph_edit,
			'id_unit'    			=> $unit_ph_edit,
			'jns_ph'    			=> $jns_ph_edit,
			'nm_ph'    			=> $nm_ph_edit,
			'nik_ph'    			=> $nik_ph_edit,
			't_lahir_ph'    		=> $t_lahir_ph_edit,
			'tgl_lahir_ph'    		=> $ta_edit . "-" . $bln_edit . "-" . $tgl_edit,
			'jk_ph'    				=> $jk_ph_edit,
			'alamat_ph'    			=> $alamat_ph_edit,
			'agama_ph'    			=> $agama_ph_edit,
			'pekerjaan_ph'    		=> $pekerjaan_ph_edit,
			'kebangsaan_ph'    		=> $kebangsaan_ph_edit,
			'update_by_ph'       	=> $this->session->userdata('ses_nm'),
			'updated_at_ph'       	=> date('Y-m-d H:i:s'),
		);
		$this->m_penahanan->update($data, $id_ph);
		$array = array(
			'success' => 'sukses'
		);

		echo json_encode($array);
	}

	public function reupload_smohon()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc1      	= $this->input->post('id_edoc1', true);
		$edoc1 = $_FILES['edoc1_ph_edit']['name'];

		$config['upload_path']          = 'file/ph/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc1);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc1 . "_s_mohon." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc1_ph_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc1_ph_edit' => $this->upload->data());

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
		$edoc2 = $_FILES['edoc2_ph_edit']['name'];

		$config['upload_path']          = 'file/ph/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc2);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc2 . "_s_lap." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc2_ph_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc2_ph_edit' => $this->upload->data());

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
		$edoc3 = $_FILES['edoc3_ph_edit']['name'];

		$config['upload_path']          = 'file/ph/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc3);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc3 . "_pen_tersangka." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc3_ph_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc3_ph_edit' => $this->upload->data());

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
		$edoc4 = $_FILES['edoc4_ph_edit']['name'];

		$config['upload_path']          = 'file/ph/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc4);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc4 . "_spdp." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc4_ph_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			array('edoc4_ph_edit' => $this->upload->data());

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	

	private function cek_delete_ph()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		$this->form_validation->set_rules('smohon', 's_mohon', 'trim|required');
		$this->form_validation->set_rules('lap', 'lap', 'trim|required');
		$this->form_validation->set_rules('penetapan', 'penetapan', 'trim|required');
		$this->form_validation->set_rules('spdp', 'spdp', 'trim|required');
		
		return $this->form_validation->run();
	}
	public function delete_ph()
	{
		if ($this->cek_delete_ph()) {
			$this->load->helper('file');
			$id = $this->input->post('id');
			$smohon = $this->input->post('smohon');
			$lap = $this->input->post('lap');
			$penetapan = $this->input->post('penetapan');
			$spdp = $this->input->post('spdp');
			
			$this->db->where('id_penahanan', $id);
			$this->db->delete('tbl_penahanan');
			unlink(FCPATH . 'file/ph/' . $smohon);
			unlink(FCPATH . 'file/ph/' . $lap);
			unlink(FCPATH . 'file/ph/' . $penetapan);
			unlink(FCPATH . 'file/ph/' . $spdp);
			
			
			die;
		} else {
			redirect('penahanan');
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
			$this->m_psita->insert_brg($data);
			$array = array(
				'success' => 'sukses'
			);

			echo json_encode($array);
		} else {
			redirect('psita');
		}
	}

	public function edoc_r()
	{
		$image_data = array();
		$document_data = array();

		$this->load->helper(['form', 'string']);
		$this->load->library('upload');

		$id      	= $this->input->post('id_r');


		$edoc_r1 = $_FILES['edoc_r1']['name'];

		$config1['upload_path']          = 'file/ph/';
		$config1['allowed_types']        = 'pdf';
		$x1 = explode(".", $edoc_r1);
		$ext1 = strtolower(end($x1));
		$config1['file_name'] = $id . "_riwayat1." . $ext1;
		$config1['overwrite']            = true;
		$config1['max_size']             = 5024; // 1MB
		$edoc1_name = $config1['file_name'];
		$this->upload->initialize($config1);

		// process image upload first
		if (!$this->upload->do_upload('edoc_r1')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		}
		// image was uploaded properly, continue
		else {
			$image_data = $this->upload->data();
			$edoc_r2 = $_FILES['edoc_r2']['name'];

			$config2['upload_path']          = 'file/ph/';
			$config2['allowed_types']        = 'pdf';
			$x2 = explode(".", $edoc_r2);
			$ext2 = strtolower(end($x2));
			$config2['file_name'] = $id . "_riwayat2." . $ext2;
			$config2['overwrite']            = true;
			$config2['max_size']             = 5024; // 1MB
			$edoc2_name = $config2['file_name'];
			$this->upload->initialize($config2);

			if (!$this->upload->do_upload('edoc_r2')) {
				$array = array(
					'error'   => true,
				);
				echo json_encode($array);
			} else {

				$document_data = $this->upload->data();
				
				$data = array(
					
					'edoc_r1'    		=> $edoc1_name,
					'edoc_r2'    => $edoc2_name,
					'riwayat'       		=> "1",
				);
				$this->m_penahanan->update_r($data, $id);
				$array = array(
					'success' => 'sukses'
				);

				echo json_encode($array);
			}
		}
	}
}
