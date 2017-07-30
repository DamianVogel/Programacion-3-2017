-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2017 at 05:28 PM
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
(26, 'PRUEBAWEB', 'PRUEBAWEB', 'PRUEBAWEB', 'EMPLEADO', 'HABILITADO', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_EMPLEADO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
