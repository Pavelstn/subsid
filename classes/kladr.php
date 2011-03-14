<?php
//работа с кладром//
include_once("database_work.php");

class kladr extends database_work
{
  var $name= "kladr";
  var $kladr_code= "01004000001"; //"01004000001";
 // var $kladr_code_village= "01004000001";
  var $default_departament= "0100400000000";
  var $default_village= "0100400000100";
  var $default_street= "01004000001005600";
  var $num_house= "";
  var $num_korp="";
  var $num_kvart= "";
  
  function get_kladr_code()
  	{ return $this->kladr_code; }
  function get_departament()
  	{ return $this->default_departament; }
  function get_village()
  	{ return $this->default_village; }
  function get_street()
  	{ return $this->default_street; }
  function get_house()
  	{ return $this->num_house; }
  function get_korp()
  	{ return $this->num_korp; }
  function get_kvart()
  	{ return $this->num_kvart; }
  	
  function set_kladr_code($kladr_code)
  	{ $this->kladr_code= $kladr_code; }
  function set_departament($departament)
  	{ $this->default_departament= $departament; }
  function set_village($village)
  	{ $this->default_village= $village; }
  function set_street($street)
  	{ $this->default_street= $street; }
  function set_house($house)
  	{ $this->num_house= $house; }
  function set_korp($korp)
  	{ $this->num_korp= $korp; }
  function set_kvart($kvart)
  	{ $this->num_kvart= $kvart; }
 ///////////////////////////////////////////////////////////////////////////////////////////
 
 
 
 		function popPostVar($varName)
			{
			  //по идее эта функция выбирает параметы которые были переданы форме//
				$result=false;
				if (!empty($_POST[$varName]))
			//	$result=(get_magic_quotes_gpc()?$_POST[$varName]:addslashes($_POST[$varName]));
				$result= $_POST[$varName];
				return $result;
			}
	function cath_event()
			{
			  $event_departament=   $this->popPostVar($this->name."departament");
			  $event_village=   $this->popPostVar($this->name."village");
			  $event_street=  $this->popPostVar($this->name."street");
			  $event_num_house=  $this->popPostVar($this->name."num_house");
			  $event_num_korp=  $this->popPostVar($this->name."num_korp");
			  $event_num_kvart=  $this->popPostVar($this->name."num_kvart");
			  
			  
			  
			  if($event_departament){ $this->default_departament= $event_departament;}
			  if($event_village)    { $this->default_village= $event_village;}
			  if($event_street)     { $this->default_street= $event_street;}
			  if($event_num_house)  { $this->num_house= $event_num_house;}
			  if($event_num_korp)   { $this->num_korp= $event_num_korp;}
			  if($event_num_kvart)  { $this->num_kvart= $event_num_kvart;}
			} 
  //////////////////////////////////////////////////////////////////////////////////////////////
  
