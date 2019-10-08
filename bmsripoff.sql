-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2019 at 05:14 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmsripoff`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE `admin_log` (
  `Admin` varchar(200) NOT NULL,
  `Pass` varchar(500) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_log`
--

INSERT INTO `admin_log` (`Admin`, `Pass`, `Name`) VALUES
('AllenNo1', '$2y$10$9j/RKOFi19epwxDSDuOGO.Tkh6DlNRRdflSzlSh.HDqlOZCshg/IG', 'Allleeeeeen');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `uid` varchar(50) NOT NULL,
  `Bid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Saves the bookings for each user';

-- --------------------------------------------------------

--
-- Table structure for table `deets`
--

CREATE TABLE `deets` (
  `Name` varchar(50) NOT NULL,
  `Synop` mediumtext,
  `PGRating` enum('U','UA','A','S') NOT NULL DEFAULT 'U',
  `Language` varchar(15) DEFAULT '"English"'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Just contains movie deets. ';

--
-- Dumping data for table `deets`
--

INSERT INTO `deets` (`Name`, `Synop`, `PGRating`, `Language`) VALUES
('Abc', '&lt;insert copypasta&gt;', 'A', 'sas'),
('Ass', 'This Movie is entirely about ass. There is so much ass it\'s unbelievable, how much ass there is. IT\'S EVERYWHERE. JUST ASS.', 'U', 'Hindi');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `uid` varchar(50) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is the Table with Login details for the user';

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`uid`, `pass`, `Name`) VALUES
('a', '$2y$10$4107pumym.QzMGuC4.i5JOP5PUIsThPKTf3m./ZKekADmrf.K/hSm', 'a'),
('cse123', '$2y$10$a1sEsVMy.bFcmFyZnee1ROpwObcE3X2byS6xs76IjMTYE0tl7DkMa', 'sjbit'),
('gg69', '$2y$10$RvWQmEaxGuWsw/9aq6V6suYM78Qa6xtu2VRBCeaVGbExIBjjaKgra', 'Gaurav'),
('mub123', '$2y$10$k8NVGArkQxyIU3UacTFplumzy9Z7c9H3i8BTb8a9zHMU9Nyl/GE/m', 'md mubeen'),
('vru', '$2y$10$AkOXvS84SrQj0kytPnqzcejXxCgFX9l5.UiJ1Bd6xTA4EXx1mugV.', 'Varuni');

-- --------------------------------------------------------

--
-- Table structure for table `moviet`
--

CREATE TABLE `moviet` (
  `Name` varchar(50) NOT NULL,
  `Screen` varchar(3) NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Holds Screens and time a movie is running at';

--
-- Dumping data for table `moviet`
--

INSERT INTO `moviet` (`Name`, `Screen`, `Time`) VALUES
('Ass', 's1', '09:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `s1`
--

CREATE TABLE `s1` (
  `Sno` int(11) NOT NULL,
  `bid` varchar(50) NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Booked seats for a given show';

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `SName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`SName`) VALUES
('s1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`Admin`(50));

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`uid`,`Bid`);

--
-- Indexes for table `deets`
--
ALTER TABLE `deets`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `moviet`
--
ALTER TABLE `moviet`
  ADD PRIMARY KEY (`Screen`,`Time`);

--
-- Indexes for table `s1`
--
ALTER TABLE `s1`
  ADD PRIMARY KEY (`Sno`,`bid`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`SName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
