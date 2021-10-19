<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "user";
 
    // object properties
    public $id;
    public $email;
    public $password;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
    function signup(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    user_id=:user_id, email=:email, password=:password";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
    
        // bind values
		$stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
        
    }
	
	function signup_mobile(){
    
        if($this->isAlreadyExist_m()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    user_id=:user_id, phone=:phone, password=:password";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->password=htmlspecialchars(strip_tags($this->password));
    
        // bind values
		$stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":password", $this->password);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
        
    }
	
	
    // login user
    function login(){
        // select all query
        $query = "SELECT
                    `user_id`, `email`, `phone`, `password`
                FROM
                    " . $this->table_name . " 
                WHERE
                    email='".$this->email."' AND password='".$this->password."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
	
	// login user
    function login_m(){
        // select all query
        $query = "SELECT
                    `user_id`, `email`, `phone`, `password`
                FROM
                    " . $this->table_name . " 
                WHERE
                    phone='".$this->mobile."' AND password='".$this->password."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->email."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
	
	function isAlreadyExist_m(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                phone='".$this->phone."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
	
	function update(){
		$query = "update
                    " . $this->table_name . "
                SET
                    email=:email, phone=:phone where user_id=:user_id";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
    
        // bind values
		$stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
	}
}