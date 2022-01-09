<?php

class Auth
{
    const SEPARATOR = '-';
    /** @var string */
    protected $username;

    /** @var string */
    protected $password;

    /** @var string */
    protected $secret;

    public function __construct($username, $password, $secret)
    {
        $this->username = $username;
        $this->password = $password;
        $this->secret = $secret;
    }

    public function basicAuth(){
        if (
            (
                !isset($_SERVER['PHP_AUTH_USER'])
                || (isset($_SERVER['PHP_AUTH_USER']) && $_SERVER['PHP_AUTH_USER'] != $this->username)
            )
            || (
                !isset($_SERVER['PHP_AUTH_PW'])
                || (isset($_SERVER['PHP_AUTH_PW']) && $_SERVER['PHP_AUTH_PW'] != $this->password)
            )
        ) {
            header('WWW-Authenticate: Basic realm="Login"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Please login to continue.';
            exit;
        }
    }

    /**
     * Crea  la autenticacion en base al config.ini
     * @return Auth
     * @throws ErrorException
     */
    public static function fromConfig(){
        $path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config.ini';
        if (!is_file($path)) {
            throw new ErrorException(sprintf('config.ini not defined on %s',$path));
        }
        $params = parse_ini_file($path);
        return new Auth($params['username'],$params['password'],$params['secret']);
    }

    /**
     * Determina si al cabecera fue enviada
     * @return bool
     * @throws ErrorException
     */
    public function validateHeader()
    {
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            throw  new ErrorException('La cabecera de autenticación no fue enviada');
        }
        $secret = str_replace('Bearer ','',$_SERVER['HTTP_AUTHORIZATION']);
        $p = explode(self::SEPARATOR,$secret);
        if(empty($secret) || !count($p)){
            throw  new ErrorException('La cabecera de autenticación esta incompleta');
        }
        return $this->makeToken($p[0]) == $p[1];
    }

    /**
     * retorna un token
     * @return string
     */
    public function getToken()
    {
        $time = time();
        return  $time.'-'.$this->makeToken($time);
    }


    protected function makeToken($time)
    {
       return md5($time.'-'.$this->secret.'-'.$this->username.'_'.$this->password);
    }
}