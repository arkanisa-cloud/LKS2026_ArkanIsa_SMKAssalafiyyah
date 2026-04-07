<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_analyst extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('analyst')) {
            redirect('auth/login');
        }
        $this->load->model('dashboard/dashboard_analyst_model');
    }

    public function index()
    {
        $data['page'] = 'dashboard_analyst';
        $this->load->view('dashboard/dashboard_analyst_view', $data);
    }


}