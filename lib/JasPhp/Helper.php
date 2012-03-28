<?php

namespace JasPhp;

use JasPhp;

class Helper {

  private $app = null;
  private $opts = null;
  private $nomrep = '';
  private $nommod = '';

  public static $validate_inputcat = array('type', 'label', 'sql', 'sqlcat', 'name_from', 'field_from');
  public static $validate_input = array('type', 'label', 'name_from', 'field_from');
  public static $validate_inputfec = array('type', 'label', 'sql', 'name_from', 'field_from');
  public static $validate_combo = array('type', 'label', 'sql', 'name_from', 'field_from');
  public static $validate_combof = array('type', 'label', 'name_from', 'field_from');
  public static $validate_inputarea = array('type', 'label', 'name_from', 'field_from');

  
  public function __construct($app, $opts=array()) {
    $this->app = $app;
    $this->opts = $opts;
  }

  public function setNomrep($val){
    $this->nomrep=$val;
  }
  public function setNommod($val){
    $this->nommod=$val;
  }

  function inputcat_tag($opts) {
    $tb = $this->app['database.execute']($opts['sql']);

    if ($opts['name_from'] != '') {
      $script = '
      <div class="clearfix">
        <label for="lInput"><strong>' . $opts['label'] . '</strong></label>
        <div class="input row show-grid">
          <div class="span4"><input name="filters[' . $opts['name_from'] . ']" type="text" class="medium ' . $opts['size'] . '" id="filters_' . $opts['name_from'] . '" value="' . $tb[0][$opts['field_from']] . '" ' . $opts['params'] . '>
            <a href="#" ><img src="/img/search.gif" align="top" onclick="catalog(' . "'" . $opts['name_from'] . "'" . ',' . "'" . $opts['index'] . "'" . ',' . "'" . $this->nomrep . "'" . ',' . "'" . $this->nommod . "'" . '); "></a></div>';

          if($opts['name_to'] != '')
            $script .='
          <div class="span4"><input name="filters[' . $opts['name_to'] . ']" type="text" class="medium ' . $opts['size'] . '" id="filters_' . $opts['name_to'] . '" value="' . $tb[0][$opts['field_to']] . '" ' . $opts['params'] . '>
            <a href="#" ><img src="/img/search.gif" align="top" onclick="catalog(' . "'" . $opts['name_to'] . "'" . ',' . "'" . $opts['index'] . "'" . ',' . "'" . $this->nomrep . "'" . ',' . "'" . $this->nommod . "'" . '); "></a></div>';

          $script .= '
        </div>
      </div>';
    } else {
      $script = '';
    }

    return $script;
  }

  function input_tag($opts) {

     if ($opts['name_from'] != '') {
      $script = '
  <div class="clearfix">
    <label for="lInput"><strong>' . $opts['label'] . '</strong></label>
    <div class="input row show-grid">
      <div class="span4"><input name="filters[' . $opts['name_from'] . ']" type="text" class="large ' . $opts['size'] . '" id="filters_' . $opts['name_from'] . '" value="' . $opts['field_from'] . '" ' . $opts['params'] . '></div>';

      if($opts['name_to'] != '')
      $script .= '
      <div class="span4"><input name="filters[' . $opts['name_to'] . ']" type="text" class="medium ' . $opts['size'] . '" id="filters_' . $opts['name_to'] . '" value="' . $opts['field_to'] . '" ' . $opts['params'] . '></div>';
      
      $script .= '
    </div>
  </div>';
    } else {
      $script = '';
    }

    return $script;
  }

