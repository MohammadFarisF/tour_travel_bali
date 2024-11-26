-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2024 at 12:37 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `allocateVehicles` (IN `p_booking_id` VARCHAR(10) CHARSET utf8mb4)   BEGIN
    DECLARE total_people_count INT;  -- Mengganti nama variabel menjadi total_people_count
    DECLARE available_vehicle_id INT;
    DECLARE vehicle_capacity INT;     -- Mengganti nama variabel menjadi vehicle_capacity
    DECLARE remaining_people INT;

    -- Ambil jumlah penumpang dari pemesanan berdasarkan booking_id
    SELECT total_people INTO total_people_count
    FROM bookings
    WHERE booking_id = p_booking_id COLLATE utf8mb4_general_ci;

    -- Jika booking_id tidak ditemukan, biarkan sistem database menampilkan error bawaan
    IF total_people_count IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Booking ID tidak ditemukan.';
    END IF;

    SET remaining_people = total_people_count;
    
    -- Loop selama masih ada penumpang yang belum dialokasikan
    WHILE remaining_people > 0 DO
        -- Cek apakah ada mobil yang memiliki kapasitas yang cukup untuk sisa penumpang
        SELECT vehicle_id, capacity 
        INTO available_vehicle_id, vehicle_capacity
        FROM vehicles
        WHERE status = 'available' AND capacity >= remaining_people
        ORDER BY capacity ASC  -- Urutkan berdasarkan kapasitas dari yang terkecil
        LIMIT 1;

        -- Jika ditemukan mobil yang muat untuk sisa penumpang
        IF available_vehicle_id IS NOT NULL THEN
            -- Alokasikan seluruh sisa penumpang ke mobil tersebut
            INSERT INTO booking_vehicles (booking_id, vehicle_id)
            VALUES (p_booking_id, available_vehicle_id);

            -- Update status mobil menjadi 'in_use'
            UPDATE vehicles SET status = 'in_use' WHERE vehicle_id = available_vehicle_id;

            -- Semua penumpang telah dialokasikan
            SET remaining_people = 0;
        ELSE
            -- Jika tidak ada mobil yang cukup besar, ambil mobil yang memiliki kapasitas yang paling mendekati
            SELECT vehicle_id, capacity 
            INTO available_vehicle_id, vehicle_capacity
            FROM vehicles
            WHERE status = 'available' AND capacity >= remaining_people
            ORDER BY capacity ASC  -- Urutkan berdasarkan kapasitas dari yang terkecil
            LIMIT 1;

            -- Jika masih tidak ada kendaraan yang tersedia, hentikan prosedur
            IF available_vehicle_id IS NULL THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Tidak ada kendaraan yang tersedia untuk mengakomodasi seluruh penumpang.';
            END IF;

            -- Kurangi remaining_people dengan kapasitas mobil yang dialokasikan
            SET remaining_people = remaining_people - vehicle_capacity;

            -- Simpan hubungan antara pemesanan dan mobil
            INSERT INTO booking_vehicles (booking_id, vehicle_id)
            VALUES (p_booking_id, available_vehicle_id);

            -- Update status mobil menjadi 'in_use'
            UPDATE vehicles SET status = 'in_use' WHERE vehicle_id = available_vehicle_id;
        END IF;
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

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_role` enum('customer','admin','owner') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `full_name`, `email`, `password`, `phone_number`, `user_role`, `photo`, `created_at`, `updated_at`) VALUES
('U001', 'Mohammad Faris Fawwaz', 'farisfawwaz123@gmail.com', '$2y$10$PgHv21Iba7PotRA.NeFla.HX1tNelgVlIAqmlPvdzK4WHd8QSLkia', '081234567891', 'owner', '1730129683_bf5804dbb1ce67bf8530.jpg', '2024-10-07 02:03:00', '2024-11-03 21:35:51'),
('U002', 'Muhammad Fauzan Azhar', 'mfauzanazhar12@gmail.com', '$2y$10$CCrIoiQ77QgPRrON3e8//OaMHrdauZZ3HWxjMDd6w4R1PQQsUBy8a', '089843213412', 'admin', '1730128767_15f3f8e75d79db270b7d.png', '2024-10-07 02:07:29', '2024-10-28 15:19:27');

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

--
-- Dumping data for table `bank_travel`
--

INSERT INTO `bank_travel` (`trabank_id`, `account_number`, `account_holder_name`, `bank_name`, `photo`, `created_at`, `updated_at`) VALUES
(1, '1412341323', 'Muhammad Fauzan Azhar', 'Bank Central Asia (BCA)', 0x313732383239333130375f61333861613334663230383463323532653630322e6a7067, '2024-10-07 02:25:07', '2024-10-07 02:31:44'),
(2, '1234567891', 'Mohammad Faris Fawwaz', 'Bank Negara Indonesia (BNI)', 0x313732383239333331375f38306361666532663237303039613530313731632e706e67, '2024-10-07 02:28:37', '2024-10-07 02:31:33'),
(3, '081234567891', 'Mohammad Faris Fawwaz', 'Paypal', 0x313732383239333431385f30623536316462306534623862623136623563382e6a7067, '2024-10-07 02:30:18', '2024-10-07 02:31:23'),
(4, '081256789423', 'Muhammad Fauzan Azhar', 'DANA', 0x313732383239333436395f61626134653835613532353164643735343537382e6a706567, '2024-10-07 02:31:09', '2024-10-07 02:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `package_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `total_people` int DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `cust_request` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `booking_status` enum('pending','confirmed','cancelled','completed') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_status` enum('pending','paid','refund_processed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `customer_id`, `package_id`, `address`, `total_people`, `departure_date`, `return_date`, `total_amount`, `cust_request`, `booking_status`, `payment_status`, `created_at`, `updated_at`) VALUES
('B32535', 'C002', 'P02', 'Jl. Jakarta', 1, '2024-11-20', '2024-11-20', '750000.00', 'Tidak Ada', 'completed', 'paid', '2024-11-16 19:08:56', '2024-11-25 11:09:02'),
('B43298', 'C002', 'P01', 'Jl. Medan', 4, '2024-11-17', '2024-11-17', '3000000.00', '2 Anak, 2 Dewasa', 'completed', 'paid', '2024-11-16 19:06:26', '2024-11-17 04:23:43'),
('B68127', 'C002', 'P01', 'Jl. Medan', 2, '2024-11-25', '2024-11-25', '1500000.00', '', 'completed', 'paid', '2024-11-24 18:26:03', '2024-11-25 11:28:47');

--
-- Triggers `bookings`
--
DELIMITER $$
CREATE TRIGGER `vehicle_release_on_cancel_trigger` AFTER UPDATE ON `bookings` FOR EACH ROW BEGIN
    IF NEW.booking_status = 'cancelled' THEN
        -- Update status kendaraan yang digunakan menjadi 'available'
        UPDATE vehicles v
        JOIN booking_vehicles bv ON v.vehicle_id = bv.vehicle_id
        SET v.status = 'available'
        WHERE bv.booking_id = NEW.booking_id;
    END IF;
END
$$
DELIMITER ;
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
-- Dumping data for table `booking_destinations`
--

INSERT INTO `booking_destinations` (`booking_destination_id`, `booking_id`, `destination_id`) VALUES
(17, 'B43298', 'D01'),
(18, 'B43298', 'D02'),
(19, 'B32535', 'D03'),
(21, 'B68127', 'D01'),
(22, 'B68127', 'D02');

-- --------------------------------------------------------

--
-- Table structure for table `booking_vehicles`
--

CREATE TABLE `booking_vehicles` (
  `booking_vehicle_id` int NOT NULL,
  `booking_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vehicle_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_vehicles`
--

INSERT INTO `booking_vehicles` (`booking_vehicle_id`, `booking_id`, `vehicle_id`) VALUES
(8, 'B43298', 10),
(9, 'B32535', 7),
(10, 'B68127', 10);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` text COLLATE utf8mb4_general_ci,
  `citizen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_lahir` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` enum('laki-laki','perempuan','tidak ada') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_role` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `nik`, `email`, `password`, `full_name`, `phone_number`, `photo`, `citizen`, `tgl_lahir`, `gender`, `user_role`, `created_at`, `updated_at`) VALUES
