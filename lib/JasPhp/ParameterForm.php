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


  function renderRow($row){

    $row_opt = $this->rows[$row];

    $helper = new Helper($this->app,$row_opt);
    $helper->setNomrep($this->options['name']);
    $helper->setNommod($this->options['module']);

    return $helper;

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
