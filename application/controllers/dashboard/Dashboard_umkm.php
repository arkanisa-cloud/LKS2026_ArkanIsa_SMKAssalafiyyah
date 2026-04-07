<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_umkm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('applicant')) {
            redirect('auth/login');
        }
        $this->load->model('dashboard_umkm_model');
        $this->load->library(['form_validation', 'upload']);
    }

    public function index()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $data['profile'] = $this->dashboard_umkm_model->get_by_user_id($user_id);

        $this->load->view('layouts/header', $data);
        $this->load->view('folder/view_file', $data);
        $this->load->view('layouts/footer');
    }


}