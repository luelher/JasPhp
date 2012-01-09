<?php

class Herramientas {

  function Herramientas() {
  }

  public static function GetPost($variable)
  {
    if (isset($_POST[$variable]) && $_POST[$variable]!=""){
      return trim($_POST[$variable]);
    }
    elseif(isset($_GET[$variable]) && $_GET[$variable]!="")
    {
      return trim($_GET[$variable]);
    }else return "";
  }



  public static function PrintR($obj)
  {
    print '<pre>';
    print_r($obj);
    print '</pre>';
  }
 public function FormatoNum($varmonto,$format='VE')
  {
  	if($format=='VE')
  	{
  		$auxvar=str_replace(".","",$varmonto);
		$auxvar=str_replace(",",".",$auxvar);
  	}else
  	{
		$auxvar=str_replace(",","",$varmonto);
		$auxvar=str_replace(".",",",$auxvar);
  	}

	return $auxvar;
  }




	public static function instr($palabra,$busqueda,$comienzo,$concurrencia)
	{
		/*echo $palabra. " ";
		echo $busqueda. " ";
		echo $comienzo. " ";
		echo $concurrencia. " ";*/
		//echo $palabra="#-##-##-##-##-###";
		//$concurrencia=6;
		//echo "   ,   ";

		$tamano=strlen($palabra);
		//echo "   ,   ";
		$cont=0;
		$cont_conc=0;

		for ($i=$comienzo;$i<=$tamano;$i++){
			$cont=$cont+1;
			if ($palabra[$i]==$busqueda):
				$cont_conc=$cont_conc+1;

				if ($cont_conc==$concurrencia):
					$i=$tamano;
				endif;
			endif;
		}
			if ($concurrencia > $cont_conc ):
				 $cont=0;
			else:
				 $cont;
			endif;

		return $instr=$cont;
	}

	 public static function isFloat($value)
  {
    $expresionfloat =  "/^(\d{1,3}\,)(\d{3,3}\,){1,10}(\.\d+)$/";
    $expresionfloat_1 =  "/^(\d{1,10})(\.\d+)$/";
    $expresionfloat_2 =  "/^(\d{1,3}\,){1,10}(\d{3,3})(\.\d+)$/";
    $expresionfloat_3 =  "/^(\d{1,20})$/";
    $expresionfloat_4 =  "/^(\d{1,20})(\.\d+)$/";

    if(preg_match($expresionfloat,$value) || preg_match($expresionfloat_1,$value) || preg_match($expresionfloat_2,$value) || preg_match($expresionfloat_3,$value) || preg_match($expresionfloat_4,$value) ) return true;
    else return false;
  }

  public static function isFloatVE($value)
  {
    $expresionfloatVE =  "/^(\d{1,3}\.)(\d{3,3}\.){1,10}(\,\d+)$/";
    $expresionfloatVE_1 =  "/^(\d{1,10})(\.\d+)$/";
    $expresionfloatVE_2 =  "/^(\d{1,3}\.){1,10}(\d{3,3})(\,\d+)$/";
    $expresionfloatVE_3 =  "/^(\d{1,20})$/";
    $expresionfloatVE_4 =  "/^(\d{1,20})(\,\d+)$/";

    if(preg_match($expresionfloatVE,$value) || preg_match($expresionfloatVE_1,$value) || preg_match($expresionfloatVE_2,$value) || preg_match($expresionfloatVE_3,$value) || preg_match($expresionfloatVE_4,$value) ) return true;
    else return false;

  }

  public static function FloatVEtoFloat($value){
    try{
      $sinpuntos = str_replace('.','',$value);
      $valor_en_float = (float)str_replace(',','.',$sinpuntos);
      if(is_nan($valor_en_float))
          return 0.00;
      else return $valor_en_float;
    }catch(Exception $e){return 0.00;}
  }

  public static function toFloat($value)
  {
    $valorfloat = 0.0;
    if ( ($value==" ") || ($value=="") || ($value=="NaN"))
    {
      $valorfloat=0.00;
    }else{
      if(Herramientas::isFloat($value) || is_float($value)){
        $value = str_replace(',','',$value);
        $valorfloat = (float)$value;
      }else{

        if(Herramientas::isFloatVE($value))
          $valorfloat = Herramientas::FloatVEtoFloat($value);
        else
          $valorfloat = 0.00;
      }
    }
    return round($valorfloat,2);
  }

  public static function FormatoMonto($value,$dec='2')
  {
  	$for='VE';
  	if ($value==' ')
  		$value=0;
  	if ($for=='VE')
  		$valor = number_format($value,$dec,',','.');
  	elseif ($for=='IN')
  	   	$valor = number_format($value,$dec,'.',',');
  	else
  	    $valor = number_format($value,0);

  	return $valor;
  }

