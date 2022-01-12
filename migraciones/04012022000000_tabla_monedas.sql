START TRANSACTION;

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
   `id_moneda` int(11) NOT NULL,
   `moneda` varchar(255) NOT NULL,
   `simbolo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`id_moneda`, `moneda`, `simbolo`) VALUES
 (1, 'ARS', '&#36;'),
 (2, 'USD', '&#36;'),
 (3, 'EUR', '&#8364;'),
 (4, 'PLN', '&#8484;&#10990;');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
    ADD PRIMARY KEY (`id_moneda`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
    MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;
