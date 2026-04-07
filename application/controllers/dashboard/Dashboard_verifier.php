<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_verifier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('verifier')) {
            redirect('auth/login');
        }
        $this->load->model('dashboard/dashboard_verifier_model');
    }

    public function index()
    {
        $data['page'] = 'dashboard_verifier';
        $this->load->view('dashboard/dashboard_verifier_view', $data);
    }
}