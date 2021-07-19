<?php

class Router {

  public function __construct($get, $post, &$session)
  {
    $controller = new Controller($get, $post, $session);

    if(isset($get['action']))
    {
      switch($get['action'])
      {
        case 'start':
        $controller->start();
        break;

        case 'restart':
        $controller->restart();
        break;

        case 'start-demo':
        $controller->startDemo();
        break;

        case 'demo':
        $controller->demo();
        break;

        case 'signup':
        $controller->signup();
        break;

        case 'demo-signup':
        $controller->demoSignup();
        break;
                  
        case 'list-job-ads':
        $controller->listJobAds();
        break;
  
        case 'request-auth':
        $controller->requestAuth();
        break;

        case 'receive-auth':
        $controller->receiveAuth();
        break;

        case 'error':
        $controller->showError();
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
