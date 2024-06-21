-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2024 a las 21:43:45
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

--
-- Volcado de datos para la tabla `arl`
--

INSERT INTO `arl` (`id_arl`, `valor`) VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aux_trasporte`
--

CREATE TABLE `aux_trasporte` (
  `ID` int(11) NOT NULL,
  `Valor` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aux_trasporte`
--

INSERT INTO `aux_trasporte` (`ID`, `Valor`) VALUES
(1, 170000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactanos`
--

CREATE TABLE `contactanos` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactanos`
--

INSERT INTO `contactanos` (`id`, `nombres`, `correo`, `telefono`, `comentario`, `id_estado`) VALUES
(1, 'fulgencio antonio carmelo diaz', 'ezio54285@gmail.com', '3243800533', 'que mamaguebo jajajaj', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deduccion`
--

CREATE TABLE `deduccion` (
  `ID_DEDUCCION` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_prestamo` int(11) DEFAULT NULL,
  `id_salud` int(11) DEFAULT NULL,
  `id_pension` int(11) DEFAULT NULL,
  `cuota` int(255) NOT NULL,
  `parafiscales` int(20) DEFAULT NULL,
  `total` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `NIT` bigint(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `ID_Licencia` int(11) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `barcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`NIT`, `Nombre`, `ID_Licencia`, `Correo`, `Telefono`, `barcode`) VALUES
(8888888888, 'D1', 20, 'd1@gmail.com', '8888888888', '');

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
(5, 'primera vez'),
(6, 'aprobado'),
(7, 'desaprobado'),
(8, 'Cancelado'),
(9, 'PAGO'),
(13, 'Llamar'),
(14, 'Llamado');

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

--
-- Volcado de datos para la tabla `licencia`
--

INSERT INTO `licencia` (`ID`, `Serial`, `ID_Estado`, `F_inicio`, `F_fin`, `TP_licencia`) VALUES
(20, 'PLxPIlNPxiPIrIxLE3cagLk5l', 1, '2024-06-13 15:01:02', '2025-06-13 15:01:02', 1214);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE `nomina` (
  `ID` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `ID_deduccion` int(11) NOT NULL,
  `Id_suma` int(11) NOT NULL,
  `dias_trabajados` int(10) DEFAULT NULL,
  `Valor_Pagar` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pension`
--

CREATE TABLE `pension` (
  `ID` int(11) NOT NULL,
  `Valor` int(11) DEFAULT NULL,
  `id_empresa` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pension`
--

INSERT INTO `pension` (`ID`, `Valor`, `id_empresa`) VALUES
(11, 1, 8888888888);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_reingreso` datetime NOT NULL,
  `id_us` bigint(11) DEFAULT NULL,
  `estado` int(10) DEFAULT NULL,
  `observacion` varchar(255) NOT NULL
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `ID` int(11) NOT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `id_empresa` bigint(11) NOT NULL,
  `id_arl` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`ID`, `cargo`, `salario`, `id_empresa`, `id_arl`) VALUES
(2, 'sdfdsf', 213123.00, 8888888888, 2),
(4, 'Tintero', 1270000.00, 8888888888, 2),
(5, 'bj', 2000.00, 100000, 1);

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
  `Valor` int(11) DEFAULT NULL,
  `id_empresa` bigint(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salud`
--

INSERT INTO `salud` (`ID`, `Valor`, `id_empresa`) VALUES
(2, 170000, 100000),
(20, 2, 8888888888);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sumas`
--

CREATE TABLE `sumas` (
  `ID_INDUCCION` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `valor_hora_extra` int(11) DEFAULT NULL,
  `horas_trabajadas` int(11) DEFAULT NULL,
  `transporte` int(255) NOT NULL,
  `total` int(20) DEFAULT NULL
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
  `id_us` bigint(11) NOT NULL,
  `nombre_us` varchar(50) NOT NULL,
  `apellido_us` varchar(50) NOT NULL,
  `correo_us` varchar(50) NOT NULL,
  `tel_us` varchar(15) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `ruta_foto` varchar(255) DEFAULT NULL,
  `id_puesto` int(11) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `Codigo` int(10) NOT NULL,
  `id_empresa` bigint(11) DEFAULT NULL,
  `token` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_us`, `nombre_us`, `apellido_us`, `correo_us`, `tel_us`, `pass`, `ruta_foto`, `id_puesto`, `id_rol`, `Codigo`, `id_empresa`, `token`) VALUES
(1105462832, 'emiliano', 'ardila', 'bjulian1605@gmail.com', '3023004176', 'ea8ca18c781aa37f665f6eff7ac7c6aa7d671a9d2cad0003ddd1f2a40c08b00b4b62c2758b72b02bd95d57c767ae4d4b885ae6191a3207ffa9182a8f0949a967', '../../../uploads/fotos/user.jpg', 4, 6, 2005, 8888888888, ''),
(1105462833, 'julian', 'contreras', 'bjulian1605@gmail.com', '3023004176', 'ea8ca18c781aa37f665f6eff7ac7c6aa7d671a9d2cad0003ddd1f2a40c08b00b4b62c2758b72b02bd95d57c767ae4d4b885ae6191a3207ffa9182a8f0949a967', '../../../uploads/fotos/user.jpg', 4, 7, 2005, 8888888888, ''),
(1105462834, 'brian', 'avila', 'bjulian1605@gmail.com', '3023004176', 'ea8ca18c781aa37f665f6eff7ac7c6aa7d671a9d2cad0003ddd1f2a40c08b00b4b62c2758b72b02bd95d57c767ae4d4b885ae6191a3207ffa9182a8f0949a967', NULL, NULL, 5, 2005, 8888888888, NULL),
(1109000587, 'Larry', 'Garcia', 'windonpc125@gmail.com', '3173328716', 'eaf03a7d744a6329676a694d5d70c5fbb6eb6b5d6c34889f93714923af0f85db50b268059ae737959c858ec97dcfd610a15934685c09b71826dbce17ac9075c9', NULL, NULL, 4, 3017, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `v_h_extra`
--

CREATE TABLE `v_h_extra` (
  `ID` int(11) NOT NULL,
  `V_H_extra` int(10) DEFAULT NULL,
  `id_empresa` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `v_h_extra`
--

INSERT INTO `v_h_extra` (`ID`, `V_H_extra`, `id_empresa`) VALUES
(6, 6000, 0),
(10, 10000, 8888888888);

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
-- Indices de la tabla `contactanos`
--
ALTER TABLE `contactanos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `deduccion`
--
ALTER TABLE `deduccion`
  ADD PRIMARY KEY (`ID_DEDUCCION`);

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
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Estado` (`ID_Estado`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `pension`
--
ALTER TABLE `pension`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`ID_prest`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD PRIMARY KEY (`ID`);

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
-- Indices de la tabla `sumas`
--
ALTER TABLE `sumas`
  ADD PRIMARY KEY (`ID_INDUCCION`);

--
-- Indices de la tabla `tp_licencia`
--
ALTER TABLE `tp_licencia`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_us`);

--
-- Indices de la tabla `v_h_extra`
--
ALTER TABLE `v_h_extra`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `deduccion`
--
ALTER TABLE `deduccion`
  MODIFY `ID_DEDUCCION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `ID_Es` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `pension`
--
ALTER TABLE `pension`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `ID_prest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `salud`
--
ALTER TABLE `salud`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `sumas`
--
ALTER TABLE `sumas`
  MODIFY `ID_INDUCCION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `tp_licencia`
--
ALTER TABLE `tp_licencia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1215;

--
-- AUTO_INCREMENT de la tabla `v_h_extra`
--
ALTER TABLE `v_h_extra`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
