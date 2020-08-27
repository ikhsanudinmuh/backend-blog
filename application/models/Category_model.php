<?php
    use GuzzleHttp\Client;

    class Category_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->client = new Client([
                'base_uri' => base_url()
            ]);
        }

        public function getAllCategory()
        {
            $response = $this->client->request('GET', 'server/category_con');
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        public function getCategoryById($id)
        {
            $response = $this->client->request('GET', 'server/category_con', [
                'query' => [
                    'id' => $id
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result['data'][0];
        }

        public function inputCategory()
        {
            $data = [
                'name' => $this->input->post('name', true)
            ];

            $response = $this->client->request('POST', 'server/category_con', [
                'form_params' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        public function editCategory($id)
        {
            $data = [
                'name' => $this->input->post('name', true),
                'id' => $id
            ];

            $response = $this->client->request('PUT', 'server/category_con', [
                'form_params' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        public function deleteCategory($id)
        {
            $response = $this->client->request('DELETE', 'server/category_con', [
                'form_params' => [
                    'id' => $id
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }
    }
?>