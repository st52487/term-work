<?php
class Authentication{
    private $conn = null;
    static private $instance = null;
    static private $identity = null;

    static function getInstance(){
        if (self::$instance == NULL){
            self::$instance = new Authentication();
        }
        return self::$instance;
    }

    private function __construct()
    {
        if(isset($_SESSION['identity'])){
            self::$identity = $_SESSION['identity'];
        }
        $this->conn = Connection::getPdoInstance();
    }

    public function login($email, $password){

    }

    public function hasIdentity(){

    }

    public function getIdentity(){

    }

    public function logout(){

    }
}