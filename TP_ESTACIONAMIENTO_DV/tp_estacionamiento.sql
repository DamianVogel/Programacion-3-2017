-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2018 a las 02:39:03
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
(4, 104, 0, 1),
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
-- Estructura de tabla para la tabla `helados`
--

CREATE TABLE `helados` (
  `id_helado` int(3) NOT NULL,
  `Sabor` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `Tipo` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `Kilos` varchar(50) COLLATE utf16_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `helados`
--

INSERT INTO `helados` (`id_helado`, `Sabor`, `Tipo`, `Kilos`) VALUES
(1, 'Menta', 'Crema', '5'),
(2, 'Chocolate', 'Crema', '2'),
(3, 'pruebaPost', 'pruebaPost', 'pruebaPost'),
(4, 'PruebaPost2', 'PruebaPost2', 'PruebaPost2'),
(5, 'Dulce de leche', 'Crema', '6'),
(6, 'Dulce de leche', 'Crema', '6'),
(7, 'Dulce de leche', 'Crema', '6'),
(26, 'Crema del Cielo', 'Crema', '1'),
(27, 'Crema del Cielo', 'Crema', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id_juego` int(3) NOT NULL,
  `juego` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `jugador` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `gano` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id_juego`, `juego`, `jugador`, `gano`) VALUES
(1, 'JuegoAdivina', 'Jugador1', 1),
(2, 'JuegoAdivina', 'Juan', 0),
(3, 'JuegoAdivina', 'Pepe', 1),
(4, 'prueba', 'prueba', 0),
(5, 'prueba', 'prueba', 1),
(6, 'prueba', 'prueba', 1),
(7, 'pruebapost', 'pruebapost', 0),
(8, 'pruebapost', 'pruebapost', 1),
(9, 'pruebapost1', 'pruebapost1', 1),
(10, 'pruebapost2', 'pruebapost2', 1),
(11, 'AgilidadAritmetica', 'pruebaDV', 1),
(12, 'AgilidadAritmetica', 'pruebaDV', 0),
(13, 'AgilidadAritmetica', 'pruebaDV', 0),
(14, 'AgilidadAritmetica', 'pruebaDV', 0),
(15, 'AgilidadAritmetica', 'Array', 0),
(16, 'AgilidadAritmetica', 'asd@asd.com', 0),
(17, 'AgilidadAritmetica', 'asd@asd.com', 1);

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
(4, 1, '2017-07-23', '18:36:20', '00:32:37'),
(7, 2, '2017-07-23', '18:52:35', '20:55:38'),
(8, 1, '2017-07-24', '01:00:02', '00:32:37'),
(9, 1, '2017-07-25', '20:44:58', '00:32:37'),
(10, 1, '2017-07-25', '20:46:18', '00:32:37'),
(11, 1, '2017-07-25', '20:50:01', '00:32:37'),
(12, 2, '2017-07-25', '20:50:36', '20:55:38'),
(13, 1, '2017-07-25', '20:56:40', '00:32:37'),
(14, 1, '2017-07-25', '21:27:50', '00:32:37'),
(15, 1, '2017-07-25', '22:25:12', '00:32:37'),
(16, 1, '2017-07-25', '22:25:12', '00:32:37'),
(17, 1, '2017-07-25', '22:25:36', '00:32:37'),
(18, 1, '2017-07-26', '00:07:35', '00:32:37'),
(19, 1, '2017-07-26', '00:07:35', '00:32:37'),
(20, 1, '2017-07-26', '00:32:41', NULL),
(21, 1, '2017-07-26', '00:32:41', NULL),
(22, 1, '2017-07-30', '13:59:54', NULL),
(23, 1, '2017-07-30', '17:13:26', NULL),
(24, 1, '2018-10-13', '20:57:41', NULL),
(25, 1, '2018-10-13', '21:00:29', NULL),
(26, 1, '2018-10-13', '21:00:29', NULL),
(27, 1, '2018-10-13', '21:07:18', NULL),
(28, 1, '2018-10-13', '21:07:18', NULL),
(29, 1, '2018-10-13', '21:09:46', NULL),
(30, 1, '2018-10-13', '21:09:46', NULL),
(31, 1, '2018-10-13', '21:11:30', NULL),
(32, 1, '2018-10-13', '21:11:30', NULL),
(33, 1, '2018-10-13', '21:12:43', NULL),
(34, 1, '2018-10-13', '21:12:43', NULL),
(35, 1, '2018-10-13', '21:13:48', NULL),
(36, 1, '2018-10-13', '21:13:48', NULL),
(37, 1, '2018-10-13', '21:14:23', NULL),
(38, 1, '2018-10-13', '21:14:23', NULL),
(39, 1, '2018-10-13', '21:16:12', NULL),
(40, 1, '2018-10-13', '21:16:12', NULL),
(41, 1, '2018-10-13', '21:16:45', NULL),
(42, 1, '2018-10-13', '21:16:45', NULL),
(43, 1, '2018-10-13', '21:20:49', NULL),
(44, 1, '2018-10-13', '21:20:49', NULL),
(45, 1, '2018-10-13', '21:54:02', NULL),
(46, 1, '2018-10-13', '21:54:02', NULL),
(47, 1, '2018-10-13', '10:08:21', NULL),
(48, 1, '2018-10-13', '10:08:21', NULL),
(49, 1, '2018-10-13', '10:24:48', NULL),
(50, 1, '2018-10-13', '10:40:45', NULL),
(51, 1, '2018-10-13', '10:44:24', NULL),
(52, 1, '2018-10-13', '10:49:23', NULL),
(53, 1, '2018-10-13', '10:50:11', NULL),
(54, 1, '2018-10-13', '13:34:47', NULL),
(55, 1, '2018-10-13', '13:34:56', NULL),
(56, 1, '2018-10-13', '13:34:56', NULL),
(57, 1, '2018-10-13', '13:34:56', NULL),
(58, 1, '2018-10-13', '13:34:57', NULL),
(59, 1, '2018-10-13', '13:34:57', NULL),
(60, 1, '2018-10-13', '13:34:57', NULL),
(61, 1, '2018-10-13', '13:34:57', NULL),
(62, 1, '2018-10-13', '13:35:14', NULL),
(63, 1, '2018-10-13', '13:35:14', NULL),
(64, 1, '2018-10-13', '13:35:14', NULL),
(65, 1, '2018-10-13', '13:35:14', NULL),
(66, 1, '2018-10-13', '13:35:15', NULL),
(67, 1, '2018-10-13', '13:35:29', NULL),
(68, 1, '2018-10-13', '13:35:29', NULL),
(69, 1, '2018-10-13', '13:35:29', NULL),
(70, 1, '2018-10-13', '13:35:29', NULL),
(71, 1, '2018-10-13', '13:35:30', NULL),
(72, 1, '2018-10-13', '13:36:37', NULL),
(73, 1, '2018-10-13', '13:36:37', NULL),
(74, 1, '2018-10-13', '13:36:38', NULL),
(75, 1, '2018-10-13', '13:37:03', NULL),
(76, 1, '2018-10-13', '13:37:04', NULL),
(77, 1, '2018-10-13', '13:37:04', NULL),
(78, 1, '2018-10-13', '13:37:04', NULL),
(79, 1, '2018-10-13', '13:38:06', NULL),
(80, 1, '2018-10-13', '13:38:51', NULL),
(81, 1, '2018-10-13', '16:00:39', NULL),
(82, 1, '2018-10-13', '16:02:30', NULL),
(83, 1, '2018-10-13', '16:04:38', NULL),
(84, 1, '2018-10-13', '16:05:17', NULL),
(85, 1, '2018-10-13', '16:06:07', NULL),
(86, 1, '2018-10-13', '16:07:09', NULL),
(87, 1, '2018-10-13', '16:09:44', NULL),
(88, 1, '2018-10-13', '16:11:09', NULL),
(89, 1, '2018-10-14', '09:49:30', NULL),
(90, 1, '2018-10-14', '10:16:50', NULL),
(91, 1, '2018-10-15', '20:22:39', NULL),
(92, 1, '2018-10-15', '21:21:57', NULL),
(93, 1, '2018-10-15', '21:48:39', NULL),
(94, 1, '2018-10-15', '21:50:28', NULL),
(95, 1, '2018-10-15', '21:57:14', NULL),
(96, 1, '2018-10-15', '21:57:51', NULL),
(97, 1, '2018-10-15', '22:09:25', NULL),
(98, 1, '2018-10-15', '22:11:35', NULL),
(99, 1, '2018-10-15', '12:01:49', NULL),
(100, 1, '2018-10-15', '12:57:24', NULL),
(101, 1, '2018-10-15', '13:08:38', NULL),
(102, 1, '2018-10-15', '13:43:41', NULL),
(103, 1, '2018-10-15', '13:44:56', NULL),
(104, 1, '2018-10-15', '13:53:20', NULL),
(105, 1, '2018-10-15', '13:58:45', NULL),
(106, 1, '2018-10-15', '14:02:03', NULL),
(107, 1, '2018-10-15', '14:12:40', NULL),
(108, 1, '2018-10-15', '16:26:02', NULL),
(109, 1, '2018-10-15', '16:28:28', NULL),
(110, 1, '2018-10-15', '16:35:11', NULL),
(111, 1, '2018-10-16', '20:52:23', NULL),
(112, 1, '2018-10-16', '21:54:47', NULL),
(113, 1, '2018-10-17', '20:13:21', NULL),
(114, 1, '2018-10-17', '20:13:21', NULL),
(115, 1, '2018-10-17', '20:13:26', NULL),
(116, 1, '2018-10-17', '20:13:26', NULL),
(117, 1, '2018-10-17', '20:13:26', NULL),
(118, 1, '2018-10-17', '20:13:26', NULL),
(119, 1, '2018-10-17', '20:13:27', NULL),
(120, 1, '2018-10-17', '20:13:27', NULL),
(121, 1, '2018-10-17', '20:13:27', NULL),
(122, 1, '2018-10-17', '20:13:27', NULL),
(123, 1, '2018-10-17', '20:13:27', NULL),
(124, 1, '2018-10-17', '20:13:27', NULL),
(125, 1, '2018-10-17', '20:13:27', NULL),
(126, 1, '2018-10-17', '20:13:27', NULL),
(127, 1, '2018-10-17', '20:15:37', NULL),
(128, 1, '2018-10-17', '20:15:37', NULL),
(129, 1, '2018-10-17', '20:16:26', NULL),
(130, 1, '2018-10-17', '20:17:18', NULL),
(131, 1, '2018-10-17', '21:31:29', NULL),
(132, 1, '2018-10-17', '21:35:15', NULL),
(133, 1, '2018-10-17', '21:39:27', NULL),
(134, 1, '2018-10-17', '21:45:33', NULL),
(135, 1, '2018-10-17', '21:46:42', NULL),
(136, 1, '2018-10-17', '21:58:40', NULL),
(137, 1, '2018-10-18', '20:31:33', NULL),
(138, 1, '2018-10-18', '20:53:03', NULL),
(139, 1, '2018-10-18', '21:58:20', NULL),
(140, 1, '2018-10-18', '22:12:05', NULL),
(141, 1, '2018-10-20', '21:54:30', NULL),
(142, 2, '2018-10-20', '21:57:21', NULL),
(143, 2, '2018-10-20', '16:22:58', NULL),
(144, 2, '2018-10-20', '16:24:03', NULL),
(145, 2, '2018-10-20', '16:27:32', NULL),
(146, 2, '2018-10-20', '16:29:17', NULL),
(147, 1, '2018-10-20', '16:30:03', NULL);

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
(17, 2, 131, 2, '2017-07-24 01:25:32', '2017-07-25 23:22:05', 45.9333, NULL),
(16, 4, 130, 1, '2017-07-24 01:25:13', '2017-07-25 23:10:38', 45.75, NULL),
(15, 4, 129, 1, '2017-07-24 01:24:15', '2017-07-25 23:08:48', 45.7333, NULL),
(14, 5, 128, 1, '2017-07-24 01:14:25', '2017-07-24 01:14:36', 0, 90),
(13, 5, 127, 3, '2017-07-24 01:14:18', '2017-07-28 13:00:00', 134, 400),
(12, 5, 126, 2, '2017-07-24 01:02:14', '2017-07-24 07:00:00', 111, 170),
(11, 4, 125, 1, '2017-07-24 01:00:09', '2017-07-24 01:03:28', 0.05, 10),
(18, 6, 134, 1, '2017-07-25 23:06:16', '2017-07-25 23:07:56', 0.0166667, NULL);

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
  `ID_USUARIO` int(11) NOT NULL,
  `NOMBRE` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `TURNO` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `PASSWORD` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `TIPO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `ESTADO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `ESTADO_BASE` int(11) NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `NOMBRE`, `TURNO`, `PASSWORD`, `TIPO`, `ESTADO`, `ESTADO_BASE`, `EMAIL`) VALUES
