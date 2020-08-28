<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Mata kuliah tidak ditemukan!'
            ], 200);
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
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Mata kuliah tidak berhasil ditambahkan!'
            ], 200);
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
            ], 200);
        } else {
            if ($this->matkul->editMatkul($data, $id)) {
                $this->response([
                    'status' => true,
                    'message' => 'Mata kuliah berhasil diedit.'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Mata kuliah tidak berhasil diedit!'
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
                'message' => 'Masukkan id mata kuliah!'
            ], 200);
        } else {
            if ($this->matkul->deleteMatkul($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Mata kuliah berhasil dihapus.'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Mata kuliah tidak berhasil dihapus!'
                ], 200);
            }
        }
    }
}
