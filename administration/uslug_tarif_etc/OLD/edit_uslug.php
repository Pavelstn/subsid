<?php
include_once("../../lib/function_define.php");
include_once("local_lib.php");

///////////////////////////////////////////////////////////////////////////////////////////////
function get_name_group_uslug($id_group_uslug)
	{
	  //
	  $group_name= "<font color=\"red\">не определено</font>";
	  $query= "SELECT group_name FROM group_uslug WHERE id_group_uslug= '$id_group_uslug'";
	  connect_to_my_db();
	  $result= mysql_query($query) or die (mysql_error());
	  while($row= mysql_fetch_array($result))
	  	{
		    //
		    $group_name= $row["group_name"];
		}
		//if(!$group_name) { return "<font color=\"red\">не определено</font>";}
		return $group_name;
	}
///////////////////////////////////////////////////////////////////////////////////////////////
function seltct_group($default)
	{
	  //
	  $query="SELECT * FROM group_uslug ORDER BY 'id_group_uslug'";
	  connect_to_my_db();
	  $result= mysql_query($query) or die (mysql_error());
	  echo "<select size=\"1\" name=\"select_uslug_group\">\n";
	  while($row= mysql_fetch_array($result))
	  	{
		    //
		    $id_group_uslug= $row["id_group_uslug"];
		    $group_name= $row["group_name"];
		    
		    if($id_group_uslug!= $default) { echo "<option value=\"".$id_group_uslug."\">".$group_name."</option>\n"; }
		    	else        { echo "<option value=\"".$id_group_uslug."\" selected>".$group_name."</option>\n"; }
		}
	echo "</select>\n";
	}
///////////////////////////////////////////////////////////////////////////////////////////////
function show_edit_group_window()
	{ show_head("Редактирование услуг");
// 		echo "<style type=\"text/css\">\n";
// 		echo "<!--\n";
// 		echo "uslg{font-style: italic; font-weight: bold}\n";
// 		echo "a{color: blue;}\n";
// 		echo "-->\n";
// 		echo "</style>\n";

	  $waring_del= "onclick=\"return confirm('Вы действительно хотите удалить эту запись? ВНИМАНИЕ данные невозможно будет восстановить.')\"";
	  //покзываем основное окно редактирования груп услуг//
	 echo "<form name=\"add_del_group_uslug\" method=\"post\" action=\"edit_uslug.php\">"; 
	 
	  echo "Название группы услуг\n";
//	  if(isset($select_uslug_group))
//	  	{
 		    seltct_group("");
//		}
//	 else { seltct_group(""); }
	  
	  echo "<br>\n";
	  echo "Название услуги <input type=\"text\" name=\"uslug_name\" size=\"40\">";
	  
	  echo "Единица измерения<input type=\"text\" name=\"ed_izm\" size=\"10\">";
	  echo "&nbsp;&nbsp;";
	  echo "<input type=\"submit\" value=\"Добавить новую услугу\" name=\"add_new_uslug\"></p>";
	  echo "<hr>\n";  
	  
	  	echo "<table border=\"1\" width=\"100%\" id=\"table1\">\n";
		echo "<tr>\n";
		echo "	<td width=\"67\">\n";
		echo "	<input type=\"submit\" value=\"Удалить\" $waring_del name=\"del_uslug\"  ></td>\n";

		echo "	<td>Группа услуг</td>\n";
		
		echo "	<td>\n";
		echo "	<p align=\"center\">Название услуги</td>\n";
		echo "	<td>Единица измерения услуги</td>\n";
		echo "<td>&nbsp;</td>\n";
		echo "</tr>\n";
/////////////////////////////////////////////////////////////////		
	    connect_to_my_db();
  		$query="SELECT * FROM sprav_uslug ORDER BY 'id_uslug'";
  		
//  		$query="SELECT * FROM sprav_uslug, group_uslug WHERE sprav_uslug.id_group_uslug= group_uslug.id_group_uslug ORDER BY 'id_uslug'";;
  		
  		
  		$result= mysql_query($query) or die (mysql_error());
  		while($row= mysql_fetch_array($result))
      		{
	   			echo "<tr>\n";
	   			echo "<td width=\"67\">\n";
       			echo "<input type=\"checkbox\" name=\"UD[".$row["id_uslug"]."]\" value=\"ON\" ></td>\n";
       			echo "	<td><uslg>";
       			echo get_name_group_uslug($row["id_group_uslug"]);
				echo "</uslg></td>\n";
	   			echo "<td>".$row["uslug_name"]."</td>\n";
       			echo "<td>".$row["ed_izm"]."</td>\n";
       			echo "<td><a href=\"edit_uslug.php?id_row=".$row["id_uslug"]."&edit\" >редактировать</a></td>\n";
	   			echo "</tr>\n";
      		}
//////////////////////////////////////////////////////////////
			echo "<tr>\n";
			echo "<td width=\"67\">\n";
			echo "<input type=\"submit\" value=\"Удалить\" $waring_del name=\"del_uslug\"></td>\n";
			echo "<td>&nbsp;</td>\n";
			echo "<td>&nbsp;</td>\n";
			echo "<td>&nbsp;</td>\n";
			echo "<td>&nbsp;</td>\n";
		echo "</tr>\n";
	echo "</table>\n";  
	echo "</from>\n";    
	}
