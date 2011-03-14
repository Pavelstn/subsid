<?php


class webpage
{
  var $title="webpage";
  var $bgcolor="#FFFFFF";
  
  var $objects;
//  var $objet
  
  function add_object($new_object)
  	{
	    //
	    $name= $new_object->get_name();
	    $this->objects[$name]= $new_object;
	}
 function test1()
 	{
		    foreach($this->objects as $key=>$value)
    			{
       			 //print("$key is $value.<br>\n");
       			 	$this->objects[$key]->to_html();
    			}


	}
 
// function title($title)
// 	{
//	   $this->title= $title;
//	}

// function bgcolor($color)
// 	{
//	   $this->bgcolor= $color;
//	}
	
	
 function to_html()
 	{
	   //
	   echo "<html>\n";
	   echo "<head>\n";
       echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">\n";
       echo "<title>".$this->title."</title>\n";
       echo "</head>\n";
       echo "<body bgcolor=\"".$this->bgcolor."\">\n";
       echo "<form method=\"POST\" action=\"index.php\">";
       $this->test1();
       echo "</form>\n";
       echo "</body>\n";
       echo "</html>\n";
       
	}	
 
}



?>