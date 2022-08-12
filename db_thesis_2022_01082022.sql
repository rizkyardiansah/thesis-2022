-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2022 at 12:48 PM
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
(7, 7, 2),
(8, 8, 2),
(9, 8, 5),
(13, 9, 1),
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
(35, 32, 1),
(46, 43, 1),
(48, 45, 1),
(49, 46, 1),
(50, 47, 1),
(51, 48, 1),
(52, 49, 1),
(53, 50, 1),
(54, 51, 1),
(55, 52, 1),
(56, 53, 1),
(57, 54, 1),
(58, 55, 1),
(59, 56, 1),
(60, 57, 1),
(61, 58, 1),
(62, 59, 1),
(63, 60, 1),
(64, 61, 1),
(65, 62, 1),
(66, 63, 1),
(67, 64, 1),
(68, 65, 1),
(69, 66, 1),
(70, 67, 2),
(71, 68, 1),
(72, 69, 1),
(73, 70, 1),
(74, 71, 1),
(75, 72, 1),
(76, 73, 1),
(77, 74, 1),
(78, 75, 1),
(79, 76, 1),
(80, 77, 1),
(81, 78, 1);

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
(6, 'elan.suherlan1', 'elan.suherlan@gmail.com', '$2y$10$QAhbRerL8cNNpDMvAIIb3OcAeQPQVM4n63jNpSp/VwqZYsQ5.ONdK'),
(7, 'andreas.f', 'andreas.febrian@gmail.com', '$2y$10$HeQZV5hrviCDUHrHp6zU.O8j9pj48j3OCHmt8zhiXb81p70b8Bf7u'),
(8, 'herika.h', 'herika.hayurani@gmail.com', '$2y$10$u/yI3icPwjF9fvuQHYYSC.zNAg2Ev4i8evX2Eu36lmc3qtPiIILFy'),
(9, 'sleepy.weppy', 'sleepyweppy@gmail.com', '$2y$10$zi6pjh6Y5zQOwW6fawv4NeoLgzz2woZW4WdlW.nB2UCs9go2puz0a'),
(12, 'sleepy.weppy', 'sleepyweppy@gmail.com', '$2y$10$aUkUUACG85ir0tNpZTzZI.oHM7QZicQm0SNv.A95l1qlEz8PfWCFm'),
(13, 'indah.kurnia', 'indah.kurnianingsih@gmail.com', '$2y$10$QORdMjM68mlB7W5Kg.tOFeMNxwHY6w.nYIXcy2EtLFoRPlu7DU1py'),
(14, 'dinda.fatma', 'ip2@gmail.com', '$2y$10$PfBi/zi9PjFtGwNtQ0bJSuAvKw4yGXcVxHcNEXoTAZBCqqZ1P5TGW'),
(15, '', 'ti2@gmail.com', '$2y$10$KO4mp/.htreQULQOSqREhuEu9JqRBftwQl5Utq.qMnbpMZjDKaqIa'),
(16, '', 'ti3@gmail.com', '$2y$10$.G3QhcyNVmB/qw5MjQCiSOAxxjajNF1CVm8.rMp43bCoR1hIfNRCS'),
(17, '', 'ip3@gmail.com', '$2y$10$iBmNW0Jm9ImdRAxpeahoYu1WwBIjOQpi/Y.L59aEKGaqJ4lXFvMUq'),
(18, 'yusuf.marzuki', 'ti4@gmail.com', '$2y$10$0I.BjeYO0qQmmp9rSR/6musJXr6CokEq1mdA8VCOFcpKH57G9yZI6'),
(19, 'marzuki.ali', 'ip4@gmail.com', '$2y$10$rZsoVPNAzlPwkMmKH2DbJOPWKvNZhAt1QGfbrm4Q8IE7YNiw9iN.q'),
(20, '', 'ti5@gmail.com', '$2y$10$sn6zXd4midhXKozXaNL/1ODgC2kzz4ygk/TQcVu256.HGuxPsbWdG'),
(21, 'ip.6', 'ip6@gmail.com', '$2y$10$zESRdSX4..6ypx9KuA3GuOd1efl0xx0dMexrm/WKRavvOId/7aDWC'),
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
(32, '', 'ip5@gmail.com', '$2y$10$Un.STw/JFsRFGIj4Zh6Bx.XCnwYiw1UJUIWrQ0qOpdkR0E.khAPga'),
(43, 'surli', 'surli2946@gmail.com', '$2y$10$NSa6FFFThSIsFPNgbx6kDuZ652k3w.tS4sH/ZPkzopKVVKdrR1xb.'),
(45, 'farhan.dasyandra', 'farhanlarenzo@gmail.com', '$2y$10$XsaIselnOfwNJ3cMImPC8OuONfbxsN7q3ZGPxxArc8wyaTUu/Eyze'),
(46, 'muhammad.raihan', 'raihansuryanom99@gmail.com', '$2y$10$h5ku7WeP85W2vGvBk9cmKe3zy9EIJ7Ofpmh9qYP7qb7Ykf53qSoia'),
(47, 'melynda.putri', 'melyndaputri999@gmail.com', '$2y$10$SNXq8dohU6d6qTRIWRugneY86qHppUlSPFuSFTJNcg0ifLlPECXoi'),
(48, 'salsa.ajizah', 'salsa.ay00@gmail.com', '$2y$10$931/D.jPkUoLSziQ2/6jYuiBuAfEK4Zkm63QIqNO8S/tA4TtqVpTe'),
(49, 'nurjanah4079', 'nrjanah889@gmail.com', '$2y$10$8HvyYDX2t8BlYuUJ7E8ybOwLoQZUbZ6tKWwf3RMSnSI8AXwMFEwyO'),
(50, 'restu.setyoka', 'rsetyoka@gmail.com', '$2y$10$ExImiZAc2Ib3gvCukJO2te/cfJZb15KLJmuQrsZOyt66wJOvYLR1u'),
(51, 'siti.indriyani ', 'indryaniast62@gmail.com', '$2y$10$FX7DFKgezN970Q2ink2yvOLHhAy0Q7kzz61yu7TxmRk02YfAtJske'),
(52, 'reza.ardhiansyah', 'rezardhiansyah19@gmail.com', '$2y$10$NeD1o4cQFurwlUL1HSraz./5xbVO3BaWT/dp6fhFTXf30XXQ757GO'),
(53, 'arkan.wijdan', 'arkanwijdan00@gmail.com', '$2y$10$6qH9Pvs0UO8Wn5GNXIyw6e/NF1lIZifYbaTLssN0IMUS3QS5YG4VS'),
(54, 'juan.daniel', 'junker6.jd@gmail.com', '$2y$10$i2qL8YYHt6roJqH/BG1Fser/ZvfTDfWL7UfeA5DDXdeqL8GzBfprG'),
(55, 'rio.prasetyo', 'rprstyo27@gmail.com', '$2y$10$.lU/vkbL559VffTS48tFKuPNoP1ELLx4qHaiBj4dRNDFtkAmhWEp2'),
(56, 'akhmat.nurfauzy', 'akhmatnf@gmail.com', '$2y$10$ZC0BLb9z0rKzmJdn0jsQx.KxJ3DPa/T9vzxE.XuZgB3GJcGLPdrJi'),
(57, 'muhammad.rananda', 'dafarananda278@gmail.com', '$2y$10$YRxtAMlnZ75CqQ/QyyEpr.jmRI1DkbbB3HnWlRi8M2PoCKtLb31f2'),
(58, 'Robi.alhadhi', 'robialhadi.95@gmail.com', '$2y$10$hYSmC0kPSCyr/RKwc.Fe8e2oDjIxw2p6D/g/UA6GYnX8G4HL6sc5q'),
(59, 'nahdah.naila', 'nahdahnaila@gmail.com', '$2y$10$qrD17DBUups5/6EHnv8baek1FjL60GvfADO0W.JGj6f3kVdWmZ9DK'),
(60, 'afra.annisa', 'afraannisa01@gmail.com', '$2y$10$cwCnhPhNJxVSFEaAxJZJKe3apq2GPX8AbXkoOh7cVSZ6LYLP9mnfi'),
(61, 'annisa.azzahra', 'annisazhra22@gmail.com', '$2y$10$H1Opcz01x9Q/GbGCwz3/huMkYMR62iqc3RfjkEQbcE6ZXNf7KNp6.'),
(62, 'muhammad.yayang', 'muhammadyayang1@gmail.com', '$2y$10$Dcq7lxBr41zQjrJJ6GlZ3eUW83ZFN.mF4QR./EWlb84Xk8i6mTCf6'),
(63, 'lutfia.nurrahmah', 'Lutfiadewi2016@gmail.com', '$2y$10$2RTf9XCZx5zJPC9mNomn9.6bBK.ZK6M1SEZF7nsZHY2PCAE.uKiQ6'),
(64, 'aam.samrotul', 'aamsamrotul24@gmail.com', '$2y$10$SGwrfJNc3WEPBD2FwMG1vuyRpvhJ4r/7HxoPqlWmKOUcEOYUyh6TC'),
(65, 'alifah.nurmalasari', 'Alifahsari.17@gmail.com', '$2y$10$bOQO0ore2h9PV6sFf3u86eupHJ3oZMb5y9QGv87EhHkK2N1NsaWL2'),
(66, 'sayyid.kutub', 'sayyidworks@gmail.com', '$2y$10$L7kvbv9Bxs.ZhCoi/KApAeOJi6LlzLlRd3lUjlUzLhlyiOLk5vbb2'),
(67, 'elan.suherlan', 'elan.suherlan70@gmail.com', '$2y$10$QoqgdxrLpxvaVwzg5LIcner3TI8icw2rWRyElVtlD5.0kJlFaw8bC'),
(68, 'fadhlan.nurrachmad', 'jjnfadhlan@gmail.com', '$2y$10$k8ji8f8v1AgPMCnmRpR3Eeq0zi7W6IYlgnjXjSVoXhe.Kt7dxhnz.'),
(69, 'firda.andriani', 'firdandriani07@gmail.com', '$2y$10$rA35pvG0DWBpKBwudpt6VuNW59md.5F/1y44znIKPehs/2wm2plwe'),
(70, 'dani.dharmawan', 'danidarmawan94@gmail.com', '$2y$10$DtBeHeo0V9TMjh2S8ZCBZu1zsqosl1Z1YARjqhCb2ecwBtQLoiNRG'),
(71, 'm.alpisyahdan', 'alpisyahdan11@gmail.com', '$2y$10$sy8x.YwV3NMOh5Ebmjjr/eIuEpmsqHQG55uQeEBxLk3JRXM/rZKY6'),
(72, 'susilo.yudayono', 'bamsusilo91@gmail.com', '$2y$10$p/12N2gdT/ek/Z7jXrzSBucrnDDilUH21lXy.TCbJFH4bsc9unvVK'),
(73, 'nanda.mulya', 'nandaamelianti@gmail.com', '$2y$10$ylf2PN.NQ7qdv4tB2zBmEegwCCf5UPN8/fIGsIdjLHMK06VwsSPpq'),
(74, 'utami.dini', 'dini@markods.com', '$2y$10$ME00xnfiaV2rT.PuNXy1uuHGsQw1ZhdW10cOVO1eIiO6HdV9dZbB2'),
(75, 'Erika.nur', 'erknraffh4@gmail.com', '$2y$10$fbm5usw2je5qd7HzYPVUkOSr16uJ7cDk18E2aR3ZVJMIU8GPMazMy'),
(76, 'jodi.kurniawan', 'jodikr8s@gmail.com', '$2y$10$oA1gQIJ8DsA3eKXAfBZaG.UJomOnCelIHuEtzUp.NtqK/VoxPlNXC'),
(77, 'farhan.abdul', 'farhanaziz939@gmail.com', '$2y$10$TPvfoPiGEOSyY0PMBgH3N.lj7hVbaWKKrN833bnm2jvY1KQyBmR4u'),
(78, 'feriza.fajrin', 'ffajrin30@gmail.com', '$2y$10$qC5bgXYPzrs.TYUB1sq2AuQ0zYNuySasiAjvzFwB5SyaEtCR9wZzK');

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
(10, 21, ' asdf asdf asdf asd fasd fasd fasd fasd f', '2022-05-08 00:00:00', 'DISETUJUI'),
(11, 23, ' ;lksdjf ;lasdkjf ;lkajsd f;lka jsd ;flka jsd f', '2022-05-14 00:00:00', 'DISETUJUI'),
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
(25, 99, 'Pengarahan Bab 3', '2022-06-07 00:00:00', 'DISETUJUI'),
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
(53, 113, 'Finalisasi Bab 5', '2022-06-30 00:00:00', 'DISETUJUI'),
(66, 158, 'Bimbingan bab 1', '2022-07-01 00:00:00', 'DISETUJUI'),
(67, 158, 'coba', '2022-07-01 00:00:00', 'DISETUJUI'),
(68, 158, 'coba', '2022-07-01 00:00:00', 'DISETUJUI'),
(69, 158, 'coba', '2022-07-01 00:00:00', 'DISETUJUI'),
(70, 156, 'coba', '2022-07-01 00:00:00', 'DISETUJUI'),
(71, 156, 'coba', '2022-07-01 00:00:00', 'DISETUJUI'),
(72, 156, 'coba', '2022-07-01 00:00:00', 'DISETUJUI'),
(73, 156, 'coba', '2022-07-01 00:00:00', 'DISETUJUI'),
(74, 156, 'coba', '2022-07-01 00:00:00', 'DISETUJUI'),
(75, 156, 'coba', '2022-07-01 00:00:00', 'DISETUJUI'),
(76, 156, 'coba', '2022-07-01 00:00:00', 'DISETUJUI'),
(77, 156, 'coba', '2022-07-01 00:00:00', 'DISETUJUI'),
(78, 159, 'a.&#9;Bapak/Ibu A, selaku dosen pembimbing Ilmu dan Bapak/Ibu B, selaku dosen pembimbing Agama, yang telah menyediakan waktu, tenaga, dan pikiran &#13;&#10;', '2022-07-01 00:00:00', 'DISETUJUI'),
(79, 159, 'easfsd', '2022-07-01 00:00:00', 'DISETUJUI'),
(80, 159, 'asfa', '2022-07-01 00:00:00', 'DISETUJUI'),
(81, 159, 'asfcfasdfs&#13;&#10;', '2022-07-01 00:00:00', 'DISETUJUI'),
(82, 161, 'etrqetqwerw', '2022-07-01 00:00:00', 'DISETUJUI'),
(83, 161, 'qweqweq', '2022-07-01 00:00:00', 'DISETUJUI'),
(84, 161, 'qwerqw', '2022-07-01 00:00:00', 'DISETUJUI'),
(85, 159, 'rqweasqdqw', '2022-07-01 00:00:00', 'DISETUJUI'),
(86, 159, 'wwrfwerf', '2022-07-01 00:00:00', 'DISETUJUI'),
(87, 159, 'fdcsad', '2022-07-01 00:00:00', 'DISETUJUI'),
(88, 161, 'werwqrqw', '2022-07-01 00:00:00', 'DISETUJUI'),
(89, 159, 'sadas', '2022-07-01 00:00:00', 'DISETUJUI'),
(90, 159, 'sfcasc&#13;&#10;', '2022-07-01 00:00:00', 'DISETUJUI'),
(91, 162, 'Tester 1', '2022-07-02 00:00:00', 'DISETUJUI'),
(92, 162, 'Tester 2', '2022-07-02 00:00:00', 'DISETUJUI'),
(93, 162, 'Tester 3', '2022-07-02 00:00:00', 'DISETUJUI'),
(94, 162, 'Tester 4', '2022-07-02 00:00:00', 'DISETUJUI'),
(95, 162, 'Tester 5', '2022-07-02 00:00:00', 'DISETUJUI'),
(96, 162, 'Tester 6', '2022-07-02 00:00:00', 'DISETUJUI'),
(97, 162, 'Tester 7', '2022-07-02 00:00:00', 'DISETUJUI'),
(98, 162, 'Tester 8', '2022-07-02 00:00:00', 'DISETUJUI'),
(99, 164, 'Tester 1', '2022-07-02 00:00:00', 'DISETUJUI'),
(100, 164, 'Tester 2', '2022-07-02 00:00:00', 'DISETUJUI'),
(101, 164, 'Tester 1', '2022-07-02 00:00:00', 'DISETUJUI'),
(102, 164, 'Tester 5', '2022-07-02 00:00:00', 'DISETUJUI'),
(103, 164, 'Tester 4', '2022-07-02 00:00:00', 'DISETUJUI'),
(104, 167, 'Tes1 ', '2022-07-02 00:00:00', 'DISETUJUI'),
(105, 167, 'Tes2', '2022-07-16 00:00:00', 'DISETUJUI'),
(106, 167, 'Tes3 ', '2022-07-30 00:00:00', 'DISETUJUI'),
(107, 165, 'Tes1', '2022-07-03 00:00:00', 'DISETUJUI'),
(108, 165, 'Tes2', '2022-07-10 00:00:00', 'DISETUJUI'),
(109, 165, 'Tes3', '2022-07-17 00:00:00', 'DISETUJUI'),
(110, 165, 'Tes4', '2022-07-24 00:00:00', 'DISETUJUI'),
(111, 167, 'Tes4', '2022-08-06 00:00:00', 'DISETUJUI'),
(112, 165, 'Tes5', '2022-08-07 00:00:00', 'DISETUJUI'),
(113, 165, 'Tes6', '2022-08-14 00:00:00', 'DISETUJUI'),
(114, 165, 'Tes7', '2022-08-21 00:00:00', 'DISETUJUI'),
(115, 165, 'Tes8', '2022-08-28 00:00:00', 'DISETUJUI'),
(116, 168, 'abk', '2022-07-02 00:00:00', 'DISETUJUI'),
(117, 168, 'latar belakang dan bab 1 bab 2', '2022-07-11 00:00:00', 'DISETUJUI'),
(118, 168, 'penggunaan metodologi penelitian bab 3', '2022-07-13 00:00:00', 'DISETUJUI'),
(119, 170, 'ayat tentang anak berkebutuhan khusus', '2022-07-14 00:00:00', 'DISETUJUI'),
(120, 168, 'bimbingan tentang aplikasi ', '2022-07-15 00:00:00', 'DISETUJUI'),
(121, 170, 'ayat tentang menuntut  ilmu', '2022-07-18 00:00:00', 'DISETUJUI'),
(122, 168, 'demo aplikasi', '2022-07-20 00:00:00', 'DISETUJUI'),
(123, 168, 'bimbingan hasil pembahasan ', '2022-07-21 00:00:00', 'DISETUJUI'),
(124, 170, 'ayat dan hadist revisi', '2022-07-22 00:00:00', 'DISETUJUI'),
(125, 168, 'revisi bab 3 metodelogi', '2022-07-25 00:00:00', 'DISETUJUI'),
(126, 170, 'ayat sesuai dan revisi jurnal yang di dapat sumber hadist', '2022-07-27 00:00:00', 'DISETUJUI'),
(127, 168, 'bimbingan demo aplikasi', '2022-07-28 00:00:00', 'DISETUJUI'),
(129, 171, 'fdasfasfdasfdsadfsasdf&#13;&#10;', '2022-07-02 00:00:00', 'DISETUJUI'),
(130, 171, 'fgzdfbdzfbdf', '2022-07-02 00:00:00', 'DISETUJUI'),
(131, 173, 'rggdrdzgdfdgdgdgdf', '2022-07-02 00:00:00', 'DISETUJUI'),
(132, 171, 'fdzbzzdfsgzfsgzdsfszfdfdsfdsz', '2022-07-02 00:00:00', 'DISETUJUI'),
(133, 171, 'cvvzzcsvzxcvczxvcxzcvxz', '2022-07-02 00:00:00', 'DISETUJUI'),
(134, 171, 'zxxzc  czdcsazx zccas&#13;&#10;', '2022-07-02 00:00:00', 'DISETUJUI'),
(135, 171, 'vsfgdgdfgsfgdfsgdsgdfsgds', '2022-07-02 00:00:00', 'DISETUJUI'),
(136, 171, 'zxzxczxczxczxcxzcxzcxxzxzzxc', '2022-07-02 00:00:00', 'DISETUJUI'),
(137, 171, 'dvsdvdsvdsvdsvds&#13;&#10;', '2022-07-02 00:00:00', 'DISETUJUI'),
(138, 173, 'zxcx', '2022-07-02 00:00:00', 'DISETUJUI'),
(139, 173, 'zxdsdcsd', '2022-07-02 00:00:00', 'DISETUJUI'),
(140, 173, 'zxcasdabrrs', '2022-07-02 00:00:00', 'DISETUJUI'),
(141, 174, 'apache kafka', '2022-07-02 00:00:00', 'DISETUJUI'),
(142, 174, 'apache airflow', '2022-07-02 00:00:00', 'DISETUJUI'),
(143, 174, 'apache flink', '2022-07-02 00:00:00', 'DISETUJUI'),
(144, 174, 'hadoop&#13;&#10;', '2022-07-02 00:00:00', 'DISETUJUI'),
(145, 174, 'zookeeper', '2022-07-02 00:00:00', 'DISETUJUI'),
(146, 174, 'hbase', '2022-07-02 00:00:00', 'DISETUJUI'),
(147, 174, 'postgre', '2022-07-02 00:00:00', 'DISETUJUI'),
(148, 176, 'kiamat&#13;&#10;', '2022-07-02 00:00:00', 'DISETUJUI'),
(149, 176, 'solat', '2022-07-02 00:00:00', 'DISETUJUI'),
(150, 176, 'puasa', '2022-07-02 00:00:00', 'DISETUJUI'),
(151, 176, 'zakat', '2022-07-02 00:00:00', 'DISETUJUI'),
(153, 174, 'data mart', '2022-07-02 00:00:00', 'DISETUJUI'),
(154, 177, 'advd', '2022-07-02 00:00:00', 'DISETUJUI'),
(155, 177, 'ascdav', '2022-07-02 00:00:00', 'DISETUJUI'),
(156, 177, 'dvds', '2022-07-02 00:00:00', 'DISETUJUI'),
(157, 177, 'avdv', '2022-07-02 00:00:00', 'DISETUJUI'),
(158, 177, 'avdsv', '2022-07-02 00:00:00', 'DISETUJUI'),
(159, 177, 'Cs', '2022-07-02 00:00:00', 'DISETUJUI'),
(160, 177, 'XCdc', '2022-07-02 00:00:00', 'DISETUJUI'),
(161, 177, 'SCdac', '2022-07-02 00:00:00', 'DISETUJUI'),
(162, 179, 'XC z vc', '2022-07-02 00:00:00', 'DISETUJUI'),
(163, 179, 'SCS', '2022-07-02 00:00:00', 'DISETUJUI'),
(164, 179, 'svfsv', '2022-07-02 00:00:00', 'DISETUJUI'),
(165, 179, 'advd', '2022-07-02 00:00:00', 'DISETUJUI'),
(166, 180, 'bagus', '2022-07-02 00:00:00', 'DISETUJUI'),
(167, 180, 'mantap', '2022-07-02 00:00:00', 'DISETUJUI'),
(168, 180, 'sip', '2022-07-02 00:00:00', 'DISETUJUI'),
(169, 180, 'sip sip', '2022-07-02 00:00:00', 'DISETUJUI'),
(170, 180, 'woke', '2022-07-02 00:00:00', 'DISETUJUI'),
(171, 180, 'mantap', '2022-07-02 00:00:00', 'DISETUJUI'),
(172, 180, 'sip', '2022-07-02 00:00:00', 'DISETUJUI'),
(173, 180, 'sip', '2022-07-02 00:00:00', 'DISETUJUI'),
(174, 180, 'wkwkw', '2022-07-02 00:00:00', 'DISETUJUI'),
(175, 182, 'sip', '2022-07-02 00:00:00', 'DISETUJUI'),
(176, 182, 'iya', '2022-07-14 00:00:00', 'DISETUJUI'),
(177, 182, 'iyah', '2022-07-02 00:00:00', 'DISETUJUI'),
(178, 182, 'iya', '2022-07-18 00:00:00', 'DISETUJUI'),
(179, 183, 'pendahuluan', '2022-07-02 00:00:00', 'DISETUJUI'),
(180, 183, ' rumusan masalah', '2022-07-02 00:00:00', 'DISETUJUI'),
(181, 183, 'pengerjaan bab 2', '2022-07-02 00:00:00', 'DISETUJUI'),
(182, 183, 'adds', '2022-07-02 00:00:00', 'DISETUJUI'),
(183, 183, '5', '2022-07-02 00:00:00', 'DISETUJUI'),
(184, 183, '6', '2022-07-02 00:00:00', 'DISETUJUI'),
(185, 183, '7', '2022-07-02 00:00:00', 'DISETUJUI'),
(186, 183, '8', '2022-07-02 00:00:00', 'DISETUJUI'),
(187, 185, '1', '2022-07-02 00:00:00', 'DISETUJUI'),
(188, 185, '2', '2022-07-02 00:00:00', 'DISETUJUI'),
(189, 185, '3', '2022-07-02 00:00:00', 'DISETUJUI'),
(190, 185, '4', '2022-07-02 00:00:00', 'DISETUJUI'),
(191, 186, 'Pengembangan ide kurang diperdalam dan kurang dekat dengan isu sosial', '2022-07-02 00:00:00', 'DISETUJUI'),
(192, 188, 'Penulisan ayat kurang spasi dan ukuran font kurang tepat', '2022-07-02 00:00:00', 'TERTUNDA'),
(193, 186, 'Bab 2 kurang lengkap saat penulisan peneliti terdahulu&#13;&#10;', '2022-07-02 00:00:00', 'TERTUNDA'),
(194, 188, 'Penambahan ayat di Bab 5', '2022-07-06 00:00:00', 'TERTUNDA'),
(195, 186, 'Pemilihan Metode harus diubah', '2022-07-02 00:00:00', 'TERTUNDA'),
(196, 188, 'Penulisan ayat dengan rapih dan di akhir ayat diberi halaman surah', '2022-07-02 00:00:00', 'TERTUNDA'),
(197, 188, 'Penambahan ayat Al-Qur&#39;an dan penjelasan ayat kurang', '2022-07-02 00:00:00', 'TERTUNDA'),
(198, 186, 'Pembuatan aplikasi kurang banyak riset dan wawancara ke mitra', '2022-07-02 00:00:00', 'TERTUNDA'),
(199, 186, 'Aplikasi dibuat sederhana tampilannya dan fitur-fitur yang fungsional', '2022-07-02 00:00:00', 'TERTUNDA'),
(200, 186, 'Pengembangan aplikasi harus sesuai dengan kebutuhan mitra', '2022-07-02 00:00:00', 'TERTUNDA'),
(201, 186, 'Revisi materi pada aplikasi yang dikembangkan sesuai dengan permintaan mitra', '2022-07-02 00:00:00', 'TERTUNDA'),
(202, 186, 'Penambahan fitur kuis pada aplikasi', '2022-07-02 00:00:00', 'TERTUNDA'),
(203, 189, '1', '2022-07-02 00:00:00', 'DISETUJUI'),
(204, 189, '2', '2022-07-02 00:00:00', 'DISETUJUI'),
(205, 189, '3', '2022-07-02 00:00:00', 'DISETUJUI'),
(206, 189, '4', '2022-07-05 00:00:00', 'DISETUJUI'),
(207, 189, '5', '2022-07-13 00:00:00', 'DISETUJUI'),
(208, 189, '6', '2022-07-30 00:00:00', 'DISETUJUI'),
(209, 189, '7', '2022-08-01 00:00:00', 'DISETUJUI'),
(210, 189, '8', '2022-07-27 00:00:00', 'DISETUJUI'),
(211, 191, '1', '2022-07-02 00:00:00', 'DISETUJUI'),
(212, 191, '2', '2022-07-02 00:00:00', 'DISETUJUI'),
(213, 191, '3', '2022-07-02 00:00:00', 'DISETUJUI'),
(214, 191, '4', '2022-07-02 00:00:00', 'DISETUJUI'),
(215, 198, 'satu', '2022-06-19 00:00:00', 'DISETUJUI'),
(216, 198, 'dua', '2022-06-20 00:00:00', 'DISETUJUI'),
(217, 198, 'tiga', '2022-06-21 00:00:00', 'DISETUJUI'),
(218, 198, 'empat', '2022-06-22 00:00:00', 'DISETUJUI'),
(219, 198, 'lima', '2022-06-23 00:00:00', 'DISETUJUI'),
(220, 198, 'enam', '2022-06-24 00:00:00', 'DISETUJUI'),
(221, 198, 'tujuh', '2022-06-25 00:00:00', 'DISETUJUI'),
(222, 198, 'delapan', '2022-06-26 00:00:00', 'DISETUJUI'),
(223, 200, 'satu', '2022-06-18 00:00:00', 'DISETUJUI'),
(224, 200, 'dua', '2022-06-21 00:00:00', 'DISETUJUI'),
(225, 200, 'tiga', '2022-06-23 00:00:00', 'DISETUJUI'),
(226, 200, 'empat', '2022-06-30 00:00:00', 'DISETUJUI'),
(228, 201, 'demo aplikasi', '2022-07-03 00:00:00', 'DISETUJUI'),
(229, 201, 'penulisan bab 2', '2022-08-03 00:00:00', 'DISETUJUI'),
(230, 201, 'penulisan bab 3', '2022-09-03 00:00:00', 'DISETUJUI'),
(231, 201, 'penulisan bab 4', '2022-10-03 00:00:00', 'DISETUJUI'),
(232, 201, 'revisi bab 1', '2022-02-03 00:00:00', 'DISETUJUI'),
(233, 201, 'revisi aplikasi ', '2022-12-03 00:00:00', 'DISETUJUI'),
(235, 201, 'revisi bab 2', '2022-02-03 00:00:00', 'DISETUJUI'),
(236, 201, 'revisi bab 4', '2022-02-27 00:00:00', 'DISETUJUI'),
(237, 203, 'agama bab 1', '2022-07-14 00:00:00', 'DISETUJUI'),
(238, 203, 'penulisan bab 5', '2022-08-14 00:00:00', 'DISETUJUI'),
(239, 203, 'penulisan bab 5', '2022-08-14 00:00:00', 'DISETUJUI'),
(240, 203, 'Revisi bab 5', '2022-08-25 00:00:00', 'DISETUJUI'),
(241, 201, 'Revisi bab 5', '2022-08-30 00:00:00', 'DISETUJUI'),
(242, 204, 'Konteks?', '2022-05-09 00:00:00', 'DISETUJUI'),
(243, 204, 'ngapa si bang', '2022-05-25 00:00:00', 'DISETUJUI'),
(244, 204, 'bakdDNKSNAL', '2022-05-30 00:00:00', 'DISETUJUI'),
(245, 204, 'sanaknckdnca', '2022-06-06 00:00:00', 'DISETUJUI'),
(246, 204, 'Gacha berhadiah?', '2022-06-14 00:00:00', 'DISETUJUI'),
(247, 206, 'utlubul ilma minal mahdi ilal lahdi', '2022-06-02 00:00:00', 'DISETUJUI'),
(248, 204, 'hslsnlsm.lsmls', '2022-06-21 00:00:00', 'DISETUJUI'),
(249, 206, 'Baca arti surah (Q.S. Adh-Dhuhaa : 6)', '2022-06-15 00:00:00', 'DISETUJUI'),
(250, 204, 'nengdongnejddmsfsfs', '2022-08-02 00:00:00', 'DISETUJUI'),
(251, 206, 'ayat al isra ayat 78&#13;&#10;', '2022-06-21 00:00:00', 'DISETUJUI'),
(252, 206, 'baca ayat al hud ayat 114', '2022-07-02 00:00:00', 'DISETUJUI'),
(253, 204, 'aku siapa?&#13;&#10;', '2022-07-03 00:00:00', 'DISETUJUI'),
(254, 207, 'Ilmu ghoib', '2022-07-03 00:00:00', 'DISETUJUI'),
(255, 207, 'ilmu ghoib ke-2', '2022-07-03 00:00:00', 'DISETUJUI'),
(256, 207, 'ilmu ghoib ke-3', '2022-07-03 00:00:00', 'DISETUJUI'),
(257, 207, 'ilmu ghoib ke-4', '2022-07-03 00:00:00', 'DISETUJUI'),
(258, 207, 'ilmu ghoib ke-5', '2022-07-03 00:00:00', 'DISETUJUI'),
(259, 207, 'ilmu ghoib ke-6', '2022-07-03 00:00:00', 'DISETUJUI'),
(260, 207, 'ilmu ghoib ke-7', '2022-07-03 00:00:00', 'DISETUJUI'),
(261, 207, 'ilmu ghoib ke-8', '2022-07-03 00:00:00', 'DISETUJUI'),
(262, 209, 'Membuat Agama ghoib ke-1', '2022-07-03 00:00:00', 'DISETUJUI'),
(263, 209, 'Membuat Agama ghoib ke-2', '2022-07-03 00:00:00', 'DISETUJUI'),
(264, 209, 'Membuat Agama ghoib ke-3', '2022-07-03 00:00:00', 'DISETUJUI'),
(265, 209, 'Membuat Agama ghoib ke-4', '2022-07-03 00:00:00', 'DISETUJUI'),
(266, 210, 'cek draft', '2022-07-03 00:00:00', 'DISETUJUI'),
(267, 210, 'ok&#13;&#10;', '2022-07-03 00:00:00', 'DISETUJUI'),
(268, 210, 'ok&#13;&#10;', '2022-07-03 00:00:00', 'DISETUJUI'),
(269, 210, 'ok', '2022-07-03 00:00:00', 'DISETUJUI'),
(270, 210, 'ok', '2022-07-03 00:00:00', 'DISETUJUI'),
(271, 210, 'ok', '2022-07-03 00:00:00', 'DISETUJUI'),
(272, 210, 'ok', '2022-07-03 00:00:00', 'DISETUJUI'),
(273, 210, 'ok', '2022-07-03 00:00:00', 'DISETUJUI'),
(274, 210, 'ok', '2022-07-03 00:00:00', 'DISETUJUI'),
(275, 212, 'cek', '2022-07-03 00:00:00', 'DISETUJUI'),
(276, 212, 'ok', '2022-07-03 00:00:00', 'DISETUJUI'),
(277, 212, 'ok', '2022-07-03 00:00:00', 'DISETUJUI'),
(278, 212, 'ok', '2022-07-03 00:00:00', 'DISETUJUI'),
(279, 213, 'mencari artikel yang berhubungan', '2022-07-04 00:00:00', 'DISETUJUI'),
(280, 213, 'cari bahan untuk pembuatan aplikasi', '2022-07-04 00:00:00', 'DISETUJUI'),
(281, 213, 'membuat aplikasi yang berhubungan dengan judul', '2022-07-04 00:00:00', 'DISETUJUI'),
(282, 213, 'tahap koding 1', '2022-07-04 00:00:00', 'DISETUJUI'),
(283, 213, 'tahap koding 2', '2022-07-04 00:00:00', 'DISETUJUI'),
(284, 213, 'Tahap Koding 3', '2022-07-04 00:00:00', 'DISETUJUI'),
(285, 213, 'Pemberi arahan penulisan', '2022-07-04 00:00:00', 'DISETUJUI'),
(286, 213, 'Revisi aplikasi dan Penulisan', '2022-07-04 00:00:00', 'DISETUJUI'),
(287, 215, 'mencari artikel agama', '2022-07-04 00:00:00', 'DISETUJUI'),
(288, 215, 'mencari hadist', '2022-07-04 00:00:00', 'DISETUJUI'),
(289, 215, 'Mencari ayat', '2022-07-04 00:00:00', 'DISETUJUI'),
(290, 215, 'revisi penulisan', '2022-07-04 00:00:00', 'DISETUJUI'),
(291, 216, 'satu', '2022-07-05 00:00:00', 'DISETUJUI'),
(292, 216, 'dua', '2022-07-05 00:00:00', 'DISETUJUI'),
(293, 216, 'tiga', '2022-07-05 00:00:00', 'DISETUJUI'),
(294, 216, 'empat', '2022-07-05 00:00:00', 'DISETUJUI'),
(295, 216, 'lima', '2022-07-05 00:00:00', 'DISETUJUI'),
(296, 216, 'enam', '2022-07-05 00:00:00', 'DISETUJUI'),
(297, 216, 'tujuh', '2022-07-05 00:00:00', 'DISETUJUI'),
(298, 216, 'delapan', '2022-07-05 00:00:00', 'DISETUJUI'),
(299, 218, 'satu agama', '2022-07-05 00:00:00', 'DISETUJUI'),
(300, 218, 'dua agama', '2022-07-05 00:00:00', 'DISETUJUI'),
(301, 218, 'tiga agama', '2022-07-05 00:00:00', 'DISETUJUI'),
(302, 218, 'empat agama', '2022-07-05 00:00:00', 'DISETUJUI'),
(303, 219, 'asdf', '2022-07-05 00:00:00', 'DISETUJUI'),
(304, 219, 'asddgasdg', '2022-07-05 00:00:00', 'DISETUJUI'),
(305, 219, 'bimbigan 3', '2022-07-05 00:00:00', 'DISETUJUI'),
(306, 219, 'bimbingan 5', '2022-07-14 00:00:00', 'DISETUJUI'),
(307, 219, 'bimbingan 4', '2022-07-08 00:00:00', 'DISETUJUI'),
(308, 219, 'bimbingan 6', '2022-07-16 00:00:00', 'DISETUJUI'),
(309, 219, 'bimbingan 7', '2022-07-24 00:00:00', 'DISETUJUI'),
(310, 219, 'bimbingan 8', '2022-07-30 00:00:00', 'DISETUJUI'),
(311, 221, 'bimbingan agama 1', '2022-07-05 00:00:00', 'DISETUJUI'),
(312, 221, 'bimbingan agama 2', '2022-07-11 00:00:00', 'DISETUJUI'),
(313, 221, 'bimbingan agama 3', '2022-07-20 00:00:00', 'DISETUJUI'),
(314, 221, 'bimbingan agama 4', '2022-07-28 00:00:00', 'DISETUJUI'),
(316, 225, 'materi 1', '2022-07-16 00:00:00', 'DISETUJUI'),
(317, 226, 'materi 2', '2022-07-16 00:00:00', 'DISETUJUI'),
(318, 225, 'materi 3', '2022-07-16 00:00:00', 'DISETUJUI'),
(319, 226, 'materi 4', '2022-07-16 00:00:00', 'DISETUJUI'),
(320, 225, 'materi 5', '2022-07-16 00:00:00', 'DISETUJUI'),
(321, 226, 'materi 6', '2022-07-16 00:00:00', 'DISETUJUI'),
(322, 225, 'materi 7', '2022-07-16 00:00:00', 'DISETUJUI'),
(323, 226, 'materi 8', '2022-07-16 00:00:00', 'DISETUJUI'),
(324, 227, 'agama 1', '2022-07-16 00:00:00', 'DISETUJUI'),
(325, 227, 'agama 2', '2022-07-16 00:00:00', 'DISETUJUI'),
(326, 227, 'agama 3', '2022-07-16 00:00:00', 'DISETUJUI'),
(327, 227, 'agama 4', '2022-07-16 00:00:00', 'DISETUJUI'),
(329, 231, 'BAB 1', '2022-07-19 00:00:00', 'DISETUJUI'),
(330, 231, 'BAB 2', '2022-07-19 00:00:00', 'DISETUJUI'),
(331, 231, 'BAB 3', '2022-07-19 00:00:00', 'DISETUJUI'),
(332, 231, 'BAB 4', '2022-07-19 00:00:00', 'DISETUJUI'),
(333, 233, 'BAB 5', '2022-07-19 00:00:00', 'DISETUJUI'),
(334, 231, 'REVISI BAB 1', '2022-07-19 00:00:00', 'DISETUJUI'),
(335, 231, 'REVISI BAB 2', '2022-07-19 00:00:00', 'DISETUJUI'),
(336, 231, 'REVISI BAB 4', '2022-07-19 00:00:00', 'DISETUJUI'),
(337, 233, 'BAB 1 BAGIAN AGAMA', '2022-07-19 00:00:00', 'DISETUJUI'),
(338, 231, 'REVISI BAB 3', '2022-07-19 00:00:00', 'DISETUJUI'),
(339, 233, 'REVISI BAB 5', '2022-07-19 00:00:00', 'DISETUJUI'),
(340, 233, 'REVISI BAB 6', '2022-07-19 00:00:00', 'DISETUJUI'),
(341, 234, 'a', '2022-07-21 00:00:00', 'DISETUJUI'),
(342, 234, 'b', '2022-07-21 00:00:00', 'DISETUJUI'),
(343, 234, 'c', '2022-07-21 00:00:00', 'DISETUJUI'),
(344, 234, 'd', '2022-07-21 00:00:00', 'DISETUJUI'),
(345, 234, 'e', '2022-07-21 00:00:00', 'DISETUJUI'),
(346, 234, 'f', '2022-07-21 00:00:00', 'DISETUJUI'),
(347, 234, 'g', '2022-07-21 00:00:00', 'DISETUJUI'),
(348, 234, 'h', '2022-07-21 00:00:00', 'DISETUJUI'),
(349, 236, 'j', '2022-07-21 00:00:00', 'DISETUJUI'),
(350, 236, 'k', '2022-07-21 00:00:00', 'DISETUJUI'),
(351, 236, 'l', '2022-07-21 00:00:00', 'DISETUJUI'),
(352, 236, 'm', '2022-07-21 00:00:00', 'DISETUJUI'),
(353, 21, 'adsf', '2022-07-21 00:00:00', 'DISETUJUI'),
(354, 21, 'asdf', '2022-07-21 00:00:00', 'DISETUJUI'),
(355, 21, 'asdf', '2022-07-21 00:00:00', 'DISETUJUI'),
(356, 21, 'asdf', '2022-07-21 00:00:00', 'DISETUJUI'),
(357, 21, 'asdf', '2022-07-21 00:00:00', 'DISETUJUI'),
(358, 21, 'asdf', '2022-07-21 00:00:00', 'DISETUJUI'),
(359, 23, 'asdf', '2022-07-21 00:00:00', 'DISETUJUI'),
(360, 23, 'asdf', '2022-07-21 00:00:00', 'DISETUJUI'),
(361, 23, 'asdf', '2022-07-21 00:00:00', 'DISETUJUI');

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
(1, 'Elan Suherlan, S.Si, M.Si', 'elan.suherlan@gmail.com', 'ES1', 1),
(2, 'Andreas Febrian, S.Kom., M.Kom.', 'andreas.febrian@gmail.com', 'AF', 1),
(3, 'Herika Hayurani, S.Kom., M.Kom.', 'herika.hayurani@gmail.com', 'HH', 1),
(4, 'Indah Kurnianingsih, S.IP., M.P.', 'indah.kurnianingsih@gmail.com', 'IK', 2),
(12, 'Elan Suherlan', 'elan.suherlan70@gmail.com', 'ES', 1);

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
(40, 'Masa Revisi dan Persiapan Sidang', '2022-06-24', '2022-07-24');

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
('1402017139', 'SAYYID KUTUB AL-HADDAD', 2017, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'sayyidworks@gmail.com'),
('1402017188', 'Faisal Akbar', 2017, 137, 1, '-', '-', 'Disetujui', '2022-06-03 11:39:32', 1, 'KHS_1402017188.pdf', 'KRS_1402017188.pdf', 'PersetujuanSkripsi_1402017188.pdf', 'ti2@gmail.com'),
('1402017300', 'Zidan Muhid', 2017, 16, 2, '&#60;script&#62;alert(&#34;tost&#34;)&#60;/script&#62;', '&#60;script&#62;alert(&#34;tust&#34;)&#60;/script&#62;', 'Disetujui', '2022-05-02 11:39:35', 1, 'KHS_1402017300.pdf', 'KRS_1402017300.pdf', 'PersetujuanSkripsi_1402017300.pdf', 'ti5@gmail.com'),
('1402017777', 'Fadil Irham', 2017, 137, 2, 'DDP, PBO, PBP', 'Agama 1, Agama 3', 'Disetujui', '2022-06-05 22:05:17', 1, 'KHS_1402017777.pdf', 'KRS_1402017777.pdf', 'PersetujuanSkripsi_1402017777.pdf', 'ti7@gmail.com'),
('1402018050', 'Muhammad Raihan Suryanom', 2018, 140, 3, '-', 'Skripsi', 'Disetujui', '2022-07-02 12:03:26', 1, 'KHS_1402018050.pdf', 'KRS_1402018050.pdf', 'PersetujuanSkripsi_1402018050.pdf', 'raihansuryanom99@gmail.com'),
('1402018053', 'Muhammad Yayang Cahyadi', 2018, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'muhammadyayang1@gmail.com'),
('1402018073', 'Alifah Nurmalasari', 2018, 140, 3, 'Tidak ada', 'Tidak ada', 'Disetujui', '2022-07-04 09:09:42', 1, 'KHS_1402018073.pdf', 'KRS_1402018073.pdf', 'PersetujuanSkripsi_1402018073.pdf', 'Alifahsari.17@gmail.com'),
('1402018079', 'Nurjanah', 2018, 139, 3, 'Penulisan Ilmiah', 'SKRIPSI', 'Disetujui', '2022-07-02 14:08:18', 1, 'KHS_1402018079.pdf', 'KRS_1402018079.pdf', 'PersetujuanSkripsi_1402018079.pdf', 'nrjanah889@gmail.com'),
('1402018083', 'Annisa Azzahra', 2018, 140, 2, 'Skripsi', '-', 'Disetujui', '2022-07-02 21:49:20', 1, 'KHS_1402018083.pdf', 'KRS_1402018083.pdf', 'PersetujuanSkripsi_1402018083.pdf', 'annisazhra22@gmail.com'),
('1402018111', 'Muhammad Rizky Ardiansah', 2018, 140, 1, '-', '-', 'Disetujui', '2022-06-15 15:16:13', 1, 'KHS_1402018111.pdf', 'KRS_1402018111.pdf', 'PersetujuanSkripsi_1402018111.pdf', 'ti11@gmail.com'),
('1402018112', 'Robi Alhadhi', 2018, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'robialhadi.95@gmail.com'),
('1402018131', 'Melynda Putri Tri Utami', 2018, 110, 1, 'skripsi', 'tidak ada', 'Disetujui', '2022-07-03 23:26:34', 1, 'KHS_1402018131.pdf', 'KRS_1402018131.pdf', 'PersetujuanSkripsi_1402018131.pdf', 'melyndaputri999@gmail.com'),
('1402018139', 'Farhan Abdul Aziz', 2018, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'farhanaziz939@gmail.com'),
('1402018151', 'Afra Annisa', 2018, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'afraannisa01@gmail.com'),
('1402018152', 'Reza Septian Ardhiansyah', 2018, 140, 2, '-', '-', 'Disetujui', '2022-07-02 17:00:13', 1, 'KHS_1402018152.pdf', 'KRS_1402018152.pdf', 'PersetujuanSkripsi_1402018152.pdf', 'rezardhiansyah19@gmail.com'),
('1402018153', 'Nahdah Naila', 2018, 140, 2, 'Skripsi', 'Skripsi', 'Disetujui', '2022-07-02 20:35:20', 1, 'KHS_1402018153.pdf', 'KRS_1402018153.pdf', 'PersetujuanSkripsi_1402018153.pdf', 'nahdahnaila@gmail.com'),
('1402018157', 'Rio Prasetyo', 2018, 140, 2, '0', 'skripsi', 'Disetujui', '2022-07-03 19:38:43', 1, 'KHS_1402018157.pdf', 'KRS_1402018157.pdf', 'PersetujuanSkripsi_1402018157.pdf', 'rprstyo27@gmail.com'),
('1402018160', 'Akhmat Nurfauzy', 2018, 140, 2, 'tidak ada', 'Skripsi', 'Disetujui', '2022-07-02 22:30:38', 1, 'KHS_1402018160.pdf', 'KRS_1402018160.pdf', 'PersetujuanSkripsi_1402018160.pdf', 'akhmatnf@gmail.com'),
('1402018166', 'M.alpisyahdan', 2018, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'alpisyahdan11@gmail.com'),
('1402018176', 'Nanda Mulya Amelianti', 2018, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'nandaamelianti@gmail.com'),
('1402018179', 'Siti Indriyani Astuti', 2018, 140, 2, 'Skripsi', 'Skripsi', 'Disetujui', '2022-07-02 16:07:08', 1, 'KHS_1402018179.pdf', 'KRS_1402018179.pdf', 'PersetujuanSkripsi_1402018179.pdf', 'indryaniast62@gmail.com'),
('1402018182', 'Surli', 2018, 100, 1, 'Skripsi', '-', 'Disetujui', '2022-07-01 09:56:47', 1, 'KHS_1402018182.pdf', 'KRS_1402018182.pdf', 'PersetujuanSkripsi_1402018182.pdf', 'surli2946@gmail.com'),
('1402018186', 'Farhan Dasyandra Larenzo', 2018, 140, 2, 'skripsi', '-', 'Disetujui', '2022-07-01 19:25:48', 1, 'KHS_1402018186.pdf', 'KRS_1402018186.pdf', 'PersetujuanSkripsi_1402018186.pdf', 'farhanlarenzo@gmail.com'),
('1402018189', 'Sinta Tia', 2018, 137, 1, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', '2022-06-14 11:39:45', 1, 'KHS_1402018189.pdf', 'KRS_1402018189.pdf', 'PersetujuanSkripsi_1402018189.pdf', 'ti3@gmail.com'),
('1402018193', 'Juan Daniel Halomoan', 2018, 134, 2, 'Skripsi', '-', 'Disetujui', '2022-07-03 20:54:58', 1, 'KHS_1402018193.pdf', 'KRS_1402018193.pdf', 'PersetujuanSkripsi_1402018193.pdf', 'junker6.jd@gmail.com'),
('1402018199', 'Erika Nur Afifah', 2018, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'erknraffh4@gmail.com'),
('1402018201', 'Susilo Yudayono', 2018, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'bamsusilo91@gmail.com'),
('1402018203', 'Jodi Kurniawan', 2018, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'jodikr8s@gmail.com'),
('1402018207', 'Muhammad Daffa Rananda', 2018, 130, 1, 'dasar dasar pemprograman', 'sistem operasi', 'Disetujui', '2022-07-02 20:49:11', 1, 'KHS_1402018207.pdf', 'KRS_1402018207.pdf', 'PersetujuanSkripsi_1402018207.pdf', 'dafarananda278@gmail.com'),
('1402018210', 'Restu Setyoka Anindita', 2018, 140, 1, 'skripsi', 'skripsi', 'Disetujui', '2022-07-02 15:15:55', 1, 'KHS_1402018210.pdf', 'KRS_1402018210.pdf', 'PersetujuanSkripsi_1402018210.pdf', 'rsetyoka@gmail.com'),
('1402018213', 'Utami Dini Islami', 2018, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'dini@markods.com'),
('1402018214', 'Arkan Wijdan', 2018, 140, 3, 'Agama 3', 'tidak ada', 'Disetujui', '2022-07-02 17:09:45', 1, 'KHS_1402018214.pdf', 'KRS_1402018214.pdf', 'PersetujuanSkripsi_1402018214.pdf', 'arkanwijdan00@gmail.com'),
('1402018223', 'Lutfia Nurrahmah Dewi', 2018, 140, 2, 'penulisan ilmiah', 'Skipsi', 'Disetujui', '2022-07-03 14:39:03', 1, 'KHS_1402018223.pdf', 'KRS_1402018223.pdf', 'PersetujuanSkripsi_1402018223.pdf', 'Lutfiadewi2016@gmail.com'),
('1402018300', 'Kamila Damayanti', 2018, 137, 2, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', '2022-05-18 11:39:48', 2, 'KHS_1402018300.pdf', 'KRS_1402018300.pdf', 'PersetujuanSkripsi_1402018300.pdf', 'sleepyweppy@gmail.com'),
('1402018666', 'Iqbal Mahdi', 2018, 137, 1, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', '2022-06-07 14:57:23', 1, 'KHS_1402018666.pdf', 'KRS_1402018666.pdf', 'PersetujuanSkripsi_1402018666.pdf', 'ti8@gmail.com'),
('1402018888', 'Rizal Fajri', 2018, 140, 1, '-', '-', 'Disetujui', '2022-06-15 10:54:42', 1, 'KHS_1402018888.pdf', 'KRS_1402018888.pdf', 'PersetujuanSkripsi_1402018888.pdf', 'ti10@gmail.com'),
('1402018999', 'Rizalun Akbar', 2018, 140, 2, '-', '-', 'Disetujui', '2022-06-15 07:35:35', 1, 'KHS_1402018999.pdf', 'KRS_1402018999.pdf', 'PersetujuanSkripsi_1402018999.pdf', 'ti9@gmail.com'),
('1502015199', 'Sekar Sari', 2015, 130, 4, '-', 'Agama 1, Agama 2, Agama 3', 'Disetujui', '2022-06-21 22:58:46', 2, 'KHS_1502015199.pdf', 'KRS_1502015199.pdf', 'PersetujuanSkripsi_1502015199.pdf', 'ip3@gmail.com'),
('1502016200', 'Puspita Dewi', 2016, 137, 4, 'Agama 1, Agama 2, Agama 3', 'Agama 1, Agama 3', 'Disetujui', '2022-06-20 11:39:58', 2, 'KHS_1502016200.pdf', 'KRS_1502016200.pdf', 'PersetujuanSkripsi_1502016200.pdf', 'ip6@gmail.com'),
('1502017110', 'Marzuki ali', 2017, 140, 4, '-', '-', 'Disetujui', '2022-05-13 11:40:01', 2, 'KHS_1502017110.pdf', 'KRS_1502017110.pdf', 'PersetujuanSkripsi_1502017110.pdf', 'ip4@gmail.com'),
('1502017787', 'Laras Puspita', 2017, 140, 4, '-', '-', 'Disetujui', '2022-06-22 20:05:05', 2, 'KHS_1502017787.pdf', 'KRS_1502017787.pdf', 'PersetujuanSkripsi_1502017787.pdf', 'ip5@gmail.com'),
('1502018025', 'Feriza Fajrin', 2018, 140, 4, '-', '-', 'Disetujui', '2022-07-19 06:42:45', 2, 'KHS_1502018025.pdf', 'KRS_1502018025.pdf', 'PersetujuanSkripsi_1502018025.pdf', 'ffajrin30@gmail.com'),
('1502018029', 'Firda Andriani', 2018, 140, 4, '-', '-', 'Disetujui', '2022-07-16 21:47:04', 2, 'KHS_1502018029.pdf', 'KRS_1502018029.pdf', 'PersetujuanSkripsi_1502018029.pdf', 'firdandriani07@gmail.com'),
('1502018044', 'Fadhlan Nurrachmad Joyokusumo Junior', 2018, 140, 4, 'skripsi', 'tidak ada', 'Disetujui', '2022-07-05 00:17:55', 2, 'KHS_1502018044.pdf', 'KRS_1502018044.pdf', 'PersetujuanSkripsi_1502018044.pdf', 'jjnfadhlan@gmail.com'),
('1502018049', 'Aam Samrotul Mahmudah', 2018, 138, 4, 'Skripsi', 'Tidak ada', 'Disetujui', '2022-07-03 23:07:06', 2, 'KHS_1502018049.pdf', 'KRS_1502018049.pdf', 'PersetujuanSkripsi_1502018049.pdf', 'aamsamrotul24@gmail.com'),
('1502018057', 'Dani Dharmawan', 2018, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 'danidarmawan94@gmail.com'),
('1502018062', 'Salsa Ajizah Yasmin', 2018, 138, 4, 'skripsi', '-', 'Disetujui', '2022-07-03 13:52:20', 2, 'KHS_1502018062.pdf', 'KRS_1502018062.pdf', 'PersetujuanSkripsi_1502018062.pdf', 'salsa.ay00@gmail.com'),
('1502018100', 'Dinda Fatma', 2018, 137, 4, 'Agama 1, Agama 2, Agama 3', '-', 'Disetujui', '2022-05-14 11:40:05', 2, 'KHS_1502018100.pdf', 'KRS_1502018100.pdf', 'PersetujuanSkripsi_1502018100.pdf', 'ip2@gmail.com'),
('1502018999', 'Indah Pratami', 2018, 140, 4, '-', '-', 'Disetujui', '2022-06-19 10:40:21', 2, 'KHS_1502018999.pdf', 'KRS_1502018999.pdf', 'PersetujuanSkripsi_1502018999.pdf', 'ip7@gmail.com');

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
(8, 'Sistem Informasi Skripsi', 'Sistem informasi terkait skripsi.', 'sistem informasi, skripsi, universitas yarsi', 'Makalah_1402018888.pdf', '1402018888', NULL, 4),
(10, 'Pengembangan Sistem Magang Berbasis Web', 'sistem magang khususnya untuk prodi ti', 'magang  teknik informatika', 'Makalah_1402018182.pdf', '1402018182', '2022-07-01 13:10:40', 4),
(11, 'OPTIMALISASI PEMBELAJARAN DARING SELEPAS PANDEMI COVID-19 MELALUI APLIKASI ANDROID&#13;&#10;(Studi kasus : SDS NURANI)&#13;&#10;', 'a.&#9;Bapak/Ibu A, selaku dosen pembimbing Ilmu dan Bapak/Ibu B, selaku dosen pembimbing Agama, yang telah menyediakan waktu, tenaga, dan pikiran untuk mengarahkan saya dalam penyusunan skripsi ini;', 'safjkasdhlashdasjk ssafsa sa dsa d asd as das dsa ', 'Makalah_1402018186.pdf', '1402018186', '2022-07-01 19:49:53', 1),
(12, 'Testing THESIS Website | Suryanom', 'Tester FINAL Makalah nih bang', 'Suryanom, Rehan, Anom, Nom', 'Makalah_1402018050.pdf', '1402018050', '2022-07-02 12:22:23', 3),
(13, 'ANALISIS SENTIMEN PROGRAM MERDEKA BELAJAR KAMPUS &#13;&#10;MERDEKA MENGGUNAKAN ALGOTIMA SUPPORT VECTOR &#13;&#10;MACHINE', 'tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes tes ', 'tes tes tes tes tes tes tes tes tes tes ', 'Makalah_1402018079.pdf', '1402018079', '2022-07-02 14:50:04', 2),
(14, 'APLIKASI PEMBELAJARAN PENGENALAN ANGKA DAN CARA MEMBEDAKAN NILAI ANGKA UNTUK ANAK ADHD (ATTENTION DEFICIT HIPERACTIVITY DISORDER) BERBASIS ANDROID .', 'Aplikasi untuk membantu anak anak berkebutuhan khusus adhd ddalam beljara membantu orang tua mereka ', 'ADHD (ATTENTION DEFICIT HIPERACTIVITY DISORDER)', 'Makalah_1402018210.pdf', '1402018210', '2022-07-02 15:47:59', 1),
(15, 'awokkawkoaweokdkofadsfokSDJ', 'SDJODSOJDOFSDOFDSADSKLFASLDFSADNLFLDSALFAS', 'ASKDFOASDFPOKASFIFSA', 'Makalah_1402018152.pdf', '1402018152', '2022-07-02 17:23:21', 1),
(16, 'Pembaruan Arsitektur Data pada Perusahaan Juan Gaming Secara Real-Time (Kafka) dan Batching (Airflow)', 'abstraknya ini!!!!!!!!!!!!!!!', 'Kafka Airflow Data Data Engineer', 'Makalah_1402018214.pdf', '1402018214', '2022-07-02 17:36:32', 2),
(17, 'APLIKASI PEMBELAJARAN ETIOLOGI, PATOFISIOLOGI DAN KONSERVASI NON KARIES BERBASIS ANDROID ', 'APLIKASI PEMBELAJARAN ETIOLOGI, PATOFISIOLOGI DAN KONSERVASI NON KARIES BERBASIS ANDROID ', 'gigi, abrasi, abfraksi, atrisi, erosi', 'Makalah_1402018153.pdf', '1402018153', '2022-07-02 21:01:57', 1),
(18, 'perancangan aplikasi pengenalan dan pembelajaran', 'semoga loremisup loremisup loremisup loremisup', 'loremisup loremisup loremisup', 'Makalah_1402018207.pdf', '1402018207', '2022-07-02 21:29:49', 1),
(19, 'PEMBUATAN SKRIPSI INI SANGAT MEMBUAT MAHASISWA PUSING', 'pusing pusing pusing pusing pusing', 'pusing pusing pusing', 'Makalah_1402018083.pdf', '1402018083', '2022-07-02 22:19:26', 1),
(20, 'Implementasi Deep Learning dalam Klasifikasi Limbah Menggunakan CNN berbasis Citra Digital', 'Implementasi Deep Learning dalam Klasifikasi Limbah Menggunakan CNN berbasis Citra Digital', 'klasifikasi sampah ,', 'Makalah_1402018160.pdf', '1402018160', '2022-07-02 23:42:19', 2),
(21, 'PENGARUH DESAIN INTERIOR UPT PERPUSTAKAAN UNIVERSITAS NEGERI JAKARTA TERHADAP MINAT KUNJUNGAN PEMUSTAKA', 'ini kenapa saya ip sendiri', 'desain interior;  perpustakaan', 'Makalah_1502018062.pdf', '1502018062', '2022-07-03 15:02:31', 8),
(22, 'Pengembangan Aplikasi Bahasa Isyarat berbasis Android', 'Aplikasi Bahasa isyarat merupakan pembelajaran bahasa isyarat bisindo untuk berkunikasi dengan teman tuli dengan mudah ', 'bahasa isyarat, bisindo, mdlc ', 'Makalah_1402018223.pdf', '1402018223', '2022-07-03 15:50:33', 1),
(23, 'KLASIFIKASI PADA DATA MINING UNTUK MENGETES ALGORITMA THESIS', 'Yuk di testing akan ada hadiah menarik dari bang kiki', 'Thesis ini sudah good', 'Makalah_1402018157.pdf', '1402018157', '2022-07-03 21:14:45', 2),
(24, 'KLASIFIKASI KOMENTAR CYBERBULLYING PADA MEDIA SOSIAL TWITTER MENGGUNAKAN DEEP LEARNING', 'Kalo orang lain bisa kenapa harus saya!', 'kunci ghoib yang harus dimiliki untuk bisa membuka dunia baru (Isekai)', 'Makalah_1402018193.pdf', '1402018193', '2022-07-03 21:25:04', 2),
(25, 'mari skripsi bersama', 'lalalolololalalololalalolo', 'lalalolololalalololalalolo', 'Makalah_1402018131.pdf', '1402018131', '2022-07-04 00:24:23', 1),
(26, 'Aplikasi Augmented Reality Bahasa Melayu', 'ini adalah aplikasi ajaib yang bisa keluar gambar dari kamera dan mengeluarkan bahasa melayu yang khas dari daerah minangkabau', 'aplikasi, minangkabau, bahasa melayu', 'Makalah_1402018073.pdf', '1402018073', '2022-07-04 09:44:18', 4),
(27, 'Pembuatan Skripsi Perpustakaan dan Sains Teknologi&#9;', 'deskripsi skripsi perpustakaan dan sains teknologi', 'kata kunci kata kunci', 'Makalah_1502018049.pdf', '1502018049', '2022-07-05 00:09:14', 6),
(28, 'PERANGKAT LUNAK OPEN SOURCE PERPUSTAKAAN DIGITAL : KOMPARASI GREENSTONE DAN GANESHA DIGITAL LIBRARY', 'terkait tentang perangkat lunak open source', 'open source, greenstone, ganesha', 'Makalah_1502018044.pdf', '1502018044', '2022-07-05 00:33:00', 6),
(29, 'Pengaruh Suasana Perpustakaan Terhadap Minat Baca Mahasiswa', 'Penelitian terkait perpusatakaan', 'perpustakaan, minat baca, mahasiswa', 'Makalah_1502018029.pdf', '1502018029', '2022-07-16 22:21:29', 6),
(30, 'Pengembangan SLIM pada Perpustakaan Unversitas Negeri Jakarta&#9;', 'Penelitian tentang perpusatakaan', 'SLIM, UNJ, Perpustakaan', 'Makalah_1502018025.pdf', '1502018025', '2022-07-19 07:14:28', 6);

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
(132, 24, 4, 'Pembimbing Ilmu 1'),
(133, 24, NULL, 'Pembimbing Ilmu 2'),
(134, 24, 4, 'Pembimbing Agama'),
(141, 12, 3, 'Pembimbing Ilmu 1'),
(142, 12, 3, 'Pembimbing Ilmu 2'),
(143, 12, 3, 'Pembimbing Agama'),
(156, 26, 3, 'Pembimbing Ilmu 1'),
(157, 26, NULL, 'Pembimbing Ilmu 2'),
(158, 26, 1, 'Pembimbing Agama'),
(159, 27, 1, 'Pembimbing Ilmu 1'),
(160, 27, NULL, 'Pembimbing Ilmu 2'),
(161, 27, 3, 'Pembimbing Agama'),
(162, 28, 3, 'Pembimbing Ilmu 1'),
(163, 28, NULL, 'Pembimbing Ilmu 2'),
(164, 28, 2, 'Pembimbing Agama'),
(165, 29, 3, 'Pembimbing Ilmu 1'),
(166, 29, NULL, 'Pembimbing Ilmu 2'),
(167, 29, 1, 'Pembimbing Agama'),
(168, 30, 1, 'Pembimbing Ilmu 1'),
(169, 30, NULL, 'Pembimbing Ilmu 2'),
(170, 30, 3, 'Pembimbing Agama'),
(171, 31, 1, 'Pembimbing Ilmu 1'),
(172, 31, NULL, 'Pembimbing Ilmu 2'),
(173, 31, 3, 'Pembimbing Agama'),
(174, 32, 3, 'Pembimbing Ilmu 1'),
(175, 32, NULL, 'Pembimbing Ilmu 2'),
(176, 32, 2, 'Pembimbing Agama'),
(177, 33, 1, 'Pembimbing Ilmu 1'),
(178, 33, NULL, 'Pembimbing Ilmu 2'),
(179, 33, 3, 'Pembimbing Agama'),
(180, 34, 1, 'Pembimbing Ilmu 1'),
(181, 34, NULL, 'Pembimbing Ilmu 2'),
(182, 34, 3, 'Pembimbing Agama'),
(183, 35, 1, 'Pembimbing Ilmu 1'),
(184, 35, NULL, 'Pembimbing Ilmu 2'),
(185, 35, 3, 'Pembimbing Agama'),
(186, 36, 1, 'Pembimbing Ilmu 1'),
(187, 36, NULL, 'Pembimbing Ilmu 2'),
(188, 36, 3, 'Pembimbing Agama'),
(189, 37, 1, 'Pembimbing Ilmu 1'),
(190, 37, NULL, 'Pembimbing Ilmu 2'),
(191, 37, 3, 'Pembimbing Agama'),
(195, 9, 4, 'Pembimbing Ilmu 1'),
(196, 9, 4, 'Pembimbing Ilmu 2'),
(197, 9, 4, 'Pembimbing Agama'),
(198, 38, 4, 'Pembimbing Ilmu 1'),
(199, 38, NULL, 'Pembimbing Ilmu 2'),
(200, 38, 4, 'Pembimbing Agama'),
(201, 40, 1, 'Pembimbing Ilmu 1'),
(202, 40, NULL, 'Pembimbing Ilmu 2'),
(203, 40, 3, 'Pembimbing Agama'),
(204, 42, 1, 'Pembimbing Ilmu 1'),
(205, 42, NULL, 'Pembimbing Ilmu 2'),
(206, 42, 3, 'Pembimbing Agama'),
(207, 43, 1, 'Pembimbing Ilmu 1'),
(208, 43, NULL, 'Pembimbing Ilmu 2'),
(209, 43, 3, 'Pembimbing Agama'),
(210, 44, 1, 'Pembimbing Ilmu 1'),
(211, 44, NULL, 'Pembimbing Ilmu 2'),
(212, 44, 3, 'Pembimbing Agama'),
(213, 45, 1, 'Pembimbing Ilmu 1'),
(214, 45, NULL, 'Pembimbing Ilmu 2'),
(215, 45, 3, 'Pembimbing Agama'),
(216, 46, 4, 'Pembimbing Ilmu 1'),
(217, 46, NULL, 'Pembimbing Ilmu 2'),
(218, 46, 4, 'Pembimbing Agama'),
(219, 47, 4, 'Pembimbing Ilmu 1'),
(220, 47, NULL, 'Pembimbing Ilmu 2'),
(221, 47, 4, 'Pembimbing Agama'),
(225, 48, 4, 'Pembimbing Ilmu 1'),
(226, 48, 4, 'Pembimbing Ilmu 2'),
(227, 48, 4, 'Pembimbing Agama'),
(228, 18, 12, 'Pembimbing Ilmu 1'),
(229, 18, NULL, 'Pembimbing Ilmu 2'),
(230, 18, 2, 'Pembimbing Agama'),
(231, 49, 4, 'Pembimbing Ilmu 1'),
(232, 49, NULL, 'Pembimbing Ilmu 2'),
(233, 49, 4, 'Pembimbing Agama'),
(234, 50, 4, 'Pembimbing Ilmu 1'),
(235, 50, NULL, 'Pembimbing Ilmu 2'),
(236, 50, 4, 'Pembimbing Agama');

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
(2, 'Sistem Informasi Skripsi Fakultas Teknologi Informasi Universitas YARSI', 'Penelitian ini berfokus pada pengembangan sistem informasi skripsi yang sebelumnya sudah pernah digunakan pada Program Studi Teknik Informatika. Target dari penelitian ini adalah untuk membuat sistem informasi skripsi yang dapat digunakan pada lingkup yang lebih luas yaitu Fakultas Teknologi Informasi.', 1, 4, 1, 'TERSEDIA'),
(3, 'Pengembangan Sistem Informasi Kepustakaan', 'Penelitian terkait sistem informasi perpustakaan', 4, 6, 5, 'TIDAK TERSEDIA');

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
(24, 24, 'Draft_1502018999_24.pdf', 'LembarPersetujuanPrasidang_1502018999_24.pdf', '2022-06-18 21:58:47', 'DISETUJUI'),
(26, 26, 'Draft_1402018182_26.pdf', 'LembarPersetujuanPrasidang_1402018182_26.pdf', '2022-07-01 10:07:36', 'DISETUJUI'),
(27, 27, 'Draft_1402018186_27.pdf', 'LembarPersetujuanPrasidang_1402018186_27.pdf', '2022-07-01 19:37:40', 'DISETUJUI'),
(28, 28, 'Draft_1402018050_28.pdf', 'LembarPersetujuanPrasidang_1402018050_28.pdf', '2022-07-02 12:16:35', 'DISETUJUI'),
(29, 29, 'Draft_1402018079_29.pdf', 'LembarPersetujuanPrasidang_1402018079_29.pdf', '2022-07-02 14:29:05', 'DISETUJUI'),
(30, 30, 'Draft_1402018210_30.pdf', 'LembarPersetujuanPrasidang_1402018210_30.pdf', '2022-07-02 15:37:29', 'DISETUJUI'),
(31, 31, 'Draft_1402018152_31.pdf', 'LembarPersetujuanPrasidang_1402018152_31.pdf', '2022-07-02 17:12:57', 'DISETUJUI'),
(32, 32, 'Draft_1402018214_32.pdf', 'LembarPersetujuanPrasidang_1402018214_32.pdf', '2022-07-02 17:21:46', 'DISETUJUI'),
(33, 33, 'Draft_1402018153_33.pdf', 'LembarPersetujuanPrasidang_1402018153_33.pdf', '2022-07-02 20:50:24', 'DISETUJUI'),
(34, 34, 'Draft_1402018207_34.pdf', 'LembarPersetujuanPrasidang_1402018207_34.pdf', '2022-07-02 21:16:27', 'DISETUJUI'),
(35, 35, 'Draft_1402018083_35.pdf', 'LembarPersetujuanPrasidang_1402018083_35.pdf', '2022-07-02 22:05:50', 'DISETUJUI'),
(36, 36, 'Draft_1402018179_36.pdf', 'LembarPersetujuanPrasidang_1402018179_36.pdf', '2022-07-02 22:21:55', 'DISETUJUI'),
(37, 37, 'Draft_1402018160_37.pdf', 'LembarPersetujuanPrasidang_1402018160_37.pdf', '2022-07-02 23:33:07', 'DISETUJUI'),
(38, 38, 'Draft_1502018062_38.pdf', 'LembarPersetujuanPrasidang_1502018062_38.pdf', '2022-07-03 14:39:19', 'DISETUJUI'),
(39, 40, 'Draft_1402018223_40.pdf', 'LembarPersetujuanPrasidang_1402018223_40.pdf', '2022-07-03 15:28:52', 'DISETUJUI'),
(40, 42, 'Draft_1402018157_42.pdf', 'LembarPersetujuanPrasidang_1402018157_42.pdf', '2022-07-03 21:00:24', 'DISETUJUI'),
(41, 43, 'Draft_1402018193_43.pdf', 'LembarPersetujuanPrasidang_1402018193_43.pdf', '2022-07-03 21:17:38', 'DISETUJUI'),
(42, 44, 'Draft_1402018131_44.pdf', 'LembarPersetujuanPrasidang_1402018131_44.pdf', '2022-07-03 23:43:59', 'DISETUJUI'),
(43, 45, 'Draft_1402018073_45.pdf', 'LembarPersetujuanPrasidang_1402018073_45.pdf', '2022-07-04 09:24:53', 'DISETUJUI'),
(44, 46, 'Draft_1502018049_46.pdf', 'LembarPersetujuanPrasidang_1502018049_46.pdf', '2022-07-05 00:04:12', 'DISETUJUI'),
(45, 47, 'Draft_1502018044_47.pdf', 'LembarPersetujuanPrasidang_1502018044_47.pdf', '2022-07-05 00:27:27', 'DISETUJUI'),
(46, 48, 'Draft_1502018029_48.pdf', 'LembarPersetujuanPrasidang_1502018029_48.pdf', '2022-07-16 22:05:32', 'DISETUJUI'),
(47, 49, 'Draft_1502018025_49.pdf', 'LembarPersetujuanPrasidang_1502018025_49.pdf', '2022-07-19 07:06:56', 'DISETUJUI');

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
(4, 15, 'Draft_Final_1402017300_15.pdf', 'Form_Bimbingan_1402017300_15.pdf', 'Persyaratan_Sidang_1402017300_15.pdf', '2022-05-28 20:58:40', 'DISETUJUI'),
(5, 18, 'Draft_Final_1402015666_18.pdf', 'Form_Bimbingan_1402015666_18.pdf', 'Persyaratan_Sidang_1402015666_18.pdf', '2022-06-04 23:47:04', 'DISETUJUI'),
(6, 19, 'Draft_Final_1402017777_19.pdf', 'Form_Bimbingan_1402017777_19.pdf', 'Persyaratan_Sidang_1402017777_19.pdf', '2022-06-05 22:59:47', 'DISETUJUI'),
(7, 20, 'Draft_Final_1402018666_20.pdf', 'Form_Bimbingan_1402018666_20.pdf', 'Persyaratan_Sidang_1402018666_20.pdf', '2022-06-07 15:14:14', 'DISETUJUI'),
(8, 21, 'Draft_Final_1402018999_21.pdf', 'Form_Bimbingan_1402018999_21.pdf', 'Persyaratan_Sidang_1402018999_21.pdf', '2022-06-15 08:14:43', 'DISETUJUI'),
(9, 22, 'Draft_Final_1402018888_22.pdf', 'Form_Bimbingan_1402018888_22.pdf', 'Persyaratan_Sidang_1402018888_22.pdf', '2022-06-15 11:07:25', 'DISETUJUI'),
(10, 23, 'Draft_Final_1402018111_23.pdf', 'Form_Bimbingan_1402018111_23.pdf', 'Persyaratan_Sidang_1402018111_23.pdf', '2022-06-15 15:55:49', 'DISETUJUI'),
(12, 14, 'Draft_Final_1502017110_14.pdf', 'Form_Bimbingan_1502017110_14.pdf', 'Persyaratan_Sidang_1502017110_14.pdf', '2022-06-18 22:15:37', 'DISETUJUI'),
(13, 9, 'Draft_Final_1502015199_9.pdf', 'Form_Bimbingan_1502015199_9.pdf', 'Persyaratan_Sidang_1502015199_9.pdf', '2022-06-18 22:16:05', 'DISETUJUI'),
(14, 24, 'Draft_Final_1502018999_24.pdf', 'Form_Bimbingan_1502018999_24.pdf', 'Persyaratan_Sidang_1502018999_24.pdf', '2022-06-22 21:37:22', 'DISETUJUI'),
(16, 26, 'Draft_Final_1402018182_26.pdf', 'Form_Bimbingan_1402018182_26.pdf', 'Persyaratan_Sidang_1402018182_26.pdf', '2022-07-01 10:23:38', 'DISETUJUI'),
(17, 27, 'Draft_Final_1402018186_27.pdf', 'Form_Bimbingan_1402018186_27.pdf', 'Persyaratan_Sidang_1402018186_27.pdf', '2022-07-01 19:45:50', 'DISETUJUI'),
(18, 28, 'Draft_Final_1402018050_28.pdf', 'Form_Bimbingan_1402018050_28.pdf', 'Persyaratan_Sidang_1402018050_28.pdf', '2022-07-02 12:18:32', 'DISETUJUI'),
(19, 29, 'Draft_Final_1402018079_29.pdf', 'Form_Bimbingan_1402018079_29.pdf', 'Persyaratan_Sidang_1402018079_29.pdf', '2022-07-02 14:33:25', 'DISETUJUI'),
(20, 30, 'Draft_Final_1402018210_30.pdf', 'Form_Bimbingan_1402018210_30.pdf', 'Persyaratan_Sidang_1402018210_30.pdf', '2022-07-02 15:40:06', 'DISETUJUI'),
(21, 31, 'Draft_Final_1402018152_31.pdf', 'Form_Bimbingan_1402018152_31.pdf', 'Persyaratan_Sidang_1402018152_31.pdf', '2022-07-02 17:16:18', 'DISETUJUI'),
(22, 32, 'Draft_Final_1402018214_32.pdf', 'Form_Bimbingan_1402018214_32.pdf', 'Persyaratan_Sidang_1402018214_32.pdf', '2022-07-02 17:31:03', 'DISETUJUI'),
(23, 33, 'Draft_Final_1402018153_33.pdf', 'Form_Bimbingan_1402018153_33.pdf', 'Persyaratan_Sidang_1402018153_33.pdf', '2022-07-02 20:54:46', 'DISETUJUI'),
(24, 34, 'Draft_Final_1402018207_34.pdf', 'Form_Bimbingan_1402018207_34.pdf', 'Persyaratan_Sidang_1402018207_34.pdf', '2022-07-02 21:19:49', 'DISETUJUI'),
(25, 35, 'Draft_Final_1402018083_35.pdf', 'Form_Bimbingan_1402018083_35.pdf', 'Persyaratan_Sidang_1402018083_35.pdf', '2022-07-02 22:10:04', 'DISETUJUI'),
(26, 37, 'Draft_Final_1402018160_37.pdf', 'Form_Bimbingan_1402018160_37.pdf', 'Persyaratan_Sidang_1402018160_37.pdf', '2022-07-02 23:35:57', 'DISETUJUI'),
(27, 38, 'Draft_Final_1502018062_38.pdf', 'Form_Bimbingan_1502018062_38.pdf', 'Persyaratan_Sidang_1502018062_38.pdf', '2022-07-03 14:57:24', 'DISETUJUI'),
(28, 40, 'Draft_Final_1402018223_40.pdf', 'Form_Bimbingan_1402018223_40.pdf', 'Persyaratan_Sidang_1402018223_40.pdf', '2022-07-03 15:40:53', 'DISETUJUI'),
(29, 42, 'Draft_Final_1402018157_42.pdf', 'Form_Bimbingan_1402018157_42.pdf', 'Persyaratan_Sidang_1402018157_42.pdf', '2022-07-03 21:08:30', 'DISETUJUI'),
(30, 43, 'Draft_Final_1402018193_43.pdf', 'Form_Bimbingan_1402018193_43.pdf', 'Persyaratan_Sidang_1402018193_43.pdf', '2022-07-03 21:20:03', 'DISETUJUI'),
(31, 44, 'Draft_Final_1402018131_44.pdf', 'Form_Bimbingan_1402018131_44.pdf', 'Persyaratan_Sidang_1402018131_44.pdf', '2022-07-04 00:16:02', 'DISETUJUI'),
(32, 45, 'Draft_Final_1402018073_45.pdf', 'Form_Bimbingan_1402018073_45.pdf', 'Persyaratan_Sidang_1402018073_45.pdf', '2022-07-04 09:28:36', 'DISETUJUI'),
(33, 46, 'Draft_Final_1502018049_46.pdf', 'Form_Bimbingan_1502018049_46.pdf', 'Persyaratan_Sidang_1502018049_46.pdf', '2022-07-05 00:06:44', 'DISETUJUI'),
(34, 47, 'Draft_Final_1502018044_47.pdf', 'Form_Bimbingan_1502018044_47.pdf', 'Persyaratan_Sidang_1502018044_47.pdf', '2022-07-05 00:29:20', 'DISETUJUI'),
(35, 48, 'Draft_Final_1502018029_48.pdf', 'Form_Bimbingan_1502018029_48.pdf', 'Persyaratan_Sidang_1502018029_48.pdf', '2022-07-16 22:15:45', 'DISETUJUI'),
(36, 49, 'Draft_Final_1502018025_49.pdf', 'Form_Bimbingan_1502018025_49.pdf', 'Persyaratan_Sidang_1502018025_49.pdf', '2022-07-19 07:10:21', 'DISETUJUI'),
(38, 50, 'Draft_Final_1502018100_50.pdf', 'Form_Bimbingan_1502018100_50.pdf', 'Persyaratan_Sidang_1502018100_50.pdf', '2022-07-21 12:48:16', 'DISETUJUI'),
(39, 10, 'Draft_Final_1402016314_10.pdf', 'Form_Bimbingan_1402016314_10.pdf', 'Persyaratan_Sidang_1402016314_10.pdf', '2022-07-21 13:02:20', 'DISETUJUI');

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
(19, 4, 25, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 3.8, 3, 3.84, 'A', 'LULUS'),
(21, 1, 20, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 'B', 'LULUS'),
(25, 2, 46, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(26, 3, 27, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(27, 1, 27, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(28, 3, 28, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(29, 1, 28, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(30, 1, 29, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(31, 3, 29, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(32, 2, 29, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(33, 2, 30, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(34, 3, 30, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(35, 1, 30, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(36, 2, 31, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(37, 1, 31, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(38, 3, 31, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(39, 2, 32, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(40, 1, 32, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(41, 3, 32, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(42, 1, 33, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(43, 2, 33, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(44, 3, 33, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(45, 2, 34, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(46, 1, 34, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(47, 3, 34, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(48, 2, 35, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(49, 3, 35, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(50, 1, 35, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(51, 1, 36, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(52, 2, 36, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(53, 3, 36, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(54, 2, 37, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(55, 3, 37, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(56, 1, 37, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(57, 4, 38, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(58, 2, 39, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(59, 1, 39, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(60, 3, 39, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(61, 2, 40, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(62, 3, 40, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(63, 1, 40, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(64, 2, 41, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(65, 3, 41, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(66, 1, 41, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(67, 2, 42, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(68, 3, 42, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(69, 1, 42, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(70, 2, 43, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(71, 3, 43, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(72, 1, 43, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(73, 4, 44, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(74, 4, 45, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(75, 4, 47, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(76, 4, 48, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS'),
(77, 1, 10, 2, 3, 3, 4, 4, 3, 4, 3, 2, 4, 3, 2, 3.08, 'B', 'LULUS'),
(81, 4, 46, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, '', 'TIDAK LULUS'),
(82, 2, 27, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'A', 'LULUS');

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
(27, 'PENGEMBANGAN SISTEM OTOMATISASI OPERASIONAL&#13;&#10;PUSAT BEKAM RUQYAH BEKASI MENGGUNAKAN&#13;&#10;ALGORITMA FIFO BERBASIS PROGRESSIVE WEB', 6, '1502016200', 'Baru', 'Dosen', 'Proposal_1502016200_03072022045405.pdf', '2022-07-03 16:54:05', 4, 4, 'DITERIMA', 'Sudah cukup baik, perbanyak literasi', 4),
(28, 'ANALISIS PERBANDINGAN KOMPUTASI PARALEL PADA\nSINGLE', 3, '1402017300', 'Lanjutan', 'Dosen', 'Proposal_1402017300_28052022023709.pdf', '2022-05-28 14:37:09', 2, 3, 'DITOLAK', 'Tidak mengumpulkan video seminar proposal', 3),
(29, 'Game Pengenalan Sampah 2D Berbasis Mobile', 1, '1402017300', 'Baru', 'Keluarga', 'Proposal_1402017300_28052022024053.pdf', '2022-05-28 14:40:53', 3, 1, 'REVISI', 'Hubungi AF', 1),
(31, 'SISTEM PREDIKSI KELULUSAN MAHASISWA PROGRAM\nSTUDI TEKNIK INFORMATIKA MENGGUNAKAN\nALGORITMA K – NEAREST NEIGHBOUR\n(STUDI KASUS: UNIVERSITAS YARSI)', 2, '1402015666', 'Baru', 'Dosen', 'Proposal_1402015666_31052022024415.pdf', '2022-05-31 14:44:15', 1, 1, 'DITERIMA', 'Perbanyak literasi', 1),
(32, 'ANALISIS CITRA RETONOPATY DIABETIC UNTUK\nMENDETEKSI TINGKAT KEBUTAAN MENGGUNAKAN\nMETODECONVOLUTIONAL NEURAL NETWORK (CNN).', 2, '1402017777', 'Baru', 'Dosen', 'Proposal_1402017777_05062022100750.pdf', '2022-06-05 22:07:57', 3, 1, 'DITOLAK', 'Tidak mencantumkan sitasi', 3),
(33, 'Perancangan Media Pembelajaran Sistem Gerak dan Gangguan\npada Sistem Gerak Manusia Berbasis Augmented Reality (Studi\nKasus : SMP Yappenda Jakarta Utara)', 2, '1402017777', 'Baru', 'Dosen', 'Proposal_1402017777_05062022101033.pdf', '2022-06-05 22:10:33', 1, 2, 'REVISI', 'Perbaiki lagi', 3),
(34, 'Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi Universitas YARSI', 4, '1402018666', 'Lanjutan', 'Dosen', 'Proposal_1402018666_07062022025957.pdf', '2022-06-07 14:59:57', 1, 3, 'DITERIMA', 'Sudah cukup baik, perbanyak literasi', 2),
(35, 'Sistem Informasi Skripsi (TheSIS) Fakultas Teknologi Informasi', 4, '1402018999', 'Lanjutan', 'Dosen', 'Proposal_1402018999_14062022194028.pdf', '2022-06-15 07:41:03', 1, 3, 'DITERIMA', 'Sudah cukup baik, Perbanyak literasi.', 2),
(36, 'Sistem Informasi Skripsi FTI Universitas YARSI', 4, '1402018888', 'Lanjutan', 'Dosen', 'Proposal_1402018888_14062022225659.pdf', '2022-06-15 10:56:59', 2, 3, 'REVISI', 'Perbanyak literasi.', 1),
(37, 'Sistem Informasi Skripsi Fakultas Teknologi Informasi Universitas YARSI', 4, '1402018111', 'Lanjutan', 'Dosen', 'Proposal_1402018111_26062022014924.pdf', '2022-06-26 13:49:24', 1, 2, 'DITERIMA', 'Perbanyak literasi', 1),
(38, 'Pengembangan Sistem Perpustakaan Daring', 7, '1502018999', 'Baru', 'Sendiri', 'Proposal_1502018999_18062022094554.pdf', '2022-06-18 21:45:54', 4, 4, 'DITERIMA', 'sudah cukup bagus', 4),
(40, 'Pengembangan sistem magang prodi teknik informatika berbasis web ', 4, '1402018182', 'Lanjutan', 'Dosen', 'Proposal_1402018182_30062022220047.pdf', '2022-07-01 10:00:47', 1, 3, 'DITERIMA', 'Sudah cukup bagus, perdalam lagi tujuan penelitiannya', 1),
(41, 'OPTIMALISASI PEMBELAJARAN DARING SELEPAS PANDEMI COVID-19 MELALUI APLIKASI ANDROID&#13;&#10;(Studi kasus : SDS NURANI)', 4, '1402018186', 'Baru', 'Sendiri', 'Proposal_1402018186_01072022073118.pdf', '2022-07-01 19:31:59', 3, 2, 'DITERIMA', 'Sudah bagus, perbanyak literasi', 1),
(42, 'Tester Tester Tester', 1, '1402018050', 'Baru', 'Dosen', 'Proposal_1402018050_02072022000526.pdf', '2022-07-02 12:05:26', 3, 2, 'DITERIMA', 'Sudah bagus, perbanyak literasi', 3),
(43, 'ANALISIS SENTIMEN PROGRAM MERDEKA BELAJAR KAMPUS &#13;&#10;MERDEKA MENGGUNAKAN ALGOTIMA SUPPORT VECTOR &#13;&#10;MACHINE', 2, '1402018079', 'Baru', 'Sendiri', 'Proposal_1402018079_02072022021215.pdf', '2022-07-02 14:12:15', 1, 2, 'DITERIMA', 'Sudah bagus, perbanyak literasi', 1),
(44, 'APLIKASI PEMBELAJARAN PENGENALAN ANGKA DAN CARA MEMBEDAKAN NILAI ANGKA UNTUK ANAK ADHD (ATTENTION DEFICIT HIPERACTIVITY DISORDER) BERBASIS ANDROID .', 1, '1402018210', 'Baru', 'Sendiri', 'Proposal_1402018210_02072022032013.pdf', '2022-07-02 15:20:13', 1, 2, 'DITERIMA', 'Sudah Bagus, Perbanyak literasi', 1),
(45, 'MEMBANGUN APLIKASI AUGMENTED REALITY &#13;&#10;“HEALTHYTEETH” SEBAGAI MEDIA EDUKASI KESEHATAN GIGI&#13;&#10;BAGI ANAK', 4, '1402018179', 'Baru', 'Sendiri', 'Proposal_1402018179_02072022041348.pdf', '2022-07-02 16:13:48', 1, 2, 'DITERIMA', 'Sudah bagus, perbanyak literasi', 3),
(46, 'oasofpdsjpkdfpasjlsamfkdmfk;ad', 3, '1402018152', 'Baru', 'Keluarga', 'Proposal_1402018152_02072022050127.pdf', '2022-07-02 17:01:27', 1, 2, 'DITERIMA', 'Sudah bagus, silahkan teruskan', 3),
(47, 'Pembaruan Arsitektur Data pada Perusahaan Juan Gaming Secara Real-Time dan Batching', 2, '1402018214', 'Baru', 'Sendiri', 'Proposal_1402018214_02072022051330.pdf', '2022-07-02 17:13:30', 3, 2, 'DITERIMA', 'Sudah bagus, perbanyak literasi', 2),
(48, 'APLIKASI PEMBELAJARAN ETIOLOGI, PATOFISIOLOGI DAN KONSERVASI NON KARIES BERBASIS ANDROID ', 1, '1402018153', 'Baru', 'Dosen', 'Proposal_1402018153_02072022084023.pdf', '2022-07-02 20:40:23', 1, 1, 'TERTUNDA', NULL, NULL),
(49, 'APLIKASI PEMBELAJARAN ETIOLOGI, PATOFISIOLOGI DAN KONSERVASI NON KARIES BERBASIS ANDROID ', 1, '1402018153', 'Baru', 'Dosen', 'Proposal_1402018153_02072022084024.pdf', '2022-07-02 20:40:24', 1, 1, 'DITERIMA', 'Sudah bagus, perbanyak literasi', 1),
(50, 'perancangan aplikasi pengenalan dan pembelajaran ', 1, '1402018207', 'Baru', 'Sendiri', 'Proposal_1402018207_02072022090018.pdf', '2022-07-02 21:00:18', 2, 1, 'DITERIMA', 'Sudah bagus', 3),
(51, 'PEMBUATAN SKRIPSI INI SANGAT MEMBUAT PUSING PARA MAHASISWA', 1, '1402018083', 'Baru', 'Sendiri', 'Proposal_1402018083_02072022095154.pdf', '2022-07-02 21:51:54', 2, 1, 'DITERIMA', 'Sudah bagus, perkuat tujuan penelitiannya', 3),
(52, 'Implementasi Deep Learning dalam Klasifikasi Limbah Menggunakan CNN berbasis Citra Digital', 2, '1402018160', 'Baru', 'Sendiri', 'Proposal_1402018160_02072022103421.pdf', '2022-07-02 23:04:33', 1, 3, 'DITERIMA', 'Sudah bagus, urgensinya ditingkatkan', 1),
(53, 'PENGARUH DESAIN INTERIOR UPT PERPUSTAKAAN UNIVERSITAS NEGERI JAKARTA TERHADAP MINAT KUNJUNGAN PEMUSTAKA', 8, '1502018062', 'Baru', 'Sendiri', 'Proposal_1502018062_03072022021332.pdf', '2022-07-03 14:13:32', 4, 4, 'DITERIMA', 'Sudah bagus, perbanyak literasi', 4),
(54, 'Pengembangan Aplikasi Bahasa Isyarat Berbasis Android', 1, '1402018223', 'Baru', 'Sendiri', 'Proposal_1402018223_03072022025232.pdf', '2022-07-03 14:52:32', 2, 3, 'DITERIMA', 'Sudah bagus, urgensinya terlihat jelas', 2),
(55, 'KLASIFIKASI PADA DATA MINING UNTUK MENGETES ALGORITMA THESIS', 2, '1402018157', 'Baru', 'Sendiri', 'Proposal_1402018157_03072022083515.pdf', '2022-07-03 20:35:15', 2, 3, 'DITERIMA', 'Sudah bagus, perbanyak literasi', 3),
(56, 'KLASIFIKASI KOMENTAR CYBERBULLYING PADA MEDIA SOSIAL TWITTER MENGGUNAKAN DEEP LEARNING', 2, '1402018193', 'Baru', 'Sendiri', 'Proposal_1402018193_03072022085746.pdf', '2022-07-03 20:57:46', 1, 2, 'DITERIMA', 'Sudah bagus, pertahankan', 2),
(57, 'Mari Membuat Skripsi Bersama', 1, '1402018131', 'Baru', 'Sendiri', 'Proposal_1402018131_03072022113125.pdf', '2022-07-03 23:31:25', 1, 3, 'DITERIMA', 'Sudah bagus, silahkan lanjutkan', 1),
(58, 'Perancangan Aplikasi Pembelajaran Aksara Lontara Suku Bugis', 4, '1402018073', 'Baru', 'Sendiri', 'Proposal_1402018073_03072022211146.pdf', '2022-07-04 09:11:46', 3, 1, 'DITERIMA', 'Sudah bagus, silahkan lanjutkan', 3),
(59, 'Pembuatan Skripsi Perpustakaan dan Sains Teknologi', 6, '1502018049', 'Baru', 'Teman', 'Proposal_1502018049_04072022115823.pdf', '2022-07-04 23:58:23', 4, 4, 'DITERIMA', 'Sudah bagus, lanjutkan penelitiannya', 4),
(60, 'PERANGKAT LUNAK OPEN SOURCE PERPUSTAKAAN DIGITAL : KOMPARASI GREENSTONE DAN GANESHA DIGITAL LIBRARY', 6, '1502018044', 'Baru', 'Dosen', 'Proposal_1502018044_04072022121911.pdf', '2022-07-05 00:19:11', 4, 4, 'DITERIMA', 'Sudah bagus, perbanyak literasi', 4),
(61, 'Pengaruh Suasana Perpustakaan Pada Minat Baca Mahasiswa ', 6, '1502018029', 'Baru', 'Sendiri', 'Proposal_1502018029_16072022094948.pdf', '2022-07-16 21:49:48', 4, 4, 'DITERIMA', 'Penelitian yang menari. Perdalam permasalahan.', 4),
(62, 'Pengembangan SLIM pada Perpustakaan Unversitas Negeri Jakarta', 6, '1502018025', 'Baru', 'Dosen', 'Proposal_1502018025_18072022184400.pdf', '2022-07-19 06:44:00', 4, 4, 'DITERIMA', 'Sudah bagus, perbanyak literasi', 4);

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
(43, 10, '2022-06-20 08:00:00', 'https://us02web.zoom.us/j/87138824537?pwd=RzNlV2U2Nis3d0FIOEZUbWhaV3JUZz09', 1, 'Perlu ada perbaikan pada beberapa fitur seperti fitur ....', 'LAYAK SIDANG', 'SEDANG'),
(45, 26, '2022-07-02 10:00:00', 'https://zoom.us', 3, 'Perlu ada perbaikan pada fitur ....', 'LAYAK SIDANG', 'TINGGI'),
(46, 27, '2022-06-30 13:00:00', 'Ruang Rapat', 3, 'perbaikan pada fitur ....', 'LAYAK SIDANG', 'SEDANG'),
(47, 28, '2022-07-02 10:00:00', 'Ruang Rapat', 1, 'Sudah Bagus, penelitiannya menarik', 'LAYAK SIDANG', 'TINGGI'),
(48, 29, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 'Model sudah terbuat dengan baik, perlu meningkatkan akurasi', 'LAYAK SIDANG', 'TINGGI'),
(49, 30, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 'Fiturnya sudah lengkap, sudah layak sidang', 'LAYAK SIDANG', 'TINGGI'),
(50, 31, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 'Lakukan split data, ulangi penelitian anda', 'LAYAK SIDANG', 'TINGGI'),
(51, 32, '2022-07-02 10:00:00', 'Ruang Rapat', 1, 'Belajar lagi ya', 'LAYAK SIDANG', 'TINGGI'),
(52, 33, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 'Perbaikan pada fitur ...', 'LAYAK SIDANG', 'TINGGI'),
(53, 34, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 'Sudah bagus, tambahkan fitur ...', 'LAYAK SIDANG', 'TINGGI'),
(54, 35, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 'Perbaikan pada fitur ...', 'LAYAK SIDANG', 'TINGGI'),
(55, 37, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 'Tingkatkan akurasi', 'LAYAK SIDANG', 'TINGGI'),
(56, 36, '2022-07-03 10:00:00', 'Ruang Rapat', 2, 'Sudah bagus, sudah layak sidang', 'LAYAK SIDANG', 'TINGGI'),
(57, 38, '2022-07-03 10:00:00', 'Ruang Rapat', 4, 'Sudah bagus, penambahan pada ...', 'LAYAK SIDANG', 'TINGGI'),
(58, 40, '2022-07-03 10:00:00', 'Ruang Rapat', 2, 'Sudah bagus, sempurnakan aplikasi', 'LAYAK SIDANG', 'TINGGI'),
(59, 42, '2022-07-03 10:00:00', 'Ruang Rapat', 2, 'sudah bagus, perbaiki fitur ...', 'LAYAK SIDANG', 'TINGGI'),
(60, 43, '2022-07-03 10:00:00', 'Ruang Rapat', 2, 'Sudah bagus, tingkatkan akurasi', 'LAYAK SIDANG', 'TINGGI'),
(61, 44, '2022-07-04 10:00:00', 'Ruang Rapat', 2, 'Sudah bagus, lanjutan', 'LAYAK SIDANG', 'TINGGI'),
(62, 45, '2022-07-04 10:00:00', 'Ruangan 504', 2, 'Sudah bagus, sempurnakan', 'LAYAK SIDANG', 'TINGGI'),
(63, 46, '2022-07-05 10:00:00', 'Ruang Rapat', 4, 'Perbaikan pada penulisan', 'LAYAK SIDANG', 'TINGGI'),
(64, 47, '2022-07-05 10:00:00', 'Ruang Rapat', 4, 'lanjutkan sidang', 'LAYAK SIDANG', 'TINGGI'),
(65, 48, '2022-07-17 13:00:00', 'Ruang Rapat', 4, 'Perbaikan pada ....', 'LAYAK SIDANG', 'TINGGI'),
(66, 49, '2022-07-20 15:00:00', 'Ruang Rapat', 4, 'Perlu ada perbaikan pada bagian ....', 'LAYAK SIDANG', 'TINGGI');

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
(71, 38, '2022-03-20 13:00:00', 'R Ruangan', NULL, 'https://google.com', 4, NULL),
(73, 40, '2022-07-01 10:01:59', NULL, 'https://www.youtube.com/', NULL, NULL, NULL),
(74, 41, '2022-07-01 19:32:58', NULL, 'https://sisakad.yarsi.ac.id/login.php?menu=krs_proses', NULL, NULL, NULL),
(75, 42, '2022-07-02 12:06:49', NULL, 'https://tester.com', NULL, NULL, NULL),
(76, 43, '2022-07-02 14:15:47', NULL, 'https://www.youtube.com/watch?v=5qap5aO4i9A', NULL, NULL, NULL),
(77, 44, '2022-07-02 15:21:49', NULL, 'https://sisakad.yarsi.ac.id/login.php?menu=krs_proses&_print=1', NULL, NULL, NULL),
(78, 45, '2022-07-02 16:17:08', NULL, 'https://drive.google.com/file/d/1pUYqAh6g_mdi6bUOLRrh43pCdG7GJDop/view?usp=sharing', NULL, NULL, NULL),
(79, 46, '2022-07-02 17:02:20', NULL, 'https://subscene.icu/', NULL, NULL, NULL),
(80, 47, '2022-07-02 17:14:02', NULL, 'https://kafka.apache.org/documentation/', NULL, NULL, NULL),
(81, 49, '2022-07-02 20:41:50', NULL, 'https://thesis-2022.host/Mahasiswa/seminarProposal', NULL, NULL, NULL),
(82, 50, '2022-07-02 21:01:22', NULL, 'https://thesis-2022.host/Mahasiswa/seminarProposal', NULL, NULL, NULL),
(83, 51, '2022-07-02 21:52:41', NULL, 'https://sisakad.yarsi.ac.id/login.php?menu=krs_sementara&action=detail&id=67063&_print=1', NULL, NULL, NULL),
(84, 52, '2022-07-02 22:36:10', NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', NULL, NULL, NULL),
(85, 53, '2022-07-03 10:00:00', NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 4, NULL),
(86, 54, '2022-07-03 14:57:35', NULL, 'https://drive.google.com/file/d/1pM-gV0jnUrXIHCPcgorH0X5upML9APS4/view?usp=sharing', NULL, NULL, NULL),
(87, 55, '2022-07-03 20:36:27', NULL, 'https://www.youtube.com/watch?v=_jQpQsnEOoA', NULL, NULL, NULL),
(88, 56, '2022-07-03 21:09:14', NULL, 'https://www.linkedin.com/in/juandanielhalomoan/', NULL, NULL, NULL),
(89, 57, '2022-07-03 23:32:45', NULL, 'https://forms.gle/e5dpMLmt1S2R3uXp6', NULL, NULL, NULL),
(90, 58, '2022-07-04 09:13:07', NULL, 'https://layar.yarsi.ac.id/course/view.php?id=11#section-6', NULL, NULL, NULL),
(91, 59, '2022-07-04 10:00:00', NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 4, NULL),
(92, 60, '2022-07-05 10:00:00', NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 4, NULL),
(93, 61, '2022-07-17 13:00:00', NULL, NULL, 'https://zoom.us', 4, NULL),
(94, 62, '2022-07-19 14:55:00', NULL, NULL, 'https://zoom.us', 4, 4);

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
(10, 10, '2022-06-03 10:00:00', 'Ruang Rapat', 3, 3.69333, 'A-', 'LULUS'),
(11, 15, '2022-06-02 11:00:00', 'Ruang R04', 1, 3.88, 'A', 'LULUS'),
(14, 19, '2022-06-10 10:00:00', 'Ruang Multimedia', 3, 3.33333, 'B+', 'LULUS'),
(15, 20, '2022-06-30 11:00:00', 'Ruang MDI', 2, 3.91333, 'A', 'LULUS'),
(16, 21, '2022-06-17 13:00:00', 'Ruang Multimedia', 1, 3.96667, 'A', 'LULUS'),
(17, 22, '2022-06-16 13:00:00', 'Ruang 504', 3, 3.25, 'B+', 'LULUS'),
(18, 23, '2022-06-17 13:00:00', 'Ruang 504', 2, NULL, NULL, NULL),
(20, 18, '2022-06-20 13:00:00', 'https://us02web.zoom.us/j/87138824537?pwd=RzNlV2U2Nis3d0FIOEZUbWhaV3JUZz09', 1, NULL, NULL, NULL),
(21, 9, '2022-07-22 13:00:00', 'R 504', 4, NULL, NULL, NULL),
(25, 24, '2022-07-22 13:02:00', 'R 506', 4, 3.84, 'A', 'LULUS'),
(27, 26, '2022-07-05 14:00:00', 'Ruang 504', 2, 4, 'A', 'LULUS'),
(28, 27, '2022-07-01 10:00:00', 'Ruang 504', 3, 4, 'A', 'LULUS'),
(29, 28, '2022-07-02 10:00:00', 'Ruang Rapat', 1, 4, 'A', 'LULUS'),
(30, 29, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(31, 30, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(32, 31, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(33, 32, '2022-07-02 10:00:00', 'Ruang Rapat', 1, 4, 'A', 'LULUS'),
(34, 33, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(35, 34, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(36, 35, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(37, 37, '2022-07-02 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(38, 38, '2022-07-03 10:00:00', 'Ruang Rapat', 4, 4, 'A', 'LULUS'),
(39, 40, '2022-07-03 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(40, 42, '2022-07-03 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(41, 43, '2022-07-03 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(42, 44, '2022-07-04 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(43, 45, '2022-07-04 10:00:00', 'Ruang Rapat', 2, 4, 'A', 'LULUS'),
(44, 46, '2022-07-05 10:00:00', 'Ruang Rapat', 4, 4, 'A', 'LULUS'),
(45, 47, '2022-07-05 10:00:00', 'Ruang Rapat', 4, 4, 'A', 'LULUS'),
(46, 14, '2022-07-05 10:00:00', 'Ruang Rapat', 4, 2, '', 'TIDAK LULUS'),
(47, 48, '2022-07-23 13:00:00', 'Ruang MDI', 4, 4, 'A', 'LULUS'),
(48, 49, '2022-07-26 14:00:00', 'Ruang Rapat', 4, 4, 'A', 'LULUS');

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
(10, 'SISTEM PREDIKSI KELULUSAN MAHASISWA PROGRAM STUDI TEKNIK INFORMATIKA MENGGUNAKAN ALGORITMA K–NEAREST NEIGHBOUR (STUDI KASUS: UNIVERSITAS YARSI)', 'Dosen', 'Lanjutan', '1402016314', 2, '2022-05-13 09:28:09', '2022-06-30 20:04:28', '', 'Lulus'),
(11, 'PEMILIHAN METODE DAN ALGORITMA DALAM ANALISIS SENTIMEN TERHADAP PENYEDIA LAYANAN SELULER PADA TWITTER MENGGUNAKAN DEEP', 'Dosen', 'Baru', '1402018189', 2, '2022-05-14 01:15:39', NULL, '', 'Dalam Pengerjaan'),
(12, 'Perancangan Media Pembelajaran Sistem Gerak dan Gangguan\npada Sistem Gerak Manusia Berbasis Augmented Reality (Studi\nKasus : SMP Yappenda Jakarta Utara)', 'Teman', 'Baru', '1402017188', 1, '2022-05-14 10:50:18', NULL, '', 'Dalam Pengerjaan'),
(14, 'Pengembangan Sistem Magang FTI Universitas YARSI Berbasis\nWeb', 'Sendiri', 'Baru', '1502017110', 6, '2022-05-23 20:23:53', NULL, '', 'Tidak Lulus'),
(15, 'APLIKASI PENGENALAN DAN PEMBELAJARAN METAMORFOSIS PADA HEWAN MENGGUNAKAN TEKNOLOGI AUGMENTED REALITY BERBASIS ANDROID', 'Dosen', 'Baru', '1402017300', 1, '2022-05-28 14:44:29', NULL, NULL, 'Lulus'),
(18, 'Game Pengenalan Sampah 2D Berbasis Mobile', 'Sendiri', 'Baru', '1402015666', 1, '2022-06-04 23:32:19', NULL, '', 'Dalam Pengerjaan'),
(19, 'KLASIFIKASI PHISHING PADA SITUS WEBSITE\nMENGGUNAKAN ALGORITMA CATBOOST', 'Teman', 'Baru', '1402017777', 2, '2022-06-05 22:13:14', '2022-06-22 20:29:17', 'Skripsi_1402017777_19.pdf', 'Lulus'),
(20, 'Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi Universitas YARSI', 'Dosen', 'Lanjutan', '1402018666', 4, '2022-06-07 15:04:08', '2022-06-22 20:52:49', 'Skripsi_1402018666_20.pdf', 'Lulus'),
(21, 'Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi Universitas YARSI', 'Dosen', 'Lanjutan', '1402018999', 4, '2022-06-15 07:44:42', '2022-06-22 20:34:50', 'Skripsi_1402018999_21.pdf', 'Lulus'),
(22, 'Sistem Informasi Skripsi FTI Universitas YARSI', 'Dosen', 'Lanjutan', '1402018888', 4, '2022-06-15 10:59:44', '2022-06-26 20:20:23', 'Skripsi_1402018888_22.pdf', 'Lulus'),
(23, 'Sistem Informasi Skripsi Universitas YARSI', 'Dosen', 'Lanjutan', '1402018111', 4, '2022-06-15 15:38:00', NULL, NULL, 'Dalam Pengerjaan'),
(24, 'Pengembangan Sistem Perpustakaan Daring', 'Sendiri', 'Baru', '1502018999', 7, '2022-06-18 21:56:22', NULL, '', 'Lulus'),
(26, 'Pengembangan Sistem Magang Berbasis Web', 'Dosen', 'Lanjutan', '1402018182', 4, '2022-07-01 10:03:54', '2022-07-01 13:08:55', 'Skripsi_1402018182_26.pdf', 'Lulus'),
(27, 'OPTIMALISASI PEMBELAJARAN DARING SELEPAS PANDEMI COVID-19 MELALUI APLIKASI ANDROID&#13;&#10;(Studi kasus : SDS NURANI)', 'Sendiri', 'Baru', '1402018186', 4, '2022-07-01 19:34:53', '2022-07-01 19:49:22', 'Skripsi_1402018186_27.pdf', 'Lulus'),
(28, 'Tester nih boy suryanom', 'Dosen', 'Baru', '1402018050', 3, '2022-07-02 12:08:50', '2022-07-02 12:21:37', 'Skripsi_1402018050_28.pdf', 'Lulus'),
(29, 'ANALISIS SENTIMEN PROGRAM MERDEKA BELAJAR KAMPUS &#13;&#10;MERDEKA MENGGUNAKAN ALGOTIMA SUPPORT VECTOR &#13;&#10;MACHINE', 'Sendiri', 'Baru', '1402018079', 2, '2022-07-02 14:18:53', '2022-07-02 14:49:08', 'Skripsi_1402018079_29.pdf', 'Lulus'),
(30, 'APLIKASI PEMBELAJARAN PENGENALAN ANGKA DAN CARA MEMBEDAKAN NILAI ANGKA UNTUK ANAK ADHD (ATTENTION DEFICIT HIPERACTIVITY DISORDER) BERBASIS ANDROID .', 'Sendiri', 'Baru', '1402018210', 1, '2022-07-02 15:25:21', '2022-07-02 15:46:13', 'Skripsi_1402018210_30.pdf', 'Lulus'),
(31, 'dgfdgsdfdsfgdsfgdfsgdsfgdfs', 'Sendiri', 'Lanjutan', '1402018152', 1, '2022-07-02 17:04:34', '2022-07-02 17:22:21', 'Skripsi_1402018152_31.pdf', 'Lulus'),
(32, 'Pembaruan Arsitektur Data pada Perusahaan Juan Gaming Secara Real-Time dan Batching&#9;', 'Sendiri', 'Baru', '1402018214', 2, '2022-07-02 17:17:01', '2022-07-02 17:34:41', 'Skripsi_1402018214_32.pdf', 'Lulus'),
(33, 'APLIKASI PEMBELAJARAN ETIOLOGI, PATOFISIOLOGI DAN KONSERVASI NON KARIES BERBASIS ANDROID ', 'Dosen', 'Baru', '1402018153', 1, '2022-07-02 20:44:03', '2022-07-02 21:01:14', 'Skripsi_1402018153_33.pdf', 'Lulus'),
(34, 'perancangan aplikasi pengenalan dan pembelajaran', 'Sendiri', 'Baru', '1402018207', 1, '2022-07-02 21:04:48', '2022-07-02 21:27:06', 'Skripsi_1402018207_34.pdf', 'Lulus'),
(35, 'PEMBUATAN SKRIPSI INI SANGAT MEMBUAT MAHASISWA PUSING', 'Sendiri', 'Baru', '1402018083', 1, '2022-07-02 21:56:05', '2022-07-02 22:17:55', 'Skripsi_1402018083_35.pdf', 'Lulus'),
(36, 'MEMBANGUN APLIKASI AUGMENTED REALITY &#13;&#10;“HEALTHYTEETH” SEBAGAI MEDIA EDUKASI KESEHATAN GIGI&#13;&#10;BAGI ANAK', 'Sendiri', 'Baru', '1402018179', 4, '2022-07-02 22:08:06', NULL, NULL, 'Dalam Pengerjaan'),
(37, 'Implementasi Deep Learning dalam Klasifikasi Limbah Menggunakan CNN berbasis Citra Digital', 'Sendiri', 'Baru', '1402018160', 2, '2022-07-02 23:24:06', '2022-07-02 23:40:11', 'Skripsi_1402018160_37.pdf', 'Lulus'),
(38, 'PENGARUH DESAIN INTERIOR UPT PERPUSTAKAAN UNIVERSITAS NEGERI JAKARTA TERHADAP MINAT KUNJUNGAN PEMUSTAKA', 'Sendiri', 'Baru', '1502018062', 8, '2022-07-03 14:23:21', '2022-07-03 15:01:09', 'Skripsi_1502018062_38.pdf', 'Lulus'),
(40, 'Pengembangan Aplikasi Bahasa Isyarat Berbasis Android', 'Sendiri', 'Baru', '1402018223', 1, '2022-07-03 15:01:48', '2022-07-03 15:47:43', 'Skripsi_1402018223_40.pdf', 'Lulus'),
(42, 'KLASIFIKASI PADA DATA MINING UNTUK MENGETES ALGORITMA THESIS', 'Dosen', 'Lanjutan', '1402018157', 2, '2022-07-03 20:38:43', '2022-07-03 21:12:18', 'Skripsi_1402018157_42.pdf', 'Lulus'),
(43, 'KLASIFIKASI KOMENTAR CYBERBULLYING PADA MEDIA SOSIAL TWITTER MENGGUNAKAN DEEP LEARNING', 'Sendiri', 'Baru', '1402018193', 2, '2022-07-03 21:10:58', '2022-07-03 21:22:31', 'Skripsi_1402018193_43.pdf', 'Lulus'),
(44, 'Mari Membuat Skripsi Bersama', 'Sendiri', 'Baru', '1402018131', 1, '2022-07-03 23:35:17', '2022-07-04 00:22:31', 'Skripsi_1402018131_44.pdf', 'Lulus'),
(45, 'Perancangan Aplikasi Augmented Reality Bahasa Melayu', 'Sendiri', 'Baru', '1402018073', 4, '2022-07-04 09:16:02', '2022-07-04 09:42:32', 'Skripsi_1402018073_45.pdf', 'Lulus'),
(46, 'Pembuatan Skripsi Perpustakaan dan Sains Teknologi&#9;', 'Teman', 'Baru', '1502018049', 5, '2022-07-05 00:00:24', '2022-07-05 00:08:23', 'Skripsi_1502018049_46.pdf', 'Lulus'),
(47, 'PERANGKAT LUNAK OPEN SOURCE PERPUSTAKAAN DIGITAL : KOMPARASI GREENSTONE DAN GANESHA DIGITAL LIBRARY', 'Teman', 'Baru', '1502018044', 6, '2022-07-05 00:22:22', '2022-07-05 00:31:30', 'Skripsi_1502018044_47.pdf', 'Lulus'),
(48, 'Pengaruh Suasana Perpustakaan Pada Minat Baca Mahasiswa', 'Sendiri', 'Baru', '1502018029', 6, '2022-07-16 21:57:13', '2022-07-16 22:20:19', 'Skripsi_1502018029_48.pdf', 'Lulus'),
(49, 'Pengembangan SLIM pada Perpustakaan Unversitas Negeri Jakarta&#9;', 'Dosen', 'Baru', '1502018025', 6, '2022-07-19 06:58:52', '2022-07-19 07:13:27', 'Skripsi_1502018025_49.pdf', 'Lulus'),
(50, 'Skripsi yang menarik', 'Sendiri', 'Baru', '1502018100', 6, '2022-07-21 12:30:09', '2022-07-21 12:30:42', NULL, 'Dalam Pengerjaan');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `catatan_bimbingan`
--
ALTER TABLE `catatan_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `penelitian_dosen`
--
ALTER TABLE `penelitian_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengajuan_prasidang`
--
ALTER TABLE `pengajuan_prasidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pengajuan_sidang`
--
ALTER TABLE `pengajuan_sidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `penilaian_sidang`
--
ALTER TABLE `penilaian_sidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seminar_prasidang`
--
ALTER TABLE `seminar_prasidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `seminar_proposal`
--
ALTER TABLE `seminar_proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `sidang_skripsi`
--
ALTER TABLE `sidang_skripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `skripsi`
--
ALTER TABLE `skripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sumber_daya`
--
ALTER TABLE `sumber_daya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