(1, 'LEANDRO', 'MAÑANA', '1234', 'ADMIN', 'DESHABILITADO', 1, ''),
(2, 'ADMIN', 'NOCHE', 'ADMIN', 'ADMIN', 'HABILITADO', 0, ''),
(6, 'NUEVONOMBRE', 'OTROTURNO', '7890', 'EMPLEADO', 'DESHABILITADO', 1, ''),
(24, 'PRUEBAWEB', 'PRUEBAWEB', 'PRUEBAWEB', 'EMPLEADO', 'HABILITADO', 1, ''),
(23, 'OCTAVIO', 'NOCHE', 'UTNFRA', 'EMPLEADO', 'HABILITADO', 0, ''),
(22, 'OTRONOMBRE', 'MAÑANA', 'IZQUIERDA', 'EMPLEADO', 'HABILITADO', 0, ''),
(25, 'PRUEBAWEB', 'PRUEBAWEB', 'PRUEBAWEB', 'EMPLEADO', 'HABILITADO', 1, ''),
(26, 'PRUEBAWEB', 'PRUEBAWEB', 'PRUEBAWEB', 'EMPLEADO', 'HABILITADO', 1, ''),
(27, 'PRUEBAWEB', 'PRUEBAWEB', 'PRUEBAWEB', 'EMPLEADO', 'HABILITADO', 1, ''),
(28, '', '', '1234', '', '', 0, 'asd@asd.com'),
(29, '', '', '1234', '', '', 0, 'asd123@asd.com'),
(30, '', '', '1234qweqwe', '', '', 0, 'asd123@asd.comweqwe'),
(31, '', '', '1234', '', '', 0, 'rodolfovogel@gmail.c'),
(32, '', '', '1234', '', '', 0, 'rodolfovogel@gmail.c');

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
(131, 'AAA00', 'NEGRO', 'cahevyu', '0'),
(132, 'WEB111', 'COLORINTERNET', 'YAHOO', '1'),
(133, 'AABBBB', 'ahoraEsRojo', 'otroVW', '1'),
(134, 'PRIMEROWEB', 'color1', 'google', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cocheras`
--
ALTER TABLE `cocheras`
  ADD PRIMARY KEY (`ID_COCHERA`);

--
-- Indices de la tabla `helados`
--
ALTER TABLE `helados`
  ADD PRIMARY KEY (`id_helado`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id_juego`);

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
  ADD PRIMARY KEY (`ID_USUARIO`);

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
-- AUTO_INCREMENT de la tabla `helados`
--
ALTER TABLE `helados`
  MODIFY `id_helado` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id_juego` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `logs_empleados`
--
ALTER TABLE `logs_empleados`
  MODIFY `ID_LOG_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `ID_OPERACION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `ID_TARIFA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `ID_VEHICULO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
