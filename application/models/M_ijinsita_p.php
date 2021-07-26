<?php
class M_ijinsita_p extends CI_Model
{

    public $table = 'tbl_ijinsita_p';
    public $id = 'id';
    public $order = 'asc';

    function __construct()
    {
        parent::__construct();
    }

    public function json()
    {
        if ($this->session->userdata('akses') == 4) {
            $where = $this->session->userdata('ses_id_unit');
        }
        $this->datatables->select('*');
        $this->datatables->select('DATEDIFF(tbl_ijinsita_p.verif_date,tbl_ijinsita_p.created_at_sita) as lamaproses
        ');
        $this->datatables->from('tbl_ijinsita_p');
        if ($this->session->userdata('akses') == 4) {
            $this->datatables->where('tbl_ijinsita_p.id_unit', $where);
        }
        $this->datatables->join('tbl_unit', 'tbl_ijinsita_p.id_unit = tbl_unit.id_unit', 'left');

        $this->db->order_by('urut_sita', 'asc');
        return $this->datatables->generate();
    }

    public function json_brg_sita($id)
    {

        $this->datatables->select('*');
        $this->datatables->from('tbl_brg_ijin_sita_p');
        $this->datatables->where('id_ijin_sita', $id);
        $this->db->order_by('urut_brg', 'asc');
        return $this->datatables->generate();
    }
    public function insert($data)
    {
        return $this->db->insert('tbl_ijinsita_p', $data);
    }


    function update($data)
    {
        $id = $this->input->post('id_ijin_sita_edit_p');

        $this->db->where('id_ijin_sita', $id);
        $result = $this->db->update('tbl_ijinsita_p', $data);
        return $result;
    }
    public function insert_brg($data)
    {
        return $this->db->insert('tbl_brg_ijin_sita_p', $data);
    }
    

   

    function verif($data, $id)
    {

        $this->db->where('id_ijin_sita', $id);
        $result = $this->db->update('tbl_ijinsita_p', $data);
        return $result;
    }

    function valid($data)
    {
        $id = $this->input->post('id');
        $this->db->where('id_ijin_sita', $id);
        $result = $this->db->update('tbl_ijinsita_p', $data);
        return $result;
    }

    public function get_id_ijin_sita($id)
    {
        $this->datatables->select('*');
        $this->datatables->where('id_ijin_sita', $id);
        $this->datatables->from('tbl_ijinsita_p');
        $this->datatables->join('tbl_unit', 'tbl_ijinsita_p.id_unit = tbl_unit.id_unit', 'left');
        return $this->db->get($this->table)->row();
    }

    public function get_by_id_penyelidikan($id)
    {
        $this->datatables->select('*');
        $this->datatables->where('id_ijin_pg', $id);
        $this->datatables->from('tbl_penyelidikan');
        return $this->db->get('tbl_penyelidikan')->row();
    }

    function update_penyelidikan($data)
    {
        $id_pg = $this->input->post('id_pg');

        $this->db->where('id_ijin_pg', $id_pg);
        $result = $this->db->update('tbl_penyelidikan', $data);
        return $result;
    }

    function update_smohon($data)
    {
        $id_smohon_edoc1 = $this->input->post('id_smohon_edoc1');

        $this->db->where('id_smohon_gd', $id_smohon_edoc1);
        $result = $this->db->update('tbl_penyelidikan', $data);
        return $result;
    }

    function update_lap_pol_intel($data)
    {
        $id_lap_pol_intel_edoc1 = $this->input->post('id_lap_pol_intel_edoc1');

        $this->db->where('id_smohon_gd', $id_lap_pol_intel_edoc1);
        $result = $this->db->update('tbl_penyelidikan', $data);
        return $result;
    }

    public function get_by_id_penyidikan($id)
    {
        $this->datatables->select('*');
        $this->db->select('DATE_FORMAT(tgl_lahir_pydk, "%m/%d/%Y") as date_lahir_pydk');
        $this->datatables->where('id_ijin_pg', $id);
        $this->datatables->from('tbl_penyidikan');
        return $this->db->get('tbl_penyidikan')->row();
    }





    public function delete($id)
    {
        $this->db->where('id_bag', $id);
        $result = $this->db->delete('tbl_bagian');
        return $result;
    }
}
