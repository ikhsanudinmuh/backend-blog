<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    use chriskacerguis\RestServer\RestController;

    class Profile_con extends RestController
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('server/Profile_model', 'profile');
        }

        public function index_get()
        {
            $profile = $this->profile->getProfile();

            if ($profile) {
                $this->response([
                    'status' => true,
                    'data' => $profile
                ]);
            }
        }

        public function index_put()
        {
            $username = $this->put('username');
            $data = [
                'full_name' => $this->put('full_name'),
                'email' => $this->put('email'),
                'about' => $this->put('about'),
                'telephone' => $this->put('telephone')
            ];

            if ($this->profile->editProfile($data, $username) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Profile berhasil diedit.'
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Profile tidak berhasil diedit!'
                ]);
            }
        }

        public function changePass_put()
        {
            $profile = $this->profile->getProfile();
            $username = $this->put('username');
            $oldpass = $this->put('oldpass');

            $data = [
                'password' => $this->put('password')
            ];

            if ($oldpass == $profile[0]['password']) {
                if ($this->profile->changePass($data, $username) > 0) {
                    $this->response([
                        'status' => true,
                        'message' => 'Password berhasil diedit.'
                    ]);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Password tidak berhasil diedit!'
                    ]);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Password lama tidak cocok!'
                ]);
            }

        }

        public function with_photo_put()
        {
            $username = $this->put('username');
            $data = [
                'full_name' => $this->put('full_name'),
                'email' => $this->put('email'),
                'about' => $this->put('about'),
                'img' => $this->put('img'),
                'telephone' => $this->put('telephone')
            ];

            if ($this->profile->editProfile($data, $username) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Photo profile berhasil diedit.'
                ]);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Photo profile tidak berhasil diedit!'
                ]);
            }
        }
    }
?>
