<?php
include_once("../classes/database_work.php");


$database= new database_work;
$database->connect_db();

function get_sezon($data)
	{
	  echo "<hr>\n get_sezon<p>\n";
	  $db= new database_work;
	  $db->connect_db();
	  $id_s= 0;
	  $query= "SELECT * FROM sezon WHERE start_sezon <= '".$data."' AND '".$data."' <= stop_sezon";
	  $res= mysql_query($query) or die( mysql_eror());
	  while($row= mysql_fetch_array($res))
	  	{
		    $id_s= $row["id_sezon"];
		    //echo $row["sezon_name"];
		    
		}
	$db->dis_connect_db();
	unset($db);
	return $id_s;
	}
////////////////////////////////////

function get_tarif($data, $id_uslug)
	{
	  echo "<hr>\n get_tarif<p>\n";
	  $id_s= get_sezon($data);
	  
	  $db= new database_work;
	  $db->connect_db();
	  $mv= 0;
	  $query= "SELECT * FROM tarif_net WHERE start_date <= '".$data."' AND '".$data."' <= stop_date AND id_sezon= '".$id_s."' AND id_uslug= '".$id_uslug."'";
	 // echo "<hr>\n";
	 // echo $query;
	 // echo "<hr>\n";
	  $res= mysql_query($query) or die( mysql_eror());
	  while($row= mysql_fetch_array($res))
	  	{
		    $mv= $row["money_value"];
		}
	  $db->dis_connect_db();
	  unset($db);
	  return $mv;
	}








?>