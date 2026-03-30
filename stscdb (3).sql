-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2026 at 02:31 PM
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
-- Database: `stscdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_classes`
--

CREATE TABLE `add_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_classes`
--

INSERT INTO `add_classes` (`id`, `name`, `class`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'Class 1', '1', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21'),
(2, 'Class 2', '2', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21'),
(3, 'Class 3', '3', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21'),
(4, 'Class 4', '4', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21'),
(5, 'Class 5', '5', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21'),
(6, 'Class 6', '6', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21'),
(7, 'Class 7', '7', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21'),
(8, 'Class 8', '8', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21'),
(9, 'Class 9', '9', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21'),
(10, 'Class 10', '10', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21'),
(11, 'Class 11', '11', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21'),
(12, 'Class 12', '12', 3, '2026-03-25 00:54:21', '2026-03-25 00:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent','late','excused') NOT NULL DEFAULT 'present',
  `remarks` text DEFAULT NULL,
  `recorded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `student_id`, `class_id`, `date`, `status`, `remarks`, `recorded_by`, `created_at`, `updated_at`) VALUES
(1, 18, 9, '2026-03-24', 'absent', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 04:20:47'),
(6, 6, 5, '2026-03-25', 'absent', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(11, 13, 6, '2026-03-26', 'late', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 04:29:33'),
(14, 15, 1, '2026-03-26', 'absent', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(18, 10, 11, '2026-03-21', 'present', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(19, 2, 10, '2026-03-26', 'absent', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 05:39:24'),
(22, 13, 7, '2026-03-26', 'absent', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(23, 12, 5, '2026-03-26', 'absent', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 04:29:13'),
(24, 10, 6, '2026-03-22', 'late', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(26, 12, 11, '2026-03-24', 'present', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(29, 17, 6, '2026-03-21', 'late', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(33, 10, 11, '2026-03-21', 'present', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(36, 12, 5, '2026-03-23', 'absent', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(38, 5, 7, '2026-03-21', 'excused', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(39, 4, 3, '2026-03-22', 'late', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(40, 11, 2, '2026-03-22', 'excused', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(41, 3, 7, '2026-03-26', 'absent', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 04:22:48'),
(42, 16, 7, '2026-03-25', 'present', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(45, 14, 10, '2026-03-24', 'excused', 'Auto generated', 3, '2026-03-26 00:52:11', '2026-03-26 00:52:11'),
(51, 5, 7, '2026-03-26', 'absent', NULL, 1, '2026-03-26 04:22:38', '2026-03-26 05:10:08'),
(52, 4, 5, '2026-03-26', 'present', NULL, 1, '2026-03-26 04:28:45', '2026-03-26 04:33:46'),
(53, 11, 5, '2026-03-26', 'present', NULL, 1, '2026-03-26 04:29:17', '2026-03-26 04:33:44'),
(54, 17, 5, '2026-03-26', 'late', NULL, 1, '2026-03-26 04:32:41', '2026-03-26 04:36:44'),
(55, 18, 5, '2026-03-26', 'present', NULL, 1, '2026-03-26 04:32:44', '2026-03-26 04:36:46'),
(56, 10, 4, '2026-03-26', 'late', NULL, 1, '2026-03-26 04:33:08', '2026-03-26 04:33:08'),
(58, 4, 5, '2026-03-28', 'absent', NULL, 1, '2026-03-27 23:16:00', '2026-03-27 23:16:00'),
(59, 2, 10, '2026-03-28', 'present', NULL, 1, '2026-03-27 23:16:06', '2026-03-27 23:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `complaint_id` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `issue_category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('open','in_progress','resolved','rejected') NOT NULL DEFAULT 'open',
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `complaint_id`, `student_name`, `mobile`, `school_name`, `issue_category`, `description`, `status`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'CMP-ABC123', 'Ravi Kumar', '9998887776', 'Govt High School Patna', 'Scholarship Delay', 'Scholarship amount not received.', 'open', NULL, '2026-03-25 00:51:56', '2026-03-25 00:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

CREATE TABLE `homes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `hero` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`hero`)),
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `about` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`about`)),
  `activities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`activities`)),
  `school_at_a_glance` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`school_at_a_glance`)),
  `infrasture` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`infrasture`)),
  `quiz` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`quiz`)),
  `alumni` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`alumni`)),
  `faq` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`faq`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homes`
--

INSERT INTO `homes` (`id`, `school_id`, `hero`, `gallery`, `about`, `activities`, `school_at_a_glance`, `infrasture`, `quiz`, `alumni`, `faq`, `created_at`, `updated_at`) VALUES
(1, 3, '{\"bgimage\":\"schoolBgImage\\/1774099614.jpg\",\"badge_text\":\"Residential \\u2022 SC\\/ST Welfare\",\"rating_value\":\"4.6\",\"school_title\":\"Dr. B.R. Ambedkar Residential School\",\"location_text\":\"Patna, Bihar\",\"students_count\":\"345studebt\",\"class_range\":\"Class 6 - 12\",\"back_button_text\":\"Back to Schools\"}', '\"[{\\\"gallery_card_image\\\":\\\"GalleryImage\\\\\\/1774254180.jpg\\\",\\\"gallery_card_title\\\":\\\"University Life\\\",\\\"gallery_card_subtitle\\\":\\\"Cannot access offset of type string on string\\\"},{\\\"gallery_card_image\\\":\\\"GalleryImage\\\\\\/1774254201.png\\\",\\\"gallery_card_title\\\":\\\"University Life\\\",\\\"gallery_card_subtitle\\\":\\\"Cannot access offset of type string on string Cannot access offset of type string on string\\\"}]\"', '\"{\\\"about_label\\\":\\\"About the School\\\",\\\"about_title\\\":\\\"Dr. B.R. Ambedkar SC\\\\\\/ST Residential School, Patna\\\",\\\"about_description\\\":\\\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\\\",\\\"about_bullet_1\\\":\\\"Classes from 6 to 12 with experienced faculty\\\",\\\"about_bullet_2\\\":\\\"Safe residential hostels with structured supervision\\\",\\\"about_bullet_3\\\":\\\"Strong academic performance and exam preparation support\\\",\\\"students_count\\\":\\\"1500+\\\",\\\"student_ratio\\\":\\\"15:1\\\",\\\"pass_percentage\\\":\\\"95%\\\",\\\"about_image\\\":\\\"aboutImage\\\\\\/1774099706.jpg\\\"}\"', '\"[{\\\"title\\\":\\\"Cultural Activities\\\",\\\"image\\\":\\\"uploads\\\\\\/1774099781.jpg\\\"},{\\\"title\\\":\\\"Classroom Learning\\\",\\\"image\\\":\\\"uploads\\\\\\/1774341666.png\\\"}]\"', '\"{\\\"glance_title\\\":\\\"School At A Glance\\\",\\\"glance_subtitle\\\":\\\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\\\",\\\"stat_1_value\\\":\\\"650\\\",\\\"stat_1_label\\\":\\\"Total Students\\\",\\\"stat_2_label\\\":\\\"Faculty Members\\\",\\\"stat_2_value\\\":\\\"45\\\",\\\"stat_3_value\\\":\\\"12\\\",\\\"stat_3_label\\\":\\\"Classes (6\\\\u201312)\\\",\\\"stat_4_value\\\":\\\"95%\\\",\\\"stat_4_label\\\":\\\"Board Pass Rate\\\"}\"', '\"{\\\"infra_label\\\":\\\"Facilities\\\",\\\"infra_title\\\":\\\"Infrastructure for Holistic Student Growth\\\",\\\"infra_description\\\":\\\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\\\",\\\"allfeatures\\\":{\\\"feature1\\\":\\\"Modern Classrooms\\\",\\\"feature2\\\":\\\"Science Laboratories\\\",\\\"feature3\\\":\\\"Computer Education\\\",\\\"feature4\\\":\\\"Residential Hostels\\\",\\\"feature5\\\":\\\"Nutritious Meals\\\",\\\"feature6\\\":\\\"Sports Facilities\\\",\\\"feature7\\\":\\\"Safe &  Secure Campus\\\",\\\"feature8\\\":\\\"Health & Student Welfare\\\"}}\"', '\"[{\\\"quiz_status\\\":\\\"Upcoming\\\",\\\"quiz_image\\\":\\\"quizImage\\\\\\/1774099832.jpg\\\",\\\"quiz_button_text\\\":\\\"View Details\\\",\\\"quiz_title\\\":\\\"Inter-House General Knowledge Quiz\\\",\\\"quiz_description\\\":\\\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\\\"},{\\\"quiz_status\\\":\\\"Upcoming\\\",\\\"quiz_image\\\":\\\"quizImage\\\\\\/1774099848.png\\\",\\\"quiz_button_text\\\":\\\"View Details\\\",\\\"quiz_title\\\":\\\"Science Talent Challenge\\\",\\\"quiz_description\\\":\\\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\\\"},{\\\"quiz_status\\\":\\\"Completed\\\",\\\"quiz_image\\\":\\\"quizImage\\\\\\/1774346664.jpg\\\",\\\"quiz_button_text\\\":\\\"View Details\\\",\\\"quiz_title\\\":\\\"Inter-House General Knowledge Quiz\\\",\\\"quiz_description\\\":\\\"printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scram\\\"}]\"', '\"[{\\\"alumni_name\\\":\\\"Aman Kumar\\\",\\\"alumni_photo\\\":\\\"alumniPhoto\\\\\\/1774413484.jpg\\\",\\\"alumni_details\\\":\\\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\\\"},{\\\"alumni_name\\\":\\\"Abhishek\\\",\\\"alumni_photo\\\":\\\"alumniPhoto\\\\\\/1774413881.jpg\\\",\\\"alumni_details\\\":\\\"If you want, I can also write the frontend Alpine.js code so each alumni card has a \\\\u201cDelete\\\\u201d button that deletes by index and refreshes the list instantly.\\\"}]\"', '\"[{\\\"faq_question\\\":\\\"FIRST QUESTIONS\\\",\\\"faq_answer\\\":\\\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\\\"},{\\\"faq_question\\\":\\\"FIRST QUESTIONS second\\\",\\\"faq_answer\\\":\\\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\\\"}]\"', '2026-03-21 07:56:54', '2026-03-24 23:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `infrastructures`
--

CREATE TABLE `infrastructures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `hero` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`hero`)),
  `compus_overview` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`compus_overview`)),
  `academic_infrastructure` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`academic_infrastructure`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `infrastructures`
