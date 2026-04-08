<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business_verification_model extends CI_Model
{
    public function get_by_user_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->get('business_verifications')->row();
    }

    public function get_status_by_user_id($user_id)
    {
        $this->db->select('status');
        $this->db->where('user_id', $user_id);
        $result = $this->db->get('business_verifications')->row();
        return $result ? $result->status : null;
    }

    public function get_all_submitted()
    {
        $this->db->where('status', 'submitted');
        return $this->db->get('business_verifications')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('business_verifications', $data);
    }

    public function update($business_verification_id, $data)
    {
        $this->db->where('business_verification_id', $business_verification_id);
        return $this->db->update('business_verifications', $data);
    }

    public function update_status($business_verification_id, $status)
    {
        $this->db->where('business_verification_id', $business_verification_id);
        return $this->db->update('business_verifications', ['status' => $status]);
    }

    public function delete($business_verification_id)
    {
        $this->db->where('business_verification_id', $business_verification_id);
        return $this->db->delete('business_verifications');
    }
}