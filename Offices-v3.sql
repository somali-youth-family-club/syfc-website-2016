-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 16, 2016 at 02:11 AM
-- Server version: 5.6.28
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wordpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'A WordPress Commenter', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2016-10-15 19:15:14', '2016-10-15 19:15:14', 'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href="https://gravatar.com">Gravatar</a>.', 0, '1', '', '', 0, 0),
(2, 1, 'salimovsky', 'salim.addi@gmail.com', '', '::1', '2016-10-15 19:48:22', '2016-10-15 19:48:22', 'cool!', 0, '1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:49.0) Gecko/20100101 Firefox/49.0', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE `wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 5, '_edit_last', '1'),
(3, 5, '_edit_lock', '1476576498:1'),
(4, 5, 'syafc_office_address', '19550 International Blvd, B106, SeaTac WA, 98188'),
(5, 5, 'syafc_office_phone', '425 207-8297'),
(6, 5, 'syafc_office_hours', '9 AM - 5 PM Monday-Friday'),
(8, 7, '_edit_last', '1'),
(9, 7, '_edit_lock', '1476575450:1'),
(10, 7, 'syafc_office_address', '13445 Martin Luther King Jr Way S, Seattle, WA 98178'),
(11, 7, 'syafc_office_phone', '206 779-0138'),
(12, 7, 'syafc_office_hours', '9 AM - 5 PM Monday-Friday'),
(13, 7, 'syafc_office_extras', 'After school program Mon-Tu 6pm-8pm\r\nEarly learning program Friday morning 10am-1pm'),
(14, 8, '_edit_last', '1'),
(15, 8, '_edit_lock', '1476575442:1'),
(16, 8, 'syafc_office_address', '3725 Pine Ridge apartments SeaTac WA,98188'),
(17, 8, 'syafc_office_phone', '206 246-5443'),
(18, 8, 'syafc_office_hours', '9 AM - 5 PM Monday-Friday'),
(19, 8, 'syafc_office_extras', 'After school program Mon-Thu 4pm-6pm\r\nFax: 206 242-4203'),
(20, 9, '_edit_last', '1'),
(21, 9, '_edit_lock', '1476575432:1'),
(22, 9, 'syafc_office_address', '7054 32nd Ave S Office #4 Seattle, WA 98118'),
(23, 9, 'syafc_office_phone', '206 779-0138'),
(24, 9, 'syafc_office_hours', '11 AM - 5 PM Mondays & Thursdays'),
(27, 5, 'syafc_office_services', '3'),
(28, 5, 'syafc_office_services', '24'),
(29, 5, 'syafc_office_services', '12'),
(30, 5, 'syafc_office_services', '14'),
(31, 5, 'syafc_office_services', '7'),
(32, 5, 'syafc_office_services', '8'),
(33, 5, 'syafc_office_services', '26'),
(34, 5, 'syafc_office_services', '4'),
(35, 5, 'syafc_office_services', '15'),
(36, 5, 'syafc_office_services', '17'),
(37, 5, 'syafc_office_services', '16'),
(38, 5, 'syafc_office_services', '18'),
(39, 5, 'syafc_office_services', '23'),
(40, 5, 'syafc_office_services', '21'),
(41, 5, 'syafc_office_services', '25'),
(42, 5, 'syafc_office_services', '19'),
(43, 5, 'syafc_office_services', '20'),
(44, 5, 'syafc_office_services', '22'),
(45, 5, 'syafc_office_services', '27'),
(46, 5, 'syafc_office_services', '28'),
(47, 7, 'syafc_office_services', '12'),
(48, 7, 'syafc_office_services', '5'),
(49, 7, 'syafc_office_services', '13'),
(50, 7, 'syafc_office_services', '6'),
(51, 7, 'syafc_office_services', '9'),
(52, 7, 'syafc_office_services', '11'),
(53, 7, 'syafc_office_services', '10'),
(54, 7, 'syafc_office_services', '14'),
(55, 7, 'syafc_office_services', '7'),
(56, 7, 'syafc_office_services', '8'),
(57, 7, 'syafc_office_services', '4'),
(58, 7, 'syafc_office_services', '15'),
(59, 7, 'syafc_office_services', '16'),
(60, 7, 'syafc_office_services', '17'),
(61, 7, 'syafc_office_services', '3'),
(62, 7, 'syafc_office_services', '18'),
(63, 7, 'syafc_office_services', '23'),
(64, 7, 'syafc_office_services', '26'),
(65, 7, 'syafc_office_services', '21'),
(66, 7, 'syafc_office_services', '25'),
(67, 7, 'syafc_office_services', '19'),
(68, 7, 'syafc_office_services', '20'),
(69, 7, 'syafc_office_services', '22'),
(70, 8, 'syafc_office_services', '12'),
(71, 8, 'syafc_office_services', '5'),
(72, 8, 'syafc_office_services', '13'),
(73, 8, 'syafc_office_services', '6'),
(74, 8, 'syafc_office_services', '9'),
(75, 8, 'syafc_office_services', '11'),
(76, 8, 'syafc_office_services', '10'),
(77, 8, 'syafc_office_services', '14'),
(78, 8, 'syafc_office_services', '7'),
(79, 8, 'syafc_office_services', '8'),
(80, 8, 'syafc_office_services', '4'),
(81, 8, 'syafc_office_services', '15'),
(82, 8, 'syafc_office_services', '16'),
(83, 8, 'syafc_office_services', '17'),
(84, 8, 'syafc_office_services', '3'),
(85, 8, 'syafc_office_services', '18'),
(86, 8, 'syafc_office_services', '23'),
(87, 8, 'syafc_office_services', '26'),
(88, 8, 'syafc_office_services', '21'),
(89, 8, 'syafc_office_services', '25'),
(90, 8, 'syafc_office_services', '19'),
(91, 8, 'syafc_office_services', '20'),
(92, 8, 'syafc_office_services', '22'),
(93, 9, 'syafc_office_services', '7'),
(94, 9, 'syafc_office_services', '8'),
(95, 10, '_edit_last', '1'),
(96, 10, 'syafc_office_address', '1229 W Smith St, Kent, WA 98032'),
(97, 10, 'syafc_office_phone', '206 779-0138'),
(98, 10, 'syafc_office_hours', '9 AM - 5 PM Monday-Friday'),
(99, 10, 'syafc_office_services', '5'),
(100, 10, 'syafc_office_services', '13'),
(101, 10, 'syafc_office_services', '6'),
(102, 10, 'syafc_office_services', '9'),
(103, 10, 'syafc_office_services', '11'),
(104, 10, 'syafc_office_services', '10'),
(105, 10, 'syafc_office_services', '3'),
(106, 10, 'syafc_office_extras', 'Will open November 1st, 2016'),
(107, 10, '_edit_lock', '1476576164:1');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2016-10-15 19:15:14', '2016-10-15 19:15:14', 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2016-10-15 19:15:14', '2016-10-15 19:15:14', '', 0, 'http://localhost/syfc-website-2016/?p=1', 0, 'post', '', 2),
(2, 1, '2016-10-15 19:15:14', '2016-10-15 19:15:14', 'This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href="http://localhost/syfc-website-2016/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2016-10-15 19:15:14', '2016-10-15 19:15:14', '', 0, 'http://localhost/syfc-website-2016/?page_id=2', 0, 'page', '', 0),
(3, 1, '2016-10-15 19:15:32', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2016-10-15 19:15:32', '0000-00-00 00:00:00', '', 0, 'http://localhost/syfc-website-2016/?p=3', 0, 'post', '', 0),
(4, 1, '2016-10-15 22:21:09', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2016-10-15 22:21:09', '0000-00-00 00:00:00', '', 0, 'http://localhost/syfc-website-2016/?post_type=office&p=4', 0, 'office', '', 0),
(5, 1, '2016-10-15 22:36:04', '2016-10-15 22:36:04', '', 'Main Office', '', 'publish', 'closed', 'closed', '', 'main-office', '', '', '2016-10-15 23:48:27', '2016-10-15 23:48:27', '', 0, 'http://localhost/syfc-website-2016/?post_type=office&#038;p=5', 0, 'office', '', 0),
(7, 1, '2016-10-15 22:43:51', '2016-10-15 22:43:51', '', 'South Seattle - Creston Point Apartments', '', 'publish', 'closed', 'closed', '', 'south-seattle-creston-point-apartments', '', '', '2016-10-15 23:49:53', '2016-10-15 23:49:53', '', 0, 'http://localhost/syfc-website-2016/?post_type=office&#038;p=7', 0, 'office', '', 0),
(8, 1, '2016-10-15 22:46:09', '2016-10-15 22:46:09', '', 'SeaTac - Pine Ridge Apartments', '', 'publish', 'closed', 'closed', '', 'seatac-pine-ridge-apartments', '', '', '2016-10-15 23:50:36', '2016-10-15 23:50:36', '', 0, 'http://localhost/syfc-website-2016/?post_type=office&#038;p=8', 0, 'office', '', 0),
(9, 1, '2016-10-15 22:48:58', '2016-10-15 22:48:58', '', 'NEW HOLLY CAMPUS, FAMILY BLDG', '', 'publish', 'closed', 'closed', '', 'new-holly-campus-family-bldg', '', '', '2016-10-15 23:52:39', '2016-10-15 23:52:39', '', 0, 'http://localhost/syfc-website-2016/?post_type=office&#038;p=9', 0, 'office', '', 0),
(10, 1, '2016-10-16 00:05:05', '2016-10-16 00:05:05', '', 'SYFC New office in Kent', '', 'publish', 'closed', 'closed', '', 'syfc-new-office-in-kent', '', '', '2016-10-16 00:05:05', '2016-10-16 00:05:05', '', 0, 'http://localhost/syfc-website-2016/?post_type=office&#038;p=10', 0, 'office', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_termmeta`
--

CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE `wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(5, 'Education: After School Program', 'education-after-school-program', 0),
(6, 'Education: Early Learning Program', 'education-early-learning-program', 0),
(7, 'Family Engagment: Training', 'family-engagment-training', 0),
(8, 'Family Engagment: Workshops', 'family-engagment-workshops', 0),
(9, 'Education: ELL', 'education-ell', 0),
(10, 'Education: Weekend Cultural Classes', 'education-weekend-cultural-classes', 0),
(11, 'Education: Free After School tutoring', 'education-free-after-school-tutoring', 0),
(12, 'Education: Adult ESL classes', 'education-adult-esl-classes', 0),
(13, 'Education: Early Childhood', 'education-early-childhood', 0),
(14, 'Education: Youth Employment', 'education-youth-employment', 0),
(15, 'Housing Services: Homelessnes', 'housing-services-homelessnes', 0),
(16, 'Housing Services: Homelessness Prevention', 'housing-services-unhoused', 0),
(17, 'Housing Services: Rehousing', 'housing-services-rehousing', 0),
(18, 'Social Services: DHSH Benefits', 'social-services-dhsh-benefits', 0),
(19, 'Social Services: Rental &amp; Utility', 'social-services-rental-utility', 0),
(20, 'Social Services: School Enrollment', 'social-services-school-enrollment', 0),
(21, 'Social Services: Languages', 'social-services-languages', 0),
(22, 'Social Services: Transportation', 'social-services-transportation', 0),
(23, 'Social Services: Employment', 'social-services-employment', 0),
(24, 'Citizenship &amp; Naturalization Services: Citizenship Classes', 'naturalization-classes', 0),
(25, 'Social Services: Legal Assistance', 'social-services-legal-assistance', 0),
(26, 'Social Services: Health Plan Referrals', 'health-plan-referrals', 0),
(27, 'Citizenship &amp; Naturalization Services: Naturalization Application Assistance', 'citizenship-naturalization-services-naturalization-application-assistance', 0),
(28, 'Citizenship: Voter Registration Assistance', 'citizenship-voter-registration-assistance', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(5, 5, 'service', 'Afterschool Program-free tutoring and homework help ages 6-18 (hours depend on site)', 0, 0),
(6, 6, 'service', '', 0, 0),
(7, 7, 'service', '', 0, 0),
(8, 8, 'service', '', 0, 0),
(9, 9, 'service', 'Basic Reading, Digital Literacy Skills', 0, 0),
(10, 10, 'service', 'Open to all', 0, 0),
(11, 11, 'service', '', 0, 0),
(12, 12, 'service', 'Adult ESL classes at Creston Point Apartments, taught by Renton Technical College accredited teachers', 0, 0),
(13, 13, 'service', 'Sha-Sha Early Foundations- providing part-time childcare focused on early childhood education,King County Kalaidascope Play n\' Learn Affiliate classes held weekly open to ages 0-6 must be accompanied by a parent or FFN caregiver', 0, 0),
(14, 14, 'service', 'Youth employment in partnership with Multi-Service Center', 0, 0),
(15, 15, 'service', 'Homelessness prevention', 0, 0),
(16, 16, 'service', 'Prevention of homelessness', 0, 0),
(17, 17, 'service', 'Emergency rehousing', 0, 0),
(18, 18, 'service', 'DSHS Benefits assistance (food, medical, disability)', 0, 0),
(19, 19, 'service', 'Referrals for rental and utility assistance', 0, 0),
(20, 20, 'service', 'School enrollment', 0, 0),
(21, 21, 'service', 'Interpreting (General, Legal, Medical)', 0, 0),
(22, 22, 'service', 'Local transportation assistance', 0, 0),
(23, 23, 'service', 'Employment assistance', 0, 0),
(24, 24, 'service', 'Citizenship Classes', 0, 0),
(25, 25, 'service', '', 0, 0),
(26, 26, 'service', '', 0, 0),
(27, 27, 'service', 'Naturalization Application Assistance', 0, 0),
(28, 28, 'service', 'Assistance Voter Registration', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_comments`
--
ALTER TABLE `wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indexes for table `wp_links`
--
ALTER TABLE `wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_posts`
--
ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_terms`
--
ALTER TABLE `wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `wp_term_relationships`
--
ALTER TABLE `wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_comments`
--
ALTER TABLE `wp_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wp_links`
--
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_terms`
--
ALTER TABLE `wp_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
