<?php
include_once("class_calc_lgot.php");
include_once("../classes/db_load.php");

class get_setting
{
  
//$db_load_= new db_load("SELECT * FROM prog_set WHERE id_set='1'");
//$db_load_->row["month_range"]
//$db_load_->row["bank_filial"]
//$db_load_->row["month_zaprlat"]


var $year;
var $month;
var $day;

/////////////////////////////////////////////////////
function get_year($date)
        {
          $year= $date[0].$date[1].$date[2].$date[3];
          return $year;
        }
/////////////////////////////////////////////////////
function get_month($date)
         {
           return $date[5].$date[6];
         }
/////////////////////////////////////////////////////
function get_day($date)
         {
           return $date[8].$date[9];
         }
////////////////////////////////////////////////////

function plus_month($add_month)
	{
	  $this->month+= $add_month;
	  if($this->month>12)
	  	{
		    $this->month-= 12;
		    $this->year+= 1;
		}
	  if(strlen($this->month)==1) {$this->month= "0".$this->month;}
	}

function minus_month($add_month)
	{
	  $this->month-=$add_month;
	  if($this->month< 1)
	  	{
		    $this->month= 12+ $this->month;
		    $this->year--;
		}
	  if(strlen($this->month)==1) {$this->month= "0".$this->month;}
	}

function get_data()
	{
	  return $this->year."-".$this->month."-".$this->day;
	}	
	

}








?>