///////////////////////////////////////////////////////////////////////////////////////////////////

function add_group_uslug($select_uslug_group, $uslug_name, $ed_izm)
	{
	     $query= "INSERT INTO sprav_uslug (
                                      id_group_uslug,
									  uslug_name,
                                      ed_izm
                                      
                                     )
                              VALUES (
                              		   '$select_uslug_group',
                                       '$uslug_name',
                                       '$ed_izm'
                                     )";
                                     

   		connect_to_my_db();
   		$result= mysql_query($query) or die (mysql_error());
 
	}
///////////////////////////////////////////////////////////////////////////////////////////////

function del_uslug($UD)
	{
	  //
	  for($i=1;$i< 1+ ordinary_count_row ( "sprav_uslug", "id_uslug");$i++)
      {
       if(isset($UD[$i]))
        {
         //echo $i," ",$C[$i],"<br>";
         $query= "DELETE FROM `sprav_uslug` WHERE `id_uslug` = '$i'";
         connect_to_my_db();
         $result= mysql_query($query) or die (mysql_error());
        }
      }
	}
//////////////////////////////////////////////////////////////////////////////////////////////

function edit_uslug_interface($id_row)
	{
	  //редактирование записи
	  show_head("Редактирование услуги");
	//  $query= "SELECT * FROM group_uslug WHERE id_group_uslug=".$id_row."";
	  $query="SELECT * FROM sprav_uslug WHERE id_uslug=".$id_row."";
	  connect_to_my_db();
	  
//	  $id_group_uslug= 0;
//	  $uslug_name= "";
//	  $ed_izm= "";
	  $result= mysql_query($query) or die (mysql_error());
	  while($row= mysql_fetch_array($result))
		 {
			 //
//			 echo "<br>-------------------------<br>";
//			 echo $row["id_group_uslug"];
//			 echo $row["uslug_name"];
//			 echo $row["ed_izm"];
//			 echo "<br>-------------------------<br>";
			 $id_group_uslug= $row["id_group_uslug"];
			 $uslug_name= $row["uslug_name"];
			 $ed_izm= $row["ed_izm"];
		  }
	  
	  echo "<form name=\"add_del_group_uslug\" method=\"post\" action=\"edit_uslug.php\">"; 
	  echo "<input type=\"hidden\" name=\"id_row\" value=\"$id_row\">\n";
	  
	  echo "Группы услуг";
	  seltct_group($id_group_uslug);
	  echo" <input type=\"text\" name=\"uslug_name\" value=\"".$uslug_name."\" size=\"40\">";
	  echo" <input type=\"text\" name=\"ed_izm\" value=\"".$ed_izm."\" size=\"10\">";
	  echo "&nbsp;&nbsp;";
	  echo "<input type=\"submit\" value=\"Обновить\" name=\"refresh_uslug\"></p>";	  
	  
	}

//////////////////////////////////////////////////////////////////////////////////////////////

function edit_uslug_work($id_row, $select_uslug_group, $uslug_name, $ed_izm)
	{
	  //
	  $query= "UPDATE sprav_uslug SET 
	  						          id_group_uslug= '$select_uslug_group',
	  						          uslug_name= '$uslug_name',
	  						          ed_izm= '$ed_izm'
							          WHERE id_uslug= '$id_row'";
		connect_to_my_db();
		$result= mysql_query($query) or die (mysql_error());
	//	echo "Готово\n";
	}

//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

if(isset($add_new_uslug))
	{
	  //
	  add_group_uslug($select_uslug_group, $uslug_name, $ed_izm);
	  show_edit_group_window();
	}
if(isset($del_uslug) and isset($UD))
	{
	  //
	  del_uslug($UD);
	  show_edit_group_window();
	}


	
if(isset($id_row) and isset($edit))
	{
	  //
	  edit_uslug_interface($id_row);
	}

	
if(isset($refresh_uslug) and isset($id_row) and isset ($select_uslug_group) and isset($uslug_name) and isset($ed_izm))
	{
	  //
	  edit_uslug_work($id_row, $select_uslug_group, $uslug_name, $ed_izm);
	  show_edit_group_window();
	}
//show_edit_group_window();
if(!isset($add_new_uslug) and !isset($UD) and !isset($refresh_uslug) and !isset($edit) and !isset($edit) and !isset($group_uslug_name) and !isset($del_uslug))
	{
	  //
	  show_edit_group_window();
	}

?>