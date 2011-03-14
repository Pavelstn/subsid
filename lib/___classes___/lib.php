<?
include_once("people_data.php");
include_once("table.php");
class webpage
        {
          var $bgcolor;
          function setbgcolor($color)
                    {
                      $this->bgcolor= $color;
                    }
          function getbgcolor()
                    {
                      return $this->bgcolor;
                    }
          function show_color()
                    {
                      echo "<font color=\"$this->bgcolor\">";
                      echo $this->bgcolor;
                      echo "</font>";
                    }
        }
class button
        {
          var $name;
          var $text;
          var $disable= "false";
          function button($new_name)
                    {
                      $this->name= $new_name;
                    }
          function set_name($new_name)
                    {
                      $this->name= $new_name;
                    }
          function get_name()
                    {
                      return $this->name;
                    }
          function on_click()
                    {
                      return $this->name;
                    }
          function set_text($new_text)
                    {
                      $this->text= $new_text;
                    }
          function get_text()
                    {
                      return $this->text;
                    }
          function set_disable($new_disable)
                    {
                      $this->disable= $new_disable;
                    }
          function show()
                    {
                      //echo "<input type=\"submit\" value=\"$this->text\" name=\"$this->name\">";
                      echo "<input type=\"submit\" value=\"$this->text\" name=\"OBJ[".$this->name."]\">\n";
                    }
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////
function start_form($form_target)
            {
              echo "\n<form method=\"POST\" action=\"$form_target\">\n";
            }
function end_form()
            {
              echo "\n</form>\n";
            }
/////////////////////////////////////////////////////////////////////////////////////////////////////
//function onclick($click_obj)
//            {
//              if(isset($OBJ[$click_obj])) {echo"$click_obj<br>"; return 1;}
//              else {echo"$click_obj<br>";  return 0;}
//            }
class base_text
        {
          var $name;
          var $text;
          var $disable= "false";
          var $size= "20";
          

          function set_name($new_name)
                    {
                      $this->name= $new_name;
                    }
          function get_name()
                    {
                      return $this->name;
                    }
          function on_change()
                    {
                      return $this->name;
                    }
          function set_text($new_text)
                    {
                      $this->text= $new_text;
                    }
          function get_text()
                    {
                      return $this->text;
                    }
          function set_disable($new_disable)
                    {
                      $this->disable= $new_disable;
                    }
          function set_size($new_size)
                    {
                      $this->size= $new_size;
                    }

        }
////////////////////////////////////////////////////////////////////////////////////////////////////////////
class text extends base_text
        {
          function text($new_name)
                    {
                      $this->name= $new_name;
                    }
          function show()
                    {
                      echo "<input type=\"text\" name=\"OBJ[".$this->name."]\" value=\"$this->text\" size=\"$this->size\">\n";
                    }
        }
////////////////////////////////////////////////////////////////////////////////////////////////////////////
class text_paswd extends base_text
        {
          function text_paswd($new_name)
                    {
                      $this->name= $new_name;
                    }
          function show()
                    {
                      echo "<input type=\"password\" name=\"OBJ[".$this->name."]\" value=\"$this->text\" size=\"$this->size\">\n";
                    }
        }
////////////////////////////////////////////////////////////////////////////////////////////////////////////
class text_hidden extends base_text
        {
          function text_hidden($new_name)
                    {
                      $this->name= $new_name;
                    }
          function show()
                    {
                      echo "<input type=\"password\" name=\"OBJ[".$this->name."]\" value=\"$this->text\" size=\"$this->size\">\n";
                    }
        }
////////////////////////////////////////////////////////////////////////////////////////////////////////////
class select
        {
          var $name;
          var $default_value;
          function set_name($new_name)
                    {
                      $this->name= $new_name;
                    }
          function get_name()
                    {
                      return $this->name;
                    }
          function on_change()
                    {
                      return $this->name;
                    }
          function set_default($new_default)
                    {
                      $this->default_value= $new_default;
                    }
         }
//////////////////////////////////////////////////////////////////////////////////////////////////////////
class select_day extends select
        {
          function select_day($new_name)
                    {
                      $this->name= $new_name;
                    }
          function show()
                    {
                      if($this->default_value=="current")
                            {
                              $this->default_value= date("d");
                            }
                      echo "\n<select size=\"1\" name=\"OBJ[".$this->name."]\">\n";
                      for($i = 1; $i <= 31; $i++)
                        {
                          if($i!= $this->default_value) { echo "<option>$i</option>\n"; }
                          else                           { echo "<option selected>$i</option>\n"; }
                        }
                      echo "</select>\n";
                    }
        }
////////////////////////////////////////////////////////////////////////////////
class select_month extends select
        {
          function select_month($new_name)
                    {
                      $this->name= $new_name;
                    }
          function show()
                    {
                        $month_list[1]=  "Января";
                        $month_list[2]=  "Февраля";
                        $month_list[3]=  "Марта";
                        $month_list[4]=  "Апреля";
                        $month_list[5]=  "Мая";
                        $month_list[6]=  "Июня";
                        $month_list[7]=  "Июля";
                        $month_list[8]=  "Августа";
                        $month_list[9]=  "Сентября";
                        $month_list[10]= "Октября";
                        $month_list[11]= "Ноября";
                        $month_list[12]= "Декабря";
                        if($this->default_value=="current")
                            {
                              $this->default_value= date("m");
                            }
                        echo "\n<select size=\"1\" name=\"OBJ[".$this->name."]\">\n";
                        for($i = 1; $i <= 12; $i++)
                            {
                              if($i!= $this->default_value ){ echo "<option value= $i>$month_list[$i] ($i)</option>\n"; }
                              else { echo "<option value= $i selected>$month_list[$i] ($i)</option>\n"; }
                            }
                        echo "</select>\n";
                        
                    }
        }
//////////////////////////////////////////////////////////////////////////////
class select_year extends select
        {
          function select_year($new_name)
                    {
                      $this->name= $new_name;
                    }
          function show()
                    {
                      if($this->default_value=="current")
                            {
                              $this->default_value= date("Y");
                            }
                      echo "\n<select size=\"1\" name=\"OBJ[".$this->name."]\">\n";
                      for($i = 1900; $i <= 2020; $i++)
                        {
                          if($i!= $this->default_value) { echo "<option>$i</option>\n"; }
                          else                           { echo "<option selected>$i</option>\n"; }
                        }
                      echo "</select>\n";
                    }
        }
////////////////////////////////////////////////////////////////////////////////
class select_vid_vipl extends select
        {
          function select_vid_vipl($new_name)
                    {
                      $this->name= $new_name;
                    }
          function get_default()
                    {
                      return $this->default_value;
                    }
          function show()
                    {
                      $vid_vipl[1]=  "Выплачивать";
                      $vid_vipl[2]=  "Приостановлено";
                      $vid_vipl[3]=  "Не выплачивать";
                      echo "\n<select size=\"1\" name=\"OBJ[".$this->name."]\">\n";
                      for($i = 1; $i <= 3; $i++)
                        {
                          if($i!= $this->default_value ){ echo "<option value= $i>".$vid_vipl[$i]."</option>\n"; }
                        else
                            {
                              echo "<option value= ".$i." selected>".$vid_vipl[$i]."</option>\n";
                            }
                        }
                      }
        }
include_once("calendar.php");
///////////////////////////////////////////////////////////////////////////////////
class n_select_uslug
	{
	  //include_once("../function_define.php");
	  //класс для вывода списка услуг//
	  var $text= "";
	  var $default_value="";
	  var $onchange= true;
	  var $zero_select= true; 
	  	function set_onclick($new_text)
	  		{
			    //
			    $this->text= $new_text;
			}
		function n_seclect_uslug($id_group, $default)
		{
	  	//
	  	$query="SELECT * FROM sprav_uslug  WHERE id_group_uslug= '$id_group' ORDER BY 'id_uslug'";
	  	connect_to_my_db();
	  	$result= mysql_query($query) or die (mysql_error());
	  	while($row= mysql_fetch_array($result))
	  		{
		    	//
		    	if($row["id_uslug"]!= $default)
		    		{
				  		echo "<option value=\"".$row["id_uslug"]."\">".$row["uslug_name"]."  [".$row["ed_izm"]."]</option>\n";
					}
				else
					{
				  		echo "<option value=\"".$row["id_uslug"]."\"  selected >".$row["uslug_name"]."  [".$row["ed_izm"]."]</option>\n";
					}
			}
		}

		function n_select_group_uslug($default)
			{
	 	 	//
	  		//echo "n_select_group_uslug";
	  
	 	 	$query="SELECT * FROM group_uslug ORDER BY 'id_group_uslug'";
	 	 	connect_to_my_db();
	  		$result= mysql_query($query) or die (mysql_error());
	  		
	  		if($this->onchange) { $this->text= "onchange= this.form.submit()"; }
	  		
	  		echo "<select name=\"uslug\" ".$this->text." >\n";
      if($this->zero_select) 
      		{
			    echo "<option value=\"0\">Выберите услугу</option>\n";
			}
	  
	  		while($row= mysql_fetch_array($result))
	  			{
		    		//
		    		echo "<optgroup label=\"".$row["group_name"]."\">\n";
		    		$this->n_seclect_uslug($row["id_group_uslug"], $default);
		    		echo "</optgroup>\n";
				}
					echo "</select>\n";	  
			}
		function set_default($new_default)
			{
			  //
			  $this->default_value= $new_default;
			}
			
		function to_html()
			{
			  //
			  $this->n_select_group_uslug($this->default_value);
			}
	  
}



            
?>
