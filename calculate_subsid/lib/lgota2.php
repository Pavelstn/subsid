<?php
include_once("get_house_normativ.php");
include_once("../classes/database_work.php");

    function calc_lgot__($range, $id_home, $id_people, $id_uslug)
  	{
  	  echo "<hr>\n calc_lgot__<p>\n";
  	  
	    $pG_lgot= 0; //процент глобальной льготы //
	    $cG_lgot= 0; //счетчик глобальных льгот  //
	    
	    $pL_lgot= 100;  //процент локальных льгот  //
	    $cL_lgot= 0;   //счетчик локальных льгот  //
	    
	    $Dbase= new database_work;
	    $Dbase->connect_db();
	    $tables= "udostover, lgot, uslug";
	    $where1= "udostover.id_vid_udostover= lgot.id_sprav_udostover AND  uslug.id_vid_uslug= lgot.id_sprav_uslug ";
	    $where2= " AND uslug.id_home='".$id_home."' AND udostover.id_people= '".$id_people."' AND uslug.id_vid_uslug= '".$id_uslug."'";
	    $where3= " AND  lgot_range='2' "; //ищем только глобальные льготы//
	    $where4= " AND  lgot_range='1' "; //ищем только локальные льготы//

	    $query= "SELECT * FROM ".$tables. " WHERE ". $where1. $where2;
	    if($range=="GLOBAL")
	    	{
			  $query= $query.$where3." LIMIT 1";
// 			  echo "<hr>\n";
// 			  echo $query;
// 			  echo "<hr>\n";
			}
	    else
	    	{
			  $query= $query.$where4." LIMIT 1";
			}

// 			  echo "<hr>\n";
// 			  echo $query;
// 			  echo "<hr>\n";


	    $result= mysql_query($query) or die( mysql_eror());
	    while($row= mysql_fetch_array($result))
	    	{
	    	  if($range=="GLOBAL")
	    	  	{
	    	  $pG_lgot+= $row["percent"];
	    	  //echo $pG_lgot."---<br>\n";
			  $cG_lgot++;
				}
			else
				{
					$pL_lgot= $row["percent"];
			  		$cL_lgot++;
			  		//echo "  ;local lgot ".$pL_lgot;
				}
			}


			  if($range=="GLOBAL")
			  	{
					if($cG_lgot>1)
						{
						  	echo "ќшибка: указано слишком много √ЋќЅјЋ№Ќџ’ Ћ№√ќ“ уберите лишние льготы<br>\n";
			  				$pG_lgot= 100;
						}
//						echo "-=".$pG_lgot."=-";
					return $pG_lgot;	
				}
			else
				{
					if($cG_lgot>1)
						{
						  	echo "ќшибка: указано слишком много Ћќ јЋ№Ќџ’ Ћ№√ќ“ у человека ".$id_people." уберите лишние льготы<br>\n";
			  				$pL_lgot= 100;
						}
						//echo "  ;local lgot ".$pL_lgot;
					return $pL_lgot;
				}
		$Dbase->dis_connect_db();
       unset($Dbase);	
	} 

////////////////////////////////////////////////////////////////////////////////////////////////////////
function koef_lgot_($usluga, $house)
	{
	  $Llgot=0;    //локальна€ льгота //
	  $Glgot= 0; //глобальна€ льгота//
	  $Dbase= new database_work;
	  $people= 0;
	  	$Dbase->connect_db();

	    $query= "SELECT id_people FROM people WHERE id_home='".$house."' AND to_be= '1'";  //¬ыбираем людей, имеющих право на субсидию //

	    $result= mysql_query($query) or die( mysql_eror());
	    while($row= mysql_fetch_array($result))
	    	{
			  $Llgot+= calc_lgot__("LOCAL", $house, $row["id_people"], $usluga);
//			  echo "  local lgot ".$Llgot;
			  $Glgot+= calc_lgot__("GLOBAL", $house, $row["id_people"], $usluga);
			  $people++;
//			  echo " people ".$people." ";			  
			}
			$Dbase->dis_connect_db();
			unset($Dbase);
// 			echo "<br>\n";
// 			echo $Glgot."-";
		
		if($Glgot== 0) $Glgot= 100;
		
		//$cl= ($Llgot*$Glgot)/10000;
		$cl["LOCAL"]= $Llgot/100;
		$cl["GLOBAL"]= $Glgot/100;
		return $cl;
	}

?>