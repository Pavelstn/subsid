<?php
include_once("../classes/database_work.php");


class core_lgot extends database_work
{
  //содержит данные о всех тарифах, за расчетный период//
  //var $CALENDAR;
  //var $id_tarif_net
  var $id_lgot;
  var $id_sprav_udostover;
  var $id_sprav_uslug;
  var $percent;
  var $lgot_range;
  var $count=0;
  
  
  function init_lgot()
  	{
	    //
	    $query= "SELECT * FROM lgot";
	    $this->connect_db();
	    $res= mysql_query($query) or die( mysql_eror());
	    
	    while($row= mysql_fetch_array($res))
	  	{
		    
		    //echo $row["id_tarif_net"]
		    //$id_tarif= $this->count;
	    	$this->id_lgot[$this->count]=            $row["id_lgot"];
	    	$this->id_sprav_udostover[$this->count]= $row["id_sprav_udostover"];
	    	$this->id_sprav_uslug[$this->count]=     $row["id_sprav_uslug"];
	    	$this->percent[$this->count]=            $row["percent"];
	    	$this->lgot_range[$this->count]=         $row["lgot_range"];
	    	
	    	$this->count++;
		}   
		$this->dis_connect_db();
	}
///////////////////////////////////////////////////
	function get_lgot($udostover, $uslug)
		{
		  //
		  for($i= 0;$i< $this->count; $i++)
		  	{
			    if(($this->id_sprav_udostover[$i]==$udostover) AND ($this->id_sprav_uslug[$i]== $uslug))
			    	{
			    	  $value["percent"]= $this->percent[$i];
			    	  $value["range"]=   $this->lgot_range[$i];
					  return $value;
					}
				//else
				//	{
				//	  $value["percent"]= 100;
			    //	  $value["range"]=   1;
			    //	  return $value;
				//	}
			}
		}
}


?>