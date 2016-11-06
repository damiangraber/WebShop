<?php

//trzeba stworzyć tabelę dla Adminów w bazie danych!

class Admin {

    private $id;
    private $email;
    private $hashedPassword;

    public function __construct() {
        $this->id = -1;
        $this->email = '';
        $this->hashedPassword = '';
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function setEmail($email) {
        if (is_string($email) && strlen(trim($email)) >= 5) {
            $this->email = trim($email);
        }
    }

    public function setHashedPassword($hashedPassword) {
        $this->hashedPassword = $hashedPassword;
    }

    public function setPassword($password) {
        if (is_string($password) && strlen(trim($password)) > 5) {
            $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }
    }

}