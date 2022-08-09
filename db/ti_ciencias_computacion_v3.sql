-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-08-2022 a las 06:26:53
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
('trabajo_interdisciplinar_a', 1, 5, 10.0, 10.0, 30.0, 10.0, 10.0, 30.0, 100.0);

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
  `NF` float(4,2) DEFAULT NULL,
  `NC_1_PRAC_1` float(4,2) DEFAULT NULL,
  `NC_1_PRAC_2` float(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajo_interdisciplinar_a_calificaciones`
--

INSERT INTO `trabajo_interdisciplinar_a_calificaciones` (`cui`, `NC_1`, `EX_1`, `NC_2`, `EX_2`, `NC_3`, `EX_3`, `NF`, `NC_1_PRAC_1`, `NC_1_PRAC_2`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, 'NELZON JORGE', 'APAZA APAZA', 0),
(2, 'ANGEL ABRAHAM', 'APAZA QUISPE', 4),
(3, 'PAOLO DANIEL', 'BENAVENTE AGUIRRE', 6),
(4, 'JHOSEP ANGEL', 'CACSIRE SANCHEZ', 7),
(5, 'ALESSANDER JESUS', 'CARAZAS QUISPE', 5),
(6, 'SERGIO AHMED', 'CASTILLO SANCHO', 5),
(7, 'DIEGO YAMPIER', 'CAYLLAHUA GUTIERREZ', 4),
(8, 'GUSTAVO ALONSO', 'CCAMA MARRON', 8),
(9, 'RANDU JEAN FRANCO', 'CERPA GARCIA', 8),
(10, 'EBERT LUIS', 'CONDORI CASQUINO', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo_interdisciplinar_a_informacion_y_estadistica`
--

CREATE TABLE `trabajo_interdisciplinar_a_informacion_y_estadistica` (
  `ID` int(11) NOT NULL,
  `notas` varchar(100) NOT NULL,
  `notaSuperior` varchar(100) NOT NULL,
  `porcentaje` float(4,1) DEFAULT NULL,
  `mejorNota` int(2) DEFAULT NULL,
  `nomMejorNota` varchar(100) NOT NULL,
  `cuiMejorNota` varchar(8) NOT NULL,
  `peorNota` int(2) DEFAULT NULL,
  `nomPeorNota` varchar(100) NOT NULL,
  `cuiPeorNota` varchar(8) NOT NULL,
  `notaPromedio` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajo_interdisciplinar_a_informacion_y_estadistica`
--

INSERT INTO `trabajo_interdisciplinar_a_informacion_y_estadistica` (`ID`, `notas`, `notaSuperior`, `porcentaje`, `mejorNota`, `nomMejorNota`, `cuiMejorNota`, `peorNota`, `nomPeorNota`, `cuiPeorNota`, `notaPromedio`) VALUES
(1, 'NC_1', 'NF', 10.0, NULL, '', '', NULL, '', '', NULL),
(2, 'NC_2', 'NF', 10.0, NULL, '', '', NULL, '', '', NULL),
(3, 'NC_3', 'NF', 30.0, NULL, '', '', NULL, '', '', NULL),
(4, 'EX_1', 'NF', 10.0, NULL, '', '', NULL, '', '', NULL),
(5, 'EX_2', 'NF', 10.0, NULL, '', '', NULL, '', '', NULL),
(6, 'EX_3', 'NF', 30.0, NULL, '', '', NULL, '', '', NULL),
(7, 'NF', 'NF', 100.0, NULL, '', '', NULL, '', '', NULL),
(23, 'NC_1_PRAC_1', 'NC_1', 50.0, NULL, '', '', NULL, '', '', NULL),
(24, 'NC_1_PRAC_2', 'NC_1', 50.0, NULL, '', '', NULL, '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` int(8) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `clave`, `email`) VALUES
(1, '1a79a4d60de6718e8e5b326e338ae533', 'example@gmail.com'),
(2, '1a79a4d60de6718e8e5b326e338ae533', 'example@gmail.com'),
(3, '1a79a4d60de6718e8e5b326e338ae533', 'example@gmail.com'),
(4, '1a79a4d60de6718e8e5b326e338ae533', 'example@gmail.com'),
(5, '1a79a4d60de6718e8e5b326e338ae533', 'example@gmail.com'),
(6, '1a79a4d60de6718e8e5b326e338ae533', 'example@gmail.com'),
(7, '1a79a4d60de6718e8e5b326e338ae533', 'example@gmail.com'),
(8, '1a79a4d60de6718e8e5b326e338ae533', 'example@gmail.com'),
(9, '1a79a4d60de6718e8e5b326e338ae533', 'example@gmail.com'),
(10, '1a79a4d60de6718e8e5b326e338ae533', 'example@gmail.com');

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
-- Indices de la tabla `trabajo_interdisciplinar_a_informacion_y_estadistica`
--
ALTER TABLE `trabajo_interdisciplinar_a_informacion_y_estadistica`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `codigo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `trabajo_interdisciplinar_a_informacion_y_estadistica`
--
ALTER TABLE `trabajo_interdisciplinar_a_informacion_y_estadistica`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