  function inputfec_tag($opts) {
    $tb = $this->app['database.execute']($opts['sql']);

    if ($opts['name_from'] != '') {
      $script = '
  <div class="clearfix">
    <label for="lInput"><strong>' . $opts['label'] . '</strong></label>
    <div class="input row show-grid">
      <div class="span4 inline-inputs">
        <input name="filters[' . $opts['name_from'] . ']" type="text" class="large ' . $opts['size'] . '" id="filters_' . $opts['name_from'] . '" value="' . $tb[0][$opts['field_from']] . '" ' . $opts['params'] . ' data-datepicker="datepicker" >
        <div class="datepicker" style="display: none;"><div class="nav"><div class="months"><span class="prev button">←</span><span class="name"><div class="fg">January</div></span><span class="next button">→</span></div><div class="years"><span class="prev button">←</span><span class="name"><div class="fg">2011</div></span><span class="next button">→</span></div></div><div class="calendar"><div class="dow">Mon</div><div class="dow">Tue</div><div class="dow">Wed</div><div class="dow">Thu</div><div class="dow">Fri</div><div class="dow">Sat</div><div class="dow">Sun</div><div class="days"><div date="12/27/2010" class="overlap">27</div><div date="12/28/2010" class="overlap">28</div><div date="12/29/2010" class="overlap">29</div><div date="12/30/2010" class="overlap">30</div><div date="12/31/2010" class="overlap">31</div><div date="01/01/2011">1</div><div date="01/02/2011">2</div><div date="01/03/2011">3</div><div date="01/04/2011">4</div><div date="01/05/2011">5</div><div date="01/06/2011">6</div><div date="01/07/2011">7</div><div date="01/08/2011">8</div><div date="01/09/2011">9</div><div date="01/10/2011">10</div><div date="01/11/2011">11</div><div date="01/12/2011" class="selected">12</div><div date="01/13/2011" class="">13</div><div date="01/14/2011">14</div><div date="01/15/2011">15</div><div date="01/16/2011">16</div><div date="01/17/2011">17</div><div date="01/18/2011">18</div><div date="01/19/2011">19</div><div date="01/20/2011">20</div><div date="01/21/2011">21</div><div date="01/22/2011">22</div><div date="01/23/2011">23</div><div date="01/24/2011">24</div><div date="01/25/2011">25</div><div date="01/26/2011">26</div><div date="01/27/2011">27</div><div date="01/28/2011">28</div><div date="01/29/2011">29</div><div date="01/30/2011">30</div><div date="01/31/2011">31</div><div date="02/01/2011" class="overlap">1</div><div date="02/02/2011" class="overlap">2</div><div date="02/03/2011" class="overlap">3</div><div date="02/04/2011" class="overlap">4</div><div date="02/05/2011" class="overlap">5</div><div date="02/06/2011" class="overlap">6</div></div></div></div>
      </div>';

      if($opts['name_to'] != '')
      $script .= '
      <div class="span4 inline-inputs">
        <input name="filters[' . $opts['name_to'] . ']" type="text" class="large ' . $opts['size'] . '" id="filters_' . $opts['name_to'] . '" value="' . $tb[0][$opts['field_to']] . '" ' . $opts['params'] . ' data-datepicker="datepicker" >
        <div class="datepicker" style="display: none;"><div class="nav"><div class="months"><span class="prev button">←</span><span class="name"><div class="fg">January</div></span><span class="next button">→</span></div><div class="years"><span class="prev button">←</span><span class="name"><div class="fg">2011</div></span><span class="next button">→</span></div></div><div class="calendar"><div class="dow">Mon</div><div class="dow">Tue</div><div class="dow">Wed</div><div class="dow">Thu</div><div class="dow">Fri</div><div class="dow">Sat</div><div class="dow">Sun</div><div class="days"><div date="12/27/2010" class="overlap">27</div><div date="12/28/2010" class="overlap">28</div><div date="12/29/2010" class="overlap">29</div><div date="12/30/2010" class="overlap">30</div><div date="12/31/2010" class="overlap">31</div><div date="01/01/2011">1</div><div date="01/02/2011">2</div><div date="01/03/2011">3</div><div date="01/04/2011">4</div><div date="01/05/2011">5</div><div date="01/06/2011">6</div><div date="01/07/2011">7</div><div date="01/08/2011">8</div><div date="01/09/2011">9</div><div date="01/10/2011">10</div><div date="01/11/2011">11</div><div date="01/12/2011" class="selected">12</div><div date="01/13/2011" class="">13</div><div date="01/14/2011">14</div><div date="01/15/2011">15</div><div date="01/16/2011">16</div><div date="01/17/2011">17</div><div date="01/18/2011">18</div><div date="01/19/2011">19</div><div date="01/20/2011">20</div><div date="01/21/2011">21</div><div date="01/22/2011">22</div><div date="01/23/2011">23</div><div date="01/24/2011">24</div><div date="01/25/2011">25</div><div date="01/26/2011">26</div><div date="01/27/2011">27</div><div date="01/28/2011">28</div><div date="01/29/2011">29</div><div date="01/30/2011">30</div><div date="01/31/2011">31</div><div date="02/01/2011" class="overlap">1</div><div date="02/02/2011" class="overlap">2</div><div date="02/03/2011" class="overlap">3</div><div date="02/04/2011" class="overlap">4</div><div date="02/05/2011" class="overlap">5</div><div date="02/06/2011" class="overlap">6</div></div></div></div>
      </div>';
      
      $script .= '
    </div>
  </div>';
    } else {
      $script = '';
    }

    return $script;
  }

