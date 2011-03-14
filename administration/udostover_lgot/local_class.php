<?php
include_once("../../lib/function_define.php");

class  select_udostover
{
  		var $name= "select_udostover";
  		var $value_default= 0;
  		var $add_text= "onchange= this.form.submit()";
  		
  		function get_default()
  			{
			   return $this->value_default;
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
		  	if($this->popPostVar($this->name))
				{ 
				 $this->value_default=   $this->popPostVar($this->name);
				}
		}
			
	function to_html()
        {
          $this->cath_event();
          
          //$add_text= "onchange= this.form.submit()";
          $get_query= "SELECT * FROM sprav_udostover ORDER BY id_udostover ASC";
            echo "<select size=\"1\" name=\"".$this->name."\" ".$this->add_text.">\n";
            
            connect_to_my_db();
            $result= mysql_query($get_query) or die (mysql_error());
            while($row= mysql_fetch_array($result))
                {
                    //echo "<option value=",$row["id_udostover"],">", $row["name_ud"],"</opton>\n";
                    if($row["id_udostover"]== $this->value_default)
                    	{
						  echo "<option value=",$row["id_udostover"]," selected>", $row["name_ud"],"</opton>\n";
						}
					else
					{
					  echo "<option value=",$row["id_udostover"],">", $row["name_ud"],"</opton>\n";
					}
                }
                 echo "</select>\n";
        }
        
	function select_udostover()
		{
		  $this->to_html();
		}
} 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class select_uslug extends n_select_uslug
{
         function popPostVar($varName)
			{
				$result=false;
				if (!empty($_POST[$varName]))
				$result= $_POST[$varName];
				return $result;
			}  

	function cath_event()
		{
		  	if($this->popPostVar("uslug"))
				{ 
				 $this->default_value=   $this->popPostVar("uslug");
				}
		}
	function get_default()
		{
		  return $this->default_value;
		}
  
  function to_html_()
  	{
  	  	$this->cath_event();
	    $this->to_html();
	}
	function select_uslug()
		{
		  $this->to_html_();
		}
}
//////////////////////////////////////////////////////////////////////////////////
class select_percent
{
  var $name= "minus_percent";
  var $default_value= "100";
  var $add_text="";
  
	function get_default()
  	{
	    return $this->default_value;
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
		  	if($this->popPostVar($this->name))
				{ 
				 $this->default_value=   $this->popPostVar($this->name);
				} 
		} 
		
	function count($default_value)
		{
		  //
		  for($i=0; $i<=100; $i++)
		  	{
			    if($i== $default_value) { echo "<option value=",$i," selected>", $i,"</opton>\n";}
			    else { echo "<option value=",$i,">", $i,"</opton>\n";}
			}
		}
	function select()
		{
		  //
		  echo "<select size=\"1\" name=\"".$this->name."\" ".$this->add_text.">\n";
		  $this->count($this->default_value);
		  echo "</select>\n";
		}
	function to_html()
		{
		  $this->cath_event();
		  $this->select();
		}
	function select_percent()
		{
		  $this->to_html();
		                   echo "</select>\n";

		}
		
	  
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class  select_lgot_range
{
  		var $name= "select_lgot_range";
  		var $value_default= 1;
  		var $add_text="";
  		
  		function get_default()
  			{
			   return $this->value_default;
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
		  	if($this->popPostVar($this->name))
				{ 
				 $this->value_default=   $this->popPostVar($this->name);
				}
		}
			
	function to_html()
        {
          $this->cath_event();
          
          $add_text= "onchange= this.form.submit()";
          $get_query= "SELECT * FROM lgot_range ORDER BY id_lgot_range ASC";
            echo "<select size=\"1\" name=\"".$this->name."\" ".$this->add_text.">\n";
            
            connect_to_my_db();
            $result= mysql_query($get_query) or die (mysql_error());
            while($row= mysql_fetch_array($result))
                {
                    //echo "<option value=",$row["id_udostover"],">", $row["name_ud"],"</opton>\n";
                    if($row["id_lgot_range"]== $this->value_default)
                    	{
						  echo "<option value=",$row["id_lgot_range"]," selected>", $row["name_lgot_range"],"</opton>\n";
						}
					else
					{
					  echo "<option value=",$row["id_lgot_range"],">", $row["name_lgot_range"],"</opton>\n";
					}
                }

        }
        
	function select_lgot_range()
		{
		  $this->to_html();
		}
}



?>