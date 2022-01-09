<?php


class Database
{
    private $host       = "";
    private $dbname     = "";
    private $dbUsername = "";
    private $dbPass     = "";
    private $charset    = 'utf8mb4';
    private $dsn;

    const LOGIN_DATABASE = 'login_data';

    /** @var PDO */
    private $conecction;

    /**
     * @param string $host
     * @param string $dbname
     * @param string $dbUsername
     * @param string $dbPass
     */
    public function __construct( $host,  $dbname,  $dbUsername,  $dbPass)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->dbUsername = $dbUsername;
        $this->dbPass = $dbPass;
    }

    /**
     * @param Query $cliente
     * @return array
     * @throws ErrorException
     */
    public function procesar($cliente)
    {
        if($cliente instanceof SelectQuery){
            $stmt = $this->query($cliente->getDql());
            return $cliente->handleQuery($stmt);
        }elseif($cliente instanceof  MultiDatabase ){
            $respuesta  =  [];
            foreach ($cliente->getCompanyId() as $companyId){
                $dql = $cliente->getDql();
                try{
                    $dbCliente = $this->fromRootConection($companyId);
                    $dbCliente->tryConnect();
                    $respuesta[$companyId] = ['dql'=>$dql.'('.$companyId.')','response'=>$cliente->handleQuery( $dbCliente->query($dql))];
                }catch (Exception $e){
                    $respuesta[$companyId] =  ['dql'=>$dql.'('.$companyId.')','response'=>$e->getMessage()];
                }
            }
            return $respuesta;
        }
        throw new ErrorException('No se solicito ningun query valido');
    }

    /**
     * @return PDO
     */
    public function tryConnect()
    {
        $this->dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
        $DBH = new PDO($this->dsn,$this->dbUsername,$this->dbPass);
        $DBH->exec("set names utf8");
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conecction = $DBH;
        return $DBH;
    }


    /**
     * Procesa un query
     * @param $dql
     * @return PDOStatement
     * @throws ErrorException
     */
    public function query($dql)
    {
        $stmt =  $this->conecction->prepare($dql);
        if (!$stmt) {
            $error = $this->conecction->errorInfo();
            throw new ErrorException(sprintf('Ocurrio un error al procesar el query %s ',$error[2]));
        }
        return $stmt;
    }


    public function close(){
        $this->conecction = null;
    }

    /**
     * @param int $companyId  id to determine the database
     * @return Database Clients database
     * @throws ErrorException
     */
    public function fromRootConection($companyId)
    {
        $stmt = $this->conecction->query(sprintf('SELECT db_user, db_password, id_company, company_name FROM %s WHERE id=%d ',self::LOGIN_DATABASE,intval($companyId)));
        $row = $stmt->fetchObject();
        if (!$row) {
            throw  new ErrorException('Client not found.',404);
        }
        $user = $row->db_user;
        $pass = $row->db_password;
        if(defined('USE_SAME_USER_ON_CLIENT') && USE_SAME_USER_ON_CLIENT){
            $user = $this->dbUsername;
            $pass = $this->dbPass;
        }
        return  new Database($this->host,$row->id_company,$user,$pass);
    }


}