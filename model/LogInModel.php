<?php

class LogInModel{
    private $userName;
    private $password;
    private $textFile;
    private $sessionName;

    // TODO: Implement a proper storage of username and password in a database or a text file.
    public function __construct(){
        $this->userName = "Admin101";
        $this->password = "pass101";
        $this->textFile = "CookiePassword.txt";
        $this->sessionName = "LoggedIn";
    }

    public function LogIn($userName, $password){
        
        if($userName === $this->userName && $password === $this->password){
            $_SESSION[$this->sessionName] = true;
            return true;
        }
        else if($userName === $this->userName && $password === $this->readFromTextFile()){
            $_SESSION[$this->sessionName] = true;
            return true;
        }
        else{
            return false;
        }
    }

    public function isLoggedin(){
        if(isset($_SESSION[$this->sessionName]) == true){
            return true;
        }
        else{
            return false;
        }
    }

    public function logOut(){
        unset($_SESSION[$this->sessionName]);
    }

    public function readFromTextFile(){
        return file_get_contents($this->textFile);
    }

    public function writeToTextFile($cookiePassword){
        file_put_contents($this->textFile, $cookiePassword);
    }

    public function randomStringGenerator(){
        $characters = "abcdefghijklmnopqrstuvwxyz0123456789";

        $string = '';

        $max = strlen($characters) - 1;
        for($i = 1; $i < 20; $i++){
            $string .= $characters[mt_rand(0, $max)];
        }

        return $string;
    }

    //TODO: Implement a function for adding a user

}