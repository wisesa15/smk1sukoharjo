<?php

class Guru_model extends CI_Model
{
    public $id;
    public $nis;
    public $nama;
    public $kelas;

    public function importGuru($data = array())
    {
        if (!empty($data)) {
            // Insert member data
            $insert = $this->db->insert('guru', $data);

            // Return the status
            return $insert ? $this->db->insert_id() : false;
        } else {
            return false;
        }
    }

    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('guru');

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


    public function check_unique_nip($id = '', $nip)
    {
        $this->db->where('nip', $nip);
        if ($id) {
            $this->db->where_not_in('id', $id);
        }
        return $this->db->get('guru')->num_rows();
        // return $id;
    }

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
    public function getGuruCount()
    {
        //mendapatkan jumlah siswa yang ada
        return $this->db->count_all('guru');
    }
    public function getGuruLimit($limit, $start)
    {
        //mengambil semua data siswa dengan limit
        $this->db->limit($limit, $start);
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
    public function hapusGuru($id)
    {
        //menghapus data guru berdasarkan idnya
        $this->db->delete('guru', ['id' => $id]);
    }
}
