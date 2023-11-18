-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2023 a las 18:41:57
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `osakidetza`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `colegiado` int(11) NOT NULL,
  `tarjeta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `hora` time NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`colegiado`, `tarjeta`, `fecha`, `tipo`, `hora`, `id`) VALUES
(4178, 87958, '2023-11-23', 'presencial', '18:00:00', 1),
(4178, 1234567, '2023-11-20', 'Consulta presencial', '08:00:00', 20),
(1478, 1234567, '2023-11-23', 'Digestivo', '08:00:00', 22),
(1478, 1234567, '2023-11-21', 'Digestivo', '09:00:00', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `nombre` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `ambulatorio` varchar(50) NOT NULL,
  `hospital` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`nombre`, `provincia`, `ambulatorio`, `hospital`) VALUES
('Barakaldo', 'Vizcaya', 'Zuazo', 'Cruces'),
('Bilbao', 'Vizcaya', 'Altamira', 'Basurto'),
('Guetaria', 'Guipuzcoa', 'Casa Ulpiano', ''),
('Hondarribia', 'Guipuzcoa', 'Matxin Arzu', ''),
('Murguía', 'Alava', 'Zuia-Murgía', ''),
('Muskiz', 'Vizcaya', 'Sendeja', ''),
('San Sebastian', 'Guipuzcoa', 'Gros', 'San Juan de Dios'),
('Vitoria', 'Alava', 'Aranbizkarra', 'Txagorritxu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnosticos`
--

