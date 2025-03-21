-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 22, 2025 at 02:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee') NOT NULL DEFAULT 'employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`, `role`) VALUES
(14, 'Admin', 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'admin'),
(15, 'Test', 'Test', '0cbc6611f5540bd0809a388dc95a615b', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(16, 'Triple Cheeseburger', 'Food_Category216.jpg', 'Yes', 'Yes'),
(17, 'Coffee', 'Food_Category892.jpg', 'Yes', 'Yes'),
(18, 'Burger Steak', 'Food_Category363.jpg', 'Yes', 'Yes'),
(19, 'Cold Brew Drinks', 'Food_Category555.jpg', 'Yes', 'Yes'),
(20, 'Pastries', 'Food_Category381.jpg', 'Yes', 'Yes'),
(21, 'Frappe', 'Food_Category309.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `name`, `username`, `password`) VALUES
(1, 'Maverie', 'Reave', '0cf5d42e34cfeb8ae58bf0b5eca73375'),
(2, 'Marie', 'Marie', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(1, 'Triple Cheese Burger', 'Triple Cheese Burger is a delicious treat. It features three juicy beef patties, each layered with melted cheddar cheese, all stacked on a toasted sesame seed bun.', 230.00, 'Food_889.jpg', 16, 'Yes', 'Yes'),
(2, 'Espresso ', 'Espresso is a rich and intense coffee experience. Made by forcing hot water through finely-ground coffee beans, it delivers a concentrated shot of bold flavor with a velvety crema on top.\r\n\r\n', 65.00, 'Food_976.jpg', 17, 'Yes', 'Yes'),
(3, '1-pc Burger Steak with Rice', 'Burger Steak is a savory and satisfying dish. It features a juicy, well-seasoned beef patty, often smothered in rich mushroom gravy.', 120.00, 'Food_129.jpg', 18, 'Yes', 'Yes'),
(4, 'A Chocolate Cake', 'Chocolate Cake is a decadent dessert loved worldwide for its rich, chocolatey flavor and moist texture. Chocolate Cake is rich and satisfying until the last bite!\r\n', 45.00, 'Food_315.jpg', 20, 'Yes', 'Yes'),
(5, 'Cold White Brew Coffee', 'This beverage is served chilled over ice, making it a popular choice during warmer months or as a refreshing pick-me-up any time of year.', 120.00, 'Food_744.jpg', 19, 'Yes', 'Yes'),
(6, 'Strawberry Frappe', 'A Strawberry Frappe perfect blend of Frosty vanilla, iced coffee, and real strawberry pulp. A delicious frozen treat bursting with fresh strawberries and sweet cream.', 135.00, 'Food_24.jpg', 21, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `field_updated` varchar(255) DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`id`, `order_id`, `field_updated`, `old_value`, `new_value`, `update_date`, `updated_by`) VALUES
(1, 1, 'qty', '1', '2', '2024-07-25 06:29:18', 'Employee'),
(2, 1, 'order_date', '2024-07-11 06:55:24', '2024-07-11T06:55', '2024-07-25 06:29:18', 'Employee'),
(3, 1, 'customer_name', 'Wikey Smith', 'Donny Smith', '2024-07-25 06:29:18', 'Employee'),
(4, 1, 'customer_contact', '9532 562 47851', '9505 562 47851', '2024-07-25 06:29:18', 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history_admins`
--

CREATE TABLE `tbl_history_admins` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `field_updated` varchar(100) DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_history_admins`
--

INSERT INTO `tbl_history_admins` (`id`, `admin_id`, `field_updated`, `old_value`, `new_value`, `update_date`, `updated_by`) VALUES
(1, 15, 'full_name', 'AdminTest', 'Test', '2024-07-25 07:36:45', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history_category`
--

CREATE TABLE `tbl_history_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `field_updated` varchar(255) NOT NULL,
  `old_value` text NOT NULL,
  `new_value` text NOT NULL,
  `update_date` datetime NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_history_category`
--

