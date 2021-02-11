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
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
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
        $data['user'] = $this->user->getUser($this->session->userdata('username'));
        $data['kelas'] = $this->kelas->getAllKelas();
        $data_kelas = $this->kelas->getDetail($id_kelas);
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
}
