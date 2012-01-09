<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class Jasper{
    
    function Jasper() {
  }
  
  public static function GetPost($variable)
  {
    if (isset($_POST[$variable])){
      return trim($_POST[$variable]);
    }
    elseif(isset($_GET[$variable]))
    {
      return trim($_GET[$variable]);
    }else return "";
  }
  
  public static function CargarReportesenJasper($modulo, $reporte)
  {
        //$schema=J::GetPost('s');
        $parametros = J::LecturaParametros();
        print "java -jar ../lib/java/reportesjasper.jar $modulo $reporte $parametros";exit;
        //exec("java -jar ../lib/java/reportesjasper.jar $schema $modulo $reporte $parametros",$return);
        //print_r($return);
        return $return;
  }
  
  public static function LecturaParametros()
  {
    $arrparam = array();
    foreach ($_POST as $param => $val){
      $arrparam[] = $param;
      $arrparam[] = $val;
    }
    $parametros = '"'.implode('" "',$arrparam).'"';
    return $parametros;
  }
  
} 


class J extends Jasper
{

}
?>