('C001', NULL, 'mfirjatullah123@gmail.com', '$2y$10$buajdfrcMRWhvt.RTZFUN.vS6NKh5dPDQVngJ5xU1KrJFlcJCvyWa', 'Muhammad Firjatullah', '081234513423', NULL, NULL, NULL, NULL, 'customer', '2024-11-03 14:16:26', '2024-11-08 02:47:08'),
('C002', '123456789101112', 'agushariyanto@gmail.com', '$2y$10$OLYi3vMUgQWO4Re8Me0w9O6FsuEEuerMeETBEQO1NCw41wz0KHkV2', 'Agus Hariyanto', '+6281235826974', '1731036860_6b4cd01a49c7091b5cb6.jpg', 'Indonesia', '15 June 2004', 'laki-laki', 'customer', '2024-11-07 20:18:37', '2024-11-08 07:06:55'),
('C003', NULL, 'teguhpratama@gmail.com', '$2y$10$9G4eAaSrHNd.khbYNTxYieDr1oyVBCzeNXeEr8uMDX3YJW7WOfbX.', 'Teguh Pratama', '+6281456286315', NULL, NULL, NULL, NULL, 'customer', '2024-11-09 18:16:34', '2024-11-10 01:16:34');

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `check_nik_unique` BEFORE INSERT ON `customer` FOR EACH ROW BEGIN
    IF NEW.nik IS NOT NULL THEN
        IF EXISTS (
            SELECT 1 FROM customer 
            WHERE nik = NEW.nik 
            AND customer_id != NEW.customer_id 
            AND nik IS NOT NULL
        ) THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'NIK sudah terdaftar';
        END IF;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_nik_unique_update` BEFORE UPDATE ON `customer` FOR EACH ROW BEGIN
    IF NEW.nik IS NOT NULL THEN
        IF EXISTS (
            SELECT 1 FROM customer 
            WHERE nik = NEW.nik 
            AND customer_id != NEW.customer_id 
            AND nik IS NOT NULL
        ) THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'NIK sudah terdaftar';
        END IF;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `package_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `destination_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga_per_orang` decimal(10,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`destination_id`, `package_id`, `destination_name`, `longitude`, `latitude`, `harga_per_orang`, `description`, `foto`, `created_at`, `updated_at`) VALUES
