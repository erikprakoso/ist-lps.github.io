<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function get_all_count()
    {
        $kapal = $this->db->get('kapal')->num_rows();
        $users = $this->db->get('users')->num_rows();
        $syahbandar = $this->db->get('syahbandar')->num_rows();
        $count = [
            'kapal' => $kapal,
            'users' => $users,
            'syahbandar' => $syahbandar,
        ];
        return $count;
    }
}
