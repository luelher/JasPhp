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

        $controllers->get('/{module}/{report}', function (Application $app, $module, $report) {

          $parameter_form = new \JasPhp\ParameterForm($module, $report, $app);

          $parameter_form->parseYml();

          $fmt = new \IntlDateFormatter($locale, \IntlDateFormatter::FULL, \IntlDateFormatter::NONE, $timezone, \IntlDateFormatter::GREGORIAN);

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

          //$header = $app['headers'];

          //print '<pre>';
          //print_r($request['headers']);exit;

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
