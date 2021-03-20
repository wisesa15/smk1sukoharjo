<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Guru_model', 'guru');
        $this->load->model('Kelas_model', 'kelas');
        $this->load->model('Siswa_model', 'siswa');
    }
    public function index()
    {
        /* menampilkan halaman dashboard - halaman yang ditampilkan tergantung role dari user yang login*/

        $data['title'] = 'Dashboard';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));

        if ($this->session->userdata('role_id') == 1) {
            //apabila role user adalah admin
            $this->load->view('templates/header', $data);
            $this->load->view('dashboard/admin');
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('role_id') == 2) {
            //apabila role user adalah guru
            $data['guru'] = $this->guru->getGuru($data['user']['id_guru']); //menyiapkan data guru yang login
            $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id')); //menyiapkan data kelas guru yang login untuk sidebar
            $this->load->view('templates/header', $data);
            $this->load->view('dashboard/guru', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('role_id') == 3) {
            //apabila role user adalah siswa
            $data['siswa'] = $this->siswa->getSiswa($data['user']['id_siswa']); //menyiapkan data siswa yang login
            $data['kelas'] = $this->kelas->getKelas($data['siswa']['id'], $this->session->userdata('role_id')); //menyiapkan data kelas siswa yang login untuk sidebar
            $this->load->view('templates/header', $data);
            $this->load->view('dashboard/siswa', $data);
            $this->load->view('templates/footer');
        }
    }
}
