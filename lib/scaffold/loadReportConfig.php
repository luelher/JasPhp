<?php

require_once("../lib/yaml/Yaml.class.php");
include_once("../lib/scaffold/headhtml.php");
$report_arch = '../reports/' . $modulo . '/' . $reporte . ".yml";
if(file_exists($report_arch)){
  $opciones = Yaml::load($report_arch);
  $modulo = $opciones["Params"]["module"];

  /* * ***VARIABLES FIJAS PARA EL REPORTE VIENEN DEL YML***************** */
  $bd = new Database();

  $nomrep = $opciones["Params"]["name"];
  $con = $bd;
  $width = $opciones["Params"]["width"];
  $titulo = $opciones["Params"]["title"];
  $orientacion = $opciones["Params"]["orientation"];
  $tipopagina = $opciones["Params"]["page"];
  $txt = isset($opciones["Params"]["txt"]) ? $opciones["Params"]["txt"] : '';
  $descripcion = isset($opciones["Params"]["description"]) ? $opciones["Params"]["description"] : '';
}else{
  $opciones = null;
}

?>