<?php
include_once("../classes/database_work.php");
///////////////////////////////////////////////////////////////
class calc_people extends database_work
{
  
  var $all_people= 0; //колличество жильцов, проживающих в домовладении//
  var $subsid_people= 0; //колличество жильцов, проживающих в домовладении и имеющих право на субсидию//
  var $id_house; //код домовладения//
  var $debug_mode= false; 
  function calc()
  	{
  	  echo "<hr>\n calc<p>\n";
	    $this->connect_db();
	    $query= "SELECT * FROM people WHERE id_home=".$this->id_house;
	    $result= mysql_query($query) or die( mysql_eror());
	    while($row= mysql_fetch_array($result))
	    	{
			  //
			  if($row["to_be"]=="1") $this->subsid_people++;
			  if($this->debug_mode) 
			  	{
//					echo $row["familia"]." ".$row["imya"]." ".$row["otchestvo"]."<br>\n";
//					echo "<hr>\n";
				}
			  $this->all_people++;
			}
			$this->dis_connect_db();
	} 
}

///////////////////////////////////////////////////////////////
function get_house_normativ($id_house)
	{
	  echo "<hr>\n get_house_normativ<p>\n";
	  
	  $normativ= 0;
	  
	  $calc_people= new calc_people;
	  $calc_people->id_house= $id_house;
	  $calc_people->calc();
	  //$calc_people->$all_people;
	  $db_load= new db_load("SELECT * FROM soderg_house WHERE id_set= '1' LIMIT 1");
	  if($calc_people->all_people==1) $normativ= 1* $db_load->row["one_peole"];
	  if($calc_people->all_people==2) $normativ= 2* $db_load->row["two_people"];
	  if($calc_people->all_people>=3) $normativ= $calc_people->all_people* $db_load->row["three_people"];
	  unset($calc_people);
	  unset($db_load);
	  return $normativ;
	}
	
function get_house_normativ_only($id_house)
	{
	  $normativ= 0;
	  
	  $calc_people= new calc_people;
	  $calc_people->id_house= $id_house;
	  $calc_people->calc();
	  //$calc_people->$all_people;
	  $db_load= new db_load("SELECT * FROM soderg_house WHERE id_set= '1' LIMIT 1");
	  if($calc_people->all_people==1) $normativ= $db_load->row["one_peole"];
	  if($calc_people->all_people==2) $normativ= $db_load->row["two_people"];
	  if($calc_people->all_people>=3) $normativ= $db_load->row["three_people"];
	  unset($calc_people);
	  unset($db_load);
	  return $normativ;
	}

?>