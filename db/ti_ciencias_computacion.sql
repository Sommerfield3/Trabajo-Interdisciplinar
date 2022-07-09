-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2022 a las 18:32:59
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
  `EP_1` float(3,1) DEFAULT NULL,
  `EP_2` float(3,1) DEFAULT NULL,
  `EP_3` float(3,1) DEFAULT NULL,
  `EC_1` float(3,1) DEFAULT NULL,
  `EC_2` float(3,1) DEFAULT NULL,
  `EC_3` float(3,1) DEFAULT NULL,
  `NF` float(4,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`nombre`, `codigo`, `total_Horas`, `EP_1`, `EP_2`, `EP_3`, `EC_1`, `EC_2`, `EC_3`, `NF`) VALUES
('trabajo_interdisciplinar_a', 1, 7, 10.0, 10.0, 30.0, 10.0, 10.0, 30.0, 100.0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo_interdisciplinar_a_asistencia`
--

CREATE TABLE `trabajo_interdisciplinar_a_asistencia` (
  `cui` int(3) NOT NULL,
  `19_06_2022` char(1) DEFAULT NULL,
  `20_06_2022` char(1) DEFAULT NULL,
  `22_06_2022` char(1) DEFAULT NULL,
  `23_06_2022` char(1) DEFAULT NULL,
  `25_06_2022` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajo_interdisciplinar_a_asistencia`
--

INSERT INTO `trabajo_interdisciplinar_a_asistencia` (`cui`, `19_06_2022`, `20_06_2022`, `22_06_2022`, `23_06_2022`, `25_06_2022`) VALUES
(1, 'F', 'F', 'F', 'F', 'F'),
(2, 'F', 'F', 'P', 'P', 'F'),
(3, 'P', 'F', 'P', 'P', 'P'),
(4, 'P', 'P', 'P', 'F', 'P'),
(5, 'P', 'P', 'P', 'P', 'F'),
(6, 'P', 'P', 'P', 'P', 'F'),
(7, 'F', 'F', 'F', 'F', 'F'),
(8, 'P', 'P', 'P', 'P', 'P'),
(9, 'P', 'P', 'P', 'P', 'P'),
(10, 'P', 'P', 'P', 'P', 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo_interdisciplinar_a_calificaciones`
--

CREATE TABLE `trabajo_interdisciplinar_a_calificaciones` (
  `cui` int(8) NOT NULL,
  `NC_1` float(4,2) DEFAULT NULL,
  `EX_1` float(4,2) DEFAULT NULL,
  `NC_2` float(4,2) DEFAULT NULL,
  `EX_2` float(4,2) DEFAULT NULL,
  `NC_3` float(4,2) DEFAULT NULL,
  `EX_3` float(4,2) DEFAULT NULL,
  `NF` float(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajo_interdisciplinar_a_calificaciones`
--

INSERT INTO `trabajo_interdisciplinar_a_calificaciones` (`cui`, `NC_1`, `EX_1`, `NC_2`, `EX_2`, `NC_3`, `EX_3`, `NF`) VALUES
(1, 10.00, 20.00, 20.00, 20.00, 20.00, 20.00, 19.00),
(2, NULL, 2.00, 3.60, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 5.00, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, 4.50, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, 'APAZA APAZA', 'NELZON JORGE', 2),
(2, 'APAZA QUISPE', 'ANGEL ABRAHAM', 2),
(3, 'BENAVENTE AGUIRRE', 'PAOLO DANIEL', 4),
(4, 'CACSIRE SANCHEZ', 'JHOSEP ANGEL', 4),
(5, 'CARAZAS QUISPE', 'ALESSANDER JESUS', 4),
(6, 'CASTILLO SANCHO', 'SERGIO AHMED', 4),
(7, 'CAYLLAHUA GUTIERREZ', 'DIEGO YAMPIER', 3),
(8, 'CCAMA MARRON', 'GUSTAVO ALONSO', 5),
(9, 'CERPA GARCIA', 'RANDU JEAN FRANCO', 5),
(10, 'CONDORI CASQUINO', 'EBERT LUIS', 5);

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
-- Indices de la tabla `trabajo_interdisciplinar_a_calificaciones`
--
ALTER TABLE `trabajo_interdisciplinar_a_calificaciones`
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
