<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_manager extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('manager')) {
            redirect('auth/login');
        }
        $this->load->model('dashboard/dashboard_manager_model');
    }

    public function index()
    {
        $data['page'] = 'dashboard_manager';
        $this->load->view('dashboard/dashboard_manager_view', $data);
    }
}