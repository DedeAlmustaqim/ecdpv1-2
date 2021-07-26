<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyelidikan extends CI_Controller
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
		$this->load->model('m_penyelidikan');
		$this->load->library('datatables');
	}

	//INDEX PG
	public function index()
	{
		$this->load->library('template');
		$data['judul'] = "Penggeledahan - Penyelidikan";
		$data['unit'] = $this->m_master->tampil_unit();
		$this->template->konten('penggeledahan/gd', $data);
		//var_dump($data);
	}

	public function json_penyelidikan()
	{
		$data = $this->m_penyelidikan->json_penyelidikan();
		header('Content-Type: application/json');
		echo $data;
	}

	public function valid()
	{

		$this->load->helper(['form', 'string']);
		$id      	= $this->input->post('id_verif_gd', true);
		$verif_gd = $_FILES['verif_gd']['name'];

		$config['upload_path']          = 'file/gd/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $verif_gd);
		$ext = strtolower(end($x));
		$config['file_name'] = $id . "_verif_gd." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$verif_gd_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('verif_gd')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$data = array('verif_gd' => $this->upload->data());
			$data = array(

				'verif_doc'    		=> $verif_gd_name,
				'validasi'        => 2,
				'verif_by'        => $this->session->userdata('ses_nm'),
				'verif_date'        => date('Y-m-d H:i:s'),
			);
			$this->m_penyelidikan->verif_gd($data, $id);
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
				'verif_by'        => $this->session->userdata('ses_nm'),

			);
			$this->m_penyelidikan->valid($data);

			echo json_encode($data);
		} else {
			redirect('penyelidikan');
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
				'verif_date'        => null,
				'verif_by'        => null,
				'validasi'        => 0,
			);
			$this->m_penyelidikan->valid($data);

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
			$edoc = $this->input->post('edoc');
			$data = array(
				'verif_doc'        => null,
				'validasi'        => 1,
			);
			$this->m_penyelidikan->valid($data);
			unlink(FCPATH . 'file/gd/' . $edoc);

			echo json_encode($data);
		} else {
			redirect('penyelidikan');
		}
	}


	//LIHAT PENYELIDIKAN 
	public function get_id_penyelidikan($id)
	{
		$row = $this->m_penyelidikan->get_id_penyelidikan($id);
		if ($row) {
			$data = array(
				'id_smohon_gd' 	=> $row->id_smohon_gd,
				'no_smohon_gd' 	=> $row->no_smohon_gd,
				'jns_gd' 	=> $row->jns_gd,
				'lok_gd' 	=> $row->lok_gd,
				'pemilik_lok_gd' 	=> $row->pemilik_lok_gd,
				'id_unit' 	=> $row->id_unit,
				'nm_unit' 	=> $row->nm_unit,
				'edoc_s_mohon' 	=> $row->edoc_s_mohon,
				'edoc_lap_pol_intel' 	=> $row->edoc_lap_pol_intel,
				'edoc_sprint' 	=> $row->edoc_sprint,
				'edoc_spg' 	=> $row->edoc_spg,
				'validasi' 	=> $row->validasi,

			);
		} else {
			echo "data kosong";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function tambah_pyd()
	{
		$image_data = array();
		$document_data = array();

		$this->load->helper(['form', 'string']);
		$this->load->library('upload');

		$id      	= random_string('alnum', 25);


		$edoc_s_mohon = $_FILES['edoc_s_mohon']['name'];

		$config1['upload_path']          = 'file/gd/';
		$config1['allowed_types']        = 'pdf';
		$x1 = explode(".", $edoc_s_mohon);
		$ext1 = strtolower(end($x1));
		$config1['file_name'] = $id . "_s_mohon." . $ext1;
		$config1['overwrite']            = true;
		$config1['max_size']             = 5024; // 1MB
		$edoc_s_mohon_name = $config1['file_name'];
		$this->upload->initialize($config1);

		// process image upload first
		if (!$this->upload->do_upload('edoc_s_mohon')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		}
		// image was uploaded properly, continue
		else {
			$image_data = $this->upload->data();
			$edoc_lap_pol_intel = $_FILES['edoc_lap_pol_intel']['name'];

			$config2['upload_path']          = 'file/gd/';
			$config2['allowed_types']        = 'pdf';
			$x2 = explode(".", $edoc_lap_pol_intel);
			$ext2 = strtolower(end($x2));
			$config2['file_name'] = $id . "_s_lap." . $ext2;
			$config2['overwrite']            = true;
			$config2['max_size']             = 5024; // 1MB
			$edoc_lap_pol_intel_name = $config2['file_name'];
			$this->upload->initialize($config2);

			if (!$this->upload->do_upload('edoc_lap_pol_intel')) {
				$array = array(
					'error'   => true,
				);
				echo json_encode($array);
			} else {
                $edoc_sprint = $_FILES['edoc_sprint']['name'];

                $this->upload->data();
                $config3['upload_path']          = 'file/gd/';
                $config3['allowed_types']        = 'pdf';
                $x3 = explode(".", $edoc_sprint);
                $ext3 = strtolower(end($x3));
                $config3['file_name'] = $id . "_sprint." . $ext3;
                $config3['overwrite']            = true;
                $config3['max_size']             = 5024; // 1MB
                $edoc_sprint_name = $config3['file_name'];
                $this->upload->initialize($config3);

                if (!$this->upload->do_upload('edoc_spg')) {
                    $array = array(
                    'error'   => true,
                );
                    echo json_encode($array);
                } else {
                    $edoc_spg = $_FILES['edoc_spg']['name'];

                    $this->upload->data();
                    $config4['upload_path']          = 'file/gd/';
                    $config4['allowed_types']        = 'pdf';
                    $x4 = explode(".", $edoc_spg);
                    $ext4 = strtolower(end($x4));
                    $config4['file_name'] = $id . "_spg." . $ext4;
                    $config4['overwrite']            = true;
                    $config4['max_size']             = 5024; // 1MB
                    $edoc_spg_name = $config4['file_name'];
                    $this->upload->initialize($config4);

                    if (!$this->upload->do_upload('edoc_spg')) {
                        $array = array(
                    'error'   => true,
                );
                        echo json_encode($array);
                    } else {
                        $no_srt_gd  		= $this->input->post('no_srt_gd', true);
                        $unit_gd  		= $this->input->post('unit_gd', true);
                        $jns_gd  	= $this->input->post('jns_gd', true);
                        $lok_gd  		= $this->input->post('lok_gd', true);
                        $pemilik_lok_gd  		= $this->input->post('pemilik_lok_gd', true);
                        $data = array(
                    'id_smohon_gd'       	=> $id,
                    'no_smohon_gd'        	=> $no_srt_gd,
                    'id_unit'    			=> $unit_gd,
                    'jns_gd'    			=> $jns_gd,
                    'lok_gd'    			=> $lok_gd,
                    'pemilik_lok_gd'    	=> $pemilik_lok_gd,
                    'edoc_s_mohon'    		=> $edoc_s_mohon_name,
                    'edoc_lap_pol_intel'    => $edoc_lap_pol_intel_name,
                    'edoc_sprint'    => $edoc_sprint_name,
                    'edoc_spg'    => $edoc_spg_name,
                    'create_by_gd'       		=> $this->session->userdata('ses_nm'),
                    'created_at_gd'       		=> date('Y-m-d H:i:s'),
                );
                        $this->m_penyelidikan->insert($data);
                        $array = array(
                    'success' => 'sukses'
                );

                        echo json_encode($array);
                    }
                }
            }
		}
	}

	public function edit_pyd()
	{
		$valid = $this->input->post('valid_gd');
        $id_gd_edit = $this->input->post('id_gd_edit');

        $this->db->where('validasi', $valid);
        $this->db->where('id_smohon_gd', $id_gd_edit);
        $q = $this->db->get('tbl_penyelidikan');

        if ($q->num_rows() > 1) {
            
            redirect('penyelidikan');
        }
		
		$no_srt_gd_edit  		= $this->input->post('no_srt_gd_edit', true);
		$unit_gd_edit  		= $this->input->post('unit_gd_edit', true);
		$lok_gd_edit  	= $this->input->post('lok_gd_edit', true);
		$jns_gd_edit  	= $this->input->post('jns_gd_edit', true);
		$pemilik_lok_gd_edit  		= $this->input->post('pemilik_lok_gd_edit', true);
		$data = array(
			'no_smohon_gd'       	=> $no_srt_gd_edit,
			'id_unit'        		=> $unit_gd_edit,
			'jns_gd'    			=> $jns_gd_edit,
			'lok_gd'    			=> $lok_gd_edit,
			'pemilik_lok_gd'    	=> $pemilik_lok_gd_edit,
			'update_by_gd'       		=> $this->session->userdata('ses_nm'),
			'updated_at_gd'       		=> date('Y-m-d H:i:s'),
		);
		$this->m_penyelidikan->update($data);
		$array = array(
			'success' => 'sukses'
		);

		echo json_encode($array);
	}
	public function reupload_smohon()
	{

		$this->load->helper(['form', 'string']);
		$id_smohon_edoc1      	= $this->input->post('id_smohon_edoc1', true);
		$edoc_s_mohon_edit = $_FILES['edoc_s_mohon_edit']['name'];

		$config['upload_path']          = 'file/gd/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc_s_mohon_edit);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_smohon_edoc1 . "_s_mohon." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$edoc_s_mohon_edit_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc_s_mohon_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$data = array('edoc_s_mohon_edit' => $this->upload->data());
			$data = array(

				'edoc_s_mohon'    		=> $edoc_s_mohon_edit_name,
			);
			$this->m_penyelidikan->update_smohon($data);
			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	public function reupload_lap_pol_intel()
	{

		$this->load->helper(['form', 'string']);
		$id_lap_pol_intel_edoc1      	= $this->input->post('id_lap_pol_intel_edoc1', true);
		$edoc_lap_pol_intel_edit = $_FILES['edoc_lap_pol_intel_edit']['name'];

		$config['upload_path']          = 'file/gd/';
		$config['allowed_types']        = 'pdf';
		$x = explode(".", $edoc_lap_pol_intel_edit);
		$ext = strtolower(end($x));
		$config['file_name'] = $id_lap_pol_intel_edoc1 . "_s_lap." . $ext;
		$config['overwrite']            = true;
		$config['max_size']             = 5024; // 1MB
		$edoc_edoc_lap_pol_intel_edit_name = $config['file_name'];
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya  

		if (!$this->upload->do_upload('edoc_lap_pol_intel_edit')) {
			$array = array(
				'error'   => true,
			);
			echo json_encode($array);
		} else {
			$data = array('edoc_s_mohon_edit' => $this->upload->data());
			$data = array(

				'edoc_s_mohon'    		=> $edoc_edoc_lap_pol_intel_edit_name,
			);
			$this->m_penyelidikan->update_lap_pol_intel($data);
			$array = array(
				'success' => 'sukses'
			);
			echo json_encode($array);
		}
	}

	private function cek_delete_pyd()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		$this->form_validation->set_rules('smohon', 's_mohon', 'trim|required');
		$this->form_validation->set_rules('lap', 'lap', 'trim|required');
		return $this->form_validation->run();
	}
	public function delete_pyd()
	{
		if ($this->cek_delete_pyd()) {
			$this->load->helper('file');
			$id = $this->input->post('id');
			$smohon = $this->input->post('smohon');
			$lap = $this->input->post('lap');
			$this->db->where('id_smohon_gd', $id);
			$this->db->delete('tbl_penyelidikan');
			unlink(FCPATH . 'file/gd/' . $smohon);
			unlink(FCPATH . 'file/gd/' . $lap);
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
