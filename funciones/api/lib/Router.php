<?php

class Router
{
    private $get;
    private $client;
    private $query;

    const CLIENT_PARAM = 'c';
    const QUERY_PARAM = 'q';

    const QUERY_COBROS = 'c';
    const QUERY_MEDIOS_PAGO = 'mp';

    public function __construct($get)
    {
        if (!isset($get[self::CLIENT_PARAM])) {
            throw new ErrorException(sprintf('The client param  %s is not defined ', self::CLIENT_PARAM));
        }
        if (!isset($get[self::QUERY_PARAM])) {
            throw new ErrorException(sprintf('The client param  %s is not defined ', self::QUERY_PARAM));
        }

        $this->get = $get;
        $this->client = intval($this->get[self::CLIENT_PARAM]);
        $this->query = strval($this->get[self::QUERY_PARAM]);
        if (!in_array($this->query, $this->validQueryParams())) {
            throw new ErrorException(sprintf('The query param %s is not a valid one %s', $this->query, implode(',', $this->validQueryParams())));
        }
    }

    private function validQueryParams()
    {
        return [self::QUERY_COBROS, self::QUERY_MEDIOS_PAGO];
    }

    public function getQuery()
    {
        if ($this->query == self::QUERY_COBROS) {
            return new CobrosQuery();
        }
        if ($this->query == self::QUERY_MEDIOS_PAGO) {
            return new CobrosFormaPagoQuery();
        }
        throw new ErrorException(sprintf('The query param %s is not a valid one %s', $this->query, implode(',', $this->validQueryParams())));
    }

    /**
     * @return int
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param int $client
     */
    public function setClient( $client)
    {
        $this->client = $client;
    }
}