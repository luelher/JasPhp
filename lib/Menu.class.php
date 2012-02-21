<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu
 *
 * @author luelher
 */
class Menu {

  var $options = array();
  var $menu = array();


  function Menu($yml)
  {
    if(file_exists($yml)) $this->options = Yaml::load($yml);
    else $this->options = array();

    $menu=''; $menu = isset($_GET['menu']) ? $_GET['menu'] : '';

  }

}
?>
