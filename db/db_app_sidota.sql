-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2021 at 12:28 AM
-- Server version: 10.3.29-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_app_sidota`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_activity`
--

CREATE TABLE `tb_activity` (
  `activity_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `category_activity_id` int(2) NOT NULL,
  `ticket_code` varchar(8) DEFAULT NULL,
  `location` varchar(80) NOT NULL,
  `location_address` tinytext DEFAULT NULL,
  `shift` enum('pagi','siang','malam','wfh') NOT NULL,
  `activity` mediumtext NOT NULL,
  `date_activity` date NOT NULL,
  `result_activity` mediumtext NOT NULL,
  `problem` mediumtext DEFAULT '-',
  `action` mediumtext DEFAULT '-',
  `status` enum('finished','on-progress','pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_app_setting`
--

CREATE TABLE `tb_app_setting` (
  `app_id` int(1) NOT NULL,
  `app_title` varchar(100) NOT NULL,
  `app_title_alt` varchar(50) NOT NULL,
  `footer_text` varchar(255) NOT NULL,
  `app_icon` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_logo_login` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `show_category` varchar(255) NOT NULL,
  `show_month` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_app_setting`
--

INSERT INTO `tb_app_setting` (`app_id`, `app_title`, `app_title_alt`, `footer_text`, `app_icon`, `app_logo`, `app_logo_login`, `company_name`, `show_category`, `show_month`) VALUES
(1, 'Sistem Dokumentasi Data Center', 'SIDOTA', 'SIDOTA - DISKOMINFO KOTA TANGERANG', 'favicon_qMKrQzUAslgHAMdwceEOA_MrZuCFnj_8236_147986025_XYVmdL_1620556808.webp', 'sidota-dashboard.png', 'sidota_QYZflIdKUmCd8MpQlaPy1g_rxFvBsGo_5834_146835279_rfuDKI_1620556605.webp', 'DINAS KOMUNIKASI DAN INFORMATIKA KOTA TANGERANG', '1, 2, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 22, 23, 24, 25, 26', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_category_activity`
--

CREATE TABLE `tb_category_activity` (
  `category_activity_id` int(2) NOT NULL,
  `category_activity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_category_activity`
--

INSERT INTO `tb_category_activity` (`category_activity_id`, `category_activity`) VALUES
(1, 'Installation'),
(2, 'Configuration'),
(3, 'Troubleshooting'),
(4, 'Monitoring'),
(5, 'Dismantle'),
(7, 'Research and Development'),
(8, 'Scanning'),
(9, 'Supervision'),
(10, 'Hardenning Server'),
(11, 'Maintenance'),
(12, 'Survey'),
(13, 'Inventarisasi'),
(14, 'Rekap Formulir'),
(15, 'Dokumentasi'),
(16, 'Data Collecting'),
(17, 'Data Presentation'),
(18, 'Dok Kegiatan Takol'),
(19, 'Teleconference'),
(22, 'Menerima Telepon Client'),
(23, 'Menerima Tiket Client'),
(24, 'Daftar Esign'),
(25, 'Daftar Email'),
(26, 'Pentest');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ebook`
--

CREATE TABLE `tb_ebook` (
  `ebook_id` int(11) NOT NULL,
  `ebook_categories` varchar(255) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `ebook_title` varchar(50) NOT NULL,
  `ebook_description` varchar(255) NOT NULL,
  `upload_date` date NOT NULL,
  `ebook_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ebook_category`
--

CREATE TABLE `tb_ebook_category` (
  `id_category` int(3) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_ebook_category`
--

INSERT INTO `tb_ebook_category` (`id_category`, `category`) VALUES
(1, 'linux'),
(2, 'networking'),
(3, 'cyber-security'),
(4, 'programming'),
(5, 'server'),
(6, 'Hacking');

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `employee_id` int(2) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_place_ob` varchar(255) NOT NULL,
  `employee_date_ob` date NOT NULL,
  `employee_address` text NOT NULL,
  `employee_phone` varchar(13) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `employee_bio` text DEFAULT NULL,
  `employee_picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`employee_id`, `employee_name`, `employee_place_ob`, `employee_date_ob`, `employee_address`, `employee_phone`, `facebook`, `instagram`, `website`, `employee_bio`, `employee_picture`) VALUES
(1, 'Ridwan Naim', 'Tangerang Kota', '1996-04-08', 'Perumahan Pondok Arum Blok F 3 No. 9, Kelurahan Nambo Jaya, Kecamatan Karawaci, Kota Tangerang', '089650285675', NULL, NULL, NULL, NULL, 'black-holes_2J2Mt5RSEfmVOwVJEWInoQ_dYEXnAiM_4592_208931567_kbZRXS_1622741198.webp'),
(10, 'Helpdesk TI', 'Tangerang', '1997-05-10', 'Gedung Puspem Barat Lt. 4, Jl. Satria - Sudirman, RT.002/RW.001, Sukarasa, Kec. Tangerang, Kota Tangerang, Banten 15111', '089517725731', '', '', 'https://diskominfo.tangerangkota.go.id', 'Ini Akun Helpdesk TI DISKOMINFO', 'mrndyh-ySlXUfFvAE20200604024119-helpdesk-ti.webp'),
(11, 'Kepala Bidang TIK', 'Somewhere', '1972-05-28', 'Kota Tangerang', '012345678910', NULL, NULL, NULL, NULL, 'edf9d161c4be4d52912fc93185f1db56_NZ4F0gtKxQX5CldGUuw_jXhgSBTZ_9436_051827396_ABiKcS_1622740528.webp'),
(12, 'PPTK', 'Somewhere', '1970-01-01', 'Somewhere', '02123456789', NULL, NULL, NULL, NULL, 'icon_viuUfzma2xEe0qIyyezq5w_TemMCjgi_8593_745601328_lQTCtK_1622741264.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jobdesc`
--

CREATE TABLE `tb_jobdesc` (
  `jobdesc_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `jobdesc_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jobdesc`
--

INSERT INTO `tb_jobdesc` (`jobdesc_id`, `type_id`, `jobdesc_name`) VALUES
(4, 1, 'superadmin'),
(5, 2, 'Operator Jaringan Komputer'),
(6, 5, 'Help Desk'),
(7, 3, 'Kepala Bidang TIK'),
(9, 4, 'KASI IIDC'),
(10, 2, 'HelpdeskTIK'),
(34, 2, 'Graphic Designer'),
(35, 2, 'Computer Operator Network Security');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_parent` int(11) DEFAULT NULL,
  `menu_label` varchar(100) NOT NULL,
  `menu_link` varchar(150) NOT NULL,
  `menu_icon` varchar(80) DEFAULT NULL,
  `menu_location` enum('mainmenu','submenu','content') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`menu_id`, `menu_parent`, `menu_label`, `menu_link`, `menu_icon`, `menu_location`) VALUES
(1, NULL, 'Dashboard', 'dashboard', 'fas fa-home', 'mainmenu'),
(2, NULL, 'Employee Management', '#', 'fa fa-users', 'mainmenu'),
(3, 2, 'Add Employee', 'add-employee', 'fa fa-plus-square', 'submenu'),
(4, 2, 'Edit Employee', 'edit-employee', 'fa fa-pencil-alt', 'content'),
(5, 2, 'Delete Employee', 'delete-employee', 'fa fa-trash', 'content'),
(6, NULL, 'Utilities', 'utilities', 'fa fa-cogs', 'mainmenu'),
(8, 6, 'Add Utility', 'add-utility', 'fa fa-plus-square', 'content'),
(9, 6, 'Edit Utility', 'edit-utility', 'fa fa-pencil-alt', 'content'),
(10, 6, 'Delete Utility', 'delete-utility', 'fa fa-trash', 'content'),
(11, NULL, 'Access Management', 'access-management', 'fa fa-key', 'mainmenu'),
(12, 11, 'Add Access', 'add-access', 'fa fa-plus-square', 'content'),
(13, 11, 'Edit Access', 'edit-access', 'fa fa-pencil-alt', 'content'),
(14, 11, 'Delete Access', 'delete-access', 'fa fa-trash', 'content'),
(15, NULL, 'Application Settings', 'app-settings', 'fa fa-cogs', 'mainmenu'),
(16, NULL, 'Ticket', 'ticket', 'fas fa-ticket-alt', 'mainmenu'),
(17, 16, 'Add Ticket', 'add-ticket', 'fa fa-plus-square', 'content'),
(18, 16, 'Edit Ticket', 'edit-ticket', 'fa fa-pencil-alt', 'content'),
(19, 16, 'Delete Ticket', 'delete-ticket', 'fa fa-trash', 'content'),
(20, 16, 'Approve Ticket', 'approve-ticket', 'fa fa-check', 'content'),
(21, 16, 'Close Ticket', 'close-ticket', 'fa fa-ban', 'content'),
(22, NULL, 'On Going', 'on-going', 'fa fa-clock', 'mainmenu'),
(23, 22, 'Update Progress', 'update-progress', 'fa fa-check', 'content'),
(24, NULL, 'Report & Documentation', '#', 'fa fa-table', 'mainmenu'),
(25, 24, 'Add Report', 'add-report', NULL, 'submenu'),
(26, 24, 'Reports', 'reports', NULL, 'submenu'),
(27, 24, 'Documentations', 'documentations', NULL, 'submenu'),
(29, 24, 'Daily Report', 'daily-report', NULL, 'submenu'),
(30, 24, 'Edit Report', 'edit-report', 'fas fa-pencil-alt', 'content'),
(31, 24, 'Delete Report', 'delete-report', 'fas fa-trash', 'content'),
(32, 24, 'Copy Report', 'copy-report', 'fas fa-copy', 'content'),
(33, 24, 'Monthly Documentation', 'monthly-documentation', NULL, 'content'),
(34, 24, 'Download', 'download-documentation', 'fa fa-download', 'content'),
(35, 24, 'Preview', 'preview-documentation', 'fa fa-eye', 'content'),
(36, 24, 'Print Documentation', 'print-documentation', 'fa fa-print', 'content'),
(37, 24, 'Periodic Report', 'periodic-report', NULL, 'content'),
(38, NULL, 'Employee Reports', 'employee-reports', 'fas fa-briefcase', 'mainmenu'),
(39, 38, 'Employee Profile', 'profile', NULL, 'content'),
(40, NULL, 'Schedule', 'schedule', 'fa fa-calendar', 'mainmenu'),
(41, NULL, 'Libraries', '#', 'fa fa-book', 'mainmenu'),
(42, 41, 'Add Ebook', 'add-ebook', NULL, 'submenu'),
(43, 41, 'Edit Ebook', 'edit-ebook', 'fa fa-pencil-alt', 'content'),
(44, 41, 'Delete Ebook', 'delete-ebook', 'fa fa-trash', 'content'),
(45, 41, 'Download Ebook', 'download-ebook', 'fa fa-download', 'content'),
(46, 24, 'Report Detail', 'report-detail', 'fa fa-eye', 'content'),
(47, 16, 'Ticket Detail', 'ticket-detail', 'fa fa-eye', 'content'),
(48, 24, 'Monthly Report', 'monthly-report', NULL, 'content'),
(49, 24, 'Periodic Documentation', 'periodic-documentation', NULL, 'content'),
(50, 24, 'Delete Documentation', 'delete-documentation', 'fas fa-trash', 'content'),
(51, 24, 'Merge PDF', 'merge-pdf', NULL, 'submenu'),
(52, 41, 'Libraries', 'libraries', NULL, 'submenu'),
(53, 2, 'Employee List', 'employee', NULL, 'submenu'),
(54, 11, 'Update Index', 'update-index', NULL, 'content'),
(55, NULL, 'Search', 'search-result', NULL, 'content');

-- --------------------------------------------------------

--
-- Table structure for table `tb_picture`
--

CREATE TABLE `tb_picture` (
  `picture_id` int(10) NOT NULL,
  `activity_id` int(10) NOT NULL,
  `upload_date` date NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_roles`
--

CREATE TABLE `tb_roles` (
  `role_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_roles`
--

INSERT INTO `tb_roles` (`role_id`, `type_id`, `menu_id`) VALUES
(15, 2, 1),
(16, 2, 22),
(17, 2, 23),
(18, 2, 16),
(19, 2, 20),
(20, 2, 21),
(21, 2, 25),
(22, 2, 24),
(23, 2, 26),
(24, 2, 27),
(25, 2, 29),
(26, 2, 30),
(27, 2, 31),
(28, 2, 32),
(29, 2, 33),
(30, 2, 37),
(31, 2, 38),
(32, 2, 39),
(33, 2, 40),
(34, 2, 35),
(35, 2, 36),
(36, 2, 34),
(37, 2, 41),
(38, 2, 42),
(39, 2, 43),
(40, 2, 44),
(41, 2, 45),
(42, 2, 46),
(45, 2, 47),
(49, 2, 48),
(52, 2, 49),
(55, 2, 50),
(56, 2, 51),
(58, 2, 52),
(82, 5, 17),
(83, 5, 19),
(84, 5, 18),
(85, 5, 16),
(86, 5, 47),
(87, 3, 53),
(88, 3, 2),
(89, 3, 48),
(90, 3, 49),
(91, 3, 46),
(92, 3, 47),
(94, 4, 53),
(95, 4, 2),
(96, 4, 48),
(97, 4, 49),
(98, 4, 46),
(99, 4, 47),
(100, 1, 11),
(101, 1, 12),
(102, 1, 3),
(103, 1, 8),
(104, 1, 15),
(105, 1, 14),
(106, 1, 5),
(107, 1, 10),
(108, 1, 13),
(109, 1, 4),
(110, 1, 9),
(111, 1, 53),
(112, 1, 2),
(113, 1, 54),
(114, 1, 6),
(116, 2, 55);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ticket`
--

CREATE TABLE `tb_ticket` (
  `ticket_id` int(11) NOT NULL,
  `ticket_code` varchar(8) NOT NULL,
  `category_activity_id` int(2) DEFAULT 14,
  `problem_report` text NOT NULL,
  `reporter` varchar(80) NOT NULL,
  `date_report` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `approved_by` varchar(80) DEFAULT NULL,
  `solved_by` varchar(80) DEFAULT NULL,
  `date_solved` date DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `status` enum('opened','approved','closed') DEFAULT 'opened'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_ticket`
--

INSERT INTO `tb_ticket` (`ticket_id`, `ticket_code`, `category_activity_id`, `problem_report`, `reporter`, `date_report`, `created_by`, `approved_by`, `solved_by`, `date_solved`, `location`, `status`) VALUES
(2, 'YIRHJCU2', 3, 'Wifi tidak bisa terhubung dengan Internet', 'Staf Walikota', '2020-02-21', 10, 'Muhammad Ridwan Naim', 'Muhammad Ridwan Naim', NULL, 'Ruang Staf Walikota', 'opened'),
(4, 'VDXAE1OC', 3, 'Wifi tidak bisa terhubung dengan Internet', 'Staf Walikota', '2019-12-01', 10, 'Muhammad Ridwan Naim', 'Muhammad Ridwan Naim', NULL, 'Ruang Staf Walikota', 'opened'),
(10, 'V0FD34O8', 3, 'Internet nya tidak stabil ', 'ian', '2020-06-15', NULL, 'Muhammad Anwar Lain', 'Muhammad Anwar Lain', NULL, 'tlr', 'opened'),
(11, '7VHY6P89', 3, 'akses internet WIFI nya down', 'Kris', '2020-06-17', NULL, 'Muhammad Ridwan Naim', 'Muhammad Ridwan Naim', NULL, 'Bid. DIKP', 'opened'),
(12, 'FZ57I48M', 3, 'Koneksi TLR down', 'IAN', '2020-06-23', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'tlr', 'opened'),
(13, 'EBW73NK1', 18, 'Koneksi Internet down', 'memet', '2020-06-24', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'BAPENDA', 'opened'),
(14, 'WT7AQR5D', 18, 'NO INTERNET', 'INDAH', '2020-06-24', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'KASDA', 'opened'),
(15, 'GUPM3Y0J', 3, 'Ga bisa akses internet', 'ENO', '2020-06-25', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'KASDA', 'opened'),
(16, 'AJ0WHUED', 3, 'Internet lambat ', 'Slamet', '2020-06-25', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'BAPENDA ', 'opened'),
(17, '0F3HTQXE', 1, 'Instalasi jaringan untuk 1 PC', 'Fauzi Ruslan', '2020-06-25', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'DP3AP2KB', 'opened'),
(18, '9EA1N52H', 2, 'Configurasi IP', 'KASIDI', '2020-07-01', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'BPKD', 'opened'),
(19, 'X90FKSZB', 1, 'PEMASANGAN WIFI', 'Fauzi Ruslan', '2020-07-02', NULL, 'Muhammad Ridwan Naim', 'Muhammad Ridwan Naim', NULL, 'DP3AP2KB', 'opened'),
(20, 'IKRZ7FCL', 2, 'setting koneksi internet di PC via LAN', 'Rininta', '2020-08-07', NULL, 'Muhammad Anwar Lain', 'Muhammad Anwar Lain', NULL, 'Bidang Penatausahaan dan Akuntansi (BPKD)', 'opened'),
(21, 'WKI5G84C', 2, 'tidak terkoneksi internet', 'Pipin', '2020-08-10', NULL, 'Muhammad Anwar Lain', 'Muhammad Anwar Lain', NULL, ' Bidang Penatausahaan dan Akuntansi - BPKD', 'opened'),
(22, 'JO5RIK2F', 3, 'Rak Server terkena air sehingga perangkat perlu di matikan terlebih dahulu', 'Dhian', '2020-09-04', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Bidang Penatausahaan dan Akuntansi BPKD', 'opened'),
(23, 'BAIFQ40Y', 1, 'kabel lan', 'Dhian', '2020-09-07', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Bidang Penatausahaan dan Akuntansi (BPKD)', 'opened'),
(24, 'PRZ5KH0M', 3, 'jaringan internet bapenda tidak bisa diakses\r\n', 'Slamet', '2020-09-08', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'BAPENDA ', 'opened'),
(25, 'H48JPVK0', 1, 'instalasi alat zoom', 'Wahyu', '2020-09-08', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'asda 3', 'opened'),
(26, '9DPCQV46', 19, 'Zoom Meeting', 'Wahyu', '2020-09-17', NULL, 'Muhammad Ridwan Naim', 'Muhammad Ridwan Naim', NULL, 'Setda', 'opened'),
(27, 'OB50DF41', 3, 'NO INTERNET ACCESS', 'INDAH', '2020-09-25', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'KASDA', 'opened'),
(28, '6H2BVWTO', 3, 'internet nya down ', 'IAN', '2020-10-09', NULL, 'Muhammad Anwar Lain', 'Kurniawan Rifaldi', NULL, 'TLR', 'opened'),
(29, 'Y3QFZB7D', 3, 'Jaringan internet nya lemot', 'Kiki', '2020-10-13', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'DIKP', 'opened'),
(30, '20ZB6AMQ', 26, 'ip nya hilang setelah instal ulang', 'Slamet', '2020-10-27', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'BAPENDA ', 'opened'),
(31, '14AQOKFH', 3, 'no internet ', 'Ririn', '2020-11-02', NULL, 'Muhammad Anwar Lain', 'Muhammad Anwar Lain', NULL, 'Dalbang', 'opened'),
(32, 'GMJXH49S', 3, 'Smart Tv gabisa connect wifi', 'Dhian', '2020-11-06', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Bidang Penatausahaan dan Akuntansi (BPKD)', 'opened'),
(33, '9AVCZH1D', 3, 'tidak bisa menggunakan youtube dll', 'ENO', '2020-11-09', NULL, 'Muhammad Ridwan Naim', 'Muhammad Ridwan Naim', NULL, 'BPKD', 'opened'),
(34, '0HC78R2V', 3, 'Internet nya mati', 'Yeti', '2020-11-09', NULL, 'Muhammad Ridwan Naim', 'Muhammad Ridwan Naim', NULL, 'BAPENDA Lt 2', 'opened'),
(35, 'N49KYWSD', 3, 'internetnya mati', 'Puspita', '2020-11-12', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Badan Pendapatan Daerah lt 2', 'opened'),
(36, '6TARSP2G', 3, 'no Internet', 'Puji', '2020-11-24', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Bidang Penatausahaan dan Akuntansi (BPKD)', 'opened'),
(37, '4IMHNE15', 1, 'internet ga stabil', 'IAN', '2020-11-24', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'tlr', 'opened'),
(38, 'EHU1RZOS', 3, 'internet ga stabil', 'Sari', '2020-11-24', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Dalbang', 'opened'),
(39, 'XE7UFMT1', 3, 'no internet', 'IAN', '2020-12-01', NULL, 'Muhammad Ridwan Naim', 'Muhammad Ridwan Naim', NULL, 'tlr', 'opened'),
(40, 'LNHPMDCY', 3, 'Internetnya ga stabil', 'Wahyu', '2020-12-02', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Sekda', 'opened'),
(41, '2G49KC6Y', 19, 'Minta link zoom', 'Nanda', '2020-12-04', NULL, 'Muhammad Anwar Lain', 'Muhammad Anwar Lain', NULL, 'BPKD Kota Tangerang', 'opened'),
(42, 'NH21I5UZ', 3, 'Internet nya mati', 'IAN', '2020-12-05', NULL, 'Muhammad Ridwan Naim', 'Muhammad Ridwan Naim', NULL, 'tlr', 'opened'),
(43, 'WTSLMX4H', 3, 'Koneksi gak stabil ', 'IAN', '2020-12-13', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'tlr', 'opened'),
(44, 'Y3K09ZDL', 3, 'no internet', 'Mokhtar', '2020-12-15', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Disnaker', 'opened'),
(45, 'R6X9PNWJ', 3, 'jaringan ga stabil di sekertariat dan di Irban 1, 2, 3, 4 koneksi ga ada', 'Ade Jenny', '2020-12-17', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Inspektorat', 'opened'),
(46, 'CYOWQLAG', 3, 'Jaringan ga stabil di lantai 2 dan 4 gedung disnaker', 'Mokhtar', '2020-12-17', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Disnaker', 'opened'),
(47, 'VQXBLZ9K', 3, 'Akses SIMPAD ke server mau backup dan akses web tangerang lemot', 'Nanda', '2020-12-28', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'BPKD', 'opened'),
(48, 'WYPT3026', 1, 'ada komputer baru jadi mau minta kabel lan buat akses internet', 'Nanda', '2021-01-28', NULL, 'Muhammad Anwar Lain', 'Muhammad Anwar Lain', NULL, 'BPKD', 'opened'),
(49, 'EJ0TDV7O', 3, 'jaringannya ga stabil ', 'Mochtar', '2020-12-30', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Disnaker', 'opened'),
(50, 'LG58B7Q0', 3, 'Jaringan internet disnaker tidak bisa diakses', 'Lidia', '2020-12-30', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Disnaker', 'opened'),
(51, 'IONL9347', 3, 'Wifi Fraksi PKS tidak bisa konek internet', 'Herianto', '2020-12-30', NULL, 'Hadi Margono Salim', 'Hadi Margono Salim', NULL, 'Fraksi PKS', 'opened'),
(52, 'JWRP7V60', 3, 'Jaringan internet tidak stabil', 'Sharie', '2021-01-04', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'BPKD', 'opened'),
(53, '6VQBKXC4', 3, 'Internet DIKP mati', 'Irvan ', '2021-01-07', NULL, 'Muhammad Anwar Lain', 'Muhammad Anwar Lain', NULL, 'DIKP', 'opened'),
(54, 'T46D9K2P', 3, 'gabisa akses internet', 'Nanda', '2021-01-11', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'BPKD bid PL', 'opened'),
(55, 'O1CMYUB6', 3, 'internet di kasda  di tempat bu eno bermasalah', 'Eno', '2021-01-11', NULL, 'Hadi Margono Salim', 'Hadi Margono Salim', NULL, 'BPKD', 'opened'),
(56, '6AB7ZVW5', 3, 'Wifi di ruang pak kadis no internet padahal pake LAN', 'Pak Kadis', '2021-01-19', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'DP3AP2KB', 'opened'),
(57, 'EPXNG4VR', 3, 'Bid Pemberdayaan Perempuan jaringannya no internet yang pake kabel LAN ', 'Bid Pemberdayaan Perempuan', '2021-01-21', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'DP3AP2KB', 'opened'),
(58, 'BCXIAY7Z', 1, ' setup koneksi jaringan internet pada PC yg pegawai pns baru ada 3 orang', 'Dhian', '2021-01-26', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Bidang Penatausahaan dan Akuntansi (BPKD)', 'opened'),
(59, '7NTQ6MIX', 3, 'Koneksi internet di tlr tidak stabil', 'IAN', '2021-01-26', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'tlr', 'opened'),
(60, '39Z60BG2', 3, 'internet di disnaker tidak stabil', 'Khaetamy', '2021-03-27', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Disnaker', 'opened'),
(61, 'PSZCN3DX', 3, 'Internet di tlr tidak bisa konek tidak bisa browsing juga', 'IAN', '2021-01-28', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'tlr', 'opened'),
(62, 'UIQG9V8R', 3, 'Internet d ruangan sekpri bpkd internetnya ga konek', 'Nanda', '2021-02-10', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'BPKD', 'opened'),
(63, 'AUD4RJ37', 3, 'Internet di tlr RTO', 'IAN', '2021-02-11', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'tlr', 'opened'),
(64, 'M9GDCKT4', 3, 'WiFi yang di fraksi Golkar sudah 1 Minggu tidak aktif. (Tidak ada koneksi)', 'Ridwan', '2021-02-17', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Fraksi Golkar', 'opened'),
(65, 'JMNFS9CI', 3, 'perangkat wifi fraksi golkar mati, kemungkinan kabel adaptor yang ada didisdik nya di cabut/ turun ncb nya ', 'Ridwan', '2021-02-23', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Fraksi Golkar', 'opened'),
(66, 'RT05EHAO', 3, 'Wifi di tlr tidak dapat konek atau terdeteksi', 'IAN', '2021-03-01', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'tlr', 'opened'),
(67, '521J9HTU', 3, 'Perangkat wifi nya masih mati', 'Ridwan', '2021-03-03', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Fraksi Golkar', 'opened'),
(68, 'IYK4O3AM', 3, 'wifi di dinas perkim tidak stabil ', 'Syifani', '2021-03-04', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Dinas Perkim', 'opened'),
(69, 'FW2HQ3SI', 1, 'Cek PC pa wawan di skret kominfo', 'Wawan ', '2021-03-15', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'KOMINFO (SEKRET)', 'opened'),
(70, 'FOGEJ9K4', 3, 'no internet', 'Sari', '2021-03-19', NULL, 'Kurniawan Rifaldi', 'Kurniawan Rifaldi', NULL, 'Dalbang', 'opened'),
(71, '306XAIC5', 3, 'Internet di 2 Komputer mati ', 'Dimas', '2021-03-31', NULL, 'Hadi Margono Salim', 'Hadi Margono Salim', NULL, 'Bid Penatausahaan dan Akuntansi  (BPKD)', 'opened'),
(72, 'J9DBPFTG', 3, 'gangguan internet di gedung disnaker lt 2 terutama perangkat PC', 'Dani Syarifudin', '2021-04-01', NULL, 'Muhammad Ridwan Naim', 'Muhammad Ridwan Naim', '2021-06-01', 'Disnaker', 'closed');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tool`
--

CREATE TABLE `tb_tool` (
  `tool_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `tool` varchar(200) NOT NULL,
  `tool_owner` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(2) NOT NULL,
  `jobdesc_id` int(2) DEFAULT 1,
  `employee_id` int(2) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_token` varchar(255) DEFAULT NULL,
  `jobdesc_series` int(2) NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `last_ip` varbinary(16) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `jobdesc_id`, `employee_id`, `user_name`, `user_password`, `user_email`, `user_token`, `jobdesc_series`, `last_login`, `last_ip`, `is_active`) VALUES
(1, 4, 1, 'superadmin', '$argon2id$v=19$m=2048,t=4,p=3$UjBhR1dFSkViWnc2aHhFOQ$K0wr46CnDVp9xBJ8ycejcP3gy76wUrbS+zegcYh1KNg', 'mrnaeem@tutanota.com', NULL, 1, 1622741305, 0x7f000001, 1),
(10, 6, 10, 'helpdeskti', '$argon2id$v=19$m=2048,t=4,p=3$UjBhR1dFSkViWnc2aHhFOQ$K0wr46CnDVp9xBJ8ycejcP3gy76wUrbS+zegcYh1KNg', 'noc.kominfo@tangerangkota.go.id', '', 1, 1622740201, 0x7f000001, 1),
(11, 7, 11, 'kabid', '$argon2id$v=19$m=2048,t=4,p=3$UjBhR1dFSkViWnc2aHhFOQ$K0wr46CnDVp9xBJ8ycejcP3gy76wUrbS+zegcYh1KNg', 'kabid@somewhere.com', '', 1, 1622741274, 0x7f000001, 1),
(12, 9, 12, 'pptk', '$argon2id$v=19$m=2048,t=4,p=3$UjBhR1dFSkViWnc2aHhFOQ$K0wr46CnDVp9xBJ8ycejcP3gy76wUrbS+zegcYh1KNg', 'pptk@somewhere.com', '', 1, 1622741240, 0x7f000001, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_type`
--

CREATE TABLE `tb_user_type` (
  `type_id` int(11) NOT NULL,
  `type_code` varchar(80) NOT NULL,
  `index_page` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user_type`
--

INSERT INTO `tb_user_type` (`type_id`, `type_code`, `index_page`) VALUES
(1, 'userman', 'employee'),
(2, 'employee', 'dashboard'),
(3, 'kabid', 'employee'),
(4, 'kasie', 'employee'),
(5, 'helpdesk', 'ticket');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_activity`
--
ALTER TABLE `tb_activity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `category_activity_id` (`category_activity_id`),
  ADD KEY `tb_activity_ibfk_3` (`ticket_code`);

--
-- Indexes for table `tb_app_setting`
--
ALTER TABLE `tb_app_setting`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `tb_category_activity`
--
ALTER TABLE `tb_category_activity`
  ADD PRIMARY KEY (`category_activity_id`);

--
-- Indexes for table `tb_ebook`
--
ALTER TABLE `tb_ebook`
  ADD PRIMARY KEY (`ebook_id`),
  ADD KEY `user_id` (`employee_id`);

--
-- Indexes for table `tb_ebook_category`
--
ALTER TABLE `tb_ebook_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tb_jobdesc`
--
ALTER TABLE `tb_jobdesc`
  ADD PRIMARY KEY (`jobdesc_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tb_picture`
--
ALTER TABLE `tb_picture`
  ADD PRIMARY KEY (`picture_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `tb_ticket`
--
ALTER TABLE `tb_ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `category_activity_id` (`category_activity_id`),
  ADD KEY `tb_ticket_ibfk_1` (`created_by`),
  ADD KEY `solved_by` (`solved_by`),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `ticket_code` (`ticket_code`);

--
-- Indexes for table `tb_tool`
--
ALTER TABLE `tb_tool`
  ADD PRIMARY KEY (`tool_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `jobdesc_id` (`jobdesc_id`);

--
-- Indexes for table `tb_user_type`
--
ALTER TABLE `tb_user_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_activity`
--
ALTER TABLE `tb_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6948;

--
-- AUTO_INCREMENT for table `tb_category_activity`
--
ALTER TABLE `tb_category_activity`
  MODIFY `category_activity_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_ebook`
--
ALTER TABLE `tb_ebook`
  MODIFY `ebook_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_ebook_category`
--
ALTER TABLE `tb_ebook_category`
  MODIFY `id_category` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `employee_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_jobdesc`
--
ALTER TABLE `tb_jobdesc`
  MODIFY `jobdesc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_picture`
--
ALTER TABLE `tb_picture`
  MODIFY `picture_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2223;

--
-- AUTO_INCREMENT for table `tb_roles`
--
ALTER TABLE `tb_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tb_ticket`
--
ALTER TABLE `tb_ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tb_tool`
--
ALTER TABLE `tb_tool`
  MODIFY `tool_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_user_type`
--
ALTER TABLE `tb_user_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_activity`
--
ALTER TABLE `tb_activity`
  ADD CONSTRAINT `tb_activity_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tb_employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_activity_ibfk_2` FOREIGN KEY (`category_activity_id`) REFERENCES `tb_category_activity` (`category_activity_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_activity_ibfk_3` FOREIGN KEY (`ticket_code`) REFERENCES `tb_ticket` (`ticket_code`) ON DELETE SET NULL;

--
-- Constraints for table `tb_ebook`
--
ALTER TABLE `tb_ebook`
  ADD CONSTRAINT `tb_ebook_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tb_employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_jobdesc`
--
ALTER TABLE `tb_jobdesc`
  ADD CONSTRAINT `tb_jobdesc_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `tb_user_type` (`type_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_picture`
--
ALTER TABLE `tb_picture`
  ADD CONSTRAINT `tb_picture_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `tb_activity` (`activity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD CONSTRAINT `tb_roles_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `tb_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_roles_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `tb_user_type` (`type_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_ticket`
--
ALTER TABLE `tb_ticket`
  ADD CONSTRAINT `tb_ticket_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tb_employee` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_ticket_ibfk_4` FOREIGN KEY (`category_activity_id`) REFERENCES `tb_category_activity` (`category_activity_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tb_tool`
--
ALTER TABLE `tb_tool`
  ADD CONSTRAINT `tb_tool_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `tb_activity` (`activity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tb_employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_user_ibfk_2` FOREIGN KEY (`jobdesc_id`) REFERENCES `tb_jobdesc` (`jobdesc_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;