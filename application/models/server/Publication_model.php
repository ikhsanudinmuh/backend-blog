<?php 

    class Publication_model extends CI_Model
    {
        public function getPublication($id = '')
        {
            if ($id == null) {
                return $this->db->get('publication')->result_array();
            } else {
                return $this->db->get_where('publication', ['id' => $id])->result_array();
            }
        }

        public function insertPublication($data)
        {
            $this->db->insert('publication', $data);
            return $this->db->affected_Rows();
        }

        public function editPublication($data, $id)
        {
            $this->db->update('publication', $data, ['id' => $id]);
            return $this->db->affected_Rows();
        }

        public function deletePublication($id)
        {
            $this->db->delete('publication', ['id' => $id]);
            return $this->db->affected_Rows();
        }
    }
?>