  public static function ObtenerMesenLetras($mes)
  {
  			if($mes=='01')  return $mes='Enero';
			if($mes=='02')  return $mes='Febrero';
			if($mes=='03')  return $mes='Marzo';
			if($mes=='04')  return $mes='Abril';
			if($mes=='05')  return $mes='Mayo';
			if($mes=='06')	return $mes='Junio';
			if($mes=='07')  return $mes='Julio';
			if($mes=='08')	return $mes='Agosto';
			if($mes=='09')  return $mes='Septiembre';
			if($mes=='10')	return $mes='Octubre';
			if($mes=='11')  return $mes='Noviembre';
			if($mes=='12')  return $mes='Diciembre';
  }

  /////////////////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////FUNCION MONTO ESCRITO//////////////////////////////////////
  public static function obtenermontoescrito($numero)
  {
  $poscoma=0;
  $nombre='';
  $contmil=0;
  $nrochar=1;
  $tira="";
  $primero="";
  $segundo="";
  $tercero="";
  $cuarto="";
  $quinto="";
  $sexto="";
  $sepmil1="";
  $sepmil2="";
  $sepmil3="";
  $sepmil4="";
  $sepmil5="";
  $sepmil6="";
  $tira3="";
  $melones=" MILLONES ";
  $billones=" BILLONES ";
  //Formatear el N�mero en Estudio
  $monchar=number_format($numero,2,".",",")."";
  $monchar=trim($monchar);
  $pospunto=strpos($monchar,'.'); //Posici�n del Punto Decimal
  $indchar=$pospunto;             //Comienzo del recorrido de lectura
                                  //Se determina directamente
                                  //la parte decimal del n�mero
  $decimal=" CON ".substr($monchar,$pospunto+1)."/100";
  while($indchar>=0)        //Comienza el ciclo m�s externo
  {
     $contmil=$contmil+1;
     $indchar=$indchar - 1;
     $contchar=1;
     $tira3="";
     $num1="";
     $num2="";
     $num3="";
     $nro=substr($monchar,$indchar,1);
     while(($indchar>=0)&&($contchar<=3))
     {
         $conn= new baseClases();
         $sql="SELECT coalesce(NOMNUM,' ')  as nomnum
               FROM NUMEROS
               WHERE NUM = ".$nro." AND
               POS=".$contchar.";";
		  $arrsql=$conn->select($sql);
         if (count($arrsql)>0)
         {
            $nombre=$arrsql[0]["nomnum"];
         }
         else
         {
         	$nombre="";
         }

         if ($contchar==1)
	     {
	            $numant=$nro+0;
	            $num1=$nombre;
	     }//if ($contchar=1)
         elseif ($contchar==2)
     {
            $num2=$nombre;
      $nro=$nro+0;
            if($nro==1)
      {
         $nro=$nro+"";
               if ($numant==1)
         {
                  $num1="";
                  $num2="ONCE";
               }//if ($numant=1)
         elseif ($numant==2)
         {
                  $num1="";
                  $num2="DOCE";
               }//elseif ($numant=2)
         elseif ($numant==3)
         {
                  $num1="";
                  $num2="TRECE";
               }//elseif ($numant=3)
         elseif ($numant==4)
         {
                  $num1="";
                  $num2="CATORCE";
               }//elseif ($numant=4)
               elseif ($numant==5)
         {
                  $num1="";
                  $num2="QUINCE";
               }//elseif ($numant=5)
            }//if($nro=1)
     }//elseif ($contchar=2)
         elseif ($contchar==3)
     {
            $num3=$nombre;
         }//elseif ($contchar=3)
         $indchar=$indchar -1;
         $contchar=$contchar + 1;
         $nro=substr($monchar,$indchar,$nrochar);
     if (trim($nro)==",")
     {
       $nro="-1";
     } //if ($nro=",")

     }//while(($indchar>=0)&&($contchar<=3))
    if (trim($num2)<>"")
    {
        if ($numant<>0)
        {
         $operador = " Y ";
        }//if ($numant<>0)
        else
        {
         $operador ="";
        }//else
    }//if ($num2<>"")
    else
    {
       $operador="";
    }//else

     if (trim($num2)=="ONCE" || trim($num2)=="DOCE" || trim($num2)=="TRECE" || trim($num2)=="CATORCE" || trim($num2)=="QUINCE")
     {
      $operador="";
     }//if ($num2="ONCE" || $num2="DOCE" || $num2="TRECE" || $num2="CATORCE" || $num2="QUINCE")

      if (trim($num1)=="CERO")
    {
       if (trim($num2)<>"" || trim($num3)<>"")
       {
         $num1="";
         $operador="";
       }//if ($num2<>"" || $num3<>"")
    }//if ($num1="CERO")

    if (trim($num3)=="CIENTO")
    {
       if (trim($num2)=="" && trim($num1)=="")
       {
        $num3="CIEN";
        $num2="";
        $operador="";
        $num1="";
       }//if ($num2="" && $num1="")
    }//if ($num3="CIENTO")

    if (trim($num1)=="UNO")
    {
       if ($contmil>1)
       {
        $num1="UN";
       }//if ($contmil>1)
    }//if ($num1="UNO")

        $tira3= $num3." ".$num2.$operador.$num1;
      if ($contmil==1)
    {
          $primero=$tira3;
    }//if ($contmil=1)
      elseif ($contmil==2)
    {
          $segundo=$tira3;
          if (trim($segundo)=="CERO")
      {
             $segundo="";
             if (trim($primero)=="CERO")
       {
                $primero="";
             }//if ($primero="CERO")
          }//if ($segundo="CERO")
      else
      {
             $sepmil2=" MIL ";
             if (trim($primero)=="CERO")
       {
                $primero="";
             }//if ($primero="CERO")
          }//else
       }//elseif ($contmil=2)
    elseif ($contmil==3)
    {
          $tercero= $tira3;
          if (trim($num1)=="UN")
      {
             $sepmil3=" MILLON ";
          }//if ($num1="UN")
      else
      {
             $sepmil3=" MILLONES ";
          }//else
          if (trim($tercero)=="CERO")
      {
             $tercero="";
          }//if ($tercero="CERO")
    }//elseif ($contmil=3)
      elseif ($contmil==4)
    {
         $cuarto=$tira3;
         if (trim($cuarto)<>"CERO")
     {
            if (trim($sepmil3)=="MILLON")
      {
               $sepmil3=" MILLONES ";
            }//if ($sepmil3="MILLON")
            $sepmil4=" MIL ";
     }//if ($cuarto<>"CERO")
         else
     {
            $cuarto="";
         }//else
      }//elseif ($contmil=4)
    elseif ($contmil==5)
     {
         $quinto=$tira3;
         if (trim($num1)=="UN")
     {
            $sepmil5=" BILLON ";
         }//if ($num1="UN")
     else
     {
            $sepmil5=" BILLONES ";
         }//else

         if (trim($tercero)=="" && trim($cuarto)=="")
     {
            $sepmil3="";
         }//if ($tercero="" && $cuarto="")


         if (trim($quinto)<>"CERO")
     {
             if (trim($cuarto)=="CERO")
       {
                $cuarto="";
                $sepmil4="";
             }//if ($cuarto="CERO")
         }//if ($quinto<>"CERO")
     }//elseif ($contmil=5)
     elseif ($contmil==6)
   {
         $sexto=$tira3;
         if (trim($sexto)<>"CERO")
     {
            $sepmil6=" MIL ";
            if (trim($sepmil5)=="BILLON")
      {
               $sepmil5=" BILLONES ";
            }//if ($sepmil5="BILLON")
            if (trim($quinto)=="CERO")
      {
                $quinto="";
            }//if ($quinto="CERO")
         }//if ($sexto<>"CERO")
     }//elseif ($contmil=6)
  } // while($indchar>=0)
  return $sexto.$sepmil6.$quinto.$sepmil5.$cuarto.$sepmil4.$tercero.$sepmil3.$segundo.$sepmil2.$primero.$sepmil1.$decimal;
  }//function montoescrito($numero)
  /////////////////////////////////////////////////////////////////////////////////////////////////////


