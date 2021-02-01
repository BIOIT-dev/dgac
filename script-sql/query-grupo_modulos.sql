-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-09-2020 a las 02:12:14
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cvirtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_modulos`
--

CREATE TABLE `grupo_modulos` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupo_modulos`
--

INSERT INTO `grupo_modulos` (`id`, `grupo_id`, `modulo_id`) VALUES
(6, 1, 1),
(18, 1, 2),
(19, 1, 3),
(20, 1, 4),
(21, 1, 7),
(22, 1, 8),
(23, 1, 62),
(31, 11, 1),
(32, 11, 3),
(33, 11, 7),
(34, 11, 62),
(24, 196, 1),
(25, 196, 2),
(26, 196, 3),
(27, 196, 4),
(28, 196, 7),
(29, 196, 8),
(30, 196, 62);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupo_modulos`
--
ALTER TABLE `grupo_modulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grupo_id` (`grupo_id`,`modulo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupo_modulos`
--
ALTER TABLE `grupo_modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
