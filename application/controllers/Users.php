<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('User_model','Store_model'));
        $this->load->library('session');
        $this->load->helper(array('form','url'));
        if ($this->session->userdata('role') !== 'superadmin') {
            show_error('Hanya superadmin yang bisa mengelola data pengguna.');
        }
    }

    public function index()
    {
        $data['users'] = $this->User_model->get_all();
        $data['stores'] = $this->Store_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        if ($this->input->method() === 'post') {
            $data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'role' => $this->input->post('role'),
                'id_toko' => $this->input->post('role') === 'admin' ? $this->input->post('id_toko') : NULL
            );
            $this->User_model->create($data);
            redirect('users');
        }
        $data['stores'] = $this->Store_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('users/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $user = $this->User_model->get($id);
        if (!$user) { show_404(); }
        if ($this->input->method() === 'post') {
            $data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'role' => $this->input->post('role'),
                'id_toko' => $this->input->post('role') === 'admin' ? $this->input->post('id_toko') : NULL
            );
            if ($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            }
            $this->User_model->update($id, $data);
            redirect('users');
        }
        $data['user'] = $user;
        $data['stores'] = $this->Store_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('users/form', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $this->User_model->delete($id);
        redirect('users');
    }
}