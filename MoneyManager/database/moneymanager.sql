-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2020 at 05:27 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moneymanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `actualtransaction`
--

CREATE TABLE `actualtransaction` (
  `TransactionID` int(11) NOT NULL,
  `BudgetPlanID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `TransactionDate` date NOT NULL,
  `TransactionType` varchar(255) NOT NULL,
  `TransactionDesc` text DEFAULT NULL,
  `TransactionAmount` float NOT NULL,
  `TransactionDescImg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actualtransaction`
--

INSERT INTO `actualtransaction` (`TransactionID`, `BudgetPlanID`, `CategoryID`, `TransactionDate`, `TransactionType`, `TransactionDesc`, `TransactionAmount`, `TransactionDescImg`) VALUES
(1, 1, 2, '2020-04-23', 'Expenses', 'Grocery ', 100, NULL),
(2, 2, 6, '2020-03-26', 'Expenses', 'Buy Table and Chair', 900, NULL),
(3, 2, 6, '2020-04-01', 'Expenses', 'Buy table and chair ', 900, NULL),
(4, 1, 1, '2020-04-07', 'Income', 'salary', 3000, NULL),
(5, 1, 3, '2020-04-15', 'Expenses', 'Going to work only', 50, NULL),
(6, 2, 4, '2020-04-01', 'Income', 'salary', 2500, NULL),
(7, 2, 5, '2020-04-01', 'Income', 'salary', 3000, NULL),
(8, 3, 7, '2020-04-07', 'Income', 'Full Time', 5000, NULL),
(9, 3, 9, '2020-04-02', 'Expenses', 'Grocery', 30, NULL),
(10, 3, 10, '2020-04-15', 'Expenses', 'Car', 200, NULL),
(11, 4, 13, '2020-04-06', 'Expenses', NULL, 119.97, NULL),
(12, 4, 12, '2020-04-01', 'Income', 'Add OT', 3100, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `BudgetID` int(11) NOT NULL,
  `BudgetPlanID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `BudgetMonth` varchar(12) NOT NULL,
  `BudgetType` varchar(11) NOT NULL,
  `BudgetDesc` varchar(500) DEFAULT NULL,
  `BudgetAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`BudgetID`, `BudgetPlanID`, `CategoryID`, `BudgetMonth`, `BudgetType`, `BudgetDesc`, `BudgetAmount`) VALUES
(1, 1, 2, '2020-04', 'Expenses', 'Cook In Home', 1500),
(2, 1, 3, '2020-04', 'Expenses', 'Use public transport ', 100),
(7, 2, 6, '2020-04', 'Expenses', 'Buy furniture ', 1000),
(8, 2, 5, '2020-04', 'Income', '', 2000),
(9, 2, 4, '2020-04', 'Income', '', 1000),
(10, 3, 7, '2020-04', 'Income', '', 5000),
(11, 3, 9, '2020-04', 'Expenses', '', 1000),
(12, 3, 8, '2020-04', 'Income', 'Part time', 500),
(13, 3, 10, '2020-04', 'Expenses', '', 500),
(15, 4, 13, '2020-04', 'Expenses', 'Family Dinner', 200),
(16, 4, 12, '2020-04', 'Income', '', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `budgetplan`
--

CREATE TABLE `budgetplan` (
  `BudgetPlanID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TeamID` int(11) DEFAULT NULL,
  `BudgetTitle` varchar(255) NOT NULL,
  `BudgetPlanImg` varchar(255) DEFAULT NULL,
  `BudgetPlanStatus` tinyint(1) NOT NULL DEFAULT 0,
  `BudgetPlanCreatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budgetplan`
--

INSERT INTO `budgetplan` (`BudgetPlanID`, `UserID`, `TeamID`, `BudgetTitle`, `BudgetPlanImg`, `BudgetPlanStatus`, `BudgetPlanCreatedDate`) VALUES
(1, 2, NULL, 'Personal Budget Plan', NULL, 0, '2020-04-16 23:20:47'),
(2, 2, 1, 'Family Tan Budget Plan', NULL, 0, '2020-04-16 23:20:47'),
(3, 4, NULL, 'KianPeng Budget Plan', NULL, 0, '2020-04-16 23:20:47'),
(4, 5, NULL, 'Celine Personal Budget', NULL, 0, '2020-04-16 23:20:47'),
(5, 2, NULL, 'Test', NULL, 1, '2020-04-16 23:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `BudgetPlanID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CategoryType` varchar(255) NOT NULL,
  `CategoryStatus` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `BudgetPlanID`, `CategoryName`, `CategoryType`, `CategoryStatus`) VALUES
(1, 1, 'Full Time Job', 'Income', 0),
(2, 1, 'Food', 'Expenses', 0),
(3, 1, 'Transport', 'Expenses', 0),
(4, 2, 'Alice Salary', 'Income', 0),
(5, 2, 'Alan Salary', 'Income', 0),
(6, 2, 'Furniture', 'Expenses', 0),
(7, 3, 'Salary', 'Income', 0),
(8, 3, 'Grab', 'Income', 0),
(9, 3, 'Food', 'Expenses', 0),
(10, 3, 'Transport', 'Expenses', 0),
(11, 3, 'Hospial', 'Expenses', 0),
(12, 4, 'Salary', 'Income', 0),
(13, 4, 'Food', 'Expenses', 0),
(14, 5, 'Food', 'Expenses', 0),
(15, 5, 'Full Time', 'Income', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FeedbackDesc` text NOT NULL,
  `FeedbackDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `UserID`, `FeedbackDesc`, `FeedbackDate`, `Rating`) VALUES
(1, 2, 'Good Design', '2020-04-12 17:27:07', 5),
(2, 3, 'Functional System', '2020-04-12 17:30:03', 4),
(3, 4, 'Good System! Help me a lot i will recommend my friend to use it !', '2020-04-12 17:51:49', 5),
(4, 5, 'Nice', '2020-04-12 17:59:26', 5);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `ReplyID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FeedbackID` int(11) NOT NULL,
  `ReplyDesc` varchar(500) NOT NULL,
  `ReplyDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`ReplyID`, `UserID`, `FeedbackID`, `ReplyDesc`, `ReplyDate`) VALUES
