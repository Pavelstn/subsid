<?php
include_once("database_work.php");
include_once("db_table_plungin.php");



class db_table3 extends database_work
{
  //создание таблицы для отображения содержимого базы данных//
  var $query= "select * from people";
  var $core_filter="";
  var $count_filter= 0;
//  var $table_for_del= "";
//  var $del_row= "";
//  var $visible_row;
//  var $row_for_checkbox;
//  var $edit_flag= false;
//  var $edit_row;
//  var $edit_path="";
//  var $target_top= false;
  
  function add_filter($new_filter)
  	{
	    $this->core_filter[$this->count_filter]= $new_filter;
	    $this->count_filter++;
	}
  
  
  function set_query($new_query)
  	{
	    $this->query= $new_query;
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	function work_filters($val, $name, $type)
		{
		  //
		  if($val=="") echo "&nbsp;";
		  $default_flag= false;
		  for($ccc= 0; $ccc< $this->count_filter;$ccc++)
		  	{
			    $this->core_filter[$ccc]->alien_value= $val;
			    $this->core_filter[$ccc]->alien_name= $name;
			    $this->core_filter[$ccc]->alien_type= $type;
			    
			    if($this->core_filter[$ccc]->is_accept_filter())
			    	{
					  //
					  $this->core_filter[$ccc]->show_filter();
					  
					  $default_flag= false;
					  return;
					}
				else
					{
					  //
					  //echo $val;
					  $default_flag= true;
// 					  echo "|";
// 					  echo $name;
// 					  echo "|";
// 					  echo $type;

					}
			}
			if($default_flag) echo $val;
		}	
	
//////////////////////////////////////
		function show_tables()
		{
		  	$this->connect_db();

			//create a query
			
			$result = mysql_query($this->query);

			print "<table border = 1>\n";

			//заголовок
			echo "<tr>\n";
			$field_count= 0;
			$field_row_data="";
			$core="";
			while ($field = mysql_fetch_field($result))
			{
  				echo " <td>".$field->name."|".$field->table."</td>\n";
  				$field_row_data["name"]= $field->name;
  				$field_row_data["type"]= $field->type;
  				$core[$field_count]= $field_row_data;
  				$field_count++;
  				//echo $field_count."\n";
			} 
			// имеется несколько вариантов
			//$field->max_length  | How long the field is (Especially important in VARCHAR fields)
			//$field->name        |The name of the field
			//$field->primary_key |TRUE if the field is a primary key
			//$field->table       |Name of table this field belongs to
			//$field->type        |Data type of this field
			print "</tr>\n\n";

			//get row data as an associative array
// 			while ($row = mysql_fetch_assoc($result))
// 				{
//   					print "<tr>\n";
//   					//look at each field
//   					foreach ($row as $col=>$val)
// 			  		{
//     					print " <td>$val</td>\n";
//   			  		} // end foreach
//   					print "</tr>\n\n";
// 					}// end while

// 			while($row = mysql_fetch_object($result))
//  				{
// 						
//  				}
// 			print "</table>\n";
// 			echo mysql_num_fields($result); 
// 			mysql_field_name($dbResult, $i)
			
//  			while ($row = mysql_fetch_assoc($result))
//  				{
//  				  
//    					print "<tr>\n";
//    						$i=0;
// 						foreach ($row as $col=>$val)
// 							{
// 							  //$field_row_data= $core[$i];
// 							  //print " <td>".$val."|".$field_row_data["name"]."|".$field_row_data["type"]."</td>\n";
// 							  echo "<td>";
// 							  //$this->work_head_filters($val, $field_row_data["name"], $field_row_data["type"]);
// 							  echo $val;
// 							  echo "&nbsp;</td>".$i."\n";
// 							  $i++;
// 							}
// 						
//    					print "</tr>\n\n";
//    					
//  					}// end while


				while ($row= mysql_fetch_row($result))
					{
					  echo "<tr>\n";
					  for ($i=0; $i<$field_count; $i++)
					  	{
						    echo "<td>";
						    if (!isset($row[$i])) //test for null value
						    	{ echo "NULL"."&nbsp;"; }
						    else
						    	{
								  //$this->show_checkbox($row, $i);}
								  $field_row_data= $core[$i];
								  $this->work_filters($row[$i], $field_row_data["name"], $field_row_data["type"]);
								  //echo $row[$i];
								}
						    echo "</td>\n";
						}
					  echo "</tr>\n";
					}

				echo "</table>\n";
			$this->dis_connect_db();
		}



//////////////////////////////////////
	function to_html()
		{
		  $this->show_tables();
		  //echo date_to_str("2006-05-31")."<br>\n";
		} 
	/////////////////////отлавливаем события///////////




}

?>