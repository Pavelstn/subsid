<?php
include_once("../classes/database_work.php");


class private_lgot extends database_work
{
    var $id_home;
    var $id_vid_udostover;
    var $id_people;
    var $count= 0;
    var $count_all_people=0;
    
    function count_people()
    	{
		  $query= "SELECT COUNT(id_people) FROM people WHERE id_home='".$this->id_home."'";
		  $this->connect_db();
		  $res= mysql_query($query) or die( mysql_eror());
		  while($row= mysql_fetch_array($res))
	  		{
				$this->count_all_people= $row["COUNT(id_people)"];
		    }
		  mysql_free_result($res);
		  $this->dis_connect_db(); 
		}
  
  
  
  function init_private_lgot()
  	{
	    //
	    $query= "SELECT * FROM udostover, people WHERE people.id_home='".$this->id_home."' AND udostover.id_people= people.id_people";
	   // echo "<hr>\n".$query."<hr>\n"; 
		$this->connect_db();
	    $res= mysql_query($query) or die( mysql_eror());
	   // echo "<hr>\n";
	    while($row= mysql_fetch_array($res))
	  	{
	    	$this->id_vid_udostover[$this->count]= $row["id_vid_udostover"];
	    	$this->id_people[$this->count]=        $row["id_people"];
	    	
	    //	echo $this->id_vid_udostover[$this->count]." ".$this->id_people[$this->count]."<br>\n";

	    	$this->count++;
		}   
		//echo "<hr>\n";
		mysql_free_result($res);
		$this->dis_connect_db();
	}
///////////////////////////////////////////////////
	function private_lgot($id_home, $count_all_people)
		{
		  $this->id_home= $id_home;
		  $this->init_private_lgot();
		 // $this->count_people();
		 $this->count_all_people= $count_all_people;
		}

// 	function get_lgot($udostover, $uslug)
// 		{
// 		  //
// 		  for($i= 0;$i< $this->count; $i++)
// 		  	{
// 			    if(($this->id_sprav_udostover[$i]==$udostover) AND ($this->id_sprav_uslug[$i]== $uslug))
// 			    	{
// 			    	  $value["percent"]= $this->percent[$i];
// 			    	  $value["range"]=   $this->lgot_range[$i];
// 					  return $value;
// 					}
// 			}
// 		}

}


?>