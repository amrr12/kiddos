-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 24, 2023 at 12:38 AM
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
-- Database: `DataBase`
--

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `id` int(10) NOT NULL,
  `child_name` varchar(50) NOT NULL,
  `child_last_name` varchar(50) NOT NULL,
  `birthDate` date NOT NULL,
  `password` varchar(50) NOT NULL,
  `parent_name` varchar(50) NOT NULL,
  `parent_last_name` varchar(50) NOT NULL,
  `parent_email` varchar(50) NOT NULL,
  `parent_phone` varchar(50) NOT NULL,
  `mark` int(11) DEFAULT NULL,
  `absences` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`id`, `child_name`, `child_last_name`, `birthDate`, `password`, `parent_name`, `parent_last_name`, `parent_email`, `parent_phone`, `mark`, `absences`) VALUES
(2, 'mayssem', 'maatallah', '2023-05-11', '11111', 'mohamed', 'nour', 'nour@gmail.com', '21474000', 20, 3),
(6, 'yahya', 'nour', '2023-05-16', '123456789', 'mohamed', 'nour', 'yahya@gmail.com', '11222333', 20, 2),
(7, 'amr', 'akrimi', '2023-05-16', 'amr123456', 'slaheddine', 'akrimi', 'amer1919ab@gmail.com', '21474000', 15, 15),
(8, 'samira', 'guizeni', '2023-05-18', 'samira123', 'fathi', 'guizeni', 'samira@gmail.com', '23454454', 0, 0),
(9, 'mohamed', 'karim', '2023-04-30', 'mohamed123', 'amin', 'karim', 'mohamed@gmail.com', '23454455', 0, 1),
(10, 'salim', 'simou', '2023-04-28', 'salim123', 'mostfa', 'sousou', 'salim@gmail.com', '23454456', 0, 0),
(11, 'alae', 'nour', '2023-04-18', 'alae123', 'souad', 'afi', 'nourr@gmail.com', '23454457', 20, 0),
(12, 'maram', 'guizeni', '2019-04-14', 'maram123', 'najla', 'guizeni', 'maram@gmail.com', '23454458', 0, 0),
(13, 'amrou', 'akrimi', '2023-05-11', 'teacher11', 'lamya', 'akrimi', 'admin@gmail.com', '21478541', 0, 0),
(14, 'abdsmad', 'beneni', '2022-05-09', 'abdsmad123', 'abdltif', 'beneni', 'abdsmad@gmail.com', '96512345', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
