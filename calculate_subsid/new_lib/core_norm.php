<?php
include_once("../classes/database_work.php");


class core_norm extends database_work
{
  //содержит данные о всех нормах потребления, за расчетный период//

  var $id_sprav_uslug;
  var $start;
  var $stop;
  var $value_norm;
  var $count=0;
  
  
  function init_norm($start_, $stop_)
  	{
	    //
	    $query= "SELECT * FROM norm_uslug WHERE  start<='$stop_' AND  stop> '$start_'";
	    $this->connect_db();
	    $res= mysql_query($query) or die( mysql_eror());
	    
	    while($row= mysql_fetch_array($res))
	  	{
		    
		   
		    
	    	$this->id_sprav_uslug[$this->count]= $row["id_sprav_uslug"];
	    	$this->start[$this->count]=          $row["start"];
	    	$this->stop[$this->count]=           $row["stop"];
	    	$this->value_norm[$this->count]=     $row["value_norm"];

	    	
	    	$this->count++;
		}   
		$this->dis_connect_db();
	}
///////////////////////////////////////////////////
	function get_normativ($data, $id_uslug)
		{
		  //
		  for($i= 0;$i<= $this->count; $i++)
		  	{
			    if(($this->id_sprav_uslug[$i]==$id_uslug) AND ($this->start[$i]<= $data) AND ($data<= $this->stop[$i]))
			    	{
					  return $this->value_norm[$i];
					}
			}
		}
}


?>