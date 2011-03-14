<?php
include_once("class_calc_lgot.php");
include_once("../classes/database_work.php");
//include_once("../classes/database_work.php");

class class_calc_prog_min extends database_work
{
var $prog_deti= 0;
var $prog_trud= 0;
var $prog_pensi= 0;

var $count_deti= 0;
var $count_trud= 0;
var $count_pensi= 0;

function show_all_cashe_min($date)
            {
              //
              $query= "SELECT * FROM prog_min_net WHERE at_date <= '$date' AND to_date > '$date' ";
              
              
              $this->connect_db();
              $result= mysql_query($query) or die (mysql_error());
              while($row= mysql_fetch_array($result))
                {
                 // echo $row["soc_kat"];
                 //  echo ">>". $row["money"];
                 //  echo "<br>\n";
                   /////////////
                   if($row["id_prog_min"]==1)//Дети
                   	{
						$this->prog_deti= $row["prog_min_value"];	     
					}
                   if($row["id_prog_min"]==2)//Трудоспособные
                   	{
						$this->prog_trud= $row["prog_min_value"];	     
					}
                   if($row["id_prog_min"]==3)//Пенсионеры (инвалиды)
                   	{
						$this->prog_pensi= $row["prog_min_value"];	     
					}

                }
			  $this->dis_connect_db();
			  
            }

function calc_people_by_prog_min($id_home)
            {
              //подсчитываем колличество людей принадлежащих выбранной социальой категории//////////
              $count= 0;
              $query= "SELECT social_kat FROM people WHERE id_home= '$id_home'";
              $this->connect_db();
              $result= mysql_query($query) or die (mysql_error());
              while($row= mysql_fetch_array($result))
                {
                   if($row["social_kat"]==1)//Дети
                   	{
						$this->count_deti++;     
					}
                   if($row["social_kat"]==2)//Трудоспособные
                   	{
						$this->count_trud++;	     
					}
                   if($row["social_kat"]==3)//Пенсионеры (инвалиды)
                   	{
						$this->count_pensi++;	     
					}
                }
               $this->dis_connect_db();
            }

function all_prog_min()
	{
// 	    echo "<br>дети\n";
// 		echo $this->count_deti;
// 		echo "<br>минимум\n";
// 		echo $this->prog_deti;
//
// 	    echo "<br>Трудоспособные\n";
// 		echo $this->count_trud;
// 		echo "<br>минимум\n";
// 		echo $this->prog_trud;
// 		echo "<br>Пенсионеры (инвалиды)\n";
// 		echo $this->count_pensi;
// 		echo "<br>минимум\n";
// 		echo $this->prog_pensi;
// 		echo "<br>\n";

		$aaa= ($this->prog_deti* $this->count_deti)+($this->prog_trud* $this->count_trud)+($this->prog_pensi * $this->count_pensi);
		
		//echo $aaa;
		return  $aaa;
		 
	}

function class_calc_prog_min($id_home, $date)
	{
	  //
	  $this->show_all_cashe_min($date);
	  $this->calc_people_by_prog_min($id_home);
	  //return $this->all_prog_min();
	}



}
?>