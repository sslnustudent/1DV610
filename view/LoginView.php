<?php

require_once("model/LogInModel.php");

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $userName = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keepLoggedIn = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

    private $loginModel;

    public function __construct(LogInModel $model){
        $this->loginModel = $model;
    }

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */

    public function logOut(){
        if(isset($_POST[self::$logout])){
            return true;
        }
        else{
            return false;
        }
    }

    public function logoutMessage(){
        unset($_COOKIE[self::$cookieName]);
        unset($_COOKIE[self::$cookiePassword]);
        $this->loginModel->logOut();
        return  "Bye bye!";
    }

    public function loginWithCookies(){
        if(isset($_COOKIE[self::$cookieName]) && isset($_COOKIE[self::$cookiePassword])){
            return true;
        }
        else{
            return false;
        }
    }

    public function loginWithCookiesMessage(){
        if($this->loginModel->LogIn($_COOKIE[self::$cookieName], $_COOKIE[self::$cookiePassword]) === true){
            return "Welcome back with cookie";
        }
        else{
            return "Wrong information in cookies";
        }
    }

    public function login(){
        if(isset($_POST[self::$login])){
            return true;
        }
        else{
            return false;
        }
    }

	public function loginMessage() {
        $message = 'Welcome';
        
        if(empty($_POST[self::$userName])){
            $message = 'Username is missing';
        }
        else if(empty($_POST[self::$password])){
            $message = 'Password is missing';
        }
        else if($this->loginModel->LogIn($_POST[self::$userName], $_POST[self::$password]) === false){
            $message = 'Wrong name or password';
        }
        else if($this->loginModel->LogIn($_POST[self::$userName], $_POST[self::$password]) === true){
            if(isset($_POST[self::$keepLoggedIn])){
                $this->createCookies();
                $message = 'Welcome and you will be remembered';
                return $message;
            }
        }
        
		return $message;
    }

    private function createCookies(){
        $randomString = $this->loginModel->randomStringGenerator();
        setcookie(self::$cookieName, $_POST[self::$userName], time() + (60 * 5));
        setcookie(self::$cookiePassword, $randomString, time() + (60 * 5));
        $this->loginModel->writeToTextFile($randomString);
    }

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	public function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	public function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$userName . '">Username :</label>
					<input type="text" id="' . self::$userName . '" name="' . self::$userName . '" value= "' . $this->getRequestUserName() . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keepLoggedIn . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keepLoggedIn . '" name="' . self::$keepLoggedIn . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
        if(!empty($_POST[self::$userName])){
			return $_POST[self::$userName];
		}
        else{
            return "";
        }
	}
}