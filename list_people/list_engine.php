<?
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();

include_once("../classes/submit.php");
include_once("../classes/kladr.php");
include_once("../classes/db_select.php");
include_once("../lib/navigate.php");

include_once("local_lib.php");

$exit= new submit("ext","Выход");
$new_people= new submit("new_ppl","Новое заявление");
$find_it= new submit("fnd_it","Поиск");

$find_by= new db_select("fnd_by", "find_by", "id_find", "name");

if($find_by->get_value()== "1")
	{
	  $kldr1= new kladr("kladr");
	  $query= "SELECT * FROM house";
	}
if($find_by->get_value()== "2")
	{
	  $fnd_by_ppl = new find_by_people();
	  $query= "SELECT * FROM people";
	}

if(($find_by->get_value()!= "1" AND ($find_by->get_value()!= "2"))) 
	{
	   $kldr1= new kladr("kladr");
	   $find_by->set_value("1");
	  $rows= "house.code_street, house.nomer_doma, house.nomer_korpusa, house.nomer_kvartiri, house_env.vladelec, house.id_home";
	   
	   $tables= "house, house_env ";
	   //$where= "WHERE street.code= house.code_street AND house_env.id_home= house.id_home AND house_env.vladelec= people.id_people";
	   $where= "WHERE house_env.id_home= house.id_home ";
	   //$where2= "AND people.id_home= house.id_home";
	  
	   $query= "SELECT ".$rows." FROM ".$tables.$where;
	   //$query= "SELECT * FROM house";
	   //echo $query;
	}
////////////////////обработка кноппок////////////////////////////////////////////////////////
if($exit->get_onclick()) link("../system_menu.php");
if($find_it->get_onclick())
	{
	  //
	  //link("../system_menu.php");
	  //обработка кнопки поиска//
	  if($find_by->get_value()== "1")
	  	{
		    //поиск по додмовледениям//
		    $query= b_find_by_adres($kldr1->get_street(), $kldr1->get_house(), $kldr1->get_korp(), $kldr1->get_kvart());
		   echo "\n<br>\n".$query."<br>\n"; 
		}
	  if($find_by->get_value()== "2")
	  	{
	  	  //поиск по именам//
		   $query= b_find_by_people($fnd_by_ppl->get_familia(), $fnd_by_ppl->get_imya(), $fnd_by_ppl->get_otchestvo());
		    echo "\n<br>\n".$query."<br>\n"; 
		}
	}

if($new_people->get_onclick()) link("../new_house/new_house.php");
/////////////////////////////////////////////////////////////////////////////////////////////////

?>
<form method="POST"  action="list_engine.php">

	<table border="0" width="100%" id="table1" bgcolor="#00FF00" bordercolordark="#00FF00" bordercolorlight="#00FF00"  style="border-collapse: collapse">
	<tr>
		<td width="20%"><? $exit->to_html(); ?></td>
		<td>
		<table border="0" width="100%" id="table2" style="border-collapse: collapse">
			<tr>
				<td width="175">Просмотр (поиск)</td>
				<td>
            <? $find_by->to_html();  ?>
				</td>
			</tr>
		</table>
		</td>
		<td width="20%"> <? $new_people->to_html(); ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
<? 
	if($find_by->get_value()== "1")
	{
	  $kldr1->to_html(); 
	}
	if($find_by->get_value()== "2")
	{
	  $fnd_by_ppl->to_html();  
	}	  
?>
</td>
		<td><? $find_it->to_html();  ?></td>
	</tr>
</table>
	<p></p>
</form>
<?
$_SESSION['_query']= $query;



                echo "<iframe name=\"I1\" width=\"100%\" height=\"80%\" src=\"list.php\">";
                echo "	Ваш обозреватель не поддерживает встроенные рамки или он не настроен на их отображение.";
                echo "</iframe>";








?>
