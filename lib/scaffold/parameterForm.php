<?php require_once("../lib/scaffold/loadReportConfig.php"); ?>
<?php if ($opciones != null) : ?>

<?php $fmt = new IntlDateFormatter($locale, IntlDateFormatter::FULL, IntlDateFormatter::NONE, $timezone, IntlDateFormatter::GREGORIAN); ?>

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
        <h1><?php echo strtoupper($titulo) ?> <small><?php echo isset($subtitulo) ? $subtitulo : '' ?></small></h1>
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
            /*             * ***********VARIABLES DEL CICLO VIENEN DEL YML************* */
            if (isset($opciones["Rows"]) && count($opciones["Rows"]) > 0) {
              foreach ($opciones["Rows"] as $name => $opc) {
                $label = $opc["label"]; //"ETIQUETA";
                $sql = isset($opc["sql"]) ? $opc["sql"] : ''; //"SELECT min(codnom) as codnommin,max(codnom) as codnommax FROM npnomina";
                $sqlcat = isset($opc["sqlcat"]) ? $opc["sqlcat"] : '';

                $nomdes = $opc["name_from"]; //"pruebades";
                $campodes = $opc["field_from"]; //"codnommin";
                $catdes = isset($opc["catdes"]) ? $opc["catdes"] : ''; // unused;
                $nomhas = isset($opc["name_to"]) ? $opc["name_to"] : null; //"pruebahas";
                $campohas = isset($opc["field_to"]) ? $opc["field_to"] : null; //"codnommax";
                $cathas = isset($opc["cathas"]) ? $opc["cathas"] : ''; // unused;
                $nomcat = isset($opc["nomcat"]) ? $opc["nomcat"] : null; // unused;
                $tipotag = $opc["type"]; //'inputcat_tag';
                $size = isset($opc["size"]) ? $opc["size"] : '';
                $Params = isset($opc["Params"]) ? $opc["Params"] : '';

                if (is_null($nomhas))// || is_null($campohas))
                  $arrcajtex = array($nomdes, $campodes, $catdes);
                else
                  $arrcajtex = array($nomdes, $campodes, $catdes, $nomhas, $campohas, $cathas);

                $param = array($nomrep, $con, $label, $sql);
                $op = array($size, $width, $modulo);

                echo $tipotag($param, $arrcajtex, $op, $Params, $name);
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
<?php $bd->closed(); ?>
</html>
<?php else: ?>
<?php header("HTTP/1.0 404 Not Found", true, 404); ?>
              <div class="topbar">
                <div class="fill">
                  <div class="container">
                    <a class="brand" href="#">JasPhp</a>

                    <!--          <ul class="nav">
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="#contact">Contact</a></li>
                              </ul>
                              <form action="" class="pull-right">
                                <input class="input-small" type="text" placeholder="Username">

                                <input class="input-small" type="password" placeholder="Password">
                                <button class="btn" type="submit">Sign in</button>
                              </form>-->
                  </div>
                </div>
              </div>

              <div class="container">

                <div class="content">
                  <div class="page-header">
                    <h1>Error 404 <small>the report does not exist.</small></h1>
                  </div>
                  <div class="row">
                    <div class="span14">

                      <div title="Half and half" class="row show-grid">
                        <div class="span4">
                          <ul class="media-grid">
                            <li>
                              <a href="#">
                                <img alt="" src="/img/Yoda_cartoon.jpg" class="thumbnail">
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="span10">
                          <h1>Occured, a 404 error has ...</h1>
                          <h2>Lost a page I have. How embarrassing ...</h2>
                          mer              <h5> The dark side I sense in you. Due to a disturbance in the force I couldn't find the page you were looking for.</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <footer>
                  <p>© Luelher 2011 - luelher [arroba] gmail dot com - [arroba] luelher </p>
                </footer>
              </div> <!-- /container -->

              </body>
              </html>
<?php endif; ?>