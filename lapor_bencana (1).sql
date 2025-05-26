-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2025 at 05:12 AM
-- Server version: 8.3.0
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lapor_bencana`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok_gudang` int NOT NULL DEFAULT '0',
  `satuan` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distribusi`
--

CREATE TABLE `distribusi` (
  `id_distribusi` int NOT NULL,
  `id_barang` int NOT NULL,
  `alamat_distribusi` text NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal_distribusi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `distribusi`
--
DELIMITER $$
CREATE TRIGGER `after_distribusi_insert` AFTER INSERT ON `distribusi` FOR EACH ROW BEGIN
    UPDATE barang 
    SET stok_gudang = stok_gudang - NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `nik` char(16) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `telp` varchar(13) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`) VALUES
('00998899897888', 'James Bond', 'james', '1234', '0812098809818'),
('1092979043483794', 'Anggun Saputri', 'Anggun', '1234', '0898487874738'),
('1234', 'Abay', 'bay', '1234', '0897687'),
('123456', 'Rizki romadon', 'rizki', '$2y$10$1Stb9gbUt00/FMP7ly3LxeE3/', '0897687'),
('3306020987670098', 'Ibnu', 'Ibnu', '1234', '089789760098'),
('33280102000009', 'Riski Maulana', 'Rizkii', 'Rizki1234', '081998766678'),
('3328061402000001', 'Bisma Arya', 'Bisma', '1234', '085809877765'),
('3328061402000005', 'Bayu Prakoso', 'Bayu21', 'Bayu1234', '089878677654'),
('3328061402010000', 'Ahmad Yogi', 'Yogi', 'Yogi1234', '081987658876'),
('6765798686098079', 'MUHAMAD YUSUF', 'ucupppp', '1234', '081256435643');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `nik` char(16) COLLATE utf8mb4_general_ci NOT NULL,
  `kecamatan` text COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_bencana` text COLLATE utf8mb4_general_ci NOT NULL,
  `penyebab` text COLLATE utf8mb4_general_ci NOT NULL,
  `dampak_kerugian` text COLLATE utf8mb4_general_ci NOT NULL,
  `kebutuhan` text COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('0','proses','selesai','batal') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `nik`, `kecamatan`, `alamat`, `jenis_bencana`, `penyebab`, `dampak_kerugian`, `kebutuhan`, `foto`, `video`, `status`) VALUES
(10, '2025-01-25', '6765798686098079', 'lebaksiu', 'tegalandong', 'banjir', 'hujan', 'rugi uang', 'beras', 'Ups.png', NULL, 'selesai'),
(11, '2025-01-30', '6765798686098079', 'DukuhWaru', 'rt5 rw2 ', 'tanah longsor', 'hujan', 'pada males beraktifitas', 'beras', 'IBN.png', NULL, 'selesai'),
(12, '2025-02-01', '6765798686098079', 'Lebaksiu', 'jalan makmuri', 'banjir', 'hujan deras', 'rumah roboh', 'beras', 'viki.jpeg', NULL, 'batal'),
(13, '2025-02-28', '1234', 'Lebaksiu', 'Desa Jatimulya, Rt02 Rw04', 'Puting Beliung', 'Hujan Lebat', 'Rumah Pada Rusak', 'Pakaian layak', 'yogi.jpeg', NULL, 'batal'),
(14, '2025-02-01', '00998899897888', 'pagerbarang', 'jalan dekukur rt04 rw09 ', 'longsor', 'hujan deras', 'rumah ambruk', 'uang tunai', 'alex.jpeg', NULL, 'batal'),
(15, '2025-02-21', '1092979043483794', 'Lebaksiu', 'Karangmoncol rt03 rw4 jalan dendrawasih', 'Longsor', 'Hujan Deras', 'Rumah ambruk', 'Material untuk membangun rumah kembali', 'rizki.jpeg', NULL, 'selesai'),
(16, '2025-02-28', '3328061402010000', 'Lebaksiu', 'Jalan Cendrawasih Rt09/Rw03 Desa Jatimulya', 'Banjir', 'Hujan Lebat', 'Rumah Warga Terendam Banjir', 'Pakaian Layak Pakai', 'gambar-lucu-banjir-jakarta-2015.jpg', NULL, 'selesai'),
(17, '2025-02-20', '33280102000009', 'Bumi Jawa', 'Jalan Makmuri Rt08/Rw09 Desa  Traju', 'Longsor', 'Hujan Lebat', 'Akses Jalan Terhambat', 'Perbaikan Jalan Secepatnya', 'longsor.jpg', NULL, 'selesai'),
(18, '2025-02-23', '33280102000009', 'Bumi Jawa', 'Jalan Sukarno Rt09/Rw01 Desa Traju', 'Longsor', 'Hujan Lebat', 'Akses Jalan Tertutup', 'Perbaikan jalan', 'longsor.jpg', NULL, 'selesai'),
(19, '2025-03-02', '33280102000009', 'Pagerbarang', 'Jl Prekutut Rt01/05 Desa Rajegweri', 'Banjir', 'Hujan Lebat', 'Rumah Warga Rusak', 'Pakaian Layak Pakai', 'gambar-lucu-banjir-jakarta-2015.jpg', NULL, 'batal'),
(20, '2025-03-01', '33280102000009', 'Lebaksiu', 'Jalan Suharto Rt02/Rw01 Desa  Kambangan', 'Longsor', 'Hujan Lebat', 'Rumah Warga Rusak', 'Makanan', 'longsor.jpg', NULL, 'batal'),
(21, '2025-02-27', '3306020987670098', 'Lebaksiu', 'Rt03, Rw04 Desa Tegalandong', 'Banjir', 'Hujan Deras', 'Rumah ambruk', 'Bahan Material', 'longsor.jpg', NULL, 'selesai'),
(22, '2025-03-11', '3328061402000005', 'Lebaksiu', 'Jl.Sukarno Rt09 Rw01', 'Tanah Longsor', 'Hujan Deras', 'Rumah Terbawa Tanah Mengakibatkan Rumah Ambruk', 'Pakaian Layak Pakai, Dan Bahan Pangan', 'tanah-longsor.jpg', NULL, 'batal'),
(23, '2025-03-11', '3328061402000001', 'Lebaksiu', 'Jl.Makmuri rt02 rw07', 'Longsor', 'Hujan Deras', 'Rumah Roboh', 'Bahan Makanan ', 'tanah-longsor.jpg', NULL, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int NOT NULL,
  `nama_petugas` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `telp` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('admin','petugas') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `telp`, `level`) VALUES
(1, 'Anto', 'admin', 'admin', '085801314818', 'admin'),
(7, 'aji', 'aji', '1234', '0989809809088', 'admin'),
(9, 'jastin', 'jastin', '1234', '098798090870', 'admin'),
(10, 'zaenal', 'zaenal', '123455', '122131313131', 'admin'),
(12, 'Bambang', 'Bangbang', '1234', '0898978686', 'petugas'),
(13, 'Sutrisno', 'Sutrisno', '1234', '0897879879898', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id_stok_masuk` int NOT NULL,
  `id_barang` int NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `stok_masuk`
