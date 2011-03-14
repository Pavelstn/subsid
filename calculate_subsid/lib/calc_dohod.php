<?php
//include_once("class_calc_lgot.php");
include_once("../classes/database_work.php");
//include_once("../classes/database_work.php");

//include_once("class_calc_people.php");
//include_once("class_calc_lgot.php");
//include_once("calculate_koef_lgot.php");
//include_once("calc_full_tarif.php");
//include_once("calc_all_uslug.php");

//include_once("get_setting.php");

//include_once("class_calc_dohod.php");
//include_once("class_calc_prog_min.php");







class class_calc_dohod extends database_work
{
 
// var $id_home;
// var $sred_zarab; //средний заработок семьи//
// var $sred_month_dohod_sem; //среднемесячный доход семьи//

//var $sredne_month_zarplat_people;
var $sr_sov_doh;
var $subsid_people;
var $all_people;

var $sred_dush_doh;
var $sov_dohod_semi;

function get_month($date)
         {
           return $date[5].$date[6];
         }
		  
// function calc_money_people($id_people)
//             {
//               $query= "SELECT * FROM dohod WHERE id_people= '$id_people'";
//                 $this->connect_db();
//                 $result= mysql_query($query) or die (mysql_error());
//                 $rub= 0;
//                 $kop= 0;
//                 $month= 0;
//                 while($row= mysql_fetch_array($result))
//                     {
//                       $rub= $rub+(int)$row["value_money"];
//                       $kop= $kop+(int)$row["value_money2"];
//                       $month+= $this->get_month($row["to_date"])- $this->get_month($row["at_date"]);
//                       $month++;
//                     }
//                 $this->dis_connect_db();
//                 $minus_kop= $kop %100;
//                 $add_rub= ($kop- $minus_kop)/100;
//                 
//                 $itog= $rub+ $add_rub+($minus_kop/100);
//                 $this->sred_zarab+= $itog;
//                 echo $month." ";
//                 if($month!= 0) { $this->sred_month_dohod_sem+= $itog/$month; }
//                 else $this->sred_month_dohod_sem+= 0;
//                 //return $itog;
//             } 
// 
// function calc_all_people_dohod($id_home)
// 	{
// 	  $query= "SELECT id_people FROM people WHERE id_home= '".$id_home."'";
// 	  $this->connect_db();
// 	  $result= mysql_query($query) or die (mysql_error());
// 	  $count_people= 0;
// 	  while($row= mysql_fetch_array($result))
// 	  	{
// 		    $this->calc_money_people($row["id_people"]);
// 		    $count_people++;
// 		}
// 	 //$this->dis_connect_db();
// 	 $this->sred_zarab= $this->sred_zarab/$count_people;
// 	 //$this->sred_month_dohod_sem= $this->sred_month_dohod_sem/$count_people;
// 	 	
// 	}

///////////////////////////////////////////////////////////////////////////////////////////
function sred_mec_doh_people($id_people) //среднемесячный доход каждого члена семьи//
	{
	  echo "<hr>\n sred_mec_doh_people<p>\n";
	  $query= "SELECT * FROM dohod WHERE id_people= '$id_people'";
	  $this->connect_db();
      $result= mysql_query($query) or die (mysql_error());
      $rub= 0;
      $kop= 0;
      $month= 0;
		while($row= mysql_fetch_array($result))
            {
                $rub= $rub+(int)$row["value_money"];
                $kop= $kop+(int)$row["value_money2"];
                $month+= $this->get_month($row["to_date"])- $this->get_month($row["at_date"]);
                $month++;
                
            }
        $this->dis_connect_db();
        $minus_kop= $kop %100;
        $add_rub= ($kop- $minus_kop)/100;
        
        $itog= $rub+ $add_rub+($minus_kop/100);
        
        if($month!= 0) { $aaa= $itog/$month; }
          else $aaa= 0;
                 
        //$aaa= $itog/$month;
        echo "\n<br>\nСреднемесячный доход человека".$aaa."<bt>\n";
        echo "\n<br>\nКолличество месяцев для расчета=".$month."<bt>\n";
        return $aaa;
	}

function sred_m_sov_doh($id_home)// Среднемесячный совокупный доход//
	{
	  //СРЕДНЕМЕСЯЧНЫЙ СОВОКУПНЫЙ ДОХОД= СУММЕ СРЕДНЕМЕСЯЧНЫХ ДОХОДОВ ЖИЛЬЦОВ
	  
	  
	  
	  echo "<hr>\n sred_m_sov_doh<p>\n";
	  $query= "SELECT id_people, to_be FROM people WHERE id_home= '".$id_home."'";
	  //echo $query;
	  $this->connect_db();
	  $result= mysql_query($query) or die (mysql_error());
	  $count_all_people= 0;
	  $count_subsid_people= 0;
	  $sr_sov_doh= 0;
	  while($row= mysql_fetch_array($result))
	  	{
		    $sr_sov_doh+= $this->sred_mec_doh_people($row["id_people"]);
		    $count_all_people++;
		    if($row["to_be"]==1) $count_subsid_people++;
		    //echo $sr_sov_doh." ";
		    
		}
		$this->dis_connect_db();
		$this->subsid_people= $count_subsid_people;
		$this->all_people= $count_all_people;
	 // echo $sr_sov_doh." ";
	 
	   return $sr_sov_doh;
	}

function sred_dush_doh_($id_home)  //  СРЕДНЕДУШЕВОЙ ДОХОД= СРЕДНЕМЕСЯЧНЫЙ СОВОКУПНЫЙ ДОХОД / КОЛЛИЧЕСТВО ЧЕЛОВЕК ВСЕГО //
	{
	  $aaa= $this->sred_m_sov_doh($id_home);
	  if($this->all_people!= 0) $this->sred_dush_doh= $aaa / $this->all_people;
	  else $this->sred_dush_doh= 0;
	  
	}

function sov_dohod_semi_()  // совокупый доход семьи расчитывается как ПРОИЗВЕДЕНИЕ СРЕДНЕДУШЕВОГО ДОХОДА НА 
							//КОЛЛИЧЕСТОВ ЧЕЛОВЕК, ИМЕЮЩИХ ПРАВО НА СУБСИДИЮ//
	{
	  $this->sov_dohod_semi= $this->sred_dush_doh* $this->subsid_people;
	}
/////////////////////////
function class_calc_dohod($id_home)
	{
	  $this->sred_dush_doh_($id_home);
	  $this->sov_dohod_semi_();
//echo "<hr>\n";	  
//	echo $this->sred_dush_doh;  //Среднедушевой доход семьи//
//	echo "<br>\n";
//	echo $this->sov_dohod_semi; //Совокупный доход семьи//	  
//echo "<hr>\n";
	}
// 

}
?>