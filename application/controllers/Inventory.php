<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Inventory_model','Product_model','Store_model'));
        $this->load->library('session');
        $this->load->helper(array('form','url'));
        if (!$this->session->userdata('role')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $role = $this->session->userdata('role');
        $id_toko = $this->session->userdata('id_toko');
        if ($role === 'admin') {
            $data['inventory'] = $this->Inventory_model->get_by_store($id_toko);
        } else {
            $store_id = $this->input->get('store_id');
            if ($store_id) {
                $data['inventory'] = $this->Inventory_model->get_by_store($store_id);
            } else {
                $data['inventory'] = $this->Inventory_model->get_all();
            }
        }
        $data['stores'] = $this->Store_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('inventory/index', $data);
        $this->load->view('templates/footer');
    }

    public function add_stock()
    {
        $role = $this->session->userdata('role');
        if ($role !== 'admin' && $role !== 'superadmin') {
            show_error('Tidak memiliki hak untuk menambah stok');
        }
        if ($this->input->method() === 'post') {
            $id_product = $this->input->post('id_product');
            $jumlah = (int)$this->input->post('jumlah');
            $id_store = $this->session->userdata('id_toko');
            if ($role === 'superadmin') {
                $id_store = $this->input->post('id_store');
            }
            $this->Inventory_model->increase_stock($id_store, $id_product, $jumlah);
            redirect('inventory');
        }
        $data['products'] = $this->Product_model->get_all();
        $data['stores'] = $this->Store_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('inventory/adjust', $data);
        $this->load->view('templates/footer');
    }

    public function adjust_stock($id)
    {
        $role = $this->session->userdata('role');
        if ($role !== 'admin' && $role !== 'superadmin') {
            show_error('Tidak memiliki hak untuk mengubah stok');
        }
        $record = $this->Inventory_model->get($id);
        if (!$record) {
            show_404();
        }
        if ($this->input->method() === 'post') {
            $new_qty = (int)$this->input->post('jumlah_stok');
            $this->Inventory_model->update($id, ['jumlah_stok' => $new_qty]);
            redirect('inventory');
            return;
        }
        $data['inventory'] = $record;
        $this->load->view('templates/header');
        $this->load->view('inventory/adjust', $data);
        $this->load->view('templates/footer');
    }
}