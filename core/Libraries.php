<?php

/**
 * @Author PROGRESS
 */

namespace core;

class Libraries
{

  function __construct()
  {
    session_start();
  }

  public function session_get($name)
  {
      if (isset($_SESSION[$name]) && !empty($_SESSION[$name])) {
        return $_SESSION[$name];
      }else {
        return "";
      }
  }

  public function session_set($ses_name,$ses_content)
  {
      $_SESSION[$ses_name] = $ses_content;
      if (isset($_SESSION[$ses_name]) && !empty($_SESSION[$ses_name])) {
        return true;
      }else {
        return false;
      }
  }

}
