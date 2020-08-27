<?php
    class Course extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Course_model', 'course');
        }

        public function index()
        {
            $data['title'] = 'Course';
            $data['course'] = $this->course->getAllCourse();
            $this->load->view('template/header', $data);
            $this->load->view('course/index', $data);
            $this->load->view('template/footer');
        }

        public function input()
        {
            if ($this->session->userdata('status') != 'login') {
                redirect(base_url('login'));
            };

            $data['title'] = 'Input Course';

            $this->form_validation->set_rules('code', 'Code', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('course/input');
                $this->load->view('template/footer');
            } else {
                $res = $this->course->inputCourse();
                if ($res['status'] == true) {
                    $this->session->set_flashdata('success', $res['message']);
                } else {
                    $this->session->set_flashdata('failed', $res['message']);
                }
                redirect('course');
            }
        }

        public function edit($id)
        {
            if ($this->session->userdata('status') != 'login') {
                redirect(base_url('login'));
            };

            $data['title'] = 'Edit Course';
            $data['course'] = $this->course->getCourseById($id);
            
            $this->form_validation->set_rules('code', 'Code', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');

            if ($this->form_validation->run() == FALSE && isset($data['course'])) {
                $this->load->view('template/header', $data);
                $this->load->view('course/edit', $data);
                $this->load->view('template/footer');
            } else {
                $res = $this->course->editCourse($id);
                if ($res['status'] == true) {
                    $this->session->set_flashdata('success', $res['message']);
                } else {
                    $this->session->set_flashdata('failed', $res['message']);
                }
                redirect('course');
            }
        }

        public function delete($id)
        {
            if ($this->session->userdata('status') != 'login') {
                redirect(base_url('login'));
            };

            $res = $this->course->deleteCourse($id);
            if ($res['status'] == true) {
                $this->session->set_flashdata('success', $res['message']);
            } else {
                $this->session->set_flashdata('failed', $res['message']);
            }
            redirect('course');
        }
    }
?>