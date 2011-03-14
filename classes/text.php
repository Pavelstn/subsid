<?php

include_once("input.php");

class text extends input
{
  //set_name($new_name)
  //get_name()
  //set_value($new_value)
  //get_value()
  //set_init_method($new_init_method)
  //get_init_method()
  //popPostVar($varName)//обработка событий//
  
var $size=20;
var $maxlength=100;

  function set_size($new_size)
  	{
	    $this->size= $new_size;
	}
  
  function set_maxlength($new_maxlength)
  	{
	    $this->maxlength= $new_maxlength;
	}

  function cath_event()
  	{
	    $event= $this->popPostVar($this->get_name());
	    if($event)
			{
				$this->set_value($event);
			}
	}
	
  function to_html()
  	{
	    //<input type="text" name="T1" size="20" maxlength="50" value="dgfdf">
	    echo "<input type=\"text\" ";
	    echo "name=\"".$this->get_name()."\" ";
	    echo "size=\"".$this->size."\" ";
	    echo "maxlength=\"".$this->maxlength."\" ";
	    echo "value=\"".$this->get_value()."\" ";
	    echo ">\n";
	    
	}
	
	function text($name)
		{
		  $this->set_name($name);
		  $this->cath_event();
		}
}