-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-07-2017 a las 19:02:14
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT ;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS ;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION ;
SET NAMES utf8mb4 ;

--
-- Base de datos: `tp_estacionamiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cocheras`
--

CREATE TABLE `cocheras` (
  `ID_COCHERA` int(11) NOT NULL,
  `NRO_COCHERA` int(11) NOT NULL,
  `RESERVADO` int(11) NOT NULL,
  `HABILITADA` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cocheras`
--

INSERT INTO `cocheras` (`ID_COCHERA`, `NRO_COCHERA`, `RESERVADO`, `HABILITADA`) VALUES
(1, 101, 1, 1),
(2, 102, 1, 1),
(3, 103, 1, 1),
(4, 104, 0, 0),
(5, 205, 0, 0),
(6, 206, 0, 1),
(7, 207, 0, 1),
(8, 308, 0, 1),
(9, 309, 0, 1),
(10, 310, 0, 1),
(11, 311, 0, 1),
(12, 312, 0, 1),
(13, 313, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_empleados`
--

CREATE TABLE `logs_empleados` (
  `ID_LOG_EMPLEADO` int(11) NOT NULL,
  `ID_EMPLEADO` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `HORA_ENTRADA` time NOT NULL,
  `HORA_SALIDA` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `logs_empleados`
--

INSERT INTO `logs_empleados` (`ID_LOG_EMPLEADO`, `ID_EMPLEADO`, `FECHA`, `HORA_ENTRADA`, `HORA_SALIDA`) VALUES
(6, 6, '2017-07-23', '18:51:56', NULL),
(5, 3, '2017-07-23', '18:40:37', '18:57:28'),
(4, 1, '2017-07-23', '18:36:20', '18:57:28'),
(7, 2, '2017-07-23', '18:52:35', '18:54:02'),
(8, 1, '2017-07-24', '01:00:02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `ID_OPERACION` int(11) NOT NULL,
  `ID_COCHERA` int(11) NOT NULL,
  `ID_VEHICULO` int(11) NOT NULL,
  `ID_EMPLEADO` int(11) NOT NULL,
  `FECHA_HORA_INGRESO` datetime NOT NULL,
  `FECHA_HORA_SALIDA` datetime DEFAULT NULL,
  `CANT_HORAS` float DEFAULT NULL,
  `IMPORTE` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`ID_OPERACION`, `ID_COCHERA`, `ID_VEHICULO`, `ID_EMPLEADO`, `FECHA_HORA_INGRESO`, `FECHA_HORA_SALIDA`, `CANT_HORAS`, `IMPORTE`) VALUES
(17, 2, 131, 1, '2017-07-24 01:25:32', NULL, NULL, NULL),
(16, 4, 130, 1, '2017-07-24 01:25:13', NULL, NULL, NULL),
(15, 4, 129, 1, '2017-07-24 01:24:15', NULL, NULL, NULL),
(14, 5, 128, 1, '2017-07-24 01:14:25', '2017-07-24 01:14:36', 0, 90),
(13, 5, 127, 1, '2017-07-24 01:14:18', '2017-07-28 13:00:00', 134, 400),
(12, 5, 126, 1, '2017-07-24 01:02:14', '2017-07-24 07:00:00', 111, 170),
(11, 4, 125, 1, '2017-07-24 01:00:09', '2017-07-24 01:03:28', 0.05, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `ID_TARIFA` int(11) NOT NULL,
  `DESC_TARIFA` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `IMPORTE` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`ID_TARIFA`, `DESC_TARIFA`, `IMPORTE`) VALUES
(1, 'HORA', 10),
(2, 'FIJO 1/2 ESTADIA', 90),
(3, 'FIJO ESTADIA', 170);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_EMPLEADO` int(11) NOT NULL,
  `NOMBRE` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `TURNO` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `PASSWORD` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `TIPO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `ESTADO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `ESTADO_BASE` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_EMPLEADO`, `NOMBRE`, `TURNO`, `PASSWORD`, `TIPO`, `ESTADO`, `ESTADO_BASE`) VALUES
(1, 'LEANDRO', 'MAÑANA', '1234', 'ADMIN', 'HABILITADO', 1),
(2, 'JULIO', 'TARDE', '5678', 'EMPLEADO', 'HABILITADO', 1),
(6, 'NUEVOPEPE', 'NOCHE', '7890', 'EMPLEADO', 'DESHABILITADO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `ID_VEHICULO` int(11) NOT NULL,
  `PATENTE` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `COLOR` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `MARCA` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `ESTADO` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`ID_VEHICULO`, `PATENTE`, `COLOR`, `MARCA`, `ESTADO`) VALUES
(128, 'I343193', 'BLANCO', 'NISSAN', '1'),
(124, 'YY66', 'Azul', 'VW', '1'),
(125, 'RR44', 'Azul', 'VW', '1'),
(126, 'RTT666', 'NBORRO', 'NISSAN', '1'),
(127, 'IIII9999', 'BLANCO', 'NISSAN', '1'),
(123, 'AA00E4444444', 'Azul', 'VW', '1'),
(122, 'AA00E', 'ahoraEsRojo', 'otroVW', '1'),
(121, 'AA00EFFFF', 'Azul', 'VW', '1'),
(129, 'AAPP00', 'NEGRO', 'ESAMARC', '1'),
(130, 'Aprkr9q9le', 'NEGRO', 'cahevyu', '1'),
(131, 'AAA00', 'NEGRO', 'cahevyu', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cocheras`
--
ALTER TABLE `cocheras`
  ADD PRIMARY KEY (`ID_COCHERA`);

--
-- Indices de la tabla `logs_empleados`
--
ALTER TABLE `logs_empleados`
  ADD PRIMARY KEY (`ID_LOG_EMPLEADO`);

--
-- Indices de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`ID_OPERACION`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`ID_TARIFA`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_EMPLEADO`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`ID_VEHICULO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cocheras`
--
ALTER TABLE `cocheras`
  MODIFY `ID_COCHERA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `logs_empleados`
--
ALTER TABLE `logs_empleados`
  MODIFY `ID_LOG_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `ID_OPERACION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `ID_TARIFA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `ID_VEHICULO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
