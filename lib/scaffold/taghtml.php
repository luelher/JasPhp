
<?php
function inputcat_tag($param,$text,$opc,$parametros='',$index='')
{
	$tb = $param[1]->execute($param[3]);

	if (count($text)>3 && count($text)==6)
    {
		$script ='
  <div class="clearfix">
    <label for="lInput"><strong>'.$param[2].'</strong></label>
    <div class="input row show-grid">
      <div class="span4"><input name="'.$text[0].'" type="text" class="medium '.$opc[0].'" id="'.$text[0].'" value="'.$tb[0][$text[1]].'" '.$parametros.'>
        <a href="#" ><img src="../../img/search.gif" align="top" onclick="catalog('."'".$text[0]."'".','."'".$index."'".','."'".$param[0]."'".','."'".$opc[2]."'".'); "></a></div>
      <div class="span4"><input name="'.$text[3].'" type="text" class="medium '.$opc[0].'" id="'.$text[3].'" value="'.$tb[0][$text[4]].'" '.$parametros.'>
        <a href="#" ><img src="../../img/search.gif" align="top" onclick="catalog('."'".$text[3]."'".','."'".$index."'".','."'".$param[0]."'".','."'".$opc[2]."'".'); "></a></div>
    </div>
  </div>';
    }else
    {
    	$script ='
  <div class="clearfix">
    <label for="lInput"><strong>'.$param[2].'</strong></label>
    <div class="input row show-grid">
      <div class="span4"><input name="'.$text[0].'" type="text" class="medium '.$opc[0].'" id="'.$text[0].'" value="'.$tb[0][$text[1]].'" '.$parametros.'>
        <a href="#" ><img src="../../img/search.gif" align="top" onclick="catalog('."'".$text[0]."'".','."'".$index."'".','."'".$param[0]."'".','."'".$opc[2]."'".'); "></a></div>
    </div>
  </div>';
    }

	return $script;
}



