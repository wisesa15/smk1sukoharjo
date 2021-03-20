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
        /* menampilkan halaman guru untuk admin*/

        $data['title'] = 'Guru'; //untuk title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //untuk data user yang login
        $data['siswa'] = $this->guru->getAllGuru(); //ini harusnya guru tapi diganti nanti aja 

        $this->load->view('templates/header', $data);
        $this->load->view('guru/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        /* menampilkan halaman detail guru berdasarkan id yang dipilih untuk admin */

        $data['title'] = 'Detail Guru'; //untuk title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //untuk data user yang login
        $data['guru'] = $this->guru->getGuru($id); //untuk menampilkan data detail data guru
        $data['kelas'] = $this->kelas->getKelas($id, 2); //untuk menampilkan data yang diajar oleh guru tersebut

        $this->load->view('templates/header', $data);
        $this->load->view('guru/detail', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        /* form edit data guru */

        $data['title'] = 'Edit Guru'; //untuk title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //untuk data user yang login
        $data['guru'] = $this->guru->getGuru($id); //untuk menampilkan data guru yang ingin diedit

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
        /* delete() digunakan untuk menghapus data guru (param: id) */
    }

    public function tambah()
    {
        /* tambah() digunakan untuk menambah data guru */

        $data['title'] = 'Tambah Guru'; // untuk title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //untuk data user yang login

        $this->form_validation->set_rules('nip', 'Nomor Induk Pegawai Negeri', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('guru/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->guru->tambahGuru();
            $this->user->tambahUser(2);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil menambahkan guru baru.</div>');
            redirect('guru');
        }
    }
}
