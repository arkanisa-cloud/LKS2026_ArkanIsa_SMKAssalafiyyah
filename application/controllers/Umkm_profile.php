<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umkm_profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('applicant')) {
            redirect('auth/login');
        }
        $this->load->model('/umkm_profile_model');
    }

    public function index()
    {
        $data['page'] = 'umkm';
        $user_id = $this->ion_auth->user()->row()->id;
        $data['profile'] = $this->umkm_profile_model->get_by_user_id($user_id);

        if ($data['profile']) {
            $this->load->view('umkm/umkm_view', $data);
        } else {
            $this->load->view('umkm/umkm_form', $data);
        }
    }

    public function edit()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $data['profile'] = $this->umkm_profile_model->get_by_user_id($user_id);

        $this->load->view('umkm/umkm_form', $data);
    }

    public function save()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $existing = $this->umkm_profile_model->get_by_user_id($user_id);

        $data = [
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'nib' => $this->input->post('nib'),
            'npwp' => $this->input->post('npwp'),
            'monthly_income' => $this->input->post('monthly_income'),
            'worker' => $this->input->post('worker'),
            'long_time' => date('Y-m-d', strtotime($this->input->post('long_time')))
        ];

        if ($existing) {
            $this->umkm_profile_model->update($existing->umkm_profile_id, $data);
        } else {
            $data['user_id'] = $user_id;
            $this->umkm_profile_model->insert($data);
        }

        redirect('umkm_profile');
    }

}