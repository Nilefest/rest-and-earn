-- --------------------------------------------------------
-- Хост:                         restan02.mysql.tools
-- Версия сервера:               5.7.16-10-log - Percona Server (GPL), Release 10, Revision a0c7d0d
-- Операционная система:         Linux
-- HeidiSQL Версия:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица restan02_db.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL DEFAULT '',
  `mail` varchar(500) NOT NULL DEFAULT '',
  `password` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы restan02_db.admin: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `name`, `mail`, `password`) VALUES
	(2, 'Анна', 'rest.and.earn.ua@gmail.com', 'adminanna');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Дамп структуры для таблица restan02_db.cash
CREATE TABLE IF NOT EXISTS `cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cl_id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL DEFAULT '',
  `amount` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы restan02_db.cash: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `cash` DISABLE KEYS */;
/*!40000 ALTER TABLE `cash` ENABLE KEYS */;

-- Дамп структуры для таблица restan02_db.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы restan02_db.city: ~24 rows (приблизительно)
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` (`id`, `name`) VALUES
	(1, 'Винница'),
	(2, 'Днепр'),
	(3, 'Донецк'),
	(4, 'Житомир'),
	(5, 'Запорожье'),
	(6, 'Иванофранковск'),
	(7, 'Киев'),
	(8, 'Кировоград'),
	(9, 'Луганск'),
	(10, 'Луцк'),
	(11, 'Львов'),
	(12, 'Николаев'),
	(13, 'Одесса'),
	(14, 'Полтава'),
	(15, 'Ровно'),
	(16, 'Сумы'),
	(17, 'Тернополь'),
	(18, 'Ужгород'),
	(19, 'Харьков'),
	(20, 'Херсон'),
	(21, 'Хмельницкий'),
	(22, 'Черкассы'),
	(23, 'Чернигов'),
	(24, 'Черновцы');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;

-- Дамп структуры для таблица restan02_db.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_reg` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(250) NOT NULL DEFAULT '',
  `last_name` varchar(250) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `mail` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `card` varchar(50) NOT NULL DEFAULT '',
  `balance` double NOT NULL DEFAULT '0',
  `cash` double NOT NULL DEFAULT '0',
  `phone` varchar(50) NOT NULL DEFAULT '',
  `visits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы restan02_db.clients: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`id`, `date_reg`, `name`, `last_name`, `city`, `mail`, `password`, `card`, `balance`, `cash`, `phone`, `visits`) VALUES
	(16, '2019-05-15', 'Anna', 'Bekh', 'Киев', 'rest.and.earn.ua@gmail.com', 'adminanna', '', 0, 0, '0935125325', 0),
	(17, '2019-05-17', 'Юлия', 'Алексеева', 'Киев', 'alekseeva7713@gmail.com', '131226zz', '', 0, 0, '80935749453', 0);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Дамп структуры для таблица restan02_db.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_st` varchar(10) NOT NULL DEFAULT '',
  `date_fin` varchar(10) NOT NULL DEFAULT '',
  `cl_id` int(11) NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `card` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(50) NOT NULL DEFAULT '',
  `method` varchar(50) NOT NULL DEFAULT '',
  `hide_adm` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы restan02_db.payments: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;

-- Дамп структуры для таблица restan02_db.reservs
CREATE TABLE IF NOT EXISTS `reservs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_st` varchar(10) NOT NULL DEFAULT '',
  `date_fin` varchar(10) NOT NULL DEFAULT '',
  `time` varchar(10) NOT NULL DEFAULT '',
  `rest_id` int(11) NOT NULL,
  `cl_id` int(11) NOT NULL,
  `visiter` varchar(300) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `hum_count` int(11) NOT NULL DEFAULT '0',
  `cost` double NOT NULL DEFAULT '0',
  `per_coop` double NOT NULL DEFAULT '0',
  `per_cl` double NOT NULL DEFAULT '0',
  `is_undo` int(1) NOT NULL DEFAULT '0',
  `ok_rest` int(1) NOT NULL DEFAULT '0',
  `ok_adm` int(1) NOT NULL DEFAULT '0',
  `hide_cl` int(1) NOT NULL DEFAULT '0',
  `hide_rest` int(1) NOT NULL DEFAULT '0',
  `hide_adm` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы restan02_db.reservs: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `reservs` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservs` ENABLE KEYS */;

-- Дамп структуры для таблица restan02_db.rest
CREATE TABLE IF NOT EXISTS `rest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_reg` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(250) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `addr` varchar(250) NOT NULL DEFAULT '',
  `mail` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(100) NOT NULL DEFAULT '',
  `manager` varchar(250) NOT NULL DEFAULT '',
  `phone` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(500) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `per_coop` double NOT NULL DEFAULT '0',
  `per_cl` double NOT NULL DEFAULT '0',
  `visits` int(11) NOT NULL DEFAULT '0',
  `total_amount` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы restan02_db.rest: ~12 rows (приблизительно)
