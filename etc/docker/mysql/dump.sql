-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 02-03-2021 a las 11:40:28
-- Versión del servidor: 5.7.23
-- Versión de PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repositories`
--
DROP TABLE IF EXISTS `repositories`;
CREATE TABLE IF NOT EXISTS `repositories` (
  `id` smallint(6) NOT NULL PRIMARY KEY,
  `package` varchar(64) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `repositories`
--
INSERT INTO `repositories` (`id`, `package`, `path`, `created_at`, `updated_at`) VALUES
(1, 'ampliffy/proyecto1', 'repositories/proyecto1', '2022-10-30 22:00:00', '2022-10-30 22:00:00'),
(2, 'ampliffy/proyecto2', 'repositories/proyecto2', '2022-10-30 22:00:00', '2022-10-30 22:00:00'),
(3, 'ampliffy/libreria1', 'repositories/libreria1', '2022-10-30 22:00:00', '2022-10-30 22:00:00'),
(4, 'ampliffy/libreria2', 'repositories/libreria2', '2022-10-30 22:00:00', '2022-10-30 22:00:00'),
(5, 'ampliffy/libreria4', 'repositories/libreria4', '2022-10-30 22:00:00', '2022-10-30 22:00:00'),
COMMIT;


--
-- Estructura de tabla para la tabla `repositories`
--
DROP TABLE IF EXISTS `dependencies`;
CREATE TABLE IF NOT EXISTS `dependencies` (
  `parent` smallint(6) NOT NULL ,
  `child` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dependencies`
--
INSERT INTO `repositories` (`parent`, `child`, `created_at`, `updated_at`) VALUES
(0, 1, '2022-10-30 22:00:00', '2022-10-30 22:00:00'),
(1, 3, '2022-10-30 22:00:00', '2022-10-30 22:00:00'),
(1, 4, '2022-10-30 22:00:00', '2022-10-30 22:00:00'),
(4, 5, '2022-10-30 22:00:00', '2022-10-30 22:00:00'),
(0, 2, '2022-10-30 22:00:00', '2022-10-30 22:00:00'),
(2, 4, '2022-10-30 22:00:00', '2022-10-30 22:00:00'),
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
