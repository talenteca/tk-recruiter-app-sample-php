<?php

class Controller {

  public function __construct($get, $post, &$session)
  {
    $this->get = $get;
    $this->post = $post;
    $this->session = &$session;
  }

  public function requestAuth()
  {
    $recruiterApp = new RecruiterApp($this->session);
    $request_auth_url = $recruiterApp->getRequestAppAuthUrl();
    if (is_null($request_auth_url)) {
      return $this->showError();
    }
    return header("Location: ".$request_auth_url);
  }

  public function receiveAuth()
  {
    $recruiterApp = new RecruiterApp($this->session);
    $status = $this->get['status'];
    $recruiterAppId = $this->get['recruiter_app_id'];
    $challengeCode = $this->get['challenge_code'];
    $recruiterId = $this->get['recruiter_id'];
    if ($status == "ok")
    {
      $access_token = $recruiterApp->getAccessToken($challengeCode);
      $this->session['recruiter_app_access_token'] = $access_token;
      return header("Location: /?action=list-job-ads");
    } else
    {
      $this->session['error_message'] = "Authorization denied";
      $this->session['error_detail'] = $status;
      return $this->showError();
    }
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
    $error_detail = $this->session['error_detail'];
    require_once('layout/views/error.php');
  }

}
