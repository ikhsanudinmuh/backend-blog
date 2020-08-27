<?php

class Post_model extends CI_Model
{

    public function getActivePost($id = '')
    {
        $this->db->select('post.post_id, post.title, post.content, post.img, post.status, post.slug, category.cat_name, post.date, admin.full_name')
            ->from('post')
            ->join('category', 'post.cat_id = category.id', 'left')
            ->join('admin', 'post.username = admin.username', 'inner')
            ->where(['status' => 'active'])
            ->order_by('date', 'desc');

        if ($id == null) {
            return $this->db->get()->result_array();
        } else {
            $this->db->where(['post.post_id' => $id]);
            return $this->db->get()->result_array();
        }
    }


    public function getNonActivePost($id = '')
    {
        $this->db->select('post.post_id, post.title, post.content, post.img, post.status, post.slug, category.cat_name, post.date, admin.full_name')
            ->from('post')
            ->join('category', 'post.cat_id = category.id', 'left')
            ->join('admin', 'post.username = admin.username', 'inner')
            ->where(['status' => 'nonactive'])
            ->order_by('date', 'desc');

        if ($id == null) {
            return $this->db->get()->result_array();
        } else {
            $this->db->where(['post.post_id' => $id]);
            return $this->db->get()->result_array();
        }
    }

    public function getPostById($id)
    {
        $this->db->select('*')
            ->from('post')
            ->where(['post.post_id' => $id]);
        return $this->db->get()->result_array();
    }

    public function getPostBySlug($slug)
    {
        $this->db->select('post.post_id, post.title, post.content, post.img, post.status, post.slug, category.cat_name, post.date, admin.full_name')
            ->from('post')
            ->join('category', 'post.cat_id = category.id', 'left')
            ->join('admin', 'post.username = admin.username', 'inner')
            ->where(['post.slug' => $slug]);
        return $this->db->get()->result_array();
    }

    public function getPreviousPost($date)
    {
        $this->db->select('post.post_id, post.title, post.content, post.img, post.status, post.slug, category.cat_name, post.date, admin.full_name')
            ->from('post')
            ->join('category', 'post.cat_id = category.id', 'left')
            ->join('admin', 'post.username = admin.username', 'inner')
            ->where(['post.date <' => $date, 'status' => 'active'])
            ->order_by('date', 'desc')
            ->limit(1);
        return $this->db->get()->result_array();
    }

    public function getNextPost($date)
    {
        $this->db->select('post.post_id, post.title, post.content, post.img, post.status, post.slug, category.cat_name, post.date, admin.full_name')
            ->from('post')
            ->join('category', 'post.cat_id = category.id', 'left')
            ->join('admin', 'post.username = admin.username', 'inner')
            ->where(['post.date >' => $date, 'status' => 'active'])
            ->order_by('date', 'desc')
            ->limit(1);
        return $this->db->get()->result_array();
    }

    public function getRecentPost()
    {
        $this->db->select('post.slug, post.title');
        $this->db->from('post');
        $this->db->join('category', 'post.cat_id = category.id', 'left');
        $this->db->join('admin', 'post.username = admin.username', 'inner');
        $this->db->where(['status' => 'active']);
        $this->db->order_by('date', 'DESC');
        $this->db->limit(5);

        return $this->db->get()->result_array();
    }

    public function insertPost($data)
    {
        $this->db->insert('post', $data);
        return $this->db->affected_Rows();
    }

    public function editPost($data, $id)
    {
        $this->db->update('post', $data, ['post_id' => $id]);
        return $this->db->affected_Rows();
    }

    public function tempdelPost($id)
    {
        $this->db->update('post', ['status' => 'nonactive'], ['post_id' => $id]);
        return $this->db->affected_Rows();
    }

    public function restorePost($id)
    {
        $this->db->update('post', ['status' => 'active'], ['post_id' => $id]);
        return $this->db->affected_Rows();
    }

    public function deletePost($id)
    {
        $this->db->delete('post', ['post_id' => $id]);
        return $this->db->affected_Rows();
    }
}
