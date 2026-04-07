<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }


    public function index()
    {

        if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('admin')) {
            redirect('dashboard/Dashboard_admin');
        } elseif ($this->ion_auth->in_group('manager')) {
            redirect('dashboard/Dashboard_manager');
        } elseif ($this->ion_auth->in_group('verifier')) {
            redirect('dashboard/Dashboard_verifier');
        } elseif ($this->ion_auth->in_group('analyst')) {
            redirect('dashboard/Dashboard_analyst');
        } elseif ($this->ion_auth->in_group('applicant')) {
            redirect('dashboard/Dashboard_umkm');
        } else {
            echo ('<h1>ERROR: Akun ini tidak memiliki group/hak akses<h1>');
        }
    }


}