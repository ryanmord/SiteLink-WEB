-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2019 at 11:08 AM
-- Server version: 5.6.42
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_bidding_staging`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_users_id` int(10) NOT NULL,
  `user_types_id` int(10) NOT NULL,
  `admin_users_name` varchar(50) NOT NULL,
  `admin_users_email` varchar(100) NOT NULL,
  `admin_users_password` varchar(255) NOT NULL,
  `admin_users_status` tinyint(1) NOT NULL COMMENT '0=InActive,1=Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_users_id`, `user_types_id`, `admin_users_name`, `admin_users_email`, `admin_users_password`, `admin_users_status`) VALUES
(1, 1, 'Admin', 'admin@gmail.com', '$2y$10$dy7UGfR1PDPHIDXJjos1RO3Kcaz9cSDlcbt/BD4LsnhjGdw/Ogkmy', 1),
(2, 3, 'Swati', 'swati@gmail.com', '$2y$10$dy7UGfR1PDPHIDXJjos1RO3Kcaz9cSDlcbt/BD4LsnhjGdw/Ogkmy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `api_generated_token`
--

CREATE TABLE `api_generated_token` (
  `api_generated_token_id` int(11) NOT NULL,
  `api_generated_token` varchar(20) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=invalid,1=valid',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_generated_token`
--

INSERT INTO `api_generated_token` (`api_generated_token_id`, `api_generated_token`, `status`, `created_at`) VALUES
(1, 'gyjUQ5Qj', 1, '2019-01-29 17:01:03'),
(2, 'gSjldJhR', 1, '2019-01-29 18:25:25'),
(3, 'xGuucXwX', 1, '2019-02-04 12:16:00'),
(4, 'Ww7NWiLy', 1, '2019-02-04 14:54:46'),
(5, 'JC1o2T9H', 1, '2019-02-06 20:55:22'),
(6, 'sgRttSct', 1, '2019-02-06 21:20:05'),
(7, '9ovl3nny', 1, '2019-02-08 18:36:00'),
(8, 'GjLG8mI2', 1, '2019-02-11 15:19:04'),
(9, 'cpc44Jqv', 1, '2019-02-11 19:37:56'),
(10, 'tyHKlGar', 1, '2019-02-12 12:19:39'),
(11, '9R9weGtG', 1, '2019-02-12 19:13:11'),
(12, 'MUcFedyb', 1, '2019-02-12 20:38:42'),
(13, 'aDyRZ0Ia', 1, '2019-02-12 20:38:59'),
(14, '6jtiYwpj', 1, '2019-02-19 19:57:58'),
(15, '9oIYXo0V', 1, '2019-02-20 21:09:53'),
(16, '75mu9luw', 1, '2019-02-20 21:10:06'),
(17, 'fHb7DVLq', 1, '2019-02-27 21:50:40'),
(18, 'p2EZKyKo', 1, '2019-02-27 21:51:06'),
(19, 'wQlhFg7q', 1, '2019-02-28 00:23:34'),
(20, 'nlBS6wVC', 1, '2019-02-28 00:33:32'),
(21, 'pHQVskPn', 1, '2019-02-28 00:45:52'),
(22, 'KXjBxtNk', 1, '2019-02-28 01:08:58'),
(23, '9yl00Vcm', 1, '2019-02-28 22:09:35'),
(24, 'vWAKQeaX', 1, '2019-02-28 22:22:36'),
(25, '3ZR7Bhea', 1, '2019-03-15 05:43:29'),
(26, 'Z1i3DLzB', 1, '2019-03-01 01:51:20'),
(27, '57qNJuq5', 1, '2019-03-01 01:52:34'),
(28, 'His9VsiI', 1, '2019-03-01 01:53:24'),
(29, 'MQEsGTI7', 1, '2019-03-01 02:02:33'),
(30, 'BqSiH0YC', 1, '2019-03-01 03:22:16'),
(31, 'hquqLa2l', 1, '2019-03-01 03:33:03'),
(32, '3BFdPCyH', 1, '2019-03-01 15:14:48'),
(33, 'Hg5Hq2OW', 1, '2019-03-14 07:15:26'),
(34, '8QMN2yoG', 1, '2019-03-14 11:11:40'),
(35, '7a3hOGBs', 1, '2019-03-14 11:18:46'),
(36, 'UdYmnu1H', 1, '2019-03-14 11:20:52'),
(37, '39d9NUwi', 1, '2019-03-14 12:20:02'),
(38, 'IhKYlXhV', 1, '2019-03-14 12:22:25'),
(39, 'F9ONLp3j', 1, '2019-03-14 16:22:27'),
(40, 'he8BiqhE', 1, '2019-03-14 18:23:14'),
(41, 'iEQnHnrD', 1, '2019-03-14 18:26:00'),
(42, '5JbdYksy', 1, '2019-03-14 18:32:09'),
(43, 'lvmgwzUN', 1, '2019-03-14 18:59:14'),
(44, 'OlBfzVuo', 1, '2019-03-14 19:01:50'),
(45, 'CBS6JYs9', 1, '2019-03-15 10:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `associate_type`
--

CREATE TABLE `associate_type` (
  `associate_type_id` tinyint(1) NOT NULL,
  `associate_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `associate_type`
--

INSERT INTO `associate_type` (`associate_type_id`, `associate_type`) VALUES
(1, 'Employee'),
(2, 'Preferred Associate'),
(3, 'Associate');

-- --------------------------------------------------------

--
-- Table structure for table `email_verification`
--

CREATE TABLE `email_verification` (
  `email_verification_id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verification_code` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=Invalid,1=Valid',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_verification`
--

INSERT INTO `email_verification` (`email_verification_id`, `user_id`, `verification_code`, `status`, `created_at`) VALUES
(1, 1, 'rrPPNCuY', 1, '2018-12-27 10:56:44'),
(2, 2, '6MdhUIWw', 1, '2018-12-27 10:59:26'),
(3, 3, 'WWMiQ0nL', 1, '2018-12-27 16:55:57'),
(4, 4, 'dFTNDjbL', 1, '2018-12-27 17:01:44'),
(5, 5, 'E2PgDg8U', 1, '2018-12-27 17:03:47'),
(6, 6, 'wM0SZjEt', 1, '2018-12-27 22:49:44'),
(7, 7, 'J5Ry6xZM', 1, '2018-12-28 16:18:04'),
(8, 8, 'wDWCCMpv', 1, '2018-12-28 16:18:14'),
(9, 9, 'kWYAvE5Q', 1, '2018-12-28 20:05:42'),
(10, 10, '6kMl9IcB', 1, '2018-12-28 20:06:04'),
(11, 11, 'B4DDww2h', 1, '2018-12-28 20:06:27'),
(12, 12, '2p2uCXb2', 1, '2018-12-28 20:10:21'),
(13, 13, 'LPednuZ9', 1, '2019-01-02 12:54:40'),
(14, 14, 'eaSn3vSN', 1, '2019-01-04 05:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `progress_status_type`
--

CREATE TABLE `progress_status_type` (
  `progress_status_type_id` int(11) NOT NULL,
  `progress_status_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `progress_status_type`
--

INSERT INTO `progress_status_type` (`progress_status_type_id`, `progress_status_type`) VALUES
(1, 'Job Started'),
(2, 'Job Complete'),
(3, 'Issue'),
(4, 'Note');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(10) NOT NULL,
  `project_number` varchar(250) DEFAULT NULL,
  `user_id` int(10) NOT NULL COMMENT 'Manager Id',
  `project_name` varchar(100) NOT NULL,
  `project_site_address` varchar(255) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `milesrange` int(10) DEFAULT NULL,
  `on_site_date` datetime DEFAULT NULL,
  `report_due_date` datetime DEFAULT NULL,
  `report_template` varchar(100) DEFAULT NULL,
  `scope_performed_id` varchar(100) NOT NULL,
  `employee_type_id` varchar(255) DEFAULT NULL,
  `instructions` text,
  `approx_bid` double(10,2) DEFAULT NULL,
  `budget` double(20,2) DEFAULT NULL,
  `property_type` varchar(100) DEFAULT NULL,
  `no_of_units` int(20) DEFAULT NULL,
  `squareFootage` double(20,2) DEFAULT NULL,
  `no_of_buildings` int(20) DEFAULT NULL,
  `no_of_stories` int(20) DEFAULT NULL,
  `year_built` int(20) DEFAULT NULL,
  `qaqc_date` datetime DEFAULT NULL,
  `created_by` tinyint(1) DEFAULT NULL COMMENT '1=API,2=Scheduler',
  `land_area` double(15,5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_number`, `user_id`, `project_name`, `project_site_address`, `city`, `state`, `country`, `latitude`, `longitude`, `milesrange`, `on_site_date`, `report_due_date`, `report_template`, `scope_performed_id`, `employee_type_id`, `instructions`, `approx_bid`, `budget`, `property_type`, `no_of_units`, `squareFootage`, `no_of_buildings`, `no_of_stories`, `year_built`, `qaqc_date`, `created_by`, `land_area`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Sara orchid', 'Hinjewadi Rajiv Gandhi Infotech Park, Hinjawadi, Pune, Maharashtra, India', NULL, NULL, NULL, '18.5946784', '73.70953650000001', 205, '2019-04-28 00:00:00', '2019-05-31 00:00:00', 'quire', '1', '1,2,3', 'It is special instructions', 250.50, 565.25, 'multiFamily', 54, 5400.20, 5, 25, 2018, NULL, 2, 5445.00000, '2019-02-04 11:59:53', '2019-03-06 11:03:55'),
(2, NULL, 52, 'demo project5', 'Wakad Chowk, Wakad, Pimpri-Chinchwad, Maharashtra', NULL, NULL, NULL, '18.592407', '73.76171799999997', 38, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', '1,2', 'it is instruction', 4500.00, 5440.20, 'familyflat', 5, 5424.57, 8, 86, 1999, '2019-03-04 00:00:00', 1, 5.23000, '2019-02-04 12:16:14', '2019-02-04 13:33:53'),
(3, NULL, 1, 'Surya Tower project1', 'Wakad Chowk, Wakad, Pimpri-Chinchwad, Maharashtra', NULL, NULL, NULL, '18.592407', '73.76171799999997', 120, '2019-02-06 00:00:00', '2019-02-06 00:00:00', 'new template', '1,2', '1,2,3', 'building purpose', 4500.00, 600.00, 'Multipurpose', 30, 444.00, 8, 15, 2019, NULL, 2, 222.22000, '2019-02-04 12:56:38', '2019-02-04 15:15:43'),
(4, NULL, 52, 'test project2', 'Sr. No 106/2/10/1, Baner Road, Opposite Hotel Sadanand Near Amar Busniness Park, Laxman Nagar, Baner, Pune, Maharashtra 411045, India', NULL, NULL, NULL, '18.568296999999998', '73.768467', 220, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', '1,2,3', 'it is instruction', 4500.00, 5440.20, 'familyflat', 5, 5424.57, 8, 86, 1999, '2019-03-04 00:00:00', 1, 5.23000, '2019-02-04 14:55:00', '2019-02-04 14:58:35'),
(5, NULL, 1, 'Surya Tower project1', 'Wakad, Pimpri-Chinchwad, Maharashtra, India', NULL, NULL, NULL, '18.5989428', '73.76527149999993', 345, '2019-02-08 00:00:00', '2019-02-08 00:00:00', 'new template', '1,2,3', '1,2,3', NULL, 6700.00, 6750.00, 'new project', 55, 45.00, 14, 15, 20, NULL, 2, 4567.89000, '2019-02-04 15:15:48', '2019-02-04 15:15:48'),
(6, NULL, 1, 'Light House city', 'Wakad, Shankar Kalat Nagar, Wakad, Pimpri-Chinchwad, Maharashtra', NULL, NULL, NULL, '18.592455', '73.76152400000001', 302, '2019-02-06 00:00:00', '2019-02-05 00:00:00', 'new template', '1,2,3,4,5', '1,2,3', 'new project Instruction', 4999.00, 5999.00, 'Multipurpose', 1, 1.00, 1, 1, 2018, NULL, 2, 1.00000, '2019-02-04 15:49:57', '2019-02-11 11:12:40'),
(7, NULL, 52, 'test project', 'Wakad Chowk, Wakad, Pimpri-Chinchwad, Maharashtra', NULL, NULL, NULL, '18.592407', '73.76171799999997', 320, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', '1,2,3', 'it is instruction', 5400.00, 5440.20, 'familyflat', 5, 5424.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-04 16:16:03', '2019-02-04 17:17:43'),
(8, NULL, 1, 'Saikrupa heights', 'Wakad Road, Wakad, Maharashtra, India', NULL, NULL, NULL, '19.240791', '77.57307079999998', 300, '2019-02-07 00:00:00', '2019-02-08 00:00:00', 'Template Generated', '1,2,3', '1,2,3', 'It is building', 4250.00, 4350.00, 'sample project', 14, 45.00, 4, 15, 2018, NULL, 2, 222.24000, '2019-02-04 16:27:10', '2019-02-04 17:12:54'),
(9, NULL, 1, 'light House tower1', 'Wakad, Pimpri-Chinchwad, Maharashtra, India', NULL, NULL, NULL, '18.5989428', '73.76527149999993', 230, '2019-02-22 00:00:00', '2019-02-21 00:00:00', 'new template', '1,2,3', '1,2,3', 'new project Instruction1', 4000.00, 2500.00, 'new project', 35, 40.56, 3, 8, 2018, NULL, 2, 3500.44000, '2019-02-04 17:08:13', '2019-02-04 17:12:37'),
(10, NULL, 1, 'Saikrupa Avenue', 'Wakad, Shankar Kalat Nagar, Wakad, Pimpri-Chinchwad, Maharashtra', NULL, NULL, NULL, '18.592455', '73.76152400000001', 244, '2019-02-16 00:00:00', '2019-02-15 00:00:00', 'this is new report template developed', '1,2,3', '1,2,3', 'new project Instruction', 4000.00, 4350.00, 'sample project', 14, 444.00, 8, 5, 2017, NULL, 2, 4567.89000, '2019-02-04 17:15:19', '2019-02-04 17:15:19'),
(11, NULL, 52, 'API Test Project', '1234 Maple Lane, Minneapolis, MN 55426', NULL, NULL, NULL, '18.2222', '75.0221', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'Template', 'ECA', NULL, 'Special Instructions', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 20:55:30', '2019-02-06 20:55:30'),
(12, NULL, 52, 'API Test Project 2', 'Minneapolis, MN', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'Template', 'ECA', NULL, 'Special Instructions', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 20:58:07', '2019-02-06 20:58:07'),
(13, NULL, 52, 'API Test Project 3', 'Minneapolis, MN', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'Template', 'PCA', NULL, 'Special Instructions', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 21:02:24', '2019-02-06 21:02:24'),
(14, NULL, 52, 'API Test Project 4', 'Minneapolis, MN', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'Template', '1', NULL, 'Special Instructions', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 21:07:08', '2019-02-06 21:07:08'),
(15, NULL, 52, 'UPDATED PROJECT', 'Minneapolis, MN', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'UPDATE: Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 21:20:13', '2019-02-06 22:35:11'),
(16, NULL, 52, 'Bens Project', 'Chaska', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 23:39:46', '2019-02-06 23:39:46'),
(17, NULL, 52, 'Bens Project', 'Chaska', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:48:41', '2019-02-07 01:48:41'),
(18, NULL, 52, 'Bens Project', 'Chaska', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:48:47', '2019-02-07 01:48:47'),
(19, NULL, 52, 'Bens Project', 'Chaska', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:49:08', '2019-02-07 01:49:08'),
(20, NULL, 54, 'Bens Project', 'Chaska', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:49:21', '2019-02-07 01:49:21'),
(21, NULL, 52, 'Bens Project', 'Chaska', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:49:29', '2019-02-07 01:49:29'),
(22, NULL, 52, 'Bens Project', 'Chaska', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:49:49', '2019-02-07 01:49:49'),
(23, NULL, 52, 'Bens Project', 'Chaska', NULL, NULL, NULL, '44.9778', '93.2650', 216, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', '1,2,3', 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', 5000.00, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:51:00', '2019-02-08 17:42:21'),
(24, NULL, 52, 'Test Ryan', 'Chaska', NULL, NULL, NULL, '44.9778', '93.2650', 129, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', '2', 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', 1000.00, 10000.00, 'Property Type', 100, 10000000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 02:18:10', '2019-02-07 21:00:04'),
(25, NULL, 57, 'update project', 'Wakad Chowk, Wakad, Pimpri-Chinchwad, Maharashtra', NULL, NULL, NULL, '18.592407', '73.76171799999997', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', NULL, 'it is instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-11 15:25:58', '2019-02-11 15:28:46'),
(26, NULL, 52, 'Test Ryan', 'Minneapolis, MN', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-11 19:38:17', '2019-02-11 19:38:17'),
(27, NULL, 52, 'Test Ryan', 'Minneapolis, MN', NULL, NULL, NULL, '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '2', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-11 19:38:48', '2019-02-11 19:38:48'),
(29, NULL, 52, 'sara Orchid', 'Chinchwad Gaon, Gandhi Peth, Prabhat Colony, Chinchwad Gaon, Chinchwad, Pimpri-Chinchwad, Maharashtra', NULL, NULL, NULL, '18.62789', '73.78235999999993', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', NULL, 'it is instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-12 12:21:14', '2019-02-12 12:24:09'),
(30, NULL, 52, 'Live List Test', '1 Twins Way, Minneapolis, MN 55403', NULL, NULL, NULL, '44.979389', '-93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '2', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-12 19:16:15', '2019-02-12 19:16:15'),
(31, NULL, 60, 'Another Twins Test', '1 Twins Way, Minneapolis, MN 55403', NULL, NULL, NULL, '44.979389', '-93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '2', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-12 20:56:43', '2019-02-12 20:57:11'),
(32, NULL, 52, 'sara Orchid', 'Chinchwad Gaon, Gandhi Peth, Prabha\nt Colony, Chinchwad Gaon, Chinchwad, Pimpri-Chinchwad, Maharashtr\na', NULL, NULL, NULL, '18.62789', '73.78235999999993', 223, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', '1,2,3', 'it i\ns instruction', 54450.00, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-20 21:32:38', '2019-03-06 10:55:21'),
(33, NULL, 64, 'sara Orchid', 'Chinchwad Gaon, Gandhi Peth, Prabha\nt Colony, Chinchwad Gaon, Chinchwad, Pimpri-Chinchwad, Maharashtr\na', NULL, NULL, NULL, '18.62789', '73.78235999999993', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', NULL, 'it i\ns instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-20 21:32:59', '2019-02-20 21:32:59'),
(34, NULL, 64, 'TwinsWork', '1 Twins Way, Minneapolis, MN  55403', NULL, NULL, NULL, '44.975662764', '-93.273665572', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', NULL, 'it i\ns instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-20 21:34:13', '2019-02-20 21:34:13'),
(35, NULL, 64, 'TwinsWork', '1 Twins Way, Minneapolis, MN  55403', NULL, NULL, NULL, '44.975662764', '-93.273665572', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '2', NULL, 'it i\ns instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-20 21:34:46', '2019-02-20 21:34:46'),
(36, NULL, 66, 'test project2', '124 any street, city, st 55555', NULL, NULL, NULL, '19.592407', '74.76171799999997', NULL, '2019-03-02 08:30:52', '2019-03-17 12:30:52', 'Quire2', '3,1', NULL, 'special instructions go here2', NULL, 25440.20, 'familyflat2', 52, 2524.57, 82, 122, 1992, NULL, 1, 7.00000, '2019-02-28 22:22:42', '2019-03-01 03:22:16'),
(37, NULL, 65, 'test project', '123 any street, city, st 55555', NULL, NULL, NULL, '18.592407', '73.76171799999997', NULL, '2019-03-01 08:30:52', '2019-03-14 12:30:52', 'Quire', '3,1,5', NULL, 'special instructions go here', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 12, 1999, NULL, 1, 7.00000, '2019-03-01 02:02:33', '2019-03-01 02:02:33'),
(38, NULL, 1, 'Sara orchid2', 'Chinchwad, Maharashtra, India', NULL, NULL, NULL, '18.6297811', '73.79970939999998', 305, '2019-03-26 00:00:00', '2019-03-27 00:00:00', 'quire', '1,2', '1,2,3', 'It is special instructions', 250.50, 565.25, 'multiFamily', 54, 5400.20, 5, 25, 2018, NULL, 2, 5445.00000, '2019-03-04 12:29:32', '2019-03-11 06:11:10'),
(39, NULL, 52, 'Test Bid Project', 'Hingawadi Park Phase 1 Samved Jawal, Phase 2, Phase 1, Hinjewadi Rajiv Gandhi Infotech Park, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', NULL, NULL, NULL, '18.588559228564826', '73.73755164418026', 335, '2019-03-31 00:00:00', '2019-03-31 00:00:00', 'quire', '1,2', '1,2,3', 'It is building', 660.50, 565.25, 'multiFamily', 54, 450.50, 5, 25, 2018, NULL, 2, 5445.00000, '2019-03-11 08:11:08', '2019-03-14 15:38:26'),
(40, 'B19-1596', 1, 'demo_project12', 'Wakad Chowk, Wakad, Pimpri-Chinchwad, Maharashtra', 'Pimpri-Chinchwad', 'MH', 'IN', '18.592407', '73.76171799999997', NULL, '2019-05-23 06:10:08', '2019-05-30 00:00:00', 'Quire', '1,2,3', NULL, 'it is instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, '2019-05-17 00:00:00', 1, 5.23000, '2019-03-14 07:37:58', '2019-03-14 07:42:52'),
(41, 'X19-0000', 64, 'Target Field Project', '1 Twins Way, Minneapolis, MN  55403', 'Minneapolis', 'MN', 'US', '44.975662764', '-93.273665572', 199, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', '1,3', 'it i\ns instruction', 2000.00, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 2009, NULL, 1, 5.23000, '2019-03-14 16:23:37', '2019-03-14 18:22:35'),
(42, 'X19-0001', 64, 'Nova Consulting Project', '1107 Hazeltine Boulevard, Chaska, MN 55318', 'Chaska', 'MN', 'US', '44.835969', '-93.599385', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', NULL, 'Here are some special instructions for the project', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 2009, NULL, 1, 5.23000, '2019-03-14 16:28:35', '2019-03-14 16:28:35'),
(43, 'X19-0001', 64, 'Mall of America', '60 E Broadway, Bloomington, MN 55425', 'Bloomington', 'MN', 'US', '44.85848', '-93.24485', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1', NULL, 'Here are some special instructions for the project', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 2009, NULL, 1, 5.23000, '2019-03-14 16:29:46', '2019-03-14 16:29:46'),
(44, 'X19-0003', 64, 'US Bank Stadium', '401 Chicago Ave, Minneapolis, MN 55415', 'Minneapolis', 'MN', 'US', '44.973553', '-93.257669', 179, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1', '1,2,3', 'Here are some special instructions for the project', 100.00, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 2009, NULL, 1, 5.23000, '2019-03-14 16:31:18', '2019-03-14 18:22:59'),
(45, 'X19-0004', 64, 'US Bank Stadium 2', '401 Chicago Ave, Minneapolis, MN 55415', 'Minneapolis', 'MN', 'US', '44.973553', '-93.257669', 175, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1', '1', 'Here are some special instructions for the project', 5000.00, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 2009, NULL, 1, 5.23000, '2019-03-14 16:36:22', '2019-03-14 16:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `project_bids`
--

CREATE TABLE `project_bids` (
  `project_bid_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL COMMENT 'Associate id',
  `is_employee` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `associate_suggested_bid` double(10,2) NOT NULL,
  `project_bid_status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '0=Rejected,1=Approved,2=Pending',
  `created_at` datetime DEFAULT NULL,
  `accepted_rejected_at` datetime DEFAULT NULL,
  `bid_status` tinyint(1) DEFAULT '0' COMMENT '0-invalid,1=valid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_bids`
--

INSERT INTO `project_bids` (`project_bid_id`, `project_id`, `user_id`, `is_employee`, `associate_suggested_bid`, `project_bid_status`, `created_at`, `accepted_rejected_at`, `bid_status`) VALUES
(1, 7, 2, 0, 5000.00, 1, '2019-02-04 17:25:06', '2019-02-04 17:25:32', 1),
(2, 10, 2, 0, 4500.00, 1, '2019-02-04 18:42:48', '2019-02-07 19:05:27', 1),
(3, 8, 2, 0, 4500.00, 1, '2019-02-07 19:40:39', '2019-02-07 19:42:20', 1),
(4, 9, 2, 0, 4000.00, 1, '2019-02-07 19:46:15', '2019-02-07 19:46:33', 1),
(5, 5, 2, 0, 2580.00, 1, '2019-02-07 19:47:28', '2019-02-07 19:47:50', 1),
(6, 3, 2, 0, 250.00, 1, '2019-02-07 19:51:18', '2019-02-07 19:51:33', 1),
(7, 4, 2, 0, 23356.00, 1, '2019-02-07 19:51:54', '2019-02-07 19:52:27', 1),
(8, 2, 2, 0, 2580.00, 1, '2019-02-07 20:00:38', '2019-02-07 20:01:56', 1),
(9, 24, 3, 0, 1000.00, 1, '2019-02-07 21:18:17', '2019-02-07 21:18:49', 1),
(10, 23, 2, 0, 4000.00, 2, '2019-02-08 17:43:58', NULL, 1),
(11, 6, 2, 0, 2356.00, 1, '2019-02-11 13:02:08', '2019-03-06 11:02:14', 1),
(12, 32, 23, 0, 54450.00, 1, '2019-03-06 16:17:28', '2019-03-06 16:17:28', 1),
(13, 1, 2, 0, 500.58, 2, '2019-03-06 11:09:43', NULL, 1),
(14, 38, 2, 0, 150.00, 1, '2019-03-11 06:11:39', '2019-03-11 06:12:02', 1),
(15, 45, 198, 1, 5000.00, 1, '2019-03-14 16:39:28', '2019-03-14 16:39:58', 1),
(16, 41, 198, 1, 2000.00, 1, '2019-03-14 18:30:37', '2019-03-14 18:37:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_bid_request`
--

CREATE TABLE `project_bid_request` (
  `project_bid_request_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `bid_request_status` tinyint(1) NOT NULL DEFAULT '0',
  `disregarded_status` tinyint(1) DEFAULT '0' COMMENT '0=no,1=yes',
  `check_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `request_send_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_bid_request`
--

INSERT INTO `project_bid_request` (`project_bid_request_id`, `from_user_id`, `to_user_id`, `project_id`, `bid_request_status`, `disregarded_status`, `check_status`, `request_send_status`, `created_at`) VALUES
(19, 1, 14, 3, 0, 0, 0, 1, '2019-02-04 15:15:43'),
(20, 1, 38, 3, 0, 0, 0, 1, '2019-02-04 15:15:43'),
(21, 1, 39, 3, 0, 0, 0, 1, '2019-02-04 15:15:43'),
(46, 52, 3, 24, 0, 0, 1, 1, '2019-02-07 20:59:54'),
(108, 52, 14, 23, 0, 0, 1, 0, '2019-02-08 19:04:26'),
(179, 52, 14, 22, 0, 0, 1, 0, '2019-02-12 14:58:12'),
(180, 52, 38, 22, 0, 1, 0, 0, '2019-02-12 14:58:14'),
(407, 1, 23, 1, 0, 0, 0, 1, '2019-03-04 11:54:37'),
(408, 1, 23, 6, 0, 0, 0, 0, '2019-03-04 11:54:37'),
(409, 1, 68, 6, 0, 0, 0, 0, '2019-03-04 12:03:12'),
(410, 1, 23, 38, 0, 0, 0, 1, '2019-03-04 12:29:33'),
(411, 1, 40, 38, 0, 0, 0, 1, '2019-03-04 12:29:33'),
(412, 1, 68, 38, 0, 0, 0, 1, '2019-03-04 12:29:33'),
(413, 1, 14, 38, 0, 0, 0, 1, '2019-03-04 12:45:24'),
(414, 1, 38, 38, 0, 0, 0, 1, '2019-03-04 12:45:24'),
(415, 1, 39, 38, 0, 0, 0, 1, '2019-03-04 12:45:24'),
(418, 52, 23, 32, 0, 0, 0, 1, '2019-03-06 10:55:05'),
(419, 52, 40, 32, 0, 0, 0, 1, '2019-03-06 10:55:05'),
(420, 52, 68, 32, 0, 0, 0, 1, '2019-03-06 10:55:05'),
(422, 52, 14, 32, 0, 0, 1, 1, '2019-03-06 10:55:11'),
(423, 1, 40, 1, 0, 0, 0, 1, '2019-03-06 11:14:05'),
(424, 1, 68, 1, 0, 0, 0, 1, '2019-03-06 11:14:05'),
(438, 60, 3, 31, 0, 0, 0, 0, '2019-03-06 15:07:29'),
(439, 60, 9, 31, 0, 0, 0, 0, '2019-03-06 15:07:29'),
(440, 60, 10, 31, 0, 0, 0, 0, '2019-03-06 15:07:29'),
(441, 60, 12, 31, 0, 0, 0, 0, '2019-03-06 15:07:29'),
(442, 60, 16, 31, 0, 0, 0, 0, '2019-03-06 15:07:29'),
(443, 60, 17, 31, 0, 0, 0, 0, '2019-03-06 15:07:29'),
(444, 60, 19, 31, 0, 0, 0, 0, '2019-03-06 15:07:29'),
(446, 60, 14, 31, 0, 0, 1, 0, '2019-03-06 15:07:36'),
(447, 60, 39, 31, 0, 0, 1, 0, '2019-03-06 15:07:37'),
(450, 1, 14, 1, 0, 0, 0, 1, '2019-03-06 11:03:55'),
(451, 1, 38, 1, 0, 0, 0, 1, '2019-03-06 11:03:55'),
(452, 1, 39, 1, 0, 0, 0, 1, '2019-03-06 11:03:55'),
(453, 1, 70, 1, 0, 0, 0, 1, '2019-03-06 11:03:55'),
(454, 1, 2, 1, 0, 0, 0, 0, '2019-03-11 04:59:01'),
(455, 1, 2, 38, 0, 0, 0, 1, '2019-03-11 04:59:01'),
(456, 52, 2, 39, 0, 0, 0, 1, '2019-03-11 08:11:09'),
(457, 52, 14, 39, 0, 0, 0, 1, '2019-03-11 08:11:09'),
(458, 52, 23, 39, 0, 0, 0, 1, '2019-03-11 08:11:09'),
(459, 52, 38, 39, 0, 0, 0, 1, '2019-03-11 08:11:09'),
(460, 52, 39, 39, 0, 0, 0, 1, '2019-03-11 08:11:09'),
(461, 52, 40, 39, 0, 0, 0, 1, '2019-03-11 08:11:09'),
(462, 52, 68, 39, 0, 0, 0, 1, '2019-03-11 08:11:09'),
(477, 64, 2, 33, 0, 0, 0, 0, '2019-03-12 19:02:41'),
(478, 64, 23, 33, 0, 0, 0, 0, '2019-03-12 19:02:41'),
(479, 64, 40, 33, 0, 0, 0, 0, '2019-03-12 19:02:41'),
(480, 64, 68, 33, 0, 0, 0, 0, '2019-03-12 19:02:41'),
(487, 1, 9, 40, 0, 0, 1, 0, '2019-03-14 15:45:03'),
(488, 1, 198, 1, 0, 0, 0, 0, '2019-03-14 16:34:38'),
(489, 52, 198, 39, 0, 0, 0, 0, '2019-03-14 16:34:38'),
(531, 64, 10, 45, 0, 1, 0, 0, '2019-03-14 16:38:12'),
(532, 64, 12, 45, 0, 1, 0, 0, '2019-03-14 16:38:12'),
(533, 64, 16, 45, 0, 1, 0, 0, '2019-03-14 16:38:12'),
(534, 64, 21, 45, 0, 1, 0, 0, '2019-03-14 16:38:12'),
(535, 64, 198, 45, 0, 0, 1, 0, '2019-03-14 16:38:18'),
(557, 64, 16, 41, 0, 0, 1, 1, '2019-03-14 18:21:39'),
(558, 64, 17, 41, 0, 0, 1, 1, '2019-03-14 18:21:39'),
(559, 64, 198, 41, 0, 0, 1, 0, '2019-03-14 18:22:00'),
(566, 64, 9, 41, 0, 0, 0, 1, '2019-03-14 18:22:21'),
(567, 64, 12, 41, 0, 0, 0, 1, '2019-03-14 18:22:21'),
(576, 64, 9, 44, 0, 0, 0, 1, '2019-03-14 18:22:26'),
(577, 64, 10, 44, 0, 0, 0, 1, '2019-03-14 18:22:26'),
(578, 64, 12, 44, 0, 1, 0, 0, '2019-03-14 18:22:26'),
(579, 64, 16, 44, 0, 1, 0, 0, '2019-03-14 18:22:26'),
(580, 64, 20, 44, 0, 1, 0, 0, '2019-03-14 18:22:26'),
(581, 64, 21, 44, 0, 1, 0, 0, '2019-03-14 18:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `project_notification`
--

CREATE TABLE `project_notification` (
  `project_notification_id` int(11) NOT NULL,
  `project_notification_type_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `notification_text` text,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `read_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unread,1=read',
  `created_at` datetime DEFAULT NULL,
  `notification_read_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_notification`
--

INSERT INTO `project_notification` (`project_notification_id`, `project_notification_type_id`, `project_id`, `notification_text`, `from_user_id`, `to_user_id`, `read_flag`, `created_at`, `notification_read_at`) VALUES
(1, 15, 1, 'New project assigned to you!', 1, 1, 0, '2019-02-04 11:59:54', NULL),
(2, 1, 1, 'New project listed in your area!', 1, 14, 0, '2019-02-04 11:59:54', NULL),
(3, 1, 1, 'New project listed in your area!', 1, 23, 1, '2019-02-04 11:59:54', '2019-03-14 18:37:33'),
(4, 1, 1, 'New project listed in your area!', 1, 39, 0, '2019-02-04 11:59:54', NULL),
(5, 15, 3, 'New project assigned to you!', 1, 1, 0, '2019-02-04 12:56:38', NULL),
(6, 1, 3, 'New project listed in your area!', 1, 23, 0, '2019-02-04 12:56:38', NULL),
(7, 1, 3, 'New project listed in your area!', 1, 2, 1, '2019-02-04 12:56:38', '2019-03-11 06:12:56'),
(8, 6, 3, 'Scheduler updated project details', 1, 1, 0, '2019-02-04 13:29:18', NULL),
(9, 6, 3, 'Scheduler updated project details', 1, 23, 0, '2019-02-04 13:29:18', NULL),
(10, 6, 3, 'Scheduler updated project details', 1, 2, 1, '2019-02-04 13:29:18', '2019-03-11 05:55:09'),
(11, 1, 2, 'New project listed in your area!', 52, 23, 1, '2019-02-04 13:33:53', '2019-02-07 19:44:54'),
(12, 1, 2, 'New project listed in your area!', 52, 2, 1, '2019-02-04 13:33:53', '2019-02-11 20:34:57'),
(13, 6, 3, 'Scheduler updated project details', 1, 1, 1, '2019-02-04 13:38:04', '2019-03-06 11:19:18'),
(14, 6, 3, 'Scheduler updated project details', 1, 23, 0, '2019-02-04 13:38:04', NULL),
(15, 1, 4, 'New project listed in your area!', 52, 2, 1, '2019-02-04 14:58:35', '2019-02-11 16:38:54'),
(16, 1, 4, 'New project listed in your area!', 52, 23, 0, '2019-02-04 14:58:35', NULL),
(17, 6, 3, 'Scheduler updated project details', 1, 1, 0, '2019-02-04 15:15:43', NULL),
(18, 1, 3, 'New project listed in your area!', 1, 2, 1, '2019-02-04 15:15:43', '2019-02-11 20:34:55'),
(19, 1, 3, 'New project listed in your area!', 1, 14, 0, '2019-02-04 15:15:43', NULL),
(20, 1, 3, 'New project listed in your area!', 1, 23, 0, '2019-02-04 15:15:43', NULL),
(21, 1, 3, 'New project listed in your area!', 1, 38, 0, '2019-02-04 15:15:43', NULL),
(22, 1, 3, 'New project listed in your area!', 1, 39, 0, '2019-02-04 15:15:43', NULL),
(23, 15, 5, 'New project assigned to you!', 1, 1, 0, '2019-02-04 15:15:48', NULL),
(24, 1, 5, 'New project listed in your area!', 1, 2, 1, '2019-02-04 15:15:48', '2019-02-11 20:34:53'),
(25, 1, 5, 'New project listed in your area!', 1, 23, 0, '2019-02-04 15:15:48', NULL),
(26, 15, 6, 'New project assigned to you!', 1, 1, 0, '2019-02-04 15:49:57', NULL),
(27, 1, 6, 'New project listed in your area!', 1, 23, 0, '2019-02-04 15:49:57', NULL),
(28, 6, 6, 'Scheduler updated project details', 1, 1, 0, '2019-02-04 15:50:35', NULL),
(29, 6, 6, 'Scheduler updated project details', 1, 23, 0, '2019-02-04 15:50:35', NULL),
(30, 15, 8, 'New project assigned to you!', 1, 1, 0, '2019-02-04 16:27:10', NULL),
(31, 1, 8, 'New project listed in your area!', 1, 23, 0, '2019-02-04 16:27:10', NULL),
(32, 6, 8, 'Scheduler updated project details', 1, 1, 0, '2019-02-04 16:29:20', NULL),
(33, 6, 8, 'Scheduler updated project details', 1, 1, 0, '2019-02-04 16:55:02', NULL),
(34, 1, 8, 'New project listed in your area!', 1, 23, 0, '2019-02-04 16:55:02', NULL),
(35, 6, 8, 'Scheduler updated project details', 1, 1, 0, '2019-02-04 17:03:21', NULL),
(36, 6, 8, 'Scheduler updated project details', 1, 23, 0, '2019-02-04 17:03:21', NULL),
(37, 15, 9, 'New project assigned to you!', 1, 1, 0, '2019-02-04 17:08:13', NULL),
(38, 1, 9, 'New project listed in your area!', 1, 23, 0, '2019-02-04 17:08:13', NULL),
(39, 6, 9, 'Scheduler updated project details', 1, 1, 0, '2019-02-04 17:09:54', NULL),
(40, 6, 9, 'Scheduler updated project details', 1, 23, 0, '2019-02-04 17:09:54', NULL),
(41, 6, 9, 'Scheduler updated project details', 1, 1, 0, '2019-02-04 17:12:37', NULL),
(42, 1, 9, 'New project listed in your area!', 1, 2, 1, '2019-02-04 17:12:37', '2019-02-11 20:34:50'),
(43, 1, 9, 'New project listed in your area!', 1, 23, 0, '2019-02-04 17:12:37', NULL),
(44, 6, 8, 'Scheduler updated project details', 1, 1, 0, '2019-02-04 17:12:54', NULL),
(45, 1, 8, 'New project listed in your area!', 1, 2, 1, '2019-02-04 17:12:55', '2019-02-11 20:34:48'),
(46, 1, 8, 'New project listed in your area!', 1, 23, 0, '2019-02-04 17:12:55', NULL),
(47, 15, 10, 'New project assigned to you!', 1, 1, 0, '2019-02-04 17:15:19', NULL),
(48, 1, 10, 'New project listed in your area!', 1, 2, 1, '2019-02-04 17:15:19', '2019-02-11 20:34:46'),
(49, 1, 10, 'New project listed in your area!', 1, 23, 0, '2019-02-04 17:15:19', NULL),
(50, 1, 7, 'New project listed in your area!', 52, 2, 1, '2019-02-04 17:17:43', '2019-02-04 18:28:30'),
(51, 1, 7, 'New project listed in your area!', 52, 23, 0, '2019-02-04 17:17:43', NULL),
(52, 3, 7, 'Job is allocated to Swati', 1, 52, 0, '2019-02-04 17:25:32', NULL),
(53, 3, 7, 'Congratulations! Your bid was accepted!', 52, 2, 1, '2019-02-04 17:25:32', '2019-02-04 17:26:49'),
(54, 12, 7, 'Associate added new status!', 2, 52, 0, '2019-02-04 17:27:48', NULL),
(55, 12, 7, 'Associate added new status!', 2, 52, 0, '2019-02-04 17:28:31', NULL),
(56, 12, 7, 'Associate added new status!', 2, 52, 0, '2019-02-04 17:28:55', NULL),
(57, 13, 7, 'Project is On hold by manager!', 52, 2, 1, '2019-02-04 17:42:14', '2019-02-07 20:04:55'),
(58, 14, 7, 'Project is In progress by manager!', 52, 2, 1, '2019-02-04 17:46:17', '2019-02-04 17:47:48'),
(59, 7, 7, 'Project completed by manager!', 52, 2, 1, '2019-02-04 17:49:59', '2019-02-08 10:09:26'),
(60, 11, 7, 'New Rating given by Manager!', 52, 2, 1, '2019-02-04 17:49:59', '2019-02-07 20:03:32'),
(61, 11, 7, 'New Rating given by Associate!', 2, 52, 0, '2019-02-04 17:51:01', NULL),
(62, 3, 10, 'Job is allocated to Swati', 1, 1, 0, '2019-02-07 19:05:27', NULL),
(63, 3, 10, 'Congratulations! Your bid was accepted!', 1, 2, 1, '2019-02-07 19:05:27', '2019-02-07 20:05:42'),
(64, 7, 10, 'Project completed by manager!', 1, 2, 1, '2019-02-07 19:07:25', '2019-02-07 20:03:40'),
(65, 11, 10, 'New Rating given by Manager!', 1, 2, 1, '2019-02-07 19:07:25', '2019-02-11 20:35:10'),
(66, 3, 8, 'Job is allocated to Swati', 1, 1, 0, '2019-02-07 19:42:20', NULL),
(67, 3, 8, 'Congratulations! Your bid was accepted!', 1, 2, 1, '2019-02-07 19:42:20', '2019-02-07 20:05:11'),
(68, 7, 8, 'Project completed by manager!', 1, 2, 1, '2019-02-07 19:44:45', '2019-02-07 20:04:09'),
(69, 11, 8, 'New Rating given by Manager!', 1, 2, 1, '2019-02-07 19:44:45', '2019-02-11 16:44:50'),
(70, 3, 9, 'Job is allocated to Swati', 1, 1, 0, '2019-02-07 19:46:33', NULL),
(71, 3, 9, 'Congratulations! Your bid was accepted!', 1, 2, 1, '2019-02-07 19:46:33', '2019-02-07 20:04:38'),
(72, 3, 5, 'Job is allocated to Swati', 1, 1, 0, '2019-02-07 19:47:50', NULL),
(73, 3, 5, 'Congratulations! Your bid was accepted!', 1, 2, 1, '2019-02-07 19:47:50', '2019-02-11 16:40:40'),
(74, 3, 3, 'Job is allocated to Swati', 1, 1, 0, '2019-02-07 19:51:33', NULL),
(75, 3, 3, 'Congratulations! Your bid was accepted!', 1, 2, 1, '2019-02-07 19:51:33', '2019-02-07 20:03:58'),
(76, 3, 4, 'Job is allocated to Swati', 1, 52, 0, '2019-02-07 19:52:27', NULL),
(77, 3, 4, 'Congratulations! Your bid was accepted!', 52, 2, 1, '2019-02-07 19:52:27', '2019-02-07 20:04:31'),
(78, 11, 8, 'New Rating given by Associate!', 2, 1, 0, '2019-02-07 19:54:42', NULL),
(79, 3, 2, 'Job is allocated to Swati', 1, 52, 0, '2019-02-07 20:01:56', NULL),
(80, 3, 2, 'Congratulations! Your bid was accepted!', 52, 2, 1, '2019-02-07 20:01:56', '2019-02-07 20:04:44'),
(81, 1, 24, 'New project listed in your area!', 52, 3, 0, '2019-02-07 21:00:04', NULL),
(82, 3, 24, 'Job is allocated to RyanPCA', 1, 52, 0, '2019-02-07 21:18:49', NULL),
(83, 3, 24, 'Congratulations! Your bid was accepted!', 52, 3, 0, '2019-02-07 21:18:49', NULL),
(84, 12, 9, 'Associate added new status!', 2, 1, 0, '2019-02-08 17:07:38', NULL),
(85, 1, 23, 'New project listed in your area!', 52, 2, 1, '2019-02-08 17:42:21', '2019-02-11 16:39:04'),
(86, 1, 23, 'New project listed in your area!', 52, 23, 0, '2019-02-08 17:42:21', NULL),
(87, 6, 6, 'Scheduler updated project details', 1, 1, 0, '2019-02-11 11:12:40', NULL),
(88, 1, 6, 'New project listed in your area!', 1, 2, 1, '2019-02-11 11:12:40', '2019-02-21 22:40:24'),
(89, 12, 2, 'Associate added new status!', 2, 52, 0, '2019-02-15 22:11:55', NULL),
(90, 15, 38, 'New project assigned to you!', 1, 1, 0, '2019-03-04 12:29:32', NULL),
(91, 1, 38, 'New project listed in your area!', 1, 23, 0, '2019-03-04 12:29:32', NULL),
(92, 1, 38, 'New project listed in your area!', 1, 40, 0, '2019-03-04 12:29:33', NULL),
(93, 1, 38, 'New project listed in your area!', 1, 68, 0, '2019-03-04 12:29:33', NULL),
(94, 6, 38, 'Scheduler updated project details', 1, 1, 0, '2019-03-04 12:45:24', NULL),
(95, 1, 38, 'New project listed in your area!', 1, 14, 0, '2019-03-04 12:45:24', NULL),
(96, 1, 38, 'New project listed in your area!', 1, 23, 0, '2019-03-04 12:45:24', NULL),
(97, 1, 38, 'New project listed in your area!', 1, 38, 0, '2019-03-04 12:45:24', NULL),
(98, 1, 38, 'New project listed in your area!', 1, 39, 0, '2019-03-04 12:45:24', NULL),
(99, 1, 38, 'New project listed in your area!', 1, 40, 0, '2019-03-04 12:45:24', NULL),
(100, 1, 38, 'New project listed in your area!', 1, 68, 0, '2019-03-04 12:45:24', NULL),
(101, 7, 2, 'Project completed by manager!', 52, 2, 0, '2019-03-04 17:42:16', NULL),
(102, 7, 4, 'Project completed by manager!', 52, 2, 0, '2019-03-04 18:38:08', NULL),
(103, 1, 32, 'New project listed in your area!', 52, 23, 0, '2019-03-06 10:55:21', NULL),
(104, 1, 32, 'New project listed in your area!', 52, 40, 0, '2019-03-06 10:55:22', NULL),
(105, 1, 32, 'New project listed in your area!', 52, 68, 0, '2019-03-06 10:55:22', NULL),
(106, 1, 32, 'New project listed in your area!', 52, 2, 1, '2019-03-06 10:55:22', '2019-03-11 05:51:21'),
(107, 1, 32, 'New project listed in your area!', 52, 14, 0, '2019-03-06 10:55:22', NULL),
(108, 7, 9, 'Project completed by manager!', 1, 2, 1, '2019-03-06 10:59:14', '2019-03-06 11:01:48'),
(109, 3, 6, 'Job is allocated to Swati', 1, 1, 0, '2019-03-06 11:02:14', NULL),
(110, 3, 6, 'Congratulations! Your bid was accepted!', 1, 2, 1, '2019-03-06 11:02:14', '2019-03-06 11:01:43'),
(111, 6, 1, 'Scheduler updated project details', 1, 1, 0, '2019-03-06 11:14:04', NULL),
(112, 6, 1, 'Scheduler updated project details', 1, 23, 1, '2019-03-06 11:14:04', '2019-03-06 11:00:22'),
(113, 1, 1, 'New project listed in your area!', 1, 40, 0, '2019-03-06 11:14:05', NULL),
(114, 1, 1, 'New project listed in your area!', 1, 68, 0, '2019-03-06 11:14:05', NULL),
(115, 12, 6, 'Associate added new status!', 2, 1, 0, '2019-03-06 13:23:19', NULL),
(116, 3, 32, 'Job is allocated to Rohit', 52, 52, 0, '2019-03-06 16:17:28', NULL),
(117, 3, 32, 'Congratulations! Job was accepted!', 52, 23, 0, '2019-03-06 16:17:28', NULL),
(118, 12, 32, 'Associate added new status!', 23, 52, 0, '2019-03-06 16:18:23', NULL),
(119, 12, 32, 'Associate added new status!', 23, 52, 0, '2019-03-06 10:53:59', NULL),
(120, 6, 1, 'Scheduler updated project details', 1, 1, 0, '2019-03-06 11:02:41', NULL),
(121, 6, 1, 'Scheduler updated project details', 1, 23, 0, '2019-03-06 11:02:41', NULL),
(122, 6, 1, 'Scheduler updated project details', 1, 40, 0, '2019-03-06 11:02:41', NULL),
(123, 6, 1, 'Scheduler updated project details', 1, 68, 0, '2019-03-06 11:02:41', NULL),
(124, 6, 1, 'Scheduler updated project details', 1, 1, 0, '2019-03-06 11:03:55', NULL),
(125, 6, 1, 'Scheduler updated project details', 1, 2, 1, '2019-03-06 11:03:55', '2019-03-07 11:06:34'),
(126, 1, 1, 'New project listed in your area!', 1, 14, 0, '2019-03-06 11:03:55', NULL),
(127, 1, 1, 'New project listed in your area!', 1, 23, 0, '2019-03-06 11:03:55', NULL),
(128, 1, 1, 'New project listed in your area!', 1, 38, 0, '2019-03-06 11:03:55', NULL),
(129, 1, 1, 'New project listed in your area!', 1, 39, 0, '2019-03-06 11:03:55', NULL),
(130, 1, 1, 'New project listed in your area!', 1, 40, 0, '2019-03-06 11:03:55', NULL),
(131, 1, 1, 'New project listed in your area!', 1, 68, 0, '2019-03-06 11:03:55', NULL),
(132, 1, 1, 'New project listed in your area!', 1, 70, 0, '2019-03-06 11:03:55', NULL),
(133, 13, 6, 'Project is On hold by manager!', 1, 2, 0, '2019-03-06 11:15:20', NULL),
(134, 14, 6, 'Project is In progress by manager!', 1, 2, 1, '2019-03-06 11:16:07', '2019-03-11 04:52:34'),
(135, 7, 5, 'Project completed by manager!', 1, 2, 1, '2019-03-06 11:16:54', '2019-03-06 11:22:01'),
(136, 12, 6, 'Associate added new status!', 2, 1, 0, '2019-03-11 04:57:34', NULL),
(137, 7, 3, 'Project completed by manager!', 1, 2, 0, '2019-03-11 05:59:14', NULL),
(138, 11, 3, 'New Rating given by Associate!', 2, 1, 0, '2019-03-11 05:59:38', NULL),
(139, 8, 6, 'Project cancelled by manager!', 1, 2, 0, '2019-03-11 06:00:00', NULL),
(140, 6, 38, 'Scheduler updated project details', 1, 1, 0, '2019-03-11 06:11:10', NULL),
(141, 6, 38, 'Scheduler updated project details', 1, 2, 0, '2019-03-11 06:11:10', NULL),
(142, 6, 38, 'Scheduler updated project details', 1, 14, 0, '2019-03-11 06:11:10', NULL),
(143, 6, 38, 'Scheduler updated project details', 1, 23, 0, '2019-03-11 06:11:10', NULL),
(144, 6, 38, 'Scheduler updated project details', 1, 38, 0, '2019-03-11 06:11:10', NULL),
(145, 6, 38, 'Scheduler updated project details', 1, 39, 0, '2019-03-11 06:11:10', NULL),
(146, 6, 38, 'Scheduler updated project details', 1, 40, 0, '2019-03-11 06:11:10', NULL),
(147, 6, 38, 'Scheduler updated project details', 1, 68, 0, '2019-03-11 06:11:10', NULL),
(148, 3, 38, 'Job is allocated to Swati', 1, 1, 0, '2019-03-11 06:12:02', NULL),
(149, 3, 38, 'Congratulations! Your bid was accepted!', 1, 2, 0, '2019-03-11 06:12:02', NULL),
(150, 12, 38, 'Associate added new status!', 2, 1, 0, '2019-03-11 06:12:34', NULL),
(151, 7, 38, 'Project completed by manager!', 1, 2, 1, '2019-03-11 06:12:46', '2019-03-11 06:13:23'),
(152, 11, 38, 'New Rating given by Associate!', 2, 1, 0, '2019-03-11 06:13:07', NULL),
(153, 15, 39, 'New project assigned to you!', 1, 52, 0, '2019-03-11 08:11:08', NULL),
(154, 1, 39, 'New project listed in your area!', 52, 2, 0, '2019-03-11 08:11:08', NULL),
(155, 1, 39, 'New project listed in your area!', 52, 14, 0, '2019-03-11 08:11:09', NULL),
(156, 1, 39, 'New project listed in your area!', 52, 23, 0, '2019-03-11 08:11:09', NULL),
(157, 1, 39, 'New project listed in your area!', 52, 38, 0, '2019-03-11 08:11:09', NULL),
(158, 1, 39, 'New project listed in your area!', 52, 39, 0, '2019-03-11 08:11:09', NULL),
(159, 1, 39, 'New project listed in your area!', 52, 40, 0, '2019-03-11 08:11:09', NULL),
(160, 1, 39, 'New project listed in your area!', 52, 68, 0, '2019-03-11 08:11:09', NULL),
(161, 6, 39, 'Scheduler updated project details', 1, 52, 0, '2019-03-14 15:38:26', NULL),
(162, 6, 39, 'Scheduler updated project details', 1, 2, 0, '2019-03-14 15:38:26', NULL),
(163, 6, 39, 'Scheduler updated project details', 1, 14, 0, '2019-03-14 15:38:26', NULL),
(164, 6, 39, 'Scheduler updated project details', 1, 23, 0, '2019-03-14 15:38:26', NULL),
(165, 6, 39, 'Scheduler updated project details', 1, 38, 0, '2019-03-14 15:38:26', NULL),
(166, 6, 39, 'Scheduler updated project details', 1, 39, 0, '2019-03-14 15:38:26', NULL),
(167, 6, 39, 'Scheduler updated project details', 1, 40, 0, '2019-03-14 15:38:26', NULL),
(168, 6, 39, 'Scheduler updated project details', 1, 68, 0, '2019-03-14 15:38:26', NULL),
(169, 1, 45, 'New project listed in your area!', 64, 198, 0, '2019-03-14 16:38:45', NULL),
(170, 3, 45, 'Job is allocated to Ryan', 1, 64, 0, '2019-03-14 16:39:58', NULL),
(171, 3, 45, 'Congratulations! Your request was accepted!', 64, 198, 0, '2019-03-14 16:39:58', NULL),
(172, 1, 41, 'New project listed in your area!', 64, 16, 0, '2019-03-14 18:22:35', NULL),
(173, 1, 41, 'New project listed in your area!', 64, 17, 0, '2019-03-14 18:22:35', NULL),
(174, 1, 41, 'New project listed in your area!', 64, 198, 0, '2019-03-14 18:22:35', NULL),
(175, 1, 41, 'New project listed in your area!', 64, 9, 0, '2019-03-14 18:22:36', NULL),
(176, 1, 41, 'New project listed in your area!', 64, 12, 0, '2019-03-14 18:22:36', NULL),
(177, 1, 44, 'New project listed in your area!', 64, 9, 0, '2019-03-14 18:22:59', NULL),
(178, 1, 44, 'New project listed in your area!', 64, 10, 0, '2019-03-14 18:22:59', NULL),
(179, 3, 41, 'Job is allocated to Ryan', 1, 64, 0, '2019-03-14 18:37:13', NULL),
(180, 3, 41, 'Congratulations! Your request was accepted!', 64, 198, 0, '2019-03-14 18:37:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_notification_sent_device`
--

CREATE TABLE `project_notification_sent_device` (
  `project_notification_id` int(11) NOT NULL,
  `user_device_id` int(11) NOT NULL,
  `notification_sent` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_notification_sent_device`
--

INSERT INTO `project_notification_sent_device` (`project_notification_id`, `user_device_id`, `notification_sent`) VALUES
(7, 51, '2019-02-04 12:56:38'),
(10, 51, '2019-02-04 13:29:18'),
(12, 51, '2019-02-04 13:33:53'),
(15, 51, '2019-02-04 14:58:35'),
(7, 51, '2019-02-04 15:15:43'),
(24, 51, '2019-02-04 15:15:48'),
(42, 51, '2019-02-04 17:12:37'),
(42, 52, '2019-02-04 17:12:37'),
(45, 51, '2019-02-04 17:12:55'),
(45, 52, '2019-02-04 17:12:55'),
(48, 51, '2019-02-04 17:15:19'),
(48, 52, '2019-02-04 17:15:19'),
(50, 51, '2019-02-04 17:17:43'),
(50, 52, '2019-02-04 17:17:43'),
(53, 51, '2019-02-04 17:25:32'),
(53, 52, '2019-02-04 17:25:32'),
(57, 51, '2019-02-04 17:42:15'),
(57, 52, '2019-02-04 17:42:15'),
(58, 51, '2019-02-04 17:46:17'),
(58, 52, '2019-02-04 17:46:17'),
(59, 51, '2019-02-04 17:49:59'),
(60, 51, '2019-02-04 17:49:59'),
(59, 52, '2019-02-04 17:49:59'),
(60, 52, '2019-02-04 17:49:59'),
(67, 2, '2019-02-07 19:42:20'),
(68, 2, '2019-02-07 19:44:45'),
(69, 2, '2019-02-07 19:44:45'),
(71, 2, '2019-02-07 19:46:33'),
(73, 2, '2019-02-07 19:47:50'),
(75, 2, '2019-02-07 19:51:33'),
(77, 2, '2019-02-07 19:52:27'),
(80, 2, '2019-02-07 20:01:56'),
(80, 4, '2019-02-07 20:01:56'),
(81, 5, '2019-02-07 21:00:04'),
(83, 5, '2019-02-07 21:18:49'),
(83, 6, '2019-02-07 21:18:49'),
(85, 7, '2019-02-08 17:42:21'),
(85, 9, '2019-02-08 17:42:21'),
(86, 3, '2019-02-08 17:42:21'),
(86, 8, '2019-02-08 17:42:21'),
(88, 2, '2019-02-11 11:12:40'),
(88, 7, '2019-02-11 11:12:40'),
(88, 9, '2019-02-11 11:12:41'),
(91, 3, '2019-03-04 12:29:32'),
(91, 11, '2019-03-04 12:29:32'),
(91, 3, '2019-03-04 12:45:24'),
(91, 11, '2019-03-04 12:45:24'),
(101, 2, '2019-03-04 17:42:16'),
(101, 7, '2019-03-04 17:42:16'),
(101, 9, '2019-03-04 17:42:16'),
(101, 14, '2019-03-04 17:42:16'),
(102, 2, '2019-03-04 18:38:08'),
(102, 7, '2019-03-04 18:38:08'),
(102, 9, '2019-03-04 18:38:08'),
(102, 14, '2019-03-04 18:38:08'),
(103, 3, '2019-03-06 10:55:21'),
(103, 11, '2019-03-06 10:55:21'),
(106, 2, '2019-03-06 10:55:22'),
(106, 7, '2019-03-06 10:55:22'),
(106, 9, '2019-03-06 10:55:22'),
(106, 14, '2019-03-06 10:55:22'),
(108, 2, '2019-03-06 10:59:14'),
(108, 7, '2019-03-06 10:59:14'),
(108, 9, '2019-03-06 10:59:14'),
(108, 14, '2019-03-06 10:59:14'),
(110, 2, '2019-03-06 11:02:14'),
(110, 7, '2019-03-06 11:02:14'),
(110, 9, '2019-03-06 11:02:14'),
(110, 14, '2019-03-06 11:02:14'),
(112, 3, '2019-03-06 11:14:04'),
(112, 11, '2019-03-06 11:14:05'),
(117, 3, '2019-03-06 16:17:28'),
(117, 11, '2019-03-06 16:17:28'),
(117, 12, '2019-03-06 16:17:29'),
(112, 3, '2019-03-06 11:02:41'),
(112, 11, '2019-03-06 11:02:41'),
(125, 2, '2019-03-06 11:03:55'),
(125, 7, '2019-03-06 11:03:55'),
(125, 9, '2019-03-06 11:03:55'),
(125, 13, '2019-03-06 11:03:55'),
(125, 14, '2019-03-06 11:03:55'),
(3, 3, '2019-03-06 11:03:55'),
(3, 11, '2019-03-06 11:03:55'),
(133, 2, '2019-03-06 11:15:20'),
(133, 7, '2019-03-06 11:15:20'),
(133, 9, '2019-03-06 11:15:20'),
(133, 13, '2019-03-06 11:15:20'),
(133, 14, '2019-03-06 11:15:21'),
(134, 2, '2019-03-06 11:16:07'),
(134, 7, '2019-03-06 11:16:08'),
(134, 9, '2019-03-06 11:16:08'),
(134, 13, '2019-03-06 11:16:08'),
(134, 14, '2019-03-06 11:16:08'),
(135, 2, '2019-03-06 11:16:54'),
(135, 7, '2019-03-06 11:16:54'),
(135, 9, '2019-03-06 11:16:54'),
(135, 13, '2019-03-06 11:16:54'),
(135, 14, '2019-03-06 11:16:54'),
(137, 2, '2019-03-11 05:59:14'),
(137, 7, '2019-03-11 05:59:14'),
(137, 9, '2019-03-11 05:59:14'),
(137, 13, '2019-03-11 05:59:14'),
(137, 14, '2019-03-11 05:59:14'),
(137, 20, '2019-03-11 05:59:14'),
(137, 21, '2019-03-11 05:59:14'),
(139, 2, '2019-03-11 06:00:00'),
(139, 7, '2019-03-11 06:00:01'),
(139, 9, '2019-03-11 06:00:01'),
(139, 13, '2019-03-11 06:00:01'),
(139, 14, '2019-03-11 06:00:01'),
(139, 20, '2019-03-11 06:00:01'),
(139, 21, '2019-03-11 06:00:01'),
(141, 2, '2019-03-11 06:11:10'),
(141, 7, '2019-03-11 06:11:10'),
(141, 9, '2019-03-11 06:11:10'),
(141, 13, '2019-03-11 06:11:10'),
(141, 14, '2019-03-11 06:11:10'),
(141, 20, '2019-03-11 06:11:10'),
(141, 21, '2019-03-11 06:11:10'),
(143, 3, '2019-03-11 06:11:10'),
(143, 11, '2019-03-11 06:11:10'),
(149, 2, '2019-03-11 06:12:02'),
(149, 7, '2019-03-11 06:12:02'),
(149, 9, '2019-03-11 06:12:02'),
(149, 13, '2019-03-11 06:12:02'),
(149, 14, '2019-03-11 06:12:02'),
(149, 20, '2019-03-11 06:12:02'),
(149, 21, '2019-03-11 06:12:02'),
(151, 2, '2019-03-11 06:12:46'),
(151, 7, '2019-03-11 06:12:46'),
(151, 9, '2019-03-11 06:12:46'),
(151, 13, '2019-03-11 06:12:46'),
(151, 14, '2019-03-11 06:12:47'),
(151, 20, '2019-03-11 06:12:47'),
(151, 21, '2019-03-11 06:12:47'),
(154, 2, '2019-03-11 08:11:08'),
(154, 7, '2019-03-11 08:11:08'),
(154, 9, '2019-03-11 08:11:08'),
(154, 13, '2019-03-11 08:11:09'),
(154, 14, '2019-03-11 08:11:09'),
(154, 20, '2019-03-11 08:11:09'),
(154, 21, '2019-03-11 08:11:09'),
(156, 3, '2019-03-11 08:11:09'),
(156, 11, '2019-03-11 08:11:09'),
(162, 2, '2019-03-14 15:38:26'),
(162, 7, '2019-03-14 15:38:26'),
(162, 9, '2019-03-14 15:38:26'),
(162, 13, '2019-03-14 15:38:26'),
(162, 14, '2019-03-14 15:38:26'),
(162, 22, '2019-03-14 15:38:26'),
(164, 3, '2019-03-14 15:38:26'),
(164, 11, '2019-03-14 15:38:26'),
(164, 23, '2019-03-14 15:38:26'),
(169, 26, '2019-03-14 16:38:45'),
(171, 26, '2019-03-14 16:39:58'),
(174, 26, '2019-03-14 18:22:35'),
(180, 26, '2019-03-14 18:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `project_notification_type`
--

CREATE TABLE `project_notification_type` (
  `project_notification_type_id` int(11) NOT NULL,
  `project_notification_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_notification_type`
--

INSERT INTO `project_notification_type` (`project_notification_type_id`, `project_notification_type`) VALUES
(1, 'create project'),
(2, 'apply bid'),
(3, 'accept bid'),
(4, 'reject bid'),
(5, 'reenter bid'),
(6, 'update project'),
(7, 'project complete'),
(8, 'project cancel'),
(9, 'approve associate request'),
(10, 'reject associate request'),
(11, 'submit review'),
(12, 'view status'),
(13, 'On Hold Project'),
(14, 'In Progress Project '),
(15, 'project allocate to PM');

-- --------------------------------------------------------

--
-- Table structure for table `project_progress_status`
--

CREATE TABLE `project_progress_status` (
  `project_progress_status_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL COMMENT 'Associate id',
  `project_progress_status_subject` varchar(50) NOT NULL,
  `project_progress_status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_progress_status`
--

INSERT INTO `project_progress_status` (`project_progress_status_id`, `project_id`, `user_id`, `project_progress_status_subject`, `project_progress_status`, `created_at`, `updated_at`) VALUES
(1, 7, 2, 'Job Started', 'new instructions request for your support', '2019-02-04 17:27:48', '2019-02-04 17:27:48'),
(2, 7, 2, 'Job Complete', 'new instructions request for your support and help', '2019-02-04 17:28:31', '2019-02-04 17:28:31'),
(3, 7, 2, 'Issue', 'new instructions request issue found.', '2019-02-04 17:28:55', '2019-02-04 17:28:55'),
(4, 9, 2, 'Issue', 'Bug', '2019-02-08 17:07:38', '2019-02-08 17:07:38'),
(5, 2, 2, 'Job Complete', 'Shdbfh', '2019-02-15 22:11:55', '2019-02-15 22:11:55'),
(6, 6, 2, 'Job Started', 'started....', '2019-03-06 13:23:19', '2019-03-06 13:23:19'),
(7, 32, 23, 'Job Started', 'Started', '2019-03-06 16:18:23', '2019-03-06 16:18:23'),
(8, 32, 23, 'Issue', 'Bug', '2019-03-06 10:53:59', '2019-03-06 10:53:59'),
(9, 6, 2, 'Issue', 'Great work', '2019-03-11 04:57:34', '2019-03-11 04:57:34'),
(10, 38, 2, 'Note', 'testing', '2019-03-11 06:12:34', '2019-03-11 06:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE `project_status` (
  `project_status_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `project_status_type_id` int(2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`project_status_id`, `project_id`, `project_status_type_id`, `created_at`) VALUES
(1, 1, 1, '2019-02-04 11:59:54'),
(2, 2, 1, '2019-02-04 12:16:14'),
(3, 3, 1, '2019-02-04 12:56:38'),
(4, 4, 1, '2019-02-04 14:55:00'),
(5, 5, 1, '2019-02-04 15:15:48'),
(6, 6, 1, '2019-02-04 15:49:57'),
(7, 7, 1, '2019-02-04 16:16:03'),
(8, 8, 1, '2019-02-04 16:27:10'),
(9, 9, 1, '2019-02-04 17:08:13'),
(10, 10, 1, '2019-02-04 17:15:19'),
(11, 7, 2, '2019-02-04 17:25:32'),
(12, 7, 3, '2019-02-04 17:25:32'),
(13, 7, 4, '2019-02-04 17:49:59'),
(14, 11, 8, '2019-03-14 20:00:24'),
(15, 12, 7, '2019-03-14 19:59:55'),
(16, 13, 7, '2019-03-14 19:59:55'),
(17, 14, 7, '2019-03-14 19:59:55'),
(18, 15, 7, '2019-03-14 19:59:55'),
(19, 16, 8, '2019-03-14 16:23:57'),
(20, 17, 8, '2019-03-14 16:23:57'),
(21, 18, 8, '2019-03-14 20:00:24'),
(22, 19, 8, '2019-03-14 20:00:24'),
(23, 20, 8, '2019-03-14 20:00:40'),
(24, 21, 8, '2019-03-14 16:23:57'),
(25, 22, 8, '2019-03-11 12:18:36'),
(26, 23, 1, '2019-02-07 01:51:00'),
(27, 24, 1, '2019-02-07 02:18:10'),
(28, 10, 2, '2019-02-07 19:05:27'),
(29, 10, 3, '2019-02-07 19:05:27'),
(30, 10, 4, '2019-02-07 19:07:25'),
(31, 8, 2, '2019-02-07 19:42:20'),
(32, 8, 3, '2019-02-07 19:42:20'),
(33, 8, 4, '2019-02-07 19:44:45'),
(34, 9, 2, '2019-02-07 19:46:33'),
(35, 9, 3, '2019-02-07 19:46:33'),
(36, 5, 2, '2019-02-07 19:47:50'),
(37, 5, 3, '2019-02-07 19:47:50'),
(38, 3, 2, '2019-02-07 19:51:33'),
(39, 3, 3, '2019-02-07 19:51:33'),
(40, 4, 2, '2019-02-07 19:52:27'),
(41, 4, 3, '2019-02-07 19:52:27'),
(42, 2, 2, '2019-02-07 20:01:56'),
(43, 2, 3, '2019-02-07 20:01:56'),
(44, 24, 2, '2019-02-07 21:18:49'),
(45, 24, 3, '2019-02-07 21:18:49'),
(46, 25, 8, '2019-03-14 16:23:57'),
(47, 26, 8, '2019-03-11 14:06:04'),
(48, 27, 7, '2019-03-14 19:59:56'),
(50, 29, 8, '2019-03-06 13:28:27'),
(51, 30, 8, '2019-03-12 19:15:04'),
(52, 31, 8, '2019-03-14 20:00:03'),
(53, 32, 1, '2019-03-06 10:54:41'),
(54, 33, 8, '2019-03-12 19:15:04'),
(55, 34, 8, '2019-03-06 13:28:15'),
(56, 35, 8, '2019-03-06 10:54:07'),
(57, 36, 8, '2019-03-06 10:54:07'),
(58, 37, 8, '2019-03-06 10:54:07'),
(59, 38, 1, '2019-03-04 12:29:32'),
(60, 2, 4, '2019-03-04 17:42:16'),
(61, 4, 4, '2019-03-04 18:38:08'),
(62, 9, 4, '2019-03-06 10:59:14'),
(63, 6, 2, '2019-03-06 11:02:14'),
(64, 6, 3, '2019-03-06 11:02:14'),
(65, 32, 2, '2019-03-06 16:17:28'),
(66, 32, 3, '2019-03-06 16:17:28'),
(67, 5, 4, '2019-03-06 11:16:54'),
(68, 3, 4, '2019-03-11 05:59:14'),
(69, 6, 5, '2019-03-11 06:00:00'),
(70, 38, 2, '2019-03-11 06:12:02'),
(71, 38, 3, '2019-03-11 06:12:02'),
(72, 38, 4, '2019-03-11 06:12:46'),
(73, 39, 1, '2019-03-11 08:11:08'),
(74, 40, 8, '2019-03-14 16:23:57'),
(75, 41, 1, '2019-03-14 18:22:36'),
(76, 42, 7, '2019-03-14 18:45:01'),
(77, 43, 7, '2019-03-14 18:45:01'),
(78, 44, 1, '2019-03-14 18:22:59'),
(79, 45, 1, '2019-03-14 16:38:46'),
(80, 45, 2, '2019-03-14 16:39:58'),
(81, 45, 3, '2019-03-14 16:39:58'),
(82, 41, 2, '2019-03-14 18:37:13'),
(83, 41, 3, '2019-03-14 18:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `project_status_type`
--

CREATE TABLE `project_status_type` (
  `project_status_type_id` int(11) NOT NULL,
  `project_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_status_type`
--

INSERT INTO `project_status_type` (`project_status_type_id`, `project_status`) VALUES
(1, 'Created'),
(2, 'Assigned'),
(3, 'In progress'),
(4, 'Completed'),
(5, 'Cancelled'),
(6, 'On Hold'),
(7, 'Awaiting Scheduling'),
(8, 'archive projects');

-- --------------------------------------------------------

--
-- Table structure for table `project_type`
--

CREATE TABLE `project_type` (
  `project_type_id` int(50) NOT NULL,
  `project_type` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_type`
--

INSERT INTO `project_type` (`project_type_id`, `project_type`) VALUES
(1, 'Multifamily');

-- --------------------------------------------------------

--
-- Table structure for table `scope_performed`
--

CREATE TABLE `scope_performed` (
  `scope_performed_id` int(10) NOT NULL,
  `scope_performed` varchar(100) NOT NULL,
  `scope_status` tinyint(1) NOT NULL COMMENT '0=InActive,1=Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scope_performed`
--

INSERT INTO `scope_performed` (`scope_performed_id`, `scope_performed`, `scope_status`) VALUES
(1, 'PCA-Fannie', 1),
(2, 'PCA-Freddie', 1),
(3, 'PCA-HUD', 1),
(4, 'PCA-ASTM', 1),
(5, 'ESA-Fannie', 1),
(6, 'ESA-Freddie', 1),
(7, 'ESA-HUD', 1),
(8, 'ESA-ASTM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` int(10) NOT NULL,
  `min_miles` int(10) NOT NULL,
  `max_miles` int(10) NOT NULL,
  `setting_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Inactive,1=Active',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `min_miles`, `max_miles`, `setting_status`, `created_at`) VALUES
(1, 2, 4, 0, '2018-09-07 05:33:54'),
(2, 4, 10, 0, '2018-09-07 05:35:02'),
(3, 5, 12, 0, '2018-09-07 05:35:52'),
(4, 5, 10, 0, '2018-09-07 06:13:57'),
(5, 12, 20, 0, '2018-09-07 06:16:21'),
(6, 2, 20, 0, '2018-09-07 06:17:41'),
(7, 5, 20, 0, '2018-09-07 06:19:13'),
(8, 12, 40, 0, '2018-09-07 06:41:23'),
(9, 2, 20, 0, '2018-09-11 05:41:33'),
(10, 2, 20, 0, '2018-09-17 04:44:24'),
(11, 2, 200, 0, '2018-09-20 06:09:28'),
(12, 2, 400, 0, '2018-09-20 06:38:56'),
(13, 2, 600, 0, '2018-09-20 06:46:25'),
(14, 2, 2000, 0, '2018-09-20 06:50:28'),
(15, 2, 20, 0, '2018-09-20 07:08:27'),
(16, 2, 100, 0, '2018-09-24 09:14:03'),
(17, 0, 0, 0, '2018-10-04 13:36:41'),
(18, 0, 500, 0, '2018-10-04 19:29:40'),
(19, 0, 0, 0, '2018-10-05 05:03:53'),
(20, 0, 600, 0, '2018-10-05 05:04:03'),
(21, 0, 100, 0, '2018-10-05 11:02:11'),
(22, 2, 500, 0, '2018-10-06 06:56:29'),
(23, 2, 500, 0, '2018-10-06 07:03:14'),
(24, 2, 500, 0, '2018-10-06 07:14:27'),
(25, 2, 300, 0, '2018-10-08 09:19:05'),
(26, 2, 500, 0, '2018-10-15 13:33:08'),
(27, 0, 0, 0, '2018-10-30 05:21:16'),
(28, 0, 500, 0, '2018-10-30 05:21:28'),
(29, 0, 500, 0, '2018-10-30 05:23:37'),
(30, 1, 1, 0, '2018-11-05 12:24:59'),
(31, 2, 4, 0, '2018-11-05 12:25:11'),
(32, 2, 500, 0, '2018-11-05 12:25:21'),
(33, 5, 500, 0, '2018-11-05 12:31:51'),
(34, 2, 500, 0, '2018-11-05 12:32:13'),
(35, 1, 1, 0, '2018-11-05 12:38:22'),
(36, 1, 1, 0, '2018-11-05 12:38:34'),
(37, 1, 500, 0, '2018-11-05 12:39:00'),
(38, 1, 500, 0, '2018-11-05 12:39:32'),
(39, 1, 1, 0, '2018-11-05 12:40:26'),
(40, 200, 500, 0, '2018-11-05 12:41:11'),
(41, 1, 1, 0, '2018-11-05 12:41:24'),
(42, 1, 500, 0, '2018-11-05 12:42:18'),
(43, 1, 500, 0, '2018-11-05 12:42:37'),
(44, 1, 600, 0, '2018-11-05 12:43:09'),
(45, 5, 5, 0, '2018-11-05 13:33:40'),
(46, 2, 500, 0, '2018-11-05 13:33:55'),
(47, 2, 500, 0, '2018-11-05 13:34:05'),
(48, 2, 500, 0, '2018-11-05 13:40:52'),
(49, 2, 500, 0, '2018-11-05 13:57:52'),
(50, 1, 1, 0, '2018-11-06 06:52:18'),
(51, 1, 500, 0, '2018-11-06 07:15:38'),
(52, 2, 500, 1, '2018-11-19 14:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `sys_language`
--

CREATE TABLE `sys_language` (
  `sys_language_id` int(10) NOT NULL,
  `sys_language` varchar(50) NOT NULL,
  `sys_language_status` tinyint(1) NOT NULL COMMENT '0=InActive,1=Active',
  `sys_language_created` datetime NOT NULL,
  `sys_language_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_language`
--

INSERT INTO `sys_language` (`sys_language_id`, `sys_language`, `sys_language_status`, `sys_language_created`, `sys_language_update`) VALUES
(1, 'English', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'French', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `user_types_id` int(10) NOT NULL,
  `associate_type_id` tinyint(1) DEFAULT NULL,
  `users_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `users_profile_image` varchar(100) DEFAULT NULL,
  `users_company` varchar(50) NOT NULL,
  `users_email` varchar(50) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_phone` varchar(20) NOT NULL,
  `users_address` varchar(255) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `lat_long_updated_at` datetime DEFAULT NULL,
  `notification_enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Inactive,1=Active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `email_status` int(1) NOT NULL DEFAULT '0',
  `users_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Not available in service,1=available in service',
  `users_approval_status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '0-NotApproved,1=Approved,2=pending,3=blocked',
  `users_approved_by` int(10) DEFAULT NULL,
  `users_approved_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `user_types_id`, `associate_type_id`, `users_name`, `last_name`, `users_profile_image`, `users_company`, `users_email`, `users_password`, `users_phone`, `users_address`, `latitude`, `longitude`, `lat_long_updated_at`, `notification_enable`, `created_at`, `updated_at`, `email_status`, `users_status`, `users_approval_status`, `users_approved_by`, `users_approved_date`) VALUES
(1, 1, NULL, 'Suvarna', 'Shinde', '1551850058-s.jpeg', 'magneto', 'suvarnashinde.magneto@gmail.com', '$2y$10$dDTTvVuSLWGGDsir1LgIrOOXpYHEe9r4Z0Quap2DBBRBpPVAyL7H2', '+1 (254) 878 7676', NULL, NULL, NULL, NULL, 1, '2018-12-27 10:56:44', '2019-03-15 10:57:54', 1, 1, 1, 1, '2019-03-06 15:05:34'),
(2, 2, 3, 'Swati', 'Bhor', '1552280341-image.1552280339.83562.png', 'Magneto pvt ltd', 'swatibhor.magneto@gmail.com', '$2y$10$eYSUlSdXeqAhR35ZpwliX.Tzqw/u1UVotkttLf9ATLK.ZyooYdEaO', '+1 (798) 959 5595', 'P 326 Type V Alkapuri CQA(SV) Quarters, Shelarwadi, Dehu Road Cantonment, Dehu Road, Maharashtra 412101, India', '18.674348715061935', '73.75263255089521', '2019-03-11 04:59:01', 1, '2018-12-27 10:59:26', '2019-03-11 04:59:02', 1, 1, 1, 1, '2018-12-27 11:00:53'),
(3, 2, 3, 'RyanPCA', 'Mord', 'default.png', 'Nova', 'ryanmord@gmail.com', '$2y$10$sO8ziVLjkWXxGN0ttkYpBev.pzgERgs0XmDAbG6pNVCA7gulAv5tG', '+1 (212) 121 2121', '1120 Hazeltine Blvd, Chaska, MN 55318, USA', '44.83488761112157', '-93.59994694590569', NULL, 1, '2018-12-27 16:55:57', '2018-12-27 23:02:00', 1, 1, 1, 1, '2018-12-27 23:02:00'),
(4, 2, NULL, 'RyanPCAII', 'Mord', 'default.png', 'Nova', 'ryanmord+1@gmail.com', '$2y$10$nje6OyThasbwmnKP.dB.7ulhh7ursARUA4Kgw9N1MalgqG0hE7z66', '+1 (545) 454 5454', 'Hazelden in Chaska, Suite 300, 1107 Hazeltine Blvd, Chaska, MN 55318, USA', '44.83648817731459', '-93.60010787844658', NULL, 1, '2018-12-27 17:01:44', '2018-12-28 19:56:37', 1, 1, 0, 1, '2018-12-28 19:56:37'),
(5, 2, NULL, 'RyanPCAIII', 'Mord', 'default.png', 'Nova', 'ryanmord+2@gmail.com', '$2y$10$2lQ3h4Cx3l08ANJD8iqIHu1Jog7whMg9WZ8YnhCbkSkp0PKED1ncG', '+1 (525) 252 5252', '1600 Amphitheatre Pkwy, Mountain View, CA 94043, USA', '37.419087499999996', '-122.08596829999999', NULL, 1, '2018-12-27 17:03:47', '2018-12-28 19:56:32', 1, 1, 0, 1, '2018-12-28 19:56:32'),
(6, 2, NULL, 'test', 'user', 'default.png', 'magneto', 'suvarnashinde.magneto+1@gmail.com', '$2y$10$G9K39vzp1miCmwSjXQV6/OKHadUyiv/zCwmRbKZ.vukCJmBtP6bJy', '+1 (589) 558 5885', 'Sr. No 106/2/10/1, Baner Road, Opposite Hotel Sadanand Near Amar Busniness Park, Laxman Nagar, Baner, Pune, Maharashtra 411045, India', '18.568296999999998', '73.768467', NULL, 1, '2018-12-27 22:49:44', '2018-12-28 13:51:40', 1, 1, 0, 1, '2018-12-28 13:51:40'),
(7, 2, NULL, 'RyanCLM', 'Mord', 'default.png', 'Nova', 'ryanmorr+3@gmail.com', '$2y$10$0e8nrC9xC6RSzx1BHsnwtO2TJsxjl.dEGF4/6TcxEsFpNpb/rr8vC', '+1 (545) 454 5454', '3125 Georgia Ave S, Minneapolis, MN 55426, USA', '44.947007', '-93.363987', NULL, 1, '2018-12-28 16:18:04', '2018-12-28 16:23:22', 0, 1, 0, 1, '2018-12-28 16:23:22'),
(8, 2, 2, 'RyanCLM', 'Mord', 'default.png', 'Nova', 'ryanmord+3@gmail.com', '$2y$10$uoowgZiNjfN7fLwOTZzfc.93YnxKl5PDONeuH6h93CnXNCkKHk3SO', '+1 (545) 454 5454', '3125 Georgia Ave S, Minneapolis, MN 55426, USA', '44.947007', '-93.363987', NULL, 1, '2018-12-28 16:18:14', '2018-12-28 16:23:32', 1, 1, 1, 1, '2018-12-28 16:23:32'),
(9, 2, 3, 'Ben', 'Bohline', 'default.png', 'Nova Consulting Group, Inc.', 'ben.bohline@novaconsulting.com', '$2y$10$W0vo1vmosRhofcmeSeqEy.nYEGGoBULplcTQDSZ8oKnKmUIfKV.PC', '+1 (952) 270 0566', '5800 Wooddale Ave, Minneapolis, MN 55424, USA', '44.897897', '-93.3394623', NULL, 1, '2018-12-28 20:05:42', '2018-12-28 20:19:46', 1, 1, 1, 1, '2018-12-28 20:16:04'),
(10, 2, 1, 'RyanWayzata', 'Mord', 'default.png', 'Nova', 'ryanmord+4@gmail.com', '$2y$10$zm9XLrXXfu976f7e4vJ20O1jg2NZ9hseuGqA1880NklZSX.rT1gBC', '+1 (545) 454 5454', '700 Lake St E, Wayzata, MN 55391, USA', '44.96888321586627', '-93.51130060851574', NULL, 1, '2018-12-28 20:06:04', '2018-12-28 20:15:37', 1, 1, 1, 1, '2018-12-28 20:15:36'),
(11, 2, 2, 'RyanNYC', 'Mord', 'default.png', 'Yankees', 'ryanmord+5@gmail.com', '$2y$10$ElC03lFAaFupbwGsvD0i1etAbhbSpdJHb.ShQ6KXY3CquSjfrqaiO', '+1 (828) 282 8282', '161 Street - Yankee Stadium Station, Bronx, NY 10451, USA', '40.8276745', '-73.9261353', NULL, 1, '2018-12-28 20:06:27', '2018-12-28 20:15:59', 1, 1, 1, 1, '2018-12-28 20:15:59'),
(12, 2, 1, 'RyanBlah', 'Mord', 'default.png', 'Nova', 'ryanmord+6@gmail.com', '$2y$10$rpF2yOOlP9PfPwtspDJ4nuRMbADj5tyQd/2UmtW2YXL1.ovfV/Gsm', '+1 (545) 454 5454', 'The Crest Apartments, 6221 Shingle Creek Pkwy, Brooklyn Center, MN 55406, USA', '45.06748734746482', '-93.30922733992338', NULL, 1, '2018-12-28 20:10:21', '2018-12-28 20:16:25', 0, 1, 1, 1, '2018-12-28 20:16:25'),
(13, 1, NULL, 'BenPM', 'Bohline', 'default.png', 'Nova Consulting Group, Inc.', 'bbohline@gmail.com', '$2y$10$rwifKU.m.82wSopX/wr9Iuw26ErT3FCTmKC5OQdmmSrwnl98vKXCq', '+1 (952) 270 0566', NULL, NULL, NULL, NULL, 1, '2019-01-02 12:54:40', '2019-01-02 12:55:32', 1, 1, 2, NULL, NULL),
(14, 2, 1, 'swati', 'adak', 'default.png', 'magnetonew', 'swatibhor.magneto+000@gmail.com', '$2y$10$/uJh26ABVuEAiNlF9gKtUOw0CKTfVpNrua2sq6dUaMxFrYEByPHDa', '+1 (646) 494 4949', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.590832199999998', '73.75316389999999', NULL, 1, '2019-01-04 05:18:27', '2019-01-04 05:19:12', 1, 1, 1, 1, '2019-01-04 05:19:12'),
(15, 1, NULL, 'Suvarna', 'Shinde', 'default.png', 'Magneto', 'suvarnashinde.magneto+46@gmail.com', '$2y$10$J9AjtEP2DofV2Un7DmqLPubV9hb/Q2lgkLWSOc232dqWX2J2dXWK6', '+1 (654) 545 4545', NULL, NULL, NULL, NULL, 1, '2019-01-07 10:54:55', '2019-01-14 11:43:54', 1, 1, 3, 1, '2019-01-14 11:43:54'),
(16, 2, 1, 'Albert', 'Einstein', 'default.png', 'Nova Consulting Group, Inc', 'ryanmord+00@gmail.com', '$2y$10$IXnGBtIii08d3QSEAuwXGODazR8RjbCQH8fqMFvmJDh041g7kSVra', '+1 (555) 555 5555', '1 Twins Way, Minneapolis, MN 55403, USA', '44.98178285648211', '-93.2775092124939', NULL, 1, '2019-01-09 16:03:12', '2019-01-09 16:05:18', 1, 1, 1, 1, '2019-01-09 16:05:18'),
(17, 2, 1, 'Lord', 'Kelvin', 'default.png', 'Nova Consulting Group, Inc', 'ryanmord+01@gmail.com', '$2y$10$GTo6la6u5Swtzf06bCD8Ce3bmJtK/gjZXnr0TML3bJmXOZQxPWBgW', '+1 (555) 555 5555', '20200 Rogers Dr, Rogers, MN 55374, USA', '44.83594752757453', '-93.59946649521589', NULL, 1, '2019-01-09 16:09:15', '2019-01-09 16:25:49', 1, 1, 1, 1, '2019-01-09 16:09:40'),
(18, 2, 2, 'Niels', 'Bohr', 'default.png', 'Preferred Associate, LLC', 'ryanmord+02@gmail.com', '$2y$10$gyMaA/vxAba3Z2uN3ubqie1i54goNhCYRQPiuk2t49SUoPu6teA1e', '+1 (555) 555 5555', '522 S Lake Ave, Duluth, MN 55802, USA', '46.78012332172791', '-92.0932961627841', NULL, 1, '2019-01-09 16:13:14', '2019-01-10 16:25:37', 1, 1, 1, 1, '2019-01-09 16:23:24'),
(19, 2, 3, 'Nicolaus', 'Copernicus', 'default.png', 'Copernicus & Co, Inc.', 'ryanmord+03@gmail.com', '$2y$10$mi02Ao7T5RTUwzRg7Y9G6uuqfHyVGUdfUmTGQRawDDiDy1Xw68lWO', '+1 (555) 555 5555', 'Minneapolis−Saint Paul International Airport (MSP), Minnesota, USA', '44.88428708353458', '-93.22305835783482', NULL, 1, '2019-01-09 16:15:47', '2019-01-10 20:16:17', 1, 1, 1, 1, '2019-01-09 16:23:15'),
(20, 2, 3, 'Isaac', 'Newton', 'default.png', 'Sir Isaac, Inc.', 'ryanmord+04@gmail.com', '$2y$10$ShO9SvhSKg0hQ55atcLXV.n8XsGCp/0EXnK1p8XfnwHyBv/.REvg6', '+1 (555) 555 5555', '20200 Rogers Dr, Rogers, MN 55374, USA', '45.18762793158772', '-93.53663306683302', NULL, 1, '2019-01-09 16:22:18', '2019-01-09 16:24:40', 1, 1, 1, 1, '2019-01-09 16:23:01'),
(21, 2, 1, 'Joe', 'smith', 'default.png', 'nova', 'ryan.mord+1@novaconsulting.com', '$2y$10$u2L8rx8OK9gZ1q6/1c3PfOXWiKkOUrcfVRNSlJSgUVzRnBew6elu.', '+1 (545) 455 5454', 'Hazelden in Chaska, Suite 300, 1107 Hazeltine Blvd, Chaska, MN 55318, USA', '44.83615318429593', '-93.59950136393309', NULL, 1, '2019-01-10 16:53:04', '2019-01-10 16:55:42', 0, 1, 1, 1, '2019-01-10 16:55:42'),
(22, 2, NULL, 'swatinew', 'bhor', 'default.png', 'magneto', 'swatibhor.magneto+123@gmail.com', '$2y$10$Op7Nmu1h7c4qzeU9szP.vOlwXNvLI66xW4uBSvS1MOV02eei2ElPa', '+1 (288) 547 9764', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.590832199999998', '73.75316389999999', NULL, 1, '2019-01-14 05:35:38', '2019-01-15 17:13:25', 1, 1, 0, 1, '2019-01-15 17:13:25'),
(23, 2, 1, 'Rohit', 'sankpal', '1551685171-image.1551685169.960615.png', 'magneto', 'rohitsankpal.magneto@gmail.com', '$2y$10$7LjBX/3JqaTLOKkDET..AOitYqJ5dEZjY0RBNl7KkoJ/nc0a/QYkC', '+1 (885) 594 3427', 'Unnamed Road, Vishnu Dev Nagar, Tathwale, Punawale, Pimpri-Chinchwad, Maharashtra 411033, India', '18.63269247110244', '73.74844897538424', '2019-03-04 11:54:37', 1, '2019-01-14 14:22:58', '2019-03-04 13:09:31', 1, 1, 1, 1, '2019-01-14 14:23:17'),
(24, 2, NULL, 'Sam', 'Sharma', 'default.png', 'magneto', 'rohitsankpal.magneto+1@gmail.com', '$2y$10$Elv4/PdUTnB5VWo6pDBbOuh0mcm64sqSWj.1cUY14v9vnkIr4zUam', '+1 (885) 594 3427', 'Unnamed Road, Jadhav Wadi, Moshi, Pimpri-Chinchwad, Maharashtra 412105, India', '18.66773785525618', '73.83139964193106', NULL, 1, '2019-01-15 07:00:30', '2019-01-15 17:14:05', 0, 1, 0, 1, '2019-01-15 17:14:05'),
(25, 2, NULL, 'Martin', 'Garix', 'default.png', 'magneto', 'rohitsankpal.magneto+2@gmail.com', '$2y$10$DGvBkirNcQWvhUzbkYwAeu0CqErszeNlxrZO22xnz9X5DVLvrC.PO', '+1 (885) 594 3427', 'Unnamed Road, Pusane, Maharashtra 412115, India', '18.62099106494538', '73.60183674842119', NULL, 1, '2019-01-15 07:03:46', '2019-01-15 17:13:48', 0, 1, 0, 1, '2019-01-15 17:13:48'),
(26, 2, NULL, 'swatinew', 'bhor', 'default.png', 'magnetonew', 'swatibhor.magneto+009@gmail.com', '$2y$10$afwRQkAP9L9HcWu30yUwKeEdqKwwV7iQZHp0H7u417basz0.XG3f.', '+1 (588) 888 9898', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.5911989', '73.7421136', NULL, 1, '2019-01-15 13:44:55', '2019-01-15 17:12:45', 1, 1, 0, 1, '2019-01-15 17:12:45'),
(27, 2, NULL, 'swatinew', 'bhor', 'default.png', 'magnetonew', 'swatibhor.magneto+001@gmail.com', '$2y$10$FIhRgbz8C9xLv32zjhmZb.fWDtgO9NbB3Ht3FSbBIZ/zu4laMeF02', '+1 (588) 888 8888', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.5911989', '73.7421136', NULL, 1, '2019-01-15 13:54:02', '2019-01-15 17:13:10', 0, 1, 0, 1, '2019-01-15 17:13:10'),
(28, 2, NULL, 'swati', 'bhor', 'default.png', 'mayneto', 'swatibhor.magneto+002@gmail.com', '$2y$10$hMOkLZ.MrKLEvFXE.u6Bo.YrPm2INQA42tHl4SMmuBFmL8u.uuvwe', '+1 (649) 464 6568', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.5911989', '73.7421136', NULL, 1, '2019-01-15 13:58:30', '2019-01-15 17:13:00', 0, 1, 0, 1, '2019-01-15 17:13:00'),
(29, 2, NULL, 'Rohit', 'sankpal', 'default.png', 'magneto', 'rohitsankpal.magneto+4@gmail.com', '$2y$10$lEQb4JybuHLfBK.aEkKC/On9mW0Cpk8q.1hrXrTgk7IM91Tx27Diu', '+1 (885) 594 3427', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.6001740430462', '73.80364213138819', NULL, 1, '2019-01-15 13:58:48', '2019-01-15 17:13:38', 0, 1, 0, 1, '2019-01-15 17:13:38'),
(30, 2, NULL, 'swatinew', 'bhor', 'default.png', 'magneto', 'swatibhor.magneto+005@gmail.com', '$2y$10$fmW.yt8yolSxuXLr5GvwDOFMcLmPA8DnNg/dO07.7uH1WAlqT6PrW', '+1 (649) 767 6767', 'Narayan Complex, हिंजेवाडी रस्ता, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.591287899999998', '73.7422465', NULL, 1, '2019-01-15 14:03:22', '2019-01-15 17:12:31', 0, 1, 0, 1, '2019-01-15 17:12:31'),
(31, 2, NULL, 'swatinew', 'bhornew', 'default.png', 'magneto', 'swatibhor.magneto+004@gmail.com', '$2y$10$47LOH8mzWZDuSWTsG.6//.WpLYHBLGLpi/xeSw95gAIduoXmncNHG', '+1 (656) 797 9997', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.5911989', '73.7421136', NULL, 1, '2019-01-15 14:06:14', '2019-01-15 17:12:16', 0, 1, 0, 1, '2019-01-15 17:12:16'),
(32, 2, NULL, 'swatinew', 'bhornew', 'default.png', 'magneto', 'swatibhor.magneto+008@gmail.com', '$2y$10$B.rawfFG5ga2Oi0banBKu.OBaiUkZOB1qY3eS40lA//sITt76o43e', '+1 (734) 373 7676', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.590832199999998', '73.75316389999999', NULL, 1, '2019-01-15 14:09:41', '2019-01-15 17:11:55', 0, 1, 0, 1, '2019-01-15 17:11:55'),
(33, 2, NULL, 'swatinew', 'bhornew', 'default.png', 'magneto', 'swatibhor.magneto+abc@gmail.com', '$2y$10$9AggWgNKaRyu3kuGbq0Mv.azjMFWfxaezJg.koFG36jooWOTu6ffa', '+1 (565) 579 7979', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.590832199999998', '73.75316389999999', NULL, 1, '2019-01-15 14:11:34', '2019-01-15 17:11:41', 0, 1, 0, 1, '2019-01-15 17:11:41'),
(34, 2, NULL, 'Ryan', 'Mord', 'default.png', 'Nova Consulting Group, Inc.', 'ryan.mord@novaconsulting.com', '$2y$10$h8oq.2ZGb2kB/07vqeQ0q.v9vhWsgxNDIyfxqidDOOdaim4lS8YUy', '+1 (555) 555 5555', 'Hazelden in Chaska, Suite 300, 1107 Hazeltine Blvd, Chaska, MN 55318, USA', '44.83587168404344', '-93.59987687319517', NULL, 1, '2019-01-15 14:22:55', '2019-01-15 14:22:55', 0, 1, 2, NULL, NULL),
(35, 1, NULL, 'Ryan', 'MordPM', 'default.png', 'Nova', 'ryanmord+99@gmail.com', '$2y$10$lJjZH3ei1GaZaKwOTJM9a.5seXC36u9y2sSH2pbgXebWo9J3DbU/e', '+1 (555) 555 5555', NULL, NULL, NULL, NULL, 1, '2019-01-15 16:01:28', '2019-01-15 16:02:57', 1, 1, 2, NULL, NULL),
(36, 2, 1, 'Rohit', 'Sharma', 'default.png', 'Magneto', 'rohitsankpal.magneto+5@gmail.com', '$2y$10$6eXCrtrVa/mZS.AiPxjhFOXR.4LTKHdD0dnO4mNcS3jn.mka42niG', '+1 (885) 594 3427', 'Tambe School, Madhuban Colony, Rahatani, Pimpri-Chinchwad, Maharashtra 411017, India', '18.6049063', '73.78501650000001', NULL, 1, '2019-01-16 05:12:20', '2019-01-16 05:24:49', 0, 1, 1, 1, '2019-01-16 05:24:49'),
(37, 2, NULL, 'Rahul', 'Berad', 'default.png', 'Magneto', 'rohitsankpal.magneto+6@gmail.com', '$2y$10$2qefa9U5wAYKTh185kPuzunCRf.JwUkwVeyg7A6wRHv7ol3isE/nm', '+1 (885) 594 3427', 'Unnamed Road, Khadki, Pune, Maharashtra 411003, India', '18.57152332087285', '73.84744495153427', NULL, 1, '2019-01-16 05:27:28', '2019-01-16 11:35:03', 0, 1, 0, 1, '2019-01-16 11:35:03'),
(38, 2, 3, 'sania', 'kedar', 'default.png', 'magneto', 'swatibhor.magneto+1@gmail.com', '$2y$10$00wtpN4LdwZ07jicjIgBFeK/bWnaFv7Pzdodb0SDOLKmHUSBXSD5W', '+1 (548) 767 6767', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.5911989', '73.7421136', NULL, 1, '2019-01-21 06:12:30', '2019-01-21 13:49:19', 1, 1, 1, 1, '2019-01-21 06:13:13'),
(39, 2, 1, 'swatiemployee', 'employee', 'default.png', 'magneto', 'swatibhor.magneto+2@gmail.com', '$2y$10$BzDsNx6Yx6brVjI5lpBxmeZAJH3Z2Ae7r/QDQ6Ezd24Td4YO3WKoy', '+1 (587) 878 7575', 'Narayan Complex, हिंजेवाडी रस्ता, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.5912798', '73.7421545', NULL, 1, '2019-01-22 05:10:27', '2019-01-22 05:12:12', 1, 1, 1, 1, '2019-01-22 05:11:33'),
(40, 2, 3, 'swati', 'bhornew', 'default.png', 'magneto', 'swatibhor.magneto+3@gmail.com', '$2y$10$05dzMB4fghweZUAxvB1JuuIjohq.mPjfbyyEwlhsiRIs2iUXLf1dO', '+1 (979) 797 7994', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.5911989', '73.7421136', NULL, 1, '2019-01-22 05:39:56', '2019-03-04 12:07:10', 1, 1, 1, 1, '2019-03-04 12:07:10'),
(52, 1, NULL, 'Suvarna', 'Shinde', 'default.png', 'magneto', 'suvarnashinde0395@gmail.com', '$2y$10$lOwF7kUp5VBS0/850aM.tOT/OKC1.0pFIg8wNC1DBhx8RRmEmTrG2', '+1 (254) 878 7676', NULL, NULL, NULL, NULL, 1, '2019-01-29 13:23:14', '2019-01-29 13:31:53', 1, 1, 2, NULL, NULL),
(53, 1, NULL, 'Suvarna', 'Shinde', 'default.png', 'Magneto', 'suvarnashinde.magneto+47@gmail.com', '$2y$10$PvNbAbI3uZyDq0Wh0EQV/ONQvzv0yjVRZqPUHHnjctUJ3y4qmy5MS', '+1 (254) 878 7676', NULL, NULL, NULL, NULL, 1, '2019-01-29 15:02:59', '2019-01-29 15:02:59', 0, 1, 2, NULL, NULL),
(54, 1, NULL, 'Suvarna', 'Shinde', 'default.png', 'magneto', 'suvarnashinde0396@gmail.com', '$2y$10$n5eTkSL5RjlEL8NcU.iviOCy8SSECeDFg6UNddrryYoD25ubHahky', '+1 (254) 878 7676', NULL, NULL, NULL, NULL, 1, '2019-02-07 01:49:20', '2019-02-07 01:49:20', 0, 1, 2, NULL, NULL),
(55, 2, NULL, '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinj', NULL, '1549547190-test2.jpg', 'Magneto pvt ltd', 'swatibhor.magneto+26@gmail.com', '$2y$10$vanrDe21M7gVtaVzAp5V.elmYrg/fy4GVInFQ9VN96jJUWPnVAScy', '+9 (497) 686 88 95', 'Bhosari', '18.590832199999998', '73.75316389999999', NULL, 1, '2019-02-07 19:16:33', '2019-02-12 12:11:56', 0, 1, 0, 1, '2019-02-12 12:11:56'),
(56, 2, NULL, 'vzvxh', 'zgzhxh', '1549601144-temp_img_1544781269443.jpg', 'hdhdhdh', 's@z.m', '$2y$10$HwvpNHctXo7aHgUSvRTk0uPptJwF5FIpUS78/nPwUscz6O9rBfdC2', '+1 (867) 676 7676', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.590832199999998', '73.75316389999999', NULL, 1, '2019-02-08 10:15:45', '2019-02-12 12:11:49', 0, 1, 0, 1, '2019-02-12 12:11:49'),
(57, 1, NULL, 'Suvarnas', 'Shinde', 'default.png', 'magneto', 'suvarnashinde4141@gmail.com', '$2y$10$MHd5gzurughaVEFz8dSRr.uvMCIHdTuP74pkC0/dk/sXY7ijx7cXG', '+1 (254) 878 7676', NULL, NULL, NULL, NULL, 1, '2019-02-11 15:20:03', '2019-02-11 15:22:17', 0, 1, 2, NULL, NULL),
(58, 1, NULL, 'Suvarna', 'Shinde', 'default.png', 'magneto', 'suvarnashinde4140@gmail.com', '$2y$10$XXnDmUSBGSWXVKVmb0./XeMFtrKXb.tRNx3bMmH7LCOkI.iYgvquy', '+1 (254) 878 7676', NULL, NULL, NULL, NULL, 1, '2019-02-12 12:25:38', '2019-02-12 12:25:38', 0, 1, 2, NULL, NULL),
(59, 1, NULL, 'Ryan', 'Mord', 'default.png', 'magneto', 'email@mail.com', '$2y$10$FtfWlOp67hT/oG7.jIqwxO2aX6dDTwEDWM0fziFRWiTaa.Jus3waa', '1231231231', NULL, NULL, NULL, NULL, 1, '2019-02-12 20:43:39', '2019-02-12 20:43:39', 0, 1, 2, NULL, NULL),
(60, 1, NULL, 'RyanUPDATE', 'MordUPDATE', 'default.png', 'magneto', 'email+2@mail.com', '$2y$10$EHamffoojvzqMhOoOhr.BOWKZ/Shj8.hJlngG18rGMJa5Bju3VjT.', '1231231231', NULL, NULL, NULL, NULL, 1, '2019-02-12 20:46:22', '2019-02-12 20:47:17', 0, 1, 2, NULL, NULL),
(61, 1, NULL, 'Mukesh', 'Nikam', 'default.png', 'magneto', 'mukeshnikam.magneto+71@gmail.com', '$2y$10$jDtbLt5JBtvlHtPRlHD8me3tp6GIFCrzWXm3U5jNpH6UZNwM5s0ty', '+1 (254) 878 7676', NULL, NULL, NULL, NULL, 1, '2019-02-19 19:59:14', '2019-02-19 20:04:23', 1, 1, 2, NULL, NULL),
(62, 1, NULL, 'Mukesh', 'Nikam', 'default.png', 'magneto', 'mukeshnikam.magneto+72@gmail.com', '$2y$10$jUiBsNGzGG3EYCRuU86D5OmgqaXiRKPm1G.tCw1z2qpHaPN0qWbFa', '1 (254) 878 7675', NULL, NULL, NULL, NULL, 1, '2019-02-19 20:41:50', '2019-02-19 20:46:37', 0, 1, 2, NULL, NULL),
(63, 1, NULL, 'Ryan', 'MordTest', 'default.png', 'NovaTestCo', 'ryanmord 0220@gmail.com', '$2y$10$AohvankiY7yc6P.mAg5NXe9vQXUvcXrVnxQGMxIx9GYuBNQwoazPW', '1111111111', NULL, NULL, NULL, NULL, 1, '2019-02-20 21:14:23', '2019-02-20 21:14:23', 0, 1, 2, NULL, NULL),
(64, 1, NULL, 'Ryan', 'MordTest', 'default.png', 'NovaTestCo', 'ryanmord+1234@gmail.com', '$2y$10$KBDIEKv.fg/Z8NItEVA.HeIWQQl3jOnAxlnKIfrySe/CGow8pcEsO', '1231231234', NULL, NULL, NULL, NULL, 1, '2019-02-20 21:22:44', '2019-02-20 21:46:25', 1, 1, 2, NULL, NULL),
(65, 1, NULL, 'Bob2', 'Smith2', 'default.png', 'Smith2, Inc.', 'bob.smith@junk.com', '$2y$10$NwJGRIItCf5XD6/o/2vLnu61qSI2wuxAC4F7krZXFZhnXnsQkA4Zq', '+1 (111) 111-1112', NULL, NULL, NULL, NULL, 1, '2019-02-28 02:38:28', '2019-03-01 03:22:16', 0, 1, 2, NULL, NULL),
(66, 1, NULL, 'Sue', 'Smith', 'default.png', 'Smith, Inc.', 'sue.smith@junk.com', '$2y$10$4dx15pWQ.XOZCtkBksIiR.TUPILo4b/GqSTZEtE3bs1F6aGZK/pG2', '+1 (111) 211-1111', NULL, NULL, NULL, NULL, 1, '2019-02-28 03:18:29', '2019-02-28 03:18:29', 0, 1, 2, NULL, NULL),
(67, 1, NULL, 'Suvarna', 'Shinde', 'default.png', 'magneto', 'suvarnashinde.magneto+96@gmail.com', '$2y$10$aMwmfZzYoUSWcQasJiC6au.vq0No4fSoIlV8sHkWTmrUV9j88gmFS', '+1 (254) 878 7676', NULL, NULL, NULL, NULL, 1, '2019-03-01 15:15:10', '2019-03-01 15:59:05', 0, 1, 2, NULL, NULL),
(68, 2, 3, 'swati', 'bhir', 'default.png', 'magnetoitsolutions', 'swatibhor.magneto+asso@gmail.com', '$2y$10$4jzJ2jkDukwK6bZsUtrWVuCch3dpWOG6X6UGgWo92c7YAXLxSQSNq', '+1 (123) 498 3893', '807, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pimpri-Chinchwad, Maharashtra 411057, India', '18.590832199999998', '73.75316389999999', NULL, 1, '2019-03-04 11:53:27', '2019-03-04 12:03:12', 1, 1, 1, 1, '2019-03-04 12:03:12'),
(69, 2, 3, 'Monika', 'Jadhav', 'default.png', 'Magneto', 'rohitsankpal.magnet+test3@gmail.com', '$2y$10$inzAE.XWaDvB65tiX3OSOu5ujK3YTxKfrdD.cL/OWkLU4gq./B6tK', '+1 (854) 949 6446', 'Behind Balewadi Stadium, Nande - Balewadi Rd, Pune, Maharashtra 410501, India', '18.5681087', '73.7390722', NULL, 1, '2019-03-05 11:49:44', '2019-03-05 12:30:35', 0, 1, 1, 1, '2019-03-05 12:30:35'),
(70, 2, 3, 'suvarna', 'ss', '1551852127-image.1551852178.372214.png', 'mis', 'suvarnashinde.magneto+test@gmail.com', '$2y$10$aCzuUEFOAObPAaOggFdSKu3oQKJO3BwrcxYHT5wwlCGRgT3MVB2HO', '+1 (455) 535 6865', 'Jai Mahesh Road, Yamuna Nagar, Shankar Kalat Nagar, Wakad, Pimpri-Chinchwad, Maharashtra 411057, India', '18.60410759564162', '73.75960595905781', NULL, 1, '2019-03-06 11:32:08', '2019-03-06 11:38:21', 1, 1, 1, 1, '2019-03-06 11:37:22'),
(71, 2, 1, 'monika', 'j', '1551852305-image.1551852355.579645.png', 'mis', 'suvarnashinde.magneto+test2@gmail.com', '$2y$10$1F9NDK0Mjna8SbZnYFlIb.lZ1JB3EE7s83omwuhhJtKg6ZUKUrFCC', '+1 (494) 646 4646', '3, Hinjawadi - Wakad Rd, Hinjawadi Village, Hinjawadi, Pune, Maharashtra 411057, India', '18.59100821740508', '73.75257689505816', NULL, 1, '2019-03-06 11:35:09', '2019-03-06 11:37:33', 1, 1, 1, 1, '2019-03-06 11:37:33'),
(72, 1, NULL, 'Amy', 'Lalonde', 'default.png', 'Nova Consulting Group', 'amy.lalonde@novaconsulting.com', '$2y$10$g6HNrEmk3Ex.3ytyj0HnuumtW.xdS/e1rh70P9NSDv70HFlsg9pjy', '630-453-7126', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:11:55', '2019-03-14 11:11:55', 0, 1, 2, NULL, NULL),
(73, 1, NULL, 'Andrea', 'Lang', 'default.png', 'Nova Consulting Group', 'andrea.lang@novaconsulting.com', '$2y$10$rg4YYVNQHAVrawdvuKneJeehUnnLkDjjRRXfNXQivmsaEzfgNBct2', '508-851-4638', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:06', '2019-03-14 11:13:06', 0, 1, 2, NULL, NULL),
(74, 1, NULL, 'Andrew', 'Harvey', 'default.png', 'Nova Consulting Group', 'andrew.harvey@novaconsulting.com', '$2y$10$iTgCWC9xhCl3vkvZq/I3V.TfTA7DHc9aQOIHxtYZy1niU.zKv1Rcm', '470-889-8431', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:07', '2019-03-14 11:13:07', 0, 1, 2, NULL, NULL),
(75, 1, NULL, 'Andy', 'York', 'default.png', 'Nova Consulting Group', 'andy.york@novaconsulting.com', '$2y$10$3cvr0bH/CLc08Eun.ln2PO.kXaBnRfnCqqxvMiIImX2ClxAFzR2fK', '(952) 239-6610', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:08', '2019-03-14 11:13:08', 0, 1, 2, NULL, NULL),
(76, 1, NULL, 'Anne', 'Sinna', 'default.png', 'Nova Consulting Group', 'anne.sinna@novaconsulting.com', '$2y$10$2GOmKSeROzPikGBWPT4XhesSVn9dNEJFtZuDkAb8AqAsqetCRwQEK', '(612) 919-2766', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:09', '2019-03-14 11:13:09', 0, 1, 2, NULL, NULL),
(77, 1, NULL, 'Anthony', 'Galasso', 'default.png', 'Nova Consulting Group', 'anthony.galasso@novaconsulting.com', '$2y$10$Yyeyae687Y8Fe3aXotzRru9B.20ehZTXMF/ptkvrneYESfk4eF5t6', '(570) 786-1031', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:10', '2019-03-14 11:13:10', 0, 1, 2, NULL, NULL),
(78, 1, NULL, 'Bob', 'Applegate', 'default.png', 'Nova Consulting Group', 'bob.applegate@novaconsulting.com', '$2y$10$VrvWHGEkCvD7oQRZpIdto.8OcWcizsM3myWF2D4FSJIM41XHQ0bn6', '(832) 259-4340', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:12', '2019-03-14 11:13:12', 0, 1, 2, NULL, NULL),
(79, 1, NULL, 'Brandon', 'Shellady', 'default.png', 'Nova Consulting Group', 'brandon.shellady@novaconsulting.com', '$2y$10$gUhGv1tVYiyhdGAjrVwm9e6NtADi7Sj8Hd5CZ/motoeiIc9wrmOdC', '(919) 618-5412', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:12', '2019-03-14 11:13:12', 0, 1, 2, NULL, NULL),
(80, 1, NULL, 'Brett', 'Alwin', 'default.png', 'Nova Consulting Group', 'brett.alwin@novaconsulting.com', '$2y$10$4TXe3rj5.lSGAR3hczPgFu2tTr0pUFAvS3Qigv6z2dl8cJowJvagi', '952-240-8421', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:14', '2019-03-14 11:13:14', 0, 1, 2, NULL, NULL),
(81, 1, NULL, 'Brian', 'Dietz', 'default.png', 'Nova Consulting Group', 'brian.dietz@novaconsulting.com', '$2y$10$G2ZYSclCs/wS0CzCxs.FPubk21ml4fQtkLWjGU8tz3meTF81NNDOe', '(952) 220-0172', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:14', '2019-03-14 11:13:14', 0, 1, 2, NULL, NULL),
(82, 1, NULL, 'Brian', 'Leuner', 'default.png', 'Nova Consulting Group', 'brian.leuner@novaconsulting.com', '$2y$10$6hy4ZtNqwddP1w5zIlHOzuDM5ieB.6T9Op.LNccsqm4TNLbhqD8eC', '(614) 867-1870', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:15', '2019-03-14 11:13:15', 0, 1, 2, NULL, NULL),
(83, 1, NULL, 'Brian', 'Meyer', 'default.png', 'Nova Consulting Group', 'brian.meyer@novaconsulting.com', '$2y$10$q6/YM7wQIusQyPJUxUyGl.yTnNljluGNO5Ir9EpbuyWDRA.q0FIsa', '(651) 334-8133', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:16', '2019-03-14 11:13:16', 0, 1, 2, NULL, NULL),
(84, 1, NULL, 'Carrie', 'Stull', 'default.png', 'Nova Consulting Group', 'carrie.stull@novaconsulting.com', '$2y$10$5X21.s5nEEr39WTnc4O39.7dCjeVmrAIcnUACyY30/jwXtdvLbTt2', '913-444-2487', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:17', '2019-03-14 11:13:17', 0, 1, 2, NULL, NULL),
(85, 1, NULL, 'Cary', 'Asper', 'default.png', 'Nova Consulting Group', 'cary.asper@novaconsulting.com', '$2y$10$lXonsQ5Z.3CfVVL.SXaT4OnimUQQCesgGKCEmbJXXIrQC48riUeja', '(801) 865-6684', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:18', '2019-03-14 11:13:18', 0, 1, 2, NULL, NULL),
(86, 1, NULL, 'Casie', 'Permenter', 'default.png', 'Nova Consulting Group', 'casie.permenter@novaconsulting.com', '$2y$10$Bf6rSuWg6/p0GOL1WETtK.T5XwBDLZxd5VXJ.lVjNBtxi6BGCgDT.', '(925) 596-3709', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:19', '2019-03-14 11:13:19', 0, 1, 2, NULL, NULL),
(87, 1, NULL, 'Charles', 'Cooley', 'default.png', 'Nova Consulting Group', 'charles.cooley@novaconsulting.com', '$2y$10$x.jfyAHgQCkKwxQPA0oRhO/mJsDaSUPy3vC2H1avKKj/CsolQnGXe', '817.688.6740', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:20', '2019-03-14 11:13:20', 0, 1, 2, NULL, NULL),
(88, 1, NULL, 'Charlotte', 'Berghoffer', 'default.png', 'Nova Consulting Group', 'charlotte.berghoffer@novaconsulting.com', '$2y$10$.EE6BPULI0dC1.F74u34e.LVcTMXipO.cItgMiw.TE2O3ZYacryTO', '(503) 857-8218', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:21', '2019-03-14 11:13:21', 0, 1, 2, NULL, NULL),
(89, 1, NULL, 'Chelsea', 'Curl', 'default.png', 'Nova Consulting Group', 'chelsea.curl@novaconsulting.com', '$2y$10$j2GsNWzyw96ttlN99dy.0O/X97FaYI8sKtuOj.ZV2NTnILlR3LRem', '470-725-4005', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:22', '2019-03-14 11:13:22', 0, 1, 2, NULL, NULL),
(90, 1, NULL, 'Cheryl', 'Campbell', 'default.png', 'Nova Consulting Group', 'cheryl.campbell@novaconsulting.com', '$2y$10$dIXlrQClEODWPMfKpHYH0uXy1hEILqmEg6vBUTKkJnlFH9Owas8T6', '(516) 423-3372', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:23', '2019-03-14 11:13:23', 0, 1, 2, NULL, NULL),
(91, 1, NULL, 'Chris', 'Coscia', 'default.png', 'Nova Consulting Group', 'chris.coscia@novaconsulting.com', '$2y$10$YDOY1BRCGklthLT1NDh0Aep.qnSN7G.kwbXCc5GgEy21vK8Nc9R66', '(208) 818-7470', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:24', '2019-03-14 11:13:24', 0, 1, 2, NULL, NULL),
(92, 1, NULL, 'Chris', 'Kessler', 'default.png', 'Nova Consulting Group', 'chris.kessler@novaconsulting.com', '$2y$10$pymC1hO/hEtmmInPSkalj.OkJtXTwWitVSrYeexc6dePKkygSDQDy', '207-245-0273', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:25', '2019-03-14 11:13:25', 0, 1, 2, NULL, NULL),
(93, 1, NULL, 'Chuck', 'Easley', 'default.png', 'Nova Consulting Group', 'chuck.easley@novaconsulting.com', '$2y$10$RXab7g2JZE.JNsiURs3EmOloghJfAeqRJwbSB15lnFBiRPwOdBNtC', '(612) 220-1455', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:26', '2019-03-14 11:13:26', 0, 1, 2, NULL, NULL),
(94, 1, NULL, 'Conrad', 'Van Dyke', 'default.png', 'Nova Consulting Group', 'conrad.vandyke@novaconsulting.com', '$2y$10$fRdRvGotkZJ4550mjLTc6eUVEMdxJxPwHmWXNsMCEQ7SkDJ0q/yA6', '(971) 271-0807', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:27', '2019-03-14 11:13:27', 0, 1, 2, NULL, NULL),
(95, 1, NULL, 'Damian', 'Gavaghan', 'default.png', 'Nova Consulting Group', 'damian.gavaghan@novaconsulting.com', '$2y$10$6X3Xt.qwjyrTzoLnCVXCpuCN9xyMrOo5xy3./KJtnuB9fqMTYeuJu', '951-903-3033', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:29', '2019-03-14 11:13:29', 0, 1, 2, NULL, NULL),
(96, 1, NULL, 'Dave', 'Jackson', 'default.png', 'Nova Consulting Group', 'dave.jackson@novaconsulting.com', '$2y$10$nR4tHeluzxMO6FZ0D7IvV.qPrQdwvkwFLTtJI3b2ANOd5mAUJWdJO', '(262) 269-0208', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:30', '2019-03-14 11:13:30', 0, 1, 2, NULL, NULL),
(97, 1, NULL, 'David', 'Brewster', 'default.png', 'Nova Consulting Group', 'david.brewster@novaconsulting.com', '$2y$10$cTjoKN0V4AxUMl3maIjvDuzhy3ZHuw3m5Kr47xzKbk6E3tZDMKRrS', '(919) 885-7762', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:31', '2019-03-14 11:13:31', 0, 1, 2, NULL, NULL),
(98, 1, NULL, 'David', 'Pulvermiller', 'default.png', 'Nova Consulting Group', 'david.pulvermiller@novaconsulting.com', '$2y$10$WywltVKYaFL/3Q6VAFDGPeHlJguHrz4wFEzbhdqIVxo8dsWWD7oti', '(631) 741-5606', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:32', '2019-03-14 11:13:32', 0, 1, 2, NULL, NULL),
(99, 1, NULL, 'Deanna', 'Lee', 'default.png', 'Nova Consulting Group', 'deanna.lee@novaconsulting.com', '$2y$10$bLlS8MJjeBb9QsSdxOY08eug2GdBZo/Il2PDnS2.8EgPIPXiTlLTu', '(213) 276-9642', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:33', '2019-03-14 11:13:33', 0, 1, 2, NULL, NULL),
(100, 1, NULL, 'Elda', 'Pomales', 'default.png', 'Nova Consulting Group', 'elda.pomales@novaconsulting.com', '$2y$10$NLQjpbSWIARVzEt.SCEuL.90VZ2GFz6N8LOjoIzutwso9FsnnjJyK', '917-831-9020', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:34', '2019-03-14 11:13:34', 0, 1, 2, NULL, NULL),
(101, 1, NULL, 'Elise', 'Steger', 'default.png', 'Nova Consulting Group', 'elise.steger@novaconsulting.com', '$2y$10$0Pc7LzxljPhH9D3hEajeAuKUSk5TBjwWdOB80coS3AvaiK9F0EtLW', '612-357-8657', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:35', '2019-03-14 11:13:35', 0, 1, 2, NULL, NULL),
(102, 1, NULL, 'Elizabeth', 'Matthews', 'default.png', 'Nova Consulting Group', 'elizabeth.matthews@novaconsulting.com', '$2y$10$x.PFiPj.mEagGWqeRAmIVOnceF8rf4.fuL6ezTLZBGTQfHkAmTB9.', '207-691-5366', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:36', '2019-03-14 13:03:27', 1, 1, 2, NULL, NULL),
(103, 1, NULL, 'Eric', 'Halpaus', 'default.png', 'Nova Consulting Group', 'eric.halpaus@novaconsulting.com', '$2y$10$Z8h2Em8v6owtGXCJWpgEveN2KnHpTL/5JmcpKc9tVjz3cjnKLD6qK', '(612) 819-1125', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:37', '2019-03-14 11:13:37', 0, 1, 2, NULL, NULL),
(104, 1, NULL, 'Eric', 'Xanderson', 'default.png', 'Nova Consulting Group', 'eric.xanderson@novaconsulting.com', '$2y$10$0oMrl.ulKBNVqyBDTI8CjeJrbkHOzKN43jys4j36VxJBk/HRn9fi.', '(952) 923-5483', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:38', '2019-03-14 11:13:38', 0, 1, 2, NULL, NULL),
(105, 1, NULL, 'Erik', 'Carlson', 'default.png', 'Nova Consulting Group', 'erik.carlson@novaconsulting.com', '$2y$10$4tn1reuwBFAqwTNGvPqywuDsLuTxoumsXOixtaMhJurKqHIXs2CbC', '(313) 549-0779', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:39', '2019-03-14 11:13:39', 0, 1, 2, NULL, NULL),
(106, 1, NULL, 'Frances', 'Williamson', 'default.png', 'Nova Consulting Group', 'frances.williamson@novaconsulting.com', '$2y$10$qsTxMakdYbNggw5COaaz0OdWkng.wo7Y3/iZFNYtxvi7u3zqkCZA.', '(770) 508-9342', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:40', '2019-03-14 11:13:40', 0, 1, 2, NULL, NULL),
(107, 1, NULL, 'Gary', 'Ganson', 'default.png', 'Nova Consulting Group', 'gary.ganson@novaconsulting.com', '$2y$10$PEGLCs2pZydY9jMhpMzgju/fPPVxKlt/AQ2QwrxRHQACvpDLAKsbi', '(816) 668-3245', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:41', '2019-03-14 11:13:41', 0, 1, 2, NULL, NULL),
(108, 1, NULL, 'Greg', 'Murphy', 'default.png', 'Nova Consulting Group', 'greg.murphy@novaconsulting.com', '$2y$10$1yFhGAgSK1sPyhSeA9cbxuzBaUbaPYfPM6ooMUFgKGst4AbzeuOPW', '(415) 377-2431', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:42', '2019-03-14 11:13:42', 0, 1, 2, NULL, NULL),
(109, 1, NULL, 'Hitesh', 'Patel', 'default.png', 'Nova Consulting Group', 'hitesh.patel@novaconsulting.com', '$2y$10$m4pDNvSYnSY0vnO4ZY2euuCur.qPHVlacM161rwo0/IWOTrxiMmNG', '(732) 569-0223', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:43', '2019-03-14 11:13:43', 0, 1, 2, NULL, NULL),
(110, 1, NULL, 'Holly', 'Welsh', 'default.png', 'Nova Consulting Group', 'holly.welsh@novaconsulting.com', '$2y$10$pkmyh/VHAyOCUcs93aDzSeV5ZBsRbPLnfl/vL.kw4.KEOJoZzAx66', '(801) 865-9997', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:44', '2019-03-14 11:13:44', 0, 1, 2, NULL, NULL),
(111, 1, NULL, 'Iris', 'Grant-Brown', 'default.png', 'Nova Consulting Group', 'iris.grant@novaconsulting.com', '$2y$10$8tVgSOtnrXLHl7FfmAhy7OubJJg1SHBawdbWZe.V3IN7cL8uezgMi', '678-699-2470', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:45', '2019-03-14 11:13:45', 0, 1, 2, NULL, NULL),
(112, 1, NULL, 'James', 'Akers', 'default.png', 'Nova Consulting Group', 'james.akers@novaconsulting.com', '$2y$10$EI9paAvFjY3U7ipkXJf9g.Z5TDZQ7n8rLpWu/OErzyuf3XjJSYB3K', '423-268-5134', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:46', '2019-03-14 11:13:46', 0, 1, 2, NULL, NULL),
(113, 1, NULL, 'James', 'McIntyre', 'default.png', 'Nova Consulting Group', 'james.mcintyre@novaconsulting.com', '$2y$10$bB8xZ/I2wYjLILT3i8o6L.hkKsOfgnlT5SknmEnAwajHjo6QhKL3C', '612-210-7744', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:47', '2019-03-14 11:13:47', 0, 1, 2, NULL, NULL),
(114, 1, NULL, 'Janin', 'Carlson', 'default.png', 'Nova Consulting Group', 'janin.carlson@novaconsulting.com', '$2y$10$lGaroZx6JCXtYw5zAnO7TODsW6YGlqC.4Wh7BzsrGbwfqR7Y7xbku', '(541) 630-0407', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:48', '2019-03-14 11:13:48', 0, 1, 2, NULL, NULL),
(115, 1, NULL, 'Janine', 'Mushock', 'default.png', 'Nova Consulting Group', 'janine.mushock@novaconsulting.com', '$2y$10$Z/WCv2KULMwYsTpvbkK0meY7OE950HBZcT2qUJ1tufH7pro5aC4oe', '(970) 216-5419', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:49', '2019-03-14 11:13:49', 0, 1, 2, NULL, NULL),
(116, 1, NULL, 'Jennon', 'Lewis', 'default.png', 'Nova Consulting Group', 'jennon.lewis@novaconsulting.com', '$2y$10$fwd4qFQn7RMOg5hc9ysmWui04lt8ICnZpfHSrEzzlJ6DtU1.IB//m', '(832) 370-1274', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:50', '2019-03-14 11:13:50', 0, 1, 2, NULL, NULL),
(117, 1, NULL, 'Jessica', 'Doerner', 'default.png', 'Nova Consulting Group', 'jessica.doerner@novaconsulting.com', '$2y$10$vbv4tOUkNz29dICup86lf.6Tl8VKdQyPh4eLBHXV.YbkluacwyhZ6', '(917) 533-5811', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:51', '2019-03-14 11:13:51', 0, 1, 2, NULL, NULL),
(118, 1, NULL, 'Jessica', 'Oxford', 'default.png', 'Nova Consulting Group', 'jessica.oxford@novaconsulting.com', '$2y$10$R0SdDa8.B6gdIqnvBsJ7.Occtci0ZDMdVljqMud0FI2ZK9tN5EXG6', '(801) 358-6912', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:52', '2019-03-14 11:13:52', 0, 1, 2, NULL, NULL),
(119, 1, NULL, 'Jim', 'Gott', 'default.png', 'Nova Consulting Group', 'jim.gott@novaconsulting.com', '$2y$10$SCoHCb0ZlcinVGT4zRXUgejQjTp.UaHfDF5C7JAUgvFM9z5u9Feju', '+44 (0) 7580 217534', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:53', '2019-03-14 11:13:53', 0, 1, 2, NULL, NULL),
(120, 1, NULL, 'Joe', 'Szarkowicz', 'default.png', 'Nova Consulting Group', 'joe.szarkowicz@novaconsulting.com', '$2y$10$rrn8.7Jq9fHG8iVmUA2nJ.YJi88VDpyeY8yiFxC2jVFasUfdyag1e', '815-904-5082', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:54', '2019-03-14 11:13:54', 0, 1, 2, NULL, NULL),
(121, 1, NULL, 'John', 'Bale', 'default.png', 'Nova Consulting Group', 'john.bale@novaconsulting.com', '$2y$10$wWAe.Fo2EMURT..YjsucmuxBtRASZeO3oGghW/l0D1jbk1NWd0kWu', '(612) 310-7957', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:55', '2019-03-14 11:13:55', 0, 1, 2, NULL, NULL),
(122, 1, NULL, 'John', 'Hill', 'default.png', 'Nova Consulting Group', 'john.hill@novaconsulting.com', '$2y$10$DkSXaau/fiKiSZfo9Nd7Tu4hbNnbGAAb5C4x6fzfCJokGMjVl8CXm', '(530) 919-9064', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:55', '2019-03-14 11:13:55', 0, 1, 2, NULL, NULL),
(123, 1, NULL, 'Joseph', 'Argenta', 'default.png', 'Nova Consulting Group', 'joseph.argenta@novaconsulting.com', '$2y$10$w4ZzRiOP/mO.lBcXb4PK9u4zi6dli2bCBZJCF94buluNWVLRj1j86', '(585) 415-7282', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:56', '2019-03-14 11:13:56', 0, 1, 2, NULL, NULL),
(124, 1, NULL, 'Joseph', 'DiBernardo', 'default.png', 'Nova Consulting Group', 'joseph.dibernardo@novaconsulting.com', '$2y$10$3tYW0hJdl8P5GMXr0CrJhuTtsNyb3VzDdt3VSJGNtoUpMpzUsWyaa', '(848) 210-2654', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:57', '2019-03-14 11:13:57', 0, 1, 2, NULL, NULL),
(125, 1, NULL, 'Justin', 'Lia', 'default.png', 'Nova Consulting Group', 'justin.lia@novaconsulting.com', '$2y$10$/JAEZgQ0ZvI/O7ZqTmeUj.MmHDxEmW9zUiA7BzMg4Sjqf2XYxMYue', '914-200-8660', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:58', '2019-03-14 11:13:58', 0, 1, 2, NULL, NULL),
(126, 1, NULL, 'Kathleen', 'Ryan', 'default.png', 'Nova Consulting Group', 'kathleen.ryan@novaconsulting.com', '$2y$10$YGmJwMnxHBLWsh9Yg8sI7O6PbYFuJukdgSPTotVTgSlnf8vJdpWra', '562-367-6106', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:13:59', '2019-03-14 11:13:59', 0, 1, 2, NULL, NULL),
(127, 1, NULL, 'Kayla', 'Koenen', 'default.png', 'Nova Consulting Group', 'kayla.koenen@novaconsulting.com', '$2y$10$BCcBXw4aoKo0CMmo/te/AeiVtgbwKmIfe9uPR/l0rSyUM5bIHFGo.', '952-207-8063', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:00', '2019-03-14 11:14:00', 0, 1, 2, NULL, NULL),
(128, 1, NULL, 'Keegan', 'Lutz', 'default.png', 'Nova Consulting Group', 'keegan.lutz@novaconsulting.com', '$2y$10$xJXcIHqovYeAtPKCru7p7uvNUawBTtql.pkis8tNmhRZg9oyubMf.', '952-239-7914', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:01', '2019-03-14 11:14:01', 0, 1, 2, NULL, NULL),
(129, 1, NULL, 'Keely', 'Felton', 'default.png', 'Nova Consulting Group', 'keely.felton@novaconsulting.com', '$2y$10$vRqbpQcoIwkrpFTa9mcVLu09EemKPGsvs2ClyA6sv6sINsFMaCQdS', '207-939-4983', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:02', '2019-03-14 11:14:02', 0, 1, 2, NULL, NULL),
(130, 1, NULL, 'Keith', 'Haberern', 'default.png', 'Nova Consulting Group', 'keith.haberern@novaconsulting.com', '$2y$10$dFLdltyfwWJH8EyYsaaPfOvHuaWg3T/ByQuLUGr.zYA.Xe.QOE6vq', '856-397-1678', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:03', '2019-03-14 11:14:03', 0, 1, 2, NULL, NULL),
(131, 1, NULL, 'Kelly', 'Brewer', 'default.png', 'Nova Consulting Group', 'kelly.brewer@novaconsulting.com', '$2y$10$dbE4UWDTDVd157Xmd0Tsa.iq9yFfn3w2uzUdM8P3oYwmAUszyU9mi', '(917) 383-5432', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:04', '2019-03-14 11:14:04', 0, 1, 2, NULL, NULL),
(132, 1, NULL, 'Kevin', 'Jones', 'default.png', 'Nova Consulting Group', 'kevin.jones@novaconsulting.com', '$2y$10$IRW5YnIqL2yVFQIjKwBwluyUHX7H1StMaEHBT8xYhnlMqaCLIc26u', '317-618-0462', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:05', '2019-03-14 11:14:05', 0, 1, 2, NULL, NULL),
(133, 1, NULL, 'Kevin', 'Orr', 'default.png', 'Nova Consulting Group', 'kevin.orr@novaconsulting.com', '$2y$10$0XAXHW37sEozc/LVFdDbEeB/qhoU5.QGMpCvMzHQB5glHZwHwZWnq', '(801) 913-7833', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:06', '2019-03-14 11:14:06', 0, 1, 2, NULL, NULL),
(134, 1, NULL, 'Kevin', 'White', 'default.png', 'Nova Consulting Group', 'kevin.white@novaconsulting.com', '$2y$10$JBc5frE1y/o4Nq2CBgZ4teECjahszt/zI3U0aTvyDz6x1wj8DItNm', '410-980-1904', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:07', '2019-03-14 11:14:07', 0, 1, 2, NULL, NULL),
(135, 1, NULL, 'Kristin', 'Tate', 'default.png', 'Nova Consulting Group', 'kristin.tate@novaconsulting.com', '$2y$10$keYC376IlcipIy5vTXz.TOC9BjxhDfBeX24adEPyGHRFynLJfATp.', '832-401-8321', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:08', '2019-03-14 11:14:08', 0, 1, 2, NULL, NULL),
(136, 1, NULL, 'Larry', 'Lee', 'default.png', 'Nova Consulting Group', 'larry.lee@novaconsulting.com', '$2y$10$nlwmJIf9rsmU4rU3P.saNOfgUcoDZ2Um74UuFN.pWidkD5xan390K', '470-445-1598', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:09', '2019-03-14 11:14:09', 0, 1, 2, NULL, NULL),
(137, 1, NULL, 'Laura', 'Botzong', 'default.png', 'Nova Consulting Group', 'laura.botzong@novaconsulting.com', '$2y$10$tcknA/eIF2jc1ZHVvL.mjOELcJirjoxAVmHo/g6uwv1rjgL9bWcuy', '310-299-6433', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:10', '2019-03-14 11:14:10', 0, 1, 2, NULL, NULL),
(138, 1, NULL, 'Lauren', 'Dorger', 'default.png', 'Nova Consulting Group', 'lauren.dorger@novaconsulting.com', '$2y$10$jABUJEnIRYZsxiF/8VrEm.E6oLaFWdLUBxaFc8yBtZOnLb5TSH1Bu', '(713) 226-9559', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:11', '2019-03-14 11:14:11', 0, 1, 2, NULL, NULL),
(139, 1, NULL, 'Lauren', 'Larson', 'default.png', 'Nova Consulting Group', 'lauren.larson@novaconsulting.com', '$2y$10$IpFaWC4WzyF7LzgvxaelhOk2kXpfDqy047K4D0sxxFrl3xUnXh/cW', '(952) 529-0030', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:12', '2019-03-14 11:14:12', 0, 1, 2, NULL, NULL),
(140, 1, NULL, 'Lauren', 'Mazzacca', 'default.png', 'Nova Consulting Group', 'lauren.mazzacca@novaconsulting.com', '$2y$10$eHnKlZ72KtsdJDPnghx5..KW54Sa426JaTgdYuoRz5IgFb/KeQ6Ra', '973-487-7524', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:13', '2019-03-14 11:14:13', 0, 1, 2, NULL, NULL),
(141, 1, NULL, 'Leann', 'Young', 'default.png', 'Nova Consulting Group', 'leann.young@novaconsulting.com', '$2y$10$7v44cXPSl6MRQ0BSPPzi7OSvfnZ7dbB7dbiCcL9vWvjbmWfGb5D3.', '(952) 484-2636', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:15', '2019-03-14 11:14:15', 0, 1, 2, NULL, NULL),
(142, 1, NULL, 'Len', 'Giacone', 'default.png', 'Nova Consulting Group', 'len.giacone@novaconsulting.com', '$2y$10$Av6BPZgsYHjqTAt0n8htE.xFcP0kVHsckntSc1NCsGRmqUg9z73XK', '(954) 270-2553', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:16', '2019-03-14 11:14:16', 0, 1, 2, NULL, NULL),
(143, 1, NULL, 'Lindsey', 'McFarland', 'default.png', 'Nova Consulting Group', 'lindsey.mcfarland@novaconsulting.com', '$2y$10$OF0U6AGYRIPZsayTd8BRKuMkICx6gVK.Xp.5oDHxyhIJIQaZS2W3q', '660-492-0231', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:16', '2019-03-14 11:14:16', 0, 1, 2, NULL, NULL),
(144, 1, NULL, 'Lindy', 'Breedon', 'default.png', 'Nova Consulting Group', 'lindy.breedon@novaconsulting.com', '$2y$10$/TlnskMjfRjylyPsc6l/tu7qyZhX97V/b.jP.DyLQJJ7Sk4wehZ16', '972-439-7468', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:17', '2019-03-14 11:14:17', 0, 1, 2, NULL, NULL),
(145, 1, NULL, 'Lloyd', 'Pflug', 'default.png', 'Nova Consulting Group', 'lloyd.pflug@novaconsulting.com', '$2y$10$7D2.sjU15qFsTZwMRRPukeLJj8YWuVqBjDs3LqPpcgOmMB5sfXAuK', '(443) 239-5831', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:18', '2019-03-14 11:14:18', 0, 1, 2, NULL, NULL),
(146, 1, NULL, 'Lori', 'Sanchez', 'default.png', 'Nova Consulting Group', 'lori.sanchez@novaconsulting.com', '$2y$10$iePiVeZTRqXqkCj57CCO1.f5hXx1uAR2M1mIdeLYoKppJBtYqmPaa', '941-225-5190', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:20', '2019-03-14 11:14:20', 0, 1, 2, NULL, NULL),
(147, 1, NULL, 'Maegan', 'Dunn', 'default.png', 'Nova Consulting Group', 'maegan.dunn@novaconsulting.com', '$2y$10$6t7a0pTKOxd6h3GC.fqHv.la0RINYK9FnwlgPXWFQ8tMp80V.HDuq', '612-900-5625', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:21', '2019-03-14 11:14:21', 0, 1, 2, NULL, NULL),
(148, 1, NULL, 'Max', 'Vaynshteyn', 'default.png', 'Nova Consulting Group', 'maksim.vaynshteyn@novaconsulting.com', '$2y$10$Aa9vG1H0KT0QsSco37g7.u6OUetM7/zAdOOHuwAlGAoBpSUIgToEO', '914-491-9101', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:22', '2019-03-14 11:14:22', 0, 1, 2, NULL, NULL),
(149, 1, NULL, 'Marc', 'Weyd', 'default.png', 'Nova Consulting Group', 'marc.weyd@novaconsulting.com', '$2y$10$S06rUTDf9en8FqbEMumytOI3Z/yHfd0QYSPdAHyaz5tRJND4z8dJa', '(704) 577-8178', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:23', '2019-03-14 11:14:23', 0, 1, 2, NULL, NULL),
(150, 1, NULL, 'Margo', 'Billings', 'default.png', 'Nova Consulting Group', 'margo.billings@novaconsulting.com', '$2y$10$PmcSLg5fPKyv14tr49y6bun5RWHfyw90i2CYiQ1oNwtll9KrlYV6S', '207-210-1215', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:24', '2019-03-14 11:14:24', 0, 1, 2, NULL, NULL),
(151, 1, NULL, 'Mark', 'Perry', 'default.png', 'Nova Consulting Group', 'mark.perry@novaconsulting.com', '$2y$10$XXn2Lvtatnj1/jGKFba1LOE2.VlstA1HJr1NifGbCct4c8Dd5Dv4i', '(612) 275-1997', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:25', '2019-03-14 11:14:25', 0, 1, 2, NULL, NULL),
(152, 1, NULL, 'Michael', 'Cronin', 'default.png', 'Nova Consulting Group', 'michael.cronin@novaconsulting.com', '$2y$10$amujXKEn6D6c1d21k5AENeAlUHFlC6h7dxbbJww8Rk4CpWJ/vUL2G', '781-258-0230', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:26', '2019-03-14 11:14:26', 0, 1, 2, NULL, NULL),
(153, 1, NULL, 'Michael', 'DiGiorgio', 'default.png', 'Nova Consulting Group', 'michael.digiorgio@novaconsulting.com', '$2y$10$XsTr5v1Kv7wfl8DadoTfNutxO6gtouwWd3fbgDync2A/fzbaVCIhS', '516-474-5425', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:27', '2019-03-14 11:14:27', 0, 1, 2, NULL, NULL),
(154, 1, NULL, 'Michael', 'Earley', 'default.png', 'Nova Consulting Group', 'michael.earley@novaconsulting.com', '$2y$10$qgoySIJ3NbYUwiOrKTVsOOCLYorlrpQ25q7BVBbvMyG2YXweK./n.', '(952) 210-1964', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:28', '2019-03-14 11:14:28', 0, 1, 2, NULL, NULL),
(155, 1, NULL, 'Michael', 'Marsich', 'default.png', 'Nova Consulting Group', 'michael.marsich@novaconsulting.com', '$2y$10$YwcUALOO.xUz4OPjJxuBcuRG0rif26p3BZ3gRlmbvdobAMKpz2Mk2', '919-428-7552', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:29', '2019-03-14 11:14:29', 0, 1, 2, NULL, NULL),
(156, 1, NULL, 'Michael', 'Monaghan', 'default.png', 'Nova Consulting Group', 'michael.monaghan@novaconsulting.com', '$2y$10$ibXsAKQ4i1y/TAihfH8gD.S59GjK0QYPn60aoynIydwh6WwoPVkPm', '719-357-2058', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:30', '2019-03-14 11:14:30', 0, 1, 2, NULL, NULL),
(157, 1, NULL, 'Michelle', 'Gill', 'default.png', 'Nova Consulting Group', 'michelle.gill@novaconsulting.com', '$2y$10$ZFCBsLdbn0ZFpQfj9udd.u9bNmUUCbCucbTXO21Q3AAFOlNJp6YMa', '207-245-2115', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:31', '2019-03-14 11:14:31', 0, 1, 2, NULL, NULL),
(158, 1, NULL, 'Mike', 'Goalen', 'default.png', 'Nova Consulting Group', 'mike.goalen@novaconsulting.com', '$2y$10$69wu7StIvHz4km3bWrHd2.GOu/HDnYNWUHsMXjCkd.g.Sf4e7xx3S', '612-499-1913', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:32', '2019-03-14 11:14:32', 0, 1, 2, NULL, NULL),
(159, 1, NULL, 'Mike', 'Hayes', 'default.png', 'Nova Consulting Group', 'mike.hayes@novaconsulting.com', '$2y$10$ewGzOmrm1A97DGtkC1wzIuHLS7.lAXAzrTGB4JuNp6MG0v6OMBdcK', '(612) 670-4658', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:33', '2019-03-14 11:14:33', 0, 1, 2, NULL, NULL),
(160, 1, NULL, 'Mike', 'Minett', 'default.png', 'Nova Consulting Group', 'mike.minett@novaconsulting.com', '$2y$10$IFHeBoDIjESUJtmoYPUn7OSk9ACzi2mRQw.KMaC5omSJnxpMT8232', '(704) 258-5196', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:34', '2019-03-14 11:14:34', 0, 1, 2, NULL, NULL),
(161, 1, NULL, 'Morgan', 'Garrett', 'default.png', 'Nova Consulting Group', 'morgan.garrett@novaconsulting.com', '$2y$10$UExGF4ZoKGI5QB4MADEEhOevlEJXHxnjhAwsyjsr9EibAtp3v8VbC', '(602) 752-3423', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:35', '2019-03-14 11:14:35', 0, 1, 2, NULL, NULL),
(162, 1, NULL, 'Neil', 'Archibald', 'default.png', 'Nova Consulting Group', 'neil.archibald@novaconsulting.com', '$2y$10$mSprg32dOn.7ayMFgdm4UOq0hQHvCD7NGEvnBbYs0zpCQnM0IClu2', '(404) 808-8012', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:36', '2019-03-14 11:14:36', 0, 1, 2, NULL, NULL),
(163, 1, NULL, 'Nick', 'Domeier', 'default.png', 'Nova Consulting Group', 'nick.domeier@novaconsulting.com', '$2y$10$T5XJc1w/YgjOi7bOh28VX.nha1eMwwGvsL/jdcJ8AReQfLS2KI5KK', '(651) 260-9520', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:37', '2019-03-14 11:14:37', 0, 1, 2, NULL, NULL),
(164, 1, NULL, 'Nolan', 'Warn', 'default.png', 'Nova Consulting Group', 'nolan.warn@novaconsulting.com', '$2y$10$X3TaJZ7wmEoc7o8.XmbN3.UFhYruoTBURqq.9J.LkTYaQll/2aHUO', '913-292-4104', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:38', '2019-03-14 11:14:38', 0, 1, 2, NULL, NULL),
(165, 1, NULL, 'Patrick', 'Johnson', 'default.png', 'Nova Consulting Group', 'patrick.johnson@novaconsulting.com', '$2y$10$cz1u2NHulR6u0L3mzx2kEO0CS95Sg6ibqdRrBC7qI1c9QgKvlE33m', '(214) 918-8113', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:39', '2019-03-14 11:14:39', 0, 1, 2, NULL, NULL),
(166, 1, NULL, 'Paul', 'Flanagan', 'default.png', 'Nova Consulting Group', 'paul.flanagan@novaconsulting.com', '$2y$10$Tyck9zcIefvN7IdnPMFqUOmxYZs8UsUmuPgPeK.rU3Sunko4qEhpe', '612-749-3340', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:39', '2019-03-14 11:14:39', 0, 1, 2, NULL, NULL),
(167, 1, NULL, 'Radu', 'Dumitrescu', 'default.png', 'Nova Consulting Group', 'radu.dumitrescu@novaconsulting.com', '$2y$10$0XHKM/6wZal4zOM13Uk49eVGFV/Ps3Hv.gbHaMhn9SgRHty/do8FG', '914-439-1157', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:40', '2019-03-14 11:14:40', 0, 1, 2, NULL, NULL),
(168, 1, NULL, 'Ray', 'Hutchison', 'default.png', 'Nova Consulting Group', 'ray.hutchison@novaconsulting.com', '$2y$10$ruo1EGVPD4vpUKmOM7./zeRdes7OZt8os.TSzz4m7TuUZqLVU9bye', '(201) 391-0520', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:41', '2019-03-14 11:14:41', 0, 1, 2, NULL, NULL),
(169, 1, NULL, 'Reginald', 'Nederman', 'default.png', 'Nova Consulting Group', 'reginald.nederman@novaconsulting.com', '$2y$10$Ic7C7k3tBlIT1iN1hoNuW.gm6xMLXSngiv7dg99UT5L3pNC0fFCN2', '310-924-2439', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:41', '2019-03-14 11:14:41', 0, 1, 2, NULL, NULL),
(170, 1, NULL, 'Rich', 'George', 'default.png', 'Nova Consulting Group', 'rich.george@novaconsulting.com', '$2y$10$QlHLUlq6tmTsMY3./dZSAeE.f7mMcXJ/TZRA.Ht7MOUtPgdeIbYYi', '904-805-2655', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:42', '2019-03-14 11:14:42', 0, 1, 2, NULL, NULL);
INSERT INTO `users` (`users_id`, `user_types_id`, `associate_type_id`, `users_name`, `last_name`, `users_profile_image`, `users_company`, `users_email`, `users_password`, `users_phone`, `users_address`, `latitude`, `longitude`, `lat_long_updated_at`, `notification_enable`, `created_at`, `updated_at`, `email_status`, `users_status`, `users_approval_status`, `users_approved_by`, `users_approved_date`) VALUES
(171, 1, NULL, 'Rick', 'Grismer', 'default.png', 'Nova Consulting Group', 'rick.grismer@novaconsulting.com', '$2y$10$zSydLX/G9ryi4ZROv5il3uOuhHqkwsxzxdJj7S45m9Q.GWIybsjOO', '(779) 208-6656', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:43', '2019-03-14 11:14:43', 0, 1, 2, NULL, NULL),
(172, 1, NULL, 'Rick', 'Leines', 'default.png', 'Nova Consulting Group', 'rick.leines@novaconsulting.com', '$2y$10$RC3miZzYuv5fEFc.ywipHu71YN3g7CTTL1hgv2xaCvuQxP3LqGIqK', '913-297-4733', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:43', '2019-03-14 11:14:43', 0, 1, 2, NULL, NULL),
(173, 1, NULL, 'Robert', 'Greene', 'default.png', 'Nova Consulting Group', 'robert.greene@novaconsulting.com', '$2y$10$pC7vFYZYvWvyAY9hh9UQj.wWR.Lgn/k/X8iqZyx6kOb/HrB.9Kh0m', '480-261-1355', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:44', '2019-03-14 11:14:44', 0, 1, 2, NULL, NULL),
(174, 1, NULL, 'Robert', 'Hird', 'default.png', 'Nova Consulting Group', 'robert.hird@novaconsulting.com', '$2y$10$LsGEZtz8ZoJxB8EZHlevlOhiu3Hr64zYci0SjvbYzkj7t8ixqzEqy', '(704) 577-8144', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:44', '2019-03-14 11:14:44', 0, 1, 2, NULL, NULL),
(175, 1, NULL, 'Robert', 'Jackson', 'default.png', 'Nova Consulting Group', 'robert.jackson@novaconsulting.com', '$2y$10$IMSbpV2H9ZyqbMpqfu/EPedMVpn/2e0dY9Iuj5na3OHb3QSeq/t02', '503-201-0453', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:45', '2019-03-14 11:14:45', 0, 1, 2, NULL, NULL),
(176, 1, NULL, 'Rotie', 'Smith', 'default.png', 'Nova Consulting Group', 'rotie.smith@novaconsulting.com', '$2y$10$cI9STPcHUza0ad9gfiHpVu23570lM.odyZ9JXJveBGvJx49.Mg4YO', '(281) 763-8462', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:46', '2019-03-14 11:14:46', 0, 1, 2, NULL, NULL),
(177, 1, NULL, 'Sara', 'Alker', 'default.png', 'Nova Consulting Group', 'sara.alker@novaconsulting.com', '$2y$10$w7GoXEmo8Hmp6Pv.s8A0/ep8T0SeLUIaClX4/iPZJIsvdVm9Shz0S', '44 (0) 7971 492965', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:46', '2019-03-14 11:14:46', 0, 1, 2, NULL, NULL),
(178, 1, NULL, 'Sarah', 'Ohlmeier', 'default.png', 'Nova Consulting Group', 'sarah.ohlmeier@novaconsulting.com', '$2y$10$n./hE0c9NfFw0aBipB8DOeHWakzbWdtWrVCKzfDBcfLk9/pC9hYL2', '913-251-2682', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:47', '2019-03-14 11:14:47', 0, 1, 2, NULL, NULL),
(179, 1, NULL, 'Sara', 'Kelm', 'default.png', 'Nova Consulting Group', 'sara.kelm@novaconsulting.com', '$2y$10$S0/Qk01jkKhpUlgKWlwLqO9CDL8E3gZ.W0iiBZenSjHEatofQuOoy', '312-350-0934', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:48', '2019-03-14 11:14:48', 0, 1, 2, NULL, NULL),
(180, 1, NULL, 'Scott', 'Brown', 'default.png', 'Nova Consulting Group', 'scott.brown@novaconsulting.com', '$2y$10$VkXwYHGHR9ek3FT5c6mRLOK9RIS6tGT20/Pe/LUsG7ipopM6Ej/au', '(317) 376-5145', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:48', '2019-03-14 11:14:48', 0, 1, 2, NULL, NULL),
(181, 1, NULL, 'Sean', 'Paradine', 'default.png', 'Nova Consulting Group', 'sean.paradine@novaconsulting.com', '$2y$10$mqDwOpSofLSOVJ/FLXQfz..6Dh0ou87DcY7XYV5PTpGI4lvHO0X6y', '(909) 285-6088', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:49', '2019-03-14 11:14:49', 0, 1, 2, NULL, NULL),
(182, 1, NULL, 'Steve', 'Cummings', 'default.png', 'Nova Consulting Group', 'steve.cummings@novaconsulting.com', '$2y$10$/XE2bwQ4odLt/3J.NQp59eTCgAsEotEiwldMmDMtbPDqAHCAwqwlu', '(952) 838-5600', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:49', '2019-03-14 11:14:49', 0, 1, 2, NULL, NULL),
(183, 1, NULL, 'Taylor', 'Russell', 'default.png', 'Nova Consulting Group', 'taylor.russell@novaconsulting.com', '$2y$10$NOdUezPlR5nrTGsbjV02YemmhIFt/fhEGmgCUlgxWbaVX9IKa3k0G', '816-315-2943', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:50', '2019-03-14 11:14:50', 0, 1, 2, NULL, NULL),
(184, 1, NULL, 'Terry', 'Kaiser', 'default.png', 'Nova Consulting Group', 'terry.kaiser@novaconsulting.com', '$2y$10$mi9pF0zqQMh3bhaaiBr43OFivKdTyj6i.yUCQU8lZZjzcXe0SMWlG', '(651) 387-2260', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:51', '2019-03-14 11:14:51', 0, 1, 2, NULL, NULL),
(185, 1, NULL, 'Thomas', 'Fiorentino-Strawn', 'default.png', 'Nova Consulting Group', 'thomas.fiorentino@novaconsulting.com', '$2y$10$gLUuFDZBYZXdmxIbedEk0OdwLKtTMR6vGRHGw9E.9E1YiIfxoScFW', '612-750-1229', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:51', '2019-03-14 11:14:51', 0, 1, 2, NULL, NULL),
(186, 1, NULL, 'Tim', 'Badger', 'default.png', 'Nova Consulting Group', 'tim.badger@novaconsulting.com', '$2y$10$SeY5yHm2bPkdd2tVlv.yXebPhfAbX.ONWU6zGa7AVAwxKcwpTJKwm', '(312) 669-4364', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:52', '2019-03-14 11:14:52', 0, 1, 2, NULL, NULL),
(187, 1, NULL, 'Tina', 'Cotterman', 'default.png', 'Nova Consulting Group', 'tina.cotterman@novaconsulting.com', '$2y$10$pbhFnc3VBTphoAE5tEbFZOshz8ZouQdD.wZiq5G0gvcrAdB.VtwWu', '(952) 999-2451', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:53', '2019-03-14 11:14:53', 0, 1, 2, NULL, NULL),
(188, 1, NULL, 'Tom', 'Favino', 'default.png', 'Nova Consulting Group', 'tom.favino@novaconsulting.com', '$2y$10$fd13ORd534T1wg.8EA9yVejHRSydaPUJqF9zDszT6kM1utPt3TCfm', '954-298-1107', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:53', '2019-03-14 11:14:53', 0, 1, 2, NULL, NULL),
(189, 1, NULL, 'Tom', 'Panning', 'default.png', 'Nova Consulting Group', 'tom.panning@novaconsulting.com', '$2y$10$0cZzGhDPqWbHsdxwQsHDNepmYjRVs4IEHscPrkOPxUpo6y3G4LHHi', '(952) 484-3309', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:54', '2019-03-14 11:14:54', 0, 1, 2, NULL, NULL),
(190, 1, NULL, 'Tom', 'Warn', 'default.png', 'Nova Consulting Group', 'tom.warn@novaconsulting.com', '$2y$10$TAEfHyPSeR7pp0Jl71Ehd.EWaP3DXA1U7iL4zrOKVW7RwfdjCVUYu', '(913) 998-3072', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:54', '2019-03-14 11:14:54', 0, 1, 2, NULL, NULL),
(191, 1, NULL, 'Tony', 'Coletta', 'default.png', 'Nova Consulting Group', 'tony.coletta@novaconsulting.com', '$2y$10$KwnDISNKOxijtzLFNwFfNOWYMAy1gt979tMocugUjTG1ivcDhc6R2', '(480) 650-4751', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:55', '2019-03-14 11:14:55', 0, 1, 2, NULL, NULL),
(192, 1, NULL, 'Trent', 'Augustus', 'default.png', 'Nova Consulting Group', 'trent.augustus@novaconsulting.com', '$2y$10$XYmOo0ViIn5sqQ4NvWy9EuT2K8aFWFcBJUk/lRPDInNRXZNSiB/Zy', '801-834-8618', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:14:56', '2019-03-14 11:14:56', 0, 1, 2, NULL, NULL),
(193, 1, NULL, 'Clifford', 'Babson', 'default.png', 'Nova Consulting Group', 'clifford.babson@novaconsulting.com', '$2y$10$lpf8a5hR.l3f2/h6f6zhfe/82qIecd3sr60qYZ6EOSFHaa/3GPZTi', '(999) 999-9999', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:18:46', '2019-03-14 11:18:46', 0, 1, 2, NULL, NULL),
(194, 1, NULL, 'Vanessa', 'Chambers', 'default.png', 'Nova Consulting Group', 'vanessa.chambers@novaconsulting.com', '$2y$10$wicIiI4KVi88FbL2XHbnuOx6Xbf6ZhjpwFbWdRbFf6IUmVb8TMn8K', '(281) 889-3054', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:18:54', '2019-03-14 11:18:54', 0, 1, 2, NULL, NULL),
(195, 1, NULL, 'Wil', 'King', 'default.png', 'Nova Consulting Group', 'wil.king@novaconsulting.com', '$2y$10$Au6uY5QRumcZGw5ykI9.C.g1BTaWSJaRQ0j6iM3SaUFZr8uNQv9vO', '(913) 378-5025', NULL, NULL, NULL, NULL, 1, '2019-03-14 11:18:55', '2019-03-14 11:18:55', 0, 1, 2, NULL, NULL),
(196, 1, NULL, 'Joe', 'Scoped', 'default.png', 'Nova Consulting Group', 'joe.scoped@novaconsulting.com', '$2y$10$EJuYuXR9GoH7mm5EGVxB.Oc4tuba5/3x.AbduTChna4IEgrGf0mvO', '555-123-4444', NULL, NULL, NULL, NULL, 1, '2019-03-14 12:20:02', '2019-03-14 12:22:25', 0, 1, 2, NULL, NULL),
(197, 1, NULL, 'Test', 'User', 'default.png', 'magneto', 'ryan.mord+2@novaconsulting.com', '$2y$10$fMkN/3inEq3O54o8mQKqcuhlQgGbohxpPeq/1oDMFoSIuU0BGvRrO', '+1 (254) 878 7676', NULL, NULL, NULL, NULL, 1, '2019-03-14 13:10:21', '2019-03-14 13:29:54', 0, 1, 2, NULL, NULL),
(198, 2, 1, 'Ryan', 'Mord', '1552581255-image.1552581255.169182.png', 'ABC Company', 'ryanmord+0314@gmail.com', '$2y$10$LcnbsfP/F7Ea0YOMK605C.GPcueWTq4z22yfNH5aaT742BDXdedS6', '+1 (612) 558 9239', '3125 Georgia Ave S, Minneapolis, MN 55426', '18.59095896135839', '73.75312205404043', NULL, 1, '2019-03-14 16:34:17', '2019-03-14 16:35:09', 1, 1, 1, 1, '2019-03-14 16:34:38'),
(199, 1, NULL, 'Suvarna', 'Shinde', 'default.png', 'magneto', 'suvarnashinde.magneto+23@gmail.com', '$2y$10$2gG.NG0P2WH8cyl.WNR1/u4LnZ1W3WjmLyfaIWdkp/huT6Dw3/sbm', '+1 (254) 878 7676', NULL, NULL, NULL, NULL, 1, '2019-03-15 11:06:41', '2019-03-15 11:06:41', 1, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_key`
--

CREATE TABLE `user_access_key` (
  `user_access_key_id` int(10) NOT NULL,
  `user_access_key` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `user_device_id` int(10) NOT NULL,
  `user_access_key_status` tinyint(1) NOT NULL COMMENT '0=InValid,1=Valid',
  `user_access_key_generated` datetime DEFAULT NULL,
  `logout_status` tinyint(1) NOT NULL DEFAULT '0',
  `logout_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_key`
--

INSERT INTO `user_access_key` (`user_access_key_id`, `user_access_key`, `user_id`, `user_device_id`, `user_access_key_status`, `user_access_key_generated`, `logout_status`, `logout_datetime`) VALUES
(1, 'WkUptKPQZIWJMPSI', 23, 1, 0, '2019-02-07 18:50:12', 1, '2019-02-07 18:51:24'),
(2, 'i64HrbwqcQSVjoVu', 2, 2, 1, '2019-02-07 19:40:03', 0, '2019-02-11 10:59:40'),
(3, 'd5RRvhUZJeLStFAK', 23, 3, 1, '2019-02-07 19:56:01', 0, '2019-02-07 19:56:17'),
(4, 'q4Q7g7A3DkZMYgp2', 2, 4, 0, '2019-02-07 19:56:34', 1, '2019-02-08 16:43:26'),
(5, 'Kph3J4TnuPhgrQ9y', 3, 5, 1, '2019-02-07 20:58:59', 0, NULL),
(6, 'kp8DciqDGjrrqK3Y', 3, 6, 1, '2019-02-07 21:03:54', 0, NULL),
(7, 'YKM466JtwTsPPbn5', 2, 7, 1, '2019-02-08 16:30:57', 0, NULL),
(8, 'TVnwXvlSzgyK3kgM', 23, 8, 0, '2019-02-08 17:10:57', 1, '2019-02-11 11:00:51'),
(9, '9IJMaHTT5dAcbWiJ', 2, 9, 1, '2019-02-08 17:41:56', 0, NULL),
(10, 'KPrxUbk2RUK0CkNO', 2, 10, 0, '2019-02-11 11:30:56', 1, '2019-02-11 11:50:21'),
(11, 'fMCI7AhTkcYSYSiB', 23, 11, 1, '2019-02-11 11:50:43', 0, '2019-03-04 11:52:45'),
(12, '73AsWLIIHjNjMd7W', 23, 12, 0, '2019-02-11 11:53:08', 1, '2019-03-06 11:00:56'),
(13, '71K3DCIjHkzIpemW', 2, 13, 1, '2019-02-11 11:53:49', 0, '2019-02-11 13:06:32'),
(14, 'CTbPpWOtwINWhMOd', 2, 14, 1, '2019-02-11 12:13:18', 0, '2019-02-11 12:50:39'),
(15, '23DOBefgnYkbsOEU', 23, 15, 0, '2019-02-11 12:51:21', 1, '2019-02-11 12:58:48'),
(16, 'VWWLKQ4bF9SgChBZ', 2, 16, 0, '2019-02-11 17:23:20', 1, '2019-03-01 13:12:21'),
(17, '0NWE9dxMHNCzTqnO', 2, 17, 0, '2019-02-11 20:33:53', 1, '2019-02-21 22:42:21'),
(18, 'IvdPpqdtgaXsH8f3', 23, 18, 0, '2019-02-12 18:23:51', 1, '2019-02-12 18:24:08'),
(19, 'XYLScRgLslpITfXK', 70, 19, 0, '2019-03-06 11:37:45', 1, '2019-03-06 11:38:44'),
(20, '834OLD8LGbYackyr', 2, 20, 0, '2019-03-07 11:05:37', 1, '2019-03-11 12:01:02'),
(21, 'MZ1VhnNUDYBH5Rt9', 2, 21, 0, '2019-03-11 04:50:41', 1, '2019-03-11 11:49:07'),
(22, 'lQDEfwf56CkLJjS5', 2, 22, 1, '2019-03-11 10:43:02', 0, NULL),
(23, 'LOYK6pMx8JxdTJxG', 23, 23, 1, '2019-03-11 11:49:34', 0, NULL),
(24, 'GDP6TCq4W8FMtyWt', 23, 24, 0, '2019-03-11 12:01:20', 1, '2019-03-11 12:07:32'),
(25, 'lPpuAoUrVNbIg4H5', 2, 25, 0, '2019-03-12 14:09:49', 1, '2019-03-12 14:09:54'),
(26, 'Ol0MqkXWAOD4YbBU', 198, 26, 1, '2019-03-14 16:35:37', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_device`
--

CREATE TABLE `user_device` (
  `user_device_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `user_device_type` tinyint(1) NOT NULL COMMENT '1=ios,2=android,3=web',
  `user_device_unique_id` varchar(255) NOT NULL,
  `user_device_registered_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_device`
--

INSERT INTO `user_device` (`user_device_id`, `user_id`, `user_device_type`, `user_device_unique_id`, `user_device_registered_on`) VALUES
(1, 23, 2, 'dvSzvWtVD4c:APA91bGZ4zGc15MvasC2apsWhuXoAE0fOC2mS-qqhYQG3yz8Brn4Br8UxAxu7ArUIapkTBJ97lgJEMOVb6jV8wNEyWQg8ic0eVAfa8qUjWzcaw3RxF5fJSt9IV6NjjaOKHAi87qmN4ID', '2019-02-07 18:50:12'),
(2, 2, 1, 'eKjnO0Gs5bg:APA91bE-aZXrWqjn4YTm8A_tjin9XOIGZsRi1KrFC7Qg07n1HGjGPChI8npFHosvxILC9GsyIfPTJpGrsMiFrYfYhf0_Littcp_Yf7A6tbHD1-oB_eA51vnXfUCuXPDVq0HR1ugn6vQt', '2019-02-07 19:40:03'),
(3, 23, 1, 'ebD_kdUqhQk:APA91bGToSRumxHfuO9qrc--VcArn-PuNuFa4mM1MvoSjwIvg3Lp06aDAQj5g1AVnZliwJWHdPG9qCqgsIZLb3O3wvIFq5Y2DWFFXj3fbBKr0l_WXR52Vb7D7egYID1ILBGE3MO7vXwG', '2019-02-07 19:56:01'),
(4, 2, 1, 'ebD_kdUqhQk:APA91bGToSRumxHfuO9qrc--VcArn-PuNuFa4mM1MvoSjwIvg3Lp06aDAQj5g1AVnZliwJWHdPG9qCqgsIZLb3O3wvIFq5Y2DWFFXj3fbBKr0l_WXR52Vb7D7egYID1ILBGE3MO7vXwG', '2019-02-07 19:56:34'),
(5, 3, 2, 'ctpxcIn--9A:APA91bH6H5ppYrYBsnWvB5SNIcfa_ZtZAio1Cf7OzRVBpTJV91jXZfjbzSckuyhiH7_H8kadjKs2qutl_TCugN3CtsbbUBeys83i0kcMoqbXFPr1w23FJ7DcRgbV06uzNberXCJhVro6', '2019-02-07 20:58:59'),
(6, 3, 1, 'eerNCt2c5SY:APA91bFGeifOh1VOyxRU4r82y_cb6QrSgJstJaYJX9_0fATCuo__tt35FqBid6Jok0ZRhfE8MBQFVHBj-7RgqyBXsiMw1eeJHR_S0MswHBsgYf0sTPmlRXxSTexjcEnToRgI481a4YbL', '2019-02-07 21:03:54'),
(7, 2, 2, 'dvSzvWtVD4c:APA91bGZ4zGc15MvasC2apsWhuXoAE0fOC2mS-qqhYQG3yz8Brn4Br8UxAxu7ArUIapkTBJ97lgJEMOVb6jV8wNEyWQg8ic0eVAfa8qUjWzcaw3RxF5fJSt9IV6NjjaOKHAi87qmN4ID', '2019-02-08 16:30:57'),
(8, 23, 1, 'eKjnO0Gs5bg:APA91bE-aZXrWqjn4YTm8A_tjin9XOIGZsRi1KrFC7Qg07n1HGjGPChI8npFHosvxILC9GsyIfPTJpGrsMiFrYfYhf0_Littcp_Yf7A6tbHD1-oB_eA51vnXfUCuXPDVq0HR1ugn6vQt', '2019-02-08 17:10:57'),
(9, 2, 2, 'cGLDR-nqcQ8:APA91bFzTp-jGmH8pV5KOJ_qIN7V16OnrY9Va20Yh_7oF1wPo7Hy5snM62bMuihSpI7gpdiBGEgn8mEZ344zSztyGxD06ffCKhLCH94WtT7DJbuffei71FmKR-rhkVQYtTCc4MkIcrPr', '2019-02-08 17:41:56'),
(10, 2, 1, 'dMm1RDJEflQ:APA91bF4HJGYZNlWqMEOu894kSyojH_3YPGJlIIYZiRC7Z_JtcxOcow2-Cd226jLHThLsVdlqXWaPAFH_coElt-gdo1TSVcLR1io4T9l-Joig9KJwjFjG619lGRUFh2sKsHNgLahDYMM', '2019-02-11 11:30:56'),
(11, 23, 1, 'dMm1RDJEflQ:APA91bF4HJGYZNlWqMEOu894kSyojH_3YPGJlIIYZiRC7Z_JtcxOcow2-Cd226jLHThLsVdlqXWaPAFH_coElt-gdo1TSVcLR1io4T9l-Joig9KJwjFjG619lGRUFh2sKsHNgLahDYMM', '2019-02-11 11:50:43'),
(12, 23, 1, 'eHA8_EQJSSM:APA91bH_PYWaCE8LyIeG38DuJb0gUdj6cgMDWa-HKNIVq04S14sH-GCpLdqt8j-P8zQBTLMtFL283a4mbbthzLWbnxoEhbzEf7L2uuuPJy7J5dKm6vFORWUXVPr_hDE8IJ7XKjwRGjjN', '2019-02-11 11:53:08'),
(13, 2, 1, 'eHA8_EQJSSM:APA91bH_PYWaCE8LyIeG38DuJb0gUdj6cgMDWa-HKNIVq04S14sH-GCpLdqt8j-P8zQBTLMtFL283a4mbbthzLWbnxoEhbzEf7L2uuuPJy7J5dKm6vFORWUXVPr_hDE8IJ7XKjwRGjjN', '2019-02-11 11:53:49'),
(14, 2, 2, 'c7B08Hjoj9I:APA91bGjMEymg9DKyA77sAQKIv00yppe_Cw7JEpAAVd06EhYPiOoHbKIDEbolx4IolhZWBd3WpWjrLBHAkhfIXMtC1EcxvKuAex-pf8Q9poWvleitcApzy3IgQorCakh_OUz8TfcTTlI', '2019-02-11 12:13:18'),
(15, 23, 2, 'c7B08Hjoj9I:APA91bGjMEymg9DKyA77sAQKIv00yppe_Cw7JEpAAVd06EhYPiOoHbKIDEbolx4IolhZWBd3WpWjrLBHAkhfIXMtC1EcxvKuAex-pf8Q9poWvleitcApzy3IgQorCakh_OUz8TfcTTlI', '2019-02-11 12:51:21'),
(16, 2, 2, 'cpcU8lP_H8s:APA91bEUjBj8Lv8FZafKfC_QYgTAcMzVfaxGZCN1ts7xCKf_YarFLWJoEqkmecwv81p5QMzPRtbg5JxBwx00aCbU-Sln1FjvCE2d8filFh7_COuZJyu1BQhvtErFm_9_u93HQ4m-_6Zq', '2019-02-11 17:23:20'),
(17, 2, 2, 'df9xotYJ21w:APA91bEK2DZdDBCLFq8jtCAfp818CAkbM1GNi2Y03SXMS8ldzs9YKZ2TPEnp1KZxxlTRE5N0BMFC1HWEpLNElA9S2Pvq3BwpflVZq_omUwh8LKXR0XZahuk2gqHbt2Y1YxrLgaYE8Map', '2019-02-11 20:33:53'),
(18, 23, 2, 'cpcU8lP_H8s:APA91bEUjBj8Lv8FZafKfC_QYgTAcMzVfaxGZCN1ts7xCKf_YarFLWJoEqkmecwv81p5QMzPRtbg5JxBwx00aCbU-Sln1FjvCE2d8filFh7_COuZJyu1BQhvtErFm_9_u93HQ4m-_6Zq', '2019-02-12 18:23:51'),
(19, 70, 1, 'eHA8_EQJSSM:APA91bH_PYWaCE8LyIeG38DuJb0gUdj6cgMDWa-HKNIVq04S14sH-GCpLdqt8j-P8zQBTLMtFL283a4mbbthzLWbnxoEhbzEf7L2uuuPJy7J5dKm6vFORWUXVPr_hDE8IJ7XKjwRGjjN', '2019-03-06 11:37:45'),
(20, 2, 2, 'ezC1ZhnBijY:APA91bEz4KI9zs9gvTLMAGRzFItEeBiyUdmKsYV4lauwKGOALmFJAhzVxfSPel1hQEK6r4OYbJe_G0GK1eglyymz-ecXdAO60YmUwHaxN3yL1S8_M9yhLcSWvwK7UhHdJN1HMG93a_Qd', '2019-03-07 11:05:37'),
(21, 2, 1, 'fm1jLw9qdeU:APA91bENNxCRgHsXtoiooDB8HiJcRhYIiCVe_FwtWYdu9AYSfVWfmuljXPtAtOYyh2lf8rDJPxnGXzMzQecAHnVLGUl525XI6-Q0qVhv9l3UQ0NKXMlbbPpvLXocd3ldVh1dIdhDBnCh', '2019-03-11 04:50:41'),
(22, 2, 2, 'diGaMTgwJZw:APA91bHY-iTlmRVEc-MhWd7xyZYk3LsldmjAJjbZyl7y-k6iwUZ38OnhPj6-YLnmVAhaYMHmugO2OaxVeciVVtqhWok4ttgj182Z6FQAL3kRZtJGoLP-7jsJFmxCNXlVDGAKLm7mGQCd', '2019-03-11 10:43:02'),
(23, 23, 1, 'fm1jLw9qdeU:APA91bENNxCRgHsXtoiooDB8HiJcRhYIiCVe_FwtWYdu9AYSfVWfmuljXPtAtOYyh2lf8rDJPxnGXzMzQecAHnVLGUl525XI6-Q0qVhv9l3UQ0NKXMlbbPpvLXocd3ldVh1dIdhDBnCh', '2019-03-11 11:49:34'),
(24, 23, 2, 'ezC1ZhnBijY:APA91bEz4KI9zs9gvTLMAGRzFItEeBiyUdmKsYV4lauwKGOALmFJAhzVxfSPel1hQEK6r4OYbJe_G0GK1eglyymz-ecXdAO60YmUwHaxN3yL1S8_M9yhLcSWvwK7UhHdJN1HMG93a_Qd', '2019-03-11 12:01:20'),
(25, 2, 2, 'cw_-h0jpYxc:APA91bFF1j-DotDZfQTauDHx6mZKAWmmqWOWfg2VFTB7RmYevUwNed7v5C66j19GSvBdo39lOo5lj8vVljg0aXv3WhgW2DoooOcQ76ifCstYFsZs7Tzb4x2FHY3Gvcbj9cG-IG6YnRss', '2019-03-12 14:09:49'),
(26, 198, 1, 'fcdO72mLcgo:APA91bFw9RNGtJkoy7m0ekhrav5KJe0NM5z3DPQQ7QvIoyiQNSZ-iA5AfYLBU-4paYU87-SNxazBWhU0cFpR-9gy9cds6Cw0V0Q62yR7QnhJYhQ4y1zoPd8ulv_xdDFcByGcPZBmXg3o', '2019-03-14 16:35:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_forget_password_request`
--

CREATE TABLE `user_forget_password_request` (
  `user_forget_password_request_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `request_date` datetime DEFAULT NULL,
  `password_updated_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not updated 1=updated',
  `password_updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_forget_password_request`
--

INSERT INTO `user_forget_password_request` (`user_forget_password_request_id`, `users_id`, `request_date`, `password_updated_flag`, `password_updated_date`) VALUES
(1, 1, '2019-01-07 09:40:39', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

CREATE TABLE `user_reviews` (
  `user_review_id` int(10) NOT NULL,
  `from_user_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `to_user_id` int(10) NOT NULL,
  `user_review_ratings` decimal(6,1) DEFAULT '0.0',
  `user_review_comments` varchar(100) DEFAULT NULL,
  `user_review_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Inactive,1=Active,2=Blocked',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_reviews`
--

INSERT INTO `user_reviews` (`user_review_id`, `from_user_id`, `project_id`, `to_user_id`, `user_review_ratings`, `user_review_comments`, `user_review_status`, `created_at`, `updated_at`) VALUES
(1, 52, 7, 2, '0.0', 'Good app', 1, '2019-02-04 17:49:59', '2019-02-04 17:49:59'),
(2, 2, 7, 52, '4.0', 'nice one', 1, '2019-02-04 17:51:01', '2019-02-04 17:51:01'),
(3, 1, 10, 2, '0.0', 'nice app', 1, '2019-02-07 19:07:25', '2019-02-07 19:07:25'),
(4, 1, 8, 2, '0.0', 'this is good', 1, '2019-02-07 19:44:45', '2019-02-07 19:44:45'),
(5, 2, 8, 1, '4.0', 'Good app', 1, '2019-02-07 19:54:42', '2019-02-07 19:54:42'),
(6, 2, 3, 1, '3.5', 'nice', 1, '2019-03-11 05:59:38', '2019-03-11 05:59:38'),
(7, 2, 38, 1, '1.0', 'Add Review...', 1, '2019-03-11 06:13:07', '2019-03-11 06:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_scope_performed`
--

CREATE TABLE `user_scope_performed` (
  `user_scope_performed_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `scope_performed_id` varchar(500) NOT NULL,
  `last_updated` datetime DEFAULT '0001-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_scope_performed`
--

INSERT INTO `user_scope_performed` (`user_scope_performed_id`, `users_id`, `scope_performed_id`, `last_updated`) VALUES
(1, 2, '5,4,3,2,1', '2018-12-27 10:59:26'),
(2, 3, '2', '2018-12-27 16:55:57'),
(3, 4, '2', '2018-12-27 17:01:44'),
(4, 5, '2', '2018-12-27 17:03:47'),
(5, 6, '1,2,5', '2018-12-27 22:49:44'),
(6, 7, '5', '2018-12-28 16:18:04'),
(7, 8, '5', '2018-12-28 16:18:14'),
(8, 9, '1,2,3,4,5', '2018-12-28 20:05:42'),
(9, 10, '2,1', '2018-12-28 20:06:04'),
(10, 11, '1,2,3,4,5', '2018-12-28 20:06:27'),
(11, 12, '5,4,3,2,1', '2018-12-28 20:10:21'),
(12, 14, '1,2', '2019-01-04 05:18:27'),
(13, 16, '2,1', '2019-01-09 16:03:12'),
(14, 17, '3,2', '2019-01-09 16:09:15'),
(15, 18, '4,3', '2019-01-09 16:13:14'),
(16, 19, '2,4,5', '2019-01-09 16:15:47'),
(17, 20, '5,1', '2019-01-09 16:22:18'),
(18, 21, '4,3,1', '2019-01-10 16:53:04'),
(19, 22, '1,2', '2019-01-14 05:35:38'),
(20, 23, '6,5,4,3,2,1', '2019-01-14 14:22:58'),
(21, 24, '5,3', '2019-01-15 07:00:30'),
(22, 25, '5,4,3,2,1', '2019-01-15 07:03:46'),
(23, 26, '1,2,4', '2019-01-15 13:44:55'),
(24, 27, '1,2', '2019-01-15 13:54:02'),
(25, 28, '1,2', '2019-01-15 13:58:30'),
(26, 29, '3', '2019-01-15 13:58:48'),
(27, 30, '1,2', '2019-01-15 14:03:22'),
(28, 31, '2,3', '2019-01-15 14:06:14'),
(29, 32, '1,2,4', '2019-01-15 14:09:41'),
(30, 33, '1,2', '2019-01-15 14:11:34'),
(31, 34, '4,3,1', '2019-01-15 14:22:55'),
(32, 36, '2,4', '2019-01-16 05:12:20'),
(33, 37, '5,4,3', '2019-01-16 05:27:28'),
(34, 38, '1,2,4', '2019-01-21 06:12:30'),
(35, 39, '1,2', '2019-01-22 05:10:27'),
(36, 40, '1,2,3', '2019-01-22 05:39:56'),
(37, 56, '1,2', '2019-02-08 10:15:45'),
(38, 68, '1,2,3,4,5,6,7,8', '2019-03-04 11:53:27'),
(39, 69, '3,6', '2019-03-05 11:49:44'),
(40, 70, '6,4,3,1', '2019-03-06 11:32:08'),
(41, 71, '4,2', '2019-03-06 11:35:09'),
(42, 198, '8,7,6,5,4,3,2,1', '2019-03-14 16:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `user_types_id` int(10) NOT NULL,
  `user_types` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`user_types_id`, `user_types`) VALUES
(1, 'Project Manager'),
(2, 'Associate'),
(3, 'Admin'),
(4, 'subAdmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_users_id`);

--
-- Indexes for table `api_generated_token`
--
ALTER TABLE `api_generated_token`
  ADD PRIMARY KEY (`api_generated_token_id`);

--
-- Indexes for table `associate_type`
--
ALTER TABLE `associate_type`
  ADD PRIMARY KEY (`associate_type_id`);

--
-- Indexes for table `email_verification`
--
ALTER TABLE `email_verification`
  ADD PRIMARY KEY (`email_verification_id`);

--
-- Indexes for table `progress_status_type`
--
ALTER TABLE `progress_status_type`
  ADD PRIMARY KEY (`progress_status_type_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `project_bids`
--
ALTER TABLE `project_bids`
  ADD PRIMARY KEY (`project_bid_id`);

--
-- Indexes for table `project_bid_request`
--
ALTER TABLE `project_bid_request`
  ADD PRIMARY KEY (`project_bid_request_id`);

--
-- Indexes for table `project_notification`
--
ALTER TABLE `project_notification`
  ADD PRIMARY KEY (`project_notification_id`);

--
-- Indexes for table `project_notification_type`
--
ALTER TABLE `project_notification_type`
  ADD PRIMARY KEY (`project_notification_type_id`);

--
-- Indexes for table `project_progress_status`
--
ALTER TABLE `project_progress_status`
  ADD PRIMARY KEY (`project_progress_status_id`);

--
-- Indexes for table `project_status`
--
ALTER TABLE `project_status`
  ADD PRIMARY KEY (`project_status_id`);

--
-- Indexes for table `project_type`
--
ALTER TABLE `project_type`
  ADD PRIMARY KEY (`project_type_id`);

--
-- Indexes for table `scope_performed`
--
ALTER TABLE `scope_performed`
  ADD PRIMARY KEY (`scope_performed_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `sys_language`
--
ALTER TABLE `sys_language`
  ADD PRIMARY KEY (`sys_language_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `user_access_key`
--
ALTER TABLE `user_access_key`
  ADD PRIMARY KEY (`user_access_key_id`);

--
-- Indexes for table `user_device`
--
ALTER TABLE `user_device`
  ADD PRIMARY KEY (`user_device_id`);

--
-- Indexes for table `user_forget_password_request`
--
ALTER TABLE `user_forget_password_request`
  ADD PRIMARY KEY (`user_forget_password_request_id`);

--
-- Indexes for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD PRIMARY KEY (`user_review_id`);

--
-- Indexes for table `user_scope_performed`
--
ALTER TABLE `user_scope_performed`
  ADD PRIMARY KEY (`user_scope_performed_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`user_types_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_users_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `api_generated_token`
--
ALTER TABLE `api_generated_token`
  MODIFY `api_generated_token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `associate_type`
--
ALTER TABLE `associate_type`
  MODIFY `associate_type_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_verification`
--
ALTER TABLE `email_verification`
  MODIFY `email_verification_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `progress_status_type`
--
ALTER TABLE `progress_status_type`
  MODIFY `progress_status_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `project_bids`
--
ALTER TABLE `project_bids`
  MODIFY `project_bid_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `project_bid_request`
--
ALTER TABLE `project_bid_request`
  MODIFY `project_bid_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=582;

--
-- AUTO_INCREMENT for table `project_notification`
--
ALTER TABLE `project_notification`
  MODIFY `project_notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `project_notification_type`
--
ALTER TABLE `project_notification_type`
  MODIFY `project_notification_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `project_progress_status`
--
ALTER TABLE `project_progress_status`
  MODIFY `project_progress_status_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project_status`
--
ALTER TABLE `project_status`
  MODIFY `project_status_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `project_type`
--
ALTER TABLE `project_type`
  MODIFY `project_type_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scope_performed`
--
ALTER TABLE `scope_performed`
  MODIFY `scope_performed_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `sys_language`
--
ALTER TABLE `sys_language`
  MODIFY `sys_language_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `user_access_key`
--
ALTER TABLE `user_access_key`
  MODIFY `user_access_key_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_device`
--
ALTER TABLE `user_device`
  MODIFY `user_device_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_forget_password_request`
--
ALTER TABLE `user_forget_password_request`
  MODIFY `user_forget_password_request_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_reviews`
--
ALTER TABLE `user_reviews`
  MODIFY `user_review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_scope_performed`
--
ALTER TABLE `user_scope_performed`
  MODIFY `user_scope_performed_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `user_types_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
