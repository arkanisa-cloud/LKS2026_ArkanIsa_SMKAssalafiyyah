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
        $this->load->model('/financing_application_model');
    }

    public function index()
    {
        $data['page'] = 'approval';
        $data['recommended_financing_applications'] = $this->financing_application_model->get_by_status('recommended');
        $data['under_review_financing_applications'] = $this->financing_application_model->get_by_status('under_review');

        $this->load->view('manager/manager_view', $data);
    }

    public function edit($financing_application_id, $status)
    {
        if ($status == 'approved') {

            $data = [
                'status' => $status,
                'rejected_reason' => null,
                'approved_at' => date('Y-m-d'),
            ];
        } else {
            $data = [
                'status' => $status,
                'rejected_reason' => $this->input->post('rejected_reason'),
                'approved_at' => null,
            ];
        }
        $this->financing_application_model->update($financing_application_id, $data);
        redirect('approval');
    }

}
