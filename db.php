<?php

class Database{
    private $dsn = "mysql:host=localhost;dbname=ajax";
    private $user = "root";
    private $pass = "";
    public $conn;

    public function __construct(){
        try{
            $this->conn = new PDO($this->dsn,$this->user,$this->pass);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function input($fname, $lname, $email, $phone) {
        $sql = "INSERT INTO tbl_ajax (fname, lname, email, phone) VALUES (
            :fname,
            :lname,
            :email,
            :phone
        )";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'phone' => $phone
        ]);
        return true;
    }
    public function display(){
        $data = array();
        $sql = "SELECT * FROM tbl_ajax";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row){
            $data[] = $row;
        }
        return $data;
    }
    public function getUserID($id){
        $sql = "SELECT * FROM tbl_ajax WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt -> execute(
            ['id'=>$id]
        ); 
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function update($id,$fname,$lname,$email,$phone){
        $sql = "UPDATE tbl_ajax SET 
        fname = :fname,
        lname = :lname,
        email = :email,
        phone = :phone
        WHERE id = :id 
        "; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(
            ['id' => $id,
            'fname'=>$fname,
            'lname'=>$lname,
            'email'=>$email,
            'phone'=>$phone]
        ); 
        return true;
    }
    public function remove($id){
        $sql ="DELETE FROM tbl_ajax WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(
            ['id'=>$id]
        );
        return true;
    }
    public function countUser(){
        $sql = "SELECT * FROM tbl_ajax";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count; 
    }
} 
?>