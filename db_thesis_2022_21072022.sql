-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 04:30 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_thesis_2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id`, `id_akun`, `id_role`) VALUES
(4, 5, 4),
(5, 6, 2),
(6, 6, 3),
(7, 7, 2),
(8, 8, 2),
(9, 8, 5),
(10, 9, 1),
(11, 9, 1),
(12, 11, 1),
(13, 9, 1),
(14, 13, 3),
(15, 13, 2),
(16, 14, 1),
(17, 15, 1),
(18, 16, 1),
(19, 17, 1),
(20, 18, 1),
(21, 19, 1),
(22, 20, 1),
(23, 21, 1),
(24, 22, 1),
(25, 23, 1),
(26, 24, 5),
(27, 25, 3),
(28, 26, 3),
(30, 27, 1),
(31, 28, 1),
(32, 29, 1),
(33, 30, 1),
(34, 31, 1),
(35, 32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `username`, `email`, `password`) VALUES
(5, 'ten.dik', 'tendik1@gmail.com', '$2y$10$2lStY4LhEHSyURBpm6.a.uoQ0lrrrnA6HS1gdg0H3KqnrEj.mnaIa'),
(6, 'elan.suherlan', 'elan.suherlan@gmail.com', '$2y$10$QAhbRerL8cNNpDMvAIIb3OcAeQPQVM4n63jNpSp/VwqZYsQ5.ONdK'),
(7, '', 'andreas.febrian@gmail.com', '$2y$10$HeQZV5hrviCDUHrHp6zU.O8j9pj48j3OCHmt8zhiXb81p70b8Bf7u'),
(8, '', 'herika.hayurani@gmail.com', '$2y$10$u/yI3icPwjF9fvuQHYYSC.zNAg2Ev4i8evX2Eu36lmc3qtPiIILFy'),
(9, '', 'sleepyweppy@gmail.com', '$2y$10$zi6pjh6Y5zQOwW6fawv4NeoLgzz2woZW4WdlW.nB2UCs9go2puz0a'),
(10, '', 'sleepyweppy@gmail.com', '$2y$10$6AnbzCSQzojl4J15SBawH.PeClSDkKLxxK3Ksi05oZp/LiFSdQoIe'),
(11, '', 'asdf@gmail.com', '$2y$10$5Uudlyvbgi4CUUwVc1A9l.aLMbgJYOsj82OqQzOi1wc83MiFSXQ6y'),
(12, '', 'sleepyweppy@gmail.com', '$2y$10$aUkUUACG85ir0tNpZTzZI.oHM7QZicQm0SNv.A95l1qlEz8PfWCFm'),
(13, '', 'indah.kurnianingsih@gmail.com', '$2y$10$QORdMjM68mlB7W5Kg.tOFeMNxwHY6w.nYIXcy2EtLFoRPlu7DU1py'),
(14, '', 'ip2@gmail.com', '$2y$10$PfBi/zi9PjFtGwNtQ0bJSuAvKw4yGXcVxHcNEXoTAZBCqqZ1P5TGW'),
(15, '', 'ti2@gmail.com', '$2y$10$KO4mp/.htreQULQOSqREhuEu9JqRBftwQl5Utq.qMnbpMZjDKaqIa'),
(16, '', 'ti3@gmail.com', '$2y$10$.G3QhcyNVmB/qw5MjQCiSOAxxjajNF1CVm8.rMp43bCoR1hIfNRCS'),
(17, '', 'ip3@gmail.com', '$2y$10$iBmNW0Jm9ImdRAxpeahoYu1WwBIjOQpi/Y.L59aEKGaqJ4lXFvMUq'),
(18, 'yusuf.marzuki', 'ti4@gmail.com', '$2y$10$0I.BjeYO0qQmmp9rSR/6musJXr6CokEq1mdA8VCOFcpKH57G9yZI6'),
(19, '', 'ip4@gmail.com', '$2y$10$rZsoVPNAzlPwkMmKH2DbJOPWKvNZhAt1QGfbrm4Q8IE7YNiw9iN.q'),
(20, '', 'ti5@gmail.com', '$2y$10$sn6zXd4midhXKozXaNL/1ODgC2kzz4ygk/TQcVu256.HGuxPsbWdG'),
(21, '', 'ip6@gmail.com', '$2y$10$zESRdSX4..6ypx9KuA3GuOd1efl0xx0dMexrm/WKRavvOId/7aDWC'),
(22, '', 'ti6@gmail.com', '$2y$10$4XeMLpo.8tJoPW4n.L40Y.ZcRB8waUJpJVQ0yypMo6irIrBstPJ1i'),
(23, '', 'ti7@gmail.com', '$2y$10$KwCTdH7n/ehuJkFu30UKtuPKbGMaO7mJ26ScXxXCj6uQ3nVYxcmn6'),
(24, 'fti.yarsi', 'fti.yarsi@gmail.com', '$2y$10$VfhWEzfQH.ePOaeR0hc9GuFC16fMoNSqkRkFgyljKx.CPuD4t1zYS'),
(25, 'ti.yarsi', 'teknik.informatika@gmail.com', '$2y$10$on3XdiXgVlE4NFIMf0ap8OCgmzWSDewwJyltODdOXeVhYuYJEFw2.'),
(26, 'pdsi.yarsi', 'pdsi.yarsi@gmail.com', '$2y$10$csxZEn9WI4gzKpbgg04ik.OGvvDd1eWI3WmOUB3drgoz1UpdxVxjq'),
(27, '', 'ti8@gmail.com', '$2y$10$Z.0gsMSpkUQptkb.EtUixuTFPOIQ1VTL2wKdc2E61NEgTDU2Z2Fa2'),
(28, '', 'ti9@gmail.com', '$2y$10$pqTTDiKjsbdcmKaQtRBJcuUeC/JNo8xIQtsQMYJzAdtp0RKdXKI42'),
(29, '', 'ti10@gmail.com', '$2y$10$vS/BJNlFv80o2szVRUrGOuwF1d1yqkCYuIrarym958m3wsv2Njzfe'),
(30, '', 'ti11@gmail.com', '$2y$10$3cx9QSZqUEDItq9lRWUIbOrCXfb6/ZW44JmGdCiTsPIc3dbL4O4oW'),
(31, '', 'ip7@gmail.com', '$2y$10$DGzesOeNB67sOEwau1c3leDmyiyXa1gAgKv1eZ3PITt7IAeRLbs2a'),
(32, '', 'ip5@gmail.com', '$2y$10$Un.STw/JFsRFGIj4Zh6Bx.XCnwYiw1UJUIWrQ0qOpdkR0E.khAPga');

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id` int(11) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `inisial` varchar(10) NOT NULL,
  `id_prodi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id`, `nama`, `inisial`, `id_prodi`) VALUES
(1, 'Multimedia & Immersive Technology', 'MM', 1),
(2, 'Artificial Intelligence, Big Data, Computer Vision', 'AI', 1),
(3, 'High Performance Computing & Communication', 'HPC', 1),
(4, 'Software Engineering & Human Computer Interaction', 'SE', 1),
(5, 'Organisasi Informasi', 'OI', 2),
(6, 'Layanan Informasi dan Kajian Pengguna', 'LIKP', 2),
(7, 'Aspek Sosial dan Hukum', 'ASH', 2),
(8, 'Manajemen dan Administrasi Lembaga Informasi', 'MALI', 2);

-- --------------------------------------------------------

--
-- Table structure for table `catatan_bimbingan`
--

