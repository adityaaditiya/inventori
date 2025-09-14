<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_model extends CI_Model {

    protected $table = 'stock_transfers';

    public function get_all()
    {
        return $this->db
            ->select('stock_transfers.*, products.nama_barang, sa.nama_toko AS asal, st.nama_toko AS tujuan, users.nama_lengkap AS operator')
            ->join('products','products.id=stock_transfers.id_product')
            ->join('stores sa','sa.id=stock_transfers.id_toko_asal')
            ->join('stores st','st.id=stock_transfers.id_toko_tujuan')
            ->join('users','users.id=stock_transfers.id_user_transfer')
            ->order_by('stock_transfers.tanggal_transfer','DESC')
            ->get($this->table)->result();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update_status($id, $status)
    {
        $this->db->where('id', $id)->update($this->table, ['status' => $status]);
        return $this->db->affected_rows();
    }
}