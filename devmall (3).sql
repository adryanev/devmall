-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2021 at 07:22 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devmall`
--

-- --------------------------------------------------------

--
-- Table structure for table `booth`
--

CREATE TABLE `booth` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booth`
--

INSERT INTO `booth` (`id`, `id_user`, `nama`, `alamat1`, `alamat2`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `banner`, `avatar`, `deskripsi`, `email`, `nomor_telepon`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 'Testing Booth', 'Jl Anggrek Perumahan Vaishatama ', 'Blok D 12B', 'Simpang Baru', 'Kecamatan Tampan', 'Kota Pekanbaru', 'Riau', NULL, '1586090957-two_people.jpg', '<p>Akun Testing Booth</p>', 'booth@devmall.test', '+6282174969356', 0.47293, 101.359, 1, 1586090957, 1586095285);

-- --------------------------------------------------------

--
-- Table structure for table `coin`
--

CREATE TABLE `coin` (
  `id` int(11) NOT NULL,
  `id_booth` int(11) DEFAULT NULL,
  `saldo` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coin`
--

INSERT INTO `coin` (`id`, `id_booth`, `saldo`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 1, 1586846983, 1586846983);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `key`, `value`) VALUES
(1, 'deskripsi', 'Lorem Ipsum'),
(2, 'nomor_hp', '0195310295'),
(3, 'email', 'support@devmall.test'),
(4, 'alamat', 'Jl Subrantas km 5'),
(5, 'faq', 'FAQ'),
(6, 'tos', 'term of service'),
(7, 'download', 'Cara Download'),
(8, 'beli', 'Cara Beli'),
(9, 'pembayaran', 'Cara Bayar'),
(10, 'refund', 'Cara Refund'),
(11, 'nego', 'Cara Nego'),
(12, 'cicil', 'Cara cicil');

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `persentase` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id`, `id_produk`, `persentase`, `created_at`, `updated_at`) VALUES
(11, 7, 1, 1608192925, 1608192925),
(12, 11, 21, 1608192951, 1608192951),
(13, 8, 10, 1608644867, 1608644867);

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_booth` int(11) DEFAULT NULL,
  `notification` tinyint(1) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeri_produk`
--

CREATE TABLE `galeri_produk` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `nama_berkas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_berkas` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeri_produk`
--

INSERT INTO `galeri_produk` (`id`, `id_produk`, `nama_berkas`, `jenis_berkas`, `created_at`, `updated_at`) VALUES
(14, 7, '1607866957-index.jpg', 'jpg', 1607866957, 1607866957),
(17, 14, '1608709507-index.jpg', 'jpg', 1608709507, 1608709507),
(22, 16, '1608712115-index.jpg', 'jpg', 1608712115, 1608712115),
(23, 16, '1608712993-kampar.png', 'png', 1608712993, 1608712993),
(24, 26, '1609087186-index.jpg', 'jpg', 1609087186, 1609087186);

-- --------------------------------------------------------

--
-- Table structure for table `harga_nego`
--

CREATE TABLE `harga_nego` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `harga_nego`
--

INSERT INTO `harga_nego` (`id`, `id_user`, `id_produk`, `harga`, `created_at`, `updated_at`) VALUES
(4, 3, 24, 9400, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `frekuensi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `deskripsi`, `created_at`, `updated_at`, `frekuensi`) VALUES
(1, 'Web', 'Web Application', 1586088966, 1609088924, 11),
(2, 'Mobile', 'Aplikasi Mobile', 1586089146, 1607753608, 1),
(3, 'Android', 'Aplikasi Android', 1586089162, 1608709503, 1),
(5, 'asd', 'sdsassadds', 1607673850, 1607673859, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_produk` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_produk`, `id_kategori`) VALUES
(7, 1),
(11, 1),
(8, 1),
(14, 3),
(16, 1),
(17, 1),
(18, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `is_nego` tinyint(1) DEFAULT NULL,
  `id_harga_nego` int(11) DEFAULT NULL,
  `is_diskon` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1586080378),
