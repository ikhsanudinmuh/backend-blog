<?php
class Comment_model extends CI_Model
{
    public function getComment($id = '')
    {
        $this->db->select('comment.id, comment.post_id, comment.content, comment.name, comment.date')
            ->from('comment')
            ->join('post', 'comment.post_id = post.post_id', 'left')
            ->order_by('date', 'desc');

        if ($id == null) {
            return $this->db->get()->result_array();
        } else {
            $this->db->where(['comment.post_id' => $id]);
            return $this->db->get()->result_array();
        }
    }

    public function insertComment($data)
    {
        $this->db->insert('comment', $data);
        return $this->db->affected_Rows();
    }

    public function deleteComment($id)
    {
        $this->db->delete('comment', ['id' => $id]);
        return $this->db->affected_Rows();
    }
}
