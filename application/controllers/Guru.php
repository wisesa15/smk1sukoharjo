<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Guru_model', 'guru');
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
}
