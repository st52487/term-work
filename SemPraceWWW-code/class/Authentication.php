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
        $stmt = $this->conn->prepare("SELECT id, username, email FROM users WHERE email= :email and password = :password");
        $stmt->bindParam(':email', $_POST["loginMail"]);
        $stmt->bindParam(':password', $_POST["loginPassword"]);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            $userDto = array('user_id' => $user['id'], 'username' => $user['username'], 'email' => $user['email']);
            $_SESSION['identity'] = $userDto;
            self::$identity = $userDto;
            return true;
        } else {
            return false;
        }
    }

    public function hasIdentity(){
        if (self::$identity == NULL) {
            return false;
        }
        return true;
    }

    public function getIdentity(){
        if (self::$identity == NULL) {
            return false;
        }
        return self::$identity;
    }

    public function logout(){
        unset($_SESSION['identity']);
        $_SESSION = array();
        session_destroy();
        self::$identity = NULL;
    }
}