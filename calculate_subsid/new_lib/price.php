<?php
include_once("core_norm.php");
include_once("core_tarif.php");


class price
{
  var $calendar;
  ////////////////
  function get_year($dat)
  	{
	    return $dat[0].$dat[1].$dat[2].$dat[3];
	}
  function get_month($dat)
  	{
	    return $dat[5].$dat[6];
	}
  function get_day($dat)
  	{
	    return $dat[8].$dat[9];
	}
/////////////////////////////////////////////////////////////////////////////  
  
  function next_day($dat)
	{
  		$ye= $this->get_year($dat);
  		$mo= $this->get_month($dat);
  		$da= $this->get_day($dat);
  
  		$nx_d  = mktime(0,0,0,$mo  ,$da+1,$ye);
  		$nx_d  =date("Y-m-d",$nx_d);
  		return $nx_d;
	}
////////////////////////////////////
function scroll_day($strt, $stp)
  {
    $tarif= new core_tarif;
    $tarif->init_tarif($strt, $stp);
    //-----------------------------------//
    $norm= new core_norm;
    $norm->init_norm($strt, $stp);
    //-----------------------------------//
    
    $nxt="";
    //$deng= 0;
    //$count= 0;
    for($nxt= $strt; $nxt<=$stp;$nxt= $this->next_day($nxt))
    	{

  		$ye= $this->get_year($nxt);
  		$mo= $this->get_month($nxt);
  		$da= $this->get_day($nxt);
  		/////////////////////////////////////
  		for($i= 0;$i< $tarif->count; $i++)
		  	{
		  	  	//echo $i." ";
				$uslg= $tarif->id_uslug[$i];
				$deng_trf= $tarif->get_tarif($nxt, $uslg);
				//---------------------------------------//
				$nrm= $norm->get_normativ($nxt, $uslg);
				///////////////////////////////////////
				$mon= date ("t",mktime (0,0,0,$mo,$da,$ye));
				//$deng= $deng_trf*$nrm/$mon;
				$deng[$uslg]= $deng_trf*$nrm/$mon;
			//	echo "День-".$nxt." Стоимость услуги ".$uslg." равна-".$deng[$uslg]." рублей<br>\n";
				
				
				$this->calendar[$nxt]= $deng;
				//echo $deng."<br>\n";
			}
		}

  }
}
?>