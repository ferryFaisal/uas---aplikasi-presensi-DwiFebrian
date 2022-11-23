-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2022 at 02:09 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` char(10) DEFAULT NULL,
  `modified` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `name`, `password`, `role`, `created`, `modified`) VALUES
('dwi.febrian38@gmail.com', 'Dwi Febrianto Halim', '056eafe7cf52220de2df36845b8ed170c67e23e3', 'admin', '2022-11-22', '2022-11-22'),
('dwi.febrian66@gmail.com', 'wik', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', 'dosen', '2022-11-23', '2022-11-23'),
('dwi.febrian8@gmail.com', 'dwii', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin', '2022-11-23', '2022-11-23'),
('dwi.febrian@gmail.com', 'Uwikk', 'a938dfdfbaa1f25ccbc39e16060f73c44e5ef0dd', 'dosen', '2022-11-22', '2022-11-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