function inputfec_tag($param,$text,$opc,$parametros='')
{
	$tb = $param[1]->execute($param[3]);

	if (count($text)>3 && count($text)==6)
    {
		$script ='
  <div class="clearfix">
    <label for="lInput"><strong>'.$param[2].'</strong></label>
    <div class="input row show-grid">
      <div class="span4 inline-inputs">
        <input name="'.$text[0].'" type="text" class="large '.$opc[0].'" id="'.$text[0].'" value="'.$tb[0][$text[1]].'" '.$parametros.' data-datepicker="datepicker" >
        <div class="datepicker" style="display: none;"><div class="nav"><div class="months"><span class="prev button">←</span><span class="name"><div class="fg">January</div></span><span class="next button">→</span></div><div class="years"><span class="prev button">←</span><span class="name"><div class="fg">2011</div></span><span class="next button">→</span></div></div><div class="calendar"><div class="dow">Mon</div><div class="dow">Tue</div><div class="dow">Wed</div><div class="dow">Thu</div><div class="dow">Fri</div><div class="dow">Sat</div><div class="dow">Sun</div><div class="days"><div date="12/27/2010" class="overlap">27</div><div date="12/28/2010" class="overlap">28</div><div date="12/29/2010" class="overlap">29</div><div date="12/30/2010" class="overlap">30</div><div date="12/31/2010" class="overlap">31</div><div date="01/01/2011">1</div><div date="01/02/2011">2</div><div date="01/03/2011">3</div><div date="01/04/2011">4</div><div date="01/05/2011">5</div><div date="01/06/2011">6</div><div date="01/07/2011">7</div><div date="01/08/2011">8</div><div date="01/09/2011">9</div><div date="01/10/2011">10</div><div date="01/11/2011">11</div><div date="01/12/2011" class="selected">12</div><div date="01/13/2011" class="">13</div><div date="01/14/2011">14</div><div date="01/15/2011">15</div><div date="01/16/2011">16</div><div date="01/17/2011">17</div><div date="01/18/2011">18</div><div date="01/19/2011">19</div><div date="01/20/2011">20</div><div date="01/21/2011">21</div><div date="01/22/2011">22</div><div date="01/23/2011">23</div><div date="01/24/2011">24</div><div date="01/25/2011">25</div><div date="01/26/2011">26</div><div date="01/27/2011">27</div><div date="01/28/2011">28</div><div date="01/29/2011">29</div><div date="01/30/2011">30</div><div date="01/31/2011">31</div><div date="02/01/2011" class="overlap">1</div><div date="02/02/2011" class="overlap">2</div><div date="02/03/2011" class="overlap">3</div><div date="02/04/2011" class="overlap">4</div><div date="02/05/2011" class="overlap">5</div><div date="02/06/2011" class="overlap">6</div></div></div></div>
      </div>
      <div class="span4 inline-inputs">
        <input name="'.$text[3].'" type="text" class="large '.$opc[0].'" id="'.$text[3].'" value="'.$tb[0][$text[4]].'" '.$parametros.' data-datepicker="datepicker" >
        <div class="datepicker" style="display: none;"><div class="nav"><div class="months"><span class="prev button">←</span><span class="name"><div class="fg">January</div></span><span class="next button">→</span></div><div class="years"><span class="prev button">←</span><span class="name"><div class="fg">2011</div></span><span class="next button">→</span></div></div><div class="calendar"><div class="dow">Mon</div><div class="dow">Tue</div><div class="dow">Wed</div><div class="dow">Thu</div><div class="dow">Fri</div><div class="dow">Sat</div><div class="dow">Sun</div><div class="days"><div date="12/27/2010" class="overlap">27</div><div date="12/28/2010" class="overlap">28</div><div date="12/29/2010" class="overlap">29</div><div date="12/30/2010" class="overlap">30</div><div date="12/31/2010" class="overlap">31</div><div date="01/01/2011">1</div><div date="01/02/2011">2</div><div date="01/03/2011">3</div><div date="01/04/2011">4</div><div date="01/05/2011">5</div><div date="01/06/2011">6</div><div date="01/07/2011">7</div><div date="01/08/2011">8</div><div date="01/09/2011">9</div><div date="01/10/2011">10</div><div date="01/11/2011">11</div><div date="01/12/2011" class="selected">12</div><div date="01/13/2011" class="">13</div><div date="01/14/2011">14</div><div date="01/15/2011">15</div><div date="01/16/2011">16</div><div date="01/17/2011">17</div><div date="01/18/2011">18</div><div date="01/19/2011">19</div><div date="01/20/2011">20</div><div date="01/21/2011">21</div><div date="01/22/2011">22</div><div date="01/23/2011">23</div><div date="01/24/2011">24</div><div date="01/25/2011">25</div><div date="01/26/2011">26</div><div date="01/27/2011">27</div><div date="01/28/2011">28</div><div date="01/29/2011">29</div><div date="01/30/2011">30</div><div date="01/31/2011">31</div><div date="02/01/2011" class="overlap">1</div><div date="02/02/2011" class="overlap">2</div><div date="02/03/2011" class="overlap">3</div><div date="02/04/2011" class="overlap">4</div><div date="02/05/2011" class="overlap">5</div><div date="02/06/2011" class="overlap">6</div></div></div></div>
      </div>
    </div>
  </div>';
    }else
    {
    	$script ='
  <div class="clearfix">
    <label for="lInput"><strong>'.$param[2].'</strong></label>
    <div class="input row show-grid">
      <div class="span4 inline-inputs">
        <input name="'.$text[0].'" type="text" class="large '.$opc[0].'" id="'.$text[0].'" value="'.$tb[0][$text[1]].'" '.$parametros.' data-datepicker="datepicker" >
        <div class="datepicker" style="display: none;"><div class="nav"><div class="months"><span class="prev button">←</span><span class="name"><div class="fg">January</div></span><span class="next button">→</span></div><div class="years"><span class="prev button">←</span><span class="name"><div class="fg">2011</div></span><span class="next button">→</span></div></div><div class="calendar"><div class="dow">Mon</div><div class="dow">Tue</div><div class="dow">Wed</div><div class="dow">Thu</div><div class="dow">Fri</div><div class="dow">Sat</div><div class="dow">Sun</div><div class="days"><div date="12/27/2010" class="overlap">27</div><div date="12/28/2010" class="overlap">28</div><div date="12/29/2010" class="overlap">29</div><div date="12/30/2010" class="overlap">30</div><div date="12/31/2010" class="overlap">31</div><div date="01/01/2011">1</div><div date="01/02/2011">2</div><div date="01/03/2011">3</div><div date="01/04/2011">4</div><div date="01/05/2011">5</div><div date="01/06/2011">6</div><div date="01/07/2011">7</div><div date="01/08/2011">8</div><div date="01/09/2011">9</div><div date="01/10/2011">10</div><div date="01/11/2011">11</div><div date="01/12/2011" class="selected">12</div><div date="01/13/2011" class="">13</div><div date="01/14/2011">14</div><div date="01/15/2011">15</div><div date="01/16/2011">16</div><div date="01/17/2011">17</div><div date="01/18/2011">18</div><div date="01/19/2011">19</div><div date="01/20/2011">20</div><div date="01/21/2011">21</div><div date="01/22/2011">22</div><div date="01/23/2011">23</div><div date="01/24/2011">24</div><div date="01/25/2011">25</div><div date="01/26/2011">26</div><div date="01/27/2011">27</div><div date="01/28/2011">28</div><div date="01/29/2011">29</div><div date="01/30/2011">30</div><div date="01/31/2011">31</div><div date="02/01/2011" class="overlap">1</div><div date="02/02/2011" class="overlap">2</div><div date="02/03/2011" class="overlap">3</div><div date="02/04/2011" class="overlap">4</div><div date="02/05/2011" class="overlap">5</div><div date="02/06/2011" class="overlap">6</div></div></div></div>
      </div>
    </div>
  </div>';
    }

	return $script;
}

