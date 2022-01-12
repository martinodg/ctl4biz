START TRANSACTION;
--
-- Estructura de tabla para la tabla `alias_articulos`
--

CREATE TABLE `alias_articulos` (
  `id_alias` int(11) NOT NULL,
  `codarticulo` int(11) NOT NULL,
  `alias` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alias_articulos`
--
ALTER TABLE `alias_articulos`
  ADD PRIMARY KEY (`id_alias`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alias_articulos`
--
ALTER TABLE `alias_articulos`
  MODIFY `id_alias` int(11) NOT NULL AUTO_INCREMENT;
  
COMMIT;
