-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2023 at 02:56 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pma_angga`
--

-- --------------------------------------------------------

--
-- Table structure for table `gap`
--

CREATE TABLE `gap` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `Discipline` int(11) DEFAULT NULL,
  `Integrity` int(11) DEFAULT NULL,
  `Achievement` int(11) DEFAULT NULL,
  `Continuous` int(11) DEFAULT NULL,
  `Improvement` int(11) DEFAULT NULL,
  `Quality` int(11) DEFAULT NULL,
  `Customer_Service` int(11) DEFAULT NULL,
  `TeamWork` int(11) DEFAULT NULL,
  `Leadership` int(11) DEFAULT NULL,
  `Analytical_Problem` int(11) DEFAULT NULL,
  `Planning` int(11) DEFAULT NULL,
  `Developing` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gap`
--

INSERT INTO `gap` (`id`, `nama`, `Discipline`, `Integrity`, `Achievement`, `Continuous`, `Improvement`, `Quality`, `Customer_Service`, `TeamWork`, `Leadership`, `Analytical_Problem`, `Planning`, `Developing`) VALUES
(1, 'Indra', 4, 5, 5, 4, 5, 5, 5, 3, 3, 5, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `hasil` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `nama`, `hasil`) VALUES
(1, 'Indra', '4.50');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `Discipline` int(11) DEFAULT NULL,
  `Integrity` int(11) DEFAULT NULL,
  `Achievement` int(11) DEFAULT NULL,
  `Continuous` int(11) DEFAULT NULL,
  `Improvement` int(11) DEFAULT NULL,
  `Quality` int(11) DEFAULT NULL,
  `Customer_Service` int(11) DEFAULT NULL,
  `TeamWork` int(11) DEFAULT NULL,
  `Leadership` int(11) DEFAULT NULL,
  `Analytical_Problem` int(11) DEFAULT NULL,
  `Planning` int(11) DEFAULT NULL,
  `Developing` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `Discipline`, `Integrity`, `Achievement`, `Continuous`, `Improvement`, `Quality`, `Customer_Service`, `TeamWork`, `Leadership`, `Analytical_Problem`, `Planning`, `Developing`) VALUES
(1, 'Indra', 4, 5, 5, 4, 5, 5, 5, 5, 5, 5, 5, 5),
(2, 'bayu', 5, 4, 5, 4, 5, 3, 4, 4, 3, 5, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jenis` enum('cf','sf') NOT NULL,
  `ket` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`, `jenis`, `ket`) VALUES
(1, 'Discipline', 'cf', 'Discipline'),
(2, 'Integrity', 'cf', 'Integrity'),
(3, 'Achievement', 'sf', 'Achievement'),
(4, 'Continuous', 'cf', 'Continuous'),
(5, 'Improvement', 'sf', 'Improvement'),
(6, 'Quality', 'cf', 'Quality'),
(7, 'Customer Service', 'cf', 'Customer_Service'),
(8, 'Team Work', 'cf', 'TeamWork'),
(9, 'Leadership', 'sf', 'Leadership'),
(10, 'Analytical & Problem', 'cf', 'Analytical_Problem'),
(11, 'Planning', 'sf', 'Planning'),
(12, 'Developing', 'cf', 'Developing');

-- --------------------------------------------------------

--
-- Table structure for table `pembobotan`
--

