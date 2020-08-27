<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class About extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('About_model', 'about');
        }
        
        public function index()
        {
            $data['title'] = 'About';
            $data['profile'] = $this->about->getProfile();

            $this->load->view('template/header', $data);
            $this->load->view('about/index', $data);
            $this->load->view('template/footer');
        }

        public function upload_config()
        {
            if ($this->session->userdata('status') != 'login') {
                redirect(base_url('login'));
            };

            $mb = 1000;
            $config['upload_path']          = FCPATH. 'assets/img';
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 10 * $mb;
            $config['max_width']            = 1024;
            $config['max_height']           = 1024;
            $config['encrypt_name']			= true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
        }

        public function edit()
        {
            if ($this->session->userdata('status') != 'login') {
                redirect(base_url('login'));
            };

            $data['title'] = 'Edit Profile';
            $data['profile'] = $this->about->getProfile();

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('about', 'About');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('telephone', 'Telephone', 'numeric');
            
            if ($this->form_validation->run() == FALSE && isset($data['profile'])) {
                $this->load->view('template/header', $data);
                $this->load->view('about/edit', $data);
                $this->load->view('template/footer');
            } else {
                $this->upload_config();
                if (isset($_FILES['img']['name']) && !empty($_FILES['img']['name'])) {
                    if (!$this->upload->do_upload('img'))
                    {
                        $error = [
                            'error' => $this->upload->display_errors()
                        ];
                        $this->load->view('template/header', $data);
                        $this->load->view('about/edit', $error);
                        $this->load->view('template/footer');
                    } else {
                        $res = $this->about->editProfileWithPhoto();
                        if ($res['status'] == true) {
                            $this->session->set_flashdata('success', $res['message']);
                        } else {
                            $this->session->set_flashdata('failed', $res['message']);
                        }
                        redirect('about');
                    }
                } else {
                    $res = $this->about->editProfile();
                    if ($res['status'] == true) {
                        $this->session->set_flashdata('success', $res['message']);
                    } else {
                        $this->session->set_flashdata('failed', $res['message']);
                    }
                    redirect('about');
                }
            }
        }

        public function change_pass()
        {
            if ($this->session->userdata('status') != 'login') {
                redirect(base_url('login'));
            };

            $data['title'] = 'Change Password';
            $data['profile'] = $this->about->getProfile();

            $this->form_validation->set_rules('oldpass', 'Old Password', 'required');
            $this->form_validation->set_rules('newpass', 'New Password', 'required|min_length[4]');
            $this->form_validation->set_rules('newpassc', 'New Password (confirmation)', 'required|matches[newpass]');
            
            if ($this->form_validation->run() == FALSE && isset($data['profile'])) {
                $this->load->view('template/header', $data);
                $this->load->view('about/change_pass', $data);
                $this->load->view('template/footer');
            } else {
                $res = $this->about->changePass();
                if ($res['status'] == true) {
                    $this->session->set_flashdata('success', $res['message']);
                } else if ($res['message'] == 'Password lama tidak cocok!') {
                    $this->session->set_flashdata('failed', $res['message']);
                    redirect('about/change_pass');
                } else {
                    $this->session->set_flashdata('failed', $res['message']);
                }
                redirect('about');
            }
        }
        
    }
?>  