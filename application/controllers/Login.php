<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model', 'login');
    }

    public function index()
    {
        $data['title'] = 'Login Form';
        $this->load->view('template/header', $data);
        $this->load->view('login');
        $this->load->view('template/footer');
    }

    public function login()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $where = [
            'username' => $username,
            'password' => md5($password)
        ];

        if ($this->login->cekLogin($where) > 0) {
            $data = $this->login->dataLogin($where);
            $data_session = [
                'username' => $data[0]['username'],
                'status' => 'login'
            ];
            $this->session->set_userdata($data_session);
            echo "<script>
                window.location.href='" . base_url() . "'
                </script>";
        } else {
            echo "<script>
                alert('Username atau password yang anda masukkan salah!')
                window.location.href='" . base_url('login') . "'
                </script>";
        }
    }

    public function logout()
    {
        echo "<script>
            alert('Berhasil logout.')
            window.location.href='" . base_url('login') . "'
            </script>";
        $this->session->sess_destroy();
    }
}
