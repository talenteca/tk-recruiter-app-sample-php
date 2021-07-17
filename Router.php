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

        case 'list-job-ads':
        $controller->listJobAds();
        break;
  
        case 'request-auth':
        $controller->requestAuth();
        break;

        case 'error':
        $controller->showError($session);
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
