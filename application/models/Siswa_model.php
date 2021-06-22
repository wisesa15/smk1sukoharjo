<?php

class Siswa_model extends CI_Model
{
    public $id;
    public $nis;
    public $nama;
    public $kelas;

    public function check_unique_nis($id = '', $nis)
    {
        $this->db->where('nis', $nis);
        if ($id) {
            $this->db->where_not_in('id', $id);
        }
        return $this->db->get('siswa')->num_rows();
    }


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
    public function getSiswaCount()
    {
        //mendapatkan jumlah siswa yang ada
        return $this->db->count_all('siswa');
    }
    public function getSiswaLimit($limit, $start)
    {
        //mengambil semua data siswa dengan limit
        $this->db->limit($limit, $start);
        $result = $this->db->get('siswa')->result_array();
        return $result;
    }
    public function editSiswa($id)
    {
        //mengambil data siswa dengan parameter id siswa lalu mengupdate data nim atau nama atau kelas berdasarkan input 
        $data = [
            'nis' => htmlspecialchars($this->input->post('nis')),
            'nama' => htmlspecialchars($this->input->post('nama')),
            'jurusan' => htmlspecialchars($this->input->post('jurusan')),
            'tahun_masuk' => htmlspecialchars($this->input->post('tahun-masuk'))
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
            'jurusan' => htmlspecialchars($this->input->post('jurusan')),
            'tahun_masuk' => htmlspecialchars($this->input->post('tahun-masuk'))
        ];
        $this->db->insert('siswa', $data);
    }
    public function hapusSiswa($id)
    {
        //menghapus data siswa berdasarkan idnya
        $this->db->delete('siswa', ['id' => $id]);
    }
}
