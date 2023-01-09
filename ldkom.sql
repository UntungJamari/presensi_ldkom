-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 09:11 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ldkom`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `tanggal` date NOT NULL,
  `no_anggota` varchar(100) NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `status_absen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `kode_hari` varchar(100) NOT NULL,
  `hari` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`kode_hari`, `hari`) VALUES
('1', 'Senin'),
('2', 'Selasa'),
('3', 'Rabu'),
('4', 'Kamis'),
('5', 'Jumat');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_user`
--

CREATE TABLE `jadwal_user` (
  `kode_hari` varchar(100) NOT NULL,
  `no_anggota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_user`
--

INSERT INTO `jadwal_user` (`kode_hari`, `no_anggota`) VALUES
('1', 'LDKOM.05.02'),
('1', 'LDKOM.05.05'),
('1', 'LDKOM.06.01'),
('1', 'LDKOM.07.04'),
('1', 'LDKOM.07.06'),
('1', 'LDKOM.07.08'),
('2', 'LDKOM.05.01'),
('2', 'LDKOM.05.03'),
('2', 'LDKOM.06.02'),
('2', 'LDKOM.06.05'),
('2', 'LDKOM.07.01'),
('2', 'LDKOM.07.04'),
('2', 'LDKOM.07.05'),
('3', 'LDKOM.05.05'),
('3', 'LDKOM.06.02'),
('3', 'LDKOM.06.03'),
('3', 'LDKOM.06.04'),
('3', 'LDKOM.07.02'),
('3', 'LDKOM.07.03'),
('3', 'LDKOM.07.07'),
('4', 'LDKOM.05.01'),
('4', 'LDKOM.05.02'),
('4', 'LDKOM.05.03'),
('4', 'LDKOM.06.01'),
('4', 'LDKOM.07.02'),
('4', 'LDKOM.07.05'),
('4', 'LDKOM.07.07'),
('5', 'LDKOM.06.03'),
('5', 'LDKOM.06.04'),
('5', 'LDKOM.06.05'),
('5', 'LDKOM.07.01'),
('5', 'LDKOM.07.03'),
('5', 'LDKOM.07.06'),
('5', 'LDKOM.07.08');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `id` int(11) NOT NULL,
  `nim` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `waktu_kedatangan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tujuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no_anggota` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no_anggota`, `nama`, `password`, `role`, `foto`) VALUES
('01', 'Admin', '$2y$10$68Ss7b3WG1WYucm/BVSa9uJt2RCK1i3Ft.azPTlLU6usAfxYJLwOC', 'Admin', '596106596f8e922c0ebb4eab11f85fa9.jpg'),
('LDKOM.05.01', 'Annisa Suprima', '$2y$10$vou9hgs33T68rcvu4i9HmuaYCu2vQF7gXhgG6SSGnM24uWQ1gRmwi', 'Asisten', 'default.jpg'),
('LDKOM.05.02', 'Dhinda Amalia Kiflia', '$2y$10$DIPo0DYkoF1sCiaBUQU/LOg4AYP5pygCHqwvHnjJpoCTTk7T.813K', 'Asisten', 'default.jpg'),
('LDKOM.05.03', 'Hanifa Alwi', '$2y$10$FdekZiip73cIbh0Iqe4bjeyV1pSeW.Ssyi1ewvTSxwnfW7yReL4zq', 'Asisten', 'default.jpg'),
('LDKOM.05.05', 'Nedia Putri Ismala', '$2y$10$P83wx5iQXLvYLr0pIXfU1upXVjNnmY4uq6V68EPLUAg4fuRabPivi', 'Asisten', 'default.jpg'),
('LDKOM.06.01', 'Ahmad Fadli Ramadhan', '$2y$10$dvnzyRlW/gckcFHix8ME.e9jeGNiCKmdHOzdB60IlaDhWUmgetZPO', 'Asisten', 'default.jpg'),
('LDKOM.06.02', 'Intan Yuliana Putri', '$2y$10$MoEd0mO.VF635xAtoeRSreqEs1js6ujahDK7W5sMIjPpUbCpWkojS', 'Asisten', 'default.jpg'),
('LDKOM.06.03', 'Puty Syalima', '$2y$10$4qFlcIi.FRiF9LTEXIcRo.IDAeLGVec.fFKX5l7O.RGMxVbYorNhO', 'Asisten', 'default.jpg'),
('LDKOM.06.04', 'Salma Hanifah', '$2y$10$S3ge4HLzxAp70IPxVkoeee3XXLrE0N//9FOg4Wd1eKS/8QdAaAIlC', 'Asisten', 'default.jpg'),
('LDKOM.06.05', 'Ulfatmi Hanifa', '$2y$10$uaZlYNKl2U/usT4D5i6n9uy/hWTfw10qDxjz6OkkUJuwMEw/L5Zg2', 'Asisten', 'default.jpg'),
('LDKOM.07.01', 'Fadillah Syafitri Nst', '$2y$10$aOc09GWiITeQ76pymP7Oe.Iw/rh9pdYUbLnbVy.jrpDecnhj/vzp6', 'Asisten', 'default.jpg'),
('LDKOM.07.02', 'Nadya Gusdita', '$2y$10$c.q0yZfNAwFzRor0D1Wa..foHLxAYfX5QwuN.eQUhx32uYtfDHala', 'Asisten', 'default.jpg'),
('LDKOM.07.03', 'Pawal Atakosi', '$2y$10$pXpGjfC/h/8BlhSwUSAPRuwE3l0Y5KFjz37n002lAH8Y.KZQX.2bG', 'Asisten', 'default.jpg'),
('LDKOM.07.04', 'Rahmadina', '$2y$10$QEqG5sH4l6uKIHCKHZL8p.5eLoiw2OW/HmWhvIAGYinpaiKVfY0ai', 'Asisten', 'default.jpg'),
('LDKOM.07.05', 'Reysha Irsyalina', '$2y$10$mHfdgIJeXgZsxIf2yFmqoOY22Sh7XrHHIV92D889cePzBOVrSl/Q.', 'Asisten', 'default.jpg'),
('LDKOM.07.06', 'Riska Shifa Salsabilla', '$2y$10$Zds.KlEYgsWiDi32ZLpR/.AWf/UKp89AZ7kllCCGI7/m.ot0Xczw6', 'Asisten', 'default.jpg'),
('LDKOM.07.07', 'Rizki Juni Darmawan', '$2y$10$b4scVhE3JowLzvALSvx5Buf6gRxA01uCG2GCBlLV2JIMGyvf0rngm', 'Asisten', 'Screenshot (243).png'),
('LDKOM.07.08', 'Untung Jamari', '$2y$10$3YpuFooqTGpIPz83UAo65epSGTf3s0GBSW4i2.fm8ZoDGShx/L/V6', 'Asisten', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`tanggal`,`no_anggota`),
  ADD KEY `absen_ibfk_1` (`no_anggota`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kode_hari`);

--
-- Indexes for table `jadwal_user`
--
ALTER TABLE `jadwal_user`
  ADD PRIMARY KEY (`kode_hari`,`no_anggota`),
  ADD KEY `jadwal_user_ibfk_2` (`no_anggota`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`no_anggota`) REFERENCES `user` (`no_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_user`
--
ALTER TABLE `jadwal_user`
  ADD CONSTRAINT `jadwal_user_ibfk_1` FOREIGN KEY (`kode_hari`) REFERENCES `jadwal` (`kode_hari`),
  ADD CONSTRAINT `jadwal_user_ibfk_2` FOREIGN KEY (`no_anggota`) REFERENCES `user` (`no_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
