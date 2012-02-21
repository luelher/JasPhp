<?php require_once("../lib/yaml/Yaml.class.php"); ?>
<?php require_once("../lib/general/Route.class.php"); ?>
<?php require_once("../lib/general/Herramientas.class.php"); ?>
<?php require_once("../lib/general/config.php"); ?>
<?php require_once("../lib/Menu.class.php"); ?>
<?php require_once '../lib/twig/lib/Twig/Autoloader.php'; ?>

<?php $router = new Router();  ?>
<?php $router->default_routes();  ?>
<?php $router->execute();  ?>

<?php if(!$router->route_found) : ?>

  <?php Twig_Autoloader::register(); ?>

  <?php

    $options = new Menu();

    $loader = new Twig_Loader_Filesystem('../templates');
    $twig = new Twig_Environment($loader, array(
      'cache' => '../cache',
    ));

    echo $twig->render('menu.html', array('name' => 'Fabien'));

  ?>

<?php else: ?>
<?php

	$modulo=$router->controller;
	$reporte=$router->action;
  
?>
<?php if($_SERVER['REQUEST_METHOD']=='GET') : ?>
  <?php if($modulo=='ajax') : ?>
    <?php if($reporte=='grid') : ?>
      <?php $modulo=H::GetPost('module'); $reporte=H::GetPost('report'); $index=H::GetPost('index'); ?>
      <?php include_once '../lib/general/ajaxGrid.php'; ?>
    <?php elseif($reporte=='filter') : // If Grid ?>
      <?php $modulo=H::GetPost('module'); $reporte=H::GetPost('report'); $index=H::GetPost('index'); ?>
      <?php include_once '../lib/general/ajaxFilter.php'; ?>
    <?php else: // If Grid ?>
      <?php include_once '../lib/scaffold/parameterForm.php'; ?>
    <?php endif; // If Grid ?>
  <?php else: // If Ajax ?>
  <?php include_once '../lib/scaffold/parameterForm.php'; ?>
  <?php endif; // If Ajax ?>
<?php else: // Request_Method = Post ?>
  <?php require_once '../lib/jasphp/jasper.php'; ?>
<?php endif; // Request_Method ?>
<?php endif; ?>