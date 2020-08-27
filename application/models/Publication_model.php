<?php
    use GuzzleHttp\Client;

    class Publication_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->client = new Client([
                'base_uri' => base_url()
            ]);
        }

        public function getAllPublication()
        {
            $response = $this->client->request('GET', 'server/publication_con');
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        public function getPublicationById($id)
        {
            $response = $this->client->request('GET', 'server/publication_con', [
                'query' => [
                    'id' => $id
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result['data'][0];
        }

        public function inputPublication()
        {
            $data = [
                'year' => $this->input->post('year', true),
                'title' => $this->input->post('title', true),
                'journal' => $this->input->post('journal', true),
                'link' => $this->input->post('link', true),
                'username' => $this->input->post('username', true)
            ];

            $response = $this->client->request('POST', 'server/publication_con', [
                'form_params' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        public function editPublication($id)
        {
            $data = [
                'year' => $this->input->post('year', true),
                'title' => $this->input->post('title', true),
                'journal' => $this->input->post('journal', true),
                'link' => $this->input->post('link', true),
                'id' => $id
            ];

            $response = $this->client->request('PUT', 'server/publication_con', [
                'form_params' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;

            
        }

        public function deletePublication($id)
        {
            $response = $this->client->request('DELETE', 'server/publication_con', [
                'form_params' => [
                    'id' => $id
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }
    }
?>