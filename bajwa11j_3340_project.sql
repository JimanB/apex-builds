-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 28, 2025 at 10:26 AM
-- Server version: 10.4.34-MariaDB-log
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bajwa11j_3340_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `is_read`, `submitted_at`) VALUES
(1, 'jim', 'jimansingh@gmail.com', 'not enough parts', 'i want more parts options, this isnt enough, this is sickening, i am going to memory express, screw this trash site', 0, '2025-07-25 19:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `order_date`) VALUES
(1, 1, 7185.00, '2025-07-23 17:37:32'),
(2, 1, 7185.00, '2025-07-23 17:39:00'),
(3, 3, 7185.00, '2025-07-24 02:54:56'),
(4, 5, 1912.00, '2025-07-27 20:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `product_price`) VALUES
(1, 1, 'Intel Core i9-14900K', 639.00),
(2, 1, 'NVIDIA RTX 4090', 3250.00),
(3, 1, 'ASUS ROG Maximus Z790', 950.00),
(4, 1, 'Vengeance RGB 32GB DDR5 6000MHz CL36 Dual Channel Kit (2x 16GB)', 165.00),
(5, 1, 'WD_BLACK 2TB SN850X NVMe M.2 Internal SSD', 220.00),
(6, 1, 'Noctua NH-D15, Premium CPU Cooler with 2X NF-A15 PWM 140mm Fans (Brown)', 120.00),
(7, 1, 'TUF GAMING 80+ GOLD Fully Modular, 1000W', 240.00),
(8, 1, 'Lian Li O11 Dynamic EVO XL Full Tower', 330.00),
(9, 1, 'CORSAIR iCUE ML120 RGB ELITE Premium 120mm PWM Magnetic Levitation Fans 3-Pack', 155.00),
(10, 1, 'Windows 11 Pro, OEM (64 bit)', 210.00),
(11, 1, '2TB BarraCuda HDD, SATA III w/ 256MB Cache ', 90.00),
(12, 1, 'ASUS TUF Gaming (VG27AQ3A) 27in LED LCD Gaming Monitor w/ 180Hz', 340.00),
(13, 1, 'MSI FORGE GK310 Gaming Keyboard w/ Hot Swappable Red Mechanical Key Switches', 75.00),
(14, 1, 'Logitech G502 Hero RGB Gaming Mouse, Black ', 80.00),
(15, 1, 'HyperX Cloud Stinger 2 Gaming Headset wired, Black ', 60.00),
(16, 1, 'Logitech C920s Pro HD 1080p Webcam, Black ', 100.00),
(17, 1, 'HyperX SoloCast USB Condenser Gaming Microphone ', 70.00),
(18, 1, 'Logitech  Z150 2.0 Speakers, Black ', 40.00),
(19, 1, 'TP-Link USB WiFi Adapter for PC (Archer T3U Plus) Dual Band Network Adapter with 2.4GHz/5GHz High Gain Antenna', 25.00),
(20, 1, 'Clovertale Braided ATX Sleeved Cable Extension kit for Power Supply', 26.00),
(21, 2, 'Intel Core i9-14900K', 639.00),
(22, 2, 'NVIDIA RTX 4090', 3250.00),
(23, 2, 'ASUS ROG Maximus Z790', 950.00),
(24, 2, 'Vengeance RGB 32GB DDR5 6000MHz CL36 Dual Channel Kit (2x 16GB)', 165.00),
(25, 2, 'WD_BLACK 2TB SN850X NVMe M.2 Internal SSD', 220.00),
(26, 2, 'Noctua NH-D15, Premium CPU Cooler with 2X NF-A15 PWM 140mm Fans (Brown)', 120.00),
(27, 2, 'TUF GAMING 80+ GOLD Fully Modular, 1000W', 240.00),
(28, 2, 'Lian Li O11 Dynamic EVO XL Full Tower', 330.00),
(29, 2, 'CORSAIR iCUE ML120 RGB ELITE Premium 120mm PWM Magnetic Levitation Fans 3-Pack', 155.00),
(30, 2, 'Windows 11 Pro, OEM (64 bit)', 210.00),
(31, 2, '2TB BarraCuda HDD, SATA III w/ 256MB Cache ', 90.00),
(32, 2, 'ASUS TUF Gaming (VG27AQ3A) 27in LED LCD Gaming Monitor w/ 180Hz', 340.00),
(33, 2, 'MSI FORGE GK310 Gaming Keyboard w/ Hot Swappable Red Mechanical Key Switches', 75.00),
(34, 2, 'Logitech G502 Hero RGB Gaming Mouse, Black ', 80.00),
(35, 2, 'HyperX Cloud Stinger 2 Gaming Headset wired, Black ', 60.00),
(36, 2, 'Logitech C920s Pro HD 1080p Webcam, Black ', 100.00),
(37, 2, 'HyperX SoloCast USB Condenser Gaming Microphone ', 70.00),
(38, 2, 'Logitech  Z150 2.0 Speakers, Black ', 40.00),
(39, 2, 'TP-Link USB WiFi Adapter for PC (Archer T3U Plus) Dual Band Network Adapter with 2.4GHz/5GHz High Gain Antenna', 25.00),
(40, 2, 'Clovertale Braided ATX Sleeved Cable Extension kit for Power Supply', 26.00),
(41, 3, 'Intel Core i9-14900K', 639.00),
(42, 3, 'NVIDIA RTX 4090', 3250.00),
(43, 3, 'ASUS ROG Maximus Z790', 950.00),
(44, 3, 'Vengeance RGB 32GB DDR5 6000MHz CL36 Dual Channel Kit (2x 16GB)', 165.00),
(45, 3, 'WD_BLACK 2TB SN850X NVMe M.2 Internal SSD', 220.00),
(46, 3, 'Noctua NH-D15, Premium CPU Cooler with 2X NF-A15 PWM 140mm Fans (Brown)', 120.00),
(47, 3, 'TUF GAMING 80+ GOLD Fully Modular, 1000W', 240.00),
(48, 3, 'Lian Li O11 Dynamic EVO XL Full Tower', 330.00),
(49, 3, 'CORSAIR iCUE ML120 RGB ELITE Premium 120mm PWM Magnetic Levitation Fans 3-Pack', 155.00),
(50, 3, 'Windows 11 Pro, OEM (64 bit)', 210.00),
(51, 3, '2TB BarraCuda HDD, SATA III w/ 256MB Cache ', 90.00),
(52, 3, 'ASUS TUF Gaming (VG27AQ3A) 27in LED LCD Gaming Monitor w/ 180Hz', 340.00),
(53, 3, 'MSI FORGE GK310 Gaming Keyboard w/ Hot Swappable Red Mechanical Key Switches', 75.00),
(54, 3, 'Logitech G502 Hero RGB Gaming Mouse, Black ', 80.00),
(55, 3, 'HyperX Cloud Stinger 2 Gaming Headset wired, Black ', 60.00),
(56, 3, 'Logitech C920s Pro HD 1080p Webcam, Black ', 100.00),
(57, 3, 'HyperX SoloCast USB Condenser Gaming Microphone ', 70.00),
(58, 3, 'Logitech  Z150 2.0 Speakers, Black ', 40.00),
(59, 3, 'TP-Link USB WiFi Adapter for PC (Archer T3U Plus) Dual Band Network Adapter with 2.4GHz/5GHz High Gain Antenna', 25.00),
(60, 3, 'Clovertale Braided ATX Sleeved Cable Extension kit for Power Supply', 26.00),
(61, 4, 'AMD Ryzen 5 7600X', 270.00),
(62, 4, 'Gigabyte WINDFORCE OC GeForce RTX 5060 8GB', 415.00),
(63, 4, 'MSI B650 GAMING PLUS WIFI ATX AM5 Motherboard', 230.00),
(64, 4, 'Vengeance 16GB DDR5 5200MHz CL40 Dual Channel Memory Kit (2x 8GB)', 83.00),
(65, 4, 'WD_BLACK 1TB SN850x NVMe Internal Gaming M.2 SSD w/ Heatsink', 204.00),
(66, 4, 'Thermalright Phantom Spirit', 50.00),
(67, 4, 'MAG A850GL PCIE5, 80+ Gold Fully Modular, 850W', 200.00),
(68, 4, 'Fractal Design North ATX Mid Tower Case', 155.00),
(69, 4, 'Lian Li Uni SL-Infinity 120 ARGB 120mm Case Fans 3-Pack', 140.00),
(70, 4, 'Windows 11 Home, OEM (64 bit) ', 165.00),
(71, 4, 'None', 0.00),
(72, 4, 'None', 0.00),
(73, 4, 'None', 0.00),
(74, 4, 'None', 0.00),
(75, 4, 'None', 0.00),
(76, 4, 'None', 0.00),
(77, 4, 'None', 0.00),
(78, 4, 'None', 0.00),
(79, 4, 'none', 0.00),
(80, 4, 'none', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `displayName` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `displayName`, `name`, `price`, `image`) VALUES
(1, 'CPU', 'Processor', 'Intel Core i9-14900K', 639.00, 'images/cpu_intel_i9.png'),
(2, 'CPU', 'Processor', 'AMD Ryzen 9 7950X3D', 978.00, 'images/cpu_amd_r9.png'),
(3, 'CPU', 'Processor', 'Intel Core i5-14600K', 500.00, 'images/cpu_intel_i5.png'),
(4, 'GPU', 'Graphics Card', 'MSI GAMING TRIO GeForce RTX 4090 24GB', 3250.00, 'images/gpu_rtx_4090.png'),
(5, 'GPU', 'Graphics Card', 'Gigabyte GAMING OC Radeon RX 7900 XTX 24 GB', 1552.00, 'images/gpu_rx_7900xtx.png'),
(6, 'GPU', 'Graphics Card', 'MSI GAMING X SLIM GeForce RTX 4070 Ti SUPER 16GB', 1769.00, 'images/gpu_rtx_4070ti.png'),
(7, 'Motherboard', 'Motherboard', 'ASUS ROG Maximus Z790', 950.00, 'images/mobo_asus_z790.png'),
(8, 'Motherboard', 'Motherboard', 'MSI MAG B650 Tomahawk', 290.00, 'images/mobo_msi_b650.png'),
(9, 'Motherboard', 'Motherboard', 'Gigabyte Z790 AORUS Elite', 367.00, 'images/mobo_gigabyte_z790.png'),
(10, 'RAM', 'Memory (RAM)', 'Vengeance RGB 32GB DDR5 6000MHz CL36 Dual Channel Kit (2x 16GB)', 165.00, 'images/ram_32gb.png'),
(11, 'RAM', 'Memory (RAM)', 'Vengeance RGB 64GB DDR5 5600MHz CL40 Dual Channel Kit (2x 32GB)', 245.00, 'images/ram_64gb.png'),
(12, 'RAM', 'Memory (RAM)', 'Vengeance 16GB DDR5 5200MHz CL40 Dual Channel Memory Kit (2x 8GB)', 83.00, 'images/ram_16gb.png'),
(13, 'SSD', 'Primary Storage (SSD)', 'WD_BLACK 2TB SN850X NVMe M.2 Internal SSD', 220.00, 'images/ssd_2tb.png'),
(14, 'SSD', 'Primary Storage (SSD)', 'Samsung 990 EVO Plus - 4TB PCIe Gen4 M.2 Internal SSD', 430.00, 'images/ssd_4tb.png'),
(15, 'SSD', 'Primary Storage (SSD)', 'WD_BLACK 1TB SN850x NVMe Internal Gaming M.2 SSD w/ Heatsink', 204.00, 'images/ssd_1tb.png'),
(16, 'PSU', 'Power Supply (PSU)', 'TUF GAMING 80+ GOLD Fully Modular, 1000W', 240.00, 'images/psu_1000w.png'),
(17, 'PSU', 'Power Supply (PSU)', 'MAG A850GL PCIE5, 80+ Gold Fully Modular, 850W', 200.00, 'images/psu_850w.png'),
(18, 'PSU', 'Power Supply (PSU)', 'ROG Thor Platinum III Fully Modular 1200W', 620.00, 'images/psu_1200w.png'),
(19, 'Case', 'PC Cases', 'Lian Li O11 Dynamic EVO XL Full Tower', 330.00, 'images/case_lianli_o11.png'),
(20, 'Case', 'PC Cases', 'Fractal Design North ATX Mid Tower Case', 155.00, 'images/case_fractal_north.png'),
(21, 'Case', 'PC Cases', 'NZXT H5 Flow RGB Compact Mid-Tower ATX', 170.00, 'images/case_nzxt_h5.png'),
(22, 'Cooler', 'CPU Cooler', 'Noctua NH-D15, Premium CPU Cooler with 2X NF-A15 PWM 140mm Fans (Brown)', 120.00, 'images/cooler_noctua_d15.png'),
(23, 'Cooler', 'CPU Cooler', 'H150i ELITE CAPELLIX XT 360mm AIO CPU Cooler', 310.00, 'images/cooler_corsair_h150i.png'),
(24, 'Cooler', 'CPU Cooler', 'Thermalright Phantom Spirit', 50.00, 'images/cooler_thermalright.png'),
(25, 'Fans', 'Case Fans', 'CORSAIR iCUE ML120 RGB ELITE Premium 120mm PWM Magnetic Levitation Fans 3-Pack', 155.00, 'images/fans_rgb.png'),
(26, 'Fans', 'Case Fans', 'Lian Li Uni SL-Infinity 120 ARGB 120mm Case Fans 3-Pack', 140.00, 'images/fans_li.png'),
(27, 'OS', 'Operating System', 'Windows 11 Pro, OEM (64 bit)', 210.00, 'images/os_win11p.png'),
(28, 'OS', 'Operating System', 'Windows 11 Home, OEM (64 bit) ', 165.00, 'images/os_win11h.png'),
(29, 'HDD', 'Secondary Storage', '2TB BarraCuda HDD, SATA III w/ 256MB Cache ', 90.00, 'images/hdd_2tb.png'),
(30, 'HDD', 'Secondary Storage', ' 4TB IronWolf Pro NAS HDD, SATA III w/ 256MB Cache ', 220.00, 'images/hdd_4tb.png'),
(31, 'HDD', 'Secondary Storage', 'RED Plus 8TB NAS Desktop Hard Drive, SATA III w/ 256MB Cache ', 270.00, 'images/hdd_8tb.png'),
(32, 'Monitor', 'Display', 'ASUS TUF Gaming (VG27AQ3A) 27in LED LCD Gaming Monitor w/ 180Hz', 340.00, 'images/monitor_asus.png'),
(33, 'Monitor', 'Display', 'LG UltraGear 27in LED LCD Gaming Monitor 144Hz', 1200.00, 'images/monitor_lg.png'),
(34, 'Monitor', 'Display', 'Samsung Odyssey G9 49in Curved OLED Gaming Monitor 240Hz', 2200.00, 'images/monitor_premium.png'),
(35, 'Keyboard', 'Keyboard', 'MSI FORGE GK310 Gaming Keyboard w/ Hot Swappable Red Mechanical Key Switches', 75.00, 'images/keyboard_msi.png'),
(36, 'Keyboard', 'Keyboard', 'BlackWidow V4 X Mechanical Gaming Keyboard w/ Razer Chroma RGB Lighting, Razer Green Mechanical Switches ', 190.00, 'images/keyboard_razer.png'),
(37, 'Keyboard', 'Keyboard', 'Ducky One 3 RGB Mist Grey SF Gaming Keyboard w/ MX Blue Switches ', 200.00, 'images/keyboard_ducky.png'),
(38, 'Mouse', 'Mouse', 'Logitech G502 Hero RGB Gaming Mouse, Black ', 80.00, 'images/mouse_g5.png'),
(39, 'Mouse', 'Mouse', 'Basilisk V3 Wired Optical Gaming Mouse w/ Razer Chroma RGB Lighting ', 100.00, 'images/mouse_razer.png'),
(40, 'Headset', 'Headset', 'HyperX Cloud Stinger 2 Gaming Headset wired, Black ', 60.00, 'images/headset_hyperx.png'),
(41, 'Headset', 'Headset', 'steelseries Arctis Nova 5 Wireless Gaming Headset', 180.00, 'images/headset_steelseriess.png'),
(42, 'Webcam', 'Webcam', 'Logitech C920s Pro HD 1080p Webcam, Black ', 100.00, 'images/webcam_logitech.png'),
(43, 'Webcam', 'Webcam', 'Elgato Facecam MK.2 Full HD 1080p60 Webcam, Black', 180.00, 'images/webcam_Elgato.png'),
(44, 'Microphone', 'Microphone', 'HyperX SoloCast USB Condenser Gaming Microphone ', 70.00, 'images/mic_hyperx.png'),
(45, 'Microphone', 'Microphone', 'Logitech Yeti USB Microphone, Blackout Edition ', 180.00, 'images/mic_logitech.png'),
(46, 'Speakers', 'Speakers', 'Logitech  Z150 2.0 Speakers, Black ', 40.00, 'images/speakers_logitech.png'),
(47, 'Speakers', 'Speakers', 'Speedex ES501 Multimedia 2.0 Stereo Speakers, Black ', 20.00, 'images/speakers_speed.png'),
(48, 'Wifi', 'Wi-Fi Adapter', 'TP-Link USB WiFi Adapter for PC (Archer T3U Plus) Dual Band Network Adapter with 2.4GHz/5GHz High Gain Antenna', 25.00, 'images/wifi_TP-Link.png'),
(49, 'Wifi', 'Wi-Fi Adapter', 'BrosTrend 1800Mbps USB WiFi 6 Adapter Long Range for PC, Dual Band 5GHz 1201Mbps + 2.4GHz 574Mbps', 80.00, 'images/wifi_BrosTrend.png'),
(50, 'Cables', 'Custom Cables', 'Clovertale Braided ATX Sleeved Cable Extension kit for Power Supply', 26.00, 'images/cables_black.png'),
(51, 'Cables', 'Custom Cables', 'AsiaHorse 18AWG PSU Cable Extension Sleeved Custom Mod', 35.00, 'images/cables_red.png'),
(52, 'Headset', 'Headset', 'Soundcore Anker Life Q30 Active Noise Cancelling Headphones', 101.00, 'images/headset_hyperx.png'),
(54, 'HDD', 'Secondary Storage', 'None', 0.00, ''),
(55, 'Monitor', 'Display', 'None', 0.00, ''),
(56, 'Keyboard', 'Keyboard', 'None', 0.00, ''),
(57, 'Mouse', 'Mouse', 'None', 0.00, ''),
(58, 'Headset', 'Headset', 'None', 0.00, ''),
(59, 'Webcam', 'Webcam', 'None', 0.00, ''),
(60, 'Microphone', 'Microphone', 'None', 0.00, ''),
(61, 'Speakers', 'Speakers', 'None', 0.00, ''),
(62, 'Wifi', 'Wi-Fi Adapter', 'none', 0.00, ''),
(63, 'Cables', 'Custom Cables', 'none', 0.00, ''),
(65, 'Motherboard', 'Motherboard', 'MSI B650 GAMING PLUS WIFI ATX AM5 Motherboard', 230.00, 'images/msi.png'),
(66, 'CPU', 'Processor', 'AMD Ryzen 5 7600X', 270.00, 'images/amd.png'),
(67, 'GPU', 'Graphics Card', 'Gigabyte WINDFORCE OC GeForce RTX 5060 8GB', 415.00, 'images/5060.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `nickname`, `password_hash`, `role`, `is_active`, `created_at`, `address_line1`, `address_line2`, `city`, `province`, `postal_code`) VALUES
(1, 'dark_knight', 'mariosingh151@gmail.com', NULL, '$2y$10$Nat2S88vXwB6yAnC3xIY.eBp74T29Z08u5xRW2rKLBgS13fglNFaa', 'admin', 1, '2025-07-20 18:29:29', NULL, NULL, NULL, NULL, NULL),
(2, 'Medium_Oven302', 'jimansingh@gmail.com', NULL, '$2y$10$ECEmlQLbZUqVzMAbzfR4fOZHYFY0j0/uGd3wAv4wQrG6ADtVPbsyO', 'admin', 1, '2025-07-20 20:48:06', '2595 Jefferson Blvd', '', 'windsor', 'Ontario', 'N8T 2W5'),
(3, 'George', 'george@gmail.com', NULL, '$2y$10$nvcLW8cBXD9rMkvtUFAk/u56w3gkYR7eKvAkQHUQ28fAu.s7HvoiK', 'customer', 1, '2025-07-21 02:21:23', NULL, NULL, NULL, NULL, NULL),
(4, 'jiman', 'bajwa@gmail.com', 'jimany', '$2y$10$z33W4y4TjzI/teVrlK7EJO9SPBZEpwrp8gq4fxPNg2IbsS3BQboQO', 'customer', 1, '2025-07-27 20:11:36', NULL, NULL, NULL, NULL, NULL),
(5, 'Guntas', 'guntasm1@gmail.com', 'Guntas', '$2y$10$jTv66iBY.xR8cIlvcaoxJuIic6OfaLYsA2Cf1Y5Yv8gH.mCw2gG1C', 'customer', 1, '2025-07-27 20:12:11', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
