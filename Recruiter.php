<?php

class Recruiter {

  public function __construct(&$session)
  {
    $this->session = &$session;
  }

  public function getAllJobAds($accessToken)
  {
    $url = "https://dev.talenteca.com/api/v1/recruiter/job-ad/list";
    $data = [
      'access_token' => $accessToken
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
        $activeJobAds = $json->active_job_ads;
        $inactiveJobAds = $json->inactive_job_ads;
        return [
          'activeJobAds' => $activeJobAds,
          'inactiveJobAds' => $inactiveJobAds
        ];
      }
    }
    $this->session['error_message'] = "Unable to get job ads";
    $this->session['error_detail'] = $response;
    return null;
  }

}
