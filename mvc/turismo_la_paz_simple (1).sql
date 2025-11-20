-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2025 a las 18:05:07
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
-- Base de datos: `turismo_la_paz_simple`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Sitios Históricos', 'Monumentos y lugares con valor histórico'),
(2, 'Naturaleza', 'Parques y lugares naturales'),
(3, 'Cultura', 'Museos y espacios culturales'),
(4, 'Mercados', 'Mercados tradicionales'),
(5, 'Religioso', 'Iglesias y templos'),
(6, 'Mirador', 'Lugares situados en un lugar estrategico para poder visualizar vistas importantes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares_turisticos`
--

CREATE TABLE `lugares_turisticos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `zona` varchar(50) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `horario` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lugares_turisticos`
--

INSERT INTO `lugares_turisticos` (`id`, `nombre`, `descripcion`, `direccion`, `zona`, `categoria_id`, `telefono`, `horario`, `precio`) VALUES
(1, 'Plaza Murillo', 'Plaza principal de La Paz, corazón político del país con el Palacio de Gobierno y la Catedral.', 'Calle Comercio esquina Ayacucho', 'Centro', 1, '2-2202000', '24 horas', 0.00),
(2, 'Valle de la Luna', 'Formación geológica única con paisajes lunares creados por la erosión.', 'Mallasa, Km 8', 'Zona Sur', 2, '2-2741236', '9:00 - 17:00', 15.00),
(3, 'Museo Nacional de Arte', 'Edificio colonial del siglo XVIII con importante colección de arte boliviano.', 'Calle Comercio esq. Socabaya', 'Centro', 3, '2-2408600', '9:30 - 18:30', 20.00),
(4, 'Mercado de las Brujas', 'Mercado tradicional famoso por productos rituales andinos y artesanías.', 'Calle Linares', 'Centro', 4, NULL, '8:00 - 20:00', 0.00),
(5, 'Basílica de San Francisco', 'Iglesia franciscana del siglo XVI, ejemplo del barroco mestizo.', 'Plaza San Francisco', 'Centro', 5, '2-2406129', '7:00 - 17:00', 0.00),
(6, 'Calle Jaén', 'Calle colonial mejor conservada de La Paz con museos y galerías.', 'Calle Jaén', 'Centro', 1, NULL, '9:00 - 18:00', 0.00),
(7, 'Mercado Lanza', 'Mercado tradicional famoso por jugos naturales y comida típica.', 'Calle Graneros', 'Centro', 4, NULL, '6:00 - 22:00', 0.00),
(8, 'Catedral Metropolitana', 'Catedral neoclásica en la Plaza Murillo, sede del Arzobispado.', 'Plaza Murillo', 'Centro', 5, '2-2406048', '8:00 - 12:00', 0.00),
(9, 'Parque Urbano Central', 'Parque moderno con áreas verdes y espacios recreativos.', 'Irpavi', 'Zona Sur', 2, NULL, '6:00 - 22:00', 0.00),
(11, 'Mirador Faro Murillo', 'Mirador de donde se puede ver el panorama de la ciudad ', 'Ciudad El Alto -La Paz ', 'Satelite', 3, '2440098', '8:00 - 16:00', 25.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `ultimo_acceso` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `nombre_completo`, `email`, `fecha_creacion`, `ultimo_acceso`, `activo`) VALUES
(1, 'admin', '$2y$10$Es0tnmqnyye4z5JlX8sowOijt0kYaahdPWnB.USNZ1ZK.K8tjU1RO', 'Administrador', NULL, '2025-11-08 18:27:36', '2025-11-11 01:19:22', 1),
(4, 'admin3', '$2y$10$iCd1KRqwSQglt53TYnBY6en57QblUQfhUmfGMb1SR2Iu62.zu25oO', '', NULL, '2025-11-11 02:35:04', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id` int(11) NOT NULL,
  `lugar_id` int(11) NOT NULL,
  `nombre_visitante` varchar(100) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL CHECK (`calificacion` between 1 and 5),
  `comentario` text DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id`, `lugar_id`, `nombre_visitante`, `calificacion`, `comentario`, `fecha`, `ip`) VALUES
(1, 2, 'Enrique', 5, 'No me gusto el lugar no hay sombra\r\n', '2025-11-11 00:21:29', '::1'),
(2, 5, 'david', 5, 'muy buen lugar aunque hay rejas que encierran la basilisca ', '2025-11-11 00:51:59', '::1'),
(3, 6, 'Micahel Jackson', 5, 'Muy bonita hay museos en esa calle y tiene historia la calle', '2025-11-11 01:02:05', '::1'),
(4, 6, 'Juan', 2, 'No me gusta es muy ofrico', '2025-11-11 01:16:03', '::1'),
(5, 4, 'Mauricio S', 3, 'Muy bueno pero todo es lo mismo', '2025-11-11 10:24:36', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lugares_turisticos`
--
ALTER TABLE `lugares_turisticos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lugar_id` (`lugar_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `lugares_turisticos`
--
ALTER TABLE `lugares_turisticos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lugares_turisticos`
--
ALTER TABLE `lugares_turisticos`
  ADD CONSTRAINT `lugares_turisticos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`lugar_id`) REFERENCES `lugares_turisticos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
