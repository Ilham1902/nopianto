-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jul 2023 pada 06.03
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen_api`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` varchar(40) NOT NULL,
  `nidn` varchar(10) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `tanggal` varchar(12) NOT NULL,
  `jam` varchar(8) NOT NULL,
  `status` varchar(1) NOT NULL,
  `telat` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `nidn`, `nama`, `tanggal`, `jam`, `status`, `telat`) VALUES
('07cc3d08-714b-4f18-9a7b-6feef72c24bc', '156728', 'zuzong', '26-07-2023', '06:38:14', '1', '0'),
('392b88fe-18fe-4f9c-bf1b-a389bf61e92a', '678537', 'simba', '26-07-2023', '07:10:51', '1', '0'),
('3ab55984-7c66-40a8-8ddc-2a4551b3a4d3', 'sukican ', '87978786', '26-07-2023', '06:57:07', '1', '0'),
('6b0b655b-5577-4348-88b9-4631abdb8aba', '156257', 'RIA', '26-07-2023', '06:48:50', '1', '0'),
('903fae70-a17a-467d-94a6-d76e6bbb27a0', '638975', 'lala', '26-07-2023', '07:04:30', '1', '0'),
('afc22539-7e1a-4c77-aa0f-7b1a5cfb914d', '768090', 'sugeng', '26-07-2023', '07:34:33', '1', '0'),
('d7aa56bc-e181-400a-b7e4-31ab669680c9', 'lina ', ' 56788889', '26-07-2023', '07:00:38', '1', '0'),
('e0d49ea9-7340-4a02-bde4-d8aa461b0e76', '9090', 'bambang', '26-07-2023', '07:13:37', '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses`
--

CREATE TABLE `akses` (
  `id_akses` varchar(40) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akses`
--

INSERT INTO `akses` (`id_akses`, `api_key`) VALUES
('e5f2d6bb145211ee9b82548d5a0463ec', 'e5f2f48f145211ee9b82548d5a0463ec');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`) USING BTREE;

--
-- Indeks untuk tabel `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
