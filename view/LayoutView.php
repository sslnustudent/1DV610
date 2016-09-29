<?php
/////home/a7642829/public_html/
require_once("model/LogInModel.php");

class LayoutView {
  
  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv) {

     // $v->response();

     $e2 = '
          
          <div class="container">
              ' . $v->response() . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
    $e1 = '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($v->isLoggedin());

    echo $e1 . $e2;                                                          
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
