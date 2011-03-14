<?php
include_once("../../lib/function_define.php");
include_once("local_class.php");
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





?>