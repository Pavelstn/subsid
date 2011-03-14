<?php
include_once("../classes/database_work.php");


function get_tnornativ($data, $id_uslug)
	{
	  
	  
	  $database= new database_work;
	  $database->connect_db();
	  $value_norm= 0;
	  $query= "SELECT * FROM norm_uslug WHERE start <= '".$data."' AND '".$data."' <= stop  AND id_sprav_uslug= '".$id_uslug."'";
	 // echo "<hr>\n";
	 // echo $query;
	 // echo "<hr>\n";
	  $result= mysql_query($query) or die( mysql_eror());
	  while($row= mysql_fetch_array($result))
	  	{
		    $value_norm= $row["value_norm"];
		}
	  $database->dis_connect_db();
	  unset($database);
	  return $value_norm;
	}













?>