<?php
    class Login_model extends CI_Model
    {
        public function cekLogin($where)
        {
            return $this->db->get_where('admin', $where)->num_rows();
        }

        public function dataLogin($where)
        {
            $this->db->select('username, full_name');
            return $this->db->get_where('admin', $where)->result_array();
        }

    }
