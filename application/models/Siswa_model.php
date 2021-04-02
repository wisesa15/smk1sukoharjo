<?php

class Siswa_model extends CI_Model
{
    public $id;
    public $nis;
    public $nama;
    public $kelas;

    public function getSiswa($id)
    {
        //mengambil data siswa dengan parameter id_siswa
        $result = $this->db->get_where('siswa', ['id' => $id])->row_array();
        return $result;
    }

    public function getAllSiswa()
    {
        //mengambil semua data siswa 
        $result = $this->db->get('siswa')->result_array();
        return $result;
    }
    public function getAllSiswaLimit($mulaiData, $jmlData)
    {
        //mengambil semua data siswa dengan limit
        $result = $this->db->get('siswa')->result_array();
        return $result;
    }
    public function editSiswa($id)
    {
        //mengambil data siswa dengan parameter id siswa lalu mengupdate data nim atau nama atau kelas berdasarkan input 
        $data = [
            'nis' => htmlspecialchars($this->input->post('nis')),
            'nama' => htmlspecialchars($this->input->post('nama')),
            'kelas' => htmlspecialchars($this->input->post('kelas'))
        ];
        $this->db->where('id', $id);
        $this->db->update('siswa', $data);
    }
    public function tambahSiswa()
    {
        //menambah data siswa dengan mengisi nis nama dan kelas siswa 
        $data = [
            'nis' => htmlspecialchars($this->input->post('nis')),
            'nama' => htmlspecialchars($this->input->post('nama')),
            'kelas' => htmlspecialchars($this->input->post('kelas'))
        ];
        $this->db->insert('siswa', $data);
    }
    public function hapusSiswa($id)
    {
        //menghapus data siswa berdasarkan idnya
        $this->db->delete('siswa', ['id' => $id]);
    }
}
