<?php

class Siswa_model extends CI_Model
{
    public $id;
    public $nis;
    public $nama;
    public $kelas;

    public function getSiswa($id)
    {
        $result = $this->db->get_where('siswa', ['id' => $id])->row_array();
        return $result;
    }

    public function getAllSiswa()
    {
        $result = $this->db->get('siswa')->result_array();
        return $result;
    }
}
