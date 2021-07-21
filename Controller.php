<?php

class Controller {

  public function __construct($get, $post, &$session)
  {
    $this->get = $get;
    $this->post = $post;
    $this->session = &$session;
  }

  public function recieveAuth()
  {
    $auth = new Auth($this->session);
    $status = $this->get['status'];
    if ($status == "ok")
    {
      if (!isset($this->get['recruiter_app_id']))
      {
        $this->session['error_message'] = "No recruiter app ID recieved. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = null;
        $this->session['return_action'] = "/?action=demo-request-permission";
        return $this->showError();
      }
      $recruiterAppId = $this->get['recruiter_app_id'];
      if (!isset($this->get['challenge_code']))
      {
        $this->session['error_message'] = "No challenge code recieved. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = null;
        $this->session['return_action'] = "/?action=demo-request-permission";
        return $this->showError();
      }
      $challengeCode = $this->get['challenge_code'];
      if (!isset($this->get['recruiter_id']))
      {
        $this->session['error_message'] = "No Talenteca recruiter ID recieved. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = null;
        $this->session['return_action'] = "/?action=demo-request-permission";
        return $this->showError();
      }
      $talentecaRecruiterId = $this->get['recruiter_id'];
      if (strlen($talentecaRecruiterId) != 24)
      {
        $this->session['error_message'] = "Invalid Talenteca recruiter ID recieved. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = "The Talenteca recruiter ID revieved is ".$talentecaRecruiterId;
        $this->session['return_action'] = "/?action=demo-request-permission";
        return $this->showError();
      }
      $config = new Config($this->session);
      $current_recruiter_app_id = $config->getRecruiterAppId();
      if ($recruiterAppId != $current_recruiter_app_id)
      {
        $this->session['error_message'] = "Invalid recruiter app ID recieved. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = "The recruiter app ID revieved is ".$recruiterAppId." and the current recruiter app ID is ".$current_recruiter_app_id;
        $this->session['return_action'] = "/?action=demo-request-permission";
        return $this->showError();
      }
      $db = new Db($this->session);
      $userId = $db->getUserIdForChallengeCode($challengeCode);
      if (is_null($userId))
      {
        $this->session['error_message'] = "Unable to get the user ID for the challenge code granted permission. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = "The challenge code recieved is ".$challengeCode;
        $this->session['return_action'] = "/?action=demo-request-permission";
        return $this->showError();
      }
      $db->recordTalentecaRecruiterIdForChallengeCode($challengeCode, $talentecaRecruiterId);
      $this->session['challenge_code_ready_for_access_token'] = $challengeCode;
      $this->session['message_title'] = "Permission granted";
      $this->session['message_text'] = "Talenteca has approved your recruiter app permission request, now you can get an access token to continue.";
      $this->session['message_detail'] = "Permission granted for user ".$userId." and Talenteca recruiter ID ".$talentecaRecruiterId." that both are now linked with challenge code: ".$challengeCode;
      $this->session['return_action'] = "/?action=demo#demo-4";
      return $this->showMessage();
    }
    else
    {
      $this->session['error_message'] = "Permission denied, either the Talenteca recruiter or the Talenteca security system revoke the permission to continue.";
      $this->session['error_detail'] = $status;
      $this->session['return_action'] = "/?action=demo-request-permission";
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

  public function demoPrepareAuth()
  {
    $users = new Users($this->session);
    $user = $users->getCurrentUser();
    if (is_null($user))
    {
      $this->session['message_title'] = "Prepare Auth";
      $this->session['message_text'] = "No user created, please run the sign up step first.";
      $this->session['return_action'] = "/?action=demo#demo-1";
      return $this->showMessage();
    }
    require_once('layout/views/demo-prepare-auth.php');
  }

  public function prepareAuth()
  {
    $users = new Users($this->session);
    $user = $users->getCurrentUser();
    if (is_null($user))
    {
      $this->session['message_title'] = "Prepare Auth";
      $this->session['message_text'] = "No user created, please run the sign up step first.";
      $this->session['return_action'] = "/?action=demo#demo-1";
      return $this->showMessage();
    }
    if (isset($this->session['recruiter_app_auth_url']))
    {
      $this->session['message_title'] = "Prepare Auth";
      $this->session['message_text'] = "Auth request already prepared. Now you can continue with the next step.";
      $this->session['message_detail'] = $this->session['recruiter_app_auth_url'];
      $this->session['return_action'] = "/?action=demo#demo-3";
      return $this->showMessage();
    }
    $auth = new Auth($this->session);
    $recruiter_app_auth_url = $auth->getRequestAppAuthUrl($user);
    if (is_null($recruiter_app_auth_url)) {
      $this->session['return_action'] = "/?action=demo#demo-2";
      return $this->showError();
    }
    $this->session['recruiter_app_auth_url'] = $recruiter_app_auth_url;
    $this->session['message_title'] = "Prepare Auth";
    $this->session['message_text'] = "Auth request URL successfully created. Give it a check to the URL, especially to the challenge code and the redirect parameters.";
    $this->session['message_detail'] = $recruiter_app_auth_url;
    $this->session['return_action'] = "/?action=demo#demo-3";
    return $this->showMessage();
  }

  public function demoRequestPermission()
  {
    if (!isset($this->session['recruiter_app_auth_url']))
    {
      $this->session['message_title'] = "Request Permission";
      $this->session['message_text'] = "No auth request URL created, please try to run the prepare auth step first.";
      $this->session['return_action'] = "/?action=demo#demo-2";
      return $this->showMessage();
    }
    $recruiter_app_auth_url = $this->session['recruiter_app_auth_url'];
    require_once('layout/views/demo-request-permission.php');
  }

  public function requestPermission()
  {
    if (!isset($this->session['recruiter_app_auth_url']))
    {
      $this->session['message_title'] = "Request Permission";
      $this->session['message_text'] = "No auth request URL created, please try to run the prepare auth step first.";
      $this->session['return_action'] = "/?action=demo#demo-2";
      return $this->showMessage();
    }
    $recruiter_app_auth_url = $this->session['recruiter_app_auth_url'];
    return header("Location: ".$recruiter_app_auth_url);
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

  public function demoCreateAccessToken()
  {
    if(!isset($this->session['challenge_code_ready_for_access_token']))
    {
      $this->session['error_message'] = "Talenteca has not approved our auth request yes, please run the request permission step first.";
      $this->session['error_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-3";
      return $this->showError();
    }
    $challengeCode = $this->session['challenge_code_ready_for_access_token'];
    $db = new Db($this->session);
    $userId = $db->getUserIdForChallengeCode($challengeCode);
    if (is_null($userId))
    {
      $this->session['error_message'] = "Unable to get the user ID for the challenge code granted permission. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
      $this->session['error_detail'] = "The challenge code recieved is ".$challengeCode;
      $this->session['return_action'] = "/?action=demo#demo-3";
      return $this->showError();
    }
    $talentecaRecruiterId = $db->getTalentecaRecruiterIdForChallengeCode($challengeCode);
    if (is_null($talentecaRecruiterId))
    {
      $this->session['error_message'] = "Unable to get the Talenteca recruiter ID for the challenge code granted permission. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
      $this->session['error_detail'] = "The challenge code recieved is ".$challengeCode;
      $this->session['return_action'] = "/?action=demo#demo-3";
      return $this->showError();
    }
    require_once('layout/views/demo-create-access-token.php');
  }

  public function createAccessToken()
  {
    if(!isset($this->session['challenge_code_ready_for_access_token']))
    {
      $this->session['error_message'] = "Talenteca has not approved our auth request yes, please run the request permission step first.";
      $this->session['error_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-3";
      return $this->showError();
    }
    $challengeCode = $this->session['challenge_code_ready_for_access_token'];
    $db = new Db($this->session);
    $userId = $db->getUserIdForChallengeCode($challengeCode);
    if (is_null($userId))
    {
      $this->session['error_message'] = "Unable to get the user ID for the challenge code granted permission. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
      $this->session['error_detail'] = "The challenge code recieved is ".$challengeCode;
      $this->session['return_action'] = "/?action=demo#demo-3";
      return $this->showError();
    }
    $talentecaRecruiterId = $db->getTalentecaRecruiterIdForChallengeCode($challengeCode);
    if (is_null($talentecaRecruiterId))
    {
      $this->session['error_message'] = "Unable to get the Talenteca recruiter ID for the challenge code granted permission. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
      $this->session['error_detail'] = "The challenge code recieved is ".$challengeCode;
      $this->session['return_action'] = "/?action=demo#demo-3";
      return $this->showError();
    }
    $auth = new Auth($this->session);
    $currentAccessToken = $db->getAccessTokenForUserId($userId);
    if (!is_null($currentAccessToken))
    {
      $this->session['message_title'] = "Access token";
      $this->session['message_text'] = "The access token was already created. Now we can try to make calls to Talenteca in behalf of our local user.";
      $this->session['message_detail'] = "Access token linked to the local user ".$user_id;
      $this->session['return_action'] = "/?action=demo#demo-5";
      return $this->showMessage();
    }
    $accessToken = $auth->createAccessToken($codeChallenge, $talentecaRecruiterId);
    $db->recordAccessTokenForUserId($access_token, $user_id);
    $this->session['message_title'] = "Access token";
    $this->session['message_text'] = "Access token successfully created. Now we can try to make calls to Talenteca in behalf of our local user.";
    $this->session['message_detail'] = $recruiter_app_auth_url;
    $this->session['return_action'] = "/?action=demo#demo-5";
    return $this->showMessage();
  }

  public function restart()
  {
    unset($this->session['user']);
    unset($this->session['recruiter_app_info']);
    unset($this->session['recruiter_app_auth_url']);
    unset($this->session['recruiter_app_access_token']);
    unset($this->session['error_message']);
    unset($this->session['error_detail']);
    unset($this->session['message_title']);
    unset($this->session['message_text']);
    unset($this->session['message_detail']);
    unset($this->session['user_ids_by_challenge_code']);
    unset($this->session['talenteca_recruiters_ids_by_challenge_code']);
    unset($this->session['access_tokens_by_user_id']);
    unset($this->session['challenge_code_ready_for_access_token']);
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
