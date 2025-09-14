<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stores extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Store_model');
        $this->load->library('session');
        $this->load->helper(array('form','url'));
        if ($this->session->userdata('role') !== 'superadmin') {
            show_error('Hanya superadmin yang bisa mengelola data toko.');
        }
    }

    public function index()
    {
        $data['stores'] = $this->Store_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('stores/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        if ($this->input->method() === 'post') {
            $this->Store_model->create(array(
                'nama_toko' => $this->input->post('nama_toko'),
                'alamat' => $this->input->post('alamat'),
                'kode_toko' => $this->input->post('kode_toko')
            ));
            redirect('stores');
        }
        $this->load->view('templates/header');
        $this->load->view('stores/form');
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $store = $this->Store_model->get($id);
        if (!$store) { show_404(); }
        if ($this->input->method() === 'post') {
            $this->Store_model->update($id, array(
                'nama_toko' => $this->input->post('nama_toko'),
                'alamat' => $this->input->post('alamat'),
                'kode_toko' => $this->input->post('kode_toko')
            ));
            redirect('stores');
        }
        $data['store'] = $store;
        $this->load->view('templates/header');
        $this->load->view('stores/form', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $this->Store_model->delete($id);
        redirect('stores');
    }
}