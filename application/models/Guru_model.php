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
    public function editGuru($id)
    {
        $data = [
            'nip' => htmlspecialchars($this->input->post('nip')),
            'nama' => htmlspecialchars($this->input->post('nama'))
        ];
        $this->db->where('id', $id);
        $this->db->update('guru', $data);
    }
    public function tambahGuru()
    {
        $data = [
            'nip' => htmlspecialchars($this->input->post('nip')),
            'nama' => htmlspecialchars($this->input->post('nama'))
        ];
        $this->db->insert('guru', $data);
    }
}
