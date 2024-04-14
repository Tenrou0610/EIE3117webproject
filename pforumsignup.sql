-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-04-14 19:09:24
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `pforumsignup`
--

-- --------------------------------------------------------

--
-- 資料表結構 `chatgroup`
--

CREATE TABLE `chatgroup` (
  `group_id` int(200) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `poster_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `chatgroup`
--

INSERT INTO `chatgroup` (`group_id`, `title`, `description`, `poster_id`) VALUES
(2, 'First post!!!', 'This is the first post of the webpage!', 15),
(3, '2 nd post', '121', 15),
(4, 'Sunday', 'Hello everyone!', 17),
(5, 'Hello guys!', '4', 18),
(6, 'Hello guys!', 'Hello! I am Monday!', 19),
(7, 'Hello!', 'Hello! I am Tuesday!', 20),
(8, 'Hello guys!', 'Hello I am Thursday!', 21);

-- --------------------------------------------------------

--
-- 資料表結構 `groupmember`
--

CREATE TABLE `groupmember` (
  `member_id` int(30) NOT NULL,
  `group_id` int(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `nickname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `groupmember`
--

INSERT INTO `groupmember` (`member_id`, `group_id`, `title`, `description`, `user_id`, `nickname`) VALUES
(18, 2, 'First post!!!', 'This is the first post of the webpage!', 15, 'Zeus'),
(19, 3, '2 nd post', '121', 15, 'Zeus'),
(20, 3, '2 nd post', '121', 10, 'John'),
(21, 4, 'Sunday', 'Hello everyone!', 17, 'Happy'),
(23, 5, 'Hello guys!', '4', 15, 'Zeus'),
(25, 5, 'Hello guys!', '4', 18, 'Sunday'),
(26, 6, 'Hello guys!', 'Hello! I am Monday!', 18, 'Sunday'),
(27, 7, 'Hello!', 'Hello! I am Tuesday!', 20, 'Tuesday'),
(29, 4, 'Sunday', 'Hello everyone!', 18, 'Sunday'),
(30, 8, 'Hello guys!', 'Hello I am Thursday!', 21, 'Thursday'),
(31, 8, 'Hello guys!', 'Hello I am Thursday!', 18, 'Sunday'),
(32, 5, 'Hello guys!', '4', 21, 'Thursday'),
(33, 6, 'Hello guys!', 'Hello! I am Monday!', 21, 'Thursday'),
(34, 8, 'Hello guys!', 'Hello I am Thursday!', 15, 'Zeus');

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `message_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `posted_at` timestamp(5) NOT NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `message`
--

INSERT INTO `message` (`message_id`, `user_id`, `nickname`, `group_id`, `content`, `posted_at`) VALUES
(29, 15, 'Zeus', 3, '123', '2024-03-10 01:21:13.00000'),
(30, 15, 'Zeus', 3, '123', '2024-03-10 08:22:27.00000'),
(31, 10, 'John', 3, '123', '2024-03-10 08:31:33.00000'),
(32, 17, 'Happy', 4, 'First comment!', '2024-03-10 09:37:21.00000'),
(33, 18, 'Sunday', 5, 'first comment!', '2024-03-10 09:48:00.00000'),
(34, 15, 'Zeus', 5, 'Hello!', '2024-03-10 09:48:40.00000'),
(35, 19, 'Monday', 6, 'First Comment!', '2024-03-10 09:56:48.00000'),
(36, 18, 'Sunday', 6, 'Hello!', '2024-03-10 09:57:38.00000'),
(37, 20, 'Tuesday', 7, 'Hello guys!', '2024-03-10 10:05:24.00000'),
(38, 18, 'Sunday', 7, 'Hello!', '2024-03-10 10:06:00.00000'),
(39, 21, 'Thursday', 8, 'First Comment! Hello!', '2024-03-10 10:14:56.00000'),
(40, 18, 'Sunday', 8, 'Hello Thursday!', '2024-03-10 10:15:50.00000'),
(41, 15, 'Zeus', 2, 'Hi', '2024-03-23 08:58:22.00000'),
(42, 15, 'Zeus', 3, '1', '2024-03-23 09:48:00.00000'),
(43, 15, 'Zeus', 2, '1', '2024-03-23 09:48:00.00000'),
(44, 15, 'Zeus', 8, '2212121', '2024-04-14 15:26:25.00000');

-- --------------------------------------------------------

--
-- 資料表結構 `registration`
--

CREATE TABLE `registration` (
  `id` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profileimage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `registration`
--

INSERT INTO `registration` (`id`, `username`, `password`, `nickname`, `email`, `profileimage`) VALUES
(1, 'Carrie1', '$2y$10$0LiS1zOCU3J1umMR5YmI6.nr6eQLFb2GjOqkk9/PV6H/anPU/pRWq', 'Carrielam', 'Carrielam123@gmail.com', 'userimage/default.jpg'),
(8, 'Peterhui123', '$2y$10$hEeJaaiS8sv84d.hfqB0NOXOMOip7Vfw7aVRRY5/efYoZZt0YXJ7S', 'Peterhui', 'Peterhui123@gmail.com', 'userimage/default.jpg'),
(9, 'Audi1234', '$2y$10$wlFnLZyVHej2u1ZATsFnFupmAuKaBo0cnndWA25Hc3g0dBp.gm46C', 'Audi', 'Audi1234@gmail.com', 'userimage/default.jpg'),
(10, 'John123', '$2y$10$c.p0myOSTPNRz4W86SHIK.6jJaihHVZHZAMTLIZ1kjx9w8xWBgByy', 'John', 'John123@gmail.com', 'userimage/default.jpg'),
(11, 'Mary123', '$2y$10$TyzF4y5kulQ/iG4X2RweLOgaRACSlkHwSpRWYP1kZbtlkaq1Ld6kG', 'MaryLee', 'Mary123@gmail.com', 'userimage/default.jpg'),
(12, 'Henry123', '$2y$10$Avawf74DGwz5/x/U7YQmkud/Q0pJ5YuxWqqyHfmDenu4nqlxnl5Li', 'HenryHui', 'Henry123@gmail.com', 'userimage/default.jpg'),
(13, 'Faker123', '$2y$10$nrnXcdUwIxQ6087d3loHje6kkJ/73TNeqKjPZx7548yxfy36ZxTY2', 'Faker', 'Faker123@gmail.com', 'userimage/default.jpg'),
(14, 'kiin123', '$2y$10$ZkWt8SAmHBXANHDtxxEGK.1UavV0Goj7DlvQrN39.fMJZhaov9cc6', 'KiinLee', 'Kiin123@gmail.com', 'userimage/default.jpg'),
(15, 'Zeus123', '$2y$10$mWBVrA07CCp5xUM/AO0dHuFaBvgof.1fRgtTVUvmJvZeGfjzfx11S', 'Zeus', 'Zeus123@gmail.com', 'userimage/IMG-65ec3104244db3.22720391.png'),
(16, 'User123', '$2y$10$LHjAk3JzxstvnzL93.mNi.iuLzzbzmtVAwtOA3UBUA5ZfHNqaU2cm', 'User', 'User123@gmail.com', 'userimage/default.jpg'),
(17, 'Happy123', '$2y$10$6eHTZGW0xyZSHyHLWb5r7e.Xp/tih4diUVnLZxc9JfyUC4YL1lz6S', 'Happy', 'Happy123@gmail.com', 'userimage/IMG-65ed7ef4a1f4e2.52682105.png'),
(18, 'Sunday123', '$2y$10$ZqnsV917c6gz1gLqktBtZu32aLljgaYwuTasppwkpRO/1snW2nZQu', 'Sunday', 'Sunday123@gmail.com', 'userimage/IMG-65ed8137aa0700.48564318.png'),
(19, 'Monday123', '$2y$10$F5jxUuOwOah3bDFxZNShgurWdO4alyN5sQl.gikEd73KCEyxXwNuu', 'Monday', 'Monday123@gmail.com', 'userimage/IMG-65ed837629c127.17880502.png'),
(20, 'Tuesday123', '$2y$10$A/kNfuWW/EqwuzsxgBL4yOxkuh4cZSGXQirdQojyhcQLF2RNSd8Ii', 'Tuesday', 'Tuesday123@gmail.com', 'userimage/IMG-65ed853da14bf2.41953880.jpg'),
(21, 'Thursday123', '$2y$10$.fBEBpVLnfKY3sI2y0J8nOyoePsog3I5twJSZuv5kS4ByDSMA/Z7O', 'Thursday', 'Thursday123@gmail.com', 'userimage/IMG-65ed87806ea588.09380174.jpg');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `chatgroup`
--
ALTER TABLE `chatgroup`
  ADD PRIMARY KEY (`group_id`);

--
-- 資料表索引 `groupmember`
--
ALTER TABLE `groupmember`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `unique_group_user` (`group_id`,`user_id`);

--
-- 資料表索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- 資料表索引 `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `chatgroup`
--
ALTER TABLE `chatgroup`
  MODIFY `group_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `groupmember`
--
ALTER TABLE `groupmember`
  MODIFY `member_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `chatgroup`
--
ALTER TABLE `chatgroup`
  ADD CONSTRAINT `chatgroup_ibfk_1` FOREIGN KEY (`poster_id`) REFERENCES `registration` (`id`);

--
-- 資料表的限制式 `groupmember`
--
ALTER TABLE `groupmember`
  ADD CONSTRAINT `groupmember_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `chatgroup` (`group_id`),
  ADD CONSTRAINT `groupmember_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `registration` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
