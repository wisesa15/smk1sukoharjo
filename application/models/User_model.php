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
        //mengambil data user yang bersesuaian dengan parameter varibale user, dimaan variable user merupakan id_user 
        $result = $this->db->get_where('user', ['id' => $user])->row_array();
        return $result;
    }

    public function getUserByUsername($user)
    {
        //mengambil data user yang bersesuaian dengan parameter varibale user, dimaan variable user merupakan username pengguna  
        $result = $this->db->get_where('user', ['username' => $user])->row_array();
        return $result;
    }

    public function getUserSiswa($user)
    {
        //mengambail data user siswa dengan parameter varibale user, dimana variable user merupakan id_siswa
        $result = $this->db->get_where('user', ['id_siswa' => $user])->row_array();
        return $result;
    }

    public function getUserGuru($user)
    {
        //mengambil data user guru dengan parameter variable user, dimana variable user merupakan id_guru
        $result = $this->db->get_where('user', ['id_guru' => $user])->row_array();
        return $result;
    }

    public function getAllUser()
    {
        //mengambil semua data user 
        $result = $this->db->get('user')->result_array();
        return $result;
    }

    public function editpassword($id)
    {
        //fungsi edit digunakankan untuk edit akun (password)
        $data = [
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

    public function editprofile($id, $username, $image = NULL)
    {
        //fungsi edit digunakankan untuk edit akun (profile)

        //cek apakah ada gambar
        if ($image) {
            $this->db->set('image', $image);
        }
        $this->db->set('username', $username);
        $this->db->where('id', $id);
        $this->db->update('user');
    }

    public function resetPassword($id)
    {
        //resetPassword merupakan fungsi untuk mereset password dengan default password
        //variable user mengambil data user berdasarkan parameter id_user 
        $user = $this->db->get_where('user', ['id' => $id])->row_array();
        if ($user['role_id'] == 2) {
            //jika user merupakan guru maka default password nya adalah nip
            $default_pass = $this->db->get_where('guru', ['id' => $user['id_guru']])->row_array()['nip'];
        } else if ($user['role_id'] == 3) {
            //jika user merukan siswa maka default passwordnya merupakan nis
            $default_pass = $this->db->get_where('siswa', ['id' => $user['id_siswa']])->row_array()['nis'];
        }
        $data = [
            'password' => password_hash($default_pass, PASSWORD_DEFAULT)
        ];
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

    public function tambahUser($role)
    //menambahkan user dengan role tertentu (2 -> guru, 3 -> siswa)
    {
        if ($role == 2) {
            $user = htmlspecialchars($this->input->post('nip'));
        } else if ($role == 3) {
            $user = htmlspecialchars($this->input->post('nis'));
        }
        $data = [
            'username' => $user,
            'image' => 'default.jpg',
            'password' => password_hash($user, PASSWORD_DEFAULT),
            'role_id' => $role,
            'date_created' => time()
        ];
        if ($role == 2) {
            $guru = $this->db->get_where('guru', ['nip' => $user])->row_array();
            $data['id_guru'] = $guru['id'];
        } else if ($role == 3) {
            $siswa = $this->db->get_where('siswa', ['nis' => $user])->row_array();
            $data['id_siswa'] = $siswa['id'];
        }
        $this->db->insert('user', $data);
    }

    public function delete($role, $id)
    {
        /* delete() menghapus akun berdasarkan idsiswa atau idguru */
        if ($role == 2) {
            $this->db->delete('user', ['id' => $id]);
        } else if ($role == 3) {
            $this->db->delete('user', ['id' => $id]);
        }
    }
}
