<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $this->load->helper(array('form','url'));
        // Only superadmin and admin can manage products
        $role = $this->session->userdata('role');
        if (!in_array($role, array('superadmin','admin'))) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['products'] = $this->Product_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('products/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        if ($this->input->method() === 'post') {
            $this->load->library('upload');
            $config['upload_path'] = './uploads/products/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->upload->initialize($config);
            $file_name = null;
            if ($this->upload->do_upload('gambar')) {
                $file_name = $this->upload->data('file_name');
            }
            $product_data = array(
                'kode_barang' => $this->input->post('kode_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'deskripsi' => $this->input->post('deskripsi'),
                'gambar' => $file_name
            );
            $this->Product_model->create($product_data);
            redirect('products');
            return;
        }
        $this->load->view('templates/header');
        $this->load->view('products/form');
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $product = $this->Product_model->get($id);
        if (!$product) {
            show_404();
        }
        if ($this->input->method() === 'post') {
            $data = array(
                'kode_barang' => $this->input->post('kode_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'deskripsi' => $this->input->post('deskripsi'),
            );
            $this->Product_model->update($id, $data);
            redirect('products');
            return;
        }
        $data['product'] = $product;
        $this->load->view('templates/header');
        $this->load->view('products/form', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $this->Product_model->delete($id);
        redirect('products');
    }
}