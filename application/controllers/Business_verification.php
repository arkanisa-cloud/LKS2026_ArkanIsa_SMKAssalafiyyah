<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business_verification extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('applicant')) {
            redirect('auth/login');
        }
        $this->load->model('business_verification_model');
        $status = $this->business_verification_model->get_status_by_user_id($this->ion_auth->user()->row()->id);
        if ($status != 'approved') {
            echo $this->session->set_flashdata('error', 'Profil UMKM Anda belum diverifikasi. Silakan lengkapi profil dan tunggu proses verifikasi.');
        }
    }

    public function index()
    {
        $data['page'] = 'business_verification';
        $user_id = $this->ion_auth->user()->row()->id;
        $data['profile'] = $this->business_verification_model->get_by_user_id($user_id);

        if ($data['profile']) {
            $this->load->view('business_verification/business_verification_view', $data);
        } else {
            $this->load->view('business_verification/business_verification_form', $data);
        }
    }

    public function edit()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $data['profile'] = $this->business_verification_model->get_by_user_id($user_id);

        $this->load->view('business_verification/business_verification_form', $data);
    }

    public function save()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $existing = $this->business_verification_model->get_by_user_id($user_id);

        $data = [
            'user_id' => $user_id,
            'name' => $this->input->post('name'),
            'nib' => $this->input->post('nib'),
            'npwp' => $this->input->post('npwp'),
            'monthly_income' => $this->input->post('monthly_income'),
            'worker' => $this->input->post('worker'),
            'long_time' => date('Y-m-d', strtotime($this->input->post('long_time'))),
            'status' => 'submitted',
            'rejected_reason' => null,
            'verified_by' => null,
            'verified_at' => null,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),

        ];

        if ($existing) {
            $this->business_verification_model->update($existing->business_verification_id, $data);
        } else {
            $data['user_id'] = $user_id;
            $this->business_verification_model->insert($data);
        }

        redirect('business_verification');
    }

}