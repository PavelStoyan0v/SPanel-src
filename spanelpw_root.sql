-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2018 at 12:17 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spanelpw_root`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class` varchar(130) NOT NULL,
  `numberOfStudent` varchar(130) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `fName` varchar(150) DEFAULT NULL,
  `specialty` varchar(110) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pass`
--

CREATE TABLE `pass` (
  `id` int(111) NOT NULL,
  `name` varchar(160) NOT NULL,
  `fName` varchar(160) NOT NULL,
  `email` varchar(160) NOT NULL,
  `pass` varchar(160) NOT NULL,
  `phone` int(160) NOT NULL,
  `school` varchar(160) NOT NULL,
  `db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(111) NOT NULL,
  `name` varchar(211) NOT NULL,
  `fName` varchar(211) NOT NULL,
  `email` varchar(211) NOT NULL,
  `pass` varchar(211) NOT NULL,
  `school` varchar(211) NOT NULL,
  `db` varchar(211) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `fName`, `email`, `pass`, `school`, `db`) VALUES
(1, 'Драго', 'Малфлоит', 'drago@gmail.com', '21212112', 'ГПЧЕ', ''),
(2, 'Недялко', 'Геаоргиев', 'georgiew@gmail.com', '21212112', 'ГПЧЕ', ''),
(3, 'Иван', 'Киилов', 'ivancho343@gmail.com', '21212112', 'ГПЧЕ', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(130) NOT NULL,
  `fName` varchar(130) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(110) DEFAULT NULL,
  `phone` varchar(110) DEFAULT NULL,
  `subject` varchar(110) DEFAULT NULL,
  `classTeacher` varchar(110) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(112) NOT NULL,
  `name` varchar(111) NOT NULL,
  `fName` varchar(110) NOT NULL,
  `email` varchar(110) NOT NULL,
  `pass` varchar(110) NOT NULL,
  `school` varchar(112) NOT NULL,
  `db` varchar(133) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `fName`, `email`, `pass`, `school`, `db`) VALUES
(1, 'Ижана', 'Драгоева', 'icandragoev@gmail.coma', '$2y$12$csOXqhTsnwk2lnI7.FGvOuazOVdRulpMrObUVryMth43lSGKwNqQa', '????', ''),
(2, 'Ижанаa', 'Драгоеваa', 'icandragoev@gmail.comaa', '$2y$12$NuGDQu2jcaclVKt4dy01zehoCfVH3w4BhVXnr08chDGgi2m2HSvCK', 'ГПЧЕ', ''),
(3, 'Иван', 'Пичев', 'ivanchov@gmail.com', '$2y$12$SmBVllJfdY4c0ToQsFMDT.GCHZJjI0pIHzBEP6xMNG8dOKDkLypZK', 'ГПЧЕ', ''),
(4, 'Иван', 'Пичев', 'ivanchov@gmail.com', '$2y$12$zM75c/YwPfhbmuXhQfsKaefz2AQWAtwAOiq0rIqCXLtKzYLrSUWJq', 'ГПЧЕ', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(160) NOT NULL,
  `fName` varchar(160) NOT NULL,
  `email` varchar(160) NOT NULL,
  `pass` varchar(160) NOT NULL,
  `phone` varchar(160) NOT NULL,
  `address` varchar(200) NOT NULL DEFAULT 'not specified',
  `school` varchar(160) NOT NULL,
  `db` varchar(111) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `fName`, `email`, `pass`, `phone`, `address`, `school`, `db`, `admin`) VALUES
