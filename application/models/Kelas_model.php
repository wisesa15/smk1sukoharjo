<?php

class Kelas_model extends CI_Model
{
    public $id;
    public $nama;
    public $idMapel;

    //mengambil data seluruh kelas
    public function getAllKelas()
    {
        $result = $this->db->get('kelas')->result_array();
        return $result;
    }

    //mengambil data kelas yang diajar oleh (apabila rolenya 2/guru) atau data kelas yang diambil oleh (apabila rolenya 3/siswa)
    public function getKelas($id, $role)
    {
        if ($role == 2) {
            $this->db->select('kelas.*');
            $this->db->from('kelas');
            $this->db->join('kelas_guru', 'kelas_guru.id_kelas = kelas.id');
            $this->db->where('kelas_guru.id_guru', $id);
        } elseif ($role == 3) {
            $this->db->select('kelas.*');
            $this->db->from('kelas');
            $this->db->join('kelas_siswa', 'kelas_siswa.id_kelas = kelas.id');
            $this->db->where('kelas_siswa.id_siswa', $id);
        }
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function getDetail($id)
    {

        $result = $this->db->get_where('kelas', ['id' => $id])->row_array();
        return $result;
    }
    public function getPertemuan($id_kelas)
    {
        $result = $this->db->get_where('aktivitas_kelas', ['id_kelas' => $id_kelas])->result_array();
        return $result;
    }
    public function getFile($id_pertemuan)
    {
        $result = $this->db->get_where('file', ['id_aktivitas' => $id_pertemuan])->result_array();
        return $result;
    }
}
