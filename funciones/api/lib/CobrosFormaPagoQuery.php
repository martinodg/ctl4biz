<?php

class CobrosFormaPagoQuery extends Query
{
    public function getDql()
    {
        return 'SELECT UNIX,importe, nombre FROM  cobros_formapago ORDER BY fechacobro';
    }

    function parseRow($rowData)
    {
        return [
            'nombre' => strval($rowData['nombre']),
            'importe' => floatval($rowData['importe']),
            'fechaCobro' => $rowData['UNIX'],
        ];
    }


}