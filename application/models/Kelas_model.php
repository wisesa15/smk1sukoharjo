<?php

class Kelas_model extends CI_Model
{
    public $id;
    public $nama;
    public $idMapel;

    public function getAllKelas()
    {
        $result = $this->db->get('kelas')->result_array();
        return $result;
    }
}
