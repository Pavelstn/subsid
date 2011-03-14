<?php
include_once("../classes/database_work.php");


class private_uslug extends database_work
{
    var $id_uslug;
    var $id_home;
    var $id_vid_uslug;
    //var $value_uslug;
    var $count= 0;
  
  function init_private_uslug()
  	{
	    //
	    $query= "SELECT * FROM uslug WHERE  id_home='".$this->id_home."'";
	    $this->connect_db();
	    $res= mysql_query($query) or die( mysql_eror());
	   // echo "<hr>\n";
	    while($row= mysql_fetch_array($res))
	  	{
	    	$this->id_vid_uslug[$this->count]= $row["id_vid_uslug"];	
	    	
	    //	echo $this->id_vid_udostover[$this->count]." ".$this->id_people[$this->count]."<br>\n";

	    	$this->count++;
		}   
		//echo "<hr>\n";
		mysql_free_result($res);
		$this->dis_connect_db();
	}
///////////////////////////////////////////////////
  function private_uslug($id_home)
		{
		  $this->id_home= $id_home;
		  $this->init_private_uslug();
		}


}


?>