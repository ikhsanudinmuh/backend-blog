<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Category_con extends RestController
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('server/Category_model', 'category');
        }

        public function index_get()
        {
            $id = $this->get('id');

            if ($id == null) {
                $category = $this->category->getCategory();
            } else {
                $category = $this->category->getCategory($id);
            }

            if ($category) {
                $this->response([
                    'status' => true,
                    'data' => $category
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Kategori tidak ditemukan!'
                ]);
            }
        }

        public function index_post()
        {
            $data = [
                'cat_name' => $this->post('name')
            ];

            if ($this->category->insertCategory($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Kategori berhasil ditambahkan.'
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Id kategori tidak ditemukan!'
                ]);
            }
        }

        public function index_put()
        {
            $id = $this->put('id');
            $data = [
                'cat_name' => $this->put('name')
            ];

            if ($id == NULL) {
                $this->response([
                    'status' => false,
                    'message' => 'Masukkan id kategori!'
                ]);
            } else {
                if ($this->category->editCategory($data, $id) > 0) {
                    $this->response([
                        'status' => true,
                        'message' => 'Kategori berhasil diedit.'
                    ]);
                } else {
                    $this->response( [
                        'status' => false,
                        'message' => 'Id kategori tidak ditemukan!'
                    ]);
                }
            }
        }

        public function index_delete()
        {
            $id = $this->delete('id');

            if ($id == null) {
                $this->response( [
                    'status' => false,
                    'message' => 'Masukkan id kategori!'
                ]);
            } else {
                if ($this->category->deleteCategory($id) > 0) {
                    $this->response( [
                        'status' => true,
                        'id' => $id,
                        'message' => 'Kategori berhasil dihapus.'
                    ]);
                } else {
                    $this->response( [
                        'status' => false,
                        'message' => 'Id kategori tidak ditemukan!'
                    ]);
                }
            }
        }
    }
?>