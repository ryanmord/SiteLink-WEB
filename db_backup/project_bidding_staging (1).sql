-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 05, 2019 at 01:27 PM
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
(25, '3ZR7Bhea', 1, '2019-03-01 00:43:29'),
(26, 'Z1i3DLzB', 1, '2019-03-01 01:51:20'),
(27, '57qNJuq5', 1, '2019-03-01 01:52:34'),
(28, 'His9VsiI', 1, '2019-03-01 01:53:24'),
(29, 'MQEsGTI7', 1, '2019-03-01 02:02:33'),
(30, 'BqSiH0YC', 1, '2019-03-01 03:22:16'),
(31, 'hquqLa2l', 1, '2019-03-01 03:33:03'),
(32, '3BFdPCyH', 1, '2019-03-01 15:14:48');

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
  `user_id` int(10) NOT NULL COMMENT 'Scheduler Id',
  `project_name` varchar(100) NOT NULL,
  `project_site_address` varchar(255) NOT NULL,
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

INSERT INTO `projects` (`project_id`, `user_id`, `project_name`, `project_site_address`, `latitude`, `longitude`, `milesrange`, `on_site_date`, `report_due_date`, `report_template`, `scope_performed_id`, `employee_type_id`, `instructions`, `approx_bid`, `budget`, `property_type`, `no_of_units`, `squareFootage`, `no_of_buildings`, `no_of_stories`, `year_built`, `qaqc_date`, `created_by`, `land_area`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sara orchid', 'Hinjewadi Rajiv Gandhi Infotech Park, Hinjawadi, Pune, Maharashtra, India', '18.5946784', '73.70953650000001', 205, '2019-04-28 00:00:00', '2019-05-31 00:00:00', 'quire', '1,2', '1', 'It is special instructions', 250.50, 565.25, 'multiFamily', 54, 5400.20, 5, 25, 2018, NULL, 2, 5445.00000, '2019-02-04 11:59:53', '2019-02-04 11:59:53'),
(2, 52, 'demo project5', 'Wakad Chowk, Wakad, Pimpri-Chinchwad, Maharashtra', '18.592407', '73.76171799999997', 38, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', '1,2', 'it is instruction', 4500.00, 5440.20, 'familyflat', 5, 5424.57, 8, 86, 1999, '2019-03-04 00:00:00', 1, 5.23000, '2019-02-04 12:16:14', '2019-02-04 13:33:53'),
(3, 1, 'Surya Tower project1', 'Wakad Chowk, Wakad, Pimpri-Chinchwad, Maharashtra', '18.592407', '73.76171799999997', 120, '2019-02-06 00:00:00', '2019-02-06 00:00:00', 'new template', '1,2', '1,2,3', 'building purpose', 4500.00, 600.00, 'Multipurpose', 30, 444.00, 8, 15, 2019, NULL, 2, 222.22000, '2019-02-04 12:56:38', '2019-02-04 15:15:43'),
(4, 52, 'test project2', 'Sr. No 106/2/10/1, Baner Road, Opposite Hotel Sadanand Near Amar Busniness Park, Laxman Nagar, Baner, Pune, Maharashtra 411045, India', '18.568296999999998', '73.768467', 220, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', '1,2,3', 'it is instruction', 4500.00, 5440.20, 'familyflat', 5, 5424.57, 8, 86, 1999, '2019-03-04 00:00:00', 1, 5.23000, '2019-02-04 14:55:00', '2019-02-04 14:58:35'),
(5, 1, 'Surya Tower project1', 'Wakad, Pimpri-Chinchwad, Maharashtra, India', '18.5989428', '73.76527149999993', 345, '2019-02-08 00:00:00', '2019-02-08 00:00:00', 'new template', '1,2,3', '1,2,3', NULL, 6700.00, 6750.00, 'new project', 55, 45.00, 14, 15, 20, NULL, 2, 4567.89000, '2019-02-04 15:15:48', '2019-02-04 15:15:48'),
(6, 1, 'Light House city', 'Wakad, Shankar Kalat Nagar, Wakad, Pimpri-Chinchwad, Maharashtra', '18.592455', '73.76152400000001', 302, '2019-02-06 00:00:00', '2019-02-05 00:00:00', 'new template', '1,2,3,4,5', '1,2,3', 'new project Instruction', 4999.00, 5999.00, 'Multipurpose', 1, 1.00, 1, 1, 2018, NULL, 2, 1.00000, '2019-02-04 15:49:57', '2019-02-11 11:12:40'),
(7, 52, 'test project', 'Wakad Chowk, Wakad, Pimpri-Chinchwad, Maharashtra', '18.592407', '73.76171799999997', 320, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', '1,2,3', 'it is instruction', 5400.00, 5440.20, 'familyflat', 5, 5424.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-04 16:16:03', '2019-02-04 17:17:43'),
(8, 1, 'Saikrupa heights', 'Wakad Road, Wakad, Maharashtra, India', '19.240791', '77.57307079999998', 300, '2019-02-07 00:00:00', '2019-02-08 00:00:00', 'Template Generated', '1,2,3', '1,2,3', 'It is building', 4250.00, 4350.00, 'sample project', 14, 45.00, 4, 15, 2018, NULL, 2, 222.24000, '2019-02-04 16:27:10', '2019-02-04 17:12:54'),
(9, 1, 'light House tower1', 'Wakad, Pimpri-Chinchwad, Maharashtra, India', '18.5989428', '73.76527149999993', 230, '2019-02-22 00:00:00', '2019-02-21 00:00:00', 'new template', '1,2,3', '1,2,3', 'new project Instruction1', 4000.00, 2500.00, 'new project', 35, 40.56, 3, 8, 2018, NULL, 2, 3500.44000, '2019-02-04 17:08:13', '2019-02-04 17:12:37'),
(10, 1, 'Saikrupa Avenue', 'Wakad, Shankar Kalat Nagar, Wakad, Pimpri-Chinchwad, Maharashtra', '18.592455', '73.76152400000001', 244, '2019-02-16 00:00:00', '2019-02-15 00:00:00', 'this is new report template developed', '1,2,3', '1,2,3', 'new project Instruction', 4000.00, 4350.00, 'sample project', 14, 444.00, 8, 5, 2017, NULL, 2, 4567.89000, '2019-02-04 17:15:19', '2019-02-04 17:15:19'),
(11, 52, 'API Test Project', '1234 Maple Lane, Minneapolis, MN 55426', '18.2222', '75.0221', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'Template', 'ECA', NULL, 'Special Instructions', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 20:55:30', '2019-02-06 20:55:30'),
(12, 52, 'API Test Project 2', 'Minneapolis, MN', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'Template', 'ECA', NULL, 'Special Instructions', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 20:58:07', '2019-02-06 20:58:07'),
(13, 52, 'API Test Project 3', 'Minneapolis, MN', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'Template', 'PCA', NULL, 'Special Instructions', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 21:02:24', '2019-02-06 21:02:24'),
(14, 52, 'API Test Project 4', 'Minneapolis, MN', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'Template', '1', NULL, 'Special Instructions', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 21:07:08', '2019-02-06 21:07:08'),
(15, 52, 'UPDATED PROJECT', 'Minneapolis, MN', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'UPDATE: Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 21:20:13', '2019-02-06 22:35:11'),
(16, 52, 'Bens Project', 'Chaska', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-06 23:39:46', '2019-02-06 23:39:46'),
(17, 52, 'Bens Project', 'Chaska', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:48:41', '2019-02-07 01:48:41'),
(18, 52, 'Bens Project', 'Chaska', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:48:47', '2019-02-07 01:48:47'),
(19, 52, 'Bens Project', 'Chaska', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:49:08', '2019-02-07 01:49:08'),
(20, 54, 'Bens Project', 'Chaska', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:49:21', '2019-02-07 01:49:21'),
(21, 52, 'Bens Project', 'Chaska', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:49:29', '2019-02-07 01:49:29'),
(22, 52, 'Bens Project', 'Chaska', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:49:49', '2019-02-07 01:49:49'),
(23, 52, 'Bens Project', 'Chaska', '44.9778', '93.2650', 216, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', '1,2,3', 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', 5000.00, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 01:51:00', '2019-02-08 17:42:21'),
(24, 52, 'Test Ryan', 'Chaska', '44.9778', '93.2650', 129, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', '2', 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', 1000.00, 10000.00, 'Property Type', 100, 10000000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-07 02:18:10', '2019-02-07 21:00:04'),
(25, 57, 'update project', 'Wakad Chowk, Wakad, Pimpri-Chinchwad, Maharashtra', '18.592407', '73.76171799999997', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', NULL, 'it is instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-11 15:25:58', '2019-02-11 15:28:46'),
(26, 52, 'Test Ryan', 'Minneapolis, MN', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '1', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-11 19:38:17', '2019-02-11 19:38:17'),
(27, 52, 'Test Ryan', 'Minneapolis, MN', '44.9778', '93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '2', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-11 19:38:48', '2019-02-11 19:38:48'),
(29, 52, 'sara Orchid', 'Chinchwad Gaon, Gandhi Peth, Prabhat Colony, Chinchwad Gaon, Chinchwad, Pimpri-Chinchwad, Maharashtra', '18.62789', '73.78235999999993', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', NULL, 'it is instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-12 12:21:14', '2019-02-12 12:24:09'),
(30, 52, 'Live List Test', '1 Twins Way, Minneapolis, MN 55403', '44.979389', '-93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '2', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-12 19:16:15', '2019-02-12 19:16:15'),
(31, 60, 'Another Twins Test', '1 Twins Way, Minneapolis, MN 55403', '44.979389', '-93.2650', NULL, '2019-01-01 00:00:01', '2019-01-02 00:00:01', 'An Updated Template', '2', NULL, 'Special Instructions to see how they wrap when the text gets long la la la this is long text to see how text wrapping works on the new release', NULL, 10000.00, 'Property Type', 100, 100000.00, 40, 2, 1945, NULL, 1, 4.20000, '2019-02-12 20:56:43', '2019-02-12 20:57:11'),
(32, 52, 'sara Orchid', 'Chinchwad Gaon, Gandhi Peth, Prabha\nt Colony, Chinchwad Gaon, Chinchwad, Pimpri-Chinchwad, Maharashtr\na', '18.62789', '73.78235999999993', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', NULL, 'it i\ns instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-20 21:32:38', '2019-02-20 21:32:38'),
(33, 64, 'sara Orchid', 'Chinchwad Gaon, Gandhi Peth, Prabha\nt Colony, Chinchwad Gaon, Chinchwad, Pimpri-Chinchwad, Maharashtr\na', '18.62789', '73.78235999999993', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', NULL, 'it i\ns instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-20 21:32:59', '2019-02-20 21:32:59'),
(34, 64, 'TwinsWork', '1 Twins Way, Minneapolis, MN  55403', '44.975662764', '-93.273665572', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '1,2,3', NULL, 'it i\ns instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-20 21:34:13', '2019-02-20 21:34:13'),
(35, 64, 'TwinsWork', '1 Twins Way, Minneapolis, MN  55403', '44.975662764', '-93.273665572', NULL, '2019-01-23 06:10:08', '2019-01-17 00:00:00', 'Quire', '2', NULL, 'it i\ns instruction', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 86, 1999, NULL, 1, 5.23000, '2019-02-20 21:34:46', '2019-02-20 21:34:46'),
(36, 66, 'test project2', '124 any street, city, st 55555', '19.592407', '74.76171799999997', NULL, '2019-03-02 08:30:52', '2019-03-17 12:30:52', 'Quire2', '3,1', NULL, 'special instructions go here2', NULL, 25440.20, 'familyflat2', 52, 2524.57, 82, 122, 1992, NULL, 1, 7.00000, '2019-02-28 22:22:42', '2019-03-01 03:22:16'),
(37, 65, 'test project', '123 any street, city, st 55555', '18.592407', '73.76171799999997', NULL, '2019-03-01 08:30:52', '2019-03-14 12:30:52', 'Quire', '3,1,5', NULL, 'special instructions go here', NULL, 5440.20, 'familyflat', 5, 5524.57, 8, 12, 1999, NULL, 1, 7.00000, '2019-03-01 02:02:33', '2019-03-01 02:02:33'),
(38, 1, 'Sara orchid2', 'Chinchwad, Maharashtra, India', '18.6297811', '73.79970939999998', 305, '2019-03-26 00:00:00', '2019-03-27 00:00:00', 'quire', '1,2', '1,2,3', 'It is special instructions', 250.50, 565.25, 'multiFamily', 54, 5400.20, 5, 25, 2018, NULL, 2, 5445.00000, '2019-03-04 12:29:32', '2019-03-04 12:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `project_bids`
--

CREATE TABLE `project_bids` (
  `project_bid_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL COMMENT 'Associate id',
  `associate_suggested_bid` double(10,2) NOT NULL,
  `project_bid_status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '0=Rejected,1=Approved,2=Pending',
  `created_at` datetime DEFAULT NULL,
  `accepted_rejected_at` datetime DEFAULT NULL,
  `bid_status` tinyint(1) DEFAULT '0' COMMENT '0-invalid,1=valid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_bids`
--

INSERT INTO `project_bids` (`project_bid_id`, `project_id`, `user_id`, `associate_suggested_bid`, `project_bid_status`, `created_at`, `accepted_rejected_at`, `bid_status`) VALUES
(1, 7, 2, 5000.00, 1, '2019-02-04 17:25:06', '2019-02-04 17:25:32', 1),
(2, 10, 2, 4500.00, 1, '2019-02-04 18:42:48', '2019-02-07 19:05:27', 1),
(3, 8, 2, 4500.00, 1, '2019-02-07 19:40:39', '2019-02-07 19:42:20', 1),
(4, 9, 2, 4000.00, 1, '2019-02-07 19:46:15', '2019-02-07 19:46:33', 1),
(5, 5, 2, 2580.00, 1, '2019-02-07 19:47:28', '2019-02-07 19:47:50', 1),
(6, 3, 2, 250.00, 1, '2019-02-07 19:51:18', '2019-02-07 19:51:33', 1),
(7, 4, 2, 23356.00, 1, '2019-02-07 19:51:54', '2019-02-07 19:52:27', 1),
(8, 2, 2, 2580.00, 1, '2019-02-07 20:00:38', '2019-02-07 20:01:56', 1),
(9, 24, 3, 1000.00, 1, '2019-02-07 21:18:17', '2019-02-07 21:18:49', 1),
(10, 23, 2, 4000.00, 2, '2019-02-08 17:43:58', NULL, 1),
(11, 6, 2, 2356.00, 2, '2019-02-11 13:02:08', NULL, 1);

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
(1, 1, 14, 1, 0, 0, 0, 1, '2019-02-04 11:59:54'),
(3, 1, 39, 1, 0, 0, 0, 1, '2019-02-04 11:59:54'),
(13, 52, 2, 2, 0, 0, 1, 1, '2019-02-04 13:33:36'),
(16, 52, 2, 4, 0, 0, 0, 1, '2019-02-04 14:57:26'),
(18, 1, 2, 3, 0, 0, 0, 1, '2019-02-04 15:15:43'),
(19, 1, 14, 3, 0, 0, 0, 1, '2019-02-04 15:15:43'),
(20, 1, 38, 3, 0, 0, 0, 1, '2019-02-04 15:15:43'),
(21, 1, 39, 3, 0, 0, 0, 1, '2019-02-04 15:15:43'),
(22, 1, 2, 5, 0, 0, 0, 1, '2019-02-04 15:15:48'),
(28, 1, 2, 9, 0, 0, 0, 1, '2019-02-04 17:12:37'),
(29, 1, 2, 8, 0, 0, 0, 1, '2019-02-04 17:12:55'),
(30, 1, 2, 10, 0, 0, 0, 1, '2019-02-04 17:15:19'),
(38, 52, 2, 7, 0, 0, 0, 1, '2019-02-04 17:17:35'),
(43, 52, 11, 16, 0, 0, 1, 0, '2019-02-07 01:25:03'),
(44, 52, 20, 16, 0, 0, 1, 0, '2019-02-07 01:25:07'),
(45, 52, 9, 16, 0, 0, 1, 0, '2019-02-07 01:25:09'),
(46, 52, 3, 24, 0, 0, 1, 1, '2019-02-07 20:59:54'),
(106, 52, 2, 23, 0, 0, 0, 0, '2019-02-08 19:04:22'),
(108, 52, 14, 23, 0, 0, 1, 0, '2019-02-08 19:04:26'),
(109, 1, 2, 6, 0, 0, 0, 1, '2019-02-11 11:12:41'),
(122, 52, 2, 14, 0, 0, 0, 0, '2019-02-11 19:36:14'),
(128, 52, 2, 26, 0, 0, 0, 0, '2019-02-11 19:38:35'),
(177, 52, 2, 22, 0, 0, 0, 0, '2019-02-12 14:58:04'),
(179, 52, 14, 22, 0, 0, 1, 0, '2019-02-12 14:58:12'),
(180, 52, 38, 22, 0, 1, 0, 0, '2019-02-12 14:58:14'),
(343, 60, 3, 31, 0, 0, 0, 0, '2019-02-19 19:53:52'),
(344, 60, 9, 31, 0, 1, 0, 0, '2019-02-19 19:53:52'),
(345, 60, 10, 31, 0, 0, 0, 0, '2019-02-19 19:53:52'),
(346, 60, 12, 31, 0, 0, 0, 0, '2019-02-19 19:53:52'),
(347, 60, 16, 31, 0, 0, 0, 0, '2019-02-19 19:53:52'),
(348, 60, 17, 31, 0, 0, 0, 0, '2019-02-19 19:53:52'),
(349, 60, 19, 31, 0, 0, 0, 0, '2019-02-19 19:53:52'),
(350, 60, 2, 31, 0, 0, 1, 0, '2019-02-19 19:58:10'),
(351, 60, 39, 31, 0, 0, 1, 0, '2019-02-19 19:58:12'),
(405, 52, 2, 18, 0, 0, 0, 0, '2019-02-28 20:31:36'),
(407, 1, 23, 1, 0, 0, 0, 0, '2019-03-04 11:54:37'),
(408, 1, 23, 6, 0, 0, 0, 0, '2019-03-04 11:54:37'),
(409, 1, 68, 6, 0, 0, 0, 0, '2019-03-04 12:03:12'),
(410, 1, 23, 38, 0, 0, 0, 1, '2019-03-04 12:29:33'),
(411, 1, 40, 38, 0, 0, 0, 1, '2019-03-04 12:29:33'),
(412, 1, 68, 38, 0, 0, 0, 1, '2019-03-04 12:29:33'),
(413, 1, 14, 38, 0, 0, 0, 1, '2019-03-04 12:45:24'),
(414, 1, 38, 38, 0, 0, 0, 1, '2019-03-04 12:45:24'),
(415, 1, 39, 38, 0, 0, 0, 1, '2019-03-04 12:45:24');

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
(3, 1, 1, 'New project listed in your area!', 1, 23, 1, '2019-02-04 11:59:54', '2019-02-07 19:46:41'),
(4, 1, 1, 'New project listed in your area!', 1, 39, 0, '2019-02-04 11:59:54', NULL),
(5, 15, 3, 'New project assigned to you!', 1, 1, 0, '2019-02-04 12:56:38', NULL),
(6, 1, 3, 'New project listed in your area!', 1, 23, 0, '2019-02-04 12:56:38', NULL),
(7, 1, 3, 'New project listed in your area!', 1, 2, 1, '2019-02-04 12:56:38', '2019-02-11 20:35:19'),
(8, 6, 3, 'Scheduler updated project details', 1, 1, 0, '2019-02-04 13:29:18', NULL),
(9, 6, 3, 'Scheduler updated project details', 1, 23, 0, '2019-02-04 13:29:18', NULL),
(10, 6, 3, 'Scheduler updated project details', 1, 2, 1, '2019-02-04 13:29:18', '2019-02-11 20:34:59'),
(11, 1, 2, 'New project listed in your area!', 52, 23, 1, '2019-02-04 13:33:53', '2019-02-07 19:44:54'),
(12, 1, 2, 'New project listed in your area!', 52, 2, 1, '2019-02-04 13:33:53', '2019-02-11 20:34:57'),
(13, 6, 3, 'Scheduler updated project details', 1, 1, 0, '2019-02-04 13:38:04', NULL),
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
(102, 7, 4, 'Project completed by manager!', 52, 2, 0, '2019-03-04 18:38:08', NULL);

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
(102, 14, '2019-03-04 18:38:08');

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
(5, 2, 2, 'Job Complete', 'Shdbfh', '2019-02-15 22:11:55', '2019-02-15 22:11:55');

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
(14, 11, 7, '2019-02-06 20:55:30'),
(15, 12, 7, '2019-02-06 20:58:07'),
(16, 13, 7, '2019-02-06 21:02:24'),
(17, 14, 7, '2019-02-06 21:07:08'),
(18, 15, 7, '2019-02-06 21:20:13'),
(19, 16, 7, '2019-02-06 23:39:46'),
(20, 17, 7, '2019-02-07 01:48:41'),
(21, 18, 7, '2019-02-07 01:48:47'),
(22, 19, 7, '2019-02-07 01:49:08'),
(23, 20, 7, '2019-02-07 01:49:21'),
(24, 21, 7, '2019-02-07 01:49:29'),
(25, 22, 7, '2019-02-07 01:49:49'),
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
(46, 25, 7, '2019-02-11 15:25:58'),
(47, 26, 7, '2019-02-11 19:38:17'),
(48, 27, 7, '2019-02-11 19:38:48'),
(50, 29, 7, '2019-02-12 12:21:14'),
(51, 30, 7, '2019-02-12 19:16:15'),
(52, 31, 7, '2019-02-12 20:56:43'),
(53, 32, 7, '2019-02-20 21:32:38'),
(54, 33, 7, '2019-02-20 21:32:59'),
(55, 34, 7, '2019-02-20 21:34:13'),
(56, 35, 7, '2019-02-20 21:34:46'),
(57, 36, 7, '2019-02-28 22:22:42'),
(58, 37, 7, '2019-03-01 02:02:33'),
(59, 38, 1, '2019-03-04 12:29:32'),
(60, 2, 4, '2019-03-04 17:42:16'),
(61, 4, 4, '2019-03-04 18:38:08');

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
(1, 1, NULL, 'Suvarna', 'Shinde', '1551786276-s.jpeg', 'Magneto', 'suvarnashinde.magneto@gmail.com', '$2y$10$dDTTvVuSLWGGDsir1LgIrOOXpYHEe9r4Z0Quap2DBBRBpPVAyL7H2', '+1 (254) 878 7676', NULL, NULL, NULL, NULL, 1, '2018-12-27 10:56:44', '2019-03-05 17:14:36', 1, 1, 2, NULL, NULL),
(2, 2, 3, 'Swati', 'Bhor', '1551786339-nature2.jpeg', 'Magneto pvt ltd', 'swatibhor.magneto@gmail.com', '$2y$10$eYSUlSdXeqAhR35ZpwliX.Tzqw/u1UVotkttLf9ATLK.ZyooYdEaO', '+1 (798) 959 5595', 'zhshz', '44.9778', '93.2650', NULL, 1, '2018-12-27 10:59:26', '2019-03-05 17:15:40', 1, 1, 1, 1, '2018-12-27 11:00:53'),
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
(52, 1, NULL, 'Suvarna', 'Shinde', 'default.png', 'magneto', 'suvarnashinde0395@gmail.com', '$2y$10$lOwF7kUp5VBS0/850aM.tOT/OKC1.0pFIg8wNC1DBhx8RRmEmTrG2', ' +1 66 587 54', NULL, NULL, NULL, NULL, 1, '2019-01-29 13:23:14', '2019-01-29 13:31:53', 1, 1, 2, NULL, NULL),
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
(69, 2, 3, 'Monika', 'Jadhav', 'default.png', 'Magneto', 'rohitsankpal.magnet+test3@gmail.com', '$2y$10$inzAE.XWaDvB65tiX3OSOu5ujK3YTxKfrdD.cL/OWkLU4gq./B6tK', '+1 (854) 949 6446', 'Behind Balewadi Stadium, Nande - Balewadi Rd, Pune, Maharashtra 410501, India', '18.5681087', '73.7390722', NULL, 1, '2019-03-05 11:49:44', '2019-03-05 12:30:35', 0, 1, 1, 1, '2019-03-05 12:30:35');

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
(12, 'eMvYW1mRKUlcWQHs', 23, 12, 0, '2019-02-11 11:53:08', 1, '2019-02-11 13:18:53'),
(13, 'FKgst1Pogih3VwGo', 2, 13, 0, '2019-02-11 11:53:49', 1, '2019-02-11 13:06:32'),
(14, 'CTbPpWOtwINWhMOd', 2, 14, 1, '2019-02-11 12:13:18', 0, '2019-02-11 12:50:39'),
(15, '23DOBefgnYkbsOEU', 23, 15, 0, '2019-02-11 12:51:21', 1, '2019-02-11 12:58:48'),
(16, 'VWWLKQ4bF9SgChBZ', 2, 16, 0, '2019-02-11 17:23:20', 1, '2019-03-01 13:12:21'),
(17, '0NWE9dxMHNCzTqnO', 2, 17, 0, '2019-02-11 20:33:53', 1, '2019-02-21 22:42:21'),
(18, 'IvdPpqdtgaXsH8f3', 23, 18, 0, '2019-02-12 18:23:51', 1, '2019-02-12 18:24:08');

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
(18, 23, 2, 'cpcU8lP_H8s:APA91bEUjBj8Lv8FZafKfC_QYgTAcMzVfaxGZCN1ts7xCKf_YarFLWJoEqkmecwv81p5QMzPRtbg5JxBwx00aCbU-Sln1FjvCE2d8filFh7_COuZJyu1BQhvtErFm_9_u93HQ4m-_6Zq', '2019-02-12 18:23:51');

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
(5, 2, 8, 1, '4.0', 'Good app', 1, '2019-02-07 19:54:42', '2019-02-07 19:54:42');

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
(1, 2, '1, 2, 3', '2018-12-27 10:59:26'),
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
(39, 69, '3,6', '2019-03-05 11:49:44');

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
  MODIFY `api_generated_token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `project_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `project_bids`
--
ALTER TABLE `project_bids`
  MODIFY `project_bid_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `project_bid_request`
--
ALTER TABLE `project_bid_request`
  MODIFY `project_bid_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT for table `project_notification`
--
ALTER TABLE `project_notification`
  MODIFY `project_notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `project_notification_type`
--
ALTER TABLE `project_notification_type`
  MODIFY `project_notification_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `project_progress_status`
--
ALTER TABLE `project_progress_status`
  MODIFY `project_progress_status_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_status`
--
ALTER TABLE `project_status`
  MODIFY `project_status_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

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
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `user_access_key`
--
ALTER TABLE `user_access_key`
  MODIFY `user_access_key_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_device`
--
ALTER TABLE `user_device`
  MODIFY `user_device_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_forget_password_request`
--
ALTER TABLE `user_forget_password_request`
  MODIFY `user_forget_password_request_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_reviews`
--
ALTER TABLE `user_reviews`
  MODIFY `user_review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_scope_performed`
--
ALTER TABLE `user_scope_performed`
  MODIFY `user_scope_performed_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `user_types_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
