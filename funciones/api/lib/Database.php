<?php


class Database
{
    private $host       = "";
    private $dbname     = "";
    private $dbUsername = "";
    private $dbPass     = "";
    private $charset    = 'utf8mb4';
    private $dsn;

    /** @var PDO */
    private $conecction;

    /**
     * @param string $host
     * @param string $dbname
     * @param string $dbUsername
     * @param string $dbPass
     */
    public function __construct(string $host, string $dbname, string $dbUsername, string $dbPass)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->dbUsername = $dbUsername;
        $this->dbPass = $dbPass;
    }


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
     * @param Query $query
     * @return array
     */
    public function getJson( $query)
    {
        $data = array();
        $stmt = $this->conecction->query($query->getDql());
        while ($row = $stmt->fetch()) {
            $data[] = $query->parseRow($row);
        }
        return $data;
    }


    public function close(){
        $this->conecction = null;
    }

    /**
     * @param int $clientId  id to determine the database
     * @return Database Clients database
     * @throws ErrorException
     */
    public function fromRootConection($clientId)
    {
        $stmt = $this->conecction->query("SELECT db_user, db_password, id_company, company_name FROM login_data WHERE id=".intval($clientId));
        $row = $stmt->fetchObject();
        if (!$row) {
           throw  new ErrorException('Client not found.',404);
        }
        return  new Database($this->host,$row->id_company,$row->db_user,$row->db_password);
    }
}