 /***
  * FUNCION QUE DEVUELVE LA LONGITUD DEL CAMPO CODPRE DE LA TABLE CPDEFTIT POR DEFECTO
  * TAMBIEN PUEDEN PASARSE COMO PARAMETROS LA TABLA Y EL CAMPO PARA QUE DEVUELVA LA LONGITUD
  * EJEMPLOS:
  *
  * **/
  public static function LongitudCampo($param='',$tabla='',$campo='')
  {
  	$conn= new baseClases();
    if(empty($tabla) && empty($campo))
    {
    	$sql="select pg_attribute.attname as nombrecolumna,(pg_attribute.atttypmod-4) as longcampo
			from pg_attribute, pg_class, pg_namespace
			where
			pg_namespace.nspname ='".$_SESSION['schema']."'
			and relnamespace = pg_namespace.oid
			and relname = lower('cpdeftit')
			and attname=lower('codpre')
			and pg_class.oid = attrelid
			union all
			select pg_attribute.attname as nombrecolumna,(pg_attribute.atttypmod-4) as longcampo
			from pg_attribute, pg_class, pg_namespace
			where
			pg_namespace.nspname ='".$_SESSION['schema']."'
			and relnamespace = pg_namespace.oid
			and relname = lower('contaba')
			and attname=lower('codcta')
			and pg_class.oid = attrelid
			union all
			select pg_attribute.attname as nombrecolumna,(pg_attribute.atttypmod-4) as longcampo
			from pg_attribute, pg_class, pg_namespace
			where
			pg_namespace.nspname ='".$_SESSION['schema']."'
			and relnamespace = pg_namespace.oid
			and relname = lower('npcatpre')
			and attname=lower('codcat')
			and pg_class.oid = attrelid
			union all
			select pg_attribute.attname as nombrecolumna,(pg_attribute.atttypmod-4) as longcampo
			from pg_attribute, pg_class, pg_namespace
			where
			pg_namespace.nspname ='".$_SESSION['schema']."'
			and relnamespace = pg_namespace.oid
			and relname = lower('nppartidas')
			and attname=lower('codpar')
			and pg_class.oid = attrelid
			union all
			select pg_attribute.attname as nombrecolumna,(pg_attribute.atttypmod-4) as longcampo
			from pg_attribute, pg_class, pg_namespace
			where
			pg_namespace.nspname ='".$_SESSION['schema']."'
			and relnamespace = pg_namespace.oid
			and relname = lower('nphojint')
			and attname=lower('codemp')
			and pg_class.oid = attrelid
			";
		$arr=$conn->select($sql);
		if(strtoupper($param)=='CODPRE')
		{
			return $arr[0]["longcampo"];
		}elseif(strtoupper($param)=='CODCTA')
		{
			return $arr[1]["longcampo"];
		}elseif(strtoupper($param)=='CODCAT')
		{
			return $arr[2]["longcampo"];
		}elseif(strtoupper($param)=='CODPAR')
		{
			return $arr[3]["longcampo"];
		}elseif(strtoupper($param)=='CODEMP')
		{
			return $arr[4]["longcampo"];
		}else
		  return $arr;
    }else
    {
    	$sql="select pg_attribute.attname as nombrecolumna,(pg_attribute.atttypmod-4) as longcampo
			from pg_attribute, pg_class, pg_namespace
			where
			pg_namespace.nspname ='".$_SESSION['schema']."'
			and relnamespace = pg_namespace.oid
			and relname = lower('".$tabla."')
			and attname=lower('".$campo."')
			and pg_class.oid = attrelid
			";
			$arr=$conn->select($sql);
			return $arr[0]["longcampo"];
    }
  }

