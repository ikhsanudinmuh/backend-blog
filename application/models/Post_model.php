<?php

use GuzzleHttp\Client;

class Post_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->client = new Client([
            'base_uri' => base_url()
        ]);
    }

    public function getActivePost()
    {
        $response = $this->client->request('GET', 'server/post_con');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getNonActivePost()
    {
        $response = $this->client->request('GET', 'server/post_con/nonactive');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getPostById($id)
    {
        $response = $this->client->request('GET', 'server/post_con/byId', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    public function getPostBySlug($slug)
    {
        $response = $this->client->request('GET', 'server/post_con/detail', [
            'query' => [
                'slug' => $slug
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    public function getPreviousPost($slug)
    {
        $response = $this->client->request('GET', 'server/post_con/previous', [
            'query' => [
                'slug' => $slug
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getNextPost($slug)
    {
        $response = $this->client->request('GET', 'server/post_con/next', [
            'query' => [
                'slug' => $slug
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function create_slug($string)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
    }

    public function createPost()
    {
        $slug = $this->create_slug($this->input->post('title'));

        if ($this->upload->data('file_name') == null) {
            $data = [
                'title' => $this->input->post('title', true),
                'content' => $this->input->post('content', true),
                'category' => $this->input->post('category', true) == '' ? null : $this->input->post('category', true),
                'slug' => strtolower($slug),
                'username' => $this->input->post('username', true)
            ];
        } else {
            $data = [
                'title' => $this->input->post('title', true),
                'content' => $this->input->post('content', true),
                'category' => $this->input->post('category', true) == '' ? null : $this->input->post('category', true),
                'img' => $this->upload->data('file_name'),
                'slug' => strtolower($slug),
                'username' => $this->input->post('username', true)
            ];
        }

        $response = $this->client->request('POST', 'server/post_con', [
            'form_params' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function editPost($id)
    {
        $slug = $this->create_slug($this->input->post('title'));

        $data = [
            'title' => $this->input->post('title', true),
            'content' => $this->input->post('content', true),
            'category' => $this->input->post('category', true) == '' ? null : $this->input->post('category', true),
            'slug' => strtolower($slug),
            'id' => $id
        ];

        $response = $this->client->request('PUT', 'server/post_con', [
            'form_params' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function editPostWithPhoto($id)
    {
        $slug = $this->create_slug($this->input->post('title'));

        $data = [
            'title' => $this->input->post('title', true),
            'content' => $this->input->post('content', true),
            'img' => $this->upload->data('file_name'),
            'category' => $this->input->post('category', true) == '' ? null : $this->input->post('category', true),
            'slug' => strtolower($slug),
            'id' => $id
        ];

        $response = $this->client->request('PUT', 'server/post_con/withPhoto', [
            'form_params' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function tempdelPost($id)
    {
        $response = $this->client->request('PUT', 'server/post_con/tempdel', [
            'form_params' => [
                'id' => $id
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function restorePost($id)
    {
        $response = $this->client->request('PUT', 'server/post_con/restore', [
            'form_params' => [
                'id' => $id
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deletePost($id)
    {
        $response = $this->client->request('DELETE', 'server/post_con/restore', [
            'form_params' => [
                'id' => $id
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getComment($id)
    {
        $response = $this->client->request('GET', 'server/comment_con', [
            'query' => [
                'post_id' => $id
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function insertComment()
    {
        $data = [
            'post_id' => $this->input->post('post_id', true),
            'name' => $this->input->post('name', true),
            'content' => $this->input->post('content', true)
        ];

        $response = $this->client->request('POST', 'server/comment_con', [
            'form_params' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteComment($id)
    {
        $response = $this->client->request('DELETE', 'server/comment_con', [
            'form_params' => [
                'id' => $id
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
}
