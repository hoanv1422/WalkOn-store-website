-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 24, 2025 lúc 03:50 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `datn1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) NOT NULL,
  `city_code` int(11) DEFAULT NULL,
  `district` varchar(255) NOT NULL,
  `district_code` int(11) DEFAULT NULL,
  `ward` varchar(255) NOT NULL,
  `ward_code` int(11) DEFAULT NULL,
  `address_line` varchar(255) NOT NULL,
  `type` enum('HOME','OFFICE','OTHER') NOT NULL DEFAULT 'HOME',
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Mặc định',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `city`, `city_code`, `district`, `district_code`, `ward`, `ward_code`, `address_line`, `type`, `latitude`, `longitude`, `is_default`, `created_at`, `updated_at`) VALUES
(22, 2, 'Thành phố Hà Nội', 1, 'Quận Hoàn Kiếm', 2, 'Phường Hàng Mã', 43, '123', 'OTHER', NULL, NULL, 0, '2025-04-16 01:27:58', '2025-04-16 08:59:44'),
(24, 2, 'Tỉnh Hà Giang', 2, 'Huyện Mèo Vạc', 27, 'Xã Pải Lủng', 775, '1234345435345345435345', 'HOME', 23.2430179, 105.4093083, 1, '2025-04-16 07:29:52', '2025-04-16 08:59:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Tên thương hiệu',
  `slug` varchar(255) NOT NULL COMMENT 'URL thân thiện',
  `logo` varchar(255) DEFAULT NULL COMMENT 'Logo thương hiệu',
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Nike', 'nike', 'brands/nike.png', 'Thương hiệu thể thao nổi tiếng toàn cầu.', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(2, 'Adidas', 'adidas', 'brands/adidas.png', 'Đối thủ cạnh tranh chính của Nike.', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(3, 'Puma', 'puma', 'brands/puma.png', 'Phong cách thể thao trẻ trung và năng động.', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(4, 'Converse', 'converse', 'brands/converse.png', 'Nổi bật với giày vải cổ điển.', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(5, 'New Balance', 'new-balance', 'brands/new-balance.png', 'Giày thể thao chất lượng cao, nổi bật với sự thoải mái.', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-04-11 03:57:33', '2025-04-11 03:57:33'),
(2, 2, '2025-04-12 02:24:24', '2025-04-12 02:24:24'),
(3, 5, '2025-04-15 06:23:47', '2025-04-15 06:23:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1 COMMENT 'Số lượng sản phẩm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_variant_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, '2025-04-11 03:57:33', '2025-04-11 03:57:33'),
(2, 1, 4, 5, '2025-04-11 03:57:33', '2025-04-11 03:57:33'),
(3, 1, 2, 3, '2025-04-11 03:57:33', '2025-04-11 03:57:33'),
(32, 3, 100, 1, '2025-04-18 07:38:31', '2025-04-18 07:38:31'),
(37, 3, 90, 1, '2025-04-19 05:59:25', '2025-04-19 05:59:25'),
(38, 3, 16, 1, '2025-04-19 05:59:32', '2025-04-19 05:59:32'),
(39, 3, 89, 1, '2025-04-19 06:01:03', '2025-04-19 06:01:03'),
(40, 3, 84, 1, '2025-04-19 06:03:30', '2025-04-19 06:03:30'),
(78, 2, 205, 1, '2025-04-23 08:10:32', '2025-04-23 08:10:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Tên danh mục',
  `slug` varchar(255) NOT NULL COMMENT 'URL thân thiện',
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Áo', 'ao', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(2, 'Quần', 'quan', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(3, 'Giày', 'giay', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(4, 'Phụ kiện', 'phu-kien', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(5, 'Khuyến mãi', 'khuyen-mai', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) NOT NULL COMMENT 'Màu sắc',
  `slug` varchar(255) NOT NULL COMMENT 'URL thân thiện',
  `code` varchar(255) NOT NULL COMMENT 'Mã màu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `colors`
--

INSERT INTO `colors` (`id`, `color`, `slug`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Đỏ', 'do', '#FF0000', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(2, 'Xanh lá', 'xanh-la', '#00FF00', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(3, 'Xanh dương', 'xanh-duong', '#0000FF', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(4, 'Vàng', 'vang', '#FFFF00', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(5, 'Đen', 'den', '#000000', '2025-04-21 08:03:00', '2025-04-21 08:03:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` text NOT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment_galleries`
--

CREATE TABLE `comment_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_code` varchar(255) NOT NULL COMMENT 'Mã phản hồi',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Tên người dùng',
  `email` varchar(255) NOT NULL COMMENT 'Email người dùng',
  `phone` varchar(255) NOT NULL COMMENT 'Số điện thoại',
  `message` text NOT NULL COMMENT 'Nội dung tin nhắn',
  `status` enum('UNREAD','READ','REPLIED') NOT NULL DEFAULT 'UNREAD',
  `response_message` text DEFAULT NULL COMMENT 'Nội dung phản hồi',
  `responded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `max_uses` int(11) NOT NULL DEFAULT 1,
  `max_uses_per_user` int(11) NOT NULL DEFAULT 1,
  `discount_type` enum('percentage','fixed','freeship') NOT NULL,
  `discount_value` decimal(20,2) DEFAULT NULL,
  `minimum_order_value` decimal(20,2) NOT NULL DEFAULT 0.00,
  `maximum_discount_amount` decimal(20,2) DEFAULT NULL COMMENT 'Số tiền giảm tối đa',
  `max_shipping_discount` decimal(20,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `description`, `start_time`, `end_time`, `max_uses`, `max_uses_per_user`, `discount_type`, `discount_value`, `minimum_order_value`, `maximum_discount_amount`, `max_shipping_discount`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test', 'Test', '2025-04-22 00:00:00', '2025-04-25 00:00:00', 1, 1, 'fixed', 1212.00, 10000.00, 10000.00, 10000.00, 1, '2025-04-22 23:39:45', '2025-04-22 17:59:10', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon_brands`
--

CREATE TABLE `coupon_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupon_brands`
--

INSERT INTO `coupon_brands` (`id`, `coupon_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-04-22 17:59:11', '2025-04-22 17:59:11'),
(2, 1, 2, '2025-04-22 17:59:11', '2025-04-22 17:59:11'),
(3, 1, 3, '2025-04-22 17:59:11', '2025-04-22 17:59:11'),
(4, 1, 4, '2025-04-22 17:59:11', '2025-04-22 17:59:11'),
(5, 1, 5, '2025-04-22 17:59:11', '2025-04-22 17:59:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon_categories`
--

CREATE TABLE `coupon_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupon_categories`
--

INSERT INTO `coupon_categories` (`id`, `coupon_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-04-22 17:59:10', '2025-04-22 17:59:10'),
(2, 1, 2, '2025-04-22 17:59:10', '2025-04-22 17:59:10'),
(3, 1, 3, '2025-04-22 17:59:10', '2025-04-22 17:59:10'),
(4, 1, 4, '2025-04-22 17:59:10', '2025-04-22 17:59:10'),
(5, 1, 5, '2025-04-22 17:59:10', '2025-04-22 17:59:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon_user`
--

CREATE TABLE `coupon_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `times_used` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `couriers`
--

CREATE TABLE `couriers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `license_plate` varchar(255) DEFAULT NULL,
  `delivery_area` varchar(255) NOT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `rating` decimal(2,1) DEFAULT NULL,
  `total_orders` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `courier_reviews`
--

CREATE TABLE `courier_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courier_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` decimal(2,1) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_02_03_041019_create_addresses_table', 1),
(6, '2025_02_04_101349_create_categories_table', 1),
(7, '2025_02_04_101547_create_brands_table', 1),
(8, '2025_02_04_101644_create_sizes_table', 1),
(9, '2025_02_04_101703_create_colors_table', 1),
(10, '2025_02_04_102157_create_products_table', 1),
(11, '2025_02_04_102939_create_product_variants_table', 1),
(12, '2025_02_04_103126_create_product_galleries_table', 1),
(13, '2025_02_15_022153_create_couriers_table', 1),
(14, '2025_02_15_140640_create_carts_table', 1),
(15, '2025_02_15_140727_create_cart_items_table', 1),
(16, '2025_02_15_153550_create_wishlists_table', 1),
(17, '2025_02_15_164252_create_coupons_table', 1),
(18, '2025_02_16_015350_create_orders_table', 1),
(19, '2025_02_16_015748_create_order_items_table', 1),
(20, '2025_02_16_024419_create_courier_reviews_table', 1),
(21, '2025_02_16_030618_create_shipments_table', 1),
(22, '2025_02_16_032248_create_comments_table', 1),
(23, '2025_02_18_083556_create_transactions_table', 1),
(24, '2025_02_21_175438_create_post_categories_table', 1),
(25, '2025_02_21_175517_create_posts_table', 1),
(26, '2025_02_21_175532_create_post_comments_table', 1),
(27, '2025_03_17_084432_create_order_cancellation_reasons_table', 1),
(28, '2025_03_17_084521_create_order_cancellations_table', 1),
(29, '2025_03_28_162801_create_contacts_table', 1),
(30, '2025_03_31_165955_create_website_informations_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `receiver_email` varchar(255) DEFAULT NULL,
  `receiver_name` varchar(255) DEFAULT NULL,
  `receiver_address` varchar(255) DEFAULT NULL,
  `receiver_phone` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon` varchar(255) DEFAULT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `discount_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `shipping_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `final_price` decimal(15,2) NOT NULL,
  `order_status` enum('pending','confirmed','processing','shipped','delivered','cancelled','returned') NOT NULL DEFAULT 'pending',
  `payment_status` enum('unpaid','paid','refunded') NOT NULL DEFAULT 'unpaid',
  `payment_method` varchar(255) NOT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `tracking_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `user_id`, `user_email`, `user_name`, `user_address`, `user_phone`, `receiver_email`, `receiver_name`, `receiver_address`, `receiver_phone`, `note`, `coupon_id`, `coupon`, `total_price`, `discount_amount`, `shipping_fee`, `final_price`, `order_status`, `payment_status`, `payment_method`, `payment_date`, `delivered_at`, `tracking_code`, `created_at`, `updated_at`) VALUES
(27, 'ORD202504227MDH', 2, NULL, 'admin', NULL, '0900000002', 'minh33490@gmail.com', 'Admin Account', '1234, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0900000002', NULL, NULL, NULL, 3242439.00, 0.00, 2587530.00, 5829969.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-21 20:28:07', '2025-04-21 20:28:07'),
(28, 'ORD20250422NCAP', 2, NULL, 'admin', NULL, '0900000002', 'admin@gmail.com', 'Admin Account', '1234, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0900000002', NULL, NULL, NULL, 1006378.00, 0.00, 2587530.00, 3593908.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-21 21:04:16', '2025-04-21 21:04:16'),
(30, 'ORD20250422HXNS', 2, NULL, 'admin', NULL, '0900000002', 'admin@gmail.com', 'Admin Account', '1234, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0900000002', NULL, NULL, NULL, 800378.00, 0.00, 2587530.00, 3387908.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-21 21:16:33', '2025-04-21 21:16:33'),
(31, 'ORD20250422ZJHO', 2, NULL, 'admin', NULL, '0900000002', 'admin@gmail.com', 'Admin Account', '1234, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0900000002', NULL, NULL, NULL, 615051.00, 0.00, 2587530.00, 3202581.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-21 21:18:09', '2025-04-21 21:18:09'),
(32, 'ORD20250422XXIP', 2, NULL, 'admin', NULL, '0900000002', 'admin@gmail.com', 'Admin Account', '1234, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0394422302', NULL, NULL, NULL, 956559.00, 0.00, 2587530.00, 3544089.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-22 11:04:07', '2025-04-22 11:04:07'),
(33, 'ORD202504223BZD', 2, NULL, 'admin', NULL, '0900000002', 'admin@gmail.com', 'Admin Account', '1234, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0900000002', NULL, NULL, NULL, 253589.00, 0.00, 2587530.00, 2841119.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-22 11:05:53', '2025-04-22 11:05:53'),
(34, 'ORD20250422Y1WE', 2, NULL, 'admin', NULL, '0900000002', 'admin@gmail.com', 'Admin Account', '1234, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0900000002', NULL, NULL, NULL, 278745.00, 0.00, 2587530.00, 2866275.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-22 11:25:02', '2025-04-22 11:25:02'),
(45, 'ORD20250423QUOW', 2, NULL, 'admin', NULL, '0900000002', 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0900000002', NULL, NULL, NULL, 1055811.00, 0.00, 0.00, 1055811.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-22 20:11:18', '2025-04-22 20:11:18'),
(46, 'ORD202504236KZA', 2, NULL, 'admin', NULL, '0900000002', 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0900000002', NULL, NULL, NULL, 200088.00, 0.00, 0.00, 200088.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-22 20:13:32', '2025-04-22 20:13:32'),
(47, 'ORD20250423BMYQ', 2, NULL, 'admin', NULL, '0900000002', 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0900000002', NULL, NULL, NULL, 200088.00, 0.00, 0.00, 200088.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-22 20:15:50', '2025-04-22 20:15:50'),
(48, 'ORD20250423FRVP', 2, NULL, 'admin', NULL, '0900000002', 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0900000002', NULL, NULL, NULL, 238986.00, 0.00, 0.00, 238986.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-22 20:17:04', '2025-04-22 20:17:04'),
(49, 'ORD202504235QRS', 2, NULL, 'admin', NULL, '0900000002', 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0900000002', NULL, NULL, NULL, 325101.00, 0.00, 258753.00, 325101.00, 'pending', 'unpaid', 'COD', NULL, NULL, NULL, '2025-04-22 21:29:36', '2025-04-22 21:29:36'),
(50, 'ORD20250423BRKS', 2, NULL, 'admin', NULL, NULL, 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0394422302', NULL, NULL, NULL, 478742.00, 0.00, 258753.00, 478742.00, 'pending', 'paid', 'VNPAY', NULL, NULL, NULL, '2025-04-22 21:46:38', '2025-04-22 21:46:38'),
(51, 'ORD2025042366GX', 2, NULL, 'admin', NULL, NULL, 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0394422302', NULL, NULL, NULL, 200088.00, 0.00, 258753.00, 200088.00, 'pending', 'paid', 'VNPAY', NULL, NULL, NULL, '2025-04-22 21:50:51', '2025-04-22 21:50:51'),
(52, 'ORD20250423XIJN', 2, NULL, 'admin', NULL, NULL, 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0394422302', NULL, NULL, NULL, 395628.00, 0.00, 258753.00, 395628.00, 'pending', 'paid', 'VNPAY', NULL, NULL, NULL, '2025-04-22 21:52:00', '2025-04-22 21:52:00'),
(53, 'ORD20250423MDEK', 2, NULL, 'admin', NULL, '0394422302', 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0394422302', NULL, NULL, NULL, 600770.00, 0.00, 258753.00, 600770.00, 'pending', 'paid', 'VNPAY', NULL, NULL, NULL, '2025-04-23 08:07:13', '2025-04-23 08:07:13'),
(54, 'ORD20250423AESV', 2, NULL, 'admin', NULL, '0394422302', 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0394422302', NULL, NULL, NULL, 341480.00, 0.00, 258753.00, 341480.00, 'pending', 'paid', 'VNPAY', NULL, NULL, NULL, '2025-04-23 08:09:00', '2025-04-23 08:09:00'),
(55, 'ORD202504233HMT', 2, NULL, 'admin', NULL, '0394422302', 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0394422302', NULL, NULL, NULL, 341480.00, 0.00, 258753.00, 341480.00, 'pending', 'paid', 'VNPAY', NULL, NULL, NULL, '2025-04-23 08:09:07', '2025-04-23 08:09:07'),
(56, 'ORD20250423GT5U', 2, NULL, 'admin', NULL, '0394422302', 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0394422302', NULL, NULL, NULL, 341480.00, 0.00, 258753.00, 341480.00, 'pending', 'paid', 'VNPAY', NULL, NULL, NULL, '2025-04-23 08:09:10', '2025-04-23 08:09:10'),
(57, 'ORD20250423ES4F', 2, NULL, 'admin', NULL, '0394422302', 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0394422302', NULL, NULL, NULL, 341480.00, 0.00, 258753.00, 341480.00, 'pending', 'paid', 'VNPAY', NULL, NULL, NULL, '2025-04-23 08:09:10', '2025-04-23 08:09:10'),
(58, 'ORD20250423QFQX', 2, NULL, 'admin', NULL, '0394422302', 'admin@gmail.com', 'Admin Account', '1234345435345345435345, Xã Pải Lủng, Huyện Mèo Vạc, Tỉnh Hà Giang', '0394422302', NULL, NULL, NULL, 229326.00, 0.00, 258753.00, 229326.00, 'pending', 'paid', 'VNPAY', NULL, NULL, NULL, '2025-04-23 08:10:44', '2025-04-23 08:10:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_cancellations`
--

CREATE TABLE `order_cancellations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `reason_id` bigint(20) UNSIGNED DEFAULT NULL,
  `custom_reason` text DEFAULT NULL,
  `cancelled_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cancelled_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_cancellation_reasons`
--

CREATE TABLE `order_cancellation_reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sku` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(15,2) NOT NULL,
  `product_price_sale` decimal(15,2) DEFAULT NULL,
  `variant_size_name` varchar(255) DEFAULT NULL,
  `variant_color_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_variant_id`, `product_name`, `product_sku`, `product_image`, `product_price`, `product_price_sale`, `variant_size_name`, `variant_color_name`, `quantity`, `created_at`, `updated_at`) VALUES
(54, 27, 59, 'Giày chạy bộ New Balance 520', 'SP0010', 'variants/variant-10-2-3.jpg', 416732.00, 356571.00, 'M', 'Xanh dương', 1, '2025-04-21 20:28:07', '2025-04-21 20:28:07'),
(55, 27, 58, 'Giày chạy bộ New Balance 520', 'SP0010', 'variants/variant-10-2-4.jpg', 236769.00, 354413.00, 'M', 'Vàng', 1, '2025-04-21 20:28:07', '2025-04-21 20:28:07'),
(56, 27, 56, 'Giày chạy bộ New Balance 520', 'SP0010', 'variants/variant-10-2-5.jpg', 407517.00, 269736.00, 'M', 'Đen', 1, '2025-04-21 20:28:07', '2025-04-21 20:28:07'),
(57, 27, 63, 'Giày chạy bộ New Balance 520', 'SP0010', 'variants/variant-10-1-4.jpg', 415101.00, 439390.00, 'S', 'Vàng', 1, '2025-04-21 20:28:07', '2025-04-21 20:28:07'),
(58, 27, 65, 'Giày chạy bộ New Balance 520', 'SP0010', 'variants/variant-10-1-2.jpg', 210101.00, 340669.00, 'S', 'Xanh lá', 2, '2025-04-21 20:28:07', '2025-04-21 20:28:07'),
(59, 27, 61, 'Giày chạy bộ New Balance 520', 'SP0010', 'variants/variant-10-1-5.jpg', 458212.00, 334158.00, 'S', 'Đen', 1, '2025-04-21 20:28:07', '2025-04-21 20:28:07'),
(60, 27, 74, 'Giày chạy bộ New Balance 520', 'SP0010', 'variants/variant-10-5-3.jpg', 453689.00, 256732.00, 'XXL', 'Xanh dương', 1, '2025-04-21 20:28:07', '2025-04-21 20:28:07'),
(61, 27, 217, 'Mũ lưỡi trai Nike', 'SP0006', 'variants/variant-6-4-1.jpg', 331911.00, 331911.00, 'XL', 'Đỏ', 1, '2025-04-21 20:28:07', '2025-04-21 20:28:07'),
(62, 27, 78, 'Áo thun Adidas Originals', 'SP0002', 'variants/variant-2-3-4.jpg', 389199.00, 288778.00, 'L', 'Vàng', 1, '2025-04-21 20:28:07', '2025-04-21 20:28:07'),
(63, 27, 116, 'Quần short Puma Active', 'SP0003', 'variants/variant-3-4-5.jpg', 383377.00, 332481.00, 'XL', 'Đen', 1, '2025-04-21 20:28:07', '2025-04-21 20:28:07'),
(64, 28, 28, 'Giày Converse cổ cao', 'SP0004', 'variants/variant-4-3-4.jpg', 416238.00, 206524.00, 'L', 'Vàng', 1, '2025-04-21 21:04:16', '2025-04-21 21:04:16'),
(65, 28, 114, 'Quần short Puma Active', 'SP0003', 'variants/variant-3-1-3.jpg', 497170.00, 250734.00, 'S', 'Xanh dương', 1, '2025-04-21 21:04:16', '2025-04-21 21:04:16'),
(66, 28, 13, 'Giày thể thao Nike Air Max', 'SP0001', 'variants/variant-1-1-4.jpg', 338308.00, 387798.00, 'S', 'Vàng', 1, '2025-04-21 21:04:16', '2025-04-21 21:04:16'),
(67, 28, 141, 'Áo hoodie New Balance', 'SP0005', 'variants/variant-5-4-5.jpg', 210812.00, 283841.00, 'XL', 'Đen', 1, '2025-04-21 21:04:16', '2025-04-21 21:04:16'),
(68, 30, 97, 'Áo thun Adidas Originals', 'SP0002', 'variants/variant-2-5-1.jpg', 225527.00, 443411.00, 'XXL', 'Đỏ', 1, '2025-04-21 21:16:33', '2025-04-21 21:16:33'),
(69, 30, 85, 'Áo thun Adidas Originals', 'SP0002', 'variants/variant-2-2-2.jpg', 236324.00, 353526.00, 'M', 'Xanh lá', 1, '2025-04-21 21:16:33', '2025-04-21 21:16:33'),
(70, 30, 79, 'Áo thun Adidas Originals', 'SP0002', 'variants/variant-2-3-3.jpg', 338527.00, 400319.00, 'L', 'Xanh dương', 1, '2025-04-21 21:16:33', '2025-04-21 21:16:33'),
(71, 31, 119, 'Quần short Puma Active', 'SP0003', 'variants/variant-3-4-3.jpg', 478415.00, 355761.00, 'XL', 'Xanh dương', 1, '2025-04-21 21:18:09', '2025-04-21 21:18:09'),
(72, 31, 84, 'Áo thun Adidas Originals', 'SP0002', 'variants/variant-2-2-3.jpg', 259290.00, 345633.00, 'M', 'Xanh dương', 1, '2025-04-21 21:18:09', '2025-04-21 21:18:09'),
(73, 32, 213, 'Mũ lưỡi trai Nike', 'SP0006', 'variants/variant-6-1-4.jpg', 478742.00, 478742.00, 'S', 'Vàng', 1, '2025-04-22 11:04:07', '2025-04-22 11:04:07'),
(74, 32, 201, 'Mũ lưỡi trai Nike', 'SP0006', 'product_variant/bMgKAD204JAJuWnnrK4NExt1H4jzux7yR36SnYJd.jpg', 477817.00, 477817.00, 'L', 'Đen', 1, '2025-04-22 11:04:07', '2025-04-22 11:04:07'),
(75, 33, 35, 'Giày Converse cổ cao', 'SP0004', 'variants/variant-4-2-2.jpg', 341101.00, 253589.00, 'M', 'Xanh lá', 1, '2025-04-22 11:05:53', '2025-04-22 11:05:53'),
(76, 34, 38, 'Giày Converse cổ cao', 'SP0004', 'variants/variant-4-1-4.jpg', 366914.00, 278745.00, 'S', 'Vàng', 1, '2025-04-22 11:25:02', '2025-04-22 11:25:02'),
(97, 45, 32, 'Giày Converse cổ cao', 'SP0004', 'variants/variant-4-2-1.jpg', 490259.00, 208778.00, 'M', 'Đỏ', 4, '2025-04-22 20:11:18', '2025-04-22 20:11:18'),
(98, 45, 76, 'Áo thun Adidas Originals', 'SP0002', 'variants/variant-2-3-5.jpg', 354747.00, 220699.00, 'L', 'Đen', 1, '2025-04-22 20:11:18', '2025-04-22 20:11:18'),
(99, 46, 40, 'Giày Converse cổ cao', 'SP0004', 'variants/variant-4-1-2.jpg', 200088.00, 284443.00, 'S', 'Xanh lá', 1, '2025-04-22 20:13:32', '2025-04-22 20:13:32'),
(100, 47, 40, 'Giày Converse cổ cao', 'SP0004', 'variants/variant-4-1-2.jpg', 200088.00, 284443.00, 'S', 'Xanh lá', 1, '2025-04-22 20:15:50', '2025-04-22 20:15:50'),
(101, 48, 39, 'Giày Converse cổ cao', 'SP0004', 'variants/variant-4-1-3.jpg', 304344.00, 238986.00, 'S', 'Xanh dương', 1, '2025-04-22 20:17:04', '2025-04-22 20:17:04'),
(102, 49, 207, 'Mũ lưỡi trai Nike', 'SP0006', 'variants/variant-6-2-1.jpg', 325101.00, 325101.00, 'M', 'Đỏ', 1, '2025-04-22 21:29:36', '2025-04-22 21:29:36'),
(103, 50, 213, 'Mũ lưỡi trai Nike', 'SP0006', 'variants/variant-6-1-4.jpg', 478742.00, 478742.00, 'S', 'Vàng', 1, '2025-04-22 21:46:38', '2025-04-22 21:46:38'),
(104, 51, 40, 'Giày Converse cổ cao', 'SP0004', 'variants/variant-4-1-2.jpg', 200088.00, 284443.00, 'S', 'Xanh lá', 1, '2025-04-22 21:50:51', '2025-04-22 21:50:51'),
(105, 52, 210, 'Mũ lưỡi trai Nike', 'SP0006', 'variants/variant-6-2-2.jpg', 395628.00, 395628.00, 'M', 'Xanh lá', 1, '2025-04-22 21:52:00', '2025-04-22 21:52:00'),
(106, 53, 84, 'Áo thun Adidas Originals', 'SP0002', 'variants/variant-2-2-3.jpg', 259290.00, 345633.00, 'M', 'Xanh dương', 1, '2025-04-23 08:07:13', '2025-04-23 08:07:13'),
(107, 53, 225, 'Mũ lưỡi trai Nike', 'SP0006', 'variants/variant-6-5-2.jpg', 341480.00, 341480.00, 'XXL', 'Xanh lá', 1, '2025-04-23 08:07:13', '2025-04-23 08:07:13'),
(108, 54, 225, 'Mũ lưỡi trai Nike', 'SP0006', 'variants/variant-6-5-2.jpg', 341480.00, 341480.00, 'XXL', 'Xanh lá', 1, '2025-04-23 08:09:00', '2025-04-23 08:09:00'),
(109, 55, 225, 'Mũ lưỡi trai Nike', 'SP0006', 'variants/variant-6-5-2.jpg', 341480.00, 341480.00, 'XXL', 'Xanh lá', 1, '2025-04-23 08:09:07', '2025-04-23 08:09:07'),
(110, 56, 225, 'Mũ lưỡi trai Nike', 'SP0006', 'variants/variant-6-5-2.jpg', 341480.00, 341480.00, 'XXL', 'Xanh lá', 1, '2025-04-23 08:09:10', '2025-04-23 08:09:10'),
(111, 57, 225, 'Mũ lưỡi trai Nike', 'SP0006', 'variants/variant-6-5-2.jpg', 341480.00, 341480.00, 'XXL', 'Xanh lá', 1, '2025-04-23 08:09:10', '2025-04-23 08:09:10'),
(112, 58, 205, 'Mũ lưỡi trai Nike', 'SP0006', 'variants/variant-6-3-2.jpg', 229326.00, 229326.00, 'L', 'Xanh lá', 1, '2025-04-23 08:10:44', '2025-04-23 08:10:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `code`, `created_at`) VALUES
('admin@gmail.com', 'Lw9BJS9OBziiJlEtaTRWXffwbN9opHUIDjLl64RPCR76yZsci9OVGEOJblZ6', '128964', '2025-04-23 04:44:16'),
('minh33490@gmail.com', '$2y$12$Vl75zXAZcDmx4Ot4ht7oleuE5NbnKLDvCQS6LdeJNPcA6S2bHML1C', NULL, '2025-04-19 05:19:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'auth_token', '53fcc3a99d0617c543fa4ab121b86455b6c905494442005f4ab9dd5e5095baed', '[\"*\"]', NULL, NULL, '2025-04-12 01:06:23', '2025-04-12 01:06:23'),
(2, 'App\\Models\\User', 2, 'auth_token', '74c9bf52b6b148f4f360e08a1e107fa517a4d51a9ad7d24437f00ce681a336a8', '[\"*\"]', NULL, NULL, '2025-04-12 01:12:31', '2025-04-12 01:12:31'),
(3, 'App\\Models\\User', 2, 'auth_token', 'fed6494bae9b61a0f785d589d17e90514ec82662b2770d60c59b0cb8588ee6ed', '[\"*\"]', NULL, NULL, '2025-04-12 01:12:40', '2025-04-12 01:12:40'),
(4, 'App\\Models\\User', 2, 'auth_token', '534e98763a23b52fcd54302424d34ac4c14a017c58005e0ba44e5e9a0172d1f4', '[\"*\"]', NULL, NULL, '2025-04-12 01:12:55', '2025-04-12 01:12:55'),
(5, 'App\\Models\\User', 2, 'auth_token', '43e3ad7f476334ba6990b6b11da00ea01e8e20fe01bd4fcf9cf1bdecddc305cd', '[\"*\"]', NULL, NULL, '2025-04-12 01:13:50', '2025-04-12 01:13:50'),
(6, 'App\\Models\\User', 2, 'auth_token', 'fa0c4d9ee766300d6fb8b2e2c2c95d253ccecb5845c53f2a85b26d5c2fddf9bb', '[\"*\"]', NULL, NULL, '2025-04-12 01:18:11', '2025-04-12 01:18:11'),
(7, 'App\\Models\\User', 2, 'auth_token', '6c432a3cb1bb01fea3be6da7ada99bddb9723c4a9b9680891cd2ed954ceb22ae', '[\"*\"]', NULL, NULL, '2025-04-12 01:22:29', '2025-04-12 01:22:29'),
(8, 'App\\Models\\User', 2, 'auth_token', '8f65c7cc218d2f1cf3aa14429f9caf4785eb0e4a1f8f1ac20ccd50d2397795b4', '[\"*\"]', NULL, NULL, '2025-04-12 01:23:02', '2025-04-12 01:23:02'),
(9, 'App\\Models\\User', 2, 'auth_token', '996ad0092376d3d41aa363c772abbfe954dc9c404069c88fd8867224650e2d85', '[\"*\"]', NULL, NULL, '2025-04-12 01:29:51', '2025-04-12 01:29:51'),
(10, 'App\\Models\\User', 2, 'auth_token', '4e6a42209165063e47f20e5f5351682e9685cfa6f7a1218e66351d78acb0458a', '[\"*\"]', NULL, NULL, '2025-04-12 01:30:20', '2025-04-12 01:30:20'),
(11, 'App\\Models\\User', 2, 'auth_token', '2d8db01d1610a3186cff98bc31779500a361d4718e5de62ff68e03a1cfb4011f', '[\"*\"]', NULL, NULL, '2025-04-12 01:30:31', '2025-04-12 01:30:31'),
(12, 'App\\Models\\User', 2, 'auth_token', '249c526787685ab698f86307b78bd2986fbecec7f4ba72248c3732b46bdfa637', '[\"*\"]', NULL, NULL, '2025-04-12 01:31:56', '2025-04-12 01:31:56'),
(13, 'App\\Models\\User', 2, 'auth_token', 'fd967085a28fe86ac3d0efa0146e65a9517ea7c9869a1eedf94bfc73cec6cd70', '[\"*\"]', NULL, NULL, '2025-04-12 01:32:45', '2025-04-12 01:32:45'),
(14, 'App\\Models\\User', 2, 'auth_token', '65be5e28654feb3a4d4f9d242ac3cc59865a95d6df67135a7a333db77534012b', '[\"*\"]', NULL, NULL, '2025-04-12 01:35:05', '2025-04-12 01:35:05'),
(15, 'App\\Models\\User', 2, 'auth_token', '2e435bcbd0da329797d415a86ae1c7b8bdb7f2d907b8a19fcbffd6bd885cce4f', '[\"*\"]', NULL, NULL, '2025-04-12 01:35:19', '2025-04-12 01:35:19'),
(16, 'App\\Models\\User', 2, 'auth_token', '008e1f61de4b3d919df4bd85057ed4d25951475eaee511fb583f532cfafda612', '[\"*\"]', NULL, NULL, '2025-04-12 01:35:32', '2025-04-12 01:35:32'),
(17, 'App\\Models\\User', 2, 'auth_token', '7d488c29518e0321a4059fabba7b11d91d1441c80b0ac2c043fa486884d1a1b2', '[\"*\"]', NULL, NULL, '2025-04-12 01:43:22', '2025-04-12 01:43:22'),
(18, 'App\\Models\\User', 2, 'auth_token', '3502b7d2fa8cb2ef4a94ca7fb7ebe92f5da370a3fe0cccb22d51d8c4fa9f5c79', '[\"*\"]', NULL, NULL, '2025-04-13 03:34:52', '2025-04-13 03:34:52'),
(19, 'App\\Models\\User', 2, 'auth_token', '2cd0c03b8c8292066da258813872ef2d9adcbbd88e4511bd1d7fbc76e9313586', '[\"*\"]', NULL, NULL, '2025-04-13 03:41:41', '2025-04-13 03:41:41'),
(20, 'App\\Models\\User', 2, 'auth_token', '50c3da9d1621584643e8ee933c7e8c95ddd1f04b33ee3fee495858eda3710d4d', '[\"*\"]', NULL, NULL, '2025-04-13 03:41:56', '2025-04-13 03:41:56'),
(21, 'App\\Models\\User', 2, 'auth_token', '262b4f03f8ac38d9b094cf1dd77b35ca710dcb82a5beeb877ac044c520073ccb', '[\"*\"]', NULL, NULL, '2025-04-13 03:42:46', '2025-04-13 03:42:46'),
(22, 'App\\Models\\User', 2, 'auth_token', '0828ebf6bdc72aaa11b90303875ffc75d2ca932e32a11ad63beeaba312b82d4c', '[\"*\"]', NULL, NULL, '2025-04-13 04:10:12', '2025-04-13 04:10:12'),
(23, 'App\\Models\\User', 2, 'auth_token', 'b59d1c04890d940ed13d951e1307594ac0e6e589d6b24947e18e0dbdf0207cb3', '[\"*\"]', NULL, NULL, '2025-04-13 04:24:25', '2025-04-13 04:24:25'),
(24, 'App\\Models\\User', 2, 'auth_token', 'b73330f944176c8be225239defd8e8513d1ca9fa9e0dccada7e91f41fe6e0341', '[\"*\"]', NULL, NULL, '2025-04-13 04:26:18', '2025-04-13 04:26:18'),
(25, 'App\\Models\\User', 2, 'auth_token', '6c6aa2bacf6cf3338432a762e0748ad4d47ac5f0caab1a4869eb706aeb22c32d', '[\"*\"]', NULL, NULL, '2025-04-13 04:31:24', '2025-04-13 04:31:24'),
(26, 'App\\Models\\User', 2, 'auth_token', '7535f147a04250a518182f1af835c40add5c1b1810f46d25b7280fba70496aba', '[\"*\"]', NULL, NULL, '2025-04-13 04:32:29', '2025-04-13 04:32:29'),
(27, 'App\\Models\\User', 2, 'auth_token', '84949ed0fb82610884d9444deafb445d76ce13462848416e8c64a93e7dfd4589', '[\"*\"]', NULL, NULL, '2025-04-13 04:36:05', '2025-04-13 04:36:05'),
(28, 'App\\Models\\User', 2, 'auth_token', 'bc9bf8de8b6e9d6c8c2dca1f1ebb5058e6c1a6046af00f85cabe103759089b95', '[\"*\"]', NULL, NULL, '2025-04-13 04:41:14', '2025-04-13 04:41:14'),
(29, 'App\\Models\\User', 4, 'auth_token', '89a6928e1032d8f3508dab25020d23e00a0996bbbff9d26dd834b20515a4846b', '[\"*\"]', NULL, NULL, '2025-04-13 05:46:53', '2025-04-13 05:46:53'),
(30, 'App\\Models\\User', 2, 'auth_token', '6c57f87675fbcb0c0aa2e57fd5ac3bc83e501c03b43ddedea8a2953efd5ded54', '[\"*\"]', NULL, NULL, '2025-04-13 05:51:01', '2025-04-13 05:51:01'),
(31, 'App\\Models\\User', 2, 'auth_token', '753edb9ea3ecc57cf55a448ef0109027db129ad663eadeb9e75beae47921e97f', '[\"*\"]', NULL, NULL, '2025-04-13 06:08:52', '2025-04-13 06:08:52'),
(32, 'App\\Models\\User', 2, 'auth_token', 'ecd6b6ee74a1f35ba39f14b0ad488e266f661b6f1cbc987b07b7d52e1b6eecb3', '[\"*\"]', NULL, NULL, '2025-04-13 06:12:53', '2025-04-13 06:12:53'),
(33, 'App\\Models\\User', 2, 'auth_token', '7efa5649a1a254922fde41e812e7f5818a0b89268b0882419e45f0a144a924aa', '[\"*\"]', NULL, NULL, '2025-04-13 06:13:45', '2025-04-13 06:13:45'),
(34, 'App\\Models\\User', 2, 'auth_token', 'f322a57983ca65ce3bd1a2269efe90034b0c0fa1c3248fa3036e96755b18755c', '[\"*\"]', NULL, NULL, '2025-04-13 08:23:02', '2025-04-13 08:23:02'),
(35, 'App\\Models\\User', 2, 'auth_token', 'b96d38a5a0f6a35099598462f0fd52340260a7acb8174c7882ff17389f08987c', '[\"*\"]', NULL, NULL, '2025-04-13 18:32:12', '2025-04-13 18:32:12'),
(36, 'App\\Models\\User', 2, 'auth_token', '3031978e35c37041ece11b8a479c1d50596b26a6cb0f38d3437954af5d0de575', '[\"*\"]', NULL, NULL, '2025-04-14 01:29:33', '2025-04-14 01:29:33'),
(37, 'App\\Models\\User', 2, 'auth_token', '20f8f00cf6e5bb75d9fe1f51b4e2be2aac80b9e91dcfe3a736e729e4db54d517', '[\"*\"]', NULL, NULL, '2025-04-14 04:54:05', '2025-04-14 04:54:05'),
(38, 'App\\Models\\User', 2, 'auth_token', 'fa88dfba27ceae786c021b9efe63f4905b5807d963889e75c2220a11162aef44', '[\"*\"]', NULL, NULL, '2025-04-14 09:55:10', '2025-04-14 09:55:10'),
(39, 'App\\Models\\User', 2, 'auth_token', 'ac40cdba97586104dc4673467f05d628723afdb491c16300ccd3b568a47f928d', '[\"*\"]', NULL, NULL, '2025-04-14 10:07:08', '2025-04-14 10:07:08'),
(40, 'App\\Models\\User', 2, 'auth_token', 'd98ba1ae8431f4fed8d8b1ff6566465b84d79a5b353634f8678455499dadeb98', '[\"*\"]', NULL, NULL, '2025-04-15 00:14:51', '2025-04-15 00:14:51'),
(41, 'App\\Models\\User', 5, 'auth_token', '076daa2d97a3507044728be70ad5bdf40853c7ef8acab86183a2d53bec5f6693', '[\"*\"]', NULL, NULL, '2025-04-15 06:23:30', '2025-04-15 06:23:30'),
(42, 'App\\Models\\User', 2, 'auth_token', 'b451ee32241af776bf64e543314e09ddc9de4659bd46760ad451013073624fc3', '[\"*\"]', NULL, NULL, '2025-04-15 06:26:59', '2025-04-15 06:26:59'),
(43, 'App\\Models\\User', 2, 'auth_token', '8b2cda82e3d7c1ce2b9773e47b894984e0886fc72fdbd304a362b3ad984a2f14', '[\"*\"]', NULL, NULL, '2025-04-15 06:31:19', '2025-04-15 06:31:19'),
(44, 'App\\Models\\User', 2, 'auth_token', 'b8370479ef812dfd8023277945c75c6924e06a4eb831bbd24be805f5948b98d4', '[\"*\"]', NULL, NULL, '2025-04-15 22:26:15', '2025-04-15 22:26:15'),
(45, 'App\\Models\\User', 2, 'auth_token', 'f63dd94e8627594579b784f4e8af7fd4327011a0fd50ea273d392a60525b0e5c', '[\"*\"]', NULL, NULL, '2025-04-16 05:53:42', '2025-04-16 05:53:42'),
(46, 'App\\Models\\User', 2, 'auth_token', 'bc906d44ade3c4926bb1c062ebd64d563c9a2f5d06b0b943c726ffc04e57e865', '[\"*\"]', NULL, NULL, '2025-04-17 04:55:52', '2025-04-17 04:55:52'),
(47, 'App\\Models\\User', 2, 'auth_token', '45bba54e7d49864bd4721cb199bcaa278e735614359bbe9fe298720fea06c78c', '[\"*\"]', NULL, NULL, '2025-04-17 04:56:27', '2025-04-17 04:56:27'),
(48, 'App\\Models\\User', 2, 'auth_token', 'ab36289217f3d33a3f3958f1798aff232ffc460b54821298e9cc090c17bf0c39', '[\"*\"]', NULL, NULL, '2025-04-17 04:56:38', '2025-04-17 04:56:38'),
(49, 'App\\Models\\User', 2, 'auth_token', '853e2d050cb38bb0e6b3ec6ee998963612a2b18272be0d9cd08fb07256ddc7c0', '[\"*\"]', NULL, NULL, '2025-04-17 04:56:58', '2025-04-17 04:56:58'),
(50, 'App\\Models\\User', 2, 'auth_token', '1152f66abe9700e111f316dd3a3bfdf1eea4c2298e6aeba9a201c813b885c051', '[\"*\"]', NULL, NULL, '2025-04-17 05:05:52', '2025-04-17 05:05:52'),
(51, 'App\\Models\\User', 2, 'auth_token', '72b53d088669e80ce17e37915cee96517930f4c6ea28e55194651269c90d1701', '[\"*\"]', NULL, NULL, '2025-04-17 05:07:50', '2025-04-17 05:07:50'),
(52, 'App\\Models\\User', 2, 'auth_token', '92be499043709d66c149e24b27fdc611e1581c90e437bccb08a5217103a707d1', '[\"*\"]', NULL, NULL, '2025-04-17 05:08:07', '2025-04-17 05:08:07'),
(53, 'App\\Models\\User', 2, 'auth_token', 'b80e59ffd3911b34e460a34be85f3a933d842e5e5b7c80abfb0dbd591dc94c52', '[\"*\"]', NULL, NULL, '2025-04-17 05:08:15', '2025-04-17 05:08:15'),
(54, 'App\\Models\\User', 2, 'auth_token', 'e24d78daefa134c4e406c2ae7cbf692fc3dd96925c9390b701d59adf4ebbec6a', '[\"*\"]', NULL, NULL, '2025-04-17 05:10:12', '2025-04-17 05:10:12'),
(55, 'App\\Models\\User', 2, 'auth_token', '121f8169f4994602b8bb8588a950109707a584c815faeb5d986f7d167823863f', '[\"*\"]', NULL, NULL, '2025-04-17 05:12:58', '2025-04-17 05:12:58'),
(56, 'App\\Models\\User', 2, 'auth_token', 'a3f5d1999cc4b48de6a02facccc1d096eb6c72fa08ce884b2bc532ebb089aed6', '[\"*\"]', NULL, NULL, '2025-04-17 05:15:54', '2025-04-17 05:15:54'),
(57, 'App\\Models\\User', 2, 'auth_token', 'b10c754fcb465014898970bef073f0fcfa44daeeccf21cd62d1a544f9ec0a52c', '[\"*\"]', NULL, NULL, '2025-04-17 05:16:33', '2025-04-17 05:16:33'),
(58, 'App\\Models\\User', 2, 'auth_token', '01b4a1fb69b603a3c1982c5b994df5fe3c1557248d63305d783a43abf2f15155', '[\"*\"]', NULL, NULL, '2025-04-17 05:17:30', '2025-04-17 05:17:30'),
(59, 'App\\Models\\User', 2, 'auth_token', '6f7dcbae54e8666d406bdc9389ff9062f517371d81661d1fb1a777175dfa7dd0', '[\"*\"]', NULL, NULL, '2025-04-17 05:18:10', '2025-04-17 05:18:10'),
(60, 'App\\Models\\User', 2, 'auth_token', 'd0e0e63b21983c5131c3c430b99a39783f3de05a9d84c8dcaabaffe9c319179c', '[\"*\"]', NULL, NULL, '2025-04-17 05:18:57', '2025-04-17 05:18:57'),
(61, 'App\\Models\\User', 2, 'auth_token', 'c9d80c630d04be7a99d6313d42240256ea7c81f203328b1dc36900a599343dd0', '[\"*\"]', NULL, NULL, '2025-04-17 05:20:51', '2025-04-17 05:20:51'),
(62, 'App\\Models\\User', 2, 'auth_token', 'e1739205571a7427638a9091d9702c0c7f6a0b09cf9caae98033bb90f48f2340', '[\"*\"]', NULL, NULL, '2025-04-17 05:24:18', '2025-04-17 05:24:18'),
(63, 'App\\Models\\User', 2, 'auth_token', '7dc36be71752fc4e0d947a3fe03c1b9caa811c8e02a9fa7cdbfaf7baef92df98', '[\"*\"]', NULL, NULL, '2025-04-17 05:28:50', '2025-04-17 05:28:50'),
(64, 'App\\Models\\User', 2, 'auth_token', 'e8de89c79fd0f6010797bebbd83575c7969141aecd9c40b10fa471d4cf36f57a', '[\"*\"]', NULL, NULL, '2025-04-17 05:31:26', '2025-04-17 05:31:26'),
(65, 'App\\Models\\User', 2, 'auth_token', '1939c52a9cdc73fbcc5240d866750cccc1b8b54dc0e1ef14e599ebb5d416c4f8', '[\"*\"]', NULL, NULL, '2025-04-18 04:58:32', '2025-04-18 04:58:32'),
(66, 'App\\Models\\User', 5, 'auth_token', '0bc9cc4ab9bfd42946cd9b9cabff7c387aa0becfc6c68b22ca9c6ef2dc51d0ca', '[\"*\"]', NULL, NULL, '2025-04-18 06:34:40', '2025-04-18 06:34:40'),
(67, 'App\\Models\\User', 5, 'auth_token', '9ec2b18ba899716e748db39633f997be5869ead6faaa80b8060032898717d8ff', '[\"*\"]', NULL, NULL, '2025-04-18 07:21:48', '2025-04-18 07:21:48'),
(68, 'App\\Models\\User', 5, 'auth_token', '0a4480c2553588f87e8d0ad6677ac4101e0368dd762b769a8db7f8d10582e440', '[\"*\"]', NULL, NULL, '2025-04-18 07:38:23', '2025-04-18 07:38:23'),
(69, 'App\\Models\\User', 2, 'auth_token', 'caea500af6facf480053041237101c8574c2779d7764eb3d1026b218f167458a', '[\"*\"]', NULL, NULL, '2025-04-18 19:17:48', '2025-04-18 19:17:48'),
(70, 'App\\Models\\User', 2, 'auth_token', '7b6a9a69ce7bd9d901c877dbee105feb257f956212bdb57a5043ff53d83278cc', '[\"*\"]', NULL, NULL, '2025-04-19 00:03:46', '2025-04-19 00:03:46'),
(71, 'App\\Models\\User', 5, 'auth_token', '2467d6b83f0bcd1a6e6907f5534a22e7ee11dfa491cf276ffaa00d7e6931fd88', '[\"*\"]', NULL, NULL, '2025-04-19 05:20:38', '2025-04-19 05:20:38'),
(72, 'App\\Models\\User', 2, 'auth_token', 'd2b1eff09707c75ce1313f79a94bdb4bdf36f5f1cebe26b15f670d053c3b6850', '[\"*\"]', NULL, NULL, '2025-04-19 22:12:08', '2025-04-19 22:12:08'),
(73, 'App\\Models\\User', 2, 'auth_token', 'cc49078b2b02834b749853fd26847295a8da6ccb075f6980dff62eb23a7df228', '[\"*\"]', NULL, NULL, '2025-04-20 18:15:17', '2025-04-20 18:15:17'),
(74, 'App\\Models\\User', 2, 'auth_token', '70713dba989944b1c3ff3ff8d735f877f4aa99130f8788a698a82f9239615f1e', '[\"*\"]', NULL, NULL, '2025-04-21 09:56:27', '2025-04-21 09:56:27'),
(75, 'App\\Models\\User', 2, 'auth_token', 'dc36cedae2231a439e720732e16defc7d86429413ebb4e5b720f6b27fa71c9bf', '[\"*\"]', NULL, NULL, '2025-04-21 20:24:23', '2025-04-21 20:24:23'),
(76, 'App\\Models\\User', 2, 'auth_token', 'e3a78d3261bb9d1a368043b488f9c62449539408adf895ef5ee6a92da0f4ff48', '[\"*\"]', NULL, NULL, '2025-04-22 10:44:14', '2025-04-22 10:44:14'),
(77, 'App\\Models\\User', 3, 'auth_token', 'a8eef9b6dfae45dbb76cf7871e26bff19c7f26cc40d2ef82b2e982eef36007a5', '[\"*\"]', NULL, NULL, '2025-04-22 21:42:33', '2025-04-22 21:42:33'),
(78, 'App\\Models\\User', 2, 'auth_token', '31df40385f39fad5e960dc2413a7625cbbffb85716994d2b46df52f1e210a18e', '[\"*\"]', NULL, NULL, '2025-04-22 21:45:47', '2025-04-22 21:45:47'),
(79, 'App\\Models\\User', 2, 'auth_token', '660cf72d913a389b22eeb185f71273384267e7b09cb8c427af04570a7b3f011a', '[\"*\"]', NULL, NULL, '2025-04-23 07:37:46', '2025-04-23 07:37:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'Tên bài viết',
  `slug` varchar(255) NOT NULL COMMENT 'URL thân thiện',
  `content` text NOT NULL COMMENT 'Nội dung',
  `thumbnail` varchar(255) DEFAULT NULL COMMENT 'Ảnh đại diện',
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('published','draft','pending') NOT NULL DEFAULT 'draft' COMMENT 'Trạng thái',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Tên danh mục',
  `slug` varchar(255) NOT NULL COMMENT 'URL thân thiện',
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái',
  `description` text DEFAULT NULL COMMENT 'Mô tả',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL COMMENT 'Nội dung',
  `status` enum('published','pending','spam') NOT NULL DEFAULT 'pending' COMMENT 'Trạng thái',
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(255) NOT NULL COMMENT 'Mã sản phẩm',
  `name` varchar(255) NOT NULL COMMENT 'Tên sản phẩm',
  `slug` varchar(255) NOT NULL COMMENT 'URL thân thiện',
  `description` text DEFAULT NULL COMMENT 'Mô tả sản phẩm',
  `price_income` decimal(50,2) NOT NULL COMMENT 'Giá nhập vào',
  `price` decimal(50,2) NOT NULL COMMENT 'Giá cơ bản',
  `price_sale` decimal(50,2) DEFAULT NULL COMMENT 'Giá khuyến mãi',
  `image` varchar(255) DEFAULT NULL COMMENT 'Hình ảnh sản phẩm',
  `quantity` int(11) NOT NULL DEFAULT 0 COMMENT 'Số lượng tồn kho',
  `sold_quantity` int(11) NOT NULL DEFAULT 0 COMMENT 'Số lượng đã bán',
  `average_rating` decimal(3,1) NOT NULL DEFAULT 0.0 COMMENT 'Đánh giá trung bình',
  `view_count` int(11) NOT NULL DEFAULT 0 COMMENT 'Lượt xem sản phẩm',
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái sản phẩm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `slug`, `description`, `price_income`, `price`, `price_sale`, `image`, `quantity`, `sold_quantity`, `average_rating`, `view_count`, `category_id`, `brand_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'SP0001', 'Giày thể thao Nike Air Max', 'giay-the-thao-nike-air-max', 'Mô tả sản phẩm: Giày thể thao Nike Air Max', 1200000.00, 1500000.00, 1350000.00, 'products/nike-air-max.jpg', 748, 21, 4.5, 350, 1, 1, 1, '2025-04-21 08:03:00', '2025-04-21 21:04:16'),
(2, 'SP0002', 'Áo thun Adidas Originals', 'ao-thun-adidas-originals', 'Mô tả sản phẩm: Áo thun Adidas Originals', 200000.00, 350000.00, 300000.00, 'products/adidas-shirt.jpg', 640, 37, 4.2, 120, 2, 2, 1, '2025-04-21 08:03:00', '2025-04-23 08:07:13'),
(3, 'SP0003', 'Quần short Puma Active', 'quan-short-puma-active', 'Mô tả sản phẩm: Quần short Puma Active', 180000.00, 250000.00, 220000.00, 'products/puma-shorts.jpg', 738, 13, 4.0, 90, 2, 3, 1, '2025-04-21 08:03:00', '2025-04-21 21:18:09'),
(4, 'SP0004', 'Giày Converse cổ cao', 'giay-converse-co-cao', 'Mô tả sản phẩm: Giày Converse cổ cao', 700000.00, 1000000.00, 99000.00, 'products/converse-high.jpg', 719, 26, 4.3, 200, 1, 4, 1, '2025-04-21 08:03:00', '2025-04-22 21:50:51'),
(5, 'SP0005', 'Áo hoodie New Balance', 'ao-hoodie-new-balance', 'Mô tả sản phẩm: Áo hoodie New Balance', 450000.00, 600000.00, 550000.00, 'products/nb-hoodie.jpg', 621, 6, 4.1, 70, 2, 5, 1, '2025-04-21 08:03:00', '2025-04-21 21:04:16'),
(6, 'SP0006', 'Mũ lưỡi trai Nike', 'mu-luoi-trai-nike-SP0006', '<p>Mô tả sản phẩm: Mũ lưỡi trai Nike</p>', 100000.00, 180000.00, 150000.00, 'products/5KHDI4VtC7KEv4TeQwcVDl6D1XchElI4xIVBGMY1.jpg', 744, 24, 4.4, 60, 3, 1, 1, '2025-04-21 08:03:00', '2025-04-23 08:10:44'),
(7, 'SP0007', 'Balo Adidas Street', 'balo-adidas-street', 'Mô tả sản phẩm: Balo Adidas Street', 350000.00, 500000.00, 450000.00, 'products/adidas-backpack.jpg', 40, 18, 4.6, 150, 4, 2, 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(8, 'SP0008', 'Quần jogger Puma Lifestyle', 'quan-jogger-puma-lifestyle', 'Mô tả sản phẩm: Quần jogger Puma Lifestyle', 250000.00, 400000.00, 360000.00, 'products/puma-joggers.jpg', 70, 25, 4.2, 110, 2, 3, 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(9, 'SP0009', 'Áo khoác Converse Windbreaker', 'ao-khoac-converse-windbreaker', 'Mô tả sản phẩm: Áo khoác Converse Windbreaker', 500000.00, 750000.00, 700000.00, 'products/converse-jacket.jpg', 35, 8, 4.0, 85, 2, 4, 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(10, 'SP0010', 'Giày chạy bộ New Balance 520', 'giay-chay-bo-new-balance-520', 'Mô tả sản phẩm: Giày chạy bộ New Balance 520', 900000.00, 1200000.00, 1100000.00, 'products/nb-running-shoes.jpg', 758, 27, 4.7, 250, 1, 5, 1, '2025-04-21 08:03:00', '2025-04-21 20:28:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_galleries`
--

CREATE TABLE `product_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL COMMENT 'Hình ảnh phụ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_galleries`
--

INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'galleries/product-1-1.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(2, 1, 'galleries/product-1-2.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(3, 1, 'galleries/product-1-3.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(4, 4, 'galleries/product-4-1.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(5, 4, 'galleries/product-4-2.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(6, 4, 'galleries/product-4-3.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(7, 10, 'galleries/product-10-1.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(8, 10, 'galleries/product-10-2.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(9, 10, 'galleries/product-10-3.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(10, 2, 'galleries/product-2-1.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(11, 2, 'galleries/product-2-2.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(12, 2, 'galleries/product-2-3.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(13, 3, 'galleries/product-3-1.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(14, 3, 'galleries/product-3-2.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(15, 3, 'galleries/product-3-3.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(16, 5, 'galleries/product-5-1.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(17, 5, 'galleries/product-5-2.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(18, 5, 'galleries/product-5-3.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(19, 8, 'galleries/product-8-1.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(20, 8, 'galleries/product-8-2.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(21, 8, 'galleries/product-8-3.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(22, 9, 'galleries/product-9-1.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(23, 9, 'galleries/product-9-2.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(24, 9, 'galleries/product-9-3.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(25, 6, 'galleries/product-6-1.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(26, 6, 'galleries/product-6-2.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(27, 6, 'galleries/product-6-3.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(28, 7, 'galleries/product-7-1.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(29, 7, 'galleries/product-7-2.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(30, 7, 'galleries/product-7-3.jpg', '2025-04-21 08:03:00', '2025-04-21 08:03:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT 'Hình ảnh sản phẩm',
  `price` decimal(15,2) NOT NULL COMMENT 'Giá biến thể',
  `price_sale` decimal(15,2) DEFAULT NULL COMMENT 'Giá giảm',
  `quantity` int(11) NOT NULL DEFAULT 0 COMMENT 'Số lượng tồn kho cho biến thể',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `size_id`, `color_id`, `image`, `price`, `price_sale`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 5, 'variants/variant-1-3-5.jpg', 423985.00, 292903.00, 16, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(2, 1, 3, 1, 'variants/variant-1-3-1.jpg', 203809.00, 352248.00, 43, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(3, 1, 3, 4, 'variants/variant-1-3-4.jpg', 346940.00, 325725.00, 40, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(4, 1, 3, 3, 'variants/variant-1-3-3.jpg', 449666.00, 292159.00, 48, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(5, 1, 3, 2, 'variants/variant-1-3-2.jpg', 207537.00, 227280.00, 8, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(6, 1, 2, 5, 'variants/variant-1-2-5.jpg', 418853.00, 227967.00, 11, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(7, 1, 2, 1, 'variants/variant-1-2-1.jpg', 308387.00, 397345.00, 6, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(8, 1, 2, 4, 'variants/variant-1-2-4.jpg', 311237.00, 183042.00, 33, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(9, 1, 2, 3, 'variants/variant-1-2-3.jpg', 247627.00, 323700.00, 39, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(10, 1, 2, 2, 'variants/variant-1-2-2.jpg', 250141.00, 415391.00, 33, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(11, 1, 1, 5, 'variants/variant-1-1-5.jpg', 404572.00, 197660.00, 43, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(12, 1, 1, 1, 'variants/variant-1-1-1.jpg', 433151.00, 281184.00, 40, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(13, 1, 1, 4, 'variants/variant-1-1-4.jpg', 338308.00, 387798.00, 14, '2025-04-21 08:03:00', '2025-04-21 21:04:16'),
(14, 1, 1, 3, 'variants/variant-1-1-3.jpg', 407535.00, 378442.00, 46, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(15, 1, 1, 2, 'variants/variant-1-1-2.jpg', 231816.00, 321557.00, 20, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(16, 1, 4, 5, 'variants/variant-1-4-5.jpg', 324167.00, 449038.00, 19, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(17, 1, 4, 1, 'variants/variant-1-4-1.jpg', 294634.00, 323685.00, 9, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(18, 1, 4, 4, 'variants/variant-1-4-4.jpg', 212013.00, 256171.00, 43, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(19, 1, 4, 3, 'variants/variant-1-4-3.jpg', 441213.00, 408768.00, 18, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(20, 1, 4, 2, 'variants/variant-1-4-2.jpg', 340925.00, 274695.00, 44, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(21, 1, 5, 5, 'variants/variant-1-5-5.jpg', 203812.00, 425746.00, 34, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(22, 1, 5, 1, 'variants/variant-1-5-1.jpg', 274156.00, 180377.00, 35, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(23, 1, 5, 4, 'variants/variant-1-5-4.jpg', 201293.00, 354509.00, 18, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(24, 1, 5, 3, 'variants/variant-1-5-3.jpg', 235261.00, 338576.00, 49, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(25, 1, 5, 2, 'variants/variant-1-5-2.jpg', 247095.00, 181317.00, 39, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(26, 4, 3, 5, 'variants/variant-4-3-5.jpg', 230735.00, 188194.00, 19, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(27, 4, 3, 1, 'variants/variant-4-3-1.jpg', 325369.00, 272963.00, 44, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(28, 4, 3, 4, 'variants/variant-4-3-4.jpg', 416238.00, 206524.00, 47, '2025-04-21 08:03:00', '2025-04-21 21:04:16'),
(29, 4, 3, 3, 'variants/variant-4-3-3.jpg', 499312.00, 190597.00, 7, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(30, 4, 3, 2, 'variants/variant-4-3-2.jpg', 247195.00, 415065.00, 35, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(31, 4, 2, 5, 'variants/variant-4-2-5.jpg', 307404.00, 362826.00, 6, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(32, 4, 2, 1, 'variants/variant-4-2-1.jpg', 490259.00, 208778.00, 4, '2025-04-21 08:03:00', '2025-04-22 20:11:18'),
(33, 4, 2, 4, 'variants/variant-4-2-4.jpg', 405361.00, 190771.00, 39, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(34, 4, 2, 3, 'variants/variant-4-2-3.jpg', 479231.00, 272252.00, 38, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(35, 4, 2, 2, 'variants/variant-4-2-2.jpg', 341101.00, 253589.00, 5, '2025-04-21 08:03:00', '2025-04-22 11:05:53'),
(36, 4, 1, 5, 'variants/variant-4-1-5.jpg', 344528.00, 221954.00, 47, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(37, 4, 1, 1, 'variants/variant-4-1-1.jpg', 269873.00, 433369.00, 33, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(38, 4, 1, 4, 'variants/variant-4-1-4.jpg', 366914.00, 278745.00, 40, '2025-04-21 08:03:00', '2025-04-22 11:25:02'),
(39, 4, 1, 3, 'variants/variant-4-1-3.jpg', 304344.00, 238986.00, 31, '2025-04-21 08:03:00', '2025-04-22 20:17:04'),
(40, 4, 1, 2, 'variants/variant-4-1-2.jpg', 200088.00, 284443.00, 42, '2025-04-21 08:03:00', '2025-04-22 21:50:51'),
(41, 4, 4, 5, 'variants/variant-4-4-5.jpg', 332536.00, 361560.00, 21, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(42, 4, 4, 1, 'variants/variant-4-4-1.jpg', 476658.00, 402855.00, 15, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(43, 4, 4, 4, 'variants/variant-4-4-4.jpg', 490692.00, 427003.00, 27, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(44, 4, 4, 3, 'variants/variant-4-4-3.jpg', 419229.00, 278179.00, 25, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(45, 4, 4, 2, 'variants/variant-4-4-2.jpg', 408088.00, 329772.00, 15, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(46, 4, 5, 5, 'variants/variant-4-5-5.jpg', 428367.00, 346729.00, 39, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(47, 4, 5, 1, 'variants/variant-4-5-1.jpg', 223228.00, 231363.00, 36, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(48, 4, 5, 4, 'variants/variant-4-5-4.jpg', 216134.00, 325682.00, 45, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(49, 4, 5, 3, 'variants/variant-4-5-3.jpg', 382828.00, 368381.00, 10, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(50, 4, 5, 2, 'variants/variant-4-5-2.jpg', 396677.00, 234375.00, 49, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(51, 10, 3, 5, 'variants/variant-10-3-5.jpg', 478847.00, 274401.00, 7, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(52, 10, 3, 1, 'variants/variant-10-3-1.jpg', 288279.00, 317750.00, 31, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(53, 10, 3, 4, 'variants/variant-10-3-4.jpg', 318934.00, 423723.00, 7, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(54, 10, 3, 3, 'variants/variant-10-3-3.jpg', 265485.00, 368919.00, 26, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(55, 10, 3, 2, 'variants/variant-10-3-2.jpg', 405245.00, 261561.00, 26, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(56, 10, 2, 5, 'variants/variant-10-2-5.jpg', 407517.00, 269736.00, 10, '2025-04-21 08:03:00', '2025-04-21 20:28:07'),
(57, 10, 2, 1, 'variants/variant-10-2-1.jpg', 336852.00, 253744.00, 10, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(58, 10, 2, 4, 'variants/variant-10-2-4.jpg', 236769.00, 354413.00, 28, '2025-04-21 08:03:00', '2025-04-21 20:28:07'),
(59, 10, 2, 3, 'variants/variant-10-2-3.jpg', 416732.00, 356571.00, 42, '2025-04-21 08:03:00', '2025-04-21 20:28:07'),
(60, 10, 2, 2, 'variants/variant-10-2-2.jpg', 462056.00, 421027.00, 42, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(61, 10, 1, 5, 'variants/variant-10-1-5.jpg', 458212.00, 334158.00, 49, '2025-04-21 08:03:00', '2025-04-21 20:28:07'),
(62, 10, 1, 1, 'variants/variant-10-1-1.jpg', 205838.00, 439363.00, 47, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(63, 10, 1, 4, 'variants/variant-10-1-4.jpg', 415101.00, 439390.00, 37, '2025-04-21 08:03:00', '2025-04-21 20:28:07'),
(64, 10, 1, 3, 'variants/variant-10-1-3.jpg', 341531.00, 360709.00, 47, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(65, 10, 1, 2, 'variants/variant-10-1-2.jpg', 210101.00, 340669.00, 46, '2025-04-21 08:03:00', '2025-04-21 20:28:07'),
(66, 10, 4, 5, 'variants/variant-10-4-5.jpg', 460707.00, 234905.00, 46, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(67, 10, 4, 1, 'variants/variant-10-4-1.jpg', 351429.00, 414513.00, 22, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(68, 10, 4, 4, 'variants/variant-10-4-4.jpg', 306936.00, 315525.00, 39, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(69, 10, 4, 3, 'variants/variant-10-4-3.jpg', 310804.00, 400215.00, 15, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(70, 10, 4, 2, 'variants/variant-10-4-2.jpg', 220657.00, 242168.00, 17, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(71, 10, 5, 5, 'variants/variant-10-5-5.jpg', 251607.00, 424842.00, 28, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(72, 10, 5, 1, 'variants/variant-10-5-1.jpg', 419016.00, 253718.00, 46, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(73, 10, 5, 4, 'variants/variant-10-5-4.jpg', 347066.00, 443611.00, 44, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(74, 10, 5, 3, 'variants/variant-10-5-3.jpg', 453689.00, 256732.00, 11, '2025-04-21 08:03:00', '2025-04-21 20:28:07'),
(75, 10, 5, 2, 'variants/variant-10-5-2.jpg', 369024.00, 390565.00, 35, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(76, 2, 3, 5, 'variants/variant-2-3-5.jpg', 354747.00, 220699.00, 25, '2025-04-21 08:03:00', '2025-04-22 20:11:18'),
(77, 2, 3, 1, 'variants/variant-2-3-1.jpg', 387708.00, 364865.00, 11, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(78, 2, 3, 4, 'variants/variant-2-3-4.jpg', 389199.00, 288778.00, 21, '2025-04-21 08:03:00', '2025-04-21 20:28:07'),
(79, 2, 3, 3, 'variants/variant-2-3-3.jpg', 338527.00, 400319.00, 44, '2025-04-21 08:03:00', '2025-04-21 21:16:33'),
(80, 2, 3, 2, 'variants/variant-2-3-2.jpg', 226784.00, 292826.00, 46, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(81, 2, 2, 5, 'variants/variant-2-2-5.jpg', 365370.00, 409500.00, 16, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(82, 2, 2, 1, 'variants/variant-2-2-1.jpg', 282043.00, 332658.00, 36, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(83, 2, 2, 4, 'variants/variant-2-2-4.jpg', 436790.00, 233733.00, 33, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(84, 2, 2, 3, 'variants/variant-2-2-3.jpg', 259290.00, 345633.00, 22, '2025-04-21 08:03:00', '2025-04-23 08:07:13'),
(85, 2, 2, 2, 'variants/variant-2-2-2.jpg', 236324.00, 353526.00, 7, '2025-04-21 08:03:00', '2025-04-21 21:16:33'),
(86, 2, 1, 5, 'variants/variant-2-1-5.jpg', 299711.00, 391277.00, 12, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(87, 2, 1, 1, 'variants/variant-2-1-1.jpg', 379577.00, 395001.00, 21, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(88, 2, 1, 4, 'variants/variant-2-1-4.jpg', 463889.00, 315329.00, 5, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(89, 2, 1, 3, 'variants/variant-2-1-3.jpg', 478043.00, 180741.00, 48, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(90, 2, 1, 2, 'variants/variant-2-1-2.jpg', 300783.00, 339224.00, 15, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(91, 2, 4, 5, 'variants/variant-2-4-5.jpg', 400770.00, 295993.00, 12, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(92, 2, 4, 1, 'variants/variant-2-4-1.jpg', 377846.00, 307052.00, 28, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(93, 2, 4, 4, 'variants/variant-2-4-4.jpg', 363026.00, 426250.00, 9, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(94, 2, 4, 3, 'variants/variant-2-4-3.jpg', 485706.00, 270361.00, 8, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(95, 2, 4, 2, 'variants/variant-2-4-2.jpg', 331498.00, 405025.00, 26, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(96, 2, 5, 5, 'variants/variant-2-5-5.jpg', 476283.00, 329512.00, 17, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(97, 2, 5, 1, 'variants/variant-2-5-1.jpg', 225527.00, 443411.00, 34, '2025-04-21 08:03:00', '2025-04-21 21:16:33'),
(98, 2, 5, 4, 'variants/variant-2-5-4.jpg', 351202.00, 221394.00, 50, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(99, 2, 5, 3, 'variants/variant-2-5-3.jpg', 352974.00, 356198.00, 46, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(100, 2, 5, 2, 'variants/variant-2-5-2.jpg', 227658.00, 320355.00, 48, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(101, 3, 3, 5, 'variants/variant-3-3-5.jpg', 332547.00, 206349.00, 43, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(102, 3, 3, 1, 'variants/variant-3-3-1.jpg', 302904.00, 180872.00, 24, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(103, 3, 3, 4, 'variants/variant-3-3-4.jpg', 455699.00, 330257.00, 37, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(104, 3, 3, 3, 'variants/variant-3-3-3.jpg', 482142.00, 302673.00, 46, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(105, 3, 3, 2, 'variants/variant-3-3-2.jpg', 457819.00, 215535.00, 27, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(106, 3, 2, 5, 'variants/variant-3-2-5.jpg', 378040.00, 193303.00, 28, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(107, 3, 2, 1, 'variants/variant-3-2-1.jpg', 369528.00, 446054.00, 43, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(108, 3, 2, 4, 'variants/variant-3-2-4.jpg', 326425.00, 181437.00, 38, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(109, 3, 2, 3, 'variants/variant-3-2-3.jpg', 399026.00, 367733.00, 16, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(110, 3, 2, 2, 'variants/variant-3-2-2.jpg', 455852.00, 393679.00, 38, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(111, 3, 1, 5, 'variants/variant-3-1-5.jpg', 446425.00, 440932.00, 48, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(112, 3, 1, 1, 'variants/variant-3-1-1.jpg', 216372.00, 287139.00, 31, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(113, 3, 1, 4, 'variants/variant-3-1-4.jpg', 217006.00, 181345.00, 16, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(114, 3, 1, 3, 'variants/variant-3-1-3.jpg', 497170.00, 250734.00, 18, '2025-04-21 08:03:00', '2025-04-21 21:04:16'),
(115, 3, 1, 2, 'variants/variant-3-1-2.jpg', 392577.00, 242426.00, 35, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(116, 3, 4, 5, 'variants/variant-3-4-5.jpg', 383377.00, 332481.00, 21, '2025-04-21 08:03:00', '2025-04-21 20:28:07'),
(117, 3, 4, 1, 'variants/variant-3-4-1.jpg', 373372.00, 447992.00, 6, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(118, 3, 4, 4, 'variants/variant-3-4-4.jpg', 206993.00, 184969.00, 26, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(119, 3, 4, 3, 'variants/variant-3-4-3.jpg', 478415.00, 355761.00, 33, '2025-04-21 08:03:00', '2025-04-21 21:18:09'),
(120, 3, 4, 2, 'variants/variant-3-4-2.jpg', 350124.00, 260473.00, 50, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(121, 3, 5, 5, 'variants/variant-3-5-5.jpg', 329834.00, 378694.00, 19, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(122, 3, 5, 1, 'variants/variant-3-5-1.jpg', 266724.00, 239531.00, 11, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(123, 3, 5, 4, 'variants/variant-3-5-4.jpg', 428367.00, 441019.00, 36, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(124, 3, 5, 3, 'variants/variant-3-5-3.jpg', 490322.00, 362656.00, 15, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(125, 3, 5, 2, 'variants/variant-3-5-2.jpg', 235095.00, 203134.00, 33, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(126, 5, 3, 5, 'variants/variant-5-3-5.jpg', 215813.00, 272795.00, 45, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(127, 5, 3, 1, 'variants/variant-5-3-1.jpg', 417417.00, 314572.00, 6, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(128, 5, 3, 4, 'variants/variant-5-3-4.jpg', 418479.00, 194821.00, 35, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(129, 5, 3, 3, 'variants/variant-5-3-3.jpg', 364211.00, 360929.00, 27, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(130, 5, 3, 2, 'variants/variant-5-3-2.jpg', 264764.00, 359303.00, 14, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(131, 5, 2, 5, 'variants/variant-5-2-5.jpg', 298936.00, 438654.00, 33, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(132, 5, 2, 1, 'variants/variant-5-2-1.jpg', 319532.00, 406194.00, 50, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(133, 5, 2, 4, 'variants/variant-5-2-4.jpg', 316749.00, 286095.00, 16, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(134, 5, 2, 3, 'variants/variant-5-2-3.jpg', 334229.00, 298912.00, 40, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(135, 5, 2, 2, 'variants/variant-5-2-2.jpg', 289574.00, 320025.00, 8, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(136, 5, 1, 5, 'variants/variant-5-1-5.jpg', 235484.00, 413058.00, 8, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(137, 5, 1, 1, 'variants/variant-5-1-1.jpg', 205799.00, 203764.00, 49, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(138, 5, 1, 4, 'variants/variant-5-1-4.jpg', 486709.00, 202438.00, 28, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(139, 5, 1, 3, 'variants/variant-5-1-3.jpg', 433395.00, 406921.00, 6, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(140, 5, 1, 2, 'variants/variant-5-1-2.jpg', 335197.00, 448605.00, 18, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(141, 5, 4, 5, 'variants/variant-5-4-5.jpg', 210812.00, 283841.00, 22, '2025-04-21 08:03:00', '2025-04-21 21:04:16'),
(142, 5, 4, 1, 'variants/variant-5-4-1.jpg', 229798.00, 360060.00, 22, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(143, 5, 4, 4, 'variants/variant-5-4-4.jpg', 209479.00, 275283.00, 8, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(144, 5, 4, 3, 'variants/variant-5-4-3.jpg', 359231.00, 247082.00, 33, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(145, 5, 4, 2, 'variants/variant-5-4-2.jpg', 269289.00, 306905.00, 10, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(146, 5, 5, 5, 'variants/variant-5-5-5.jpg', 282062.00, 399860.00, 32, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(147, 5, 5, 1, 'variants/variant-5-5-1.jpg', 288502.00, 287482.00, 37, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(148, 5, 5, 4, 'variants/variant-5-5-4.jpg', 396305.00, 409882.00, 23, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(149, 5, 5, 3, 'variants/variant-5-5-3.jpg', 422429.00, 331561.00, 8, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(150, 5, 5, 2, 'variants/variant-5-5-2.jpg', 315930.00, 405558.00, 43, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(151, 8, 3, 5, 'variants/variant-8-3-5.jpg', 283170.00, 227350.00, 7, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(152, 8, 3, 1, 'variants/variant-8-3-1.jpg', 456571.00, 233119.00, 22, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(153, 8, 3, 4, 'variants/variant-8-3-4.jpg', 215947.00, 322189.00, 39, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(154, 8, 3, 3, 'variants/variant-8-3-3.jpg', 415654.00, 230479.00, 36, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(155, 8, 3, 2, 'variants/variant-8-3-2.jpg', 233632.00, 356626.00, 48, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(156, 8, 2, 5, 'variants/variant-8-2-5.jpg', 429751.00, 266833.00, 39, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(157, 8, 2, 1, 'variants/variant-8-2-1.jpg', 306130.00, 269733.00, 10, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(158, 8, 2, 4, 'variants/variant-8-2-4.jpg', 380309.00, 255960.00, 5, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(159, 8, 2, 3, 'variants/variant-8-2-3.jpg', 236210.00, 231005.00, 20, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(160, 8, 2, 2, 'variants/variant-8-2-2.jpg', 228188.00, 417715.00, 31, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(161, 8, 1, 5, 'variants/variant-8-1-5.jpg', 275705.00, 383317.00, 28, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(162, 8, 1, 1, 'variants/variant-8-1-1.jpg', 272171.00, 262332.00, 8, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(163, 8, 1, 4, 'variants/variant-8-1-4.jpg', 465720.00, 245237.00, 12, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(164, 8, 1, 3, 'variants/variant-8-1-3.jpg', 315114.00, 207458.00, 21, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(165, 8, 1, 2, 'variants/variant-8-1-2.jpg', 382867.00, 424139.00, 7, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(166, 8, 4, 5, 'variants/variant-8-4-5.jpg', 251265.00, 244883.00, 20, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(167, 8, 4, 1, 'variants/variant-8-4-1.jpg', 242235.00, 303060.00, 6, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(168, 8, 4, 4, 'variants/variant-8-4-4.jpg', 202112.00, 407268.00, 6, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(169, 8, 4, 3, 'variants/variant-8-4-3.jpg', 456439.00, 285003.00, 35, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(170, 8, 4, 2, 'variants/variant-8-4-2.jpg', 446800.00, 427990.00, 27, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(171, 8, 5, 5, 'variants/variant-8-5-5.jpg', 276501.00, 391817.00, 37, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(172, 8, 5, 1, 'variants/variant-8-5-1.jpg', 236683.00, 294184.00, 38, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(173, 8, 5, 4, 'variants/variant-8-5-4.jpg', 319574.00, 218979.00, 14, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(174, 8, 5, 3, 'variants/variant-8-5-3.jpg', 346549.00, 404111.00, 23, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(175, 8, 5, 2, 'variants/variant-8-5-2.jpg', 372186.00, 328699.00, 5, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(176, 9, 3, 5, 'variants/variant-9-3-5.jpg', 329605.00, 273679.00, 20, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(177, 9, 3, 1, 'variants/variant-9-3-1.jpg', 456562.00, 199779.00, 26, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(178, 9, 3, 4, 'variants/variant-9-3-4.jpg', 361045.00, 241290.00, 7, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(179, 9, 3, 3, 'variants/variant-9-3-3.jpg', 364683.00, 428844.00, 11, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(180, 9, 3, 2, 'variants/variant-9-3-2.jpg', 424639.00, 374669.00, 48, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(181, 9, 2, 5, 'variants/variant-9-2-5.jpg', 287523.00, 231527.00, 18, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(182, 9, 2, 1, 'variants/variant-9-2-1.jpg', 340673.00, 298661.00, 50, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(183, 9, 2, 4, 'variants/variant-9-2-4.jpg', 228047.00, 297213.00, 9, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(184, 9, 2, 3, 'variants/variant-9-2-3.jpg', 448425.00, 322396.00, 40, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(185, 9, 2, 2, 'variants/variant-9-2-2.jpg', 315235.00, 447533.00, 13, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(186, 9, 1, 5, 'variants/variant-9-1-5.jpg', 337515.00, 191103.00, 27, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(187, 9, 1, 1, 'variants/variant-9-1-1.jpg', 380629.00, 329172.00, 12, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(188, 9, 1, 4, 'variants/variant-9-1-4.jpg', 271672.00, 354825.00, 44, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(189, 9, 1, 3, 'variants/variant-9-1-3.jpg', 343122.00, 345533.00, 47, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(190, 9, 1, 2, 'variants/variant-9-1-2.jpg', 230871.00, 428263.00, 18, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(191, 9, 4, 5, 'variants/variant-9-4-5.jpg', 229333.00, 369664.00, 11, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(192, 9, 4, 1, 'variants/variant-9-4-1.jpg', 391963.00, 316571.00, 42, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(193, 9, 4, 4, 'variants/variant-9-4-4.jpg', 223735.00, 372485.00, 25, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(194, 9, 4, 3, 'variants/variant-9-4-3.jpg', 449342.00, 417287.00, 30, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(195, 9, 4, 2, 'variants/variant-9-4-2.jpg', 474517.00, 433188.00, 15, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(196, 9, 5, 5, 'variants/variant-9-5-5.jpg', 450581.00, 394598.00, 33, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(197, 9, 5, 1, 'variants/variant-9-5-1.jpg', 280718.00, 358440.00, 46, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(198, 9, 5, 4, 'variants/variant-9-5-4.jpg', 494133.00, 180649.00, 35, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(199, 9, 5, 3, 'variants/variant-9-5-3.jpg', 258357.00, 446011.00, 10, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(200, 9, 5, 2, 'variants/variant-9-5-2.jpg', 463291.00, 365208.00, 35, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(201, 6, 3, 5, 'product_variant/bMgKAD204JAJuWnnrK4NExt1H4jzux7yR36SnYJd.jpg', 477817.00, 477817.00, 8, '2025-04-21 08:03:00', '2025-04-22 11:04:07'),
(202, 6, 3, 1, 'variants/variant-6-3-1.jpg', 434288.00, 434288.00, 40, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(203, 6, 3, 4, 'variants/variant-6-3-4.jpg', 442235.00, 442235.00, 24, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(204, 6, 3, 3, 'variants/variant-6-3-3.jpg', 425224.00, 425224.00, 11, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(205, 6, 3, 2, 'variants/variant-6-3-2.jpg', 229326.00, 229326.00, 43, '2025-04-21 08:03:00', '2025-04-23 08:10:44'),
(206, 6, 2, 5, 'variants/variant-6-2-5.jpg', 396114.00, 396114.00, 42, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(207, 6, 2, 1, 'variants/variant-6-2-1.jpg', 325101.00, 325101.00, 41, '2025-04-21 08:03:00', '2025-04-22 21:29:36'),
(208, 6, 2, 4, 'variants/variant-6-2-4.jpg', 368937.00, 368937.00, 48, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(209, 6, 2, 3, 'variants/variant-6-2-3.jpg', 458476.00, 458476.00, 15, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(210, 6, 2, 2, 'variants/variant-6-2-2.jpg', 395628.00, 395628.00, 39, '2025-04-21 08:03:00', '2025-04-22 21:52:00'),
(211, 6, 1, 5, 'variants/variant-6-1-5.jpg', 343683.00, 343683.00, 24, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(212, 6, 1, 1, 'variants/variant-6-1-1.jpg', 413786.00, 413786.00, 32, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(213, 6, 1, 4, 'variants/variant-6-1-4.jpg', 478742.00, 478742.00, 3, '2025-04-21 08:03:00', '2025-04-22 21:46:38'),
(214, 6, 1, 3, 'variants/variant-6-1-3.jpg', 265559.00, 265559.00, 44, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(215, 6, 1, 2, 'variants/variant-6-1-2.jpg', 400000.00, 400000.00, 22, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(216, 6, 4, 5, 'variants/variant-6-4-5.jpg', 369663.00, 369663.00, 29, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(217, 6, 4, 1, 'variants/variant-6-4-1.jpg', 331911.00, 331911.00, 41, '2025-04-21 08:03:00', '2025-04-21 20:28:07'),
(218, 6, 4, 4, 'variants/variant-6-4-4.jpg', 251485.00, 251485.00, 33, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(219, 6, 4, 3, 'variants/variant-6-4-3.jpg', 496328.00, 496328.00, 25, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(220, 6, 4, 2, 'variants/variant-6-4-2.jpg', 204840.00, 204840.00, 33, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(221, 6, 5, 5, 'variants/variant-6-5-5.jpg', 249016.00, 249016.00, 29, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(222, 6, 5, 1, 'variants/variant-6-5-1.jpg', 212558.00, 212558.00, 43, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(223, 6, 5, 4, 'variants/variant-6-5-4.jpg', 390375.00, 390375.00, 38, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(224, 6, 5, 3, 'variants/variant-6-5-3.jpg', 402963.00, 402963.00, 37, '2025-04-21 08:03:00', '2025-04-21 09:59:49'),
(225, 6, 5, 2, 'variants/variant-6-5-2.jpg', 341480.00, 341480.00, 0, '2025-04-21 08:03:00', '2025-04-23 08:09:10'),
(226, 7, 3, 5, 'variants/variant-7-3-5.jpg', 356768.00, 408674.00, 28, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(227, 7, 3, 1, 'variants/variant-7-3-1.jpg', 201434.00, 229786.00, 9, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(228, 7, 3, 4, 'variants/variant-7-3-4.jpg', 473126.00, 433024.00, 13, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(229, 7, 3, 3, 'variants/variant-7-3-3.jpg', 393559.00, 225827.00, 12, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(230, 7, 3, 2, 'variants/variant-7-3-2.jpg', 236661.00, 282730.00, 6, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(231, 7, 2, 5, 'variants/variant-7-2-5.jpg', 298747.00, 330251.00, 35, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(232, 7, 2, 1, 'variants/variant-7-2-1.jpg', 405366.00, 309049.00, 40, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(233, 7, 2, 4, 'variants/variant-7-2-4.jpg', 470138.00, 347662.00, 38, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(234, 7, 2, 3, 'variants/variant-7-2-3.jpg', 334809.00, 294746.00, 11, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(235, 7, 2, 2, 'variants/variant-7-2-2.jpg', 249261.00, 273087.00, 37, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(236, 7, 1, 5, 'variants/variant-7-1-5.jpg', 367632.00, 446195.00, 29, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(237, 7, 1, 1, 'variants/variant-7-1-1.jpg', 288392.00, 298411.00, 10, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(238, 7, 1, 4, 'variants/variant-7-1-4.jpg', 214559.00, 228292.00, 45, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(239, 7, 1, 3, 'variants/variant-7-1-3.jpg', 295736.00, 360691.00, 31, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(240, 7, 1, 2, 'variants/variant-7-1-2.jpg', 450048.00, 443747.00, 49, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(241, 7, 4, 5, 'variants/variant-7-4-5.jpg', 298758.00, 270351.00, 18, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(242, 7, 4, 1, 'variants/variant-7-4-1.jpg', 463165.00, 216253.00, 42, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(243, 7, 4, 4, 'variants/variant-7-4-4.jpg', 282985.00, 422220.00, 41, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(244, 7, 4, 3, 'variants/variant-7-4-3.jpg', 344569.00, 227677.00, 37, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(245, 7, 4, 2, 'variants/variant-7-4-2.jpg', 405195.00, 213932.00, 44, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(246, 7, 5, 5, 'variants/variant-7-5-5.jpg', 314968.00, 251621.00, 49, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(247, 7, 5, 1, 'variants/variant-7-5-1.jpg', 451908.00, 183304.00, 26, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(248, 7, 5, 4, 'variants/variant-7-5-4.jpg', 391698.00, 340048.00, 43, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(249, 7, 5, 3, 'variants/variant-7-5-3.jpg', 403383.00, 219212.00, 15, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(250, 7, 5, 2, 'variants/variant-7-5-2.jpg', 311854.00, 345349.00, 29, '2025-04-21 08:03:00', '2025-04-21 08:03:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `courier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','in_transit','delivered','failed','returned') NOT NULL DEFAULT 'pending',
  `tracking_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL COMMENT 'Kích cỡ',
  `slug` varchar(255) NOT NULL COMMENT 'URL thân thiện',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'S', 's', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(2, 'M', 'm', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(3, 'L', 'l', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(4, 'XL', 'xl', '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(5, 'XXL', 'xxl', '2025-04-21 08:03:00', '2025-04-21 08:03:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transactions_code` varchar(255) NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(20,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL COMMENT 'Tên đăng nhập',
  `password` varchar(255) NOT NULL COMMENT 'Mật khẩu',
  `name` varchar(255) NOT NULL COMMENT 'Tên người dùng',
  `email` varchar(255) NOT NULL COMMENT 'Email',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Ảnh đại diện',
  `phone` varchar(255) DEFAULT NULL COMMENT 'Số điện thoại',
  `email_verified_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian xác nhận email',
  `role` enum('admin','user','shipper') NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `avatar`, `phone`, `email_verified_at`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'user', '$2y$12$SWgRrVBTcdPKiIC.8GCC7.luOyNBpiL7hHe1M8KZmRnaks0/.za2S', 'User Account', 'user@gmail.com', 'avatars/default.png', '0900000001', '2025-04-23 04:33:05', 'user', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00'),
(2, 'admin', '$2y$12$RZz3efLzZdcXHJyg/4nRB.LS6.PWeP3zRBIIapJly.Tlj3WtwT/.O', 'Admin Account', 'admin@gmail.com', 'avatars/default.png', '0394422302', '2025-04-22 03:25:02', 'admin', 1, '2025-04-21 08:03:00', '2025-04-23 07:38:57'),
(3, 'shipper', '$2y$12$A1zKuYZABvFp/mIngFyd/O3LiqFJsH01aTH/1Ug2J76C30i3Owrgi', 'Shipper Account', 'shipper@gmail.com', 'avatars/default.png', '0900000003', NULL, 'shipper', 1, '2025-04-21 08:03:00', '2025-04-21 08:03:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `website_informations`
--

CREATE TABLE `website_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colors_slug_unique` (`slug`),
  ADD UNIQUE KEY `colors_code_unique` (`code`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_product_id_foreign` (`product_id`),
  ADD KEY `1` (`parent_id`);

--
-- Chỉ mục cho bảng `comment_galleries`
--
ALTER TABLE `comment_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_galleries_comment_id_foreign` (`comment_id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contacts_contact_code_unique` (`contact_code`),
  ADD KEY `contacts_user_id_foreign` (`user_id`),
  ADD KEY `contacts_responded_by_foreign` (`responded_by`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Chỉ mục cho bảng `coupon_brands`
--
ALTER TABLE `coupon_brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_brands_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupon_brands_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `coupon_categories`
--
ALTER TABLE `coupon_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_categories_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupon_categories_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_user_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupon_user_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `couriers_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `courier_reviews`
--
ALTER TABLE `courier_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courier_reviews_courier_id_foreign` (`courier_id`),
  ADD KEY `courier_reviews_user_id_foreign` (`user_id`),
  ADD KEY `courier_reviews_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_coupon_id_foreign` (`coupon_id`);

--
-- Chỉ mục cho bảng `order_cancellations`
--
ALTER TABLE `order_cancellations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_cancellations_order_id_foreign` (`order_id`),
  ADD KEY `order_cancellations_reason_id_foreign` (`reason_id`),
  ADD KEY `order_cancellations_cancelled_by_id_foreign` (`cancelled_by_id`);

--
-- Chỉ mục cho bảng `order_cancellation_reasons`
--
ALTER TABLE `order_cancellation_reasons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_cancellation_reasons_reason_unique` (`reason`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comments_post_id_foreign` (`post_id`),
  ADD KEY `post_comments_user_id_foreign` (`user_id`),
  ADD KEY `post_comments_parent_id_foreign` (`parent_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_galleries_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`),
  ADD KEY `product_variants_size_id_foreign` (`size_id`),
  ADD KEY `product_variants_color_id_foreign` (`color_id`);

--
-- Chỉ mục cho bảng `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipments_tracking_number_unique` (`tracking_number`),
  ADD KEY `shipments_order_id_foreign` (`order_id`),
  ADD KEY `shipments_courier_id_foreign` (`courier_id`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sizes_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_transactions_code_unique` (`transactions_code`),
  ADD KEY `transactions_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `website_informations`
--
ALTER TABLE `website_informations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `website_informations_email_unique` (`email`);

--
-- Chỉ mục cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `comment_galleries`
--
ALTER TABLE `comment_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `coupon_brands`
--
ALTER TABLE `coupon_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `coupon_categories`
--
ALTER TABLE `coupon_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `coupon_user`
--
ALTER TABLE `coupon_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `courier_reviews`
--
ALTER TABLE `courier_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `order_cancellations`
--
ALTER TABLE `order_cancellations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_cancellation_reasons`
--
ALTER TABLE `order_cancellation_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product_galleries`
--
ALTER TABLE `product_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT cho bảng `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `website_informations`
--
ALTER TABLE `website_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `1` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comment_galleries`
--
ALTER TABLE `comment_galleries`
  ADD CONSTRAINT `comment_galleries_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_responded_by_foreign` FOREIGN KEY (`responded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `coupon_brands`
--
ALTER TABLE `coupon_brands`
  ADD CONSTRAINT `coupon_brands_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_brands_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `coupon_categories`
--
ALTER TABLE `coupon_categories`
  ADD CONSTRAINT `coupon_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_categories_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD CONSTRAINT `coupon_user_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `couriers`
--
ALTER TABLE `couriers`
  ADD CONSTRAINT `couriers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `courier_reviews`
--
ALTER TABLE `courier_reviews`
  ADD CONSTRAINT `courier_reviews_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courier_reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `courier_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_cancellations`
--
ALTER TABLE `order_cancellations`
  ADD CONSTRAINT `order_cancellations_cancelled_by_id_foreign` FOREIGN KEY (`cancelled_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_cancellations_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_cancellations_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `order_cancellation_reasons` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `post_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD CONSTRAINT `product_galleries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variants_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shipments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
