<?php require_once("../lib/yaml/Yaml.class.php"); ?>

<?php

$locale = 'es_VE';
$timezone = 'America/Caracas';


$config = Yaml::load("../config/config.yml");

if(count($config)>0){
  $locale = isset($config['jasphp']['locale']) ? $config['jasphp']['locale'] : 'es_VE';
  $timezone = isset($config['jasphp']['timezone']) ? $config['jasphp']['timezone'] : 'America/Caracas';
}

?>
