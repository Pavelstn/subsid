<?php
//alert
class message
{
  var $core_message;
  
  
  
  function add_alert($text_alert)
  	{
	    $this->core_message[]= "window.alert(\"".$text_alert."\")\n";
	}
	
 function to_html()
 	{
	   echo "<script language=JavaScript>\n";
	    $indexLimit = count($this->core_message);
    	for($index=0; $index < $indexLimit; $index++)
    		{
        		echo $this->core_message[$index]."\n";
    		}
		echo "</script>\n";
	}	
}