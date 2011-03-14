<?php
//db_select
include_once("database_work.php");

class db_select extends database_work
{
  //set_database($database);  //default= "subsid"
  //set_user_data($user_name, $user_password);   //default: $user_name="", $user_password=""
  //connect_db();
  //dis_connect_db();
  var $name="";
  var $table="";
  var $index_row="";
  var $visible_row="";
  var $query="";
  var $selected;
  var $submit= true;
  var $flag_auto_query= true;
  
  function set_submit($submit)
  	{
	    $this->submit= $submit;
	}
  
  function set_name($name)
  	{
	    $this->name= $name;
	}
	
	function get_value()
		{
		  return $this->selected;
		}
	function set_value($value)
		{
		  $this->selected= $value;
		}
		
  
//////////////////////////////////////////////////////////////////////
		function popPostVar($varName)
			{
			  //по идее эта функция выбирает параметы которые были переданы форме//
				$result=false;
				if (!empty($_POST[$varName]))
			//	$result=(get_magic_quotes_gpc()?$_POST[$varName]:addslashes($_POST[$varName]));
				$result= $_POST[$varName];
				return $result;
			}
	function cath_event()
			{
			  $event=   $this->popPostVar($this->name);
			  if($event)
			  	{
				    $this->selected= $event;
				    if($this->debug_mode)  echo $this->selected."<br>\n";
				}
			}
/////////////////////////////////////////////////////////////////////  
  
  
  function set_data($table, $index_row, $visible_row)
  	{
	    $this->table= $table;
	    $this->index_row= $index_row;
	    $this->visible_row= $visible_row;  
	}
	
  function set_query($query)
  	{
	    $this->query= $query;
	    $this->flag_auto_query= false;
	    
	}
		
  function make_query()
  	{
  	  
	    $this->query= "SELECT ".$this->index_row.", ".$this->visible_row." FROM ".$this->table." ORDER BY '".$this->index_row."' ASC";
	   if($this->debug_mode) echo $this->query."<br>\n";
	}
	


	function to_html()
	{
	  //
	  	$this->cath_event();
	  	if($this->flag_auto_query){ $this->make_query(); }
	  	
	    $this->connect_db();
	    $result= mysql_query($this->query) or die (mysql_error());
	    $head_string= "\n<select size=\"1\" name=\"".$this->name."\" ";
	    if($this->submit) $head_string= $head_string."onchange= this.form.submit()";
	    $head_string= $head_string.">\n";

		echo $head_string;
		while($row= mysql_fetch_array($result))
	    	{
			  	$make_select_string= "<option value=\"".$row[$this->index_row]."\"";
				if($row[$this->index_row]== $this->selected) $make_select_string= $make_select_string."  selected";
				$make_select_string= $make_select_string.">".$row[$this->visible_row]."</opton>\n";
				echo $make_select_string;
			}
		echo "</select>\n";	
	}
	////////////////////////////////////////////////////////////////////
	function db_select($name, $table, $index_row, $visible_row)	
		{
		  //
		  $this->set_name($name);
		  $this->set_data($table, $index_row, $visible_row);
		  $this->cath_event();
		}
}
?>