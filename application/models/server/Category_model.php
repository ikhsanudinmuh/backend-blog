<?php
    class Category_model extends CI_Model
    {
        public function getCategory($id = '')
        {
            if ($id == NULL) {
                return $this->db->get('category')->result_array();
            } else {
                return $this->db->get_where('category', ['id' => $id])->result_array();
            }
        }

        public function insertCategory($data)
        {
            $this->db->insert('category', $data);
            return $this->db->affected_Rows();
        }

        public function editCategory($data, $id)
        {
            $this->db->update('category', $data, ['id' => $id]);
            return $this->db->affected_Rows();
        }

        public function deleteCategory($id)
        {
            $this->db->delete('category', ['id' => $id]);
            return $this->db->affected_Rows();
        }
    }
?>