(51, 'Pavel', 'Stoyanov', 'pavelstoyanovdev@gmail.com', '$2y$12$5gj3H3h/hPbWgZZ54AtQOe2j1sFltriBBdN8oPm7hrCGh.E64SOn.', '0896129441', 'not specified', 'Software University', 'user_51', 1),
(57, 'Georgi', 'Dimitrov', 'asd@asd.asd', '123456', '1353253253', 'not specified', 'Software Uni', 'user_57', 0),
(58, 'admin', 'admin', 'admin', '$2y$10$HyFkT5C.ISZdPTnHRQP6BeY3sxMvBTmjkPPMmnqJagqiv3TZPdPEy', '0894393801', 'not specified', 'Mg', 'spanelpw_user_58', 1),
(158, 'asdasdsadasd', 'sdasdasdasdasds', 'az2363sss4@gmail.com', '21212112asdasd', '089565653355323', 'not specified', '', 'spanelpw_user_58', 0),
(159, 'Недко', 'Димитов', 'a22z23634@gcgmail.com', '$2y$10$6UPvMF6Kd2QsYxtlNwrOs..3IdTX8/Sj0wfIRjrOHI8l/.ShQu7LW', '089455654325', 'not specified', '', 'spanelpw_user_58', 0),
(160, 'Ivan', 'Georgiev', 'goshko54@gmail.com', '$2y$10$HIL5rAuJd56SMD2lQFt8N.2I2.9O6znqcDc/tvKVcrbsaw4VhSXTK', '0856545121542', 'not specified', '', 'spanelpw_user_58', 0),
(172, 'Ивайло', 'Домбев', 'dombev@gmail.com', '$2y$10$jHcc2xFZ6QI/7wNrOv83m.NkvLsn7qPZy8sHd46IR7O.t3whwe7UG', '0894393851', 'not specified', '', 'spanelpw_user_58', 0),
(174, 'asdas', 'asdasdas', 'assdadasdasdd', '$2y$10$EMdWnsey81q9y146xCi/luapZ.9kPgYdEFV0WzG.XkewDcrf17WyW', '2364567854', 'not specified', '', 'spanelpw_user_58', 0),
(175, 'fdsfddd', 'fdsdddf', 'az215433@gmil.com', '$2y$10$YOEh44VZrGo9qKZf0l76ZuWTegYoZ5Jf8Vwh6HgGJCZrh7JFa6Um6', '1234567890', 'not specified', '', 'spanelpw_user_58', 0),
(176, 'Dilqna', 'Petrova', 'az23634@gmail.com', '$2y$10$4OI8W/z6WBHqPXgxIr7wxeyIIeK6RQ/x.YKVYC5Sl5s8WlH3ojTLi', '0894562345', 'not specified', '', 'spanelpw_user_58', 0),
(179, 'Иван', 'Червенски', 'ivan@gmail.com', '$2y$10$iu5/DWYWTrGYazN5OwLtXumIP2FT18DddxMptCQF1y5X0n/uBx0nW', '0894562547', 'not specified', '', 'spanelpw_user_58', 0),
(180, 'Героги', 'Стоилов', 'georgi@spanel.pw', '$2y$10$s8zYs4AVLA3aEAfCMRSJcuzao/8D8eattdCu1.D8yiZGeELpbLlGa', '0894567894', 'not specified', '', 'spanelpw_user_58', 0),
(181, 'Иван', 'Георгиев', 'ivan@spanel.pw', '$2y$10$O0MW3J4S/ZUspWBwbZI2fe0BPNMwGv/Q3A67sALx1Az.dE3frcKSi', '0894568954', 'not specified', '', 'spanelpw_user_58', 0),
(182, 'Иван', 'Петров', 'petrov@spanel.pw', '$2y$10$BiZ/oC4jF3VO3uFR3OHmQO3slIir9/aryJXDLGBctkPLbwDVTVCw6', '0894567592', 'not specified', '', 'spanelpw_user_58', 0),
(186, 'Иван', 'Стоичев', 'ivanstoychev@spanel.pw', '$2y$10$39WbtTLQZpx13NFwcxvehuqoEg1exct6ss6s6bhqjmY/4v/Pb0avm', '0894567854', 'not specified', '', 'spanelpw_user_58', 0),
(190, 'Гинка', 'Върбанова', 'ginka@spanel.pw', '$2y$10$bHKYsXp0hi5s9PaI7smNJuruQuxZZC3L0cdEfIqGqlNxmtCq28xte', '0894561758', 'not specified', '', 'spanelpw_user_58', 0),
(191, 'sadsdas', 'dasdasdasa', 'adadad@spanel.pw', '$2y$10$Bslu.sI5MAjmeFBKePPole3Jjp5dyuCNaor7WH2B.6ro6p0W5tN2K', '0894567824', 'not specified', '', 'spanelpw_user_58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_`
--

CREATE TABLE `user_` (
  `name` varchar(130) NOT NULL,
  `fName` varchar(130) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(110) DEFAULT NULL,
  `phone` varchar(110) DEFAULT NULL,
  `subject` varchar(110) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pass`
--
ALTER TABLE `pass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pass`
--
ALTER TABLE `pass`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(112) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
