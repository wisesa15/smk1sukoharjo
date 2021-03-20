<?php

class Guru_model extends CI_Model
{
    public $id;
    public $nis;
    public $nama;
    public $kelas;


    public function getGuru($id)
    {
        //mengambil data guru berdasarkan idnya
        $result = $this->db->get_where('guru', ['id' => $id])->row_array();
        return $result;
    }

    public function getAllGuru()
    {
        //getAllGuru mengambil semua data guru
        $result = $this->db->get('guru')->result_array();
        return $result;
    }
    public function editGuru($id)
    {
        //editGuru mengambil data Guru dengan parameter id guru
        //mengembalikan nilai nip dan nama pada tabel guru
        $data = [
            'nip' => htmlspecialchars($this->input->post('nip')),
            'nama' => htmlspecialchars($this->input->post('nama'))
        ];
        $this->db->where('id', $id);
        $this->db->update('guru', $data);
    }
    public function tambahGuru()
    {
        //tambahGuru menambahkan nip dan nama pada tabel guru berdasarkan input 
        $data = [
            'nip' => htmlspecialchars($this->input->post('nip')),
            'nama' => htmlspecialchars($this->input->post('nama'))
        ];
        $this->db->insert('guru', $data);
    }
}
