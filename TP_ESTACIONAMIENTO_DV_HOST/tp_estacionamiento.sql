-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2017 at 05:36 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id2356315_tp_estacionamiento`
--

-- --------------------------------------------------------

--
-- Table structure for table `cocheras`
--

CREATE TABLE `cocheras` (
  `ID_COCHERA` int(11) NOT NULL,
  `NRO_COCHERA` int(11) NOT NULL,
  `RESERVADO` int(11) NOT NULL,
  `HABILITADA` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `cocheras`
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
-- Table structure for table `logs_empleados`
--

CREATE TABLE `logs_empleados` (
  `ID_LOG_EMPLEADO` int(11) NOT NULL,
  `ID_EMPLEADO` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `HORA_ENTRADA` time NOT NULL,
  `HORA_SALIDA` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `logs_empleados`
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
(23, 1, '2017-07-30', '17:13:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `operaciones`
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
-- Dumping data for table `operaciones`
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
-- Table structure for table `tarifas`
--

CREATE TABLE `tarifas` (
  `ID_TARIFA` int(11) NOT NULL,
  `DESC_TARIFA` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `IMPORTE` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `tarifas`
--

INSERT INTO `tarifas` (`ID_TARIFA`, `DESC_TARIFA`, `IMPORTE`) VALUES
(1, 'HORA', 10),
(2, 'FIJO 1/2 ESTADIA', 90),
(3, 'FIJO ESTADIA', 170);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
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
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ID_EMPLEADO`, `NOMBRE`, `TURNO`, `PASSWORD`, `TIPO`, `ESTADO`, `ESTADO_BASE`) VALUES
(1, 'LEANDRO', 'MAÑANA', '1234', 'ADMIN', 'DESHABILITADO', 1),
(2, 'JULIO', 'TARDE', '5678', 'EMPLEADO', 'HABILITADO', 0),
(6, 'NUEVONOMBRE', 'OTROTURNO', '7890', 'EMPLEADO', 'DESHABILITADO', 1),
(24, 'PRUEBAWEB', 'PRUEBAWEB', 'PRUEBAWEB', 'EMPLEADO', 'HABILITADO', 1),
(23, 'OCTAVIO', 'NOCHE', 'UTNFRA', 'EMPLEADO', 'HABILITADO', 0),
(22, 'OTRONOMBRE', 'MAÑANA', 'IZQUIERDA', 'EMPLEADO', 'HABILITADO', 0),
(25, 'PRUEBAWEB', 'PRUEBAWEB', 'PRUEBAWEB', 'EMPLEADO', 'HABILITADO', 1),
(26, 'PRUEBAWEB', 'PRUEBAWEB', 'PRUEBAWEB', 'EMPLEADO', 'HABILITADO', 1),
(27, 'PRUEBAWEB', 'PRUEBAWEB', 'PRUEBAWEB', 'EMPLEADO', 'HABILITADO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehiculos`
--

CREATE TABLE `vehiculos` (
  `ID_VEHICULO` int(11) NOT NULL,
  `PATENTE` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `COLOR` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `MARCA` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `ESTADO` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `vehiculos`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `cocheras`
--
ALTER TABLE `cocheras`
  ADD PRIMARY KEY (`ID_COCHERA`);

--
-- Indexes for table `logs_empleados`
--
ALTER TABLE `logs_empleados`
  ADD PRIMARY KEY (`ID_LOG_EMPLEADO`);

--
-- Indexes for table `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`ID_OPERACION`);

--
-- Indexes for table `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`ID_TARIFA`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_EMPLEADO`);

--
-- Indexes for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`ID_VEHICULO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cocheras`
--
ALTER TABLE `cocheras`
  MODIFY `ID_COCHERA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `logs_empleados`
--
ALTER TABLE `logs_empleados`
  MODIFY `ID_LOG_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `ID_OPERACION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `ID_TARIFA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `ID_VEHICULO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