('D01', 'P01', 'Rice Terrace Swing', '115.27914568465303', '-8.434760395434676', '500000.00', 'the most popular choice in Bali recently. The tourist destination is located on the north side of Ubud Village, Gianyar Regency.', '1730131800_146ff9732e20b166befb.png', '2024-10-28 09:10:00', '2024-10-28 09:10:00'),
('D02', 'P01', 'Goa Gajah Temple', '115.2871319949841', '-8.52340219151913', '250000.00', 'famously with a historical temple, an archaelogical place. An Archaelogical and Historical Temple in Bali.', '1730131938_56b2a71e91c0be230bd7.jpg,1730131938_9d37b01be6047f3a35b0.jpg', '2024-10-28 09:12:18', '2024-10-28 09:12:18'),
('D03', 'P02', 'Tanah Lot', '115.0868031452482', '-8.620999689160582', '750000.00', 'Bedugul is a famous mountain tourist area in Bali, Indonesia. Located in Tabanan Regency, about 50 kilometers from Denpasar, Bedugul is a favorite destination because of its cool air and beautiful natural views. Bedugul is surrounded by green hills, lakes and lush gardens.', '1730132001_25f9ee03d8ce6855a035.jpg', '2024-10-28 09:13:21', '2024-10-28 09:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `package_type` enum('single_destination','multiple_day') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hari` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `foto` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `package_name`, `package_type`, `hari`, `description`, `foto`, `created_at`, `updated_at`) VALUES
('P01', 'Paket Wisata Ubud', 'single_destination', 1, 'Ubud is a unique and captivating tourist destination that offers a perfect blend of nature, culture, and art. Despite its increasing popularity, Ubud has managed to preserve its traditional charm and serene atmosphere, which are hallmarks of the area. With its stunning natural beauty, rich cultural heritage, and peaceful environment, Ubud stands out as one of Bali\'s hidden gems and is a must-visit for travelers.', '1729568758_e309f0d7e9cae72dcd8a.jpg', NULL, '2024-11-08 20:34:56'),
('P02', 'Paket Wisata Bedugul', 'single_destination', 1, 'Bedugul is a famous mountain tourist area in Bali, Indonesia. Located in Tabanan Regency, about 50 kilometers from Denpasar, Bedugul is a favorite destination because of its cool air and beautiful natural views. Bedugul is surrounded by green hills, lakes and lush gardens.', '1729568779_5b6aa544ebe5b64901ab.jpg', NULL, '2024-11-08 20:24:43'),
('P03', 'Paket Hamparan Perak', 'single_destination', 1, 'hamparan perak adalah kota yang sangat luar biasa', '1730166231_0e6a73dd39350d1fb1f6.jpg', NULL, '2024-11-08 20:24:49');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int NOT NULL,
  `booking_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_method` enum('bank_transfer','other') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `account_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `account_number` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `account_holder_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` enum('pending','validated','failed') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `proof_of_payment` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `customer_id`, `payment_method`, `account_name`, `account_number`, `account_holder_name`, `payment_date`, `payment_status`, `proof_of_payment`) VALUES
(7, 'B43298', 'C002', 'bank_transfer', 'Bank Rakyat Indonesia', '113414134134', 'Agus Hariyanto', '2024-11-17 02:06:57', 'validated', '1731809217_65fe52845770bec23769.jpg'),
(9, 'B32535', 'C002', 'bank_transfer', 'Bank Rakyat Indonesia', '113414134134', 'Agus Hariyanto', '2024-11-17 03:15:03', 'validated', '1731813303_bec3a590b7bf2da3740c.jpg'),
(10, 'B68127', 'C002', 'bank_transfer', 'Bank Rakyat Indonesia', '113414134134', 'Agus Hariyanto', '2024-11-25 01:30:23', 'validated', '1732498223_9363ca8148fd87244278.png');

--
-- Triggers `payments`
--
DELIMITER $$
CREATE TRIGGER `update_booking_status` AFTER UPDATE ON `payments` FOR EACH ROW BEGIN
    -- Jika status pembayaran telah selesai ('paid'), maka update booking status menjadi 'confirmed'
    IF NEW.payment_status = 'validated' THEN
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
  `payment_id` int NOT NULL,
  `booking_id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
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
  `rating` tinyint NOT NULL,
  `review_text` text COLLATE utf8mb4_general_ci,
  `review_photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `review_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `booking_id`, `rating`, `review_text`, `review_photo`, `review_date`) VALUES
