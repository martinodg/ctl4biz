<?php

abstract class Query
{
    /**
     * @return string
     */
    abstract function getDql();

    /**
     * Procesa la peticon y contesta un array
     * @param PDOStatement $stmt
     * @return array
     */
    abstract function handleQuery($stmt);

}