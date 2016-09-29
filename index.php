<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/LogInModel.php');

session_start();
$_SESSION["visits"] = 0;
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS

$m = new LogInModel();

$v = new LoginView($m);
$dtv = new DateTimeView();
$lv = new LayoutView();


$lv->render(false, $v, $dtv);

