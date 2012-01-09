<?php

//error_reporting(E_ERROR | E_PARSE);
//session_name();
session_start();

//require_once("../../lib/general/seguridad.php");

require_once('../lib/db/adodb/adodb.inc.php');
require_once("../lib/db/Connection.class.php");
require_once("../lib/yaml/Yaml.class.php");

class Database {

  private $conn;
  private $bd;
  public $schema;

  function Database() {
    $this->bd = new Connection();
    $opciones = Yaml::load("../config/databases.yml");

    $confbd = $opciones['database']['name'];

    $driver = $opciones[$confbd]['driver'];
    $hostname = $opciones[$confbd]['host'];
    $user = $opciones[$confbd]['usuario'];
    $password = $opciones[$confbd]['password'];
    $dbname = $opciones[$confbd]['bd'];
    $port = isset($opciones[$confbd]['port']) ? $opciones[$confbd]['port'] : '';
    $debug = isset($opciones[$confbd]['debug']) ? $opciones[$confbd]['debug'] : false;

    $this->conn = $this->bd->connect($driver, $hostname, $user, $password, $port, $dbname,$debug);
  }

  function execute($sql, $FetchMode = ADODB_FETCH_DEFAULT) {
    $this->conn->SetFetchMode($FetchMode);
    $rs = $this->conn->Execute($sql);
    if ($rs) {
      return $rs->GetArray();
    } else {
      return array();
    }
    return $rs;
  }

  function executePager($sql, $rows, $page, &$last_page = array(), $FetchMode = ADODB_FETCH_DEFAULT) {
    $this->conn->SetFetchMode($FetchMode);
    $rs = $this->conn->PageExecute($sql, $rows, $page);
    if ($rs) {
      $last_page = $rs->LastPageNo();
      return $rs->GetArray();
    } else {
      return array();
    }
    return $rs;
  }

  function update($sql) {
    $this->conn->Execute($sql);
  }

  function closed() {
    $this->conn->Close();
  }

}

?>
