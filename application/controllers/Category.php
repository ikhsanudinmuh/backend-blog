<?php
class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model', 'category');
    }

    public function index()
    {
        $data['title'] = 'Category';
        $data['category'] = $this->category->getAllCategory();
        $this->load->view('template/header', $data);
        $this->load->view('category/index', $data);
        $this->load->view('template/footer');
    }

    public function input()
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $data['title'] = 'Input Category';

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('category/input');
            $this->load->view('template/footer');
        } else {
            $res = $this->category->inputCategory();
            if ($res['status'] == true) {
                $this->session->set_flashdata('success', $res['message']);
            } else {
                $this->session->set_flashdata('failed', $res['message']);
            }
            redirect('category');
        }
    }

    public function edit($id)
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $data['title'] = 'Edit Category';
        $data['category'] = $this->category->getCategoryById($id);

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE && isset($data['category'])) {
            $this->load->view('template/header', $data);
            $this->load->view('category/edit', $data);
            $this->load->view('template/footer');
        } else {
            $res = $this->category->editCategory($id);
            if ($res['status'] == true) {
                $this->session->set_flashdata('success', $res['message']);
            } else {
                $this->session->set_flashdata('failed', $res['message']);
            }
            redirect('category');
        }
    }

    public function delete($id)
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $res = $this->category->deleteCategory($id);
        if ($res['status'] == true) {
            $this->session->set_flashdata('success', $res['message']);
        } else {
            $this->session->set_flashdata('failed', $res['message']);
        }
        redirect('category');
    }
}
