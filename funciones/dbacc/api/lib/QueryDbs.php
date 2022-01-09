<?php

class QueryDbs extends Query implements MultiDatabase
{

    const PARAM_COMPANY='companyIds';

    const PARAM_QUERY='query';

    /** @var array */
    protected  $companyId;


    /** @var string */
    protected  $query;

    /**
     * Arma el query
     * @param array $post
     * @throws ErrorException
     */
    public function __construct($post=[])
    {
        if(empty( $post[self::PARAM_COMPANY])){
            throw new ErrorException('The db param was not sent');
        }
        if(empty( $post[self::PARAM_QUERY])){
            throw new ErrorException('The query param was not sent');
        }
        if(!is_array($post[self::PARAM_COMPANY])){
            $post[self::PARAM_COMPANY]= [$post[self::PARAM_COMPANY]];
        }
        $this->companyId =   array_map('trim',$post[self::PARAM_COMPANY] );
        $this->query = trim($post[self::PARAM_QUERY]);
    }

    public function getDql()
    {
        return $this->query;
    }

    /**
     * @return array
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }


    /**
     * @inheritDoc
     */
    function handleQuery($stmt)
    {
        $stmt->execute();
        return $stmt->fetchAll();
    }


}