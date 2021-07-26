<?php
class M_pg extends CI_Model
{

    public $table = 'tbl_pg';
    public $id = 'id';
    public $order = 'asc';

    function __construct()
    {
        parent::__construct();
    }

    public function json_pg()
    {
        $ses = 1;
        if ($ses == 3) {
            $id = "A9EFRBUpeosWMzIr";
        }
        $this->datatables->select('tbl_pg.id_ijin_pg,
        tbl_pg.id_unit,
        tbl_pg.no_srt,
        tbl_pg.created_at,
        tbl_pg.stts_penyelidikan,
        tbl_pg.stts_penyidikan,
        tbl_pg.status,
        tbl_penyelidikan.edoc_pnyldk,
        tbl_penyidikan.edoc_pydk,
        tbl_unit.id_unit,
        tbl_unit.nm_unit');
        $this->datatables->from('tbl_pg');
        $this->datatables->join('tbl_penyelidikan', 'tbl_pg.id_ijin_pg = tbl_penyelidikan.id_ijin_pg', 'left');
        $this->datatables->join('tbl_penyidikan', 'tbl_pg.id_ijin_pg = tbl_penyidikan.id_ijin_pg', 'left');
        $this->datatables->join('tbl_unit', 'tbl_pg.id_unit = tbl_unit.id_unit', 'left');
        if ($ses == 3) {
            $this->datatables->where('tbl_unit.id_unit', $id);
        }
        $this->db->order_by('created_at', 'asc');
        return $this->datatables->generate();
    }
    public function insert_pg($data)
    {
        return $this->db->insert('tbl_pg', $data);
    }

    function update_pg($data)
    {
        $id_ijin_pg_edit = $this->input->post('id_ijin_pg_edit');
        $this->db->where('id_ijin_pg', $id_ijin_pg_edit);
        $result = $this->db->update('tbl_pg', $data);
        return $result;
    }

    public function insert_penyelidikan($data)
    {
        return $this->db->insert('tbl_penyelidikan', $data);
    }

    public function insert_penyidikan($data)
    {
        return $this->db->insert('tbl_penyidikan', $data);
    }

    function kunci_pg($data)
    {
        $id = $this->input->post('id');

        $this->db->where('id_ijin_pg', $id);
        $result = $this->db->update('tbl_pg', $data);
        return $result;
    }

    function buka_kunci_pg($data)
    {
        $id = $this->input->post('id');
        $this->db->where('id_ijin_pg', $id);
        $result = $this->db->update('tbl_pg', $data);
        return $result;
    }

    public function get_by_id($id)
    {
        $this->datatables->select('*');
        $this->datatables->where('id_ijin_pg', $id);
        $this->datatables->from('tbl_pg');
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

    function update_penyidikan($data)
    {
        $id_pg_pydk = $this->input->post('id_pg_pydk');

        $this->db->where('id_ijin_pg', $id_pg_pydk);
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

    public function update_foto($data)
    {
        $id_foto_menara = $this->input->post('id_foto_menara');

        $this->db->where('id_menara', $id_foto_menara);
        $this->db->update('tbl_menara', $data);
    }

    function update_stts_terbit($data)
    {
        $id_menara = $this->input->post('id_menara');

        $this->db->where('id_menara', $id_menara);
        $result = $this->db->update('tbl_menara', $data);
        return $result;
    }
    public function tampil_kec()
    {
        $this->datatables->select('*');
        $this->datatables->from('ref_kecamatan');
        return $this->db->get('ref_kecamatan')->result();
    }

    public function delete($id)
    {
        $this->db->where('id_bag', $id);
        $result = $this->db->delete('tbl_bagian');
        return $result;
    }
    function get_coordinates()
    {
        $return = array();
        $this->db->select("latitude,longitude");
        $this->db->from("tbl_menara");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                array_push($return, $row);
            }
        }
        return $return;
    }
}
