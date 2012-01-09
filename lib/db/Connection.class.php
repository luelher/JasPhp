<?php

require_once('../lib/db/adodb/adodb.inc.php');

class Connection {

  var $conn;
  var $dsn;

  function Connection() {
    $this->conn = "";
  }

  function connect($driver, $server, $user, $pws, $port, $sid, $debug=false) {
    if ($driver == 'mysql') {
      $this->conn = ADONewConnection($driver); //Conexion con MySQL
      $this->conn->PConnect($server, $user, $pws, $sid);
    } else if ($driver == 'postgres') {
      $this->dsn = $driver . '://' . $user . ':' . $pws . '@' . $server . ':' . $port . '/' . $sid . '?persist'; //Conexion con PostgreSQL
      $this->conn = ADONewConnection($this->dsn); //Conexion con PostgreSQL
      //$this->conn->PConnect($server,$user,$pws,$sid);
    } else if ($driver == 'oci8') {
      $this->conn = ADONewConnection($driver); //Conexion con Oracle
      $this->conn->Connect($server, $user, $pws, $sid);
    } else if ($driver == 'sqlite3') {
      $this->dsn = $driver . '://' . $sid . '?persist'; //Conexion con Sqlite3
      $this->conn = ADONewConnection($this->dsn); //Conexion con Sqlite3
      //$this->conn->PConnect($sid);
    }

    if($debug) $this->conn->debug=true;

    return $this->conn;
  }

  function closeConnection() {
    $this->conn->Close();
  }

}

?>