<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Publication_con extends RestController 
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('server/Publication_model', 'publication');
        }

        public function index_get()
        {
            $id = $this->get('id');

            if ($id == null) {
                $publication = $this->publication->getPublication();
            } else {
                $publication = $this->publication->getPublication($id);
            }

            if ($publication) {
                $this->response([
                    'status' => true,
                    'data' => $publication
                ],200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Publikasi belum ada!'
                ],200);
            }
        }

        public function index_post()
        {
            $data = [
                'year' => $this->post('year'),
                'title' => $this->post('title'),
                'journal' => $this->post('journal'),
                'link' => $this->post('link'),
                'username' => $this->post('username')
            ];

            if($this->publication->insertPublication($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Publikasi berhasil ditambahkan!'
                ],200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Publikasi tidak berhasil ditambahkan!'
                ],200);
            }
        }

        public function index_put()
        {
            $id = $this->put('id');
            $data = [
                'year' => $this->put('year'),
                'title' => $this->put('title'),
                'journal' => $this->put('journal'),
                'link' => $this->put('link')
            ];

            if ($id == null) {
                $this->response([
                    'status' => false,
                    'message' => 'Masukkan id publikasi!'
                ],200);
            }
            if($this->publication->editPublication($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Publikasi berhasil diedit!'
                ],200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Id publikasi tidak ditemukan!'
                ],200);
            }
        }



        public function index_delete()
        {
            $id = $this->delete('id');

            if ($id == null) {
                $this->response( [
                    'status' => false,
                    'message' => 'Masukkan id mata kuliah!'
                ],200);
            } else {
                if ($this->publication->deletePublication($id) > 0) {
                    $this->response([
                        'status' => true,
                        'message' => 'Publikasi berhasil dihapus!'
                    ],200);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Id publikasi tidak ditemukan!'
                    ],200);
                }
            }
            
        }
    }
