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
        //liat role id session
        $data['title'] = 'Kelas';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['kelas'] = $this->kelas->getAllKelas();
        $data['pengajar'] = [];
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
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
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
        $this->load->view('templates/header', $data);
        $this->load->view('kelas/detail', $data);
        $this->load->view('templates/footer');
    }
    public function tambahPertemuan($id_kelas)
    {
        $data['title'] = 'Tambah Pertemuan';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['detailKelas'] = $this->kelas->getDetail($id_kelas);
        $data['kelas'] = $this->kelas->getAllKelas();

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
        $data['title'] = 'Tambah Materi';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['detailPertemuan'] = $this->kelas->getDetailPertemuan($id_pertemuan);
        $data['detailKelas'] = $this->kelas->getDetail($data['detailPertemuan']['id_kelas']);
        $data['kelas'] = $this->kelas->getAllKelas();

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
}
