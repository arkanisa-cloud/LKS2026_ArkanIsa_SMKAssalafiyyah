<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class loan_model extends CI_Model
{
    public function get_by_umkm($umkm_profile_id)
    {
        $this->db->where('umkm_profile_id', $umkm_profile_id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('loans')->result();
    }

    public function get_by_id($loan_id)
    {
        $this->db->where('loan_id', $loan_id);
        return $this->db->get('loans')->row();
    }

    public function get_by_status($status)
    {
        $this->db->select('loans.*, umkm_profiles.name, umkm_profiles.nib, umkm_profiles.npwp, umkm_profiles.monthly_income');
        $this->db->from('loans');
        $this->db->join('umkm_profiles', 'umkm_profiles.umkm_profile_id = loans.umkm_profile_id');
        $this->db->where('loans.status', $status);
        $this->db->order_by('loans.created_at', 'ASC');

        return $this->db->get()->result();
    }

    public function insert($data)
    {
        return $this->db->insert('loans', $data);
    }

    public function update($loan_id, $data)
    {
        $this->db->where('loan_id', $loan_id);
        return $this->db->update('loans', $data);
    }

    public function delete($loan_id)
    {
        $this->db->where('loan_id', $loan_id);
        return $this->db->delete('loans');
    }
}