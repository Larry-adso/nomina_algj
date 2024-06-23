-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2024 a las 04:32:22
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

--
-- Volcado de datos para la tabla `deduccion`
--

INSERT INTO `deduccion` (`ID_DEDUCCION`, `fecha`, `id_usuario`, `id_prestamo`, `id_salud`, `id_pension`, `cuota`, `parafiscales`, `total`) VALUES
(12, '2024-06-23 00:00:00', 1109000123, 10, 1, 1, 93519, 73188, 1016519),
(15, '2024-06-23 00:00:00', 1007428011, 11, 1, 1, 356663, 199808, 1866213);

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
(1109000123, 'Celcia', 21, 'Celcia123@gmail.com', '3112222222', 'img/1109000123.png'),
(1109111919, 'hola', 25, 'hola@gmail.com', '3229894890', 'img/1109111919.png'),
(7501033210, 'hghghgh', 22, 'fggf@gmail.com', '1424554545', 'img/7501033210.png'),
(7700304515, 'angie', 23, 'hh@gmail.com', '8767887678', 'img/7700304515.png');

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
(21, 'cDtB2spjCgNBz1WGDosIOkHTr', 5, NULL, NULL, 1214),
(22, 'wHZMqeu8sBc3SHq49wUHybuPH', 1, '2024-06-23 02:22:51', '2024-12-23 02:22:51', 1213),
(23, 'Z07OhpeubEB9TdknMGgxHB2nG', 1, '2024-06-23 02:28:02', '2025-05-23 02:28:02', 1214),
(24, 'DftWLtcduG0Pk39xkBeMe6BpV', 2, NULL, NULL, 1213),
(25, 'sBrKyVogS88pfe4BhFXcUKBzl', 1, '2024-06-23 03:41:38', '2025-06-23 03:41:38', 1214);

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

--
-- Volcado de datos para la tabla `nomina`
--

INSERT INTO `nomina` (`ID`, `ID_user`, `Fecha`, `ID_deduccion`, `Id_suma`, `dias_trabajados`, `Valor_Pagar`) VALUES
(53, 1109000123, '2024-06-23 00:00:00', 12, 74, 29, 1016519),
(56, 1007428011, '2024-06-23 00:00:00', 15, 77, 19, 1866213);

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
(12, 2, 7700304515),
(14, 6, 1109111919);

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

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `fecha`, `fecha_reingreso`, `id_us`, `estado`, `observacion`) VALUES
(2, '2024-07-10 07:01:00', '2024-07-11 11:13:00', 1109000123, 4, 'tengo cita con un man que es re pedagogo'),
(3, '2024-06-23 09:02:00', '2024-06-23 00:06:00', 1007428011, 4, 'Tengo clases de natación');

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
  `cuotas_pagas` int(11) NOT NULL,
  `VALOR` decimal(10,2) NOT NULL,
  `estado` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`ID_prest`, `ID_Empleado`, `Fecha`, `Cantidad_cuotas`, `Valor_Cuotas`, `cuotas_en_deuda`, `cuotas_pagas`, `VALOR`, `estado`) VALUES
(10, 1109000123, '2024-06-22 20:10:24', 12, 93519.00, 11, 1, 1122222.00, 6),
(11, 1007428011, '2024-06-22 21:02:32', 11, 356663.00, 10, 1, 3923292.00, 6);

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
(7, 'conserje', 1122222.00, 7700304515, 2),
(9, 'secretario', 4000000.00, 1109111919, 2);

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
(21, 4, 7700304515),
(25, 2, 1109111919);

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

--
-- Volcado de datos para la tabla `sumas`
--

