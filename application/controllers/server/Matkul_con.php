<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use chriskacerguis\RestServer\RestController;

    class Matkul_con extends RestController
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('server/Matkul_model', 'matkul');
        }

        public function index_get()
        {   
            $id = $this->get('id');

            if ($id == NULL) {
                $matkul = $this->matkul->getMatkul();
            } else {
                $matkul = $this->matkul->getMatkul($id);
            }

            if ($matkul) {
                $this->response([
                    'status' => true,
                    'data' => $matkul
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Mata kuliah tidak ditemukan!'
                ]);
            }
        }

        public function index_post()
        {
            $data = [
                'username' => $this->post('username'),
                'code' => $this->post('code'),
                'name' => $this->post('name'),
                'year' => $this->post('year')
            ];

            if ($this->matkul->insertMatkul($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Mata kuliah berhasil ditambahkan.'
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Mata kuliah tidak berhasil ditambahkan!'
                ]);
            }
        }

        public function index_put()
        {
            $id = $this->put('id');
            $data = [
                'code' => $this->put('code'),
                'name' => $this->put('name'),
                'year' => $this->put('year')
            ];

            if ($id == NULL) {
                $this->response([
                    'status' => false,
                    'message' => 'Masukkan id mata kuliah'
                ]);
            } else {
                if ($this->matkul->editMatkul($data, $id) > 0) {
                    $this->response([
                        'status' => true,
                        'message' => 'Mata kuliah berhasil diedit.'
                    ]);
                } else {
                    $this->response( [
                        'status' => false,
                        'message' => 'Id mata kuliah tidak ditemukan!'
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
                    'message' => 'Masukkan id mata kuliah!'
                ]);
            } else {
                if ($this->matkul->deleteMatkul($id) > 0) {
                    $this->response( [
                        'status' => true,
                        'id' => $id,
                        'message' => 'Mata kuliah berhasil dihapus.'
                    ]);
                } else {
                    $this->response( [
                        'status' => false,
                        'message' => 'Id mata kuliah tidak ditemukan!'
                    ]);
                }
            }
        }
    }
?>