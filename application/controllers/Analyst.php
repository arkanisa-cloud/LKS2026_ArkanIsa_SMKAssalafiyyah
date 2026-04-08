<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analyst extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('analyst')) {
            redirect('auth/login');
        }
        $this->load->model('/financing_application_model');
    }

    public function index()
    {
        $data['page'] = 'analyst';
        $data['submitted_financing_applications'] = $this->financing_application_model->get_by_status('submitted');
        $this->load->view('analyst/analyst_view', $data);
    }

    public function edit($financing_application_id)
    {
        $rate = $this->input->post('rate');

        if ($rate <= 25) {
            $status = 'rejected_by_analyst';
        } elseif ($rate < 65) {
            $status = 'under_review';
        } else {
            $status = 'recommended';
        }

        $data = [
            'status' => $status,
            'rate' => $rate,
            'rekomen_limit' => $this->input->post('rekomen_limit'),
            'note' => $this->input->post('note'),
        ];

        $this->financing_application_model->update($financing_application_id, $data);
        redirect('analyst');
    }

}
