-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2018 a las 18:17:34
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
(32, '', '', 'qwer', '', '', 0, 'qwe@qwe.com'),
(33, '', '', 'asdf', '', '', 0, 'qwe@qwe.com'),
(34, '', '', '6789', '', '', 0, 'qwe@qwe.com'),
(35, '', '', '4567', '', '', 0, 'rodolfovogel@gmail.c'),
(36, '', '', '0000', '', '', 0, 'rodolfovogel@gmail.com'),
(37, '', '', '2222', '', '', 0, 'qwe@qwe.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
