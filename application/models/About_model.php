<?php
    use GuzzleHttp\Client;

    class About_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->client = new Client([
                'base_uri' => base_url()
            ]);
        }
        
        public function getProfile()
        {
            $response = $this->client->request('GET', 'server/profile_con');
            $result = json_decode($response->getBody()->getContents(), true);
            return $result['data'][0];
        }

        public function editProfile()
        {
            $data = [
                'full_name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'about' => $this->input->post('about', true),
                'telephone' => $this->input->post('telephone', true),
                'username' => $this->input->post('username', true)
            ];

            $response = $this->client->request('PUT', 'server/profile_con', [
                'form_params' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        public function changePass()
        {
            $data = [
                'oldpass' => md5($this->input->post('oldpass', true)),
                'password' => md5($this->input->post('newpass', true)),
                'username' => $this->input->post('username', true)
            ];

            $response = $this->client->request('PUT', 'server/profile_con/changePass', [
                'form_params' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        public function editProfileWithPhoto()
        {
            $data = [
                'full_name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'about' => $this->input->post('about', true),
                'telephone' => $this->input->post('telephone', true),
                'img' => $this->upload->data('file_name'),
                'username' => $this->input->post('username', true)
            ];

            $response = $this->client->request('PUT', 'server/profile_con/with_photo', [
                'form_params' => $data
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }
    }
?>