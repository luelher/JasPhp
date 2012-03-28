<?php
require_once __DIR__.'/../lib/silex/silex.phar';

$app = new Silex\Application();
$app['debug'] = true;
$app['autoloader']->registerNamespace( 'JasPhp', __DIR__.'/../lib');

$app->register(new JasPhp\ConnectionServiceProvider());
$app->register(new JasPhp\DatabaseServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__.'/../templates',
    'twig.class_path' => __DIR__.'/../lib/twig/lib',
));

$app->mount('/', new JasPhp\MenuControllerProvider());

$app->mount('/reports', new JasPhp\ReportsControllerProvider());

$app->run();
?>
