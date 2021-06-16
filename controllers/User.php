<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model', 'order');
        $this->load->model('User_model');
    }

    public function index()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://13.250.104.14:5555/gateway/api_users/1.0/getDataRegisterUser',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'x-Gateway-APIKey: dc4d50e7-bfa7-47eb-bba4-c5ad9e1350a1'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $users = json_decode($response, true);

        if ($users['code'] === 'T') {
            $data = [
                'items' => $users['data']
            ];
        } else {
            $data = [
                'items' => []
            ];
        }

        $data['main_view'] = 'user/index';
        $data['title'] = 'User';
        $this->load->view('template', $data);
    }

    public function delete()
    {

        $data = [
            'username' => $this->input->post('username')
        ];

        $input = json_encode($data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://13.250.104.14:5555/gateway/api_users/1.0/deleteDataRegisterUserByUsername',
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
            redirect('user');
        } else {
            $this->session->set_flashdata('error', $users['message']);
            redirect('user');
        }
    }

    public function insert()
    {

        $data = [
            'transaction_type' => 'Add User',
            'status' => '9',
            'created_at' => date("Y-m-d H:i:s")
        ];
        $insert_order = $this->order->insert($data);

        $orgDate = $this->input->post('birthdate');
        $newDate = date("Ymd", strtotime($orgDate));
        $data = [
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
            'emailaddress' => $this->input->post('emailaddress'),
            'identitynumber' => $this->input->post('identitynumber'),
            'address' => $this->input->post('address'),
            'birthdate' => $newDate,
            'orderid' => $insert_order
        ];
        $input = json_encode($data);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://13.250.104.14:5555/gateway/api_users/1.0/insertRegisterUser',
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
            redirect('user');
        } else {
            $this->session->set_flashdata('error', $users['message']);
            redirect('user');
        }
    }

    public function update()
    {
        $orgDate = $this->input->post('birthdate');
        $newDate = date("Ymd", strtotime($orgDate));
        $data = [
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
            'emailaddress' => $this->input->post('emailaddress'),
            'identitynumber' => $this->input->post('identitynumber'),
            'address' => $this->input->post('address'),
            'birthdate' => $newDate
        ];
        $input = json_encode($data);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://13.250.104.14:5555/gateway/api_users/1.0/updateDataRegisterUserByUsername',
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
            redirect('user');
        } else {
            $this->session->set_flashdata('error', $users['message']);
            redirect('user');
        }
    }

    public function upload()
    {
        $select_file = $this->input->post('select_file');

        $config = [
            'upload_path' => FCPATH . '/assets/files/',
            'allowed_types' => '*',
            'max_size'  => 10000,
            'file_name' => uniqid(date('Y-m-d-h-i-s_')),
            'overwrite' => TRUE,
        ];
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('select_file')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            return redirect('user');
        } else {
            $data = [
                'transaction_type' => 'Upload User Data',
                'status' => '9',
                'created_at' => date("Y-m-d H:i:s")
            ];
            $insert_order = $this->order->insert($data);

            $path = 'http://13.250.104.14:5555/gateway/api_users/1.0/uploadFile';
            $resource = '?orderId=' . $insert_order;
            $url = $path . $resource;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('contentStream' => new CURLFILE($this->upload->data('full_path'))),
                CURLOPT_HTTPHEADER => array(
                    'x-Gateway-APIKey: dc4d50e7-bfa7-47eb-bba4-c5ad9e1350a1'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $uploads = json_decode($response, true);

            if ($uploads['code'] === 'T') {
                $this->session->set_flashdata('info', $uploads['message']);
                redirect('user');
            } else {
                $this->session->set_flashdata('error', $uploads['message']);
                redirect('user');
            }
            unlink($this->upload->data('full_path'));
        }
    }
}
