<?php

class Users {

  public function __construct(&$session)
  {
    $this->session = &$session;
  }

  public function getCurrentUser()
  {
    if (!isset($this->session['user'])) {
      return null;
    }
    return $this->session['user'];
  }

  public function recordUser(&$user)
  {
    $user['user_id'] = uniqid("user_id_");
    $this->session['user'] = $user;
  }

}
