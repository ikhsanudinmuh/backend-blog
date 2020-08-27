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
            ]);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ]);
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
            ]);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ]);
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
            ]);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ]);
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
            ]);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ]);
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
            ]);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ]);
        }
    }

    public function recent_get()
    {
        $post = $this->post->getRecentPost();

        if ($post) {
            $this->response([
                'status' => true,
                'data' => $post
            ]);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ]);
        }
    }

    public function nonactive_get()
    {
        $post = $this->post->getNonActivePost();

        if ($post) {
            $this->response([
                'status' => true,
                'data' => $post
            ]);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak ditemukan!'
            ]);
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
            ]);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Postingan tidak berhasil dibuat!'
            ]);
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
            ]);
        } else {
            if ($this->post->editPost($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Postingan berhasil diedit.'
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Id postingan tidak ditemukan!'
                ]);
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
            ]);
        } else {
            if ($this->post->editPost($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Postingan berhasil diedit.'
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Id postingan tidak ditemukan!'
                ]);
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
            ]);
        } else {
            if ($this->post->tempdelPost($id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Postingan berhasil dipindahkan ke recycle bin.'
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id postingan tidak ditemukan!'
                ]);
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
            ]);
        } else {
            if ($this->post->restorePost($id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Postingan berhasil dipulihkan.'
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id postingan tidak ditemukan!'
                ]);
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
            ]);
        } else {
            if ($this->post->deletePost($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Postingan berhasil dihapus.'
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id postingan tidak ditemukan!'
                ]);
            }
        }
    }
}
