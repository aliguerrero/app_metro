-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2024 a las 16:06:48
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdapp_metro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden`
--

CREATE TABLE `detalle_orden` (
  `n_ot` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `observacion` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `responsable_cco` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `responsable_act` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `responsable_ccf` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hora_ini_pre` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `hora_fin_pre` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hora_ini_tra` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hora_fin_tra` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hora_ini_eje` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hora_fin_eje` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramienta`
--

CREATE TABLE `herramienta` (
  `id_herramienta` varchar(10) NOT NULL,
  `nombre_herramienta` varchar(250) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `herramienta`
--

INSERT INTO `herramienta` (`id_herramienta`, `nombre_herramienta`, `cantidad`, `estado`) VALUES
('001', 'MARTILLO', 2, '3'),
('002', 'DESTORNILLADOR', 1, '1'),
('003', 'TALADRO', 0, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientaot`
--

CREATE TABLE `herramientaot` (
  `id_herramientaOT` int(11) NOT NULL,
  `id_herramienta` varchar(10) NOT NULL,
  `n_ot` varchar(30) NOT NULL,
  `cantidadot` int(11) NOT NULL,
  `estadoot` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `herramientaot`
--

INSERT INTO `herramientaot` (`id_herramientaOT`, `id_herramienta`, `n_ot`, `cantidadot`, `estadoot`) VALUES
(1, '001', 'OT-001', 1, 'EN USO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembro`
--

CREATE TABLE `miembro` (
  `id_miembro` varchar(10) NOT NULL,
  `nombre_miembro` varchar(40) NOT NULL,
  `tipo_miembro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `miembro`
--

INSERT INTO `miembro` (`id_miembro`, `nombre_miembro`, `tipo_miembro`) VALUES
('M-001', 'PEDRO PEREZ', 2),
('M-002', 'MANUEL ROJAS k', 2),
('M-003', 'ANGELICA LINARES', 1),
('M-004', 'JESUS MARTINEZ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_trabajo`
--

CREATE TABLE `orden_trabajo` (
  `n_ot` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_user` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre_trab` varchar(500) NOT NULL,
  `sitio_trab` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `semana` varchar(100) NOT NULL,
  `mes` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `orden_trabajo`
--

INSERT INTO `orden_trabajo` (`n_ot`, `id_user`, `nombre_trab`, `sitio_trab`, `fecha`, `semana`, `mes`, `status`) VALUES
('OT-001', '1111111', 'MANTENIMIENTO VIAL', 'PATIO', '2024-04-02', '12', '04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_system`
--

CREATE TABLE `user_system` (
  `id_user` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `user_system`
--

INSERT INTO `user_system` (`id_user`, `user`, `username`, `password`, `tipo`) VALUES
('1111111', 'ALI GUERRERO', 'root', '$2y$10$JDLy2Xp9fISDD54GBWX2JuOzzpva5LEfKlDfbkwkeP6rSGIPnnBTO', 1),
('22206460', 'ANDREINA GARCIA', 'roottt', '$2y$10$KWK1p5eK0K54XmHU12otO./yFjllrnqn9LItykDdBnGfQNHn1m4sW', 2),
('1234567', 'ALI GUERRERO', 'roottttt', '$2y$10$7mmNYN2wIJZl/2AhxukMVu74bZgANiCHcQLe2Myfg2JhK48MptdTm', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD PRIMARY KEY (`n_ot`),
  ADD KEY `responsable_ccf` (`responsable_ccf`),
  ADD KEY `responsable_cco` (`responsable_cco`),
  ADD KEY `responsable_act` (`responsable_act`);

--
-- Indices de la tabla `herramienta`
--
ALTER TABLE `herramienta`
  ADD PRIMARY KEY (`id_herramienta`);

--
-- Indices de la tabla `herramientaot`
--
ALTER TABLE `herramientaot`
  ADD KEY `id_herramienta` (`id_herramienta`),
  ADD KEY `n_ot` (`n_ot`);

--
-- Indices de la tabla `miembro`
--
ALTER TABLE `miembro`
  ADD PRIMARY KEY (`id_miembro`);

--
-- Indices de la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  ADD PRIMARY KEY (`n_ot`),
  ADD KEY `status` (`status`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `user_system`
--
ALTER TABLE `user_system`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD CONSTRAINT `detalle_orden_ibfk_1` FOREIGN KEY (`n_ot`) REFERENCES `orden_trabajo` (`n_ot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_orden_ibfk_2` FOREIGN KEY (`responsable_act`) REFERENCES `user_system` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_orden_ibfk_3` FOREIGN KEY (`responsable_ccf`) REFERENCES `miembro` (`id_miembro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_orden_ibfk_4` FOREIGN KEY (`responsable_cco`) REFERENCES `miembro` (`id_miembro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `herramientaot`
--
ALTER TABLE `herramientaot`
  ADD CONSTRAINT `herramientaot_ibfk_1` FOREIGN KEY (`n_ot`) REFERENCES `orden_trabajo` (`n_ot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `herramientaot_ibfk_2` FOREIGN KEY (`id_herramienta`) REFERENCES `herramienta` (`id_herramienta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  ADD CONSTRAINT `orden_trabajo_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_system` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
