-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 14 2019 г., 19:06
-- Версия сервера: 8.0.15
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `betjournal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `betjournal_news`
--

CREATE TABLE `betjournal_news` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Short_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Update_date` date DEFAULT NULL,
  `Edit_date` date DEFAULT NULL,
  `Views` int(11) DEFAULT NULL,
  `Author_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `betjournal_news`
--

INSERT INTO `betjournal_news` (`ID`, `Title`, `Short_description`, `Content`, `Update_date`, `Edit_date`, `Views`, `Author_ID`) VALUES
(1, 'Новость дня', 'Новость дня', 'Новость дня', '2019-06-27', '2019-06-29', NULL, 2),
(3, 'First', 'First', 'First', '2019-06-06', '2019-06-29', NULL, 1),
(7, 'Spring', 'Spring', 'Spring', '2019-07-03', '2019-07-18', NULL, 2),
(12, 'News1', 'News        ', 'News', '2019-07-14', '2019-07-14', 88, 2),
(25, 'новость', 'новость      ', 'н', '2019-07-14', '2019-07-14', 114, 4),
(34, 'today', 'today  ', 'yesterday', '2019-07-14', '2019-07-14', 2, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `betjournal_news`
--
ALTER TABLE `betjournal_news`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `betjournal_news`
--
ALTER TABLE `betjournal_news`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
