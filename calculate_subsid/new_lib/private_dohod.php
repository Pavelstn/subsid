<?php
include_once("../classes/database_work.php");


class people_data
{
  var $all_deng= 0;
  var $data;
  var $sum_month= 0;
  var $sred_mes=0;
//  var $c_start;
//  var $c_stop;
      function full_month($start, $stop)
    	{
		  //
		  $month= ($stop[5].$stop[6])- ($start[5].$start[6])+1;
		  return $month;
		}
  
  
  function add_dohod($id_dohod,$value_dohod, $start, $stop)
  	{
	   $this->all_deng+= $value_dohod;
	   
	   $dt["start"]= $start;
	   $dt["stop"]= $stop;
	   
	   $this->data[$id_dohod]= $dt;
	   
	   //$this->c_start[$id_dohod]= $start;
	   //$this->c_stop[$id_dohod]= $stop;   
	}
///////////////
  function show()
  	{

 			 while (list ($key, $val) = each ($this->data) ) :
 				//echo "Доход ".$key." начало ".$val["start"]." конец ".$val["stop"]."<br>\n";
 				$this->sum_month+= $this->full_month($val["start"], $val["stop"]);
 			 endwhile;
 			 //echo "Всего денег ".$this->all_deng." рублей \n";
 			 //echo $this->sum_month." месяцев<br>\n";
 			 
 			 //$this->sred_mes= $this->all_deng/$this->sum_month;
 			         if($this->sum_month!= 0) { $this->sred_mes= $this->all_deng/$this->sum_month;}
          		  else $this->sred_mes= 0;
 			 
 			 //echo "Среднемесячный доход человека= ".$this->sred_mes." рублей<br>\n";
 			 

	}
  
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
class private_dohod extends database_work
{

     var $id_home;
     var $count= 0;
	 var $all_people;	 
	 var $sov_dohod= 0; //// Среднемесячный совокупный доход//
	 
	 var $people= 0;
	 var $subsid_people= 0;
	 
	 var $sred_dush_doh;
	 var $sov_dohod_semi;

///////////////////////////////////////////////////////////////////////////////////////
function calc_vse()
	{
	  //  СРЕДНЕДУШЕВОЙ ДОХОД= СРЕДНЕМЕСЯЧНЫЙ СОВОКУПНЫЙ ДОХОД / КОЛЛИЧЕСТВО ЧЕЛОВЕК ВСЕГО //
	  $this->sred_dush_doh= $this->sov_dohod/ $this->people;
	  // совокупый доход семьи расчитывается как ПРОИЗВЕДЕНИЕ СРЕДНЕДУШЕВОГО ДОХОДА НА КОЛЛИЧЕСТОВ ЧЕЛОВЕК, ИМЕЮЩИХ ПРАВО НА СУБСИДИЮ//
	  $this->sov_dohod_semi= $this->sred_dush_doh* $this->subsid_people;
	}





///////////////////////////////////////////////////////////////////////////////////////
    
  function show()
  	{
 			 while (list ($key, $val) = each ($this->all_people) ) :
 			//	echo "<hr>Человек ".$key." доходы <br> \n";
 				$val->show();
 				$this->sov_dohod+= $val->sred_mes;
 			 endwhile;
 			 
 			 //echo "<br>Среднемесячный совокупный доход ".$this->sov_dohod."<br>\n";
	}
/////////////////////////////////////////////
	function ru_co_to_float_ru($rub, $kop)
		{
		  //
		  $minus_kop= $kop %100;
          $add_rub= ($kop- $minus_kop)/100;
          $itog= $rub+ $add_rub+($minus_kop/100);
          return $itog;
		}
///////////////////////////////////////////////
  function init_private_dohod()
  	{
	    $query= "SELECT * FROM dohod, people WHERE people.id_home='".$this->id_home."' AND dohod.id_people= people.id_people";
	    $this->connect_db();
	    $res= mysql_query($query) or die( mysql_eror());
	    while($row= mysql_fetch_array($res))
	  	{ 	  
 	    	$id_people= $row["id_people"];
 	    	$value_dohod= $this->ru_co_to_float_ru($row["value_money"], $row["value_money2"]);
 	    	$id_dohod= $row["id_dohod"];
 	    	$start=    $row["at_date"];
 	    	$stop=    $row["to_date"];	

			if(!isset($this->all_people[$id_people])) $this->all_people[$id_people]= new people_data;
			$this->all_people[$id_people]->add_dohod($id_dohod,$value_dohod, $start, $stop);
			
	    	$this->count++;
		} 
		  
		mysql_free_result($res);
		$this->dis_connect_db();
	}
///////////////////////////////////////////////////
  function private_dohod($id_home)
		{
		  $this->id_home= $id_home;
		  $this->init_private_dohod();
		  $this->show();
		  //$this->calc_vse();
		}
		


}


?>