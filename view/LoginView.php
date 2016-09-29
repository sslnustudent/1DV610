<?php
///home/a7642829/public_html/
require_once("/home/a7642829/public_html/model/LogInModel.php");

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

    private $model;

    public function __construct(LogInModel $model){
        $this->model = $model;
    }

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
    public function isLoggedin(){
        return $this->model->isLoggedin();
    }

	public function response() {

        $oldname = "";
        $message = '';

        if(isset($_POST["LoginView::Logout"])){
            if($this->model->isLoggedin() == true){
                $message = "Bye bye!";
            }
            unset($_COOKIE["LoginView::CookieName"]);
            unset($_COOKIE["LoginView::CookiePassword "]);
            $this->model->logOut();
        }

        if($this->model->isLoggedin() == true){
            return $this->generateLogoutButtonHTML($message);
        }

        else if(isset($_COOKIE["LoginView::CookieName"]) && isset($_COOKIE["LoginView::CookiePassword"])){
            if($this->model->LogIn($_COOKIE["LoginView::CookieName"], $_COOKIE["LoginView::CookiePassword"]) === true){
                $message = "Welcome back with cookie";
                return $this->generateLogoutButtonHTML($message);
            }
            else{
                $message = "Wrong information in cookies";
                $response = $this->generateLoginFormHTML($message, $oldname);
            }

        }

		
        if(!empty($_POST["LoginView::UserName"])){
			$oldname = $_POST["LoginView::UserName"];
		}

        if(isset($_POST["LoginView::Login"])){
            
            if(empty($_POST["LoginView::UserName"])){
                $message = 'Username is missing';
            }

            else if(empty($_POST["LoginView::Password"])){
                $message = 'Password is missing';
            }

            else if($this->model->LogIn($_POST["LoginView::UserName"], $_POST["LoginView::Password"]) === false){
                $message = 'Wrong name or password';
            }

            else if($this->model->LogIn($_POST["LoginView::UserName"], $_POST["LoginView::Password"]) === true){

                if(isset($_POST['LoginView::KeepMeLoggedIn'])){
                    setcookie("LoginView::CookieName", $_POST["LoginView::UserName"], time() + (60 * 5));
                    setcookie("LoginView::CookiePassword", $_POST["LoginView::Password"], time() + (60 * 5));

                    $message = 'Welcome and you will be remembered';
                    return $this->generateLogoutButtonHTML($message);
                }

                $message = 'Welcome';
                return $this->generateLogoutButtonHTML($message);
            }
        }

		$response = $this->generateLoginFormHTML($message, $oldname);
		//$response .= $this->generateLogoutButtonHTML($message);



		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
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
	private function generateLoginFormHTML($message, $oldname) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value= "' . $oldname . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
	}
	
}