--
DELIMITER $$
CREATE TRIGGER `after_stok_masuk_insert` AFTER INSERT ON `stok_masuk` FOR EACH ROW BEGIN
    UPDATE barang 
    SET stok_gudang = stok_gudang + NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int NOT NULL,
  `id_pengaduan` int NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `tanggapan` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_petugas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_petugas`) VALUES
(1, 11, '2025-02-11', 'oke bro', 1),
(2, 10, '2025-02-11', 'oke mas saya tangkap', 1),
(3, 12, '2025-02-13', 'mimin lagi galau', 7),
(4, 13, '2025-02-13', 'Males ah', 7),
(5, 14, '2025-02-14', 'maaf mimin lagi gk mood', 13),
(6, 15, '2025-02-19', 'oke bahan bangunan akan segera dikirim', 7),
(7, 16, '2025-02-24', 'Baik laporan anda saya terima', 7),
(8, 17, '2025-02-24', 'Laporan Anda Kami Terima', 7),
(9, 18, '2025-02-24', 'Baik Laporan Anda Kami Terima', 7),
(10, 19, '2025-02-24', 'Tempat ini sudah mendapatkan bantuan', 7),
(11, 20, '2025-02-24', 'Laporan Tidak Sesuai', 7),
(12, 21, '2025-02-26', 'oke laporan saya terimaa', 7),
(13, 23, '2025-03-11', 'Terimakasih Laporan Anda Kami Terima', 7),
(14, 22, '2025-03-11', 'Maaf Pengaduan Anda Kami Tolak', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `distribusi`
--
ALTER TABLE `distribusi`
  ADD PRIMARY KEY (`id_distribusi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id_stok_masuk`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD UNIQUE KEY `id_pengaduan_2` (`id_pengaduan`),
  ADD KEY `id_pengaduan` (`id_pengaduan`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_pengaduan_3` (`id_pengaduan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distribusi`
--
ALTER TABLE `distribusi`
  MODIFY `id_distribusi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id_stok_masuk` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `distribusi`
--
ALTER TABLE `distribusi`
  ADD CONSTRAINT `distribusi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `masyarakat` (`nik`);

--
-- Constraints for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD CONSTRAINT `stok_masuk_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `tanggapan_ibfk_2` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