CREATE TABLE `pembobotan` (
  `id` int(11) NOT NULL,
  `selisih` float NOT NULL,
  `bobot` float NOT NULL,
  `ket` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembobotan`
--

INSERT INTO `pembobotan` (`id`, `selisih`, `bobot`, `ket`) VALUES
(1, 0, 5, 'Tidak Ada Selisih (kompetensi sesuai dengan yang dibutuhkan)'),
(2, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level'),
(3, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level'),
(4, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level'),
(5, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level'),
(6, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level'),
(7, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level'),
(8, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level'),
(9, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level');

-- --------------------------------------------------------

--
-- Table structure for table `peringkat`
--

CREATE TABLE `peringkat` (
  `id` int(11) NOT NULL,
  `mhs_id` int(11) NOT NULL,
  `nilai_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peringkat`
--

INSERT INTO `peringkat` (`id`, `mhs_id`, `nilai_total`) VALUES
(1, 1, 3.85),
(2, 2, 4.35);

-- --------------------------------------------------------

--
-- Table structure for table `profil_standar2`
--

CREATE TABLE `profil_standar2` (
  `id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `subkriteria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil_standar2`
--

INSERT INTO `profil_standar2` (`id`, `kriteria_id`, `subkriteria_id`) VALUES
(1, 1, 1),
(2, 2, 6),
(3, 3, 12),
(4, 4, 16),
(5, 5, 21),
(6, 6, 26),
(7, 7, 31),
(8, 8, 39),
(9, 9, 44),
(10, 10, 47),
(11, 11, 52),
(12, 12, 57);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `nama` varchar(68) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id`, `kriteria_id`, `nama`, `nilai`) VALUES
(1, 1, 'Baik Sekali', 5),
(2, 1, 'Baik', 4),
(3, 1, 'Sedang', 3),
(4, 1, 'Kurang', 2),
(5, 1, 'Kurang sekali', 1),
(6, 2, 'Baik Sekali', 5),
(7, 2, 'Baik', 4),
(8, 2, 'Sedang', 3),
(9, 2, 'Kurang', 2),
(10, 2, 'Kurang sekali', 1),
(11, 3, 'Baik Sekali', 5),
(12, 3, 'Baik', 4),
(13, 3, 'Sedang', 3),
(14, 3, 'Kurang', 2),
(15, 3, 'Kurang sekali', 1),
(16, 4, 'Baik Sekali', 5),
(17, 4, 'Baik', 4),
(18, 4, 'Sedang', 3),
(19, 4, 'Kurang', 2),
(20, 4, 'Kurang sekali', 1),
(21, 5, 'Baik Sekali', 5),
(22, 5, 'Baik', 4),
(23, 5, 'Sedang', 3),
(24, 5, 'Kurang', 2),
(25, 5, 'Kurang sekali', 1),
(26, 6, 'Baik Sekali', 5),
(27, 6, 'Baik', 4),
(28, 6, 'Sedang', 3),
(29, 6, 'Kurang', 2),
(30, 6, 'Kurang sekali', 1),
(31, 7, 'Baik Sekali', 5),
(32, 7, 'Baik', 4),
(33, 7, 'Sedang', 3),
(34, 7, 'Kurang', 2),
(35, 7, 'Kurang sekali', 1),
(36, 8, 'Baik Sekali', 5),
(37, 8, 'Baik', 4),
(38, 8, 'Sedang', 3),
(39, 8, 'Kurang', 2),
(40, 8, 'Kurang sekali', 1),
(41, 9, 'Baik Sekali', 5),
(42, 9, 'Baik', 4),
(43, 9, 'Sedang', 3),
(44, 9, 'Kurang', 2),
(45, 9, 'Kurang sekali', 1),
(46, 10, 'Baik Sekali', 5),
(47, 10, 'Baik', 4),
(48, 10, 'Sedang', 3),
(49, 10, 'Kurang', 2),
(50, 10, 'Kurang sekali', 1),
(51, 11, 'Baik Sekali', 5),
(52, 11, 'Baik', 4),
(53, 11, 'Sedang', 3),
(54, 11, 'Kurang', 2),
(55, 11, 'Kurang sekali', 1),
(56, 12, 'Baik Sekali', 5),
(57, 12, 'Baik', 4),
(58, 12, 'Sedang', 3),
(59, 12, 'Kurang', 2),
(60, 12, 'Kurang sekali', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin1', '21232f297a57a5a743894a0e4a801fc3', 1),
(8, 'bayu@gmail.com', 'a430e06de5ce438d499c2e4063d60fd6', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_penduduk`
-- (See below for the actual view)
--
CREATE TABLE `vw_penduduk` (
);

-- --------------------------------------------------------

--
-- Structure for view `vw_penduduk`
--
DROP TABLE IF EXISTS `vw_penduduk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_penduduk`  AS SELECT `p`.`id` AS `id`, `p`.`nama_penduduk` AS `nama_penduduk`, `pekerjaan`.`nama` AS `pekerjaan`, `penghasilan`.`nama` AS `penghasilan`, `jml_tanggungan`.`nama` AS `jml_tanggungan`, `tempat_tgl`.`nama` AS `tempat_tgl`, `umur`.`nama` AS `umur`, `sts_kawin`.`nama` AS `sts_kawin` FROM ((((((`penduduk` `p` join `sub_kriteria` `pekerjaan` on(`pekerjaan`.`nilai` = `p`.`pekerjaan` and `pekerjaan`.`kriteria_id` = 1)) join `sub_kriteria` `penghasilan` on(`penghasilan`.`nilai` = `p`.`penghasilan` and `penghasilan`.`kriteria_id` = 2)) join `sub_kriteria` `jml_tanggungan` on(`jml_tanggungan`.`nilai` = `p`.`jml_tanggungan` and `jml_tanggungan`.`kriteria_id` = 3)) join `sub_kriteria` `tempat_tgl` on(`tempat_tgl`.`nilai` = `p`.`tempat_tgl` and `tempat_tgl`.`kriteria_id` = 4)) join `sub_kriteria` `umur` on(`umur`.`nilai` = `p`.`umur` and `umur`.`kriteria_id` = 5)) join `sub_kriteria` `sts_kawin` on(`sts_kawin`.`nilai` = `p`.`sts_kawin` and `sts_kawin`.`kriteria_id` = 6))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gap`
--
ALTER TABLE `gap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembobotan`
--
ALTER TABLE `pembobotan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peringkat`
--
ALTER TABLE `peringkat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mhs_id` (`mhs_id`);

--
-- Indexes for table `profil_standar2`
--
ALTER TABLE `profil_standar2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_id` (`kriteria_id`),
  ADD KEY `subkriteria_id` (`subkriteria_id`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_kriteria_ibfk_1` (`kriteria_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gap`
--
ALTER TABLE `gap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembobotan`
--
ALTER TABLE `pembobotan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peringkat`
--
ALTER TABLE `peringkat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `profil_standar2`
--
ALTER TABLE `profil_standar2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profil_standar2`
--
ALTER TABLE `profil_standar2`
  ADD CONSTRAINT `profil_standar2_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `profil_standar2_ibfk_2` FOREIGN KEY (`subkriteria_id`) REFERENCES `sub_kriteria` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
