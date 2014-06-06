<?php

namespace JasPhp;

class ParameterForm implements \Iterator {

  private $position = 0;
  private $array = array();
  private $report = '';
  private $module = '';
  private $yml = '';
  private $rows = array();
  private $options = array();
  private $app = null;

  public function getName()
  {
    return $this->options['name'];
  }

  public function getModule()
  {
    return $this->options['module'];
  }

  public function getTitle()
  {
    return $this->options['title'];
  }

  public function getSubTitle()
  {
    return isset($this->options['subtitle']) ? $this->options['subtitle'] : '';
  }

  public function getOrientation()
  {
    return $this->options['orientation'];
  }

  public function getPage()
  {
    return $this->options['page'];
  }

  public function getDescription()
  {
    return $this->options['description'];
  }



  public function __construct($module, $report, $app) {
    $this->report = $report;
    $this->module = $module;
    $this->position = 0;
    $this->app = $app;

    $this->yml = __DIR__ . "/../../reports/$module/$report.yml";
  }

  function parseYml() {
    $yml_array = Yaml::load($this->yml);

    if (is_array($yml_array)) {
      if (isset($yml_array['Params'])) {
        $this->options = $yml_array['Params'];
      }
      if (isset($yml_array['Rows'])) {
        $rows = $yml_array['Rows'];
      }

      foreach($rows as $i => $row){
        $row['index'] = $i;
        $this->rows[] = $row;
      }

    }
  }

  private function check_options($options, $values)
  {
    $response = true;
    foreach ($variable as $key => $value) {
      # code...
    }
  }

  private function validate_options($row_opt)
  {
    switch($row_opt['type']){
      case 'inputcat_tag':
        break;
    }
    // print_r($row_opt);
    return $row_opt; 
  }

  private function default_options($row_opt)
  {
    foreach (Helper::$validate_all as $key) {
      if(!array_key_exists($key, $row_opt)){
        $row_opt[$key] = '';
      }   
    }
    return $row_opt; 
  }

  function renderRow($row){

    $row_opt = $this->default_options($this->rows[$row]);

    $row_opt = $this->validate_options($row_opt);

    $helper = new Helper($this->app,$row_opt);
    $helper->setNomrep($this->options['name']);
    $helper->setNommod($this->options['module']);

    return $helper;

  }

  function getPager($index, $max_rows, $page, &$last_page){

    $row_opt = null;
    foreach ($this->rows as $row){
      if($row['index']==$index) $row_opt = $row;
    }

    if($row_opt){
      $sql = \sprintf($format, $args);
      $sql = str_replace('?', '', $row_opt['sqlcat']);
      $rows = $this->app['database.page_execute']($sql ,$max_rows, $page, $last_page, ADODB_FETCH_ASSOC);
      return $rows;
    }

    return $row_opt;

  }

  function getFilters($index){
    $row_opt = null;
    $filters = array();
    
    foreach ($this->rows as $row){
      if($row['index']==$index) $row_opt = $row;
    }

    if($row_opt){
      $rows = $this->app['database.execute']( str_replace('?', '', $row_opt['sqlcat']).' LIMIT 1' ,ADODB_FETCH_ASSOC);

      if(count($rows)>0) $rows = $rows[0];
      else return $html;

      $i=0;
      $opts=array();
      $helper = new Helper($this->app, $opts);

      foreach($rows as $index => $value){
        if($i>0){
          $opts['label'] = $index;
          $opts['id'] = $index;
          $opts['value'] = '';

          $filters[] = $opts;
        }
        $i++;
      }
    }
    return $filters;
  }
  
  function rewind() {
    $this->position = 0;
  }

  function current() {

    return $this->renderRow($this->position);
  }

  function key() {
    return $this->position;
  }

  function next() {
    ++$this->position;
  }

  function valid() {
    return isset($this->rows[$this->position]);
  }

}

?>
