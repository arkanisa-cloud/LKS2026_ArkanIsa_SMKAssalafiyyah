<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('verifer')) {
            redirect('auth/login');
        }
        $this->load->model('/loan_model');
    }

    public function index()
    {
        $data['page'] = 'verifer';
        $data['submitted_loan'] = $this->loan_model->get_by_status('submitted');
        $this->load->view('verifer/verifer_view', $data);
    }

    public function edit($loan_id)
    {
        $this->loan_model->update($loan_id, ['status' => 'verified']);
        redirect('verifer');
    }

}
