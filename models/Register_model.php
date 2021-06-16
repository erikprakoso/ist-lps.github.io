<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register_model extends CI_Model
{
    public function create($data)
    {
        $this->db->insert('users', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }
}
