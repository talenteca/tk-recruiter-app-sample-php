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
    return "tkrai:tk-recruiter-app-sample-sandbox:89425260059766841857197795291062";
  }

  public function getTestRecruiterAppSecret()
  {
    return "JGQyU1VyVXpzTzJGbURHWExMZFV1OFE9PSRiRzB4N1lCYlNCbkRyTmg3WmVCQS9HVGNhTHl0QzBEdUtFK29scGIzTXNJUFIrcUVsSDRLTno0a25GTTdNTUlNTFNuYzRhbVJWbDBjVzB3cVEvR29lTmZBUmU5Tzgya0NyR04xcDd3ODBsTk8wK0Y4RzlGcjVqS3l0N0ZRbDluYVFxajNzWWJTU3N2S254ajlOSDM1MGNZSnY2QW5zK3dqMTlmU21RemUydU5KUnFKNnI4emdaeTE0SVZPYmpJbnArbkYxdldVanJBaHc1WUZ5elBHc0pyS3hDcDFrOFBwUUhwSnR0Wk9JenpQb3VHY0xWYTdUdWJES0dvVHFzcmtmUlFhNnZqS0JQSTM1S1E1WVE5aXRvbzlsaXB0N2c2ZEk1TlFFWUVQZUdZbFl5UnQ1ZWN3ZlI1VkFuZlBvaXp5NmRQc2w5VFY4d2dNQStjM3JBVFp2RzU1aEpWa01QMXdwRis1UXdLSlVTcE9rdUlYT0FDajZKanlMUHdrbWxUQTN0dTZRbmpUbUU2OURNN05pc2ZicWY0NU52OVZRczZpQ1M0QnhYcllxSkhLbi9xR21aTlJTTHBjQ3ZEemtkcWE3dW4xWlljd1hubzFGZ2RySkMwTmlIMjNHUVVVSEhUbS9XczNzSDJGaFRuWT0=";
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
