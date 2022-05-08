-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 02 2021 г., 15:18
-- Версия сервера: 8.0.26
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ecoproduct`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'EKO1', '1945'),
(2, 'EKO2', '123'),
(3, 'EKO3', '111');

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE IF NOT EXISTS `basket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer` varchar(50) NOT NULL,
  `catalogid` int NOT NULL,
  `quantity` float NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `catalogid` (`catalogid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `customer`, `catalogid`, `quantity`, `datetime`) VALUES
(3, 'nv9vtarl3qlrd0ku0j2tsslnm0', 1, 1, '2021-04-13 00:47:14');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `typeid` int NOT NULL,
  `article` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `note` varchar(500) NOT NULL,
  `amount` int NOT NULL,
  `price` float NOT NULL,
  `discount` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `typeid` (`typeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 COMMENT='каталог спорт товаров' AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `typeid`, `article`, `name`, `note`, `amount`, `price`, `discount`) VALUES
(1, 6, '11-св', 'Авокадо спелый ~ 300 г', 'ЮАР. Если вы не любите авокадо, значит, вы просто еще не слышали, как он полезен. Клетчатка и полезные жиры этого фрукта, например, помогают худеть и поддерживать идеальный вес. Научно доказано, что ¼ спелого авокадо на обед помогает дольше чувствовать сытость и сократить калорийность дневного рациона – а значит, в перспективе сбросить накопленные благодаря сидячему образу жизни килограммы.', 3, 207, 10),
(2, 6, '22-св', 'Помидоры желтые сливка', 'Желтые помидоры, в отличии от красных, имеют более сладкую мякоть, поэтому идеально подходят для приготовления салатов и соусов, например, сальсы. Помимо высоких вкусовых качеств, такие томаты содержат в себе больше полезных веществ: ретинол, присутствующий в плодах, оказывает укрепляющее воздействие на кости, органы зрения и кожу. ', 13, 195, 0),
(3, 6, '25-св', 'Огурцы Бакинские светлые', 'Азербайджан, Бакинские огурцы визуально отличаются плотной кожицей с мелкими пупырышками и имеют в наличии такие витамины как: С, Р,А,В2. Их полезно употреблять как в сыром виде, так в соленом, салатном. Огурец бакинский небольшого размера, умеренно пупырчатый и хорошо хрустит.', 5, 425, 0),
(4, 6, 'са-33', 'Картофель белый молодой ', 'Натуральный молодой картофель не только содержит меньше крахмала, чем обычные клубни, но и обладает нежным и сладковатым вкусом. Такой картофель - прекрасное самостоятельное блюда, а также гарнир к овощам, рыбе и мясу. Сложно представить повседневный рацион без картофеля.', 59, 49, 5),
(5, 6, 'св-5', 'Кабачки', 'Турция. Во время приготовления вместе с другими ингредиентами, например, овощами, кабачки впитывают в себя аромат и вкус “соседей по сковородке”. Добавляя кабачки в разные блюда, мы получаем новые варианты вкусов кабачков. Кабачки содержат много бета-каротина, который поддерживает молодость. ', 0, 95, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` varchar(30) NOT NULL,
  `news` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `date`, `title`, `news`) VALUES
(1, '2021-11-11', 'Страховка груза', 'С 01 января 2022 года компания страхует полную стоимость груза при утери или порчи.'),
(2, '2021-11-12', 'Изменение тарифа', 'С 10 февраля 2022 года происходит увеличение тарифов.');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `date2` date DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `fio` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `idtypets` int NOT NULL,
  `idpoint1` int NOT NULL,
  `idpoint2` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idtypets` (`idtypets`,`idpoint1`,`idpoint2`),
  KEY `idpoint1` (`idpoint1`),
  KEY `idpoint2` (`idpoint2`),
  KEY `idtypets_2` (`idtypets`),
  KEY `idpoint1_2` (`idpoint1`),
  KEY `idpoint2_2` (`idpoint2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `date`, `date2`, `number`, `fio`, `address`, `phone`, `idtypets`, `idpoint1`, `idpoint2`) VALUES
(3, '2020-01-01', NULL, '5124314', 'Полозова Марина Викторовна', 'г. Солигорск, ул. Ленина, д.12', '+375449874562', 1, 3, 1),
(4, '2020-01-19', NULL, '125487', 'Иванов И.П.', 'г. Витебск, Московский проспект, д.34, кв. 1', '+375291236547', 2, 3, 1),
(5, '2020-01-19', NULL, '297814', 'Иванов И.П.', 'г. Кричев, ул. Ленина, д.28, кв.18', '+375441628563', 1, 3, 5),
(6, '2021-04-12', NULL, '369718', 'Арефьева Наталья', 'г. Жлобин, д.14', '+375294178962', 2, 5, 1),
(7, '2021-09-12', NULL, '159357', 'Пронин Владимир', 'г. Светлогорск, ул. Батова, д.8', '+375297777777', 1, 20, 21);

-- --------------------------------------------------------

--
-- Структура таблицы `ordersp`
--

