<?php
include_once("database_work.php");

class db_load extends database_work
{
  //var $text;
  //var $result;
  var $query= "";
  var $row;
  

  function load_from_base()
  	{
      $this->connect_db();
      $result= mysql_query($this->query) or die (mysql_error());
      $this->row= mysql_fetch_array($result);
      $this->dis_connect_db(); 
	} 
	
  function db_load($query)
  		{
		    $this->query= $query;
		    $this->load_from_base();
		}	  
  
  
}




?>