<?php

class ListaDbs extends Query implements SelectQuery
{
    public function getDql()
    {
        return sprintf('SELECT id, company_name AS nombre FROM %s',Database::LOGIN_DATABASE);
    }

    function parseRow($rowData)
    {
        return [
            'id' => intval($rowData['id']),
            'compania' => $rowData['company_name'],
        ];
    }

}