CREATE TABLE `diagnosticos` (
  `id` int(50) NOT NULL,
  `tarjeta` int(11) NOT NULL,
  `colegiado` int(11) NOT NULL,
  `sintomas` text NOT NULL,
  `respuesta` text NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'pendiente',
  `comentarios` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `diagnosticos`
--

INSERT INTO `diagnosticos` (`id`, `tarjeta`, `colegiado`, `sintomas`, `respuesta`, `tipo`, `estado`, `comentarios`) VALUES
(16, 1234567, 4178, 'dolor de cabeza ', 'Posible diagnóstico: Migraña', 'autodiagnostico', 'aceptado', 'pide cita con el medico '),
(17, 1234567, 0, 'dolor de cabeza', 'covid', 'presencial', 'aceptado', 'quedarse en casa 14 dias y 1 paracetamol cada 8 horas durante la primera semana '),
(18, 1234567, 4178, 'dolor de garganta', 'gripe', 'telefonica', 'aceptado', 'reposo'),
(19, 1234567, 4178, 'dolor de cabeza, perdida de gusto y olfato, fiebre', 'Posible diagnóstico: COVID-19', 'autodiagnostico', 'pendiente', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sanitario`
--

CREATE TABLE `sanitario` (
  `nombre` varchar(200) NOT NULL,
  `colegiado` int(11) NOT NULL,
  `contra` varchar(30) NOT NULL,
  `especialidad` varchar(30) NOT NULL,
  `tipo_trabajo` varchar(30) NOT NULL,
  `trabajo` varchar(30) NOT NULL,
  `provincia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sanitario`
--

INSERT INTO `sanitario` (`nombre`, `colegiado`, `contra`, `especialidad`, `tipo_trabajo`, `trabajo`, `provincia`) VALUES
('Luis Pérez López', 1148, 'Luis1234', 'cardiologia', 'hospital', 'Basurto', 'Vizcaya'),
('Juan Arnaiz Cruz', 1178, 'Juan1234', 'enfermeria', 'ambulatorio', 'Altamira', 'Vizcaya'),
('Bosco Aranguren', 1213, 'Bosco123', 'enfermeria', 'ambulatorio', 'Altamira', 'Vizcaya'),
('Maria Teresa Lopez', 1478, 'Maria123', 'traumatologia', 'hospital', 'Cruces', 'Vizcaya'),
('Fernando Rodriguez', 2014, 'Fernan123', 'ginecologia', 'hospital', 'Cruces', 'Vizcaya'),
('Marian Fuertes', 2020, 'Marian123', 'digestivo', 'hospital', 'Cruces', 'Vizcaya'),
('Jose Conti', 2021, 'Jose1234', 'digestivo', 'hospital', 'Basurto', 'Vizcaya'),
('Javier Gonzalo Ocejo', 2025, 'Gonzalo123', 'cardiologia', 'hospital', 'Cruces', 'Vizcaya'),
('Joel Bra ', 2121, 'Joel1234', 'cabecera', 'ambulatorio', 'Altamira', 'Vizcaya'),
('Juana Bonilla', 2135, 'Juana123', 'enfermeria', 'hospital', 'Basurto', 'Vizcaya'),
('Laia Palau', 2145, 'Laia1234', 'enfermeria', 'hospital', 'Cruces', 'Vizcaya'),
('Vinicius Junior', 2345, 'Vinicius123', 'ginecologia', 'hospital', 'Basurto', 'Vizcaya'),
('Juan Ventosa', 2564, 'Juan1234', 'oftalmologia', 'hospital', 'Cruces', 'Vizcaya'),
('Pedro Luis Pérez', 4178, 'Pedro12', 'cabecera', 'ambulatorio', 'Altamira', 'Vizcaya'),
('Diego García', 4568, 'Diego123', 'enfermeria', 'ambulatorio', 'Zuazo', 'Vizcaya'),
('Conchi Bejerano ', 4575, 'Conchi123', 'cabecera', 'ambulatorio', 'Zuazo', 'Vizcaya'),
('Joselu Mato', 4758, 'Joselu123', 'oftalmologia', 'hospital', 'Basurto', 'Vizcaya'),
('Diego Marta', 5465, 'Diego123', 'cabecera', 'ambulatorio', 'Zuazo', 'Vizcaya'),
('Pedro Piqueras', 5879, 'Pedro123', 'traumatologia', 'hospital', 'Basurto', 'Vizcaya'),
('María Fonfría Ruiz', 7894, 'Maria123', 'enfermeria', 'ambulatorio', 'Zuazo', 'Vizcaya');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `id` int(11) NOT NULL,
  `clave` int(11) NOT NULL,
  `fechahora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `exito` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`id`, `clave`, `fechahora`, `exito`) VALUES
(126, 87958, '2023-11-17 16:07:16', 1),
(127, 87958, '2023-11-17 16:08:48', 1),
(128, 87958, '2023-11-17 16:14:29', 1),
(129, 87958, '2023-11-17 16:17:56', 1),
(130, 4178, '2023-11-17 16:28:18', 1),
(131, 4178, '2023-11-17 16:30:35', 1),
(132, 4178, '2023-11-17 16:32:36', 1),
(133, 87958, '2023-11-17 16:33:27', 1),
(134, 87958, '2023-11-17 17:34:34', 1),
(135, 87958, '2023-11-17 17:36:52', 1),
(136, 87958, '2023-11-17 17:42:15', 1),
(137, 87958, '2023-11-17 17:47:51', 1),
(138, 87958, '2023-11-17 17:48:28', 1),
(139, 87958, '2023-11-17 17:50:03', 1),
(140, 87958, '2023-11-17 17:52:03', 1),
(141, 87958, '2023-11-17 17:52:54', 1),
(142, 87958, '2023-11-17 23:05:32', 1),
(143, 1234567, '2023-11-18 00:09:00', 1),
(144, 1234567, '2023-11-18 00:12:43', 1),
(145, 1234567, '2023-11-18 00:15:45', 1),
(146, 1234567, '2023-11-18 08:49:46', 1),
(147, 1234567, '2023-11-18 08:56:35', 1),
(148, 1234567, '2023-11-18 09:05:39', 1),
(149, 1234567, '2023-11-18 09:12:19', 1),
(150, 1234567, '2023-11-18 09:15:52', 1),
(151, 1234567, '2023-11-18 09:20:57', 0),
(152, 1234567, '2023-11-18 09:21:07', 1),
(153, 4178, '2023-11-18 09:28:13', 1),
(154, 4178, '2023-11-18 09:34:28', 1),
(155, 4178, '2023-11-18 09:41:31', 1),
(156, 4178, '2023-11-18 09:47:33', 1),
(157, 87958, '2023-11-18 14:55:41', 1),
(158, 87958, '2023-11-18 15:04:12', 1),
(159, 4178, '2023-11-18 15:16:09', 1),
(160, 1234567, '2023-11-18 15:20:13', 1),
(161, 4178, '2023-11-18 16:05:52', 0),
(162, 4178, '2023-11-18 16:06:09', 1),
(163, 1478, '2023-11-18 16:06:56', 1),
(164, 4178, '2023-11-18 16:14:16', 1),
(165, 4178, '2023-11-18 16:26:04', 1),
(166, 4178, '2023-11-18 16:26:52', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(200) NOT NULL,
  `telefono` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `tarjeta` int(8) NOT NULL,
  `contra` varchar(50) NOT NULL,
  `cabecera` varchar(50) NOT NULL,
  `ambulatorio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `telefono`, `fecha`, `provincia`, `ciudad`, `tarjeta`, `contra`, `cabecera`, `ambulatorio`) VALUES
('vicen', 666666666, '2019-04-27', 'Bizkaia', 'Bilbao', 87958, 'vicen', '89758', 'San Juan'),
('Antonio García', 605258897, '2006-07-19', 'Bizkaia', 'Bilbao', 1234567, 'Vicen123', '4178', 'San Juan');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `diagnosticos`
--
ALTER TABLE `diagnosticos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sanitario`
--
ALTER TABLE `sanitario`
  ADD PRIMARY KEY (`colegiado`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`tarjeta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `diagnosticos`
--
ALTER TABLE `diagnosticos`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
