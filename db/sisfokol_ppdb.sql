-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2015 at 04:45 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sisfokol_ppdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bikin_nomer`
--

CREATE TABLE IF NOT EXISTS `bikin_nomer` (
  `noid` int(50) NOT NULL AUTO_INCREMENT,
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `kd_calon` varchar(50) NOT NULL,
  `nomernya` varchar(15) NOT NULL,
  `postdate` datetime NOT NULL,
  PRIMARY KEY (`noid`),
  UNIQUE KEY `noid` (`noid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `bikin_nomer`
--

INSERT INTO `bikin_nomer` (`noid`, `kd`, `kd_tapel`, `tahun`, `kelamin`, `kd_calon`, `nomernya`, `postdate`) VALUES
(7, '499bf7af4e5e917dd30aa2b9a0b2fdb1', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '2015', 'L', 'ca8223286d8b3e00bc36d26f041daf97', '2015L007', '2015-04-30 11:13:18'),
(6, '5fd525a2e10accdf94d08dfcf564d2af', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '2015', 'L', 'db20066042d400a8eb554a1e94f6ba94', '2015L006', '2015-04-30 11:12:39'),
(5, 'af73e8b8cd13fa908f1141c29da00eab', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '2015', 'L', 'c6031f6eb788d87a22abb798ed70870d', '2015L005', '2015-04-30 10:36:22'),
(8, 'cc9b603c8213ea04f4c9a69c4195c05b', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '2015', 'P', '39fac75be8740baa2df11875485217e9', '2015P008', '2015-04-30 11:46:21'),
(9, 'a057c8cc6b6b483371dfb759cf286d33', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '2015', 'L', '9071656452244f7adfe2bd66d69e3ec3', '2015L009', '2015-04-30 21:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `psb_berita`
--

CREATE TABLE IF NOT EXISTS `psb_berita` (
  `kd` varchar(50) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` longtext NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `psb_buku_tamu`
--

CREATE TABLE IF NOT EXISTS `psb_buku_tamu` (
  `kd` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `web` varchar(255) NOT NULL,
  `komentar` longtext NOT NULL,
  `ip` varchar(20) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `psb_buku_tamu`
--

INSERT INTO `psb_buku_tamu` (`kd`, `nama`, `alamat`, `kelamin`, `email`, `web`, `komentar`, `ip`, `postdate`) VALUES
('e9ce492b8bcf6cddfc4461361a5a04ef', 'asfsaf', 'ddsg', 'L', 'sdsdg', 'fwsdfg', 'sdgdsg', '127.0.0.1', '2015-04-30 21:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `psb_info`
--

CREATE TABLE IF NOT EXISTS `psb_info` (
  `kd` varchar(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` longtext NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_info`
--

INSERT INTO `psb_info` (`kd`, `judul`, `isi`, `postdate`) VALUES
('37edd8b8e90bb85aceb2345f584b3d0b', 'Uji coba sistem....', 'Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....\r\n\r\n\r\nUji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....\r\n\r\n\r\nUji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....Uji coba sistem....', '2015-04-30 09:39:57'),
('45ca274203125a8b3a451c2bf99a26f6', 'saatnya rilis......', 'saatnya rilis......', '2015-04-30 21:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `psb_login_log`
--

CREATE TABLE IF NOT EXISTS `psb_login_log` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kd_login` varchar(50) NOT NULL,
  `url_inputan` varchar(255) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_login_log`
--

INSERT INTO `psb_login_log` (`kd`, `kd_tapel`, `kd_login`, `url_inputan`, `postdate`) VALUES
('371f9c10fa0252e2d88095e8b7a0adb1', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', 'Login Administrator : admin', '2015-04-29 12:20:39'),
('5ab5afda04cb786a5c678426fbf8b04a', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', 'Login Administrator : admin', '2015-04-29 12:22:05'),
('b30fd4eefa059ce64cb30c685e6e308f', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Set Aktif Seleksi [EDIT DATA]', '2015-04-29 12:22:17'),
('48130cf6d97c8c387bd3cdd768b4ddb9', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Set Aktif Seleksi [EDIT DATA]', '2015-04-29 12:22:20'),
('2c3c9bb1bc7cccef51cf74de355e186c', '9e18f123302d9dbce1c466a274d95c69', 'c4ca4238a0b923820dcc509a6f75849b', 'Login Administrator : admin', '2015-04-30 09:34:46'),
('ad452abcd244b380add363bcb9036bd3', '9e18f123302d9dbce1c466a274d95c69', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Set Aktif Seleksi [EDIT DATA]', '2015-04-30 09:34:53'),
('67931ff3ea5c9d52cfc3a7d9ae01aef0', '9e18f123302d9dbce1c466a274d95c69', 'c4ca4238a0b923820dcc509a6f75849b', 'Data Info  [Administrator] [EDIT DATA]', '2015-04-30 09:39:57'),
('ef05edfa716caabb0ffb8079e4e17036', '9e18f123302d9dbce1c466a274d95c69', 'c4ca4238a0b923820dcc509a6f75849b', 'Login Administrator : admin', '2015-04-30 09:45:50'),
('607a375b099d83648a0356a9fb66b388', '9e18f123302d9dbce1c466a274d95c69', 'c4ca4238a0b923820dcc509a6f75849b', 'Buku Tamu  [Administrator] [HAPUS DATA]', '2015-04-30 09:45:59'),
('bd9ee5a61876b91e44b5ddf5cd39cf56', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Pelajaran Raport [EDIT DATA]', '2015-04-30 09:59:29'),
('2e2e919e605a5be7a7e017be6bd59468', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Pelajaran Raport [EDIT DATA]', '2015-04-30 09:59:34'),
('dfe0d2f8b37259013ebd6161a320761c', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Pelajaran Raport [EDIT DATA]', '2015-04-30 09:59:37'),
('fba654bb6409cb6627a23f5b766d2ee2', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Pelajaran Raport [HAPUS DATA]', '2015-04-30 09:59:47'),
('c70c21e73f66087bb8233f307bf9bbd3', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Pelajaran Raport [EDIT DATA]', '2015-04-30 10:00:11'),
('cd684e36e670a94a27d38b19d3a2bfa4', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Pelajaran Raport [EDIT DATA]', '2015-04-30 10:00:18'),
('498e2d495bc1f4dbe40040e55fd37f3f', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Pelajaran Raport [EDIT DATA]', '2015-04-30 10:00:25'),
('5bf5c70d2e8e50420a257b52585f226d', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Pelajaran UN [EDIT DATA]', '2015-04-30 10:02:37'),
('454848fa56e0eb6476338caf8bb2f0c8', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Pelajaran UN [EDIT DATA]', '2015-04-30 10:02:41'),
('362da57471d821a1f505bb41a38e4083', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Pelajaran UN [HAPUS DATA]', '2015-04-30 10:02:44'),
('7c57acc8854e78732543e7a01318cf64', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', 'Login Administrator : admin', '2015-04-30 10:17:53'),
('5bcb7532a36f146287486066eef1f520', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', 'Login Administrator : admin', '2015-04-30 11:47:37'),
('b720db2e57f5edddeb1454e108b835e6', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Diri... [EDIT DATA]', '2015-04-30 11:49:10'),
('68e2c99bf551516b8c3fabb2cc677cf1', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Diri... [EDIT DATA]', '2015-04-30 11:52:45'),
('2f3abe0ece67d0d3b3fd75a66e85e367', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Diri... [EDIT DATA]', '2015-04-30 11:52:50'),
('8b8a1889d3b71b6c7c4fee11407d60e3', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Diri... [EDIT DATA]', '2015-04-30 11:52:57'),
('80bfff114f440ba39c46a5efd8bc1c77', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Diri... [EDIT DATA]', '2015-04-30 11:53:04'),
('ff59339a68d026ec14d829279af2463c', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', 'Login Administrator : admin', '2015-04-30 13:20:14'),
('7c52e062e8f8faa3a7174470ee5f2588', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:20:45'),
('0bb2aeb5d6a823f4799b015e43b5c9e3', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:23:41'),
('f78191b4fed2015a2ad025021a40de0e', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:23:51'),
('2713e6f6934b30d6bb6f62603a4c433c', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:23:51'),
('d990dd9bc0c6dbfd1e2c46f0c8793060', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:23:52'),
('bb81d31df63489d774998c38231a40b5', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:24:54'),
('99c3410bb8d6e6eadd515e9e06bf8de1', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:27:14'),
('bd50f143d2b7f6a018995a0f8937f6bf', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:30:04'),
('db40e6f7f8fdfc4198699f563230af1e', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:30:06'),
('80e6c723864482232b51516222288649', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:30:07'),
('95339052e20ebb573d1825f48483f5dc', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:30:08'),
('3d77c35ba561297649d813206d5856ab', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:30:09'),
('0807b800de9bd96e9032e54b90711482', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:30:10'),
('0bc52c39c41ea8da7d4e932ca2df32f6', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:30:11'),
('db61a11c3e2904e07677d7f886367bca', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:30:12'),
('062b89697b137c3a05c45c6f7a7e613d', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:31:02'),
('8fb561f288150ffa13c0da7bfe8113a7', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:34:17'),
('952525976a3fe5df5c76a29ee780780c', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:34:18'),
('a06376bf94dc39c41f5119014e6f7858', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:34:19'),
('d215dc27794e2d9362499369aeb85c94', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:34:22'),
('016899fbb050acf583cf7330aaac08c0', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:34:22'),
('02a1f71a222c268077caf5c807650bc8', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:41'),
('e01c42c93d87fdee90ffd9d0a64bd606', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:43'),
('cf43684eb3064215b44256813fc5e4a5', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:44'),
('78d4a2edf7aac2c32efafe7c735b16d0', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:45'),
('17fc11310ca42b943a0bfc35395bcd18', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:46'),
('e183df6f69875609005d1ff26bd38356', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:47'),
('77ee91142706af4ae3d3f2f888990039', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:47'),
('ad3d79b253abd529f2f9e851ab6ab25d', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:48'),
('b6d4e0313051caee2367799a23b80fc0', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:49'),
('09e02e9a30b179fccf1d37d4b6876c90', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:49'),
('81f47cc13b8138e476305b861454c3d8', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:50'),
('028286406ef9f510b51cbf0fefe03f40', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:51'),
('f105fad2e8fa57cb69267f54958f2bb8', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:52'),
('af23628534eb282dbfabe292b8c5874d', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:52'),
('6802eedeccd212084d2f82de6dd5f9be', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:34:59'),
('0619d4e2b95e032b4737d3afc40a390e', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:35:00'),
('15a63b4af8973a72469fa48502dff029', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:35:01'),
('69bebf1933e4d77d95c22656f7651d69', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:35:01'),
('f493ef15e9c052102066bbfd59af85c0', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Nilai Prestasi [EDIT DATA]', '2015-04-30 13:36:35'),
('8645c192effaf76deb2884979075a6f0', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Nilai Prestasi [EDIT DATA]', '2015-04-30 13:42:47'),
('62e445f1e307ff83609b5a5719503b35', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Nilai Prestasi [EDIT DATA]', '2015-04-30 13:44:12'),
('c766ed4e16ca2a227ccf84ea4875f69c', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Nilai Prestasi [EDIT DATA]', '2015-04-30 13:44:13'),
('d102c5021cd7aa0c67ff49a0513cce2e', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Sertifikat [EDIT DATA]', '2015-04-30 13:47:02'),
('9e75421d27c30fec5df7950ed52a8a67', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Sertifikat [EDIT DATA]', '2015-04-30 13:48:57'),
('527c128d00d4b7dd8d7a810d590426d2', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Sertifikat [EDIT DATA]', '2015-04-30 13:48:58'),
('484a48b1fca1d8b992f78c3fd25ecb79', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:49:13'),
('22a8631a38eabaa4e40adeae9763922a', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 13:50:26'),
('56f7a6af017a502b9b6e17ee2e62762b', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 13:55:42'),
('9b38e8fa9b178a23477130897e461bc9', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', 'Login Administrator : admin', '2015-04-30 20:36:42'),
('56772d94e476ac7edc37c5ae6b01f880', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '68778a0bc9cb79f88ba2e615755200b4', 'Login Petugas Pendaftaran : agus', '2015-04-30 20:46:00'),
('bcd868aec76e7f2e37beba6fa9893cd2', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '68778a0bc9cb79f88ba2e615755200b4', '[Petugas Pendaftaran : agus] ==> Ganti Password [EDIT DATA]', '2015-04-30 20:47:59'),
('cbbf55da57aab86808a6dcf062cdc52e', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '68778a0bc9cb79f88ba2e615755200b4', 'Login Petugas Pendaftaran : agus', '2015-04-30 20:48:12'),
('2d9c9686d58d51a64cf1095c2c8d6b7c', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '68778a0bc9cb79f88ba2e615755200b4', '[Petugas Pendaftaran : agus] ==> Ganti Password [EDIT DATA]', '2015-04-30 20:48:22'),
('d1b7951a47050e458603a1d28cdd34ac', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '68778a0bc9cb79f88ba2e615755200b4', '[Petugas Pendaftaran : agus] ==> Data Diri... [EDIT DATA]', '2015-04-30 20:54:01'),
('128f4e583b0dd08c2d7380d4293b6e7a', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Nilai Prestasi [EDIT DATA]', '2015-04-30 20:56:51'),
('a81cd5f48d2bde0d5a86a40f416a4fd7', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Sertifikat [EDIT DATA]', '2015-04-30 20:57:40'),
('35d0509f14c348f20d991062df739071', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 20:58:31'),
('80c5b3d23b85bbadc77ffabbe3a1e2e6', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 20:58:36'),
('20b6bad23ca54a33cf6b04ac4a24f93c', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 20:58:47'),
('96526d401f51d32b43cd8f9dbf2f8be0', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 20:58:48'),
('7ed89316f4727c7373476d1a175a20fe', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 20:58:50'),
('371ebcdcfedd3588aba38e485a2f44f0', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 20:58:51'),
('a2b6af6f6023f9f1b0f5c41f7000a7e2', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 20:58:52'),
('971668da0483301d2958eacc883fd79a', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 20:58:52'),
('ef3f736e69a2325c0268af7adcf3f741', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 20:58:54'),
('b485d0a14824f9d297842c1466545d8a', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 20:58:55'),
('c40ef589217a12285a72d3f50672dc99', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai Tertulis [EDIT DATA]', '2015-04-30 20:58:57'),
('f20cc455f1fdab35a5b30bc0a2ed544d', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 20:59:55'),
('5f762c4df4c5a33a7f40e7a8683eae94', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 20:59:55'),
('bd8b6e26ec4a02a285acd9ffd1c9e3c0', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '[Petugas Pendaftaran : agus] ==> Calon : Nilai UN [EDIT DATA]', '2015-04-30 20:59:56'),
('e24fd1f03b04c667566681c23f8af207', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'ea3d3b57d7e9a5e3eda704919ebf5bb8', 'Login Petugas Berkas : hajir', '2015-04-30 21:00:54'),
('26e7de39f91b4ee4ca87ccee1ffb7ef1', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'ea3d3b57d7e9a5e3eda704919ebf5bb8', '[Petugas Berkas : hajir] ==> Nilai-Nilai [EDIT DATA]', '2015-04-30 21:05:28'),
('ac72982c362597c6247cd638afb5bf06', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '58830a68020be11255f56d04f902bdbd', 'Login Petugas Tes Fisik : muhajir', '2015-04-30 21:13:50'),
('1062f541c15799797ca8df11ff39b3b0', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '58830a68020be11255f56d04f902bdbd', '[Petugas Tes Fisik : muhajir] ==> Calon : Nilai Fisik [EDIT DATA]', '2015-04-30 21:14:18'),
('142f10e9cd3f91f6c544bba0a141bc6f', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '58830a68020be11255f56d04f902bdbd', 'Login Petugas Tes Fisik : muhajir', '2015-04-30 21:15:47'),
('24a14e58ea7f7315875f24c7815a311d', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', 'Login Administrator : admin', '2015-04-30 21:33:08'),
('bdae8fa646c29e59bfa3aaba63101129', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', 'Login Administrator : admin', '2015-04-30 21:36:00'),
('94c230ca921cc5d6d66c0387030d29b6', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', 'Data Info  [Administrator] [EDIT DATA]', '2015-04-30 21:36:15'),
('42811e48e1a9fb81cde60eed515cca98', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', 'Login Administrator : admin', '2015-04-30 21:40:47'),
('7eed54b16e2cb969f463faf54c5b4307', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Mata Pelajaran Ujian Tertulis [HAPUS DATA]', '2015-04-30 21:42:21'),
('ba33c21747531eccf451b1c4fe1a0b18', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'c4ca4238a0b923820dcc509a6f75849b', '[Administrator] ==> Data Mata Pelajaran Ujian Tertulis [EDIT DATA]', '2015-04-30 21:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `psb_m_dayatampung`
--

CREATE TABLE IF NOT EXISTS `psb_m_dayatampung` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `daya_tampung` varchar(5) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `psb_m_dayatampung`
--

INSERT INTO `psb_m_dayatampung` (`kd`, `kd_tapel`, `daya_tampung`, `postdate`) VALUES
('2fa6e82c9cfc51367cd4aa1d20765d43', '', '100', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `psb_m_login`
--

CREATE TABLE IF NOT EXISTS `psb_m_login` (
  `kd` varchar(50) NOT NULL,
  `usernamex` varchar(50) NOT NULL,
  `passwordx` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` varchar(1) NOT NULL,
  `postdate` datetime NOT NULL,
  PRIMARY KEY (`kd`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `psb_m_login`
--

INSERT INTO `psb_m_login` (`kd`, `usernamex`, `passwordx`, `nama`, `level`, `postdate`) VALUES
('c4ca4238a0b923820dcc509a6f75849b', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '1', '0000-00-00 00:00:00'),
('68778a0bc9cb79f88ba2e615755200b4', 'agus', 'fdf169558242ee051cca1479770ebac3', 'agus', '2', '2015-04-30 20:40:59'),
('58830a68020be11255f56d04f902bdbd', 'muhajir', '63fa0e1362986699466e346c284cf288', 'muhajir', '3', '2015-04-30 20:41:10'),
('ea3d3b57d7e9a5e3eda704919ebf5bb8', 'hajir', '625198080f3e1e8fb9d1ddd0650bd611', 'hajir', '6', '2015-04-30 20:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `psb_m_mapel`
--

CREATE TABLE IF NOT EXISTS `psb_m_mapel` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `bobot` varchar(5) NOT NULL,
  PRIMARY KEY (`kd`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_m_mapel`
--

INSERT INTO `psb_m_mapel` (`kd`, `kd_tapel`, `no`, `mapel`, `bobot`) VALUES
('e5c60641b729790bbe3bc4f25cc9537d', 'e317bf20e873858cd24f0be85faa6706', '1', 'Matematika', '5'),
('5da313f869d5d66a6d87bb9bea816481', 'e317bf20e873858cd24f0be85faa6706', '2', 'B.Inggris', '3'),
('c1569b80268614e65be71498ef60bc84', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '3', 'Matematika', '5'),
('fbdcbdb61e4506f73620edeccc2b82b9', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '2', 'B.Inggris', '3'),
('675457d9163ca653206b8ac4de965c71', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '4', 'IPA', '2'),
('0510cf929b06cfd350b5a942eaa33b26', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '1', 'B.Indonesia', '2');

-- --------------------------------------------------------

--
-- Table structure for table `psb_m_mapel2`
--

CREATE TABLE IF NOT EXISTS `psb_m_mapel2` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `bobot` varchar(5) NOT NULL,
  PRIMARY KEY (`kd`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_m_mapel2`
--

INSERT INTO `psb_m_mapel2` (`kd`, `kd_tapel`, `no`, `mapel`, `bobot`) VALUES
('90286307e7202c3707ebc9799a8d55be', 'e317bf20e873858cd24f0be85faa6706', '2', 'B.Inggris', ''),
('62708e5fe701b0b8a85776e6609b6aa9', 'e317bf20e873858cd24f0be85faa6706', '1', 'Matematika', ''),
('edff1882267bb68b8d58499a7895d869', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '01', 'Matematika', '3'),
('f7ada06eb300ffa0ba896a528ade2f7e', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '02', 'Bahasa Inggris', '5'),
('ba33c21747531eccf451b1c4fe1a0b18', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '03', 'TIK', '2'),
('498e2d495bc1f4dbe40040e55fd37f3f', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '04', 'IPA', '5');

-- --------------------------------------------------------

--
-- Table structure for table `psb_m_prestasi`
--

CREATE TABLE IF NOT EXISTS `psb_m_prestasi` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `skor` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_m_prestasi`
--

INSERT INTO `psb_m_prestasi` (`kd`, `kd_tapel`, `kode`, `nama`, `ket`, `skor`) VALUES
('5cec0ca0dcd69b1a957b15bcab9c27f0', 'e317bf20e873858cd24f0be85faa6706', 'TK06', 'Juara Tingkat KotaxgmringxKabupatenxgmringxKaresidenan', 'Juara 3', '1.25'),
('8114b7d183d6de425028eb4eafe78494', 'e317bf20e873858cd24f0be85faa6706', 'TK07', 'Juara Tingkat Kecamatan', 'Juara 1', '1.00'),
('6c300ce2edb798185874add071f08dc6', 'e317bf20e873858cd24f0be85faa6706', 'TK05', 'Juara Tingkat KotaxgmringxKabupatenxgmringxKaresidenan', 'Juara 2', '1.50'),
('0943e365bfcbca4d10ef50a0be2a17c9', 'e317bf20e873858cd24f0be85faa6706', 'TK04', 'Juara Tingkat KotaxgmringxKabupatenxgmringxKaresidenan', 'Juara 1', '1.75'),
('f36944303391e8c509c50eac9440ad74', 'e317bf20e873858cd24f0be85faa6706', 'TK01', 'Juara Tingkat InternasionalxgmringxNasionalxgmringxPropinsi', 'Juara 1', '2'),
('ae7f530f2e6642f186c98d58fca1716a', 'e317bf20e873858cd24f0be85faa6706', 'TK02', 'Juara Tingkat InternasionalxgmringxNasionalxgmringxPropinsi', 'Juara 2', '2'),
('466616242eb3fc2a0f6652a61ba2bc28', 'e317bf20e873858cd24f0be85faa6706', 'TK03', 'Juara Tingkat InternasionalxgmringxNasionalxgmringxPropinsi', 'Juara 3', '2'),
('5f3269c4eb2c740420ed4c008b58487e', 'e317bf20e873858cd24f0be85faa6706', 'TK08', 'Juara Tingkat Kecamatan', 'Juara 2', '0.75'),
('63c4427a58f679782dea396340e1568f', 'e317bf20e873858cd24f0be85faa6706', 'TK09', 'Juara Tingkat Kecamatan', 'Juara 3', '0.50'),
('d2a04af1d22de08a932890ef5f1d7757', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'krs', 'Beginner', 'Kursus Bahasa Inggris', '0,5'),
('d33fc8dba3f1ec093c99c7d0115d9e17', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'krs2', 'elementary', 'Kursus Bahasa Inggris', '1'),
('e1edb6512297adf6ea7b992dd6b3fdc3', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'krs3', 'intermediate', 'Kursus Bahasa Inggris', '1,5'),
('28ad5f192918f6e04da5d7b177c68c50', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'krs4', 'advance', 'Kursus Bahasa Inggris', '2'),
('afb513d3a3a0fdb6a8fa3c192ccf856f', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'akd', 'Juara 1 Int,Nas dan Propinsi', 'Prestasi Akademin dan Non Akademik', '10'),
('d177181253ab7c3f84ed418d7d2f18f6', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'akd2', 'Juara 2 Int,Nas dan Propinsi', 'Prestasi Akademin dan Non Akademik', '10'),
('0a1b7062f69dbd550eb49ca1b7994e1a', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'akd3', 'Juara 3 Int,Nas dan Propinsi', 'Prestasi Akademin dan Non Akademik', '10'),
('5c88517d8d16d52d7ed7c578b0f70d16', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'kab1', 'Juara 1 Kars atau Kabupaten', 'Prestasi Akademik dan Non Akademik', '1,75'),
('30d294bfa9a5fed9b8eb1d35cff767e3', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'kab2', 'Juara 2 Kars atau Kabupaten', 'Prestasi Akademik dan Non Akademik', '1,5'),
('09d774cbff9ab992e478f3442912c945', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'kab3', 'Juara 3 Kars atau Kabupaten', 'Prestasi Akademik dan Non Akademik', '1,25'),
('f855c0d2172832bda066fc34ae051d74', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'kec', 'Juara 1 Kecamatan', 'Prestasi Akademik dan Non Akademik', '1'),
('dabe01c487b2c2ecbd6ef6bc8ccf11b7', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'kec2', 'Juara 2 Kecamatan', 'Prestasi Akademik dan Non Akademik', '0,75'),
('9946f764ca58a3f046964b9f18b9d6ed', '3e51bc44ebc2e59849fa0e2ff8d3ed12', 'kec3', 'Juara 3 Kecamatan', 'Prestasi Akademik dan Non Akademik', '0,5'),
('a49bea6109b202fed1e148667ff80088', '', '1.1', 'Juara 1 Tk. Internasional', 'Langsung diterima', '10'),
('fac7ce6a6a76224347201a2fdb3eee7d', '', '1.2', 'Juara 2 Internasional', 'Langsung diterima', '10'),
('113c88268c5f0782d01267e1982fee46', '', '1.3', 'Juara 3 Internasional', 'Langsung diterima', '10'),
('67df9f9a987fd3a2c8dc7e33bbb8e80d', '', '2.1', 'Juara 1 Nasional', 'Langsung diterima', '10'),
('a8eefee0c31b09dd9f448b6d4f5311ac', '', '2.2', 'Juara 2 Nasional', '', '4'),
('b3ec4a1281d822903362ef3b62c711da', '', '2.3', 'Juara 3 Nasional', '', '3'),
('1360415bcedbf37e99ae56dc92666f3b', '', '3.1', 'Juara 1 Propinsi', '', '3'),
('cedf8d0a41c9b99dec465e2b330c8e4e', '', '3.2', 'Juara 2 Propinsi', '', '2,75'),
('fcb5954f5d96cc35db1f051f7a196c61', '', '3.3', 'Juara 3 Propinsi', '', '2,50'),
('fe07ae1c9b1e9d895bb2d36267f9e1f2', '', '4.1', 'Juara 1 KabupatenxstrixKota', '', '1,50'),
('4e2ff9168668f9b204a23a2c7c75f8fe', '', '4.2', 'Juara 2 KabupatenxstrixKota', '', '1,25'),
('7b060829195202a285390fe3d002906c', '', '4.3', 'Juara 3 KabiupatenxstrixKota', '', '1,00'),
('79d1590906d73dd10748562088a88d3c', '', '5.1', 'Juara 1 Kecamatan', '', '0,75'),
('d1487508d5d0b5ef3db2e9d38be6b8f1', '', '5.2', 'Juara 2 Kecamatan', '', '0,50'),
('e0a28c38bc54cafa7cc3669a56239d24', '', '5.3', 'Juara 3 Kecamatan', '', '0,25');

-- --------------------------------------------------------

--
-- Table structure for table `psb_m_rumus`
--

CREATE TABLE IF NOT EXISTS `psb_m_rumus` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `persen_tertulis` varchar(5) NOT NULL,
  `persen_prestasi` varchar(5) NOT NULL,
  `persen_sertifikat` varchar(5) NOT NULL,
  `persen_un` varchar(5) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_m_rumus`
--

INSERT INTO `psb_m_rumus` (`kd`, `kd_tapel`, `persen_tertulis`, `persen_prestasi`, `persen_sertifikat`, `persen_un`, `postdate`) VALUES
('b2fa06dd0f6b980c1da50414ba99ec93', 'e317bf20e873858cd24f0be85faa6706', '50', '20', '', '', '2013-05-21 07:38:37'),
('91c9962a77d844248dc867cc46c9fbcd', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '20', '30', '10', '40', '2015-04-30 21:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `psb_m_sertifikat`
--

CREATE TABLE IF NOT EXISTS `psb_m_sertifikat` (
  `kd` varchar(50) NOT NULL,
  `no` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_m_sertifikat`
--

INSERT INTO `psb_m_sertifikat` (`kd`, `no`, `nama`) VALUES
('c4ca4238a0b923820dcc509a6f75849b', '1', 'Kejuaraan'),
('c81e728d9d4c2f636f067f89cc14862c', '2', 'Bahasa Inggris');

-- --------------------------------------------------------

--
-- Table structure for table `psb_m_tapel`
--

CREATE TABLE IF NOT EXISTS `psb_m_tapel` (
  `kd` varchar(50) NOT NULL,
  `tahun1` varchar(4) NOT NULL,
  `tahun2` varchar(4) NOT NULL,
  `status` enum('true','false') NOT NULL DEFAULT 'false',
  `biaya` varchar(15) NOT NULL,
  `dayatampung` varchar(5) NOT NULL,
  `postdate` datetime NOT NULL,
  PRIMARY KEY (`kd`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_m_tapel`
--

INSERT INTO `psb_m_tapel` (`kd`, `tahun1`, `tahun2`, `status`, `biaya`, `dayatampung`, `postdate`) VALUES
('3e51bc44ebc2e59849fa0e2ff8d3ed12', '2015', '2016', 'true', '50000', '100', '0000-00-00 00:00:00'),
('deb04a0072839922633c9b89df007b5c', '2016', '2017', 'false', '100000', '100', '2015-04-30 09:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `psb_set_seleksi`
--

CREATE TABLE IF NOT EXISTS `psb_set_seleksi` (
  `kd` varchar(50) NOT NULL,
  `seleksi` enum('true','false') NOT NULL DEFAULT 'false',
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `psb_set_seleksi`
--

INSERT INTO `psb_set_seleksi` (`kd`, `seleksi`, `postdate`) VALUES
('3ed80c52533d267c5b89eae123837f4b', 'false', '2015-04-30 09:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `psb_siswa_calon`
--

CREATE TABLE IF NOT EXISTS `psb_siswa_calon` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `no_urut` varchar(20) NOT NULL,
  `no_daftar` varchar(20) NOT NULL,
  `no_tes` varchar(50) NOT NULL,
  `no_loket` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tmp_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(1000) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `nama_ayah` varchar(30) NOT NULL,
  `alamat_ayah` varchar(100) NOT NULL,
  `kerja_ayah` varchar(20) NOT NULL,
  `nama_wali` varchar(30) NOT NULL,
  `alamat_wali` varchar(100) NOT NULL,
  `kerja_wali` varchar(20) NOT NULL,
  `asal_sekolah` varchar(30) NOT NULL,
  `status_sekolah` varchar(20) NOT NULL,
  `alamat_sekolah` varchar(100) NOT NULL,
  `no_sttb` varchar(20) NOT NULL,
  `tahun_lulus` varchar(4) NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `jml_bayar` varchar(10) NOT NULL,
  `status_daftar` enum('true','false') NOT NULL DEFAULT 'false',
  `status_diterima` enum('true','false') NOT NULL DEFAULT 'false',
  `postdate` datetime NOT NULL,
  `tes_fisik` enum('true','false') NOT NULL DEFAULT 'false',
  `pengembalian` enum('true','false') NOT NULL DEFAULT 'false',
  `tb` varchar(5) NOT NULL,
  `bb` varchar(5) NOT NULL,
  `usernamex` varchar(50) NOT NULL,
  `passwordx` varchar(50) NOT NULL,
  `telp_ayah` varchar(100) NOT NULL,
  `telp_wali` varchar(100) NOT NULL,
  `status_diterima2` enum('true','false') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`kd`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `psb_siswa_calon`
--

INSERT INTO `psb_siswa_calon` (`kd`, `kd_tapel`, `no_urut`, `no_daftar`, `no_tes`, `no_loket`, `nama`, `tmp_lahir`, `tgl_lahir`, `alamat`, `kelamin`, `agama`, `telp`, `nama_ayah`, `alamat_ayah`, `kerja_ayah`, `nama_wali`, `alamat_wali`, `kerja_wali`, `asal_sekolah`, `status_sekolah`, `alamat_sekolah`, `no_sttb`, `tahun_lulus`, `tgl_daftar`, `tgl_bayar`, `jml_bayar`, `status_daftar`, `status_diterima`, `postdate`, `tes_fisik`, `pengembalian`, `tb`, `bb`, `usernamex`, `passwordx`, `telp_ayah`, `telp_wali`, `status_diterima2`) VALUES
('c6031f6eb788d87a22abb798ed70870d', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '5', '2015L005', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2015-04-30 10:36:22', '0000-00-00 00:00:00', '', 'false', 'false', '2015-04-30 10:36:22', 'false', 'false', '', '', '', '', '', '', 'false'),
('db20066042d400a8eb554a1e94f6ba94', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '6', '2015L006', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2015-04-30 11:12:39', '0000-00-00 00:00:00', '', 'false', 'false', '2015-04-30 11:12:39', 'false', 'false', '', '', '', '', '', '', 'false'),
('ca8223286d8b3e00bc36d26f041daf97', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '7', '2015L007', '', '', '7', '7', '2015-04-14', '7', 'L', 'Islam', '7', '7', '7', 'TNIxgmringxPOLRI', '7', '7', 'TNIxgmringxPOLRI', '7', 'Swasta', '7', '', '7', '2015-04-30 11:35:25', '0000-00-00 00:00:00', '', 'false', 'false', '2015-04-30 11:35:04', 'false', 'true', '7', '7', '2015L007', 'a4fbcd0b6224da9a8ebebc8577728f08', '', '', 'false'),
('39fac75be8740baa2df11875485217e9', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '8', '2015P008', '', '', 'u', 'u', '2015-04-07', '8xxxxx', 'P', 'Islam', '8xxxx', '8xx', '8', 'TNIxgmringxPOLRI', '8', '8', 'TNIxgmringxPOLRI', '8', 'Swasta', '8', '', '8', '2015-04-30 11:46:56', '0000-00-00 00:00:00', '', 'false', 'true', '2015-04-30 11:46:23', 'true', 'false', '8', '8', '2015P008', '874a195c135e72fb23a312661777fb1b', '', '', 'false'),
('9071656452244f7adfe2bd66d69e3ec3', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '9', '2015L009', '', '', '76', '76', '2015-04-16', 'kendal', 'L', 'Islam', '0818298854', 'xstrix', 'xstrix', 'Swasta', 'xstrix', 'xstrix', 'TNIxgmringxPOLRI', 'xstrix', 'Negeri', 'xstrix', '', '1998', '2015-04-30 21:38:01', '0000-00-00 00:00:00', '', 'false', 'false', '2015-04-30 21:37:06', 'false', 'false', '176', '67', '2015L009', 'c2e01a5d2f9ba5b40abaa87459ef63f6', '', '', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `psb_siswa_calon_fisik`
--

CREATE TABLE IF NOT EXISTS `psb_siswa_calon_fisik` (
  `kd` varchar(50) NOT NULL,
  `kd_siswa_calon` varchar(50) NOT NULL,
  `nilai` enum('true','false') NOT NULL DEFAULT 'false',
  `tinggi_badan` enum('true','false') NOT NULL DEFAULT 'true',
  `tindik_tatto` enum('true','false') NOT NULL DEFAULT 'false',
  `buta_warna` enum('true','false') NOT NULL DEFAULT 'false',
  `cacat_fisik` enum('true','false') NOT NULL DEFAULT 'false',
  `penampilan` enum('true','false') NOT NULL DEFAULT 'true',
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_siswa_calon_fisik`
--

INSERT INTO `psb_siswa_calon_fisik` (`kd`, `kd_siswa_calon`, `nilai`, `tinggi_badan`, `tindik_tatto`, `buta_warna`, `cacat_fisik`, `penampilan`, `postdate`) VALUES
('1062f541c15799797ca8df11ff39b3b0', '39fac75be8740baa2df11875485217e9', 'true', 'true', 'true', 'true', 'true', 'true', '2015-04-30 21:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `psb_siswa_calon_prestasi`
--

CREATE TABLE IF NOT EXISTS `psb_siswa_calon_prestasi` (
  `kd` varchar(50) NOT NULL,
  `kd_siswa_calon` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `kd_prestasi` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `postdate` datetime NOT NULL,
  `nilai` varchar(5) NOT NULL,
  `total` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_siswa_calon_prestasi`
--

INSERT INTO `psb_siswa_calon_prestasi` (`kd`, `kd_siswa_calon`, `no`, `kd_prestasi`, `nama`, `postdate`, `nilai`, `total`) VALUES
('f493ef15e9c052102066bbfd59af85c0', '39fac75be8740baa2df11875485217e9', '1', 'd177181253ab7c3f84ed418d7d2f18f6', 'xstrix', '2015-04-30 20:56:51', '10', '10'),
('f493ef15e9c052102066bbfd59af85c0', '39fac75be8740baa2df11875485217e9', '2', '0a1b7062f69dbd550eb49ca1b7994e1a', 'xstrix', '2015-04-30 20:56:51', '10', '10'),
('f493ef15e9c052102066bbfd59af85c0', '39fac75be8740baa2df11875485217e9', '3', 'f855c0d2172832bda066fc34ae051d74', 'xstrix', '2015-04-30 20:56:51', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `psb_siswa_calon_rangking`
--

CREATE TABLE IF NOT EXISTS `psb_siswa_calon_rangking` (
  `kd` varchar(50) NOT NULL,
  `kd_tapel` varchar(50) NOT NULL,
  `no` varchar(5) NOT NULL,
  `kd_siswa_calon` varchar(50) NOT NULL,
  `nil_fisik` varchar(5) NOT NULL,
  `nil_un` varchar(5) NOT NULL,
  `nil_tertulis` varchar(5) NOT NULL,
  `nil_prestasi` varchar(5) NOT NULL,
  `nil_sertifikat` varchar(5) NOT NULL,
  `total` varchar(5) NOT NULL,
  `rata` varchar(5) NOT NULL,
  `status` enum('true','false') NOT NULL DEFAULT 'false',
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `psb_siswa_calon_rangking`
--

INSERT INTO `psb_siswa_calon_rangking` (`kd`, `kd_tapel`, `no`, `kd_siswa_calon`, `nil_fisik`, `nil_un`, `nil_tertulis`, `nil_prestasi`, `nil_sertifikat`, `total`, `rata`, `status`, `postdate`) VALUES
('17fe5635902c50a2d818fd68d82c7d68', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '2', 'ca8223286d8b3e00bc36d26f041daf97', 'false', '36.96', '0', '0', '1.54', '107.8', '38.5', 'false', '2015-04-30 21:44:45'),
('acf87bb2a672303266c859f9f3ae2fb2', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '1', '39fac75be8740baa2df11875485217e9', 'true', '42.24', '7.46', '6.3', '1.76', '181.5', '57.76', 'false', '2015-04-30 21:44:45'),
('e462b8fad27bce4eb6533fbbb6e06a34', '3e51bc44ebc2e59849fa0e2ff8d3ed12', '', '9071656452244f7adfe2bd66d69e3ec3', 'false', '35.12', '0', '0', '1.32', '101', '36.44', 'false', '2015-04-30 21:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `psb_siswa_calon_sertifikat`
--

CREATE TABLE IF NOT EXISTS `psb_siswa_calon_sertifikat` (
  `kd` varchar(50) NOT NULL,
  `kd_siswa_calon` varchar(50) NOT NULL,
  `kd_sertifikat` varchar(50) NOT NULL,
  `nilai` varchar(10) NOT NULL,
  `postdate` datetime NOT NULL,
  `total` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_siswa_calon_sertifikat`
--

INSERT INTO `psb_siswa_calon_sertifikat` (`kd`, `kd_siswa_calon`, `kd_sertifikat`, `nilai`, `postdate`, `total`) VALUES
('58ef738471cf1f068faa1d8a1ded988b', 'ca8223286d8b3e00bc36d26f041daf97', 'c4ca4238a0b923820dcc509a6f75849b', '07.70', '2015-04-30 11:35:25', ''),
('58ef738471cf1f068faa1d8a1ded988b', 'ca8223286d8b3e00bc36d26f041daf97', 'c81e728d9d4c2f636f067f89cc14862c', '07.70', '2015-04-30 11:35:25', ''),
('aabc3e91c5976c18c0da5e029a3fce16', '39fac75be8740baa2df11875485217e9', 'c4ca4238a0b923820dcc509a6f75849b', '08.80', '2015-04-30 20:57:40', '08.80'),
('aabc3e91c5976c18c0da5e029a3fce16', '39fac75be8740baa2df11875485217e9', 'c81e728d9d4c2f636f067f89cc14862c', '08.80', '2015-04-30 20:57:40', '08.80'),
('f2869668365e330d5d8066de9e9c967e', '9071656452244f7adfe2bd66d69e3ec3', 'c4ca4238a0b923820dcc509a6f75849b', '06.50', '2015-04-30 21:38:01', ''),
('f2869668365e330d5d8066de9e9c967e', '9071656452244f7adfe2bd66d69e3ec3', 'c81e728d9d4c2f636f067f89cc14862c', '06.70', '2015-04-30 21:38:01', '');

-- --------------------------------------------------------

--
-- Table structure for table `psb_siswa_calon_tertulis`
--

CREATE TABLE IF NOT EXISTS `psb_siswa_calon_tertulis` (
  `kd` varchar(50) NOT NULL,
  `kd_siswa_calon` varchar(50) NOT NULL,
  `kd_mapel` varchar(50) NOT NULL,
  `nilai` varchar(5) NOT NULL,
  `postdate` datetime NOT NULL,
  `total` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_siswa_calon_tertulis`
--

INSERT INTO `psb_siswa_calon_tertulis` (`kd`, `kd_siswa_calon`, `kd_mapel`, `nilai`, `postdate`, `total`) VALUES
('6f4847b6239d1c273631b936c27dcc14', '39fac75be8740baa2df11875485217e9', 'edff1882267bb68b8d58499a7895d869', '7.44', '2015-04-30 20:58:57', '22.32'),
('6f4847b6239d1c273631b936c27dcc14', '39fac75be8740baa2df11875485217e9', 'f7ada06eb300ffa0ba896a528ade2f7e', '3', '2015-04-30 20:58:57', '15'),
('6f4847b6239d1c273631b936c27dcc14', '39fac75be8740baa2df11875485217e9', 'c70c21e73f66087bb8233f307bf9bbd3', '0', '2015-04-30 20:58:57', '0'),
('6f4847b6239d1c273631b936c27dcc14', '39fac75be8740baa2df11875485217e9', '498e2d495bc1f4dbe40040e55fd37f3f', '0', '2015-04-30 20:58:57', '0'),
('838f052efae0940bc0b2385c2108fec9', 'ca8223286d8b3e00bc36d26f041daf97', 'edff1882267bb68b8d58499a7895d869', '0', '0000-00-00 00:00:00', ''),
('838f052efae0940bc0b2385c2108fec9', 'ca8223286d8b3e00bc36d26f041daf97', 'f7ada06eb300ffa0ba896a528ade2f7e', '0', '0000-00-00 00:00:00', ''),
('838f052efae0940bc0b2385c2108fec9', 'ca8223286d8b3e00bc36d26f041daf97', 'c70c21e73f66087bb8233f307bf9bbd3', '0', '0000-00-00 00:00:00', ''),
('838f052efae0940bc0b2385c2108fec9', 'ca8223286d8b3e00bc36d26f041daf97', '498e2d495bc1f4dbe40040e55fd37f3f', '0', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `psb_siswa_calon_un`
--

CREATE TABLE IF NOT EXISTS `psb_siswa_calon_un` (
  `kd` varchar(50) NOT NULL,
  `kd_siswa_calon` varchar(50) NOT NULL,
  `kd_mapel` varchar(50) NOT NULL,
  `nilai` varchar(5) NOT NULL,
  `total` varchar(5) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psb_siswa_calon_un`
--

INSERT INTO `psb_siswa_calon_un` (`kd`, `kd_siswa_calon`, `kd_mapel`, `nilai`, `total`, `postdate`) VALUES
('3c381a685ccf8853e3017632e3aad826', 'ca8223286d8b3e00bc36d26f041daf97', '0510cf929b06cfd350b5a942eaa33b26', '07.70', '15.4', '2015-04-30 11:35:25'),
('25f2b2f02bbf99997e0392f5f86d3116', 'ca8223286d8b3e00bc36d26f041daf97', 'fbdcbdb61e4506f73620edeccc2b82b9', '07.70', '23.1', '2015-04-30 11:35:25'),
('eaa5371d1b2213df7e46409c5c8dbf9c', 'ca8223286d8b3e00bc36d26f041daf97', 'c1569b80268614e65be71498ef60bc84', '07.70', '38.5', '2015-04-30 11:35:25'),
('58ef738471cf1f068faa1d8a1ded988b', 'ca8223286d8b3e00bc36d26f041daf97', '675457d9163ca653206b8ac4de965c71', '07.70', '15.4', '2015-04-30 11:35:25'),
('83471697e7c3a9fa36e43485e8c275d6', '39fac75be8740baa2df11875485217e9', '0510cf929b06cfd350b5a942eaa33b26', '08.80', '17.6', '2015-04-30 11:46:56'),
('f9b0c857f03f076360b3ffb0c4319bbd', '39fac75be8740baa2df11875485217e9', 'fbdcbdb61e4506f73620edeccc2b82b9', '08.80', '26.4', '2015-04-30 11:46:56'),
('ba4f7933335f8f005f638416e9d068b3', '39fac75be8740baa2df11875485217e9', 'c1569b80268614e65be71498ef60bc84', '08.80', '44', '2015-04-30 11:46:56'),
('aabc3e91c5976c18c0da5e029a3fce16', '39fac75be8740baa2df11875485217e9', '675457d9163ca653206b8ac4de965c71', '08.80', '17.6', '2015-04-30 11:46:56'),
('f1fc73ffe65877c5dae9f58cb8fe4d99', '9071656452244f7adfe2bd66d69e3ec3', '0510cf929b06cfd350b5a942eaa33b26', '08.70', '17.4', '2015-04-30 21:38:01'),
('edd87a21c313a3501c09be69f933520f', '9071656452244f7adfe2bd66d69e3ec3', 'fbdcbdb61e4506f73620edeccc2b82b9', '06.50', '19.5', '2015-04-30 21:38:01'),
('47e3d35b8462ee565b26cdc131447ac7', '9071656452244f7adfe2bd66d69e3ec3', 'c1569b80268614e65be71498ef60bc84', '06.70', '33.5', '2015-04-30 21:38:01'),
('f2869668365e330d5d8066de9e9c967e', '9071656452244f7adfe2bd66d69e3ec3', '675457d9163ca653206b8ac4de965c71', '08.70', '17.4', '2015-04-30 21:38:01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
