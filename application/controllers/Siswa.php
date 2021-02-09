<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function index()
    {
        //liat role id session
        $data['title'] = 'Data Siswa';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/index');
        $this->load->view('templates/footer');
    }
}
