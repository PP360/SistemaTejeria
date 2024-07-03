-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2017 a las 00:40:08
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `p_tejeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_area` varchar(25) NOT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `nombre_area`) VALUES
(1, 'Administración'),
(2, 'Bodega'),
(3, 'Producción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `botellas`
--

CREATE TABLE IF NOT EXISTS `botellas` (
  `id_botella` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_botella` varchar(100) NOT NULL,
  `unidad_medida` varchar(25) NOT NULL,
  `precio_botella` varchar(255) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_botella`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `botellas`
--

INSERT INTO `botellas` (`id_botella`, `tipo_botella`, `unidad_medida`, `precio_botella`, `active`, `status`) VALUES
(2, 'Botella de 408ml PCO', 'Pza', '6', 1, 1),
(3, 'Botella de 409ml PCO', 'Pza', '8', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT '0',
  `brand_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(1, 'plastico', 1, 1),
(1, 'plastico', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT '0',
  `categories_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(1, 'botellas', 1, 2),
(2, 'tapas', 1, 1),
(3, 'PET', 1, 1),
(1, 'botellas', 1, 2),
(2, 'tapas', 1, 1),
(3, 'PET', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `rfc` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_cliente` varchar(50) CHARACTER SET latin1 NOT NULL,
  `direccion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `telefono` varchar(12) CHARACTER SET latin1 NOT NULL,
  `celular` varchar(12) CHARACTER SET latin1 NOT NULL,
  `otro` int(15) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `rfc`, `nombre_cliente`, `direccion`, `email`, `telefono`, `celular`, `otro`) VALUES
(1, '1251523', 'Gonzalo Alberto Castillo Gonzalez', 'Teapa Tabasco', 'gonzalocast17@gmail.com', '9323233321', '9323234332', 0),
(3, 'CAGG62694UTA', 'gonzalo', 'aassd', 'gonzalocast17@gmail.com', '2323', '2323', 0),
(4, 'TELE8003321-ME2', 'TELE-SERVI', 'AV. CARLOS RAMOS NO. 123 COL. CENTRO TEAPA TABASCO', 'teleservi@gmail.com', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_preformas`
--

CREATE TABLE IF NOT EXISTS `compra_preformas` (
  `id_compraPreformas` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `codigo_compraPreformas` int(11) NOT NULL,
  `id_proveedor` int(25) NOT NULL,
  `total_compra` double NOT NULL,
  PRIMARY KEY (`id_compraPreformas`),
  KEY `id_compraPreformas` (`id_compraPreformas`),
  KEY `id_compraPreformas_2` (`id_compraPreformas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `compra_preformas`
--

INSERT INTO `compra_preformas` (`id_compraPreformas`, `fecha_compra`, `codigo_compraPreformas`, `id_proveedor`, `total_compra`) VALUES
(1, '2017-02-27 21:18:31', 1, 12, 69042.96),
(2, '2017-02-27 21:18:31', 1, 12, 43151.85),
(3, '2017-02-27 21:18:31', 1, 12, 50343.825),
(4, '2017-05-23 14:15:10', 2, 10, 8690.22),
(5, '2017-06-02 03:40:05', 3, 13, 8690.22),
(6, '2017-06-02 03:41:33', 4, 10, 3657.5),
(7, '2017-09-04 03:11:20', 5, 10, 26334);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_resina`
--

CREATE TABLE IF NOT EXISTS `compra_resina` (
  `id_compraResina` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `codigo_compraResina` int(11) NOT NULL,
  `id_proveedor` int(10) NOT NULL,
  `total_compra` int(50) NOT NULL,
  PRIMARY KEY (`id_compraResina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `compra_resina`
--

INSERT INTO `compra_resina` (`id_compraResina`, `fecha_compra`, `codigo_compraResina`, `id_proveedor`, `total_compra`) VALUES
(1, '2017-02-27 21:20:02', 1, 13, 1000000),
(2, '2017-06-02 03:37:00', 2, 12, 420000),
(3, '2017-06-02 17:15:55', 3, 12, 420000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_tapas`
--

CREATE TABLE IF NOT EXISTS `compra_tapas` (
  `id_compraTapas` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `codigo_compraTapas` int(11) NOT NULL,
  `id_proveedor` int(10) NOT NULL,
  `total_compra` double NOT NULL,
  PRIMARY KEY (`id_compraTapas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `compra_tapas`
--

INSERT INTO `compra_tapas` (`id_compraTapas`, `fecha_compra`, `codigo_compraTapas`, `id_proveedor`, `total_compra`) VALUES
(1, '2017-02-27 21:19:29', 1, 12, 60375),
(2, '2017-02-27 21:19:29', 1, 12, 60375),
(3, '2017-02-27 21:19:29', 1, 12, 3750);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_comprapreformas`
--

CREATE TABLE IF NOT EXISTS `detalle_comprapreformas` (
  `id_detalleCompraPreformas` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_compraPreformas` varchar(50) NOT NULL,
  `id_preforma` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_detalleCompraPreformas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `detalle_comprapreformas`
--

INSERT INTO `detalle_comprapreformas` (`id_detalleCompraPreformas`, `codigo_compraPreformas`, `id_preforma`, `cantidad`) VALUES
(1, '1', 7, 80000),
(2, '1', 8, 50000),
(3, '1', 9, 70000),
(4, '2', 13, 21000),
(5, '3', 13, 21000),
(6, '4', 9, 5000),
(7, '5', 8, 30000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compraresina`
--

CREATE TABLE IF NOT EXISTS `detalle_compraresina` (
  `id_detalleCompraResina` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_compraResina` varchar(50) NOT NULL,
  `id_resina` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_detalleCompraResina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `detalle_compraresina`
--

INSERT INTO `detalle_compraresina` (`id_detalleCompraResina`, `codigo_compraResina`, `id_resina`, `cantidad`) VALUES
(1, '1', 2, 50000),
(2, '2', 2, 21000),
(3, '3', 2, 21000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compratapas`
--

CREATE TABLE IF NOT EXISTS `detalle_compratapas` (
  `id_detalleCompraTapas` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_compraTapas` varchar(50) NOT NULL,
  `id_tapa` int(11) NOT NULL,
  `cantidad` int(50) NOT NULL,
  PRIMARY KEY (`id_detalleCompraTapas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `detalle_compratapas`
--

INSERT INTO `detalle_compratapas` (`id_detalleCompraTapas`, `codigo_compraTapas`, `id_tapa`, `cantidad`) VALUES
(1, '1', 3, 500000),
(2, '1', 3, 500000),
(3, '1', 4, 30000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entregapreformas`
--

CREATE TABLE IF NOT EXISTS `detalle_entregapreformas` (
  `id_detalleEntregaPreformas` int(11) NOT NULL AUTO_INCREMENT,
  `id_entregaPreformas` int(11) NOT NULL,
  `id_preforma` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo_botella` varchar(35) NOT NULL,
  PRIMARY KEY (`id_detalleEntregaPreformas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `detalle_entregapreformas`
--

INSERT INTO `detalle_entregapreformas` (`id_detalleEntregaPreformas`, `id_entregaPreformas`, `id_preforma`, `cantidad`, `tipo_botella`) VALUES
(26, 1, 8, 1800, ''),
(27, 27, 13, 13316, ''),
(28, 28, 8, 1684, ''),
(29, 29, 8, 1200, ''),
(30, 30, 8, 1260, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entregaresina`
--

CREATE TABLE IF NOT EXISTS `detalle_entregaresina` (
  `id_detalleEntregaResina` int(11) NOT NULL AUTO_INCREMENT,
  `id_entregaResina` int(11) NOT NULL,
  `id_resina` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_detalleEntregaResina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `detalle_entregaresina`
--

INSERT INTO `detalle_entregaresina` (`id_detalleEntregaResina`, `id_entregaResina`, `id_resina`, `cantidad`) VALUES
(1, 1, 2, 2000),
(2, 2, 2, 900),
(3, 1, 2, 3000),
(4, 4, 2, 21000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entregatapas`
--

CREATE TABLE IF NOT EXISTS `detalle_entregatapas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_entregapreformas` int(10) unsigned NOT NULL,
  `id_tapas` int(10) unsigned NOT NULL,
  `cantidad` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `detalle_entregatapas`
--

INSERT INTO `detalle_entregatapas` (`id`, `id_entregapreformas`, `id_tapas`, `cantidad`) VALUES
(1, 20, 3, 11518),
(2, 21, 3, 16116),
(3, 24, 4, 4500),
(4, 25, 4, 21000),
(5, 1, 4, 1800),
(6, 27, 3, 13316),
(7, 28, 3, 1684),
(8, 29, 3, 1200),
(9, 30, 3, 1260);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega_preformas`
--

CREATE TABLE IF NOT EXISTS `entrega_preformas` (
  `id_entregaPreformas` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrega` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuarioEntrega` int(11) NOT NULL,
  `id_usuarioRecibe` int(11) NOT NULL,
  PRIMARY KEY (`id_entregaPreformas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `entrega_preformas`
--

INSERT INTO `entrega_preformas` (`id_entregaPreformas`, `fecha_entrega`, `id_usuarioEntrega`, `id_usuarioRecibe`) VALUES
(26, '2017-08-17 18:38:59', 2, 9),
(27, '2017-08-23 13:19:54', 2, 9),
(28, '2017-09-04 01:06:20', 2, 9),
(29, '2017-09-04 02:37:48', 2, 9),
(30, '2017-09-04 03:12:24', 2, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega_resina`
--

CREATE TABLE IF NOT EXISTS `entrega_resina` (
  `id_entregaResina` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrega` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuarioEntrega` int(11) NOT NULL,
  `id_usuarioRecibe` int(11) NOT NULL,
  PRIMARY KEY (`id_entregaResina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `entrega_resina`
--

INSERT INTO `entrega_resina` (`id_entregaResina`, `fecha_entrega`, `id_usuarioEntrega`, `id_usuarioRecibe`) VALUES
(1, '2017-02-27 21:35:22', 2, 9),
(2, '2017-06-02 03:49:50', 2, 9),
(3, '2017-06-02 04:09:14', 3, 9),
(4, '2017-06-02 17:17:12', 4, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_botellas`
--

CREATE TABLE IF NOT EXISTS `inventario_botellas` (
  `id_inventarioBotella` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_botella` varchar(11) NOT NULL,
  `unidad_medida` varchar(25) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_inventarioBotella`),
  KEY `id_inventarioBotella` (`id_inventarioBotella`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `inventario_botellas`
--

INSERT INTO `inventario_botellas` (`id_inventarioBotella`, `tipo_botella`, `unidad_medida`, `cantidad`) VALUES
(1, '2', 'Pza', 81785),
(2, '3', 'Pza', 37035),
(3, '3', 'Pza', 11100),
(4, '', 'Pza', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_preformas`
--

CREATE TABLE IF NOT EXISTS `inventario_preformas` (
  `id_inventarioPreformas` int(11) NOT NULL AUTO_INCREMENT,
  `id_preforma` int(10) NOT NULL,
  `cantidad` int(50) NOT NULL,
  PRIMARY KEY (`id_inventarioPreformas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `inventario_preformas`
--

INSERT INTO `inventario_preformas` (`id_inventarioPreformas`, `id_preforma`, `cantidad`) VALUES
(1, 7, 20000),
(2, 8, 48090),
(3, 9, 2500),
(4, 13, 9684);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_resina`
--

CREATE TABLE IF NOT EXISTS `inventario_resina` (
  `id_inventarioResina` int(11) NOT NULL AUTO_INCREMENT,
  `id_resina` int(10) NOT NULL,
  `cantidad` int(50) NOT NULL,
  PRIMARY KEY (`id_inventarioResina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `inventario_resina`
--

INSERT INTO `inventario_resina` (`id_inventarioResina`, `id_resina`, `cantidad`) VALUES
(1, 2, 60000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_tapas`
--

CREATE TABLE IF NOT EXISTS `inventario_tapas` (
  `id_inventarioTapas` int(11) NOT NULL AUTO_INCREMENT,
  `id_tapa` int(11) NOT NULL,
  `cantidad` int(50) NOT NULL,
  PRIMARY KEY (`id_inventarioTapas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `inventario_tapas`
--

INSERT INTO `inventario_tapas` (`id_inventarioTapas`, `id_tapa`, `cantidad`) VALUES
(1, 3, 970556),
(2, 4, 2800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `order_status`) VALUES
(0, '2017-05-04', 'Gonzalo Alberto Castillo Gonzalez', '932100', '608.00', '608.00', '0', '608.00', '608', '0.00', 2, 1, 1),
(0, '2017-05-08', 'TELE-SERVI', '9321021145', '14.00', '14.00', '0', '14.00', '14', '0.00', 2, 1, 1),
(1, '2017-05-08', 'TELE-SERVI', '932100220', '16.00', '16.00', '0', '16.00', '16', '0.00', 2, 1, 1),
(0, '2017-05-01', 'Gonzalo Alberto Castillo Gonzalez', '932102511', '14.00', '14.00', '0', '14.00', '14', '0.00', 2, 1, 1),
(0, '2017-05-07', 'Gonzalo Alberto Castillo Gonzalez', '932', '22.00', '22.00', '0', '22.00', '22', '0.00', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`) VALUES
(76, 164, 1, '50', '6', '300.00', 2),
(77, 164, 2, '90', '23', '2070.00', 2),
(78, 165, 2, '23', '23', '529.00', 2),
(79, 165, 2, '53', '23', '1219.00', 2),
(80, 166, 1, '6', '6', '36.00', 2),
(81, 166, 2, '8', '23', '184.00', 2),
(82, 167, 1, '1', '6', '6.00', 2),
(83, 168, 2, '1', '23', '23.00', 2),
(86, 170, 1, '5', '6', '30.00', 1),
(87, 170, 2, '21', '23', '483.00', 1),
(89, 169, 1, '1', '6', '6.00', 1),
(90, 171, 1, '1', '6', '6.00', 1),
(76, 164, 1, '50', '6', '300.00', 2),
(77, 164, 2, '90', '23', '2070.00', 2),
(78, 165, 2, '23', '23', '529.00', 2),
(79, 165, 2, '53', '23', '1219.00', 2),
(80, 166, 1, '6', '6', '36.00', 2),
(81, 166, 2, '8', '23', '184.00', 2),
(82, 167, 1, '1', '6', '6.00', 2),
(83, 168, 2, '1', '23', '23.00', 2),
(86, 170, 1, '5', '6', '30.00', 1),
(87, 170, 2, '21', '23', '483.00', 1),
(89, 169, 1, '1', '6', '6.00', 1),
(90, 171, 1, '1', '6', '6.00', 1),
(0, 0, 2, '100', '6', '600.00', 1),
(0, 1, 3, '1', '8', '8.00', 1),
(0, 0, 2, '1', '6', '6.00', 1),
(0, 0, 3, '1', '8', '8.00', 1),
(0, 0, 3, '1', '8', '8.00', 1),
(0, 0, 3, '1', '8', '8.00', 1),
(0, 0, 2, '1', '6', '6.00', 1),
(0, 0, 3, '1', '8', '8.00', 1),
(0, 0, 2, '1', '6', '6.00', 1),
(0, 0, 3, '1', '8', '8.00', 1),
(0, 0, 3, '1', '8', '8.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preformas`
--

CREATE TABLE IF NOT EXISTS `preformas` (
  `id_preforma` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_medida` varchar(5) CHARACTER SET latin1 NOT NULL,
  `gramaje` varchar(100) CHARACTER SET latin1 NOT NULL,
  `usd` double NOT NULL,
  `tipo_cambio` double NOT NULL,
  PRIMARY KEY (`id_preforma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `preformas`
--

INSERT INTO `preformas` (`id_preforma`, `unidad_medida`, `gramaje`, `usd`, `tipo_cambio`) VALUES
(7, 'Pza', 'Preforma de 13 Grs. Corvaglia', 39.9, 22),
(8, 'Pza', 'Preforma de 21 Grs. Corvaglia', 39.9, 22),
(9, 'Pza', 'Preforma de 17.5 Grs. PCO', 33.25, 22),
(10, 'Pza', 'Preforma de 25 Grs. PCO', 47.5, 22),
(11, 'Pza', 'Preforma de 28 Grs. PCO', 53.2, 22),
(12, 'Pza', 'Preforma de 18.5 Grs. CSN 26', 35.15, 22),
(13, 'Pza', 'Preforma de 10 Grs. CSN 26', 18.81, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion_botella`
--

CREATE TABLE IF NOT EXISTS `produccion_botella` (
  `id_produccionBotella` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipobotella` int(11) NOT NULL,
  `fecha_produccion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_entregaPreformas` int(11) NOT NULL,
  `id_usuarioProduce` int(11) NOT NULL,
  `estatus` varchar(25) NOT NULL,
  `merma` int(11) NOT NULL,
  `devolucion` int(11) NOT NULL,
  `elaboradas` int(11) NOT NULL,
  PRIMARY KEY (`id_produccionBotella`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `produccion_botella`
--

INSERT INTO `produccion_botella` (`id_produccionBotella`, `id_tipobotella`, `fecha_produccion`, `id_entregaPreformas`, `id_usuarioProduce`, `estatus`, `merma`, `devolucion`, `elaboradas`) VALUES
(31, 3, '2017-08-17 19:12:46', 26, 9, 'Completada', 50, 400, 1350),
(32, 3, '2017-08-23 13:23:19', 27, 9, 'Completada', 80, 0, 13236),
(33, 0, '2017-08-23 14:23:03', 0, 9, '', 0, 0, 0),
(34, 3, '2017-09-04 01:08:08', 28, 9, 'Completada', 100, 300, 1284),
(35, 3, '2017-09-04 02:38:44', 29, 9, 'Completada', 50, 100, 1050),
(36, 3, '2017-09-04 03:13:13', 30, 9, 'Completada', 60, 150, 1050);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `categories_id` varchar(30) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `categories_id`, `rate`, `active`, `status`) VALUES
(1, 'botellaOBC', 'Pza', '30', 1, 1),
(2, 'botella', 'Pza', '45', 1, 1),
(1, 'botellaOBC', 'Pza', '30', 1, 1),
(2, 'botella', 'Pza', '45', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `rfc` varchar(15) CHARACTER SET latin1 NOT NULL,
  `nombre_fiscal` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nombre_contacto` varchar(50) CHARACTER SET latin1 NOT NULL,
  `direccion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `telefono` varchar(12) CHARACTER SET latin1 NOT NULL,
  `celular` varchar(12) CHARACTER SET latin1 NOT NULL,
  `otro` int(15) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `rfc`, `nombre_fiscal`, `nombre_contacto`, `direccion`, `email`, `telefono`, `celular`, `otro`) VALUES
(10, 'EMO880404488', 'Envases Multiples de Occidente SA de Cv', 'Araceli Garcia', 'Zapopan Jalisco', 'arags75@hotmail.com', '3336569176', '3336569176', 2147483647),
(12, '134423XVCG', 'Envases Plásticos del Sureste', 'Gonzalo Alberto', 'Villahermosa Tabasco.', 'gonzalocast17@gmail.com', '9323212234', '9934325432', 0),
(13, 'ENVPLT', 'Envases Plasticos la Tejeria', 'Mauricio Oropeza Salazar', 'Teapa', 'mauricio@gmail.com', '9323254478', '9936547889', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resina`
--

CREATE TABLE IF NOT EXISTS `resina` (
  `id_resina` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `unidad_medida` varchar(25) CHARACTER SET latin1 NOT NULL,
  `precio` double NOT NULL,
  PRIMARY KEY (`id_resina`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `resina`
--

INSERT INTO `resina` (`id_resina`, `nombre`, `unidad_medida`, `precio`) VALUES
(2, 'PET', 'Kg', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tapas`
--

CREATE TABLE IF NOT EXISTS `tapas` (
  `id_tapa` int(11) NOT NULL AUTO_INCREMENT,
  `tamano` varchar(100) CHARACTER SET latin1 NOT NULL,
  `unidad_medida` varchar(25) CHARACTER SET latin1 NOT NULL,
  `precio` double NOT NULL,
  PRIMARY KEY (`id_tapa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tapas`
--

INSERT INTO `tapas` (`id_tapa`, `tamano`, `unidad_medida`, `precio`) VALUES
(3, 'Tapa de 28 mm Corta', 'Pza', 0.12075),
(4, 'Tapa de 28 mm Standar', 'Pza', 0.125);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `turno` varchar(25) NOT NULL,
  `id_area` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `usuario`, `contrasena`, `turno`, `id_area`) VALUES
(1, 'Gonzalo Alberto', 'gonzo', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'Matutino', 1),
(2, 'Dafne Alvarez', 'Dafne', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'Matutino', 2),
(3, 'Genaro Díaz', 'Genaro', 'b706bf6aa8575ad5e84103fcc7ed86f1806ca991', 'Matutino', 1),
(6, 'Mauricio Oropeza Salazar', 'mauricio', 'adcd7048512e64b48da55b027577886ee5a36350', 'Matutino', 1),
(9, 'Angelica Avalos', 'Angelica', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'Matutino', 3),
(10, 'Jose de la Cruz', 'jose', 'adcd7048512e64b48da55b027577886ee5a36350', 'Vespertino', 2),
(11, 'Jose de la Cruz Cruz', 'pepe', '1bb926c6c1f62d5d107a4db87549ec7da365464f', 'Matutino', 2),
(12, 'Marco Antonio de la Fuente', 'marco', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'Matutino', 3),
(13, 'José Valencia Cruz', 'PP360', '5d0027d7ba148a2c83becb2cf2669feca6107007', 'Matutino', 1),
(14, 'diogenes', 'diogenes', 'df2cd7104536553afde9f7d66133d578eccb4606', 'Matutino', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
