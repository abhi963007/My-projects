-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 05:26 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leavesystemphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `staff_id` varchar(50) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `days_requested` int(2) NOT NULL,
  `date_applied` date NOT NULL,
  `leave_status` varchar(30) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`staff_id`, `leave_type`, `start_date`, `end_date`, `days_requested`, `date_applied`, `leave_status`) VALUES
('hoover@gmail.com', 'Casual Leave', '2021-05-25', '2021-05-25', 1, '2021-05-24', 'Rejected'),
('jenny@gmail.com', 'Casual Leave', '2021-05-25', '2021-05-28', 4, '2021-05-24', 'Rejected'),
('kathryn@gmail.com', 'Quarantine Leave', '2021-05-25', '2021-06-12', 19, '2021-05-24', 'Approved'),
('kevin@gmail.com', 'Casual Leave', '2021-05-25', '2021-05-25', 1, '2021-05-24', 'Pending'),
('leonardh@gmail.com', 'Sick Leave', '2020-04-11', '2020-04-12', 1, '2020-04-10', 'Pending'),
('liam@gmail.com', 'Quarantine Leave', '2020-04-03', '2020-04-26', 23, '2020-04-01', 'Approved'),
('liam@gmail.com', 'Casual Leave', '2020-04-23', '2020-04-30', 8, '2020-04-23', 'Pending'),
('liam@gmail.com', 'Sick Leave', '2020-06-13', '2020-06-18', 6, '2020-06-10', 'Approved'),
('melinda@gmail.com', 'Maternity Leave', '2021-05-25', '2021-06-27', 34, '2021-05-24', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `leave_statistics`
--

CREATE TABLE `leave_statistics` (
  `staff_id` varchar(50) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `maximum_leaves` int(2) NOT NULL,
  `leaves_taken` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_statistics`
--

INSERT INTO `leave_statistics` (`staff_id`, `leave_type`, `maximum_leaves`, `leaves_taken`) VALUES
('corey@gmail.com', 'Bereavement Leave', 3, 0),
('corey@gmail.com', 'Casual Leave', 9, 0),
('corey@gmail.com', 'Compensatory Leave', 6, 0),
('corey@gmail.com', 'Maternity Leave', 35, 0),
('corey@gmail.com', 'Quarantine Leave', 22, 0),
('corey@gmail.com', 'Religious Holiday', 3, 0),
('corey@gmail.com', 'Sick Leave', 10, 0),
('davidr@gmail.com', 'Bereavement Leave', 3, 0),
('davidr@gmail.com', 'Casual Leave', 9, 0),
('davidr@gmail.com', 'Compensatory Leave', 6, 0),
('davidr@gmail.com', 'Quarantine Leave', 22, 0),
('davidr@gmail.com', 'Religious Holiday', 3, 0),
('davidr@gmail.com', 'Sick Leave', 10, 0),
('francisco@gmail.com', 'Bereavement Leave', 3, 0),
('francisco@gmail.com', 'Casual Leave', 9, 0),
('francisco@gmail.com', 'Compensatory Leave', 6, 0),
('francisco@gmail.com', 'Maternity Leave', 35, 0),
('francisco@gmail.com', 'Quarantine Leave', 22, 0),
('francisco@gmail.com', 'Religious Holiday', 3, 0),
('francisco@gmail.com', 'Sick Leave', 10, 0),
('hoover@gmail.com', 'Bereavement Leave', 3, 0),
('hoover@gmail.com', 'Casual Leave', 9, 0),
('hoover@gmail.com', 'Compensatory Leave', 6, 0),
('hoover@gmail.com', 'Maternity Leave', 35, 0),
('hoover@gmail.com', 'Quarantine Leave', 22, 0),
('hoover@gmail.com', 'Religious Holiday', 3, 0),
('hoover@gmail.com', 'Sick Leave', 10, 0),
('jenny@gmail.com', 'Bereavement Leave', 3, 0),
('jenny@gmail.com', 'Casual Leave', 9, 0),
('jenny@gmail.com', 'Compensatory Leave', 6, 0),
('jenny@gmail.com', 'Maternity Leave', 35, 0),
('jenny@gmail.com', 'Quarantine Leave', 22, 0),
('jenny@gmail.com', 'Religious Holiday', 3, 0),
('jenny@gmail.com', 'Sick Leave', 10, 0),
('kathryn@gmail.com', 'Bereavement Leave', 3, 0),
('kathryn@gmail.com', 'Casual Leave', 9, 0),
('kathryn@gmail.com', 'Compensatory Leave', 6, 0),
('kathryn@gmail.com', 'Maternity Leave', 35, 0),
('kathryn@gmail.com', 'Quarantine Leave', 22, 19),
('kathryn@gmail.com', 'Religious Holiday', 3, 0),
('kathryn@gmail.com', 'Sick Leave', 10, 0),
('kevin@gmail.com', 'Bereavement Leave', 3, 0),
('kevin@gmail.com', 'Compensatory Leave', 6, 1),
('kevin@gmail.com', 'Religious Holiday', 3, 0),
('leonardh@gmail.com', 'Bereavement Leave', 3, 0),
('leonardh@gmail.com', 'Casual Leave', 9, 0),
('leonardh@gmail.com', 'Compensatory Leave', 6, 0),
('leonardh@gmail.com', 'Quarantine Leave', 22, 0),
('leonardh@gmail.com', 'Religious Holiday', 3, 0),
('leonardh@gmail.com', 'Sick Leave', 10, 3),
('liam@gmail.com', 'Bereavement Leave', 3, 0),
('liam@gmail.com', 'Casual Leave', 9, 0),
('liam@gmail.com', 'Compensatory Leave', 6, 0),
('liam@gmail.com', 'Quarantine Leave', 22, 9),
('liam@gmail.com', 'Religious Holiday', 3, 0),
('liam@gmail.com', 'Sick Leave', 10, 6),
('louise@gmail.com', 'Bereavement Leave', 3, 0),
('louise@gmail.com', 'Casual Leave', 9, 0),
('louise@gmail.com', 'Compensatory Leave', 6, 0),
('louise@gmail.com', 'Maternity Leave', 35, 0),
('louise@gmail.com', 'Quarantine Leave', 22, 0),
('louise@gmail.com', 'Religious Holiday', 3, 0),
('martinr@gmail.com', 'Bereavement Leave', 3, 0),
('martinr@gmail.com', 'Casual Leave', 9, 0),
('martinr@gmail.com', 'Compensatory Leave', 6, 0),
('martinr@gmail.com', 'Maternity Leave', 35, 0),
('martinr@gmail.com', 'Quarantine Leave', 22, 0),
('martinr@gmail.com', 'Religious Holiday', 3, 0),
('martinr@gmail.com', 'Sick Leave', 10, 0),
('melinda@gmail.com', 'Bereavement Leave', 3, 0),
('melinda@gmail.com', 'Casual Leave', 9, 0),
('melinda@gmail.com', 'Compensatory Leave', 6, 0),
('melinda@gmail.com', 'Maternity Leave', 35, 0),
('melinda@gmail.com', 'Quarantine Leave', 22, 0),
('melinda@gmail.com', 'Religious Holiday', 3, 0),
('melinda@gmail.com', 'Sick Leave', 10, 0),
('miller@gmail.com', 'Bereavement Leave', 3, 0),
('miller@gmail.com', 'Casual Leave', 9, 0),
('miller@gmail.com', 'Compensatory Leave', 6, 0),
('miller@gmail.com', 'Maternity Leave', 35, 0),
('miller@gmail.com', 'Quarantine Leave', 22, 0),
('miller@gmail.com', 'Religious Holiday', 3, 0),
('miller@gmail.com', 'Sick Leave', 10, 0),
('oscarb@gmail.com', 'Bereavement Leave', 3, 0),
('oscarb@gmail.com', 'Casual Leave', 9, 0),
('oscarb@gmail.com', 'Compensatory Leave', 6, 0),
('oscarb@gmail.com', 'Maternity Leave', 35, 0),
('oscarb@gmail.com', 'Quarantine Leave', 22, 0),
('oscarb@gmail.com', 'Religious Holiday', 3, 0),
('oscarb@gmail.com', 'Sick Leave', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `leave_type` varchar(50) NOT NULL,
  `no_of_days` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`leave_type`, `no_of_days`) VALUES
('Bereavement Leave', 3),
('Casual Leave', 9),
('Compensatory Leave', 6),
('Maternity Leave', 35),
('Quarantine Leave', 22),
('Religious Holiday', 3),
('Sick Leave', 10);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `password`, `user_type`) VALUES
('admin', 'password0101', 'admin'),
('corey@gmail.com', 'password123', 'Staff'),
('davidr@gmail.com', 'password123', 'Staff'),
('francisco@gmail.com', 'password123', 'Staff'),
('hoover@gmail.com', 'password123', 'Staff'),
('jenny@gmail.com', 'password123', 'Staff'),
('kathryn@gmail.com', 'password123', 'Staff'),
('kevin@gmail.com', 'password123', 'Staff'),
('leonardh@gmail.com', 'password123', 'Staff'),
('liam@gmail.com', 'password123', 'Staff'),
('louise@gmail.com', 'password123', 'PC'),
('martinr@gmail.com', 'password123', 'Staff'),
('melinda@gmail.com', 'password123', 'Staff'),
('miller@gmail.com', 'password123', 'Staff'),
('oscarb@gmail.com', 'password123', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `first_name`, `middle_name`, `last_name`, `gender`, `contact`) VALUES
('corey@gmail.com', 'Corey', 'M', 'Fletcher', 'Male', '7401474440'),
('davidr@gmail.com', 'David', 'R.', 'Baker', 'Male', '2547774540'),
('francisco@gmail.com', 'Francisco', 'A', 'Miles', 'Male', '6547854450'),
('hoover@gmail.com', 'Judith', 'J', 'Hoover', 'Male', '3690002450'),
('jenny@gmail.com', 'Jenny', 'M', 'Compton', 'Female', '7025550001'),
('kathryn@gmail.com', 'Kathryn', 'Am', 'Nettles', 'Female', '7016950002'),
('kevin@gmail.com', 'Kevin', 'M.', 'Callan', 'Male', '3657450001'),
('leonardh@gmail.com', 'Leonard', 'D.', 'Howard', 'Male', '7913696969'),
('liam@gmail.com', 'Liam', 'Jl', 'Moore', 'Male', '6060000025'),
('louise@gmail.com', 'Louise', 'C', 'Sauer', 'Female', '6060002458'),
('martinr@gmail.com', 'Rosalee', 'Jin', 'Martinn', 'Female', '6870125480'),
('melinda@gmail.com', 'Melinda', 'L', 'Winslow', 'Female', '7402369690'),
('miller@gmail.com', 'Marvin', 'L.', 'Miller', 'Female', '4521585550'),
('oscarb@gmail.com', 'Oscar', 'C', 'Bates', 'Male', '7014585550');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`staff_id`,`start_date`,`end_date`);

--
-- Indexes for table `leave_statistics`
--
ALTER TABLE `leave_statistics`
  ADD PRIMARY KEY (`staff_id`,`leave_type`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`leave_type`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`,`user_type`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
