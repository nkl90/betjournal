-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 26 2019 г., 19:33
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
-- Структура таблицы `betjournal_author`
--

CREATE TABLE `betjournal_author` (
  `ID` int(11) NOT NULL,
  `Author_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_password` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `betjournal_author`
--

INSERT INTO `betjournal_author` (`ID`, `Author_name`, `username`, `user_password`) VALUES
(1, 'Долгушин Д. В.', '', ''),
(2, 'Лущак В. А.', '', ''),
(3, 'Либас А. А.', '', ''),
(4, 'Лобыкин Ю. В.', '', ''),
(5, 'Новиков', 'novikov', ''),
(6, 'Выберите автора', '', ''),
(8, 'lkl', 'llkl', 'jbjb'),
(9, 'ывп', 'ывпы', 'ыпып'),
(10, 'Dylan', 'dylan', '12345');

-- --------------------------------------------------------

--
-- Структура таблицы `betjournal_news`
--

CREATE TABLE `betjournal_news` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Short_description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `Content` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `Add_date` date DEFAULT NULL,
  `Edit_date` date DEFAULT NULL,
  `Views` int(11) DEFAULT NULL,
  `Author_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `betjournal_news`
--

INSERT INTO `betjournal_news` (`ID`, `Title`, `Short_description`, `Content`, `Add_date`, `Edit_date`, `Views`, `Author_ID`) VALUES
(1, 'Новость дня', 'Новость дня     ', 'News', '2019-06-27', '2019-07-26', NULL, 4),
(3, 'First', 'First', 'First', '2019-06-06', '2019-06-29', NULL, 1),
(7, 'Spring', 'Spring', 'Spring', '2019-07-03', '2019-07-18', NULL, 2),
(12, 'News1', 'News        ', 'News', '2019-07-14', '2019-07-14', 88, 2),
(34, 'today', 'today    ', 'gbkjk', '2019-07-18', '2019-07-26', 2, 3),
(36, 'g', 'h  ', 'j', '2019-07-19', '2019-07-26', NULL, 4),
(47, 'o', 'ljl  ', 'k', '2019-07-24', '2019-07-26', NULL, 1),
(53, 'ывмпыпвм', ' ', 'вмвы', '2019-07-26', '2019-07-26', NULL, 3),
(54, '', 'kjhnk', 'lknln', '2019-07-26', NULL, NULL, 8);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `betjournal_author`
--
ALTER TABLE `betjournal_author`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Индексы таблицы `betjournal_news`
--
ALTER TABLE `betjournal_news`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Author_ID` (`Author_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `betjournal_author`
--
ALTER TABLE `betjournal_author`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `betjournal_news`
--
ALTER TABLE `betjournal_news`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `betjournal_news`
--
ALTER TABLE `betjournal_news`
  ADD CONSTRAINT `betjournal_news_ibfk_1` FOREIGN KEY (`Author_ID`) REFERENCES `betjournal_author` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
