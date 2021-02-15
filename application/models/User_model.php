<?php

class User_model extends CI_Model
{
    public $username;
    public $password;
    public $role_id;
    public $date_created;
    public $id_siswa;
    public $id_guru;

    public function getUser($user)
    {
        $result = $this->db->get_where('user', ['id' => $user])->row_array();
        return $result;
    }

    public function getUserByUsername($user)
    {
        $result = $this->db->get_where('user', ['username' => $user])->row_array();
        return $result;
    }

    public function getUserSiswa($user)
    {
        $result = $this->db->get_where('user', ['id_siswa' => $user])->row_array();
        return $result;
    }

    public function getUserGuru($user)
    {
        $result = $this->db->get_where('user', ['id_guru' => $user])->row_array();
        return $result;
    }

    public function getAllUser()
    {
        $result = $this->db->get('user')->result_array();
        return $result;
    }
    public function edit($id)
    {
        if ($this->input->post('password') != "") {
            $data = [
                'username' => htmlspecialchars($this->input->post('username')),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username'))
            ];
        }
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
    public function resetPassword($id)
    {
        $user = $this->db->get_where('user', ['id' => $id])->row_array();
        if ($user['role_id'] == 2) {
            $default_pass = $this->db->get_where('guru', ['id' => $user['id_guru']])->row_array()['nip'];
        } else if ($user['role_id'] == 3) {
            $default_pass = $this->db->get_where('siswa', ['id' => $user['id_siswa']])->row_array()['nis'];
        }
        $data = [
            'password' => password_hash($default_pass, PASSWORD_DEFAULT)
        ];
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
}
