-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 21 Jul 2020 pada 01.12
-- Versi Server: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloggo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL COMMENT 'dont edit this field',
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `date` varchar(225) NOT NULL,
  `newDate` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `article`
--

INSERT INTO `article` (`article_id`, `name`, `title`, `subtitle`, `date`, `newDate`, `status`) VALUES
(2, 'Zuma Akbar', 'PEMULIHAN AKUN', 'asdfggafdg', '20-07-2020', '20-07-2020', 'unpublished'),
(6, 'Zuma Akbar', 'Aku Sayang Kamu', 'Kamu Sayang Aku', '20-07-2020', '', 'published'),
(8, 'Paijo', 'Gorengannya mas?', 'kisah cerdikiawanita', '20-07-2020', '', 'published');

-- --------------------------------------------------------

--
-- Struktur dari tabel `article_details`
--

CREATE TABLE `article_details` (
  `article_id` int(11) NOT NULL COMMENT 'dont edit this field',
  `title` varchar(255) NOT NULL,
  `content1` varchar(255) NOT NULL,
  `content2` varchar(255) NOT NULL,
  `content3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `article_details`
--

INSERT INTO `article_details` (`article_id`, `title`, `content1`, `content2`, `content3`) VALUES
(2, 'PEMULIHAN AKUN', 'aaaa', 'sssss', 'ddddda'),
(6, 'Aku Sayang Kamu', 'aaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaa  ', 'The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten.', 'cccccccccccc ccccccccccccccccccccccccccccc ccccccccccccccccccccccccccc cccccccccccccccccccccccccccccc cccccccccccccccccccccccccccccccc'),
(8, 'Gorengannya mas?', 'apa elo tegaaaaa wkwkwk', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(10) NOT NULL,
  `sosmed` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `level`, `sosmed`) VALUES
(1, 'Zuma Akbar', 'zuma', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'admin', 'https://google.com/'),
(2, 'Paijo', 'demos', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'member', ''),
(3, 'toolsa', 'apasih', '063018fc5778f887f7378fbde34dbcc4adf04d36', 'member', 'https://facebook.com/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `article_details`
--
ALTER TABLE `article_details`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'dont edit this field', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `article_details`
--
ALTER TABLE `article_details`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'dont edit this field', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
