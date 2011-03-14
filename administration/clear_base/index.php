<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");
include_once("../../classes/password.php");
include_once("../../classes/database_work.php");

//группы услуг//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("../index.php");
/////////////////////////////////////////////////
$pass= new password;
$pass->set_name("_pss_");

$clear_people_data= new submit("_clr_ppl_","Очистить данные о домовладениях и жильцах");
$clear_people_data->set_alert(true);
$clear_people_data->set_alert_text("Вы действительно хотите удалить ВСЕ ДАННЫЕ О ДОМОВЛАДЕНИЯХ ?");
	if($clear_people_data->get_onclick())
		{
		  $pass->cath_event();
		  echo $pass->get_value();
		  if(crypt($pass->get_value(), 'xx')=="xxMJPlbn2mOMI")
			{
				$dtb= new database_work;
		  		$dtb->connect_db();
		  		$query= "DELETE FROM zayavki";
		  			$result= mysql_query($query) or die (mysql_error());
				$query= "DELETE FROM uslug";
					$result= mysql_query($query) or die (mysql_error());
				$query= "DELETE FROM udostover";
					$result= mysql_query($query) or die (mysql_error());
				$query= "DELETE FROM udobstv";
					$result= mysql_query($query) or die (mysql_error());
				$query= "DELETE FROM people";
					$result= mysql_query($query) or die (mysql_error());
				$query= "DELETE FROM house_env";
					$result= mysql_query($query) or die (mysql_error());
				$query= "DELETE FROM house";
					$result= mysql_query($query) or die (mysql_error());
				$query= "DELETE FROM dohod";
		  			$result= mysql_query($query) or die (mysql_error());
		  		$dtb->dis_connect_db();
				  echo "Удаление из базы"; 
				  link("index.php");
			}
			if(crypt($pass->get_value(), 'xx')!="xxMJPlbn2mOMI") echo "Неправильно набран пароль<br>\n";
		  
		  
		}





echo "<form method=\"POST\"  action=\"index.php\">\n";
$back->to_html();
echo "администрирование->Очистка базы\n<hr>\n";
//////////////////////////////////////////////////////////////////
$clear_people_data->to_html();
$pass->to_html();




echo "</form>\n";
?>