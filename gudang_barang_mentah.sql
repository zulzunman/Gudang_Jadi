-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2023 pada 07.46
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang_barang_mentah1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `jenis_barang` varchar(10) NOT NULL,
  `warna_barang` varchar(15) NOT NULL,
  `stok_barang` int(11) NOT NULL,
  `satuan_barang` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `jenis_barang`, `warna_barang`, `stok_barang`, `satuan_barang`) VALUES
('KF01', 'Flanel Lembut', 'Kain', 'Hitam', 100, 'Roll');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'PR01', 1, 0, 0, NULL, 0),
(2, 2, 'admin123', 1, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `limits`
--

CREATE TABLE `limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `limits`
--

INSERT INTO `limits` (`id`, `uri`, `count`, `hour_started`, `api_key`) VALUES
(1, 'uri:api/permintaan_barang_mentah/index:get', 9, 1673443500, 'admin123'),
(2, 'uri:api/permintaan_barang_mentah/index:delete', 1, 1673443892, 'admin123'),
(3, 'uri:api/permintaan_barang_mentah/index:post', 2, 1673443933, 'admin123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan`
--

CREATE TABLE `penerimaan` (
  `id_penerimaan` varchar(11) NOT NULL,
  `id_barang` varchar(11) NOT NULL,
  `stok_diterima` int(11) NOT NULL,
  `satuan_stok` varchar(11) NOT NULL,
  `tanggal_penerimaan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `penerimaan`
--
DELIMITER $$
CREATE TRIGGER `tambah_barang` AFTER INSERT ON `penerimaan` FOR EACH ROW BEGIN

INSERT INTO barang SET id_barang = NEW.id_barang,
satuan_barang = NEW.satuan_stok,
stok_barang = NEW.stok_diterima ON DUPLICATE KEY UPDATE
stok_barang = stok_barang + NEW.stok_diterima;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` varchar(11) NOT NULL,
  `id_permintaan_barang` varchar(11) NOT NULL,
  `tanggal_pengiriman` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stok_terkirim` int(11) NOT NULL,
  `satuan_stok` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `pengiriman`
--
DELIMITER $$
CREATE TRIGGER `status_permintaan_barang_mentah` AFTER INSERT ON `pengiriman` FOR EACH ROW BEGIN

UPDATE permintaan_barang_mentah SET 
status = 1,
stok_terkirim = NEW.stok_terkirim
WHERE id_permintaan_barang = NEW.id_permintaan_barang;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_barang_mentah`
--

CREATE TABLE `permintaan_barang_mentah` (
  `id_permintaan_barang` varchar(11) NOT NULL,
  `id_barang` varchar(11) NOT NULL,
  `stok_barang` int(11) NOT NULL,
  `stok_terkirim` int(11) NOT NULL,
  `satuan_barang` varchar(11) NOT NULL,
  `tanggal_permintaan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` smallint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permintaan_barang_mentah`
--

INSERT INTO `permintaan_barang_mentah` (`id_permintaan_barang`, `id_barang`, `stok_barang`, `stok_terkirim`, `satuan_barang`, `tanggal_permintaan`, `status`) VALUES
('A01', 'KF01', 2, 0, 'Pcs', '2023-01-11 06:32:13', 0),
('A02', 'KF01', 2, 0, 'Pcs', '2023-01-11 06:03:31', 0),
('A03', 'KF01', 2, 0, 'Pcs', '2023-01-11 06:06:31', 0),
('A04', 'KF01', 2, 0, 'Pcs', '2023-01-11 06:32:30', 1);

--
-- Trigger `permintaan_barang_mentah`
--
DELIMITER $$
CREATE TRIGGER `kurang_barang` AFTER UPDATE ON `permintaan_barang_mentah` FOR EACH ROW update barang set 
stok_barang = stok_barang - NEW.stok_terkirim, 
satuan_barang = NEW.satuan_barang
where id_barang = NEW.id_barang
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `limits`
--
ALTER TABLE `limits`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`id_penerimaan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `id_permintaan_barang` (`id_permintaan_barang`);

--
-- Indeks untuk tabel `permintaan_barang_mentah`
--
ALTER TABLE `permintaan_barang_mentah`
  ADD PRIMARY KEY (`id_permintaan_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `limits`
--
ALTER TABLE `limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD CONSTRAINT `penerimaan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`id_permintaan_barang`) REFERENCES `permintaan_barang_mentah` (`id_permintaan_barang`);

--
-- Ketidakleluasaan untuk tabel `permintaan_barang_mentah`
--
ALTER TABLE `permintaan_barang_mentah`
  ADD CONSTRAINT `permintaan_barang_mentah_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
