<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Register';
        $this->load->view('register/index', $data);
    }

    public function create()
    {
        $input = [
            'name' => $this->input->post('inputName'),
            'username' => $this->input->post('inputUsername'),
            'email' => $this->input->post('inputEmail'),
            'password1' => $this->input->post('inputPassword1'),
            'password2' => $this->input->post('inputPassword2')
        ];

        $input = json_encode($input);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://13.250.104.14:5555/gateway/auth/1.0/userRegister',
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
            $this->session->set_flashdata('info', $users['message']);
            redirect('login');
        } else {
            $this->session->set_flashdata('error', $users['message']);
            redirect('register');
        }
    }
}
