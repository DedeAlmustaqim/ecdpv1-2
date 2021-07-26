<?php
class M_psita extends CI_Model
{

    public $table = 'tbl_psita';
    public $id = 'id';
    public $order = 'asc';

    function __construct()
    {
        parent::__construct();
    }

    public function json_psita()
    {
        if ($this->session->userdata('akses') == 4) {
            $where = $this->session->userdata('ses_id_unit');
        }
        $this->datatables->select('*');
        //$this->datatables->select('DATEDIFF(tbl_ijinsita.verif_date,tbl_ijinsita.created_at_sita) as lamaproses
        //');
        $this->datatables->from('tbl_psita');
        if ($this->session->userdata('akses') == 4) {
            $this->datatables->where('tbl_psita.id_unit', $where);
        }
        $this->datatables->join('tbl_unit', 'tbl_psita.id_unit = tbl_unit.id_unit', 'left');

        $this->db->order_by('urut_psita', 'asc');
        return $this->datatables->generate();
    }

    public function json_brg_psita($id)
    {

        $this->datatables->select('*');
        $this->datatables->from('tbl_brg_psita');
        $this->datatables->where('id_psita', $id);
        $this->db->order_by('urut_brg', 'asc');
        return $this->datatables->generate();
    }
    public function insert($data)
    {
        return $this->db->insert('tbl_psita', $data);
    }


    function update($data)
    {
        $id = $this->input->post('id_psita_edit');

        $this->db->where('id_psita', $id);
        $result = $this->db->update('tbl_psita', $data);
        return $result;
    }
    public function insert_brg($data)
    {
        return $this->db->insert('tbl_brg_psita', $data);
    }
    public function insert_penyelidikan($data)
    {
        return $this->db->insert('tbl_penyelidikan', $data);
    }

    public function insert_penyidikan($data)
    {
        return $this->db->insert('tbl_penyidikan', $data);
    }

    function verif($data, $id)
    {

        $this->db->where('id_psita', $id);
        $result = $this->db->update('tbl_psita', $data);
        return $result;
    }

    function valid($data)
    {
        $id = $this->input->post('id');
        $this->db->where('id_psita', $id);
        $result = $this->db->update('tbl_psita', $data);
        return $result;
    }

    public function get_id_psita($id)
    {
        $this->datatables->select('*');
        $this->datatables->where('id_psita', $id);
        $this->datatables->from('tbl_psita');
        $this->datatables->join('tbl_unit', 'tbl_psita.id_unit = tbl_unit.id_unit', 'left');
        return $this->db->get($this->table)->row();
    }

    public function get_by_id_penyelidikan($id)
    {
        $this->datatables->select('*');
        $this->datatables->where('id_ijin_pg', $id);
        $this->datatables->from('tbl_penyelidikan');
        return $this->db->get('tbl_penyelidikan')->row();
    }

   

   




    public function delete($id)
    {
        $this->db->where('id_bag', $id);
        $result = $this->db->delete('tbl_bagian');
        return $result;
    }
}
