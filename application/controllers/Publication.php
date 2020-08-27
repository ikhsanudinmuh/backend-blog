<?php
    class Publication extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Publication_model', 'publication');
        }

        public function index()
        {
            $data['title'] = 'Publication';
            $data['publication'] = $this->publication->getAllPublication();
            
            $this->load->view('template/header', $data);
            $this->load->view('publication/index', $data);
            $this->load->view('template/footer');
        }
        
        public function input()
        {
            if ($this->session->userdata('status') != 'login') {
                redirect(base_url('login'));
            };

            $data['title'] = 'Input Publication';

            $this->form_validation->set_rules('year', 'Year', 'required|numeric');
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('journal', 'Journal', 'required');
            $this->form_validation->set_rules('link', 'Link', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('publication/input');
                $this->load->view('template/footer');
            } else {
                $res = $this->publication->inputPublication();
                if ($res['status'] == true) {
                    $this->session->set_flashdata('success', $res['message']);
                } else {
                    $this->session->set_flashdata('failed', $res['message']);
                }
                redirect('publication');
            }
            
        }

        public function edit($id)
        {
            if ($this->session->userdata('status') != 'login') {
                redirect(base_url('login'));
            };

            $data['title'] = 'Edit Publication';
            $data['publication'] = $this->publication->getPublicationById($id);

            $this->form_validation->set_rules('year', 'Year', 'required|numeric');
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('journal', 'Journal', 'required');
            $this->form_validation->set_rules('link', 'Link', 'required');

            if ($this->form_validation->run() == FALSE && isset($data['publication'])) {
                $this->load->view('template/header', $data);
                $this->load->view('publication/edit', $data);
                $this->load->view('template/footer');
            } else {
                $res = $this->publication->editPublication($id);
                if ($res['status'] == true) {
                    $this->session->set_flashdata('success', $res['message']);
                } else {
                    $this->session->set_flashdata('failed', $res['message']);
                }
                redirect('publication');
            }
        }

        public function delete($id)
        {
            if ($this->session->userdata('status') != 'login') {
                redirect(base_url('login'));
            };

            $res = $this->publication->deletePublication($id);
            if ($res['status'] == true) {
                $this->session->set_flashdata('success', $res['message']);
            } else {
                $this->session->set_flashdata('failed', $res['message']);
            }
            redirect('publication');
        }

    }

?>