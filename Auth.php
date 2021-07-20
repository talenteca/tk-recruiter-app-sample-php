<?php

class Auth {

  public function __construct(&$session)
  {
    $this->session = &$session;
    $this->config = new Config($this->session);
  }

  public function getRecruiterAppInfo()
  {
    if (isset($this->session['recruiter_app_info']))
    {
      return $this->session['recruiter_app_info'];
    }
    if (is_null($this->config->getRecruiterAppId()))
    {
      $this->session['error_message'] = "The recruiter app ID is required";
      return null;
    }
    $url = "https://dev.talenteca.com/api/v1/oauth/recruiter/recruiter-app-info";
    $data = [
      'app_id' => $this->config->getRecruiterAppId()
    ];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl);
    $status_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
    curl_close($curl);
    if ($status_code == 200)
    {
      $json = json_decode($response);
      if ($json->status == "ok")
      {
        $recruiter_app_info = $json->app_info;
        $this->session['recruiter_app_info'] = $recruiter_app_info;
        return $recruiter_app_info;
      }
    }
    $this->session['error_message'] = "Unable to get recruiter app info, please ensure your credentials are right";
    $this->session['error_detail'] = $response;
    return null;
  }

  public function getRequestAppAuthUrl($user)
  {
    $user_id = $user['user_id'];
    $challenge_code = $this->generateChallengeCode($user_id);
    if (is_null($challenge_code)) {
      return null;
    }
    $challenge_code_encoded = urlencode($challenge_code);
    $recruiter_app_id_encoded = urlencode($this->config->getRecruiterAppId());
    $redirect_callback_url = urlencode($this->getRedirectCallbackUrl());
    return "https://dev.talenteca.com/auth/recruiter-app?recruiter_app_id=".$recruiter_app_id_encoded."&challenge_code=".$challenge_code_encoded."&redirect=".$redirect_callback_url;
  }

  private function generateChallengeCode($user_id) {
    $url = "https://dev.talenteca.com/api/v1/oauth/recruiter/challenge-code";
    $data = [
      'app_id' => $this->config->getRecruiterAppId(),
      'app_secret' => $this->config->getRecruiterAppSecret()
    ];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl);
    $status_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
    curl_close($curl);
    if ($status_code == 200)
    {
      $json = json_decode($response);
      if ($json->status == "ok")
      {
        $challenge_code = $json->challenge_code;
        $db = new Db($this->session);
        $db->recordUserIdForChallengeCode($challenge_code, $user_id);
        return $challenge_code;
      }
    }    
    $this->session['error_message'] = "Unable to get challenge code to start request authentication";
    $this->session['error_detail'] = $response;
    return null;
  }

  public function getAccessToken($codeChallenge)
  {
    return "FIXME";
  }

  private function getRedirectCallbackUrl()
  {
    $schema = "http";
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")
    {
      $schema = "https";
    }
    return $schema."://".$_SERVER['HTTP_HOST']."/?action=receive-auth";
  }

}
