<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sharepoint extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model', 'order');
    }

    public function index()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://13.250.104.14:5555/gateway/api_sharepoint/1.0/api_sharepoint/getListDocumentByPath',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'path=%2Fsites%2FIST%2FShared%20Documents%2Ftesting%2Fpoc',
            CURLOPT_HTTPHEADER => array(
                'x-Gateway-APIKey: dc4d50e7-bfa7-47eb-bba4-c5ad9e1350a1',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $documents = json_decode($response, true);

        if ($documents['code'] === 'T') {
            $data = [
                'items' => $documents['items']
            ];
        } else {
            $data = [
                'items' => []
            ];
        }

        $data['title'] = 'SharePoint';
        $data['main_view'] = 'sharepoint/index';
        $this->load->view('template', $data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $curl = curl_init();

        $data = [
            'id' => $id
        ];

        $input = json_encode($data);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://13.250.104.14:5555/gateway/api_sharepoint/1.0/api_sharepoint/deleteDocumentById',
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
        $documents = json_decode($response, true);

        if ($documents['code'] === 'T') {
            $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                ile berhasil dihapus.
              </div>');
            redirect('sharepoint');
        } else {
            $this->session->set_flashdata('info', '<div class="alert alert-danger" role="alert">
                File gagal dihapus.
              </div>');
            redirect('sharepoint');
        }
    }

    public function upload()
    {
        $select_file = $this->input->post('select_file');
        $title = $this->input->post('title');
        $filename = $this->input->post('filename');
        $destination_folder = $this->input->post('destination_folder');

        $config = [
            'upload_path' => FCPATH . '/assets/files/',
            'allowed_types' => '*',
            'max_size'  => 10000,
            'file_name' => $filename,
            'overwrite' => TRUE,
        ];
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('select_file')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            return redirect('sharepoint');
        } else {
            $data = [
                'transaction_type' => 'Upload Document',
                'status' => '9',
                'created_at' => date("Y-m-d H:i:s")
            ];
            $insert_order = $this->order->insert($data);
            $path = 'http://13.250.104.14:5555/gateway/api_sharepoint/1.0/api_sharepoint/uploadDocument';
            $resource = '?baseName=' . $filename . '&title=' . $title . '&destinationFolder=' . $destination_folder;
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
                redirect('sharepoint');
            } else {
                $this->session->set_flashdata('error', $uploads['message']);
                redirect('sharepoint');
            }
            unlink($this->upload->data('full_path'));
        }
    }
}
