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
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['siswa'] = $this->siswa->getAllSiswa();

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['siswa'] = $this->siswa->getSiswa($id);
        $data['kelas'] = $this->kelas->getKelas($id, 3);

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/detail', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['siswa'] = $this->siswa->getSiswa($id);

        $this->form_validation->set_rules('nis', 'Nomor Induk Sekolah', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('siswa/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->siswa->editSiswa($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil mengubah data ' . $data['siswa']['nama'] . '.</div>');
            redirect('siswa');
        }
    }

    public function delete()
    {
    }

    public function resetPassword()
    {
    }

    //ini buat nyimpen template doang
    public function template()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated.</div>');
            redirect('user');
        }
    }
}
