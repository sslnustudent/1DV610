<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/LogInModel.php');
require_once('controller/LoginController.php');

session_start();
$_SESSION["visits"] = 0;
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS

$loginModel = new LogInModel();

$loginView = new LoginView($loginModel);
$dateTimeView = new DateTimeView();
$layoutView = new LayoutView($dateTimeView);
$loginController = new LoginController($loginView, $layoutView, $loginModel);

$loginController->run();


