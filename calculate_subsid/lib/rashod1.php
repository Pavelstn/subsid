<?php
include_once("calc_tarif.php");
include_once("get_normativ.php");


function next_day($dat)
{
  $ye= $dat[0].$dat[1].$dat[2].$dat[3];
  $mo= $dat[5].$dat[6];
  $da= $dat[8].$dat[9];
  
  $nx_d  = mktime(0,0,0,$mo  ,$da+1,$ye);
  $nx_d  =date("Y-m-d",$nx_d);
  return $nx_d;
}
////////////////////////////////////
function scroll_day($strt, $stp, $uslg)
  {
    $nxt="";
    $deng= 0;
    for($nxt= $strt; $nxt<=$stp;$nxt= next_day($nxt))
    	{
  	    $ye= $nxt[0].$nxt[1].$nxt[2].$nxt[3];
  	    $mo= $nxt[5].$nxt[6];
  	    $da= $nxt[8].$nxt[9];
  	    
  	    $tar= get_tarif($ye."-".$mo."-".$da, $uslg);
  	    $nor= get_normativ($ye."-".$mo."-".$da, $uslg);	   
  	    $mon= date ("t",mktime (0,0,0,$mo,$da,$ye));

	$deng+= $tar*$nor/$mon;
  	   // echo "<br>\n";
  	}
//  	echo " Норма ".$nor." ";
  	return $deng;
  }
?>