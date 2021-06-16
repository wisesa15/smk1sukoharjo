-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2021 at 12:26 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas_kelas`
--

CREATE TABLE `aktivitas_kelas` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aktivitas_kelas`
--

INSERT INTO `aktivitas_kelas` (`id`, `id_kelas`, `nama_kegiatan`) VALUES
(1, 1, 'Pertemuan-1 '),
(3, 1, 'pertemuan 2'),
(4, 1, 'pertemuan 3'),
(5, 2, 'pertemuan 1');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `id_aktivitas` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `jenis` int(11) NOT NULL,
  `tgl_ditampilkan` int(11) NOT NULL,
  `tenggalwaktu` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `id_aktivitas`, `nama`, `nama_file`, `jenis`, `tgl_ditampilkan`, `tenggalwaktu`, `keterangan`) VALUES
(22, 1, 'tugas', 'Surat_Pernyataan_Kesanggupan_240601181301324.pdf', 2, 1617524040, 1617538380, '<p>Ini TUgas</p>'),
(25, 1, 'materi-3', 'Coursera_2NTW8F55J5EX-merged32.pdf', 1, 1617522120, 1617525420, '<p>Muhammad Rizal</p>');

-- --------------------------------------------------------

--
-- Table structure for table `file_tugas_siswa`
--

CREATE TABLE `file_tugas_siswa` (
  `id` int(11) NOT NULL,
  `id_file` int(11) NOT NULL,
  `nama_file` varchar(40) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file_tugas_siswa`
--

INSERT INTO `file_tugas_siswa` (`id`, `id_file`, `nama_file`, `id_siswa`) VALUES
(12, 22, 'Coursera_PA7WC3CKVB2M8.pdf', 3);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama`) VALUES
(1, 123, 'Suprapto'),
(2, 124, 'Joni'),
(3, 125, 'Indra'),
(4, 126, 'Arif'),
(5, 127, 'Eko'),
(6, 128, 'Kurniawan'),
(7, 129, 'Sri'),
(8, 130, 'Tyas'),
(9, 131, 'Dian'),
(10, 132, 'Maya'),
(11, 133, 'Ika'),
(12, 134, 'Yudi'),
(13, 135, 'Andy'),
(14, 136, 'Siti'),
(15, 137, 'Reza'),
(16, 138, 'Fitri'),
(17, 139, 'Indah'),
(18, 140, 'dwi'),
(19, 141, 'Maria'),
(20, 142, 'Lia');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_file`
--

CREATE TABLE `jenis_file` (
  `id` int(11) NOT NULL,
  `jenis_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_file`
--

INSERT INTO `jenis_file` (`id`, `jenis_file`) VALUES
(1, 'Materi'),
(2, 'Tugas');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `gambar`) VALUES
(1, 'Ilmu Komputer 2020', ''),
(2, 'Jaringan 2021', '');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_guru`
--