CREATE TABLE IF NOT EXISTS `ordersp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orderid` int NOT NULL,
  `goodsid` int NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `orderid` (`orderid`),
  KEY `goodsid` (`goodsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `ordersp`
--

INSERT INTO `ordersp` (`id`, `orderid`, `goodsid`, `quantity`) VALUES
(1, 6, 1, '4'),
(2, 6, 2, '1'),
(3, 3, 1, '4'),
(4, 3, 4, '2'),
(5, 7, 2, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `orderst`
--

CREATE TABLE IF NOT EXISTS `orderst` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idorder` int NOT NULL,
  `idpoint` int NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idorder` (`idorder`),
  KEY `idorder_2` (`idorder`),
  KEY `idpoint` (`idpoint`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `orderst`
--

INSERT INTO `orderst` (`id`, `idorder`, `idpoint`, `date`) VALUES
(5, 3, 2, '2020-01-19'),
(8, 3, 5, NULL),
(9, 3, 6, NULL),
(10, 4, 2, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `id` int NOT NULL AUTO_INCREMENT,
  `point` varchar(50) NOT NULL,
  `idregion` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idregion` (`idregion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `points`
--

INSERT INTO `points` (`id`, `point`, `idregion`) VALUES
(1, 'г. Минск', 5),
(2, 'г. Витебск', 2),
(3, 'г. Гомель', 3),
(5, 'г. Брест', 1),
(6, 'г. Гродно', 4),
(7, 'г. Калинковичи', 3),
(8, 'г. Кобрин', 1),
(9, 'г. Речица', 3),
(10, 'г. Солигорск', 5),
(11, 'г. Светлогорск', 3),
(12, 'г. Сморгонь', 4),
(13, 'г. Слоним', 4),
(14, 'г. Новогрудок', 4),
(15, 'г. Кричев', 6),
(16, 'г. Толочин', 2),
(17, 'г. Жлобин', 3),
(18, 'г. Бобруйск', 6),
(19, 'г. Полоцк', 2),
(20, 'г. Ельск', 6),
(21, 'г. Могилев', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int NOT NULL AUTO_INCREMENT,
  `region` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `region`
--

INSERT INTO `region` (`id`, `region`) VALUES
(1, 'Брестская область'),
(2, 'Витебская Область'),
(3, 'Гомельская область'),
(4, 'Гродненская область'),
(5, 'Минская область'),
(6, 'Могилевскаяская область');

-- --------------------------------------------------------

--
-- Структура таблицы `route`
--

CREATE TABLE IF NOT EXISTS `route` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idtypets` int NOT NULL,
  `idpoint1` int NOT NULL,
  `idpoint2` int NOT NULL,
  `dist` decimal(10,0) NOT NULL,
  `time` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idtype` (`idtypets`,`idpoint1`,`idpoint2`),
  KEY `idpoint1` (`idpoint1`),
  KEY `idpoint2` (`idpoint2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `route`
--

INSERT INTO `route` (`id`, `idtypets`, `idpoint1`, `idpoint2`, `dist`, `time`) VALUES
(1, 2, 2, 5, '360', 1),
(2, 2, 3, 21, '370', 1),
(3, 2, 7, 13, '300', 2),
(4, 1, 7, 14, '400', 5),
(5, 1, 8, 15, '135', 2),
(6, 1, 9, 10, '200', 3),
(7, 1, 10, 6, '280', 3),
(8, 3, 5, 21, '310', 5),
(9, 3, 11, 7, '350', 8),
(10, 3, 12, 16, '390', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 COMMENT='типы товаров' AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`id`, `type`) VALUES
(1, 'Хлебобулочные изделия'),
(2, 'Мясо и птица'),
(3, 'Морепродукты'),
(4, 'Молочные продукты'),
(5, 'Рыба'),
(6, 'Овощи');

-- --------------------------------------------------------

--
-- Структура таблицы `typets`
--

CREATE TABLE IF NOT EXISTS `typets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `typets`
--

INSERT INTO `typets` (`id`, `type`, `price`) VALUES
(1, 'автотранспорт', 35),
(2, 'авиатранспорт', 0.1),
(3, 'ж/д доставка', 5);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`catalogid`) REFERENCES `catalog` (`id`);

--
-- Ограничения внешнего ключа таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD CONSTRAINT `catalog_ibfk_1` FOREIGN KEY (`typeid`) REFERENCES `type` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`idtypets`) REFERENCES `typets` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`idpoint1`) REFERENCES `points` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`idpoint2`) REFERENCES `points` (`id`);

--
-- Ограничения внешнего ключа таблицы `ordersp`
--
ALTER TABLE `ordersp`
  ADD CONSTRAINT `ordersp_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `ordersp_ibfk_2` FOREIGN KEY (`goodsid`) REFERENCES `catalog` (`id`);

--
-- Ограничения внешнего ключа таблицы `orderst`
--
ALTER TABLE `orderst`
  ADD CONSTRAINT `orderst_ibfk_1` FOREIGN KEY (`idorder`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderst_ibfk_2` FOREIGN KEY (`idpoint`) REFERENCES `points` (`id`);

--
-- Ограничения внешнего ключа таблицы `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_ibfk_1` FOREIGN KEY (`idregion`) REFERENCES `region` (`id`);

--
-- Ограничения внешнего ключа таблицы `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`idpoint1`) REFERENCES `points` (`id`),
  ADD CONSTRAINT `route_ibfk_3` FOREIGN KEY (`idpoint2`) REFERENCES `points` (`id`),
  ADD CONSTRAINT `route_ibfk_4` FOREIGN KEY (`idtypets`) REFERENCES `typets` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
