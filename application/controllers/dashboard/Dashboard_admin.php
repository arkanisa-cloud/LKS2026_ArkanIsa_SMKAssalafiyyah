<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('admin')) {
            redirect('auth/login');
        }
        $this->load->model('dashboard/dashboard_admin_model');
    }

    public function index()
    {
        $data['page'] = 'dashboard_admin';
        $this->load->view('dashboard/dashboard_admin_view', $data);
    }


}