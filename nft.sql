-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 01:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nft`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `cancelled_transaction`
-- (See below for the actual view)
--
CREATE TABLE `cancelled_transaction` (
`transaction_id` int(50)
,`transaction_date` datetime
,`commission` decimal(50,0)
,`commission_type` varchar(6)
,`nft_address` varchar(50)
,`nft_token_id` int(11)
,`seller_eth_address` varchar(50)
,`buyer_eth_address` varchar(50)
,`transaction_status` varchar(9)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `manager_view`
-- (See below for the actual view)
--
CREATE TABLE `manager_view` (
);

-- --------------------------------------------------------

--
-- Table structure for table `nft_items`
--

CREATE TABLE `nft_items` (
  `token_id` int(11) NOT NULL,
  `smart_contract_address` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `current_mp` decimal(50,0) DEFAULT NULL,
  `owner_id` int(50) NOT NULL,
  `list` tinyint(1) NOT NULL DEFAULT 0,
  `list_in` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nft_items`
--

INSERT INTO `nft_items` (`token_id`, `smart_contract_address`, `name`, `current_mp`, `owner_id`, `list`, `list_in`) VALUES
(1101794, '0xeebaccf650cd5fee15b31093daa5836788696aa4', 'SHIB', '100', 123456745, 1, 'usd'),
(1555155, '0xaf6947ec39ff3e2989e5b3bb59d1e85259f83813', 'DOGE', '542419', 123456745, 1, 'usd'),
(1555156, '0x12y8hhhAwq341j', 'funky-monkey', '10000', 123456745, 0, 'usd'),
(1555159, '1248hsdqidh3', 'varshil', '140', 123456746, 1, 'eth'),
(1555160, 'sdffdfsdfsewfgdgrgg', 'varshilqwqw', '40', 123456745, 0, 'usd');

-- --------------------------------------------------------

--
-- Table structure for table `nft_transaction`
--

