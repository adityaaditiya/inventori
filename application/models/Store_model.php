<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model {

    protected $table = 'stores';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}