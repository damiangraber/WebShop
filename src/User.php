<?php

class User {
    private $id;
    private $fname;
    private $lname;
    private $email;
    private $hashedPassword;
    private $shippingAdress;


    public function __construct(){
        $this->id = -1;
        $this->fname = '';
        $this->lname = '';
        $this->email = '';
        $this->hashedPassword = '';
        $this->shippingAddress = '';
    }
    function getFname() {
        return $this->fname;
    }

    function getLname() {
        return $this->lname;
    }

    function setFname($fname) {
        if(is_string($fname) && strlen(trim($fname)) >0){
        $this->fname = $fname;
        }
    }

    function setLname($lname) {
        if(is_string($lname) && strlen(trim($lname)) >0){
        $this->lname = $lname;
        }
    }

        public function getId() {
        return $this->id;
    } 
    
        
          
    
    
    public function setShippingAddress($shippingAddres){
        if(is_string($shippingAddres) && strlen(trim($shippingAddres)) >0){
            $this->name = trim($shippingAddres);
        }
    }
    
    public function getShippingAddress(){
        return $this->shippingAdress;
    }
    
    public function setEmail($email) {
        if(is_string($email) && strlen(trim($email)) >=5){
            $this->email = trim($email);
        }
        
    }
    
    public function getEmail() {
        return $this->email;
        
    }
    
    public function setPassword($password){
        if(is_string($password) && strlen(trim($password)) >5 ) {
            $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }
    }
    
    public function saveToDB(mysqli $connection){
        if($this->id == -1){
            $query = "INSERT INTO Users (email, fname, lname, hashed_password, shipping_address) 
                VALUES ('$this->email', '$this->fname', '$this->lname','$this->hashedPassword', '$this->shippingAdress')";
            if($connection->query($query)) {
                return true;
            }  else {
               return false;    
            }
        }  else { // na wypadek wywołania do obiektu gdzie istnieje
            
            $query = "UPDATE Users 
                 SET fname = '$this->fname',
                     lname= '$this->lname',
                 email = '$this->email',
                 hashed_password = '$this->hashedPassword',
                  shipping_address = '$this->shippingAdress'
                 WHERE id = $this->id";
                    if($connection->query($query)){
                        return true;
                    }else{
                        return false;
                    }
                        
        }
    }
    
    static public function loadUserById(mysqli $connection, $id){
        $query = " SELECT * FROM Users WHERE id =".$connection->real_escape_string($id);
        
        $res = $connection->query($query);
        if($res && $res->num_rows == 1){
            $row = $res->fetch_assoc();
            $user = new User();
            $user->id = $row['id'];
            $user->setName($row['fname']);
            $user->setEmail($row['email']);
            $user->hashedPassword = $row['hashed_password'];
            $user->setShippingAddress($row['shippingAddress']);
            
            return $user;
        }
        return null;
    }
    
    static public function loadAllUsers(mysqli $connection){
        $query = "SELECT * FROM Users";
        
        $users = [];
        $res = $connection->query($query);
        
        if($res){
        foreach ($res as $row) {
            $user = new User();
            $user->id = $row['id'];
            $user->setFname($row['fname']);
            $user->setFname($row['lname']);
            $user->setEmail($row['email']);
            $user->hashedPassword = $row['hashed_password'];
            $user->setShippingAddress($row['shippingAddress']);
            $users[] = $user;
        }
        }
        return $users;
    }
    
    
    public function delete(mysqli $connection){
        if($this->id != -1){
            $query = "DELETE FROM Users WHERE id = $this->id";
            if($connection->query($query)){
                $this->id = -1;
                return true;
            }  else {
                return false;
            }
        }
        return true;
    }
    
    static public function loadUserByEmail(mysqli $connection, $email){
        $query = "SELECT * FROM Users WHERE email = '".$connection->real_escape_string($email)."'";
        
        $res = $connection->query($query);
        if($res && $res->num_rows ==1){
            $row = $res->fetch_assoc();
            $user = new User();
            $user->id = $row['id'];
            $user->setFname($row['fname']);
            $user->setFname($row['lname']);
            $user->setEmail($row['email']);
            $user->hashedPassword = $row['hashed_password'];
            $user->setShippingAddress($row['shippingAddress']);
            return $user;
        }
        return null;
    }
    
    static public function login(mysqli $connection, $email, $password){
        $user = self::loadUserByEmail($connection, $email);
        if($user && password_verify($password, $user->hashedPassword)){
        // funkcja password verify
           return $user;
                    
        }  else {
            return false;    
        }
    }
} 