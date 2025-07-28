-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2025 a las 03:37:54
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cics`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidades`
--

CREATE TABLE `entidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entidades`
--

INSERT INTO `entidades` (`id`, `nombre`) VALUES
(1, 'Universidad Mayor'),
(2, 'CONICYT'),
(3, 'Comisión Nacional de Acreditación'),
(4, 'Explora CONICYT para Productos de Difusión Científica y Tecnológica'),
(5, 'Agencia Chilena de Cooperación Internacional para el Desarrollo (AGCID)'),
(6, 'CYTED'),
(7, 'ANID (CONICYT)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_a`
--

CREATE TABLE `estado_a` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_a`
--

INSERT INTO `estado_a` (`id`, `tipo_estado`) VALUES
(2, 'Aceptado'),
(4, 'En desarrollo'),
(3, 'En evaluación'),
(1, 'Publicado'),
(5, 'Suspendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_ie`
--

CREATE TABLE `estado_ie` (
  `id` int(11) UNSIGNED NOT NULL,
  `tipo_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_ie`
--

INSERT INTO `estado_ie` (`id`, `tipo_estado`) VALUES
(8, 'Aprobado'),
(13, 'Cancelado'),
(10, 'En ejecución'),
(7, 'En revisión'),
(11, 'Finalizado'),
(9, 'Rechazado'),
(14, 'Reformulado'),
(12, 'Suspendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(10) UNSIGNED NOT NULL,
  `pais` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `pais`) VALUES
(1, 'Argentina'),
(2, 'Bolivia'),
(3, 'Brasil'),
(4, 'Chile'),
(5, 'Colombia'),
(6, 'Ecuador'),
(19, 'EE.UU'),
(18, 'España'),
(10, 'Guatemala'),
(20, 'México'),
(11, 'Paraguay'),
(7, 'Perú'),
(8, 'Uruguay'),
(9, 'Venezuela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos_ie`
--

CREATE TABLE `proyectos_ie` (
  `id` int(11) NOT NULL,
  `anio` year(4) NOT NULL,
  `entidad_id` int(11) NOT NULL,
  `estado_id` int(10) UNSIGNED NOT NULL,
  `titulo_propuesta` varchar(255) NOT NULL,
  `otras_entidades` text DEFAULT NULL,
  `tipo_proyecto` varchar(50) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos_ie`
--

INSERT INTO `proyectos_ie` (`id`, `anio`, `entidad_id`, `estado_id`, `titulo_propuesta`, `otras_entidades`, `tipo_proyecto`, `fecha_registro`) VALUES
(2, '2019', 1, 12, 'Person authentication using EEG-based biometry: Performance comparison.', 'N/A', 'Externo', '2025-07-13 22:52:30'),
(3, '2019', 2, 9, 'Weighing reputational damage based on social media viralization metrics: Technical and legal perspectives', 'Universidad Mayor', 'Externo', '2025-07-13 22:52:30'),
(4, '2020', 6, 9, 'ETI-COMP: Integración de la Ética en Curriculas Universitarias de Ingeniería Informática', '\"Universidad Mayor\" -  \"Universidad de Lleida - España\" - \"Universidad del Cauca - Colombia\"', 'Externo', '2025-07-13 22:52:30'),
(5, '2019', 3, 9, 'Propuesta de Integración de Ciberseguridad a las Nuevas Mallas de Pre y Postgrado', 'Universidad Mayor', 'Externo', '2025-07-13 22:52:30'),
(6, '2019', 4, 9, 'Podcast sobre Experiencias e Inclusión de Mujeres en Ciberseguridad', 'N/A', 'Externo', '2025-07-13 23:50:30'),
(7, '2015', 1, 13, 'test', '1', 'test', '2025-07-27 20:26:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL DEFAULT 'estandar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `nombre_completo`, `tipo_usuario`) VALUES
(5, 'jesusedt', '$2y$10$rOCUjbfGw1cTUipXu8I8ueiF59/Wbm/B/Kw1hiycBbpU8/vXRX/xu', 'Jesus Delgado', 'administrador'),
(6, 'admin', '$2y$10$rOCUjbfGw1cTUipXu8I8ueiF59/Wbm/B/Kw1hiycBbpU8/vXRX/xu', 'Usuario Estandar', 'estandar'),
(8, 'jesusedt@gmail.com', '$2y$10$lpHZ4CsfFXH9FFgZoAGdju8bdgm6DnzoCMDNOTbRVgicRBCfrXpUC', 'Jesus Enrique Delgado Toro', 'administrador'),
(9, 'test', '$2y$10$v3JDLmtXs3tref7buWLwBeUR8aTI48WQBbWYZNSpfMo1/ajKKsUye', 'test', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `entidades`
--
ALTER TABLE `entidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_a`
--
ALTER TABLE `estado_a`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipo_estado` (`tipo_estado`) USING BTREE;

--
-- Indices de la tabla `estado_ie`
--
ALTER TABLE `estado_ie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipo_estado` (`tipo_estado`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pais` (`pais`);

--
-- Indices de la tabla `proyectos_ie`
--
ALTER TABLE `proyectos_ie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entidad_id` (`entidad_id`),
  ADD KEY `estado_id` (`estado_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `entidades`
--
ALTER TABLE `entidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estado_a`
--
ALTER TABLE `estado_a`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado_ie`
--
ALTER TABLE `estado_ie`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `proyectos_ie`
--
ALTER TABLE `proyectos_ie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyectos_ie`
--
ALTER TABLE `proyectos_ie`
  ADD CONSTRAINT `proyectos_ie_ibfk_1` FOREIGN KEY (`entidad_id`) REFERENCES `entidades` (`id`),
  ADD CONSTRAINT `proyectos_ie_ibfk_2` FOREIGN KEY (`estado_id`) REFERENCES `estado_ie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
