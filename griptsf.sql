-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2021 at 12:35 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `griptsf`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(6) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `currbal` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `currbal`) VALUES
(1, 'Eeshan', 'eeshan@email.co', 24600),
(2, 'Kunal', 'kunal@email.co', 14800),
(3, 'Parameswaran', 'paramesr@email.co', 54045),
(4, 'Vidhika', 'vidhika@email.co', 12548),
(5, 'Kartavya', 'kartavya@email.co', 55051),
(6, 'Nitish', 'nitish@email.co', 45661),
(7, 'Suresh', 'suresh@email.co', 78421),
(8, 'Jatin', 'jatin@email.co', 12552),
(9, 'Tiasha', 'tiash@email.co', 12345),
(10, 'Charu', 'charu@email.co', 54321),
(11, 'abc', 'abc@c.com', 123),
(12, 'test', 'test@test.com', 123);

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `trans_id` int(11) NOT NULL,
  `sender` int(11) DEFAULT NULL,
  `reciever` int(11) DEFAULT NULL,
  `amnt` int(11) NOT NULL,
  `tr_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`trans_id`, `sender`, `reciever`, `amnt`, `tr_dt`) VALUES
(9, 1, 5, 44, '2021-05-13 20:51:23'),
(10, 1, 6, 450, '2021-05-13 20:51:40'),
(11, 1, 8, 6, '2021-05-13 20:52:59'),
(12, 2, 1, 100, '2021-05-13 20:53:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
