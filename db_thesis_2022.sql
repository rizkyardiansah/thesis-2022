-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 02:18 PM
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
(2, 4, 1),
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
(20, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `email`, `password`) VALUES
(4, 'muhammadrizkyardiansah93@gmail.com', '$2y$10$t9CFEftfU2nb7GsfR17cM.DtrNsLX118gEbh1sU4hw8t9GhbvzBwa'),
(5, 'tendik1@gmail.com', '$2y$10$2lStY4LhEHSyURBpm6.a.uoQ0lrrrnA6HS1gdg0H3KqnrEj.mnaIa'),
(6, 'elan.suherlan@gmail.com', '$2y$10$QAhbRerL8cNNpDMvAIIb3OcAeQPQVM4n63jNpSp/VwqZYsQ5.ONdK'),
(7, 'andreas.febrian@gmail.com', '$2y$10$HeQZV5hrviCDUHrHp6zU.O8j9pj48j3OCHmt8zhiXb81p70b8Bf7u'),
(8, 'herika.hayurani@gmail.com', '$2y$10$u/yI3icPwjF9fvuQHYYSC.zNAg2Ev4i8evX2Eu36lmc3qtPiIILFy'),
(9, 'sleepyweppy@gmail.com', '$2y$10$zi6pjh6Y5zQOwW6fawv4NeoLgzz2woZW4WdlW.nB2UCs9go2puz0a'),
(10, 'sleepyweppy@gmail.com', '$2y$10$6AnbzCSQzojl4J15SBawH.PeClSDkKLxxK3Ksi05oZp/LiFSdQoIe'),
(11, 'asdf@gmail.com', '$2y$10$5Uudlyvbgi4CUUwVc1A9l.aLMbgJYOsj82OqQzOi1wc83MiFSXQ6y'),
(12, 'sleepyweppy@gmail.com', '$2y$10$aUkUUACG85ir0tNpZTzZI.oHM7QZicQm0SNv.A95l1qlEz8PfWCFm'),
(13, 'indah.kurnianingsih@gmail.com', '$2y$10$QORdMjM68mlB7W5Kg.tOFeMNxwHY6w.nYIXcy2EtLFoRPlu7DU1py'),
(14, 'ip2@gmail.com', '$2y$10$PfBi/zi9PjFtGwNtQ0bJSuAvKw4yGXcVxHcNEXoTAZBCqqZ1P5TGW'),
(15, 'ti2@gmail.com', '$2y$10$KO4mp/.htreQULQOSqREhuEu9JqRBftwQl5Utq.qMnbpMZjDKaqIa'),
(16, 'ti3@gmail.com', '$2y$10$.G3QhcyNVmB/qw5MjQCiSOAxxjajNF1CVm8.rMp43bCoR1hIfNRCS'),
(17, 'ip3@gmail.com', '$2y$10$iBmNW0Jm9ImdRAxpeahoYu1WwBIjOQpi/Y.L59aEKGaqJ4lXFvMUq'),
(18, 'ti4@gmail.com', '$2y$10$0I.BjeYO0qQmmp9rSR/6musJXr6CokEq1mdA8VCOFcpKH57G9yZI6');

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
(12, 30, 'kj ;alsdkjf alskdj fl;askdjf ;laskdjf lkasdf ', '2022-05-14 00:00:00', 'TERTUNDA');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `inisial` varchar(10) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nama`, `email`, `inisial`, `id_prodi`, `alamat`, `no_telp`) VALUES
(1, 'Elan Suherlan, S.Si, M.Si', 'elan.suherlan@gmail.com', 'ES', 1, 'Jl. yang deket situ', '085767547645'),
(2, 'Andreas Febrian, S.Kom., M.Kom.', 'andreas.febrian@gmail.com', 'AF', 1, 'Jl. Jalan', '088976574224'),
(3, 'Herika Hayurani, S.Kom., M.Kom.', 'herika.hayurani@gmail.com', 'HH', 1, 'Jl. kesana kemari', '087689685356'),
(4, 'Indah Kurnianingsih, S.IP., M.P.', 'indah.kurnianingsih@gmail.com', 'IK', 2, 'Jl. Gak Lari', '086754343562');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `inisial` varchar(10) NOT NULL,
  `dekan` int(11) NOT NULL,
  `wadek_I` int(11) NOT NULL,
  `wadek_II` int(11) NOT NULL,
  `wadek_III` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`, `inisial`, `dekan`, `wadek_I`, `wadek_II`, `wadek_III`) VALUES
