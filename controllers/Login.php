<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model', 'login');
    }

    public function index()
    {
        $this->form_validation->set_rules(
            'inputPassword',
            'Password',
            'required|trim|min_length[5]'
        );

        if ($this->session->userdata('name')) {
            redirect('dashboard');
        } else {
            if ($this->form_validation->run() == false) {
                $data['title'] = 'Login';
                $this->load->view('login/index', $data);
            } else {
                $this->_login();
            }
        }
    }

    private function _login()
    {
        if ($this->input->post('userEmail') === '1') {
            $input = [
                'username' => $this->input->post('inputUsername'),
                'password' => $this->input->post('inputPassword')
            ];

            $input = json_encode($input);
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://13.250.104.14:5555/gateway/auth/1.0/loginByUsername',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $input,
                CURLOPT_HTTPHEADER => array(
                    'x-Gateway-APIKey: dc4d50e7-bfa7-47eb-bba4-c5ad9e1350a1',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $users = json_decode($response, true);

            if ($users['code'] === 'T') {
                $user = $users['data'];
                $data = [
                    'logged_in' => true,
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'user_id' => $user['id'],
                    'role' => $user['role'],
                    'status' => $user['status']
                ];
                $this->session->set_userdata($data);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', $users['message']);
                redirect('login');
            }
        } else {
            $input = [
                'email' => $this->input->post('inputEmail'),
                'password' => $this->input->post('inputPassword')
            ];

            $input = json_encode($input);
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://13.250.104.14:5555/gateway/auth/1.0/loginByEmail',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $input,
                CURLOPT_HTTPHEADER => array(
                    'x-Gateway-APIKey: dc4d50e7-bfa7-47eb-bba4-c5ad9e1350a1',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $users = json_decode($response, true);

            if ($users['code'] === 'T') {
                $user = $users['data'];
                $data = [
                    'logged_in' => true,
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'user_id' => $user['id'],
                    'role' => $user['role'],
                    'status' => $user['status']
                ];
                $this->session->set_userdata($data);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', $users['message']);
                redirect('login');
            }
        }
    }
}
