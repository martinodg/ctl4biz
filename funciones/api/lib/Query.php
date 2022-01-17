<?php

abstract class Query
{
    /**
     * @return string
     */
    abstract function getDql();

    /**
     * @param array $rowData
     * @return array
     */
    abstract function parseRow($rowData);
}