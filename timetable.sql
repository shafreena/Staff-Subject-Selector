-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2020 at 05:30 PM
-- Server version: 10.5.0-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL,
  `seniority` int(11) NOT NULL,
  `sub2` varchar(100) NOT NULL DEFAULT 'nil'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `seniority`, `sub2`) VALUES
('A', 1, 'nil'),
('B', 2, 'nil'),
('C', 3, 'nil'),
('D', 4, 'nil'),
('E', 5, 'nil');

-- --------------------------------------------------------

--
-- Table structure for table `paper`
--

CREATE TABLE `paper` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paper`
--

INSERT INTO `paper` (`id`, `subject`, `rank`) VALUES
(1, 'aaa', 0),
(2, 'bbb', 0),
(3, 'ccc', 0),
(4, 'ddd', 0),
(5, 'eee', 0),
(6, 'fff', 0),
(7, 'ggg', 0),
(8, 'hhh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `staff` varchar(20) NOT NULL,
  `sub` varchar(20) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `sub1` varchar(50) NOT NULL DEFAULT 'nil'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`staff`, `sub`, `rank`, `sub1`) VALUES
('root', 'abc', 1, 'nil'),
('E', 'a', 5, 'nil'),
('A', 'b', 1, 'nil'),
('B', 'c', 2, 'nil'),
('C', 'd', 3, 'nil'),
('D', 'e', 4, 'nil');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
