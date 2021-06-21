-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2021 at 04:21 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(1, 1, 'Aktivitas 1'),
(5, 2, 'pertemuan 1'),
(6, 1, 'Aktivitas 2'),
(7, 3, 'Aktivitas 2');

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
(22, 1, 'tugas', 'Surat_Pernyataan_Kesanggupan_240601181301324.pdf', 2, 1617524040, 1617721980, '<p><b>Ini Tugas</b></p>'),
(25, 1, 'materi-3', 'Coursera_2NTW8F55J5EX-merged32.pdf', 1, 1617522120, 1617525420, '<p>Muhammad Rizal</p>'),
(26, 1, 'materi-2', 'lecture_slides_for_RMSprp2.pdf', 1, 1617690000, 1617690000, '<p>ini</p>');

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
(12, 22, 'Coursera_PA7WC3CKVB2M8.pdf', 3),
(13, 22, 'lecture_slides_for_RMSprp3.pdf', 1);

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
(21, 155, 'Eko'),
(22, 156, 'Tyas');

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
  `tahun_ajaran` varchar(9) NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `tahun_ajaran`, `gambar`) VALUES
(1, 'Ilmu Komputer 2020', '2019/2020', 'default_kelas.jpg'),
(2, 'Jaringan 2021', '2019/2020', 'default_kelas.jpg'),
(3, 'dasar pemrograman', '2020/2021', 'default_kelas.jpg'),
(4, 'algoritma pemrograman', '2020/2021', 'default_kelas.jpg'),
(5, 'struktur data', '2020/2021', 'default_kelas.jpg');

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
(1, 1, 1),
(11, 21, 2),
(12, 22, 3),
(13, 1, 4),
(14, 22, 5),
(15, 1, 3);

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
(2, 3, 1),
(4, 3, 2),
(5, 2, 1),
(6, 13, 1),
(7, 19, 4),
(8, 20, 4),
(9, 21, 4),
(10, 22, 4),
(11, 23, 4),
(12, 24, 4),
(13, 12, 5),
(14, 15, 5),
(15, 18, 5),
(16, 19, 5),
(17, 21, 5),
(18, 5, 5),
(19, 2, 2),
(20, 4, 2),
(21, 5, 2),
(22, 6, 2),
(23, 7, 2),
(24, 1, 3),
(25, 3, 3),
(26, 21, 3),
(27, 23, 3),
(28, 24, 3),
(32, 5, 1),
(33, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `jurusan` varchar(128) NOT NULL,
  `tahun_masuk` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `jurusan`, `tahun_masuk`) VALUES
(1, 123, 'JuanP', 'XII TKJ', '2018'),
(2, 124, 'Jojon', 'XII TKJ', '2018'),
(3, 125, 'Sumanto', 'XII RPL', '2018'),
(4, 126, 'Muhammad Rizal', '12 IPA 2', '2018'),
(5, 127, 'Aulia', 'XII', '2018'),
(6, 128, 'Utami', 'XI', '2018'),
(7, 129, 'Tika', 'XI', '2018'),
(8, 130, 'Hadi', '129', '2018'),
(9, 131, 'Bazu', 'XII', '2018'),
(10, 132, 'Annisa', 'XII', '2018'),
(12, 133, 'Retno', 'X1', '2018'),
(13, 134, 'Fajar', 'XI', '2018'),
(15, 135, 'Wulandari', 'XI', '2019'),
(16, 136, 'Nurul', 'XI', '2019'),
(18, 137, 'Rini', 'XI', '2019'),
(19, 138, 'Ilham', 'XI', '2019'),
(20, 139, 'Kusuma', 'XI', '2019'),
(21, 140, 'Rizki', 'XI', '2019'),
(22, 141, 'Dinda', 'XI', '2019'),
(23, 142, 'Andre', 'Xi', '2019'),
(24, 143, 'Ari', 'XI', '2019'),
(29, 9999, 'tes', 'tes', '2020');

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
(6, 'guru', '$2y$10$b0s5514YrNJOmrxwZXac2OgsYEhFG0VbGBS0/pYr1BLnpgne9OgCS', 2, NULL, 1, 'kid-2529907_6401.jpg', 1613116471),
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
(48, '155', '$2y$10$asIkl9KJhgI8t9Ee0l3jEucdRVsh8OWa9OJdC9j2CeKFwR4SvPzaK', 2, NULL, 21, 'default.jpg', 1617542809),
(49, '156', '$2y$10$XVphK96B6A0MYTgS8cyX0eT0V/Dx3Mlp1tx20lR.83ewLhTuw3Yoi', 2, NULL, 22, 'default.jpg', 1617542818),
(54, '9999', '$2y$10$XePisyQ5KjLHoe08v9vnpePX4poA6Jqvp/9U0qmboXvHW5VIW0.A.', 3, 29, NULL, 'default.jpg', 1623851166);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `file_tugas_siswa`
--
ALTER TABLE `file_tugas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jenis_file`
--
ALTER TABLE `jenis_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kelas_guru`
--
ALTER TABLE `kelas_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
