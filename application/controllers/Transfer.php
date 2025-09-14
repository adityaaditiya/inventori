<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Transfer_model','Inventory_model','Product_model','Store_model'));
        $this->load->library('session');
        $this->load->helper(array('form','url'));
        if ($this->session->userdata('role') !== 'superadmin') {
            show_error('Hanya superadmin yang dapat mentransfer stok.');
        }
    }

    public function index()
    {
        $data['transfers'] = $this->Transfer_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('transfer/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        if ($this->input->method() === 'post') {
            $id_product = $this->input->post('id_product');
            $id_asal = $this->input->post('id_toko_asal');
            $id_tujuan = $this->input->post('id_toko_tujuan');
            $jumlah = (int)$this->input->post('jumlah');
            // validate stock
            $stock_asal = $this->Inventory_model->get_by_store($id_asal);
            $available = 0;
            foreach ($stock_asal as $item) {
                if ($item->id_product == $id_product) {
                    $available = $item->jumlah_stok;
                    break;
                }
            }
            if ($jumlah > $available) {
                $data['error'] = 'Jumlah melebihi stok tersedia.';
            } else {
                // reduce and increase stock
                $this->Inventory_model->increase_stock($id_asal, $id_product, -$jumlah);
                $this->Inventory_model->increase_stock($id_tujuan, $id_product, $jumlah);
                // create transfer record
                $this->Transfer_model->create(array(
                    'id_product' => $id_product,
                    'id_toko_asal' => $id_asal,
                    'id_toko_tujuan' => $id_tujuan,
                    'jumlah' => $jumlah,
                    'status' => 'selesai',
                    'id_user_transfer' => $this->session->userdata('user_id'),
                    'keterangan' => $this->input->post('keterangan')
                ));
                redirect('transfer');
                return;
            }
        }
        $data['products'] = $this->Product_model->get_all();
        $data['stores'] = $this->Store_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('transfer/form', $data);
        $this->load->view('templates/footer');
    }
}