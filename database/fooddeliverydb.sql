-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 08:32 PM
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
-- Database: `fooddeliverydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountdb`
--

CREATE TABLE `accountdb` (
  `id` int(30) NOT NULL,
  `Fullname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `Usertype` varchar(250) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountdb`
--

INSERT INTO `accountdb` (`id`, `Fullname`, `email`, `username`, `password`, `Usertype`) VALUES
(16, 'Matt Andrei Belano', 'belanomatt@gmail.com', 'xeinjii', '$2y$10$d8//XL5QdC4uURLbl2GV0.btCoNZ/mArf7Y.SEmYvSaRiALtCDRuy', 'admin'),
(29, 'Sheane Galeno', 'sheane@gmail.com', 'sheane', '$2y$10$xp1YqB2fIuzsobFGv.QyR.xK6po3XrxNWab8fLDtKPNl3iCTYqpsa', 'user'),
(30, 'Riyann Aguilar', 'riyann@gmail.com', 'riyann', '$2y$10$aqCKHJO.bTQG.eti5MBeW.B0Y23C/LBf.QgBJ/WAbl.AhZbGAq60K', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `quantity` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(250) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `phone` int(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `address1` varchar(250) NOT NULL,
  `address2` varchar(250) NOT NULL,
  `payment_method` varchar(250) NOT NULL,
  `total_product` varchar(250) NOT NULL,
  `total_price` int(250) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `user_id` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `fullname`, `phone`, `city`, `address1`, `address2`, `payment_method`, `total_product`, `total_price`, `order_date`, `user_id`) VALUES
(40, 'Riyan aguilar', 978786434, 'jeoquieoqeq', 'jgajsjka;s', 'sasasasasa', 'Cod', 'Pizza hawaiian (1) , Pizza margarita  (10) , Pizza pepperoni (13) , Pizza plain (13) ', 2960, '2024-06-08 14:25:42', 30),
(41, 'frer', 323232323, '232323jkhg', 'fdfdfd', 'fdfdfdf', 'Cod', 'Pizza margarita  (1) ', 80, '2024-06-08 14:32:54', 30),
(42, 'gfgfgfgf', 0, 'fgfgfg', 'fgfgfgf', 'gfgfgf', 'Cod', 'Pizza margarita  (38) ', 3040, '2024-06-08 14:34:13', 30),
(43, 'fdfdfdf', 0, 'dfdfdfd', 'fdfdf', 'fdfdfd', 'Cod', 'Pizza pepperoni (37) ', 2960, '2024-06-08 14:36:58', 30),
(44, 'fgfgfg', 0, 'fgfgfg', 'fgfgfg', 'fgfgfgfgf', 'Cod', 'Pizza plain (37) ', 2960, '2024-06-08 14:37:33', 30);

-- --------------------------------------------------------

--
-- Table structure for table `productdb`
--

CREATE TABLE `productdb` (
  `id` int(250) NOT NULL,
  `ProductTitle` varchar(250) NOT NULL,
  `ProductPrice` varchar(250) NOT NULL,
  `Quantity` int(250) NOT NULL,
  `Category` varchar(250) NOT NULL,
  `ProductPicture` varchar(250) NOT NULL,
  `product_id` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productdb`
--

INSERT INTO `productdb` (`id`, `ProductTitle`, `ProductPrice`, `Quantity`, `Category`, `ProductPicture`, `product_id`) VALUES
(73, 'Ube ice cream', '25 pesos', 100, 'Icecream', 'dessert ube.jpg', 0),
(74, 'Royal', '30 pesos', 200, 'Drinks', 'royal.jpg', 0),
(81, 'Coke', '30 pesos', 300, 'Drinks', 's-l1200.webp', 0),
(82, 'Leche flan', '50 pesos', 199, 'Desert', 'download (1).jpg', 0),
(83, 'French friese - sour & cream', '40 pesos', 100, 'Fries', 'sour & cream.jpg', 0),
(84, 'French fries - bbq ', '40 pesos', 100, 'Desert', 'bbq.jpg', 0),
(85, 'French fries - plain', '40 pesos', 300, 'Fries', 'french fries.jpg', 0),
(86, 'Tempura', '40', 100, 'Fried', 'side-view-tempura-shrimps-with-sweet-chili-sauce-board.jpg', 0),
(87, 'Chicken nuggets', '90', 100, 'Fried', 'pexels-leonardo-luz-338722550-14001637.jpg', 0),
(88, 'Fried chicken', '100pesos', 100, 'Fried', 'pexels-pixabay-60616.jpg', 0),
(89, 'Fried rice', '50', 99, 'Fried', 'pexels-rickyrecap-1630495.jpg', 0),
(90, 'Strawberry cake', '79', 21, 'Desert', 'pexels-suzyhazelwood-1098592.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountdb`
--
ALTER TABLE `accountdb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productdb`
--
ALTER TABLE `productdb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountdb`
--
ALTER TABLE `accountdb`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `productdb`
--
ALTER TABLE `productdb`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
