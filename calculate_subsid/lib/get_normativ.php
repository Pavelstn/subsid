<?php
include_once("../classes/database_work.php");


function get_normativ($data, $id_uslug)
	{	  
	  echo "<hr>\n get_normativ<p>\n";
	  $dbs= new database_work;
	  $dbs->connect_db();
	  $norma= 0;
	  $query= "SELECT * FROM norm_uslug WHERE start <= '".$data."' AND '".$data."' <= stop  AND id_sprav_uslug= '".$id_uslug."' LIMIT 1";
	 // echo "<hr>\n";
	 // echo $query;
	 // echo "<hr>\n";
	  $res= mysql_query($query) or die( mysql_eror());
	  while($row= mysql_fetch_array($res))
	  	{
		    $norma= $row["value_norm"];
		}
		
	  $dbs->dis_connect_db();
	  unset($dbs);
	  
	  return $norma;
	}


?>