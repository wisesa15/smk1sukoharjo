<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Kelas_model', 'kelas');
        $this->load->model('Guru_model', 'guru');
    }

    public function index()
    {
        //liat role id session
        $data['title'] = 'Profile';
        $data['user'] = $this->user->getUser($this->session->userdata('username'));

        if ($data['user']['role_id'] == 1) {
            $this->load->view('templates/header', $data);
        } else {
            if ($data['user']['role_id'] == 2) {
                $data['guru'] = $this->guru->getGuru($data['user']['id_guru']);
                $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id'));
            }
            $this->load->view('templates/header', $data);
        }
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }
}