  	function periodo($periodo,$inifin)
	{
		if($inifin==1)
			return "01/".$periodo."/".$this->perfis;
		else
		{
			if($periodo=="01"||$periodo=="03"||$periodo=="05"||$periodo=="07"||$periodo=="08"||$periodo=="10"||$periodo=="12")
				return "31/".$periodo."/".$this->perfis;
			elseif($periodo=="04"||$periodo=="06"||$periodo=="09"||$periodo=="11")
			    return "30/".$periodo."/".$this->perfis;
			else
			    return "29/".$periodo."/".$this->perfis;
		}
	}

  public function colocarPeriodo($perdesde, $perhasta){
  	$conn= new baseClases();
  	$this->setFont("Arial","B",7);
	$y=$this->getY();
  	$t=$conn->select("select to_char(fecper,'yyyy') as perfis from cpdefniv");
	$this->perfis=$t[0]["perfis"];
  	$this->setXY(30,28);
	$this->cell(40,4,"Período Fiscal: ".$this->perfis);
	$this->setXY(27,31);
	$this->cell(40,4,"Desde:  ".self::periodo($perdesde,1)."   Hasta:  ".self::periodo($perhasta,2));
	$this->setY($y);
  }

   public static function getEmpresa()
  {
    $conn= new baseClases();
    $sql="SELECT * from empresa limit 1 ";
    $arrsql=$conn->select($sql);

    if(count($arrsql)>0) return $arrsql[0];
    else return array();

  }

  public static function periodo2($periodo,$ano)
	{

			if($periodo=="01"||$periodo=="03"||$periodo=="05"||$periodo=="07"||$periodo=="08"||$periodo=="10"||$periodo=="12")
				return $ano."-".$periodo."-"."31";
			elseif($periodo=="04"||$periodo=="06"||$periodo=="09"||$periodo=="11")
			    return $ano."-".$periodo."-"."30";
			else
				return $ano."-".$periodo."-"."29";

	}


}




class H extends Herramientas
{

}


?>