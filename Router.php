<?php

class Router {

  public function __construct($get, $post, &$session)
  {
    $controller = new Controller($session);

    if(isset($get['action']))
    {
      switch($get['action'])
      {
        case 'start':
        $controller->start();
        break;

        case 'demo':
        $controller->showJobAds();
        break;
  
        case 'request-auth':
        $controller->requestAuth();
        break;

        case 'error':
        $controller->showError($get);
        break;
      
        default:
        $controller->start();
      }
    }
    else
    {
      $controller->start();
    }
  }
}