(1, 4, 1, '+1', '2020-04-12 17:49:02'),
(2, 4, 2, 'Yes! this system let met save a lot money in the month. ', '2020-04-12 17:49:58'),
(3, 1, 3, 'Thank you very much', '2020-04-12 18:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `TeamID` int(11) NOT NULL,
  `TeamName` varchar(255) NOT NULL,
  `TeamType` varchar(255) NOT NULL,
  `TeamDesc` text NOT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `TeamStatus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`TeamID`, `TeamName`, `TeamType`, `TeamDesc`, `CreateDate`, `TeamStatus`) VALUES
(1, 'Tan Family Budget Plan', 'Family', 'Save Money ! \r\nBuy Big House !!\r\nWe Can Do It !!!', '2020-04-12 16:59:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `User_Birthday` date NOT NULL,
  `UserGender` varchar(255) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `UserRole` tinyint(1) NOT NULL DEFAULT 0,
  `UserImg` varchar(255) DEFAULT NULL,
  `UserStatus` tinyint(1) NOT NULL DEFAULT 0,
  `ResetToken` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `UserEmail`, `User_Birthday`, `UserGender`, `UserPassword`, `UserRole`, `UserImg`, `UserStatus`, `ResetToken`) VALUES
(1, 'admin', 'admin@hotmail.com', '2020-01-07', 'Male', '$2y$10$I133BXXOnHyFPpVWMUr7BeAghlm2LA79vzdpZbiGs7/4r0wXDXxU6', 0, NULL, 0, NULL),
(2, 'Alan Tan', 'alantan@gmail.com', '2020-04-07', 'Male', '$2y$10$y8hR6XUmAcoG3eDbU1vPbOihTrcY0HCZv9eWekn4Ez5cZyeO6i7Dy', 0, NULL, 0, NULL),
(3, 'Alice', 'AliceTan@gmail.com', '2020-04-12', 'Female', '$2y$10$hUo6gPMNg.MvR0dBe0XeF.JStgG8uMLEy6pq45ZNSOpQ9Y/1D8CTu', 0, NULL, 0, NULL),
(4, 'KianPeng', 'Kianpeng@gmail.com', '2020-04-01', 'Male', '$2y$10$Psr3KhZ7Bw9ZZoWDH2kx6uypTtjQrT3tvWWR0BQTNq7wdE6AoWa6i', 0, NULL, 0, NULL),
(5, 'Celine', 'Celine@gmail.com', '2020-04-01', 'Female', '$2y$10$WjhfbreXsLrCudo7237Y6uomeA9XzBPautfuTsvqigeU9/Vybvlue', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userteamroles`
--

CREATE TABLE `userteamroles` (
  `UserID` int(11) NOT NULL,
  `TeamID` int(11) NOT NULL,
  `UserRole` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userteamroles`
--

INSERT INTO `userteamroles` (`UserID`, `TeamID`, `UserRole`) VALUES
(2, 1, 1),
(3, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actualtransaction`
--
ALTER TABLE `actualtransaction`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `BudgetPlanID` (`BudgetPlanID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`BudgetID`),
  ADD KEY `BudgetPlanID` (`BudgetPlanID`),
  ADD KEY `CategotyID` (`CategoryID`);

--
-- Indexes for table `budgetplan`
--
ALTER TABLE `budgetplan`
  ADD PRIMARY KEY (`BudgetPlanID`),
  ADD KEY `TeamID` (`TeamID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`),
  ADD KEY `BudgetPlanID` (`BudgetPlanID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`ReplyID`),
  ADD KEY `FeedbackID` (`FeedbackID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`TeamID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `userteamroles`
--
ALTER TABLE `userteamroles`
  ADD PRIMARY KEY (`UserID`,`TeamID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `TeamID` (`TeamID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actualtransaction`
--
ALTER TABLE `actualtransaction`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `BudgetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `budgetplan`
--
ALTER TABLE `budgetplan`
  MODIFY `BudgetPlanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `ReplyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `TeamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actualtransaction`
--
ALTER TABLE `actualtransaction`
  ADD CONSTRAINT `actualtransaction_ibfk_1` FOREIGN KEY (`BudgetPlanID`) REFERENCES `budgetplan` (`BudgetPlanID`),
  ADD CONSTRAINT `actualtransaction_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`BudgetPlanID`) REFERENCES `budgetplan` (`BudgetPlanID`) ON DELETE CASCADE,
  ADD CONSTRAINT `budget_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `budgetplan`
--
ALTER TABLE `budgetplan`
  ADD CONSTRAINT `budgetplan_ibfk_1` FOREIGN KEY (`TeamID`) REFERENCES `team` (`TeamID`) ON DELETE CASCADE,
  ADD CONSTRAINT `budgetplan_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`BudgetPlanID`) REFERENCES `budgetplan` (`BudgetPlanID`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`FeedbackID`) REFERENCES `feedback` (`FeedbackID`),
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `userteamroles`
--
ALTER TABLE `userteamroles`
  ADD CONSTRAINT `TeamID` FOREIGN KEY (`TeamID`) REFERENCES `team` (`TeamID`) ON DELETE CASCADE,
  ADD CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
