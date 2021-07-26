<?php
class M_penyidikan extends CI_Model
{

    public $table = 'tbl_penyidikan';
    public $id = 'id';
    public $order = 'asc';      

    function __construct()
    {
        parent::__construct();
    }

    public function json_penyidikan()
    {

        if ($this->session->userdata('akses') == 4) {
            $where = $this->session->userdata('ses_id_unit');
        }
        $this->datatables->select('*');
        $this->datatables->from('tbl_penyidikan');
        if ($this->session->userdata('akses') == 4) {
            $this->datatables->where('tbl_penyidikan.id_unit', $where);
        }
        //$this->datatables->join('tbl_penyelidikan', 'tbl_pg.id_ijin_pg = tbl_penyelidikan.id_ijin_pg', 'left');
        $this->datatables->join('tbl_unit', 'tbl_penyidikan.id_unit = tbl_unit.id_unit', 'left');

        $this->db->order_by('urut_py', 'asc');
        return $this->datatables->generate();
    }
    public function insert($data)
    {
        return $this->db->insert('tbl_penyidikan', $data);
    }

    function update($data)
    {
        $id_py = $this->input->post('id_py');
        $this->db->where('id_py', $id_py);
        $result = $this->db->update('tbl_penyidikan', $data);
        return $result;
    }



    public function insert_penyidikan($data)
    {
        return $this->db->insert('tbl_penyidikan', $data);
    }

    public function get_id_penyidikan($id)
    {
        $this->datatables->select('*');
        $this->db->select('YEAR(tgl_lahir_py) as ta,
        MONTH(tgl_lahir_py) as bln,
        DAY(tgl_lahir_py) as tgl');
        $this->datatables->where('id_py', $id);
        $this->datatables->from('tbl_penyidikan');
        $this->datatables->join('tbl_unit', 'tbl_penyidikan.id_unit = tbl_unit.id_unit', 'left');
        return $this->db->get($this->table)->row();
    }

    function verif($data, $id)
    {

        $this->db->where('id_py', $id);
        $result = $this->db->update('tbl_penyidikan', $data);
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

    function valid($data)
    {
        $id = $this->input->post('id');
        $this->db->where('id_py', $id);
        $result = $this->db->update('tbl_penyidikan', $data);
        return $result;
    }
}
