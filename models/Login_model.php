<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
    public function get_user_by_email($email)
    {
        $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `status` = '1'";
        return $this->db->query($query)->row_array();
    }

    public function get_user_by_username($username)
    {
        $query = "SELECT * FROM `users` WHERE `username` = '$username' AND `status` = '1'";
        return $this->db->query($query)->row_array();
    }
}
