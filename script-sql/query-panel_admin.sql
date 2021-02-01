-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-12-2020 a las 22:35:31
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
-- Estructura de tabla para la tabla `panel_admin`
--

CREATE TABLE `panel_admin` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `orden` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `panel_admin`
--

INSERT INTO `panel_admin` (`id`, `name`, `orden`, `estatus`) VALUES
(1, 'Gestión de Procesos de Admisión', 0, 0),
(2, 'Gestión Académica', 0, 0),
(3, 'Gestión Administrativa', 0, 0),
(4, 'Administración de Comunidades', 0, 0),
(5, 'Administración de Usuarios', 0, 0),
(6, 'Administración de Objetos de Aprendizaje', 0, 0),
(7, 'Administración Encuestas o Banco de Preguntas', 0, 0),
(8, 'Elementos de Seccion Publica', 20, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `panel_admin`
--
ALTER TABLE `panel_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `panel_admin`
--
ALTER TABLE `panel_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
