-- --------------------------------------------------------
-- Хост:                         localhost
-- Версия сервера:               5.7.19 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных farmer
DROP DATABASE IF EXISTS `farmer`;
CREATE DATABASE IF NOT EXISTS `farmer` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `farmer`;

-- Дамп структуры для таблица farmer.outlines
DROP TABLE IF EXISTS `outlines`;
CREATE TABLE IF NOT EXISTS `outlines` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `main_point` varchar(50) DEFAULT NULL,
  `addres_otline` varchar(200) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы farmer.outlines: ~10 rows (приблизительно)
DELETE FROM `outlines`;
/*!40000 ALTER TABLE `outlines` DISABLE KEYS */;
INSERT INTO `outlines` (`id`, `owner_id`, `name`, `main_point`, `addres_otline`) VALUES
	(0000000001, 1, 'пример 1', '55.415798, 86.251668', 'Ленсная поляна'),
	(0000000002, 1, 'новое название', '55.415798, 86.251668', 'Лесная поляна'),
	(0000000003, 1, 'новое название321', '55.415798, 86.251668', 'Лесная поляна2'),
	(0000000004, 1, 'тралял', '55.415798, 86.251668', 'Лесная поляна3'),
	(0000000005, 1, 'тралял', '55.415798, 86.251668', 'Лесная поляна3'),
	(0000000006, 1, 'тралял', '55.415798, 86.251668', 'Лесная поляна3'),
	(0000000007, 1, 'тралял', '55.415798, 86.251668', 'Лесная поляна'),
	(0000000008, 1, 'тралял', '55.415798, 86.251668', 'Лесная поляна'),
	(0000000009, 1, 'тралял', '55.415798, 86.251668', 'Лесная поляна'),
	(0000000010, 1, 'тралялkzkz', '55.415798, 86.251668', 'Лесная поляна'),
	(0000000011, 1, 'тралялkzkz', '55.415798, 86.251668', 'Лесная поляна'),
	(0000000012, 1, 'new object1', '55.415798, 86.251668', 'Лесная поляна'),
	(0000000013, 1, 'new object1', '55.415798, 86.251668', 'Лесная поляна'),
	(0000000014, 1, 'new object2', '55.415798, 86.251668', 'Лесная поляна'),
	(0000000015, 1, 'new object3', '55.415798, 86.251668', 'Лесная поляна'),
	(0000000016, 1, 'new object3', '55.415798, 86.251668', 'Лесная поляна'),
	(0000000017, 1, 'new object3', '55.415798, 86.251668', 'Лесная поляна');
/*!40000 ALTER TABLE `outlines` ENABLE KEYS */;

-- Дамп структуры для таблица farmer.points
DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outline_id` int(11) DEFAULT '0',
  `point` varchar(50) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Дамп данных таблицы farmer.points: ~0 rows (приблизительно)
DELETE FROM `points`;
/*!40000 ALTER TABLE `points` DISABLE KEYS */;
/*!40000 ALTER TABLE `points` ENABLE KEYS */;

-- Дамп структуры для таблица farmer.service_dates
DROP TABLE IF EXISTS `service_dates`;
CREATE TABLE IF NOT EXISTS `service_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outline_id` int(11) DEFAULT '0',
  `text` text,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Дамп данных таблицы farmer.service_dates: ~0 rows (приблизительно)
DELETE FROM `service_dates`;
/*!40000 ALTER TABLE `service_dates` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_dates` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
