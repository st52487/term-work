<?php
class UserRepository{

    private $conn = null;

    public function __construct()
    {
        $this->conn = $conn;
    }

    public function getAllUsers(){
        $stmt = $this->conn->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByEmail($mail){
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email LIKE concat('%', :email, '%') ");
        $stmt->bindParam(":email", $mail);
        $stmt->exxecute();
        return $stmt->fetchAll();
    }

}