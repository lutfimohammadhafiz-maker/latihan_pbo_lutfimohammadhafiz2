-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2026 at 03:23 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan_pbo_trpl1a_lutfimhafiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` int NOT NULL,
  `nama_film` varchar(100) NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` int NOT NULL,
  `harga_dasar_tiket` decimal(10,2) NOT NULL,
  `jenis_studio` enum('Reguler','IMAX','Velvet') NOT NULL,
  `tipe_audio` varchar(50) DEFAULT NULL,
  `kacamata_3d_id` varchar(20) DEFAULT NULL,
  `efek_gerak_fitur` varchar(100) DEFAULT NULL,
  `lokasi_baris` varchar(20) DEFAULT NULL,
  `bantal_selimut_pack` varchar(50) DEFAULT NULL,
  `layanan_butler` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_audio`, `kacamata_3d_id`, `efek_gerak_fitur`, `lokasi_baris`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(1, 'Avengers Endgame', '2026-06-15 19:00:00', 100, 50000.00, 'Reguler', 'Dolby Digital', NULL, NULL, NULL, NULL, NULL),
(2, 'Spider-Man No Way Home', '2026-06-15 21:00:00', 120, 55000.00, 'Reguler', 'DTS Surround', NULL, NULL, NULL, NULL, NULL),
(3, 'The Batman', '2026-06-16 18:30:00', 90, 50000.00, 'Reguler', 'Dolby Atmos', NULL, NULL, NULL, NULL, NULL),
(4, 'Joker', '2026-06-16 20:30:00', 110, 45000.00, 'Reguler', 'DTS-HD', NULL, NULL, NULL, NULL, NULL),
(5, 'Interstellar', '2026-06-17 19:00:00', 95, 60000.00, 'Reguler', 'Dolby Digital', NULL, NULL, NULL, NULL, NULL),
(6, 'Inception', '2026-06-17 21:30:00', 100, 55000.00, 'Reguler', 'Dolby Atmos', NULL, NULL, NULL, NULL, NULL),
(7, 'Doctor Strange', '2026-06-18 18:00:00', 85, 50000.00, 'Reguler', 'DTS Surround', NULL, NULL, NULL, NULL, NULL),
(8, 'Avatar 3', '2026-06-15 20:00:00', 80, 100000.00, 'IMAX', NULL, '3D001', 'Motion Seat', NULL, NULL, NULL),
(9, 'Dune Part Three', '2026-06-15 22:00:00', 75, 95000.00, 'IMAX', NULL, '3D002', 'Vibration Effect', NULL, NULL, NULL),
(10, 'Transformers Rise', '2026-06-16 19:30:00', 70, 90000.00, 'IMAX', NULL, '3D003', 'Motion Seat', NULL, NULL, NULL),
(11, 'Pacific Rim', '2026-06-16 21:30:00', 85, 95000.00, 'IMAX', NULL, '3D004', 'Wind Effect', NULL, NULL, NULL),
(12, 'Godzilla x Kong', '2026-06-17 20:00:00', 90, 100000.00, 'IMAX', NULL, '3D005', 'Motion Seat', NULL, NULL, NULL),
(13, 'Jurassic World Rebirth', '2026-06-18 20:00:00', 80, 105000.00, 'IMAX', NULL, '3D006', 'Water Splash', NULL, NULL, NULL),
(14, 'Star Wars New Era', '2026-06-18 22:00:00', 75, 110000.00, 'IMAX', NULL, '3D007', 'Vibration Effect', NULL, NULL, NULL),
(15, 'Titanic Reborn', '2026-06-15 21:00:00', 40, 150000.00, 'Velvet', NULL, 'NULL', NULL, 'Baris A', 'Premium Pack', 'Tersedia'),
(16, 'La La Land', '2026-06-16 19:00:00', 35, 145000.00, 'Velvet', NULL, 'NULL', NULL, 'Baris B', 'Premium Pack', 'Tersedia'),
(17, 'The Notebook', '2026-06-16 21:00:00', 30, 140000.00, 'Velvet', NULL, 'NULL', NULL, 'Baris A', 'Luxury Pack', 'Tersedia'),
(18, 'Me Before You', '2026-06-17 20:00:00', 25, 150000.00, 'Velvet', NULL, 'NULL', NULL, 'Baris C', 'Premium Pack', 'Tersedia'),
(19, 'A Walk to Remember', '2026-06-18 18:30:00', 28, 145000.00, 'Velvet', NULL, 'NULL', NULL, 'Baris B', 'Luxury Pack', 'Tersedia'),
(20, 'The Fault in Our Stars', '2026-06-18 21:00:00', 32, 155000.00, 'Velvet', NULL, 'NULL', NULL, 'Baris A', 'Exclusive Pack', 'Tersedia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  MODIFY `id_tiket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
