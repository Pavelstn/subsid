<?php
include_once("database_work.php");
class db_table extends database_work
{
  //создание таблицы для отображения содержимого базы данных//
  var $query="";
  var $table_for_del= "";
  var $del_row= "";
  var $visible_row;
  var $row_for_checkbox;
  var $edit_flag= false;
  var $edit_row;
  var $edit_path="";
  var $button_flag= true;
  
  function get_name()
  	{
	    return "table";
	}
  function add_visible_row($row_name, $alias)
  	{
	    $this->visible_row[$row_name]= $alias;
	}
  
  function set_query($new_query)
  	{
	    $this->query= $new_query;
	}
  function set_table_for_del($new_table_for_del, $new_row_del)
  	{
		$this->table_for_del= $new_table_for_del;
		$this->del_row= $new_row_del;
	}
  function set_edit_row($new_edit)
  	{
	    $this->edit_flag= $new_edit;
	}
  function set_edit_path($new_path)
  	{
	    $this->edit_path= $new_path;
	}
//////////////////////////////////////////////////////
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
//////////////////////////////////////////////////////
function repalase_date($value)
	{
	  //
	  if($this->is_date($value))
	  	{ return $this->date_to_str($value);}
	  else { return $value;}
	}
//////////////////////////////////////////////////////
function is_date($date)
	{
	  //
	  if(strlen($date)!=10) {return false;}
	  	else
	  		{
			    //
			    $year= $this->get_year($date);
			    $month= $this->get_month($date);
			    $day= $this->get_day($date);
			    
			    if(!is_numeric($year)) { return false;}
			    if(!is_numeric($month)) { return false;}
			    if(!is_numeric($day)) { return false;}
			    
			    if(!checkdate($month, $day, $year)) { return false;}
			    else { return true;}
			}
	}


	function date_to_str($date)
	{
	  if($this->is_date($date)) 
	   
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
	}


  function show_checkbox($row, $ii)
  	{
	    //if(($ii== 0) AND ($this->button_flag) )
	    if($ii== 0)
	    {
		  echo "<p align= \"center\"> <input type=\"checkbox\" name=\"checkbox_del[".$row[$ii]."]\" value=\"ON\" ></p>";
		  $this->edit_row= $row[$ii];
		}
		//else {echo $row[$ii]."&nbsp;";}
		else {echo $this->repalase_date($row[$ii])."&nbsp;";}
	}
	
  function show_button($result, $i)
  	{
	    //
	 	//if(($i== 0 )AND ($this->button_flag) )
	 	if($i== 0 )
		 {
		   	$waring_del= "onclick=\"return confirm('Вы действительно хотите удалить эту запись? ВНИМАНИЕ данные невозможно будет восстановить.')\"";
	     	   return "<input type=\"submit\" value=\"Удалить\" $waring_del name=\"del\" >\n";
		 } 
		 else 
		 	{
			  return $this->alias(mysql_field_name($result, $i));
			} 
	}

/////////////////////////////////////////////////////////////////////////////////////////////
  function alias($row_name)
  	{
	    if(isset($this->visible_row[$row_name]))
	    	{ return $this->visible_row[$row_name];}
	    else {return $row_name; }
	}

  function to_html_test2()
  	{
  	   
	    if(!isset($this->query)|| empty($this->query))
			{ $this->query= "select * from people";}

		$this->query= stripslashes($this->query);
//		mysql_connect("subsid", "", "") or die("could not connect to database.");
//		mysql_select_db("subsid") or die ("cannot select database.");
        $this->connect_db();
		$result= mysql_query($this->query) or die( mysql_eror());
		$number_cols= mysql_num_fields($result);


	echo "<table border=\"1\" >\n";
		echo "<tr>\n";
		/////////////////////////////////////////////
		for ($i=0; $i<$number_cols; $i++)
			{
			 echo "<td>".$this->show_button($result, $i)."</td>\n";
			}
		if($this->edit_flag) { echo "<td>Редактировать</td>\n";}	
		echo "</tr>\n"; //end table header
echo "<!-- end header --->\n";
//////////////////////////////////////////////////////////////////////////////////////
		while ($row= mysql_fetch_row($result))
		{
		  echo "<tr>\n";
		  for ($i=0; $i<$number_cols; $i++)
		  {
		    echo "   <td>";
		    if (!isset($row[$i])) //test for null value
		    	{ echo "NULL"."&nbsp;"; }
		    else
				{  $this->show_checkbox($row, $i);}
		    echo "</td>\n";
		}
	if($this->edit_flag) { echo "   <td><a href=\"".$this->edit_path."?id_row=".$this->edit_row."&edit\" >редактировать</a></td>\n";} //при включенном флаге редактирования//
		echo "</tr>\n";
		}
//////////подвал////////////////////////////
	echo "<tr>\n";
	echo "<td>".$this->show_button("", 0)."</td>\n";
	for($c=1; $c< $i; $c++)
		{
		    echo "<td>&nbsp;</td>\n";
		}
	if($this->edit_flag) { echo "<td>&nbsp;</td>\n";} //при включенном флаге редактирования//
	echo "</tr>\n";	
		echo "</table>\n";
	} 
	///////////////////////////////
	function to_html()
		{
		  $this->to_html_test2();
		  //echo date_to_str("2006-05-31")."<br>\n";
		} 
	/////////////////////отлавливаем события///////////
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
			  $del_event=   $this->popPostVar('del');
			  $check_event= $this->popPostVar('checkbox_del');
			  if(!$del_event== false)
			  	{
				    $this->del_from_table($check_event);
				}
			}
	////////////////удаление из таблицы////////////////
	function del_value($key)
		{
		  //DELETE FROM `test` WHERE `id_test` = '1' LIMIT 1;
		  $query= "DELETE FROM ".$this->table_for_del." WHERE `".$this->del_row."` = '".$key."'";
		  //echo $query."<br>\n";
		 //$this->connect_to_my_db();
		 $this->connect_db();
         $result= mysql_query($query) or die (mysql_error());
		}
	
	function del_from_table($check_event)
		{
		  //удаление из таблицы//
		 // echo "удаление из таблицы<br>\n";
		  if (!empty($check_event))
		  	{
			while (list($key, $val) = each($check_event))
			 {
 				//echo "удаление записи № $key<br>\n";
 				$this->del_value($key);
			}

			}	
		}
}


?>