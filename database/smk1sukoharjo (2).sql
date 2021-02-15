-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2021 at 02:21 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smk1sukoharjo`
--

--
-- Dumping data for table `aktivitas_kelas`
--

INSERT INTO `aktivitas_kelas` (`id`, `id_kelas`, `nama_kegiatan`) VALUES
(1, 1, 'Pertemuan-1 '),
(3, 1, 'pertemuan 2');

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `id_aktivitas`, `nama`, `nama_file`, `jenis`, `tgl_ditampilkan`, `tenggalwaktu`) VALUES
(1, 1, 'Pertemuan-1', 'Materi-1', 1, 10, 0),
(3, 1, 'tugas-1', 'tugas-matematik', 2, 10, 20),
(8, 3, 'materi-3', 'ini', 1, 1613084400, 1613170800),
(9, 3, 'materi-3', 'ini', 1, 1613210280, 1613372100);

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama`) VALUES
(1, 123, 'Suprapto'),
(2, 124, 'Joni');

--
-- Dumping data for table `jenis_file`
--

INSERT INTO `jenis_file` (`id`, `jenis_file`) VALUES
(1, 'Materi'),
(2, 'Tugas');

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `id_mapel`, `gambar`) VALUES
(1, 'Ilmu Komputer 2020', 1, ''),
(2, 'Jaringan 2021', 2, '');

--
-- Dumping data for table `kelas_guru`
--

INSERT INTO `kelas_guru` (`id`, `id_guru`, `id_kelas`) VALUES
(1, 1, 1),
(5, 1, 2);

--
-- Dumping data for table `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id`, `id_siswa`, `id_kelas`) VALUES
(1, 1, 1);

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `nama`) VALUES
(1, 'Ilmu Komputer'),
(2, 'Jaringan');

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `kelas`) VALUES
(1, 123, 'JuanP', 'XII TKJ'),
(2, 124, 'Jojon', 'XII TKJ'),
(3, 125, 'Sumanto', 'XII RPL');

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role_id`, `id_siswa`, `id_guru`, `image`, `date_created`) VALUES
(3, 'admin', '$2y$10$a1oCFaUfW4Zeij./h/CC7.1ntQGsYnSBnhqHlj2O/7N9L.1.NP4NC', 1, NULL, NULL, 'default.jpg', 1612851981),
(6, 'guru', '$2y$10$h51Ufh0gTCd6Rv0P/ZEkzu9P0giEWEgy31/6DphtgVj63ApIEoNEO', 2, NULL, 1, 'default.jpg', 1613116471),
(7, 'siswa', '$2y$10$Fwl7iGXDXtpvDn9zp3whJ.qmzOO1UhFkW6I7lt9jK2x7QfGDGA/VK', 3, 1, NULL, 'default.jpg', 1613117307);

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 1, 2),
(5, 1, 3),
(6, 1, 4),
(7, 2, 4),
(8, 3, 4),
(9, 1, 5),
(10, 2, 5),
(11, 3, 5);

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `url`, `icon`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-fw fa-tachometer-alt'),
(2, 'Siswa', 'siswa', 'fas fa-fw fa-user-graduate'),
(3, 'Guru', 'guru', 'fas fa-fw fa-chalkboard-teacher'),
(4, 'Kelas', 'kelas', 'fas fa-fw fa-book-open'),
(5, 'Profile', 'profile', 'fas fa-fw fa-user-circle');

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'guru'),
(3, 'siswa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
