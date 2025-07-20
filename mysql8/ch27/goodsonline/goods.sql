-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-06-29 11:40:06
-- 服务器版本： 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goods`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `id` int(3) UNSIGNED NOT NULL,
  `user` varchar(30) NOT NULL,
  `pwd` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `user`, `pwd`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- 表的结构 `form`
--

CREATE TABLE `form` (
  `oid` int(255) UNSIGNED NOT NULL,
  `user` varchar(30) CHARACTER SET gb2312 NOT NULL,
  `leibie` int(1) NOT NULL,
  `name` varchar(20) CHARACTER SET gb2312 NOT NULL,
  `price` int(3) UNSIGNED NOT NULL,
  `num` int(3) UNSIGNED NOT NULL,
  `call` varchar(15) CHARACTER SET gb2312 NOT NULL,
  `address` text CHARACTER SET gb2312 NOT NULL,
  `ip` varchar(15) CHARACTER SET gb2312 NOT NULL,
  `btime` datetime NOT NULL,
  `addons` text CHARACTER SET gb2312 NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `form`
--

INSERT INTO `form` (`oid`, `user`, `leibie`, `name`, `price`, `num`, `call`, `address`, `ip`, `btime`, `addons`, `state`) VALUES
(1, '张峰', 1, '智能手表', 1299, 1, '1234567', '金水区创智大厦1221', '128.10.1.1', '2018-10-18 12:07:39', '尽快发货', 0),
(2, '天山', 5, '佳能单反套机', 8599, 1, '1231238', '东区创智大厦1261', '128.10.2.4', '2018-10-18 12:23:45', '无', 0),
(3, '风云', 3, '三星液晶显示器', 1200, 2, '2562569', '西区创智大厦1821', '128.10.0.1', '2018-10-18 12:55:47', '无', 0);

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE `product` (
  `cid` int(255) UNSIGNED NOT NULL,
  `cname` varchar(100) CHARACTER SET gb2312 NOT NULL,
  `cprice` int(3) UNSIGNED NOT NULL,
  `cspic` varchar(255) CHARACTER SET gb2312 DEFAULT NULL,
  `cpicpath` varchar(255) CHARACTER SET gb2312 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`cid`, `cname`, `cprice`, `cspic`, `cpicpath`) VALUES
(1, '智能手表', 1299, '', '101.png'),
(2, '台式风扇', 240, '', '102.png'),
(3, '三星液晶显示器', 1200, '', '103.png'),
(4, '惠普激光打印机', 850, '', '104.png'),
(5, '佳能单反套机', 8599, '', '105.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`cid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `form`
--
ALTER TABLE `form`
  MODIFY `oid` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `cid` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