--

INSERT INTO `infrastructures` (`id`, `school_id`, `hero`, `compus_overview`, `academic_infrastructure`, `created_at`, `updated_at`) VALUES
(1, 3, '\"{\\\"infra_hero_image\\\":\\\"InfImage\\\\\\/1774084802.jpg\\\",\\\"infra_hero_title\\\":\\\"Infrastructure for Holistic Student Growth\\\",\\\"infra_hero_subtitle\\\":\\\"Explore the facilities, learning spaces and residential environment that support student development across academics, health and co-curricular life.\\\",\\\"infra_breadcrumb\\\":\\\"Infrastructure\\\"}\"', '\"{\\\"campus_overview_title\\\":\\\"Campus Overview\\\",\\\"campus_paragraph_1\\\":\\\"The campus is designed to provide a balanced environment where students can grow academically, socially and personally within a secure residential setting.\\\",\\\"campus_paragraph_2\\\":\\\"Modern facilities, open spaces and structured student support systems help create a strong foundation for holistic development.\\\",\\\"feature_1_title\\\":null,\\\"feature_1_description\\\":\\\"Well-planned academic and residential spaces that support learning and student life.\\\",\\\"feature_2_title\\\":\\\"Residential Facility\\\",\\\"feature_2_description\\\":\\\"Safe hostel accommodation with structured routines and supervised care for students.\\\",\\\"feature_3_title\\\":\\\"Modern Labs\\\",\\\"feature_3_description\\\":\\\"Dedicated laboratory spaces that encourage practical learning and scientific exploration.\\\",\\\"feature_4_title\\\":\\\"Sports Facilities\\\",\\\"feature_4_description\\\":\\\"Outdoor and indoor activity spaces that promote fitness, teamwork and discipline.\\\",\\\"campus_overview_image\\\":\\\"CampusImage\\\\\\/1774088567.webp\\\"}\"', '\"[{\\\"infra_card_title\\\":\\\"Modern Classrooms\\\",\\\"infra_card_description\\\":\\\"Spacious and technology-enabled classrooms designed for focused, engaging learning.\\\",\\\"infra_card_link\\\":\\\"#\\\",\\\"infra_card_image\\\":\\\"acadmiImg\\\\\\/1774092120.webp\\\"},{\\\"infra_card_title\\\":\\\"Science Laboratories\\\",\\\"infra_card_description\\\":\\\"Dedicated labs for practical experiments that strengthen conceptual understanding.\\\",\\\"infra_card_link\\\":\\\"#\\\",\\\"infra_card_image\\\":\\\"acadmiImg\\\\\\/1774092189.png\\\"}]\"', '2026-03-21 03:50:02', '2026-03-21 05:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meal_reports`
--

CREATE TABLE `meal_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `menu` text NOT NULL,
  `district` varchar(255) NOT NULL,
  `report_image` varchar(255) NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `report_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `report_category` enum('academic','infrastructure') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meal_reports`
--

INSERT INTO `meal_reports` (`id`, `date`, `menu`, `district`, `report_image`, `school_id`, `report_type`, `created_at`, `updated_at`, `report_category`) VALUES
(1, '2026-03-28 12:50:41', 'Rice,Roti,Sabji', 'Patna', 'mealImage/1774702241.jpeg', 3, 'Meal Attendance', '2026-03-28 07:20:41', '2026-03-28 07:20:41', 'academic');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '0001_01_01_000000_create_users_table', 1),
(5, '0001_01_01_000001_create_cache_table', 1),
(6, '0001_01_01_000002_create_jobs_table', 1),
(7, '2026_02_25_102009_create_complaints_table', 2),
(8, '2026_02_25_102011_create_support_tickets_table', 2),
(9, '2026_02_25_102014_create_scholarship_documents_table', 2),
(10, '2026_02_25_130007_create_personal_access_tokens_table', 2),
(11, '2026_02_26_131259_create_schools_table', 2),
(12, '2026_03_17_060757_add_to_colum_category_table_schools', 3),
(13, '2026_03_17_125619_add_to_school_id_colum_to_users_table', 4),
(14, '2026_03_18_124953_create_homes_table', 5),
(15, '2026_03_18_125008_create_infrastructures_table', 5),
(16, '2026_03_18_125025_create_staff_table', 5),
(17, '2026_03_18_125049_create_notices_table', 5),
(18, '2026_03_25_060142_create_add_classes_table', 6),
(19, '2026_03_25_062708_create_students_table', 7),
(20, '2026_03_25_070850_create_attendances_table', 8),
(21, '2026_03_26_085512_add_to_colum_school_id_to_table_stundents', 7),
(22, '2026_03_26_102149_create_reports_table', 9),
(23, '2026_03_26_111102_add_to_colum_to_table_reports', 10),
(24, '2026_03_28_090125_create_meal_reports_table', 11),
(25, '2026_03_28_120731_add_to_colum_report_category_to_reports_table', 12),
(26, '2026_03_28_120851_add_to_colum_report_category_to_reports_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `notice_manage` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`notice_manage`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `school_id`, `notice_manage`, `created_at`, `updated_at`) VALUES
(1, 3, '\"[{\\\"notice_title\\\":\\\"Admission Open for Session 2026-27\\\",\\\"notice_description\\\":\\\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\\\",\\\"notice_category\\\":\\\"Events\\\",\\\"notice_publish_date\\\":\\\"2026-03-11\\\",\\\"notice_badge\\\":\\\"Nnew\\\",\\\"notice_attachment\\\":\\\"notices\\\\\\/1774099405.pdf\\\"},{\\\"notice_title\\\":\\\"Admission Open for Session 2026-27 seconsd\\\",\\\"notice_description\\\":\\\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\\\",\\\"notice_category\\\":\\\"Academic\\\",\\\"notice_publish_date\\\":\\\"2026-03-11\\\",\\\"notice_badge\\\":\\\"Nnew\\\",\\\"notice_attachment\\\":\\\"notices\\\\\\/1774099428.pdf\\\"}]\"', '2026-03-21 07:53:25', '2026-03-21 07:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `report_type` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `report_img` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `report_category` enum('academic','infrastructure') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `school_id`, `report_type`, `date`, `district`, `report_img`, `created_at`, `updated_at`, `report_category`) VALUES
(1, 3, 'Student Attendance', '2026-03-12', 'Patna', 'Reports/1774702163.jpg', '2026-03-28 07:19:23', '2026-03-28 07:19:23', 'academic');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_documents`
--

CREATE TABLE `scholarship_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `scheme_name` varchar(255) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scholarship_documents`
--

INSERT INTO `scholarship_documents` (`id`, `scheme_name`, `document_name`, `created_at`, `updated_at`) VALUES
(1, 'Bihar Pre Matric SC Scholarship', 'Caste Certificate', NULL, NULL),
(2, 'Bihar Pre Matric SC Scholarship', 'Income Certificate', NULL, NULL),
(3, 'Bihar Pre Matric SC Scholarship', 'Aadhaar Card', NULL, NULL),
(4, 'Bihar Post Matric ST Scholarship', 'Caste Certificate', NULL, NULL),
(5, 'Bihar Post Matric ST Scholarship', 'Previous Marksheet', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_logo` varchar(255) NOT NULL,
  `school_code` varchar(255) NOT NULL,
  `establishment_year` year(4) DEFAULT NULL,
  `district` varchar(255) NOT NULL,
  `block` varchar(255) NOT NULL,
  `full_address` text NOT NULL,
  `official_email` varchar(255) NOT NULL,
  `school_phone` varchar(255) NOT NULL,
  `principle_name` varchar(255) NOT NULL,
  `principle_contact` varchar(255) NOT NULL,
  `total_classrooms` int(11) NOT NULL DEFAULT 0,
  `total_students_enrolled` int(11) NOT NULL DEFAULT 0,
  `total_teachers_sanctioned` int(11) NOT NULL DEFAULT 0,
  `hostel_capacity` int(11) NOT NULL DEFAULT 0,
  `school_admin_username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `school_name`, `school_logo`, `school_code`, `establishment_year`, `district`, `block`, `full_address`, `official_email`, `school_phone`, `principle_name`, `principle_contact`, `total_classrooms`, `total_students_enrolled`, `total_teachers_sanctioned`, `hostel_capacity`, `school_admin_username`, `password`, `account_status`, `created_at`, `updated_at`, `category`) VALUES
(1, 'Dr. B.R. Ambedkar Residential School', 'SchoolLogo/1773743328.jpg', 'GHS2026MP01', '2022', 'Patna', 'Mithapur', 'Patna', 'first@gmail.com', '9874576454', 'Abhishek', '2345665432', 100, 1000, 80, 50, 'first_school', '$2y$12$9DYSJrIc0S5Y26cZGoO1BuWbebdRoxB6VR//GYpxRFufsnmbRcO0O', 'inactive', '2026-03-17 01:11:02', '2026-03-17 07:40:10', 'Residential'),
(3, 'Dr. B.R. Ambedkar Residential School', 'SchoolLogo/1773752713.png', 'BR-AMB-RDSL-S', '2022', 'Patna', 'Mithapur', 'Patna', 'Testing@gmail.com', '9874576454', 'Abhishek', '3442424224', 100, 10000, 29, 20, 'testschool', '$2y$12$BQF6k3CZmca8qWN7B85e5e8/JLRnrh9IkK1Cu1U3FbOJyZOZ.lp0u', 'active', '2026-03-17 07:35:13', '2026-03-17 07:35:13', 'Day School'),
(6, 'Dr. B.R. Ambedkar Residential School', 'SchoolLogo/1773989215.png', 'BR-AMB-RDSL-5', '2022', 'Katihar', 'Mithapur', 'Testing for data', 'second@gmail.com', '3434344444', 'Abhishek', '1234567890', 12, 100, 200, 399, 'testschool2', '$2y$12$vMBo4STf/t9VswXVh/6Wbeg67LQga2ISb0Aq/cAu82w0AIEcIpF.W', 'active', '2026-03-20 01:16:42', '2026-03-20 01:16:55', 'Day School');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `leadership` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`leadership`)),
  `teacher_staff` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`teacher_staff`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `school_id`, `leadership`, `teacher_staff`, `created_at`, `updated_at`) VALUES
