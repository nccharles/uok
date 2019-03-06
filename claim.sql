-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2019 at 02:42 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `claim`
--

-- --------------------------------------------------------

--
-- Table structure for table `annoucement`
--

CREATE TABLE `annoucement` (
  `annid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `pdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `annoucement`
--

INSERT INTO `annoucement` (`annid`, `title`, `body`, `pdate`) VALUES
(2, 'Feedback', 'Hey , Twabonye ikibazo cyawe ihangane tugiye kukigaho tuzagusubiza vuba bidatinze.Urakoze kwihangana!', '2018-05-26 17:54:17'),
(3, 'Meeting', 'we would like to inform you that tomorrow there is a meeting', '2018-05-26 18:48:02'),
(4, 'Leaning meeting', 'Welcome to our new learning course meeting', '2018-05-27 09:33:51'),
(5, 'Leaning meeting', 'Welcome to learning meeting at Hall', '2018-05-27 09:43:19'),
(6, 'Meeting', 'Munama sha ', '2018-05-27 10:17:58'),
(7, 'Munama', 'Mutumiwe mu nama', '2018-05-27 10:21:27'),
(8, 'Munama', 'Utumiwe munama', '2018-05-27 10:24:28'),
(9, 'Meeting', 'Muraho', '2018-07-16 13:32:09'),
(10, 'Meeting', 'dff,mfbv', '2018-07-16 13:32:40'),
(11, 'Leaning meeting', 'kjsdbjksdsd', '2018-07-16 14:06:12'),
(12, 'Meeting', 'fgdxcvvbkhcgv', '2018-07-16 17:36:43'),
(13, 'Feedback', 'Hey , Twabonye ikibazo cyawe ihangane tugiye kukigaho tuzagusubiza vuba bidatinze.Urakoze kwihangana!', '2019-03-06 12:30:28'),
(14, 'Check availability', 'Ok we need you to check if you are our students', '2019-03-06 14:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

CREATE TABLE `claim` (
  `claimid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `ccode` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claim`
--

INSERT INTO `claim` (`claimid`, `sid`, `ccode`, `lid`, `level`, `reason`, `status`) VALUES
(1, 2, 200, 1, 'level 1', 'Oh ni macye', '1');

-- --------------------------------------------------------

--
-- Table structure for table `courselevel`
--

CREATE TABLE `courselevel` (
  `clevid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `levid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `cid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `ccode` int(11) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`cid`, `lid`, `ccode`, `cname`, `level`) VALUES
(1, 1, 200, 'Networking', 'level 1'),
(2, 3, 500, 'Artificial Intelligence', 'level 2'),
(3, 4, 820, 'Maths', 'level 1'),
(4, 5, 878, 'English', 'level 2');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `hid` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`hid`, `fname`, `lname`, `gender`, `email`, `phone`, `password`) VALUES
(1, 'NYAKUNDI', 'Mercy', 'Male', 'mercy@gmail.com', '0784525865', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `lid` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`lid`, `fname`, `lname`, `gender`, `email`, `phone`, `password`) VALUES
(1, 'KATENDE', 'Nicolas', 'Male', 'nicolas@gmail.com', '0784625458', 'katende'),
(2, 'MUKAMA', 'Elyse', 'Male', 'elyse@gmail.com', '0784578525', 'pass'),
(3, 'KAYITABA', 'RWIRANGIRA', 'Male', 'kayitaba@gmail.com', '0784582562', 'pass'),
(4, 'Musoni', 'Kamitali', 'Male', 'nccharles1@gmail.com', '0782568582', 'pass'),
(5, 'Mutoni', 'alice', 'Female', 'alice@gmail.com', '0784528563', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `lectureannouncement`
--

CREATE TABLE `lectureannouncement` (
  `lannid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `annid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lectureannouncement`
--

INSERT INTO `lectureannouncement` (`lannid`, `lid`, `annid`, `status`) VALUES
(1, 1, 12, '1'),
(2, 1, 12, '1'),
(3, 1, 12, '1');

-- --------------------------------------------------------

--
-- Table structure for table `lecturesesslevel`
--

CREATE TABLE `lecturesesslevel` (
  `llevid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `slevid` int(11) NOT NULL,
  `ccode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturesesslevel`
--

INSERT INTO `lecturesesslevel` (`llevid`, `lid`, `slevid`, `ccode`) VALUES
(1, 3, 2, '500'),
(2, 4, 1, '820'),
(3, 5, 2, '878');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `levid` int(11) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`levid`, `level`) VALUES
(1, 'level 1'),
(2, 'level 2'),
(3, 'level 3');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `mid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `ass1` int(11) NOT NULL,
  `ass2` int(11) NOT NULL,
  `cat1` int(11) NOT NULL,
  `cat2` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`mid`, `cid`, `sid`, `ass1`, `ass2`, `cat1`, `cat2`, `exam`, `level`, `status`, `date_added`) VALUES
(1, 1, 2, 10, 8, 15, 18, 31, 'level 1', '1', '2018-07-16 15:52:51'),
(2, 1, 3, 4, 5, 8, 10, 14, 'level 1', '1', '2018-07-16 16:53:53'),
(3, 1, 5, 8, 9, 10, 18, 35, 'level 1', '1', '2018-07-16 17:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `registrar`
--

CREATE TABLE `registrar` (
  `rid` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrar`
--

INSERT INTO `registrar` (`rid`, `fname`, `lname`, `gender`, `phone`, `email`, `password`) VALUES
(1, 'MULISA', 'Daniel', 'Male', '0782568525', 'danny@gmail.com', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `Session`
--

CREATE TABLE `Session` (
  `sID` int(11) NOT NULL,
  `Sessname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Session`
--

INSERT INTO `Session` (`sID`, `Sessname`) VALUES
(1, 'Day'),
(2, 'Evening'),
(3, 'Weekend');

-- --------------------------------------------------------

--
-- Table structure for table `sesslevel`
--

CREATE TABLE `sesslevel` (
  `seslevid` int(11) NOT NULL,
  `sID` int(11) NOT NULL,
  `levid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sesslevel`
--

INSERT INTO `sesslevel` (`seslevid`, `sID`, `levid`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 2, 2),
(6, 2, 3),
(7, 3, 1),
(8, 3, 2),
(9, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sid` int(11) NOT NULL,
  `regnum` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `regnum`, `fname`, `lname`, `gender`, `email`, `phone`, `password`) VALUES
(1, 'W/BIT/15/05/2018', 'Charles', 'Ndayisaba', 'Male', 'nccharles1@gmail.com', '0784603404', 'pass'),
(2, 'D/BIT/15/05/2018', 'Mugisha ', 'Steven', 'Male', 'steven@gmail.com', '0787582585', 'pass1'),
(3, 'E/BIT/15/05/2018', 'Mukamana', 'Emma', 'Female', 'emma@gmail.com', '0783935192', 'pass'),
(4, 'W/BIT/18/05/2018', 'NIYIGENA', 'Callixte', 'Male', 'callixte@gmail.com', '0784603404', 'pass'),
(5, 'E/BIT/17/05/2018', 'AKIMANA', 'Console', 'Female', 'akimana@gmail.com', '0787582585', 'pass'),
(6, 'BIT/15/05/2010', 'BATAMURIZA', 'Jacky', 'Female', 'batamujacky@gmail.com', '0789194626', 'pass'),
(7, 'W/2039/2/2018', 'Charles', 'Ndayisaba', 'Male', 'safalijean@gmail.com', '0784603402', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `studentannoucement`
--

CREATE TABLE `studentannoucement` (
  `sannid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `annid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentannoucement`
--

INSERT INTO `studentannoucement` (`sannid`, `sid`, `annid`, `status`) VALUES
(1, 2, 4, 1),
(2, 2, 7, 1),
(3, 3, 14, 1),
(4, 6, 14, 0),
(5, 7, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `studentsesslevel`
--

CREATE TABLE `studentsesslevel` (
  `stlevid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `seslevid` int(11) NOT NULL,
  `Ystatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentsesslevel`
--

INSERT INTO `studentsesslevel` (`stlevid`, `sid`, `seslevid`, `Ystatus`) VALUES
(7, 1, 7, '0'),
(8, 1, 8, '0'),
(9, 1, 9, '1'),
(10, 2, 1, '1'),
(11, 3, 4, '1'),
(12, 4, 7, '1'),
(13, 5, 4, '1'),
(14, 6, 4, '1'),
(15, 7, 7, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annoucement`
--
ALTER TABLE `annoucement`
  ADD PRIMARY KEY (`annid`);

--
-- Indexes for table `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`claimid`,`sid`,`ccode`,`lid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `lid` (`lid`);

--
-- Indexes for table `courselevel`
--
ALTER TABLE `courselevel`
  ADD PRIMARY KEY (`clevid`,`cid`,`levid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `levid` (`levid`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`cid`,`lid`,`ccode`),
  ADD KEY `lid` (`lid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `lectureannouncement`
--
ALTER TABLE `lectureannouncement`
  ADD PRIMARY KEY (`lannid`,`lid`,`annid`),
  ADD KEY `annid` (`annid`),
  ADD KEY `lid` (`lid`);

--
-- Indexes for table `lecturesesslevel`
--
ALTER TABLE `lecturesesslevel`
  ADD PRIMARY KEY (`llevid`,`lid`,`slevid`),
  ADD KEY `levid` (`slevid`),
  ADD KEY `lid` (`lid`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`levid`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`mid`,`cid`,`sid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `registrar`
--
ALTER TABLE `registrar`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `Session`
--
ALTER TABLE `Session`
  ADD PRIMARY KEY (`sID`);

--
-- Indexes for table `sesslevel`
--
ALTER TABLE `sesslevel`
  ADD PRIMARY KEY (`seslevid`,`sID`,`levid`),
  ADD KEY `levid` (`levid`),
  ADD KEY `sID` (`sID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`,`regnum`);

--
-- Indexes for table `studentannoucement`
--
ALTER TABLE `studentannoucement`
  ADD PRIMARY KEY (`sannid`,`sid`,`annid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `annid` (`annid`);

--
-- Indexes for table `studentsesslevel`
--
ALTER TABLE `studentsesslevel`
  ADD PRIMARY KEY (`stlevid`,`sid`,`seslevid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `levid` (`seslevid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annoucement`
--
ALTER TABLE `annoucement`
  MODIFY `annid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `claim`
--
ALTER TABLE `claim`
  MODIFY `claimid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courselevel`
--
ALTER TABLE `courselevel`
  MODIFY `clevid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lectureannouncement`
--
ALTER TABLE `lectureannouncement`
  MODIFY `lannid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lecturesesslevel`
--
ALTER TABLE `lecturesesslevel`
  MODIFY `llevid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `levid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registrar`
--
ALTER TABLE `registrar`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Session`
--
ALTER TABLE `Session`
  MODIFY `sID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sesslevel`
--
ALTER TABLE `sesslevel`
  MODIFY `seslevid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `studentannoucement`
--
ALTER TABLE `studentannoucement`
  MODIFY `sannid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `studentsesslevel`
--
ALTER TABLE `studentsesslevel`
  MODIFY `stlevid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `claim`
--
ALTER TABLE `claim`
  ADD CONSTRAINT `claim_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`),
  ADD CONSTRAINT `claim_ibfk_2` FOREIGN KEY (`lid`) REFERENCES `lecture` (`lid`);

--
-- Constraints for table `courselevel`
--
ALTER TABLE `courselevel`
  ADD CONSTRAINT `courselevel_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`),
  ADD CONSTRAINT `courselevel_ibfk_2` FOREIGN KEY (`levid`) REFERENCES `level` (`levid`);

--
-- Constraints for table `lectureannouncement`
--
ALTER TABLE `lectureannouncement`
  ADD CONSTRAINT `lectureannouncement_ibfk_1` FOREIGN KEY (`annid`) REFERENCES `annoucement` (`annid`),
  ADD CONSTRAINT `lectureannouncement_ibfk_2` FOREIGN KEY (`lid`) REFERENCES `lecture` (`lid`);

--
-- Constraints for table `lecturesesslevel`
--
ALTER TABLE `lecturesesslevel`
  ADD CONSTRAINT `lecturesesslevel_ibfk_1` FOREIGN KEY (`lid`) REFERENCES `lecture` (`lid`),
  ADD CONSTRAINT `lecturesesslevel_ibfk_2` FOREIGN KEY (`slevid`) REFERENCES `sesslevel` (`seslevid`);

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`),
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`);

--
-- Constraints for table `sesslevel`
--
ALTER TABLE `sesslevel`
  ADD CONSTRAINT `sesslevel_ibfk_1` FOREIGN KEY (`levid`) REFERENCES `level` (`levid`),
  ADD CONSTRAINT `sesslevel_ibfk_2` FOREIGN KEY (`sID`) REFERENCES `Session` (`sID`);

--
-- Constraints for table `studentannoucement`
--
ALTER TABLE `studentannoucement`
  ADD CONSTRAINT `studentannoucement_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`),
  ADD CONSTRAINT `studentannoucement_ibfk_2` FOREIGN KEY (`annid`) REFERENCES `annoucement` (`annid`);

--
-- Constraints for table `studentsesslevel`
--
ALTER TABLE `studentsesslevel`
  ADD CONSTRAINT `studentsesslevel_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`),
  ADD CONSTRAINT `studentsesslevel_ibfk_2` FOREIGN KEY (`seslevid`) REFERENCES `sesslevel` (`seslevid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
