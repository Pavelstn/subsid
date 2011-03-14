<?php
//демонстрация работы//
include_once("../../lib/function_define.php");
include_once("local_lib.php");
include_once("local_class.php");
if(!isset($new_net)) { $new_net= new net; }


show_head("Самотестирование");

//echo $PHP_SELF;

echo "<form method=\"POST\" action=\"self_test.php\">\n";
$uslg= new n_select_uslug;
$uslg->n_select_group_uslug(24);
echo "<hr>\n";



$new_net->set_query("SELECT * FROM test");
$new_net->add_visible_row("name_1", "имя 1");
$new_net->add_visible_row("name_2", "имя 2");
$new_net->set_table_for_del("test", "id_test");
$new_net->set_edit_row(true);
$new_net->set_edit_path("self_test.php"); //$PHP_SELF
$new_net->cath_event();
$new_net->to_html_test2();

echo "</form>";
if(checkdate(2, 29, 2000))//проверка правильности даты   месяц, день, год//
	{
	  echo "YES<br>\n";
	}


?>