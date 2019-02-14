-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 02 2019 г., 08:29
-- Версия сервера: 8.0.14
-- Версия PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shopdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comp`
--

CREATE TABLE IF NOT EXISTS `comp` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cost` float DEFAULT '0',
  `name` varchar(50) DEFAULT 'PRODUCT',
  `count` int(11) DEFAULT '0',
  `case_id` int(11) DEFAULT '0',
  `cpu_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cpu_id` (`cpu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cpu`
--

CREATE TABLE IF NOT EXISTS `cpu` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `frequency` int(10) UNSIGNED DEFAULT NULL COMMENT 'частота процессора',
  `weight` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'вес',
  `cost` int(10) UNSIGNED DEFAULT NULL COMMENT 'цена',
  `count` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'кол-во',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'unnamed' COMMENT 'имя',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comp`
--
ALTER TABLE `comp`
  ADD CONSTRAINT `comp_cpu` FOREIGN KEY (`cpu_id`) REFERENCES `cpu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
