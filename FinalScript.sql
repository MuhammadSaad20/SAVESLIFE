-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2019 at 12:56 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hope`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloodprices`
--

CREATE TABLE `bloodprices` (
  `bg` varchar(3) NOT NULL,
  `bg_price` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bloodprices`
--

INSERT INTO `bloodprices` (`bg`, `bg_price`) VALUES
('A+', 2000),
('A-', 4000),
('AB+', 1000),
('AB-', 2000),
('B+', 2000),
('B-', 4000),
('O+', 4000),
('O-', 8000);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(4) NOT NULL,
  `cid_fk` int(4) NOT NULL,
  `did_fk` int(4) NOT NULL,
  `rid_fk` int(4) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ctd`
--

CREATE TABLE `ctd` (
  `rid_fk` int(4) NOT NULL,
  `cid_fk` int(4) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `ctdstatus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctd`
--

INSERT INTO `ctd` (`rid_fk`, `cid_fk`, `date`, `ctdstatus`) VALUES
(82, 14, '2019-12-02', 1),
(84, 14, '2019-12-02', 1),
(83, 15, '2019-12-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cusers`
--

CREATE TABLE `cusers` (
  `id` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `location` varchar(50) NOT NULL,
  `joindate` timestamp NOT NULL DEFAULT current_timestamp(),
  `verfkey` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `rid` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cusers`
--

INSERT INTO `cusers` (`id`, `username`, `email`, `password`, `location`, `joindate`, `verfkey`, `status`, `rid`) VALUES
(14, 'Fatima Sardar', 'fs2@gmail.com', '$2y$10$sckqPDULJW6ZARkMcUaVMOqRNO/JIPNXOM1ZFRQry5OckhLTcZeJK', 'defence', '2019-12-01 19:28:53', '64c36f51fcc7ed3a17c7c3557f6f07da', 1, NULL),
(15, 'AQ', 'anam.qureshi@nu.edu.pk', '$2y$10$dRXbymNqUz9DikhcVNfKVuPAXhZPAVVXWf8Y3p3UY1y3Yz34LG/Wi', 'jahur', '2019-12-02 10:42:55', '4107e7f185bd4e0902b0fc4e4a2f3144', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `chat_id` int(4) NOT NULL,
  `did_fk` int(4) NOT NULL,
  `cid_fk` int(4) NOT NULL,
  `rid_fk` int(4) NOT NULL,
  `chat` text DEFAULT NULL,
  `cs` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`chat_id`, `did_fk`, `cid_fk`, `rid_fk`, `chat`, `cs`, `date`) VALUES
(56, 25, 14, 82, 'hey FS!', 1, '2019-12-02 00:36:17'),
(57, 25, 14, 82, 'hey ', 0, '2019-12-02 00:37:35'),
(58, 39, 14, 84, 'Hey Fatima!', 1, '2019-12-02 09:20:38'),
(59, 39, 14, 84, 'its good that you chose me as a donor', 1, '2019-12-02 09:21:08'),
(60, 39, 14, 84, 'Ya can we meat on sunday?', 0, '2019-12-02 09:21:53'),
(61, 27, 15, 83, 'hey aq', 1, '2019-12-02 15:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `card_num` bigint(20) NOT NULL,
  `card_exp_month` int(2) NOT NULL,
  `card_exp_year` year(4) NOT NULL,
  `card_cvv` int(3) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` float(10,2) NOT NULL,
  `currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `order_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `card_num`, `card_exp_month`, `card_exp_year`, `card_cvv`, `item_name`, `item_number`, `item_price`, `currency`, `paid_amount`, `order_number`, `txn_id`, `payment_status`, `created`, `modified`) VALUES
(4, 'fatima sardar', 'fs2@gmail.com', 4222222222222220, 3, 2019, 1234, 'Premium Script CodexWorld', 'PS123456', 25.00, 'USD', '25.00', '9093752292288', '9093752292297', 'APPROVED', '2019-12-02 08:25:49', '2019-12-02 08:25:49'),
(5, 'fatima sardar', 'fs2@gmail.com', 4222222222222220, 9, 2020, 1234, 'Premium Script CodexWorld', 'PS123456', 25.00, 'USD', '25.00', '9093752292339', '9093752292348', 'APPROVED', '2019-12-02 09:23:07', '2019-12-02 09:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `req`
--

CREATE TABLE `req` (
  `rid` int(4) NOT NULL,
  `did_fk` int(4) NOT NULL,
  `location` varchar(50) NOT NULL,
  `blood_group` varchar(3) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `reqstatus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req`
--

INSERT INTO `req` (`rid`, `did_fk`, `location`, `blood_group`, `date`, `reqstatus`) VALUES
(82, 25, 'Gulshan', 'O+', '2019-12-02', 1),
(83, 27, 'Gulshan', 'O+', '2019-12-02', 1),
(84, 39, 'Gulshan', 'B+', '2019-12-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `location` varchar(50) NOT NULL,
  `joindate` timestamp NOT NULL DEFAULT current_timestamp(),
  `verfkey` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `location`, `joindate`, `verfkey`, `status`) VALUES
(4, 'mubashir ahmed', 'mubashir1@gmail.com', '$2y$10$rnI7lVbAHUaf4F/CgXAzuONYJ1cElqe4DsrAZ951cUNI8D22aqcKi', 'malir', '2019-09-29 08:35:05', '', 1),
(5, 'ana maree', 'marieuk@gmail.com', '$2y$10$x/xWpuiNaCfPpqw6b4Wk1esHU4tYPxFKOvO24f8srxUL7xZ0HEjKO', 'uk', '2019-09-29 11:11:18', '', 0),
(6, 'ali nawaz', 'Ali123@gmail.com', '$2y$10$Blp9u8oG5wWBWeD0.VY3qujX4rEgm/OS.gC2MbSWZn/idwDJeGozS', 'defence', '2019-09-29 11:14:48', '', 1),
(8, 'aliza', 'uzma_iqbal@gmail.com', '$2y$10$T0.jGtj2BTVe00lefaOkc.YnXlK8DSr3PjcePSwkQb5BDZdX6L0q6', 'gulshan', '2019-09-29 12:10:52', '', 1),
(9, 'wars', 'uzma_iqbal@gmail.com', '$2y$10$ovb9CnkwxQ/ZlBxl.1ZXXedFM7Cm9Av.e/GT7lLaDlsf6VNOz5zJq', 'malir', '2019-09-29 12:12:59', '', 1),
(10, 'asim farhan', 'Ali123@gmail.com', '$2y$10$OvKqUzxPdPvoYrDR4A.dRuiF.HR6ESx8JHtMq6SRjAPScnLt4lhzy', 'kda', '2019-09-29 12:13:45', '', 1),
(11, 'hyder', 'a@gmial.com', '$2y$10$cKlik4PUtRyQAEnBngUgCO55tLnc/RK0gDQ8U1dYo4z9KBc2dexSm', 'malir', '2019-09-29 12:20:42', '', 1),
(12, 'imran khan', 'a@gmial.com', '$2y$10$4F6ZEFecZjcSJz8PE3AHk.wPFPIG88bzVbkkaM4P0LqCYaheuCoCO', 'malir', '2019-09-29 12:21:35', '', 1),
(13, 'nawaz sharif', 'gov@gmail.om', '$2y$10$bvKS/U4dKedF5l1legrkBeNs9gHr/f1I.cCBPlfds8zr6Mb/OIH1u', 'northkarachi', '2019-09-29 12:25:38', '', 1),
(14, 'ifrah ifthikar', 'a@gmial.com', '$2y$10$PjQBZsJKK/flldy5jsAX0OLCbdFepm7Z5dd.5SJkXnPstPojL8osu', 'gulshan', '2019-09-29 14:13:40', '', 1),
(15, 'fahad qureshi', 'uzma_iqbal@gmail.com', '$2y$10$nbl55E9l9zB.0.okJaEOtu0PZJDW4aJUEA0UdFTrmEZH4FRQTSvZS', 'kda', '2019-09-29 14:30:20', '', 1),
(16, 'Muhammad mujahid', 'uzma_iqbal@gmail.com', '$2y$10$gyMyXCtmBiCpXblkmPUuNemEO5vqF3kqIlAwUs2R7JNYywSlnbajy', 'jahur', '2019-09-29 14:32:08', '', 1),
(17, 'Muhammad Saeed', 'uzma_iqbal@gmail.com', '$2y$10$/1s56uW87m89fczWlfAL7OnDtVuMYOZ19C8.bUW8Yw6ZsqXUhOmbK', 'northkarachi', '2019-09-29 14:38:26', '', 1),
(18, 'farhan ahmed', 'ke@gmail.com', '$2y$10$Trtp42lM06PwnTgBrxuFWeI.6B2rfC.FYIzIe.uooirj0utx8PG2W', 'kda', '2019-09-29 14:44:00', '', 1),
(19, 'wajhat kazmi', 'kazmi@gmail.com', '$2y$10$O1s10FzWZyS82/4D04GwGetTlI3ecOLDLks0ksXHetcMNGBxz0voi', 'gulshan', '2019-09-29 16:26:27', 'f83e7ce96f16461ac16d0af9bdb86c1a', 1),
(20, 'satish kumar', 'satishuk@gmail.com', '$2y$10$jG6lqCLCvuxBBrKiECN9PeAjr28G2KXyrYk6E9Pbrk0tzRmSA.nqS', 'hadid', '2019-10-09 08:22:28', 'ade630bd66bdf2bdd8b28c077c28845e', 1),
(21, 'Faraz Ahmed1', 'f1@gmail.com', '$2y$10$zHFEs.7hIkurFEvdvB/6f.1zyr0W8vJCHG7Tum3dZq6mq/WYd6gLa', 'malir', '2019-10-17 17:26:34', '761b660a823538904b2c21fd6ca49c99', 1),
(22, 'Hunain Khan', 'hk@gmail.com', '$2y$10$Nzinq5YENSfHbhRiPg17/.eeGEq6kgCsxhoKVD4Bd/CSaCOO9kbO6', 'kda', '2019-10-22 20:12:37', '2e9470d060f9b566a8290029cc24b869', 1),
(24, 'hanabk', 'huzaifa@gmail.com', '$2y$10$uf3cduomx04oAIXxFgabTOJwAr.ao.rYNJX..AogIraB6lrWpvU7i', 'Karachi', '2019-10-28 08:08:27', '8d5db37dd69fdf62278b634e84cdf727', 1),
(25, 'Qadri', 'qd@gmail.com', '$2y$10$rNHwxV0o.4PhPHm8o3LR6Ovk7w5KAObPWudEZCrTTOBjvK3/IOiz6', 'dastegear', '2019-11-19 21:16:04', '4eeb04e26285895f88af3301f9300b32', 1),
(26, 'Bilawal Tariq', 'bt@gmail.com', '$2y$10$XQBhmSOESg.As33o/I4SVubYi0vN.tLXQnGcX703cDFbSIe1dCuAy', 'azizabad', '2019-11-19 21:16:48', '6d793246592bb6194b5c69efdbd0e02b', 1),
(27, 'Guree Shankar', 'y2k@gmail.com', '$2y$10$xOLXVJ.p8LCLkAmxoFAf9uC3VKMFd6bKekdQtfapARWQ55iQJRdo6', 'janutun naima', '2019-11-19 21:18:47', 'cf169b5f3f0433c8855fc790810f53ae', 1),
(28, 'John Wick', 'jw@gmail.com', '$2y$10$Cq8na3RViSaXMRwYz9aVDu8Th5Ak8Q8CEKzJD8pqPvbkWga.k.6P6', 'kda', '2019-11-21 10:22:01', 'af4d53e3f753396688351e6165235c21', 1),
(29, 'abdul - rahman', 'armahmood786@yahoo.com', '$2y$10$olFP9VM/DdjieiBuLtaTb.bfybdRNzodKoscv4G1epxrG9i8VxVti', 'defence', '2019-11-25 10:07:23', '46ea31f8a1474d861a12ebb50bb08d10', 1),
(37, 'Sheikh Zaid', 'msaadkhan375@gmail.com', '$2y$10$ITzfmK2U8Vsl2SSi.2hCp.ev3N5/Bj.R.cQG.vAiTYq9BU1uGTgxy', 'jahur', '2019-12-01 16:51:24', '659e8dfe279916248c58dcdf76c9d882', 1),
(39, 'Muhammad Zaid', 'saadnust71@gmail.com', '$2y$10$fAi1mX1.Ls3BH2j01fwqyO/UwK1YcMy1DNrSAr8teCVK.hpxDAnWS', 'gulshan', '2019-12-02 04:17:48', 'bdcca89f003022c9b09a5035f68a1ca0', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloodprices`
--
ALTER TABLE `bloodprices`
  ADD PRIMARY KEY (`bg`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD KEY `cid_fk` (`cid_fk`),
  ADD KEY `did_fk` (`did_fk`),
  ADD KEY `rid_fk` (`rid_fk`);

--
-- Indexes for table `ctd`
--
ALTER TABLE `ctd`
  ADD KEY `rid_fk` (`rid_fk`),
  ADD KEY `cid_fk` (`cid_fk`);

--
-- Indexes for table `cusers`
--
ALTER TABLE `cusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `did_fk` (`did_fk`),
  ADD KEY `cid_fk` (`cid_fk`),
  ADD KEY `rid_fk` (`rid_fk`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req`
--
ALTER TABLE `req`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `did_fk` (`did_fk`),
  ADD KEY `blood_group` (`blood_group`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cusers`
--
ALTER TABLE `cusers`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `chat_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `req`
--
ALTER TABLE `req`
  MODIFY `rid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`cid_fk`) REFERENCES `cusers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_ibfk_2` FOREIGN KEY (`did_fk`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_ibfk_3` FOREIGN KEY (`rid_fk`) REFERENCES `req` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ctd`
--
ALTER TABLE `ctd`
  ADD CONSTRAINT `ctd_ibfk_1` FOREIGN KEY (`rid_fk`) REFERENCES `req` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ctd_ibfk_3` FOREIGN KEY (`cid_fk`) REFERENCES `cusers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cusers`
--
ALTER TABLE `cusers`
  ADD CONSTRAINT `cusers_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `req` (`rid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `msg`
--
ALTER TABLE `msg`
  ADD CONSTRAINT `msg_ibfk_1` FOREIGN KEY (`did_fk`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `msg_ibfk_2` FOREIGN KEY (`cid_fk`) REFERENCES `cusers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `msg_ibfk_3` FOREIGN KEY (`rid_fk`) REFERENCES `req` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `req`
--
ALTER TABLE `req`
  ADD CONSTRAINT `req_ibfk_1` FOREIGN KEY (`did_fk`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `req_ibfk_2` FOREIGN KEY (`blood_group`) REFERENCES `bloodprices` (`bg`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
