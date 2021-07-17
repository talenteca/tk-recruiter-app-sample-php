<?php

class RecruiterApp {

  const TALENTECA_BASE_URL = 'https://dev.talenteca.com';

  const RECRUITER_APP_ID = 'tkrai:tk-recruiter-app-sample-sandbox:89425260059766841857197795291062';
  const RECRUITER_APP_SECRET = 'JGQyU1VyVXpzTzJGbURHWExMZFV1OFE9PSRiRzB4N1lCYlNCbkRyTmg3WmVCQS9HVGNhTHl0QzBEdUtFK29scGIzTXNJUFIrcUVsSDRLTno0a25GTTdNTUlNTFNuYzRhbVJWbDBjVzB3cVEvR29lTmZBUmU5Tzgya0NyR04xcDd3ODBsTk8wK0Y4RzlGcjVqS3l0N0ZRbDluYVFxajNzWWJTU3N2S254ajlOSDM1MGNZSnY2QW5zK3dqMTlmU21RemUydU5KUnFKNnI4emdaeTE0SVZPYmpJbnArbkYxdldVanJBaHc1WUZ5elBHc0pyS3hDcDFrOFBwUUhwSnR0Wk9JenpQb3VHY0xWYTdUdWJES0dvVHFzcmtmUlFhNnZqS0JQSTM1S1E1WVE5aXRvbzlsaXB0N2c2ZEk1TlFFWUVQZUdZbFl5UnQ1ZWN3ZlI1VkFuZlBvaXp5NmRQc2w5VFY4d2dNQStjM3JBVFp2RzU1aEpWa01QMXdwRis1UXdLSlVTcE9rdUlYT0FDajZKanlMUHdrbWxUQTN0dTZRbmpUbUU2OURNN05pc2ZicWY0NU52OVZRczZpQ1M0QnhYcllxSkhLbi9xR21aTlJTTHBjQ3ZEemtkcWE3dW4xWlljd1hubzFGZ2RySkMwTmlIMjNHUVVVSEhUbS9XczNzSDJGaFRuWT0=';

  public function __construct(&$session)
  {
    $this->session = &$session;
  }

  public function getRequestAppAuthUrl()
  {
    $challenge_code = getChallengeCode();
    if ($challenge_code == null) {
      return null;
    }
    $challenge_code_encoded = urlencode($challenge_code);
    $recruiter_app_id_encoded = urlencode(self::RECRUITER_APP_ID);
    return "/auth/recruiter-app?recruiter_app_id=".$recruiter_app_id_encoded."&challenge_code=".$challenge_code_encoded;
  }

  private function getChallengeCode() {
    $url = self::TALENTECA_BASE_URL."/api/v1/oauth/recruiter/challenge-code";
    $data = [
      'app_id' => self::RECRUITER_APP_ID,
      'app_secret' => self::RECRUITER_APP_SECRET
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
        return $challenge_code;
      }
    }    
    $error_message = "Unable to request authentication: ".$response;
    $this->session['error_message'] = $error_message;
    return null;
  }

}
