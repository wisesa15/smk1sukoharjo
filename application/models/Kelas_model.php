<?php

class Kelas_model extends CI_Model
{
    public $id;
    public $nama;
    public $idMapel;

    public function tambah($nama, $gambar = NULL)
    {
        //menambahkan data kelas
        if ($gambar) {
            $this->db->set('gambar', $gambar);
        }
        $this->db->set('nama', $nama);

        $this->db->insert('kelas');
    }

    public function getAllKelas()
    {
        //mengambil data seluruh kelas
        $result = $this->db->get('kelas')->result_array();
        return $result;
    }

    public function getKelasCount()
    {
        //mendapatkan jumlah Kelas yang ada
        return $this->db->count_all('siswa');
    }
    public function getKelasLimit($limit, $start)
    {
        //mengambil semua data siswa dengan limit
        $this->db->limit($limit, $start);
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

    public function getMateri($id)
    {
        $this->db->select('f.* , ak.id_kelas as id_kelas');
        $this->db->from('file as f');
        $this->db->join('aktivitas_kelas as ak', 'f.id_aktivitas = ak.id');
        $this->db->where('f.id', $id);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function getFileSiswa($id_siswa, $id_file)
    {
        $this->db->select('file_tugas_siswa.*');
        $this->db->from('file_tugas_siswa');
        $this->db->where('id_siswa', $id_siswa);
        $this->db->where('id_file', $id_file);
        $result = $this->db->get()->row_array();
        return $result;
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

    public function uploadMateri($id_siswa, $id_file, $file)
    {
        $data = [
            'id_file' => $id_file,
            'nama_file' => $file,
            'id_siswa' => $id_siswa
        ];
        $this->db->insert('file_tugas_siswa', $data);
    }
    public function editMateri($id, $file = null)
    {
        //menambahkan materi pada suatu pertemuan dengan parameter id_aktivitas(id pertemuan )
        if ($file != null) {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama_file')),
                'jenis' => ($this->input->post('jenis')),
                'tgl_ditampilkan' => strtotime($this->input->post('dataTampil')),
                'tenggalwaktu' => strtotime($this->input->post('dateline')),
                'nama_file' => $file,
                'keterangan' => $this->input->post('keterangan')
            ];
        } elseif ($file == null) {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama_file')),
                'jenis' => ($this->input->post('jenis')),
                'tgl_ditampilkan' => strtotime($this->input->post('dataTampil')),
                'tenggalwaktu' => strtotime($this->input->post('dateline')),
                'keterangan' => $this->input->post('keterangan')
            ];
        }
        $this->db->select('file.*');
        $this->db->from('file');
        $this->db->where('id', $id);
        $this->db->update('file', $data);
        //$this->db->get_where('file', ['id' => $id],);
        //$this->db->update('file', $data);
    }

    public function deleteMateri($id)
    {
        //menghapus data siswa berdasarkan idnya
        //menghapus data siswa yang dikumpulkan
        $this->db->select('file_tugas_siswa.*');
        $this->db->from('file_tugas_siswa');
        $this->db->where('id_file', $id);
        $this->db->delete('file_tugas_siswa');
        //menghapus materi
        $this->db->select('file.*');
        $this->db->from('file');
        $this->db->where('id', $id);
        $this->db->delete('file');
    }

    public function checkPekerjaan($id_siswa, $id_file)
    {
        $this->db->select('file_tugas_siswa.*');
        $this->db->from('file_tugas_siswa');
        $this->db->where('id_siswa', $id_siswa);
        $this->db->where('id_file', $id_file);
        $result = $this->db->get()->row_array();
        return $result;
    }
    public function hapus($id)
    {
        //menghapus data kelas berdasarkan idnya
        $this->db->delete('kelas', ['id' => $id]);
    }
    public function tambahSiswa($data)
    {
        // menambahkan data guru dan kelas yang diajarnya
        // $data berisi id guru dan id kelas yg diajar
        $this->db->insert_batch('kelas_siswa', $data);
    }
    public function tambahGuru($data)
    {
        // menambahkan data guru dan kelas yang diajarnya
        // $data berisi id guru dan id kelas yang diajar
        $this->db->insert_batch('kelas_guru', $data);
    }
    public function getKelasSiswa($id_kelas)
    {
        // mendapatkan daftar siswa yang mengambil kelas tersebut
        $this->db->select('s.id as id, s.nama as nama');
        $this->db->from('kelas_siswa as ks');
        $this->db->join('siswa as s', 'ks.id_siswa = s.id');
        $this->db->where('id_kelas', $id_kelas);
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function getKelasGuru($id_kelas)
    {
        // mendapatkan daftar guru yang mengambil kelas tersebut
        $this->db->select('g.id as id, g.nama as nama');
        $this->db->from('kelas_guru as kg');
        $this->db->join('guru as g', 'kg.id_guru = g.id');
        $this->db->where('id_kelas', $id_kelas);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function hapusSiswa($id_siswa, $id_kelas)
    {
        $this->db->delete('kelas_siswa', ['id_siswa' => $id_siswa, 'id_kelas' => $id_kelas]);
    }
    public function hapusGuru($id_guru, $id_kelas)
    {
        $this->db->delete('kelas_guru', ['id_guru' => $id_guru, 'id_kelas' => $id_kelas]);
    }
    public function editKelas($id, $nama, $gambar = NULL)
    {
        //mengubah kelas siswa
        if ($gambar) {
            $this->db->set('gambar', $gambar);
        }
        $this->db->set('nama', $nama);
        $this->db->where('id', $id);
        $this->db->update('kelas');
    }
    public function hapusFileSiswa($id_siswa, $id_file)
    {
        $this->db->select('file_tugas_siswa.*');
        $this->db->from('file_tugas_siswa');
        $this->db->where('id_siswa', $id_siswa);
        $this->db->where('id_file', $id_file);
        $this->db->delete('file_tugas_siswa');
    }
}
