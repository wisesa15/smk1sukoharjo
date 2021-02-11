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

    public function edit($id)
    {
        $data['title'] = 'Edit Guru';
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['guru'] = $this->guru->getGuru($id);

        $this->form_validation->set_rules('nip', 'Nomor Indentitas Pegawai Negeri Sipil', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('guru/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->guru->editGuru($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil mengubah data ' . $data['guru']['nama'] . '.</div>');
            redirect('guru');
        }
    }

    public function delete()
    {
    }

    public function resetPassword()
    {
    }
}
