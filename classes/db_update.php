<?php
include_once("database_work.php");

class db_update extends database_work
{
  //var $text;
  //var $result;
  var $query= "";
//  var $row;
  

  function load_from_base()
  	{
      $this->connect_db();
      echo $this->query;
      $result= mysql_query($this->query) or die (mysql_error());
      $this->dis_connect_db(); 
	} 
	
  function db_update($query)
  		{
		    $this->query= $query;
		    $this->load_from_base();
		}	  
  
  
}




?>