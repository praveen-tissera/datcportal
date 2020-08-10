-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2020 at 07:59 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch_table`
--

CREATE TABLE `batch_table` (
  `batch_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `batch_number` char(3) NOT NULL,
  `create_date` date NOT NULL,
  `commence_date` date NOT NULL,
  `tentitive_close_date` date NOT NULL,
  `close_date` date NOT NULL,
  `discription` varchar(255) NOT NULL,
  `state` enum('active','complete','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch_table`
--

INSERT INTO `batch_table` (`batch_id`, `course_id`, `staff_id`, `batch_number`, `create_date`, `commence_date`, `tentitive_close_date`, `close_date`, `discription`, `state`) VALUES
(1, 1, 1, '1', '2020-08-08', '2021-08-07', '0000-00-00', '2021-01-03', 'class time : Saturday 9.00 am to 3.00 pm', 'active'),
(2, 1, 1, '2', '2020-08-09', '2021-08-08', '0000-00-00', '2021-01-03', 'class time : Sunday 9.00 am to 3.00 pm', 'active'),
(3, 2, 1, '1', '2020-08-16', '2021-08-29', '0000-00-00', '2021-01-03', 'class time : Sunday 9.00 am to 3.00 pm', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `course_table`
--

CREATE TABLE `course_table` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` text NOT NULL,
  `course_fee` text NOT NULL,
  `state` enum('active','inactive','delete') NOT NULL,
  `staff_id` int(11) NOT NULL,
  `course_type` enum('diploma','threedays','oneday') NOT NULL,
  `submit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_table`
--

INSERT INTO `course_table` (`course_id`, `course_name`, `course_description`, `course_fee`, `state`, `staff_id`, `course_type`, `submit_date`) VALUES
(1, 'Diploma of Agribusiness management ', 'This qualification reflects the role of personnel working on farms, stations and related rural businesses involved in administering and managing those businesses. Industry expects individuals with this qualification to take personal responsibility and exercise autonomy in undertaking complex work. They must analyze information and exercise judgment to complete a range of advanced skilled activities.', 'Rs.30,000.00', 'active', 2, 'diploma', '2020-01-01'),
(2, 'Diploma Of Horticulture ', 'The Diploma of Horticulture reflects the role of those who manage amenity horticultural enterprises where a range of skills and knowledge across the breadth of the industry is required or personnel working in horticulture at a level requiring higher technical skills.', 'Rs.25,000.00', 'active', 2, 'diploma', '2020-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `payment_receive_table`
--

CREATE TABLE `payment_receive_table` (
  `payment_id` int(11) NOT NULL,
  `receipt_number` varchar(10) NOT NULL,
  `paid_amount` float NOT NULL,
  `paid_date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `add_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_schedule_table`
--

CREATE TABLE `payment_schedule_table` (
  `payment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `payment_status` enum('full','1st installment','2nd installment') NOT NULL,
  `amount` float NOT NULL,
  `payment_due_date` date NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff_table`
--

CREATE TABLE `staff_table` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role_type` enum('admin','coordinator') NOT NULL,
  `password` varchar(40) NOT NULL,
  `state` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_table`
--

INSERT INTO `staff_table` (`staff_id`, `staff_name`, `email`, `role_type`, `password`, `state`) VALUES
(1, 'chathuri', 'chathuri@gmail.com', 'coordinator', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active'),
(2, 'admin', 'admin@gmail.com', 'admin', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active'),
(3, 'online staff', 'online@datc.com', 'coordinator', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance_table`
--

CREATE TABLE `student_attendance_table` (
  `student_attent_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `attend_date` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_batch_map_table`
--

CREATE TABLE `student_batch_map_table` (
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `state` enum('active','deactivate','suspend','pending') NOT NULL,
  `certificate_no` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_batch_map_table`
--

INSERT INTO `student_batch_map_table` (`student_id`, `batch_id`, `staff_id`, `added_date`, `state`, `certificate_no`) VALUES
(17, 2, 3, '2020-08-05', 'pending', NULL),
(17, 1, 3, '2020-08-05', 'pending', NULL),
(1, 1, 3, '2020-08-06', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_mark_table`
--

CREATE TABLE `student_mark_table` (
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `state` enum('pass','falil') NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_table`
--

CREATE TABLE `student_table` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `state` enum('active','pending','inactive') NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_table`
--

INSERT INTO `student_table` (`student_id`, `first_name`, `last_name`, `birth_date`, `email`, `telephone`, `password`, `staff_id`, `state`, `register_date`) VALUES
(1, 'chinthana', 'perera', '1997-08-04', 'chinthan@gmail.com', '', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 1, 'pending', '2020-08-01'),
(17, 'praveen', 'tissera', '1985-08-03', 'praveen@gmail.com', '+94764354111', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 3, 'pending', '2020-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `subject_table`
--

CREATE TABLE `subject_table` (
  `subject_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `state` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trainer_attendance_table`
--

CREATE TABLE `trainer_attendance_table` (
  `trainer_attend_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `attend_date` date NOT NULL,
  `added_date` date NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trainer_batch_map_table`
--

CREATE TABLE `trainer_batch_map_table` (
  `trainer_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `state` enum('active','deactivate') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trainer_table`
--

CREATE TABLE `trainer_table` (
  `trainer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `state` enum('active','inactive') NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainer_table`
--

INSERT INTO `trainer_table` (`trainer_id`, `first_name`, `last_name`, `birth_date`, `email`, `password`, `state`, `register_date`) VALUES
(1, 'trainer', 'trainer', '1987-08-03', 'trainer@gmail.com', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active', '2020-08-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch_table`
--
ALTER TABLE `batch_table`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `course_table`
--
ALTER TABLE `course_table`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `payment_receive_table`
--
ALTER TABLE `payment_receive_table`
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `payment_schedule_table`
--
ALTER TABLE `payment_schedule_table`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_status` (`payment_status`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `staff_table`
--
ALTER TABLE `staff_table`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `student_attendance_table`
--
ALTER TABLE `student_attendance_table`
  ADD PRIMARY KEY (`student_attent_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `student_batch_map_table`
--
ALTER TABLE `student_batch_map_table`
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `student_batch_map_table_ibfk_3` (`student_id`);

--
-- Indexes for table `student_mark_table`
--
ALTER TABLE `student_mark_table`
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `student_table`
--
ALTER TABLE `student_table`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `subject_table`
--
ALTER TABLE `subject_table`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `trainer_attendance_table`
--
ALTER TABLE `trainer_attendance_table`
  ADD PRIMARY KEY (`trainer_attend_id`),
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `trainer_batch_map_table`
--
ALTER TABLE `trainer_batch_map_table`
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `trainer_table`
--
ALTER TABLE `trainer_table`
  ADD PRIMARY KEY (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch_table`
--
ALTER TABLE `batch_table`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_table`
--
ALTER TABLE `course_table`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_schedule_table`
--
ALTER TABLE `payment_schedule_table`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_table`
--
ALTER TABLE `staff_table`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_attendance_table`
--
ALTER TABLE `student_attendance_table`
  MODIFY `student_attent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_table`
--
ALTER TABLE `student_table`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subject_table`
--
ALTER TABLE `subject_table`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainer_attendance_table`
--
ALTER TABLE `trainer_attendance_table`
  MODIFY `trainer_attend_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainer_table`
--
ALTER TABLE `trainer_table`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch_table`
--
ALTER TABLE `batch_table`
  ADD CONSTRAINT `batch_table_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_table` (`course_id`),
  ADD CONSTRAINT `batch_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`);

--
-- Constraints for table `course_table`
--
ALTER TABLE `course_table`
  ADD CONSTRAINT `course_table_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`);

--
-- Constraints for table `payment_receive_table`
--
ALTER TABLE `payment_receive_table`
  ADD CONSTRAINT `payment_receive_table_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payment_schedule_table` (`payment_id`),
  ADD CONSTRAINT `payment_receive_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`);

--
-- Constraints for table `payment_schedule_table`
--
ALTER TABLE `payment_schedule_table`
  ADD CONSTRAINT `payment_schedule_table_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_table` (`student_id`),
  ADD CONSTRAINT `payment_schedule_table_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`);

--
-- Constraints for table `student_attendance_table`
--
ALTER TABLE `student_attendance_table`
  ADD CONSTRAINT `student_attendance_table_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`),
  ADD CONSTRAINT `student_attendance_table_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_table` (`student_id`),
  ADD CONSTRAINT `student_attendance_table_ibfk_3` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`);

--
-- Constraints for table `student_batch_map_table`
--
ALTER TABLE `student_batch_map_table`
  ADD CONSTRAINT `student_batch_map_table_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`),
  ADD CONSTRAINT `student_batch_map_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`),
  ADD CONSTRAINT `student_batch_map_table_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student_table` (`student_id`);

--
-- Constraints for table `student_mark_table`
--
ALTER TABLE `student_mark_table`
  ADD CONSTRAINT `student_mark_table_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`),
  ADD CONSTRAINT `student_mark_table_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_table` (`student_id`),
  ADD CONSTRAINT `student_mark_table_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject_table` (`subject_id`);

--
-- Constraints for table `student_table`
--
ALTER TABLE `student_table`
  ADD CONSTRAINT `student_table_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`);

--
-- Constraints for table `subject_table`
--
ALTER TABLE `subject_table`
  ADD CONSTRAINT `subject_table_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_table` (`course_id`);

--
-- Constraints for table `trainer_attendance_table`
--
ALTER TABLE `trainer_attendance_table`
  ADD CONSTRAINT `trainer_attendance_table_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`),
  ADD CONSTRAINT `trainer_attendance_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`),
  ADD CONSTRAINT `trainer_attendance_table_ibfk_3` FOREIGN KEY (`trainer_id`) REFERENCES `trainer_table` (`trainer_id`);

--
-- Constraints for table `trainer_batch_map_table`
--
ALTER TABLE `trainer_batch_map_table`
  ADD CONSTRAINT `trainer_batch_map_table_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`),
  ADD CONSTRAINT `trainer_batch_map_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`),
  ADD CONSTRAINT `trainer_batch_map_table_ibfk_3` FOREIGN KEY (`trainer_id`) REFERENCES `trainer_table` (`trainer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
