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
            redirect('approval');
        } elseif ($this->ion_auth->in_group('manager')) {
            redirect('approval');
        } elseif ($this->ion_auth->in_group('verifer')) {
            redirect('verifer');
        } elseif ($this->ion_auth->in_group('analyst')) {
            redirect('analyst');
        } elseif ($this->ion_auth->in_group('applicant')) {
            redirect('umkm_profile');
        } else {
            echo ('<h1>ERROR: Akun ini tidak memiliki group/hak akses<h1>');
        }
    }


}