function combo_tag($param,$text,$opc,$parametros='')
{
	$t= explode("=>",$text[1]);
	$r = explode("-",$t[0]);
	$campo1= $r[0];
	$campo2= $r[1];
	if (strrpos(strtolower($param[3]),"order by"))
	{
		$sql1=$param[3]." asc";
		$sql2=$param[3]." desc";
	}else
	{
		$sql1=$param[3]."";
		$sql2=$param[3]."";
	}

	if (count($text)>3 && count($text)==6)
    {
    $script ='
      <div class="clearfix">
        <label for="lInput"><strong>'.$param[2].'</strong></label>
        <div class="input row show-grid">
          <div class="span4">
            <select name="'.$text[0].'" type="text" class="large '.$opc[0].'" id="'.$text[0].'" '.$parametros.' >';
              $tb=$param[1]->execute($sql1);
              foreach ($tb as $i => $field)
              {
                 if ($i==0)
                 {
                   $script.='<option value="'.$field[$campo1].'" selected>'.$field[$campo2].'</option>';
                 }
                 else
                 {
                   $script.='<option value="'.$field[$campo1].'">'.$field[$campo2].'</option>';
                 }
              }
          $script.='</select>
          </div>
          <div class="span4">
            <select name="'.$text[3].'" type="text" class="large '.$opc[0].'" id="'.$text[3].'" '.$parametros.' >';
              $tb=$param[1]->execute($sql2);
              foreach ($tb as $i => $field)
              {
                 if ($i==0)
                 {
                   $script.='<option value="'.$field[$campo1].'" selected>'.$field[$campo2].'</option>';
                 }
                 else
                 {
                   $script.='<option value="'.$field[$campo1].'">'.$field[$campo2].'</option>';
                 }
             }
            $script.='</select>
          </div>
        </div>
      </div>';
    }else
    {
    $script ='
      <div class="clearfix">
        <label for="lInput"><strong>'.$param[2].'</strong></label>
        <div class="input row show-grid">
          <div class="span4">
            <select name="'.$text[0].'" type="text" class="large '.$opc[0].'" id="'.$text[0].'" '.$parametros.' >';
              $tb=$param[1]->execute($sql1);
              foreach ($tb as $field)
              {
                 if ($field[$campo1]==$seleccionado)
                 {
                   $script.='<option value="'.$field[$campo1].'" selected>'.$field[$campo2].'</option>';
                 }
                 else
                 {
                   $script.='<option value="'.$field[$campo1].'">'.$field[$campo2].'</option>';
                 }
             }
          $script.='</select>
          </div>
        </div>
      </div>';

    }

	return $script;
}