(1, 3, '\"{\\\"leader_name\\\":\\\"Dr. Anil Kumar\\\",\\\"leader_designation\\\":\\\"Principal\\\",\\\"leader_bio\\\":\\\"Dr. Anil Kumar leads the institution with a focus on academic excellence, student welfare and inclusive residential education.\\\",\\\"leader_image\\\":\\\"leaders\\\\\\/1774094677.jpg\\\"}\"', '\"[{\\\"staff_name\\\":\\\"Ravi Prakash\\\",\\\"staff_subject\\\":\\\"Science Department\\\",\\\"staff_email\\\":\\\"ravi.prakash@school.edu\\\",\\\"staff_image\\\":\\\"teacher\\\\\\/1774096536.jpg\\\"}]\"', '2026-03-21 06:34:37', '2026-03-21 07:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `roll_number` varchar(255) NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `parent_name` varchar(255) NOT NULL,
  `parent_email` varchar(255) DEFAULT NULL,
  `parent_phone` varchar(255) NOT NULL,
  `parent_relation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `roll_number`, `class_id`, `dob`, `gender`, `email`, `phone`, `parent_name`, `parent_email`, `parent_phone`, `parent_relation`, `created_at`, `updated_at`, `school_id`) VALUES
(2, 'Student 2', '2', 10, '2020-03-25', 'Female', 'student2@example.com', '9000000002', 'Parent 2', 'parent2@example.com', '9100000002', 'Father', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(3, 'Student 3', '3', 10, '2011-03-25', 'Male', 'student3@example.com', '9000000003', 'Parent 3', 'parent3@example.com', '9100000003', 'Father', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(4, 'Student 4', '4', 5, '2020-03-25', 'Male', 'student4@example.com', '9000000004', 'Parent 4', 'parent4@example.com', '9100000004', 'Mother', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(5, 'Karan Kumar', '5', 10, '2018-03-25', 'Male', 'student5@example.com', '9000000005', 'Parent 5', 'parent5@example.com', '9100000005', 'Father', '2026-03-25 01:29:34', '2026-03-28 01:01:43', 3),
(6, 'Student 6', '6', 3, '2012-03-25', 'Female', 'student6@example.com', '9000000006', 'Parent 6', 'parent6@example.com', '9100000006', 'Guardian', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(10, 'Student 10', '10', 4, '2016-03-25', 'Female', 'student10@example.com', '9000000010', 'Parent 10', 'parent10@example.com', '9100000010', 'Mother', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(11, 'Student 11', '11', 5, '2013-03-25', 'Female', 'student11@example.com', '9000000011', 'Parent 11', 'parent11@example.com', '9100000011', 'Mother', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(12, 'Student 12', '12', 8, '2017-03-25', 'Female', 'student12@example.com', '9000000012', 'Parent 12', 'parent12@example.com', '9100000012', 'Mother', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(13, 'Student 13', '13', 8, '2010-03-25', 'Female', 'student13@example.com', '9000000013', 'Parent 13', 'parent13@example.com', '9100000013', 'Father', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(14, 'Student 14', '14', 12, '2011-03-25', 'Male', 'student14@example.com', '9000000014', 'Parent 14', 'parent14@example.com', '9100000014', 'Father', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(15, 'Student 15', '15', 8, '2015-03-25', 'Male', 'student15@example.com', '9000000015', 'Parent 15', 'parent15@example.com', '9100000015', 'Guardian', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(16, 'Student 16', '16', 10, '2010-03-25', 'Female', 'student16@example.com', '9000000016', 'Parent 16', 'parent16@example.com', '9100000016', 'Guardian', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(17, 'Student 17', '17', 5, '2012-03-25', 'Male', 'student17@example.com', '9000000017', 'Parent 17', 'parent17@example.com', '9100000017', 'Father', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(18, 'Student 18', '18', 5, '2020-03-25', 'Female', 'student18@example.com', '9000000018', 'Parent 18', 'parent18@example.com', '9100000018', 'Guardian', '2026-03-25 01:29:34', '2026-03-25 01:29:34', 3),
(53, 'Student 2', 'ST38826P', 10, '2020-03-25', 'Female', 'student2@example.com', '9000000002', 'Parent 2', 'parent2@example.com', '9100000002', 'Father', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(54, 'Student 3', 'ST38659A', 10, '2011-03-25', 'Male', 'student3@example.com', '9000000003', 'Parent 3', 'parent3@example.com', '9100000003', 'Father', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(55, 'Student 4', 'ST52865P', 5, '2020-03-25', 'Male', 'student4@example.com', '9000000004', 'Parent 4', 'parent4@example.com', '9100000004', 'Mother', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(56, 'Karan Kumar', 'KA81828G', 10, '2018-03-25', 'Male', 'student5@example.com', '9000000005', 'Parent 5', 'parent5@example.com', '9100000005', 'Father', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(57, 'Student 6', 'ST83367J', 3, '2012-03-25', 'Female', 'student6@example.com', '9000000006', 'Parent 6', 'parent6@example.com', '9100000006', 'Guardian', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(58, 'Student 10', 'ST30623N', 4, '2016-03-25', 'Female', 'student10@example.com', '9000000010', 'Parent 10', 'parent10@example.com', '9100000010', 'Mother', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(59, 'Student 11', 'ST66722S', 5, '2013-03-25', 'Female', 'student11@example.com', '9000000011', 'Parent 11', 'parent11@example.com', '9100000011', 'Mother', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(60, 'Student 12', 'ST56771P', 8, '2017-03-25', 'Female', 'student12@example.com', '9000000012', 'Parent 12', 'parent12@example.com', '9100000012', 'Mother', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(61, 'Student 13', 'ST65265V', 8, '2010-03-25', 'Female', 'student13@example.com', '9000000013', 'Parent 13', 'parent13@example.com', '9100000013', 'Father', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(62, 'Student 14', 'ST78670T', 12, '2011-03-25', 'Male', 'student14@example.com', '9000000014', 'Parent 14', 'parent14@example.com', '9100000014', 'Father', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(63, 'Student 15', 'ST29848A', 8, '2015-03-25', 'Male', 'student15@example.com', '9000000015', 'Parent 15', 'parent15@example.com', '9100000015', 'Guardian', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(64, 'Student 16', 'ST71766O', 10, '2010-03-25', 'Female', 'student16@example.com', '9000000016', 'Parent 16', 'parent16@example.com', '9100000016', 'Guardian', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(65, 'Student 17', 'ST55250C', 5, '2012-03-25', 'Male', 'student17@example.com', '9000000017', 'Parent 17', 'parent17@example.com', '9100000017', 'Father', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3),
(66, 'Student 18', 'ST57612S', 5, '2020-03-25', 'Female', 'student18@example.com', '9000000018', 'Parent 18', 'parent18@example.com', '9100000018', 'Guardian', '2026-03-28 03:05:38', '2026-03-28 03:05:38', 3);

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `status` enum('open','assigned','in_progress','resolved') NOT NULL DEFAULT 'open',
  `assigned_officer` varchar(255) DEFAULT NULL,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` enum('admin','school_admin','staff') NOT NULL DEFAULT 'admin',
  `address` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `schoolCode` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `role`, `address`, `username`, `schoolCode`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `school_id`) VALUES
