-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 08 2022 г., 14:32
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ecoproduct2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(50) NOT NULL,
  `catalogid` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `catalogid` (`catalogid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL,
  `article` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `note` varchar(500) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `typeid` (`typeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='каталог спорт товаров' AUTO_INCREMENT=6 ;

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
-- Структура таблицы `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fio` varchar(50) NOT NULL,
  `phone` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `login`, `email`, `password`, `fio`, `phone`) VALUES
(1, 'valerygretchishnikov', 'valeragrkris@mail.ru', 'qwe', 'Валера', '+375291234567');

-- --------------------------------------------------------

--
-- Структура таблицы `nakls`
--

CREATE TABLE IF NOT EXISTS `nakls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `nakl_statuses`
--

CREATE TABLE IF NOT EXISTS `nakl_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` varchar(30) NOT NULL,
  `news` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `date2` date DEFAULT NULL,
  `id_nakl` int(11) NOT NULL,
  `fio` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `idpoint1` int(11) NOT NULL,
  `idpoint2` int(11) NOT NULL,
  `ul` varchar(100) NOT NULL,
  `house` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idpoint1` (`idpoint1`),
  KEY `idpoint2` (`idpoint2`),
  KEY `id_nakl` (`id_nakl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ordersp`
--

CREATE TABLE IF NOT EXISTS `ordersp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `goodsid` int(11) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `orderid` (`orderid`),
  KEY `goodsid` (`goodsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `orderst`
--

CREATE TABLE IF NOT EXISTS `orderst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idorder` int(11) NOT NULL,
  `idpoint` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idorder` (`idorder`),
  KEY `idorder_2` (`idorder`),
  KEY `idpoint` (`idpoint`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `point` varchar(50) NOT NULL,
  `idregion` int(11) NOT NULL,
  `is_region_center` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idregion` (`idregion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `points`
--

INSERT INTO `points` (`id`, `point`, `idregion`, `is_region_center`) VALUES
(1, 'г. Минск', 5, 1),
(2, 'г. Витебск', 2, 1),
(3, 'г. Гомель', 3, 1),
(4, 'г. Могилев', 6, 1),
(5, 'г. Брест', 1, 1),
(6, 'г. Гродно', 4, 1),
(7, 'г. Калинковичи', 3, 0),
(8, 'г. Кобрин', 1, 0),
(9, 'г. Речица', 3, 0),
(10, 'г. Солигорск', 5, 0),
(11, 'г. Светлогорск', 3, 0),
(12, 'г. Сморгонь', 4, 0),
(13, 'г. Слоним', 4, 0),
(14, 'г. Новогрудок', 4, 0),
(15, 'г. Кричев', 6, 0),
(16, 'г. Толочин', 2, 0),
(17, 'г. Жлобин', 3, 0),
(18, 'г. Бобруйск', 6, 0),
(19, 'г. Полоцк', 2, 0),
(20, 'г. Ельск', 3, 0),
(21, 'г. Логойск', 5, 0),
(22, 'г. Жодино', 5, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtypets` int(11) NOT NULL,
  `idpoint1` int(11) NOT NULL,
  `idpoint2` int(11) NOT NULL,
  `id_points` text COMMENT 'ID проходящих городов',
  `dist` decimal(10,0) NOT NULL,
  `time` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idtype` (`idtypets`,`idpoint1`,`idpoint2`),
  KEY `idpoint1` (`idpoint1`),
  KEY `idpoint2` (`idpoint2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `route`
--

INSERT INTO `route` (`id`, `idtypets`, `idpoint1`, `idpoint2`, `id_points`, `dist`, `time`) VALUES
(1, 1, 1, 21, NULL, '38', 30),
(2, 1, 1, 22, NULL, '54', 32),
(3, 1, 1, 10, NULL, '123', 115),
(4, 1, 2, 16, NULL, '92', 57),
(5, 1, 2, 19, NULL, '96', 59),
(6, 1, 3, 7, NULL, '119', 69),
(7, 1, 3, 9, NULL, '57', 36),
(8, 1, 3, 11, NULL, '91', 54),
(9, 1, 3, 17, NULL, '83', 50),
(10, 1, 3, 20, NULL, '144', 120),
(11, 1, 4, 15, NULL, '93', 55),
(12, 1, 4, 18, NULL, '110', 60),
(13, 1, 5, 8, NULL, '47', 27),
(14, 1, 6, 12, NULL, '190', 155),
(15, 1, 6, 13, NULL, '118', 65),
(16, 1, 6, 12, NULL, '131', 118);

-- --------------------------------------------------------

--
-- Структура таблицы `transport`
--

CREATE TABLE IF NOT EXISTS `transport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type` (`id_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='типы товаров' AUTO_INCREMENT=7 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `typets`
--

INSERT INTO `typets` (`id`, `type`, `price`) VALUES
(1, 'автотранспорт', 35);

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
-- Ограничения внешнего ключа таблицы `nakls`
--
ALTER TABLE `nakls`
  ADD CONSTRAINT `nakls_ibfk_1` FOREIGN KEY (`status`) REFERENCES `nakl_statuses` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`idpoint1`) REFERENCES `points` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`idpoint2`) REFERENCES `points` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`id_nakl`) REFERENCES `nakls` (`id`);

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

--
-- Ограничения внешнего ключа таблицы `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `transport_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `typets` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
