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
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Publikasi belum ada!'
                ]);
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
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Publikasi tidak berhasil ditambahkan!'
                ]);
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
                ]);
            }
            if($this->publication->editPublication($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Publikasi berhasil diedit!'
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Id publikasi tidak ditemukan!'
                ]);
            }
        }



        public function index_delete()
        {
            $id = $this->delete('id');

            if ($id == null) {
                $this->response( [
                    'status' => false,
                    'message' => 'Masukkan id mata kuliah!'
                ]);
            } else {
                if ($this->publication->deletePublication($id) > 0) {
                    $this->response([
                        'status' => true,
                        'message' => 'Publikasi berhasil dihapus!'
                    ]);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Id publikasi tidak ditemukan!'
                    ]);
                }
            }
            
        }
    }
?>