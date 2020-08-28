<?php
    class Matkul_model extends CI_Model
    {
        public function getMatkul($id = '')
        {
            if ($id == NULL) {
                return $this->db->get('matkul')->result_array();
            } else {
                return $this->db->get_where('matkul', ['id' => $id])->result_array();
            }
        }

        public function insertMatkul($data)
        {
            $this->db->insert('matkul', $data);
            return $this->db->affected_Rows();
        }

        public function editMatkul($data, $id)
        {
            return $this->db->update('matkul', $data, ['id' => $id]);
        }

        public function deleteMatkul($id)
        {
            $this->db->delete('matkul', ['id' => $id]);
            return $this->db->affected_Rows();
        }
    }
