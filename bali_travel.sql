-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 06, 2024 at 09:28 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bali_travel`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `allocateVehicles` (IN `p_booking_id` INT)   BEGIN
    DECLARE total_people INT;
    DECLARE available_vehicle_id INT;
    DECLARE capacity INT;
    DECLARE remaining_people INT;
    
    -- Ambil jumlah penumpang dari pemesanan
    SELECT total_people INTO total_people
    FROM bookings WHERE booking_id = p_booking_id;
    
    SET remaining_people = total_people;
    
    -- Loop selama masih ada penumpang yang belum dialokasikan
    WHILE remaining_people > 0 DO
        -- Ambil mobil yang tersedia dan kapasitasnya
        SELECT vehicle_id, capacity INTO available_vehicle_id, capacity
        FROM vehicles
        WHERE status = 'available'
        LIMIT 1;
        
        -- Kurangi remaining_people dengan kapasitas mobil yang dialokasikan
        SET remaining_people = remaining_people - capacity;
        
        -- Simpan hubungan antara pemesanan dan mobil
        INSERT INTO booking_vehicles (booking_id, vehicle_id)
        VALUES (p_booking_id, available_vehicle_id);
        
        -- Update status mobil menjadi 'in_use'
        UPDATE vehicles SET status = 'in_use' WHERE vehicle_id = available_vehicle_id;
    END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `calculateRefund` (IN `p_booking_id` INT)   BEGIN
    DECLARE booking_date DATE;
    DECLARE departure_date DATE;
    DECLARE days_before_departure INT;
    DECLARE total_amount DECIMAL(10, 2);
    DECLARE refund_amount DECIMAL(10, 2);
    
    -- Ambil informasi tanggal keberangkatan dan total biaya pemesanan
    SELECT b.departure_date, b.total_amount INTO departure_date, total_amount
    FROM bookings b WHERE b.booking_id = p_booking_id;
    
    -- Hitung selisih hari antara tanggal sekarang dengan tanggal keberangkatan
    SET days_before_departure = DATEDIFF(departure_date, CURDATE());
    
    -- Hitung jumlah refund berdasarkan kebijakan
    IF days_before_departure > 7 THEN
        SET refund_amount = total_amount;  -- Refund 100%
    ELSEIF days_before_departure BETWEEN 3 AND 7 THEN
        SET refund_amount = total_amount * 0.5;  -- Refund 50%
    ELSE
        SET refund_amount = 0;  -- Tidak ada refund
    END IF;
    
    -- Simpan informasi refund ke tabel refunds
    INSERT INTO refunds (booking_id, user_id, refund_amount, refund_status)
    SELECT b.booking_id, b.user_id, refund_amount, 'pending'
    FROM bookings b WHERE b.booking_id = p_booking_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_transaction_amount` (IN `transaction_id` INT, IN `payment_method` ENUM('bank_transfer','other'))   BEGIN
    DECLARE base_amount DECIMAL(10, 2);
    DECLARE final_amount DECIMAL(10, 2);
    
    -- Ambil jumlah dasar dari transaksi
    SELECT total_amount INTO base_amount
    FROM transactions
    WHERE id = transaction_id;
    
    -- Hitung jumlah yang harus dibayar
    CALL calculate_final_amount(base_amount, payment_method, final_amount);
    
    -- Perbarui entri transaksi
    UPDATE transactions
    SET transfer_fee_percentage = 
        CASE 
            WHEN payment_method = 'bank_transfer' THEN 0.00
            ELSE 2.00
        END,
        amount_paid = final_amount
    WHERE id = transaction_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bank_customer`
--

CREATE TABLE `bank_customer` (
  `custbank_id` int NOT NULL,
  `account_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `account_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `account_holder_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `account_type` enum('bank account','other') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_travel`
--

CREATE TABLE `bank_travel` (
  `trabank_id` int NOT NULL,
  `account_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `account_holder_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` blob,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `package_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `total_people` int DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `booking_status` enum('pending','confirmed','cancelled','completed') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_status` enum('pending','paid','refund_processed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `bookings`
--
DELIMITER $$
CREATE TRIGGER `vehicle_release_trigger` AFTER UPDATE ON `bookings` FOR EACH ROW BEGIN
    IF NEW.booking_status = 'completed' THEN
        -- Update status kendaraan yang digunakan menjadi 'available'
        UPDATE vehicles v
        JOIN booking_vehicles bv ON v.vehicle_id = bv.vehicle_id
        SET v.status = 'available'
        WHERE bv.booking_id = NEW.booking_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking_destinations`
--

CREATE TABLE `booking_destinations` (
  `booking_destination_id` int NOT NULL,
  `booking_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `destination_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `booking_destinations`
--
DELIMITER $$
CREATE TRIGGER `limit_destination_choice` BEFORE INSERT ON `booking_destinations` FOR EACH ROW BEGIN
    DECLARE destination_count INT;
    
    -- Hitung jumlah destinasi yang sudah dipilih untuk booking ini
    SELECT COUNT(*) INTO destination_count
    FROM booking_destinations
    WHERE booking_id = NEW.booking_id;
    
    -- Cegah penambahan destinasi jika sudah mencapai batas maksimum
    IF destination_count >= 4 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'You cannot select more than 4 destinations for this package.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking_vehicles`
--

CREATE TABLE `booking_vehicles` (
  `booking_vehicle_id` int NOT NULL,
  `booking_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vehicle_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `package_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `destination_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `package_type` enum('single_destination','multiple_day') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `package_name`, `package_type`, `description`, `created_at`, `updated_at`) VALUES
('P01', 'Wisata Bali 3 Hari 4 Malam', 'multiple_day', 'Wisata Bali', '2024-10-05 21:41:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int NOT NULL,
  `booking_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_method` enum('bank_transfer','other') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` enum('pending','validated','failed') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `proof_of_payment` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `payments`
--
DELIMITER $$
CREATE TRIGGER `update_booking_status` AFTER UPDATE ON `payments` FOR EACH ROW BEGIN
    -- Jika status pembayaran telah selesai ('paid'), maka update booking status menjadi 'confirmed'
    IF NEW.payment_status = 'paid' THEN
        UPDATE bookings
        SET booking_status = 'confirmed'
        WHERE bookings.booking_id = NEW.booking_id;
    END IF;

    -- Jika status pembayaran di payments sudah divalidasi, maka update payment_status menjadi 'paid' di bookings
    IF NEW.payment_status = 'validated' THEN
        UPDATE bookings
        SET payment_status = 'paid'
        WHERE bookings.booking_id = NEW.booking_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `refund_id` int NOT NULL,
  `booking_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `custbank_id` int DEFAULT NULL,
  `refund_amount` decimal(10,2) DEFAULT NULL,
  `refund_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `refund_status` enum('completed','processed','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `refunds`
--
DELIMITER $$
CREATE TRIGGER `refund_auto_processing` AFTER INSERT ON `refunds` FOR EACH ROW BEGIN
    -- Jika refund statusnya 'pending', jalankan prosedur calculateRefund
    IF NEW.refund_status = 'pending' THEN
        CALL calculateRefund(NEW.booking_id);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int NOT NULL,
  `booking_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `package_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rating` tinyint NOT NULL,
  `review_text` text COLLATE utf8mb4_general_ci,
  `review_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_role` enum('customer','admin','owner') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `phone_number`, `user_role`, `created_at`, `updated_at`) VALUES
('U01', 'Mohammad Faris Fawwaz', 'farisfawwaz123@gmail.com', 'Faris1811.', '0812545584444', 'customer', '2024-10-06 04:42:26', '2024-10-06 04:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int NOT NULL,
  `vehicle_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `license_plate` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `vehicle_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vehicle_photo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('available','in_use','maintenance') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `vehicle_name`, `license_plate`, `capacity`, `vehicle_type`, `vehicle_photo`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Avanza Black', 'BK 1234 AB', 6, 'MPV', '1727757860_3598cad48cb5adbdbd31.jpg', 'maintenance', '2024-09-30 21:44:20', '2024-09-30 22:09:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_customer`
--
ALTER TABLE `bank_customer`
  ADD PRIMARY KEY (`custbank_id`);

--
-- Indexes for table `bank_travel`
--
ALTER TABLE `bank_travel`
  ADD PRIMARY KEY (`trabank_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `bookings_ibfk_1` (`user_id`),
  ADD KEY `bookings_ibfk_2` (`package_id`);

--
-- Indexes for table `booking_destinations`
--
ALTER TABLE `booking_destinations`
  ADD PRIMARY KEY (`booking_destination_id`),
  ADD KEY `booking_destinations_ibfk_2` (`destination_id`),
  ADD KEY `booking_destinations_ibfk_1` (`booking_id`);

--
-- Indexes for table `booking_vehicles`
--
ALTER TABLE `booking_vehicles`
  ADD PRIMARY KEY (`booking_vehicle_id`),
  ADD KEY `booking_vehicles_ibfk_2` (`vehicle_id`),
  ADD KEY `booking_vehicles_ibfk_1` (`booking_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payments_ibfk_1` (`booking_id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`refund_id`),
  ADD KEY `refunds_ibfk_3` (`custbank_id`),
  ADD KEY `refunds_ibfk_1` (`booking_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `reviews_ibfk_1` (`user_id`),
  ADD KEY `reviews_ibfk_2` (`package_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_customer`
--
ALTER TABLE `bank_customer`
  MODIFY `custbank_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_travel`
--
ALTER TABLE `bank_travel`
  MODIFY `trabank_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_destinations`
--
ALTER TABLE `booking_destinations`
  MODIFY `booking_destination_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_vehicles`
--
ALTER TABLE `booking_vehicles`
  MODIFY `booking_vehicle_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `refund_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking_destinations`
--
ALTER TABLE `booking_destinations`
  ADD CONSTRAINT `booking_destinations_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_destinations_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destination_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking_vehicles`
--
ALTER TABLE `booking_vehicles`
  ADD CONSTRAINT `booking_vehicles_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_vehicles_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `fk_destinasi_paket` FOREIGN KEY (`destination_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `refunds_ibfk_3` FOREIGN KEY (`custbank_id`) REFERENCES `bank_customer` (`custbank_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
