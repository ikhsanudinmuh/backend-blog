<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Comment_con extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('server/Comment_model', 'comment');
    }

    public function index_get()
    {
        $id = $this->get('post_id');

        if ($id == null) {
            $comment = $this->comment->getComment();
        } else {
            $comment = $this->comment->getComment($id);
        }

        if ($comment) {
            $this->response([
                'status' => true,
                'data' => $comment
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Belum ada komentar!'
            ], 200);
        }
    }

    public function index_post()
    {
        $data = [
            'post_id' => $this->post('post_id'),
            'name' => $this->post('name'),
            'content' => $this->post('content')
        ];

        if ($this->comment->insertComment($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Komentar berhasil ditambahkan.'
            ], 200);
        } else {
            $this->response([
                'status' => true,
                'message' => 'Komentar tidak berhasil ditambahkan'
            ], 200);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($this->comment->deleteComment($id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Komentar berhasil dihapus.'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Komentar tidak berhasil dihapus!'
            ], 200);
        }
    }
}
