-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2018 a las 01:42:47
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp_salajuegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadas`
--

CREATE TABLE `jugadas` (
  `id_jugada` int(11) NOT NULL,
  `Nombre_juego` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Nombre_usuario` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Resultado` tinyint(1) NOT NULL,
  `Fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `jugadas`
--

INSERT INTO `jugadas` (`id_jugada`, `Nombre_juego`, `Nombre_usuario`, `Resultado`, `Fecha_hora`) VALUES
(1, 'Piedra Papel o Tijera', 'UsuarioJuego', 1, '2018-10-22 23:51:11'),
(2, 'Anagrama', 'lnpollola', 1, '2018-10-23 00:44:02'),
(3, 'Adivina el número', 'Adivina el número', 1, '2018-10-23 23:21:27'),
(4, 'Adivina el número', 'Adivina el número', 1, '2018-10-23 23:23:01'),
(5, 'Adivina el número', 'Adivina el número', 1, '2018-10-23 23:25:39'),
(6, 'Adivina el número', 'Adivina el número', 1, '2018-10-23 23:27:22'),
(7, 'Adivina el número', 'NN', 1, '2018-10-23 23:29:52'),
(8, 'Adivina el número', 'NN', 1, '2018-10-23 23:39:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `Password` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Email` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `Nombre`, `Usuario`, `Password`, `Email`) VALUES
(1, 'Administrador', 'admin', 'admin', ''),
(2, 'Usuario', 'usuario', 'usuario', ''),
(3, 'Leandro', 'lnpollola', '123456', 'leandro.pollola@hotmail.com'),
(4, 'Leandro Pollola', 'eeee', '1234', 'leandro.pollola@hotmail.com'),
(5, 'JESUS', 'santisimatrinidad', 'diosesvida', 'alabadoseael@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jugadas`
--
ALTER TABLE `jugadas`
  ADD PRIMARY KEY (`id_jugada`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jugadas`
--
ALTER TABLE `jugadas`
  MODIFY `id_jugada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
