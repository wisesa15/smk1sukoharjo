<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        //liat role id session
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        if ($this->session->userdata('role_id') == 1) {
            //admin
            $this->load->view('templates/header', $data);
            $this->load->view('dashboard/admin');
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('role_id') == 2) {
            //guru
            $this->load->view('templates/header', $data);
            $this->load->view('dashboard/guru');
            $this->load->view('templates/footer');
        }
    }
}
