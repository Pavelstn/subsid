<?php

include_once("input.php");

class select_number extends input
{
  //
  //set_name($new_name)
  //get_name()
  //set_value($new_value)
  //get_value()
  //set_init_method($new_init_method)
  //get_init_method()
  //popPostVar($varName)//обработка событий//
  
  var $start_range="0";
  var $stop_range="100";
  var $default_value="";
  var $on_change= false;
  
  function set_start_range($new_range)
  	{
	    $this->start_range= $new_range;
	}
	
  function set_stop_gange($new_range)
  	{
	    $this->stop_range= $new_range;
	}

  function set_range($start, $stop)
  	{
	    $this->start_range= $start;
	    $this->stop_range= $stop;
	}
	
  function set_default($new_default)
  	{
	    $this->default_value= $new_default;
	}
	
  function get_default()
  		{
		    return $this->default_value;
		}
	
  function cath_event()
			{
			  $event=   $this->popPostVar($this->name);
			  if($event)
			  	{
				    $this->default_value= $event;  
				}
			}
			
  function to_html()
  	{
	    //
	    $head_string= "\n<select size=\"1\" name=\"".$this->name."\" ";
	    if($this->on_change) $head_string= $head_string."onchange= this.form.submit()";
	    $head_string= $head_string.">\n";
	    echo $head_string;
	    for($i=$this->start_range; $i<= $this->stop_range; $i++)
	    	{
			  if($this->default_value!= $i) { echo "<option value=\"".$i."\">".$i."</opton>\n";}
			  if($this->default_value== $i) { echo "<option value=\"".$i."\" selected >".$i."</opton>\n";}
			}
		echo "</select>\n";	
	}
	
function select_number($name, $start, $stop)	
	{
	  $this->set_name($name);
	  $this->set_range($start, $stop);
	  $this->cath_event();
	}	
  
}

?>