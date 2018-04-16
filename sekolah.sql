-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Apr 2018 pada 08.11
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

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
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
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
(24, 'jl;kl', 'l;lj');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_ujian`
--

CREATE TABLE `jadwal_ujian` (
  `id` int(11) NOT NULL,
  `id_soal_ujian` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_soal_ujian_detail`
--

CREATE TABLE `jawaban_soal_ujian_detail` (
  `id_jawaban_soal_ujian_detail` int(11) NOT NULL,
  `id_soal_ujian_detail` int(11) NOT NULL,
  `id_murid` int(11) NOT NULL,
  `jawaban_tulisan` varchar(1000) NOT NULL,
  `jawaban_gambar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_soal_ujian_detail`
--

CREATE TABLE `jenis_soal_ujian_detail` (
  `id` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `id_tahun_ajaran`) VALUES
(1, 'aaaa', 2),
(2, 'aa', 3),
(3, 'b', 4),
(4, 'c', 2),
(5, '222', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `id_kelas`, `id_guru`, `nama`) VALUES
(1, 3, 12, 'fadsfasdfda'),
(2, 3, 14, 'lkfkakd'),
(3, 1, 13, 'aalalla'),
(4, 5, 19, 'fdasass');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi_pelajaran`
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
-- Struktur dari tabel `murid`
--

CREATE TABLE `murid` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `murid`
--

INSERT INTO `murid` (`id`, `id_kelas`, `nama`, `password`) VALUES
(1, 2, 'fadsfdsa', 'fadsfad'),
(2, 3, '123', 'Ojaqhdad1'),
(4, 3, '123', 'Ojaqhdad1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pr`
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
-- Struktur dari tabel `soal_ujian`
--

CREATE TABLE `soal_ujian` (
  `id` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_ujian_detail`
--

CREATE TABLE `soal_ujian_detail` (
  `id_soal_ujian` int(11) NOT NULL,
  `id_soal_ujian_detail` int(11) NOT NULL,
  `soal_tulisan` varchar(1000) NOT NULL,
  `soal_gambar` varchar(500) NOT NULL,
  `pilihan_jawaban_tulisan` varchar(1000) NOT NULL,
  `pilihan_jawaban_gambar` varchar(500) NOT NULL,
  `kunci_jawaban` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(11) NOT NULL,
  `tahun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tahun_ajaran`
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
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jawaban_soal_ujian_detail`
--
ALTER TABLE `jawaban_soal_ujian_detail`
  ADD PRIMARY KEY (`id_jawaban_soal_ujian_detail`);

--
-- Indeks untuk tabel `jenis_soal_ujian_detail`
--
ALTER TABLE `jenis_soal_ujian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materi_pelajaran`
--
ALTER TABLE `materi_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pr`
--
ALTER TABLE `pr`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `soal_ujian`
--
ALTER TABLE `soal_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `soal_ujian_detail`
--
ALTER TABLE `soal_ujian_detail`
  ADD PRIMARY KEY (`id_soal_ujian_detail`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawaban_soal_ujian_detail`
--
ALTER TABLE `jawaban_soal_ujian_detail`
  MODIFY `id_jawaban_soal_ujian_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_soal_ujian_detail`
--
ALTER TABLE `jenis_soal_ujian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `materi_pelajaran`
--
ALTER TABLE `materi_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `murid`
--
ALTER TABLE `murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pr`
--
ALTER TABLE `pr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `soal_ujian`
--
ALTER TABLE `soal_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `soal_ujian_detail`
--
ALTER TABLE `soal_ujian_detail`
  MODIFY `id_soal_ujian_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
