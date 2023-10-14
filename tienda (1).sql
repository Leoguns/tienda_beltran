-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-10-2022 a las 08:58:40
-- Versión del servidor: 8.0.27
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'Abrigos'),
(2, 'Pantalones'),
(3, 'Remeras'),
(4, 'Verano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `id_compra` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `id_usuario`, `fecha`, `monto`) VALUES
(1, 110, '2022-09-14 00:00:00', '8067.00'),
(2, 110, '2022-09-14 00:00:00', '5600.00'),
(3, 110, '2022-09-16 00:00:00', '4567.00'),
(4, 110, '2022-09-16 00:00:00', '3500.00'),
(5, 110, '2022-09-16 00:00:00', '5600.00'),
(6, 110, '2022-09-16 00:00:00', '3500.00'),
(7, 110, '2022-09-16 00:00:00', '3500.00'),
(8, 110, '2022-09-16 00:00:00', '5600.00'),
(9, 110, '2022-09-16 00:00:00', '3500.00'),
(10, 110, '2022-09-16 00:00:00', '5600.00'),
(11, 110, '2022-09-16 00:00:00', '5600.00'),
(12, 110, '2022-09-16 00:00:00', '3500.00'),
(13, 110, '2022-09-17 00:00:00', '4567.00'),
(14, 110, '2022-09-17 12:44:40', '4567.00'),
(15, 110, '2022-09-18 18:25:09', '3500.00'),
(16, 110, '2022-09-18 18:25:41', '3500.00'),
(17, 110, '2022-09-18 18:27:36', '1000.00'),
(18, 110, '2022-09-18 18:29:42', '4567.00'),
(19, 110, '2022-09-18 18:30:27', '3500.00'),
(20, 110, '2022-09-18 18:32:14', '3500.00'),
(21, 110, '2022-09-19 19:16:00', '8067.00'),
(22, 110, '2022-09-23 20:19:52', '4567.00'),
(23, 110, '2022-09-23 20:20:28', '3500.00'),
(24, 110, '2022-09-23 20:21:09', '8067.00'),
(25, 110, '2022-09-23 21:57:02', '16800.00'),
(26, 110, '2022-09-23 21:57:36', '4567.00'),
(27, 110, '2022-09-30 19:28:06', '3500.00'),
(28, 110, '2022-10-09 17:23:03', '3500.00'),
(29, 110, '2022-10-09 17:26:34', '3500.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

DROP TABLE IF EXISTS `detalle_compras`;
CREATE TABLE IF NOT EXISTS `detalle_compras` (
  `id_carrito` int NOT NULL AUTO_INCREMENT,
  `id_compra` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` decimal(12,0) NOT NULL,
  `precio_unitario` decimal(12,0) NOT NULL,
  PRIMARY KEY (`id_carrito`),
  KEY `id_producto` (`id_producto`),
  KEY `detalle_compras_ibfk_1` (`id_compra`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_compras`
--

INSERT INTO `detalle_compras` (`id_carrito`, `id_compra`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(4, 1, 13, '1', '4567'),
(5, 1, 12, '1', '3500'),
(6, 2, 11, '1', '5600'),
(7, 3, 13, '1', '4567'),
(8, 4, 12, '1', '3500'),
(9, 5, 11, '1', '5600'),
(10, 6, 12, '1', '3500'),
(11, 7, 12, '1', '3500'),
(12, 8, 11, '1', '5600'),
(13, 9, 12, '1', '3500'),
(14, 10, 11, '1', '5600'),
(15, 11, 11, '1', '5600'),
(16, 12, 12, '1', '3500'),
(17, 13, 13, '1', '4567'),
(18, 14, 13, '1', '4567'),
(19, 15, 12, '1', '3500'),
(20, 16, 12, '1', '3500'),
(21, 17, 14, '1', '1000'),
(22, 18, 13, '1', '4567'),
(23, 19, 12, '1', '3500'),
(24, 20, 12, '1', '3500'),
(25, 21, 13, '1', '4567'),
(26, 21, 12, '1', '3500'),
(27, 22, 13, '1', '4567'),
(28, 23, 12, '1', '3500'),
(29, 24, 12, '1', '3500'),
(30, 24, 13, '1', '4567'),
(31, 25, 11, '3', '5600'),
(32, 26, 13, '1', '4567'),
(33, 27, 12, '1', '3500'),
(34, 28, 12, '1', '3500'),
(35, 29, 12, '1', '3500');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'Habilitado'),
(2, 'Bloqueado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id_marca` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre`) VALUES
(1, 'Adidas'),
(2, 'Nike');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `id_pago` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `monto` decimal(10,0) DEFAULT NULL,
  `id_tipoPago` int DEFAULT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `fk_pagos_tipo` (`id_tipoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `id_marca` int NOT NULL,
  `id_categoria` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(12,0) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `talle` varchar(10) DEFAULT NULL,
  `stock` int NOT NULL,
  `imagen` varchar(300) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_producto`),
  KEY `id_marca` (`id_marca`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_marca`, `id_categoria`, `nombre`, `precio`, `descripcion`, `talle`, `stock`, `imagen`, `estado`) VALUES
(11, 1, 1, 'Campera de Boca', '5600', 'Campera Deportiva', 'XXL', 390, 'abrigo5.jpg', b'1'),
(12, 1, 1, 'Camiseta de Boca', '3500', 'Camiseta Alternativa de Boca Juniors', 'M', 284, '2a394368-623x800.jpg', b'1'),
(13, 1, 1, 'a', '4567', 'asdadasd', 'xll', 290, 'A.jpg', b'1'),
(14, 1, 1, 'producto1', '1000', 'producto1', 'xl', 999, 'wp2149358.jpg', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagenes`
--

DROP TABLE IF EXISTS `producto_imagenes`;
CREATE TABLE IF NOT EXISTS `producto_imagenes` (
  `id_imagen` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `imagen` int NOT NULL,
  PRIMARY KEY (`id_imagen`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pagos`
--

DROP TABLE IF EXISTS `tipo_pagos`;
CREATE TABLE IF NOT EXISTS `tipo_pagos` (
  `id_tipoPago` int NOT NULL AUTO_INCREMENT,
  `Modo_Pago` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tipoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

DROP TABLE IF EXISTS `tipo_usuarios`;
CREATE TABLE IF NOT EXISTS `tipo_usuarios` (
  `id_tipo` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`id_tipo`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(130) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `last_session` datetime DEFAULT NULL,
  `id_estado` int DEFAULT NULL,
  `id_tipo` int DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_tipo` (`id_tipo`),
  KEY `estados_usuariosFK` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `nombre`, `correo`, `last_session`, `id_estado`, `id_tipo`) VALUES
(110, 'Angus', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Angus', 'cyberdyne710@gmail.com', '2022-10-09 17:22:50', 1, 1),
(113, 'leonelguns', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'leonelguns', 'fariasrodrigoleonel@gmail.com', NULL, 2, 2),
(119, 'guns1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'guns1', 'leitoguns@gmail.com', NULL, 2, 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD CONSTRAINT `detalle_compras_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `FK_detalle_compras_compras` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pagos_tipo` FOREIGN KEY (`id_tipoPago`) REFERENCES `tipo_pagos` (`id_tipoPago`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
tiendatiendatiendatienda
--
-- Filtros para la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD CONSTRAINT `producto_imagenes_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `estados_usuariosFK` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`),
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_usuarios` (`id_tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
