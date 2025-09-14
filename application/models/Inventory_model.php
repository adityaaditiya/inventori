<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model {

    protected $table = 'inventory';

    public function get_all()
    {
        return $this->db
            ->select('inventory.*, products.nama_barang, stores.nama_toko')
            ->join('products','products.id=inventory.id_product')
            ->join('stores','stores.id=inventory.id_store')
            ->get($this->table)->result();
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_by_store($store_id)
    {
        return $this->db
            ->select('inventory.*, products.nama_barang')
            ->join('products','products.id=inventory.id_product')
            ->where('inventory.id_store', $store_id)
            ->get($this->table)->result();
    }

    public function increase_stock($store_id, $product_id, $qty)
    {
        $existing = $this->db->get_where($this->table, [
            'id_store' => $store_id,
            'id_product' => $product_id
        ])->row();
        if ($existing) {
            $this->db->where('id', $existing->id)
                ->update($this->table, ['jumlah_stok' => $existing->jumlah_stok + $qty]);
        } else {
            $this->db->insert($this->table, [
                'id_store' => $store_id,
                'id_product' => $product_id,
                'jumlah_stok' => $qty
            ]);
        }
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update($this->table, $data);
        return $this->db->affected_rows();
    }
}