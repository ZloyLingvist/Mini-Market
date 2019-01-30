-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 30 2019 г., 11:28
-- Версия сервера: 10.1.36-MariaDB
-- Версия PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mini-market`
--

-- --------------------------------------------------------

--
-- Структура таблицы `greeds`
--

CREATE TABLE `greeds` (
  `Номер` int(11) NOT NULL,
  `Наименование` varchar(250) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `Цена(сум)` int(11) NOT NULL,
  `Производитель` varchar(250) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `Код отдела` int(11) NOT NULL,
  `Срок хранения (суток)` int(11) NOT NULL,
  `Кол-во в отделе(штук)` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `greeds`
--

INSERT INTO `greeds` (`Номер`, `Наименование`, `Цена(сум)`, `Производитель`, `Код отдела`, `Срок хранения (суток)`, `Кол-во в отделе(штук)`) VALUES
(1, 'мука', 10000, 'DANI-NAN-TASHKENT ДП', 4, 180, 20),
(7, 'хлеб', 1200, ' OCHIQ DIL ООО', 1, 2, 50),
(8, 'патыр', 2000, 'OCHIQ DIL ООО', 1, 4, 20),
(9, 'гель для мытья посуды ', 4400, 'Sharqona Hamkor Baraka,', 3, 365, 10),
(10, 'сервелат', 12000, 'Tegen', 7, 10, 15),
(11, 'пельмени домашние', 3500, 'Tegen', 4, 90, 20),
(12, 'докторская колбаса', 9800, 'Tegen', 7, 10, 15),
(13, 'шампунь Пантин', 13800, 'Sharqona Hamkor Baraka', 3, 730, 10),
(14, 'сигареты', 9000, ' PINE TABAK SAVDO ЧП', 2, 365, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `job`
--

CREATE TABLE `job` (
  `Номер` int(11) NOT NULL,
  `График` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `job`
--

INSERT INTO `job` (`Номер`, `График`) VALUES
(1, 'Каждый день'),
(2, 'Через 2 дня'),
(3, 'Через 3 дня'),
(4, '6:00-14:00'),
(5, '14:00-23:00'),
(6, '7:00-15:00');

-- --------------------------------------------------------

--
-- Структура таблицы `otdel`
--

CREATE TABLE `otdel` (
  `Номер` int(11) NOT NULL,
  `Отдел` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `otdel`
--

INSERT INTO `otdel` (`Номер`, `Отдел`) VALUES
(1, 'Хлеб и хлебобулочные изделия'),
(2, 'Табачные изделия'),
(3, 'Бытовая химия'),
(4, 'Бакалея'),
(5, 'Фрукты и овощи'),
(6, 'Товары для дома'),
(7, 'Мяcные и колбасные изделия');

-- --------------------------------------------------------

--
-- Структура таблицы `personal`
--

CREATE TABLE `personal` (
  `Номер` int(11) NOT NULL,
  `ФИО` text CHARACTER SET utf16 COLLATE utf16_bin,
  `Трудовой стаж (лет)` int(11) DEFAULT NULL,
  `Должность` text CHARACTER SET utf16 COLLATE utf16_bin,
  `Зарплата (сум)` int(11) DEFAULT NULL,
  `Возраст (лет)` int(11) NOT NULL,
  `Адрес` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `Телефон` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `personal`
--

INSERT INTO `personal` (`Номер`, `ФИО`, `Трудовой стаж (лет)`, `Должность`, `Зарплата (сум)`, `Возраст (лет)`, `Адрес`, `Телефон`) VALUES
(1, 'Ким Валентин Робертович', 18, 'Директор', 925000, 49, 'Узбекистан, Ташкент, ЯШНАБАДСКИЙ РАЙОН, ул. ОХАНГРАБО, 29', 715962345),
(3, 'Муминов Алишер Файзула Оглы', 2, 'Охранник', 420000, 25, 'Узбекистан, 100043, Ташкент, ЧИЛАНЗАРСКИЙ РАЙОН, ул. МУКИМИ, 4', 934563456),
(4, 'Юнусова Тамара Илхом Кызы', 28, 'Продавец', 600000, 47, 'Узбекистан, 100046, Ташкент, МИРАБАДСКИЙ РАЙОН, просп. АМИРА ТЕМУРА, 19', 935347862),
(5, 'Тожибаев Эркин Аскарович', 1, 'Продавец', 450000, 21, ' Узбекистан ТАШКЕНТ Яккасарайский район ул. Ш.РУСТАВЕЛИ, 63  ', 905453212),
(6, 'Русакова Наталья Леонидовна', 30, 'Товаровед', 725000, 62, 'Узбекистан, 100161, Ташкент, ЧИЛАНЗАРСКИЙ РАЙОН, пр. 2-й ЧОРБОГ, 12', 934123716),
(7, 'Пак Юрий Львович', 27, 'Продавец', 700000, 48, 'Узбекистан, 100017, Ташкент, ЮНУСАБАДСКИЙ РАЙОН, просп. АМИРА ТЕМУРА, 3', 907895432),
(8, 'Исраилова Мафтуна Иброхим Кызы', 7, 'Уборщица', 325000, 39, 'Узбекистан, Ташкент, МИРЗО-УЛУГБЕКСКИЙ РАЙОН, ул. ФЕРУЗА, 12/36', 938094167),
(9, 'Смирнов Иван Альбертович', 4, 'Охранник', 475000, 32, 'Узбекистан, Ташкент, МИРАБАДСКИЙ РАЙОН, ул. 8 МАРТА, 57', 906321234),
(10, 'Рузиева Гульнара Ходжабековна', 8, 'Продавец', 545000, 34, ' Узбекистан, Ташкент, АЛМАЗАРСКИЙ РАЙОН, ул. КИЧИК ХАЛКА ЙУЛИ, 76 А', 906789072);

-- --------------------------------------------------------

--
-- Структура таблицы `postavshik`
--

CREATE TABLE `postavshik` (
  `Номер` int(11) NOT NULL,
  `Поставщик` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `Дата поставки` date NOT NULL,
  `Юридический адрес` varchar(250) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `Телефон` int(11) NOT NULL,
  `Цена поставки(сум)` int(11) NOT NULL,
  `Оплачено(процент)` int(11) NOT NULL,
  `Поставлено товара(штук)` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `postavshik`
--

INSERT INTO `postavshik` (`Номер`, `Поставщик`, `Дата поставки`, `Юридический адрес`, `Телефон`, `Цена поставки(сум)`, `Оплачено(процент)`, `Поставлено товара(штук)`) VALUES
(1, 'DANI-NAN-TASHKENT ДП', '2018-12-19', 'Узбекистан, 100031, Ташкент, МИРАБАДСКИЙ РАЙОН, ул. АФРОСИАБ, 12 Б', 712527787, 100000, 75, 10),
(5, 'OCHIQ DIL ООО', '2019-01-30', 'Узбекистан ТАШКЕНТ Алмазарский ул. БЕРУНИ, 88  ', 712494409, 60000, 100, 50),
(6, ' AGROMIR GROUP СП ООО', '2019-01-10', ' AGROMIR GROUP СП ООО', 712345678, 200000, 75, 10),
(7, 'BADAL AGRO INVEST ООО', '2019-01-03', 'Узбекистан, Ташкент, МИРАБАДСКИЙ РАЙОН, ул. АБУ СУЛЕЙМАНА БАНОКАТИ, 186/1', 719786234, 30000, 100, 20),
(8, 'FAZLIDDIN-FAYZ BARAKA ', '2018-12-28', 'Узбекистан, 100080, Ташкент, ЯШНАБАДСКИЙ РАЙОН, ул. ИСТИКБОЛ, 45', 712347890, 712000, 50, 60),
(9, 'Tegen', '2019-01-20', 'Узбекистан, г.Ташкент, улица Инокобад, 10', 712834602, 397000, 85, 50),
(10, 'PINE TABAK SAVDO ЧП', '2019-01-24', 'Узбекистан, 100149, Ташкент, ЧИЛАНЗАРСКИЙ РАЙОН, ул. ГАВХАР, 44', 907895432, 12000, 100, 35),
(11, 'Sharqona Hamkor Baraka', '2019-01-16', 'Узбекистан, Ташкент, ЮНУСАБАДСКИЙ РАЙОН, м-в МИНОР, 77', 715678240, 120000, 100, 50);

-- --------------------------------------------------------

--
-- Структура таблицы `sales`
--

CREATE TABLE `sales` (
  `Номер` int(11) NOT NULL,
  `Дата продажи` date NOT NULL,
  `Количество(штук)` int(11) NOT NULL,
  `Код продавца` int(11) NOT NULL,
  `Код товара` int(11) NOT NULL,
  `Скидка (процент)` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `sales`
--

INSERT INTO `sales` (`Номер`, `Дата продажи`, `Количество(штук)`, `Код продавца`, `Код товара`, `Скидка (процент)`) VALUES
(18, '2019-01-30', 2, 4, 7, 0),
(19, '2019-01-19', 2, 3, 1, 0),
(20, '2019-01-20', 3, 5, 9, 5),
(21, '2019-01-29', 8, 3, 11, 3),
(23, '2019-01-02', 1, 3, 11, 0),
(24, '2019-01-29', 3, 4, 14, 0),
(25, '2019-01-29', 1, 5, 13, 3),
(26, '2019-01-29', 3, 3, 8, 0),
(27, '2019-01-31', 1, 5, 8, 0),
(28, '2019-01-31', 1, 4, 10, 0),
(29, '2019-01-31', 3, 6, 12, 1),
(30, '2019-01-29', 1, 4, 14, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `salesman`
--

CREATE TABLE `salesman` (
  `Номер` int(11) NOT NULL,
  `Код сотрудника` int(11) NOT NULL,
  `План по прибыли(сум/месяц)` int(11) NOT NULL,
  `График работы` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `Премия(процент от продаж)` int(11) NOT NULL,
  `Работа в магазине(лет)` int(11) NOT NULL,
  `Статус` text CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `salesman`
--

INSERT INTO `salesman` (`Номер`, `Код сотрудника`, `План по прибыли(сум/месяц)`, `График работы`, `Премия(процент от продаж)`, `Работа в магазине(лет)`, `Статус`) VALUES
(3, 5, 100000, '14:00-23:00', 5, 0, 'Стажер'),
(4, 4, 800000, 'Каждый день', 15, 12, 'Кассир-продавец'),
(5, 7, 800000, 'Каждый день', 15, 10, 'Старший продавец'),
(6, 10, 600000, '7:00-15:00', 10, 5, 'Младший продавец');

-- --------------------------------------------------------

--
-- Структура таблицы `sklad`
--

CREATE TABLE `sklad` (
  `Номер` int(11) NOT NULL,
  `Код товара` int(11) NOT NULL,
  `Код поставки` int(11) NOT NULL,
  `Номер стеллажа` int(11) NOT NULL,
  `Номер полки` int(11) NOT NULL,
  `Получил` int(11) NOT NULL,
  `На складе(штук)` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `sklad`
--

INSERT INTO `sklad` (`Номер`, `Код товара`, `Код поставки`, `Номер стеллажа`, `Номер полки`, `Получил`, `На складе(штук)`) VALUES
(1, 1, 1, 5, 100, 1, 30),
(8, 7, 5, 0, 0, 1, 0),
(9, 10, 9, 15, 42, 6, 8),
(10, 11, 9, 18, 1234, 6, 20),
(11, 12, 9, 15, 44, 1, 2),
(16, 14, 10, 13, 51, 1, 10);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `greeds`
--
ALTER TABLE `greeds`
  ADD PRIMARY KEY (`Номер`),
  ADD KEY `Код отдела` (`Код отдела`);

--
-- Индексы таблицы `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`Номер`);

