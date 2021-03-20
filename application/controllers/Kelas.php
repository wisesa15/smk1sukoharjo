<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Kelas_model', 'kelas');
    }

    public function index()
    {
        /* menampilkan daftar semua kelas untuk admin */

        $data['title'] = 'Kelas'; //title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //data user yg login
        $data['kelas'] = $this->kelas->getAllKelas(); //data untuk ditampilkan
        $data['pengajar'] = []; //data pengajar tiap kelas

        //loop untuk mengambil data pengajar yang mengajar di tiap kelas
        foreach ($data['kelas'] as $k) :
            $pengajar = $this->kelas->getAllGuru($k['id']);
            array_push($data['pengajar'], $pengajar);
        endforeach;

        $this->load->view('templates/header', $data);
        $this->load->view('kelas/admin', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id_kelas)
    {
        /* menampilkan detail kelas berdasarkan id kelas yang ingin dilihat */

        $data['user'] = $this->user->getUser($this->session->userdata('id')); //data user yang login
        $data['kelas'] = $this->kelas->getAllKelas();
        $data_kelas = $this->kelas->getDetail($id_kelas);
        $data['detail'] = $data_kelas;
        $data['title'] = $data_kelas['nama'];
        $data_aktivitas = $this->kelas->getPertemuan($id_kelas);
        $data['aktivitas'] = $data_aktivitas;
        $data['file'] = [];
        foreach ($data_aktivitas as $a) :
            $file = $this->kelas->getFile($a['id']);
            array_push($data['file'], $file);
        endforeach;
        if ($data['user']['role_id'] == 2) {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/detail', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/detail_siswa', $data);
            $this->load->view('templates/footer');
        }
    }

    public function tambahPertemuan($id_kelas)
    {
        /* menambah pertemuan di suatu kelas (untuk admin dan guru) */

        $data['title'] = 'Tambah Pertemuan'; //title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //data user yg login 
        $data['detailKelas'] = $this->kelas->getDetail($id_kelas);
        $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id')); //untuk sidebar guru (kelas yang dia ajar)

        $this->form_validation->set_rules('aktivitas', 'Nama Aktivitas', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/tambah_pertemuan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->kelas->tambahPertemuan($id_kelas);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil menambah data ' . $data['kelas']['nama'] . '.</div>');
            redirect('kelas/detail/' . $id_kelas);
        }
    }

    public function tambahMateri($id_pertemuan)
    {
        /* menambah materi untuk suatu pertemuan pada suatu kelas (untuk admin dan guru) */
        $data['title'] = 'Tambah Materi';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['detailPertemuan'] = $this->kelas->getDetailPertemuan($id_pertemuan);
        $data['detailKelas'] = $this->kelas->getDetail($data['detailPertemuan']['id_kelas']);
        $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id')); //untuk sidebar guru (kelas yang dia ajar)

        $this->form_validation->set_rules('nama_file', 'Nama file', 'required|trim');
        $this->form_validation->set_rules('jenis', 'jenis', 'required|trim');
        $this->form_validation->set_rules('dataTampil', 'Tanggal Ditampilkan', 'required');
        $this->form_validation->set_rules('dateline', 'Dateline', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/tambah_Materi', $data);
            $this->load->view('templates/footer');
        } else {

            $this->kelas->tambahMateri($id_pertemuan);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil mengubah data ' . $this->input->post('dataTampil') . '.</div>');
            redirect('kelas/detail/' . $data['detailPertemuan']['id_kelas']);
            // redirect('kelas');
        }
    }
    public function editMateri($id_materi)
    {
        $data['file'] = $this->kelas->getDetailFile($id_materi);
        $data['title'] = 'Edit Materi';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['detailPertemuan'] = $this->kelas->getDetailPertemuan($data['file']['id_aktivitas']);
        $data['detailKelas'] = $this->kelas->getDetail($data['detailPertemuan']['id_kelas']);
        $data['kelas'] = $this->kelas->getAllKelas();


        $this->form_validation->set_rules('nama_file', 'Nama file', 'required|trim');
        $this->form_validation->set_rules('jenis', 'jenis', 'required|trim');
        $this->form_validation->set_rules('dataTampil', 'Tanggal Ditampilkan', 'required');
        $this->form_validation->set_rules('dateline', 'Dateline', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/edit_Materi', $data);
            $this->load->view('templates/footer');
        } else {

            $this->kelas->tambahMateri($id_pertemuan);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil mengubah data ' . $this->input->post('dataTampil') . '.</div>');
            redirect('kelas/detail/' . $data['detailPertemuan']['id_kelas']);
            // redirect('kelas');
        }
    }
}
