<?php
    class Home extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Post_model', 'post');
        }

        public function index()
        {
            $data['title'] = 'Home';
            $data['post'] = $this->post->getActivePost();
            $this->load->view('template/header', $data);
            $this->load->view('home', $data);
            $this->load->view('template/footer');
        }
    }
?>