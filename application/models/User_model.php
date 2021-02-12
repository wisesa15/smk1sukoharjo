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
        $result = $this->db->get_where('user', ['username' => $user])->row_array();
        return $result;
    }

    public function getAllUser()
    {
        $result = $this->db->get('user')->result_array();
        return $result;
    }
    public function edit($id)
    {
        $data = [
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
}
