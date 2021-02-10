<?php

class Guru_model extends CI_Model
{
    public $id;
    public $nis;
    public $nama;
    public $kelas;

    //mengambil data guru berdasarkan idnya
    public function getGuru($id)
    {
        $result = $this->db->get_where('guru', ['id' => $id])->row_array();
        return $result;
    }

    //mengambil data seluruh guru
    public function getAllGuru()
    {
        $result = $this->db->get('guru')->result_array();
        return $result;
    }
}
