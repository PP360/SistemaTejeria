--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `rfc`, `nombre_cliente`, `direccion`, `email`, `telefono`, `celular`, `otro`) VALUES
(1, '1251523', 'Gonzalo Alberto Castillo Gonzalez', 'Teapa Tabasco', 'gonzalocast17@gmail.com', '9323233321', '9323234332', 0),
(3, 'CAGG62694UTA', 'gonzalo', 'aassd', 'gonzalocast17@gmail.com', '2323', '2323', 0),
(4, 'TELE8003321-ME2', 'TELE-SERVI', 'AV. CARLOS RAMOS NO. 123 COL. CENTRO TEAPA TABASCO', 'teleservi@gmail.com', '', '', 0);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `compra_resina`
--

INSERT INTO `compra_resina` (`id_compraResina`, `fecha_compra`, `codigo_compraResina`, `id_proveedor`, `total_compra`) VALUES
(1, '2017-02-27 21:20:02', 1, 13, 1000000),
(2, '2017-06-02 03:37:00', 2, 12, 420000),
(3, '2017-06-02 17:15:55', 3, 12, 420000);

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `compra_tapas`
--

INSERT INTO `compra_tapas` (`id_compraTapas`, `fecha_compra`, `codigo_compraTapas`, `id_proveedor`, `total_compra`) VALUES
(1, '2017-02-27 21:19:29', 1, 12, 60375),
(2, '2017-02-27 21:19:29', 1, 12, 60375),
(3, '2017-02-27 21:19:29', 1, 12, 3750);

-- --------------------------------------------------------


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
-- Volcado de datos para la tabla `detalle_compraresina`
--

INSERT INTO `detalle_compraresina` (`id_detalleCompraResina`, `codigo_compraResina`, `id_resina`, `cantidad`) VALUES
(1, '1', 2, 50000),
(2, '2', 2, 21000),
(3, '3', 2, 21000);

-- ----------------

--
-- Volcado de datos para la tabla `detalle_compratapas`
--

INSERT INTO `detalle_compratapas` (`id_detalleCompraTapas`, `codigo_compraTapas`, `id_tapa`, `cantidad`) VALUES
(1, '1', 3, 500000),
(2, '1', 3, 500000),
(3, '1', 4, 30000);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `detalle_entregaresina`
--

INSERT INTO `detalle_entregaresina` (`id_detalleEntregaResina`, `id_entregaResina`, `id_resina`, `cantidad`) VALUES
(1, 1, 2, 2000),
(2, 2, 2, 900),
(3, 1, 2, 3000),
(4, 4, 2, 21000);

-- ------------------------------

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
-- Volcado de datos para la tabla `entrega_resina`
--

INSERT INTO `entrega_resina` (`id_entregaResina`, `fecha_entrega`, `id_usuarioEntrega`, `id_usuarioRecibe`) VALUES
(1, '2017-02-27 21:35:22', 2, 9),
(2, '2017-06-02 03:49:50', 2, 9),
(3, '2017-06-02 04:09:14', 3, 9),
(4, '2017-06-02 17:17:12', 4, 9);

-- --------------------------------------------------------


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
-- Volcado de datos para la tabla `inventario_preformas`
--

INSERT INTO `inventario_preformas` (`id_inventarioPreformas`, `id_preforma`, `cantidad`) VALUES
(1, 7, 20000),
(2, 8, 48090),
(3, 9, 2500),
(4, 13, 9684);

-- --------------------------------------------------------


--
-- Volcado de datos para la tabla `inventario_resina`
--

INSERT INTO `inventario_resina` (`id_inventarioResina`, `id_resina`, `cantidad`) VALUES
(1, 2, 60000);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `inventario_tapas`
--

INSERT INTO `inventario_tapas` (`id_inventarioTapas`, `id_tapa`, `cantidad`) VALUES
(1, 3, 970556),
(2, 4, 2800);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `resina`
--

INSERT INTO `resina` (`id_resina`, `nombre`, `unidad_medida`, `precio`) VALUES
(2, 'PET', 'Kg', 20);

-- --------------------------------------------------------


--
-- Volcado de datos para la tabla `tapas`
--

INSERT INTO `tapas` (`id_tapa`, `tamano`, `unidad_medida`, `precio`) VALUES
(3, 'Tapa de 28 mm Corta', 'Pza', 0.12075),
(4, 'Tapa de 28 mm Standar', 'Pza', 0.125);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '');

-- --------------------------------------------------------


INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `usuario`, `contrasena`, `turno`, `id_area`) VALUES
(2, 'Dafne Alvarez', 'Dafne', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'Matutino', 2),
(3, 'Genaro Díaz', 'Genaro', 'b706bf6aa8575ad5e84103fcc7ed86f1806ca991', 'Matutino', 1),
(13, 'José Valencia Cruz', 'PP360', '5d0027d7ba148a2c83becb2cf2669feca6107007', 'Matutino', 1);

