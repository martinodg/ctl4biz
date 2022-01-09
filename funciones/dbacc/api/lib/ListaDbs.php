<?php

class ListaDbs extends Query implements SelectQuery
{
    public function getDql()
    {
        return sprintf('SELECT id, company_name  FROM %s',Database::LOGIN_DATABASE);
    }

    function parseRow($rowData)
    {
        return [
            'id' => intval($rowData['id']),
            'nombre' => $rowData['company_name'],
        ];
    }

    function handleQuery($stmt)
    {
        $stmt->execute();
        $data = [];
        while ($row = $stmt->fetch()) {
            $data[] = $this->parseRow($row);
        }
        return $data;
    }


}