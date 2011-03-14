<?php
//функции для тестового заполнения базы//
include_once("../../classes/database_work.php");

function init_kladr($pointer_kladr)
	{
	  //инициализация адресов//
	 $db= new database_work; 
	$query="SELECT code FROM street";
	$db->connect_db();
	$result= mysql_query($query) or die (mysql_error());
	  	while($row= mysql_fetch_array($result))
	  		{
				//echo $row["code"]."<br>\n";
				array_push($pointer_kladr, $row["code"]);
			}
	}
	
function new_house($code_street)
	{
	    $db= new database_work;
	    $db->connect_db();
	    $query= " INSERT INTO house ( code_street,  nomer_doma, nomer_korpusa, nomer_kvartiri  ) VALUES ('".$code_street."','6','6','6')";
	    $result= mysql_query($query) or die (mysql_error());
	   // echo $query."<br>\n";
	   	$id_house= mysql_insert_id();
	   	
	   	$query= " INSERT INTO house_env (id_home) VALUES ('".$id_house."')";
             //$this->connect_db();
             $result= mysql_query($query) or die (mysql_error());
             $db->dis_connect_db();
	   
	}


?>