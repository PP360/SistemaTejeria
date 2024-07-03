-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2021 a las 16:10:12
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `p_tejeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajuste_preformas`
--

CREATE TABLE `ajuste_preformas` (
  `ID_Ajuste` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Id_compraPreformas` int(11) NOT NULL,
  `Gramaje` varchar(100) NOT NULL,
  `NumeroCaja` int(11) NOT NULL DEFAULT '0',
  `Cantidad_ajustada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ajuste_preformas`
--

INSERT INTO `ajuste_preformas` (`ID_Ajuste`, `Fecha`, `Id_compraPreformas`, `Gramaje`, `NumeroCaja`, `Cantidad_ajustada`) VALUES
(1, '2021-02-12 15:05:28', 25, '1\r\n', 0, 120),
(7, '2021-02-12 15:39:58', 28, '1', 0, -100),
(8, '2021-02-12 15:49:08', 32, '14', 0, 300),
(9, '2021-02-25 16:18:25', 32, '13', 1, 57);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `nombre_area` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `botellas` (
  `id_botella` int(11) NOT NULL,
  `tipo_botella` varchar(100) NOT NULL,
  `unidad_medida` varchar(25) NOT NULL,
  `precio_botella` varchar(255) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `botellas`
--

INSERT INTO `botellas` (`id_botella`, `tipo_botella`, `unidad_medida`, `precio_botella`, `active`, `status`) VALUES
(4, 'Botella de 1000 ml cuello corto 26mm', 'Pza', '1.53', 1, 1),
(5, 'Botella de 700 ml cuello corto 26mm', 'Pza', '0', 1, 1),
(6, 'Botella de 500 ml cuello corto 26mm', 'Pza', '0', 1, 1),
(7, 'Botella de 1000 ml cuello normal 28mm', 'Pza', '0', 1, 1),
(8, 'Botella de 700 ml cuello normal 28mm', 'Pza', '0', 1, 1),
(9, 'Botella de 500 ml cuello normal 28mm', 'Pza', '0', 1, 1),
(10, 'Botella de 940 ml licorera 28mm', 'Pza', '0', 1, 1),
(11, 'Botella de 408 ml licorera 28mm', 'Pza', '0', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
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

CREATE TABLE `categories` (
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

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `rfc` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_cliente` varchar(50) CHARACTER SET latin1 NOT NULL,
  `direccion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `telefono` varchar(12) CHARACTER SET latin1 NOT NULL,
  `celular` varchar(12) CHARACTER SET latin1 NOT NULL,
  `otro` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

CREATE TABLE `compra_preformas` (
  `id_compraPreformas` int(10) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `codigo_compraPreformas` int(11) NOT NULL,
  `id_proveedor` int(25) NOT NULL,
  `total_compra` double NOT NULL,
  `flete` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra_preformas`
--

INSERT INTO `compra_preformas` (`id_compraPreformas`, `fecha_compra`, `codigo_compraPreformas`, `id_proveedor`, `total_compra`, `flete`) VALUES
(1, '2020-09-21 23:17:20', 1, 14, 10723.284113472, 0),
(2, '2020-09-21 23:17:20', 1, 14, 11425.43910144, 0),
(3, '2020-09-21 23:17:20', 1, 14, 573336.07153805, 0),
(4, '2020-09-21 23:17:20', 1, 14, 26366.3979264, 0),
(5, '2020-09-21 23:17:21', 1, 14, 13205.6193696, 0),
(6, '2020-10-18 22:09:07', 2, 10, 8702.955222528, 500),
(7, '2020-10-18 22:12:33', 3, 10, 10723.284113472, 7500),
(8, '2020-10-18 22:12:33', 3, 10, 11446.084559, 7500),
(9, '2020-10-18 22:49:28', 4, 10, 53616.42056736, 5000),
(10, '2020-10-18 22:49:28', 4, 10, 34276.31730432, 5000),
(11, '2020-10-18 22:49:28', 4, 10, 10546.55917056, 5000),
(12, '2020-10-18 22:51:24', 5, 10, 10723.284113472, 3500),
(13, '2020-10-18 22:51:24', 5, 10, 22850.87820288, 3500),
(14, '2020-10-18 22:51:24', 5, 10, 3954.95968896, 3500),
(15, '2020-10-18 23:43:21', 6, 14, 35390.213712, 6000),
(16, '2020-10-18 23:43:21', 6, 14, 50276.72832, 6000),
(17, '2020-10-18 23:43:21', 6, 14, 822901.427712, 6000),
(18, '2020-10-18 23:43:21', 6, 14, 1450.29024, 6000),
(19, '2020-10-18 23:43:21', 6, 14, 14527.5672, 6000),
(20, '2020-12-05 15:41:34', 7, 14, 22685.74334208, 5000),
(21, '2020-12-05 16:28:31', 8, 14, 20237.08176, 15000),
(22, '2020-12-05 16:28:31', 8, 14, 1243.9728, 15000),
(23, '2020-12-05 17:37:18', 9, 14, 11827.49515584, 25000),
(24, '2020-12-05 17:37:18', 9, 14, 605148.99016666, 25000),
(25, '2020-12-05 17:37:18', 9, 14, 27294.2195904, 25000),
(26, '2020-12-05 17:37:18', 9, 14, 13670.3191656, 25000),
(27, '2020-12-05 18:19:47', 10, 14, 22201.263300384, 10000),
(28, '2020-12-05 18:19:47', 10, 14, 27340.6383312, 10000),
(29, '2021-02-12 15:40:52', 11, 10, 11100.631650192, 5000),
(30, '2021-02-12 15:40:52', 11, 10, 23654.99031168, 5000),
(31, '2021-02-12 15:48:21', 12, 10, 22201.263300384, 5000),
(32, '2021-02-12 15:48:21', 12, 10, 13670.3191656, 5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_resina`
--

CREATE TABLE `compra_resina` (
  `id_compraResina` int(11) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `codigo_compraResina` int(11) NOT NULL,
  `id_proveedor` int(10) NOT NULL,
  `total_compra` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_tapas`
--

CREATE TABLE `compra_tapas` (
  `id_compraTapas` int(11) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `codigo_compraTapas` int(11) NOT NULL,
  `id_proveedor` int(10) NOT NULL,
  `total_compra` double NOT NULL,
  `flete` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra_tapas`
--

INSERT INTO `compra_tapas` (`id_compraTapas`, `fecha_compra`, `codigo_compraTapas`, `id_proveedor`, `total_compra`, `flete`) VALUES
(1, '2020-09-25 17:20:54', 1, 10, 880, 0),
(2, '2020-09-25 21:10:10', 2, 10, 2062.8, 0),
(3, '2020-09-25 21:10:30', 3, 10, 2640, 0),
(4, '2020-09-25 21:21:10', 4, 10, 4400, 0),
(5, '2020-09-25 21:21:10', 4, 14, 3438, 0),
(6, '2020-09-25 21:41:47', 6, 14, 4813.2, 0),
(7, '2020-10-18 21:22:49', 7, 10, 4400, 4500),
(8, '2021-02-18 16:18:57', 8, 14, 8800, 25000),
(9, '2021-02-18 16:18:58', 8, 14, 3438, 25000),
(10, '2021-02-19 16:47:40', 10, 14, 1760, 5000),
(11, '2021-02-19 16:47:40', 10, 14, 3438, 5000),
(12, '2021-02-19 16:58:08', 12, 14, 880, 2000),
(13, '2021-02-19 16:58:08', 12, 14, 687.6, 2000),
(14, '2021-02-19 18:18:57', 14, 15, 28800, 0),
(15, '2021-02-19 18:22:31', 15, 10, 6876, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_comprapreformas`
--

CREATE TABLE `detalle_comprapreformas` (
  `id_detalleCompraPreformas` int(11) NOT NULL,
  `codigo_compraPreformas` varchar(50) NOT NULL,
  `id_preforma` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cajas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_comprapreformas`
--

INSERT INTO `detalle_comprapreformas` (`id_detalleCompraPreformas`, `codigo_compraPreformas`, `id_preforma`, `cantidad`, `cajas`) VALUES
(1, '1', 1, 23184, 0),
(2, '1', 11, 18816, 0),
(3, '1', 13, 663408, 0),
(4, '1', 12, 26880, 0),
(5, '1', 14, 9120, 0),
(6, '2', 1, 18816, 1),
(7, '3', 1, 23184, 1),
(8, '3', 11, 18850, 1),
(9, '4', 1, 115920, 0),
(10, '4', 11, 56448, 0),
(11, '4', 12, 10752, 0),
(12, '5', 1, 23184, 1),
(13, '5', 11, 37632, 2),
(14, '5', 12, 4032, 3),
(15, '6', 1, 69552, 3),
(16, '6', 11, 75264, 4),
(17, '6', 13, 865536, 46),
(18, '6', 12, 1344, 1),
(19, '6', 14, 9120, 1),
(20, '7', 11, 37632, 2),
(21, '8', 1, 46368, 2),
(22, '8', 12, 1344, 1),
(23, '9', 11, 18816, 1),
(24, '9', 13, 676416, 52),
(25, '9', 12, 26880, 2),
(26, '9', 14, 9120, 1),
(27, '10', 1, 46368, 2),
(28, '10', 14, 18240, 2),
(29, '11', 1, 23184, 1),
(30, '11', 11, 37632, 2),
(31, '12', 1, 46368, 2),
(32, '12', 14, 9120, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compraresina`
--

CREATE TABLE `detalle_compraresina` (
  `id_detalleCompraResina` int(11) NOT NULL,
  `codigo_compraResina` varchar(50) NOT NULL,
  `id_resina` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compratapas`
--

CREATE TABLE `detalle_compratapas` (
  `id_detalleCompraTapas` int(11) NOT NULL,
  `codigo_compraTapas` varchar(50) NOT NULL,
  `id_tapa` int(11) NOT NULL,
  `cantidad` int(50) NOT NULL,
  `cajas` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_compratapas`
--

INSERT INTO `detalle_compratapas` (`id_detalleCompraTapas`, `codigo_compraTapas`, `id_tapa`, `cantidad`, `cajas`) VALUES
(1, '1', 1, 8000, 1),
(2, '2', 2, 13500, 3),
(3, '3', 1, 24000, 3),
(4, '4', 1, 40000, 10),
(5, '4', 2, 22500, 5),
(6, '6', 2, 31500, 7),
(7, '7', 1, 40000, 5),
(8, '8', 1, 80000, 10),
(9, '8', 2, 22500, 5),
(10, '10', 1, 16000, 2),
(11, '10', 2, 22500, 5),
(12, '12', 1, 8000, 1),
(13, '12', 2, 4500, 1),
(14, '14', 3, 240000, 30),
(15, '15', 2, 45000, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entregapreformas`
--

CREATE TABLE `detalle_entregapreformas` (
  `id_detalleEntregaPreformas` int(11) NOT NULL,
  `id_entregaPreformas` int(11) NOT NULL,
  `id_preforma` int(11) NOT NULL,
  `NumeroCaja` int(11) NOT NULL DEFAULT '0',
  `cantidad` int(11) NOT NULL,
  `tipo_botella` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_entregapreformas`
--

INSERT INTO `detalle_entregapreformas` (`id_detalleEntregaPreformas`, `id_entregaPreformas`, `id_preforma`, `NumeroCaja`, `cantidad`, `tipo_botella`) VALUES
(1, 1, 1, 1, 23184, '500 ml'),
(2, 2, 12, 2, 1500, 'Botella de 1000 ml cuello corto 26m'),
(3, 3, 13, 3, 2000, 'Botellas'),
(4, 4, 13, 4, 3000, 'Botella'),
(5, 5, 12, 5, 500, '6'),
(6, 6, 13, 6, 700, '6'),
(7, 7, 12, 7, 700, '0'),
(8, 8, 13, 8, 13008, '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entregaresina`
--

CREATE TABLE `detalle_entregaresina` (
  `id_detalleEntregaResina` int(11) NOT NULL,
  `id_entregaResina` int(11) NOT NULL,
  `id_resina` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entregatapas`
--

CREATE TABLE `detalle_entregatapas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_entregapreformas` int(10) UNSIGNED NOT NULL,
  `id_tapas` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega_preformas`
--

CREATE TABLE `entrega_preformas` (
  `id_entregaPreformas` int(11) NOT NULL,
  `fecha_entrega` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuarioEntrega` int(11) NOT NULL,
  `id_usuarioRecibe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrega_preformas`
--

INSERT INTO `entrega_preformas` (`id_entregaPreformas`, `fecha_entrega`, `id_usuarioEntrega`, `id_usuarioRecibe`) VALUES
(1, '2020-09-21 23:26:20', 15, 16),
(2, '2020-09-23 02:36:19', 13, 16),
(3, '2020-09-23 02:41:47', 13, 16),
(4, '2020-09-23 03:00:34', 13, 16),
(5, '2020-09-23 15:44:09', 13, 16),
(6, '2020-09-23 15:48:36', 13, 16),
(7, '2020-09-23 16:35:02', 13, 16),
(8, '2021-02-25 17:27:07', 13, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega_resina`
--

CREATE TABLE `entrega_resina` (
  `id_entregaResina` int(11) NOT NULL,
  `fecha_entrega` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuarioEntrega` int(11) NOT NULL,
  `id_usuarioRecibe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_botellas`
--

CREATE TABLE `inventario_botellas` (
  `id_inventarioBotella` int(11) NOT NULL,
  `tipo_botella` varchar(11) NOT NULL,
  `unidad_medida` varchar(25) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario_botellas`
--

INSERT INTO `inventario_botellas` (`id_inventarioBotella`, `tipo_botella`, `unidad_medida`, `cantidad`) VALUES
(1, '6', 'Pza', 8311),
(2, '4', 'Pza', 14108),
(3, '5', 'Pza', 4700),
(4, '8', 'Pza', 2700),
(5, '10', 'Pza', 642),
(6, '11', 'Pza', 685);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_preformas`
--

CREATE TABLE `inventario_preformas` (
  `id_inventarioPreformas` int(11) NOT NULL,
  `id_preforma` int(10) NOT NULL,
  `cantidad` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario_preformas`
--

INSERT INTO `inventario_preformas` (`id_inventarioPreformas`, `id_preforma`, `cantidad`) VALUES
(1, 1, 428128),
(2, 11, 301090),
(3, 13, 2187379),
(4, 12, 68742),
(5, 14, 55020);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_resina`
--

CREATE TABLE `inventario_resina` (
  `id_inventarioResina` int(11) NOT NULL,
  `id_resina` int(10) NOT NULL,
  `cantidad` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario_resina`
--

INSERT INTO `inventario_resina` (`id_inventarioResina`, `id_resina`, `cantidad`) VALUES
(1, 2, 60000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_tapas`
--

CREATE TABLE `inventario_tapas` (
  `id_inventarioTapas` int(11) NOT NULL,
  `id_tapa` int(11) NOT NULL,
  `cantidad` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario_tapas`
--

INSERT INTO `inventario_tapas` (`id_inventarioTapas`, `id_tapa`, `cantidad`) VALUES
(1, 1, 384000),
(2, 2, 369000),
(3, 3, 240000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
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
(0, '2017-05-07', 'Gonzalo Alberto Castillo Gonzalez', '932', '22.00', '22.00', '0', '22.00', '22', '0.00', 2, 1, 1),
(0, '2019-07-11', 'TELE-SERVI', '932929292', '14.00', '14.00', '0', '14.00', '20', '-6.00', 2, 1, 1),
(0, '2020-08-10', 'TELE-SERVI', '9323220232', '1996.00', '1996.00', '0', '1996.00', '0', '1996.00', 2, 1, 1),
(0, '2020-08-10', 'Gonzalo Alberto Castillo Gonzalez', '9323240650', '1400000.00', '1400000.00', '0', '1400000.00', '0', '1400000.00', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_item`
--

CREATE TABLE `order_item` (
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
(0, 0, 3, '1', '8', '8.00', 1),
(0, 0, 2, '1', '6', '6.00', 1),
(0, 0, 3, '1', '8', '8.00', 1),
(0, 0, 4, '1200', '1.53', '1836.00', 1),
(0, 0, 3, '20', '8', '160.00', 1),
(0, 0, 3, '100000', '8', '800000.00', 1),
(0, 0, 2, '100000', '6', '600000.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preformas`
--

CREATE TABLE `preformas` (
  `id_preforma` int(11) NOT NULL,
  `unidad_medida` varchar(5) CHARACTER SET latin1 NOT NULL,
  `gramaje` varchar(100) CHARACTER SET latin1 NOT NULL,
  `usd` double NOT NULL,
  `tipo_cambio` double NOT NULL,
  `millarcaja` float NOT NULL,
  `preciomillar` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `preformas`
--

INSERT INTO `preformas` (`id_preforma`, `unidad_medida`, `gramaje`, `usd`, `tipo_cambio`, `millarcaja`, `preciomillar`) VALUES
(1, 'pza', 'preforma 9.9 Grs CSN 26', 21.29, 22.4897, 23.184, 0),
(11, 'Pza', 'Preforma13 Grs CSN 26', 27.95, 22.4897, 18.816, 0),
(12, 'Pza', 'Preforma 21 Grs Corvaglia', 45.15, 22.4897, 13.44, 0),
(13, 'Pza', 'Preforma 18 Grs CSN 26', 39.78, 22.4897, 13.008, 0),
(14, 'Pza', 'Preforma 31 Grs Corvaglia', 66.65, 22.4897, 9.12, 0),
(15, 'Pza', 'Preforma 25 Grs CSN 26', 0, 22.4897, 9.12, 0),
(16, 'Pza', 'Preforma 10 Grs CSN 26', 0, 22.4897, 23.184, 0),
(17, 'Pza', 'Preforma 13 Grs Corvaglia', 0, 22.4897, 18.816, 0),
(18, 'Pza', 'Preforma 24 Grs Corvaglia', 0, 22.4897, 13.158, 0),
(19, 'Pza', 'Preforma 36 Grs Corvaglia', 0, 22.4897, 9.12, 0),
(20, 'Pza', 'Preforma 40 Grs Corvaglia', 0, 22.4897, 7, 0),
(21, 'Pza', 'Preforma 45 Grs Corvaglia', 0, 22.4897, 6.772, 0),
(22, 'Pza', 'Preforma 46 Grs Corvaglia', 0, 22.4897, 7.808, 0),
(23, 'Pza', 'Preforma 50 Grs Corvaglia', 0, 22.4897, 5.808, 0),
(24, 'Pza', 'Preforma 57 Grs Corvaglia', 0, 22.4897, 5.808, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion_botella`
--

CREATE TABLE `produccion_botella` (
  `id_produccionBotella` int(11) NOT NULL,
  `id_tipobotella` int(11) NOT NULL,
  `fecha_produccion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_entregaPreformas` int(11) NOT NULL,
  `id_usuarioProduce` int(11) NOT NULL,
  `estatus` varchar(25) NOT NULL,
  `merma` int(11) NOT NULL,
  `devolucion` int(11) NOT NULL,
  `elaboradas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `produccion_botella`
--

INSERT INTO `produccion_botella` (`id_produccionBotella`, `id_tipobotella`, `fecha_produccion`, `id_entregaPreformas`, `id_usuarioProduce`, `estatus`, `merma`, `devolucion`, `elaboradas`) VALUES
(1, 6, '2020-09-21 23:28:42', 1, 15, 'Completada', 184, 15184, 7816),
(2, 4, '2020-09-23 02:36:51', 2, 13, 'Completada', 100, 200, 1200),
(4, 5, '2020-09-23 02:52:21', 3, 13, 'Completada', 35, 100, 1865),
(8, 8, '2020-09-23 03:09:08', 4, 13, 'Completada', 100, 200, 0),
(9, 5, '2020-09-23 03:10:41', 4, 13, 'Completada', 45, 120, 2835),
(10, 5, '2020-09-23 03:11:04', 4, 13, 'Completada', 45, 120, 2835),
(11, 6, '2020-09-23 15:45:19', 5, 13, 'Completada', 5, 0, 495),
(12, 4, '2021-02-25 17:37:54', 8, 13, 'Completada', 100, 0, 12908);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
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

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `rfc` varchar(15) CHARACTER SET latin1 NOT NULL,
  `nombre_fiscal` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nombre_contacto` varchar(50) CHARACTER SET latin1 NOT NULL,
  `direccion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `telefono` varchar(12) CHARACTER SET latin1 NOT NULL,
  `celular` varchar(12) CHARACTER SET latin1 NOT NULL,
  `otro` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `rfc`, `nombre_fiscal`, `nombre_contacto`, `direccion`, `email`, `telefono`, `celular`, `otro`) VALUES
(10, 'EMO880404488', 'Envases Multiples de Occ.', 'Araceli Garcia', 'Zapopan Jalisco', 'arags75@hotmail.com', '3336569176', '3336569176', 2147483647),
(13, 'ENVPLT', 'Envases Plasticos la Tejeria', 'Mauricio Oropeza Salazar', 'Teapa', 'mauricio@gmail.com', '9323254478', '9936547889', 0),
(14, 'XXX-00000-IX1', 'Kimex S.A. de C.V.', 'Yadira Valentina', 'Tlanepantla Edo. de México', 'yadira@kimex.com.mx', '555555555', '555555555', 0),
(15, 'COLL80223MDE', 'COLL Merida', 'Juan Lopez', 'Mérida Yucatán', 'collmerida@gmail.com', '9323240650', '9323240650', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resina`
--

CREATE TABLE `resina` (
  `id_resina` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `unidad_medida` varchar(25) CHARACTER SET latin1 NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `resina`
--

INSERT INTO `resina` (`id_resina`, `nombre`, `unidad_medida`, `precio`) VALUES
(2, 'PET', 'Kg', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tapas`
--

CREATE TABLE `tapas` (
  `id_tapa` int(11) NOT NULL,
  `Presentacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tamano` varchar(100) CHARACTER SET latin1 NOT NULL,
  `unidad_medida` varchar(25) CHARACTER SET latin1 NOT NULL,
  `precio` double NOT NULL,
  `millarcaja` float NOT NULL,
  `preciomillar` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tapas`
--

INSERT INTO `tapas` (`id_tapa`, `Presentacion`, `tamano`, `unidad_medida`, `precio`, `millarcaja`, `preciomillar`) VALUES
(1, 'Cuello Corto', 'Tapa Rosca #26 mini', 'Pza', 0.11, 888, 0),
(2, 'Cuello Normal', 'Tapa Rosca #28 corta', 'Pza', 0.1528, 765, 0),
(3, 'Cuello Corto', 'Tapa rosca #26 mini M', 'Pza', 0.12, 960, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
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

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `turno` varchar(25) NOT NULL,
  `id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `usuario`, `contrasena`, `turno`, `id_area`) VALUES
(13, 'Jose Valencia Cruz', 'PP360', '5d0027d7ba148a2c83becb2cf2669feca6107007', 'Matutino', 1),
(14, 'nelly navarro martinez', 'kelly', 'bd8b1e3b4cb7c47f948efe74d5fc569519c06c5e', 'Matutino', 1),
(15, 'arianna martinez alegria', 'Ary', '6a1ea311e9b53d46587c2f84a891ab0d6e7de3d3', 'Matutino', 1),
(16, 'jose del carmen focil jimenez', 'chepe', '84ba2f41059c96db71f23ba27e47a236e57bc0c0', 'Matutino', 3),
(17, 'Bodega', 'Bodega', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Matutino', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ajuste_preformas`
--
ALTER TABLE `ajuste_preformas`
  ADD PRIMARY KEY (`ID_Ajuste`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `botellas`
--
ALTER TABLE `botellas`
  ADD PRIMARY KEY (`id_botella`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compra_preformas`
--
ALTER TABLE `compra_preformas`
  ADD PRIMARY KEY (`id_compraPreformas`),
  ADD KEY `id_compraPreformas` (`id_compraPreformas`),
  ADD KEY `id_compraPreformas_2` (`id_compraPreformas`);

--
-- Indices de la tabla `compra_resina`
--
ALTER TABLE `compra_resina`
  ADD PRIMARY KEY (`id_compraResina`);

--
-- Indices de la tabla `compra_tapas`
--
ALTER TABLE `compra_tapas`
  ADD PRIMARY KEY (`id_compraTapas`);

--
-- Indices de la tabla `detalle_comprapreformas`
--
ALTER TABLE `detalle_comprapreformas`
  ADD PRIMARY KEY (`id_detalleCompraPreformas`);

--
-- Indices de la tabla `detalle_compraresina`
--
ALTER TABLE `detalle_compraresina`
  ADD PRIMARY KEY (`id_detalleCompraResina`);

--
-- Indices de la tabla `detalle_compratapas`
--
ALTER TABLE `detalle_compratapas`
  ADD PRIMARY KEY (`id_detalleCompraTapas`);

--
-- Indices de la tabla `detalle_entregapreformas`
--
ALTER TABLE `detalle_entregapreformas`
  ADD PRIMARY KEY (`id_detalleEntregaPreformas`);

--
-- Indices de la tabla `detalle_entregaresina`
--
ALTER TABLE `detalle_entregaresina`
  ADD PRIMARY KEY (`id_detalleEntregaResina`);

--
-- Indices de la tabla `detalle_entregatapas`
--
ALTER TABLE `detalle_entregatapas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `entrega_preformas`
--
ALTER TABLE `entrega_preformas`
  ADD PRIMARY KEY (`id_entregaPreformas`);

--
-- Indices de la tabla `entrega_resina`
--
ALTER TABLE `entrega_resina`
  ADD PRIMARY KEY (`id_entregaResina`);

--
-- Indices de la tabla `inventario_botellas`
--
ALTER TABLE `inventario_botellas`
  ADD PRIMARY KEY (`id_inventarioBotella`),
  ADD KEY `id_inventarioBotella` (`id_inventarioBotella`);

--
-- Indices de la tabla `inventario_preformas`
--
ALTER TABLE `inventario_preformas`
  ADD PRIMARY KEY (`id_inventarioPreformas`);

--
-- Indices de la tabla `inventario_resina`
--
ALTER TABLE `inventario_resina`
  ADD PRIMARY KEY (`id_inventarioResina`);

--
-- Indices de la tabla `inventario_tapas`
--
ALTER TABLE `inventario_tapas`
  ADD PRIMARY KEY (`id_inventarioTapas`);

--
-- Indices de la tabla `preformas`
--
ALTER TABLE `preformas`
  ADD PRIMARY KEY (`id_preforma`);

--
-- Indices de la tabla `produccion_botella`
--
ALTER TABLE `produccion_botella`
  ADD PRIMARY KEY (`id_produccionBotella`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `resina`
--
ALTER TABLE `resina`
  ADD PRIMARY KEY (`id_resina`);

--
-- Indices de la tabla `tapas`
--
ALTER TABLE `tapas`
  ADD PRIMARY KEY (`id_tapa`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ajuste_preformas`
--
ALTER TABLE `ajuste_preformas`
  MODIFY `ID_Ajuste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `botellas`
--
ALTER TABLE `botellas`
  MODIFY `id_botella` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compra_preformas`
--
ALTER TABLE `compra_preformas`
  MODIFY `id_compraPreformas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `compra_resina`
--
ALTER TABLE `compra_resina`
  MODIFY `id_compraResina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra_tapas`
--
ALTER TABLE `compra_tapas`
  MODIFY `id_compraTapas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detalle_comprapreformas`
--
ALTER TABLE `detalle_comprapreformas`
  MODIFY `id_detalleCompraPreformas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `detalle_compraresina`
--
ALTER TABLE `detalle_compraresina`
  MODIFY `id_detalleCompraResina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_compratapas`
--
ALTER TABLE `detalle_compratapas`
  MODIFY `id_detalleCompraTapas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detalle_entregapreformas`
--
ALTER TABLE `detalle_entregapreformas`
  MODIFY `id_detalleEntregaPreformas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_entregaresina`
--
ALTER TABLE `detalle_entregaresina`
  MODIFY `id_detalleEntregaResina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_entregatapas`
--
ALTER TABLE `detalle_entregatapas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrega_preformas`
--
ALTER TABLE `entrega_preformas`
  MODIFY `id_entregaPreformas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `entrega_resina`
--
ALTER TABLE `entrega_resina`
  MODIFY `id_entregaResina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_botellas`
--
ALTER TABLE `inventario_botellas`
  MODIFY `id_inventarioBotella` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `inventario_preformas`
--
ALTER TABLE `inventario_preformas`
  MODIFY `id_inventarioPreformas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inventario_resina`
--
ALTER TABLE `inventario_resina`
  MODIFY `id_inventarioResina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventario_tapas`
--
ALTER TABLE `inventario_tapas`
  MODIFY `id_inventarioTapas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `preformas`
--
ALTER TABLE `preformas`
  MODIFY `id_preforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `produccion_botella`
--
ALTER TABLE `produccion_botella`
  MODIFY `id_produccionBotella` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `resina`
--
ALTER TABLE `resina`
  MODIFY `id_resina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tapas`
--
ALTER TABLE `tapas`
  MODIFY `id_tapa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
