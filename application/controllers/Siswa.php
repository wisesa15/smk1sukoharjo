<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Siswa_model', 'siswa');
        $this->load->model('Kelas_model', 'kelas');
    }

    public function index()
    {
        /* menampilkan daftar siswa - untuk admin */
        $data['title'] = 'Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['siswa'] = $this->siswa->getAllSiswa();

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function import()
    {
        $data['title'] = 'Import CSV Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $memCsv = array();

        $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('siswa/import', $data);
            $this->load->view('templates/footer');
        } else {
            $insertCount = $rowCount = $notAddCount = 0;

            // If file uploaded
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                // Load CSV reader library
                $this->load->library('CSVReader');

                // Parse data from CSV file
                $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                // Insert/update CSV data into database
                if (!empty($csvData)) {
                    foreach ($csvData as $row) {
                        $rowCount++;

                        // Prepare data for DB insertion
                        $memCsv = array(
                            'nis' => $row['NIS'],
                            'Nama' => $row['Nama'],
                            'tahun_masuk' => $row['Tahun'],
                            'jurusan' => $row['Jurusan'],
                        );

                        // Check whether email already exists in the database
                        $con = array(
                            'where' => array(
                                'nis' => $row['NIS']
                            ),
                            'returnType' => 'count'
                        );
                        $prevCount = $this->siswa->getRows($con);

                        if ($prevCount == 0) {
                            // Insert member data
                            $insert = $this->siswa->importSiswa($memCsv);
                            $this->user->importUser(3, $row['NIS']);

                            if ($insert) {
                                $insertCount++;
                            }
                        }
                    }

                    // Status message with imported data count
                    $notAddCount = ($rowCount - $insertCount);
                    $successMsg = '<div class="alert alert-success" role="alert">Berhasil menambah siswa. Jumlah baris (' . $rowCount . ') | Baris yang berhasil ditambah (' . $insertCount . ') | Baris yang gagal ditambah (' . $notAddCount . ')</div>';
                    $this->session->set_flashdata('message', $successMsg);
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Gagal mengunggah file, tolong coba lagi</div>');
            }
            // $this->siswa->tambahSiswa();
            // $this->user->tambahUser(3);
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil mengubah data ' . $data['siswa']['nama'] . '.</div>');
            redirect('siswa');
        }
    }

    public function file_check($str)
    {
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if (($ext == 'csv') && in_array($mime, $allowed_mime_types)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }

    public function detail($id)
    {
        /* menampilkan detail siswa berdasarkan id */

        $data['title'] = 'Detail Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['siswa'] = $this->siswa->getSiswa($id);
        $data['kelas'] = $this->kelas->getKelas($id, 3);

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/detail', $data);
        $this->load->view('templates/footer');
    }

    public function ubah($id)
    {
        /* edit data siswa berdasarkan id */
        $data['title'] = 'Edit Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $data['siswa'] = $this->siswa->getSiswa($id);

        $this->form_validation->set_rules('nis', 'Nomor Induk Sekolah', 'required|trim|is_unique[guru.nip]|callback_nis_edit[' . $id . ']');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
        $this->form_validation->set_rules('tahun-masuk', 'Tahun Masuk', 'required|trim|exact_length[4]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('siswa/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->siswa->editSiswa($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil mengubah data ' . $data['siswa']['nama'] . '.</div>');
            redirect('siswa');
        }
    }

    public function nis_edit($nis, $id)
    {
        $result = $this->siswa->check_unique_nis($id, $nis);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('nis_edit', 'Bidang {field} harus unik' . $result);
            $response = false;
        }
        return $response;
    }

    public function hapus($id)
    {
        $dataUser = $this->user->getUserSiswa($id); //mengambil data user yang ingin dihapus akunnya berdasarkan id_siswa
        $this->user->delete(3, $dataUser['id']);
        $this->siswa->hapusSiswa($id);  //menghapus data siswa berdasarkan idnya
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You\'ve succesfully deleted siswa!</div>');
        redirect('siswa');
    }

    public function tambah()
    {
        /* menambahkan data siswa berdasarkan id */

        $data['title'] = 'Tambah Siswa';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));

        $this->form_validation->set_rules('nis', 'Nomor Induk Sekolah', 'required|trim|is_unique[siswa.nis]|is_unique[guru.nip]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
        $this->form_validation->set_rules('tahun-masuk', 'Tahun Masuk', 'required|trim|exact_length[4]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('siswa/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->siswa->tambahSiswa();
            $this->user->tambahUser(3);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil menambahkan siswa baru.</div>');
            redirect('siswa');
        }
    }

    public function template()
    {
        //ini buat nyimpen template doang

        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated.</div>');
            redirect('user');
        }
    }
}
