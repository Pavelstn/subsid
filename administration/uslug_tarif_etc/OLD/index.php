<?php

include_once("main_window.php");
//услуги тарифы и так далее index.php
echo "<body bgcolor=\"#CC99FF\">";

        echo "<table border=\"0\" id=\"table2\" cellpadding=\"0\" style=\"border-collapse: collapse\" width=\"100%\">\n";
        echo "	<tr>\n";
        echo "		<td width=\"357\">\n";
        echo "		<form method=\"POST\" action=\"../administration.php\">\n";

        echo "			<p><input type=\"submit\" value=\"^ Назад\" name=\"retrun\"></p>\n";
        echo "		</form>\n";
        echo "		</td>\n";
        echo "		<td>Редактирование услуг тарифов и.т.д.</td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "<br>\n";
		echo "<hr>\n";
		
//////////////////////////////////////

//if(isset($click))
//		{
//		  //начинаем обработку нажатых кнопок//
//		  echo $click."<br>\n";
//		  
//		  switch ($click)
//		  {
//		    //
//		    case isset($click["edit_org"]) : echo "edit_org";
//		    break;
//		    
//		    case isset($click["edit_group_uslug"]) : echo "edit_group_uslug";
//		    break;
//
//		    case isset($click["edit_uslug"]) : echo "edit_uslug";
//		    break;
//		    
//		    case isset($click["edit_sezon"]) : echo "edit_sezon";
//		    break;
//		    
//		    case isset($click["edit_tarif_net"]) : echo "edit_tarif_net";
//		    break;
//		}
//		  
//		}
//else 
//	{
//	  //если нет значим показывем главное окно//
//	  show_main_window();
//	}
show_main_window(); 		

?>

