<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model');
        $this->load->library('session');
        $this->load->helper(array('form','url'));
        // owner and superadmin can view reports
        $role = $this->session->userdata('role');
        if (!in_array($role, array('superadmin','owner'))) {
            show_error('Tidak memiliki hak untuk melihat laporan');
        }
    }

    public function inventory()
    {
        $store_id = $this->input->get('store_id');
        $data['inventory'] = $this->Report_model->inventory_report($store_id);
        $this->load->view('templates/header');
        $this->load->view('reports/inventory', $data);
        $this->load->view('templates/footer');
    }

    public function transfers()
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $data['transfers'] = $this->Report_model->transfer_report($start_date, $end_date);
        $this->load->view('templates/header');
        $this->load->view('reports/transfers', $data);
        $this->load->view('templates/footer');
    }
}