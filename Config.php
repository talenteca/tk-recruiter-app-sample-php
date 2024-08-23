<?php

class Config {

  public function __construct(&$session)
  {
    $this->session = &$session;
  }

  public function getTalentecaBaseUrl()
  {
    return 'https://www.talenteca.com';
  }

  public function getTestRecruiterAppId()
  {
    return "tkrai:tk-recruiter-app-sample-sandbox:53331797198906154036";
  }

  public function getTestRecruiterAppSecret()
  {
    return "JCszZ0pSZHBNcUN1eXNtaHplRFQvRWc9PSRNL0tMczFZTzRmVCthZEttTGN6MWhUM0FzSGxPTWZmV2Q4TS9BbThJU002NXlzbWxtczJEUHh5SVBpa3V1anZZZEtzakxDRXN4SUVOSFUvR0VsWmFRMDNrOVVJVmxuU1pGVXVFMFM2Qk5Gb1cvS3Q4VFZOQ3FvS0pVK04xcVdmTnFXL1I3dlBDWUJPNzlsUi9UVzVrNlpsRFhmYVdxelo5VWthdWZWR0xybTJOTHJnT09ycm1xMHR3WlR0M2FIV0gyc1Q5SGYyeVVsaXZMdGlnZXV3MVBsVXFKaXRzNjgvekJaSUVrNEJrb2F1Z21zRHoyODRPWG1wazhrQlFmeVIxaktyQmlSeURHMVBld3pWejFnbGRyWlpSVFJPbTJoaUR4TThqYXlBOUkyRUxkeWtubEFGRGtUUGI4cWJNTUpMOVpxOEhaMzRSamJKTEIwNlh0dWRHbTNhUWtSOGJvNVBJaGJQQzJOTHEzM1VDS3dMZHorWDBvSmlacTNrZldpZ2FWa0hCenkwUmp6azc3ZDRJODlMUURjaTh2d3htVkpYUVcxOEhPUXAwZHJoK2FpeFoxVE92TUdKMWZ6VG9Zdm14dVV4UFpwMFd5VUtTOEFvbld4SGQ0ZXgwS2lWdENmcnpxVXZWN3dEQ1FmWT0=";
  }

  public function getBasePath()
  {
      $document_uri = $_SERVER['DOCUMENT_URI'];
      $parts = explode("/", $document_uri);
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

}
