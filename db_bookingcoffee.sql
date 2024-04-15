-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 15, 2024 at 01:36 AM
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
-- Database: `bookingcoffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AccountID` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `FullName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `UserName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `RoleID` char(36) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountID`, `FullName`, `UserName`, `Password`, `Email`, `RoleID`) VALUES
('1ecce68e-52ea-4bf8-b3cd-6c89120e7b56', 'Nguyễn Văn O', 'nguyenvano', '$2y$10$lK7w3m1CGaEv6OVZfxnFkO.yXP2dVTOW9A6/PqhrLb4JYqkVK1zum', 'nguyenvano@gmail.com', '8895cda3-548d-4cca-808c-6053256da06e'),
('499fd614-cc81-431d-980f-3c2d0cc73189', 'Nguyễn Văn A', 'nguyenvana', 'nguyenvana', 'nguyenvana@gmail.com', 'f4b28d9d-4418-41f2-8bbd-cf054edf64ea'),
('4c969e06-9623-4cde-8487-5c515be68bce', 'Nguyễn Văn H', 'nguyenvanh', '$2y$10$WafyuypwfZgBemxHTb01AOZNf2c8jHLn6o7ujP97HqK2igEq5IRhy', 'nguyenvanh@gmail.com', '8895cda3-548d-4cca-808c-6053256da06e'),
('61875c6b-dd35-4a33-9b21-b35718e4cc97', 'Nguyễn Văn B', 'nguyenvanb', 'nguyenvanb', 'nguyenvanb@gmail.com', '8895cda3-548d-4cca-808c-6053256da06e'),
('62b30a16-e2de-4062-9f29-b5810e1c46ce', 'Nguyễn Văn F', 'nguyenvanf123', '$2y$10$y5lse2lY4uMg.npiQW5d1OumH.vm1LN3LYdmcnqoZGu3AcHsgMMhO', 'nguyenvanf@gmail.com', '8895cda3-548d-4cca-808c-6053256da06e'),
('85579e9b-2ea1-4e92-969c-acdc1eba7a0d', 'Nguyễn Văn E', 'nguyenvane', '$2y$10$75O/89hh.Kc35Nw17NtGQeh10fnaBlZwoXlrsEyGObIXWK2RZIT3i', 'nguyenvane@gmail.com', '8895cda3-548d-4cca-808c-6053256da06e'),
('9f290340-c075-42bb-b2c6-ebcf995c4d85', 'Nguyễn Văn C', 'nguyenvand', '$2y$10$jxbd7kqQrfuKKHfkNqdcG.2SJtHs2wwr.LapHUliV5cNugDR8kK66', 'nguyenvand@gmail.com', 'f4b28d9d-4418-41f2-8bbd-cf054edf64ea'),
('a41d4925-cdfd-4dd8-b4d1-90c5a9cce911', 'Nguyễn Văn L', 'nguyenvanl', '$2y$10$g/gLGcqaVyX48A0gaSx4ieNCuv.irXC9oEyEiu.xSBXqnGB2zPd2.', 'nguyenvanl@gmail.com', '8895cda3-548d-4cca-808c-6053256da06e'),
('e8d9bd3e-0801-4a37-9152-613ea7e0485a', 'Nguyễn Văn C', 'nguyenvanc', '$2y$10$..CPbUW/xcJ3tvBvq/EXw.ILIMItmmDECCXgyPa94R7bk92iG22ce', 'nguyenvanc@gmail.com', '8895cda3-548d-4cca-808c-6053256da06e');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CateID` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `CateName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CateID`, `CateName`, `Image`) VALUES
('42b4f591-ee08-4614-a180-c7b3b840a535', 'Trà', 'https://i.imgur.com/LNzRsXt.png'),
('7b474708-86f5-4404-94ef-ac1cb8504bba', 'Coffee', 'https://i.imgur.com/LNzRsXt.png'),
('7d9b97ce-e2ac-4dfc-9376-9884c7930268', 'Bánh', 'https://i.imgur.com/LNzRsXt.png');

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `DishID` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `DishName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Price` decimal(10,3) DEFAULT NULL,
  `Description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Amount` int DEFAULT NULL,
  `Image` longtext COLLATE utf8mb4_general_ci,
  `Status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CateID` char(36) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ToppingID` char(36) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`DishID`, `DishName`, `Price`, `Description`, `Amount`, `Image`, `Status`, `CateID`, `ToppingID`) VALUES
('03eede6a-c8ba-484f-a98f-2703606f02ec', 'Chicken Curry', 50.000, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('04c9e51d-0d05-44b0-b511-a5220523d5b7', 'Coffee Latte', 3.990, 'A delicious coffee latte made with freshly brewed coffee and steamed milk.', 100, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '7b474708-86f5-4404-94ef-ac1cb8504bba', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('0ab91a1c-08cc-41b0-8acc-70fe00127da9', 'Chicken Curry', 50.000, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('25f2c63e-71e7-40c6-a8d2-ef1e4ebcfe19', 'Coffee Latte', 3.990, 'A delicious coffee latte made with freshly brewed coffee and steamed milk.', 100, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '7b474708-86f5-4404-94ef-ac1cb8504bba', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('29fdf395-cdba-4991-a093-5e4603f42c0b', 'Chicken Curry', 50.000, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('32e24623-642c-42c5-b274-f70333474892', 'Trà chanh lô hội', 800.000, 'A delicious coffee latte made with freshly brewed coffee and steamed milk.', 250, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('34f9bdc5-e1d2-43cb-8d11-6b52d8c7f62e', 'Coffee Latte', 3.990, 'A delicious coffee latte made with freshly brewed coffee and steamed milk.', 100, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '7b474708-86f5-4404-94ef-ac1cb8504bba', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('367aff73-6a8b-4413-a0b2-bbfd9422ee02', 'Chicken Curry', 50.000, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('38978528-1632-4775-9dd4-1275df0e0846', 'Chicken Curry', 10.990, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('39e95e31-8f8a-44eb-8e43-f23e4700a6b7', 'Coffee Latte', 3.990, 'A delicious coffee latte made with freshly brewed coffee and steamed milk.', 100, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '7b474708-86f5-4404-94ef-ac1cb8504bba', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('46c7db72-f79d-462a-b7b6-32165388351a', 'Chicken Curry', 50.000, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('4c862552-3668-42a8-9ddd-bd616d73ff6f', 'Coffee Latte', 3.990, 'A delicious coffee latte made with freshly brewed coffee and steamed milk.', 100, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '7b474708-86f5-4404-94ef-ac1cb8504bba', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('5aeed4f8-a0c4-4f5e-b5cc-348f70d3d20b', 'Chicken Curry', 50.000, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('7bbc0390-8f25-462b-876d-79fd695cfd64', 'Chicken Curry', 50.000, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('c43dcade-39d9-409d-94fb-542027449e5c', 'Chicken Curry', 50.000, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('c82f4549-f1df-4f17-a254-43ad6b14082a', 'Chicken Curry', 50.000, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('d1f6591b-8a08-4779-b6f1-58dae11846a2', 'Chicken Curry', 50.000, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('df719030-1c30-435d-b223-acf13160e8fe', 'Coffee Latte', 3.990, 'A delicious coffee latte made with freshly brewed coffee and steamed milk.', 100, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '7b474708-86f5-4404-94ef-ac1cb8504bba', '4f8d3222-9571-42c5-ac91-0ee87c587eaf'),
('f3fbd81c-fee1-4360-8531-8b215d8f7287', 'Chicken Curry', 50.000, 'Delicious chicken curry with spices', 1, 'https://i.imgur.com/CqDHcUb.jpg', 'Còn hàng', '42b4f591-ee08-4614-a180-c7b3b840a535', '4f8d3222-9571-42c5-ac91-0ee87c587eaf');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `OrderID` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `DishID` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `Size` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Quantity` int DEFAULT NULL,
  `Price` decimal(10,3) DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `Topping` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TableName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`OrderID`, `DishID`, `Size`, `Quantity`, `Price`, `Total`, `Topping`, `TableName`) VALUES