('m130524_201442_init', 1586080381),
('m190124_110200_add_verification_token_column_to_user_table', 1586080382),
('m190827_122000_create_profil_user_table', 1586080384),
('m190827_124005_create_verifikasi_user_table', 1586080386),
('m190828_124421_create_booth_table', 1586080389),
('m190828_125759_create_produk_table', 1586080391),
('m190828_131357_create_kategori_table', 1586080392),
('m190828_131659_create_kategori_produk_table', 1586080396),
('m190828_132539_create_galeri_produk_table', 1586080399),
('m190828_132834_create_nego_table', 1586080401),
('m190828_133914_create_config_table', 1586080403),
('m190828_134821_create_ulasan_table', 1586080407),
('m190828_135831_create_favorit_table', 1586080410),
('m190828_140126_create_promo_table', 1586080412),
('m190828_142203_create_promo_produk_table', 1586080416),
('m190830_114249_insert_super_admin', 1586080417),
('m190904_115213_create_transaksi_table', 1586080419),
('m191001_122929_add_booth_column_to_user_table', 1586080420),
('m191004_114920_add_sms_verification_to_user_table', 1586080420),
('m191004_142338_add_is_phone_verified_to_user_table', 1586080421),
('m191020_074924_update_galeri_produk_table', 1586080422),
('m191021_122307_update_tabel_kategori', 1586080423),
('m191107_101139_create_table_follow', 1586080427),
('m191119_133928_create_keranjang_table', 1586080431),
('m191123_085455_alter_transaksi_table', 1586080434),
('m191126_081724_create_permintaan_produk_table', 1586080437),
('m191127_120036_create_permintaan_produk_detail_table', 1586080440),
('m191127_123305_create_transaksi_detail_table', 1586080444),
('m191127_130002_create_transaksi_cicilan_table', 1586080446),
('m191127_130627_create_pembayaran_cicilan_table', 1586080448),
('m191204_105719_insert_app_config', 1586080448),
('m191221_071303_alter_transaksi_table_remove_booth', 1586080453),
('m191223_124057_create_harga_nego_table', 1586080457),
('m191223_130150_alter_keranjang_table', 1586080458),
('m200115_113800_create_diskon_table', 1586080462),
('m200115_120411_add_foreign_key_of_harga_nego_to_keranjang_table', 1586080463),
('m200119_102453_create_riwayat_nego_table', 1586080468),
('m200126_115959_create_riwayat_permintaan_table', 1586080470),
('m200126_121432_add_keterangan_to_permintaan_produk_table', 1586080471),
('m200218_141444_create_transaksi_permintaan_table', 1586080473),
('m200218_141903_create_riwayat_transaksi_permintaan_table', 1586080475),
('m200225_132411_add_jenis_to_riwayat_transaksi_permintaan', 1586080476),
('m200227_123101_create_coin_table', 1586080478),
('m200402_164023_create_pembayaran_table', 1586080479),
('m200402_170611_alter_transaksi_table', 1586080486),
('m200407_082558_alter_pembayaran_transaksi_permintaan_table', 1586248253);

-- --------------------------------------------------------

--
-- Table structure for table `nego`
--

CREATE TABLE `nego` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga_produk` bigint(20) NOT NULL,
  `harga_satu` bigint(20) DEFAULT NULL,
  `harga_dua` bigint(20) DEFAULT NULL,
  `harga_tiga` bigint(20) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nego`
--

INSERT INTO `nego` (`id`, `id_produk`, `harga_produk`, `harga_satu`, `harga_dua`, `harga_tiga`, `created_at`, `updated_at`) VALUES
(4, 16, 1000, 1800, 700, 699, 1608712993, 1608713875),
(5, 17, 1000, 1200, 100, 100, 1608859686, 1608860179),
(6, 24, 10000, 9000, 8000, 800, 1608949076, 1608949317),
(7, 26, 9000, 8000, 9000, NULL, 1609087881, 1609088924);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `context` varchar(100) NOT NULL,
  `id_data` int(11) NOT NULL,
  `jenis_data` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `sender`, `receiver`, `context`, `id_data`, `jenis_data`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Booth menambahkan Produk baru dengan id23', 23, 'Produk', 'Sudah Dibaca', 1608947698, 1608947758),
(2, 2, 1, 'Booth menambahkan Produk baru dengan id 24', 24, 'Produk', 'Sudah Dibaca', 1608949076, 1613028568),
(3, 2, 1, 'Booth mengubah data Produk dengan id', 24, 'Produk', 'Sudah Dibaca', 1608949097, 1613026865),
(4, 2, 1, 'Booth mengubah data Produk dengan id', 24, 'Produk', 'Belum Dibaca', 1608949302, 1608949302),
(5, 2, 1, 'Booth mengubah data Produk dengan id', 24, 'Produk', 'Belum Dibaca', 1608949317, 1608949318),
(6, 2, 1, 'Booth menambahkan Produk baru dengan id 25', 25, 'Produk', 'Belum Dibaca', 1609087010, 1609087010),
(7, 2, 1, 'Booth menambahkan Produk baru dengan id 26', 26, 'Produk', 'Belum Dibaca', 1609087185, 1609087185),
(8, 2, 1, 'Booth mengubah data Produk dengan id', 26, 'Produk', 'Belum Dibaca', 1609087202, 1609087202),
(9, 2, 1, 'Booth mengubah data Produk dengan id', 26, 'Produk', 'Belum Dibaca', 1609087881, 1609087881),
(10, 2, 1, 'Booth mengubah data Produk dengan id', 26, 'Produk', 'Belum Dibaca', 1609087898, 1609087898),
(11, 2, 1, 'Booth mengubah data Produk dengan id', 26, 'Produk', 'Belum Dibaca', 1609087958, 1609087958),
(12, 2, 1, 'Booth mengubah data Produk dengan id', 26, 'Produk', 'Belum Dibaca', 1609088361, 1609088361),
(13, 2, 1, 'Booth mengubah data Produk dengan id', 26, 'Produk', 'Belum Dibaca', 1609088377, 1609088377),
(14, 2, 1, 'Booth mengubah data Produk dengan id', 26, 'Produk', 'Belum Dibaca', 1609088398, 1609088398),
(15, 2, 1, 'Booth mengubah data Produk dengan id', 26, 'Produk', 'Belum Dibaca', 1609088418, 1609088418),
(16, 2, 1, 'Booth mengubah data Produk dengan id', 26, 'Produk', 'Belum Dibaca', 1609088733, 1609088733),
(17, 2, 1, 'Booth mengubah data Produk dengan id', 26, 'Produk', 'Belum Dibaca', 1609088905, 1609088905),
(18, 2, 1, 'Booth mengubah data Produk dengan id', 26, 'Produk', 'Belum Dibaca', 1609088924, 1609088924),
(30, 3, 2, 'usersatu me-request produk baru dengan id 40', 40, 'Request Produk', 'Sudah Dibaca', 1612197176, 1613027712),
(31, 2, 3, ' Menerima Request produk baru dengan id 40', 40, 'Request Produk', 'Belum Dibaca', 1612210869, 1612211390),
(32, 2, 3, ' Menolak Request produk baru dengan id 36', 36, 'Request Produk', 'Belum Dibaca', 1612211628, 1612211657);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `kode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_pembayaran` tinyint(4) DEFAULT NULL,
  `nominal` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `expire` int(11) DEFAULT NULL,
  `waktu` int(11) DEFAULT NULL,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `kode_pembayaran`, `external_id`, `type`, `jenis_pembayaran`, `nominal`, `status`, `expire`, `waktu`, `snap_token`, `created_at`, `updated_at`) VALUES
