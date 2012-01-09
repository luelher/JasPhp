<?php
require_once("../lib/yaml/Yaml.class.php");
$rutabase = implode("/",explode("/",$_SERVER['SCRIPT_FILENAME'],-2));
require_once '../lib/general/Jasper.class.php';

$r=$reporte;
$m=$modulo;
$opciones = Yaml::load("../reports/$modulo/$reporte.yml");
$generatxt=isset($opciones["Parametros"]["generatxt"]) ? $opciones["Parametros"]["generatxt"] : '';

$return = J::CargarReportesenJasper($r,$m);
if(is_array($return))
{
    $file = "";
    if(isset($return[0]))
      if(file_exists($return[0])) $file=$return[0];
    if(isset($return[1]))
      if(file_exists($return[1])) $file=$return[1];

    $aux = explode("/",$file);
    $filepdf = $aux[count($aux)-1];

    if(file_exists($file))
    {
        $tam = filesize($file);
        header("Content-Length: $tam");
        
        if($generatxt=='S'){
          header ("Content-Disposition: attachment; filename=reporte.txt;" );
          header ("Content-Type: application/force-download");            
        }
        else{
          header("Content-type: application/pdf");
          header("Content-Disposition: inline; filename=reportePDF.pdf");
        }
        readfile($file);
        unlink($file);
    }else
    {?>
       <script>
          alert("Archivo de Reporte no Generado. (<?php echo implode(', ',$return) ?>)");
          location="/index.php/<?php echo $m."/".$r ?>";
       </script>
    <?php }
}else
    {?>
       <script>
          alert("Archivo de Reporte no Generado. (<?php echo implode(', ',$return) ?>)");
          location="/index.php/<?php echo $m."/".$r ?>";
       </script>
    <?php }


?>
