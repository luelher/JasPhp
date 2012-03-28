<?php

namespace JasPhp;

use Silex\Application;
use Silex\ServiceProviderInterface;

require_once('../lib/db/adodb/adodb.inc.php');
require_once("../lib/yaml/Yaml.class.php");

class ConnectionServiceProvider implements ServiceProviderInterface {

  var $conn = "";
  var $dsn;

  public function register(Application $app){
    $app['connection.connect'] = $app->protect(function ($driver, $server, $user, $pws, $port, $sid, $debug=false) use ($app) {
      if ($driver == 'mysql') {
        $app['connection.conn'] = ADONewConnection($driver); //Conexion con MySQL
        $app['connection.conn']->PConnect($server, $user, $pws, $sid);
      } else if ($driver == 'postgres') {
        $app['connection.dsn'] = $driver . '://' . $user . ':' . $pws . '@' . $server . ':' . $port . '/' . $sid . '?persist'; //Conexion con PostgreSQL
        $app['connection.conn'] = ADONewConnection($app['connection.dsn']); //Conexion con PostgreSQL
      } else if ($driver == 'oci8') {
        $app['connection.conn'] = ADONewConnection($driver); //Conexion con Oracle
        $app['connection.conn']->Connect($server, $user, $pws, $sid);
      } else if ($driver == 'sqlite3') {
        $app['connection.dsn'] = $driver . '://' . $sid . '?persist'; //Conexion con Sqlite3
        $app['connection.conn'] = ADONewConnection($app['connection.dsn']); //Conexion con Sqlite3
      }

      if($debug) $app['connection.conn']->debug=true;

      return $app['connection.conn'];
    });

    $app['connection.close_connection'] = $app->protect(function () use ($app) {
      $app['connection.conn']->Close();
    });

  }

}

?>