(3, 'devmall-produk-1586939038', NULL, NULL, NULL, 12300000, 0, 1586939038, 1586939038, NULL, NULL, NULL),
(4, 'devmall-produk-1586940714', 4, 'transaksiProduk', NULL, 12300000, 0, 1586940714, 1586940714, '39937374-ba63-4a2f-9cf4-24d1adb338fc', NULL, NULL),
(6, 'devmall-produk-1586940793', 6, 'transaksiProduk', NULL, 12300000, 0, 1586940793, 1586940793, 'd221a1f8-39fc-45d1-8648-ec89bec94db8', NULL, NULL),
(7, 'devmall-produk-1586943190', 7, 'transaksiProduk', NULL, 53253246, 0, 1586943190, 1586943190, '4cdedd03-1361-4fc5-ac7b-0000cda06055', NULL, NULL),
(8, 'devmall-produk-1586943785', 8, 'transaksiProduk', NULL, 53253246, 0, 1586943785, 1586943785, 'f7502c82-3586-4a6b-ab4c-51a6068fcd8f', NULL, NULL),
(9, 'devmall-produk-1586943890', 9, 'transaksiProduk', NULL, 53253246, 0, 1586943890, 1586943890, 'fc556a6b-21ba-482a-bae1-f071fced87da', NULL, NULL),
(11, 'devmall-produk-1586943947', 11, 'transaksiProduk', NULL, 53253246, 0, 1586943947, 1586943947, 'f28d0ece-fb79-4246-b22d-f440b629af51', NULL, NULL),
(12, 'devmall-produk-1586944512', 12, 'transaksiProduk', NULL, 53253246, 0, 1586944512, 1586944512, 'c820e804-f183-43f6-a390-9d63339d8ef3', NULL, NULL),
(13, 'devmall-produk-1586944946', 14, 'transaksiProduk', NULL, 53253246, 0, 1586944946, 1586944946, '7bfeab70-e0eb-4bb5-8d08-03d0755359e0', NULL, NULL),
(14, 'devmall-produk-1586945096', 15, 'transaksiProduk', NULL, 12300000, 0, 1586945096, 1586945096, 'c9d9c412-9313-44b4-bcee-6e0046eabc21', NULL, NULL),
(15, 'devmall-produk-1614001121', 19, 'transaksiProduk', NULL, 100, 0, 1614001121, 1614001121, '62f07abb-6010-452c-9710-2aa4f1355f3d', NULL, NULL),
(16, 'devmall-produk-1614579702', 20, 'transaksiProduk', NULL, 54400, 0, 1614579702, 1614579702, 'a04d5565-e90b-466b-aab3-1ef272dec9d1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_cicilan`
--

CREATE TABLE `pembayaran_cicilan` (
  `id` int(11) NOT NULL,
  `id_transaksi_cicilan` int(11) DEFAULT NULL,
  `tanggal_pembayaran` int(11) DEFAULT NULL,
  `jumlah_dibayar` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_transaksi_permintaan`
--

CREATE TABLE `pembayaran_transaksi_permintaan` (
  `id` int(11) NOT NULL,
  `id_transaksi_permintaan` int(11) DEFAULT NULL,
  `nominal` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `jenis` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran_transaksi_permintaan`
--

INSERT INTO `pembayaran_transaksi_permintaan` (`id`, `id_transaksi_permintaan`, `nominal`, `status`, `created_at`, `updated_at`, `jenis`) VALUES
(1, 1, 890, 0, 1607757836, 1607757836, 1),
(2, 1, 5000, 0, 1607757910, 1607757910, 2),
(3, 2, 200, 0, 1608094223, 1608094223, 1),
(4, 1, 50000, 0, 1609086661, 1609086661, 2),
(5, 3, 190, 0, 1612210869, 1612210869, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_produk`
--

CREATE TABLE `permintaan_produk` (
  `id` int(11) NOT NULL,
  `id_booth` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kriteria` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` int(11) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `uang_muka` bigint(20) DEFAULT NULL,
  `progres` float DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permintaan_produk`
--

INSERT INTO `permintaan_produk` (`id`, `id_booth`, `id_user`, `nama`, `kriteria`, `deadline`, `harga`, `uang_muka`, `progres`, `status`, `created_at`, `updated_at`, `keterangan`) VALUES
(14, 2, 3, 'dfgh', 'sadasasd', 123456, 12131, 112, NULL, 0, NULL, NULL, NULL),
(29, 2, 3, 'xasas', '<p>sdfg</p>', 1607706000, 70000, 890, NULL, 1, 1607756507, 1607757836, 'Oke'),
(35, 2, 3, 'Request Produk 1 ', '<p>andasdasodjasdjoiwjio</p>', 1609520400, 5000, 200, NULL, 1, 1608094133, 1608094223, 'Oke, SIlahkan bayar DP nya dlu'),
(36, 2, 3, 'Request Produk 1 ', '<p>andasdasodjasdjoiwjio</p>', 1609520400, 5000, 200, NULL, 0, 1608094134, 1612211628, 'Oke'),
(38, 2, 3, 'Produk 8', '<p>kriteria</p>', 1611939600, 90000, 10000, NULL, 2, 1611925581, 1611925581, NULL),
(39, 2, 3, 'Produk 81', '<p>csdss</p>', 1611939600, 10000, 190, NULL, 2, 1612197131, 1612197131, NULL),
(40, 2, 3, 'Produk 81', '<p>csdss</p>', NULL, 10000, 190, NULL, 1, 1612197175, 1612210869, '1');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_produk_detail`
--

CREATE TABLE `permintaan_produk_detail` (
  `id` int(11) NOT NULL,
  `id_permintaan` int(11) DEFAULT NULL,
  `nama_berkas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_berkas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permintaan_produk_detail`
--

INSERT INTO `permintaan_produk_detail` (`id`, `id_permintaan`, `nama_berkas`, `jenis_berkas`, `created_at`, `updated_at`) VALUES
(1, 29, '1607756507-rini.docx', 'docx', 1607756507, 1607756507),
(2, 35, '1608094133-Note ppt.docx', 'docx', 1608094133, 1608094133),
(3, 36, '1608094134-Note ppt.docx', 'docx', 1608094134, 1608094134),
(4, 38, '1611925581-amak.docx', 'docx', 1611925581, 1611925581),
(5, 39, '1612197132-amak.docx', 'docx', 1612197132, 1612197132),
(6, 40, '1612197175-BK Kelas VII Pertemuan 2.docx', 'docx', 1612197176, 1612197176);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `id_booth` int(11) DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesifikasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fitur` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `demo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nego` tinyint(1) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `id_booth`, `nama`, `deskripsi`, `spesifikasi`, `fitur`, `harga`, `demo`, `manual`, `nego`, `created_at`, `updated_at`) VALUES
(7, 2, 'EBook Belajar Laravel', '<p>Cocok untuk pemula</p>', '<p>agdasjd</p>', '<p>asad</p>', 100000, '-', '1607866956-Note ppt.docx', 0, 1607866956, 1607866956),
(8, 2, 'Produk 2', '<p>scdvc</p>', '<p>cxcxzzxc</p>', '<p>sdasdas</p>', 50000, '-', '', 0, 1607867059, 1608546171),
(11, 2, 'Produk 3', '<p>Deksirpsi Produk</p>', '<p>Spesifikasi</p>', '<p>Fitur bnyak</p>', 50010, '', '', 0, 1608092573, 1608092573),
(14, 2, 'asdfghj', '<p>sdfghj</p>', '<p>adsad</p>', '<p>cc</p>', 5000, 'sa', '', 0, 1608709502, 1608709502),
(16, 2, 'asertyu', '<p>dfg</p>', '<p>aaasac</p>', '<p>bhb</p>', 1000, '', '', 1, 1608711569, 1608713875),
(17, 2, 'asdfghjk', '<p>zsdfghjk</p>', '<p>hgjhl</p>', '<p>gjhjkl</p>', 1000, '', '', 1, 1608859684, 1608860179),
(18, 2, 'Produk 7', '<p>sdfghjk</p>', '<p>dhgadhad</p>', '<p>asdasasd</p>', 9000, '', '', 0, 1608946189, 1608946189),
(23, 2, 'produk 812', '<p>asdas</p>', '<p>asjdash</p>', '<p>asdsadj</p>', 100, '', '', 0, 1608947698, 1608947698),
(24, 2, 'ddd', '<p>adadas</p>', '<p>ksdhasd</p>', '<p>asdsakd</p>', 10000, '', '', 1, 1608949076, 1608949317),
(25, 2, 'Produk Baru', '<p>dashd</p>', '<p>adkasd</p>', '<p>asdkasd</p>', 6000, '', '', 0, 1609087010, 1609087010),
(26, 2, 'asdfghjklfdis', '<p>&nbsp;igdiuiwqei</p>', '<p>fs hd</p>', '<p>sdfhdsh</p>', 9000, '', '', 1, 1609087185, 1609088924);

-- --------------------------------------------------------

--
-- Table structure for table `profil_user`
--

CREATE TABLE `profil_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_depan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_belakang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` int(11) DEFAULT NULL,
  `jenis_kelamin` tinyint(4) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil_user`
--

INSERT INTO `profil_user` (`id`, `id_user`, `nama_depan`, `nama_belakang`, `tanggal_lahir`, `jenis_kelamin`, `avatar`, `alamat1`, `alamat2`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `pekerjaan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super 1', 'Administrator', 0, 1, 'superadmin.jpg', '', '', '', '', '', '', 'Super Admin', 0, 0),
(2, 2, 'Booth', 'Tes 1', 1608829200, 1, '1612169410-index.jpg', 'asdsa', '', '3213070004', '3213070', '3213', '32', 'Olshoper', 1586084403, 1612169410),
(3, 3, 'User', 'Satu', NULL, NULL, '1612168852-abstrac.jpg', 'Jalan 1', '', '1301013002', '1301013', '1301', '13', '', 1586258202, 1613826359),
(27, 37, 'Admin2', '', NULL, NULL, 'user_default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1608544993, 1608544993),
(28, 38, 'admin3', 'kece', NULL, NULL, 'user_default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1608545177, 1608545177),
(29, 39, 'Admin', '', NULL, NULL, 'user_default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1608644089, 1608644089),
(30, 40, 'admin5', '', NULL, NULL, 'user_default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1608694100, 1608694100),
(34, 44, 'user', '2', NULL, NULL, 'user_default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1610597974, 1610597974),
(44, 54, 'dfghjk', 'fghj', NULL, NULL, 'user_default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1610698566, 1610698566),
(51, 61, 'asdfg', 'zxcv', NULL, NULL, 'user_default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1611924505, 1611924505),
(52, 62, 'maya', 'may', NULL, NULL, 'user_default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1611927481, 1611927481);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `id_booth` int(11) DEFAULT NULL,
  `promo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persentase` float DEFAULT NULL,
  `waktu_mulai` int(11) DEFAULT NULL,
  `waktu_selesai` int(11) DEFAULT NULL,
  `kode_promo` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `id_booth`, `promo`, `persentase`, `waktu_mulai`, `waktu_selesai`, `kode_promo`, `created_at`, `updated_at`) VALUES
(6, NULL, 'Promo Akhir Tahun', 10, 1609261200, 1610125200, '', 1608544727, 1608544727),
(9, NULL, 'Promo Bulan 2', 10, 1612112400, 1612544400, 'ASDFGHJ', 1611622056, 1611622056),
(10, NULL, 'ASDFGHJK', 20, NULL, NULL, 'ASDFGHJK', 1612148192, 1612148192),
(11, NULL, 'asdf', 9, 1607360400, 1604163600, 'qwer', 1612148300, 1612148300);

-- --------------------------------------------------------

--
-- Table structure for table `promo_booth`
--

CREATE TABLE `promo_booth` (
  `id` int(11) NOT NULL,
  `id_promo` int(11) NOT NULL,
  `id_booth` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promo_booth`
--

INSERT INTO `promo_booth` (`id`, `id_promo`, `id_booth`, `created_at`, `updated_at`) VALUES
(1, 11, 2, 1612148300, 1612148300);

-- --------------------------------------------------------

--
-- Table structure for table `promo_produk`
--

CREATE TABLE `promo_produk` (
  `id` int(11) NOT NULL,
  `id_promo` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_produk`
--

INSERT INTO `promo_produk` (`id`, `id_promo`, `id_produk`, `created_at`, `updated_at`) VALUES
(12, 6, 7, 1608544727, 1608544727),
(20, 9, 25, 1611622056, 1611622056),
(21, 10, 16, 1612148192, 1612148192),
(22, 11, 16, 1612148300, 1612148300);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_nego`
--

CREATE TABLE `riwayat_nego` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `waktu_nego` int(11) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_nego`
--

INSERT INTO `riwayat_nego` (`id`, `id_user`, `id_produk`, `waktu_nego`, `harga`, `created_at`, `updated_at`) VALUES
(19, 3, 24, 1613047310, 8900, 1613047310, 1613047310),
(20, 3, 24, 1613047325, 8900, 1613047325, 1613047325);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_permintaan`
--

CREATE TABLE `riwayat_permintaan` (
  `id` int(11) NOT NULL,
  `id_permintaan_produk` int(11) DEFAULT NULL,
  `tanggal` int(11) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_permintaan`
--

INSERT INTO `riwayat_permintaan` (`id`, `id_permintaan_produk`, `tanggal`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 29, 1607014800, 'jjd', 1607757820, 1607757820),
(2, 29, 1606842000, 'Tahap 2', 1609086645, 1609086645);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_cicilan`
--

CREATE TABLE `transaksi_cicilan` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `banyak_cicilan` int(11) DEFAULT NULL,
  `jumlah_cicilan` int(11) DEFAULT NULL,
  `tanggal_jatuh_tempo` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga_transaksi` bigint(20) DEFAULT NULL,
  `is_promo` tinyint(1) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id`, `id_transaksi`, `id_produk`, `harga_transaksi`, `is_promo`, `created_at`, `updated_at`) VALUES
(12, 19, 23, 100, 0, 1613914722, 1613914722),
(13, 20, 8, 50000, 1, 1614493302, 1614493302),
(14, 20, 24, 10000, 0, 1614493302, 1614493302);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_permintaan`
--

CREATE TABLE `transaksi_permintaan` (
  `id` int(11) NOT NULL,
  `id_permintaan` int(11) DEFAULT NULL,
  `sudah_dibayar` bigint(20) DEFAULT NULL,
  `belum_dibayar` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_permintaan`
--

INSERT INTO `transaksi_permintaan` (`id`, `id_permintaan`, `sudah_dibayar`, `belum_dibayar`, `status`, `created_at`, `updated_at`) VALUES
(1, 29, 0, 70000, 0, 1607757836, 1607757836),
(2, 35, 0, 5000, 0, 1608094223, 1608094223),
(3, 40, 0, 10000, 0, 1612210869, 1612210869);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_produk`
--

CREATE TABLE `transaksi_produk` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `jenis_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_produk`
--

INSERT INTO `transaksi_produk` (`id`, `id_user`, `status`, `created_at`, `updated_at`, `jenis_transaksi`) VALUES
(3, 3, 0, 1586852639, 1586852639, 'tunai'),
(4, 3, 0, 1586854314, 1586854314, 'tunai'),
(6, 3, 0, 1586854393, 1586854393, 'tunai'),
(7, 3, 0, 1586856790, 1586856790, 'tunai'),
(8, 3, 0, 1586857385, 1586857385, 'tunai'),
(9, 3, 0, 1586857490, 1586857490, 'tunai'),
(11, 3, 0, 1586857547, 1586857547, 'tunai'),
(12, 3, 0, 1586858112, 1586858112, 'tunai'),
(14, 3, 0, 1586858546, 1586858546, 'tunai'),
(15, 3, 0, 1586858696, 1586858696, 'tunai'),
(19, 3, 0, 1613914721, 1613914721, 'tunai'),
(20, 3, 0, 1614493302, 1614493302, 'tunai');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `komentar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `id_produk`, `id_user`, `nilai`, `komentar`, `created_at`, `updated_at`) VALUES
(2, 7, 3, 3, 'bagus', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `level_akses` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_booth` tinyint(1) DEFAULT 0,
  `sms_verification` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_phone_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `access_token`, `nomor_hp`, `email`, `status`, `level_akses`, `created_at`, `updated_at`, `verification_token`, `has_booth`, `sms_verification`, `is_phone_verified`) VALUES
(1, 'root', 'Pwys0TRico7Ha4YSyX2fmjABrFskscxh', '$2y$13$kypnhc9ye9hRdvc99yiuquUe3QvTjvBm5kJih72rE.vRjWr1yIlfS', NULL, NULL, '08121111111', 'root@devmall.test', 1, 'superadmin', 0, 1608090102, 'Pwys0TRico7Ha4YSyX2fmjABrFskscxh', 0, NULL, 0),
(2, 'booth', '7UIQqAni4YcThOo_pWMr2LdCcPD7iyFX', '$2y$13$UijDQAZJcd25.y1hAjzizOeCWM1.Nxa92P4wNWT7YG13VlIk3Dq6a', NULL, NULL, '+6282174969356', 'booth@devmall.com', 3, 'penjual', 1586084403, 1607847209, 'tE0ztugpitwU2WOMXnzXGkBmf7i4IuwW_1586084403', 1, '858490', 1),
(3, 'usersatu', 'BSWiQ-OlNhnMFKeNLPg_ASQpbDytusMX', '$2y$13$.YDv/Mymu4uSr1QEtc8cjOd.RNX7CpCAE5e5d3dJCHnrQymM9I0mC', NULL, NULL, '+6285157588396', 'petya.orlov14@gmail.com', 1, 'pengguna', 1586258202, 1613826359, 'cieIMOqKkjwM8u1blWIh_TIZSUAIimsf_1613826359', 1, '821344', 1),
(37, 'admin2', 'cjZjFyPq7Cq0duasXDqqaOcWNKa6x5QJ', '$2y$13$oxIXhuNnW1btuUC/nA6NIuTsI2xikmE//YSuQmS3IozTV3IN44l2K', NULL, NULL, NULL, 'admin2@ckcda.co', 1, 'superadmin', 1608544993, 1608544993, NULL, 0, NULL, 0),
(38, 'admin3', 'zDtPDAV2gKH2HZLibdLH3NFIN0Bahd53', '$2y$13$VFq3ZZxtJbPp6Uj6pjKRd.5yozvpttbjSBEaHZayC5Zx72Ht1kfle', NULL, NULL, NULL, 'dgad@ahdamca.a', 1, 'superadmin', 1608545177, 1608545743, NULL, 0, NULL, 0),
(39, 'admin4', 'BazWJu1ucwq-wnCg1BzulOzPd_Do_SkY', '$2y$13$iylWBms8yP67GrRC4M1IseCI4mBUwrfkS./Ei8CTa31zirCPt39bK', NULL, NULL, NULL, 'admin4@ja.co', 1, 'superadmin', 1608644089, 1608644089, NULL, 0, NULL, 0),
(40, 'admin5', 'FWEMs5bYrfLJe4zKR-JpM7yX2cqzy-FL', '$2y$13$0hRKzkx/v/JGVqbrL5JhmuvzKqdK.gZLD3yEYH0wEldwN36ZkviKW', NULL, NULL, NULL, 'admin5@asdas.cs', 1, 'superadmin', 1608694099, 1608694099, NULL, 0, NULL, 0),
(44, 'user3', 'VpsXVyycYhjEps_y_EnFFgHfEy4Usdq1', '$2y$13$odwZwZ/6YFYHJikZDwT05.yDhbLU6Zi73t2uObil3TqiAyPcR/PRO', NULL, NULL, NULL, 'user3@vnd.coma', 0, '', 1610597973, 1610597973, 'ij5vJlCirVXGgeuDTWIJNC0nTF4Euc34_1610597973', 0, NULL, 0),
(54, 'user33', 'RQOfPq0RERfk-vkYu-7WqqNbVMH0DBvf', '$2y$13$Pu4.vPG1Yl7bi76jRC6UHushnw9/TlQLR0GFxyiM3RzPi608rjC6a', NULL, NULL, NULL, 'ondripku14@gmail.com', 0, '', 1610698566, 1610698566, '9HtJyookAzPhOdvMWSGsvW4h1IVORf8a_1610698566', 0, NULL, 0),
(61, 'asdfg6786', 'yKZz-HBcN3LFp5LQLz6jgntVOcedzGrq', '$2y$13$nYjKOzP/v3ndrKymUy/SD.o4ETplmjiyAspXbqi13l.QUo8I2n.YG', NULL, NULL, NULL, 'petya.orlov13@gmail.com', 0, '', 1611924505, 1611924505, 'TYFJJ1eESJ_TPFlVX58dXuy7t7uw9v6N_1611924505', 0, NULL, 0),
(62, 'qwertyuiop', 'vvhwHNGFM4J2PiHgMekMCpMB-gd4Ljvm', '$2y$13$iBin18Ahsx5KU31fxDbCkuObY5IjQBQTK8ANJRcVTPgU2.z8MVkEO', NULL, NULL, NULL, 'mrizda63@gmail.com', 0, '', 1611927481, 1611927481, 'jj3qm9EnDVgV9EYa2QPseqxzgAi_X5xC_1611927481', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi_user`
--

CREATE TABLE `verifikasi_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_verifikasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verifikasi_user`
--

INSERT INTO `verifikasi_user` (`id`, `id_user`, `nama_file`, `jenis_verifikasi`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '1586085894-biden.jpg', 'ktp', 0, 1586085894, 1586085913),
(2, 2, '1586086934-obama.jpg', 'ktp', 2, 1586086934, 1586086950),
(3, 3, '1606278416-FireShot Capture 052 - Tracer Studi - Tracer Site - pkts.belmawa.ristekdikti.go.id.png', 'ktp', 2, 1606278416, 1606278455);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booth`
--
ALTER TABLE `booth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `coin`
--
ALTER TABLE `coin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-coin-booth` (`id_booth`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`),
  ADD KEY `idx-config-key` (`key`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_produk` (`id_produk`),
  ADD KEY `idx-diskon-id_produk` (`id_produk`);

--
-- Indexes for table `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-favorit-produk` (`id_produk`),
  ADD KEY `fk-favorit-user` (`id_user`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-follow-pengguna` (`id_pengguna`),
  ADD KEY `fk-follow-booth` (`id_booth`);

--
-- Indexes for table `galeri_produk`
--
ALTER TABLE `galeri_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-galeri_produk-produk` (`id_produk`);

--
-- Indexes for table `harga_nego`
--
ALTER TABLE `harga_nego`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-harga_nego-user` (`id_user`),
  ADD KEY `fk-harga_nego-produk` (`id_produk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD KEY `fk-kategori_produk-produk` (`id_produk`),
  ADD KEY `fk-kategori_produk-kategori` (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-keranjang-user` (`id_user`),
  ADD KEY `fk-keranjang-produk` (`id_produk`),
  ADD KEY `fk-keranjang-harga_nego` (`id_harga_nego`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `nego`
--
ALTER TABLE `nego`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_produk` (`id_produk`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-pembayaran-kode_pembayaran` (`kode_pembayaran`);

--
-- Indexes for table `pembayaran_cicilan`
--
ALTER TABLE `pembayaran_cicilan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-pembayaran_cicilan-transaksi` (`id_transaksi_cicilan`);

--
-- Indexes for table `pembayaran_transaksi_permintaan`
--
ALTER TABLE `pembayaran_transaksi_permintaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-riwayat_tp-tp` (`id_transaksi_permintaan`);

--
-- Indexes for table `permintaan_produk`
--
ALTER TABLE `permintaan_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-permintaan_produk_booth` (`id_booth`),
  ADD KEY `fk-permintaan_produk_user` (`id_user`);

--
-- Indexes for table `permintaan_produk_detail`
--
ALTER TABLE `permintaan_produk_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-detail_pemintaan_produk` (`id_permintaan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-produk-booth` (`id_booth`);

--
-- Indexes for table `profil_user`
--
ALTER TABLE `profil_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-profil_user-user` (`id_user`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-promo-booth` (`id_booth`);

--
-- Indexes for table `promo_booth`
--
ALTER TABLE `promo_booth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_produk`
--
ALTER TABLE `promo_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-promo_produk-promo` (`id_promo`),
  ADD KEY `fk-promo_produk-produk` (`id_produk`);

--
-- Indexes for table `riwayat_nego`
--
ALTER TABLE `riwayat_nego`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-riwayat_nego-id_user` (`id_user`),
  ADD KEY `idx-riwayat_nego-id_waktu_nego` (`waktu_nego`),
  ADD KEY `fk-riwayat_nego-produk` (`id_produk`);

--
-- Indexes for table `riwayat_permintaan`
--
ALTER TABLE `riwayat_permintaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-riwayat_permintaan-permintaan_produk` (`id_permintaan_produk`);

--
-- Indexes for table `transaksi_cicilan`
--
ALTER TABLE `transaksi_cicilan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-transaksi_cicilan-transaksi` (`id_transaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-transaksi_detail-transaksi` (`id_transaksi`),
  ADD KEY `fk-transaksi_detail-produk` (`id_produk`);

--
-- Indexes for table `transaksi_permintaan`
--
ALTER TABLE `transaksi_permintaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-transaksi_permintaan-permintaan` (`id_permintaan`);

--
-- Indexes for table `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-transaksi-user` (`id_user`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-ulasan-produk` (`id_produk`),
  ADD KEY `fk-ulasan-user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `verifikasi_user`
--
ALTER TABLE `verifikasi_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booth`
--
ALTER TABLE `booth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coin`
--
ALTER TABLE `coin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri_produk`
--
ALTER TABLE `galeri_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `harga_nego`
--
ALTER TABLE `harga_nego`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `nego`
--
ALTER TABLE `nego`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pembayaran_cicilan`
--
ALTER TABLE `pembayaran_cicilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran_transaksi_permintaan`
--
ALTER TABLE `pembayaran_transaksi_permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permintaan_produk`
--
ALTER TABLE `permintaan_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `permintaan_produk_detail`
--
ALTER TABLE `permintaan_produk_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `profil_user`
--
ALTER TABLE `profil_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `promo_booth`
--
ALTER TABLE `promo_booth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promo_produk`
--
ALTER TABLE `promo_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `riwayat_nego`
--
ALTER TABLE `riwayat_nego`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `riwayat_permintaan`
--
ALTER TABLE `riwayat_permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_cicilan`
--
ALTER TABLE `transaksi_cicilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaksi_permintaan`
--
ALTER TABLE `transaksi_permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `verifikasi_user`
--
ALTER TABLE `verifikasi_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booth`
--
ALTER TABLE `booth`
  ADD CONSTRAINT `fk-booth-user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coin`
--
ALTER TABLE `coin`
  ADD CONSTRAINT `fk-coin-booth` FOREIGN KEY (`id_booth`) REFERENCES `booth` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diskon`
--
ALTER TABLE `diskon`
  ADD CONSTRAINT `fk-diskon-produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorit`
--
ALTER TABLE `favorit`
  ADD CONSTRAINT `fk-favorit-produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-favorit-user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `fk-follow-booth` FOREIGN KEY (`id_booth`) REFERENCES `booth` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-follow-pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `galeri_produk`
--
ALTER TABLE `galeri_produk`
  ADD CONSTRAINT `fk-galeri_produk-produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `harga_nego`
--
ALTER TABLE `harga_nego`
  ADD CONSTRAINT `fk-harga_nego-produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-harga_nego-user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD CONSTRAINT `fk-kategori_produk-kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-kategori_produk-produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `fk-keranjang-harga_nego` FOREIGN KEY (`id_harga_nego`) REFERENCES `harga_nego` (`id`),
  ADD CONSTRAINT `fk-keranjang-produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-keranjang-user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nego`
--
ALTER TABLE `nego`
  ADD CONSTRAINT `fk-nego-produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran_cicilan`
--
ALTER TABLE `pembayaran_cicilan`
  ADD CONSTRAINT `fk-pembayaran_cicilan-transaksi` FOREIGN KEY (`id_transaksi_cicilan`) REFERENCES `transaksi_cicilan` (`id`);

--
-- Constraints for table `pembayaran_transaksi_permintaan`
--
ALTER TABLE `pembayaran_transaksi_permintaan`
  ADD CONSTRAINT `fk-riwayat_tp-tp` FOREIGN KEY (`id_transaksi_permintaan`) REFERENCES `transaksi_permintaan` (`id`);

--
-- Constraints for table `permintaan_produk`
--
ALTER TABLE `permintaan_produk`
  ADD CONSTRAINT `fk-permintaan_produk_booth` FOREIGN KEY (`id_booth`) REFERENCES `booth` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-permintaan_produk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `permintaan_produk_detail`
--
ALTER TABLE `permintaan_produk_detail`
  ADD CONSTRAINT `fk-detail_pemintaan_produk` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan_produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk-produk-booth` FOREIGN KEY (`id_booth`) REFERENCES `booth` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profil_user`
--
ALTER TABLE `profil_user`
  ADD CONSTRAINT `fk-profil_user-user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `fk-promo-booth` FOREIGN KEY (`id_booth`) REFERENCES `booth` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promo_produk`
--
ALTER TABLE `promo_produk`
  ADD CONSTRAINT `fk-promo_produk-produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-promo_produk-promo` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat_nego`
--
ALTER TABLE `riwayat_nego`
  ADD CONSTRAINT `fk-riwayat_nego-produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-riwayat_nego-user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat_permintaan`
--
ALTER TABLE `riwayat_permintaan`
  ADD CONSTRAINT `fk-riwayat_permintaan-permintaan_produk` FOREIGN KEY (`id_permintaan_produk`) REFERENCES `permintaan_produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_cicilan`
--
ALTER TABLE `transaksi_cicilan`
  ADD CONSTRAINT `fk-transaksi_cicilan-transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_produk` (`id`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `fk-transaksi_detail-produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-transaksi_detail-transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_permintaan`
--
ALTER TABLE `transaksi_permintaan`
  ADD CONSTRAINT `fk-transaksi_permintaan-permintaan` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan_produk` (`id`);

--
-- Constraints for table `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD CONSTRAINT `fk-transaksi-user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `fk-ulasan-produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-ulasan-user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `verifikasi_user`
--
ALTER TABLE `verifikasi_user`
  ADD CONSTRAINT `fk-verifikasi_user-user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
