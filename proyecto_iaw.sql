-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2024 a las 00:33:39
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
-- Base de datos: `proyecto_iaw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`, `id_producto`, `precio_total`, `fecha_creacion`, `cantidad`) VALUES
(2, 1, 8, 11.00, '2024-11-27 22:35:25', 1),
(3, 1, 1, 19.00, '2024-11-27 22:49:22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `ultima_modificacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `ultima_modificacion`) VALUES
(1, 'Pato Pekinés', 'Pato laqueado servido con pancakes finos, pepino y salsa Hoisin, un clásico de la gastronomía de Beijing.', 19.00, 'pato_pekinés.jpg', '2024-10-31 23:00:00'),
(2, 'Arroz Frito', 'Arroz cocido salteado con verduras, huevo y a veces carne o mariscos, un plato esencial de la cocina cantonesa.', 7.50, 'arroz_frito.jpg', '2024-10-29 23:00:00'),
(3, 'Pollo Kung Pao', 'Pollo salteado con cacahuates, pimientos y salsa de soja, un plato picante y sabroso originario de Sichuan.', 12.00, 'pollo_kung_pao.jpg', '2024-10-27 23:00:00'),
(4, 'Dim Sum', 'Pequeñas empanaditas rellenas de cerdo, camarones o vegetales, servidas al vapor o fritas. Acompañan las tradicionales comidas chinas.', 6.50, 'dim_sum.jpg', '2024-10-24 22:00:00'),
(5, 'Sopa Agripicante', 'Sopa espesa con tofu, setas y un toque de vinagre y chile, muy popular en la cocina de Sichuan.', 5.00, 'sopa_agripicante.jpg', '2024-10-21 22:00:00'),
(6, 'Mapo Tofu', 'Tofu firme en salsa picante de frijoles y carne de cerdo, uno de los platos más emblemáticos de la cocina Sichuan.', 9.00, 'mapo_tofu.jpg', '2024-10-19 22:00:00'),
(7, 'Chow Mein', 'Fideos fritos salteados con carne, pollo o verduras, uno de los platos más populares de la cocina cantonesa.', 8.00, 'chow_mein.jpg', '2024-10-17 22:00:00'),
(8, 'Cerdo a la Mostaza', 'Cerdo cocinado en salsa espesa de mostaza, un plato tradicional con un sabor fuerte y delicioso.', 11.00, 'cerdo_mostaza.jpg', '2024-10-14 22:00:00'),
(9, 'Sopa de Wonton', 'Sopa ligera con wontons rellenos de cerdo y camarones, acompañada de caldo claro y fideos finos.', 4.50, 'sopa_wonton.jpg', '2024-10-09 22:00:00'),
(10, 'Pescado al Vapor con Jengibre', 'Pescado fresco cocinado al vapor con jengibre, cebollín y salsa de soja, una receta ligera y sabrosa.', 12.50, 'pescado_al_vapor.jpg', '2024-10-04 22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contraseña`, `fecha_creacion`) VALUES
(1, 'sandro', '123', '2024-11-27 18:43:08'),
(11, 'admin', '123', '2024-11-27 19:15:20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
