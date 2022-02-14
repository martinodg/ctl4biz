START TRANSACTION;

CREATE TABLE `articulosEmbalajes` (
                                      `id` int(10) UNSIGNED NOT NULL,
                                      `codarticulo` int(10) NOT NULL,
                                      `codembalaje` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `articulosEmbalajes`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codarticulo` (`codarticulo`,`codembalaje`);

ALTER TABLE `articulosEmbalajes`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

COMMIT;
