-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2017 a las 01:36:23
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.1.4

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
  `TIPO` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `RESERVADO` int(11) NOT NULL,
  `ESTADO_ACTUAL` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `HABILITADA` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estacionamientos`
--

CREATE TABLE `estacionamientos` (
  `ID_ESTACIONAMIENTO` int(11) NOT NULL,
  `ID_PISO` int(11) NOT NULL,
  `CANT_COCHERAS` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='Tabla de Estacionamientos (con pisos y cant. cocheras)';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `ID_LOGIN` int(11) NOT NULL,
  `TIMESTAMP_LOGIN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TIPO_INGRESO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `USUARIO_INGRESADO` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `PASSWORD_INGRESADO` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_empleados`
--

CREATE TABLE `logs_empleados` (
  `ID_LOG_EMPLEADO` int(11) NOT NULL,
  `ID_EMPLEADO` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `HORA_ENTRADA` time NOT NULL,
  `HORA_SALIDA` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `ID_OPERACION` int(11) NOT NULL,
  `ID_COCHERA` int(11) NOT NULL,
  `ID_VEHICULO` int(11) NOT NULL,
  `ID_EMPLEADO` int(11) NOT NULL,
  `HORA_INGRESO` time NOT NULL,
  `HORA_SALIDA` time NOT NULL,
  `CANT_HORAS` int(11) NOT NULL,
  `ID_TARIFA` int(11) NOT NULL,
  `IMPORTE` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pisos`
--

CREATE TABLE `pisos` (
  `ID_PISO` int(11) NOT NULL,
  `HABILITADO` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `ID_TARIFA` int(11) NOT NULL,
  `DESC_TARIFA` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `IMPORTE` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
  `ESTADO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_EMPLEADO`, `NOMBRE`, `TURNO`, `PASSWORD`, `TIPO`, `ESTADO`) VALUES
(1, 'LEANDRO', 'MAÑANA', '1234', 'ADMIN', 'HABILITADO'),
(2, 'JULIO', 'TARDE', '5678', 'EMPLEADO', 'HABILITADO'),
(6, 'PEPE', 'NOCHE', '7890', 'EMPLEADO', 'DESHABILITADO'),
(9, 'TOTO', 'TARDE', '[object HTMLInputEle', 'EMPLEADO', 'HABILITADO');

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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cocheras`
--
ALTER TABLE `cocheras`
  ADD PRIMARY KEY (`ID_COCHERA`);

--
-- Indices de la tabla `estacionamientos`
--
ALTER TABLE `estacionamientos`
  ADD PRIMARY KEY (`ID_ESTACIONAMIENTO`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`ID_LOGIN`);

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
-- Indices de la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD PRIMARY KEY (`ID_PISO`);

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
  MODIFY `ID_COCHERA` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estacionamientos`
--
ALTER TABLE `estacionamientos`
  MODIFY `ID_ESTACIONAMIENTO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `ID_LOGIN` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `logs_empleados`
--
ALTER TABLE `logs_empleados`
  MODIFY `ID_LOG_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `ID_OPERACION` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pisos`
--
ALTER TABLE `pisos`
  MODIFY `ID_PISO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `ID_TARIFA` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `ID_VEHICULO` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
