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

    public function getAllGuru($id)
    {
        $this->db->select('guru.*');
        $this->db->from('guru');
        $this->db->join('kelas_guru', 'kelas_guru.id_guru = guru.id');
        $this->db->where('kelas_guru.id_kelas', $id);

        $result = $this->db->get()->result_array();
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
    public function getDetailPertemuan($id_pertemuan)
    {
        $result = $this->db->get_where('aktivitas_kelas', ['id' => $id_pertemuan])->row_array();
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
    public function tambahPertemuan($id)
    {
        $data = [
            'nama_kegiatan' => htmlspecialchars($this->input->post('aktivitas')),
            'id_kelas' => $id
        ];
        $this->db->insert('aktivitas_kelas', $data);
    }
    public function tambahMateri($id)
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama_file')),
            'jenis' => ($this->input->post('jenis')),
            'tgl_ditampilkan' => strtotime($this->input->post('dataTampil')),
            'tenggalwaktu' => strtotime($this->input->post('dateline')),
            'nama_file' => 'ini',
            'id_aktivitas' => $id
        ];
        $this->db->insert('file', $data);
    }
}
