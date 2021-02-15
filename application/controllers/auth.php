<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        if ($this->session->userdata('id')) {
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Login';

                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/login');
                $this->load->view('templates/auth_footer');
            } else {
                $this->_login();
            }
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->user->getUserByUsername($username);

        //usernya ada
        if ($user) {
            if (password_verify($password, $user['password'])) {
                //jika password sama, login berhasil
                $data = [
                    'id' => $user['id'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                redirect('dashboard');
            } else {
                //password salah, login gagal
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                redirect('auth');
            }
        } else {
            //tidak ada user dengan email itu
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username isn\'t registered</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You\'ve been logout!</div>');
        redirect('auth');
    }

    public function resetPassword($role, $id)
    {
        if ($role == 2) {
            $data = $this->user->getUserGuru($id); //mengambil data uesr yang ingin direset passwordnya berdasarkan id guru / id siswa
            $this->user->resetPassword($data['id']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You\'ve reset the password!</div>');
            redirect('guru');
        } else if ($role == 3) {
            $data = $this->user->getUserSiswa($id);
            $this->user->resetPassword($data['id']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You\'ve reset the password!</div>');
            redirect('siswa');
        }
    }

    public function registration()
    {
        $data = [
            'username' => 'siswa',
            'image' => 'default.jpg',
            'password' => password_hash('siswa', PASSWORD_DEFAULT),
            'role_id' => 3,
            'date_created' => time()
        ];
        $this->db->insert('user', $data);
        redirect('auth');
    }
}
