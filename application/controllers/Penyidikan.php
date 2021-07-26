<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyidikan extends CI_Controller
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
		$this->load->model('m_penyidikan');
		$this->load->library('datatables');
	}

	//INDEX PG
	public function index()
	{
		$this->load->library('template');
		$data['judul'] = "Penggeledahan - Penyidikan";
		$data['unit'] = $this->m_master->tampil_unit();

		$this->template->konten('penggeledahan/penyidikan', $data);
		//var_dump($data);
	}

	public function json_penyidikan()
	{
		$data = $this->m_penyidikan->json_penyidikan();
		header('Content-Type: application/json');
		echo $data;
	}




	//LIHAT PENYELIDIKAN 
	public function get_id_penyidikan($id)
	{
		$row = $this->m_penyidikan->get_id_penyidikan($id);
		if ($row) {
			$data = array(
				'id_py' 	=> $row->id_py,
				'validasi' 	=> $row->validasi,
				'no_smohon_py' 	=> $row->no_smohon_py,
				'id_unit' 	=> $row->id_unit,
				'nm_unit' 	=> $row->nm_unit,
				'jns_py' 	=> $row->jns_py,
				'lok_py' 	=> $row->lok_py,
				'pemilik_lok_py' 	=> $row->pemilik_lok_py,
				'edoc_s_mohon' 	=> $row->edoc_s_mohon,
				'edoc_lap_pol_intel' 	=> $row->edoc_lap_pol_intel,
				'edoc_penetapan' 	=> $row->edoc_penetapan,
				'edoc_spdp' 	=> $row->edoc_spdp,
				'created_at_py' 	=> $row->created_at_py,
				'updated_at_py' 	=> $row->updated_at_py,
				'create_by_py' 	=> $row->create_by_py,
				'update_by_py' 	=> $row->update_by_py,
				'nm_py' 	=> $row->nm_py,
				'nik_py' 	=> $row->nik_py,
				'nm_py' 	=> $row->nm_py,
				't_lahir_py' 	=> $row->t_lahir_py,
				'ta' 	=> $row->ta,
				'bln' 	=> $row->bln,
				'tgl' 	=> $row->tgl,
				'tgl_lahir_py' 	=> shortdate_indo($row->tgl_lahir_py),
				'jk_py' 	=> $row->jk_py,
				'alamat_py' 	=> $row->alamat_py,
				'agama_py' 	=> $row->agama_py,
				'pekerjaan_py' 	=> $row->pekerjaan_py,
				'kebangsaan_py' 	=> $row->kebangsaan_py,


			);
		} else {
			echo "data kosong";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}




	public function tambah_py()
	{
		$file1 = array();
		$file2 = array();
		$file3 = array();
		$file4 = array();


		$this->load->helper(['form', 'string']);
		$this->load->library('upload');

		$id      	= random_string('alnum', 25);


		$edoc1 = $_FILES['edoc_s_mohon_py']['name'];

		$config1['upload_path']          = 'file/py/';
		$config1['allowed_types']        = 'pdf';
		$x1 = explode(".", $edoc1);
		$ext1 = strtolower(end($x1));
		$config1['file_name'] = $id . "_s_mohon." . $ext1;
		$config1['overwrite']            = true;
		$config1['max_size']             = 3072; // 1MB
		$edoc1_name = $config1['file_name'];
		$this->upload->initialize($config1);

		// process image upload first
		if (!$this->upload->do_upload('edoc_s_mohon_py')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		}
		// image was uploaded properly, continue
		else {
			$file1 = $this->upload->data();
			$edoc2 = $_FILES['edoc_lap_pol_intel_py']['name'];

			$config2['upload_path']          = 'file/py/';
			$config2['allowed_types']        = 'pdf';
			$x2 = explode(".", $edoc2);
			$ext2 = strtolower(end($x2));
			$config2['file_name'] = $id . "_s_lap." . $ext2;
			$config2['overwrite']            = true;
			$config2['max_size']             = 3072; // 1MB
			$edoc2_name = $config2['file_name'];
			$this->upload->initialize($config2);

			if (!$this->upload->do_upload('edoc_lap_pol_intel_py')) {
				$array = array(
					'error'   => true,
				);
				echo json_encode($array);
			} else {
				$file2 = $this->upload->data();
				$edoc3 = $_FILES['edoc_pen_tersangka_py']['name'];

				$config3['upload_path']          = 'file/py/';
				$config3['allowed_types']        = 'pdf';
				$x3 = explode(".", $edoc3);
				$ext3 = strtolower(end($x3));
				$config3['file_name'] = $id . "_pen_tersangka." . $ext3;
				$config3['overwrite']            = true;
				$config3['max_size']             = 3072; // 1MB
				$edoc3_name = $config3['file_name'];
				$this->upload->initialize($config3);

				if (!$this->upload->do_upload('edoc_pen_tersangka_py')) {
					$array = array(
						'error'   => true,
					);
					echo json_encode($array);
				} else {
					$file3 = $this->upload->data();
					$edoc4 = $_FILES['edoc_spdp']['name'];

					$config4['upload_path']          = 'file/py/';
					$config4['allowed_types']        = 'pdf';
					$x4 = explode(".", $edoc4);
					$ext3 = strtolower(end($x4));
					$config4['file_name'] = $id . "_spdp." . $ext3;
					$config4['overwrite']            = true;
					$config4['max_size']             = 3072; // 1MB
					$edoc4_name = $config4['file_name'];
					$this->upload->initialize($config4);

					if (!$this->upload->do_upload('edoc_spdp')) {
						$array = array(
							'error'   => true,
						);
						echo json_encode($array);
					} else {
						$file4 = $this->upload->data();
						$no_srt_py  		= $this->input->post('no_srt_py', true);
						$unit_py 			= $this->input->post('unit_py', true);
						$jns_py  			= $this->input->post('jns_py', true);
						$lok_py  			= $this->input->post('lok_py', true);
						$pemilik_lok_py  	= $this->input->post('pemilik_lok_py', true);
						$nik_py  			= $this->input->post('nik_py', true);
						$nm_py  			= $this->input->post('nik_py', true);
						$tgl  				= $this->input->post('tgl', true);
						$bln  				= $this->input->post('bln', true);
						$ta  				= $this->input->post('ta', true);
						$t_lahir_py  		= $this->input->post('t_lahir_py', true);
						$jk_py  			= $this->input->post('jk_py', true);
						$alamat_py  		= $this->input->post('alamat_py', true);
						$agama_py  			= $this->input->post('agama_py', true);
						$pekerjaan_py  		= $this->input->post('pekerjaan_py', true);
						$kebangsaan_py  	= $this->input->post('kebangsaan_py', true);

						$data = array(
							'id_py'       			=> $id,
							'no_smohon_py'        	=> $no_srt_py,
							'id_unit'    			=> $unit_py,
							'jns_py'    			=> $jns_py,
							'lok_py'    			=> $lok_py,
							'pemilik_lok_py'    	=> $pemilik_lok_py,
							'nik_py'    			=> $nik_py,
							'nm_py'    				=> $nm_py,
							't_lahir_py'    		=> $t_lahir_py,
							'tgl_lahir_py'    		=> $ta . "-" . $bln . "-" . $tgl,
							'jk_py'    				=> $jk_py,
							'alamat_py'    			=> $alamat_py,
							'agama_py'    			=> $agama_py,
							'pekerjaan_py'    		=> $pekerjaan_py,
							'kebangsaan_py'    		=> $kebangsaan_py,
							'edoc_s_mohon'    		=> $edoc1_name,
							'edoc_lap_pol_intel'    => $edoc2_name,
							'edoc_penetapan'    	=> $edoc3_name,
							'edoc_spdp'    			=> $edoc4_name,
							'create_by_py'       	=> $this->session->userdata('ses_nm'),
							'created_at_py'       	=> date('Y-m-d H:i:s'),
						);
						$this->m_penyidikan->insert($data);
						$array = array(
							'success' => 'sukses'
						);

						echo json_encode($array);
					}
				}
			}
		}
	}

	public function edit_py()
	{
		$valid = $this->input->post('valid');
		$id_py = $this->input->post('id_py');

		$this->db->where('validasi', $valid);
		$this->db->where('id_py', $id_py);
		$q = $this->db->get('tbl_penyidikan');

		if ($q->num_rows() > 1) {

			redirect('penyidikan');
		}

		$no_srt_py_edit  		= $this->input->post('no_srt_py_edit', true);
		$unit_py_edit  			= $this->input->post('unit_py_edit', true);
		$jns_py_edit  			= $this->input->post('jns_py_edit', true);
		$lok_py_edit  			= $this->input->post('lok_py_edit', true);
		$pemilik_lok_py_edit  	= $this->input->post('pemilik_lok_py_edit', true);
		$nik_py_edit  			= $this->input->post('nik_py_edit', true);
		$nm_py_edit  			= $this->input->post('nm_py_edit', true);
		$t_lahir_py_edit  		= $this->input->post('t_lahir_py_edit', true);
		$tgl_edit  				= $this->input->post('tgl_edit', true);
		$bln_edit  				= $this->input->post('bln_edit', true);
		$ta_edit  				= $this->input->post('ta_edit', true);
		$jk_py_edit  			= $this->input->post('jk_py_edit', true);
		$alamat_py_edit  		= $this->input->post('alamat_py_edit', true);
		$agama_py_edit  		= $this->input->post('agama_py_edit', true);
		$pekerjaan_py_edit  	= $this->input->post('pekerjaan_py_edit', true);
		$kebangsaan_py_edit  	= $this->input->post('kebangsaan_py_edit', true);
		$data = array(
			'no_smohon_py'       	=> $no_srt_py_edit,
			'id_unit'        		=> $unit_py_edit,
			'jns_py'    			=> $jns_py_edit,
			'lok_py'    			=> $lok_py_edit,
			'pemilik_lok_py'    	=> $pemilik_lok_py_edit,
			'nik_py'    			=> $nik_py_edit,
			'nm_py'    				=> $nm_py_edit,
			't_lahir_py'    		=> $t_lahir_py_edit,
			'tgl_lahir_py'    		=> $ta_edit . "-" . $bln_edit . "-" . $tgl_edit,
			'jk_py'    				=> $jk_py_edit,
			'alamat_py'    			=> $alamat_py_edit,
			'agama_py'    			=> $agama_py_edit,
			'pekerjaan_py'    		=> $pekerjaan_py_edit,
			'kebangsaan_py'    		=> $kebangsaan_py_edit,
			'update_by_py'       	=> $this->session->userdata('ses_nm'),
			'updated_at_py'       	=> date('Y-m-d H:i:s'),
		);
		$this->m_penyidikan->update($data);
		$array = array(
			'success' => 'sukses'
		);

		echo json_encode($array);
	}

	public function reupload_smohon()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc1      	= $this->input->post('id_edoc1', true);
		$edoc1 = $_FILES['edoc1_py']['name'];

		$config['upload_path']          = 'file/py/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc1);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc1 . "_s_mohon." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 3072; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc1_py')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$this->upload->data();

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
		$edoc2 = $_FILES['edoc2_py']['name'];

		$config['upload_path']          = 'file/py/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc2);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc2 . "_s_lap." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 3072; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc2_py')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$this->upload->data();

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	public function reupload_s_penetapan()
	{

		$this->load->helper(['form', 'string']);
		$id_edoc3      	= $this->input->post('id_edoc3', true);
		$edoc3 = $_FILES['edoc3_py']['name'];

		$config['upload_path']          = 'file/py/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc3);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc3 . "_pen_tersangka." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 3072; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc3_py')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$this->upload->data();

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
		$edoc4 = $_FILES['edoc4_py']['name'];

		$config['upload_path']          = 'file/py/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc4);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_edoc4 . "_spdp." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 3072; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc4_py')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$this->upload->data();

			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	private function cek_delete_py()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		$this->form_validation->set_rules('smohon', 's_mohon', 'trim|required');
		$this->form_validation->set_rules('lap', 'lap', 'trim|required');
		$this->form_validation->set_rules('penetapan', 'penetapan', 'trim|required');
		$this->form_validation->set_rules('spdp', 'spdp', 'trim|required');
		return $this->form_validation->run();
	}
	public function delete_py()
	{
		if ($this->cek_delete_py()) {
			$this->load->helper('file');
			$id = $this->input->post('id');
			$smohon = $this->input->post('smohon');
			$lap = $this->input->post('lap');
			$penetapan = $this->input->post('penetapan');
			$spdp = $this->input->post('spdp');
			$this->db->where('id_py', $id);
			$this->db->delete('tbl_penyidikan');
			unlink(FCPATH . 'file/py/' . $smohon);
			unlink(FCPATH . 'file/py/' . $lap);
			unlink(FCPATH . 'file/py/' . $penetapan);
			unlink(FCPATH . 'file/py/' . $spdp);
			die;
		} else {
			redirect('penyelidikan');
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
			$this->m_penyidikan->valid($data);

			echo json_encode($data);
		} else {
			redirect('penyidikan');
		}
	}

	//VALIDASI
	public function valid()
	{

		$this->load->helper(['form', 'string']);
		$id      	= $this->input->post('id_verif_py', true);
		$verif = $_FILES['verif_py']['name'];

		$config['upload_path']          = 'file/py/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $verif);
		$ext = strtolower(end($x));
		$config['file_name'] = $id . "_verif_py." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$verif_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('verif_py')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$data = array('verif_py' => $this->upload->data());
			$data = array(

				'verif_doc'    		=> $verif_name,
				'validasi'        => 2,
				'verif_by'        => $this->session->userdata('ses_nm'),
				'verif_date'        => date('Y-m-d H:i:s'),
			);
			$this->m_penyidikan->verif($data, $id);
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
				'verif_by'        => null,
			);
			$this->m_penyidikan->valid($data);

			echo json_encode($data);
		} else {
			redirect('penyidikan');
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
				'verif_doc'        => null,
				'validasi'        => 1,
			);
			$this->m_penyidikan->valid($data);
			echo json_encode($data);
			unlink(FCPATH . 'file/py/' . $edoc);
		} else {
			redirect('penyidikan');
		}
	}


}
