<?php

/**
 * Class Database hanya untuk SQLSERVER dan ODBC
 * @Author PROGRESS
 */

namespace core;

class Database
{
  protected $primarykey;
  protected $table;
  protected $column;
  protected $connection;
  protected $result;
  protected $row;
  protected $rows = array();
  protected $count;

  function __construct($table,$col,$pm)
  {
    include(__DIR__.'/../config/database.php');
    $this->connection = $this->connect($db['server'],$db['user'],$db['pass']) or die(odbc_errormsg());
    $this->table = $table;
    $this->column = $col;
    $this->primarykey = $pm;
  }

  private function connect($server,$username,$password)
  {
      $db =  odbc_connect($server,$username,$password);
      if(!$db){
        echo "Gagal Mengkoneksikan ke Database";
      }else {
        return $db;
      }
  }

  public function fill($col)
  {
    $this->column = $col;
    return $this;
  }

  public function query($query)
  {
      $this->result = odbc_exec($this->connection,$query);
      return $this;
  }

  public function getObject()
  {
    while($row = odbc_fetch_array($this->result)){
      $this->rows[] = (object) $row;
    }
    return (object) $this->rows;
  }

  public function find($primary_key)
  {
      $this->result = odbc_exec($this->connection,"SELECT * FROM ".$this->table." WHERE ".$this->primarykey." = ".$primary_key);
      if (odbc_num_rows($this->result) == 1) {
        return true;
      }else {
        return false;
      }
  }

  public function all()
  {
    $this->result = odbc_exec($this->connection,"SELECT * FROM ".$this->table);
    while ($row = odbc_fetch_array($this->result)) {
      $this->rows[] = (object) $row;
    }
    return (object) $this->rows;
  }

  public function get()
  {
    while($row = odbc_fetch_array($this->result)){
      $this->rows[] = $row;
    }
    return $this->rows;
  }

  public function count()
  {
      $this->count = odbc_num_rows($this->result);
      return $this->count;
  }

  public function where($col,$logic="",$var=""){
    $this->result = odbc_exec($this->connection,"SELECT * FROM ".$this->table." WHERE ".$col.$logic.$var);
    return $this;
  }

  public function insert($data)
  {
    $this->result = odbc_exec($this->connection,'INSERT INTO '.$this->table.'('.implode(',',$this->column).") VALUES ('".implode("','",$data)."')");
    return $this;
  }

  public function insertMass($data)
  {
    $values = array();
      foreach ( $data as $rowValues) {
        foreach ($rowValues as $key => $rowValue) {
             $rowValues[$key] = "'".($rowValues[$key])."'";
        }

        $values[] = "(" . implode(', ', $rowValues) . ")";
      }
    $this->result =  odbc_exec($this->connection,"INSERT INTO ".$this->table."(".implode(',',$this->column).") VALUES ". implode (', ', $values));
    return $this;
  }



}
