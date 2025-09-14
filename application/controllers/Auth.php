<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authentication controller.
 *
 * Provides login and logout functionality for all user roles.  Each user
 * record includes a role flag ('superadmin','owner','admin') which is used
 * to control access to various sections of the application.
 */
class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(array('form','url'));
    }

    /**
     * Display the login form and handle login submission.
     */
    public function login()
    {
        if ($this->input->method() === 'post') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->User_model->get_by_username($username);
            if ($user && password_verify($password, $user->password)) {
                // set session data
                $this->session->set_userdata(array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                    'id_toko' => $user->id_toko
                ));
                redirect('/');
                return;
            }
            $data['error'] = 'Login gagal. Periksa username atau password.';
        }
        $this->load->view('auth/login', isset($data) ? $data : NULL);
    }

    /**
     * Destroy the current session.
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}