CREATE TABLE `nft_transaction` (
  `transaction_id` int(50) NOT NULL,
  `transaction_date` datetime DEFAULT current_timestamp(),
  `commission` decimal(50,0) NOT NULL,
  `commission_type` varchar(6) DEFAULT NULL,
  `nft_address` varchar(50) DEFAULT NULL,
  `nft_token_id` int(11) DEFAULT NULL,
  `seller_eth_address` varchar(50) NOT NULL,
  `buyer_eth_address` varchar(50) NOT NULL,
  `transaction_status` varchar(9) DEFAULT 'success',
  `amount` float NOT NULL,
  `commission_payment_in` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nft_transaction`
--

INSERT INTO `nft_transaction` (`transaction_id`, `transaction_date`, `commission`, `commission_type`, `nft_address`, `nft_token_id`, `seller_eth_address`, `buyer_eth_address`, `transaction_status`, `amount`, `commission_payment_in`) VALUES
(1, '2022-11-30 18:03:55', '1500', 'silver', '0x12y8hhhAwq341j', 1555156, '0x71C7656EC7ab88b098defB751B7401B5f6d8976F', '0x71C7656EC7ab88b098defB751B7401B5f6e5976F', 'success', 10000, 'usd'),
(15216625, '2022-11-18 18:15:10', '14016688', 'gold', '0xaf6947ec39ff3e2989e5b3bb59d1e85259f83813', 1101794, '0x71C7656EC7ab88b098defB751B7401B5f6e5976F', '0x71C7656EC7ab88b098defB751B7401B5f6d8976F', 'success', 103450, 'usd'),
(22653184, '2022-11-18 18:30:10', '55022476', 'silver', '0xaf6947ec39ff3e2989e5b3bb59d1e85259f83813', 1101794, '0x71C7656EC7ab88b098defB751B7401B5f6d8976F', '0x71C7656EC7ab88b098defB751B7401B5f6e5976F', 'cancelled', 234532, 'eth'),
(77682127, '2021-12-20 00:00:00', '6565327', 'silver', '0xeebaccf650cd5fee15b31093daa5836788696aa4', 1555155, '0x71C7656EC7ab88b098defB751B7401B5f6d8976F', '0x71C7656EC7ab88b098defB751B7401B5f6e5976F', 'success', 563452, 'eth'),
(78820005, '2021-08-02 00:00:00', '841038', 'gold', '0xeebaccf650cd5fee15b31093daa5836788696aa4', 1101794, '0x71C7656EC7ab88b098defB751B7401B5f6e5976F', '0x71C7656EC7ab88b098defB751B7401B5f6d8976F', 'cancelled', 1278640, 'usd'),
(78859025, '2022-08-23 00:00:00', '4240367', 'gold', '0xeebaccf650cd5fee15b31093daa5836788696aa4', 1555155, '0x71C7656EC7ab88b098defB751B7401B5f6d8976F', '0x71C7656EC7ab88b098defB751B7401B5f6e5976F', 'success', 678523, 'eth'),
(78859026, '2022-12-02 13:45:17', '82', 'gold', '0xaf6947ec39ff3e2989e5b3bb59d1e85259f83813', 1555155, '0x71C7656EC7ab88b098defB751B7401B5f6e5976F', '0x71C7656EC7ab88b098defB751B7401B5f6e5976F', 'success', 823, 'eth'),
(78859027, '2022-12-05 14:28:26', '2', 'gold', '0xaf6947ec39ff3e2989e5b3bb59d1e85259f83813', 1555155, '0x71C7656EC7ab88b098defB751B7401B5f6e5976F', '0x71C7656EC7ab88b098defB751B7401B5f6d8976F', 'cancelled', 20, 'eth');

-- --------------------------------------------------------

--
-- Table structure for table `payment_transaction`
--

CREATE TABLE `payment_transaction` (
  `payment_id` int(10) NOT NULL,
  `client_id` int(50) NOT NULL,
  `payment_type` varchar(3) DEFAULT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` int(50) DEFAULT NULL,
  `payment_address` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL,
  `eth_count` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_transaction`
--

INSERT INTO `payment_transaction` (`payment_id`, `client_id`, `payment_type`, `transaction_date`, `amount`, `payment_address`, `status`, `eth_count`) VALUES
(1, 123456745, 'USD', '2021-05-25 00:00:00', 49585891, '38247723487239847', 'cancelled', NULL),
(2, 123456746, 'ETH', '2022-05-25 00:00:00', NULL, '0x1fd02e019b865998faaa7250248d0251e169873c', 'success', 500),
(3, 123456746, 'USD', '2020-07-13 00:00:00', 21602194, '12093984723764', 'success', NULL),
(4, 123456745, 'ETH', '2021-08-19 00:00:00', NULL, '0xf1be01814b1802a69b78ab65457f2b811ae94a64', 'success', 200),
(5, 123456746, 'USD', '2022-11-26 19:50:35', 10000, '1234567', 'success', NULL),
(6, 123456746, 'ETH', '2022-11-26 19:51:34', NULL, '0x71C7656EC7ab88b098defB751B7401B5f6d8976F', 'success', 5000),
(7, 123456746, 'USD', '2022-11-28 21:04:55', 500, '12131194', 'success', NULL),
(8, 123456746, 'ETH', '2022-11-28 21:05:52', NULL, '0x71C7656EC7ab88b098defB751B7401B5f6d8976F', 'success', 1000),
(9, 123456745, 'USD', '2022-11-28 21:09:03', 10000, '71241984', 'success', NULL),
(10, 123456745, 'USD', '2022-11-30 18:01:19', 10000, '712489141', 'success', NULL),
(11, 123456745, 'USD', '2022-12-02 13:30:22', 10000, '4456764674674764', 'success', NULL),
(12, 123456745, 'USD', '2022-12-02 13:32:43', 100000, '34543545654756765645', 'success', NULL),
(13, 123456745, 'USD', '2022-12-05 13:29:42', 50000, '71461746', 'success', NULL),
(14, 123456745, 'USD', '2022-12-05 13:45:34', 100000, '214614619', 'success', NULL),
(15, 123456745, 'USD', '2022-12-05 13:53:41', 40000, '2498148916', 'success', NULL),
(16, 123456745, 'ETH', '2022-12-05 13:55:32', NULL, '0x71C7656EC7ab88b098defB751B7401B5f6e5976F', 'cancelled', 6);

-- --------------------------------------------------------

--
-- Stand-in structure for view `recent_transaction15`
-- (See below for the actual view)
--
CREATE TABLE `recent_transaction15` (
`transaction_id` int(50)
,`transaction_date` datetime
,`nft_address` varchar(50)
,`seller_eth_address` varchar(50)
,`buyer_eth_address` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `traders`
--

CREATE TABLE `traders` (
  `client_id` int(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone_num` varchar(50) DEFAULT NULL,
  `cell_num` varchar(50) DEFAULT NULL,
  `balance` decimal(10,0) NOT NULL DEFAULT 0,
  `client_category` varchar(6) NOT NULL DEFAULT 'silver',
  `ethereum_address` varchar(50) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `user_role` int(1) NOT NULL,
  `eth_count` decimal(11,0) DEFAULT NULL,
  `join_date` datetime NOT NULL DEFAULT current_timestamp(),
  `street` varchar(550) DEFAULT NULL,
  `city` varchar(550) NOT NULL,
  `zipcode` varchar(550) NOT NULL,
  `state` varchar(550) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `traders`
--

INSERT INTO `traders` (`client_id`, `first_name`, `last_name`, `email`, `phone_num`, `cell_num`, `balance`, `client_category`, `ethereum_address`, `password`, `user_role`, `eth_count`, `join_date`, `street`, `city`, `zipcode`, `state`) VALUES
(123456745, 'Jos', 'Butler', 'jos@gmail.com', '4567823641', '3457685234', '160000', 'gold', '0x71C7656EC7ab88b098defB751B7401B5f6e5976F', '$2y$10$Plre6gMZByuXBT9TvITbXOQyzbNShSLwXA38P0s.8VPXaIFbmTij6', 0, '86', '2021-11-21 18:02:43', '955 W', 'Dallas', '75080', 'Texas'),
(123456746, 'John', 'Cobb', 'john@gmail.com', '3457685234', '4567823641', '58500', 'silver', '0x71C7656EC7ab88b098defB751B7401B5f6d8976F', '$2y$10$Plre6gMZByuXBT9TvITbXOQyzbNShSLwXA38P0s.8VPXaIFbmTij6', 0, '2299', '2022-11-21 18:02:43', '7575W', 'Richardson', '75525', 'Texas'),
(123456747, 'Nisarg', 'Shah', 'nisu@gmail.com', '9452572631', '22334455', '0', 'silver', '955 West President George Bush High', '$2y$10$Plre6gMZByuXBT9TvITbXOQyzbNShSLwXA38P0s.8VPXaIFbmTij6', 1, NULL, '2022-11-26 19:10:11', 'APT 1210', 'Richardson', '75080', 'Texas');

-- --------------------------------------------------------

--
-- Structure for view `cancelled_transaction`
--
DROP TABLE IF EXISTS `cancelled_transaction`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cancelled_transaction`  AS SELECT `nft_transaction`.`transaction_id` AS `transaction_id`, `nft_transaction`.`transaction_date` AS `transaction_date`, `nft_transaction`.`commission` AS `commission`, `nft_transaction`.`commission_type` AS `commission_type`, `nft_transaction`.`nft_address` AS `nft_address`, `nft_transaction`.`nft_token_id` AS `nft_token_id`, `nft_transaction`.`seller_eth_address` AS `seller_eth_address`, `nft_transaction`.`buyer_eth_address` AS `buyer_eth_address`, `nft_transaction`.`transaction_status` AS `transaction_status` FROM `nft_transaction` WHERE `nft_transaction`.`transaction_status` = 'cancelled''cancelled'  ;

-- --------------------------------------------------------

--
-- Structure for view `manager_view`
--
DROP TABLE IF EXISTS `manager_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `manager_view`  AS SELECT (select concat(`traders`.`first_name`,' ',`traders`.`last_name`) from `traders` where `traders`.`ethereum_address` = `seller_eth_address`) AS `Seller`, (select concat(`traders`.`first_name`,' ',`traders`.`last_name`) from `traders` where `traders`.`ethereum_address` = `buyer_eth_address`) AS `Buyer`, `transaction_date` AS `Transaction_date`, `commission_payment_in` AS `Payment_type`, (select `i`.`name` from `nft_items` `i` where `i`.`token_id` = `nft_token_id`) AS `Token_name`, `amount` AS `Amount`, `eth_count` AS `Eth_qty`, `transaction_status` AS `Status` FROM `nft_transaction` AS `nft``nft`  ;

-- --------------------------------------------------------

--
-- Structure for view `recent_transaction15`
--
DROP TABLE IF EXISTS `recent_transaction15`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recent_transaction15`  AS SELECT `nft_transaction`.`transaction_id` AS `transaction_id`, `nft_transaction`.`transaction_date` AS `transaction_date`, `nft_transaction`.`nft_address` AS `nft_address`, `nft_transaction`.`seller_eth_address` AS `seller_eth_address`, `nft_transaction`.`buyer_eth_address` AS `buyer_eth_address` FROM `nft_transaction` WHERE `nft_transaction`.`transaction_status` = 'success' AND `nft_transaction`.`transaction_date` >= current_timestamp() - interval 15 minute AND `nft_transaction`.`transaction_date` <= current_timestamp()  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nft_items`
--
ALTER TABLE `nft_items`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `nft_transaction`
--
ALTER TABLE `nft_transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `nft_token_id` (`nft_token_id`);

--
-- Indexes for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  ADD PRIMARY KEY (`payment_id`) USING BTREE,
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `traders`
--
ALTER TABLE `traders`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `ethereum_address` (`ethereum_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nft_items`
--
ALTER TABLE `nft_items`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1555161;

--
-- AUTO_INCREMENT for table `nft_transaction`
--
ALTER TABLE `nft_transaction`
  MODIFY `transaction_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78859028;

--
-- AUTO_INCREMENT for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `traders`
--
ALTER TABLE `traders`
  MODIFY `client_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123456748;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nft_transaction`
--
ALTER TABLE `nft_transaction`
  ADD CONSTRAINT `nft_transaction_ibfk_1` FOREIGN KEY (`nft_token_id`) REFERENCES `nft_items` (`token_id`);

--
-- Constraints for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  ADD CONSTRAINT `payment_transaction_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `traders` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
