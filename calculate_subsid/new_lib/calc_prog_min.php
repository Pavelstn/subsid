<?php
include_once("../classes/database_work.php");


class calc_prog_min extends database_work
{
	var $id_home;
	var $all_people= 0;
	var $subsid_people= 0;
	var $summ_prog_min =0;
  

  function init_prog_min($date)
  	{
	    $rows= "people.to_be,  prog_min_net.prog_min_value ";
	    $query= "SELECT ".$rows." FROM people, prog_min_net WHERE  people.id_home='".$this->id_home."' AND  prog_min_net.at_date<= '".$date."' AND  prog_min_net.to_date>= '".$date."' AND people.social_kat=  prog_min_net.id_prog_min";
	    
	    //echo $query."<br>\n";
		$this->connect_db();
	    $res= mysql_query($query) or die( mysql_eror());
	    
	    while($row= mysql_fetch_array($res))
	  	{
			$this->summ_prog_min+= $row["prog_min_value"];
			if($row["to_be"]==1) $this->subsid_people++; //сколько чловек имеет право на получение субсидий //
	    	$this->all_people++;          //считаем сколько всего человек/
		}   
		mysql_free_result($res);
		$this->dis_connect_db();
	}
function calc_prog_min($id_home, $date)
	{
	  $this->id_home= $id_home;
	  $this->init_prog_min($date);
	}


}



?>