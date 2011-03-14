<?php
include_once("rashod_house.php");
include_once("lgota.php");

include_once("../classes/database_work.php");
include_once("../classes/db_load.php");




function calc_house_uslug($id_h, $strt, $stp)
	{
	  echo "<hr>\n calc_house_uslug<p>\n";
	  //$db= new database_work;
	  //$db->connect_db(); 
	  $db_load= new db_load("SELECT point_uslug FROM soderg_house");
      $n_uslg= $db_load->row["point_uslug"]; 
      unset($db_load);
	  $mny= 0;
//	  echo "указатель на услугу".$n_uslg." <br>\n";
	    //$que= "SELECT * FROM uslug WHERE id_home='".$id_h."'";
	    //$res= mysql_query($que) or die( mysql_eror());
	   // while($row= mysql_fetch_array($res))
	   // 	{
	     
	     	  $calc_people= new calc_people;
	  		  $calc_people->id_house= $id_h;
	  		  $calc_people->calc();
	  		  //$calc_people->subsid_people;
	///		   //id_uslug
	//		   //id_vid_uslug
	//		   // value_uslug
			   //$n_uslg= $row["id_vid_uslug"];
//			   echo "код домовладени€ ".$id_h." <br>\n";
			   
			   $k= koef_lgot($n_uslg, $id_h); 
			   if($calc_people->subsid_people!= 0) $k= $k /$calc_people->subsid_people;
			   else $k= 0;
			   //echo $k."- Ћьгота  ";
			   
			   $f= rashod_house($strt, $stp, $n_uslg, $id_h);
			  // echo "<hr>\n";
			  // echo "денег без льгот ".$f."\n";
			  // echo "<hr>\n";
			   $mny= $k* $f;
			  // echo "<hr>\n";
			  // echo "денег со льготами ".$mny."\n";
			  // echo "<hr>\n";
	//}
	  return $mny;
	}








?>