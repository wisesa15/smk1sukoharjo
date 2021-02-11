<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Guru_model', 'guru');
        $this->load->model('Kelas_model', 'kelas');
    }

    public function index()
    {
        //liat role id session
        $data['title'] = 'Guru';
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['siswa'] = $this->guru->getAllGuru();

        $this->load->view('templates/header', $data);
        $this->load->view('guru/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Guru';
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['guru'] = $this->guru->getGuru($id);
        $data['kelas'] = $this->kelas->getKelas($id, 2);

        $this->load->view('templates/header', $data);
        $this->load->view('guru/detail', $data);
        $this->load->view('templates/footer');
    }
    public function tambah_materi()
    {
        $data['title'] = 'Tambah Pertemuan';
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['guru'] = $this->guru->getGuru($id);
        $data['kelas'] = $this->kelas->getKelas($id, 2);
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
