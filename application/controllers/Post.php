<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Post_model', 'post');
        $this->load->model('Category_model', 'category');
    }

    public function index()
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $data['title'] = 'Post';
        $data['post'] = $this->post->getActivePost();

        $this->load->view('template/header', $data);
        $this->load->view('post/index', $data);
        $this->load->view('template/footer');
    }


    public function recycle_bin()
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $data['title'] = 'Recycle Bin';
        $data['post'] = $this->post->getNonActivePost();

        $this->load->view('template/header', $data);
        $this->load->view('post/recyclebin', $data);
        $this->load->view('template/footer');
    }

    public function detail($slug)
    {
        $data['post'] = $this->post->getPostBySlug($slug);
        $data['previous'] = $this->post->getPreviousPost($slug);
        $data['next'] = $this->post->getNextPost($slug);
        $data['title'] = $data['post']['title'];
        $data['comment'] = $this->post->getComment($data['post']['post_id']);

        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('content', 'Comment', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('post/detail', $data);
            $this->load->view('comment/index', $data);
            $this->load->view('comment/input', $data);
            $this->load->view('template/footer');
        } else {
            $res = $this->post->insertComment();
            if ($res['status'] == true) {
                $this->session->set_flashdata('success', $res['message']);
            } else {
                $this->session->set_flashdata('failed', $res['message']);
            }
            redirect('post/detail/' . $slug);
        }
    }

    public function category($category)
    {
        $data['title'] = 'Category: ' . $category;
        $data['category'] = $category;
        $data['post'] = $this->post->getPostByCategory($category);

        $this->load->view('template/header', $data);
        $this->load->view('post/category', $data);
        $this->load->view('template/footer');
    }

    public function upload_config()
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $mb = 1000;
        $config['upload_path']          = FCPATH . 'assets/img';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 10 * $mb;
        $config['max_width']            = 1920;
        $config['max_height']           = 1080;
        $config['encrypt_name']            = true;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
    }

    public function create()
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $data['title'] = 'Create Post';
        $data['category'] = $this->category->getAllCategory();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('post/input', $data);
            $this->load->view('template/footer');
        } else {
            $this->upload_config();
            if (!empty($_FILES['thumbnail']['name'])) {
                if (!$this->upload->do_upload('thumbnail')) {
                    $error = [
                        'error' => $this->upload->display_errors()
                    ];
                    $this->load->view('template/header', $data);
                    $this->load->view('post/input', $error);
                    $this->load->view('template/footer');
                } else {
                    $res = $this->post->createPost();
                    if ($res['status'] == true) {
                        $this->session->set_flashdata('success', $res['message']);
                    } else {
                        $this->session->set_flashdata('failed', $res['message']);
                    }
                    redirect('post');
                }
            } else {
                $res = $this->post->createPost();
                if ($res['status'] == true) {
                    $this->session->set_flashdata('success', $res['message']);
                } else {
                    $this->session->set_flashdata('failed', $res['message']);
                }
                redirect('post');
            }
        }
    }

    public function edit($id)
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $data['title'] = 'Edit Post';
        $data['category'] = $this->category->getAllCategory();
        $data['post'] = $this->post->getPostById($id);

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() == false && isset($data['post'])) {
            $this->load->view('template/header', $data);
            $this->load->view('post/edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->upload_config();
            if (isset($_FILES['thumbnail']['name']) && !empty($_FILES['thumbnail']['name'])) {
                if (!$this->upload->do_upload('thumbnail')) {
                    $error = [
                        'error' => $this->upload->display_errors()
                    ];
                    $this->load->view('template/header', $data);
                    $this->load->view('post/edit', $error);
                    $this->load->view('template/footer');
                } else {
                    $res = $this->post->editPostWithPhoto($id);
                    if ($res['status'] == true) {
                        $this->session->set_flashdata('success', $res['message']);
                    } else {
                        $this->session->set_flashdata('failed', $res['message']);
                    }
                    redirect('post');
                }
            } else {
                $res = $this->post->editPost($id);
                if ($res['status'] == true) {
                    $this->session->set_flashdata('success', $res['message']);
                } else {
                    $this->session->set_flashdata('failed', $res['message']);
                }
                redirect('post');
            }
        }
    }

    public function tempdel($id)
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $res = $this->post->tempdelPost($id);
        if ($res['status'] == true) {
            $this->session->set_flashdata('success', $res['message']);
        } else {
            $this->session->set_flashdata('failed', $res['message']);
        }
        redirect('post');
    }

    public function restore($id)
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $res = $this->post->restorePost($id);
        if ($res['status'] == true) {
            $this->session->set_flashdata('success', $res['message']);
        } else {
            $this->session->set_flashdata('failed', $res['message']);
        }
        redirect('post/recycle_bin');
    }

    public function delete($id)
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $res = $this->post->deletePost($id);
        if ($res['status'] == true) {
            $this->session->set_flashdata('success', $res['message']);
        } else {
            $this->session->set_flashdata('failed', $res['message']);
        }
        redirect('post/recycle_bin');
    }

    public function delete_comment($post_id, $id)
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url('login'));
        };

        $post = $this->post->getPostById($post_id);


        $res = $this->post->deleteComment($id);
        if ($res['status'] == true) {
            $this->session->set_flashdata('success', $res['message']);
        } else {
            $this->session->set_flashdata('failed', $res['message']);
        }
        redirect('post/detail/' . $post['slug']);
    }
}
