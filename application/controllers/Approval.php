<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('manager')) {
            redirect('auth/login');
        }
        $this->load->model('/loan_model');
    }

    public function index()
    {
        $data['page'] = 'approval';
        $data['verified_loan'] = $this->loan_model->get_by_status('verified');
        $data['recommended_loan'] = $this->loan_model->get_by_status('recommended');
        $data['under_review_loan'] = $this->loan_model->get_by_status('under_review');

        $this->load->view('manager/manager_view', $data);
    }

    public function edit($loan_id)
    {
        $this->loan_model->update($loan_id, ['status' => 'approved']);
        redirect('approval');
    }

}
