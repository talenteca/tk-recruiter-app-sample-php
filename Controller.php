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
    $auth = new Auth($this->session);
    $request_auth_url = $auth->getRequestAppAuthUrl();
    if (is_null($request_auth_url)) {
      return $this->showError();
    }
    return header("Location: ".$request_auth_url);
  }

  public function receiveAuth()
  {
    $auth = new Auth($this->session);
    $status = $this->get['status'];
    $recruiterAppId = $this->get['recruiter_app_id'];
    $challengeCode = $this->get['challenge_code'];
    $recruiterId = $this->get['recruiter_id'];
    if ($status == "ok")
    {
      $access_token = $auth->getAccessToken($challengeCode);
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
    $config = new Config($this->session);
    $recruiterAppId = $config->getRecruiterAppId();
    $recruiterAppSecret = $config->getRecruiterAppSecret();
    $testRecruiterAppId = $config->getTestRecruiterAppId();
    $testRecruiterAppSecret = $config->getTestRecruiterAppSecret();
    $errorMessage = null;
    if (isset($this->session['error_message'])) {
      $errorMessage = $this->session['error_message'];
    }
    require_once('layout/views/start.php');
  }

  public function startDemo()
  {
    $config = new Config($this->session);
    if(!isset($this->post['recruiter_app_id']) || $this->post['recruiter_app_id'] == "") {
      $config->recordRecruiterAppId('');
      $config->recordRecruiterAppSecret($this->post['recruiter_app_secret']);
      $this->session['error_message'] = "Recruiter app ID is required";
      return header("Location: /?action=start");
    }
    $config->recordRecruiterAppId($this->post['recruiter_app_id']);
    if(!isset($this->post['recruiter_app_secret']) || $this->post['recruiter_app_secret'] == "") {
      $config->recordRecruiterAppSecret($this->post['recruiter_app_id']);
      $config->recordRecruiterAppSecret('');
      $this->session['error_message'] = "Recruiter app secret is required";
      return header("Location: /?action=start");
    }
    $config->recordRecruiterAppSecret($this->post['recruiter_app_secret']);
    $this->session['error_message'] = null;
    return header("Location: /?action=demo");
  }

  public function demo()
  {
    $auth = new Auth($this->session);
    $recruiter_app_info = $auth->getRecruiterAppInfo();
    if (is_null($recruiter_app_info)) {
      return $this->showError();
    }
    require_once('layout/views/demo.php');
  }

  public function demoSignup()
  {
    $users = new Users($this->session);
    $user = $users->getCurrentUser();
    if (!is_null($user))
    {
      $this->session['message_title'] = "Signup";
      $this->session['message_text'] = "User already created";
      $this->session['message_detail'] = "User ID: ".$user['user_id'].", user email: ".$user['user_email'].", user fullname: ".$user['user_fullname'];
      $this->session['return_action'] = "/?action=demo#demo-2";
      return $this->showMessage();
    }
    require_once('layout/views/demo-signup.php');
  }

  public function signup()
  {
    if (!isset($this->post['user_email']) || $this->post['user_email'] == "")
    {
      $this->session['error_message'] = 'User email is required';
      $this->session['return_action'] = '/?action=demo-signup';
      return $this->showError();
    }
    if (!isset($this->post['user_fullname']) || $this->post['user_fullname'] == "")
    {
      $this->session['error_message'] = 'User fullname is required';
      $this->session['return_action'] = '/?action=demo-signup';
      return $this->showError();
    }
    $user = [
      'user_email'=>$this->post['user_email'],
      'user_fullname'=>$this->post['user_fullname']
    ];
    $users = new Users($this->session);
    $users->recordUser($user);
    $this->session['message_title'] = "Signup";
    $this->session['message_text'] = "User created";
    $this->session['message_detail'] = "User ID: ".$user['user_id'].", user email: ".$user['user_email'].", user fullname: ".$user['user_fullname'];
    $this->session['return_action'] = "/?action=demo#demo-2";
    return $this->showMessage();
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

  public function restart()
  {
    unset($this->session['user']);
    unset($this->session['recruiter_app_info']);
    unset($this->session['recruiter_app_access_token']);
    unset($this->session['error_message']);
    unset($this->session['error_detail']);
    unset($this->session['message_title']);
    unset($this->session['message_text']);
    unset($this->session['message_detail']);
    return header("Location: /?action=start");
  }

  public function showMessage()
  {
    $message_title = $this->session['message_title'];
    $message_text = $this->session['message_text'];
    $message_detail = $this->session['message_detail'];
    $return_action = $this->session['return_action'];
    require_once('layout/views/message.php');
  }

  public function showError()
  {
    $error_message = $this->session['error_message'];
    $error_detail = $this->session['error_detail'];
    $return_action = $this->session['return_action'];
    require_once('layout/views/error.php');
  }

}
