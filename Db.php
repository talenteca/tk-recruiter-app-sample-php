<?php

class Db {

  public function __construct(&$session)
  {
    $this->session = &$session;
    if (!isset($this->session['user_ids_by_challenge_code']))
    {
      $this->session['user_ids_by_challenge_code'] = [];
    }
    if (!isset($this->session['talenteca_recruiters_ids_by_challenge_code']))
    {
      $this->session['talenteca_recruiters_ids_by_challenge_code'] = [];
    }
    if (!isset($this->session['access_tokens_by_user_id']))
    {
      $this->session['access_tokens_by_user_id'] = [];
    }
  }

  public function recordUserIdForChallengeCode($challenge_code, $user_id)
  {
    $this->session['user_ids_by_challenge_code'][$challenge_code] = $user_id;
  }

  public function recordTalentecaRecruiterIdForChallengeCode($challenge_code, $talenteca_recruiter_id)
  {
    $this->session['talenteca_recruiters_ids_by_challenge_code'][$challenge_code] = $talenteca_recruiter_id;
  }

  public function recordAccessTokenForUserId($user_id, $access_token)
  {
    $this->session['access_tokens_by_user_id'][$user_id] = $access_token;
  }

  public function getUserIdForChallengeCode($challenge_code)
  {
    if (!isset($this->session['user_ids_by_challenge_code'][$challenge_code]))
    {
      return null;
    }
    return $this->session['user_ids_by_challenge_code'][$challenge_code];
  }

  public function getTalentecaRecruiterIdForChallengeCode($challenge_code)
  {
    if (!isset($this->session['talenteca_recruiters_ids_by_challenge_code'][$challenge_code]))
    {
      return null;
    }
    return $this->session['talenteca_recruiters_ids_by_challenge_code'][$challenge_code];
  }

  public function getAccessTokenForUserId($user_id)
  {
    if (!isset($this->session['access_tokens_by_user_id'][$user_id]))
    {
      return null;
    }
    return $this->session['access_tokens_by_user_id'][$user_id];
  }

}
