-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2017 at 10:29 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gpdi_sulut`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gembala`
--

CREATE TABLE IF NOT EXISTS `tbl_gembala` (
  `tgem_id` int(11) NOT NULL AUTO_INCREMENT,
  `tgem_nomor_induk` varchar(30) NOT NULL,
  `tgem_nama` varchar(50) NOT NULL,
  `tgem_tgl_lahir` date NOT NULL,
  `tgem_tpt_lahir` varchar(30) NOT NULL,
  `tgem_jk` char(1) NOT NULL,
  `tgem_status_nikah` varchar(1) NOT NULL,
  `tgem_domisili` varchar(30) NOT NULL,
  `tgem_tipe` tinyint(4) NOT NULL COMMENT '1:gembala, 2:pendamping, 3:calon',
  `tgem_sk_gembala` varchar(50) NOT NULL,
  `tgem_pendidikan` varchar(30) NOT NULL,
  `tgem_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`tgem_id`),
  KEY `tgem_nomor_induk` (`tgem_nomor_induk`),
  KEY `tgem_nama` (`tgem_nama`),
  KEY `tgem_status` (`tgem_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_gembala`
--

INSERT INTO `tbl_gembala` (`tgem_id`, `tgem_nomor_induk`, `tgem_nama`, `tgem_tgl_lahir`, `tgem_tpt_lahir`, `tgem_jk`, `tgem_status_nikah`, `tgem_domisili`, `tgem_tipe`, `tgem_sk_gembala`, `tgem_pendidikan`, `tgem_status`) VALUES
(1, '', 'Pdt. Vecky Mamentu STh.', '1961-02-28', 'Tondano, Sulawesi Utara', 'L', '1', 'Desa Rerer-satu, kec. Kombi', 1, '', 'S.Th.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gereja`
--

CREATE TABLE IF NOT EXISTS `tbl_gereja` (
  `tg_id` int(11) NOT NULL AUTO_INCREMENT,
  `tg_nama` varchar(255) NOT NULL,
  `tg_lokasi` varchar(255) NOT NULL,
  `tg_tgl_berdiri` date NOT NULL,
  `tg_inventaris` text NOT NULL,
  `tg_jadwal_ibadah` text NOT NULL,
  `tgem_id` int(11) NOT NULL,
  `tw_id` int(11) NOT NULL,
  `tg_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`tg_id`),
  KEY `tg_nama` (`tg_nama`),
  KEY `tw_id` (`tw_id`),
  KEY `tgem_id` (`tgem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_gereja`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_jemaat`
--

CREATE TABLE IF NOT EXISTS `tbl_jemaat` (
  `tj_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tj_nij` varchar(25) NOT NULL,
  `tj_nama` varchar(50) NOT NULL,
  `tj_jk` varchar(1) NOT NULL,
  `tj_tgl_lahir` date NOT NULL,
  `tj_tempat_lahir` varchar(50) NOT NULL,
  `tj_no_telp` varchar(50) NOT NULL,
  `tj_domisili` varchar(50) NOT NULL,
  `tj_status_nikah` varchar(1) NOT NULL,
  `tj_pekerjaan` varchar(30) NOT NULL,
  `tj_pend_terakhir` varchar(30) NOT NULL,
  `tj_tgl_baptis` date NOT NULL,
  `tj_meninggal` date NOT NULL,
  `tj_jabatan` varchar(50) NOT NULL,
  `tj_wadah` varchar(50) NOT NULL,
  `tj_rayon` varchar(50) NOT NULL,
  `tg_id` int(11) NOT NULL,
  `tj_status` tinyint(4) NOT NULL,
  `tj_index_search` text NOT NULL,
  `tj_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tj_id`),
  KEY `tj_nij` (`tj_nij`),
  KEY `tj_nama` (`tj_nama`),
  KEY `tj_jk` (`tj_jk`),
  KEY `tj_tgl_lahir` (`tj_tgl_lahir`),
  KEY `tg_id` (`tg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_jemaat`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `tu_id` int(11) NOT NULL AUTO_INCREMENT,
  `tu_username` varchar(100) NOT NULL,
  `tu_password` varchar(100) NOT NULL,
  `tu_tipe_user` int(11) NOT NULL,
  `tu_tipe_id` int(11) NOT NULL,
  `tu_is_linked` tinyint(4) NOT NULL,
  `tu_id_linked` int(11) NOT NULL,
  `tu_display_name` varchar(50) NOT NULL,
  `tu_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`tu_id`),
  KEY `tu_username` (`tu_username`,`tu_tipe_id`,`tu_id_linked`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`tu_id`, `tu_username`, `tu_password`, `tu_tipe_user`, `tu_tipe_id`, `tu_is_linked`, `tu_id_linked`, `tu_display_name`, `tu_status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 0, 0, 'Administrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wilayah`
--

CREATE TABLE IF NOT EXISTS `tbl_wilayah` (
  `tw_id` int(11) NOT NULL AUTO_INCREMENT,
  `tw_nomor_induk` varchar(30) NOT NULL,
  `tw_nama` varchar(30) NOT NULL,
  `tw_lokasi` varchar(255) NOT NULL,
  `tw_struktur_organisasi` text NOT NULL,
  `tw_inventaris` text NOT NULL,
  `tgem_id` int(11) NOT NULL,
  `tw_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`tw_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `tbl_wilayah`
--

INSERT INTO `tbl_wilayah` (`tw_id`, `tw_nomor_induk`, `tw_nama`, `tw_lokasi`, `tw_struktur_organisasi`, `tw_inventaris`, `tgem_id`, `tw_status`) VALUES
(1, 'I', 'Wenang Tikala', '', '', '', 0, 1),
(2, 'II', 'Sario Wanea', '', '', '', 0, 1),
(3, 'III', 'Wanea', '', '', '', 0, 1),
(4, 'IV', 'Paal Dua', '', '', '', 0, 1),
(5, 'V', 'Malalayang A', '', '', '', 0, 1),
(6, 'VI', 'Malalayang B', '', '', '', 0, 1),
(7, 'VII', 'Mapanget I', '', '', '', 0, 1),
(8, 'VIII', 'Mapanget II', '', '', '', 0, 1),
(9, 'IX', 'Buha', '', '', '', 0, 1),
(10, 'X', 'Singkil', '', '', '', 0, 1),
(11, 'XI', 'Tuminting', '', '', '', 0, 1),
(12, 'XII', 'Bunaken I', '', '', '', 0, 1),
(13, 'XIII', 'Bunaken II', '', '', '', 0, 1),
(14, 'XIV', 'Bunaken ', '', '', '', 0, 1),
(15, 'XV', 'Lembeh Utara', '', '', '', 0, 1),
(16, 'XVI', 'Lembeh Selatan', '', '', '', 0, 1),
(17, 'XVII', 'Aertembaga', '', '', '', 0, 1),
(18, 'XVIII', 'Maesa', '', '', '', 0, 1),
(19, 'XIX', 'Madidir', '', '', '', 0, 1),
(20, 'XX', 'Girian', '', '', '', 0, 1),
(21, 'XXI', 'Matuari I', '', '', '', 0, 1),
(22, 'XXII', 'Matuari II', '', '', '', 0, 1),
(23, 'XXIII', 'Ranowulu I', '', '', '', 0, 1),
(24, 'XXIV', 'Ranowulu II', '', '', '', 0, 1),
(25, 'XXV', 'Kema', '', '', '', 0, 1),
(26, 'XXVI', 'Kauditan', '', '', '', 0, 1),
(27, 'XXVII', 'Airmadidi I', '', '', '', 0, 1),
(28, 'XXVIII', 'Airmadidi II', '', '', '', 0, 1),
(29, 'XXIX', 'Kalawat I', '', '', '', 0, 1),
(30, 'XXX', 'Kalawat II', '', '', '', 0, 1),
(31, 'XXXI', 'Dimembe', '', '', '', 0, 1),
(32, 'XXXII', 'Tatelu', '', '', '', 0, 1),
(33, 'XXXIII', 'Talawaan I', '', '', '', 0, 1),
(34, 'XXXIV', 'Talawaan II', '', '', '', 0, 1),
(35, 'XXXV', 'Likupang Timur', '', '', '', 0, 1),
(36, 'XXXVI', 'Likupang Selatan', '', '', '', 0, 1),
(37, 'XXXVII', 'Likupang Barat', '', '', '', 0, 1),
(38, 'XXXVIII', 'Gabata', '', '', '', 0, 1),
(39, 'XXXIX', 'Wori Utara', '', '', '', 0, 1),
(40, 'XL', 'Wori Selatan', '', '', '', 0, 1),
(41, 'XLI', 'Tombariri', '', '', '', 0, 1),
(42, 'XLII', 'Pineleng', '', '', '', 0, 1),
(43, 'XLIII', 'Pineleng ', '', '', '', 0, 1),
(44, 'XLIV', 'Tombulu', '', '', '', 0, 1),
(45, 'XLV', 'Tondano Barat', '', '', '', 0, 1),
(46, 'XLVI', 'Tondano Utara', '', '', '', 0, 1),
(47, 'XLVII', 'Tondano Timur', '', '', '', 0, 1),
(48, 'XLVIII', 'Tondano Selatan', '', '', '', 0, 1),
(49, 'XLIX', 'Eris', '', '', '', 0, 1),
(50, 'L', 'Kombi', '', '', '', 0, 1),
(51, 'LI', 'Lembean Timur', '', '', '', 0, 1),
(52, 'LII', 'Remboken', '', '', '', 0, 1),
(53, 'LIII', 'Kakas', '', '', '', 0, 1),
(54, 'LIV', 'Kakas Barat', '', '', '', 0, 1),
(55, 'LV', 'Langowan I', '', '', '', 0, 1),
(56, 'LVI', 'Langowan II', '', '', '', 0, 1),
(57, 'LVII', 'Langowan III', '', '', '', 0, 1),
(58, 'LVIII', 'Langowan IV', '', '', '', 0, 1),
(59, 'LIX', 'Tompaso', '', '', '', 0, 1),
(60, 'LX', 'Kawangkoan', '', '', '', 0, 1),
(61, 'LXI', 'Sonder', '', '', '', 0, 1),
(62, 'LXII', 'Tomohon I', '', '', '', 0, 1),
(63, 'LXIII', 'Tomohon II', '', '', '', 0, 1),
(64, 'LXIV', 'Tareran Sulta', '', '', '', 0, 1),
(65, 'LXV', 'Tumpaan', '', '', '', 0, 1),
(66, 'LXVI', 'Tatapaan', '', '', '', 0, 1),
(67, 'LXVII', 'Amurang I', '', '', '', 0, 1),
(68, 'LXVIII', 'Amurang II', '', '', '', 0, 1),
(69, 'LXIX', 'Tenga', '', '', '', 0, 1),
(70, 'LXX', 'Sinonsayang', '', '', '', 0, 1),
(71, 'LXXI', 'Kumelembuai', '', '', '', 0, 1),
(72, 'LXXII', 'Motoling', '', '', '', 0, 1),
(73, 'LXXIII', 'Ranoyapo', '', '', '', 0, 1),
(74, 'LXXIV', 'Tompaso Baru', '', '', '', 0, 1),
(75, 'LXXV', 'Maesaan', '', '', '', 0, 1),
(76, 'LXXVI', 'Modoinding', '', '', '', 0, 1),
(77, 'LXXVII', 'Toluaan', '', '', '', 0, 1),
(78, 'LXXVIII', 'Tombatu A', '', '', '', 0, 1),
(79, 'LXXIX', 'Tombatu B', '', '', '', 0, 1),
(80, 'LXXX', 'Ratahan I', '', '', '', 0, 1),
(81, 'LXXXI', 'Ratahan II', '', '', '', 0, 1),
(82, 'LXXXII', 'Belang', '', '', '', 0, 1),
(83, 'LXXXIII', 'Pusomaen', '', '', '', 0, 1),
(84, 'LXXXIV', 'Ratatotok', '', '', '', 0, 1),
(85, 'LXXXV', 'Kotabunan-', '', '', '', 0, 1),
(86, 'LXXXVI', 'Nuangan', '', '', '', 0, 1),
(87, 'LXXXVII', 'Modayag-Moat.', '', '', '', 0, 1),
(88, 'LXXXVIII', 'Kotamobagu', '', '', '', 0, 1),
(89, 'LXXXIX', 'Pinolosian', '', '', '', 0, 1),
(90, 'XC', 'Bolaang Uki', '', '', '', 0, 1),
(91, 'XCI', 'Dumoga Barat ', '', '', '', 0, 1),
(92, 'XCII', 'Dumoga Utara', '', '', '', 0, 1),
(93, 'XCIII', 'Dumoga Timur ', '', '', '', 0, 1),
(94, 'XCIV', 'Dumoga ', '', '', '', 0, 1),
(95, 'XCV', 'Lolayan', '', '', '', 0, 1),
(96, 'XCVI', 'Passi Bersatu', '', '', '', 0, 1),
(97, 'XCVII', 'Poigar', '', '', '', 0, 1),
(98, 'XCVIII', 'Bolaang Lolak', '', '', '', 0, 1),
(99, 'XCIX', 'Lolak', '', '', '', 0, 1),
(100, 'C', 'Lolak Maelang', '', '', '', 0, 1),
(101, 'CI', 'Santombolang', '', '', '', 0, 1),
(102, 'CII', 'Kaidipang Besar', '', '', '', 0, 1),
(103, 'CIII', 'Biaro', '', '', '', 0, 1),
(104, 'CIV', 'Tagulangdang I', '', '', '', 0, 1),
(105, 'CV', 'Tagulandang II', '', '', '', 0, 1),
(106, 'CVI', 'Siau I', '', '', '', 0, 1),
(107, 'CVII', 'Siau II', '', '', '', 0, 1),
(108, 'CVII', 'Tahuna Kendahe', '', '', '', 0, 1),
(109, 'CIX', 'Manganitu Utara', '', '', '', 0, 1),
(110, 'CX', 'Tamako', '', '', '', 0, 1),
(111, 'CXI', 'Manganitu Selatan', '', '', '', 0, 1),
(112, 'CXII', 'Tabukan Utara', '', '', '', 0, 1),
(113, 'CXIII', 'Tabukan Tengah', '', '', '', 0, 1),
(114, 'CXIV', 'Tabukan Selatan - ', '', '', '', 0, 1),
(115, 'CXV', 'Tabukan Selatan', '', '', '', 0, 1),
(116, 'CXVI', 'Tatoareng', '', '', '', 0, 1),
(117, 'CXVII', 'Melonguane', '', '', '', 0, 1),
(118, 'CXVIII', 'Lirung', '', '', '', 0, 1),
(119, 'CXIX', 'Kabaruan', '', '', '', 0, 1),
(120, 'CXX', 'Beo', '', '', '', 0, 1),
(121, 'CXXI', 'Rainis', '', '', '', 0, 1),
(122, 'CXXII', 'Essang', '', '', '', 0, 1),
(123, 'CXXIII', 'Gemeh-', '', '', '', 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_gereja`
--
ALTER TABLE `tbl_gereja`
  ADD CONSTRAINT `tbl_gereja_ibfk_2` FOREIGN KEY (`tgem_id`) REFERENCES `tbl_gembala` (`tgem_id`);

--
-- Constraints for table `tbl_jemaat`
--
ALTER TABLE `tbl_jemaat`
  ADD CONSTRAINT `tbl_jemaat_ibfk_1` FOREIGN KEY (`tg_id`) REFERENCES `tbl_gereja` (`tg_id`);
