<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Kelas_model', 'kelas');
        $this->load->model('guru_model', 'guru');
        $this->load->model('siswa_model', 'siswa');
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
        $data_kelas = $this->kelas->getDetail($id_kelas);
        $data['detail'] = $data_kelas;
        $data['title'] = $data_kelas['nama'];
        $data_aktivitas = $this->kelas->getPertemuan($id_kelas);
        $data['aktivitas'] = $data_aktivitas;
        $data['file'] = [];
        if ($data['user']['role_id'] == 2) //untuk kepentingan sidebar guru (kelas yang dia ajar)
        {
            $data['guru'] = $this->guru->getGuru($data['user']['id_guru']);
            $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id'));
        } else  if ($data['user']['role_id'] == 3) //untuk kepentingan sidebar siswa
        {
            $data['siswa'] = $this->siswa->getSiswa($data['user']['id_siswa']);
            $data['kelas'] = $this->kelas->getKelas($data['siswa']['id'], $this->session->userdata('role_id'));
        }
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

    public function tambah()
    {
        /* menambahkan kelas baru */

        $data['user'] = $this->user->getUser($this->session->userdata('id')); //data user yang login
        $data['title'] = 'Tambah Kelas';

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = htmlspecialchars($this->input->post('nama'));
            $upload_image = $_FILES['gambar']['name'];
            $new_image = NULL;
            if ($upload_image) {
                $config['upload_path'] = './assets/images/profile';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $new_image = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tolong pilih gambar yang sesuai</div>');
                    redirect('kelas/tambah');
                    // echo $this->upload->display_errors();
                }
            }
            if ($new_image) {
                $this->kelas->tambah($nama, $new_image);
            } else {
                $this->kelas->tambah($nama);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil menambahkan kelas</div>');
            redirect('kelas');
        }
    }

    public function tambahPertemuan($id_kelas)
    {
        /* menambah pertemuan di suatu kelas (untuk admin dan guru) */

        $data['title'] = 'Tambah Pertemuan'; //title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //data user yg login 
        $data['detailKelas'] = $this->kelas->getDetail($id_kelas);

        if ($data['user']['role_id'] == 2) //untuk kepentingan sidebar guru (kelas yang dia ajar)
        {
            $data['guru'] = $this->guru->getGuru($data['user']['id_guru']);
            $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id'));
        }

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
        if ($data['user']['role_id'] == 2) //untuk kepentingan sidebar guru (kelas yang dia ajar)
        {
            $data['guru'] = $this->guru->getGuru($data['user']['id_guru']);
            $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id'));
        }
        $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id')); //untuk sidebar guru (kelas yang dia ajar)

        $this->form_validation->set_rules('nama_file', 'Nama file', 'required|trim');
        $this->form_validation->set_rules('jenis', 'jenis', 'required|trim');
        $this->form_validation->set_rules('dataTampil', 'Tanggal Ditampilkan', 'required');
        $this->form_validation->set_rules('dateline', 'Dateline', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        $config['upload_path']          = './assets/file/';
        $config['allowed_types']        = 'pdf|ppt|docx';
        $config['max_size']             = 10000;


        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/tambah_Materi', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('userfile')) {
                $nama_file = $this->upload->data();
                $nama_file = $nama_file['file_name'];
            }
            $this->kelas->tambahMateri($id_pertemuan, $nama_file);
            redirect('kelas/detail/' . $data['detailPertemuan']['id_kelas']);
        }
        /*
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/tambah_Materi', $data);
            $this->load->view('templates/footer');
        } else {

            $this->kelas->tambahMateri($id_pertemuan);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil mengubah data ' . $this->input->post('dataTampil') . '.</div>');
            redirect('kelas/detail/' . $data['detailPertemuan']['id_kelas']);
            // redirect('kelas');
        }*/
    }
    public function editMateri($id_materi)
    {
        $data['file'] = $this->kelas->getDetailFile($id_materi);
        $data['title'] = 'Edit Materi';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['detailPertemuan'] = $this->kelas->getDetailPertemuan($data['file']['id_aktivitas']);
        $data['detailKelas'] = $this->kelas->getDetail($data['detailPertemuan']['id_kelas']);
        $data['kelas'] = $this->kelas->getAllKelas();
        $data['materi'] = $this->kelas->getMateri($id_materi);
        $data['detailKelas'] = $this->kelas->getDetail($data['detailPertemuan']['id_kelas']);
        if ($data['user']['role_id'] == 2) //untuk kepentingan sidebar guru (kelas yang dia ajar)
        {
            $data['guru'] = $this->guru->getGuru($data['user']['id_guru']);
            $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id'));
        }
        $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id')); //untuk sidebar guru (kelas yang dia ajar)

        $this->form_validation->set_rules('nama_file', 'Nama file', 'required|trim');
        $this->form_validation->set_rules('jenis', 'jenis', 'required|trim');
        $this->form_validation->set_rules('dataTampil', 'Tanggal Ditampilkan', 'required');
        $this->form_validation->set_rules('dateline', 'Dateline', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        $config['upload_path']          = './assets/file/';
        $config['allowed_types']        = 'pdf|ppt|docx';
        $config['max_size']             = 10000;


        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/edit_Materi', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('userfile')) {
                $nama_file = $this->upload->data();
                $nama_file = $nama_file['file_name'];
            }
            $this->kelas->editMateri($data['materi']['id'], $nama_file);
            redirect('kelas/detail/' . $data['detailPertemuan']['id_kelas']);
        }
    }
    public function deleteMateri($id_materi)
    {
        $data['file'] = $this->kelas->getDetailFile($id_materi);
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['detailPertemuan'] = $this->kelas->getDetailPertemuan($data['file']['id_aktivitas']);
        $data['file'] = $this->kelas->getDetailFile($id_materi);
        $data['title'] = 'Delete Materi';
        $id = $data['detailPertemuan']['id_kelas'];
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['detailPertemuan'] = $this->kelas->getDetailPertemuan($data['file']['id_aktivitas']);
        $this->kelas->deleteMateri($id_materi);
        redirect('kelas/detail/' . $id);
    }

    public function detailMateri($id_materi)
    {
        $data['file'] = $this->kelas->getDetailFile($id_materi);
        $data['title'] = 'Detail Materi';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['detailPertemuan'] = $this->kelas->getDetailPertemuan($data['file']['id_aktivitas']);
        $data['detailKelas'] = $this->kelas->getDetail($data['detailPertemuan']['id_kelas']);
        $data['file'] = $this->kelas->getDetailFile($id_materi);
        if ($data['user']['role_id'] == 2) //untuk kepentingan sidebar guru (kelas yang dia ajar)
        {
            $data['guru'] = $this->guru->getGuru($data['user']['id_guru']);
            $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id'));
        } else  if ($data['user']['role_id'] == 3) //untuk kepentingan sidebar siswa
        {
            $data['siswa'] = $this->siswa->getSiswa($data['user']['id_siswa']);
            $data['kelas'] = $this->kelas->getKelas($data['siswa']['id'], $this->session->userdata('role_id'));
            $data['check'] = $this->kelas->checkPekerjaan($data['siswa']['id'], $data['file']['id']);
        }


        $config['upload_path']          = './assets/file/';
        $config['allowed_types']        = 'pdf|ppt|docx';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);
        if (!$_FILES) {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/detail_materi_siswa', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('userfile')) {
                $nama_file = $this->upload->data();
                $nama_file = $nama_file['file_name'];
            }
            $this->kelas->uploadMateri($data['siswa']['id'], $data['file']['id'], $nama_file);
            redirect('kelas/detailMateri/' . $data['file']['id']);
        }
    }

    public function masterFile($id_materi)
    {
        $data['file'] = $this->kelas->getDetailFile($id_materi);
        $data['title'] = 'Master Materi';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['detailPertemuan'] = $this->kelas->getDetailPertemuan($data['file']['id_aktivitas']);
        $data['detailKelas'] = $this->kelas->getDetail($data['detailPertemuan']['id_kelas']);
        $data['file'] = $this->kelas->getDetailFile($id_materi);
        $data['guru'] = $this->guru->getGuru($data['user']['id_guru']);
        $data['kelas'] = $this->kelas->getKelas($data['guru']['id'], $this->session->userdata('role_id'));
        $data['allSiswa'] = $this->kelas->getAllSiswaKelas($data['kelas']['id']);
        foreach ($data['allSiswa'] as $data_siswa):
            $data['check'] = $this->kelas->checkPekerjaan($data['siswa']['id'], $data['file']['id']);
    }
}
