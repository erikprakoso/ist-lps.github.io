<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function all()
    {
        $orders = $this->db->get('orders')->result_array();
        return $orders;
    }

    public function insert($data)
    {
        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('orders');
        return $this->db->affected_rows() > 0 ? true : false;
    }
}