(1, 'Fakultas Teknologi Informasi', 'FTI', 0, 0, 0, 0);

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
(16, 'Pembuatan Proposal dan Pengumpulan Persyaratan Skripsi say', '2022-02-14', '2022-02-19'),
(17, 'Seminar Proposal', '2022-02-21', '2022-03-01'),
(18, 'Pengumuman Pembimbing Skripsi', '2022-03-04', '2022-03-04'),
(33, 'Pembekalan', '2022-03-15', '2022-05-09'),
(34, 'Pengumpulan Draft Pra Sidang', '2022-05-09', '2022-05-13'),
(36, 'y', '2022-05-04', '2022-05-05');

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
  `id_prodi` int(11) NOT NULL,
  `file_khs` varchar(255) DEFAULT NULL,
  `file_krs` varchar(255) DEFAULT NULL,
  `file_persetujuan_skripsi` varchar(255) DEFAULT NULL,
  `file_pengajuan_pra_sidang` varchar(255) DEFAULT NULL,
  `file_lembar_pengesahan` varchar(255) DEFAULT NULL,
  `file_form_bimbingan` varchar(255) DEFAULT NULL,
  `email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama`, `angkatan`, `sks_lulus`, `pembimbing_akademik`, `mk_sedang_diambil`, `mk_akan_diambil`, `status_persetujuan_skripsi`, `id_prodi`, `file_khs`, `file_krs`, `file_persetujuan_skripsi`, `file_pengajuan_pra_sidang`, `file_lembar_pengesahan`, `file_form_bimbingan`, `email`) VALUES
