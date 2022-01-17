<?php

class CobrosQuery extends Query
{
    public function getDql()
    {
        return 'SELECT fechacobro, importe FROM  cobros ORDER BY fechacobro';
    }

    function parseRow($rowData)
    {
        $fecha = strtotime($rowData['fechacobro']);
        return [
            'importe' => floatval($rowData['importe']),
            'fechaCobro' => $fecha,
        ];
    }


}