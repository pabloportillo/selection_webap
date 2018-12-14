-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2018 a las 08:43:27
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

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
-- Estructura de tabla para la tabla `archivossubidos`
--

CREATE TABLE `archivossubidos` (
  `id` int(10) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Archivo` mediumblob NOT NULL,
  `solicitude_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `archivossubidos`
--

INSERT INTO `archivossubidos` (`id`, `Descripcion`, `Archivo`, `solicitude_id`) VALUES
(1, 'archivo para solicitud 1', 0x434352434c6f67676572302e6c6f67, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `PuntuacionMax` varchar(10) NOT NULL,
  `solicitude_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `Descripcion`, `PuntuacionMax`, `solicitude_id`) VALUES
(7, 'categoria solicitud 2.1', '10', 2),
(8, 'Categoria solicitud 1.1', '10', 1),
(9, 'Categoria solicitud 1.2', '10', 1),
(10, 'Categoria solicitud 2.2', '10', 2),
(11, 'Categoria solicitud 2.3', '10', 2),
(13, 'Categoria solicitud 1.3', '10', 1),
(17, 'asdfasdf', 'asdfasdf', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(10) NOT NULL,
  `CIF` varchar(9) NOT NULL,
  `NombreEmpresa` varchar(200) NOT NULL,
  `NombreContacto` varchar(60) DEFAULT NULL,
  `ApellidoContacto` varchar(200) DEFAULT NULL,
  `TelefonoContacto` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `CIF`, `NombreEmpresa`, `NombreContacto`, `ApellidoContacto`, `TelefonoContacto`) VALUES
(1, 'R2334219I', 'Ingenia', 'Recepción', '', '987654321'),
(2, 'N8263680D', 'Telefonica', 'Recepción', '', '987432121'),
(4, 'E19864602', 'Endesa', 'Recepción', '', '987123234'),
(5, 'G66060195', 'Gas Natural', 'Recepción', '', '987423123'),
(12, 'P8579197H', 'Grupo Santander', 'Recepción', '', '987654321');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluadorsolicitanterequisitos`
--

CREATE TABLE `evaluadorsolicitanterequisitos` (
  `id` int(10) NOT NULL,
  `DescripcionEvaluacion` varchar(100) DEFAULT NULL,
  `Validado` tinyint(1) NOT NULL,
  `FechaCreacion` date NOT NULL,
  `FechaEvaluacion` date DEFAULT NULL,
  `Reclamacion` tinyint(1) NOT NULL,
  `Usuario_id` int(10) NOT NULL,
  `Requisito_id` int(10) NOT NULL,
  `solicitante_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meritos`
--

CREATE TABLE `meritos` (
  `id` int(10) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Puntuacion` varchar(10) NOT NULL,
  `solicitude_id` int(10) NOT NULL,
  `categoria_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `meritos`
--

INSERT INTO `meritos` (`id`, `Descripcion`, `Puntuacion`, `solicitude_id`, `categoria_id`) VALUES
(21, 'Merito solicitud 2 categoria 2', '209', 2, 7),
(22, 'Nuevo Merito', '99', 2, 7),
(23, 'asdf', '1234', 1, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

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
-- Estructura de tabla para la tabla `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20180417120056, 'Changearchivossubidos', '2018-04-17 12:10:47', '2018-04-17 12:10:47', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisitos`
--

CREATE TABLE `requisitos` (
  `id` int(10) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Solicitude_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `requisitos`
--

INSERT INTO `requisitos` (`id`, `Descripcion`, `Solicitude_id`) VALUES
(1, 'Master AAA', 1),
(3, 'Menos de 30 años', 2),
(6, 'Varon', 2),
(7, 'Soltero', 2),
(8, 'de Málaga', 2),
(10, 'Requisito Solicitud 3', 4),
(11, 'Requisito Solicitud 3.1', 4),
(12, 'Requisito nuevo', 2),
(13, 'asdfasdfasdfasdf', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(10) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(3550) NOT NULL,
  `FechaCreacion` date NOT NULL,
  `FechaAltaSolicitud` date NOT NULL,
  `FechaBajaSolicitud` date NOT NULL,
  `FechaAltaReclamacion` date NOT NULL,
  `FechaBajaReclamacion` date NOT NULL,
  `FechaEvaluacion` date NOT NULL,
  `ListadoProvisional` mediumblob,
  `ListadoDefinitivo` mediumblob,
  `UltimaFase` mediumblob,
  `Visible` tinyint(1) NOT NULL,
  `Usuario_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `Nombre`, `Descripcion`, `FechaCreacion`, `FechaAltaSolicitud`, `FechaBajaSolicitud`, `FechaAltaReclamacion`, `FechaBajaReclamacion`, `FechaEvaluacion`, `ListadoProvisional`, `ListadoDefinitivo`, `UltimaFase`, `Visible`, `Usuario_id`) VALUES
(1, 'Solicitud 1', 'Esta es la solicitud 1', '2018-03-01', '2018-03-02', '2018-03-03', '2018-03-04', '2018-03-05', '2018-03-06', NULL, NULL, NULL, 1, 1),
(2, 'Solicitud 2', 'Solicitud número 2', '2018-03-20', '2018-03-20', '2018-03-20', '2018-03-20', '2018-03-20', '2018-03-20', NULL, NULL, NULL, 0, 6),
(4, 'Solicitud 3', 'Esta es la solicitud 3', '2018-04-09', '2018-04-09', '2018-04-10', '2018-04-12', '2018-04-15', '2018-04-18', NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `Apellidos` varchar(200) NOT NULL,
  `Dni` varchar(9) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Email` varchar(60) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Perfile_id` int(10) NOT NULL,
  `Empresa_id` int(10) DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `Nombre`, `Apellidos`, `Dni`, `Direccion`, `Email`, `Contraseña`, `Telefono`, `Perfile_id`, `Empresa_id`, `Activo`) VALUES
(1, 'Pablo', 'Portillo', '', '', 'portillo@gmail.com', '516a8bbd4bb92e4abd357ae2d04ad95b', '653225032', 1, NULL, 1),
(2, 'Jorge', 'Castro', '', '', 'Jorge@gmail.com', '516a8bbd4bb92e4abd357ae2d04ad95b', '987654321', 2, 2, 1),
(3, 'Rosa', 'Gonzalez', '19261675A', '', 'oneofthefigureheadsofthegenre@gmail.com', '516a8bbd4bb92e4abd357ae2d04ad95b', '987784512', 5, NULL, 1),
(4, 'Laura', 'Ruiz', '', '', 'laura@gmail.com', '516a8bbd4bb92e4abd357ae2d04ad95b', '987123132', 3, 5, 0),
(5, 'Javier', 'Guerrero', '', '', 'Javier@gmail.com', '516a8bbd4bb92e4abd357ae2d04ad95b', '987234126', 4, 12, 1),
(6, 'Luis Manuel', 'García', '74938601r', '', 'luis@gmail.com', '6f709ec49941de7e497687b0720e80af', '987123987', 5, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivossubidos`
--
ALTER TABLE `archivossubidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ArchivosSubidos_solicitudes1_idx` (`solicitude_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Categorias_solicitudes1_idx` (`solicitude_id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CIF_UNIQUE` (`CIF`),
  ADD UNIQUE KEY `NombreEmpresa_UNIQUE` (`NombreEmpresa`);

--
-- Indices de la tabla `evaluadorsolicitanterequisitos`
--
ALTER TABLE `evaluadorsolicitanterequisitos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_EvaluadorSolicitanteRequisitos_Usuarios1_idx` (`Usuario_id`),
  ADD KEY `fk_EvaluadorSolicitanteRequisitos_Requisitos1_idx` (`Requisito_id`),
  ADD KEY `fk_evaluadorsolicitanterequisitos_solicitantes1_idx` (`solicitante_id`);

--
-- Indices de la tabla `meritos`
--
ALTER TABLE `meritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Meritos_solicitudes1_idx` (`solicitude_id`),
  ADD KEY `fk_Meritos_Categorias1_idx` (`categoria_id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Nombre_UNIQUE` (`Nombre`);

--
-- Indices de la tabla `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `requisitos`
--
ALTER TABLE `requisitos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Requisitos_Solicitudes1_idx` (`Solicitude_id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Solicitud_Usuarios1_idx` (`Usuario_id`);

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
-- AUTO_INCREMENT de la tabla `archivossubidos`
--
ALTER TABLE `archivossubidos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `evaluadorsolicitanterequisitos`
--
ALTER TABLE `evaluadorsolicitanterequisitos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `meritos`
--
ALTER TABLE `meritos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `requisitos`
--
ALTER TABLE `requisitos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivossubidos`
--
ALTER TABLE `archivossubidos`
  ADD CONSTRAINT `fk_ArchivosSubidos_solicitudes1` FOREIGN KEY (`solicitude_id`) REFERENCES `solicitudes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_Categorias_solicitudes1` FOREIGN KEY (`solicitude_id`) REFERENCES `solicitudes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluadorsolicitanterequisitos`
--
ALTER TABLE `evaluadorsolicitanterequisitos`
  ADD CONSTRAINT `evaluadorsolicitanterequisitos_ibfk_1` FOREIGN KEY (`solicitante_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `fk_EvaluadorSolicitanteRequisitos_Requisitos1` FOREIGN KEY (`Requisito_id`) REFERENCES `requisitos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_EvaluadorSolicitanteRequisitos_Usuarios1` FOREIGN KEY (`Usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `meritos`
--
ALTER TABLE `meritos`
  ADD CONSTRAINT `fk_Meritos_Categorias1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Meritos_solicitudes1` FOREIGN KEY (`solicitude_id`) REFERENCES `solicitudes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `requisitos`
--
ALTER TABLE `requisitos`
  ADD CONSTRAINT `fk_Requisitos_Solicitudes1` FOREIGN KEY (`Solicitude_id`) REFERENCES `solicitudes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `fk_Solicitud_Usuarios1` FOREIGN KEY (`Usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
