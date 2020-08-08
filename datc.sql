-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2018 at 03:15 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lawyer_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_casebrief`
--

CREATE TABLE IF NOT EXISTS `tbl_casebrief` (
  `case_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `case_title` varchar(255) NOT NULL,
  `case_description` text NOT NULL,
  `case_added_date` date NOT NULL,
  PRIMARY KEY (`case_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_casebrief`
--

INSERT INTO `tbl_casebrief` (`case_id`, `user_id`, `case_title`, `case_description`, `case_added_date`) VALUES
(6, 2, 'Perera V. Perera', 'Perera V. Perera , in this case I  have tried to limit number of rows in textarea to 4 but its giving error Message: Array to string', '2018-05-14'),
(7, 2, 'Perera V. Perera', 'Perera V. Perera , in this case I  have tried to limit number of rows in textarea to 4 but its giving error Message: Array to string', '2018-05-14'),
(8, 2, 'Perera V. Perera2', 'have tried to limit number of rows in textarea to 4 but its giving error Message: Array to string', '2018-05-14'),
(9, 2, 'Perera V. Perera2', 'have tried to limit number of rows in textarea to 4 but its giving error Message: Array to string', '2018-05-14'),
(10, 24, 'nimal v. perera 2017', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mauris odio, fringilla eget turpis ut, malesuada scelerisque felis. Phasellus dui ligula, maximus sed urna sit amet, tincidunt volutpat metus. Vivamus id ante sit amet enim varius aliquam. Fusce ut nibh a nunc pulvinar efficitur. Etiam eget magna vitae risus porttitor auctor eu sit amet est. Duis commodo tortor ut purus interdum, sed viverra orci luctus. Quisque rhoncus lobortis turpis eu malesuada. Nulla posuere dapibus porta. Suspendisse vitae fringilla libero, sed vulputate est. Duis quam nulla, maximus sagittis auctor bibendum, scelerisque nec elit. Ut tristique libero justo, vitae porttitor lorem hendrerit et.\r\n\r\nNullam vestibulum sapien non ex volutpat, eu finibus enim interdum. In arcu erat, molestie eu consequat vitae, efficitur sed mi. Aliquam lorem nibh, viverra aliquam convallis aliquam, fermentum nec urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin nec finibus tortor, eu blandit mi. Donec ligula neque, tempus et ornare in, interdum ut mauris. Curabitur imperdiet ex non odio suscipit, eget auctor nisi molestie. Proin luctus varius justo, sed semper leo vehicula sollicitudin. Nunc facilisis nisl accumsan porttitor condimentum. Sed in tortor vel velit feugiat euismod cursus vel orci. Nulla facilisi. Suspendisse id massa id dolor auctor euismod. In cursus turpis eu sem pharetra suscipit. Integer imperdiet condimentum nibh, in eleifend purus. Pellentesque elementum elit nisi.', '2018-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forum_answer`
--

CREATE TABLE IF NOT EXISTS `tbl_forum_answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL,
  `answer_description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `answer_added_date` datetime NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_forum_answer`
--

INSERT INTO `tbl_forum_answer` (`answer_id`, `forum_id`, `answer_description`, `user_id`, `user_type`, `answer_added_date`) VALUES
(2, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mauris odio, fringilla eget turpis ut, malesuada scelerisque felis. Phasellus dui ligula, maximus sed urna sit amet, tincidunt volutpat metus. Vivamus id ante sit amet enim varius aliquam. Fusce ut nibh a nunc pulvinar efficitur. Etiam eget magna vitae risus porttitor auctor eu sit amet est. Duis commodo tortor ut purus interdum, sed viverra orci luctus. Quisque rhoncus lobortis turpis eu malesuada. Nulla posuere dapibus porta. Suspendisse vitae fringilla libero, sed vulputate est. Duis quam nulla, maximus sagittis auctor bibendum, scelerisque nec elit. Ut tristique libero justo, vitae porttitor lorem hendrerit et.', 5, 'client', '2018-05-17 03:13:20'),
(3, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mauris odio, fringilla eget turpis ut, malesuada scelerisque felis. Phasellus dui ligula, maximus sed urna sit amet, tincidunt volutpat metus. Vivamus id ante sit amet enim varius aliquam. Fusce ut nibh a nunc pulvinar efficitur. Etiam eget magna vitae risus porttitor auctor eu sit amet est. Duis commodo tortor ut purus interdum, sed viverra orci luctus. Quisque rhoncus lobortis turpis eu malesuada. Nulla posuere dapibus porta. Suspendisse vitae fringilla libero, sed vulputate est. Duis quam nulla, maximus sagittis auctor bibendum, scelerisque nec elit. Ut tristique libero justo, vitae porttitor lorem hendrerit et.', 5, 'client', '2018-05-18 00:00:00'),
(4, 3, 'answer 33', 5, 'client', '2018-05-17 00:00:00'),
(5, 3, 'sed viverra orci luctus. Quisque rhoncus lobortis turpis eu malesuada. Nulla posuere dapibus porta. Suspendisse vitae fringilla libero, sed vulputate est. Duis quam nulla, maximus sagittis auctor bibendum, scelerisque nec elit. Ut tristique libero justo, vitae porttitor lorem hendrerit et.', 5, 'client', '2018-05-17 13:11:51'),
(6, 3, 'test answer to check the date and time', 5, 'client', '2018-05-17 13:13:56'),
(7, 1, 'Nullam vestibulum sapien non ex volutpat, eu finibus enim interdum. In arcu erat, molestie eu consequat vitae, efficitur sed mi. Aliquam lorem nibh, viverra aliquam convallis aliquam, fermentum nec urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin nec finibus tortor, eu blandit mi. Donec ligula neque, tempus et ornare in, interdum ut mauris. Curabitur imperdiet ex non odio suscipit, eget auctor nisi molestie. Proin luctus varius justo, sed semper leo vehicula sollicitudin. Nunc facilisis nisl accumsan porttitor condimentum. Sed in tortor vel velit feugiat euismod cursus vel orci. Nulla facilisi. Suspendisse id massa id dolor auctor euismod. In cursus turpis eu sem pharetra suscipit. Integer imperdiet condimentum nibh, in eleifend purus. Pellentesque elementum elit nisi.', 5, 'client', '2018-05-17 13:21:50'),
(8, 1, 'Nullam vestibulum sapien non ex volutpat, eu finibus enim interdum. In arcu erat, molestie eu consequat vitae, efficitur sed mi. Aliquam lorem nibh, viverra aliquam convallis aliquam, fermentum nec urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin nec finibus tortor, eu blandit mi. Donec ligula neque, tempus et ornare in, interdum ut mauris. Curabitur imperdiet ex non odio suscipit, eget auctor nisi molestie. Proin luctus varius justo, sed semper leo vehicula sollicitudin. Nunc facilisis nisl accumsan porttitor condimentum. Sed in tortor vel velit feugiat euismod cursus vel orci. Nulla facilisi. Suspendisse id massa id dolor auctor euismod. In cursus turpis eu sem pharetra suscipit. Integer imperdiet condimentum nibh, in eleifend purus. Pellentesque elementum elit nisi.', 5, 'client', '2018-05-17 13:22:28'),
(9, 2, 'auctor. Pellentesque rhoncus, diam in accumsan feugiat, ligula lacus aliquam enim, vel gravida ante leo at turpis. Nunc posuere lorem sed sem porttitor, sit amet pharetra mauris mattis. Aenean mattis purus quis', 5, 'client', '2018-05-17 13:31:52'),
(10, 2, 'm sed. Curabitur finibus erat eu odio maximus auctor. Pellentesque rhoncus, diam in accumsan feugiat, ligula lacus aliquam enim, vel gravida ante leo at turpis. Nunc posuere lorem sed sem porttitor, sit amet pharetra mauris mattis. Aenean mattis purus quis volutpat feugiat. Etiam sed mi ut lacus aliquam efficitur. Pellentesque feugiat ultrices neque a laoreet.', 5, 'client', '2018-05-17 13:33:55'),
(11, 5, 'This is the soloution can provie\r\n\r\nSed dui tortor, tempor quis dignissim id, hendrerit sed massa. Aenean dui elit, rhoncus eget eros congue, varius ullamcorper neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam id mollis tortor. Vestibulum bibendum', 24, 'lawyer', '2018-05-17 15:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forum_question`
--

CREATE TABLE IF NOT EXISTS `tbl_forum_question` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_title` varchar(255) NOT NULL,
  `forum_description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `forum_added_date` datetime NOT NULL,
  PRIMARY KEY (`forum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_forum_question`
--

INSERT INTO `tbl_forum_question` (`forum_id`, `forum_title`, `forum_description`, `user_id`, `user_type`, `forum_added_date`) VALUES
(1, 'question title ', 'Sed sed vestibulum metus, sed pretium risus. Vestibulum dui nisi, dignissim vel euismod ac, congue ut lorem. Pellentesque feugiat nibh mauris, sit amet auctor ante bibendum sed. Curabitur finibus erat eu odio maximus auctor. Pellentesque rhoncus, diam in accumsan feugiat, ligula lacus aliquam enim, vel gravida ante leo at turpis. Nunc posuere lorem sed sem porttitor, sit amet pharetra mauris mattis. Aenean mattis purus quis volutpat feugiat. Etiam sed mi ut lacus aliquam efficitur. Pellentesque feugiat ultrices neque a laoreet.', 5, 'client', '2018-05-17 00:00:00'),
(2, 'Sed sed vestibulum metus, sed pretium risus', 'Sed sed vestibulum metus, sed pretium risus. Vestibulum dui nisi, dignissim vel euismod ac, congue ut lorem. Pellentesque feugiat nibh mauris, sit amet auctor ante bibendum sed. Curabitur finibus erat eu odio maximus auctor. Pellentesque rhoncus, diam in accumsan feugiat, ligula lacus aliquam enim, vel gravida ante leo at turpis. Nunc posuere lorem sed sem porttitor, sit amet pharetra mauris mattis. Aenean mattis purus quis volutpat feugiat. Etiam sed mi ut lacus aliquam efficitur. Pellentesque feugiat ultrices neque a laoreet.', 5, 'client', '2018-05-17 00:00:00'),
(3, 'How can i store the table content that is the comments of the html page into a database using php', 'Integer elit dui, finibus a tellus eget, rhoncus sodales orci. Fusce vitae consequat nulla. Vestibulum scelerisque lectus vel velit porttitor cursus. Praesent consectetur lorem non turpis accumsan, sit amet elementum sapien mattis. In lobortis turpis sed libero luctus ornare. Praesent pulvinar neque mollis risus suscipit, nec eleifend leo interdum. Cras lacinia ligula mattis eros tristique, euismod bibendum sem accumsan. Nullam sit amet mauris dolor. Nunc malesuada porttitor arcu eget consequat. Cras lorem dui, tristique sit amet tortor a, suscipit condimentum', 5, 'client', '2018-05-17 00:00:00'),
(4, 'question title user', 'question title user - description', 5, 'client', '2018-05-17 00:00:00'),
(5, 'Land Issue in Kaduwela', 'Sed dui tortor, tempor quis dignissim id, hendrerit sed massa. Aenean dui elit, rhoncus eget eros congue, varius ullamcorper neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam id mollis tortor. Vestibulum bibendum nisi a lacus dictum, vel semper enim molestie. Sed feugiat mi eget massa interdum elementum. Morbi a dapibus felis, eget porttitor mi. Nam imperdiet, elit eu faucibus porta, nisl nunc pulvinar enim, at pharetra velit nisl a erat. Nunc id ipsum ac arcu vestibulum tincidunt eu nec nunc. Sed elementum euismod varius. Donec viverra diam arcu, sit amet euismod nisi tristique ut.', 10, 'client', '2018-05-17 15:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lawyer_schedule`
--

CREATE TABLE IF NOT EXISTS `tbl_lawyer_schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `day` varchar(50) NOT NULL,
  `schedule_time` time NOT NULL,
  `schedule_status` enum('available','booked','booked-closed','closed') NOT NULL,
  `client_id` int(11) NOT NULL,
  `schedule_add_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `booked_date` date NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `tbl_lawyer_schedule`
--

INSERT INTO `tbl_lawyer_schedule` (`schedule_id`, `user_id`, `schedule_date`, `day`, `schedule_time`, `schedule_status`, `client_id`, `schedule_add_date`, `updated_date`, `booked_date`) VALUES
(1, 2, '2018-05-11', 'friday', '06:30:00', 'closed', 0, '2018-05-10', '2018-05-10', '0000-00-00'),
(2, 2, '2018-05-12', 'saturday', '15:00:00', 'booked-closed', 5, '2018-05-10', '2018-05-10', '2018-05-12'),
(3, 2, '2018-05-10', 'thursday', '09:30:00', 'booked-closed', 5, '2018-05-09', '2018-05-09', '2018-05-13'),
(4, 2, '2018-05-13', 'sunday', '10:00:00', 'closed', 0, '2018-05-11', '2018-05-11', '0000-00-00'),
(5, 2, '2018-05-13', 'sunday', '11:30:00', 'booked-closed', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(6, 2, '2018-05-14', 'monday', '13:30:00', 'booked', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(7, 2, '2018-05-14', 'monday', '16:00:00', 'booked', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(8, 2, '2018-05-13', 'Sunday', '06:00:00', 'closed', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(9, 2, '2018-05-13', 'Sunday', '06:30:00', 'closed', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(10, 2, '2018-05-15', 'Tuesday', '06:00:00', 'available', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(11, 2, '2018-05-16', 'Wednesday', '06:00:00', 'booked', 5, '2018-05-12', '2018-05-12', '2018-05-16'),
(12, 2, '2018-05-16', 'Wednesday', '06:30:00', 'available', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(13, 2, '2018-05-16', 'Wednesday', '07:00:00', 'available', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(14, 2, '2018-05-16', 'Wednesday', '07:30:00', 'available', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(15, 2, '2018-05-16', 'Wednesday', '09:30:00', 'available', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(16, 2, '2018-05-13', 'Sunday', '07:00:00', 'available', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(17, 2, '2018-05-13', 'Sunday', '07:30:00', 'available', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(18, 2, '2018-05-13', 'Sunday', '08:00:00', 'available', 0, '2018-05-12', '2018-05-12', '0000-00-00'),
(19, 2, '2018-05-19', 'Saturday', '06:00:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(20, 2, '2018-05-19', 'Saturday', '06:30:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(21, 2, '2018-05-19', 'Saturday', '07:00:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(22, 2, '2018-05-14', 'Monday', '06:00:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(23, 2, '2018-05-14', 'Monday', '06:30:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(24, 2, '2018-05-18', 'Friday', '06:00:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(25, 2, '2018-05-18', 'Friday', '06:30:00', 'available', 5, '2018-05-13', '2018-05-13', '0000-00-00'),
(26, 2, '2018-05-18', 'Friday', '21:00:00', 'available', 5, '2018-05-13', '2018-05-13', '0000-00-00'),
(27, 2, '2018-05-18', 'Friday', '21:30:00', 'booked', 5, '2018-05-13', '2018-05-13', '0000-00-00'),
(28, 2, '2018-05-20', 'Sunday', '06:00:00', 'booked', 5, '2018-05-13', '2018-05-13', '0000-00-00'),
(29, 2, '2018-05-20', 'Sunday', '06:30:00', 'booked', 5, '2018-05-13', '2018-05-13', '0000-00-00'),
(30, 2, '2018-05-20', 'Sunday', '21:30:00', 'booked', 5, '2018-05-13', '2018-05-13', '2018-05-14'),
(31, 2, '2018-05-17', 'Thursday', '22:00:00', 'booked', 5, '2018-05-13', '2018-05-13', '2018-05-14'),
(32, 2, '2018-05-17', 'Thursday', '22:30:00', 'booked', 8, '2018-05-13', '2018-05-13', '2018-05-17'),
(33, 2, '2018-05-17', 'Thursday', '23:00:00', 'booked', 9, '2018-05-13', '2018-05-13', '2018-05-17'),
(34, 2, '2018-05-14', 'Monday', '23:00:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(35, 3, '2018-05-14', 'Monday', '06:00:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(36, 3, '2018-05-14', 'Monday', '06:30:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(37, 3, '2018-05-14', 'Monday', '07:00:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(38, 3, '2018-05-14', 'Monday', '07:30:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(39, 3, '2018-05-14', 'Monday', '08:00:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(40, 3, '2018-05-14', 'Monday', '08:30:00', 'available', 0, '2018-05-13', '2018-05-13', '0000-00-00'),
(41, 3, '2018-05-15', 'Tuesday', '06:00:00', 'available', 0, '2018-05-14', '2018-05-14', '0000-00-00'),
(42, 3, '2018-05-15', 'Tuesday', '06:30:00', 'booked-closed', 5, '2018-05-14', '2018-05-14', '2018-05-15'),
(43, 3, '2018-05-15', 'Tuesday', '07:00:00', 'booked-closed', 5, '2018-05-14', '2018-05-14', '2018-05-15'),
(44, 3, '2018-05-15', 'Tuesday', '07:30:00', 'booked', 5, '2018-05-14', '2018-05-14', '0000-00-00'),
(45, 24, '2018-05-18', 'Friday', '08:00:00', 'available', 0, '2018-05-17', '2018-05-17', '0000-00-00'),
(46, 24, '2018-05-18', 'Friday', '08:30:00', 'available', 0, '2018-05-17', '2018-05-17', '0000-00-00'),
(47, 24, '2018-05-18', 'Friday', '09:00:00', 'available', 0, '2018-05-17', '2018-05-17', '0000-00-00'),
(48, 24, '2018-05-18', 'Friday', '09:30:00', 'available', 0, '2018-05-17', '2018-05-17', '0000-00-00'),
(49, 24, '2018-05-18', 'Friday', '10:00:00', 'booked', 10, '2018-05-17', '2018-05-17', '2018-05-17'),
(50, 24, '2018-05-18', 'Friday', '10:30:00', 'available', 0, '2018-05-17', '2018-05-17', '0000-00-00'),
(51, 24, '2018-05-18', 'Friday', '11:00:00', 'available', 0, '2018-05-17', '2018-05-17', '0000-00-00'),
(52, 24, '2018-05-18', 'Friday', '11:30:00', 'available', 0, '2018-05-17', '2018-05-17', '0000-00-00'),
(53, 24, '2018-05-18', 'Friday', '12:00:00', 'available', 0, '2018-05-17', '2018-05-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` enum('Mr','Mrs','Ms','Miss') NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `provincial_area` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `legal_professional` enum('lawyer','sworn-translator','lawyer-sworn-translator','notary','family-counselor') NOT NULL,
  `admitted_bar` varchar(255) DEFAULT '0',
  `specialty` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `register_date` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `title`, `first_name`, `last_name`, `email`, `provincial_area`, `password`, `legal_professional`, `admitted_bar`, `specialty`, `location`, `register_date`) VALUES
(2, 'Mr', 'praveen', 'tissera', 'praveen.tissera@gmail.com', 'north-Western', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lawyer', 'vavuniya', 'accident-personal', 'kotikawatta', '2018-05-09'),
(3, 'Mr', 'sampa', 'rasini', 'samap@gmail.com', 'western', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lawyer', 'colombo', 'immigration', 'colombo', '2018-05-13'),
(4, 'Mr', 'surangi', 'tissera', 'hgs@gmail.com', 'northern', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lawyer', 'colombo-10', 'accident-personal', 'colombo', '2018-05-14'),
(5, 'Mr', 'udari', 'tissera', 'udari01@gmail.com', 'north-Western', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lawyer', 'colombo-10', 'accident-personal', 'colombo', '2018-05-14'),
(6, 'Mr', 'praveena', 'tisseraa', 'praveena@gmail.com', 'northern', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 'colombo-10', 'accident-personal', 'colombo 4', '2018-05-14'),
(7, 'Mr', 'praveenaa', 'tissera', 'praveenaa@gmail.com', 'northern', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lawyer', 'colombo-10', 'immigration', 'colombo', '2018-05-14'),
(8, 'Mr', 'praveen', 'tissera', 'praveen123.tissera@gmail.com', 'western', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'lawyer-sworn-translator', 'colombo-10', 'immigration', 'colombo', '2018-05-14'),
(9, 'Mr', 'praveen', 'tissera', 'praveen11.tissera@gmail.com', 'northern', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'notary', '', 'divorce', 'colombo', '2018-05-14'),
(10, 'Mr', 'praveen', 'tissera', 'praveen12.tissera@gmail.com', 'north-Central', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'sworn-translator', '', 'divorce', 'colombo', '2018-05-14'),
(11, 'Mr', 'praveen', 'tissera', 'praveen124.tissera@gmail.com', 'northern', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'sworn-translator', '', '0', 'colombo', '2018-05-14'),
(12, 'Mr', 'praveen', 'tissera', 'praveen125.tissera@gmail.com', 'western', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'sworn-translator', '', '0', 'colombo', '2018-05-14'),
(13, 'Mr', 'praveen', 'tissera', 'praveen6.tissera@gmail.com', 'western', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'sworn-translator', '', '0', 'colombo', '2018-05-14'),
(14, 'Mr', 'praveen', 'tissera', 'maithree11.pathirane@gmail.com', 'western', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'lawyer', 'colombo-10', '0', 'colombo', '2018-05-14'),
(15, 'Mr', 'praveen', 'tissera', 'praveen199.tissera@gmail.com', 'north-Western', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'sworn-translator', '', '', 'colombo', '2018-05-14'),
(16, 'Mr', 'praveen', 'tissera', 'praveen198.tissera@gmail.com', 'northern', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'lawyer', 'colombo-10', 'immigration', 'colombo', '2018-05-14'),
(17, 'Mr', 'Lalitha', 'caldera', 'lalitha@gmail.com', 'central', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'sworn-translator', '', '', 'colombo 4', '2018-05-14'),
(18, 'Mr', 'praveen', 'tissera', 'praveen197.tissera@gmail.com', 'northern', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lawyer', 'colombo-10', 'family', 'colombo', '2018-05-14'),
(19, 'Mr', 'praveen', 'tissera', 'praveen777.tissera@gmail.com', 'central', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'notary', '', '', 'kotikawatta', '2018-05-14'),
(20, 'Mr', 'praveen', 'tissera', 'praveen171.tissera@gmail.com', 'sabaragamuwa', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lawyer', 'nuwara', 'criminal', 'colombo', '2018-05-14'),
(21, 'Mr', 'praveen', 'tissera', 'praveen144.tissera@gmail.com', 'western', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lawyer-sworn-translator', 'colombo-10', 'criminal', 'colombo', '2018-05-14'),
(22, 'Miss', 'sasmitha', 'tissera', 'sasmitha123@gmail.com', 'northern', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lawyer', 'colombo-10', 'immigration', 'colombo', '2018-05-15'),
(23, 'Mr', 'raveen', 'jaya', 'raveen@gmail.com', 'northern', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lawyer', 'Welimada-Combined-Court', 'divorce', 'colombo', '2018-05-15'),
(24, 'Mr', 'wanigasekara', 'perera', 'wanni@gmail.com', 'western', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lawyer', 'Kandy', 'divorce', 'kandy', '2018-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_client`
--

CREATE TABLE IF NOT EXISTS `tbl_user_client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `register_date` date NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_user_client`
--

INSERT INTO `tbl_user_client` (`client_id`, `first_name`, `last_name`, `email`, `password`, `contact`, `register_date`) VALUES
(4, 'saseema', 'damaya', 'sasi@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '014521244', '2018-05-14'),
(5, 'udari', 'tissera', 'udari011@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0123654787', '2018-05-15'),
(6, 'gimi', 'ti', 'gimi@yahoo.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '012456874', '2018-05-15'),
(8, 'luky', 'perera', 'luky@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0124587544', '2018-05-17'),
(9, 'chatu', 'kari', 'chatu@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '012458544', '2018-05-17'),
(10, 'achini', 'siriwardana', 'achini@yahoo.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0713695488', '2018-05-17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
