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
        /* menampilkan daftar siswa - untuk admin */
        $data['title'] = 'Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['siswa'] = $this->siswa->getAllSiswa();

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        /* menampilkan detail siswa berdasarkan id */

        $data['title'] = 'Detail Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['siswa'] = $this->siswa->getSiswa($id);
        $data['kelas'] = $this->kelas->getKelas($id, 3);

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/detail', $data);
        $this->load->view('templates/footer');
    }

    public function ubah($id)
    {
        /* edit data siswa berdasarkan id */
        $data['title'] = 'Edit Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['siswa'] = $this->siswa->getSiswa($id);

        $this->form_validation->set_rules('nis', 'Nomor Induk Sekolah', 'required|trim|is_unique[guru.nip]|callback_nis_edit[' . $id . ']');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
        $this->form_validation->set_rules('tahun-masuk', 'Tahun Masuk', 'required|trim|exact_length[4]');

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

    public function nis_edit($nis, $id)
    {
        $result = $this->siswa->check_unique_nis($id, $nis);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('nis_edit', 'Bidang {field} harus unik' . $result);
            $response = false;
        }
        return $response;
    }

    public function hapus($id)
    {
        $dataUser = $this->user->getUserSiswa($id); //mengambil data user yang ingin dihapus akunnya berdasarkan id_siswa
        $this->user->delete(3, $dataUser['id']);
        $this->siswa->hapusSiswa($id);  //menghapus data siswa berdasarkan idnya
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You\'ve succesfully deleted siswa!</div>');
        redirect('siswa');
    }

    public function tambah()
    {
        /* menambahkan data siswa berdasarkan id */

        $data['title'] = 'Tambah Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));

        $this->form_validation->set_rules('nis', 'Nomor Induk Sekolah', 'required|trim|is_unique[siswa.nis]|is_unique[guru.nip]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
        $this->form_validation->set_rules('tahun-masuk', 'Tahun Masuk', 'required|trim|exact_length[4]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('siswa/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->siswa->tambahSiswa();
            $this->user->tambahUser(3);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil menambahkan siswa baru.</div>');
            redirect('siswa');
        }
    }

    public function template()
    {
        //ini buat nyimpen template doang

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
