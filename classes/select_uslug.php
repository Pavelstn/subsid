<?php
include_once("database_work.php");

class n_select_uslug extends database_work
	{
	  //include_once("../function_define.php");
	  //класс дл€ вывода списка услуг//
	  var $text= "";
	  var $default_value="";
	  var $onchange= true;
	  var $zero_select= true; 
	  var $html_name= "uslug";
	  
	  	function set_onclick($new_text)
	  		{
			    //
			    $this->text= $new_text;
			}
		function get_value()
			{
			  return $this->default_value;
			}	
			
		function seclect_uslug($id_group, $default)
		{
	  	//
	  	$query="SELECT * FROM sprav_uslug  WHERE id_group_uslug= '$id_group' ORDER BY 'id_uslug'";
	  	$this->connect_db();
	  	$result= mysql_query($query) or die (mysql_error());
	  	while($row= mysql_fetch_array($result))
	  		{
		    	//
		    	if($row["id_uslug"]!= $default)
		    		{
				  		echo "<option value=\"".$row["id_uslug"]."\">".$row["uslug_name"]."  [".$row["ed_izm"]."]</option>\n";
					}
				else
					{
				  		echo "<option value=\"".$row["id_uslug"]."\"  selected >".$row["uslug_name"]."  [".$row["ed_izm"]."]</option>\n";
					}
			}
		}

		function n_select_group_uslug($default)
			{
	 	 	//
	  		//echo "n_select_group_uslug";
	  
	 	 	$query="SELECT * FROM group_uslug ORDER BY 'id_group_uslug'";
	 	 	$this->connect_db();
	  		$result= mysql_query($query) or die (mysql_error());
	  		
	  		if($this->onchange) { $this->text= "onchange= this.form.submit()"; }
	  		
	  		echo "<select name=\"".$this->html_name."\" ".$this->text." >\n";
      if($this->zero_select) 
      		{
			    echo "<option value=\"0\">¬ыберите услугу</option>\n";
			}
	  
	  		while($row= mysql_fetch_array($result))
	  			{
		    		//
		    		echo "<optgroup label=\"".$row["group_name"]."\">\n";
		    		$this->seclect_uslug($row["id_group_uslug"], $default);
		    		echo "</optgroup>\n";
				}
					echo "</select>\n";	  
			}
		function set_default($new_default)
			{
			  //
			  $this->default_value= $new_default;
			}
			
	function popPostVar($varName)
			{
				$result=false;
				if (!empty($_POST[$varName]))
				$result= $_POST[$varName];
				return $result;
			}

  	function cath_event()
			{
			  $event=   $this->popPostVar($this->html_name);
			  if($event)
			  	{
				    $this->set_default($event);
				}
			}
			
		function to_html()
			{
			  //
			  $this->n_select_group_uslug($this->default_value);
			}
	  
	  function n_select_uslug()
	  	{
		    $this->cath_event();
		}
}

?>