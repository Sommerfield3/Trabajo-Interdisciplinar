-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2022 a las 03:37:20
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ti_ciencias_computacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `nombre` varchar(100) NOT NULL,
  `codigo` int(6) NOT NULL,
  `total_Horas` int(11) NOT NULL DEFAULT 0,
  `hora_1` varchar(50) DEFAULT NULL,
  `hora_2` varchar(50) DEFAULT NULL,
  `hora_3` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`nombre`, `codigo`, `total_Horas`, `hora_1`, `hora_2`, `hora_3`) VALUES
('trabajo_interdisciplinar_a', 1, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo_interdisciplinar_a_asistencia`
--

CREATE TABLE `trabajo_interdisciplinar_a_asistencia` (
  `cui` int(3) NOT NULL,
  `19_06_2022` char(1) DEFAULT NULL,
  `20_06_2022` char(1) DEFAULT NULL,
  `22_06_2022` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajo_interdisciplinar_a_asistencia`
--

INSERT INTO `trabajo_interdisciplinar_a_asistencia` (`cui`, `19_06_2022`, `20_06_2022`, `22_06_2022`) VALUES
(1, 'P', 'F', 'F'),
(2, 'F', 'F', 'P'),
(3, 'P', 'F', 'P'),
(4, 'P', 'P', 'P'),
(5, 'P', 'P', 'P'),
(6, 'P', 'P', 'P'),
(7, 'P', 'P', 'F'),
(8, 'P', 'P', 'P'),
(9, 'P', 'P', 'P'),
(10, 'P', 'P', 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo_interdisciplinar_a_datos`
--

CREATE TABLE `trabajo_interdisciplinar_a_datos` (
  `cui` int(8) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `total_Asistencia` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajo_interdisciplinar_a_datos`
--

INSERT INTO `trabajo_interdisciplinar_a_datos` (`cui`, `nombre`, `apellido`, `total_Asistencia`) VALUES
(1, 'APAZA APAZA', 'NELZON JORGE', 1),
(2, 'APAZA QUISPE', 'ANGEL ABRAHAM', 1),
(3, 'BENAVENTE AGUIRRE', 'PAOLO DANIEL', 2),
(4, 'CACSIRE SANCHEZ', 'JHOSEP ANGEL', 3),
(5, 'CARAZAS QUISPE', 'ALESSANDER JESUS', 3),
(6, 'CASTILLO SANCHO', 'SERGIO AHMED', 3),
(7, 'CAYLLAHUA GUTIERREZ', 'DIEGO YAMPIER', 2),
(8, 'CCAMA MARRON', 'GUSTAVO ALONSO', 3),
(9, 'CERPA GARCIA', 'RANDU JEAN FRANCO', 3),
(10, 'CONDORI CASQUINO', 'EBERT LUIS', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `trabajo_interdisciplinar_a_asistencia`
--
ALTER TABLE `trabajo_interdisciplinar_a_asistencia`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `trabajo_interdisciplinar_a_datos`
--
ALTER TABLE `trabajo_interdisciplinar_a_datos`
  ADD PRIMARY KEY (`cui`),
  ADD KEY `cui` (`cui`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `codigo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
