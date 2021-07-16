<?php

class Controller {

  const BASE_URL = 'http://localhost:8000/';

  public function __construct(&$session)
  {
    $this->session = &$session;
  }

  public function requestAuth()
  {
    $recruiterApp = new RecruiterApp;
    $request_auth_url = $recruiterApp->getRequestAppAuthUrl();

    return header("Location: ".$request_auth_url);
  }

  public function start()
  {
    require_once('layout/views/start.php');
  }

  public function showJobAds()
  {
    if(!isset($this->session['recruiter_app_access_token']))
    return header("Location: ".self::BASE_URL.'?action=request-auth');

    $job_ads = new JobAds;
    $job_ads = $job_ads->getAllJobAds();
    require_once('layout/views/job-ads-list.php');
  }

  public function showError($get)
  {
    $error_message = $get['error_message'];
    require_once('layout/views/error.php');
  }

}
