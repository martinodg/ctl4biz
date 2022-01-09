<?php

interface SelectQuery
{
    /**
     * Retorna un array  de con la fila
     * @param $rowData
     * @return array
     */
    function parseRow($rowData);
}