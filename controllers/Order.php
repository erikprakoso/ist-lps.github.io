<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model', 'order');
    }

    public function update_status()
    {
        $order_id = $this->input->post('order_id');
        $status = $this->input->post('status');

        $data = [
            'status' => $status,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $update_status = $this->order->update($data, $order_id);
        if ($update_status) {
            $response = [
                'code' => 'T',
                'message' => 'Success',
                'data' => null
            ];
        } else {
            $response = [
                'code' => 'F',
                'message' => 'Failed',
                'data' => null
            ];
        }
        echo json_encode($response);
    }
}
