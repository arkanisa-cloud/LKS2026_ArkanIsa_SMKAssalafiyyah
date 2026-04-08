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
        $this->load->model('dashboard/dashboard_umkm_model');
        $this->load->model('/business_verification_model');
    }

    public function index()
    {
        $data['page'] = 'dashboard_umkm';
        $user_id = $this->ion_auth->user()->row()->id;
        $data['profile'] = $this->business_verification_model->get_by_user_id($user_id);

        if ($data['profile']) {
            $this->load->view('dashboard/dashboard_umkm_view', $data);
        } else {
            $this->load->view('business_verification/business_verification_form', $data);
        }
    }


}