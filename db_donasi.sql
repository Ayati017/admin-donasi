-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14 Jun 2019 pada 11.47
-- Versi Server: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_donasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password_admin` varchar(64) NOT NULL,
  `email_admin` varchar(64) NOT NULL,
  `akses_level` enum('super admin','panti sosial') NOT NULL,
  `id_panti` varchar(22) DEFAULT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `id_panti` (`id_panti`),
  KEY `id_panti_2` (`id_panti`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password_admin`, `email_admin`, `akses_level`, `id_panti`) VALUES
(1, 'ayati131', '098765', 'ayati@gmail.com', 'panti sosial', NULL),
(2, 'ayati', '123456', 'ayati@gmail.com', 'super admin', NULL),
(3, 'admin', '123456', 'ayati017@gmail.com', 'super admin', NULL),
(4, 'mirna', '444444', 'mirna@gmail.com', '', NULL),
(5, 'Panti Sejahtera', '6701142021', 'asdfsad123f@asdfasdf.com', 'panti sosial', '6701142021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_donasi`
--

CREATE TABLE IF NOT EXISTS `tb_donasi` (
  `id_donasi` varchar(22) NOT NULL,
  `jumlah_donasi` varchar(22) NOT NULL,
  `waktu_donasi` datetime NOT NULL,
  `bukti_tf` text,
  `status` varchar(22) NOT NULL,
  `id_donatur` varchar(22) NOT NULL,
  `id_panti` varchar(22) NOT NULL,
  PRIMARY KEY (`id_donasi`),
  KEY `id_donatur` (`id_donatur`),
  KEY `id_panti` (`id_panti`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_donasi`
--

INSERT INTO `tb_donasi` (`id_donasi`, `jumlah_donasi`, `waktu_donasi`, `bukti_tf`, `status`, `id_donatur`, `id_panti`) VALUES
('098654321', '20000', '2018-12-13 07:30:14', 'dummy', 'unverified', '1301178551', '6701142021'),
('1234567890', '5000000', '2018-12-13 03:12:22', 'dummy', 'verified', '1301178551', '6701142021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_donatur`
--

CREATE TABLE IF NOT EXISTS `tb_donatur` (
  `id_donatur` varchar(22) NOT NULL,
  `nama_donatur` varchar(64) NOT NULL,
  `email_donatur` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `akses_level` varchar(30) NOT NULL,
  `alamat_donatur` text NOT NULL,
  `foto_donatur` text,
  `telp_donatur` varchar(12) NOT NULL,
  PRIMARY KEY (`id_donatur`),
  UNIQUE KEY `email_donatur` (`email_donatur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_donatur`
--

INSERT INTO `tb_donatur` (`id_donatur`, `nama_donatur`, `email_donatur`, `password`, `akses_level`, `alamat_donatur`, `foto_donatur`, `telp_donatur`) VALUES
('123', 'ayati', 'ayati131.ca@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', 'subang', NULL, '089765'),
('1301178551', 'marni', 'mei@gmail.com', '973f2d6ee2c2ba6817f14a440b0601e1940267c1', '0', 'indonesia', 'http://10.0.2.2/edonate/profiles/abc.jpg', '082186555186');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_panti`
--

CREATE TABLE IF NOT EXISTS `tb_panti` (
  `id_panti` varchar(22) NOT NULL,
  `nama_panti` varchar(64) NOT NULL,
  `norek_panti` varchar(22) NOT NULL,
  `bank_panti` varchar(64) NOT NULL,
  `namarek_panti` varchar(64) NOT NULL,
  `alamat_panti` text NOT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `telp_panti` varchar(12) DEFAULT NULL,
  `foto` text,
  `status` enum('verified','unverified') DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `keterangan_panti` text,
  `nama_kegiatan_panti` varchar(64) DEFAULT NULL,
  `foto_kegiatan` text,
  `deskripsi_kegiatan_panti` text,
  PRIMARY KEY (`id_panti`),
  UNIQUE KEY `nama_panti` (`nama_panti`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_panti`
--

INSERT INTO `tb_panti` (`id_panti`, `nama_panti`, `norek_panti`, `bank_panti`, `namarek_panti`, `alamat_panti`, `lat`, `lng`, `telp_panti`, `foto`, `status`, `email`, `keterangan_panti`, `nama_kegiatan_panti`, `foto_kegiatan`, `deskripsi_kegiatan_panti`) VALUES
('1213343331', 'Panti Berkah', '013823280943', 'Bank BCA', 'Berkah Official', 'Soreang, kab. Bandung', -6.894796, 110.638413, '083292424', 'http://10.0.2.2/edonate/profiles/t2nbe5gjbwbma7bz4xb0.png', 'verified', 'pantiberkah@android.com', 'Ini adalah panti ', 'Gotong Royong', 'http://10.0.2.2/edonate/profiles/t2nbe5gjbwbma7bz4xb0.png', 'Ini adalah panti dummy yang diguakan untuk dummy. '),
('6701142021', 'Panti Sejahtera', '130009090231221', 'Bank Mandi Sendiri', 'Yayasan Panti Sejahtera', 'Bojongsoang, Kab. Bandung', -6.916692, 110.482984, '0481290455', 'http://10.0.2.2/edonate/profiles/t2nbe5gjbwbma7bz4xb0.png', 'verified', 'pantisejahtera@android.com', 'panti asuhan sejahtera merupakan', 'Buka bersama ramadhan', NULL, 'ramadhan bersama anak-anak panti'),
('6701142022', 'panti mukaromah', '86153093264', 'bank bni', 'mukaromah', 'Dayeuh kolot, bandung', 25113452, 131242, '6785612310', 'contractor-vs-full-time-330x220.jpg', 'verified', 'mukaromah@gmail.com', 'dfsdafs', 'sembako', NULL, 'afsdafds'),
('6701142023', 'panti milana', '92384291', 'bank jenius', 'milan', 'depok', 981763, 183217, '08122987654', 'Capture.PNG', 'verified', 'milan@gmail.com', 'uhdasjhdak', 'fsdafsd', NULL, 'fsadsd'),
('6701142024', 'Balai Perlindungan Sosial Tresna Werdha', '9876541434', 'bank bca', 'bpstw', 'Dayeuh kolot, jalan telekomunikasi', -7.052695, 107.70981, '0225950943', 'bpstw-min.PNG', 'verified', 'bpstw@gmail.com', 'Balai Perlindungan Sosial Tresna Werdha (BPSTW) Ciparay semula bernama Panti Sosial Tresna Werdha Pakutandang yang merupakan UPT Kanwil Departemen Sosial Provinsi Jawa Barat berdiri Tahun1979 dan memulai operasionalnya pada tanggal 19 Mei 1980', 'fsasd', NULL, 'FSFSDFS'),
('6701142025', '123', '123', '123', '123', '123', 123, 123, '123', 'a_putih2.png', 'verified', 'asdfsad123f@asdfasdf.com', '123', '123', 'A_hitam2.png', '123');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`id_panti`) REFERENCES `tb_panti` (`id_panti`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_donasi`
--
ALTER TABLE `tb_donasi`
  ADD CONSTRAINT `tb_donasi_ibfk_1` FOREIGN KEY (`id_donatur`) REFERENCES `tb_donatur` (`id_donatur`),
  ADD CONSTRAINT `tb_donasi_ibfk_2` FOREIGN KEY (`id_panti`) REFERENCES `tb_panti` (`id_panti`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
