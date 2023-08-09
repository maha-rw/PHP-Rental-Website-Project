-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 22, 2023 at 01:22 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `HouseDeal`
--

-- --------------------------------------------------------

--
-- Table structure for table `ApplicationStatus`
--

CREATE TABLE `ApplicationStatus` (
  `id` varchar(10) NOT NULL,
  `status` enum('under consideration','accepted','declined') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ApplicationStatus`
--

INSERT INTO `ApplicationStatus` (`id`, `status`) VALUES
('1', 'under consideration'),
('2', 'accepted'),
('3', 'declined');

-- --------------------------------------------------------

--
-- Table structure for table `Homeowner`
--

CREATE TABLE `Homeowner` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email_address` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Homeowner`
--

INSERT INTO `Homeowner` (`id`, `name`, `phone_number`, `email_address`, `password`) VALUES
('1', 'Abdulaziz saleh', '0552332312', 'abdulaziz11@gmail.com', '$2y$10$Gc.pEoQVcQXTiX.MXaon7OY26aEFaAtifagrQ/MgZJg8KW0Lg/5FG'),
('2', 'munira ibrahim', '0583332562', 'munira_i@gmail.com', '$2y$10$I3xb47DRTQj4MTpi7Cj.kOTMjZ7DJksj7Bf1nLXPexPKviO5VH9tS'),
('3', 'mohammed ali', '0598234332', 'moh_ali@gmail.com', '$2y$10$suV/0yivIG1mVwhhyyBEWuk2RqMbdqUV7EM1JkkWBQ464QvUilrJy');

-- --------------------------------------------------------

--
-- Table structure for table `HomeSeeker`
--

CREATE TABLE `HomeSeeker` (
  `id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `family_members` int(11) NOT NULL,
  `income` decimal(7,2) NOT NULL,
  `job` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email_address` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='#we assume that phone numbers can be international so n';

--
-- Dumping data for table `HomeSeeker`
--

INSERT INTO `HomeSeeker` (`id`, `first_name`, `last_name`, `age`, `family_members`, `income`, `job`, `phone_number`, `email_address`, `password`) VALUES
(1, 'Fahad', 'Abdullah', 27, 5, '25000.00', 'Financial analyst', '0557233333', 'fahad123@gmail.com', '$2y$10$OSDTaSxV3MKvvqVkU5y1w.VK3VPAdy4F.H9F6q6jZ2EMOewN6AAkO'),
(2, 'Lama', 'Saud', 40, 6, '65000.00', 'Computer system analyst', '0563222459', 'itsLama@gmail.com', '$2y$10$pbb546eiPHXYPdjD3uI1.utt6R/jWE/zILBeiPtt0uRXh7Hjegz8O'),
(3, 'Asma', 'Alotaibi', 27, 6, '29500.00', 'Lawyer', '0583332599', 'alotaibi.asma@outlook.com', '$2y$10$94/2eU4KPdxmWFYDQiQM1eaGFvYgTkzw/vfjO4Nx8T8ycwqGf8bPq'),
(4, 'Hamad', 'Abdullah', 27, 5, '25000.00', 'Financial analyst', '0557233343', 'hamad123@gmail.com', '$2y$10$6kY2dYHvREMkxAlU8iwYtukCVjaP.MRr27HT9v2/EpdYgBJzw.AV2'),
(5, 'haifa', 'r', 22, 0, '30000.00', 'Financial analyst', '0542004997', 'haifa@gmail.com', '$2y$10$Y9BeZQGZ3R1.wsIH44DUs.JFXu20KKxefLgfAuERo4E.hch.9PWNG'),
(6, 'Noura', 'albuqmi', 21, 7, '70000.00', 'CEO', '0987654321', 'noura@gmail.com', '$2y$10$DBWL0LNR7SoeCFXjD6ZIoe7CjMHkPojlHFCA9tr0meFsp0i1uEieO');

-- --------------------------------------------------------

--
-- Table structure for table `Property`
--

CREATE TABLE `Property` (
  `id` int(10) NOT NULL,
  `homeowner_id` int(10) NOT NULL,
  `property_category_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rooms` int(11) NOT NULL,
  `rent_cost` decimal(7,0) NOT NULL,
  `location` varchar(50) NOT NULL,
  `max_tenants` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Property`
--

INSERT INTO `Property` (`id`, `homeowner_id`, `property_category_id`, `name`, `rooms`, `rent_cost`, `location`, `max_tenants`, `description`) VALUES
(1, 1, 1, 'Tuwaiq villa 1', 6, '90000', 'Al Arid, North Riyadh, Riyadh, Riyadh Region', 10, 'Consists of:\r\nAnnex - livingroom  - Guestroom - Seniors room - Two halls - Passenger kitchen - above the master room - Two rooms including a bathroom - Maid\'s room - Laundry room - Garage\r\n\r\nPlot Width: 20 meters\r\nPlot Length: 20 meters\r\nStreet Width: 15 meters\r\nProperty Facade: Northern Facade \r\nProperty Age: 20 month(s)\r\nAmenities: Laundry Room,  Maid Room'),
(2, 2, 1, 'safa villa 2', 3, '12500', 'Al yasmin, North Riyadh, Riyadh, Riyadh Region', 6, 'Amenities: Completion Year,  Barbeque Area,  Day Care Center,  Waste Disposal,  First Aid Medical Center,  Flooring,  Gym or Health Club,  Broadband Internet,  Satellite/Cable TV,  Intercom,  Kids Play Area,  Lawn or Garden,  Security Staff,  CCTV Security,  Cafeteria or Canteen,  Total Floors,  Covered parking,  Basement parking,  Public parking,  Private garage,  Nearby Mosque'),
(3, 3, 2, 'al majid apartments', 4, '18000', 'Al Malqa, North Riyadh, Riyadh, Riyadh Region', 6, 'Luxuary appartment in riyadh in al malqa disctrict one of the finest and most modern neighborhoods in riyadh. The appartment consists of aliving room open to the kitchen ( amirican system ) . + 4 bed room + 5 bathroom+ gym (femal/male)\r\nAmenities: Completion Year,  Balcony or Terrace,  Barbeque Area,  Double Glazed Windows,  Centrally Air-Conditioned,  Central Heating,  Electricity Backup,  Waste Disposal,  Floor,  Furnished,  Gym or Health Club,  Laundry Room,  Satellite/Cable TV,  Intercom,  Kids Play Area.');

-- --------------------------------------------------------

--
-- Table structure for table `PropertyCategory`
--

CREATE TABLE `PropertyCategory` (
  `id` varchar(10) NOT NULL,
  `category` enum('villa','apartment','duplex') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PropertyCategory`
--

INSERT INTO `PropertyCategory` (`id`, `category`) VALUES
('1', 'villa'),
('2', 'apartment'),
('3', 'duplex');

-- --------------------------------------------------------

--
-- Table structure for table `PropertyImage`
--

CREATE TABLE `PropertyImage` (
  `id` int(10) NOT NULL,
  `property_id` int(10) NOT NULL,
  `path` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PropertyImage`
--

INSERT INTO `PropertyImage` (`id`, `property_id`, `path`) VALUES
(1, 1, 'tuwaiqvilla.PNG'),
(2, 2, 'safavilla.jpeg'),
(3, 3, 'Apartment.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `RentalApplication`
--

CREATE TABLE `RentalApplication` (
  `id` int(10) NOT NULL,
  `property_id` int(10) NOT NULL,
  `home_seeker_id` int(10) NOT NULL,
  `application_status_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RentalApplication`
--

INSERT INTO `RentalApplication` (`id`, `property_id`, `home_seeker_id`, `application_status_id`) VALUES
(1, 1, 2, 3),
(2, 2, 3, 2),
(3, 3, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ApplicationStatus`
--
ALTER TABLE `ApplicationStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Homeowner`
--
ALTER TABLE `Homeowner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HomeSeeker`
--
ALTER TABLE `HomeSeeker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Property`
--
ALTER TABLE `Property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homeowner_id` (`homeowner_id`),
  ADD KEY `property_category_id` (`property_category_id`);

--
-- Indexes for table `PropertyCategory`
--
ALTER TABLE `PropertyCategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `PropertyImage`
--
ALTER TABLE `PropertyImage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `propertyid` (`property_id`);

--
-- Indexes for table `RentalApplication`
--
ALTER TABLE `RentalApplication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `home_seeker_id` (`home_seeker_id`),
  ADD KEY `application_status_id` (`application_status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `HomeSeeker`
--
ALTER TABLE `HomeSeeker`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Property`
--
ALTER TABLE `Property`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `PropertyImage`
--
ALTER TABLE `PropertyImage`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `RentalApplication`
--
ALTER TABLE `RentalApplication`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
