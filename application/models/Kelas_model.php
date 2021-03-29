<?php

class Kelas_model extends CI_Model
{
    public $id;
    public $nama;
    public $idMapel;


    public function getAllKelas()
    {
        //mengambil data seluruh kelas
        $result = $this->db->get('kelas')->result_array();
        return $result;
    }

    public function getAllGuru($id)
    {
        //mengambil semua data guru dengan parameter id_kelas (yang mengajar kelas tersebut)  
        $this->db->select('guru.*');
        $this->db->from('guru');
        $this->db->join('kelas_guru', 'kelas_guru.id_guru = guru.id');
        $this->db->where('kelas_guru.id_kelas', $id);

        $result = $this->db->get()->result_array();
        return $result;
    }

    public function getKelas($id, $role)
    {
        //mengambil data kelas yang diajar oleh (apabila rolenya 2/guru) atau data kelas yang diambil oleh (apabila rolenya 3/siswa)
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
        //mengambil semua data kelas berdasarkan idnya 
        $result = $this->db->get_where('kelas', ['id' => $id])->row_array();
        return $result;
    }

    public function getDetailPertemuan($id_pertemuan)
    {
        //mengambil data detail pertemuan berdasarkan id_pertemuan 
        //mengembalikan banyaknya file pada suatu pertemuan
        $result = $this->db->get_where('aktivitas_kelas', ['id' => $id_pertemuan])->row_array();
        return $result;
    }

    public function getPertemuan($id_kelas)
    {
        //mengambil data pertemuan berdasarkan id_kelas(pada tiap kelas)
        $result = $this->db->get_where('aktivitas_kelas', ['id_kelas' => $id_kelas])->result_array();
        return $result;
    }

    public function getFile($id_pertemuan)
    {
        //mengambil nama-name file materi suatu pertemuan dengan parameter id_pertemuan 
        $result = $this->db->get_where('file', ['id_aktivitas' => $id_pertemuan])->result_array();
        return $result;
    }

    public function getDetailFile($id_materi)
    {
        //mengambil detail file 
        $result = $this->db->get_where('file', ['id' => $id_materi])->row_array();
        return $result;
    }

    public function tambahPertemuan($id)
    {
        //menambahkan pertemuan dengan parameter id_kelas  
        $data = [
            'nama_kegiatan' => htmlspecialchars($this->input->post('aktivitas')),
            'id_kelas' => $id
        ];
        $this->db->insert('aktivitas_kelas', $data);
    }


    public function tambahMateri($id, $file)
    {
        //menambahkan materi pada suatu pertemuan dengan parameter id_aktivitas(id pertemuan )
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama_file')),
            'jenis' => ($this->input->post('jenis')),
            'tgl_ditampilkan' => strtotime($this->input->post('dataTampil')),
            'tenggalwaktu' => strtotime($this->input->post('dateline')),
            'nama_file' => $file,
            'id_aktivitas' => $id,
            'keterangan' => $this->input->post('keterangan')
        ];
        $this->db->insert('file', $data);
    }
}
