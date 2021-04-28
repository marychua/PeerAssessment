-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 04:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ha07`
--

-- --------------------------------------------------------

--
-- Table structure for table `grading`
--

CREATE TABLE `grading` (
  `GRID` varchar(99) NOT NULL,
  `GRADEID` varchar(99) DEFAULT NULL,
  `UID` varchar(99) NOT NULL,
  `RATE` int(11) NOT NULL,
  `COMMENT` varchar(999) NOT NULL,
  `STATUS` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grading`
--

INSERT INTO `grading` (`GRID`, `GRADEID`, `UID`, `RATE`, `COMMENT`, `STATUS`) VALUES
('R20201203021534', '20201130224502', '20201113013156', 5, 'sup', 'Completed'),
('R20201203120655', '20201130110119', 'U20201203120612', 5, 'Very nice girl', 'Completed'),
('R20201203121428', 'U20201203120300', '20201113013156', 2, 'Terrible teammate', 'Completed'),
('R20201203121804', 'U20201203120300', '20201130224502', 4, 'ok only', 'Completed'),
('R20201203123112', 'U20201203121152', 'U20201203123041', 9, 'Nice guy', 'Completed'),
('R20201204114015', '20201113013156', 'U20201203120300', 6, '123123', 'Completed'),
('R20201204114039', '20201130224502', 'U20201203120300', 9, 'Best Student!', 'Completed'),
('R20201204153043', '20201113013156', '20201130224502', 10, 'Very very good', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `PID` varchar(99) NOT NULL,
  `UID` varchar(99) NOT NULL,
  `PICNAME` varchar(99) NOT NULL,
  `EXTENSION` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`PID`, `UID`, `PICNAME`, `EXTENSION`) VALUES
('P20201113013156', '20201113013156', 'z4.jpeg', '.jpeg'),
('P20201130110119', '20201130110119', 'z3.png', '.png'),
('P20201130224502', '20201130224502', 'z2.jpg', '.jpg'),
('P20201203120300', 'U20201203120300', 'z4.jpeg', '.jpeg'),
('P20201203120612', 'U20201203120612', 'z3.png', '.png'),
('P20201203121152', 'U20201203121152', 'z2.jpg', '.jpg'),
('P20201203123041', 'U20201203123041', 'z3.png', '.png');

-- --------------------------------------------------------

--
-- Table structure for table `studentgroup`
--

CREATE TABLE `studentgroup` (
  `GID` varchar(99) NOT NULL,
  `GNAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentgroup`
--

INSERT INTO `studentgroup` (`GID`, `GNAME`) VALUES
('G000000001', 'Group 1'),
('G000000002', 'Group 2'),
('G000000003', 'Group 3'),
('G000000004', 'Group 4'),
('G000000005', 'Group 5'),
('G000000006', 'Group 6'),
('G000000007', 'Group 7'),
('G000000008', 'Group 8'),
('G000000009', 'Group 9'),
('G000000010', 'Group 10');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `TID` varchar(99) NOT NULL,
  `TUTORNAME` varchar(99) NOT NULL,
  `TUTORPASS` varchar(99) NOT NULL,
  `ROLE` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`TID`, `TUTORNAME`, `TUTORPASS`, `ROLE`) VALUES
('T000000000 ', '000000000 ', '4c93008615c2d041e33ebac605d14b5b', 'TUTOR');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `UPLOADID` varchar(99) NOT NULL,
  `UPLOADERID` varchar(99) NOT NULL,
  `REFERALID` varchar(99) NOT NULL,
  `GRID` varchar(99) NOT NULL,
  `FILENAME` varchar(999) NOT NULL,
  `EXTENSION` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`UPLOADID`, `UPLOADERID`, `REFERALID`, `GRID`, `FILENAME`, `EXTENSION`) VALUES