INSERT INTO `sumas` (`ID_INDUCCION`, `fecha`, `id_usuario`, `valor_hora_extra`, `horas_trabajadas`, `transporte`, `total`) VALUES
(74, '2024-06-23 00:00:00', 1109000123, 25800, 0, 170000, 1219820),
(77, '2024-06-23 00:00:00', 1007428011, 23000, 2, 0, 2497612);

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
(1007428011, 'angie', 'gutierrez', 'angie@gmail.com', '3187738647', '35f8b64ac3b2cfa9c3ec7f52a572edf60f831e7e3befaefe17928d958f6ccb730eb2037f1e1875b3be44a9eb18a621ef449decd52d985169a84858a5d57bca8e', '../../../uploads/fotos/19678155966677815c86be76.49030288.png', 9, 6, 2000, 1109111919, ''),
(1007428012, 'angie', 'gutierrez', 'gutierrez@gmail.com', '3187738647', '35f8b64ac3b2cfa9c3ec7f52a572edf60f831e7e3befaefe17928d958f6ccb730eb2037f1e1875b3be44a9eb18a621ef449decd52d985169a84858a5d57bca8e', '../../../uploads/fotos/15689771586677800a3c0ac0.48210996.jpg', 9, 7, 2000, 1109111919, ''),
(1007428013, 'angie', 'gutierrez', 'gutierrezangietatiana@gmail.com', '3187738647', '35f8b64ac3b2cfa9c3ec7f52a572edf60f831e7e3befaefe17928d958f6ccb730eb2037f1e1875b3be44a9eb18a621ef449decd52d985169a84858a5d57bca8e', NULL, NULL, 5, 2000, 1109111919, NULL),
(1105462834, 'Brian', 'Avila', 'Brianjulian@gmail.com', '3112346543', 'fc1a24b284807264e93dcefa6e26e175e8165f8c85fc6c777840b9fa8718b54e87fdd37a6e67ac80d06e046bd59e8a368ee6591ce92d31e9b684e2f4ec3017d6', '../../../uploads/fotos/user.jpg', 7, 7, 3434, 7700304515, ''),
(1109000123, 'larry', 'garcia', 'garcialarry03@gmail.com', '3173328716', 'fc1a24b284807264e93dcefa6e26e175e8165f8c85fc6c777840b9fa8718b54e87fdd37a6e67ac80d06e046bd59e8a368ee6591ce92d31e9b684e2f4ec3017d6', '../../../uploads/fotos/user.jpg', 7, 6, 730004, 7700304515, ''),
(1109000445, 'Prueba', 'UNO', 'garcialarry0338@gmail.com', '3173328715', '4d0b24ccade22df6d154778cd66baf04288aae26df97a961f3ea3dd616fbe06dcebecc9bbe4ce93c8e12dca21e5935c08b0954534892c568b8c12b92f26a2448', NULL, NULL, 5, 3436, 1109000123, NULL),
(1109000587, 'Larry', 'Garcia', 'windonpc125@gmail.com', '3173328716', 'eaf03a7d744a6329676a694d5d70c5fbb6eb6b5d6c34889f93714923af0f85db50b268059ae737959c858ec97dcfd610a15934685c09b71826dbce17ac9075c9', NULL, NULL, 4, 3017, NULL, NULL),
(1121212112, 'lmlkl', 'hghfhfgf', 'hh@gmail.com', '6433232342', 'fef221254dd93aa65538a9895f62b642e523b412f0a569653fb89901f2a8911d4e8ef3d8c6b4805ced85f64c3f77bd16efb29f7f1d3f885e75c333c8e555e261', NULL, NULL, 5, 4324, 7501033210, NULL),
(1234567876, 'lkjhgfghj', 'lkjhgfdfghj', 'kjhgh@gmail.com', '9876556789', '7ca3dcd51f278e91a6491754a1bce0178c3ae9377c66946337a916ac31bc2c5dbe2810381e72ae8d8680bfc047465f4a65e895f87a768dc91f70156d53a6b994', NULL, NULL, 5, 9876, 7700304515, NULL);

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
(11, 25800, 7700304515),
(13, 23000, 1109111919);

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
  MODIFY `ID_DEDUCCION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `ID_Es` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `pension`
--
ALTER TABLE `pension`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `ID_prest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `salud`
--
ALTER TABLE `salud`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `sumas`
--
ALTER TABLE `sumas`
  MODIFY `ID_INDUCCION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `tp_licencia`
--
ALTER TABLE `tp_licencia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1215;

--
-- AUTO_INCREMENT de la tabla `v_h_extra`
--
ALTER TABLE `v_h_extra`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
