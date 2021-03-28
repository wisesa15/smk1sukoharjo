<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Kelas_model', 'kelas');
        $this->load->model('Guru_model', 'guru');
        $this->load->model('Siswa_model', 'siswa');
    }

    public function index()
    {
        /* menampilkan profile user */

        $data['title'] = 'Profile'; //title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //data user yg login

        if ($data['user']['role_id'] == 1) {
            $this->load->view('templates/header', $data);
        } else {
            if ($data['user']['role_id'] == 2) {
                $data['guru'] = $this->guru->getGuru($data['user']['id_guru']);
                $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id')); //untuk sidebar 
            } else {
                $data['siswa'] = $this->siswa->getSiswa($data['user']['id_siswa']);
                $data['kelas'] = $this->kelas->getKelas($data['siswa']['id'], $this->session->userdata('role_id')); //untuk sidebar
            }
            $this->load->view('templates/header', $data);
        }
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }

    public function EditPassword()
    {
        /* mengedit profile user */

        $data['title'] = 'Edit Password'; //title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //data user yang login
        if ($data['user']['role_id'] == 2) //untuk kepentingan sidebar guru (kelas yang dia ajar)
        {
            $data['guru'] = $this->guru->getGuru($data['user']['id_guru']);
            $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id'));
        } else if ($data['user']['role_id'] == 3) {
            $data['siswa'] = $this->siswa->getSiswa($data['user']['id_siswa']);
            $data['kelas'] = $this->kelas->getKelas($data['siswa']['id'], $this->session->userdata('role_id')); //untuk sidebar
        }
        $this->form_validation->set_rules('old_password', 'Old Password', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|matches[n_password]');
        $this->form_validation->set_rules('n_password', 'New Password', 'trim|matches[password]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('profile/edit_password', $data);
            $this->load->view('templates/footer');
        } else {
            if (password_verify($this->input->post('old_password'), $data['user']['password'])) {
                $this->user->editpassword($data['user']['id']);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated.</div>');
                redirect('profile');
            }
        }
    }

    public function EditProfile()
    {
        /* mengedit profile user */

        $data['title'] = 'Edit Profile'; //title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //data user yang login
        if ($data['user']['role_id'] == 2) //untuk kepentingan sidebar guru (kelas yang dia ajar)
        {
            $data['guru'] = $this->guru->getGuru($data['user']['id_guru']);
            $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id'));
        } else if ($data['user']['role_id'] == 3) {
            $data['siswa'] = $this->siswa->getSiswa($data['user']['id_siswa']);
            $data['kelas'] = $this->kelas->getKelas($data['siswa']['id'], $this->session->userdata('role_id')); //untuk sidebar
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('profile/edit_profile', $data);
            $this->load->view('templates/footer');
        } else {
            $username = htmlspecialchars($this->input->post('username'));
            //cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            $new_image = NULL;
            if ($upload_image) {
                $config['upload_path'] = './assets/images/profile';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }
            if ($new_image) {
                $this->user->editprofile($data['user']['id'], $username, $new_image);
            } else {
                $this->user->editprofile($data['user']['id'], $username);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated.</div>');
            redirect('profile');
            // if (password_verify($this->input->post('old_password'), $data['user']['password'])) {
            //     $this->user->editpassword($data['user']['id']);
            //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated.</div>');
            //     redirect('profile');
            // }
        }
    }
}