CREATE TABLE `kelas_guru` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_guru`
--

INSERT INTO `kelas_guru` (`id`, `id_guru`, `id_kelas`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id`, `id_siswa`, `id_kelas`) VALUES
(1, 1, 1),
(2, 3, 1),
(4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `kelas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `kelas`) VALUES
(1, 123, 'JuanP', 'XII TKJ'),
(2, 124, 'Jojon', 'XII TKJ'),
(3, 125, 'Sumanto', 'XII RPL'),
(4, 126, 'Muhammad Rizal', '12 IPA 2'),
(5, 127, 'Aulia', 'XII'),
(6, 128, 'Utami', 'XI'),
(7, 129, 'Tika', 'XI'),
(8, 130, 'Hadi', '129'),
(9, 131, 'Bazu', 'XII'),
(10, 132, 'Annisa', 'XII'),
(12, 133, 'Retno', 'X1'),
(13, 134, 'Fajar', 'XI'),
(15, 135, 'Wulandari', 'XI'),
(16, 136, 'Nurul', 'XI'),
(18, 137, 'Rini', 'XI'),
(19, 138, 'Ilham', 'XI'),
(20, 139, 'Kusuma', 'XI'),
(21, 140, 'Rizki', 'XI'),
(22, 141, 'Dinda', 'XI'),
(23, 142, 'Andre', 'Xi'),
(24, 143, 'Ari', 'XI');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `image` varchar(256) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role_id`, `id_siswa`, `id_guru`, `image`, `date_created`) VALUES
(3, 'admin', '$2y$10$a1oCFaUfW4Zeij./h/CC7.1ntQGsYnSBnhqHlj2O/7N9L.1.NP4NC', 1, NULL, NULL, 'default.jpg', 1612851981),
(6, 'guru', '$2y$10$b0s5514YrNJOmrxwZXac2OgsYEhFG0VbGBS0/pYr1BLnpgne9OgCS', 2, NULL, 1, 'horse-60153_1920.jpg', 1613116471),
(7, 'siswa', '$2y$10$Fwl7iGXDXtpvDn9zp3whJ.qmzOO1UhFkW6I7lt9jK2x7QfGDGA/VK', 3, 1, NULL, 'default.jpg', 1613117307),
(8, 'siswa2', '$2y$10$z8u4qDIW8aARFv6d5fwYVep1RNizAi260JfugO/ZZjx1OS0ERHGoe', 3, 3, NULL, 'default.jpg', 1617329348),
(9, '126', '$2y$10$5gK3rGy33aXXfsIDxZbgqeBunvUPBOjeXLOoS.erAkEm/kdebsy8u', 3, 4, NULL, 'default.jpg', 1617377395),
(10, '127', '$2y$10$9xR71fqZHZ8uvFggCMYQL.lXxcirdhAOLYdDHyra2uC7wy0PZSG8G', 3, 5, NULL, 'default.jpg', 1617530568),
(11, '128', '$2y$10$vj3Aehca.Y6Gb6.Z/kK7heBR.7jJbS48sv1M.NaoZp0d31xzAiMGe', 3, 6, NULL, 'default.jpg', 1617530582),
(12, '129', '$2y$10$1ETblci0Ze/vrPmygZKuPeolAUfvaC1eR0g3cKH7Mvjd6O5Ioganq', 3, 7, NULL, 'default.jpg', 1617530595),
(13, 'Bayu', '$2y$10$ndWz3SKFfvR.LQynMjb0VujEBEGKM/v74FUiWFC1Al/1Dn9XBpg1a', 3, 8, NULL, 'default.jpg', 1617530615),
(14, '131', '$2y$10$aYX9O2kIv7pNWcftBfIk9uBJkNHt4ZwwuSqJ5nPTPCqxe.YYV3.1i', 3, 9, NULL, 'default.jpg', 1617530658),
(15, '132', '$2y$10$LTHdQe/J4C9hD54cZF2QhOvUqbNXK4KjACENSKdlXbVcArMrdMVI2', 3, 10, NULL, 'default.jpg', 1617530669),
(17, '133', '$2y$10$4hbf1MmBCtILmas4VSVHYeAEclvUvexAJEvjmSYt5OZ.vI88tn3eC', 3, 12, NULL, 'default.jpg', 1617530716),
(18, '134', '$2y$10$HRc5FptCrWqTqfPcbZ32oOti4.dYOb8ZJrLoQ/rad2eJkSAnUB23S', 3, 13, NULL, 'default.jpg', 1617530737),
(20, '135', '$2y$10$e8sf9W.mCPODaF3o27dk9OKGSZh2MZLwgFRAlXH5F1CcV5L84g9bq', 3, 15, NULL, 'default.jpg', 1617530773),
(21, '136', '$2y$10$MPyKtOLogQGhOtmIK/YGsujxopphHIPgaRq111NPKvRpGdLAFECDK', 3, 16, NULL, 'default.jpg', 1617530795),
(23, '137', '$2y$10$ts6P7v3mctlWxqOf092hwur2CVNIPxjDp9TBbO7M1w7dGUM1VjjvC', 3, 18, NULL, 'default.jpg', 1617530844),
(24, '138', '$2y$10$r9yMI9X7nyXEs9t8gpotyu1TGr9Hz66SlM.qPkKEh6mezV5c9Oj5a', 3, 19, NULL, 'default.jpg', 1617530856),
(25, '139', '$2y$10$L9K9yxrdi6hBat1HHsWhw.m5trF0PaXFznZQI31VYRPUPa0.S3cU2', 3, 20, NULL, 'default.jpg', 1617530869),
(26, '140', '$2y$10$YFq9aCL7dFBmb5h2w9MiF.Hn4VHy4B8NFJAcSPVlR.NFAs38NHFYW', 3, 21, NULL, 'default.jpg', 1617530899),
(27, '141', '$2y$10$8Ew1whgm/QwEINGc1rQ2Kuk2sfpldiZGind/Xe1h/sMa4X9STssoW', 3, 22, NULL, 'default.jpg', 1617530913),
(28, '142', '$2y$10$iv2jS7wOOktRdTXjmYeafONQyHgR09yCcMZ7zp9CZfJY4lvHatDVi', 3, 23, NULL, 'default.jpg', 1617530927),
(29, '143', '$2y$10$AnKMqMZ.rKwqMv/zf9uxkuo92TAwtcXyXicItneZ4VjT1EU0Nu/Pi', 3, 24, NULL, 'default.jpg', 1617530936),
(30, '125', '$2y$10$HaYD0y70qSy3zG7VvFvdHeaorrAShpWh4jCFpDuw4jb5fF0hmxtlG', 2, NULL, 3, 'default.jpg', 1617531124),
(31, '126', '$2y$10$yOK44.6m9dLhnCMwBhKB2.4X/0HnO3Tsvsp./EdPCC4Rs8Xi.M5sS', 2, NULL, 4, 'default.jpg', 1617531132),
(32, '127', '$2y$10$i5j2W7606Ff/e9jH5Sn9DuJ4QcmEtGM8xUWPlhbXXjUfOSgOGr/0e', 2, NULL, 5, 'default.jpg', 1617531141),
(33, '128', '$2y$10$MKBu.XSXpjm7yLlwrOU4JelR6S2S0XSusjqzZ2kUoiD7YdoandyPa', 2, NULL, 6, 'default.jpg', 1617531150),
(34, '129', '$2y$10$Z8Z9Dgh/WY6M.i8NCHSglOj5HIhzsQjCefQG8EsjYiN.i8leZ8X8W', 2, NULL, 7, 'default.jpg', 1617531160),
(35, '130', '$2y$10$tIXC5YcBUTBxoxpFKOAgruxV8WMD9KyYGpTdU556s42oFcZkhTv1y', 2, NULL, 8, 'default.jpg', 1617531175),
(36, '131', '$2y$10$6oLFSwgQv8VUSOKTIwGB9OtGcQ2IAut/FWkXuZ/VQbxTTnRp5d3Sa', 2, NULL, 9, 'default.jpg', 1617531185),
(37, '132', '$2y$10$kr6sdmEAFQYvlNjgV/E7a.qdV3lavM0JJ.cvPRRb/./fwiA.X9fP2', 2, NULL, 10, 'default.jpg', 1617531205),
(38, '133', '$2y$10$Qyw1dUS35SWSG5kKG0OhBOPJS4jYvhgF7UGSFVJkipLwYOVb56yRG', 2, NULL, 11, 'default.jpg', 1617531221),
(39, '134', '$2y$10$lWoV3yHMfFT6X9xsRZPn9ukHO3elEzneGFMBAnk2dRYdiIe6g5qdK', 2, NULL, 12, 'default.jpg', 1617531241),
(40, '135', '$2y$10$dSy9sEDxY0Dj7CSP0..c3uuBWmvMHOyGInnhmO3Swqefk//17lVSq', 2, NULL, 13, 'default.jpg', 1617531251),
(41, '136', '$2y$10$azxcnrmTDqw4VP0scK7GF.7Kg1URZwsdzHTzZu6g7mJSnnTa28mDG', 2, NULL, 14, 'default.jpg', 1617531262),
(42, '137', '$2y$10$ydggPJSqk/LiaF.t.vYtruWpAlw2wdm8f2PLtcEWXij.tq6If.Sri', 2, NULL, 15, 'default.jpg', 1617531280),
(43, '138', '$2y$10$kq.dffpPdiE6TZgQUiOo0OGkrPxP6AAb3wRHHfKRON46xfQAcr/0W', 2, NULL, 16, 'default.jpg', 1617531292),
(44, '139', '$2y$10$A3jq9ut5CamsQOqF9d90w.6NfGk7W3bKAe13m/0IqW1abB6dX/c62', 2, NULL, 17, 'default.jpg', 1617531306),
(45, '140', '$2y$10$lIEG3O1lgF6RoL/B8Q94fuDntxkIWjTynpAFt4TTM.o2Z01I8bORe', 2, NULL, 18, 'default.jpg', 1617531318),
(46, '141', '$2y$10$BFjqgFZIDu1D5c9d3bhr5euC73oqEGdYdWYEQkvM4CHIYlDzh8Fm2', 2, NULL, 19, 'default.jpg', 1617531355),
(47, '142', '$2y$10$8eIuvPziwQt22PLNL8A9WOhezdznkCgJwT5s5.Epz0dJI3oRj7J9a', 2, NULL, 20, 'default.jpg', 1617531360);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `url`, `icon`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-fw fa-tachometer-alt'),
(2, 'Siswa', 'siswa', 'fas fa-fw fa-user-graduate'),
(3, 'Guru', 'guru', 'fas fa-fw fa-chalkboard-teacher'),
(4, 'Kelas', 'kelas', 'fas fa-fw fa-book-open'),
(5, 'Profile', 'profile', 'fas fa-fw fa-user-circle');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'guru'),
(3, 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas_kelas`
--
ALTER TABLE `aktivitas_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aktivitas` (`id_aktivitas`),
  ADD KEY `jenis` (`jenis`);

--
-- Indexes for table `file_tugas_siswa`
--
ALTER TABLE `file_tugas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_file` (`id_file`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_file`
--
ALTER TABLE `jenis_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_guru`
--
ALTER TABLE `kelas_guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `user_ibfk_1` (`id_guru`),
  ADD KEY `user_ibfk_2` (`id_siswa`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas_kelas`
--
ALTER TABLE `aktivitas_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `file_tugas_siswa`
--
ALTER TABLE `file_tugas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jenis_file`
--
ALTER TABLE `jenis_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas_guru`
--
ALTER TABLE `kelas_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas_kelas`
--
ALTER TABLE `aktivitas_kelas`
  ADD CONSTRAINT `aktivitas_kelas_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`id_aktivitas`) REFERENCES `aktivitas_kelas` (`id`),
  ADD CONSTRAINT `file_ibfk_2` FOREIGN KEY (`jenis`) REFERENCES `jenis_file` (`id`);

--
-- Constraints for table `file_tugas_siswa`
--
ALTER TABLE `file_tugas_siswa`
  ADD CONSTRAINT `file_tugas_siswa_ibfk_1` FOREIGN KEY (`id_file`) REFERENCES `file` (`id`),
  ADD CONSTRAINT `file_tugas_siswa_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`);

--
-- Constraints for table `kelas_guru`
--
ALTER TABLE `kelas_guru`
  ADD CONSTRAINT `kelas_guru_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`),
  ADD CONSTRAINT `kelas_guru_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD CONSTRAINT `kelas_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `kelas_siswa_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`),
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;