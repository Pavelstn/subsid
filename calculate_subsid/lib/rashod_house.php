<?php
include_once("calc_tarif.php");
include_once("get_house_normativ.php");


function next_day_($dat)
{
  $ye= $dat[0].$dat[1].$dat[2].$dat[3];
  $mo= $dat[5].$dat[6];
  $da= $dat[8].$dat[9];
  
  $nx_d  = mktime(0,0,0,$mo  ,$da+1,$ye);
  $nx_d  =date("Y-m-d",$nx_d);
  return $nx_d;
}
////////////////////////////////////

function rashod_house($strt, $stp, $uslg, $id_house)
  {
    $nxt="";
    $deng= 0;
    for($nxt= $strt; $nxt<=$stp;$nxt= next_day_($nxt))
    	{
  	    $ye= $nxt[0].$nxt[1].$nxt[2].$nxt[3];
  	    $mo= $nxt[5].$nxt[6];
  	    $da= $nxt[8].$nxt[9];
  	    
  	    $tar= get_tarif($ye."-".$mo."-".$da, $uslg);
  	    
  	    //$nor= get_normativ($ye."-".$mo."-".$da, $uslg);
		  //$nor= get_house_normativ($id_house);
		  $nor= 1;	  
		  // echo "Норма по домовладению ".$nor." кв.м.<br>\n";
		  // echo "Тариф ".$tar." рубей за 1 кв.м. в месяц<br>\n";
		   
  	    $mon= date ("t",mktime (0,0,0,$mo,$da,$ye));

	$deng+= $tar/$mon;
  	   // echo "<br>\n";
  	}
  	//echo "<br>\n всего за период расчета=".$deng."<br>\n";
  	return $deng;
  }
?>