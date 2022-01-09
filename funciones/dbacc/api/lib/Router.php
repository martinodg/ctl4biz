<?php

class Router
{
    /** @var array */
    private $get;
    /** @var array */
    private $post;

    const DBS_PARAM = 'dbs';
    const QUERY_PARAM = 'q';

    public function __construct($get, $post = [])
    {
        $get = array_keys($get);
        $get = $get[0];
        //@todo validar el acceso por auth
        if (!in_array($get, $this->validQueryParams())) {
            throw new ErrorException(sprintf('The query param %s is not a valid one %s', $get, implode(',', $this->validQueryParams())));
        }
        $this->get = $get;
        $this->post = $post;
    }

    /**
     * Valores de accion aceptados
     * @return string[]
     */
    private function validQueryParams()
    {
        return [self::DBS_PARAM, self::QUERY_PARAM];
    }

    /**
     * Retorna la respuesta del query o falla
     * @return Query
     * @throws ErrorException
     */
    public function getQuery()
    {
        if (self::DBS_PARAM == $this->get) {
            return new ListaDbs();
        }
        if (self::QUERY_PARAM == $this->get) {
            return new QueryDbs($this->post);
        }

        throw new ErrorException(sprintf('The query  is not a valid one %s', implode(',', $this->validQueryParams())));
    }

    /**
     * @return ListaDbs|Query|QueryDbs
     * @throws ErrorException
     */
    public function getClient()
    {
        return $this->getQuery();
    }

}