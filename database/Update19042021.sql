-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 19, 2021 lúc 09:17 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel_phivinh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_01_31_130351_create_tbl_coordinator_table', 1),
(4, '2021_02_19_135336_tbl_course', 2),
(5, '2021_02_20_090305_tbl_user', 3),
(8, '2021_02_23_091011_tbl_category', 4),
(9, '2021_03_23_075755_tbl_asm', 5),
(10, '2021_03_24_141937_tbl_submission', 5),
(11, '2021_03_30_154422_tbl_mark', 6),
(12, '2021_04_12_192908_tbl_comment', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_asm`
--

CREATE TABLE `tbl_asm` (
  `asm_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `asm_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asm_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `exp2` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_asm`
--

INSERT INTO `tbl_asm` (`asm_id`, `course_id`, `asm_name`, `asm_status`, `exp`, `exp2`, `created_at`, `updated_at`) VALUES
(3, 25, 'CoA280321', '1', '2021-04-17 08:53:18', '2021-04-24 06:51:58', NULL, NULL),
(4, 35, 'CoW28032021', '1', '2021-04-17 08:53:30', '2021-04-10 16:59:59', NULL, NULL),
(5, 36, 'CoS222', '1', '2021-04-18 09:31:00', '2021-04-19 09:31:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_des` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_des`, `category_status`, `category_image`, `created_at`, `updated_at`) VALUES
(1, 'Atumn', 'The third season of the year, when crops and fruits are gathered and leaves fall, in the northern hemisphere from September to November and in the southern hemisphere from March to May', '1', 'Winter661061502UTC.jfif', NULL, NULL),
(2, 'Winter', 'The coldest season of the year, in the northern hemisphere from December to February and in the southern hemisphere from June to August.', '1', 'Atumn46303708UTC.jpg', NULL, NULL),
(6, 'Spring 2', 'Spring is the best 2', '1', 'Winter6703721192021.jfif', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `cmt_id` int(10) UNSIGNED NOT NULL,
  `submission_id` int(11) NOT NULL,
  `mark_id` int(11) NOT NULL,
  `mark_comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_comment`
--

INSERT INTO `tbl_comment` (`cmt_id`, `submission_id`, `mark_id`, `mark_comment`, `created_at`, `updated_at`) VALUES
(5, 28, 16, 'Student One1: aa', NULL, NULL),
(6, 28, 1, 'Coordinator One: vang', NULL, NULL),
(7, 36, 17, 'Coordinator Ten: You so good, your document will approve', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_course`
--

CREATE TABLE `tbl_course` (
  `course_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_des` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_status` int(11) NOT NULL,
  `course_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `category_id`, `course_name`, `course_des`, `course_status`, `course_image`, `created_at`, `updated_at`) VALUES
(25, 1, 'Color of Atumn', 'Color of Atumn is best topic of Athumn', 1, 'CorlorOfAthumn1518788581UTC.jpg', NULL, NULL),
(35, 2, 'Color Of Winter', 'Color Of Winter', 1, 'ColorOfWinter10104934402021.jpg', NULL, NULL),
(36, 6, 'Color of Spring', 'Color of Spring is good', 1, 'ColorOfWinter3399113632021.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_mark`
--

CREATE TABLE `tbl_mark` (
  `mark_id` int(10) UNSIGNED NOT NULL,
  `coordinator_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `mark` double(8,2) DEFAULT NULL,
  `mark_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mark_comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_mark`
--

INSERT INTO `tbl_mark` (`mark_id`, `coordinator_id`, `student_id`, `submission_id`, `mark`, `mark_status`, `mark_comment`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 28, 9.70, '1', 'Good Job 22', NULL, NULL),
(9, 2, 7, 32, 5.30, '0', 'Try Again', NULL, NULL),
(10, 2, 9, 33, 8.70, '1', 'Verry good', NULL, NULL),
(11, 2, 10, 34, 6.20, '0', 'Try Again', NULL, NULL),
(16, 2, 3, 35, 3.50, '0', 'You need try again!', NULL, NULL),
(17, 12, 11, 36, 9.30, '1', 'So good', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_submission`
--

CREATE TABLE `tbl_submission` (
  `submission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asm_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submission_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf_review` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_submission`
--

INSERT INTO `tbl_submission` (`submission_id`, `user_id`, `course_id`, `course_name`, `asm_name`, `submission_file`, `pdf_review`, `image_file`, `created_at`, `updated_at`) VALUES
(28, 3, 35, 'Color Of Winter', 'CoW28032021', 'result2977261872021706518192021.docx', 'result29772618720215714.pdf', 'qrcode_www16853383412021.png', NULL, NULL),
(32, 7, 35, 'Color Of Winter', 'CoW28032021', 'Guide for individual Report11202340012021.docx', 'Guide for individual Report9152.pdf', '162130202_449942562905395_4785547693286415725_o14866576312021.jpg', NULL, NULL),
(33, 9, 35, 'Color Of Winter', 'CoW28032021', 'UC113962048732021.docx', 'UC18060.pdf', 'logo-removebg-preview2269558022021.png', NULL, NULL),
(34, 10, 35, 'Color Of Winter', 'CoW28032021', 'COMP16823849222762021.docx', 'COMP16829827.pdf', 'Page_113432783302021.png', NULL, NULL),
(35, 3, 25, 'Color of Atumn', 'CoA280321', 'result29772618720212342082552021.docx', 'result29772618720216249.pdf', 'z2328813117076_91d977f6e5de306528720fa8c3995e7f1679016202021.jpg', NULL, NULL),
(36, 11, 36, 'Color of Spring', 'CoS222', 'result297726187202119894625412021.docx', 'result29772618720217469.pdf', 'cour12031572652021.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_gender` int(11) NOT NULL,
  `user_birthday` date NOT NULL,
  `user_role` int(11) NOT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_email`, `user_password`, `user_fullname`, `user_phone`, `user_gender`, `user_birthday`, `user_role`, `user_image`, `created_at`, `updated_at`) VALUES
(2, 'Coordinator1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Coordinator One', '23235656598', 1, '1992-02-18', 2, 'Coordinator One1901987389UTC.png', NULL, NULL),
(3, 'Student1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Student One1', '01213156489', 0, '2000-02-19', 1, 'Student-One374064162UTC.jpg', NULL, NULL),
(4, 'Admin1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin One', '03232656562', 0, '1982-02-03', 0, 'admin.png', NULL, NULL),
(5, 'Manager1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Manager One', '03213216156', 0, '1972-02-04', 3, 'Manager One1215514209UTC.jpg', NULL, NULL),
(6, 'Guest1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Guest One', '02123154564', 1, '2001-02-04', 4, 'Guest One888711563UTC.png', NULL, NULL),
(7, 'Student2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Student Two', '03211654489', 1, '1999-02-03', 1, 'Student Two896988113UTC.jpg', NULL, NULL),
(9, 'student3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Student Three', '0332365874', 0, '1999-06-11', 1, 'Student One276035505Asia/Ho_Chi_Minh.jpg', NULL, NULL),
(10, 'Student4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Student Four', '0326854712', 1, '2003-06-11', 1, 'Student One1793257687Asia/Ho_Chi_Minh.jpg', NULL, NULL),
(11, 'student10@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Student ten', '0326598745', 0, '2017-06-17', 1, 'Student Two767489140Asia/Ho_Chi_Minh.jpg', NULL, NULL),
(12, 'Coordinator10@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Coordinator Ten', '0326595956', 0, '2021-04-09', 2, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_asm`
--
ALTER TABLE `tbl_asm`
  ADD PRIMARY KEY (`asm_id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`cmt_id`);

--
-- Chỉ mục cho bảng `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `FOREIGN` (`category_id`) USING BTREE;

--
-- Chỉ mục cho bảng `tbl_mark`
--
ALTER TABLE `tbl_mark`
  ADD PRIMARY KEY (`mark_id`);

--
-- Chỉ mục cho bảng `tbl_submission`
--
ALTER TABLE `tbl_submission`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `FOREIN` (`user_id`),
  ADD KEY `FOREIN2` (`course_id`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_asm`
--
ALTER TABLE `tbl_asm`
  MODIFY `asm_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `cmt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `tbl_mark`
--
ALTER TABLE `tbl_mark`
  MODIFY `mark_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `tbl_submission`
--
ALTER TABLE `tbl_submission`
  MODIFY `submission_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