function combof_tag($param,$text,$opc,$parametros='')
{
	if (count($text)>3 && count($text)==6)
    {
    $script ='
      <div class="clearfix">
        <label for="lInput"><strong>'.$param[2].'</strong></label>
        <div class="input row show-grid">
          <div class="span4">
            <select name="'.$text[0].'" type="text" class="large '.$opc[0].'" id="'.$text[0].'" '.$parametros.' >';
              for($i=0;$i < count($text[1]);$i++)
						  {
						  	$aux=explode("=>",$text[1][$i]);
						  	if (count($aux)<2)
						  	  $aux[1]=$aux[0];
						  	$script.='<option value="'.$aux[0].'" >'.$aux[1].'</option>';
						  }
              $script.='</select>
          </div>
          <div class="span4">
            <select name="'.$text[3].'" type="text" class="large '.$opc[0].'" id="'.$text[3].'" '.$parametros.' >';
              for($i=0;$i < count($text[4]);$i++)
						  {
						  	$aux=explode("=>",$text[4][$i]);
						  	if (count($aux)<2)
						  	  $aux[1]=$aux[0];
						  	$script.='<option value="'.$aux[0].'" >'.$aux[1].'</option>';
						  }
              $script.='</select>
          </div>
        </div>
      </div>';
    }else
    {
    $script ='
      <div class="clearfix">
        <label for="lInput"><strong>'.$param[2].'</strong></label>
        <div class="input row show-grid">
          <div class="span4">
            <select name="'.$text[0].'" type="text" class="large '.$opc[0].'" id="'.$text[0].'" '.$parametros.' >';
              for($i=0;$i < count($text[1]);$i++)
						  {
						  	$aux=explode("=>",$text[1][$i]);
						  	if (count($aux)<2)
						  	  $aux[1]=$aux[0];
						  	$script.='<option value="'.$aux[0].'" >'.$aux[1].'</option>';
						  }
              $script.='</select>
          </div>
        </div>
      </div>';
    }

	return $script;
}

function input_tag($param,$text,$opc,$parametros='')
{
	if (isset($text[1]) && $text[1]==-1)
	   $text[1]="";
	if (isset($text[4]) && $text[4]==-1)
	   $text[4]="";

	if (count($text)>3 && count($text)==6)
    {
		$script ='
  <div class="clearfix">
    <label for="lInput"><strong>'.$param[2].'</strong></label>
    <div class="input row show-grid">
      <div class="span4"><input name="'.$text[0].'" type="text" class="large '.$opc[0].'" id="'.$text[0].'" value="'.$text[1].'" '.$parametros.'></div>
      <div class="span4"><input name="'.$text[3].'" type="text" class="large '.$opc[0].'" id="'.$text[3].'" value="'.$text[4].'" '.$parametros.'></div>
    </div>
  </div>';
    }else
    {
    	$script ='
  <div class="clearfix">
    <label for="lInput"><strong>'.$param[2].'</strong></label>
    <div class="input row show-grid">
      <div class="span4"><input name="'.$text[0].'" type="text" class="large '.$opc[0].'" id="'.$text[0].'" value="'.$text[1].'" '.$parametros.'></div>
    </div>
  </div>';
    }

	return $script;
}

function inputarea_tag($param,$text,$opc,$parametros='')
{
	if ($text[1]==-1)
	   $text[1]="";
  $script ='
  <div class="clearfix">
    <label for="lInput"><strong>'.$param[2].'</strong></label>
    <div class="input row show-grid">
      <div class="span4"><textarea name="'.$text[0].'" type="text" rows="3" class="xlarge '.$opc[0].'" id="'.$text[0].'" value="'.$text[1].'" '.$parametros.'></textarea></div>
    </div>
  </div>';
	return $script;
}
