-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 02:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `activity`, `description`, `timestamp`) VALUES
(1, 1, 'user', 'User in user page', '2024-11-13 09:06:05'),
(2, 1, 'logout', 'User logged out.', '2024-11-13 09:06:27'),
(3, 1, 'user', 'User in user page', '2024-11-13 09:06:33'),
(4, 1, 'user', 'User in user page', '2024-11-13 09:08:01'),
(5, 1, 'user', 'User in user page', '2024-11-13 09:10:28'),
(6, 1, 'tambah user', 'User in tambah user page', '2024-11-13 09:10:29'),
(7, 1, 'user', 'User in user page', '2024-11-13 09:10:32'),
(8, 1, 'user', 'User in user page', '2024-11-13 09:10:58'),
(9, 1, 'user', 'User in user page', '2024-11-13 09:11:23'),
(10, 1, 'user', 'User in user page', '2024-11-13 09:13:16'),
(11, 1, 'user', 'User in user page', '2024-11-13 09:14:31'),
(12, 1, 'user', 'User in user page', '2024-11-13 09:15:41'),
(13, 1, 'user', 'User added a new account', '2024-11-13 09:15:58'),
(14, 1, 'user', 'User in user page', '2024-11-13 09:15:58'),
(15, 1, 'user', 'User in user page', '2024-11-13 09:17:13'),
(16, 1, 'user', 'User in user page', '2024-11-13 09:18:00'),
(17, 3, 'logout', 'User logged out.', '2024-11-13 09:21:16'),
(18, 1, 'user', 'User in user page', '2024-11-13 09:21:30'),
(19, 1, 'user', 'User in user page', '2024-11-13 09:23:26'),
(20, 1, 'user', 'User in user page', '2024-11-13 09:23:48'),
(21, 1, 'user', 'User in user page', '2024-11-13 09:24:31'),
(22, 1, 'user', 'User in user page', '2024-11-13 09:24:42'),
(23, 1, 'user', 'User in user page', '2024-11-13 09:24:51'),
(24, 1, 'user', 'User in user page', '2024-11-13 09:25:01'),
(25, 1, 'user', 'User in user page', '2024-11-13 09:32:19'),
(26, 1, 'user', 'User in user page', '2024-11-13 09:34:08'),
(27, 1, 'buku', 'User in buku page', '2024-11-13 09:34:11'),
(28, 1, 'buku', 'User in buku page', '2024-11-13 09:34:23'),
(29, 1, 'buku', 'User in buku page', '2024-11-13 09:42:26'),
(30, 1, 'buku', 'User in buku page', '2024-11-13 09:43:02'),
(31, 1, 'buku', 'User in buku page', '2024-11-13 09:43:22'),
(32, 1, 'buku', 'User menambahkan buku', '2024-11-13 09:44:00'),
(33, 1, 'buku', 'User in buku page', '2024-11-13 09:44:00'),
(34, 1, 'buku', 'User in buku page', '2024-11-13 09:47:24'),
(35, 1, 'buku', 'User in buku page', '2024-11-13 09:47:37'),
(36, 1, 'buku', 'User deleted a buku data.', '2024-11-13 09:48:21'),
(37, 1, 'buku', 'User in buku page', '2024-11-13 09:48:21'),
(38, 1, 'buku', 'User menambahkan buku', '2024-11-13 09:48:31'),
(39, 1, 'buku', 'User in buku page', '2024-11-13 09:48:31'),
(40, 1, 'buku', 'User in buku page', '2024-11-13 09:48:39'),
(41, 1, 'buku', 'User in buku page', '2024-11-13 09:56:16'),
(42, 1, 'kategori', 'User in kategori page', '2024-11-13 09:56:31'),
(43, 1, 'kategori', 'User in kategori page', '2024-11-13 09:58:40'),
(44, 1, 'kategori', 'User in kategori page', '2024-11-13 09:58:58'),
(45, 1, 'kategori', 'User in kategori page', '2024-11-13 09:59:24'),
(46, 1, 'kategori', 'User in kategori page', '2024-11-13 09:59:37'),
(47, 1, 'kategori', 'User deleted a kategori data.', '2024-11-13 10:00:11'),
(48, 1, 'kategori', 'User in kategori page', '2024-11-13 10:00:12'),
(49, 1, 'kategori', 'User in kategori page', '2024-11-13 10:00:17'),
(50, 1, 'kategori', 'User in kategori page', '2024-11-13 10:03:08'),
(51, 1, 'kategori', 'User in kategori page', '2024-11-13 10:03:20'),
(52, 1, 'kategori', 'User in kategori page', '2024-11-13 10:03:44'),
(53, 1, 'kategori', 'User in kategori page', '2024-11-13 10:03:55'),
(54, 1, 'kategori', 'User in kategori page', '2024-11-13 10:04:08'),
(55, 1, 'kategori', 'User in kategori page', '2024-11-13 10:05:42'),
(56, 1, 'kategori', 'User in kategori page', '2024-11-13 10:06:17'),
(57, 1, 'kategori', 'User in kategori page', '2024-11-13 10:06:18'),
(58, 1, 'kategori', 'User in kategori page', '2024-11-13 10:06:24'),
(59, 1, 'kategori', 'User in kategori page', '2024-11-13 10:08:47'),
(60, 1, 'kategori', 'User in kategori page', '2024-11-13 10:08:53'),
(61, 1, 'kategori', 'User in kategori page', '2024-11-13 10:12:10'),
(62, 1, 'kategori', 'User in kategori page', '2024-11-13 10:12:16'),
(63, 1, 'kategori', 'User in kategori page', '2024-11-13 10:12:35'),
(64, 1, 'kategori', 'User in kategori page', '2024-11-13 10:15:16'),
(65, 1, 'kategori', 'User in kategori page', '2024-11-13 10:15:55'),
(66, 1, 'kategori', 'User in kategori page', '2024-11-13 10:16:02'),
(67, 1, 'kategori', 'User in kategori page', '2024-11-13 10:17:23'),
(68, 1, 'buku', 'User in buku page', '2024-11-13 10:18:31'),
(69, 1, 'buku', 'User in buku page', '2024-11-13 10:25:08'),
(70, 1, 'buku', 'User in buku page', '2024-11-13 10:28:04'),
(71, 1, 'buku', 'User in buku page', '2024-11-13 10:28:22'),
(72, 1, 'buku', 'User in buku page', '2024-11-13 10:31:11'),
(73, 1, 'buku', 'User in buku page', '2024-11-13 10:31:42'),
(74, 1, 'buku', 'User in buku page', '2024-11-13 10:32:06'),
(75, 1, 'buku', 'User in buku page', '2024-11-13 10:37:09'),
(76, 1, 'buku', 'User in buku page', '2024-11-13 10:37:52'),
(77, 1, 'buku', 'User in buku page', '2024-11-13 10:38:09'),
(78, 1, 'buku', 'User in buku page', '2024-11-13 10:38:19'),
(79, 1, 'buku', 'User menambahkan buku', '2024-11-13 10:38:43'),
(80, 1, 'buku', 'User in buku page', '2024-11-13 10:38:43'),
(81, 1, 'buku', 'User in buku page', '2024-11-13 10:39:08'),
(82, 1, 'buku', 'User in buku page', '2024-11-13 10:39:22'),
(83, 1, 'buku', 'User in buku page', '2024-11-13 10:42:06'),
(84, 1, 'buku', 'User in buku page', '2024-11-13 10:42:22'),
(85, 1, 'buku', 'User in buku page', '2024-11-13 10:42:29'),
(86, 1, 'buku', 'User in buku page', '2024-11-13 10:44:18'),
(87, 1, 'buku', 'User in buku page', '2024-11-13 10:45:23'),
(88, 1, 'buku', 'User in buku page', '2024-11-13 10:45:35'),
(89, 1, 'buku', 'User in buku page', '2024-11-13 10:45:58'),
(90, 1, 'buku', 'User in buku page', '2024-11-13 10:48:26'),
(91, 1, 'buku', 'User in buku page', '2024-11-13 10:48:31'),
(92, 1, 'buku', 'User in buku page', '2024-11-13 10:50:22'),
(93, 1, 'buku', 'User in buku page', '2024-11-13 10:50:28'),
(94, 1, 'kategori', 'User in kategori page', '2024-11-13 10:51:07'),
(95, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 10:51:10'),
(96, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 10:51:31'),
(97, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 10:55:09'),
(98, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 10:55:22'),
(99, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 10:56:28'),
(100, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 10:57:05'),
(101, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 11:04:20'),
(102, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 11:05:32'),
(103, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 11:19:37'),
(104, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 11:19:49'),
(105, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 11:21:28'),
(106, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 11:30:57'),
(107, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 11:30:59'),
(108, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 11:31:04'),
(109, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 11:31:15'),
(110, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 11:48:12'),
(111, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 12:06:34'),
(112, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 12:07:49'),
(113, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 12:07:52'),
(114, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 12:07:54'),
(115, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 12:11:28'),
(116, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 12:12:31'),
(117, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 12:15:25'),
(118, 1, 'kategori', 'User in kategori page', '2024-11-13 18:24:28'),
(119, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 18:24:30'),
(120, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 18:25:03'),
(121, 1, 'ulasan', 'User in ulasan page', '2024-11-13 18:25:08'),
(122, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 18:25:11'),
(123, 1, 'peminjaman', 'User in peminjaman page', '2024-11-13 18:31:15'),
(124, 1, 'ulasan', 'User in ulasan page', '2024-11-13 18:31:17'),
(125, 1, 'ulasan', 'User in ulasan page', '2024-11-13 18:33:25'),
(126, 1, 'ulasan', 'User in ulasan page', '2024-11-13 18:33:32'),
(127, 1, 'ulasan', 'User in ulasan page', '2024-11-13 18:33:56'),
(128, 1, 'ulasan', 'User in ulasan page', '2024-11-13 18:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `tahun_terbit` date DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `id_kategori`) VALUES
(2, 'newjeans', 'new hair new tee new pussy', 'aria', '2024-11-19', 3),
(3, 'Javid lovers', 'helminx', 'julio laiberto', '2024-11-13', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Buku Non-Fiksi'),
(3, 'Buku Pelajaran');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_relasi`
--

CREATE TABLE `kategori_relasi` (
  `id_kategoribuku` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koleksi`
--

CREATE TABLE `koleksi` (
  `id_koleksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status_peminjaman` enum('dikembalikan','dipinjam') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status_peminjaman`) VALUES
(1, 1, 2, '2024-11-14', '2024-11-16', 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulusan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `ulasan` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `level` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `pw`, `email`, `nama_lengkap`, `alamat`, `level`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'paopaogasgas@gmail.com', 'aria savana', 'anggrek permai', '1'),
(2, 'aria', 'd41d8cd98f00b204e9800998ecf8427e', 'paopaogasgas@gmail.com', 'jing wen', 'winner kencana', '2'),
(3, 'julio laiberto', '202cb962ac59075b964b07152d234b70', 'juliolaiberto26@gmail.com', 'julio laiberto', 'orchid park', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_relasi`
--
ALTER TABLE `kategori_relasi`
  ADD PRIMARY KEY (`id_kategoribuku`);

--
-- Indexes for table `koleksi`
--
ALTER TABLE `koleksi`
  ADD PRIMARY KEY (`id_koleksi`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulusan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_relasi`
--
ALTER TABLE `kategori_relasi`
  MODIFY `id_kategoribuku` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `koleksi`
--
ALTER TABLE `koleksi`
  MODIFY `id_koleksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulusan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
