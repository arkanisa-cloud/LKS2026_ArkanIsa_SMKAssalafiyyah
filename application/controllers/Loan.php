<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('applicant')) {
            redirect('auth/login');
        }

        $this->load->model('umkm_profile_model');
        $this->load->model('loan_model');
    }

    public function index()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $profile = $this->umkm_profile_model->get_by_user_id($user_id);

        if (!$profile) {
            redirect('umkm_profile');
        }

        $data['page'] = 'loan';
        $data['profile'] = $profile;
        $data['loans'] = $this->loan_model->get_by_umkm($profile->umkm_profile_id);
        $data['max_amount'] = $profile->monthly_income * 3;

        $this->load->view('loan/loan_view', $data);
    }

    public function save()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $profile = $this->umkm_profile_model->get_by_user_id($user_id);

        $amount = $this->input->post('amount');
        $max_amount = $profile->monthly_income * 3;

        if ($amount > $max_amount) {
            $this->session->set_flashdata('error', 'Gagal!, Nominal melebihi batas maksimal');
        }

        $data = [
            'umkm_profile_id' => $profile->umkm_profile_id,
            'amount' => $amount,
            'months' => $this->input->post('months'),
            'status' => 'submitted',
            'created_at' => date('Y-m-d')
        ];

        if ($this->loan_model->insert($data)) {
            $this->session->set_flashdata('Success', 'Berhasil mengajukan pinjaman');
        } else {
            $this->session->set_flashdata('Error', 'Gagal mengajukan pinjaman');
        }

        redirect('loan');
    }

    public function delete($loan_id)
    {
        if ($this->loan_model->delete($loan_id)) {
            $this->session->set_flashdata('Success', 'Berhasil menghapus pinjaman');
        } else {
            $this->session->set_flashdata('Error', 'Gagal menghapus pinjaman');
        }

        redirect('loan');
    }
}