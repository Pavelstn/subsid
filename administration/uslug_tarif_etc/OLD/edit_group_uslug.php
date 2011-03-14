<?php
include_once("../../lib/function_define.php");
include_once("local_lib.php");

// function show_head($caption)
// 	{
// 	  //
// 	  echo "<body bgcolor=\"#CC99FF\">";
//         echo "<table border=\"0\" id=\"table2\" cellpadding=\"0\" style=\"border-collapse: collapse\" width=\"100%\">\n";
//         echo "	<tr>\n";
//         echo "		<td width=\"357\">\n";
//         echo "		<form method=\"POST\" action=\"index.php\">\n";
// 
//         echo "			<p><input type=\"submit\" value=\"^ Назад\" name=\"retrun\"></p>\n";
//         echo "		</form>\n";
//         echo "		</td>\n";
//         echo "		<td>".$caption."</td>\n";
// 		echo "</tr>\n";
// 		echo "</table>\n";
// 		echo "<br>\n";
// 		echo "<hr>\n";
// 	}

///////////////////////////////////////////////////////////////////////////////////////////////
function show_edit_group_window()
	{ show_head("Редактирование групп услуг");
	  $waring_del= "onclick=\"return confirm('Вы действительно хотите удалить эту запись? ВНИМАНИЕ данные невозможно будет восстановить.')\"";
	  //покзываем основное окно редактирования груп услуг//
	 echo "<form name=\"add_del_group_uslug\" method=\"post\" action=\"edit_group_uslug.php\">"; 
	  echo "Название группы услуг <input type=\"text\" name=\"group_uslug_name\" size=\"40\">";
	  echo "&nbsp;&nbsp;";
	  echo "<input type=\"submit\" value=\"Добавить новую группу услуг\" name=\"add_new_group_uslug\"></p>";
	  echo "<hr>\n";  
	  
	  	echo "<table border=\"1\" width=\"100%\" id=\"table1\">\n";
		echo "<tr>\n";
		echo "	<td width=\"67\">\n";
		echo "	<input type=\"submit\" value=\"Удалить\" $waring_del name=\"del_g_uslug\"  ></td>\n";
		echo "	<td>\n";
		echo "	<p align=\"center\">Название группы услуг</td>\n";
//		echo "	<td>Единица измерения услуги</td>\n";
		echo "<td>&nbsp;</td>\n";
		echo "</tr>\n";
/////////////////////////////////////////////////////////////////		
	    connect_to_my_db();
  		$query="SELECT * FROM group_uslug ORDER BY 'id_group_uslug'";
  		$result= mysql_query($query) or die (mysql_error());
  		while($row= mysql_fetch_array($result))
      		{
	   			echo "<tr>\n";
	   			echo "<td width=\"67\">\n";
       			echo "<input type=\"checkbox\" name=\"UD[".$row["id_group_uslug"]."]\" value=\"ON\" ></td>\n";
	   			echo "<td>".$row["group_name"]."</td>\n";
//       			echo "<td>".$row["ed_izm"]."</td>\n";
       			echo "<td><a href=\"edit_group_uslug.php?id_row=".$row["id_group_uslug"]."&edit\" >редактировать</a></td>\n";
	   			echo "</tr>\n";
      		}
//////////////////////////////////////////////////////////////
			echo "<tr>\n";
			echo "<td width=\"67\">\n";
			echo "<input type=\"submit\" value=\"Удалить\" $waring_del name=\"del_g_uslug\"></td>\n";
			echo "<td>&nbsp;</td>\n";
//			echo "<td>&nbsp;</td>\n";
			echo "<td>&nbsp;</td>\n";
		echo "</tr>\n";
	echo "</table>\n";  
	echo "</from>\n";    
	}
///////////////////////////////////////////////////////////////////////////////////////////////////

function add_group_uslug($group_uslug_name)
	{
   		$query= "INSERT INTO group_uslug (
                                      		group_name
                                      	  )
                              VALUES (
                                       '$group_uslug_name'
                                      )";
   		connect_to_my_db();
   		$result= mysql_query($query) or die (mysql_error());
 
	}
///////////////////////////////////////////////////////////////////////////////////////////////

function del_g_uslug($UD)
	{
	  //
	  for($i=1;$i< 1+ ordinary_count_row ( "group_uslug", "id_group_uslug");$i++)
      {
       if(isset($UD[$i]))
        {
         //echo $i," ",$C[$i],"<br>";
         $query= "DELETE FROM `group_uslug` WHERE `id_group_uslug` = '$i'";
         connect_to_my_db();
         $result= mysql_query($query) or die (mysql_error());
        }
      }
	}
//////////////////////////////////////////////////////////////////////////////////////////////

function edit_group_uslug_interface($id_row)
	{
	  //редактирование записи
	  show_head("Редактирование групп услуг");
	  $query= "SELECT * FROM group_uslug WHERE id_group_uslug=".$id_row."";
	  connect_to_my_db();
	  $result= mysql_query($query) or die (mysql_error());
	  while($row= mysql_fetch_array($result))
		 {
			 //
			 $group_name= $row["group_name"];
		  }
	  
	  echo "<form name=\"add_del_group_uslug\" method=\"post\" action=\"edit_group_uslug.php\">"; 
	  echo "<input type=\"hidden\" name=\"id_row\" value=\"$id_row\">\n";
	  echo "Название группы услуг <input type=\"text\" name=\"group_uslug_name\" value=\"".$group_name."\" size=\"40\">";
	  echo "&nbsp;&nbsp;";
	  echo "<input type=\"submit\" value=\"Обновить\" name=\"refresh_group_uslug\"></p>";	  
	  
	}

//////////////////////////////////////////////////////////////////////////////////////////////

function edit_group_uslug_work($id_row, $group_uslug_name)
	{
	  //
	  $query= "UPDATE group_uslug SET 
	  						          group_name= '$group_uslug_name'
							          WHERE id_group_uslug= '$id_row'";
		connect_to_my_db();
		$result= mysql_query($query) or die (mysql_error());
	}

//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

if(isset($add_new_group_uslug))
	{
	  //
	  add_group_uslug($group_uslug_name);
	  show_edit_group_window();
	}
if(isset($del_g_uslug) and isset($UD))
	{
	  //
	  del_g_uslug($UD);
	  show_edit_group_window();
	}
if(isset($del_g_uslug) and !isset($UD))
	{
	  show_edit_group_window();
	}

	
if(isset($id_row) and isset($edit))
	{
	  //
	  edit_group_uslug_interface($id_row);
	}
if(isset($refresh_group_uslug) and isset($id_row) and isset ($group_uslug_name))
	{
	  //
	  edit_group_uslug_work($id_row, $group_uslug_name);
	  show_edit_group_window();
	}

if(!isset($add_new_group_uslug) and !isset($UD) and !isset($del_g_uslug) and !isset($id_row) and !isset($edit) and !isset($group_uslug_name) and !isset($refresh_group_uslug))
	{
	  //
	  show_edit_group_window();
	}

?>