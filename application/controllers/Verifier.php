<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('verifier')) {
            redirect('auth/login');
        }
        $this->load->model('/loan_model');
    }

    public function index()
    {
        $data['page'] = 'verifier';
        $data['submitted_loan'] = $this->loan_model->get_by_status('submitted');
        $this->load->view('verifier/verifier_view', $data);
    }

    public function edit($loan_id)
    {
        $this->loan_model->update($loan_id, ['status' => 'verified']);
        redirect('verifier');
    }

}
