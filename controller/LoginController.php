<?php

class LoginController{
    
    private $loginView;
    private $layoutView;
    private $loginModel;

    public function __construct(LoginView $loginView, LayoutView $layoutView, LogInModel $loginModel){
        $this->loginView = $loginView;
        $this->layoutView = $layoutView;
        $this->loginModel = $loginModel;
    }

    public function run(){
        $message = "";
        $htmlPage = "";

        if($this->loginView->logout() == true && $this->loginModel->isLoggedin() == true){
            $message = $this->loginView->logoutMessage();
        }
        else if($this->loginView->loginWithCookies() == true && $this->loginModel->isLoggedin() == false){
            $message = $this->loginView->loginWithCookiesMessage();
        }
        else if($this->loginView->login() == true && $this->loginModel->isLoggedin() == false){
            $message = $this->loginView->loginMessage();
        }

        if($this->loginModel->isLoggedin() == false){
            $htmlPage = $this->loginView->generateLoginFormHTML($message);
        }
        else{
            $htmlPage = $this->loginView->generateLogoutButtonHTML($message);
        }
        $this->layoutView->render($this->loginModel->isLoggedin(), $htmlPage);
    }
}