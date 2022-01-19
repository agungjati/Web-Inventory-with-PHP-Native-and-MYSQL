-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jan 2022 pada 18.27
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_2022014`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `id_pemasok` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `harga_barang` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `id_pemasok`, `nama_barang`, `stok`, `satuan`, `harga_barang`) VALUES
(3, '1002', 1, 'Baut rc7', 10, 'pcs', 1000),
(4, '1003', 2, 'Pilok warna merah muda', 5, 'lusin', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name_customer` varchar(50) NOT NULL,
  `no_telpon` varchar(14) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `alamat_customer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `name_customer`, `no_telpon`, `email`, `alamat_customer`) VALUES
(1, 'anita', '08080808', 'anita@gmail.com', 'Tiban a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasok`
--

CREATE TABLE `pemasok` (
  `id` int(11) NOT NULL,
  `nama_pemasok` varchar(50) NOT NULL,
  `alamat_pemasok` varchar(100) NOT NULL,
  `no_telpon_pemasok` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemasok`
--

INSERT INTO `pemasok` (`id`, `nama_pemasok`, `alamat_pemasok`, `no_telpon_pemasok`) VALUES
(1, 'Pt Pemasok spare part', 'Jl. Imam Bonjol No.26. Kel. Alai Gelombang, Kec. P', '080808080'),
(2, 'Pt Mencari cinta', 'Ruko, Jl.Pembangunan, Komplek, Jl. Komp. Penuin Ce', '08080808');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pembelian`
--

CREATE TABLE `transaksi_pembelian` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `jumlah_harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_pembelian`
--

INSERT INTO `transaksi_pembelian` (`id`, `no_faktur`, `kode_barang`, `tgl_transaksi`, `jumlah_beli`, `jumlah_harga`) VALUES
(2, 'INV1001', '1002', '2022-01-16', 1, 1000);

--
-- Trigger `transaksi_pembelian`
--
DELIMITER $$
CREATE TRIGGER `tambah_stok_barang` AFTER INSERT ON `transaksi_pembelian` FOR EACH ROW BEGIN
	update barang set 
	stok = stok + new.jumlah_beli 
	WHERE kode_barang = new.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jumlah_jual` int(11) NOT NULL,
  `jumlah_harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`id`, `no_faktur`, `kode_barang`, `customer_id`, `tgl_transaksi`, `jumlah_jual`, `jumlah_harga`) VALUES
(2, 'INV1001', '1002', 0, '2022-01-16', 1, 1000),
(3, 'INV1002', '1002', 0, '2022-01-16', 1, 1000),
(4, 'INV1003', '1002', 1, '2022-01-20', 1, 1000);

--
-- Trigger `transaksi_penjualan`
--
DELIMITER $$
CREATE TRIGGER `kurangi_stok_barang` AFTER INSERT ON `transaksi_penjualan` FOR EACH ROW update barang set 
	stok = stok - new.jumlah_jual 
	WHERE kode_barang = new.kode_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `foto`, `password`) VALUES
(1, 'Agung Jati', '2022014', '61e4087e4084c.jpg', '$2y$10$E5BGuLPauPeN0Sb8M1mTlea9RJjahe./4fCkRsyRF8v4SECMNZr5e'),
(3, 'admin', 'admin', '61e408d3302a4.jpg', '$2y$10$xOL6cqLGIqEWlHa9j2YSgemsF6.md1Tevo7fq7HgaTWx9wI5eyaFK');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemasok` (`id_pemasok`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
