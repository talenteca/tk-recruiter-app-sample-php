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

        case 'prepare-auth':
        $controller->prepareAuth();
        break;
  
        case 'demo-prepare-auth':
        $controller->demoPrepareAuth();
        break;
  
        case 'request-permission':
        $controller->requestPermission();
        break;

        case 'demo-request-permission':
        $controller->demoRequestPermission();
        break;

        case 'create-access-token':
        $controller->createAccessToken();
        break;
    
        case 'demo-create-access-token':
        $controller->demoCreateAccessToken();
        break;

        case 'demo-list-job-ads':
        $controller->demoListJobAds();
        break;
  
        case 'list-job-ads':
        $controller->listJobAds();
        break;
  
        case 'demo-create-job-ad':
        $controller->demoCreateJobAd();
        break;
  
        case 'create-job-ad':
        $controller->createJobAd();
        break;

        case 'demo-activate-job-ad':
        $controller->demoActivateJobAd();
        break;
        
        case 'activate-job-ad':
        $controller->activateJobAd();
        break;
                  
        case 'recieve-auth':
        $controller->recieveAuth();
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
