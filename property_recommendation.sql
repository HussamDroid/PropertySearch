-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2026 at 10:43 PM
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
-- Database: `property_recommendation`
--

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `recommendation_score` int(3) NOT NULL,
  `average_rating` float NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `bedrooms` int(11) NOT NULL DEFAULT 0,
  `bathrooms` int(11) NOT NULL DEFAULT 0,
  `size` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `name`, `type`, `price`, `location`, `description`, `recommendation_score`, `average_rating`, `image`, `bedrooms`, `bathrooms`, `size`) VALUES
(1, 'Marina Bay Tower 1', 'Apartment', 1250000, 'Lusail', '', 9, 0, NULL, 0, 0, 0),
(2, 'Porto Arabia Suite', 'Apartment', 2100000, 'The Pearl', '', 9, 0, NULL, 0, 0, 0),
(3, 'Skyline Penthouse', 'Penthouse', 4500000, 'West Bay', '', 10, 0, NULL, 0, 0, 0),
(4, 'Al Waab Family Villa', 'Villa', 6000000, 'Al Waab', '', 9, 0, NULL, 0, 0, 0),
(5, 'Gardenia Townhouse', 'Villa', 3200000, 'Lusail', '', 8, 0, NULL, 0, 0, 0),
(6, 'Corniche View Studio', 'Apartment', 950000, 'Doha', '', 8, 0, NULL, 0, 0, 0),
(7, 'Fox Hills Residence', 'Apartment', 1100000, 'Lusail', '', 8, 0, NULL, 0, 0, 0),
(8, 'Waterfront Villa', 'Villa', 7500000, 'Lusail', '', 9, 0, NULL, 0, 0, 0),
(9, 'Erkyah City Apt', 'Apartment', 980000, 'Lusail', '', 8, 0, NULL, 0, 0, 0),
(10, 'Viva Bahriya Tower 10', 'Apartment', 2400000, 'The Pearl', '', 9, 0, NULL, 0, 0, 0),
(11, 'Abraj Quartier Studio', 'Apartment', 1200000, 'The Pearl', '', 8, 0, NULL, 0, 0, 0),
(12, 'Perla Villa Estate', 'Villa', 12000000, 'The Pearl', '', 10, 0, NULL, 0, 0, 0),
(13, 'Diplomatic Area Suite', 'Apartment', 1500000, 'West Bay', '', 9, 0, NULL, 0, 0, 0),
(14, 'Zig Zag Tower B', 'Apartment', 1650000, 'West Bay', '', 8, 0, NULL, 0, 0, 0),
(15, 'Msheireb Downtown Apt', 'Apartment', 3500000, 'Doha', '', 10, 0, NULL, 0, 0, 0),
(16, 'Old Airport Villa', 'Villa', 2800000, 'Doha', '', 7, 0, NULL, 0, 0, 0),
(17, 'Aspire Zone Villa', 'Villa', 5500000, 'Al Waab', '', 9, 0, NULL, 0, 0, 0),
(18, 'Heritage Townhouse', 'Villa', 4200000, 'Al Waab', '', 8, 0, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `image_filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `preferred_property` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `date_of_birth`, `username`, `password`, `country`, `preferred_property`) VALUES
(1, 'John', 'Doe', 'johndoe@example.com', NULL, 'john_doe', '$2y$10$6j/SnnDiVlU3Cw4Zn/oXOuR4N4zKeqopxL3B1QotvlODhLORDj6Q.', 'Qatar', NULL),
(2, 'Alice', 'Smith', 'alice@example.com', NULL, 'alice_smith', '*A57E009B0989A6C292D631A2746203C89AD6A622', 'Qatar', NULL),
(3, 'Bob', 'Johnson', 'bob@example.com', NULL, 'bob_johnson', '*3DC53D7230F6D46A818090C010918431E9C4F2EA', 'Qatar', NULL),
(4, 'Charlie', 'Davis', 'charlie@example.com', NULL, 'charlie_davis', '*A07673412AE7C49D6A4D7D8769441E0E4584DBDF', 'Qatar', NULL),
(5, 'David', 'Miller', 'david@example.com', NULL, 'david_miller', '*76E1DED67C484EF41716EFA3545C12098380B713', 'Qatar', NULL),
(6, 'abc', 'xys', 'abc@xyz.com', '2026-04-02', 'abc', '$2y$10$QoE2m.QLx895zBUelVaztOspFlwRlPLHIDzwOSn.uGT5GYuGIFi9.', 'Qatar', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

CREATE TABLE `user_reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_reviews`
--

INSERT INTO `user_reviews` (`review_id`, `user_id`, `property_id`, `title`, `content`, `score`) VALUES
(1, 1, 1, 'Amazing Place!', 'This apartment is fantastic. Great view and location.', 9),
(2, 1, 2, 'Spacious Villa', 'The villa is large with a beautiful garden.', 8),
(3, 1, 1, 'Great Apartment', 'This is a wonderful apartment in a great location. Highly recommended!', 8),
(4, 2, 2, 'Spacious Villa', 'The villa is amazing! Perfect for family vacations.', 9),
(5, 3, 3, 'Luxury Penthouse', 'The penthouse has an incredible view and fantastic amenities!', 10),
(6, 4, 4, 'Cozy Studio', 'A great option for a single person or a couple.', 7),
(7, 1, 5, 'Beach Resort', 'Perfect place for a relaxing vacation. Beach access is amazing!', 9),
(8, 2, 6, 'Charming Cottage', 'The cottage is very peaceful, surrounded by nature. Ideal for a weekend getaway.', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_id` (`property_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_reviews`
--
ALTER TABLE `user_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD CONSTRAINT `user_reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_reviews_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
