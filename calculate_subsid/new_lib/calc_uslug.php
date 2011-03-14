<?php

class calc_uslug
{
  var $all_uslug;
  var $nxt="";
  /////////////////////////////////
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
 		
  function next_day($dat)
	{
  		$ye= $this->get_year($dat);
  		$mo= $this->get_month($dat);
  		$da= $this->get_day($dat);
  
  		$nx_d  = mktime(0,0,0,$mo  ,$da+1,$ye);
  		$nx_d  =date("Y-m-d",$nx_d);
  		return $nx_d;
	}
//////////////////////////////////////////////////////////
	function calc(&$price, &$private_uslug, $strt, $stp)
		{
		  //
		  for($nxt= $strt; $nxt<=$stp; $nxt= $this->next_day($nxt))
    		{
				$deng= $price->calendar[$nxt];
				for($i= 0; $i< $private_uslug->count; $i++ )
					{
				  		$aa= $private_uslug->id_vid_uslug[$i];
				  		if(!isset($this->all_uslug[$aa])) $this->all_uslug[$aa]=0;
				  		$this->all_uslug[$aa]+= $deng[$aa];
					}
			}
		}
/////////////////////////////////////////////////////////////////////////
		function calc2(&$core_tarif, $uslug, $strt, $stp)
		{
		  //
		  $tarif= 0;
		  for($nxt= $strt; $nxt<=$stp; $nxt= $this->next_day($nxt))
    		{
				//$deng= $price->calendar[$nxt];
			//	for($i= 0; $i< $private_uslug->count; $i++ )
			//		{
			//	  		$aa= $private_uslug->id_vid_uslug[$uslug];
				  		//if(!isset($this->all_uslug[$aa])) $this->all_uslug[$aa]=0;
			//	  		$tarif+= $deng[$aa];
			//		}
			  		$ye= $this->get_year($nxt);
  					$mo= $this->get_month($nxt);
  					$da= $this->get_day($nxt);
  					
  					$mon= date ("t",mktime (0,0,0,$mo,$da,$ye));
			  $tarif+= ($core_tarif->get_tarif($nxt, $uslug))/$mon;
			}
		 return $tarif;	
		}
}





// 
// 	//echo $all_uslug[46]."<br>\n";
// 		while (list ($key, $val) = each ($all_uslug) ) :
// 		echo "услуга ".$key." деньги ".$val."<br>\n";
// 		endwhile;
// 
// ///////////////////////////////////////////
// echo "</form>\n";

?>