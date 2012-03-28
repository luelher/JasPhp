<?php

namespace JasPhp;

use Silex\Application;
use Silex\ServiceProviderInterface;

require_once('../lib/db/adodb/adodb.inc.php');
require_once("../lib/yaml/Yaml.class.php");

class DatabaseServiceProvider implements ServiceProviderInterface {

  private $conn;
  public $schema;

  public function register(Application $app){

    $opciones = Yaml::load("../config/databases.yml");

    $confbd = $opciones['database']['name'];

    $driver = $opciones[$confbd]['driver'];
    $hostname = $opciones[$confbd]['host'];
    $user = $opciones[$confbd]['usuario'];
    $password = $opciones[$confbd]['password'];
    $dbname = $opciones[$confbd]['bd'];
    $port = isset($opciones[$confbd]['port']) ? $opciones[$confbd]['port'] : '';
    $debug = isset($opciones[$confbd]['debug']) ? $opciones[$confbd]['debug'] : false;

    $app['connection.conn'] = $app['connection.connect']($driver, $hostname, $user, $password, $port, $dbname,$debug);

    $app['database.execute'] =  $app->protect(function ($sql, $FetchMode = ADODB_FETCH_DEFAULT) use ($app) {
      $app['connection.conn']->SetFetchMode($FetchMode);
      $rs = $app['connection.conn']->Execute($sql);
      if ($rs) {
        return $rs->GetArray();
      } else {
        return array();
      }
      return $rs;
    });

    $app['database.page_execute'] =  $app->protect(function ($sql, $rows, $page, &$last_page = array(), $FetchMode = ADODB_FETCH_DEFAULT) use ($app) {
      $app['connection.conn']->SetFetchMode($FetchMode);
      $rs = $app['connection.conn']->PageExecute($sql, $rows, $page);
      if ($rs) {
        $last_page = $rs->LastPageNo();
        return $rs->GetArray();
      } else {
        return array();
      }
      return $rs;
    });

  }

  function update($sql) {
    $this->conn->Execute($sql);
  }

  function closed() {
    $this->conn->Close();
  }

}

?>
