<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        //liat role id session
        if ($this->session->userdata('role_id') == 1) {
            //admin
            $this->load->view('templates/header');
            $this->load->view('dashboard/admin');
            $this->load->view('templates/footer');
        }
    }
}
