<?php

class Controller {

  public function __construct($get, $post, &$session)
  {
    $this->get = $get;
    $this->post = $post;
    $this->session = &$session;
    $this->config = new Config($this->session);
  }

  public function recieveAuth()
  {
    $auth = new Auth($this->session);
    $status = $this->get['status'];
    if ($status == "ok")
    {
      if (!isset($this->get['recruiter_app_id']))
      {
        $this->session['error_message'] = "No recruiter app ID received. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = null;
        $this->session['return_action'] = "/?action=demo-request-permission";
        return $this->showError();
      }
      $recruiterAppId = $this->get['recruiter_app_id'];
      if (!isset($this->get['challenge_code']))
      {
        $this->session['error_message'] = "No challenge code received. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = null;
        $this->session['return_action'] = "/?action=demo-request-permission";
        return $this->showError();
      }
      $challengeCode = $this->get['challenge_code'];
      if (!isset($this->get['recruiter_id']))
      {
        $this->session['error_message'] = "No Talenteca recruiter ID received. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = null;
        $this->session['return_action'] = "/?action=demo-request-permission";
        return $this->showError();
      }
      $talentecaRecruiterId = $this->get['recruiter_id'];
      if (strlen($talentecaRecruiterId) != 24)
      {
        $this->session['error_message'] = "Invalid Talenteca recruiter ID received. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = "The Talenteca recruiter ID reviewed is ".$talentecaRecruiterId;
        $this->session['return_action'] = "/?action=demo-request-permission";
        return $this->showError();
      }
      $current_recruiter_app_id = $this->config->getRecruiterAppId();
      if ($recruiterAppId != $current_recruiter_app_id)
      {
        $this->session['error_message'] = "Invalid recruiter app ID received. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = "The recruiter app ID reviewed is ".$recruiterAppId." and the current recruiter app ID is ".$current_recruiter_app_id;
        $this->session['return_action'] = "/?action=demo-request-permission";
        return $this->showError();
      }
      $db = new Db($this->session);
      $userId = $db->getUserIdForChallengeCode($challengeCode);
      if (is_null($userId))
      {
        $this->session['error_message'] = "Unable to get the user ID for the challenge code granted permission. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
        $this->session['error_detail'] = "The challenge code received is ".$challengeCode;
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
    $basePath = $this->config->getBasePath();
    $talentecaBaseUrl = $this->config->getTalentecaBaseUrl();
    $recruiterAppId = $this->config->getRecruiterAppId();
    $recruiterAppSecret = $this->config->getRecruiterAppSecret();
    $testRecruiterAppId = $this->config->getTestRecruiterAppId();
    $testRecruiterAppSecret = $this->config->getTestRecruiterAppSecret();
    $errorMessage = null;
    if (isset($this->session['error_message'])) {
      $errorMessage = $this->session['error_message'];
    }
    require_once('layout/views/start.php');
  }

  public function startDemo()
  {
    $basePath = $this->config->getBasePath();
    $talentecaBaseUrl = $this->config->getTalentecaBaseUrl();
    if(!isset($this->post['recruiter_app_id']) || $this->post['recruiter_app_id'] == "") {
      $this->config->recordRecruiterAppId('');
      $this->config->recordRecruiterAppSecret($this->post['recruiter_app_secret']);
      $this->session['error_message'] = "Recruiter app ID is required";
      return header("Location: " . $this->config->toBasePath("/?action=start"));
    }
    $this->config->recordRecruiterAppId($this->post['recruiter_app_id']);
    if(!isset($this->post['recruiter_app_secret']) || $this->post['recruiter_app_secret'] == "") {
      $this->config->recordRecruiterAppSecret($this->post['recruiter_app_id']);
      $this->config->recordRecruiterAppSecret('');
      $this->session['error_message'] = "Recruiter app secret is required";
      return header("Location: " . $this->config->toBasePath("/?action=start"));
    }
    $this->config->recordRecruiterAppSecret($this->post['recruiter_app_secret']);
    $this->session['error_message'] = null;
    return header("Location: " . $this->config->toBasePath("/?action=demo"));
  }

  public function demo()
  {
    $basePath = $this->config->getBasePath();
    $talentecaBaseUrl = $this->config->getTalentecaBaseUrl();
    $auth = new Auth($this->session);
    $recruiter_app_info = $auth->getRecruiterAppInfo();
    if (is_null($recruiter_app_info)) {
      return $this->showError();
    }
    require_once('layout/views/demo.php');
  }

  public function demoSignup()
  {
    $basePath = $this->config->getBasePath();
    $talentecaBaseUrl = $this->config->getTalentecaBaseUrl();
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
    $basePath = $this->config->getBasePath();
    $talentecaBaseUrl = $this->config->getTalentecaBaseUrl();
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
    $basePath = $this->config->getBasePath();
    $talentecaBaseUrl = $this->config->getTalentecaBaseUrl();
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
    $basePath = $this->config->getBasePath();
    $talentecaBaseUrl = $this->config->getTalentecaBaseUrl();
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
    $basePath = $this->config->getBasePath();
    $talentecaBaseUrl = $this->config->getTalentecaBaseUrl();
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
    $basePath = $this->config->getBasePath();
    $talentecaBaseUrl = $this->config->getTalentecaBaseUrl();
    if (!isset($this->session['recruiter_app_auth_url']))
    {
      $this->session['message_title'] = "Request Permission";
      $this->session['message_text'] = "No auth request URL created, please try to run the prepare auth step first.";
      $this->session['return_action'] = "/?action=demo#demo-2";
      return $this->showMessage();
    }
    $recruiter_app_auth_url = $this->session['recruiter_app_auth_url'];
    return header("Location: " . $recruiter_app_auth_url);
  }

  public function demoListJobAds()
  {
    $users = new Users($this->session);
    $user = $users->getCurrentUser();
    if (is_null($user))
    {
      $this->session['message_title'] = "List job ads";
      $this->session['message_text'] = "No user in session, please run the first step.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-1";
      return $this->showMessage();
    }
    $userId = $user['user_id'];
    $db = new Db($this->session);
    $accessToken = $db->getAccessTokenForUserId($userId);
    if (is_null($accessToken))
    {
      $this->session['message_title'] = "List job ads";
      $this->session['message_text'] = "No access token available, please create an access token to continue.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-4 ";
      return $this->showMessage();
    }
    require_once('layout/views/demo-list-job-ads.php');
  }

  public function listJobAds()
  {
    $users = new Users($this->session);
    $user = $users->getCurrentUser();
    if (is_null($user))
    {
      $this->session['message_title'] = "List job ads";
      $this->session['message_text'] = "No user in session, please run the first step.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-1";
      return $this->showMessage();
    }
    $userId = $user['user_id'];
    $db = new Db($this->session);
    $accessToken = $db->getAccessTokenForUserId($userId);
    if (is_null($accessToken))
    {
      $this->session['message_title'] = "List job ads";
      $this->session['message_text'] = "No access token available, please create an access token to continue.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-4";
      return $this->showMessage();
    }
    $recruiter = new Recruiter($this->session);
    $allJobAds = $recruiter->getAllJobAds($accessToken);
    if (is_null($allJobAds)) {
      $this->session['return_action'] = "/?action=demo-list-job-ads";
      return $this->showError();
    }
    $activeJobAds = $allJobAds['activeJobAds'];
    $inactiveJobAds = $allJobAds['inactiveJobAds'];
    require_once('layout/views/job-ads-list.php');
  }

  public function demoCreateJobAd()
  {
    $users = new Users($this->session);
    $user = $users->getCurrentUser();
    if (is_null($user))
    {
      $this->session['message_title'] = "List job ads";
      $this->session['message_text'] = "No user in session, please run the first step.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-1";
      return $this->showMessage();
    }
    $userId = $user['user_id'];
    $db = new Db($this->session);
    $accessToken = $db->getAccessTokenForUserId($userId);
    if (is_null($accessToken))
    {
      $this->session['message_title'] = "List job ads";
      $this->session['message_text'] = "No access token available, please create an access token to continue.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-4";
      return $this->showMessage();
    }
    require_once('layout/views/demo-create-job-ad.php');
  }

  public function createJobAd()
  {
    $users = new Users($this->session);
    $user = $users->getCurrentUser();
    if (is_null($user))
    {
      $this->session['message_title'] = "Create job ad";
      $this->session['message_text'] = "No user in session, please run the first step.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-1";
      return $this->showMessage();
    }
    $userId = $user['user_id'];
    $db = new Db($this->session);
    $accessToken = $db->getAccessTokenForUserId($userId);
    if (is_null($accessToken))
    {
      $this->session['message_title'] = "Create job ad";
      $this->session['message_text'] = "No access token available, please create an access token to continue.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-4";
      return $this->showMessage();
    }
    $recruiter = new Recruiter($this->session);
    $jobAd = [
      'title' => $this->post['title'],
      'salary' => $this->post['salary'],
      'custom_company_name' => $this->post['custom_company_name'],
      'category' => $this->post['category'],
      'industry' => $this->post['industry'],
      'desired_candidate_education_level' => $this->post['desired_candidate_education_level'],
      'desired_candidate_experience_level' => $this->post['desired_candidate_experience_level'],
      'country_code' => $this->post['country_code'],
      'postal_code' => $this->post['postal_code'],
      'position' => $this->post['position'],
      'description' => $this->post['description'],
      'test' => true
    ];
    $jobAdId = $recruiter->createJobAdInProgress($accessToken, $jobAd);
    if (is_null($jobAdId)) {
      $this->session['return_action'] = "/?action=demo-create-job-ad";
      return $this->showError();
    }
    $this->session['job_ad_in_progress_id'] = $jobAdId;
    $this->session['message_title'] = "Create job ad";
    $this->session['message_text'] = "Job ad created with status 'in progress', now you can continue to active it.";
    $this->session['message_detail'] = "Job ad ID: ".$jobAdId;
    $this->session['return_action'] = "/?action=demo#demo-7";
    return $this->showMessage();
  }

  public function demoActivateJobAd()
  {
    $users = new Users($this->session);
    $user = $users->getCurrentUser();
    if (is_null($user))
    {
      $this->session['message_title'] = "List job ads";
      $this->session['message_text'] = "No user in session, please run the first step.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-1";
      return $this->showMessage();
    }
    $userId = $user['user_id'];
    $db = new Db($this->session);
    $accessToken = $db->getAccessTokenForUserId($userId);
    if (is_null($accessToken))
    {
      $this->session['message_title'] = "List job ads";
      $this->session['message_text'] = "No access token available, please create an access token to continue.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-4";
      return $this->showMessage();
    }
    if (!isset($this->session['job_ad_in_progress_id'])) {
      $this->session['message_title'] = "Activate job ad";
      $this->session['message_text'] = "No job ad in progress found, please create a job ad to continue.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-6";
      return $this->showMessage();
    }
    $jobAdId = $this->session['job_ad_in_progress_id'];
    $this->session['message_title'] = "Activate job ad";
    $this->session['message_text'] = "Now you can activate the created job ad to move it from 'in progress' status to 'published' status.";
    $this->session['message_detail'] = "Jod ad to activate: " . $jobAdId;
    $this->session['return_action'] = "/?action=activate-job-ad";
    return $this->showMessage();
}

  public function activateJobAd()
  {
    $users = new Users($this->session);
    $user = $users->getCurrentUser();
    if (is_null($user))
    {
      $this->session['message_title'] = "Create job ad";
      $this->session['message_text'] = "No user in session, please run the first step.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-1";
      return $this->showMessage();
    }
    $userId = $user['user_id'];
    $db = new Db($this->session);
    $accessToken = $db->getAccessTokenForUserId($userId);
    if (is_null($accessToken))
    {
      $this->session['message_title'] = "Create job ad";
      $this->session['message_text'] = "No access token available, please create an access token to continue.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-4";
      return $this->showMessage();
    }
    if (!isset($this->session['job_ad_in_progress_id'])) {
      $this->session['message_title'] = "Activate job ad";
      $this->session['message_text'] = "No job ad in progress found, please create a job ad to continue.";
      $this->session['message_detail'] = null;
      $this->session['return_action'] = "/?action=demo#demo-6";
      return $this->showMessage();
    }
    $jobAdId = $this->session['job_ad_in_progress_id'];
    $recruiter = new Recruiter($this->session);
    $resultOk = $recruiter->activateJobAd($accessToken, $jobAdId);
    if (!$resultOk) {
      $this->session['return_action'] = "/?action=demo-activate-job-ad";
      return $this->showError();
    }
    $this->session['message_title'] = "Activate job ad";
    $this->session['message_text'] = "Job ad activated, now you can get a new list of job ads to check if it's OK.";
    $this->session['message_detail'] = "Job ad activated ID: ".$jobAdId;
    $this->session['return_action'] = "/?action=demo#demo-5";
    return $this->showMessage();
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
      $this->session['error_detail'] = "The challenge code received is ".$challengeCode;
      $this->session['return_action'] = "/?action=demo#demo-3";
      return $this->showError();
    }
    $talentecaRecruiterId = $db->getTalentecaRecruiterIdForChallengeCode($challengeCode);
    if (is_null($talentecaRecruiterId))
    {
      $this->session['error_message'] = "Unable to get the Talenteca recruiter ID for the challenge code granted permission. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
      $this->session['error_detail'] = "The challenge code received is ".$challengeCode;
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
      $this->session['error_detail'] = "The challenge code received is ".$challengeCode;
      $this->session['return_action'] = "/?action=demo#demo-3";
      return $this->showError();
    }
    $talentecaRecruiterId = $db->getTalentecaRecruiterIdForChallengeCode($challengeCode);
    if (is_null($talentecaRecruiterId))
    {
      $this->session['error_message'] = "Unable to get the Talenteca recruiter ID for the challenge code granted permission. Maybe this is a simple miss configuration or a session expiration on the local server but it can also actually happen on real servers and this is trying to prevent possible attacks of man in the middle on the authorization process. If you recieve these kind of attacks please contact Talenteca to try to minimize them and fix them.";
      $this->session['error_detail'] = "The challenge code received is ".$challengeCode;
      $this->session['return_action'] = "/?action=demo#demo-3";
      return $this->showError();
    }
    $currentAccessToken = $db->getAccessTokenForUserId($userId);
    if (!is_null($currentAccessToken))
    {
      $this->session['message_title'] = "Access token";
      $this->session['message_text'] = "The access token was already created. Now we can try to make calls to Talenteca in behalf of our local user.";
      $this->session['message_detail'] = "Access token linked to the local user ".$userId;
      $this->session['return_action'] = "/?action=demo#demo-5";
      return $this->showMessage();
    }
    $auth = new Auth($this->session);
    $accessToken = $auth->createAccessToken($challengeCode, $talentecaRecruiterId);
    if (is_null($accessToken))
    {
      $this->session['return_action'] = "/?action=demo#demo-3";
      return $this->showError();
    } else {
      $db->recordAccessTokenForUserId($userId, $accessToken);
      $this->session['message_title'] = "Access token";
      $this->session['message_text'] = "Access token successfully created. Now we can try to make calls to Talenteca in behalf of our local user.";
      $this->session['message_detail'] = "Access token created for local user ".$userId;
      $this->session['return_action'] = "/?action=demo#demo-5";
      return $this->showMessage();
      }
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
    unset($this->session['job_ad_in_progress_id']);
    unset($this->session['challenge_code_ready_for_access_token']);
    return header("Location: " . $this->config->toBasePath("/?action=start"));
  }

  public function showMessage()
  {
    $basePath = $this->config->getBasePath();
    $talentecaBaseUrl = $this->config->getTalentecaBaseUrl();
    $message_title = $this->session['message_title'];
    $message_text = $this->session['message_text'];
    $message_detail = $this->session['message_detail'];
    $return_action = $this->config->toBasePath($this->session['return_action']);
    require_once('layout/views/message.php');
  }

  public function showError()
  {
    $basePath = $this->config->getBasePath();
    $talentecaBaseUrl = $this->config->getTalentecaBaseUrl();
    $error_message = $this->session['error_message'];
    $error_detail = $this->session['error_detail'];
    $return_action = $this->config->toBasePath($this->session['return_action']);
    require_once('layout/views/error.php');
  }

}
