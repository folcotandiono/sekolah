-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Bulan Mei 2018 pada 11.46
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
  `password` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nama`, `password`, `no_telepon`) VALUES
(1, 'meme', 'meme', '13412');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_ujian`
--

CREATE TABLE `jadwal_ujian` (
  `id` int(11) NOT NULL,
  `id_soal_ujian` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama` varchar(500) NOT NULL,
  `durasi` int(11) NOT NULL COMMENT 'menit'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_ujian`
--

INSERT INTO `jadwal_ujian` (`id`, `id_soal_ujian`, `tanggal`, `nama`, `durasi`) VALUES
(1, 1, '2018-05-03 07:40:00', 'asfasfas', 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_soal_ujian_detail`
--

CREATE TABLE `jawaban_soal_ujian_detail` (
  `id` int(11) NOT NULL,
  `id_soal_ujian_detail` int(11) NOT NULL,
  `id_murid` int(11) NOT NULL,
  `id_jadwal_ujian` int(11) NOT NULL,
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

--
-- Dumping data untuk tabel `jenis_soal_ujian_detail`
--

INSERT INTO `jenis_soal_ujian_detail` (`id`, `nama`) VALUES
(1, 'pilihan');

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
(1, 'xii ia 4', 1);

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
(1, 1, 1, 'biologi');

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

--
-- Dumping data untuk tabel `materi_pelajaran`
--

INSERT INTO `materi_pelajaran` (`id`, `id_mata_pelajaran`, `deskripsi`, `gambar`, `nama`) VALUES
(1, 1, 'asfdadsfa', '[]', 'fadfasd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `murid`
--

CREATE TABLE `murid` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `murid`
--

INSERT INTO `murid` (`id`, `id_kelas`, `nama`, `password`, `nama_ayah`, `nama_ibu`, `no_telepon`) VALUES
(1, 1, 'folco', 'folco', 'haha', 'hehe', '13324132');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pr`
--

CREATE TABLE `pr` (
  `id` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `gambar` varchar(5000) NOT NULL,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pr`
--

INSERT INTO `pr` (`id`, `id_mata_pelajaran`, `deskripsi`, `gambar`, `nama`) VALUES
(1, 1, 'fdsfas', '[]', 'fdasfasd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_ujian`
--

CREATE TABLE `soal_ujian` (
  `id` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal_ujian`
--

INSERT INTO `soal_ujian` (`id`, `id_mata_pelajaran`, `nama`) VALUES
(1, 1, 'soal ujian biologi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_ujian_detail`
--

CREATE TABLE `soal_ujian_detail` (
  `id` int(11) NOT NULL,
  `id_soal_ujian` int(11) NOT NULL,
  `id_jenis_soal_ujian_detail` int(11) NOT NULL,
  `soal_tulisan` varchar(1000) NOT NULL,
  `soal_gambar` varchar(30000) NOT NULL,
  `pilihan_jawaban_tulisan` varchar(1000) NOT NULL,
  `pilihan_jawaban_gambar` varchar(30000) NOT NULL,
  `kunci_jawaban` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal_ujian_detail`
--

INSERT INTO `soal_ujian_detail` (`id`, `id_soal_ujian`, `id_jenis_soal_ujian_detail`, `soal_tulisan`, `soal_gambar`, `pilihan_jawaban_tulisan`, `pilihan_jawaban_gambar`, `kunci_jawaban`) VALUES
(1, 1, 1, 'dlkjfladlkfk fkljdafjlkadkl jfkldajlfkjadkl fjkldajfal', '[\"bbcc2d8126a8f9cd754ae2b823af8584.png\"]', '[\"fdadfaadfda\",\"fdsfdasfdaf\",\"fdfasdfdasfs\",\"fdfafdaf\",\"fdsafasd\"]', '[[\"c00527ea3838b9f5b5df3fec6e9b9728.png\"],[],[],[],[]]', 'fdsafasfad'),
(4, 1, 1, 'dfasfadfsdf', '[]', '[\"\",\"\",\"\",\"\",\"\"]', '[[],[],[],[],[]]', ''),
(5, 1, 1, 'sdafasdfasfa', '[]', '[\"\",\"\",\"\",\"\",\"\"]', '[[],[],[],[],[]]', ''),
(6, 1, 1, 'dhjddjd', '[\"26399fe3174b549cbe06e24d59c820cf.png\"]', '\"[jddjjs, zhzjz, djdjdjd, xhxjxjs, dhdjdj]\"', '[[\"96b0097c58652abd724ac543bd0d7be7.png\"],[\"db9d3da3c85b5f62b6297a5bf2435514.png\"],[\"adc9d85c91928497e0b6af4ecc73a0af.png\"],[\"967bf03a73165de93733b38a41d2249f.png\"],[\"aef6637a198d683fc3467c1bcb06390c.png\"]]', 'djxjdk'),
(7, 1, 1, 'dhjddjd', '[\"b0b4cd785c89a51eee4bef1c81f1a4e6.png\"]', '\"[jddjjs, zhzjz, djdjdjd, xhxjxjs, dhdjdj]\"', '[[\"0f98e228b7ba2bd3480aa21198f5dd58.png\"],[\"aaf7c3429788f64e60e0161315c11e77.png\"],[\"7d69fed1c8c62b58c31e5837a0f54313.png\"],[\"ab757c50396977ab2e7f147f974b270d.png\"],[\"7c9b78b72561bda5cf5a8e09d1650632.png\"]]', 'djxjdk'),
(8, 1, 1, 'dhjddjd', '[\"9273cced3211173bf71f93aacadc1e90.png\"]', '\"[jddjjs, zhzjz, djdjdjd, xhxjxjs, dhdjdj]\"', '[[\"0b148ede283789f7a9e1bc2fb206f445.png\"],[\"ca74f8fe4d8d619f45f197c7634f914d.png\"],[\"4fd0f70c1e025ce0c719c7be1cc8749c.png\"],[\"eaa1681638e2b4d6142fb2ee07a36294.png\"],[\"227c8bd8e8b58c0becb928bf04174996.png\"]]', 'djxjdk'),
(9, 1, 1, 'dhjddjd', '[\"f08ec822d2f0e6e18fcb5472cce1f6c2.png\"]', '\"[jddjjs, zhzjz, djdjdjd, xhxjxjs, dhdjdj]\"', '[[\"190a7c2c863fcba1311549db818270aa.png\"],[\"21c9ca20c73adece04bd926a08531f36.png\"],[\"a40b5b7ae5f73298a3a7af7ea28ff9f7.png\"],[\"990650df02635d03aa38a0d25d5f45b7.png\"],[\"8224d1840c24c07ca9ee5a61a6f0a62d.png\"]]', 'djxjdk');

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
(1, '2017/2018');

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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jawaban_soal_ujian_detail`
--
ALTER TABLE `jawaban_soal_ujian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `jenis_soal_ujian_detail`
--
ALTER TABLE `jenis_soal_ujian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `materi_pelajaran`
--
ALTER TABLE `materi_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `murid`
--
ALTER TABLE `murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pr`
--
ALTER TABLE `pr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `soal_ujian`
--
ALTER TABLE `soal_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `soal_ujian_detail`
--
ALTER TABLE `soal_ujian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
