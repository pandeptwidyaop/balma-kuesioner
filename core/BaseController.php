<?php
/**
 *
 */

namespace core;

class BaseController
{

  protected $view;
  protected $post;
  protected $get;
  protected $urlParams;
  protected $action;

  function __construct($action,$urlParams)
  {
    $this->action = $action;
    $this->urlParams = $urlParams;

  }

  protected function view($view,$var="")
  {
    $data = $var;
    include(__DIR__.'/../views/'.$view.'.php');
  }

  public function ExecuteAction() {
      include __DIR__.'/Helper.php';
      return $this->{$this->action}();
  }


  protected function input()
  {
    if (isset($_POST)) {
      $this->post = $_POST;
    }
    if (isset($_GET)) {
      $this->get = $_GET;
    }
    return $this;
  }

  protected function post($p="")
  {
    return ($p=="") ? $this->post : $this->post[$p];
  }

  protected function get($g="")
  {
    return ($g=="") ? $this->get : $this->get[$g];
  }
}
