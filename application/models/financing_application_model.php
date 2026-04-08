<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class financing_application_model extends CI_Model
{
    public function get_by_business_verification($business_verification_id)
    {
        $this->db->where('business_verification_id', $business_verification_id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('financing_applications')->result();
    }

    public function get_by_id($financing_application_id)
    {
        $this->db->where('financing_application_id', $financing_application_id);
        return $this->db->get('financing_applications')->row();
    }

    public function get_by_status($status)
    {
        $this->db->select('financing_applications.*, business_verifications.name, business_verifications.nib, business_verifications.npwp, business_verifications.monthly_income');
        $this->db->from('financing_applications');
        $this->db->join('business_verifications', 'business_verifications.business_verification_id = financing_applications.business_verification_id');
        $this->db->where('financing_applications.status', $status);
        $this->db->order_by('financing_applications.created_at', 'ASC');

        return $this->db->get()->result();
    }

    public function insert($data)
    {
        return $this->db->insert('financing_applications', $data);
    }

    public function update($financing_application_id, $data)
    {
        $this->db->where('financing_application_id', $financing_application_id);
        return $this->db->update('financing_applications', $data);
    }

    public function delete($financing_application_id)
    {
        $this->db->where('financing_application_id', $financing_application_id);
        return $this->db->delete('financing_applications');
    }
}