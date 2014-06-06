<?php
namespace JasPhp;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use JasPhp;

class ReportsControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = new ControllerCollection();

        $controllers->post('/ajax/{action}', function (Application $app, $action) {
          $request = $app['request'];

          $filters = $request->get('ajax');

          if($action=='filter'){

            $parameter_form = new \JasPhp\ParameterForm($filters['module'], $filters['report'], $app);

            $parameter_form->parseYml();

            $filters = $parameter_form->getFilters($filters['index']);

            return $app['twig']->render('ajax_filter.html', array(
              'filters' => $filters,
            ));

          }elseif($action=='grid'){

            $filters = $request->get('ajax');
            $search = $request->get('search');

            $parameter_form = new \JasPhp\ParameterForm($filters['module'], $filters['report'], $app);

            $parameter_form->parseYml();

            $index = $filters['index'];
            $page = isset($filters['page']) ? $filters['page'] : '1';

            $rs = $parameter_form->getPager($index,5,$page, $last_page);
            if(count($rs)>0){
              if($page>$last_page) $page=$last_page;

              return $app['twig']->render('ajax_grid.html', array(
                'rs' => $rs,
                'obj' => $filters['obj'],
                  'index' => $index,
                  'report' => $filters['report'],
                  'module' => $filters['module'],
                  'page' => $page,
                  'last_page' => $last_page
              ));

            }else{
              return "<h2>Sin Datos</h2>";
            }
          }else{
            return null;
          }

          $java = new \JasPhp\Jasper();

          return 'Hola Mundo';

        });


        $controllers->get('/{module}/{report}', function (Application $app, $module, $report) {

          $parameter_form = new \JasPhp\ParameterForm($module, $report, $app);

          $parameter_form->parseYml();

          $fmt = new \IntlDateFormatter($app['config']['locale'], \IntlDateFormatter::FULL, \IntlDateFormatter::NONE, $app['config']['timezone'], \IntlDateFormatter::GREGORIAN);

          $user = isset($_SESSION["user"]) ? $_SESSION["user"] : 'No Autenticated User';

          return $app['twig']->render('main_parameter_form.html', array(
            'main' => true,
            'report' => $report,
            'module' => $module,
            'fmt' => $fmt->format(strtotime(date('Y-m-d'))),
            'user' => $user,
            'form' => $parameter_form,
          ));

        });

        $controllers->post('/{module}/{report}', function (Application $app, $module, $report) {

          $request = $app['request'];

          $filters = $request->get('filters');

          $java = new \JasPhp\Jasper();
          $params = $java->readParameters($filters);
          $jasper_report = $java->makeJasperReport($module, $report, $params);

          $generatxt='N';
          $info = implode(', ',$jasper_report);
          $url = "reports/$module/$report";

          if(is_array($jasper_report)){

            $file = "";
            if(isset($jasper_report[0]))
              if(file_exists($jasper_report[0])) $file=$jasper_report[0];
            if(isset($jasper_report[1]))
              if(file_exists($jasper_report[1])) $file=$jasper_report[1];

            $aux = explode("/",$file);
            $filepdf = $aux[count($aux)-1];

            if(file_exists($file))
            {
                $tam = filesize($file);

                $stream = function () use ($file) {
                    readfile($file);
                };

                return $app->stream($stream, 200, array(
                    'Content-Type' => 'application/force-download',
                    'Content-Disposition' => 'inline; filename=reportePDF.pdf',
                    ));
            }else
            {
              return $app['twig']->render('report_message.html', array(
                'message' => $info,
                'url' => $url,
              ));
            }
          }else{
            return $app['twig']->render('report_message.html', array(
              'message' => $info,
              'url' => $url,
            ));
          }
          return null;
        });
        return $controllers;
    }

}
?>
