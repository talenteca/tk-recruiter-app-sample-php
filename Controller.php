<?php

class Controller {

  public function __construct(&$session)
  {
    $this->session = &$session;
  }

  public function requestAuth()
  {
    $recruiterApp = new RecruiterApp($session);
    $request_auth_url = $recruiterApp->getRequestAppAuthUrl();
    if ($request_auth_url == null) {
      return showError();
    }
    return header("Location: ".$request_auth_url);
  }

  public function start()
  {
    require_once('layout/views/start.php');
  }

  public function listJobAds()
  {
    if(!isset($this->session['recruiter_app_access_token'])) {
      return header("Location: /?action=request-auth");
    }
    $job_ads = new JobAds;
    $job_ads = $job_ads->getAllJobAds();
    require_once('layout/views/job-ads-list.php');
  }

  public function showError()
  {
    $error_message = $this->session['error_message'];
    require_once('layout/views/error.php');
  }

}