('UP202012030612140', '20201113013156', '20201130224502', 'R20201203021534', 'z4.jpeg', '.jpeg'),
('UP202012030612141', '20201113013156', '20201130224502', 'R20201203021534', 'z1.JPG', '.JPG'),
('UP202012030612142', '20201113013156', '20201130224502', 'R20201203021534', 'z2.jpg', '.jpg'),
('UP202012030612143', '20201113013156', '20201130224502', 'R20201203021534', 'z3.png', '.png'),
('UP202012031224330', '20201113013156', 'U20201203120300', 'R20201203121428', 'z1.JPG', '.JPG'),
('UP202012031224331', '20201113013156', 'U20201203120300', 'R20201203121428', 'z2.jpg', '.jpg'),
('UP202012031224332', '20201113013156', 'U20201203120300', 'R20201203121428', 'z3.png', '.png'),
('UP202012031227190', '20201130224502', 'U20201203120300', 'R20201203121804', 'z2.jpg', '.jpg'),
('UP202012031232290', 'U20201203123041', 'U20201203121152', 'R20201203123112', 'z2.jpg', '.jpg'),
('UP202012041143160', 'U20201203120300', '20201130224502', 'R20201204114039', 'z1.JPG', '.JPG'),
('UP202012041143161', 'U20201203120300', '20201130224502', 'R20201204114039', 'z2.jpg', '.jpg'),
('UP202012041143162', 'U20201203120300', '20201130224502', 'R20201204114039', 'z3.png', '.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UID` varchar(99) NOT NULL,
  `USERNAME` varchar(99) NOT NULL,
  `USERPASS` varchar(99) NOT NULL,
  `USEREMAIL` varchar(99) NOT NULL,
  `FNAME` varchar(99) NOT NULL,
  `LNAME` varchar(99) NOT NULL,
  `GID` varchar(99) NOT NULL,
  `ROLE` varchar(99) NOT NULL,
  `GENDER` varchar(99) DEFAULT NULL,
  `ADDRESS` varchar(99) DEFAULT NULL,
  `CITY` varchar(99) DEFAULT NULL,
  `STATE` varchar(99) DEFAULT NULL,
  `ZIP` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UID`, `USERNAME`, `USERPASS`, `USEREMAIL`, `FNAME`, `LNAME`, `GID`, `ROLE`, `GENDER`, `ADDRESS`, `CITY`, `STATE`, `ZIP`) VALUES
('00000000000001', 'admin', '0123', 'xxxx', '', '', 'G000000001', 'admin', '', '', '', '', ''),
('00000000000002', 'admin', '0123', 'xxxx', '', '', 'G000000010', 'admin', '', '', '', '', ''),
('00000000000003', 'admin', '0123', 'xxxx', '', '', 'G000000002', 'admin', '', '', '', '', ''),
('00000000000004', 'admin', '0123', 'xxxx', '', '', 'G000000005', 'admin', '', '', '', '', ''),
('00000000000005', 'admin', '0123', 'xxxx', '', '', 'G000000003', 'admin', '', '', '', '', ''),
('00000000000006', 'admin', '0123', 'xxxx', '', '', 'G000000004', 'admin', '', '', '', '', ''),
('00000000000007', 'admin', '0123', 'xxxx', '', '', 'G000000006', 'admin', '', '', '', '', ''),
('00000000000008', 'admin', '0123', 'xxxx', '', '', 'G000000007', 'admin', '', '', '', '', ''),
('00000000000009', 'admin', '0123', 'xxxx', '', '', 'G000000008', 'admin', '', '', '', '', ''),
('00000000000010', 'admin', '0123', 'xxxx', '', '', 'G000000009', 'admin', '', '', '', '', ''),
('20201113013156', '123456789', '202cb962ac59075b964b07152d234b70', 'jasonong881128@gmail.com', 'Jason', 'Ong', 'G000000001', 'student', '', '', '', '', ''),
('20201130110119', '123123123', 'e10adc3949ba59abbe56e057f20f883e', 'jasonong8811282@gmail.com', 'Mary', 'Chua', 'G000000002', 'student', '', '', '', '', ''),
('20201130224502', '222222222', 'e10adc3949ba59abbe56e057f20f883e', 'jasonong8811283@gmail.com', 'Jet', 'Li', 'G000000001', 'student', '', '', '', '', ''),
('U20201203120300', '098765432', '202cb962ac59075b964b07152d234b70', 'marianchuasiowen97@gmail.com', 'Sammy', 'Chung', 'G000000001', 'student', 'Female', 'Airpanas', 'Setapak', 'KL', '53200'),
('U20201203120612', '122222222', '202cb962ac59075b964b07152d234b70', 'chuasiowen@gmail.com', 'Kimberly', 'Ann', 'G000000002', 'student', NULL, NULL, NULL, NULL, NULL),
('U20201203121152', '333333333', '202cb962ac59075b964b07152d234b70', 'chuafamily911@gmail.com', 'George', 'Cain', 'G000000003', 'student', NULL, NULL, NULL, NULL, NULL),
('U20201203123041', '123412341', '202cb962ac59075b964b07152d234b70', 'marycse2110@gmail.com', 'James', 'Renold', 'G000000003', 'student', NULL, NULL, NULL, NULL, NULL),
('U20201204151928', '123456788', '202cb962ac59075b964b07152d234b70', 'marycse21101@gmail.com', 'Cammy', 'Ann', 'G000000002', 'student', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grading`
--
ALTER TABLE `grading`
  ADD PRIMARY KEY (`GRID`),
  ADD KEY `gradingtouser` (`UID`),
  ADD KEY `usertograding` (`GRADEID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `studentgroup`
--
ALTER TABLE `studentgroup`
  ADD PRIMARY KEY (`GID`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`TID`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`UPLOADID`),
  ADD KEY `uploadtograding` (`GRID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UID`),
  ADD KEY `usertogroup` (`GID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grading`
--
ALTER TABLE `grading`
  ADD CONSTRAINT `gradingtouser` FOREIGN KEY (`UID`) REFERENCES `user` (`UID`),
  ADD CONSTRAINT `usertograding` FOREIGN KEY (`GRADEID`) REFERENCES `user` (`UID`);

--
-- Constraints for table `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `uploadtograding` FOREIGN KEY (`GRID`) REFERENCES `grading` (`GRID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `usertogroup` FOREIGN KEY (`GID`) REFERENCES `studentgroup` (`GID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
