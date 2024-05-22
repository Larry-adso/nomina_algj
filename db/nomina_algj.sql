-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2024 a las 18:34:41
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nomina_algj`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arl`
--

CREATE TABLE `arl` (
  `id_arl` int(11) NOT NULL,
  `valor` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aux_trasporte`
--

CREATE TABLE `aux_trasporte` (
  `ID` int(11) NOT NULL,
  `Valor` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deducciones`
--

CREATE TABLE `deducciones` (
  `ID_DEDUCCION` int(11) NOT NULL,
  `MES_DEDUCCION` datetime DEFAULT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL,
  `ID_PRESTAMO` int(11) DEFAULT NULL,
  `ID_SALUD` int(11) DEFAULT NULL,
  `ID_PENSION` int(11) DEFAULT NULL,
  `TOTAL_PARAFISCALES` decimal(11,2) DEFAULT NULL,
  `TOTAL_DEDUCCION` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `NIT` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `ID_Licencia` int(11) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Password` varchar(500) NOT NULL,
  `Telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `ID_Es` int(10) NOT NULL,
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`ID_Es`, `Estado`) VALUES
(1, 'Activa'),
(2, 'Inactiva'),
(3, 'Disponible'),
(4, 'En proceso'),
(5, 'primera vez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inducciones`
--

CREATE TABLE `inducciones` (
  `ID_INDUCCION` int(11) NOT NULL,
  `MES_INDUCCION` datetime DEFAULT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL,
  `ID_VALOR_HORA_EXTRA` int(11) DEFAULT NULL,
  `HORAS_EXTRAS` int(11) DEFAULT NULL,
  `TOTAL_INDUCCION` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `ID` int(10) NOT NULL,
  `Serial` varchar(100) NOT NULL,
  `ID_Estado` int(11) NOT NULL,
  `F_inicio` datetime DEFAULT NULL,
  `F_fin` datetime DEFAULT NULL,
  `TP_licencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE `nomina` (
  `ID` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `ID_deduccion` int(11) NOT NULL,
  `Id_induccion` int(11) NOT NULL,
  `ID_aux_Trasporte` int(11) NOT NULL,
  `Valor_Pagar` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pension`
--

CREATE TABLE `pension` (
  `ID` int(11) NOT NULL,
  `Valor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pension`
--

INSERT INTO `pension` (`ID`, `Valor`) VALUES
(10, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_reingreso` datetime NOT NULL,
  `id_us` int(11) NOT NULL,
  `estado` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `ID_prest` int(11) NOT NULL,
  `ID_Empleado` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Cantidad_cuotas` int(11) NOT NULL,
  `Valor_Cuotas` decimal(10,2) NOT NULL,
  `cuotas_en_deuda` int(11) DEFAULT NULL,
  `cuotas_pagas` int(11) DEFAULT NULL,
  `VALOR` decimal(10,2) NOT NULL,
  `estado` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`ID_prest`, `ID_Empleado`, `Fecha`, `Cantidad_cuotas`, `Valor_Cuotas`, `cuotas_en_deuda`, `cuotas_pagas`, `VALOR`, `estado`) VALUES
(2, 1105462834, '2024-05-15 16:44:00', 10, 500000.00, NULL, NULL, 5000000.00, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `ID` int(11) NOT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_arl` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`ID`, `cargo`, `salario`, `id_empresa`, `id_arl`) VALUES
(1, 'desarrollador web', 2000000.00, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `Tp_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID`, `Tp_user`) VALUES
(4, 'desarrollador'),
(5, 'admin'),
(6, 'trabajadores'),
(7, 'RH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salud`
--

CREATE TABLE `salud` (
  `ID` int(11) NOT NULL,
  `Valor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salud`
--

INSERT INTO `salud` (`ID`, `Valor`) VALUES
(4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_deporte`
--

CREATE TABLE `tipo_deporte` (
  `id_tp_deporte` int(10) NOT NULL,
  `nombre_tp_deporte` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tp_licencia`
--

CREATE TABLE `tp_licencia` (
  `ID` int(11) NOT NULL,
  `Tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tp_licencia`
--

INSERT INTO `tp_licencia` (`ID`, `Tipo`) VALUES
(1213, '6 meses'),
(1214, '12 meses');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `triggers`
--

CREATE TABLE `triggers` (
  `ID_Triggers` int(11) NOT NULL,
  `id_us` int(11) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_us` int(11) NOT NULL,
  `nombre_us` varchar(50) NOT NULL,
  `apellido_us` varchar(50) NOT NULL,
  `correo_us` varchar(50) NOT NULL,
  `tel_us` varchar(15) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `foto` longblob DEFAULT NULL,
  `id_puesto` int(11) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `Codigo` int(10) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `token` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_us`, `nombre_us`, `apellido_us`, `correo_us`, `tel_us`, `pass`, `foto`, `id_puesto`, `id_rol`, `Codigo`, `id_empresa`, `token`) VALUES
(1109000587, 'Larry', 'Garcia', 'windonpc125@gmail.com', '3173328716', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', NULL, NULL, 4, 933, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `v_h_extra`
--

CREATE TABLE `v_h_extra` (
  `ID` int(11) NOT NULL,
  `V_H_extra` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `v_h_extra`
--

INSERT INTO `v_h_extra` (`ID`, `V_H_extra`) VALUES
(6, 100.00),
(8, 1200.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arl`
--
ALTER TABLE `arl`
  ADD PRIMARY KEY (`id_arl`);

--
-- Indices de la tabla `aux_trasporte`
--
ALTER TABLE `aux_trasporte`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `deducciones`
--
ALTER TABLE `deducciones`
  ADD PRIMARY KEY (`ID_DEDUCCION`),
  ADD KEY `fk_deducciones_usuarios` (`ID_USUARIO`),
  ADD KEY `fk_deducciones_prestamo` (`ID_PRESTAMO`),
  ADD KEY `fk_deducciones_salud` (`ID_SALUD`),
  ADD KEY `fk_deducciones_pension` (`ID_PENSION`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`NIT`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`ID_Es`);

--
-- Indices de la tabla `inducciones`
--
ALTER TABLE `inducciones`
  ADD PRIMARY KEY (`ID_INDUCCION`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_VALOR_HORA_EXTRA` (`ID_VALOR_HORA_EXTRA`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Estado` (`ID_Estado`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_nomina_usuarios` (`ID_user`),
  ADD KEY `fk_nomina_deducciones` (`ID_deduccion`),
  ADD KEY `fk_nomina_inducciones` (`Id_induccion`),
  ADD KEY `fk_nomina_aux_trasporte` (`ID_aux_Trasporte`);

--
-- Indices de la tabla `pension`
--
ALTER TABLE `pension`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `fk_permisos_usuarios` (`id_us`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`ID_prest`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_arl` (`id_arl`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `salud`
--
ALTER TABLE `salud`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tipo_deporte`
--
ALTER TABLE `tipo_deporte`
  ADD PRIMARY KEY (`id_tp_deporte`);

--
-- Indices de la tabla `tp_licencia`
--
ALTER TABLE `tp_licencia`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `triggers`
--
ALTER TABLE `triggers`
  ADD PRIMARY KEY (`ID_Triggers`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_us`),
  ADD KEY `id_puesto` (`id_puesto`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `v_h_extra`
--
ALTER TABLE `v_h_extra`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `ID_Es` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pension`
--
ALTER TABLE `pension`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `ID_prest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `salud`
--
ALTER TABLE `salud`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `v_h_extra`
--
ALTER TABLE `v_h_extra`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `deducciones`
--
ALTER TABLE `deducciones`
  ADD CONSTRAINT `deducciones_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`id_us`),
  ADD CONSTRAINT `deducciones_ibfk_2` FOREIGN KEY (`ID_PRESTAMO`) REFERENCES `prestamo` (`ID_prest`),
  ADD CONSTRAINT `deducciones_ibfk_3` FOREIGN KEY (`ID_SALUD`) REFERENCES `salud` (`ID`),
  ADD CONSTRAINT `deducciones_ibfk_4` FOREIGN KEY (`ID_PENSION`) REFERENCES `pension` (`ID`),
  ADD CONSTRAINT `fk_deducciones_pension` FOREIGN KEY (`ID_PENSION`) REFERENCES `pension` (`ID`),
  ADD CONSTRAINT `fk_deducciones_prestamo` FOREIGN KEY (`ID_PRESTAMO`) REFERENCES `prestamo` (`ID_prest`),
  ADD CONSTRAINT `fk_deducciones_salud` FOREIGN KEY (`ID_SALUD`) REFERENCES `salud` (`ID`),
  ADD CONSTRAINT `fk_deducciones_usuarios` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`id_us`);

--
-- Filtros para la tabla `inducciones`
--
ALTER TABLE `inducciones`
  ADD CONSTRAINT `inducciones_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`id_us`),
  ADD CONSTRAINT `inducciones_ibfk_2` FOREIGN KEY (`ID_VALOR_HORA_EXTRA`) REFERENCES `v_h_extra` (`ID`);

--
-- Filtros para la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD CONSTRAINT `licencia_ibfk_1` FOREIGN KEY (`ID_Estado`) REFERENCES `estado` (`ID_Es`);

--
-- Filtros para la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD CONSTRAINT `fk_nomina_aux_trasporte` FOREIGN KEY (`ID_aux_Trasporte`) REFERENCES `aux_trasporte` (`ID`),
  ADD CONSTRAINT `fk_nomina_deducciones` FOREIGN KEY (`ID_deduccion`) REFERENCES `deducciones` (`ID_DEDUCCION`),
  ADD CONSTRAINT `fk_nomina_inducciones` FOREIGN KEY (`Id_induccion`) REFERENCES `inducciones` (`ID_INDUCCION`),
  ADD CONSTRAINT `fk_nomina_usuarios` FOREIGN KEY (`ID_user`) REFERENCES `usuarios` (`id_us`),
  ADD CONSTRAINT `nomina_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `usuarios` (`id_us`),
  ADD CONSTRAINT `nomina_ibfk_2` FOREIGN KEY (`ID_deduccion`) REFERENCES `deducciones` (`ID_DEDUCCION`),
  ADD CONSTRAINT `nomina_ibfk_3` FOREIGN KEY (`Id_induccion`) REFERENCES `inducciones` (`ID_INDUCCION`),
  ADD CONSTRAINT `nomina_ibfk_4` FOREIGN KEY (`ID_aux_Trasporte`) REFERENCES `aux_trasporte` (`ID`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `fk_permisos_usuarios` FOREIGN KEY (`id_us`) REFERENCES `usuarios` (`id_us`),
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_us`) REFERENCES `usuarios` (`id_us`);

--
-- Filtros para la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD CONSTRAINT `puestos_ibfk_1` FOREIGN KEY (`id_arl`) REFERENCES `arl` (`id_arl`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_puesto`) REFERENCES `puestos` (`ID`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
