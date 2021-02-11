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
    public function editSiswa($id)
    {
        $data = [
            'nis' => htmlspecialchars($this->input->post('nis')),
            'nama' => htmlspecialchars($this->input->post('nama')),
            'kelas' => htmlspecialchars($this->input->post('kelas'))
        ];
        $this->db->where('id', $id);
        $this->db->update('siswa', $data);
    }
}
