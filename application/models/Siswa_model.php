<?php

class Siswa_model extends CI_Model
{
    public $id;
    public $nis;
    public $nama;
    public $kelas;

    public function importSiswa($data = array())
    {
        if (!empty($data)) {
            // Insert member data
            $insert = $this->db->insert('siswa', $data);

            // Return the status
            return $insert ? $this->db->insert_id() : false;
        } else {
            return false;
        }
    }

    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('siswa');

        if (array_key_exists("where", $params)) {
            foreach ($params['where'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
            $result = $this->db->count_all_results();
        } else {
            if (array_key_exists("id", $params)) {
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            } else {
                $this->db->order_by('id', 'desc');
                if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit'], $params['start']);
                } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit']);
                }

                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
            }
        }

        // Return fetched data
        return $result;
    }

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
