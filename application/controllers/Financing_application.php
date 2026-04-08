<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Financing_application extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('applicant')) {
            redirect('auth/login');
        }

        $this->load->model('business_verification_model');
        $this->load->model('financing_application_model');

        $status = $this->business_verification_model->get_status_by_user_id($this->ion_auth->user()->row()->id);
        if ($status != 'verified') {
            echo $this->session->set_flashdata('error', 'Profil UMKM Anda belum diverifikasi. Silakan lengkapi profil dan tunggu proses verifikasi.');
            redirect('business_verification');
        }

    }


    public function index()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $profile = $this->business_verification_model->get_by_user_id($user_id);

        if (!$profile) {
            redirect('business_verification');
        }

        $data['page'] = 'financing_application';
        $data['profile'] = $profile;
        $data['financing_applications'] = $this->financing_application_model->get_by_business_verification($profile->business_verification_id);
        $data['amount'] = $profile->monthly_income;
        $data['max_amount'] = $profile->monthly_income * 3;

        $this->load->view('financing_application/financing_application_view', $data);
    }

    public function save()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $profile = $this->business_verification_model->get_by_user_id($user_id);

        $amount = $this->input->post('amount');
        $max_amount = $profile->monthly_income * 3;


        if ($amount > $max_amount) {
            $this->session->set_flashdata('error', 'Gagal!, Nominal melebihi batas maksimal');
            redirect('financing_application');
            return;
        }

        $data = [
            'user_id' => $user_id,
            'business_verification_id' => $profile->business_verification_id,
            'amount' => $amount,
            'months' => $this->input->post('months'),
            'purpose' => $this->input->post('purpose'),
            'status' => 'submitted',
            'created_at' => date('Y-m-d'),
            'submitted_at' => date('Y-m-d'),
        ];

        if ($this->financing_application_model->insert($data)) {
            $this->session->set_flashdata('Success', 'Berhasil mengajukan pinjaman');
        } else {
            $this->session->set_flashdata('Error', 'Gagal mengajukan pinjaman');
        }

        redirect('financing_application');
    }

    public function edit($financing_application_id)
    {
        $data = [
            'amount' => $this->input->post('amount'),
            'months' => $this->input->post('months'),
            'purpose' => $this->input->post('purpose'),
            'updated_at' => date('Y-m-d'),
            'status' => 'submitted',
            'submitted_at' => date('Y-m-d'),
        ];

        if ($this->financing_application_model->update($financing_application_id, $data)) {
            $this->session->set_flashdata('Success', 'Berhasil mengedit pinjaman');
        } else {
            $this->session->set_flashdata('Error', 'Gagal mengedit pinjaman');
        }

        redirect('financing_application');
    }

    public function delete($financing_application_id)
    {
        if ($this->financing_application_model->delete($financing_application_id)) {
            $this->session->set_flashdata('Success', 'Berhasil menghapus pinjaman');
        } else {
            $this->session->set_flashdata('Error', 'Gagal menghapus pinjaman');
        }

        redirect('financing_application');
    }

    public function detail($financing_application_id)
    {
        $data['page'] = 'financing_application';
        $data['application'] = $this->financing_application_model->get_by_id($financing_application_id);

        if (!$data['application']) {
            redirect('financing_application');
        }

        $this->load->view('financing_application/financing_application_detail_view', $data);
    }
}