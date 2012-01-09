<?php

require_once("../lib/yaml/Yaml.class.php");
$opciones = Yaml::load('../reports/' . $modulo . '/' . $reporte . ".yml");
$modulo = $opciones["Parametros"]["modulo"];

include_once("../lib/scaffold/headhtml.php");

/* * ***VARIABLES FIJAS PARA EL REPORTE VIENEN DEL YML***************** */
$bd = new Database();

$nomrep = $opciones["Parametros"]["nomrep"];
$con = $bd;
$width = $opciones["Parametros"]["width"];
$titulo = $opciones["Parametros"]["titulo"];
$orientacion = $opciones["Parametros"]["orientacion"];
$tipopagina = $opciones["Parametros"]["tipopagina"];
$txt = isset($opciones["Parametros"]["txt"]) ? $opciones["Parametros"]["txt"] : '';

?>