('94cafcd9-537e-447a-a7df-129c9f790720', '03eede6a-c8ba-484f-a98f-2703606f02ec', 'Large', 2, 10.990, 21.98, 'Cheese', 'Table 1'),
('94cafcd9-537e-447a-a7df-129c9f790720', '32e24623-642c-42c5-b274-f70333474892', 'Medium', 1, 8.990, 8.99, 'Bacon', 'Table 2'),
('dc980781-647d-4cfb-9b67-61a48c33869b', '03eede6a-c8ba-484f-a98f-2703606f02ec', 'Medium', 1, 8.990, 8.99, 'Bacon', 'Table 2'),
('dc980781-647d-4cfb-9b67-61a48c33869b', '0ab91a1c-08cc-41b0-8acc-70fe00127da9', 'Large', 2, 10.990, 21.98, 'Cheese', 'Table 1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  `AccountID` char(36) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TotalAmount` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CreatedAt`, `AccountID`, `TotalAmount`) VALUES
('94cafcd9-537e-447a-a7df-129c9f790720', '2024-04-13 10:30:00', '1ecce68e-52ea-4bf8-b3cd-6c89120e7b56', 50.990),
('dc980781-647d-4cfb-9b67-61a48c33869b', '2024-04-13 10:30:00', '1ecce68e-52ea-4bf8-b3cd-6c89120e7b56', 50.990);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `TotalAmount` decimal(10,3) DEFAULT NULL,
  `PaymentMethod` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `SeatBookedID` char(36) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleID` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `Name`) VALUES
('8895cda3-548d-4cca-808c-6053256da06e', 'User'),
('f4b28d9d-4418-41f2-8bbd-cf054edf64ea', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `topping`
--

CREATE TABLE `topping` (
  `ToppingID` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Price` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topping`
--

INSERT INTO `topping` (`ToppingID`, `Name`, `Description`, `Price`) VALUES
('4f8d3222-9571-42c5-ac91-0ee87c587eaf', 'Hazelnut Syrup ', 'Siro hạt điều đậm đà và thơm ngon cho hương vị sang trọng', 10.000),
('8f241b16-c1e7-45da-b15d-34f45403108c', 'Kem', 'Kem', 10.000),
('ad0d705d-201f-47e7-9d0a-837d0b3a9ec8', 'Socola', 'Socola đen', 10.000),
('fc76e541-44b5-4089-8b5b-74ef856bcae5', 'Không', '', 0.000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountID`),
  ADD KEY `FK_Role` (`RoleID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CateID`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`DishID`),
  ADD KEY `FK_Category` (`CateID`),
  ADD KEY `FK_Topping` (`ToppingID`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`OrderID`,`DishID`),
  ADD KEY `DishID` (`DishID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK_AccountID` (`AccountID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `FK_SeatBooked` (`SeatBookedID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `topping`
--
ALTER TABLE `topping`
  ADD PRIMARY KEY (`ToppingID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `FK_Role` FOREIGN KEY (`RoleID`) REFERENCES `role` (`RoleID`);

--
-- Constraints for table `dish`
--
ALTER TABLE `dish`
  ADD CONSTRAINT `FK_Category` FOREIGN KEY (`CateID`) REFERENCES `category` (`CateID`),
  ADD CONSTRAINT `FK_Topping` FOREIGN KEY (`ToppingID`) REFERENCES `topping` (`ToppingID`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`DishID`) REFERENCES `dish` (`DishID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_AccountID` FOREIGN KEY (`AccountID`) REFERENCES `account` (`AccountID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
