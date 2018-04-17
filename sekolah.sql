-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2018 at 06:00 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `password`) VALUES
(12, '123', 'Ojaqhdad1'),
(13, '123', 'Ojaqhdad1'),
(14, 'hehehe', 'hehehe'),
(15, '123', 'Ojaqhdad1'),
(16, '123', 'Ojaqhdad1'),
(17, 'fadsf', 'fdasfdas'),
(18, 'fsadfdsa', 'fdasfas'),
(19, 'fdasfs', 'fdasfs'),
(20, '123', 'Ojaqhdad1'),
(21, 'fdasdas', 'fdas'),
(22, 'kjklk', 'hjlk'),
(23, 'hljk', 'jll'),
(24, 'jl;kl', 'l;lj'),
(25, 'hehe hehe', 'lfadskfajds');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_ujian`
--

CREATE TABLE `jadwal_ujian` (
  `id` int(11) NOT NULL,
  `id_soal_ujian` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_soal_ujian_detail`
--

CREATE TABLE `jawaban_soal_ujian_detail` (
  `id` int(11) NOT NULL,
  `id_soal_ujian_detail` int(11) NOT NULL,
  `id_murid` int(11) NOT NULL,
  `jawaban_tulisan` varchar(1000) NOT NULL,
  `jawaban_gambar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_soal_ujian_detail`
--

CREATE TABLE `jenis_soal_ujian_detail` (
  `id` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_soal_ujian_detail`
--

INSERT INTO `jenis_soal_ujian_detail` (`id`, `nama`) VALUES
(1, 'pilihan ganda');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `id_tahun_ajaran`) VALUES
(1, 'aaaa', 2),
(2, 'aa', 3),
(3, 'b', 4),
(4, 'c', 2),
(5, '222', 9);

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `id_kelas`, `id_guru`, `nama`) VALUES
(1, 3, 12, 'fadsfasdfda'),
(2, 3, 14, 'lkfkakd'),
(3, 1, 13, 'aalalla'),
(4, 5, 19, 'fdasass');

-- --------------------------------------------------------

--
-- Table structure for table `materi_pelajaran`
--

CREATE TABLE `materi_pelajaran` (
  `id` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `gambar` varchar(500) NOT NULL,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`id`, `id_kelas`, `nama`, `password`) VALUES
(1, 2, 'fadsfdsa', 'fadsfad'),
(2, 3, '123', 'Ojaqhdad1'),
(4, 3, '123', 'Ojaqhdad1');

-- --------------------------------------------------------

--
-- Table structure for table `pr`
--

CREATE TABLE `pr` (
  `id` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `gambar` varchar(500) NOT NULL,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soal_ujian`
--

CREATE TABLE `soal_ujian` (
  `id` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal_ujian`
--

INSERT INTO `soal_ujian` (`id`, `id_mata_pelajaran`, `id_guru`, `nama`) VALUES
(1, 3, 15, 'ulangan harian');

-- --------------------------------------------------------

--
-- Table structure for table `soal_ujian_detail`
--

CREATE TABLE `soal_ujian_detail` (
  `id` int(11) NOT NULL,
  `id_soal_ujian` int(11) NOT NULL,
  `id_jenis_soal_ujian_detail` int(11) NOT NULL,
  `soal_tulisan` varchar(1000) NOT NULL,
  `soal_gambar` varchar(5000) NOT NULL,
  `pilihan_jawaban_tulisan` varchar(1000) NOT NULL,
  `pilihan_jawaban_gambar` varchar(5000) NOT NULL,
  `kunci_jawaban` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal_ujian_detail`
--

INSERT INTO `soal_ujian_detail` (`id`, `id_soal_ujian`, `id_jenis_soal_ujian_detail`, `soal_tulisan`, `soal_gambar`, `pilihan_jawaban_tulisan`, `pilihan_jawaban_gambar`, `kunci_jawaban`) VALUES
(3, 1, 1, 'aaaaaaaa bbbbbbbbbbbbbbb ccccccccccc', '[\"0cf0197eeecb34456c88c2851e304bcf.png\",\"1aab48ebc090c64a3c273650e38ba7e8.png\",\"91f0f574ef6c64d2f4b399bd9b6226ee.png\"]', '[\"aaaaaa aaaaaaaaaaa\",\"bbbbbbb bbbbbbbbb\",\"ccccccc ccccccccccccc\",\"ddddddd dddddddddddd\",\"ee eeeeeeeeeeeeee\"]', '[[\"963719753afe77ce6a1739119c765061.png\",\"cb8bb41b6dc6f0427a7ca77b8eaaa3f4.png\",\"fc6c60ca9d2a58b49a8843f8a7d7a2be.png\"],[\"91823da4e9aa129650259f2a36e6d5fe.png\",\"865ba747f335f852b5dca52521060ce9.png\",\"9ea1174a5a21d9408394053d6e363812.png\"],[\"87c340403ce512275ded6169374fac14.png\",\"9154efaace8aa9374362da209730c929.png\",\"e02e55f4e43083329bf2970455b8dc08.png\"],[\"e7e428aeb96184eee93a6d4c2499e72a.png\",\"3729d5c10069bad0d9e98f79cfeff274.png\",\"d70b1a98d98dcda2ee3a64f78556641a.png\"],[\"4901c544d34619f606c5629c48222c66.png\",\"d4bb7aeac70cd67e0faa056597327bfd.png\",\"fc33e302251856abe3779b31997e1654.png\"]]', 'fka;ksl fjkdasl;kfklads;fjads;kflads;lfjla');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(11) NOT NULL,
  `tahun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun`) VALUES
(2, '2017/2018'),
(3, '2000/2001'),
(4, '2001/2002'),
(5, '2002/2003'),
(6, '2003/2004'),
(7, '2004/2005'),
(8, '2005/2006'),
(9, '2006/2007'),
(10, '2007/2008'),
(11, '2008/2009'),
(12, '2011/2012');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jawaban_soal_ujian_detail`
--
ALTER TABLE `jawaban_soal_ujian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_soal_ujian_detail`
--
ALTER TABLE `jenis_soal_ujian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi_pelajaran`
--
ALTER TABLE `materi_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr`
--
ALTER TABLE `pr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soal_ujian`
--
ALTER TABLE `soal_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soal_ujian_detail`
--
ALTER TABLE `soal_ujian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawaban_soal_ujian_detail`
--
ALTER TABLE `jawaban_soal_ujian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_soal_ujian_detail`
--
ALTER TABLE `jenis_soal_ujian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `materi_pelajaran`
--
ALTER TABLE `materi_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `murid`
--
ALTER TABLE `murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pr`
--
ALTER TABLE `pr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal_ujian`
--
ALTER TABLE `soal_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `soal_ujian_detail`
--
ALTER TABLE `soal_ujian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
