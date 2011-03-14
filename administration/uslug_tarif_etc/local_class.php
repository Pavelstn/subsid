<?php
include_once("../../classes/database_work.php");

class select_sezon extends database_work
{
  var $year;
  var $value_default;
  var $add_value="";
  //var $add_value= "onchange= this.form.submit()";
  function get_value()
	{
		//echo $this->value_default;
	  return $this->value_default;
	}

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
///////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
		function popPostVar($varName)
			{
			  //по идее эта функция выбирает параметы которые были переданы форме//
				$result=false;
				if (!empty($_POST[$varName]))
			//	$result=(get_magic_quotes_gpc()?$_POST[$varName]:addslashes($_POST[$varName]));
				$result= $_POST[$varName];
				return $result;
			}
	function cath_event()
			{
			  $event=   $this->popPostVar("sezon");
			  if($event)
			  	{
				    $this->value_default= $event;
				      //echo $this->value_default."<br>\n";
				}
			}
////////////////////////////////////////////////////////////////////////////////////////  
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
  
  function to_html()
	{
	  //

	  $this->cath_event();
	  //$add_value="";
	  $query= "SELECT * FROM sezon WHERE start_sezon >= '".$this->year."-01-01' AND stop_sezon <= '".$this->year."-12-31'";
	  $this->connect_db();
	  $result= mysql_query($query) or die (mysql_error());
	  echo "<select size=\"1\" name=\"sezon\" $this->add_value >\n";
	  echo "<option value=\"0\">Выберите сезон</opton>\n";
	  while($row= mysql_fetch_array($result))
	  	{
	  	  $select_string= $row["sezon_name"]. " [".$this->date_to_str($row["start_sezon"])."- ".$this->date_to_str($row["stop_sezon"])."]";
		 if($row["id_sezon"]!= $this->value_default)
			{
				echo "<option value=".$row["id_sezon"].">".$select_string."</opton>\n";
			}
		    
		 else echo "<option value=".$row["id_sezon"]." selected >".$select_string."</opton>\n";
		}
		echo "</select>\n";
		$this->dis_connect_db();
		
	}

function select_sezon()
	{
	  $this->cath_event();
	}
}













?>