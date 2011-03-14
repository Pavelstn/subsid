<?php
//include_once("database_work.php");
//db_select
include_once("db_select.php");
include_once("db_table.php");

echo "<form method=\"POST\" action=\"index.php\">\n";


$database= new db_select("dfsg", "sprav_dohod", "id_dohod", "dohod_name");
//$query=  "select * from sprav_dohod ORDER BY 'id_dohod' ";
//$database->set_name("dfsg");
//$database->set_data("sprav_dohod", "id_dohod", "dohod_name");
//$database->make_query();
$database->to_html();

echo "<hr>\n";
$tbl1= new db_table;
$tbl1->set_query("select  id_dohod, dohod_name from sprav_dohod ORDER BY 'id_dohod' ASC ");
$tbl1->cath_event();
$tbl1->to_html();



echo "</form>\n";
?>