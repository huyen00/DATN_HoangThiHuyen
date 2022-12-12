-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 12, 2022 lúc 07:59 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel_test`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `acl_rules`
--

CREATE TABLE `acl_rules` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_hotspots`
--

CREATE TABLE `category_hotspots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_hotspots`
--

INSERT INTO `category_hotspots` (`id`, `name`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'skin_hotspotstyle', 'default', '1', '2022-11-17 19:59:54', '2022-11-17 19:59:54'),
(2, 'skin_hotspotstyle_move', 'move', '1', '2022-11-17 19:59:54', '2022-11-17 19:59:54'),
(3, 'skin_hotspotstyle_ani', 'circle animation', '1', '2022-11-17 19:59:54', '2022-11-17 19:59:54'),
(4, 'hs_flycam', 'flycam', '1', '2022-11-17 19:59:54', '2022-11-17 19:59:54'),
(5, 'hotspot_ide', 'ide', '1', '2022-11-17 19:59:54', '2022-11-17 19:59:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_news`
--

CREATE TABLE `category_news` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_panos`
--

CREATE TABLE `category_panos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_pano_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id_priority` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_vn` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotspot_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id_priority` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `fonts`
--

CREATE TABLE `fonts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` double(8,2) DEFAULT NULL,
  `weight` double(8,2) DEFAULT NULL,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hots_pots`
--

CREATE TABLE `hots_pots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `html` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ath` double(8,2) DEFAULT NULL,
  `atv` double(8,2) DEFAULT NULL,
  `style` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distorted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zoom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `x` double(8,2) DEFAULT NULL,
  `y` double(8,2) DEFAULT NULL,
  `z` double(8,2) DEFAULT NULL,
  `renderer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scale` double(8,2) DEFAULT NULL,
  `alpha` double(8,2) DEFAULT NULL,
  `onload` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `onloaded` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `onhover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `onclick` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedscene` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pano_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_hotspot_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id_priority` bigint(20) DEFAULT NULL,
  `icon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `icon_tours`
--

CREATE TABLE `icon_tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `icon_tours`
--

INSERT INTO `icon_tours` (`id`, `name`, `icon`, `tour_id`, `created_at`, `updated_at`) VALUES
(367, 'hs_flycam', 'Tour/Tour_demoTL-1670570415/skin/hs_flycam.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(368, 'skin_hotspotstyle_move', 'Tour/Tour_demoTL-1670570415/skin/hs_dichuyen1.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(369, 'skin_hotspotstyle_move_prev', 'Tour/Tour_demoTL-1670570415/skin/hs_dichuyen1.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(370, 'skin_hotspotstyle_youtube', 'Tour/Tour_demoTL-1670570415/assets/img/iconyoutube.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(371, 'skin_hotspotstyle_point2', 'Tour/Tour_demoTL-1670570415/skin/hotspot_ani_black_64x64x20.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(372, 'skin_hotspotstyle', 'Tour/Tour_demoTL-1670570415/assets/img/new_spotd7_gif.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(373, 'skin_hotspotstyle_prev', 'Tour/Tour_demoTL-1670570415/assets/img/new_spotd7_gif.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(374, 'hs_image_text', 'Tour/Tour_demoTL-1670570415/skin/hs_text2.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(375, 'skin_hotspotstyle_info', 'Tour/Tour_demoTL-1670570415/skin/icon_info1.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(376, 'show_hide_polygo', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(377, 'skin_hotspotstyle_pointaddress', 'Tour/Tour_demoTL-1670570415/skin/arrow_down.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(378, 'skin_hotspotstyle_pointaddress_nau', 'Tour/Tour_demoTL-1670570415/skin/arrow_down_nau.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(379, 'callout_top', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(380, 'call_out_titles2callout_line', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(381, 'call_out_titles2callout_line_vertical', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(382, 'call_out_titles2callout_title', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(383, 'hotspot_point_address', 'Tour/Tour_demoTL-1670570415/skin/arrow_down.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(384, 'callout_bottom', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(385, 'call_out_titles3callout_line', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(386, 'call_out_titles3callout_line_vertical', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(387, 'call_out_titles3callout_title', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(388, 'callout_right', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(389, 'call_out_titles4callout_line', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(390, 'call_out_titles4callout_line_vertical', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(391, 'call_out_titles4callout_title', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(392, 'callout_pano_left', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(393, 'call_out_titles7callout_line', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(394, 'call_out_titles7callout_line_vertical', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(395, 'call_out_titles7callout_title', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(396, 'callout_point_straight_brown', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(397, 'brown_callout_pulse', 'Tour/Tour_demoTL-1670570415/skin/arrow_down_nau.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(398, 'call_out_titles8callout_line', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(399, 'call_out_titles8callout_line_vertical', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(400, 'call_out_titles8callout_title', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(401, 'callout_point_straight_blue', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(402, 'brown_callout_pulse_blue', 'Tour/Tour_demoTL-1670570415/skin/arrow_down.png', 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(403, 'call_out_titles8callout_line_blue', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(404, 'call_out_titles8callout_line_vertical_blue', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(405, 'call_out_titles8callout_title_blue', NULL, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(406, 'hs_flycam', 'Tour/Tour_demoTL-1670645851/skin/hs_flycam.png', 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(407, 'skin_hotspotstyle_move', 'Tour/Tour_demoTL-1670645851/skin/hs_dichuyen1.png', 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(408, 'skin_hotspotstyle_move_prev', 'Tour/Tour_demoTL-1670645851/skin/hs_dichuyen1.png', 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(409, 'skin_hotspotstyle_youtube', 'Tour/Tour_demoTL-1670645851/assets/img/iconyoutube.png', 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(410, 'skin_hotspotstyle_point2', 'Tour/Tour_demoTL-1670645851/skin/hotspot_ani_black_64x64x20.png', 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(411, 'skin_hotspotstyle', 'Tour/Tour_demoTL-1670645851/assets/img/new_spotd7_gif.png', 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(412, 'skin_hotspotstyle_prev', 'Tour/Tour_demoTL-1670645851/assets/img/new_spotd7_gif.png', 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(413, 'hs_image_text', 'Tour/Tour_demoTL-1670645851/skin/hs_text2.png', 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(414, 'skin_hotspotstyle_info', 'Tour/Tour_demoTL-1670645851/skin/icon_info1.png', 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(415, 'show_hide_polygo', NULL, 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(416, 'skin_hotspotstyle_pointaddress', 'Tour/Tour_demoTL-1670645851/skin/arrow_down.png', 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(417, 'skin_hotspotstyle_pointaddress_nau', 'Tour/Tour_demoTL-1670645851/skin/arrow_down_nau.png', 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(418, 'callout_top', NULL, 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(419, 'call_out_titles2callout_line', NULL, 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(420, 'call_out_titles2callout_line_vertical', NULL, 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(421, 'call_out_titles2callout_title', NULL, 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(422, 'hotspot_point_address', 'Tour/Tour_demoTL-1670645851/skin/arrow_down.png', 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(423, 'callout_bottom', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(424, 'call_out_titles3callout_line', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(425, 'call_out_titles3callout_line_vertical', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(426, 'call_out_titles3callout_title', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(427, 'callout_right', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(428, 'call_out_titles4callout_line', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(429, 'call_out_titles4callout_line_vertical', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(430, 'call_out_titles4callout_title', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(431, 'callout_pano_left', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(432, 'call_out_titles7callout_line', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(433, 'call_out_titles7callout_line_vertical', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(434, 'call_out_titles7callout_title', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(435, 'callout_point_straight_brown', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(436, 'brown_callout_pulse', 'Tour/Tour_demoTL-1670645851/skin/arrow_down_nau.png', 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(437, 'call_out_titles8callout_line', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(438, 'call_out_titles8callout_line_vertical', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(439, 'call_out_titles8callout_title', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(440, 'callout_point_straight_blue', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(441, 'brown_callout_pulse_blue', 'Tour/Tour_demoTL-1670645851/skin/arrow_down.png', 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(442, 'call_out_titles8callout_line_blue', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(443, 'call_out_titles8callout_line_vertical_blue', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34'),
(444, 'call_out_titles8callout_title_blue', NULL, 14, '2022-12-09 21:17:34', '2022-12-09 21:17:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_priority` bigint(20) DEFAULT NULL,
  `imageable_id` int(11) DEFAULT NULL,
  `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `infor_tours`
--

CREATE TABLE `infor_tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_priority` bigint(20) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_vn` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `languageable_id` int(11) DEFAULT NULL,
  `languageable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `languages`
--

INSERT INTO `languages` (`id`, `key`, `en`, `vn`, `languageable_id`, `languageable_type`, `created_at`, `updated_at`) VALUES
(1, 'home', 'home', 'Trang Chủ', 1, 'App\\Models\\Page', '2022-12-11 18:21:06', '2022-12-11 18:21:06'),
(2, 'description1670808066', ' ', ' ', 1, 'App\\Models\\Page', '2022-12-11 18:21:06', '2022-12-11 18:21:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `maps`
--

CREATE TABLE `maps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longtitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_29_050722_create_permission_tables', 1),
(6, '2022_08_02_085035_create_acl_rules_table', 1),
(7, '2022_08_11_013253_create_tours_table', 1),
(8, '2022_08_11_015132_create_category_panos_table', 1),
(10, '2022_08_11_015710_create_setting_tours_table', 1),
(11, '2022_08_12_073042_create_icon_tours_table', 1),
(12, '2022_08_15_023421_create_category_hotspots_table', 1),
(13, '2022_08_15_080040_create_maps_table', 1),
(14, '2022_08_16_070055_create_hots_pots_table', 1),
(15, '2022_08_16_073728_create_contents_table', 1),
(16, '2022_08_17_074725_create_fonts_table', 1),
(17, '2022_08_18_020050_create_setting_displays_table', 1),
(18, '2022_08_18_064905_create_setting_colors_table', 1),
(19, '2022_08_25_042143_create_infor_tours_table', 1),
(20, '2022_08_25_042152_create_voice_contents_table', 1),
(21, '2022_08_26_042656_create_images_table', 1),
(22, '2022_09_05_012148_create_templates_table', 1),
(23, '2022_10_10_013028_create_sounds_table', 1),
(24, '2022_11_14_154354_create_table_news_table', 1),
(25, '2022_11_14_164738_create_table_pages_table', 1),
(26, '2022_11_16_134213_create_table_pages_table', 2),
(27, '2022_08_11_015135_create_panos_table', 3),
(28, '2022_11_23_072324_create_pages_table', 4),
(29, '2022_11_23_072404_create_themes_table', 4),
(30, '2022_11_23_072436_create_sections_table', 4),
(31, '2022_11_23_072525_create_page_contents_table', 4),
(32, '2022_11_23_072842_create_pictures_table', 4),
(33, '2022_11_23_072926_create_category_news_table', 4),
(34, '2022_11_23_072948_create_news_table', 4),
(35, '2022_11_23_073014_create_tags_table', 4),
(36, '2022_11_23_073142_create_tag_new_table', 4),
(37, '2022_11_23_073247_create_languages_table', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding` int(11) DEFAULT 0,
  `view` int(11) DEFAULT 0,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_priority` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `id_priority`, `title`, `description`, `sub_title`, `created_at`, `updated_at`) VALUES
(1, NULL, 'home', 'description1670808066', NULL, '2022-12-11 18:21:06', '2022-12-11 18:21:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page_contents`
--

CREATE TABLE `page_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_priority` int(11) DEFAULT NULL,
  `page_contentable_id` int(11) NOT NULL,
  `page_contentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `panos`
--

CREATE TABLE `panos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_onstart` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_pano_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id_priority` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `panos`
--

INSERT INTO `panos` (`id`, `name`, `thumb_img`, `id_thumb`, `path_onstart`, `tour_id`, `category_pano_id`, `id_priority`, `created_at`, `updated_at`) VALUES
(242, 'Cổng vào trường', 'Tour/Tour_demoTL-1670570415/panos/1.tiles/thumb.jpg', 'scene_1', 'Tour/13/voice/1670638527-testsanbongmp3.mp3', 13, NULL, NULL, '2022-12-09 00:20:16', '2022-12-09 19:15:27'),
(243, 'Trước tòa nhà A1', 'Tour/Tour_demoTL-1670570415/panos/2.tiles/thumb.jpg', 'scene_2', 'Tour/Tour_demoTL-1670570415/assets/testA1.mp3', 13, NULL, NULL, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(244, 'Tòa nhà A2', 'Tour/Tour_demoTL-1670570415/panos/3.tiles/thumb.jpg', 'scene_3', 'Tour/Tour_demoTL-1670570415/assets/testA2.mp3', 13, NULL, NULL, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(245, 'Bên ngoài tòa A1', 'Tour/Tour_demoTL-1670570415/panos/4.tiles/thumb.jpg', 'scene_4', 'Tour/Tour_demoTL-1670570415/', 13, NULL, NULL, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(246, 'Sảnh tòa A1', 'Tour/Tour_demoTL-1670570415/panos/6.tiles/thumb.jpg', 'scene_6', 'Tour/Tour_demoTL-1670570415/', 13, NULL, NULL, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(247, 'Khu vực khuôn viên trường 1', 'Tour/Tour_demoTL-1670570415/panos/7.tiles/thumb.jpg', 'scene_7', 'Tour/Tour_demoTL-1670570415/', 13, NULL, NULL, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(248, 'Khu vực khuôn viên trường 1', 'Tour/Tour_demoTL-1670570415/panos/8.tiles/thumb.jpg', 'scene_8', 'Tour/Tour_demoTL-1670570415/', 13, NULL, NULL, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(249, 'Trước tòa T45', 'Tour/Tour_demoTL-1670570415/panos/9.tiles/thumb.jpg', 'scene_9', 'Tour/Tour_demoTL-1670570415/', 13, NULL, NULL, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(250, 'Sảnh T45', 'Tour/Tour_demoTL-1670570415/panos/10.tiles/thumb.jpg', 'scene_10', 'Tour/Tour_demoTL-1670570415/assets/testT45.mp3', 13, NULL, NULL, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(251, 'Cổng vào trường', 'Tour/Tour_demoTL-1670645851/panos/1.tiles/thumb.jpg', 'scene_1', 'Tour/Tour_demoTL-1670645851/assets/testA1.mp3', 14, NULL, NULL, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(252, 'Trước tòa nhà A1', 'Tour/Tour_demoTL-1670645851/panos/2.tiles/thumb.jpg', 'scene_2', 'Tour/Tour_demoTL-1670645851/assets/testA1.mp3', 14, NULL, NULL, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(253, 'Tòa nhà A2', 'Tour/Tour_demoTL-1670645851/panos/3.tiles/thumb.jpg', 'scene_3', 'Tour/Tour_demoTL-1670645851/assets/testA2.mp3', 14, NULL, NULL, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(254, 'Bên ngoài tòa A1', 'Tour/Tour_demoTL-1670645851/panos/4.tiles/thumb.jpg', 'scene_4', 'Tour/Tour_demoTL-1670645851/', 14, NULL, NULL, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(255, 'Sảnh tòa A1', 'Tour/Tour_demoTL-1670645851/panos/6.tiles/thumb.jpg', 'scene_6', 'Tour/Tour_demoTL-1670645851/', 14, NULL, NULL, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(256, 'Khu vực khuôn viên trường 1', 'Tour/Tour_demoTL-1670645851/panos/7.tiles/thumb.jpg', 'scene_7', 'Tour/Tour_demoTL-1670645851/', 14, NULL, NULL, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(257, 'Khu vực khuôn viên trường 1', 'Tour/Tour_demoTL-1670645851/panos/8.tiles/thumb.jpg', 'scene_8', 'Tour/Tour_demoTL-1670645851/', 14, NULL, NULL, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(258, 'Trước tòa T45', 'Tour/Tour_demoTL-1670645851/panos/9.tiles/thumb.jpg', 'scene_9', 'Tour/Tour_demoTL-1670645851/', 14, NULL, NULL, '2022-12-09 21:17:33', '2022-12-09 21:17:33'),
(259, 'Sảnh T45', 'Tour/Tour_demoTL-1670645851/panos/10.tiles/thumb.jpg', 'scene_10', 'Tour/Tour_demoTL-1670645851/assets/testT45.mp3', 14, NULL, NULL, '2022-12-09 21:17:33', '2022-12-09 21:17:33');

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
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'users-manager', 'web', '2022-11-17 19:59:53', '2022-11-17 19:59:53'),
(2, 'create-project', 'web', '2022-11-17 19:59:53', '2022-11-17 19:59:53'),
(3, 'create-user', 'web', '2022-11-17 19:59:53', '2022-11-17 19:59:53'),
(4, 'delete-user', 'web', '2022-11-17 19:59:53', '2022-11-17 19:59:53'),
(5, 'view-tour', 'web', '2022-11-17 19:59:53', '2022-11-17 19:59:53'),
(6, 'create-tour', 'web', '2022-11-17 19:59:53', '2022-11-17 19:59:53'),
(7, 'edit-tour', 'web', '2022-11-17 19:59:53', '2022-11-17 19:59:53'),
(8, 'delete-tour', 'web', '2022-11-17 19:59:54', '2022-11-17 19:59:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pictures`
--

CREATE TABLE `pictures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `element` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `embed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_priority` int(11) DEFAULT NULL,
  `page_content_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2022-11-17 19:59:54', '2022-11-17 19:59:54'),
(2, 'content-creator', 'web', '2022-11-17 19:59:54', '2022-11-17 19:59:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_priority` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `theme_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_colors`
--

CREATE TABLE `setting_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bg_icon_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hover_color_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hover_bg_icon_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_icon_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_bg_icon_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bg_menu_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bg_color_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_item` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hover_color_item` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_color_item` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_displays`
--

CREATE TABLE `setting_displays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sound` tinyint(1) DEFAULT 1,
  `share` tinyint(1) DEFAULT 1,
  `back_scene` tinyint(1) DEFAULT 1,
  `fullscreen` tinyint(1) DEFAULT 1,
  `infor` tinyint(1) DEFAULT 1,
  `setting_map` tinyint(1) DEFAULT 1,
  `guide` tinyint(1) DEFAULT 1,
  `show_hotspot` tinyint(1) DEFAULT 1,
  `rotate` tinyint(1) DEFAULT 1,
  `setting_vr` tinyint(1) DEFAULT 1,
  `contact` tinyint(1) DEFAULT 1,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting_displays`
--

INSERT INTO `setting_displays` (`id`, `sound`, `share`, `back_scene`, `fullscreen`, `infor`, `setting_map`, `guide`, `show_hotspot`, `rotate`, `setting_vr`, `contact`, `tour_id`, `created_at`, `updated_at`) VALUES
(13, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 13, '2022-12-09 00:20:16', '2022-12-09 00:20:16'),
(14, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 14, '2022-12-09 21:17:33', '2022-12-09 21:17:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_tours`
--

CREATE TABLE `setting_tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sounds`
--

CREATE TABLE `sounds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sound` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT 1,
  `id_priority` bigint(20) DEFAULT NULL,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tag_new`
--

CREATE TABLE `tag_new` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `new_id` int(10) UNSIGNED DEFAULT NULL,
  `tag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_css` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_js` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsive` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `templates`
--

INSERT INTO `templates` (`id`, `name`, `image`, `link_code`, `link_css`, `link_js`, `responsive`, `created_at`, `updated_at`) VALUES
(1, 'template1', 'Template/1670644637-template1png.PNG', 'template1', 'Template/1/css/style.css', 'Template/1/js/main.js', 'Template/1/css/responsive.css', '2022-11-17 20:12:58', '2022-12-09 20:57:17'),
(2, 'template2', 'Template/1670644650-template2png.PNG', 'template2', 'Template/2/css/style.css', 'Template/2/js/main.js', 'Template/2/css/responsive.css', '2022-11-17 20:13:14', '2022-12-09 20:57:30'),
(3, 'template3', 'Template/16702344231_template2png.PNG', 'template3', 'Template/3/css/style.css', 'Template/3/js/main.js', 'Template/3/css/responsive.css', '2022-12-05 03:00:23', '2022-12-05 03:00:23'),
(4, 'template4', 'Template/1670644665-template4png.PNG', 'template4', 'Template/4/css/style.css', 'Template/4/js/main.js', 'Template/4/css/responsive.css', '2022-12-05 03:01:58', '2022-12-09 20:57:45'),
(5, 'template5', 'Template/1670644675-template5png.PNG', 'template5', 'Template/5/css/style.css', 'Template/5/js/main.js', 'Template/5/css/responsive.css', '2022-12-05 03:03:41', '2022-12-09 20:57:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `themes`
--

CREATE TABLE `themes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `themes`
--

INSERT INTO `themes` (`id`, `title`, `image_template`, `link_code`, `type`, `created_at`, `updated_at`) VALUES
(1, 'News', 'images/theme/16698043131_newspng.PNG', 'landingpage.theme.new', 0, '2022-12-09 21:47:18', NULL),
(2, 'Tour', 'images/theme/16698044281_tourpng.PNG', 'landingpage.theme.page_tour', 0, '2022-12-09 21:47:18', NULL),
(3, 'Event', 'images/theme/16698045341_eventpng.PNG', 'landingpage.theme.page_event', 0, '2022-12-09 21:47:18', NULL),
(4, 'Page_Admissions', 'images/theme/16698046181_page-admissionspng.PNG', 'landingpage.theme.page_Admissions', 0, '2022-12-09 21:47:18', NULL),
(5, 'Page_Cooperate', 'images/theme/16698047051_hoptacdoingoaipng.PNG', 'landingpage.theme.page_cooperate', 0, '2022-12-09 21:47:18', NULL),
(6, 'Page_Alumni', 'images/theme/16698047891_page-alumnipng.PNG', 'landingpage.theme.page_alumni', 0, '2022-12-09 21:47:18', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tours`
--

CREATE TABLE `tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tours`
--

INSERT INTO `tours` (`id`, `name`, `path`, `code`, `template_id`, `created_at`, `updated_at`) VALUES
(13, 'Tour VR Đại Học Thủy Lợi', 'Tour/Tour_demoTL-1670570415', '13LVu4Li6gBkJZwD8', 2, '2022-12-09 00:20:16', '2022-12-09 21:13:17'),
(14, 'Đại Học Thủy Lợi', 'Tour/Tour_demoTL-1670645851', '14IVxqA2Jm6DfllvK', 2, '2022-12-09 21:17:33', '2022-12-09 21:17:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_byId` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `created_byId`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@holomia.com', NULL, NULL, NULL, '$2y$10$LnQ.MQxiEkRc0YBiwOFFDeelkvut8LMGG95RnaIIejk93PQ1Mk9uK', NULL, '2022-11-17 19:59:54', '2022-11-17 19:59:54'),
(5, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, '$2y$10$vLMz6T8cSf/aDUXDjM5pUOJGcwUtNQ0zx2Ffr2NIyZxi30CI416em', NULL, '2022-12-05 18:35:28', '2022-12-05 18:35:28'),
(6, 'huyen', 'hoanghuyen2k@gmail.com', '11111111111111111111', 5, NULL, '$2y$10$G2fYzoVKlZDU0j7YMTIL5uoZkdGtUqb4ckMMs/a68AFSBwti2wTki', NULL, '2022-12-05 19:11:06', '2022-12-05 19:11:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voice_contents`
--

CREATE TABLE `voice_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_voice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT 0,
  `content_id` bigint(20) UNSIGNED DEFAULT NULL,
  `infor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `acl_rules`
--
ALTER TABLE `acl_rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acl_rules_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `category_hotspots`
--
ALTER TABLE `category_hotspots`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_news`
--
ALTER TABLE `category_news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_panos`
--
ALTER TABLE `category_panos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_panos_tour_id_foreign` (`tour_id`);

--
-- Chỉ mục cho bảng `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contents_hotspot_id_foreign` (`hotspot_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `fonts`
--
ALTER TABLE `fonts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fonts_tour_id_unique` (`tour_id`);

--
-- Chỉ mục cho bảng `hots_pots`
--
ALTER TABLE `hots_pots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hots_pots_pano_id_foreign` (`pano_id`);

--
-- Chỉ mục cho bảng `icon_tours`
--
ALTER TABLE `icon_tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `icon_tours_tour_id_foreign` (`tour_id`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `infor_tours`
--
ALTER TABLE `infor_tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infor_tours_tour_id_foreign` (`tour_id`);

--
-- Chỉ mục cho bảng `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maps_tour_id_foreign` (`tour_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `panos`
--
ALTER TABLE `panos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `panos_tour_id_foreign` (`tour_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pictures_page_content_id_foreign` (`page_content_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_page_id_foreign` (`page_id`),
  ADD KEY `sections_theme_id_foreign` (`theme_id`);

--
-- Chỉ mục cho bảng `setting_colors`
--
ALTER TABLE `setting_colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_colors_tour_id_unique` (`tour_id`);

--
-- Chỉ mục cho bảng `setting_displays`
--
ALTER TABLE `setting_displays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setting_displays_tour_id_foreign` (`tour_id`);

--
-- Chỉ mục cho bảng `setting_tours`
--
ALTER TABLE `setting_tours`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_tours_thumb_unique` (`thumb`),
  ADD KEY `setting_tours_tour_id_foreign` (`tour_id`);

--
-- Chỉ mục cho bảng `sounds`
--
ALTER TABLE `sounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sounds_tour_id_foreign` (`tour_id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tag_new`
--
ALTER TABLE `tag_new`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_new_new_id_foreign` (`new_id`),
  ADD KEY `tag_new_tag_id_foreign` (`tag_id`);

--
-- Chỉ mục cho bảng `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `themes_title_unique` (`title`);

--
-- Chỉ mục cho bảng `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `voice_contents`
--
ALTER TABLE `voice_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voice_contents_content_id_foreign` (`content_id`),
  ADD KEY `voice_contents_infor_id_foreign` (`infor_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `acl_rules`
--
ALTER TABLE `acl_rules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category_hotspots`
--
ALTER TABLE `category_hotspots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `category_news`
--
ALTER TABLE `category_news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category_panos`
--
ALTER TABLE `category_panos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `fonts`
--
ALTER TABLE `fonts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hots_pots`
--
ALTER TABLE `hots_pots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT cho bảng `icon_tours`
--
ALTER TABLE `icon_tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=445;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `infor_tours`
--
ALTER TABLE `infor_tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `maps`
--
ALTER TABLE `maps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `panos`
--
ALTER TABLE `panos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `setting_colors`
--
ALTER TABLE `setting_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `setting_displays`
--
ALTER TABLE `setting_displays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `setting_tours`
--
ALTER TABLE `setting_tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sounds`
--
ALTER TABLE `sounds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tag_new`
--
ALTER TABLE `tag_new`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tours`
--
ALTER TABLE `tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `voice_contents`
--
ALTER TABLE `voice_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `acl_rules`
--
ALTER TABLE `acl_rules`
  ADD CONSTRAINT `acl_rules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `category_panos`
--
ALTER TABLE `category_panos`
  ADD CONSTRAINT `category_panos_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_hotspot_id_foreign` FOREIGN KEY (`hotspot_id`) REFERENCES `hots_pots` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `fonts`
--
ALTER TABLE `fonts`
  ADD CONSTRAINT `fonts_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hots_pots`
--
ALTER TABLE `hots_pots`
  ADD CONSTRAINT `hots_pots_pano_id_foreign` FOREIGN KEY (`pano_id`) REFERENCES `panos` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `icon_tours`
--
ALTER TABLE `icon_tours`
  ADD CONSTRAINT `icon_tours_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `infor_tours`
--
ALTER TABLE `infor_tours`
  ADD CONSTRAINT `infor_tours_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `maps`
--
ALTER TABLE `maps`
  ADD CONSTRAINT `maps_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category_news` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `panos`
--
ALTER TABLE `panos`
  ADD CONSTRAINT `panos_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_page_content_id_foreign` FOREIGN KEY (`page_content_id`) REFERENCES `page_contents` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sections_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `setting_colors`
--
ALTER TABLE `setting_colors`
  ADD CONSTRAINT `setting_colors_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `setting_displays`
--
ALTER TABLE `setting_displays`
  ADD CONSTRAINT `setting_displays_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `setting_tours`
--
ALTER TABLE `setting_tours`
  ADD CONSTRAINT `setting_tours_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `sounds`
--
ALTER TABLE `sounds`
  ADD CONSTRAINT `sounds_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `tag_new`
--
ALTER TABLE `tag_new`
  ADD CONSTRAINT `tag_new_new_id_foreign` FOREIGN KEY (`new_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tag_new_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `voice_contents`
--
ALTER TABLE `voice_contents`
  ADD CONSTRAINT `voice_contents_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `voice_contents_infor_id_foreign` FOREIGN KEY (`infor_id`) REFERENCES `infor_tours` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
