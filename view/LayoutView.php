<?php

require_once("model/LogInModel.php");

class LayoutView {
  
  private $dateTimeView;

  public function __construct(DateTimeView $dateTimeView){
      $this->dateTimeView = $dateTimeView;
  }

  public function render($isLoggedIn, $message) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $message . '
              
              ' . $this->dateTimeView->show() . '
          </div>
         </body>
      </html>
    ';                                                    
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
