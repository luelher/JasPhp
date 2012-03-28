<?php
namespace JasPhp;

use JasPhp;

class MenuItem {
  var $module;
  var $name;
  var $report;
}

class Menu{

  var $yml;
  var $menu;
  var $menu_array;
  var $main_menu;
  var $detail_menu;

  public function  __construct()
  {
    $this->yml = __DIR__.'/../../config/menu/reports.yml';
  }

  public function parseYml()
  {
    $this->menu_array = Yaml::load($this->yml);

    $modules=array();
    if(isset($this->menu_array['modules'])){
      $modules = $this->menu_array['modules'];
      $this->main_menu = array();
      $this->detail_menu = array();

      foreach($modules as $index => $module){
        $item = new MenuItem();
        $item->module = $module;
        $item->name = $index;
        $this->main_menu[] = $item;

        $detail=array();
        if(isset($this->menu_array[$module])){
          $detail = $this->menu_array[$module];
          foreach($detail as $i => $m){
            $item = new MenuItem();
            $item->module = $module;
            $item->name = $i;
            $item->report = $m;
            $this->detail_menu[] = $item;
          }
        }
      }
    }
  }

  public function getMainMenu()
  {
    return $this->main_menu;
  }

  public function getDetailMenu($module)
  {
    $result = array();
    foreach($this->detail_menu as $det)
    {
      if($det->module==$module) $result[] = $det;
    }
    return $result;
  }

  public function getModuleName($mod)
  {
    foreach($this->main_menu as $module){
      if($module->module==$mod) return $module->name;
    }
    return '';    
  }

}
?>
