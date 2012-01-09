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
$descripcion = isset($opciones["Parametros"]["description"]) ? $opciones["Parametros"]["description"] : '';

?>

    <?php $fmt = new IntlDateFormatter( $locale ,IntlDateFormatter::FULL,IntlDateFormatter::NONE,$timezone,IntlDateFormatter::GREGORIAN); ?>


    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="#">JasPhp</a>
          <div class="loggin"><span> User: </span><?php echo isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : 'Sin Usuario Autenticado'; ?></div>
          <div class="loggin"><span> Module: </span><?php echo $modulo; ?></div>
          <div class="loggin-right "><?php echo $fmt->format(strtotime(date('Y-m-d'))); ?></div>
        </div>
      </div>
    </div>

    <div class="container">
        <div class="content">
          <div class="page-header">
            <h1><?php echo strtoupper($titulo)?> <small><?php echo isset($subtitulo) ? $subtitulo : '' ?></small></h1>
          </div>
          <div class="row">
            <div class="span11">
              <h2>Criteria of Selections</h2>
              <div class="row show-grid"><br> </div>
              <form name="parameterform" method="post" action="">
                  <div class="row show-grid">
                    <label for="lInput"></label>
                    <div class="span4"><label for="lInput">From</label></div>
                    <div class="span4"><label for="lInput">To</label></div>
                  </div>

                <fieldset>
                <?php

                //CAJA CON CATALOGO
                /* * ***********VARIABLES DEL CICLO VIENEN DEL YML************* */
                //param
                if (isset($opciones["Filas"]) && count($opciones["Filas"]) > 0) {
                  foreach ($opciones["Filas"] as $name => $opc) {
                    $label = $opc["label"]; //"PRUEBA ETIQUETA";
                    $sql = isset($opc["sql"]) ? $opc["sql"] : ''; //"SELECT min(codnom) as codnommin,max(codnom) as codnommax FROM npnomina";
                    $sqlcat = isset($opc["sqlcat"]) ? $opc["sqlcat"] : '';
                    
                    $nomdes = $opc["nomdes"]; //"pruebades";
                    $campodes = $opc["campodes"]; //"codnommin";
                    $catdes = isset($opc["catdes"]) ? $opc["catdes"] : '' ; //0;
                    $nomhas = isset($opc["nomhas"]) ? $opc["nomhas"] : null; //"pruebahas";
                    $campohas = isset($opc["campohas"]) ? $opc["campohas"] : null; //"codnommax";
                    $cathas = isset($opc["cathas"]) ? $opc["cathas"] : ''; //1;
                    $nomcat = isset($opc["nomcat"]) ? $opc["nomcat"] : null; //"codnom";
                    $tipotag = $opc["tipotag"]; //'inputcat_tag';
                    $size = isset($opc["size"]) ? $opc["size"] : '';
                    $parametros = isset($opc["parametros"]) ? $opc["parametros"] : '';

                    if (is_null($nomhas))// || is_null($campohas))
                      $arrcajtex = array($nomdes, $campodes, $catdes);
                    else
                      $arrcajtex = array($nomdes, $campodes, $catdes, $nomhas, $campohas, $cathas);

                    $param = array($nomrep, $con, $label, $sql);
                    $op = array($size, $width, $modulo);

                    echo $tipotag($param, $arrcajtex, $op, $parametros, $name);
                  }
                }
                ?>
                </fieldset>
              
              <div class="actions">
                <input type="submit" value="Build Report" class="btn primary">&nbsp;<button id="btn-reset" class="btn" type="reset">Reset</button>
              </div>
              </form>
            </div>
            <div class="span3">
              <h3>Info</h3>
              <h5>Page Type:</h5> <p><?php echo $tipopagina ?></p>
              <h5>Orientation: </h5> <p><?php echo $orientacion ?></p>
              <h5>Description: </h5> <p><?php echo isset($descripcion) ? $descripcion : 'no description' ?></p>
            </div>
          </div>
        </div>
      <footer>
        <p>© Luelher 2011 - luelher [arroba] gmail dot com - [arroba] luelher </p>
      </footer>

    </div> <!-- /container -->

    <div id="catalog" class="modal hide fade" style="display: none;" >
      <div class="modal-header">
        <a class="close" href="#">×</a>
        <h3>Search Catalog</h3>
      </div>
      <div class="modal-body">
        <h3>Catalog</h3>
        <ul data-tabs="my-tab-content" class="tabs">
          <li class="active"><a href="#grid">Details</a></li>
          <li class=""><a href="#filters">Search</a></li>
        </ul>
        <div class="tab-content" id="my-tab-content">
          <div id="grid" class="tab-pane active">

            <div id="grid-ajax">
              <div id="loader-grid" style="line-height: 115px; text-align: center;"><img alt="activity indicator" src="/img/loader.gif"></div>
            </div>

          </div>
          <div id="filters" class="tab-pane">
            <div id="filters-ajax">
              <div id="loader-filter" style="line-height: 115px; text-align: center;"><img alt="activity indicator" src="/img/loader.gif"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a id="close-catalog" class="btn danger close" href="#">Cerrar</a>
      </div>
    </div>
</body>
<?php $bd->closed();?>
</html>
