<?php
/**
 * Class Controller
 * @Author PROGRESS
 */
namespace controllers;

use core\BaseController;
use core\Libraries;
use core\Database;

class Main extends BaseController
{

  protected $participant;
  protected $lib;

  /**
   * method __construct($class,$action)
   * untuk memhami alur constructor ini silakan buka core/Route;
   * pastikan parent constructornya juga memilik 2 variable parent::__construct($a,$b)
   */

  function __construct($a,$b)
  {
    parent::__construct($a,$b);
    $this->lib = new Libraries;
    $this->participant = new Database('participant',array('nim','ip_address'),'nim');
  }

  public function index()
  {
    $d = $this->participant->all();
    $this->view('front',$d);
  }

  public function store()
  {
    if (!empty($this->input()->post)) {
      $data = $this->input()->post();
      $this->participant->insert(array($data['nim'],$data['ip']));
      return redirect(base_url());
    }else {
      echo 'kosong';
    }
  }
}
