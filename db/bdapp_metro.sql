-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2025 a las 19:26:38
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
-- Estructura de tabla para la tabla `area_trabajo`
--

CREATE TABLE `area_trabajo` ( -- Tabla de áreas de trabajo responsables de las OT
  `id_area` int(11) NOT NULL COMMENT 'Área de trabajo responsable de la orden',
  `nombre_area` varchar(100) NOT NULL COMMENT 'Nombre del área de trabajo',
  `nomeclatura` varchar(20) NOT NULL COMMENT 'Nomenclatura o prefijo usado para generar códigos de OT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `area_trabajo`
--

INSERT INTO `area_trabajo` (`id_area`, `nombre_area`, `nomeclatura`) VALUES
(1, 'SEÑALIZACION', 'VF-SEÑ-'),
(2, 'APARATO DE VIA', 'VF-APV-'),
(3, 'INFRAESTRUCTURA', 'VF-INF-'),
(5, 'NO PROGRAMADA', 'VF-NP-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden`
--

CREATE TABLE `detalle_orden` ( -- Detalles y actividades específicas asociadas a una orden de trabajo
  `id` int(11) NOT NULL COMMENT 'Identificador único del rol de permisos',
  `n_ot` varchar(30) NOT NULL COMMENT 'Número único de la orden de trabajo',
  `fecha` date NOT NULL COMMENT 'Fecha programada de la orden de trabajo',
  `descripcion` varchar(250) NOT NULL COMMENT 'Descripción de la actividad o trabajo a realizar',
  `id_turno` int(11) NOT NULL COMMENT 'Identificador único del turno de trabajo',
  `id_miembro_cco` varchar(10) NOT NULL COMMENT 'Miembro responsable en CCO (Centro de Control de Operaciones)',
  `id_user_act` varchar(30) NOT NULL COMMENT 'Usuario técnico responsable de ejecutar la actividad',
  `id_miembro_ccf` varchar(10) NOT NULL COMMENT 'Miembro responsable en CCF',
  `id_estado` int(11) NOT NULL COMMENT 'Identificador único del estado de la orden de trabajo',
  `cant_tec` int(11) NOT NULL COMMENT 'Cantidad de técnicos involucrados en la actividad',
  `hora_ini_pre` varchar(12) NOT NULL COMMENT 'Hora de inicio de la etapa de preparación',
  `hora_fin_pre` varchar(12) NOT NULL COMMENT 'Hora de finalización de la etapa de preparación',
  `hora_ini_tra` varchar(12) NOT NULL COMMENT 'Hora de inicio de la etapa de traslado',
  `hora_fin_tra` varchar(12) NOT NULL COMMENT 'Hora de finalización de la etapa de traslado',
  `hora_ini_eje` varchar(12) NOT NULL COMMENT 'Hora de inicio de la etapa de ejecución',
  `hora_fin_eje` varchar(12) NOT NULL COMMENT 'Hora de finalización de la etapa de ejecución',
  `observacion` varchar(250) DEFAULT NULL COMMENT 'Observaciones adicionales sobre la actividad'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_ot`
--

CREATE TABLE `estado_ot` ( -- Catálogo de estados posibles de las órdenes de trabajo
  `id_estado` int(11) NOT NULL COMMENT 'Identificador único del estado de la orden de trabajo',
  `nombre_estado` varchar(100) NOT NULL COMMENT 'Nombre descriptivo del estado de la orden de trabajo',
  `color` varchar(15) NOT NULL COMMENT 'Código de color asociado al estado para representación visual'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estado_ot`
--

INSERT INTO `estado_ot` (`id_estado`, `nombre_estado`, `color`) VALUES
(1, 'EJECUTADA', '#25ef28'),
(2, 'NO EJECUTADA', '#fa0025'),
(3, 'RE-PROGRAMADA', '#001eff'),
(4, 'SUSPENDIDA', '#ffae00'),
(12, 'CORRECTIVA', '#00e1ff');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramienta`
--

CREATE TABLE `herramienta` ( -- Catálogo de herramientas disponibles en el sistema
  `id_herramienta` varchar(10) NOT NULL COMMENT 'Código de la herramienta asignada a la orden de trabajo',
  `nombre_herramienta` varchar(250) NOT NULL COMMENT 'Nombre descriptivo de la herramienta',
  `cantidad` int(11) NOT NULL COMMENT 'Cantidad total de unidades disponibles de la herramienta',
  `estado` varchar(300) NOT NULL COMMENT 'Descripción del estado general de la herramienta',
  `std_reg` tinyint(1) NOT NULL COMMENT 'Estado lógico del registro (1=activo, 0=inactivo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientaot`
--

CREATE TABLE `herramientaot` ( -- Relación entre herramientas y órdenes de trabajo
  `id_herramientaOT` int(11) NOT NULL COMMENT 'Identificador único del registro herramienta-OT',
  `id_herramienta` varchar(10) NOT NULL COMMENT 'Código de la herramienta asignada a la orden de trabajo',
  `n_ot` varchar(30) NOT NULL COMMENT 'Número único de la orden de trabajo',
  `cantidadot` int(11) NOT NULL COMMENT 'Cantidad de unidades de la herramienta asignadas a la OT',
  `estadoot` varchar(60) DEFAULT NULL COMMENT 'Estado o condición de la herramienta dentro de la OT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_user`
--

CREATE TABLE `log_user` ( -- Registro de acciones realizadas por los usuarios en el sistema
  `id_log` int(11) NOT NULL COMMENT 'Identificador único del registro de log',
  `id_user` varchar(30) NOT NULL COMMENT 'Identificador único del usuario del sistema',
  `accion` varchar(100) NOT NULL COMMENT 'Acción realizada por el usuario',
  `resp_system` varchar(255) NOT NULL COMMENT 'Respuesta o mensaje generado por el sistema',
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora en que se registró el evento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembro`
--

CREATE TABLE `miembro` ( -- Catálogo de miembros de CCO y CCF u otros roles operativos
  `id_miembro` varchar(10) NOT NULL COMMENT 'Identificador único del miembro',
  `nombre_miembro` varchar(40) NOT NULL COMMENT 'Nombre completo del miembro',
  `tipo_miembro` int(11) NOT NULL COMMENT 'Tipo de miembro (por ejemplo, CCO, CCF, etc.)',
  `std_reg` tinyint(1) NOT NULL COMMENT 'Estado lógico del registro (1=activo, 0=inactivo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `miembro`
--

INSERT INTO `miembro` (`id_miembro`, `nombre_miembro`, `tipo_miembro`, `std_reg`) VALUES
('M-001', 'PEDRO PEREZ', 2, 1),
('M-003', 'ANGELICA LINARES', 1, 1),
('M-004', 'JESUS MARTINEZ', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_trabajo`
--

CREATE TABLE `orden_trabajo` ( -- Tabla principal de órdenes de trabajo
  `n_ot` varchar(30) NOT NULL COMMENT 'Número único de la orden de trabajo',
  `id_area` int(11) NOT NULL COMMENT 'Área de trabajo responsable de la orden',
  `id_user` varchar(30) NOT NULL COMMENT 'Identificador único del usuario del sistema',
  `id_sitio` int(11) NOT NULL COMMENT 'Identificador único del sitio de trabajo',
  `nombre_trab` varchar(500) NOT NULL COMMENT 'Descripción o nombre del trabajo a realizar',
  `fecha` date NOT NULL COMMENT 'Fecha programada de la orden de trabajo',
  `semana` varchar(100) NOT NULL COMMENT 'Semana del año correspondiente a la orden',
  `mes` varchar(100) NOT NULL COMMENT 'Mes correspondiente a la orden de trabajo',
  `std_reg` tinyint(1) NOT NULL COMMENT 'Estado lógico del registro (1=activo, 0=inactivo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` ( -- Definición de roles y permisos del sistema
  `id` int(11) NOT NULL COMMENT 'Identificador único del rol de permisos',
  `nombre_rol` varchar(100) NOT NULL COMMENT 'Nombre del rol de usuario',
  `perm_usuarios_view` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para visualizar usuarios',
  `perm_usuarios_add` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para registrar nuevos usuarios',
  `perm_usuarios_edit` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para editar usuarios existentes',
  `perm_usuarios_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para eliminar usuarios',
  `perm_herramienta_view` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para visualizar herramientas',
  `perm_herramienta_add` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para registrar nuevas herramientas',
  `perm_herramienta_edit` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para editar herramientas',
  `perm_herramienta_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para eliminar herramientas',
  `perm_miembro_view` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para visualizar miembros',
  `perm_miembro_add` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para registrar nuevos miembros',
  `perm_miembro_edit` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para editar miembros',
  `perm_miembro_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para eliminar miembros',
  `perm_ot_view` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para visualizar órdenes de trabajo',
  `perm_ot_add` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para registrar nuevas órdenes de trabajo',
  `perm_ot_edit` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para editar órdenes de trabajo',
  `perm_ot_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para eliminar órdenes de trabajo',
  `perm_ot_add_detalle` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para agregar detalles a órdenes de trabajo',
  `perm_ot_generar_reporte` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para generar reportes de órdenes de trabajo',
  `perm_ot_add_herramienta` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Permiso para asociar herramientas a órdenes de trabajo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles_permisos`
--

INSERT INTO `roles_permisos` (`id`, `nombre_rol`, `perm_usuarios_view`, `perm_usuarios_add`, `perm_usuarios_edit`, `perm_usuarios_delete`, `perm_herramienta_view`, `perm_herramienta_add`, `perm_herramienta_edit`, `perm_herramienta_delete`, `perm_miembro_view`, `perm_miembro_add`, `perm_miembro_edit`, `perm_miembro_delete`, `perm_ot_view`, `perm_ot_add`, `perm_ot_edit`, `perm_ot_delete`, `perm_ot_add_detalle`, `perm_ot_generar_reporte`, `perm_ot_add_herramienta`) VALUES
(1, 'ROOT', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 'OPERADOR', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 1),
(5, 'ADMINISTRADOR', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(9, 'NUEVO ROL 2', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitio_trabajo`
--

CREATE TABLE `sitio_trabajo` ( -- Catálogo de sitios o ubicaciones de trabajo
  `id_sitio` int(11) NOT NULL COMMENT 'Identificador único del sitio de trabajo',
  `nombre_sitio` varchar(100) NOT NULL COMMENT 'Nombre del sitio o ubicación de trabajo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `sitio_trabajo`
--

INSERT INTO `sitio_trabajo` (`id_sitio`, `nombre_sitio`) VALUES
(1, 'PATIO'),
(2, 'LINEA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno_trabajo`
--

CREATE TABLE `turno_trabajo` ( -- Catálogo de turnos de trabajo
  `id_turno` int(11) NOT NULL COMMENT 'Identificador único del turno de trabajo',
  `nombre_turno` varchar(100) NOT NULL COMMENT 'Nombre descriptivo del turno de trabajo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `turno_trabajo`
--

INSERT INTO `turno_trabajo` (`id_turno`, `nombre_turno`) VALUES
(1, 'MAÑANA'),
(2, 'TARDE'),
(3, 'NOCHE'),
(4, 'MEDIA-NOCHE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_system`
--

CREATE TABLE `user_system` ( -- Usuarios del sistema y su configuración básica
  `id_user` varchar(30) NOT NULL COMMENT 'Identificador único del usuario del sistema',
  `user` varchar(30) NOT NULL COMMENT 'Nombre completo del usuario del sistema',
  `username` varchar(50) NOT NULL COMMENT 'Nombre de usuario utilizado para iniciar sesión',
  `password` varchar(60) NOT NULL COMMENT 'Contraseña encriptada del usuario',
  `tipo` int(11) NOT NULL COMMENT 'Rol o perfil de permisos asociado al usuario',
  `std_reg` tinyint(1) NOT NULL COMMENT 'Estado lógico del registro (1=activo, 0=inactivo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `user_system`
--

INSERT INTO `user_system` (`id_user`, `user`, `username`, `password`, `tipo`, `std_reg`) VALUES
('12345678', 'ADMINISTRADOR SISTEMA', 'administrador', '$2y$10$5gzY.kxrQ1P22hjNEyIxd.ZBw4CpaFlT7WpMnqZijDqXUHOrzh8LC', 5, 1),
('000000', 'USUARIO SISTEMA', 'root', '$2y$10$nYe4ZDnDGkD1OrWa5bacvec60XromlVEe5/9e8/k91wU7xVmMDTYi', 1, 1),
('22206460', 'ANDREINA GARCIA', 'venta', '$2y$10$zA4Jf6WFY1uzPQYjUEemm.suIwxfLQkx6gluutfsS3T1zMrZlpPTi', 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area_trabajo`
--
ALTER TABLE `area_trabajo`
  ADD PRIMARY KEY (`id_area`),
  ADD UNIQUE KEY `nomeclatura` (`nomeclatura`);

--
-- Indices de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responsable_ccf` (`id_miembro_ccf`),
  ADD KEY `responsable_cco` (`id_miembro_cco`),
  ADD KEY `responsable_act` (`id_user_act`),
  ADD KEY `turno` (`id_turno`),
  ADD KEY `status` (`id_estado`),
  ADD KEY `n_ot` (`n_ot`);

--
-- Indices de la tabla `estado_ot`
--
ALTER TABLE `estado_ot`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `herramienta`
--
ALTER TABLE `herramienta`
  ADD PRIMARY KEY (`id_herramienta`);

--
-- Indices de la tabla `herramientaot`
--
ALTER TABLE `herramientaot`
  ADD PRIMARY KEY (`id_herramientaOT`),
  ADD KEY `id_herramienta` (`id_herramienta`),
  ADD KEY `n_ot` (`n_ot`);

--
-- Indices de la tabla `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

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
  ADD KEY `status` (`std_reg`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `sitio_trab` (`id_sitio`),
  ADD KEY `id_area` (`id_area`);

--
-- Indices de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sitio_trabajo`
--
ALTER TABLE `sitio_trabajo`
  ADD PRIMARY KEY (`id_sitio`);

--
-- Indices de la tabla `turno_trabajo`
--
ALTER TABLE `turno_trabajo`
  ADD PRIMARY KEY (`id_turno`);

--
-- Indices de la tabla `user_system`
--
ALTER TABLE `user_system`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD KEY `tipo` (`tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area_trabajo`
--
ALTER TABLE `area_trabajo`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado_ot`
--
ALTER TABLE `estado_ot`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `herramientaot`
--
ALTER TABLE `herramientaot`
  MODIFY `id_herramientaOT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `sitio_trabajo`
--
ALTER TABLE `sitio_trabajo`
  MODIFY `id_sitio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `turno_trabajo`
--
ALTER TABLE `turno_trabajo`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  -- Relación: detalle_orden.id_user_act → user_system.id_user
  ADD CONSTRAINT `detalle_orden_ibfk_2` FOREIGN KEY (`id_user_act`) REFERENCES `user_system` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  -- Relación: detalle_orden.id_miembro_cco → miembro.id_miembro
  ADD CONSTRAINT `detalle_orden_ibfk_3` FOREIGN KEY (`id_miembro_ccf`) REFERENCES `miembro` (`id_miembro`) ON DELETE CASCADE ON UPDATE CASCADE,
  -- Relación: detalle_orden.id_miembro_ccf → miembro.id_miembro
  ADD CONSTRAINT `detalle_orden_ibfk_4` FOREIGN KEY (`id_miembro_cco`) REFERENCES `miembro` (`id_miembro`) ON DELETE CASCADE ON UPDATE CASCADE,
  -- Relación: detalle_orden.id_estado → estado_ot.id_estado
  ADD CONSTRAINT `detalle_orden_ibfk_5` FOREIGN KEY (`id_estado`) REFERENCES `estado_ot` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  -- Relación: detalle_orden.id_turno → turno_trabajo.id_turno
  ADD CONSTRAINT `detalle_orden_ibfk_6` FOREIGN KEY (`id_turno`) REFERENCES `turno_trabajo` (`id_turno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `herramientaot`
--
ALTER TABLE `herramientaot`
  -- Relación: herramientaot.n_ot → orden_trabajo.n_ot
  ADD CONSTRAINT `herramientaot_ibfk_1` FOREIGN KEY (`n_ot`) REFERENCES `orden_trabajo` (`n_ot`) ON DELETE CASCADE ON UPDATE CASCADE,
  -- Relación: herramientaot.id_herramienta → herramienta.id_herramienta
  ADD CONSTRAINT `herramientaot_ibfk_2` FOREIGN KEY (`id_herramienta`) REFERENCES `herramienta` (`id_herramienta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `log_user`
--
ALTER TABLE `log_user`
  -- Relación: log_user.id_user → user_system.id_user
  ADD CONSTRAINT `log_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_system` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  -- Relación: orden_trabajo.id_user → user_system.id_user
  ADD CONSTRAINT `orden_trabajo_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_system` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  -- Relación: orden_trabajo.id_sitio → sitio_trabajo.id_sitio
  ADD CONSTRAINT `orden_trabajo_ibfk_2` FOREIGN KEY (`id_sitio`) REFERENCES `sitio_trabajo` (`id_sitio`) ON DELETE CASCADE ON UPDATE CASCADE,
  -- Relación: orden_trabajo.id_area → area_trabajo.id_area
  ADD CONSTRAINT `orden_trabajo_ibfk_3` FOREIGN KEY (`id_area`) REFERENCES `area_trabajo` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_system`
--
ALTER TABLE `user_system`
  -- Relación: user_system.tipo → roles_permisos.id
  ADD CONSTRAINT `user_system_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `roles_permisos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
