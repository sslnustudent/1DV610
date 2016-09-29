<?php

class LogInModel{
    private $user;
    private $password;

    public function __construct(){
        $this->user = "Admin101";
        $this->password = "pass101";
    }

    public function LogIn($user, $password){
        
        if($user === $this->user && $password === $this->password){
            $_SESSION["LoggedIn"] = 1;
            return true;
        }

        else if($user === $this->user && $password === md5($this->password)){
            $_SESSION["LoggedIn"] = 1;
            return true;
        }

        else{
            return false;
        }

    }

    public function isLoggedin(){
        if(isset($_SESSION["LoggedIn"]) == true){
            return true;
        }
        else{
            return false;
        }
    }

    public function logOut(){
        unset($_SESSION["LoggedIn"]);
    }

}