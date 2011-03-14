<?php
include_once("local_lib.php");
include_once("../../lib/function_define.php");
include_once("local_class.php");
show_head("Редактирование сезонов");
/////////////////////////////////////////////////////////////////////////////////
if(isset($add_sezon))
{
  //echo "Добавление сезона<br>\n";
  $flag= true;
  
  if(!isset($sezon_day_start))   {$flag= false;}
  if(!isset($sezon_month_start)) {$flag= false;}
  if(!isset($sezon_year_start))  {$flag= false;}
//             sezon_year_start
  if(!isset($sezon_day_stop))    {$flag= false;}
  if(!isset($sezon_month_stop))  {$flag= false;}
  if(!isset($sezon_year_stop))   {$flag= false;}
  
  if(!isset($sezon_name))         {$flag= false;}
  if(!$flag) //значит все переменные определены//
 	{
	   echo "<error>Ошибка такие переменные не определены.</error><br>\n";
	}
  else
  {
     $sezon_day_start= add_zero($sezon_day_start); 
 	 $sezon_month_start= add_zero($sezon_month_start);
 
 	 $sezon_day_stop= add_zero($sezon_day_stop);
 	 $sezon_month_stop= add_zero($sezon_month_stop);

     if(!checkdate($sezon_month_start, $sezon_day_start, $sezon_year_start) OR !checkdate($sezon_month_stop, $sezon_day_stop, $sezon_year_stop))
  		{
	    	echo "<error>Ошибка: неправильная дата.</error><br>\n";
		}
	else
		{
			$start_date=$sezon_year_start."-".$sezon_month_start."-".$sezon_day_start;
			$stop_date= $sezon_year_stop."-".$sezon_month_stop."-".$sezon_day_stop;
			//echo $start_date."<br>\n";
			//echo $stop_date."<br>\n";
			if($start_date> $stop_date)
				{
				  echo "<error>Ошибка: неправильный период, дата начала больше даты окончания.</error><br>\n";
				}
			else
				{
				  //echo "";
				  //validate_sezon($start_date, $stop_date);
				$query= "INSERT INTO sezon (
                                      				sezon_name,
									  				start_sezon,
                                      				stop_sezon
                                      
                                     			)
                              				VALUES (
                              		   				'$sezon_name',
                                       				'$start_date',
                                      			 	'$stop_date'
                                     				)";
                    //echo $query."<br>\n";
                    connect_to_my_db();
                    $result= mysql_query($query) or die (mysql_error());
				  
				}
		}
  }

  
  
  unset($add_sezon);
}

////////////////////////////////////////////////////////////////////////////////

if(!isset($edit) AND !isset($add_sezon))
{
start_form("sezon.php");
echo"Редактирование сезонов за \n";
if(!isset($sezon_year))
{
  $_slct_year= new adv_select_year("sezon_year", "current", "onchange= this.form.submit()");
  $sezon_year="2006";
}
else
{
  $_slct_year= new adv_select_year("sezon_year", $sezon_year, "onchange= this.form.submit()");
}
$query= "SELECT * FROM sezon WHERE start_sezon >= '".$sezon_year."-01-01' AND stop_sezon <= '".$sezon_year."-12-31'";

echo " год.\n";
//echo "<hr>\n";
//echo $query;
//////////////////////////////////////////////////////////////////////////////////
echo "<br>\n";
echo "Название сезона<input type=\"text\" name=\"sezon_name\" size=\"20\">";
echo "<br>\n";
echo " C";
select_day("sezon_day_start", "current");
select_month("sezon_month_start", date("m"));
//echo "<input type=\"text\" name=\"sezon_year_start\" size=\"2\" value=\"".$sezon_year."\" disabled=\"true\">";
echo "<input type=\"text\" name=\"sezon_year_start\" size=\"2\" value=\"".$sezon_year."\" >";
/////////////////////
echo " По";
select_day("sezon_day_stop", "current");
select_month("sezon_month_stop", date("m"));
//echo "<input type=\"text\" name=\"sezon_year_stop\" size=\"2\" value=\"".$sezon_year."\" disabled=\"true\">";
echo "<input type=\"text\" name=\"sezon_year_stop\" size=\"2\" value=\"".$sezon_year."\" >";
echo "  <input type=\"submit\" value=\"Добавить сезон\" name=\"add_sezon\">\n";
echo "<hr>\n";
/////////////////////////////////////////////////////////////////////////////////
if(!isset($new_net)) { $new_net= new net; }
$new_net->set_query($query);
$new_net->add_visible_row("sezon_name", "Название сезона");
$new_net->add_visible_row("start_sezon", "Начало сезона");
$new_net->add_visible_row("stop_sezon", "Конец сезона");
$new_net->set_table_for_del("sezon", "id_sezon");
$new_net->set_edit_row(true);
$new_net->set_edit_path("sezon.php"); //$PHP_SELF
$new_net->cath_event();
$new_net->to_html_test2();

end_form();
}
if(isset($edit))
{
  echo "редактирование\n<br>\n";
}

?>