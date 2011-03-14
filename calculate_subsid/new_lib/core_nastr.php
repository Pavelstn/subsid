<?php
include_once("../classes/database_work.php");


class core_nastr extends database_work
{
  //Загружает данные о настройках системы//

	var $month_range;
	var $bank_filial;
	var $month_zaprlat;
	var $one_peole;
	var $two_people;
	var $three_people;
	var $point_uslug;
	var $point_otopl;
  
  
  function init_nastr()
  	{
	    $query= "SELECT * FROM prog_set, soderg_house";
	    $this->connect_db();
	    $res= mysql_query($query) or die( mysql_eror());
	    
	    while($row= mysql_fetch_array($res))
	  	{
	    	$this->month_range=   $row["month_range"];
	    	$this->bank_filial=   $row["bank_filial"];
	    	$this->month_zaprlat= $row["month_zaprlat"];
	    	$this->one_peole=     $row["one_peole"];
			$this->two_people=    $row["two_people"];
			$this->three_people=  $row["three_people"];
			$this->point_uslug=   $row["point_uslug"];
			$this->point_otopl=   $row["point_otopl"];
		}   
		$this->dis_connect_db();
	}
///////////////////////////////////////////////////
	function get_horm_house($people)
		{
		  if($people>=3)  return $this->three_people* $people;
		  if($people==2)  return $this->two_people* $people;
		  if($people==1)  return $this->one_peole* $people;
		}


}


?>