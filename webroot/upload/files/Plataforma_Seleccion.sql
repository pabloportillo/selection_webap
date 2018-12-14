-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2018 a las 20:05:55
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `plataforma_seleccion`
--
CREATE DATABASE IF NOT EXISTS `plataforma_seleccion` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `plataforma_seleccion`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE `empresas` (
  `id` int(10) NOT NULL,
  `CIF` varchar(9) NOT NULL,
  `NombreEmpresa` varchar(200) NOT NULL,
  `NombreContacto` varchar(60) DEFAULT NULL,
  `TelefonoContacto` int(11) DEFAULT NULL,
  `ApellidoContacto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `CIF`, `NombreEmpresa`, `NombreContacto`, `TelefonoContacto`, `ApellidoContacto`) VALUES
(1, '987654', 'Ingenia', 'Recepción', 987654321, 'Recepción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE `perfiles` (
  `id` int(10) NOT NULL,
  `Nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `Nombre`) VALUES
(1, 'Admin'),
(2, 'Admin Empresa'),
(5, 'Solicitante'),
(4, 'Usuario Empresa Lectura'),
(3, 'Usuario Empresa Modificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes`
--

DROP TABLE IF EXISTS `solicitantes`;
CREATE TABLE `solicitantes` (
  `Dni` varchar(10) NOT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Usuario_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `Apellidos` varchar(200) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  `Empresa_id` int(10) NOT NULL,
  `Perfile_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `Telefono`, `Nombre`, `Apellidos`, `Contraseña`, `Email`, `Activo`, `Empresa_id`, `Perfile_id`) VALUES
(1, '653225032', 'Pablo', 'Portillo', 'c4ca4238a0b923820dcc509a6f75849b', 'portillo@gmail.com', 1, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CIF_UNIQUE` (`CIF`),
  ADD UNIQUE KEY `NombreEmpresa_UNIQUE` (`NombreEmpresa`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Nombre_UNIQUE` (`Nombre`);

--
-- Indices de la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  ADD PRIMARY KEY (`Dni`),
  ADD KEY `fk_Solicitante_Usuario1_idx` (`Usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email_UNIQUE` (`Email`),
  ADD KEY `Empresa_id` (`Empresa_id`),
  ADD KEY `Perfile_id` (`Perfile_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  ADD CONSTRAINT `fk_Solicitante_Usuario1` FOREIGN KEY (`Usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Empresa_id`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`Perfile_id`) REFERENCES `perfiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
