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
        $config['base_url'] = base_url('guru/index');
        $config['total_rows'] = $this->guru->getGuruCount();
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
        $data['page'] = $page;
        $data['guru'] = $this->guru->getGuruLimit($config['per_page'], $page);

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

    public function ubah($id)
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

    public function hapus($id)
    {
        $dataUser = $this->user->getUserGuru($id); //mengambil data user yang ingin dihapus akunnya berdasarkan id_guru
        $this->user->delete(2, $dataUser['id']);
        $this->guru->hapusGuru($id);  //menghapus data guru berdasarkan idnya
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You\'ve succesfully deleted guru!</div>');
        redirect('guru');
    }

    public function tambah()
    {
        /* tambah() digunakan untuk menambah data guru */

        $data['title'] = 'Tambah Guru'; // untuk title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //untuk data user yang login

        $this->form_validation->set_rules('nip', 'Nomor Induk Pegawai Negeri', 'required|trim|is_unique[guru.nip]');
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