(1, 'Dr. B.R. Ambedkar Residential School', NULL, 'school_admin', NULL, 'testschool', 'BR-AMB-RDSL-S', NULL, '$2y$12$BQF6k3CZmca8qWN7B85e5e8/JLRnrh9IkK1Cu1U3FbOJyZOZ.lp0u', NULL, '2026-03-17 07:35:13', '2026-03-17 07:35:13', 3),
(2, 'Admin', NULL, 'admin', NULL, 'admin@gmail.com', NULL, NULL, '$2y$12$X82Id6V6o6IFQdVXSDo99.i458bAaOI39toUYeQJ8hI3l9xlQYtxS', NULL, '2026-03-18 03:46:55', '2026-03-18 03:46:55', NULL),
(4, 'Dr. B.R. Ambedkar Residential School', NULL, 'school_admin', NULL, 'testschool2', 'BR-AMB-RDSL-5', NULL, '$2y$12$vMBo4STf/t9VswXVh/6Wbeg67LQga2ISb0Aq/cAu82w0AIEcIpF.W', NULL, '2026-03-20 01:16:42', '2026-03-20 01:16:42', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_classes`
--
ALTER TABLE `add_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_student_id_foreign` (`student_id`),
  ADD KEY `attendances_class_id_foreign` (`class_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `complaints_complaint_id_unique` (`complaint_id`),
  ADD KEY `complaints_mobile_index` (`mobile`),
  ADD KEY `complaints_school_name_index` (`school_name`),
  ADD KEY `complaints_issue_category_index` (`issue_category`),
  ADD KEY `complaints_status_index` (`status`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homes_school_id_foreign` (`school_id`);

--
-- Indexes for table `infrastructures`
--
ALTER TABLE `infrastructures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infrastructures_school_id_foreign` (`school_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meal_reports`
--
ALTER TABLE `meal_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_reports_school_id_foreign` (`school_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notices_school_id_foreign` (`school_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_school_id_foreign` (`school_id`);

--
-- Indexes for table `scholarship_documents`
--
ALTER TABLE `scholarship_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scholarship_documents_scheme_name_index` (`scheme_name`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schools_school_code_unique` (`school_code`),
  ADD UNIQUE KEY `schools_official_email_unique` (`official_email`),
  ADD UNIQUE KEY `schools_school_admin_username_unique` (`school_admin_username`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_school_id_foreign` (`school_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_roll_number_unique` (`roll_number`),
  ADD KEY `students_class_id_foreign` (`class_id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `support_tickets_ticket_id_unique` (`ticket_id`),
  ADD KEY `support_tickets_mobile_index` (`mobile`),
  ADD KEY `support_tickets_school_name_index` (`school_name`),
  ADD KEY `support_tickets_status_index` (`status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`),
  ADD KEY `users_school_id_foreign` (`school_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_classes`
--
ALTER TABLE `add_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homes`
--
ALTER TABLE `homes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `infrastructures`
--
ALTER TABLE `infrastructures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meal_reports`
--
ALTER TABLE `meal_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scholarship_documents`
--
ALTER TABLE `scholarship_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `add_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `homes`
--
ALTER TABLE `homes`
  ADD CONSTRAINT `homes_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `infrastructures`
--
ALTER TABLE `infrastructures`
  ADD CONSTRAINT `infrastructures_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meal_reports`
--
ALTER TABLE `meal_reports`
  ADD CONSTRAINT `meal_reports_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `add_classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
