<?php
class M_pd extends CI_Model
{

    public $table = 'tbl_pd';
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
        $this->datatables->from('tbl_pd');
        if ($this->session->userdata('akses') == 4) {
            $this->datatables->where('tbl_pd.id_unit', $where);
        }
        $this->datatables->join('tbl_unit', 'tbl_pd.id_unit = tbl_unit.id_unit', 'left');

        $this->db->order_by('urut_pd', 'asc');
        return $this->datatables->generate();
    }
    public function insert($data)
    {
        return $this->db->insert('tbl_pd', $data);
    }

  
    function update($data, $id)
    {
        $this->db->where('id_smohon_pd', $id);
        $result = $this->db->update('tbl_pd', $data);
        return $result;
    }

    
    


    function valid($data)
    {
        $id = $this->input->post('id');
        $this->db->where('id_smohon_pd', $id);
        $result = $this->db->update('tbl_pd', $data);
        return $result;
    }

    public function get_pd($id)
    {
        $this->datatables->select('*');
        $this->db->select('YEAR(jk_start) as ta1,
        MONTH(jk_start) as bln1,
        DAY(jk_start) as tgl1');
        $this->db->select('YEAR(jk_end) as ta2,
        MONTH(jk_end) as bln2,
        DAY(jk_end) as tgl2');
        $this->datatables->where('id_smohon_pd', $id);
        $this->datatables->from('tbl_pd');
        $this->datatables->join('tbl_unit', 'tbl_pd.id_unit = tbl_unit.id_unit', 'left');
        return $this->db->get($this->table)->row();
    }

    public function delete($id)
    {
        $this->db->where('id_bag', $id);
        $result = $this->db->delete('tbl_bagian');
        return $result;
    }
}
