-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 08, 2018 at 07:53 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webmaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'makanan'),
(2, 'minuman');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga` float NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `id_category`, `nama_menu`, `harga`, `gambar`, `deskripsi`) VALUES
(9, 2, 'Menu baru', 12000, 'menu-baru-0886002.png', 'ini adalah menu baru'),
(10, 1, 'roti bakar', 24000, 'roti-bakar-0827103.png', 'ini adalah controh manu baru');

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
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordermenu`
--

CREATE TABLE `ordermenu` (
  `id` int(11) NOT NULL,
  `id_table` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pelanggan` varchar(50) NOT NULL,
  `total` float NOT NULL,
  `bayar` float NOT NULL,
  `kembalian` float NOT NULL,
  `is_finished` int(11) DEFAULT '0',
  `is_fetched` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordermenu`
--

INSERT INTO `ordermenu` (`id`, `id_table`, `tanggal`, `pelanggan`, `total`, `bayar`, `kembalian`, `is_finished`, `is_fetched`) VALUES
(9, 3, '2018-06-08 17:30:29', 'Drake', 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordermenu_details`
--

CREATE TABLE `ordermenu_details` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordermenu_details`
--

INSERT INTO `ordermenu_details` (`id`, `id_order`, `id_menu`, `kuantitas`, `harga`) VALUES
(7, 8, 10, 1, 12000),
(8, 9, 10, 1, 12000),
(9, 9, 9, 2, 12000);

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
-- Stand-in structure for view `q_menu`
-- (See below for the actual view)
--
CREATE TABLE `q_menu` (
`id` int(11)
,`id_category` int(11)
,`nama_menu` varchar(100)
,`harga` float
,`gambar` varchar(255)
,`deskripsi` text
,`category` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `q_ordermenu_details`
-- (See below for the actual view)
--
CREATE TABLE `q_ordermenu_details` (
`id` int(11)
,`id_order` int(11)
,`id_menu` int(11)
,`kuantitas` int(11)
,`harga` float
,`pelanggan` varchar(50)
,`is_finished` int(11)
,`is_fetched` int(11)
,`nama_menu` varchar(100)
,`harga_barang` float
,`gambar` varchar(255)
,`deskripsi` text
,`category` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `tableorder`
--

CREATE TABLE `tableorder` (
  `id` int(11) NOT NULL,
  `table_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tableorder`
--

INSERT INTO `tableorder` (`id`, `table_number`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(5, 'Andika Ahmad', 'aspendaka@gmail.com', 'f9c22e5c8b56ff08487e9a8e727df2a752438222', NULL, NULL),
(8, 'Imanuel Ronaldo', 'imanuelronaldo@gmail.com', 'b921dabed88b8cf96ea5e6c6f2e047f02f724997', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure for view `q_menu`
--
DROP TABLE IF EXISTS `q_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `q_menu`  AS  select `a`.`id` AS `id`,`a`.`id_category` AS `id_category`,`a`.`nama_menu` AS `nama_menu`,`a`.`harga` AS `harga`,`a`.`gambar` AS `gambar`,`a`.`deskripsi` AS `deskripsi`,`b`.`category` AS `category` from (`menu` `a` join `category` `b` on((`a`.`id_category` = `b`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `q_ordermenu_details`
--
DROP TABLE IF EXISTS `q_ordermenu_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `q_ordermenu_details`  AS  select `a`.`id` AS `id`,`a`.`id_order` AS `id_order`,`a`.`id_menu` AS `id_menu`,`a`.`kuantitas` AS `kuantitas`,`a`.`harga` AS `harga`,`b`.`pelanggan` AS `pelanggan`,`b`.`is_finished` AS `is_finished`,`b`.`is_fetched` AS `is_fetched`,`c`.`nama_menu` AS `nama_menu`,`c`.`harga` AS `harga_barang`,`c`.`gambar` AS `gambar`,`c`.`deskripsi` AS `deskripsi`,`d`.`category` AS `category` from (((`ordermenu_details` `a` join `ordermenu` `b` on((`a`.`id_order` = `b`.`id`))) join `menu` `c` on((`a`.`id_menu` = `c`.`id`))) join `category` `d` on((`c`.`id_category` = `d`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordermenu`
--
ALTER TABLE `ordermenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordermenu_details`
--
ALTER TABLE `ordermenu_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tableorder`
--
ALTER TABLE `tableorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ordermenu`
--
ALTER TABLE `ordermenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ordermenu_details`
--
ALTER TABLE `ordermenu_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tableorder`
--
ALTER TABLE `tableorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
