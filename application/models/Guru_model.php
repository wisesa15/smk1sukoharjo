<?php

class Guru_model extends CI_Model
{
    public $id;
    public $nis;
    public $nama;
    public $kelas;

    public function getGuru($id)
    {
        $result = $this->db->get_where('guru', ['id' => $id])->row_array();
        return $result;
    }

    public function getAllGuru()
    {
        $result = $this->db->get('guru')->result_array();
        return $result;
    }
}
