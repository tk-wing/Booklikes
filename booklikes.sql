-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018 年 11 月 22 日 06:59
-- サーバのバージョン： 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booklikes`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, '文学・小説'),
(2, '社会・ビジネス'),
(3, '旅行・地図'),
(4, '趣味'),
(5, '実用・教育'),
(6, 'アート・教養・エンタメ'),
(7, '事典・図鑑・語学・辞書'),
(8, 'こども'),
(9, 'その他');

-- --------------------------------------------------------

--
-- テーブルの構造 `feeds`
--

CREATE TABLE `feeds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `like_count` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `feeds`
--

INSERT INTO `feeds` (`id`, `user_id`, `category_id`, `title`, `comment`, `img_name`, `like_count`, `created`, `updated`) VALUES
(1, 22, 6, '海', '海の写真集', '20181120014125ocean1.jpg', 0, '2018-11-20 08:40:04', '2018-11-20 00:41:25'),
(2, 24, 5, 'English Grammar in USE', 'this is GOOD!', '20181120091852ocean1.jpg', 0, '2018-11-20 16:18:52', '2018-11-20 08:18:52'),
(3, 24, 1, ' TOEIC', 'o', '20181120092024eigo1.jpg', 0, '2018-11-20 16:20:24', '2018-11-20 08:20:24');

-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `feed_id`) VALUES
(1, 22, 1),
(3, 23, 2),
(4, 23, 1),
(5, 24, 2),
(6, 24, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `comment` text,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `nickname`, `comment`, `created`, `updated`) VALUES
(1, 22, 'つーくん', '', '2018-11-20 08:39:18', '2018-11-20 00:41:16'),
(2, 23, 'かわえもん', '川東です。', '2018-11-20 12:24:54', '2018-11-20 04:24:54');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img_name`, `created`, `updated`) VALUES
(22, 'TSUBASA KUDO', 'tsubasa@gmail.com', '$2y$10$GE6eiSha2UzuPZuh.tqdGumuqf/qgeWznWWHrrUsQsgvSyjyEF7wO', '20181120014116profile.png', '2018-11-19 05:30:06', '2018-11-20 00:41:16'),
(23, '川東　勇介', 'kawaemon@gamil.com', '$2y$10$327gNBj2dqhD35BK3PLj2ejw/o7UWdurBwgXYJBvygFf4DYv/3gNy', '20181120052357download.jpg', '2018-11-20 12:23:58', '2018-11-20 04:23:58'),
(24, 'TSUBASA KUDO', 'tsubazou@yahoo.co.jp', '$2y$10$upzFZ1KjNWFZNZg1cwiyWeBgeI8l7qYhGPx6/gZ/SdNvFBk2jxNcS', '20181120091808profile.png', '2018-11-20 16:18:09', '2018-11-20 08:18:09'),
(25, 'TSUBASA KUDO', 'tsubasa@gmail.comm', '$2y$10$/54g7edonufDpfFN/W6va.T9HYE9QS5i8r5VrSncEwDvAHmErHk9e', '20181122065445profile.png', '2018-11-22 13:54:46', '2018-11-22 05:54:46');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_categories`
--

CREATE TABLE `user_categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `user_categories`
--

INSERT INTO `user_categories` (`id`, `user_id`, `category_id`, `created`, `updated`) VALUES
(1, 22, 0, '2018-11-20 08:39:18', '2018-11-20 00:41:16'),
(2, 23, 8, '2018-11-20 12:24:54', '2018-11-20 04:24:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feeds`
--
ALTER TABLE `feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_categories`
--
ALTER TABLE `user_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feeds`
--
ALTER TABLE `feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