CREATE TABLE `catatan_bimbingan` (
  `id` int(11) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  `hasil_bimbingan` text NOT NULL,
  `tanggal_bimbingan` datetime NOT NULL,
  `status` enum('TERTUNDA','DITOLAK','DISETUJUI') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catatan_bimbingan`
--

INSERT INTO `catatan_bimbingan` (`id`, `id_pembimbing`, `hasil_bimbingan`, `tanggal_bimbingan`, `status`) VALUES
(8, 21, 'asdf asdf asdf asd fasd fasdf ', '2022-05-06 00:00:00', 'DISETUJUI'),
(10, 21, ' asdf asdf asdf asd fasd fasd fasd fasd f', '2022-05-08 00:00:00', 'DITOLAK'),
(11, 23, ' ;lksdjf ;lasdkjf ;lkajsd f;lka jsd ;flka jsd f', '2022-05-14 00:00:00', 'TERTUNDA'),
(12, 30, 'Pengarah penulisan skripsi', '2022-05-14 00:00:00', 'DISETUJUI'),
(13, 48, 'Belajar fundamental', '2022-05-15 00:00:00', 'DISETUJUI'),
(14, 75, 'bab 1', '2022-05-28 00:00:00', 'DISETUJUI'),
(17, 98, 'BAB 5', '2022-06-02 00:00:00', 'DISETUJUI'),
(18, 96, 'bab 6', '2022-06-05 00:00:00', 'DISETUJUI'),
(19, 30, 'Membahas Bab 2', '2022-06-08 00:00:00', 'DISETUJUI'),
(20, 30, 'Bab 3', '2022-06-10 00:00:00', 'DISETUJUI'),
(21, 30, 'Demo aplikasi', '2022-06-11 00:00:00', 'DISETUJUI'),
(22, 30, 'Penulisan pada Bab 4', '2022-06-12 00:00:00', 'DISETUJUI'),
(23, 99, 'Bab 1', '2022-06-01 00:00:00', 'DISETUJUI'),
(24, 99, 'Konsultasi Bab 2', '2022-06-07 00:00:00', 'DISETUJUI'),
(25, 99, 'Pengarahan Bab 3', '2022-06-07 00:00:00', 'TERTUNDA'),
(26, 105, 'Perencanaan penelitian', '2022-06-14 00:00:00', 'DISETUJUI'),
(27, 108, 'Bab 1', '2022-06-15 00:00:00', 'DISETUJUI'),
(28, 110, 'Pembahasan agama', '2022-06-17 00:00:00', 'TERTUNDA'),
(29, 111, 'Bab 1', '2022-06-16 00:00:00', 'DISETUJUI'),
(30, 132, 'bimbingan 1', '2022-06-22 00:00:00', 'DISETUJUI'),
(31, 132, 'bimbingan 2', '2022-06-24 00:00:00', 'DISETUJUI'),
(32, 132, 'bimbingan 3', '2022-06-26 00:00:00', 'DISETUJUI'),
(33, 132, 'bimbingan 4', '2022-06-28 00:00:00', 'DISETUJUI'),
(34, 132, 'bimbingan 5', '2022-06-30 00:00:00', 'DISETUJUI'),
(35, 132, 'bimbingan 6', '2022-07-02 00:00:00', 'DISETUJUI'),
(36, 132, 'bimbingan 7', '2022-07-04 00:00:00', 'DISETUJUI'),
(37, 132, 'bimbingan 8', '2022-07-06 00:00:00', 'DISETUJUI'),
(38, 134, 'bimbingan agama 1', '2022-06-22 00:00:00', 'DISETUJUI'),
(39, 134, 'bimbingan agama 2', '2022-06-24 00:00:00', 'DISETUJUI'),
(40, 134, 'bimbingan agama 3', '2022-06-24 00:00:00', 'DISETUJUI'),
(41, 134, 'bimbingan agama 4', '2022-06-30 00:00:00', 'DISETUJUI'),
(42, 111, 'Bab 2', '2022-06-19 00:00:00', 'DISETUJUI'),
(43, 111, 'Revisi Bab 2', '2022-06-21 00:00:00', 'DISETUJUI'),
(44, 111, 'Bab 3', '2022-06-23 00:00:00', 'DISETUJUI'),
(45, 111, 'Perbaikan Bab 3', '2022-06-26 00:00:00', 'DISETUJUI'),
(46, 111, 'Bab 4', '2022-06-28 00:00:00', 'DISETUJUI'),
(47, 111, 'Pengujian sistem', '2022-06-30 00:00:00', 'DISETUJUI'),
(48, 111, 'Persiapan Seminar Prasidang', '2022-07-02 00:00:00', 'DISETUJUI'),
(49, 111, 'Revisi setelah Seminar Prasidang', '2022-07-04 00:00:00', 'DISETUJUI'),
(50, 113, 'Bagian agama pada Bab 1', '2022-06-18 00:00:00', 'DISETUJUI'),
(51, 113, 'Bab 5', '2022-06-22 00:00:00', 'DISETUJUI'),
(52, 113, 'Perbaikan Bab 5', '2022-06-25 00:00:00', 'DISETUJUI'),
(53, 113, 'Finalisasi Bab 5', '2022-06-30 00:00:00', 'DISETUJUI');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `inisial` varchar(10) NOT NULL,
  `id_prodi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nama`, `email`, `inisial`, `id_prodi`) VALUES
(1, 'Elan Suherlan, S.Si, M.Si', 'elan.suherlan@gmail.com', 'ES', 1),
(2, 'Andreas Febrian, S.Kom., M.Kom.', 'andreas.febrian@gmail.com', 'AF', 1),
(3, 'Herika Hayurani, S.Kom., M.Kom.', 'herika.hayurani@gmail.com', 'HH', 1),
(4, 'Indah Kurnianingsih, S.IP., M.P.', 'indah.kurnianingsih@gmail.com', 'IK', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `inisial` varchar(10) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`, `inisial`, `email`) VALUES
(1, 'Teknologi Informasi', 'FTI', 'fti.yarsi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `kalender_skripsi`
--

CREATE TABLE `kalender_skripsi` (
  `id` int(11) NOT NULL,
  `nama_kegiatan` varchar(70) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kalender_skripsi`
--

INSERT INTO `kalender_skripsi` (`id`, `nama_kegiatan`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(16, 'Pembuatan Proposal dan Pengumpulan Persyaratan Skripsi', '2022-02-14', '2022-02-19'),
(17, 'Seminar Proposal', '2022-02-21', '2022-03-01'),
(18, 'Pengumuman Pembimbing Skripsi', '2022-03-04', '2022-03-04'),
(33, 'Pembekalan', '2022-03-15', '2022-05-09'),
(34, 'Pengumpulan Draft Prasidang', '2022-06-06', '2022-06-10'),
(39, 'Seminar Prasidang', '2022-06-15', '2022-06-24'),
(40, 'Masa Revisi dan Persiapan Sidang', '2022-06-24', '2022-07-24'),
(41, 'Revisi setelah sidang', '2022-07-10', '2022-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` varchar(10) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `angkatan` int(11) NOT NULL,
  `sks_lulus` int(11) DEFAULT NULL,
  `pembimbing_akademik` int(11) DEFAULT NULL,
  `mk_sedang_diambil` varchar(255) DEFAULT NULL,
  `mk_akan_diambil` varchar(255) DEFAULT NULL,
  `status_persetujuan_skripsi` enum('Disetujui','Ditolak') DEFAULT NULL,
  `tanggal_pengajuan_skripsi` datetime DEFAULT NULL,
  `id_prodi` int(11) NOT NULL,
  `file_khs` varchar(255) DEFAULT NULL,
  `file_krs` varchar(255) DEFAULT NULL,
  `file_persetujuan_skripsi` varchar(255) DEFAULT NULL,
  `email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama`, `angkatan`, `sks_lulus`, `pembimbing_akademik`, `mk_sedang_diambil`, `mk_akan_diambil`, `status_persetujuan_skripsi`, `tanggal_pengajuan_skripsi`, `id_prodi`, `file_khs`, `file_krs`, `file_persetujuan_skripsi`, `email`) VALUES
('1402015666', 'Fajar Ramadhan', 2015, 137, 1, '-', 'Agama 1, Agama 3', 'Disetujui', '2022-06-01 11:39:22', 1, 'KHS_1402015666.pdf', 'KRS_1402015666.pdf', 'PersetujuanSkripsi_1402015666.pdf', 'ti6@gmail.com'),
('1402016314', 'Yusuf Marzuki', 2016, 130, 1, 'Agama 1, Agama 2, Agama 3', 'Agama 1, Agama 3', 'Disetujui', '2022-06-02 11:39:28', 1, 'KHS_1402016314.pdf', 'KRS_1402016314.pdf', 'PersetujuanSkripsi_1402016314.pdf', 'ti4@gmail.com'),
('1402017188', 'Faisal Akbar', 2017, 137, 1, '-', '-', 'Disetujui', '2022-06-03 11:39:32', 1, 'KHS_1402017188.pdf', 'KRS_1402017188.pdf', 'PersetujuanSkripsi_1402017188.pdf', 'ti2@gmail.com'),
('1402017300', 'Zidan Muhid', 2017, 16, 2, '&#60;script&#62;alert(&#34;tost&#34;)&#60;/script&#62;', '&#60;script&#62;alert(&#34;tust&#34;)&#60;/script&#62;', 'Disetujui', '2022-05-02 11:39:35', 1, 'KHS_1402017300.pdf', 'KRS_1402017300.pdf', 'PersetujuanSkripsi_1402017300.pdf', 'ti5@gmail.com'),
('1402017777', 'Fadil Irham', 2017, 137, 2, 'DDP, PBO, PBP', 'Agama 1, Agama 3', 'Disetujui', '2022-06-05 22:05:17', 1, 'KHS_1402017777.pdf', 'KRS_1402017777.pdf', 'PersetujuanSkripsi_1402017777.pdf', 'ti7@gmail.com'),
('1402018111', 'Muhammad Rizky Ardiansah', 2018, 140, 1, '-', '-', 'Disetujui', '2022-06-15 15:16:13', 1, 'KHS_1402018111.pdf', 'KRS_1402018111.pdf', 'PersetujuanSkripsi_1402018111.pdf', 'ti11@gmail.com'),
('1402018189', 'Sinta Tia', 2018, 137, 1, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', '2022-06-14 11:39:45', 1, 'KHS_1402018189.pdf', 'KRS_1402018189.pdf', 'PersetujuanSkripsi_1402018189.pdf', 'ti3@gmail.com'),
('1402018300', 'Kamila Damayanti', 2018, 137, 2, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', '2022-05-18 11:39:48', 2, 'KHS_1402018300.pdf', 'KRS_1402018300.pdf', 'PersetujuanSkripsi_1402018300.pdf', 'sleepyweppy@gmail.com'),
('1402018666', 'Iqbal Mahdi', 2018, 137, 1, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', '2022-06-07 14:57:23', 1, 'KHS_1402018666.pdf', 'KRS_1402018666.pdf', 'PersetujuanSkripsi_1402018666.pdf', 'ti8@gmail.com'),
('1402018888', 'Rizal Fajri', 2018, 140, 1, '-', '-', 'Disetujui', '2022-06-15 10:54:42', 1, 'KHS_1402018888.pdf', 'KRS_1402018888.pdf', 'PersetujuanSkripsi_1402018888.pdf', 'ti10@gmail.com'),
('1402018999', 'Rizalun Akbar', 2018, 140, 2, '-', '-', 'Disetujui', '2022-06-15 07:35:35', 1, 'KHS_1402018999.pdf', 'KRS_1402018999.pdf', 'PersetujuanSkripsi_1402018999.pdf', 'ti9@gmail.com'),
('1502015199', 'Sekar Sari', 2015, 130, 4, '-', 'Agama 1, Agama 2, Agama 3', 'Disetujui', '2022-06-21 22:58:46', 2, 'KHS_1502015199.pdf', 'KRS_1502015199.pdf', 'PersetujuanSkripsi_1502015199.pdf', 'ip3@gmail.com'),
('1502016200', 'Puspita Dewi', 2016, 137, 4, 'Agama 1, Agama 2, Agama 3', 'Agama 1, Agama 3', 'Disetujui', '2022-06-20 11:39:58', 2, 'KHS_1502016200.pdf', 'KRS_1502016200.pdf', 'PersetujuanSkripsi_1502016200.pdf', 'ip6@gmail.com'),
('1502017110', 'Marzuki ali', 2017, 140, 4, '-', '-', 'Disetujui', '2022-05-13 11:40:01', 2, 'KHS_1502017110.pdf', 'KRS_1502017110.pdf', 'PersetujuanSkripsi_1502017110.pdf', 'ip4@gmail.com'),
('1502017787', 'Laras Puspita', 2017, 140, 4, '-', '-', 'Disetujui', '2022-06-22 20:05:05', 2, 'KHS_1502017787.pdf', 'KRS_1502017787.pdf', 'PersetujuanSkripsi_1502017787.pdf', 'ip5@gmail.com'),
('1502018100', 'Dinda Fatma', 2018, 137, 4, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', '2022-05-14 11:40:05', 2, 'KHS_1502018100.pdf', 'KRS_1502018100.pdf', 'PersetujuanSkripsi_1502018100.pdf', 'ip2@gmail.com'),
('1502018999', 'Mahasiswa IP', 2018, 140, 4, '-', '-', 'Disetujui', '2022-06-19 10:40:21', 2, 'KHS_1502018999.pdf', 'KRS_1502018999.pdf', 'PersetujuanSkripsi_1502018999.pdf', 'ip7@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `makalah`
--

CREATE TABLE `makalah` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kata_kunci` varchar(70) NOT NULL,
  `file_makalah` varchar(255) DEFAULT NULL,
  `npm` varchar(10) NOT NULL,
  `tanggal_upload` datetime DEFAULT NULL,
  `id_bidang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `makalah`
--

INSERT INTO `makalah` (`id`, `judul`, `deskripsi`, `kata_kunci`, `file_makalah`, `npm`, `tanggal_upload`, `id_bidang`) VALUES
(4, 'APLIKASI MANAJEMEN PERPUSTAKAAN BERBASIS\nANDROID TERINTEGRASI DENGAN SLIMS BERBASIS WEB\n(STUDI KASUS SMKN 54 JAKARTA)', 'Sistem informasi merupakan kumpulan komponen yang saling berhubungan untuk mengolah data yang kemudian digunakan untuk mencapai suatu tujuan (Kadir, 2014). ', 'aplikasi, sistem, manajemen, android', 'Makalah_1402017300.pdf', '1402017300', '2022-05-31 23:18:01', 1),
(5, 'PERANCANGAN APLIKASI PEMBELAJARAN AKSARA\nLONTARA SUKU BUGIS', 'Sistem informasi yang digunakan oleh KPS TI adalah sistem informasi skripsi bernama TheSIS. TheSIS digunakan untuk mengotomasi proses pelaksanaan dan pendataan skripsi yang sebelumnya dilakukan dengan cara konvensional (Rahman, 2014).', 'aplikasi, pembelajaran, aksara', 'Makalah_1402017777.pdf', '1402017777', '2022-06-05 23:06:14', 1),
(7, 'Sistem Informasi Skripsi TheSIS', 'Sistem informasi yang digunakan untuk mempermudah kegiatan skripsi', 'sistem informasi, skripsi, universitas yarsi', 'Makalah_1402018999.pdf', '1402018999', '2022-06-15 08:20:59', 4),
(8, 'Sistem Informasi Skripsi', 'Sistem informasi terkait skripsi.', 'sistem informasi, skripsi, universitas yarsi', 'Makalah_1402018888.pdf', '1402018888', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `id` int(11) NOT NULL,
  `id_skripsi` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `role` enum('Pembimbing Ilmu 1','Pembimbing Ilmu 2','Pembimbing Agama') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`id`, `id_skripsi`, `id_dosen`, `role`) VALUES
(21, 10, 3, 'Pembimbing Ilmu 1'),
(22, 10, NULL, 'Pembimbing Ilmu 2'),
(23, 10, 1, 'Pembimbing Agama'),
(30, 11, 2, 'Pembimbing Ilmu 1'),
(31, 11, NULL, 'Pembimbing Ilmu 2'),
(32, 11, 3, 'Pembimbing Agama'),
(48, 14, 4, 'Pembimbing Ilmu 1'),
(49, 14, NULL, 'Pembimbing Ilmu 2'),
(50, 14, 4, 'Pembimbing Agama'),
(75, 15, 1, 'Pembimbing Ilmu 1'),
(76, 15, 2, 'Pembimbing Ilmu 2'),
(77, 15, 1, 'Pembimbing Agama'),
(96, 19, 3, 'Pembimbing Ilmu 1'),
(97, 19, NULL, 'Pembimbing Ilmu 2'),
(98, 19, 2, 'Pembimbing Agama'),
(99, 20, 1, 'Pembimbing Ilmu 1'),
(100, 20, NULL, 'Pembimbing Ilmu 2'),
(101, 20, 3, 'Pembimbing Agama'),
(105, 21, 3, 'Pembimbing Ilmu 1'),
(106, 21, NULL, 'Pembimbing Ilmu 2'),
(107, 21, 2, 'Pembimbing Agama'),
(108, 22, 2, 'Pembimbing Ilmu 1'),
(109, 22, 3, 'Pembimbing Ilmu 2'),
(110, 22, 1, 'Pembimbing Agama'),
(111, 23, 1, 'Pembimbing Ilmu 1'),
(112, 23, NULL, 'Pembimbing Ilmu 2'),
(113, 23, 3, 'Pembimbing Agama'),
(123, 12, 3, 'Pembimbing Ilmu 1'),
(124, 12, 2, 'Pembimbing Ilmu 2'),
(125, 12, 1, 'Pembimbing Agama'),
(126, 18, 3, 'Pembimbing Ilmu 1'),
(127, 18, 2, 'Pembimbing Ilmu 2'),
(128, 18, 1, 'Pembimbing Agama'),
(132, 24, 4, 'Pembimbing Ilmu 1'),
(133, 24, NULL, 'Pembimbing Ilmu 2'),
(134, 24, 4, 'Pembimbing Agama');

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_dosen`
--

CREATE TABLE `penelitian_dosen` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `jumlah_peneliti` int(11) NOT NULL,
  `status` enum('TERSEDIA','TIDAK TERSEDIA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penelitian_dosen`
--

INSERT INTO `penelitian_dosen` (`id`, `judul`, `deskripsi`, `id_dosen`, `id_bidang`, `jumlah_peneliti`, `status`) VALUES
(2, 'Sistem Informasi Skripsi Fakultas Teknologi Informasi Universitas YARSI', 'Penelitian ini berfokus pada pengembangan sistem informasi skripsi yang sebelumnya sudah pernah digunakan pada Program Studi Teknik Informatika. Target dari penelitian ini adalah untuk membuat sistem informasi skripsi yang dapat digunakan pada lingkup yang lebih luas yaitu Fakultas Teknologi Informasi.', 2, 4, 1, 'TERSEDIA'),
(3, 'Pengembangan Sistem Informasi Kepustakaan', 'pokoknya lu semua harus cobain penelitian ini ya guys', 4, 6, 5, 'TIDAK TERSEDIA');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_prasidang`
--

CREATE TABLE `pengajuan_prasidang` (
  `id` int(11) NOT NULL,
  `id_skripsi` int(11) NOT NULL,
  `file_draft` varchar(255) NOT NULL,
  `lembar_persetujuan` varchar(255) NOT NULL,
  `tanggal_pengajuan` datetime NOT NULL,
  `status` enum('TERTUNDA','DITOLAK','DISETUJUI') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajuan_prasidang`
--

INSERT INTO `pengajuan_prasidang` (`id`, `id_skripsi`, `file_draft`, `lembar_persetujuan`, `tanggal_pengajuan`, `status`) VALUES
(10, 10, 'Draft_1402016314_10.pdf', 'LembarPersetujuanPrasidang_1402016314_10.pdf', '2022-05-16 09:28:31', 'DISETUJUI'),
(12, 11, 'Draft_1402018189_11.pdf', 'LembarPersetujuanPrasidang_1402018189_11.pdf', '2022-05-21 22:15:36', 'DISETUJUI'),
(13, 14, 'Draft_1502017110_14.pdf', 'LembarPersetujuanPrasidang_1502017110_14.pdf', '2022-05-23 20:29:46', 'DISETUJUI'),
(16, 18, 'Draft_1402015666_18.pdf', 'LembarPersetujuanPrasidang_1402015666_18.pdf', '2022-06-04 23:33:30', 'DISETUJUI'),
(17, 15, 'Draft_1402017300_15.pdf', 'LembarPersetujuanPrasidang_1402017300_15.pdf', '2022-06-05 21:16:53', 'DISETUJUI'),
(18, 19, 'Draft_1402017777_19.pdf', 'LembarPersetujuanPrasidang_1402017777_19.pdf', '2022-06-05 22:39:31', 'DISETUJUI'),
(19, 20, 'Draft_1402018666_20.pdf', 'LembarPersetujuanPrasidang_1402018666_20.pdf', '2022-06-07 15:09:32', 'DISETUJUI'),
(20, 21, 'Draft_1402018999_21.pdf', 'LembarPersetujuanPrasidang_1402018999_21.pdf', '2022-06-15 07:58:33', 'DISETUJUI'),
(21, 22, 'Draft_1402018888_22.pdf', 'LembarPersetujuanPrasidang_1402018888_22.pdf', '2022-06-15 11:03:41', 'DISETUJUI'),
(22, 23, 'Draft_1402018111_23.pdf', 'LembarPersetujuanPrasidang_1402018111_23.pdf', '2022-06-15 15:49:56', 'DISETUJUI'),
(23, 9, 'Draft_1502015199_9.pdf', 'LembarPersetujuanPrasidang_1502015199_9.pdf', '2022-06-18 21:57:23', 'DISETUJUI'),
(24, 24, 'Draft_1502018999_24.pdf', 'LembarPersetujuanPrasidang_1502018999_24.pdf', '2022-06-18 21:58:47', 'DISETUJUI');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_sidang`
--

CREATE TABLE `pengajuan_sidang` (
  `id` int(11) NOT NULL,
  `id_skripsi` int(11) NOT NULL,
  `file_draft_final` varchar(255) NOT NULL,
  `file_form_bimbingan` varchar(255) NOT NULL,
  `file_persyaratan_sidang` varchar(255) NOT NULL,
  `tanggal_pengajuan` datetime NOT NULL,
  `status` enum('TERTUNDA','DITOLAK','DISETUJUI') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajuan_sidang`
--

INSERT INTO `pengajuan_sidang` (`id`, `id_skripsi`, `file_draft_final`, `file_form_bimbingan`, `file_persyaratan_sidang`, `tanggal_pengajuan`, `status`) VALUES
(3, 10, 'Draft_Final_1402016314_10.pdf', 'Form_Bimbingan_1402016314_10.pdf', 'Persyaratan_Sidang_1402016314_10.pdf', '2022-05-26 10:41:26', 'DISETUJUI'),
(4, 15, 'Draft_Final_1402017300_15.pdf', 'Form_Bimbingan_1402017300_15.pdf', 'Persyaratan_Sidang_1402017300_15.pdf', '2022-05-28 20:58:40', 'DISETUJUI'),
(5, 18, 'Draft_Final_1402015666_18.pdf', 'Form_Bimbingan_1402015666_18.pdf', 'Persyaratan_Sidang_1402015666_18.pdf', '2022-06-04 23:47:04', 'DISETUJUI'),
(6, 19, 'Draft_Final_1402017777_19.pdf', 'Form_Bimbingan_1402017777_19.pdf', 'Persyaratan_Sidang_1402017777_19.pdf', '2022-06-05 22:59:47', 'DISETUJUI'),
(7, 20, 'Draft_Final_1402018666_20.pdf', 'Form_Bimbingan_1402018666_20.pdf', 'Persyaratan_Sidang_1402018666_20.pdf', '2022-06-07 15:14:14', 'DISETUJUI'),
(8, 21, 'Draft_Final_1402018999_21.pdf', 'Form_Bimbingan_1402018999_21.pdf', 'Persyaratan_Sidang_1402018999_21.pdf', '2022-06-15 08:14:43', 'DISETUJUI'),
(9, 22, 'Draft_Final_1402018888_22.pdf', 'Form_Bimbingan_1402018888_22.pdf', 'Persyaratan_Sidang_1402018888_22.pdf', '2022-06-15 11:07:25', 'DISETUJUI'),
(10, 23, 'Draft_Final_1402018111_23.pdf', 'Form_Bimbingan_1402018111_23.pdf', 'Persyaratan_Sidang_1402018111_23.pdf', '2022-06-15 15:55:49', 'DISETUJUI'),
(12, 14, 'Draft_Final_1502017110_14.pdf', 'Form_Bimbingan_1502017110_14.pdf', 'Persyaratan_Sidang_1502017110_14.pdf', '2022-06-18 22:15:37', 'DISETUJUI'),
(13, 9, 'Draft_Final_1502015199_9.pdf', 'Form_Bimbingan_1502015199_9.pdf', 'Persyaratan_Sidang_1502015199_9.pdf', '2022-06-18 22:16:05', 'DISETUJUI'),
(14, 24, 'Draft_Final_1502018999_24.pdf', 'Form_Bimbingan_1502018999_24.pdf', 'Persyaratan_Sidang_1502018999_24.pdf', '2022-06-22 21:37:22', 'DISETUJUI');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_sidang`
--

CREATE TABLE `penilaian_sidang` (
  `id` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_sidang_skripsi` int(11) NOT NULL,
  `nilai_1` float NOT NULL,
  `nilai_2` float NOT NULL,
  `nilai_3` float NOT NULL,
  `nilai_4` float NOT NULL,
  `nilai_5` float NOT NULL,
  `nilai_6` float NOT NULL,
  `nilai_7` float NOT NULL,
  `nilai_8` float NOT NULL,
  `nilai_9` float NOT NULL,
  `nilai_10` float NOT NULL,
  `nilai_11` float NOT NULL,
  `nilai_12` float NOT NULL,
  `nilai_akhir` float NOT NULL,
  `grade` varchar(5) NOT NULL,
  `status` enum('LULUS','TIDAK LULUS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian_sidang`
--

INSERT INTO `penilaian_sidang` (`id`, `id_dosen`, `id_sidang_skripsi`, `nilai_1`, `nilai_2`, `nilai_3`, `nilai_4`, `nilai_5`, `nilai_6`, `nilai_7`, `nilai_8`, `nilai_9`, `nilai_10`, `nilai_11`, `nilai_12`, `nilai_akhir`, `grade`, `status`) VALUES
(3, 2, 11, 3.9, 3.9, 3.7, 3.8, 3.8, 3.6, 3.8, 3.6, 3.6, 3.8, 3.8, 3.8, 3.76, 'A', 'LULUS'),
(4, 1, 11, 4, 4, 4, 3.9, 3.8, 3.9, 3.8, 3.8, 3.8, 4, 4, 4, 3.92, 'A', 'LULUS'),
(6, 3, 10, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(7, 3, 14, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(8, 2, 14, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, '', 'TIDAK LULUS'),
(9, 2, 15, 3.8, 3.8, 3.8, 3.9, 4, 3.7, 3.9, 4, 4, 3.7, 4, 3.5, 3.83, 'A', 'LULUS'),
(10, 1, 15, 3.7, 3.8, 4, 4, 3.8, 4, 3.8, 3.8, 4, 4, 3.9, 4, 3.92, 'A', 'LULUS'),
(11, 3, 15, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 3.9, 3.99, 'A', 'LULUS'),
(12, 1, 16, 3.5, 3.5, 3.5, 4, 4, 4, 3.9, 3.8, 4, 4, 4, 4, 3.9, 'A', 'LULUS'),
(13, 3, 16, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(14, 2, 16, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(15, 3, 17, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 'B', 'LULUS'),
(16, 2, 17, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(17, 1, 17, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 'B', 'LULUS'),
(18, 2, 18, 3.5, 3.5, 3.5, 3.5, 3.5, 3.5, 3.5, 3.5, 3.5, 3.5, 3.5, 3.5, 3.5, 'B+', 'LULUS'),
(19, 4, 25, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 3.8, 3, 3.84, 'A', 'LULUS');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `inisial` varchar(10) NOT NULL,
  `mode_sempro` enum('Asinkronus','Sinkronus Daring','Sinkronus Luring') DEFAULT NULL,
  `id_fakultas` int(11) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id`, `nama`, `inisial`, `mode_sempro`, `id_fakultas`, `email`) VALUES
(1, 'Teknik Informatika', 'TI', 'Asinkronus', 1, 'teknik.informatika@gmail.com'),
(2, 'Perpustakaan dan Sains Informasi', 'PdSI', 'Sinkronus Daring', 1, 'pdsi.yarsi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `npm` varchar(10) NOT NULL,
  `sifat` enum('Baru','Lanjutan') NOT NULL,
  `sumber` enum('Sendiri','Dosen','Teman','Keluarga') NOT NULL,
  `file_proposal` varchar(255) NOT NULL,
  `tanggal_upload` datetime NOT NULL,
  `dosen_usulan1` int(11) NOT NULL,
  `dosen_usulan2` int(11) NOT NULL,
  `status` enum('TERTUNDA','DITERIMA','REVISI','DITOLAK') NOT NULL DEFAULT 'TERTUNDA',
  `komentar` text DEFAULT NULL,
  `pembuat_komentar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `judul`, `id_bidang`, `npm`, `sifat`, `sumber`, `file_proposal`, `tanggal_upload`, `dosen_usulan1`, `dosen_usulan2`, `status`, `komentar`, `pembuat_komentar`) VALUES
(17, 'SISTEM PERENCANAAN PEMILIHAH JURUSAN KULIAH\nMENGGUNAKAN METODE TRAVEL PLANNER BERBASIS', 6, '1502018100', 'Lanjutan', 'Sendiri', 'Proposal_1502018100_12052022030622.pdf', '2022-05-12 03:06:22', 4, 4, 'DITERIMA', 'Perbanyak literasi', 4),
(18, 'DETEKSI SERANGAN DDOS PADA SOFTWARE DEFINED\nNETWORK (SDN) BERBASIS SURICATA MENGGUNAKAN\nCONTROLLER OPENDAYLIGHT', 5, '1502015199', 'Baru', 'Sendiri', 'Proposal_1502015199_12052022031438.pdf', '2022-05-12 03:14:38', 4, 4, 'DITERIMA', '-', 4),
(19, 'APLIKASI PEMBELAJARAN TERKAIT PENGENALAN ALAT\nMUSIK TRADISIONAL GAMELAN JAWA BERBASIS\nANDROID PADA SISWA SEKOLAH DASAR', 7, '1402018300', 'Baru', 'Teman', 'Proposal_1402018300_12052022060827.pdf', '2022-05-12 06:08:27', 4, 4, 'DITOLAK', 'Sudah sering dilakukan', 4),
(20, 'SISTEM PAKAR DIAGNOSA PENYAKIT LAMBUNG\nBERBASIS ANDROID MENGGUNAKAN METODE\nBACKWARD CHAINING', 2, '1402016314', 'Baru', 'Dosen', 'Proposal_1402016314_13052022091043.pdf', '2022-05-13 09:10:43', 1, 2, 'DITOLAK', 'Penulisan tidak sesuai dengan panduan', 2),
(21, 'PEMILIAHAN METODE DAN ALGORITMA DALAM\nANALISIS SENTIMEN TERHADAP PENYEDIA LAYANAN\nSELULER PADA TWITTER MENGGUNAKAN DEEP', 2, '1402016314', 'Baru', 'Dosen', 'Proposal_1402016314_13052022091513.pdf', '2022-05-13 09:15:13', 2, 2, 'DITERIMA', 'Perbanyak literasi', 3),
(22, 'Klasifikasi Pengidap Murmur Jantung Menggunakan Deep', 2, '1402018189', 'Baru', 'Sendiri', 'Proposal_1402018189_14052022011325.pdf', '2022-05-14 01:13:25', 2, 2, 'DITERIMA', 'Penelitian yang menarik', 1),
(23, 'KLASIFIKASI PENYAKIT KANKER MULUT DENGAN\nMENGGUNAKAN METODE CONVOLUTIONAL NEURAL\nNETWORK BERDASARKAN CITRA DIGITAL', 2, '1402017188', 'Baru', 'Dosen', 'Proposal_1402017188_14052022095354.pdf', '2022-05-14 09:53:54', 2, 2, 'REVISI', 'Melakukan revisi dengan HH', 1),
(24, 'IMPLEMENTASI METODE MARKERLESS PADA\nAUGMENTED REALITY PENGENALAN OBJEK KERANGKA\nMANUSIA BERBASIS ANDROID', 6, '1402018300', 'Baru', 'Dosen', 'Proposal_1402018300_16052022040201.pdf', '2022-05-16 16:02:01', 4, 4, 'REVISI', 'mantap dah', 4),
(25, 'Pembuatan Sistem Database Stunting di Kabupaten Pandeglang', 5, '1502017110', 'Lanjutan', 'Teman', 'Proposal_1502017110_26062022013310.pdf', '2022-06-26 13:37:56', 4, 4, 'DITERIMA', 'Sudah cukup baik', 4),
(26, 'KLASIFIKASI PHISHING PADA SITUS WEBSITE\nMENGGUNAKAN ALGORITMA CATBOOST', 2, '1402017300', 'Baru', 'Sendiri', 'Proposal_1402017300_28052022020729.pdf', '2022-05-28 14:07:29', 2, 3, 'DITOLAK', 'Literasi masih kurang', 2),
(27, 'PENGEMBANGAN SISTEM OTOMATISASI OPERASIONAL\nPUSAT BEKAM RUQYAH BEKASI MENGGUNAKAN\nALGORITMA FIFO BERBASIS PROGRESSIVE WEB', 6, '1502016200', 'Baru', 'Dosen', 'Proposal_1502016200_28052022023009.pdf', '2022-05-28 14:30:09', 4, 4, 'DITERIMA', 'Sudah cukup baik, perbanyak literasi', 4),
(28, 'ANALISIS PERBANDINGAN KOMPUTASI PARALEL PADA\nSINGLE', 3, '1402017300', 'Lanjutan', 'Dosen', 'Proposal_1402017300_28052022023709.pdf', '2022-05-28 14:37:09', 2, 3, 'DITOLAK', 'Tidak mengumpulkan video seminar proposal', 3),
(29, 'Game Pengenalan Sampah 2D Berbasis Mobile', 1, '1402017300', 'Baru', 'Keluarga', 'Proposal_1402017300_28052022024053.pdf', '2022-05-28 14:40:53', 3, 1, 'REVISI', 'Hubungi AF', 1),
(31, 'SISTEM PREDIKSI KELULUSAN MAHASISWA PROGRAM\nSTUDI TEKNIK INFORMATIKA MENGGUNAKAN\nALGORITMA K – NEAREST NEIGHBOUR\n(STUDI KASUS: UNIVERSITAS YARSI)', 2, '1402015666', 'Baru', 'Dosen', 'Proposal_1402015666_31052022024415.pdf', '2022-05-31 14:44:15', 1, 1, 'DITERIMA', 'Perbanyak literasi', 1),
(32, 'ANALISIS CITRA RETONOPATY DIABETIC UNTUK\nMENDETEKSI TINGKAT KEBUTAAN MENGGUNAKAN\nMETODECONVOLUTIONAL NEURAL NETWORK (CNN).', 2, '1402017777', 'Baru', 'Dosen', 'Proposal_1402017777_05062022100750.pdf', '2022-06-05 22:07:57', 3, 1, 'DITOLAK', 'Tidak mencantumkan sitasi', 3),
(33, 'Perancangan Media Pembelajaran Sistem Gerak dan Gangguan\npada Sistem Gerak Manusia Berbasis Augmented Reality (Studi\nKasus : SMP Yappenda Jakarta Utara)', 2, '1402017777', 'Baru', 'Dosen', 'Proposal_1402017777_05062022101033.pdf', '2022-06-05 22:10:33', 1, 2, 'REVISI', 'Perbaiki lagi', 3),
(34, 'Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi Universitas YARSI', 4, '1402018666', 'Lanjutan', 'Dosen', 'Proposal_1402018666_07062022025957.pdf', '2022-06-07 14:59:57', 1, 3, 'DITERIMA', 'Sudah cukup baik, perbanyak literasi', 2),
(35, 'Sistem Informasi Skripsi (TheSIS) Fakultas Teknologi Informasi', 4, '1402018999', 'Lanjutan', 'Dosen', 'Proposal_1402018999_14062022194028.pdf', '2022-06-15 07:41:03', 1, 3, 'DITERIMA', 'Sudah cukup baik, Perbanyak literasi.', 2),
(36, 'Sistem Informasi Skripsi FTI Universitas YARSI', 4, '1402018888', 'Lanjutan', 'Dosen', 'Proposal_1402018888_14062022225659.pdf', '2022-06-15 10:56:59', 2, 3, 'REVISI', 'Perbanyak literasi.', 1),
(37, 'Sistem Informasi Skripsi Fakultas Teknologi Informasi Universitas YARSI', 4, '1402018111', 'Lanjutan', 'Dosen', 'Proposal_1402018111_26062022014924.pdf', '2022-06-26 13:49:24', 1, 2, 'DITERIMA', 'Perbanyak literasi', 1),
(38, 'Proposal anak IP ketujuh', 7, '1502018999', 'Baru', 'Sendiri', 'Proposal_1502018999_18062022094554.pdf', '2022-06-18 21:45:54', 4, 4, 'DITERIMA', 'sudah cukup bagus', 4);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama`) VALUES
(1, 'mahasiswa'),
(2, 'dosen'),
(3, 'kaprodi'),
(4, 'tendik'),
(5, 'fakultas');

-- --------------------------------------------------------

--
-- Table structure for table `seminar_prasidang`
--

CREATE TABLE `seminar_prasidang` (
  `id` int(11) NOT NULL,
  `id_skripsi` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `ruangan` varchar(255) NOT NULL,
  `dosen_reviewer` int(11) NOT NULL,
  `komentar_reviewer` text DEFAULT NULL,
  `status` enum('TERTUNDA','LAYAK SIDANG','TIDAK LAYAK SIDANG') NOT NULL,
  `rekomendasi_nilai` enum('RENDAH','SEDANG','TINGGI') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seminar_prasidang`
--

INSERT INTO `seminar_prasidang` (`id`, `id_skripsi`, `tanggal`, `ruangan`, `dosen_reviewer`, `komentar_reviewer`, `status`, `rekomendasi_nilai`) VALUES
(20, 11, '2022-05-23 11:00:00', 'Ruang 2', 3, 'great lahasdfasdf', 'LAYAK SIDANG', 'SEDANG'),
(21, 15, '2022-05-25 12:00:00', 'Ruang 30', 1, 'sudah bagus dan mantep pokoknya', 'LAYAK SIDANG', 'SEDANG'),
(25, 18, '2022-06-01 13:00:00', 'Ruang 504', 2, 'mantap deh kamu', 'TIDAK LAYAK SIDANG', 'RENDAH'),
(29, 19, '2022-06-10 10:00:00', 'R 504', 3, 'coba tingkatkan lagi tampilannya', 'LAYAK SIDANG', 'SEDANG'),
(30, 20, '2022-06-15 10:00:00', 'Ruang 504', 2, 'Sudah siap sidang, perlu ada beberapa perbaikan', 'LAYAK SIDANG', 'TINGGI'),
(32, 21, '2022-06-15 13:00:00', 'Ruang 504', 2, 'Perbaikan pada fitur pemilihan pembimbing, penentuan jadwal dan seminar proposal', 'LAYAK SIDANG', 'TINGGI'),
(33, 22, '2022-06-16 13:00:00', 'Ruang 504', 3, 'Perbaiki sistem', 'LAYAK SIDANG', 'SEDANG'),
(34, 23, '2022-06-17 13:00:00', 'Ruang 504', 2, 'Perbaikan fitur', 'LAYAK SIDANG', 'SEDANG'),
(38, 9, '2022-06-20 13:00:00', 'R 510', 4, 'mantap', 'LAYAK SIDANG', 'SEDANG'),
(40, 24, '2022-06-20 13:02:00', 'R 512', 4, 'mantap', 'LAYAK SIDANG', 'TINGGI'),
(41, 14, '2022-06-20 13:01:00', 'R 511', 4, 'mantap', 'LAYAK SIDANG', 'TINGGI'),
(43, 10, '2022-06-20 08:00:00', 'https://us02web.zoom.us/j/87138824537?pwd=RzNlV2U2Nis3d0FIOEZUbWhaV3JUZz09', 1, 'Perlu ada perbaikan pada beberapa fitur seperti fitur ....', 'LAYAK SIDANG', 'SEDANG');

-- --------------------------------------------------------

--
-- Table structure for table `seminar_proposal`
--

CREATE TABLE `seminar_proposal` (
  `id` int(11) NOT NULL,
  `id_proposal` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `ruangan` varchar(70) DEFAULT NULL,
  `link_video` varchar(255) DEFAULT NULL,
  `link_konferensi` varchar(255) DEFAULT NULL,
  `dosen_penguji1` int(11) DEFAULT NULL,
  `dosen_penguji2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seminar_proposal`
--

INSERT INTO `seminar_proposal` (`id`, `id_proposal`, `tanggal`, `ruangan`, `link_video`, `link_konferensi`, `dosen_penguji1`, `dosen_penguji2`) VALUES
(37, 18, '2022-05-13 13:00:00', 'Ruang Multimedia', NULL, NULL, 4, NULL),
(38, 17, '2022-05-14 10:00:00', 'Ruang R04', NULL, NULL, 4, NULL),
(40, 19, '2022-05-10 17:00:00', 'Ruang Rapat', NULL, NULL, 4, 4),
(41, 20, '2022-05-03 14:22:33', NULL, 'https://localhost.com/iouoiu', NULL, NULL, NULL),
(42, 21, '2022-06-01 14:22:45', NULL, 'https://casldkfasdf.com', NULL, NULL, NULL),
(43, 22, '2022-05-11 14:22:53', NULL, 'https://google.com', NULL, NULL, NULL),
(44, 23, '2022-06-07 14:23:01', NULL, 'https://asdlfkjasd.com', NULL, NULL, NULL),
(54, 25, '2022-05-12 13:00:00', NULL, NULL, 'https://us04web.zoom.us/j/79803311486?pwd=stgSbCZ7Y9Fb60QyjVJmz6236DHTNM.1', 4, 4),
(55, 26, '2022-05-03 14:23:07', NULL, 'https://www.videosemproti5.com/yang-baru', NULL, NULL, NULL),
(56, 27, '2022-06-01 10:00:00', NULL, NULL, 'https://us04web.zoom.us/j/79803311486?pwd=stgSbCZ7Y9Fb60QyjVJmz6236DHTNM.1', 4, 4),
(57, 28, '2022-05-10 14:23:12', NULL, 'https://videobaru.com', NULL, NULL, NULL),
(58, 29, '2022-06-06 14:23:17', NULL, 'https://videocapek.com', NULL, NULL, NULL),
(61, 31, '2022-05-03 14:23:20', NULL, 'https://asdfasdf.com', NULL, NULL, NULL),
(62, 32, '2022-06-05 22:08:23', NULL, 'https://localhost.8080.com', NULL, NULL, NULL),
(63, 33, '2022-06-05 22:11:19', NULL, 'https://asdlkfjasl.com', NULL, NULL, NULL),
(64, 34, '2022-06-07 15:01:20', NULL, 'https://videoseminarproposal.co.id', NULL, NULL, NULL),
(65, 35, '2022-06-15 07:41:52', NULL, 'https://google.co.id', NULL, NULL, NULL),
(66, 36, '2022-06-15 10:57:50', NULL, 'https://google.co.id', NULL, NULL, NULL),
(67, 37, '2022-06-15 15:22:24', NULL, 'https://google.com', NULL, NULL, NULL),
(70, 24, '2022-03-20 13:01:00', 'R Ruangan', NULL, 'https://google.com', 4, NULL),
(71, 38, '2022-03-20 13:00:00', 'R Ruangan', NULL, 'https://google.com', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sidang_skripsi`
--

CREATE TABLE `sidang_skripsi` (
  `id` int(11) NOT NULL,
  `id_skripsi` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `ruangan` varchar(255) NOT NULL,
  `dosen_penguji` int(11) NOT NULL,
  `total_nilai` float DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL,
  `status` enum('LULUS','TIDAK LULUS') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sidang_skripsi`
--

INSERT INTO `sidang_skripsi` (`id`, `id_skripsi`, `tanggal`, `ruangan`, `dosen_penguji`, `total_nilai`, `grade`, `status`) VALUES
(10, 10, '2022-06-03 10:00:00', 'Ruang Rapat', 3, NULL, NULL, NULL),
(11, 15, '2022-06-02 11:00:00', 'Ruang R04', 1, 3.88, 'A', 'LULUS'),
(14, 19, '2022-06-10 10:00:00', 'Ruang Multimedia', 3, 3.33333, 'B+', 'LULUS'),
(15, 20, '2022-06-30 11:00:00', 'Ruang MDI', 2, 3.91333, 'A', 'LULUS'),
(16, 21, '2022-06-17 13:00:00', 'Ruang Multimedia', 1, 3.96667, 'A', 'LULUS'),
(17, 22, '2022-06-16 13:00:00', 'Ruang 504', 3, 3.25, 'B+', 'LULUS'),
(18, 23, '2022-06-17 13:00:00', 'Ruang 504', 2, NULL, NULL, NULL),
(20, 18, '2022-06-20 13:00:00', 'https://us02web.zoom.us/j/87138824537?pwd=RzNlV2U2Nis3d0FIOEZUbWhaV3JUZz09', 1, NULL, NULL, NULL),
(21, 9, '2022-07-22 13:00:00', 'R 504', 4, NULL, NULL, NULL),
(22, 14, '2022-07-22 13:01:00', 'R 505', 4, NULL, NULL, NULL),
(25, 24, '2022-07-22 13:02:00', 'R 506', 4, 3.84, 'A', 'LULUS');

-- --------------------------------------------------------

--
-- Table structure for table `skripsi`
--

CREATE TABLE `skripsi` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `sumber` enum('Sendiri','Dosen','Teman','Keluarga') NOT NULL,
  `sifat` enum('Baru','Lanjutan') NOT NULL,
  `npm` varchar(10) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `tanggal_skripsi` datetime NOT NULL,
  `tanggal_selesai_skripsi` datetime DEFAULT NULL,
  `file_skripsi` varchar(255) DEFAULT NULL,
  `status` enum('Dalam Pengerjaan','Lulus','Tidak Lulus') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skripsi`
--

INSERT INTO `skripsi` (`id`, `judul`, `sumber`, `sifat`, `npm`, `id_bidang`, `tanggal_skripsi`, `tanggal_selesai_skripsi`, `file_skripsi`, `status`) VALUES
(9, 'Perancangan Sistem Aplikasi Berbasis Android Sebagai Media\nPenjualan Dan Pemasaran Pada Umkm Konveksi (Studi Kasus\nKonveksi Mattsind)', 'Dosen', 'Baru', '1502015199', 6, '2022-05-13 08:40:49', NULL, '', 'Dalam Pengerjaan'),
(10, 'SISTEM PREDIKSI KELULUSAN MAHASISWA PROGRAM STUDI TEKNIK INFORMATIKA MENGGUNAKAN ALGORITMA K–NEAREST NEIGHBOUR (STUDI KASUS: UNIVERSITAS YARSI)', 'Sendiri', 'Baru', '1402016314', 2, '2022-05-13 09:28:09', NULL, '', 'Dalam Pengerjaan'),
(11, 'PEMILIHAN METODE DAN ALGORITMA DALAM ANALISIS SENTIMEN TERHADAP PENYEDIA LAYANAN SELULER PADA TWITTER MENGGUNAKAN DEEP', 'Dosen', 'Baru', '1402018189', 2, '2022-05-14 01:15:39', NULL, '', 'Dalam Pengerjaan'),
(12, 'Perancangan Media Pembelajaran Sistem Gerak dan Gangguan\npada Sistem Gerak Manusia Berbasis Augmented Reality (Studi\nKasus : SMP Yappenda Jakarta Utara)', 'Teman', 'Baru', '1402017188', 1, '2022-05-14 10:50:18', NULL, '', 'Dalam Pengerjaan'),
(14, 'Pengembangan Sistem Magang FTI Universitas YARSI Berbasis\nWeb', 'Sendiri', 'Baru', '1502017110', 6, '2022-05-23 20:23:53', NULL, '', 'Dalam Pengerjaan'),
(15, 'APLIKASI PENGENALAN DAN PEMBELAJARAN METAMORFOSIS PADA HEWAN MENGGUNAKAN TEKNOLOGI AUGMENTED REALITY BERBASIS ANDROID', 'Dosen', 'Baru', '1402017300', 1, '2022-05-28 14:44:29', NULL, NULL, 'Lulus'),
(18, 'Game Pengenalan Sampah 2D Berbasis Mobile', 'Sendiri', 'Baru', '1402015666', 1, '2022-06-04 23:32:19', NULL, '', 'Dalam Pengerjaan'),
(19, 'KLASIFIKASI PHISHING PADA SITUS WEBSITE\nMENGGUNAKAN ALGORITMA CATBOOST', 'Teman', 'Baru', '1402017777', 2, '2022-06-05 22:13:14', '2022-06-22 20:29:17', 'Skripsi_1402017777_19.pdf', 'Lulus'),
(20, 'Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi Universitas YARSI', 'Dosen', 'Lanjutan', '1402018666', 4, '2022-06-07 15:04:08', '2022-06-22 20:52:49', 'Skripsi_1402018666_20.pdf', 'Lulus'),
(21, 'Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi Universitas YARSI', 'Dosen', 'Lanjutan', '1402018999', 4, '2022-06-15 07:44:42', '2022-06-22 20:34:50', 'Skripsi_1402018999_21.pdf', 'Lulus'),
(22, 'Sistem Informasi Skripsi FTI Universitas YARSI', 'Dosen', 'Lanjutan', '1402018888', 4, '2022-06-15 10:59:44', '2022-06-26 20:20:23', 'Skripsi_1402018888_22.pdf', 'Lulus'),
(23, 'Sistem Informasi Skripsi Universitas YARSI', 'Dosen', 'Lanjutan', '1402018111', 4, '2022-06-15 15:38:00', NULL, NULL, 'Dalam Pengerjaan'),
(24, 'judul skripsi anak ip nih', 'Sendiri', 'Baru', '1502018999', 7, '2022-06-18 21:56:22', NULL, '', 'Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `sumber_daya`
--

CREATE TABLE `sumber_daya` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nama_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sumber_daya`
--

INSERT INTO `sumber_daya` (`id`, `nama`, `nama_file`) VALUES
(6, 'Penduan Penulisan Skripsi 2022', 'Penduan_Penulisan_Skripsi_2022.pdf'),
(7, 'Template Lembar Persetujuan Penulisan Skripsi', 'Template_Lembar_Persetujuan_Penulisan_Skripsi.pdf'),
(8, 'Template Lembar Persetujuan Seminar Prasidang', 'Template_Lembar_Persetujuan_Seminar_Prasidang.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tenaga_kependidikan`
--

CREATE TABLE `tenaga_kependidikan` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenaga_kependidikan`
--

INSERT INTO `tenaga_kependidikan` (`id`, `nama`, `email`) VALUES
(2, 'Tendik', 'tendik1@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `catatan_bimbingan`
--
ALTER TABLE `catatan_bimbingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pembimbing` (`id_pembimbing`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kalender_skripsi`
--
ALTER TABLE `kalender_skripsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `makalah`
--
ALTER TABLE `makalah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bidang` (`id_bidang`),
  ADD KEY `npm` (`npm`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_skripsi` (`id_skripsi`);

--
-- Indexes for table `penelitian_dosen`
--
ALTER TABLE `penelitian_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_prasidang`
--
ALTER TABLE `pengajuan_prasidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_skripsi` (`id_skripsi`);

--
-- Indexes for table `pengajuan_sidang`
--
ALTER TABLE `pengajuan_sidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_skripsi` (`id_skripsi`);

--
-- Indexes for table `penilaian_sidang`
--
ALTER TABLE `penilaian_sidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_sidang_skripsi` (`id_sidang_skripsi`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `npm` (`npm`),
  ADD KEY `id_bidang` (`id_bidang`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seminar_prasidang`
--
ALTER TABLE `seminar_prasidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_skripsi` (`id_skripsi`);

--
-- Indexes for table `seminar_proposal`
--
ALTER TABLE `seminar_proposal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proposal` (`id_proposal`);

--
-- Indexes for table `sidang_skripsi`
--
ALTER TABLE `sidang_skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_skripsi` (`id_skripsi`);

--
-- Indexes for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bidang` (`id_bidang`),
  ADD KEY `npm` (`npm`);

--
-- Indexes for table `sumber_daya`
--
ALTER TABLE `sumber_daya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenaga_kependidikan`
--
ALTER TABLE `tenaga_kependidikan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `catatan_bimbingan`
--
ALTER TABLE `catatan_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kalender_skripsi`
--
ALTER TABLE `kalender_skripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `makalah`
--
ALTER TABLE `makalah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `penelitian_dosen`
--
ALTER TABLE `penelitian_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengajuan_prasidang`
--
ALTER TABLE `pengajuan_prasidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pengajuan_sidang`
--
ALTER TABLE `pengajuan_sidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `penilaian_sidang`
--
ALTER TABLE `penilaian_sidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seminar_prasidang`
--
ALTER TABLE `seminar_prasidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `seminar_proposal`
--
ALTER TABLE `seminar_proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `sidang_skripsi`
--
ALTER TABLE `sidang_skripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `skripsi`
--
ALTER TABLE `skripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sumber_daya`
--
ALTER TABLE `sumber_daya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tenaga_kependidikan`
--
ALTER TABLE `tenaga_kependidikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses`
--
ALTER TABLE `akses`
  ADD CONSTRAINT `akses_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`),
  ADD CONSTRAINT `akses_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);

--
-- Constraints for table `bidang`
--
ALTER TABLE `bidang`
  ADD CONSTRAINT `bidang_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `program_studi` (`id`);

--
-- Constraints for table `catatan_bimbingan`
--
ALTER TABLE `catatan_bimbingan`
  ADD CONSTRAINT `catatan_bimbingan_ibfk_1` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id`);

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `program_studi` (`id`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `program_studi` (`id`);

--
-- Constraints for table `makalah`
--
ALTER TABLE `makalah`
  ADD CONSTRAINT `makalah_ibfk_1` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id`),
  ADD CONSTRAINT `makalah_ibfk_2` FOREIGN KEY (`npm`) REFERENCES `mahasiswa` (`npm`);

--
-- Constraints for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD CONSTRAINT `pembimbing_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `pembimbing_ibfk_2` FOREIGN KEY (`id_skripsi`) REFERENCES `skripsi` (`id`);

--
-- Constraints for table `pengajuan_prasidang`
--
ALTER TABLE `pengajuan_prasidang`
  ADD CONSTRAINT `pengajuan_prasidang_ibfk_1` FOREIGN KEY (`id_skripsi`) REFERENCES `skripsi` (`id`);

--
-- Constraints for table `pengajuan_sidang`
--
ALTER TABLE `pengajuan_sidang`
  ADD CONSTRAINT `pengajuan_sidang_ibfk_1` FOREIGN KEY (`id_skripsi`) REFERENCES `skripsi` (`id`);

--
-- Constraints for table `penilaian_sidang`
--
ALTER TABLE `penilaian_sidang`
  ADD CONSTRAINT `penilaian_sidang_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `penilaian_sidang_ibfk_2` FOREIGN KEY (`id_sidang_skripsi`) REFERENCES `sidang_skripsi` (`id`);

--
-- Constraints for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD CONSTRAINT `program_studi_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id`);

--
-- Constraints for table `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `proposal_ibfk_1` FOREIGN KEY (`npm`) REFERENCES `mahasiswa` (`npm`),
  ADD CONSTRAINT `proposal_ibfk_2` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id`);

--
-- Constraints for table `seminar_prasidang`
--
ALTER TABLE `seminar_prasidang`
  ADD CONSTRAINT `seminar_prasidang_ibfk_1` FOREIGN KEY (`id_skripsi`) REFERENCES `skripsi` (`id`);

--
-- Constraints for table `seminar_proposal`
--
ALTER TABLE `seminar_proposal`
  ADD CONSTRAINT `seminar_proposal_ibfk_1` FOREIGN KEY (`id_proposal`) REFERENCES `proposal` (`id`);

--
-- Constraints for table `sidang_skripsi`
--
ALTER TABLE `sidang_skripsi`
  ADD CONSTRAINT `sidang_skripsi_ibfk_1` FOREIGN KEY (`id_skripsi`) REFERENCES `skripsi` (`id`);

--
-- Constraints for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD CONSTRAINT `skripsi_ibfk_1` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id`),
  ADD CONSTRAINT `skripsi_ibfk_2` FOREIGN KEY (`npm`) REFERENCES `mahasiswa` (`npm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
