<?php
include_once("../classes/database_work.php");


$database= new database_work;
$database->connect_db();

function get_sezon($data)
	{
	  $database= new database_work;
	  $database->connect_db();
	  $id_sezon= 0;
	  $query= "SELECT * FROM sezon WHERE start_sezon <= '".$data."' AND '".$data."' <= stop_sezon";
	  $result= mysql_query($query) or die( mysql_eror());
	  while($row= mysql_fetch_array($result))
	  	{
		    $id_sezon= $row["id_sezon"];
		    //echo $row["sezon_name"];
		    
		}
	$database->dis_connect_db();
	unset($database);
	return $id_sezon;
	}
////////////////////////////////////

function get_tarif($data, $id_uslug)
	{
	  $id_sezon= get_sezon($data);
	  
	  $database= new database_work;
	  $database->connect_db();
	  $money_value= 0;
	  $query= "SELECT * FROM tarif_net WHERE start_date <= '".$data."' AND '".$data."' <= stop_date AND id_sezon= '".$id_sezon."' AND id_uslug= '".$id_uslug."'";
	 // echo "<hr>\n";
	 // echo $query;
	 // echo "<hr>\n";
	  $result= mysql_query($query) or die( mysql_eror());
	  while($row= mysql_fetch_array($result))
	  	{
		    $money_value= $row["money_value"];
		}
	  $database->dis_connect_db();
	  unset($database);
	  return $money_value;
	}








?>