(2, 'B43298', 4, 'Perjalanan Menyenangkan', '1731823523_5b69b5e0facc51478b6b.jpg,1731823523_0f177569924865b0ff5c.jpg', '2024-11-16 23:05:23'),
(3, 'B68127', 5, 'Pelayanan Ramah dan Menyenangkan, Saya Akan menggunakan jasa Travel ini lagi jika saya ingin berpergian', '1732580467_2d46395e73335a845281.jpeg,1732580467_ea6fc87ee9daf0eaffb4.jpeg', '2024-11-25 17:21:07');

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
(7, 'Avanza Black', 'DK 1234 AB', 6, 'MPV', '1727757860_3598cad48cb5adbdbd31.jpg', 'available', '2024-09-30 21:44:20', '2024-11-25 11:09:02'),
(9, 'Suzuki APV Putih', 'DK 1234 ABC', 8, 'APV', '1728292802_0e76ce8c9e2331e8ddef.png', 'available', '2024-10-07 02:20:02', '2024-11-11 14:17:50'),
(10, 'Suzuki Ertiga Abu - Abu', 'DK 3456 BCD', 5, 'MPV', '1728292900_1fe2e62667d6773573d4.png', 'available', '2024-10-07 02:21:40', '2024-11-25 11:28:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

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
  ADD KEY `bookings_ibfk_2` (`package_id`),
  ADD KEY `bookings_ibfk_1` (`customer_id`);

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
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`),
  ADD KEY `fk_destinasi_paket` (`package_id`);

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
  ADD KEY `payments_ibfk_1` (`booking_id`),
  ADD KEY `payments_ibfk_2` (`customer_id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`refund_id`),
  ADD KEY `refunds_ibfk_1` (`booking_id`),
  ADD KEY `refunds_ibfk_2` (`customer_id`),
  ADD KEY `refunds_ibfk_3` (`payment_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_travel`
--
ALTER TABLE `bank_travel`
  MODIFY `trabank_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking_destinations`
--
ALTER TABLE `booking_destinations`
  MODIFY `booking_destination_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `booking_vehicles`
--
ALTER TABLE `booking_vehicles`
  MODIFY `booking_vehicle_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `refund_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `fk_destinasi_paket` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `refunds_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `refunds_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
