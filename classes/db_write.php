<?php
//db_select
include_once("database_work.php");

class db_write extends database_work
{
  //
  var $query;
  var $rows= "";
  var $values= "";
  var $table_name="";
  
  function set_rows($rows)
  	{
	    $this->rows= $rows;
	}
  function set_values($values)
  	{
	    $this->values= $values;
	}
  function set_table_name($table_name)
  	{
	    $this->table_name= $table_name;
	}	
	
  function make_query()
  	{
	    $this->query= "INSERT INTO ".$this->table_name." (".$this->rows.") VALUES (".$this->values.")";
	}
  function show_query()
  	{
	    echo "<hr>\n".$this->query."\n<hr>\n";
	}
  function write_to_base()
  	{
	    $this->connect_db();
	    $result= mysql_query($this->query) or die( mysql_eror());
	    $this->dis_connect_db();
	}
	
  function db_write($table_name, $rows, $values)
  	{
	    $this->set_table_name($table_name);
	    $this->set_rows($rows);
	    $this->set_values($values);
	    $this->make_query();
	   // $this->show_query();
	    //if(!$this->debug_mode) $this->show_query();
	    $this->write_to_base();
	    
	}		
}
?>