--
-- Индексы таблицы `otdel`
--
ALTER TABLE `otdel`
  ADD PRIMARY KEY (`Номер`);

--
-- Индексы таблицы `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`Номер`);

--
-- Индексы таблицы `postavshik`
--
ALTER TABLE `postavshik`
  ADD PRIMARY KEY (`Номер`);

--
-- Индексы таблицы `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`Номер`),
  ADD KEY `Код товара` (`Код товара`),
  ADD KEY `Код продавца` (`Код продавца`);

--
-- Индексы таблицы `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`Номер`),
  ADD KEY `salesman_ibfk_2` (`Код сотрудника`);

--
-- Индексы таблицы `sklad`
--
ALTER TABLE `sklad`
  ADD PRIMARY KEY (`Номер`),
  ADD KEY `Получил` (`Получил`),
  ADD KEY `Код отдела` (`На складе(штук)`),
  ADD KEY `sklad_ibfk_2` (`Код товара`),
  ADD KEY `sklad_ibfk_3` (`Код поставки`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `greeds`
--
ALTER TABLE `greeds`
  MODIFY `Номер` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `job`
--
ALTER TABLE `job`
  MODIFY `Номер` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `otdel`
--
ALTER TABLE `otdel`
  MODIFY `Номер` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `personal`
--
ALTER TABLE `personal`
  MODIFY `Номер` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `postavshik`
--
ALTER TABLE `postavshik`
  MODIFY `Номер` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `sales`
--
ALTER TABLE `sales`
  MODIFY `Номер` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `salesman`
--
ALTER TABLE `salesman`
  MODIFY `Номер` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `sklad`
--
ALTER TABLE `sklad`
  MODIFY `Номер` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `greeds`
--
ALTER TABLE `greeds`
  ADD CONSTRAINT `greeds_ibfk_2` FOREIGN KEY (`Код отдела`) REFERENCES `otdel` (`Номер`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`Код товара`) REFERENCES `greeds` (`Номер`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`Код продавца`) REFERENCES `salesman` (`Номер`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `salesman`
--
ALTER TABLE `salesman`
  ADD CONSTRAINT `salesman_ibfk_2` FOREIGN KEY (`Код сотрудника`) REFERENCES `personal` (`Номер`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sklad`
--
ALTER TABLE `sklad`
  ADD CONSTRAINT `sklad_ibfk_2` FOREIGN KEY (`Код товара`) REFERENCES `greeds` (`Номер`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sklad_ibfk_3` FOREIGN KEY (`Код поставки`) REFERENCES `postavshik` (`Номер`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sklad_ibfk_4` FOREIGN KEY (`Получил`) REFERENCES `personal` (`Номер`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
