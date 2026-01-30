-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2026 at 02:08 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_ruangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidang_pegawai`
--

CREATE TABLE `bidang_pegawai` (
  `id_bidang` int NOT NULL,
  `sub_bidang` varchar(100) NOT NULL,
  `bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bidang_pegawai`
--

INSERT INTO `bidang_pegawai` (`id_bidang`, `sub_bidang`, `bidang`) VALUES
(1, 'Sekretaris', 'Sekretariat'),
(2, 'Kasubag Umpeg', 'Sekretariat'),
(3, 'Kasubag Keuangan (Purna)', 'Sekretariat'),
(4, 'Kasubag Program', 'Sekretariat');

-- --------------------------------------------------------

--
-- Table structure for table `data_sarana`
--

CREATE TABLE `data_sarana` (
  `id_sarana` int NOT NULL,
  `nama_sarana` varchar(100) NOT NULL,
  `jenis_sarana` enum('elektronik','non-elektronik') NOT NULL,
  `jumlah` int NOT NULL,
  `id_ruangan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_sarana`
--

INSERT INTO `data_sarana` (`id_sarana`, `nama_sarana`, `jenis_sarana`, `jumlah`, `id_ruangan`) VALUES
(1, 'AC', 'elektronik', 1, 1),
(2, 'Sound System', 'elektronik', 3, 1),
(3, 'Kursi', 'non-elektronik', 50, 3);

-- --------------------------------------------------------

--
-- Table structure for table `gambar_ruangan`
--

CREATE TABLE `gambar_ruangan` (
  `id_gambar` int NOT NULL,
  `id_ruangan` int NOT NULL,
  `nama_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gambar_ruangan`
--

INSERT INTO `gambar_ruangan` (`id_gambar`, `id_ruangan`, `nama_file`) VALUES
(1, 1, 'ruang_skpd_tp_1.jpg\r\n'),
(3, 1, 'ruang_skpd_tp_2.jpg'),
(4, 2, 'ruang_sekdin_1.jpg'),
(5, 2, 'ruang_sekdin_2.jpg'),
(6, 3, 'ruang_rapat_kadinas_1.jpg'),
(7, 3, 'ruang_rapat_kadinas_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `gambar_ruangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`, `gambar_ruangan`) VALUES
(1, 'Ruang Rapat A', NULL),
(2, 'Ruang Rapat B', NULL),
(3, 'Aula Utama', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_peminjaman` int NOT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `acara` varchar(100) NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `status_peminjaman` enum('Menunggu','Disetujui','Ditolak','Dibatalkan') NOT NULL,
  `jumlah_peserta` int NOT NULL,
  `id_bidang` int NOT NULL,
  `id_ruangan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `no_wa` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_peminjaman`, `waktu_mulai`, `waktu_selesai`, `acara`, `catatan`, `status_peminjaman`, `jumlah_peserta`, `id_bidang`, `id_ruangan`, `id_user`, `no_wa`) VALUES
(1, '2026-01-10 09:00:00', '2026-01-10 11:00:00', 'Rapat Koordinasi', 'Koordinasi administrasi internal', 'Menunggu', 15, 1, 1, 1, '0892311111'),
(2, '2026-01-12 13:00:00', '2026-01-12 15:00:00', 'Rapat Umum Kepegawaian', 'Pembahasan data kepegawaian', 'Disetujui', 20, 2, 2, 2, '0872366757'),
(3, '2026-01-16 09:00:00', '2026-01-16 11:00:00', 'Rapat Evaluasi Anggaran', 'Evaluasi anggaran', 'Dibatalkan', 10, 3, 2, 1, '082893497'),
(4, '2026-01-18 09:00:00', '2026-01-18 11:00:00', 'Rapat Perencanaan Program', 'Perencanaan program', 'Disetujui', 25, 4, 3, 2, '0897346345'),
(9, '2026-01-28 13:50:00', '2026-01-28 14:50:00', 'rapat', '', 'Menunggu', 20, 4, 2, 1, '0813437342');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Petugas Utama', 'petugas', '$2y$12$f8ZPSGNhdQpa8FrYhrSy0.N6ikgZ7836wSQiPSYqvMuL1DDRR2Qku', 'petugas'),
(2, 'Super Admin', 'admin', '$2y$12$Hq7pXvQ4C079q7HRldyQfO0y5o7YsWmU5SyTLLPm9wlRICCbO/eie', 'superadmin'),
(3, 'Petugas Dua', 'petugas2', '$2y$12$oqJzUxUYJoFvUfYNyxCWdeM12Kd7O8iuhgCHuUhQbJ62gqJBdIuuK', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang_pegawai`
--
ALTER TABLE `bidang_pegawai`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `data_sarana`
--
ALTER TABLE `data_sarana`
  ADD PRIMARY KEY (`id_sarana`),
  ADD KEY `id_ruangan` (`id_ruangan`);

--
-- Indexes for table `gambar_ruangan`
--
ALTER TABLE `gambar_ruangan`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `id_ruangan` (`id_ruangan`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_bidang` (`id_bidang`),
  ADD KEY `id_ruangan` (`id_ruangan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_pegawai`
--
ALTER TABLE `bidang_pegawai`
  MODIFY `id_bidang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_sarana`
--
ALTER TABLE `data_sarana`
  MODIFY `id_sarana` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gambar_ruangan`
--
ALTER TABLE `gambar_ruangan`
  MODIFY `id_gambar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_sarana`
--
ALTER TABLE `data_sarana`
  ADD CONSTRAINT `fk_sarana_ruangan` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gambar_ruangan`
--
ALTER TABLE `gambar_ruangan`
  ADD CONSTRAINT `gambar_ruangan_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_bidang` FOREIGN KEY (`id_bidang`) REFERENCES `bidang_pegawai` (`id_bidang`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_ruangan` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
