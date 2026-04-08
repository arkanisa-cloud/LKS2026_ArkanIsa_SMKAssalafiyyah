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
        $this->load->model('business_verification_model');
    }

    public function index()
    {
        $data['page'] = 'verifier';
        $data['bussiness_submitted'] = $this->business_verification_model->get_all_submitted();
        $this->load->view('verifier/verifier_view', $data);
    }

    public function edit($business_verification_id, $status)
    {

        if ($status == 'verified') {

            $data = [
                'status' => $status,
                'rejected_reason' => null,
                'verified_by' => $this->ion_auth->user()->row()->id,
                'verified_at' => date('Y-m-d'),
            ];
        } else {
            $data = [
                'status' => $status,
                'rejected_reason' => $this->input->post('rejected_reason'),
                'verified_by' => null,
                'verified_at' => null,

            ];
        }
        $this->business_verification_model->update($business_verification_id, $data);
        redirect('verifier');
    }


}
