<?php

interface MultiDatabase
{
    /**
     * Retorna un array de los clientes ids
     * @return array
     */
    function getCompanyId();

    /**
     * @return string
     */
    public function getQuery();
}