<?php

namespace JasPhp;

use JasPhp;

Class Jasper {

  public static function makeJasperReport($module, $report, $parameters) {
    //print "java -jar ../lib/java/jasphp.jar $module $report $parameters";exit;
    exec("java -jar ../lib/java/dist/jasphp.jar $module $report $parameters", $return);
    //print_r($return);exit;
    return $return;
  }

  public static function readParameters($filters) {
    $arrparam = array();
    foreach ($filters as $param => $val) {
      $arrparam[] = $param;
      $arrparam[] = $val;
    }
    $parametros = '"' . implode('" "', $arrparam) . '"';
    return $parametros;
  }

}

?>
