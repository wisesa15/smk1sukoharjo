<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Guru_model', 'guru');
        $this->load->model('Kelas_model', 'kelas');
    }

    public function index()
    {
        /* menampilkan halaman guru untuk admin*/

        $data['title'] = 'Guru'; //untuk title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //untuk data user yang login

        $data['guru'] = $this->guru->getAllGuru();

        $this->load->view('templates/header', $data);
        $this->load->view('guru/index', $data);
        $this->load->view('templates/footer');
    }

    public function import()
    {
        $data['title'] = 'Import CSV Guru';
        $data['user'] = $this->user->getUser($this->session->userdata('id'));
        $memCsv = array();

        $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('guru/import', $data);
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
                            'nip' => $row['NIP'],
                            'nama' => $row['Nama'],
                        );

                        // Check whether email already exists in the database
                        $con = array(
                            'where' => array(
                                'nip' => $row['NIP']
                            ),
                            'returnType' => 'count'
                        );
                        $prevCount = $this->guru->getRows($con);

                        if ($prevCount == 0) {
                            // Insert member data
                            $insert = $this->guru->importGuru($memCsv);
                            $this->user->importUser(2, $row['NIP']);

                            if ($insert) {
                                $insertCount++;
                            }
                        }
                    }

                    // Status message with imported data count
                    $notAddCount = ($rowCount - $insertCount);
                    $successMsg = '<div class="alert alert-success" role="alert">Berhasil menambah guru. Jumlah baris (' . $rowCount . ') | Baris yang berhasil ditambah (' . $insertCount . ') | Baris yang gagal ditambah (' . $notAddCount . ')</div>';
                    $this->session->set_flashdata('message', $successMsg);
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Gagal mengunggah file, tolong coba lagi</div>');
            }
            // $this->siswa->tambahSiswa();
            // $this->user->tambahUser(3);
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil mengubah data ' . $data['siswa']['nama'] . '.</div>');
            redirect('guru');
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
        /* menampilkan halaman detail guru berdasarkan id yang dipilih untuk admin */

        $data['title'] = 'Detail Guru'; //untuk title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //untuk data user yang login
        $data['guru'] = $this->guru->getGuru($id); //untuk menampilkan data detail data guru
        $data['kelas'] = $this->kelas->getKelas($id, 2); //untuk menampilkan data yang diajar oleh guru tersebut

        $this->load->view('templates/header', $data);
        $this->load->view('guru/detail', $data);
        $this->load->view('templates/footer');
    }

    public function ubah($id)
    {
        /* form edit data guru */

        $data['title'] = 'Edit Guru'; //untuk title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //untuk data user yang login
        $data['guru'] = $this->guru->getGuru($id); //untuk menampilkan data guru yang ingin diedit

        $this->form_validation->set_rules('nip', 'Nomor Indentitas Pegawai Negeri Sipil', 'required|trim|is_unique[siswa.nis]|callback_nip_edit[' . $id . ']');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('guru/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->guru->editGuru($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil mengubah data ' . $data['guru']['nama'] . '.</div>');
            redirect('guru');
        }
    }

    public function nip_edit($nip, $id)
    {
        $result = $this->guru->check_unique_nip($id, $nip);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('nip_edit', 'Bidang {field} harus unik' . $result);
            $response = false;
        }
        return $response;
    }

    public function hapus($id)
    {
        $dataUser = $this->user->getUserGuru($id); //mengambil data user yang ingin dihapus akunnya berdasarkan id_guru
        $this->user->delete(2, $dataUser['id']);
        $this->guru->hapusGuru($id);  //menghapus data guru berdasarkan idnya
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You\'ve succesfully deleted guru!</div>');
        redirect('guru');
    }

    public function tambah()
    {
        /* tambah() digunakan untuk menambah data guru */

        $data['title'] = 'Tambah Guru'; // untuk title web
        $data['user'] = $this->user->getUser($this->session->userdata('id')); //untuk data user yang login

        $this->form_validation->set_rules('nip', 'Nomor Induk Pegawai Negeri', 'required|trim|is_unique[guru.nip]|is_unique[siswa.nis]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('guru/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->guru->tambahGuru();
            $this->user->tambahUser(2);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil menambahkan guru baru.</div>');
            redirect('guru');
        }
    }
}
