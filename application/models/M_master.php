<?php
class M_master extends CI_Model
{


    function __construct()
    {
        parent::__construct();
    }

    public function tampil_unit()
    {
        $this->datatables->select('*');
        $this->datatables->from('tbl_unit');
        return $this->db->get('tbl_unit')->result();
    }

    public function json_unit()
    {
        $this->datatables->select('*');
        $this->datatables->from('tbl_unit');
        return $this->datatables->generate();
    }

    public function json_admin()
    {
        $this->datatables->select('admin.id_user,
        admin.id_akses,
        admin.username,
        admin.nama,
        admin.nip,
        admin.email,
        admin.updated_at,
        admin.last_login,
        tbl_akses.hak_akses');
        $this->db->where_not_in('admin.id_akses', '1');
        $this->datatables->join('tbl_akses', 'admin.id_akses = tbl_akses.id_akses', 'left');

        $this->datatables->from('admin');
        return $this->datatables->generate();
    }

    public function json_op($id)
    {
        $this->datatables->select('tbl_user.id_user,
        tbl_user.id_akses,
        tbl_user.id_unit,
        tbl_user.username,
        tbl_user.nama,
        tbl_user.email,
        tbl_user.created_at,
        tbl_user.updated_at,
        tbl_user.last_login,
        tbl_user.nrp_nip');
        $this->datatables->where('tbl_user.id_unit',$id);
        $this->db->order_by('urut_user');
        $this->datatables->from('tbl_user');
        $this->datatables->join('tbl_unit', 'tbl_user.id_unit = tbl_unit.id_unit', 'left');
        return $this->datatables->generate();
    }

    public function insert_unit($data)
    {
        return $this->db->insert('tbl_unit', $data);
    }

    public function insert_admin($data)
    {
        return $this->db->insert('admin', $data);
    }

    public function insert_op($data)
    {
        return $this->db->insert('tbl_user', $data);
    }

    function update_unit($data, $id_unit)
    {
        //$id_unit = $this->input->post('id_unit');

        $this->db->where('id_unit', $id_unit);
        $result = $this->db->update('tbl_unit', $data);
        return $result;
    }

    function update_user($data)
    {
        $id_unit = $this->input->post('id_user');

        $this->db->where('id_user', $id_unit);
        $result = $this->db->update('admin', $data);
        return $result;
    }

    function reset_pass($data, $id)
    {

        $this->db->where('id_user', $id);
        $result = $this->db->update('admin', $data);
        return $result;
    }
    public function get_by_id_unit($id)
    {
        $this->datatables->select('*');
        $this->datatables->where('id_unit', $id);
        $this->datatables->from('tbl_unit');
        return $this->db->get('tbl_unit')->row();
    }

    public function get_user($id)
    {
        $this->datatables->select('*');
        $this->datatables->where('id_user', $id);
        $this->datatables->from('admin');
        return $this->db->get('admin')->row();
    }

    function ubah_pass_admin($data, $id)
    {

        $this->db->where('id_user', $id);
        $result = $this->db->update('admin', $data);
        return $result;
    }
    
    function ubah_pass_user($data, $id)
    {
        $this->db->where('id_user', $id);
        $result = $this->db->update('tbl_user', $data);
        return $result;
    }
    
}
