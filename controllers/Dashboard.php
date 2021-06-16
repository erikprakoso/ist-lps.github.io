<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model', 'order');
    }

    public function index()
    {
        $data['orders'] = $this->order->all();
        $data['main_view'] = 'dashboard/index';
        $data['title'] = 'Dashboard';
        $this->load->view('template', $data);
    }
}