	function select_kladr_departament($form_name, $kladr_code, $value_default, $add_value)
         {
          $this->connect_db();


          $query=  "select * from kladr where code REGEXP '^".$kladr_code[0].$kladr_code[1].
                   "+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+0000' AND code NOT REGEXP '^".$kladr_code[0].$kladr_code[1]. "000000000' ";
          $result= mysql_query($query) or die (mysql_error());

          echo "\n<select size=\"1\" name=\"$form_name\" $add_value >\n";
          while($row= mysql_fetch_array($result))
                {
                 if($row["code"]!= $value_default)
                    echo "<option value=",$row["code"],">",$row["socr"], " ", $row["name"],"</opton>\n";
                 else
                    echo "<option value=",$row["code"]," selected >",$row["socr"], " ", $row["name"],"</opton>\n";
                 }
          echo "</select>";
         }
   ///////////////////////////////////////////////////////////////////////////////////////////////////      
  function select_kladr_village($form_name, $kladr_code, $value_default, $add_value)
         {
           $this->connect_db();

           $query="select * from kladr where code REGEXP '^".$kladr_code[0].$kladr_code[1]./*шаблон для региона*/
                            /*шаблон для района*/            $kladr_code[2].$kladr_code[3].$kladr_code[4].
                            /*шаблон для города*/            $kladr_code[5].$kladr_code[6].$kladr_code[7].
                   /*выбираем все подходящие поселки*/       "+[0-9]+[0-9]+[0-9]'  AND code NOT REGEXP '^".
                                                            $kladr_code[0].$kladr_code[1].
                                                            $kladr_code[2].$kladr_code[3].$kladr_code[4].
                                                            $kladr_code[5].$kladr_code[6].$kladr_code[7].
                                                             "000' ";
           //  echo $query;
                     $result= mysql_query($query) or die (mysql_error());

          echo "\n<select size=\"1\" name=\"$form_name\" $add_value >\n";
          while($row= mysql_fetch_array($result))
                {
                 if($row["code"]!= $value_default)
                    echo "<option value=",$row["code"],">",$row["socr"], " ", $row["name"],"</opton>\n";
                 else
                    echo "<option value=",$row["code"]," selected >",$row["socr"], " ", $row["name"],"</opton>\n";
                 }
          echo "</select>";
         }
	////////////////////////////////////////////////////////////////////////////////////////////////// 
  function select_kladr_street($form_name, $kladr_code, $value_default, $add_value)
         {
           $this->connect_db();
         $query=  "select * from street where code REGEXP '^".$kladr_code.
                  "+[0-9]+[0-9]+[0-9]+[0-9]'order by 'name'";
         $result= mysql_query($query) or die (mysql_error());
         echo "\n<select size=\"1\" name=\"$form_name\" $add_value >\n";
         while($row= mysql_fetch_array($result))
          {
           if($row["code"]!= $value_default) //записываем названия всех
             echo "<option value=",$row["code"],">",$row["socr"], " ", $row["name"],"</opton>\n";
           else
             echo "<option value=",$row["code"]," selected >",$row["socr"], " ", $row["name"],"</opton>\n";
          }
          echo "</select>";
         }
		 
////////////////////////////////////////////////////////////////////////////////////////////////////////
function to_html()
{
echo "	<table border=\"0\" id=\"table_kladr\" style=\"border-collapse: collapse\">\n";
echo "		<tr>\n";
echo "			<td>\n";
echo "			<table border=\"0\" id=\"table3\" style=\"border-collapse: collapse\">\n";
echo "				<tr>";
echo "					<td>\n";
					$this->select_kladr_departament($this->name."departament", "0100000000000", $this->default_departament, "onchange= this.form.submit() disabled");
echo "					</td>\n";
echo "					<td>\n";

					$this->select_kladr_village($this->name."village", $this->default_departament, $this->default_village, "onchange= this.form.submit()");

echo "					</td>\n";
echo "					<td>\n";

                    $this->select_kladr_street($this->name."street", $this->default_village, $this->default_street, "");

echo "					</td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "			</td>\n";
echo "		</tr>\n";
echo "		<tr>\n";
echo "			<td>\n";
echo "			<table border=\"0\" id=\"table4\" style=\"border-collapse: collapse\">\n";
echo "				<tr>\n";
echo "					<td>номер дома<input type=\"text\" name=\"".$this->name."num_house"."\" size=\"5\" value=\"".$this->num_house."\"></td>\n";
echo "					<td>корпус<input type=\"text\" name=\"".$this->name."num_korp"."\" size=\"5\" value=\"".$this->num_korp."\"></td>\n";
echo "					<td>квартира <input type=\"text\" name=\"".$this->name."num_kvart"."\" size=\"5\" value=\"".$this->num_kvart."\"></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "			</td>\n";
echo "		</tr>\n";
echo "	</table>\n";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function kladr($name)
  	{
	    $this->name= $name;
	    $this->cath_event();
	    
	}   
	  
}

?>