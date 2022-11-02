-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2019 at 12:45 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_stok`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `kd_brg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `persediaan`
--

CREATE TABLE `persediaan` (
  `kd_brg` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kd_brg` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kd_brg`, `nama_barang`, `stok`, `harga`, `supplier`) VALUES
(17, 'Novel Langkar Pelangi', 51, 120000, 'Raditya'),
(18, 'Novel Aldinaya', 50, 99900, 'Aldito Refand Ananta'),
(23, 'Novel Mariposa', 90, 115000, 'Luluk'),
(24, 'Novel SIN', 90, 100900, 'Mawar Rinjani'),
(25, 'Novel Cinta Dalam Diam', 43, 89000, 'Aqilla Kendy'),
(26, 'Novel Dilan 1990', 75, 150000, 'Pidi Baiq'),
(27, 'Novel Dilan 1991', 76, 155000, 'Pidi Baiq'),
(28, 'Novel Januari', 40, 88800, 'Shiren Natalia'),
(29, 'Novel Alan', 30, 68000, 'Bayu Permana'),
(35, 'Novel Cold Couple', 54, 75000, 'Bayu Permana'),
(36, 'Novel MyBadBoyFriend', 62, 67000, 'Arintta'),
(37, 'Novel Alena', 30, 78000, 'Angelica Beckinsale'),
(38, 'Novel Fake Nerd Girl', 37, 90000, 'Alesca Brayn Joseph'),
(39, 'Novel Perfect Couple', 22, 85500, 'Arthaya Angelica'),
(40, 'Novel Aletta', 40, 85000, 'Regga Ananta');

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `umur` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nama_anggota`, `alamat`, `pekerjaan`, `umur`) VALUES
(1, 'Nathan Rey Davidson', 'Jakarta', 'Penulis', '17'),
(2, 'Salsabila Azzarah', 'Jombang', 'Penerbit', '25'),
(3, 'Affandy Alexander', 'Surakarta', 'Penulis', '18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` varchar(100) NOT NULL,
  `kd_brg` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `kd_brg`, `jumlah_beli`, `total`) VALUES
('RPL12019110001', 27, 4, 620000),
('RPL12019110002', 24, 2, 201800),
('RPL12019110003', 18, 3, 299700),
('RPL12019110004', 23, 7, 805000),
('RPL12019110005', 38, 6, 540000),
('RPL12019110006', 36, 6, 402000),
('RPL12019110007', 35, 2, 150000),
('RPL12019110008', 39, 8, 684000),
('RPL12019110009', 18, 10, 999000);

--
-- Triggers `tb_pembelian`
--
DELIMITER $$
CREATE TRIGGER `kurang_stok` AFTER INSERT ON `tb_pembelian` FOR EACH ROW BEGIN
UPDATE produk SET stok = stok-NEW.jumlah_beli
WHERE kd_brg = NEW.kd_brg ;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_persediaan`
--

CREATE TABLE `tb_persediaan` (
  `kd_brg` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(100) NOT NULL,
  `supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_persediaan`
--

INSERT INTO `tb_persediaan` (`kd_brg`, `nama_barang`, `stok`, `harga`, `supplier`) VALUES
(0, 'Novel Aldinaya', 58, 99900, 'Aldito Refand Ananta');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setor`
--

CREATE TABLE `tb_setor` (
  `id_setor` varchar(100) NOT NULL,
  `tgl_setor` date NOT NULL,
  `kd_brg` int(11) NOT NULL,
  `jml_setor` int(11) NOT NULL,
  `harga_setor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_setor`
--

INSERT INTO `tb_setor` (`id_setor`, `tgl_setor`, `kd_brg`, `jml_setor`, `harga_setor`) VALUES
('Imut_dong2019110001', '2019-10-27', 18, 5, 499500),
('Imut_dong2019110002', '2019-11-01', 25, 7, 623000),
('Imut_dong2019110003', '2019-11-02', 28, 10, 888000),
('Imut_dong2019110004', '2019-10-29', 23, 15, 1725000),
('Imut_dong2019110005', '2019-11-03', 38, 18, 1620000),
('Imut_dong2019110006', '2019-10-27', 23, 5, 575000),
('Imut_dong2019110007', '2019-11-02', 24, 40, 4036000);

--
-- Triggers `tb_setor`
--
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER INSERT ON `tb_setor` FOR EACH ROW BEGIN
UPDATE produk SET stok = stok+NEW.jml_setor
WHERE kd_brg = NEW.kd_brg ;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_undian`
--

CREATE TABLE `tb_undian` (
  `no` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persediaan`
--
ALTER TABLE `persediaan`
  ADD PRIMARY KEY (`kd_brg`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kd_brg`);

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `tb_persediaan`
--
ALTER TABLE `tb_persediaan`
  ADD PRIMARY KEY (`kd_brg`);

--
-- Indexes for table `tb_setor`
--
ALTER TABLE `tb_setor`
  ADD PRIMARY KEY (`id_setor`);

--
-- Indexes for table `tb_undian`
--
ALTER TABLE `tb_undian`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `kd_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
