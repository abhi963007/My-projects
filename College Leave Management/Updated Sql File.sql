-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 03:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
  `leave_status` varchar(30) NOT NULL DEFAULT 'Pending',
  `pc_approval` tinyint(1) DEFAULT 0,
  `admin_approval` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`staff_id`, `leave_type`, `start_date`, `end_date`, `days_requested`, `date_applied`, `leave_status`, `pc_approval`, `admin_approval`) VALUES
('arjun@gmail.com', 'Religious Holiday', '2024-10-09', '2024-10-09', 1, '2024-10-21', 'Approved', 1, 1),
('arjun@gmail.com', 'Bereavement Leave', '2024-10-14', '2024-10-14', 1, '2024-10-21', 'Rejected', 1, 0),
('arjun@gmail.com', 'Maternity Leave', '2024-10-16', '2024-10-16', 1, '2024-10-21', 'Rejected', 0, 0),
('aswin@gmail.com', 'duty leave', '2024-10-21', '2024-10-21', 1, '2024-10-21', 'Approved', 1, 1),
('aswin@gmail.com', 'duty leave', '2024-10-22', '2024-10-22', 1, '2024-10-21', 'Approved', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `leave_statistics`
--

CREATE TABLE `leave_statistics` (
  `staff_id` varchar(50) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `maximum_leaves` int(2) NOT NULL,
  `leaves_taken` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_statistics`
--

INSERT INTO `leave_statistics` (`staff_id`, `leave_type`, `maximum_leaves`, `leaves_taken`) VALUES
('abhiramak963@gmail.com', 'Bereavement Leave', 3, 0),
('abhiramak963@gmail.com', 'duty leave', 1, 0),
('abhiramak963@gmail.com', 'free leave', 5, 0),
('abhiramak963@gmail.com', 'leave', 1, 0),
('abhiramak963@gmail.com', 'Maternity Leave', 35, 0),
('abhiramak963@gmail.com', 'Quarantine Leave', 22, 0),
('abhiramak963@gmail.com', 'Religious Holiday', 3, 0),
('abhiramak963@gmail.com', 'Sick Leave', 10, 0),
('abin@gmail.com', 'Bereavement Leave', 3, 0),
('abin@gmail.com', 'duty leave', 1, 0),
('abin@gmail.com', 'free leave', 5, 0),
('abin@gmail.com', 'leave', 1, 0),
('abin@gmail.com', 'Maternity Leave', 35, 0),
('abin@gmail.com', 'Quarantine Leave', 22, 0),
('abin@gmail.com', 'Religious Holiday', 3, 0),
('abin@gmail.com', 'Sick Leave', 10, 0),
('admin@gmail.com', 'Bereavement Leave', 3, 0),
('admin@gmail.com', 'duty leave', 1, 0),
('admin@gmail.com', 'free leave', 5, 0),
('admin@gmail.com', 'leave', 1, 0),
('admin@gmail.com', 'Maternity Leave', 35, 0),
('admin@gmail.com', 'Quarantine Leave', 22, 0),
('admin@gmail.com', 'Religious Holiday', 3, 0),
('admin@gmail.com', 'Sick Leave', 10, 0),
('arjun@gmail.com', 'Bereavement Leave', 3, 0),
('arjun@gmail.com', 'duty leave', 1, 0),
('arjun@gmail.com', 'free leave', 5, 0),
('arjun@gmail.com', 'leave', 1, 0),
('arjun@gmail.com', 'Maternity Leave', 35, 0),
('arjun@gmail.com', 'Quarantine Leave', 22, 0),
('arjun@gmail.com', 'Religious Holiday', 3, 0),
('arjun@gmail.com', 'Sick Leave', 10, 0),
('aswin@gmail.com', 'Bereavement Leave', 3, 0),
('aswin@gmail.com', 'duty leave', 1, 0),
('aswin@gmail.com', 'free leave', 5, 0),
('aswin@gmail.com', 'leave', 1, 0),
('aswin@gmail.com', 'Maternity Leave', 35, 0),
('aswin@gmail.com', 'Quarantine Leave', 22, 0),
('aswin@gmail.com', 'Religious Holiday', 3, 0),
('aswin@gmail.com', 'Sick Leave', 10, 0),
('corey@gmail.com', 'Bereavement Leave', 3, 0),
('corey@gmail.com', 'duty leave', 1, 0),
('corey@gmail.com', 'free leave', 5, 0),
('corey@gmail.com', 'Maternity Leave', 35, 0),
('corey@gmail.com', 'Quarantine Leave', 22, 0),
('corey@gmail.com', 'Religious Holiday', 3, 0),
('corey@gmail.com', 'Sick Leave', 10, 0),
('davidr@gmail.com', 'Bereavement Leave', 3, 0),
('davidr@gmail.com', 'duty leave', 1, 0),
('davidr@gmail.com', 'free leave', 5, 0),
('davidr@gmail.com', 'Quarantine Leave', 22, 0),
('davidr@gmail.com', 'Religious Holiday', 3, 0),
('davidr@gmail.com', 'Sick Leave', 10, 0),
('francisco@gmail.com', 'Bereavement Leave', 3, 0),
('francisco@gmail.com', 'duty leave', 1, 0),
('francisco@gmail.com', 'free leave', 5, 0),
('francisco@gmail.com', 'Maternity Leave', 35, 0),
('francisco@gmail.com', 'Quarantine Leave', 22, 0),
('francisco@gmail.com', 'Religious Holiday', 3, 0),
('francisco@gmail.com', 'Sick Leave', 10, 0),
('hoover@gmail.com', 'Bereavement Leave', 3, 0),
('hoover@gmail.com', 'duty leave', 1, 0),
('hoover@gmail.com', 'free leave', 5, 0),
('hoover@gmail.com', 'Maternity Leave', 35, 0),
('hoover@gmail.com', 'Quarantine Leave', 22, 0),
('hoover@gmail.com', 'Religious Holiday', 3, 0),
('hoover@gmail.com', 'Sick Leave', 10, 0),
('jenny@gmail.com', 'Bereavement Leave', 3, 0),
('jenny@gmail.com', 'duty leave', 1, 0),
('jenny@gmail.com', 'free leave', 5, 0),
('jenny@gmail.com', 'Maternity Leave', 35, 0),
('jenny@gmail.com', 'Quarantine Leave', 22, 0),
('jenny@gmail.com', 'Religious Holiday', 3, 0),
('jenny@gmail.com', 'Sick Leave', 10, 0),
('kathryn@gmail.com', 'Bereavement Leave', 3, 0),
('kathryn@gmail.com', 'duty leave', 1, 0),
('kathryn@gmail.com', 'free leave', 5, 0),
('kathryn@gmail.com', 'Maternity Leave', 35, 0),
('kathryn@gmail.com', 'Quarantine Leave', 22, 19),
('kathryn@gmail.com', 'Religious Holiday', 3, 0),
('kathryn@gmail.com', 'Sick Leave', 10, 0),
('kevin@gmail.com', 'Bereavement Leave', 3, 0),
('kevin@gmail.com', 'duty leave', 1, 0),
('kevin@gmail.com', 'free leave', 5, 0),
('kevin@gmail.com', 'Religious Holiday', 3, 0),
('leonardh@gmail.com', 'Bereavement Leave', 3, 0),
('leonardh@gmail.com', 'duty leave', 1, 0),
('leonardh@gmail.com', 'free leave', 5, 0),
('leonardh@gmail.com', 'Quarantine Leave', 22, 0),
('leonardh@gmail.com', 'Religious Holiday', 3, 0),
('leonardh@gmail.com', 'Sick Leave', 10, 3),
('liam@gmail.com', 'Bereavement Leave', 3, 0),
('liam@gmail.com', 'duty leave', 1, 0),
('liam@gmail.com', 'free leave', 5, 0),
('liam@gmail.com', 'Quarantine Leave', 22, 9),
('liam@gmail.com', 'Religious Holiday', 3, 0),
('liam@gmail.com', 'Sick Leave', 10, 6),
('louise@gmail.com', 'Bereavement Leave', 3, 0),
('louise@gmail.com', 'duty leave', 1, 0),
('louise@gmail.com', 'free leave', 5, 0),
('louise@gmail.com', 'Maternity Leave', 35, 0),
('louise@gmail.com', 'Quarantine Leave', 22, 0),
('louise@gmail.com', 'Religious Holiday', 3, 0),
('martinr@gmail.com', 'Bereavement Leave', 3, 0),
('martinr@gmail.com', 'duty leave', 1, 0),
('martinr@gmail.com', 'free leave', 5, 0),
('martinr@gmail.com', 'Maternity Leave', 35, 0),
('martinr@gmail.com', 'Quarantine Leave', 22, 0),
('martinr@gmail.com', 'Religious Holiday', 3, 0),
('martinr@gmail.com', 'Sick Leave', 10, 0),
('melinda@gmail.com', 'Bereavement Leave', 3, 0),
('melinda@gmail.com', 'duty leave', 1, 0),
('melinda@gmail.com', 'free leave', 5, 0),
('melinda@gmail.com', 'Maternity Leave', 35, 0),
('melinda@gmail.com', 'Quarantine Leave', 22, 0),
('melinda@gmail.com', 'Religious Holiday', 3, 0),
('melinda@gmail.com', 'Sick Leave', 10, 0),
('miller@gmail.com', 'Bereavement Leave', 3, 0),
('miller@gmail.com', 'duty leave', 1, 0),
('miller@gmail.com', 'free leave', 5, 0),
('miller@gmail.com', 'Maternity Leave', 35, 0),
('miller@gmail.com', 'Quarantine Leave', 22, 0),
('miller@gmail.com', 'Religious Holiday', 3, 0),
('miller@gmail.com', 'Sick Leave', 10, 0),
('oscarb@gmail.com', 'Bereavement Leave', 3, 0),
('oscarb@gmail.com', 'duty leave', 1, 0),
('oscarb@gmail.com', 'free leave', 5, 0),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`leave_type`, `no_of_days`) VALUES
('Bereavement Leave', 3),
('duty leave', 1),
('free leave', 5),
('leave', 1),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `password`, `user_type`) VALUES
('abhiram@gmail.com', 'abhiram', 'PC'),
('abhiramak963@gmail.com', 'abhi', 'PC'),
('abin@gmail.com', 'abin', 'Staff'),
('admin', 'password0101', 'admin'),
('arjun@gmail.com', 'arjun', 'Staff'),
('aswin@gmail.com', 'aswin', 'Staff'),
('sobhanaaji963@gmail.com', 'sobha', 'PC');

-- --------------------------------------------------------

--
-- Table structure for table `program_coordinator`
--

CREATE TABLE `program_coordinator` (
  `pc_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email_id` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_coordinator`
--

INSERT INTO `program_coordinator` (`pc_id`, `first_name`, `middle_name`, `last_name`, `email_id`, `contact`, `gender`, `password`) VALUES
(4, 'B', '', 'SOBHANA', 'sobhanaaji963@gmail.com', '7303674655', 'Male', 'sobha'),
(5, 'abhiram', '', 'ak', 'abhiram@gmail.com', '1234567891', 'Male', 'abhiram');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `first_name`, `middle_name`, `last_name`, `gender`, `contact`) VALUES
('abhiramak963@gmail.com', 'ABHIRAM', 'A', 'K', 'Male', '7303674655'),
('abin@gmail.com', 'abin', '', 'varhese', 'Male', '9207571848'),
('admin@gmail.com', 'abin', '', 'var', 'Male', '9605791047'),
('arjun@gmail.com', 'arjun', 'p', 'saji', 'Male', '9947198166'),
('aswin@gmail.com', 'aswin', '', 'kp', 'Male', '7306364765');

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
-- Indexes for table `program_coordinator`
--
ALTER TABLE `program_coordinator`
  ADD PRIMARY KEY (`pc_id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `program_coordinator`
--
ALTER TABLE `program_coordinator`
  MODIFY `pc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
