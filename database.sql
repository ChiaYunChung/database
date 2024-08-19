-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-12-27 16:39:12
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `database`
--

-- --------------------------------------------------------

--
-- 資料表結構 `family`
--

CREATE TABLE `family` (
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `family`
--

INSERT INTO `family` (`name`) VALUES
('a'),
('b'),
('c'),
('d'),
('g'),
('h');

-- --------------------------------------------------------

--
-- 資料表結構 `f_relation`
--

CREATE TABLE `f_relation` (
  `nid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `f_relation`
--

INSERT INTO `f_relation` (`nid`, `fname`) VALUES
(10, 'a'),
(10, 'b'),
(10, 'c'),
(10, 'g'),
(10, 'h');

-- --------------------------------------------------------

--
-- 資料表結構 `noun`
--

CREATE TABLE `noun` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `exp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `noun`
--

INSERT INTO `noun` (`id`, `value`, `exp`) VALUES
(6, '456', '......'),
(7, '567', '222222'),
(8, '678', 'OSososos'),
(10, 'dog', '狗'),
(11, 'cat', '貓咪');

-- --------------------------------------------------------

--
-- 資料表結構 `tag`
--

CREATE TABLE `tag` (
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `tag`
--

INSERT INTO `tag` (`name`) VALUES
('DB'),
('OS'),
('演化'),
('網際網路'),
('軟工');

-- --------------------------------------------------------

--
-- 資料表結構 `t_relation`
--

CREATE TABLE `t_relation` (
  `tname` varchar(50) NOT NULL,
  `nid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `t_relation`
--

INSERT INTO `t_relation` (`tname`, `nid`) VALUES
('OS', 6),
('OS', 7),
('OS', 8),
('OS', 10),
('演化', 11),
('網際網路', 10),
('網際網路', 11),
('軟工', 10);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`name`);

--
-- 資料表索引 `f_relation`
--
ALTER TABLE `f_relation`
  ADD PRIMARY KEY (`nid`,`fname`),
  ADD KEY `fname` (`fname`);

--
-- 資料表索引 `noun`
--
ALTER TABLE `noun`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`name`);

--
-- 資料表索引 `t_relation`
--
ALTER TABLE `t_relation`
  ADD PRIMARY KEY (`tname`,`nid`),
  ADD KEY `nid` (`nid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `noun`
--
ALTER TABLE `noun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `f_relation`
--
ALTER TABLE `f_relation`
  ADD CONSTRAINT `f_relation_ibfk_1` FOREIGN KEY (`fname`) REFERENCES `family` (`name`),
  ADD CONSTRAINT `f_relation_ibfk_2` FOREIGN KEY (`nid`) REFERENCES `noun` (`id`);

--
-- 資料表的限制式 `t_relation`
--
ALTER TABLE `t_relation`
  ADD CONSTRAINT `t_relation_ibfk_1` FOREIGN KEY (`nid`) REFERENCES `noun` (`id`),
  ADD CONSTRAINT `t_relation_ibfk_2` FOREIGN KEY (`tname`) REFERENCES `tag` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
