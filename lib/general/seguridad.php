<?php

function conCredencial($credenciales, $modulo, $permiso) {

  if ($modulo != '') {
    if (is_array($credenciales)) {
      foreach ($credenciales as $cred) {
        foreach ($permiso as $per) {

          if (strtolower($cred) == strtolower($modulo) . '_' . $per ||
                  strtolower($cred) == 'admin' ||
                  'anueli' . strtolower($cred) == strtolower($modulo) . '_' . $per ||
                  'anular' . strtolower($cred) == strtolower($modulo) . '_' . $per ||
                  'anu' . strtolower($cred) == strtolower($modulo) . '_' . $per ||
                  'apr' . strtolower($cred) == strtolower($modulo) . '_' . $per ||
                  'pdf' . strtolower($cred) == strtolower($modulo) . '_' . $per ||
                  'r' . strtolower($cred) == strtolower($modulo) . '_' . $per ||
                  'catalogoobj.php' == strtolower($modulo) ||
                  'catalogoform.php' == strtolower($modulo) ||
                  'Catalogo.php' == ucfirst($modulo) ||
                  'imec' . strtolower($cred) == strtolower($modulo) . '_' . $per
          )
            return true;
        }
      }
      return false;
    }else
      return false;
  }else
    return false;
}

function validar($permiso = array(8, 11, 15), $app='', $modulo='') {

  $script = $_SERVER['SCRIPT_NAME'];
  //print $script;
  $script = split('/', $script);
  if ($app == ''){
    $app = strtolower($script[(count($script) - 1)]);
    if($app=='r.php'){
      $app = H::GetPost('r');
    }
//    elseif($app=='catalogoobj.php' || $app=='catalogoform.php'){
//      $app = 'catalogo';
//    }

  }
    
  if ($modulo == '')
    $modulo = strtolower($script[(count($script) - 2)]);

  $credenciales = $_SESSION['symfony/user/sfUser/credentials'];
  $env = $_SESSION['environment'];
  if ($env != 'dev')
    $env = ''; else
    $env='_' . $env;

  if (!empty($_SESSION["sesion_usuario"])):
    $sesion_usuario = $_SESSION["sesion_usuario"];
  else:
    $sesion_usuario = 0;
  endif;

  if ((session_id() == $sesion_usuario) and (!empty($_SESSION["x"]))):

    if (!conCredencial($credenciales, $modulo, $permiso) && !conCredencial($credenciales, $app, $permiso)):
      ?>
    <script language="javascript1.1" type="text/javascript">
        location=("http://"+window.location.host+"/autenticacion<?php echo $env; ?>.php/generales/nocredentials");
      </script>
    <?
      return false;
    endif;

  else:
?>
    <script language="javascript1.1" type="text/javascript">
      alert("Acceso Denegado")
      //location=("../../login.php")
      location=("http://"+window.location.host+"/autenticacion<?php echo $env; ?>.php/login");
    </script>
<?
    return false;
  endif;

  return true;
}
//print "ddd";exit;
validar(array(8, 11, 15));
?>
