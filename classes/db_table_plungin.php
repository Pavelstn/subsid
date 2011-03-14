<?php
include_once("database_work.php");

class sample_filter1
{
  var $name_filter;   //базовые переменные
  var $alien_value;   //базовые переменные
  var $alien_name;    //базовые переменные
  var $alien_type;    //базовые переменные
  
  function is_accept_filter()  //функция предназначена для проверки необходимости использования этого фильтра;
  	{
	    //return true;
	    if($this->alien_name== "nomer_doma") return true;
	    else false;
	}
  
  function show_filter()      //функция для применения фильтра//
  	{
	    echo $this->alien_value."|".$this->alien_type;
	}
}
/////////////////////////////////////////////////////////////////////
class edit_filter
{
  var $name_filter;   //базовые переменные
  var $alien_value;   //базовые переменные
  var $alien_name;    //базовые переменные
  var $alien_type;    //базовые переменные
  var $edit_path="../new_house/edit_house.php";
  
  function is_accept_filter()  //функция предназначена для проверки необходимости использования этого фильтра;
  	{
	    //return true;
	    if($this->alien_name== "id_home") return true;
	    else false;
	}
  
  function show_filter()      //функция для применения фильтра//
  	{
	    //echo $this->alien_value."|".$this->alien_type;
	    $target="TARGET=\"_top\"";
	    echo "<a href=\"".$this->edit_path."?id_row=".$this->alien_value."&edit\" ".$target.">редактировать</a>";
	}
}
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
class kladr_filter extends database_work
{
  var $name_filter;   //базовые переменные
  var $alien_value;   //базовые переменные
  var $alien_name;    //базовые переменные
  var $alien_type;    //базовые переменные
  ////////////////////////////////////////
  //var $code_street;
  
  function is_accept_filter()  //функция предназначена для проверки необходимости использования этого фильтра;
  	{
	    //return true;
	    if($this->alien_name== "code_street") return true;
	    else false;
	}
  ///////////////////////////////////////////////////////////////////
	function convert()
		{
		   $code_street= $this->alien_value;
		   
		    $this->connect_db();
  			if($code_street== "" OR $code_street== "0" )
  				{
				    echo "<font color=\"#FF0000\"> адрес не определен</font>\n";
				    return ;
				}
  			$code_kladr= $code_street[0].$code_street[1].$code_street[2].$code_street[3].$code_street[4].$code_street[5].$code_street[6].$code_street[7].$code_street[8].$code_street[9].$code_street[10].$code_street[11].$code_street[12];
  			$query= "SELECT * from kladr WHERE code= '$code_kladr'";
  			$result= mysql_query($query) or die (mysql_error());
  			while($row= mysql_fetch_array($result))
  				{
				    //
				    echo $row["socr"]." ".$row["name"].", ";
				}
			
			$query= "SELECT * from street WHERE code= '$code_street'";
			$result= mysql_query($query) or die (mysql_error());
			while($row= mysql_fetch_array($result))
				{
				  echo $row["socr"]." ".$row["name"];
				}
			$this->dis_connect_db();
		}
  
  
  
  
  /////////////////////////////////////////////////////////////////
  function show_filter()      //функция для применения фильтра//
  	{
	    $this->convert();
	}
}
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
class get_people_filter extends database_work
{
  var $name_filter;   //базовые переменные
  var $alien_value;   //базовые переменные
  var $alien_name;    //базовые переменные
  var $alien_type;    //базовые переменные
  ////////////////////////////////////////
  //var $code_street;
  
  function is_accept_filter()  //функция предназначена для проверки необходимости использования этого фильтра;
  	{
	    //return true;
	    if(($this->alien_name== "vladelec") AND ($this->alien_value!="")) return true;
	    else false;
	}
  ///////////////////////////////////////////////////////////////////
	function get_people()
		{
		   //$code_street= $this->alien_value;
		   
		    $this->connect_db();


  			$query= "SELECT familia, imya, otchestvo FROM people WHERE id_people= '$this->alien_value'";
  			//echo $query;
  			$result= mysql_query($query) or die (mysql_error());
  			while($row= mysql_fetch_array($result))
  				{
				    //
				    echo $row["familia"]." ".$row["imya"]." ".$row["otchestvo"];
				}
			
			$this->dis_connect_db();
		}
  
  
  
  
  /////////////////////////////////////////////////////////////////
  function show_filter()      //функция для применения фильтра//
  	{
	    $this->get_people();
	    //echo "dgg";
	}
}
/////////////////////////////////////////////////////////////////////



class calendar_filter
{
  var $name_filter;   //базовые переменные
  var $alien_value;   //базовые переменные
  var $alien_name;    //базовые переменные
  var $alien_type;    //базовые переменные
  //////////////////////////////////////////////////////////////////////////////
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
/////////////////////////////////////////////////////////////////////////////////
	function date_to_str($date)
	{
	  
	   
	  
		    $year= $this->get_year($date);
		    $month= $this->get_month($date);
		    $day= $this->get_day($date);
		    
		    
					  $month_list["01"]="Янв";
					  $month_list["02"]="Фев";
					  $month_list["03"]="Мар";
					  $month_list["04"]="Апр";
					  $month_list["05"]="Май";
					  $month_list["06"]="Июнь";
					  $month_list["07"]="Июль";
					  $month_list["08"]="Авг";
					  $month_list["09"]="Сен";
					  $month_list["10"]="Окт";
					  $month_list["11"]="Нояб";
					  $month_list["12"]="Дек";
					  
					  $strok= $day.".".$month_list[$month].".".$year;
					  return $strok;		
		 	
	}
/////////////////////////////////////////////////////////////////////////////////  
  function is_accept_filter()  //функция предназначена для проверки необходимости использования этого фильтра;
  	{
	    //return true;
	    if($this->alien_type== "date") return true;
	    else false;
	}
  
  function show_filter()      //функция для применения фильтра//
  	{
	    echo $this->date_to_str($this->alien_value);
	}
}
/////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////
class edit_filter2
{
  var $name_filter;   //базовые переменные
  var $alien_value;   //базовые переменные
  var $alien_name;    //базовые переменные
  var $alien_type;    //базовые переменные
  var $edit_path="subsid_house.php";
  
  function is_accept_filter()  //функция предназначена для проверки необходимости использования этого фильтра;
  	{
	    //return true;
	    if($this->alien_name== "id_home") return true;
	    else false;
	}
  
  function show_filter()      //функция для применения фильтра//
  	{
	    //echo $this->alien_value."|".$this->alien_type;
	    $target="TARGET=\"_top\"";
	    echo "<a href=\"".$this->edit_path."?id_row=".$this->alien_value."&edit\" ".$target.">просмотреть</a>";
	}
}
/////////////////////////////////////////////////////////////////////























?>