  function combo_tag($opts) {
    $t = explode("=>", $opts['field_from']);
    $r = explode("-", $t[0]);
    $campo1 = $r[0];
    $campo2 = $r[1];
    if (strrpos(strtolower($opts['sql']), "order by")) {
      $sql1 = $opts['sql'] . " asc";
      $sql2 = $opts['sql'] . " desc";
    } else {
      $sql1 = $opts['sql'] . "";
      $sql2 = $opts['sql'] . "";
    }

    if ($opts['name_from'] != '') {

      $options = '';
      $tb = $this->app['database.execute']($sql1);
      foreach ($tb as $i => $field) {
        if ($i == 0) {
          $options.='<option value="' . $field[$campo1] . '" selected>' . $field[$campo2] . '</option>';
        } else {
          $options.='<option value="' . $field[$campo1] . '">' . $field[$campo2] . '</option>';
        }
      }

      $script = '
      <div class="clearfix">
        <label for="lInput"><strong>' . $opts['label'] . '</strong></label>
        <div class="input row show-grid">
          <div class="span4">
            <select name="fields[' . $opts['name_from'] . ']" type="text" class="large ' . $opts['size'] . '" id="fields_' . $opts['name_from'] . '" ' . $opts['params'] . ' >
              '.$options.'
            </select>
          </div>';
      if($opts['name_to'] != ''){

        $options='';
        $tb = $this->app['database.execute']($sql2);
        foreach ($tb as $i => $field) {
          if ($i == 0) {
            $options.='<option value="' . $field[$campo1] . '" selected>' . $field[$campo2] . '</option>';
          } else {
            $options.='<option value="' . $field[$campo1] . '">' . $field[$campo2] . '</option>';
          }
        }

        $script.='
          <div class="span4">
            <select name="fields[' . $opts['name_to'] . ']" type="text" class="large ' . $opts['size'] . '" id="fields_' . $opts['name_to'] . '" ' . $opts['params'] . ' >
              '.$options.'
            </select>
          </div>';
      }
      $script.='
        </div>
      </div>';
    } else {
      $script = '';
    }

    return $script;
  }

  function combof_tag($opts) {

    if ($opts['name_from']!='') {

      $options='';
      for ($i = 0; $i < count($opts['field_from']); $i++) {
        $aux = explode("=>", $text[1][$i]);
        if (count($aux) < 2)
          $aux[1] = $aux[0];
        $options.='<option value="' . $aux[0] . '" >' . $aux[1] . '</option>';
      }

      $script = '
      <div class="clearfix">
        <label for="lInput"><strong>' . $opts['label'] . '</strong></label>
        <div class="input row show-grid">
          <div class="span4">
            <select name="fields[' . $opts['name_from'] . ']" type="text" class="large ' . $opts['size'] . '" id="fields_' . $opts['name_from'] . '" ' . $opts['params'] . ' >
              '.$options.'
            </select>
          </div>';

      if($opts['name_to']!=''){

        $options='';
        for ($i = 0; $i < count($text[4]); $i++) {
          $aux = explode("=>", $text[4][$i]);
          if (count($aux) < 2)
            $aux[1] = $aux[0];
          $options.='<option value="' . $aux[0] . '" >' . $aux[1] . '</option>';
        }



        $script .= '
          <div class="span4">
            <select name="fields[' . $opts['name_to'] . ']" type="text" class="large ' . $opts['size'] . '" id="fields_' . $opts['name_to'] . '" ' . $opts['params'] . ' >
              '.$options.'
            </select>
          </div>              ';

      }

      $script.='
        </div>
      </div>';
    }else {
      $script = '';
    }

    return $script;
  }

  function inputarea_tag($opts) {
    if ($opts['field_from'] == -1)
      $opts['field_from'] = "";
    $script = '
  <div class="clearfix">
    <label for="lInput"><strong>' . $opts['label'] . '</strong></label>
    <div class="input row show-grid">
      <div class="span4"><textarea name="fields[' . $opts['name_from'] . ']" type="text" rows="3" class="xlarge ' . $opts['size'] . '" id="fields_' . $opts['name_from'] . '" value="' . $opts['field_from'] . '" ' . $opts['params'] . '></textarea></div>
    </div>
  </div>';
    return $script;
  }

  function render(){

    if(count($this->opts)>0){
      $type = $this->opts['type'];
      return $this->$type($this->opts);
    }else return 'Not Config';


  }

}

?>
