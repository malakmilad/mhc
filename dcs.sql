-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2018 at 03:20 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_services`
--

CREATE TABLE `customer_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `group_menu_permissions`
--

CREATE TABLE `group_menu_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `add` tinyint(1) NOT NULL DEFAULT '0',
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `update` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_menu_permissions`
--

INSERT INTO `group_menu_permissions` (`id`, `menu_id`, `group_id`, `add`, `delete`, `update`, `deleted_at`, `created_at`, `updated_at`, `view`) VALUES
(1, 1, 1, 1, 1, 1, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14', 1),
(2, 2, 1, 1, 1, 1, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14', 1),
(3, 3, 1, 1, 1, 1, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14', 1),
(4, 4, 1, 1, 1, 1, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14', 1),
(5, 5, 1, 1, 1, 1, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14', 1),
(6, 6, 1, 1, 1, 1, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14', 1),
(7, 7, 1, 1, 1, 1, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14', 1),
(8, 8, 1, 1, 1, 1, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `icon`, `url`, `parent_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'القوائم', 'fa fa-folder-open-o', 'menu.index', NULL, NULL, '2018-01-22 12:19:13', '2018-01-22 12:19:13'),
(2, 'قائمة المجموعات', 'fa fa-users', 'group.index', NULL, NULL, '2018-01-22 12:19:13', '2018-01-22 12:19:13'),
(3, 'قائمة المستخدمين', 'fa fa-user', 'user.index', NULL, NULL, '2018-01-22 12:19:13', '2018-01-22 12:19:13'),
(4, 'قائمة متابعة العملاء', 'fa fa-user', 'sheet.index', NULL, NULL, '2018-01-22 12:19:13', '2018-01-22 12:19:13'),
(5, 'قائمة المهتمين', 'fa fa-user', 'interest.index', NULL, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14'),
(6, 'قائمة انواع الهاتف', 'fa fa-phone', 'phonetype.index', NULL, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14'),
(7, 'الخدمات', 'fa fa-cart-plus', 'service.index', NULL, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14'),
(8, 'قائمة المواعيد', 'fa fa-clock-o', 'timetable.index', NULL, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_01_11_104744_create_sheets_table', 1),
(4, '2018_01_11_104954_create_phones_table', 1),
(5, '2018_01_14_093648_create_add_color_sheet_table', 1),
(6, '2018_01_20_125538_create_groups_table', 1),
(7, '2018_01_20_125608_create_menus_table', 1),
(8, '2018_01_20_125625_create_user_groups_table', 1),
(9, '2018_01_20_125657_create_group_menu_permissions_table', 1),
(10, '2018_01_21_124714_create_servics_table', 1),
(11, '2018_01_21_124920_create_phone_types_table', 1),
(12, '2018_01_21_125316_create_customer_services_table', 1),
(13, '2018_01_21_125932_create_add_phonetype_sheet_table', 1),
(14, '2018_01_22_082055_create_time_tables_table', 1),
(15, '2018_01_22_124626_create_add_view_permi_create', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sheet_id` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phonetype_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_types`
--

CREATE TABLE `phone_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servics`
--

CREATE TABLE `servics` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sheets`
--

CREATE TABLE `sheets` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dynmicdate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activitytype` text COLLATE utf8mb4_unicode_ci,
  `note` text COLLATE utf8mb4_unicode_ci,
  `followtype` text COLLATE utf8mb4_unicode_ci,
  `isintrest` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_tables`
--

CREATE TABLE `time_tables` (
  `id` int(10) UNSIGNED NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dydate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meetingplace` text COLLATE utf8mb4_unicode_ci,
  `note` text COLLATE utf8mb4_unicode_ci,
  `meetingstate` tinyint(1) NOT NULL DEFAULT '0',
  `sheet_id` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `logo` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `type`, `logo`, `email`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '1', NULL, 'admin@admin.com', '$2y$10$vmmTKLk09PSFrlnOzUflbeckRWd9VeLn5TcN7cHvR/1tPGXSatT92', NULL, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `user_id`, `group_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2018-01-22 12:19:14', '2018-01-22 12:19:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_services`
--
ALTER TABLE `customer_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_services_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_services_service_id_foreign` (`service_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_menu_permissions`
--
ALTER TABLE `group_menu_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_menu_permissions_menu_id_foreign` (`menu_id`),
  ADD KEY `group_menu_permissions_group_id_foreign` (`group_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phones_sheet_id_foreign` (`sheet_id`),
  ADD KEY `phones_phonetype_id_foreign` (`phonetype_id`);

--
-- Indexes for table `phone_types`
--
ALTER TABLE `phone_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servics`
--
ALTER TABLE `servics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sheets`
--
ALTER TABLE `sheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sheets_user_id_foreign` (`user_id`);

--
-- Indexes for table `time_tables`
--
ALTER TABLE `time_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_tables_sheet_id_foreign` (`sheet_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_groups_user_id_foreign` (`user_id`),
  ADD KEY `user_groups_group_id_foreign` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_services`
--
ALTER TABLE `customer_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_menu_permissions`
--
ALTER TABLE `group_menu_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_types`
--
ALTER TABLE `phone_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servics`
--
ALTER TABLE `servics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sheets`
--
ALTER TABLE `sheets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_tables`
--
ALTER TABLE `time_tables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_services`
--
ALTER TABLE `customer_services`
  ADD CONSTRAINT `customer_services_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `sheets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `servics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_menu_permissions`
--
ALTER TABLE `group_menu_permissions`
  ADD CONSTRAINT `group_menu_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_menu_permissions_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `phones`
--
ALTER TABLE `phones`
  ADD CONSTRAINT `phones_phonetype_id_foreign` FOREIGN KEY (`phonetype_id`) REFERENCES `phone_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phones_sheet_id_foreign` FOREIGN KEY (`sheet_id`) REFERENCES `sheets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sheets`
--
ALTER TABLE `sheets`
  ADD CONSTRAINT `sheets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `time_tables`
--
ALTER TABLE `time_tables`
  ADD CONSTRAINT `time_tables_sheet_id_foreign` FOREIGN KEY (`sheet_id`) REFERENCES `sheets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD CONSTRAINT `user_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
