<?php
    class Profile_model extends CI_Model
    {
        public function getProfile()
        {
            return $this->db->get('admin')->result_array();
        }

        public function editProfile($data, $username)
        {
            $this->db->update('admin', $data, ['username' => $username]);
            return $this->db->affected_Rows();
        }

        public function changePass($data, $username)
        {
            $this->db->update('admin', $data, ['username' => $username]);
            return $this->db->affected_Rows();
        }
    }
?>