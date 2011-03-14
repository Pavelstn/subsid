<?php

include_once("input.php");

class hidden extends input
{
  //set_name($new_name)
  //get_name()
  //set_value($new_value)
  //get_value()
  //set_init_method($new_init_method)
  //get_init_method()
  //popPostVar($varName)//обработка событий//



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
	    //<input type="password" name="T2" size="20" maxlength="50" value="passs">
	    echo "<input type=\"hidden\" ";
	    echo "name=\"".$this->get_name()."\" ";
	   // echo "size=\"".$this->size."\" ";
	   // echo "maxlength=\"".$this->maxlength."\" ";
	    echo "value=\"".$this->get_value()."\" ";
	    echo ">\n";
	    
	}
	
 function hidden($name)
 	{
	   $this->set_name($name);
	   $this->cath_event();
	}
}