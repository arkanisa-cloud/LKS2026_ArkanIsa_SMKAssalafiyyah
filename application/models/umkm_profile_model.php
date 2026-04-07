<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class umkm_profile_model extends CI_Model
{
    public function get_by_user_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->get('umkm_profiles')->row();
    }

    public function insert($data)
    {
        return $this->db->insert('umkm_profiles', $data);
    }

    public function update($umkm_profile_id, $data)
    {
        $this->db->where('umkm_profile_id', $umkm_profile_id);
        return $this->db->update('umkm_profiles', $data);
    }

    public function delete($umkm_profile_id)
    {
        $this->db->where('umkm_profile_id', $umkm_profile_id);
        return $this->db->delete('umkm_profiles');
    }
}