<?php
include_once("../classes/database_work.php");


class core_tarif extends database_work
{
  //содержит данные о всех тарифах, за расчетный период//
  //var $CALENDAR;
  //var $id_tarif_net
  var $id_sezon;
  var $id_uslug;
  var $start_date;
  var $stop_date;
  var $money_value;
  var $count=0;
  
  
  function init_tarif($start, $stop)
  	{
	    //
	    $query= "SELECT * FROM tarif_net WHERE  start_date<='$stop' AND  stop_date> '$start'";
	    $this->connect_db();
	    $res= mysql_query($query) or die( mysql_eror());
	    
	    while($row= mysql_fetch_array($res))
	  	{
		    
		    //echo $row["id_tarif_net"]." ".$row["id_sezon"]." ".$row["id_uslug"]." ".$row["start_date"]." ".$row["stop_date"]." ".$row["money_value"]."<br>\n";
		    //$id_tarif= $row["id_tarif_net"];
		    $id_tarif= $this->count;
	    	$this->id_sezon[$id_tarif]= $row["id_sezon"];
	    	$this->id_uslug[$id_tarif]=$row["id_uslug"];
	    	$this->start_date[$id_tarif]=$row["start_date"];
	    	$this->stop_date[$id_tarif]=$row["stop_date"];
	    	$this->money_value[$id_tarif]= $row["money_value"];  
	    	
	    	$this->count++;
		}   
		$this->dis_connect_db();
	}
///////////////////////////////////////////////////
	function get_tarif($data, $uslug)
		{
		  //
		  for($i= 0;$i< $this->count; $i++)
		  	{
			    if(($this->id_uslug[$i]==$uslug) AND ($this->start_date[$i]<= $data) AND ($data<= $this->stop_date[$i]))
			    	{
					  return $this->money_value[$i];
					}
			}
		}
}

// $database= new database_work;
// $database->connect_db();
// 
// function get_sezon($data)
// 	{
// 	  echo "<hr>\n get_sezon<p>\n";
// 	  $db= new database_work;
// 	  $db->connect_db();
// 	  $id_s= 0;
// 	  $query= "SELECT * FROM sezon WHERE start_sezon <= '".$data."' AND '".$data."' <= stop_sezon";
// 	  $res= mysql_query($query) or die( mysql_eror());
// 	  while($row= mysql_fetch_array($res))
// 	  	{
// 		    $id_s= $row["id_sezon"];
// 		    //echo $row["sezon_name"];
// 		    
// 		}
// 	$db->dis_connect_db();
// 	unset($db);
// 	return $id_s;
// 	}
// ////////////////////////////////////
// 
// function get_tarif($data, $id_uslug)
// 	{
// 	  echo "<hr>\n get_tarif<p>\n";
// 	  $id_s= get_sezon($data);
// 	  
// 	  $db= new database_work;
// 	  $db->connect_db();
// 	  $mv= 0;
// 	  $query= "SELECT * FROM tarif_net WHERE start_date <= '".$data."' AND '".$data."' <= stop_date AND id_sezon= '".$id_s."' AND id_uslug= '".$id_uslug."'";
// 	 // echo "<hr>\n";
// 	 // echo $query;
// 	 // echo "<hr>\n";
// 	  $res= mysql_query($query) or die( mysql_eror());
// 	  while($row= mysql_fetch_array($res))
// 	  	{
// 		    $mv= $row["money_value"];
// 		}
// 	  $db->dis_connect_db();
// 	  unset($db);
// 	  return $mv;
// 	}
// 







?>