INSERT INTO `tbl_history_category` (`id`, `category_id`, `field_updated`, `old_value`, `new_value`, `update_date`, `updated_by`) VALUES
(1, 16, 'title', 'Big Burger', 'Triple Cheeseburger', '2024-07-25 01:02:00', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history_employees`
--

CREATE TABLE `tbl_history_employees` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `field_updated` varchar(255) NOT NULL,
  `old_value` text NOT NULL,
  `new_value` text NOT NULL,
  `update_date` datetime NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_history_employees`
--

INSERT INTO `tbl_history_employees` (`id`, `employee_id`, `field_updated`, `old_value`, `new_value`, `update_date`, `updated_by`) VALUES
(1, 1, 'name', 'Mave', 'Maverie', '2024-07-25 00:50:43', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history_food`
--

CREATE TABLE `tbl_history_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `food_id` int(10) UNSIGNED NOT NULL,
  `field_updated` varchar(255) DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `update_date` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_history_food`
--

INSERT INTO `tbl_history_food` (`id`, `food_id`, `field_updated`, `old_value`, `new_value`, `update_date`, `updated_by`) VALUES
(1, 1, 'description', 'A Triple Cheese Burger is a delicious treat. It features three juicy beef patties, each layered with melted cheddar cheese, all stacked on a toasted sesame seed bun.', 'Triple Cheese Burger is a delicious treat. It features three juicy beef patties, each layered with melted cheddar cheese, all stacked on a toasted sesame seed bun.', '2024-07-25 16:01:13', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history_foods`
--

CREATE TABLE `tbl_history_foods` (
  `id` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `field_updated` varchar(255) DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_history_foods`
--

INSERT INTO `tbl_history_foods` (`id`, `food_id`, `field_updated`, `old_value`, `new_value`, `update_date`, `updated_by`) VALUES
(1, 1, 'description', 'A Triple Cheese Burger is a delicious treat. It features three juicy beef patties, each layered with melted cheddar cheese, all stacked on a toasted sesame seed bun.', 'Triple Cheese Burger is a delicious treat. It features three juicy beef patties, each layered with melted cheddar cheese, all stacked on a toasted sesame seed bun.', '2024-07-24 22:27:17', 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history_order`
--

CREATE TABLE `tbl_history_order` (
  `id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `field_updated` varchar(100) NOT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_history_order`
--

INSERT INTO `tbl_history_order` (`id`, `order_id`, `field_updated`, `old_value`, `new_value`, `update_date`, `updated_by`) VALUES
(1, 1, 'total', '130.00', '', '2024-07-25 08:45:22', 'Admin'),
(2, 1, 'customer_name', 'Danna Smith', 'Danna Armstrong', '2024-07-25 08:45:22', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Espresso ', 65.00, 2, 130.00, '2024-07-11 06:55:00', 'Delivered', 'Danna Armstrong', '9505 562 47851', 'danesmith@yahoo.com', 'Testing Street'),
(3, 'Triple Cheese Burger', 230.00, 2, 460.00, '2024-07-12 03:04:50', 'Ordered', 'Vaqad Marques', '9925 223 47851', 'banez845@gmail.com', 'Cebu City'),
(4, 'Triple Cheese Burger', 230.00, 1, 230.00, '2025-03-22 01:41:46', 'Ordered', 'Danrieve', '+639123456789', 'Testy@testing.com', 'Test Mandaue City'),
(5, 'Espresso ', 65.00, 1, 65.00, '2025-03-22 01:52:28', 'Ordered', 'Testrieve', '+639451226584', 'Test@testy.com', 'Casuntigan Mandaue Test City');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_history_admins`
--
ALTER TABLE `tbl_history_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_history_category`
--
ALTER TABLE `tbl_history_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_history_employees`
--
ALTER TABLE `tbl_history_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_history_food`
--
ALTER TABLE `tbl_history_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `tbl_history_foods`
--
ALTER TABLE `tbl_history_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_history_order`
--
ALTER TABLE `tbl_history_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_history_admins`
--
ALTER TABLE `tbl_history_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_history_category`
--
ALTER TABLE `tbl_history_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_history_employees`
--
ALTER TABLE `tbl_history_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_history_food`
--
ALTER TABLE `tbl_history_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_history_foods`
--
ALTER TABLE `tbl_history_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_history_order`
--
ALTER TABLE `tbl_history_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_history_employees`
--
ALTER TABLE `tbl_history_employees`
  ADD CONSTRAINT `tbl_history_employees_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`id`);

--
-- Constraints for table `tbl_history_food`
--
ALTER TABLE `tbl_history_food`
  ADD CONSTRAINT `tbl_history_food_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `tbl_food` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
