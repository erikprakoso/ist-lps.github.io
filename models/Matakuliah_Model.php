<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Matakuliah_model extends CI_Model
{
    public function get_all()
    {
        $query = "SELECT * FROM `mata_kuliahs`";
        return $this->db->query($query)->result_array();
    }

    public function create($data)
    {
        $this->db->insert('mata_kuliahs', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function update($data, $kode)
    {
        $this->db->update('mata_kuliahs', $data, ['matkul_id' => $kode]);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function getByKode($kode)
    {
        return $this->db->get_where('mata_kuliahs', ['matkul_id' => $kode])->row();
    }
}
