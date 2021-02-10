<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Siswa_model', 'siswa');
        $this->load->model('Kelas_model', 'kelas');
    }

    public function index()
    {
        //liat role id session
        $data['title'] = 'Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['siswa'] = $this->siswa->getAllSiswa();

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['siswa'] = $this->siswa->getSiswa($id);
        $data['kelas'] = $this->kelas->getKelas($id, 3);

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/detail', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
    }

    public function delete()
    {
    }

    public function resetPassword()
    {
    }
}
