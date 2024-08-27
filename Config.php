<?php

class Config {

  public function __construct(&$session)
  {
    $this->session = &$session;
  }

  public function getTalentecaBaseUrl()
  {
    if ($this->isDevelopment())
    {
      return 'https://dev.talenteca.com';
    } else {
      return 'https://www.talenteca.com';
    }
  }

  public function getTestRecruiterAppId()
  {
    if ($this->isDevelopment())
    {
      return "tkrai:local-demo:12736935015703209286";
    } else
    {
      return "tkrai:tk-recruiter-app-sample-sandbox:53331797198906154036";
    }
  }

  public function getTestRecruiterAppSecret()
  {
    if ($this->isDevelopment())
    {
      return "JDFiWVVTcVVUaVgvL0c3cmtUanVHb2c9PSRqZldBeXduMzJxZDhyQ3g2M1RLZytuSjhxdE9aRkNTL1BaWWpuaXVyYlZLRHFUVXEwMi9ibk84K2phaGRyN0R5M3M2N0creHcrNHVrZkZTRlI3UlJvbzdUanBQRFBTa1B4UFVEVTd0d2dueHE0UnFmZkhZTWErM1NYdFJmWk5nTzhCdGdxbVpZNDAyVWo5OC9uUTZFaUFLbEh0b1dNNnRwNUg4bE1ranBBd3NnWFg4OWErcWk4ODh6bXJCa0ZSc1lHd3JUNWlSNXFWRnNwRHZoQnMxaTVpdmVZVEJnVzJDT1VEa3JvZTcyWnZqaHVPakF6Q1lxY0c3TFErVG5va0w2RS80ZmdSblFrWGFVVDl4T01iUVZlbnBCOG9aODNzNW5BNERCVEZqaVdHYnA3SEFIak92ZndhZ0x3aUVwMHFTa3YwN0h6TkFVencxRHhkT2RUTEFlUEZUdzVsK2NXaVR0aTQwRVpqSERGZGlmSFd4VHFKYlRRUHhzMmozOUNyWFc3Tzl5MVQ4NmpEbUF5RU5lNklXUXpRPT0=";
    } else
    {
      return "JCszZ0pSZHBNcUN1eXNtaHplRFQvRWc9PSRNL0tMczFZTzRmVCthZEttTGN6MWhUM0FzSGxPTWZmV2Q4TS9BbThJU002NXlzbWxtczJEUHh5SVBpa3V1anZZZEtzakxDRXN4SUVOSFUvR0VsWmFRMDNrOVVJVmxuU1pGVXVFMFM2Qk5Gb1cvS3Q4VFZOQ3FvS0pVK04xcVdmTnFXL1I3dlBDWUJPNzlsUi9UVzVrNlpsRFhmYVdxelo5VWthdWZWR0xybTJOTHJnT09ycm1xMHR3WlR0M2FIV0gyc1Q5SGYyeVVsaXZMdGlnZXV3MVBsVXFKaXRzNjgvekJaSUVrNEJrb2F1Z21zRHoyODRPWG1wazhrQlFmeVIxaktyQmlSeURHMVBld3pWejFnbGRyWlpSVFJPbTJoaUR4TThqYXlBOUkyRUxkeWtubEFGRGtUUGI4cWJNTUpMOVpxOEhaMzRSamJKTEIwNlh0dWRHbTNhUWtSOGJvNVBJaGJQQzJOTHEzM1VDS3dMZHorWDBvSmlacTNrZldpZ2FWa0hCenkwUmp6azc3ZDRJODlMUURjaTh2d3htVkpYUVcxOEhPUXAwZHJoK2FpeFoxVE92TUdKMWZ6VG9Zdm14dVV4UFpwMFd5VUtTOEFvbld4SGQ0ZXgwS2lWdENmcnpxVXZWN3dEQ1FmWT0=";
    }
  }

  public function getBasePath()
  {
      $request_uri = $_SERVER['REQUEST_URI'];
      $base_request_uri = explode("?", $request_uri)[0];
      if (substr($base_request_uri, -1) != "/")
      {
        $base_request_uri = $base_request_uri . "/";
      }
      $parts = explode("/", $base_request_uri);
      array_pop($parts);
      return implode("/", $parts);
  }

  public function toBasePath($path)
  {
      return $this->getBasePath() . $path;
  }

  public function getRecruiterAppId()
  {
    if (!isset($this->session['recruiter_app_id'])) {
      $this->session['recruiter_app_id'] = '';
    }
    return $this->session['recruiter_app_id'];
  }

  public function recordRecruiterAppId($recruiter_app_id)
  {
    $this->session['recruiter_app_id'] = $recruiter_app_id;
  }

  public function getRecruiterAppSecret()
  {
    if (!isset($this->session['recruiter_app_secret'])) {
      $this->session['recruiter_app_secret'] = '';
    }
    return $this->session['recruiter_app_secret'];
  }

  public function recordRecruiterAppSecret($recruiter_app_secret)
  {
    $this->session['recruiter_app_secret'] = $recruiter_app_secret;
  }

  private function isDevelopment()
  {
    return getenv("DEMO_RECRUITER_APP_ENV") == "dev";
  }

}
