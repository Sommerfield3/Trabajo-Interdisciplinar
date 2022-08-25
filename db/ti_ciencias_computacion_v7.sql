-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2022 a las 05:51:12
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
-- Estructura de tabla para la tabla `1702120a_asistencia`
--

CREATE TABLE `1702120a_asistencia` (
  `cui` varchar(11) NOT NULL,
  `19_06_2022` char(1) DEFAULT NULL,
  `20_06_2022` char(1) DEFAULT NULL,
  `22_06_2022` char(1) DEFAULT NULL,
  `23_06_2022` char(1) DEFAULT NULL,
  `25_06_2022` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `1702120a_asistencia`
--

INSERT INTO `1702120a_asistencia` (`cui`, `19_06_2022`, `20_06_2022`, `22_06_2022`, `23_06_2022`, `25_06_2022`) VALUES
('est20180102', 'P', 'P', 'P', 'P', 'F'),
('est20190652', 'F', 'F', 'F', 'F', 'F'),
('est20190745', 'P', 'P', 'P', 'F', 'P'),
('est20210672', 'P', 'P', 'P', 'P', 'P'),
('est20210685', 'P', 'P', 'P', 'P', 'P'),
('est20210688', 'P', 'P', 'P', 'P', 'P'),
('est20211821', 'F', 'F', 'F', 'F', 'F'),
('est20213141', 'P', 'P', 'P', 'P', 'F'),
('est20213142', 'F', 'F', 'P', 'P', 'F'),
('est20213145', 'P', 'F', 'P', 'P', 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702120a_calificaciones`
--

CREATE TABLE `1702120a_calificaciones` (
  `cui` varchar(11) NOT NULL,
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
-- Volcado de datos para la tabla `1702120a_calificaciones`
--

INSERT INTO `1702120a_calificaciones` (`cui`, `NC_1`, `EX_1`, `NC_2`, `EX_2`, `NC_3`, `EX_3`, `NF`, `NC_1_PRAC_1`, `NC_1_PRAC_2`) VALUES
('est20180102', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('est20180685', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('est20190652', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('est20190755', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('est20210672', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('est20210688', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('est20211821', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('est20213141', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('est20213142', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('est20213145', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702120a_datos`
--

CREATE TABLE `1702120a_datos` (
  `cui` varchar(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `total_Asistencia` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `1702120a_datos`
--

INSERT INTO `1702120a_datos` (`cui`, `nombre`, `apellido`, `total_Asistencia`) VALUES
('est20180102', 'ALESSANDER JESUS', 'CARAZAS QUISPE', 5),
('est20180685', 'EBERT LUIS', 'CONDORI CASQUINO', 8),
('est20190652', 'NELZON JORGE', 'APAZA APAZA', 0),
('est20190755', 'JHOSEP ANGEL', 'CACSIRE SANCHEZ', 7),
('est20210672', 'RANDU JEAN FRANCO', 'CERPA GARCIA', 8),
('est20210688', 'GUSTAVO ALONSO', 'CCAMA MARRON', 8),
('est20211821', 'DIEGO YAMPIER', 'CAYLLAHUA GUTIERREZ', 4),
('est20213141', 'SERGIO AHMED', 'CASTILLO SANCHO', 5),
('est20213142', 'ANGEL ABRAHAM', 'APAZA QUISPE', 4),
('est20213145', 'PAOLO DANIEL', 'BENAVENTE AGUIRRE', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702120a_informacion_y_estadistica`
--

CREATE TABLE `1702120a_informacion_y_estadistica` (
  `ID` int(11) NOT NULL,
  `notas` varchar(100) NOT NULL,
  `notaSuperior` varchar(100) NOT NULL,
  `porcentaje` float(4,1) DEFAULT NULL,
  `mejorNota` int(2) DEFAULT NULL,
  `nomMejorNota` varchar(100) NOT NULL,
  `cuiMejorNota` varchar(11) NOT NULL,
  `peorNota` int(2) DEFAULT NULL,
  `nomPeorNota` varchar(100) NOT NULL,
  `cuiPeorNota` varchar(11) NOT NULL,
  `notaPromedio` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `1702120a_informacion_y_estadistica`
--

INSERT INTO `1702120a_informacion_y_estadistica` (`ID`, `notas`, `notaSuperior`, `porcentaje`, `mejorNota`, `nomMejorNota`, `cuiMejorNota`, `peorNota`, `nomPeorNota`, `cuiPeorNota`, `notaPromedio`) VALUES
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
-- Estructura de tabla para la tabla `1702120b_asistencia`
--

CREATE TABLE `1702120b_asistencia` (
  `cui` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702120b_calificaciones`
--

CREATE TABLE `1702120b_calificaciones` (
  `cui` varchar(11) NOT NULL,
  `NC_1` float(4,2) DEFAULT NULL,
  `EX_1` float(4,2) DEFAULT NULL,
  `NC_2` float(4,2) DEFAULT NULL,
  `EX_2` float(4,2) DEFAULT NULL,
  `NC_3` float(4,2) DEFAULT NULL,
  `EX_3` float(4,2) DEFAULT NULL,
  `NF` float(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702120b_datos`
--

CREATE TABLE `1702120b_datos` (
  `cui` varchar(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `total_Asistencia` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702120b_informacion_y_estadistica`
--

CREATE TABLE `1702120b_informacion_y_estadistica` (
  `ID` int(11) NOT NULL,
  `notas` varchar(100) NOT NULL,
  `notaSuperior` varchar(100) NOT NULL,
  `porcentaje` float(4,1) DEFAULT NULL,
  `mejorNota` int(2) DEFAULT NULL,
  `nomMejorNota` varchar(100) NOT NULL,
  `cuiMejorNota` varchar(11) NOT NULL,
  `peorNota` int(2) DEFAULT NULL,
  `nomPeorNota` varchar(100) NOT NULL,
  `cuiPeorNota` varchar(11) NOT NULL,
  `notaPromedio` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702122a_asistencia`
--

CREATE TABLE `1702122a_asistencia` (
  `cui` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702122a_calificaciones`
--

CREATE TABLE `1702122a_calificaciones` (
  `cui` varchar(11) NOT NULL,
  `NC_1` float(4,2) DEFAULT NULL,
  `EX_1` float(4,2) DEFAULT NULL,
  `NC_2` float(4,2) DEFAULT NULL,
  `EX_2` float(4,2) DEFAULT NULL,
  `NC_3` float(4,2) DEFAULT NULL,
  `EX_3` float(4,2) DEFAULT NULL,
  `NF` float(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702122a_datos`
--

CREATE TABLE `1702122a_datos` (
  `cui` varchar(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `total_Asistencia` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702122a_informacion_y_estadistica`
--

CREATE TABLE `1702122a_informacion_y_estadistica` (
  `ID` int(11) NOT NULL,
  `notas` varchar(100) NOT NULL,
  `notaSuperior` varchar(100) NOT NULL,
  `porcentaje` float(4,1) DEFAULT NULL,
  `mejorNota` int(2) DEFAULT NULL,
  `nomMejorNota` varchar(100) NOT NULL,
  `cuiMejorNota` varchar(11) NOT NULL,
  `peorNota` int(2) DEFAULT NULL,
  `nomPeorNota` varchar(100) NOT NULL,
  `cuiPeorNota` varchar(11) NOT NULL,
  `notaPromedio` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702122b_asistencia`
--

CREATE TABLE `1702122b_asistencia` (
  `cui` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702122b_calificaciones`
--

CREATE TABLE `1702122b_calificaciones` (
  `cui` varchar(11) NOT NULL,
  `NC_1` float(4,2) DEFAULT NULL,
  `EX_1` float(4,2) DEFAULT NULL,
  `NC_2` float(4,2) DEFAULT NULL,
  `EX_2` float(4,2) DEFAULT NULL,
  `NC_3` float(4,2) DEFAULT NULL,
  `EX_3` float(4,2) DEFAULT NULL,
  `NF` float(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702122b_datos`
--

CREATE TABLE `1702122b_datos` (
  `cui` varchar(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `total_Asistencia` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `1702122b_informacion_y_estadistica`
--

CREATE TABLE `1702122b_informacion_y_estadistica` (
  `ID` int(11) NOT NULL,
  `notas` varchar(100) NOT NULL,
  `notaSuperior` varchar(100) NOT NULL,
  `porcentaje` float(4,1) DEFAULT NULL,
  `mejorNota` int(2) DEFAULT NULL,
  `nomMejorNota` varchar(100) NOT NULL,
  `cuiMejorNota` varchar(11) NOT NULL,
  `peorNota` int(2) DEFAULT NULL,
  `nomPeorNota` varchar(100) NOT NULL,
  `cuiPeorNota` varchar(11) NOT NULL,
  `notaPromedio` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `codigo` varchar(8) NOT NULL,
  `semestre` int(1) NOT NULL,
  `año` int(1) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `turno` char(1) NOT NULL,
  `total_Horas` int(11) NOT NULL DEFAULT 0,
  `EP_1` float(3,1) DEFAULT NULL,
  `EP_2` float(3,1) DEFAULT NULL,
  `EP_3` float(3,1) DEFAULT NULL,
  `EC_1` float(3,1) DEFAULT NULL,
  `EC_2` float(3,1) DEFAULT NULL,
  `EC_3` float(3,1) DEFAULT NULL,
  `NF` float(4,1) DEFAULT NULL,
  `cui_docente_1` varchar(11) DEFAULT NULL,
  `cui_docente_2` varchar(11) DEFAULT NULL,
  `curso_1` varchar(7) DEFAULT NULL,
  `curso_2` varchar(7) DEFAULT NULL,
  `curso_3` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`codigo`, `semestre`, `año`, `nombre`, `turno`, `total_Horas`, `EP_1`, `EP_2`, `EP_3`, `EC_1`, `EC_2`, `EC_3`, `NF`, `cui_docente_1`, `cui_docente_2`, `curso_1`, `curso_2`, `curso_3`) VALUES
('1702120a', 0, 2, 'TRABAJO INTERDISCIPLINAR', 'A', 5, 10.0, 10.0, 30.0, 10.0, 10.0, 30.0, 100.0, 'docMMXXII08', NULL, '1703240', NULL, NULL),
('1702120b', 0, 2, 'TRABAJO INTERDISCIPLINAR', 'B', 0, 10.0, 10.0, 30.0, 10.0, 10.0, 30.0, 100.0, 'docMMXXII07', NULL, '1703240', NULL, NULL),
('1702122a', 0, 2, 'INGLES TECNICO PROFESIONAL III', 'A', 0, 20.0, 20.0, 27.0, 9.0, 9.0, 15.0, 100.0, NULL, NULL, '1705160', '', ''),
('1702122b', 0, 2, 'INGLES TECNICO PROFESIONAL III', 'B', 0, 20.0, 20.0, 27.0, 9.0, 9.0, 15.0, 100.0, NULL, NULL, '1705160', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_notas`
--

CREATE TABLE `historico_notas` (
  `cui` varchar(11) NOT NULL,
  `1701101` int(2) DEFAULT NULL,
  `1701102` int(2) DEFAULT NULL,
  `1701104` int(2) DEFAULT NULL,
  `1701105` int(2) DEFAULT NULL,
  `1701106` int(2) DEFAULT NULL,
  `1701107` int(2) DEFAULT NULL,
  `1701114` int(2) DEFAULT NULL,
  `1702120` int(2) DEFAULT NULL,
  `1701208` int(2) DEFAULT NULL,
  `1701209` int(2) DEFAULT NULL,
  `1701210` int(2) DEFAULT NULL,
  `1701212` int(2) DEFAULT NULL,
  `1701215` int(2) DEFAULT NULL,
  `1701216` int(2) DEFAULT NULL,
  `1702224` int(2) DEFAULT NULL,
  `1702225` int(2) DEFAULT NULL,
  `1702226` int(2) DEFAULT NULL,
  `1702227` int(2) DEFAULT NULL,
  `1702228` int(2) DEFAULT NULL,
  `1702229` int(2) DEFAULT NULL,
  `1703130` int(2) DEFAULT NULL,
  `1703131` int(2) DEFAULT NULL,
  `1703132` int(2) DEFAULT NULL,
  `1703133` int(2) DEFAULT NULL,
  `1703134` int(2) DEFAULT NULL,
  `1703135` int(2) DEFAULT NULL,
  `1703236` int(2) DEFAULT NULL,
  `1703237` int(2) DEFAULT NULL,
  `1703238` int(2) DEFAULT NULL,
  `1703239` int(2) DEFAULT NULL,
  `1703240` int(2) DEFAULT NULL,
  `1703241` int(2) DEFAULT NULL,
  `1704142` int(2) DEFAULT NULL,
  `1704143` int(2) DEFAULT NULL,
  `1704144` int(2) DEFAULT NULL,
  `1704145` int(2) DEFAULT NULL,
  `1704146` int(2) DEFAULT NULL,
  `1704147` int(2) DEFAULT NULL,
  `1704248` int(2) DEFAULT NULL,
  `1704249` int(2) DEFAULT NULL,
  `1704250` int(2) DEFAULT NULL,
  `1704251` int(2) DEFAULT NULL,
  `1704252` int(2) DEFAULT NULL,
  `1704253` int(2) DEFAULT NULL,
  `1704254` int(2) DEFAULT NULL,
  `1704255` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historico_notas`
--

INSERT INTO `historico_notas` (`cui`, `1701101`, `1701102`, `1701104`, `1701105`, `1701106`, `1701107`, `1701114`, `1702120`, `1701208`, `1701209`, `1701210`, `1701212`, `1701215`, `1701216`, `1702224`, `1702225`, `1702226`, `1702227`, `1702228`, `1702229`, `1703130`, `1703131`, `1703132`, `1703133`, `1703134`, `1703135`, `1703236`, `1703237`, `1703238`, `1703239`, `1703240`, `1703241`, `1704142`, `1704143`, `1704144`, `1704145`, `1704146`, `1704147`, `1704248`, `1704249`, `1704250`, `1704251`, `1704252`, `1704253`, `1704254`, `1704255`) VALUES
('est20190652', 13, 15, 16, 12, 17, 12, 15, NULL, 15, 14, 18, 13, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre_actual`
--

CREATE TABLE `semestre_actual` (
  `cui` varchar(11) NOT NULL,
  `1702120A` tinyint(1) NOT NULL,
  `1702120B` tinyint(1) NOT NULL,
  `1702122A` tinyint(1) NOT NULL,
  `1702122B` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `semestre_actual`
--

INSERT INTO `semestre_actual` (`cui`, `1702120A`, `1702120B`, `1702122A`, `1702122B`) VALUES
('est20190652', 1, 0, 0, 0),
('MMXXII01', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(11) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `permisos` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `clave`, `email`, `permisos`) VALUES
('20180102', '1a79a4d60de6718e8e5b326e338ae533', 'example@unsa.edu.pe', 'estudiante'),
('20180685', '1a79a4d60de6718e8e5b326e338ae533', 'example@unsa.edu.pe', 'estudiante'),
('20190652', '1a79a4d60de6718e8e5b326e338ae533', 'example@unsa.edu.pe', 'estudiante'),
('20190755', '1a79a4d60de6718e8e5b326e338ae533', 'example@unsa.edu.pe', 'estudiante'),
('20210672', '1a79a4d60de6718e8e5b326e338ae533', 'example@unsa.edu.pe', 'estudiante'),
('20210688', '1a79a4d60de6718e8e5b326e338ae533', 'example@unsa.edu.pe', 'estudiante'),
('20211821', '1a79a4d60de6718e8e5b326e338ae533', 'example@unsa.edu.pe', 'estudiante'),
('20213141', '1a79a4d60de6718e8e5b326e338ae533', 'example@unsa.edu.pe', 'estudiante'),
('20213142', '1a79a4d60de6718e8e5b326e338ae533', 'example@unsa.edu.pe', 'estudiante'),
('20213145', '1a79a4d60de6718e8e5b326e338ae533', 'example@unsa.edu.pe', 'estudiante'),
('MMXXII01', '1a79a4d60de6718e8e5b326e338ae533', 'ygranda@unsa.edu.pe', 'docente'),
('MMXXII02', '1a79a4d60de6718e8e5b326e338ae533', 'ehinojosa@unsa.edu.pe', 'docente'),
('MMXXII03', '1a79a4d60de6718e8e5b326e338ae533', 'amamaniali@unsa.edu.pe', 'docente'),
('MMXXII04', '1a79a4d60de6718e8e5b326e338ae533', 'prodriguez@unsa.edu.pe', 'docente'),
('MMXXII05', '1a79a4d60de6718e8e5b326e338ae533', 'aflorez@unsa.edu.pe', 'docente'),
('MMXXII06', '1a79a4d60de6718e8e5b326e338ae533', 'arenjifo@unsa.edu.pe', 'docente'),
('MMXXII07', '1a79a4d60de6718e8e5b326e338ae533', 'ajbenavides@unsa.edu.pe', 'docente'),
('MMXXII08', '1a79a4d60de6718e8e5b326e338ae533', 'yyarira@unsa.edu.pe', 'docente'),
('MMXXII09', '1a79a4d60de6718e8e5b326e338ae533', 'sortizca@unsa.edu.pe', 'docente'),
('MMXXII10', '1a79a4d60de6718e8e5b326e338ae533', 'cveran@unsa.edu.pe', 'docente'),
('MMXXII11', '1a79a4d60de6718e8e5b326e338ae533', 'ycereceda@unsa.edu.pe', 'docente'),
('MMXXII12', '1a79a4d60de6718e8e5b326e338ae533', 'rrivas@unsa.edu.pe', 'docente'),
('MMXXII13', '1a79a4d60de6718e8e5b326e338ae533', 'evelasquezl@unsa.edu.pe', 'docente'),
('MMXXII14', '1a79a4d60de6718e8e5b326e338ae533', 'jcruzto@unsa.edu.pe', 'docente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `1702120a_asistencia`
--
ALTER TABLE `1702120a_asistencia`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702120a_calificaciones`
--
ALTER TABLE `1702120a_calificaciones`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702120a_datos`
--
ALTER TABLE `1702120a_datos`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702120a_informacion_y_estadistica`
--
ALTER TABLE `1702120a_informacion_y_estadistica`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `1702120b_asistencia`
--
ALTER TABLE `1702120b_asistencia`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702120b_calificaciones`
--
ALTER TABLE `1702120b_calificaciones`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702120b_datos`
--
ALTER TABLE `1702120b_datos`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702120b_informacion_y_estadistica`
--
ALTER TABLE `1702120b_informacion_y_estadistica`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `1702122a_asistencia`
--
ALTER TABLE `1702122a_asistencia`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702122a_calificaciones`
--
ALTER TABLE `1702122a_calificaciones`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702122a_datos`
--
ALTER TABLE `1702122a_datos`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702122a_informacion_y_estadistica`
--
ALTER TABLE `1702122a_informacion_y_estadistica`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `1702122b_asistencia`
--
ALTER TABLE `1702122b_asistencia`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702122b_calificaciones`
--
ALTER TABLE `1702122b_calificaciones`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702122b_datos`
--
ALTER TABLE `1702122b_datos`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `1702122b_informacion_y_estadistica`
--
ALTER TABLE `1702122b_informacion_y_estadistica`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `historico_notas`
--
ALTER TABLE `historico_notas`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `semestre_actual`
--
ALTER TABLE `semestre_actual`
  ADD PRIMARY KEY (`cui`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `1702120a_informacion_y_estadistica`
--
ALTER TABLE `1702120a_informacion_y_estadistica`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `1702120b_informacion_y_estadistica`
--
ALTER TABLE `1702120b_informacion_y_estadistica`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `1702122a_informacion_y_estadistica`
--
ALTER TABLE `1702122a_informacion_y_estadistica`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `1702122b_informacion_y_estadistica`
--
ALTER TABLE `1702122b_informacion_y_estadistica`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
