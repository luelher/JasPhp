<?php
namespace JasPhp;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use JasPhp;

class MenuControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = new ControllerCollection();

        $controllers->get('/', function (Application $app) {
            return $app->redirect('/index.php/menu');
        });

        $controllers->get('/menu', function (Application $app) {


          $menu = new Menu();
          $menu->parseYml();

          return $app['twig']->render('main_menu.html', array(
            'main' => true,
            'modules' => $menu->getMainMenu(),
            'module_name' => '',
            'menu' => '',
          ));

        });

        $controllers->get('/menu/{module}', function (Application $app, $module) {

          $menu = new Menu();
          $menu->parseYml();

          return $app['twig']->render('main_menu.html', array(
            'main' => false,
            'modules' => '',
            'module' => $module,
            'module_name' => $menu->getModuleName($module),
            'menu' => $menu->getDetailMenu($module),
          ));

        });

        return $controllers;
    }

}
?>