('1402016314', 'Mahasiswa TI 4', 2016, 130, 1, 'Agama 1, Agama 2, Agama 3', 'Agama 1, Agama 3', 'Disetujui', 1, 'KHS_1402016314.pdf', 'KRS_1402016314.pdf', 'PersetujuanSkripsi_1402016314.pdf', NULL, NULL, NULL, 'ti4@gmail.com'),
('1402017188', 'Mahasiswa TI 2', 2017, 137, 1, '-', '-', 'Disetujui', 1, 'KHS_1402017188.pdf', 'KRS_1402017188.pdf', 'PersetujuanSkripsi_1402017188.pdf', NULL, NULL, NULL, 'ti2@gmail.com'),
('1402018149', 'Muhammad Rizky Ardiansah', 2018, 130, 4, 'DDP, PBO, PBP', 'Agama 1, Agama 3', 'Disetujui', 2, 'KHS_1402018149.pdf', 'KRS_1402018149.pdf', 'PersetujuanSkripsi_1402018149.pdf', NULL, NULL, NULL, 'muhammadrizkyardiansah93@gmail.com'),
('1402018189', 'Mahasiswa TI 3', 2018, 137, 1, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', 1, 'KHS_1402018189.pdf', 'KRS_1402018189.pdf', 'PersetujuanSkripsi_1402018189.pdf', NULL, NULL, NULL, 'ti3@gmail.com'),
('1402018300', 'Sleepyweepy', 2018, 137, 2, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', 2, 'KHS_1402018300.pdf', 'KRS_1402018300.pdf', 'PersetujuanSkripsi_1402018300.pdf', NULL, NULL, NULL, 'sleepyweppy@gmail.com'),
('1502015199', 'Mahasiswa IP 3', 2015, 130, 4, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', 2, 'KHS_1502015199.pdf', 'KRS_1502015199.pdf', 'PersetujuanSkripsi_1502015199.pdf', NULL, NULL, NULL, 'ip3@gmail.com'),
('1502018100', 'Mahasiswa IP 2', 2018, 137, 4, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', 2, 'KHS_1502018100.pdf', 'KRS_1502018100.pdf', 'PersetujuanSkripsi_1502018100.pdf', NULL, NULL, NULL, 'ip2@gmail.com');

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
(42, 9, 4, 'Pembimbing Ilmu 1'),
(43, 9, 4, 'Pembimbing Ilmu 2'),
(44, 9, 4, 'Pembimbing Agama'),
(45, 12, 1, 'Pembimbing Ilmu 1'),
(46, 12, NULL, 'Pembimbing Ilmu 2'),
(47, 12, 3, 'Pembimbing Agama');

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
(10, 10, 'Draft_1402016314_10.pdf', 'LembarPersetujuanPrasidang_1402016314_10.pdf', '2022-05-16 09:28:31', 'DISETUJUI');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `inisial` varchar(10) NOT NULL,
  `kaprodi` int(11) NOT NULL,
  `mode_sempro` enum('Asinkronus','Sinkronus Daring','Sinkronus Luring') DEFAULT NULL,
  `id_fakultas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id`, `nama`, `inisial`, `kaprodi`, `mode_sempro`, `id_fakultas`) VALUES
(1, 'Teknik Informatika', 'TI', 1, 'Asinkronus', 1),
(2, 'Perpustakaan dan Sains Informasi', 'PdSI', 4, 'Sinkronus Luring', 1);

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
  `komentar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `judul`, `id_bidang`, `npm`, `sifat`, `sumber`, `file_proposal`, `tanggal_upload`, `dosen_usulan1`, `dosen_usulan2`, `status`, `komentar`) VALUES
(17, 'Mahasiswaa rajin banget ngumpulin duluan', 6, '1502018100', 'Lanjutan', 'Sendiri', 'Proposal_1502018100_12052022030622.pdf', '2022-05-12 03:06:22', 4, 4, 'DITERIMA', '\r\nbagus juga'),
(18, 'mahasiswa tiga ip yang jago', 5, '1502015199', 'Baru', 'Sendiri', 'Proposal_1502015199_12052022031438.pdf', '2022-05-12 03:14:38', 4, 4, 'DITERIMA', '\r\nBagus banget'),
(19, 'lksjd;fl kjas;dfl kja;sldkf j;alsdk fj', 7, '1402018300', 'Baru', 'Teman', 'Proposal_1402018300_12052022060827.pdf', '2022-05-12 06:08:27', 4, 4, 'DITOLAK', '\r\nMasih kurang literatur'),
(20, ' sdf asdf asdf asdf asd f', 2, '1402016314', 'Baru', 'Dosen', 'Proposal_1402016314_13052022091043.pdf', '2022-05-13 09:10:43', 1, 2, 'DITOLAK', '\r\nkjf ;lkasjd f;lkasjd f;lkaj sd;fl kjasdf'),
(21, ' asdf asdf asdf asdf asdfasdf asdf asdf ', 2, '1402016314', 'Baru', 'Dosen', 'Proposal_1402016314_13052022091513.pdf', '2022-05-13 09:15:13', 2, 2, 'DITERIMA', '\r\na df asdf asdf asdf asd f'),
(22, 'asd fa sdf asdf asd fasds ffasd f', 2, '1402018189', 'Baru', 'Sendiri', 'Proposal_1402018189_14052022011325.pdf', '2022-05-14 01:13:25', 2, 2, 'DITERIMA', '\r\n,askdjf l;k lajsd kjasd;dl ja; f'),
(23, 'asd fj;aslkd jf;alksjd f;laks jd;f', 2, '1402017188', 'Baru', 'Dosen', 'Proposal_1402017188_14052022095354.pdf', '2022-05-14 09:53:54', 2, 2, 'REVISI', '\r\naskdjf ;lkasjd f;lkaj sd;lfkasdf'),
(24, 'a l;flkja sdjf as;jf', 6, '1402018300', 'Baru', 'Dosen', 'Proposal_1402018300_16052022040201.pdf', '2022-05-16 16:02:01', 4, 4, 'TERTUNDA', NULL);

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
  `ruangan` varchar(70) NOT NULL,
  `dosen_penguji1` int(11) NOT NULL,
  `dosen_penguji2` int(11) DEFAULT NULL,
  `komentar_penguji1` text DEFAULT NULL,
  `komentar_penguji2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seminar_prasidang`
--

INSERT INTO `seminar_prasidang` (`id`, `id_skripsi`, `tanggal`, `ruangan`, `dosen_penguji1`, `dosen_penguji2`, `komentar_penguji1`, `komentar_penguji2`) VALUES
(10, 10, '2022-05-20 18:00:00', 'Ruang504', 1, NULL, NULL, NULL);

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
(41, 20, NULL, NULL, 'https://localhost.com/iouoiu', NULL, NULL, NULL),
(42, 21, NULL, NULL, 'https://casldkfasdf.com', NULL, NULL, NULL),
(43, 22, NULL, NULL, 'https://google.com', NULL, NULL, NULL),
(44, 23, NULL, NULL, 'https://asdlfkjasd.com', NULL, NULL, NULL);

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
  `status` enum('Dalam Pengerjaan','Lulus','Tidak Lulus') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skripsi`
--

INSERT INTO `skripsi` (`id`, `judul`, `sumber`, `sifat`, `npm`, `id_bidang`, `tanggal_skripsi`, `status`) VALUES
(9, 'asdf asd fasd fasd fa sdf asddfasddf asd f', 'Dosen', 'Baru', '1502015199', 6, '2022-05-13 08:40:49', 'Dalam Pengerjaan'),
(10, 'a;ldskfa ljf sadf asdf as', 'Sendiri', 'Baru', '1402016314', 2, '2022-05-13 09:28:09', 'Dalam Pengerjaan'),
(11, 'lklkajsd; kjasdl;kfj as;lddkfj alsdkd jff;laksd f', 'Dosen', 'Baru', '1402018189', 2, '2022-05-14 01:15:39', 'Dalam Pengerjaan'),
(12, 'Judul Skripsi Mahasiswa TI 2 ', 'Teman', 'Baru', '1402017188', 1, '2022-05-14 10:50:18', 'Dalam Pengerjaan');

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
(2, 'Tendik 1', 'tendik1@gmail.com');

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
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_skripsi` (`id_skripsi`);

--
-- Indexes for table `pengajuan_prasidang`
--
ALTER TABLE `pengajuan_prasidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_skripsi` (`id_skripsi`);

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
-- Indexes for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bidang` (`id_bidang`),
  ADD KEY `npm` (`npm`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `catatan_bimbingan`
--
ALTER TABLE `catatan_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kalender_skripsi`
--
ALTER TABLE `kalender_skripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pengajuan_prasidang`
--
ALTER TABLE `pengajuan_prasidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seminar_prasidang`
--
ALTER TABLE `seminar_prasidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seminar_proposal`
--
ALTER TABLE `seminar_proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `skripsi`
--
ALTER TABLE `skripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tenaga_kependidikan`
--
ALTER TABLE `tenaga_kependidikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD CONSTRAINT `skripsi_ibfk_1` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id`),
  ADD CONSTRAINT `skripsi_ibfk_2` FOREIGN KEY (`npm`) REFERENCES `mahasiswa` (`npm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
