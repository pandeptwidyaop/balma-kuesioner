<?php
/**
 * Class Route
 */


namespace core;

class Route
{

  private $controller;
  private $action;
  private $urlParams;

  private $Controller_Namespace = "\\controllers\\";
  private $Base_Controller_Name = "core\\BaseController";

  public function __construct($urlParams) {
      include __DIR__."/../config/config.php";
      $this->urlParams = $urlParams;

      if (empty($this->urlParams["controller"])) {
          $this->controller = $this->Controller_Namespace . $config['main_controller'];
      } else {
          $this->controller = $this->Controller_Namespace . $this->urlParams["controller"];
      }

      if (empty($this->urlParams["action"])) {
          $this->action = "index";
      } else {
          $this->action = $this->urlParams["action"];
      }

  }

  public function getController() {
    if (class_exists($this->controller)) {
      $parent = class_parents($this->controller);
      if (in_array($this->Base_Controller_Name, $parent)) {
        if (method_exists($this->controller,$this->action)) {
          return new $this->controller($this->action,$this->urlParams); //fungsi untk membuat class sesuai routing
        }else {
          echo "ERROR METHOD NOT EXIST";
        }
      }else {
        echo "ERROR CLASS NOT EXIST";
      }
    }else {
      echo "PAGE NOT FOUND";
    }
  }


}
