<?php
class M_penahanan extends CI_Model
{

    public $table = 'tbl_penahanan';
    public $id = 'id';
    public $order = 'asc';

    function __construct()
    {
        parent::__construct();
    }

    public function json_penahanan()
    {
        if ($this->session->userdata('akses') == 4) {
            $where = $this->session->userdata('ses_id_unit');
        }
        $this->datatables->select('*');
        //$this->datatables->select('DATEDIFF(tbl_ijinsita.verif_date,tbl_ijinsita.created_at_sita) as lamaproses
        //');
        $this->datatables->from('tbl_penahanan');
        if ($this->session->userdata('akses') == 4) {
            $this->datatables->where('tbl_penahanan.id_unit', $where);
        }
        $this->datatables->join('tbl_unit', 'tbl_penahanan.id_unit = tbl_unit.id_unit', 'left');

        $this->db->order_by('urut_penahanan', 'asc');
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
        return $this->db->insert('tbl_penahanan', $data);
    }


    function update($data, $id_ph)
    {

        $this->db->where('id_penahanan', $id_ph);
        $result = $this->db->update('tbl_penahanan', $data);
        return $result;
    }

    function update_r($data, $id_ph)
    {

        $this->db->where('id_penahanan', $id_ph);
        $result = $this->db->update('tbl_penahanan', $data);
        return $result;
    }
    
    function verif($data, $id)
    {

        $this->db->where('id_penahanan', $id);
        $result = $this->db->update('tbl_penahanan', $data);
        return $result;
    }

    function valid($data)
    {
        $id = $this->input->post('id');
        $this->db->where('id_penahanan', $id);
        $result = $this->db->update('tbl_penahanan', $data);
        return $result;
    }

    public function get_ph($id)
    {
        $this->datatables->select('*');
        $this->db->select('YEAR(tgl_lahir_ph) as ta,
        MONTH(tgl_lahir_ph) as bln,
        DAY(tgl_lahir_ph) as tgl');
        $this->datatables->where('id_penahanan', $id);
        $this->datatables->from('tbl_penahanan');
        $this->datatables->join('tbl_unit', 'tbl_penahanan.id_unit = tbl_unit.id_unit', 'left');
        return $this->db->get($this->table)->row();
    }
}
