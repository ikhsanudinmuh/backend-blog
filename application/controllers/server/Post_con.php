<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Post_con extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('server/Post_model', 'post');
    }

    public function index_get()
    {
        $post = $this->post->getActivePost();

        if ($post) {
            $this->response([
                'status' => true,
                'data' => $post
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ], 200);
        }
    }

    public function previous_get()
    {
        $slug = $this->get('slug');
        $post = $this->post->getPostBySlug($slug);
        $date = $post[0]['date'];
        $previous = $this->post->getPreviousPost($date);

        if ($previous) {
            $this->response([
                'status' => true,
                'data' => $previous
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ], 200);
        }
    }

    public function next_get()
    {
        $slug = $this->get('slug');
        $post = $this->post->getPostBySlug($slug);
        $date = $post[0]['date'];
        $next = $this->post->getNextPost($date);

        if ($next) {
            $this->response([
                'status' => true,
                'data' => $next
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ], 200);
        }
    }

    public function detail_get()
    {
        $slug = $this->get('slug');
        $post = $this->post->getPostBySlug($slug);

        if ($post) {
            $this->response([
                'status' => true,
                'data' => $post
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ], 200);
        }
    }

    public function byId_get()
    {
        $id = $this->get('id');
        $post = $this->post->getPostById($id);

        if ($post) {
            $this->response([
                'status' => true,
                'data' => $post
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ], 200);
        }
    }

    public function recent_get()
    {
        $post = $this->post->getRecentPost();

        if ($post) {
            $this->response([
                'status' => true,
                'data' => $post
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ], 200);
        }
    }

    public function nonactive_get()
    {
        $post = $this->post->getNonActivePost();

        if ($post) {
            $this->response([
                'status' => true,
                'data' => $post
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ], 200);
        }
    }

    public function index_post()
    {
        if ($this->post('img') == null) {
            $data = [
                'title' => $this->post('title'),
                'content' => $this->post('content'),
                'cat_id' => $this->post('category'),
                'username' => $this->post('username'),
                'status' => 'active',
                'slug' => $this->post('slug')
            ];
        } else {
            $data = [
                'title' => $this->post('title'),
                'content' => $this->post('content'),
                'img' => $this->post('img'),
                'cat_id' => $this->post('category'),
                'username' => $this->post('username'),
                'status' => 'active',
                'slug' => $this->post('slug')
            ];
        }

        if ($this->post->insertPost($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Postingan berhasil dibuat.'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak berhasil dibuat!'
            ], 200);
        }
    }


    public function index_put()
    {
        $id = $this->put('id');

        $data = [
            'title' => $this->put('title'),
            'content' => $this->put('content'),
            'cat_id' => $this->put('category'),
            'slug' => $this->put('slug')
        ];

        if ($id == null) {
            $this->response([
                'status' => false,
                'message' => 'Masukkan id postingan!'
            ], 200);
        } else {
            if ($this->post->editPost($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Postingan berhasil diedit.'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Id postingan tidak ditemukan!'
                ], 200);
            }
        }
    }

    public function withPhoto_put()
    {
        $id = $this->put('id');

        $data = [
            'title' => $this->put('title'),
            'content' => $this->put('content'),
            'img' => $this->put('img'),
            'cat_id' => $this->put('category'),
            'slug' => $this->put('slug')
        ];

        if ($id == null) {
            $this->response([
                'status' => false,
                'message' => 'Masukkan id postingan!'
            ], 200);
        } else {
            if ($this->post->editPost($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Postingan berhasil diedit.'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Id postingan tidak ditemukan!'
                ], 200);
            }
        }
    }

    public function tempdel_put()
    {
        $id = $this->put('id');

        if ($id == null) {
            $this->response([
                'status' => false,
                'message' => 'Masukkan id postingan!'
            ], 200);
        } else {
            if ($this->post->tempdelPost($id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Postingan berhasil dipindahkan ke recycle bin.'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id postingan tidak ditemukan!'
                ], 200);
            }
        }
    }

    public function restore_put()
    {
        $id = $this->put('id');

        if ($id == null) {
            $this->response([
                'status' => false,
                'message' => 'Masukkan id postingan!'
            ], 200);
        } else {
            if ($this->post->restorePost($id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Postingan berhasil dipulihkan.'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id postingan tidak ditemukan!'
                ], 200);
            }
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id == null) {
            $this->response([
                'status' => false,
                'message' => 'Masukkan id postingan!'
            ], 200);
        } else {
            if ($this->post->deletePost($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Postingan berhasil dihapus.'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id postingan tidak ditemukan!'
                ], 200);
            }
        }
    }
}