/*!40000 ALTER TABLE `rest` DISABLE KEYS */;
INSERT INTO `rest` (`id`, `date_reg`, `name`, `city`, `addr`, `mail`, `password`, `type`, `manager`, `phone`, `url`, `description`, `per_coop`, `per_cl`, `visits`, `total_amount`) VALUES
	(22, '2019-05-17', 'Царское село', 'Киев', 'Лаврская 22', 'rest.and.earn.ua@gmail.com', 'adminanna', 'Ресторан', '', '', '', '', 15, 8, 0, 0),
	(23, '2019-06-27', 'Whiskey corner', 'Киев', 'ул. Софиевская 16/16', 'bennitkolumn@gmail.com', 'adminanna', 'Ресторан', 'Дмитрий', '+380956486333', 'www.whiskycorner.kiev.ua', 'Шотландский дом-ресторан', 15, 8, 0, 0),
	(24, '2019-06-27', 'Mocco', 'Киев', 'Крещатик 15/4 (Пассаж)', 'mocco', 'adminanna', 'Ресторан', 'Сергей', '+380442309230', 'mocco.kiev.ua', 'Кухня: европейская, украинская, Wi-Fi, летняя веранда, кальян, оплата картой, цены: выше среднего', 15, 8, 0, 0),
	(25, '2019-06-27', 'Fellini', 'Киев', 'Городецкого 5', 'fellini', 'adminanna', 'Ресторан', '', '+380674300202', 'fellini.in.ua/ru/', 'Итальянская и французская кухни, эксклюзивные вина', 15, 8, 0, 0),
	(26, '2019-06-27', 'Shah-Plov', 'Киев', 'Антоновича 72-74', 'shahplov', 'adminanna', 'Ресторан', '', '+380682257777', 'shah-plov.ua/', 'Ресторан восточной кухни Shah-Plov - это изысканная легенда, ожившая в самом центре города', 15, 8, 0, 0),
	(27, '2019-06-27', 'Ok bar', 'Киев', 'Большая Васильковская 94', 'okbar', 'adminanna', 'Ресторан', '', '+380 44 225 0220', 'https://ok-bar.hoo.com.ua/', 'Ресторан, Бар, Кафе, Караоке. Кухня: Азиатская, Итальянская. Особенности: VIP-зал/VIP-кабины, TV/DVD/Video, Wi-Fi, Летняя терраса, Вид из окна, Пекарня, Кондитерская, Шоу программы', 10, 7, 0, 0),
	(28, '2019-06-27', 'Guramma', 'Киев', 'Днепровский спуск 1', 'guramma', 'adminanna', 'Ресторан', '', '+380979993288', 'guramma.com', 'Блюда Азии, известные марки шампанского и винная классика, прекрасная джазовая музыка и лучший видом на город!', 10, 8, 0, 0),
	(29, '2019-06-27', 'Perets', 'Киев', 'Маршала Тимошенка 29', 'perets', 'adminanna', 'Ресторан', '', '+380445380348', 'perets.com.ua', 'Мясной ресторан Perets – двухуровневый ресторан с большой всесезонной террасой, в интерьере которого использованы элементы лофта.', 10, 8, 0, 0),
	(30, '2019-06-27', 'Karavan', 'Киев', 'Кловский спуск 10', 'karavan', 'adminanna', 'Ресторан', '', '+380672343729', 'https://www.facebook.com/Karavan.Restaurant/', 'Ресторан с многолетней безупречной репутацией места с вкуснейшей восточной кухней. Атмосфера заведения - завораживающий дым кальяна, потрескивание мангала, танец живота, пиалы ароматного чая, персидские ковры и марокканская плитка.', 10, 8, 0, 0),
	(31, '2019-06-27', 'Avalon', 'Киев', 'Леонтовича 3', 'avalon', 'adminanna', 'Ресторан', '', '+380442347494', 'avalon.ua/', 'Развлекательный комплекс &quot;Авалон&quot;, что в центре Киева, за Владимирским собором, объединяет по своей крышей вокальный ресторан &quot;Павлин&quot;, &quot;Диджей-бар&quot;, лаунж-бар и террасу на крыше с видом на кварталы старого города и собор.', 15, 8, 0, 0),
	(32, '2019-06-27', 'Koya', 'Киев', 'Большая Васильковская 1-3', 'koya', 'adminanna', 'Ресторан', '', '+380504505335', 'koya.com.ua', 'Азиатский ресторан и бар в центре Киева, который имеет лаконичный современный интерьер, отточенную кухню и уникальную барную карту', 15, 8, 0, 0),
	(33, '2019-06-27', 'Victoria Secret', 'Киев', '', 'victoria', 'adminanna', 'Магазин', '', '', '', '', 80, 0, 0, 0);
/*!40000 ALTER TABLE `rest` ENABLE KEYS */;

-- Дамп структуры для таблица restan02_db.rest_type
CREATE TABLE IF NOT EXISTS `rest_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы restan02_db.rest_type: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `rest_type` DISABLE KEYS */;
INSERT INTO `rest_type` (`id`, `name`) VALUES
	(1, 'Ресторан'),
	(2, 'Ночной клуб'),
	(3, 'Магазин'),
	(4, 'Переводчик'),
	(5, 'Отель/Жилье в аренду'),
	(6, 'Такси/Водитель'),
	(7, 'Салон красоты'),
	(8, 'Курсы'),
	(9, 'Развлечения');
/*!40000 ALTER TABLE `rest_type` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
