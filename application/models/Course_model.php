<?php
    use GuzzleHttp\Client;

    class Course_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->client = new Client([
                'base_uri' => base_url()
            ]);
        }

        public function getAllCourse()
        {
            $response = $this->client->request('GET', 'server/matkul_con');
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        public function getCourseById($id)
        {
            $response = $this->client->request('GET', 'server/matkul_con', [
                'query' => [
                    'id' => $id
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result['data'][0];
        }

        public function inputCourse()
        {
            $data = [
                'code' => $this->input->post('code', true),
                'name' => $this->input->post('name', true),
                'year' => $this->input->post('year', true),
                'username' => $this->input->post('username', true)
            ];

            $response = $this->client->request('POST', 'server/matkul_con', [
                'form_params' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        public function editCourse($id)
        {
            $data = [
                'code' => $this->input->post('code', true),
                'name' => $this->input->post('name', true),
                'year' => $this->input->post('year', true),
                'id' => $id
            ];

            $response = $this->client->request('PUT', 'server/matkul_con', [
                'form_params' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        public function deleteCourse($id)
        {
            $response = $this->client->request('DELETE', 'server/matkul_con', [
                'form_params' => [
                    'id' => $id
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }
    }
?>