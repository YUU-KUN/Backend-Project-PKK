-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2020 at 01:02 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'APA YA', 'COBA DEH', '2020-04-20 22:15:49', '2020-04-20 22:15:49'),
(2, 'YUUKUN', 'iwahyu809@gmail.com', '2020-04-20 22:46:52', '2020-04-20 22:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `jenis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `takaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `nama_produk`, `stock`, `jenis`, `harga`, `takaran`, `created_at`, `updated_at`) VALUES
(1, 'Prosessor4', 11, 'pertalite', '250000', '1', '2020-04-24 15:27:06', '2020-04-24 15:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE `gambar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `jenis` enum('pertamax','pertamax_turbo','pertamina_dex','premium','pertalite','dextalite','bio_solar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `takaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dibeli` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`id`, `nama_produk`, `stock`, `jenis`, `harga`, `takaran`, `dibeli`, `created_at`, `updated_at`) VALUES
(6, 'Pertamina', 3, 'premium', '20000', '1', 0, '2020-04-25 00:21:31', '2020-04-25 00:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_11_05_063337_book', 1),
(4, '2020_04_24_131927_create_gambars_table', 2),
(5, '2020_04_24_132601_create_transaksis_table', 2),
(6, '2020_04_24_133808_user', 3),
(7, '2020_04_24_183842_cart', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `iduser` int(11) NOT NULL,
  `idgambar` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('penjual','pembeli') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_verify` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `kategori`, `password`, `password_verify`, `created_at`, `updated_at`) VALUES
(1, 'INDRA', 'WAHYU', 'iwahyu809@gmail.com', 'penjual', '$2y$10$I12.YSDlg/W3qKvfrOsdG.m1DmNtBw3.RQKIfTSEpt1YIEvvfrq3K', '$2y$10$DnC2vYRDFg2FuIZxM63Hle6oiy.oazahIAXjh1wqnJM9Ul/I9OFS.', '2020-04-24 07:18:22', '2020-04-24 07:18:22'),
(2, 'INDRA', 'WAHYU', 'iwahyu@gmail.com', 'pembeli', '$2y$10$FvzN7wL3yEmM.0.sYBRsE.V5zgN5lTQ2FTurl4ohh6HynQUjI66Pa', '$2y$10$7DylhEES7bAFery1/9I9mekk0/u3b/n6.7xJSYoYcGurcxHYfkld6', '2020-04-24 10:49:22', '2020-04-24 10:49:22'),
(3, 'INDRA', 'WAHYU', 'iwahyu800@gmail.com', 'pembeli', '$2y$10$6YuowGdoOhiogb.1ajr4r.jb2Jfbt2v1iKFGHfgbrpkWMbvr791UG', '$2y$10$3Zu/bq0Y2huZttRLy2pXautRHMVPKNgydhTOtOitnKwfJNbD6ZpU6', '2020-04-24 22:50:35', '2020-04-24 22:50:35'),
(4, 'INDRA3', 'WAHYU3', 'iwahyu3@gmail.com', 'penjual', '$2y$10$QBUqkc3emQYov0/yPL4euuC9P2ywO1ULpbkpdEkbDgxflSdhZ8w7e', '$2y$10$ziVmLZyQk2eOjG9SzZRe9Oz.55vIDS.C7t/q/FtAMO5Tn9lEjDXI6', '2020-04-25 00:20:41', '2020-04-25 00:20:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
