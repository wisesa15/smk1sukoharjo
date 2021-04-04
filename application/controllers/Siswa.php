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

        $config['base_url'] = base_url('siswa/index');
        $config['total_rows'] = $this->siswa->getSiswaCount();
        $config['per_page'] = 20;
        $config['num_links'] = 1;
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '<span aria-hidden="true">»</span><span class="sr-only">Next</span>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true">«</span><span class="sr-only">Previous</span>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['siswa'] = $this->siswa->getSiswaLimit($config['per_page'], $page);

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

        $this->form_validation->set_rules('nis', 'Nomor Induk Sekolah', 'required|trim|is_unique[siswa.nis]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');

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
