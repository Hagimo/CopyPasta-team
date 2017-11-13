-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2017 at 02:42 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polytech`
--

-- --------------------------------------------------------

--
-- Table structure for table `casopis`
--

CREATE TABLE `casopis` (
  `casopis_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `rok` year(4) NOT NULL,
  `cislo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `casopis`
--

INSERT INTO `casopis` (`casopis_id`, `path`, `rok`, `cislo`) VALUES
(0, 'casopisi/LOGOS POLYTECHNIKOS 1_2017.pdf', 2017, 1),
(1, 'casopisi/LOGOS POLYTECHNIKOS 2_2017.pdf', 2017, 2),
(2, 'casopisi/LOGOS POLYTECHNIKOS 3_2017.pdf', 2017, 3),
(3, 'casopisi/LOGOS POLYTECHNIKOS 1_2016.pdf', 2016, 1),
(4, 'casopisi/LOGOS POLYTECHNIKOS 2_2016.pdf', 2016, 2),
(5, 'casopisi/LOGOS POLYTECHNIKOS 3_2016.pdf', 2016, 3),
(6, 'casopisi/LOGOS POLYTECHNIKOS 4_2016.pdf', 2016, 4),
(7, 'casopisi/LOGOS POLYTECHNIKOS 1_2015.pdf', 2015, 1),
(8, 'casopisi/LOGOS POLYTECHNIKOS 2_2015.pdf', 2015, 2),
(9, 'casopisi/LOGOS POLYTECHNIKOS 3_2015.pdf', 2015, 3),
(10, 'casopisi/LOGOS POLYTECHNIKOS 4_2015.pdf', 2015, 4),
(11, 'casopisi/LOGOS POLYTECHNIKOS 1_2014.pdf', 2014, 1),
(12, 'casopisi/LOGOS POLYTECHNIKOS 2_2014.pdf', 2014, 2),
(13, 'casopisi/LOGOS POLYTECHNIKOS 3_2014.pdf', 2014, 3),
(14, 'casopisi/LOGOS POLYTECHNIKOS 4_2014.pdf', 2014, 4),
(15, 'casopisi/LOGOS POLYTECHNIKOS 1_2013.pdf', 2013, 1),
(16, 'casopisi/LOGOS POLYTECHNIKOS 2_2013.pdf', 2013, 2),
(17, 'casopisi/LOGOS POLYTECHNIKOS 3_2013.pdf', 2013, 3),
(18, 'casopisi/LOGOS POLYTECHNIKOS 4_2013.pdf', 2013, 4),
(19, 'casopisi/LOGOS POLYTECHNIKOS 1_2012.pdf', 2012, 1),
(20, 'casopisi/LOGOS POLYTECHNIKOS 2_2012.pdf', 2012, 2),
(21, 'casopisi/LOGOS POLYTECHNIKOS 3_2012.pdf', 2012, 3),
(22, 'casopisi/LOGOS POLYTECHNIKOS 4_2012.pdf', 2012, 4),
(23, 'casopisi/LOGOS POLYTECHNIKOS 1_2011.pdf', 2011, 1),
(24, 'casopisi/LOGOS POLYTECHNIKOS 2_2011.pdf', 2011, 2),
(25, 'casopisi/LOGOS POLYTECHNIKOS 3_2011.pdf', 2011, 3),
(26, 'casopisi/LOGOS POLYTECHNIKOS 4_2011.pdf', 2011, 4),
(27, 'casopisi/LOGOS POLYTECHNIKOS 1_2010.pdf', 2010, 1),
(28, 'casopisi/LOGOS POLYTECHNIKOS 2_2010.pdf', 2010, 2),
(29, 'casopisi/LOGOS POLYTECHNIKOS 3_2010.pdf', 2010, 3),
(30, 'casopisi/LOGOS POLYTECHNIKOS 4_2010.pdf', 2010, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `casopis`
--
ALTER TABLE `casopis`
  ADD PRIMARY KEY (`casopis_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
