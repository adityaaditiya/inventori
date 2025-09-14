<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function inventory_report($store_id = NULL)
    {
        $this->db
            ->select('inventory.*, products.nama_barang, stores.nama_toko')
            ->from('inventory')
            ->join('products','products.id = inventory.id_product')
            ->join('stores','stores.id = inventory.id_store');
        if ($store_id) {
            $this->db->where('inventory.id_store', $store_id);
        }
        return $this->db->get()->result();
    }

    public function transfer_report($start_date = NULL, $end_date = NULL)
    {
        $this->db
            ->select('stock_transfers.*, products.nama_barang, sa.nama_toko AS asal, st.nama_toko AS tujuan, users.nama_lengkap AS operator')
            ->from('stock_transfers')
            ->join('products','products.id=stock_transfers.id_product')
            ->join('stores sa','sa.id=stock_transfers.id_toko_asal')
            ->join('stores st','st.id=stock_transfers.id_toko_tujuan')
            ->join('users','users.id=stock_transfers.id_user_transfer');
        if ($start_date) {
            $this->db->where('stock_transfers.tanggal_transfer >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('stock_transfers.tanggal_transfer <=', $end_date);
        }
        return $this->db->order_by('stock_transfers.tanggal_transfer','DESC')->get()->result();
    }
}