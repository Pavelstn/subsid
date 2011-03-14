<?php
include_once("./lib/rashod1.php");
include_once("./lib/lgota.php");

include_once("../classes/database_work.php");

include_once("./lib/calc_alt_uslug.php");
include_once("./lib/calc_hous_uslug.php");


function calc_all_uslug($id_h, $strt, $stp)
	{
	  echo "<hr>\n calc_all_uslug<p>\n";
	  
	  $db_load= new db_load("SELECT point_uslug, point_otopl FROM soderg_house");
      $minus_uslg= $db_load->row["point_uslug"];
	  $minus_otopl= $db_load->row["point_otopl"]; 
	  unset($db_load);
	  
	  $db= new database_work;
	  $db->connect_db();  
	  $mny= 0;
	  

	    //$que= "SELECT * FROM uslug WHERE id_home='".$id_h."'";
	    $que= "SELECT * FROM uslug, sprav_uslug WHERE uslug.id_vid_uslug= sprav_uslug.id_uslug AND uslug.id_home='".$id_h."'";
	    $res= mysql_query($que) or die( mysql_eror());
	    while($row= mysql_fetch_array($res))
	    	{
			   //id_uslug
			   
			  
			   // value_uslug
			   $n_uslg= $row["id_vid_uslug"];
			   if(($n_uslg!= $minus_uslg) AND ($n_uslg!= $minus_otopl))
			   {
//			     echo $row["uslug_name"];
			     $k= koef_lgot($n_uslg, $id_h); 
			     $f= scroll_day($strt, $stp, $n_uslg);
			     $mny+= $k* $f;
//			     echo " Льгота ".$k." ";
//			     echo "[без льгот на человека ". $f."] ";
//			     echo " -> ".$k* $f." рублей <br>\n";
				}
			}
		$db->dis_connect_db();
		
		$deng["NORM"]= $mny;
		$deng["FACT"]= $mny;
		$otpl= calc_alt_uslug($id_h,$minus_otopl, $strt, $stp);
			$deng["NORM"]+= $otpl["NORM"];
			$deng["FACT"]+= $otpl["FACT"];
//			echo "<br>\n Отопление жилья<br>\n";
//			echo "По норме=".$otpl["NORM"]."<br>\n";
//			echo "По факту=".$otpl["FACT"]."<br>\n";
			
		$ho= calc_hous_uslug($id_h,$minus_uslg, $strt, $stp);
			$deng["NORM"]+= $ho["NORM"];
			$deng["FACT"]+= $ho["FACT"];
			
//			echo "<br>\n Содержание жилья<br>\n";
//			echo "По норме=".$ho["NORM"]."<br>\n";
//			echo "По факту=".$ho["FACT"]."<br>\n";
	 // return $mny;
	 return $deng;
	}








?>