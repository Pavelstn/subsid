<?php
include_once("../../lib/function_define.php");
function show_head($caption)
	{
	  //
	  echo "<body bgcolor=\"#CC99FF\">";
        echo "<table border=\"0\" id=\"table2\" cellpadding=\"0\" style=\"border-collapse: collapse\" width=\"100%\">\n";
        echo "	<tr>\n";
        echo "		<td width=\"357\">\n";
        echo "		<form method=\"POST\" action=\"index.php\">\n";

        echo "			<p><input type=\"submit\" value=\"^ Назад\" name=\"retrun\"></p>\n";
        echo "		</form>\n";
        echo "		</td>\n";
        echo "		<td>".$caption."</td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "<br>\n";
		echo "<hr>\n";
		////////////стили//////////////////////////
		echo "<style type=\"text/css\">\n";
		echo "<!--\n";
		echo "uslg{font-style: italic; font-weight: bold}\n";
		echo "a{color: blue;}\n";
		echo "error{font-weight: bold; color: red;}\n";
		echo "-->\n";
		echo "</style>\n";
		////////////////////////////////////////
	}
	
function add_zero($value)
	{
	  if(strlen($value)==1) {return "0".$value;}
       else { return $value; }
	}
	
function validate_sezon($start_date, $stop_date)
	{
	  echo "<hr>\n";
	  //echo "sdfgfd<br>\n";
	  $count= 0;
	  connect_to_my_db();
	  $query=  "select * from sezon WHERE 'start_sezon'< $start_date AND 'stop_sezon'< $stop_date ORDER BY 'id_uslug' ";
	  $result= mysql_query($query) or die (mysql_error());
	  while($row= mysql_fetch_array($result))
	  	{
		  
		   $count++;
		}
		
		echo $count."<br>\n";
		echo "<hr>\n";
	}
	
function select_sezon($year, $value_default, $add_value)
	{
	  //
	  //$add_value="";
	  $query= "SELECT * FROM sezon WHERE start_sezon >= '".$year."-01-01' AND stop_sezon <= '".$year."-12-31'";
	  connect_to_my_db();
	  $result= mysql_query($query) or die (mysql_error());
	  echo "<select size=\"1\" name=\"sezon\" $add_value >\n";
	  echo "<option value=\"0\">Выберите сезон</opton>\n";
	  while($row= mysql_fetch_array($result))
	  	{
	  	  $select_string= $row["sezon_name"]. " [".date_to_str($row["start_sezon"])."- ".date_to_str($row["stop_sezon"])."]</opton>\n";
		    if($row["id_sezon"]!= $value_default)
		    
		echo "<option value=".$row["id_sezon"].">".$select_string;
		else echo "<option value=".$row["id_sezon"]." selected >".$select_string;

		}
		echo "</select>\n";
	}




?>