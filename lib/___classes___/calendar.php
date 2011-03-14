<?
include_once("people_data.php");

class calendar extends select
        {
          var $day;
          var $month;
          var $year;
          //var full_data= "";

          function calendar($new_name)
                    {
                      
                      $this->name= $new_name;
                      
                    }
          function set_day($new_day)
                    {
                      if(strlen($new_day)==1) {$this->day= "0".$new_day;}
                      else { $this->day= $new_day; }
                      
                    }
          function set_month($new_month)
                    {
                      if(strlen($new_month)==1) {$this->month= "0".$new_month; }
                      else { $this->month= $new_month; }
                      
                    }
          function set_year($new_year)
                    {
                      $this->year= $new_year;
                    }
                    
          function set_full_data($new_data)
                    {
                      if($new_data== "current")
                        {
                            $this->year= date("Y");
                            $this->month= date("m");
                            $this->day= date("d");
                        }
                      else
                        {
                          $this->year= $new_data[0].$new_data[1].$new_data[2].$new_data[3];
                          $this->month= $new_data[5].$new_data[6];
                          $this->day= $new_data[8].$new_data[9];
                        }
                      

                    }
                    
          function get_day()
                    {
                      if(strlen($this->day)==1) {return "0".$this->day;}
                      else { return $this->day; }
                      
                    }
          function get_month()
                    {
                      if(strlen($this->month)==1) {return "0".$this->month;}
                      else { return $this->month; }
                      
                    }
          function get_year()
                    {
                        return $this->year;
                    }
          function get_full_data()
                    {
                      return  $this->year."-".$this->month."-".$this->day;
                    }

          function show_all()
                    {
                      echo "\n\n<table border=\"0\" id=\"table\" style=\"border-collapse: collapse\">\n";
                      echo "<tr>\n";
                      echo "<td>\n";
                      echo "\n<select size=\"1\" name=\"OBJ[day_".$this->name."]\">\n";
                      for($i = 1; $i <= 31; $i++)
                        {
                          if($i!= $this->day) { echo "<option>$i</option>\n"; }
                          else                { echo "<option selected>$i</option>\n"; }
                        }
                      echo "</select>\n";
                      echo "</td>\n";
                      echo "<td>\n";
                    //-------------------//
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
                        echo "\n<select size=\"1\" name=\"OBJ[month_".$this->name."]\">\n";
                        for($i = 1; $i <= 12; $i++)
                            {
                              if($i!= $this->month ){ echo "<option value= $i>$month_list[$i] ($i)</option>\n"; }
                              else { echo "<option value= $i selected>$month_list[$i] ($i)</option>\n"; }
                            }
                        echo "</select>\n";
                        echo "</td>\n";
                        echo "<td>\n";
                    //-----------------------//
                       echo "\n<select size=\"1\" name=\"OBJ[year_".$this->name."]\">\n";
                       for($i = 1900; $i <= 2020; $i++)
                            {
                              if($i!= $this->year) { echo "<option>$i</option>\n"; }
                              else                 { echo "<option selected>$i</option>\n"; }
                            }
                       echo "</select>\n";
                       echo "</td>\n";
                       echo "</tr>\n";
                       echo "</table>\n";
/*
			                 <td><select size="1" name="D1"></select></td>
			                 <td><select size="1" name="D2"></select></td>
			                 <td><select size="1" name="D3"></select></td>
		                    </tr>
	                       </table>
*/
                    }

        }
        
        
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class calendar2
{
  var $day;
  var $month;
  var $year;
  var $name="";
  var $data_range_start= 1900;
  var $data_range_stop=  2020;
  
        function set_name($new_name)
        	{
			  $this->name= $new_name;
			}
  
        function set_day($new_day)
            {
                if(strlen($new_day)==1) {$this->day= "0".$new_day;}
                    else { $this->day= $new_day; }
            }
              
		///////////////////////////////////////////////
		function set_month($new_month)
            {
                if(strlen($new_month)==1) {$this->month= "0".$new_month; }
                    else { $this->month= $new_month; }
            }
		////////////////////////////////////////////////
		function set_year($new_year)
            {
                $this->year= $new_year;
            }
		///////////////////////////////////////////////        
        function set_full_data($new_data)
            {
                if($new_data== "current")
                {
                    $this->year= date("Y");
                    $this->month= date("m");
                    $this->day= date("d");
                }
                else
                {
                    if(strlen($new_data)!=10) { echo "Неправильный формат даты<br>\n"; return false; }
                    else
                    	{
						    $this->year= $new_data[0].$new_data[1].$new_data[2].$new_data[3];
                    		$this->month= $new_data[5].$new_data[6];
                    		$this->day= $new_data[8].$new_data[9];
                    		if(!checkdate($this->month, $this->day, $this->year))
								{
								  echo "Неправильная дата<br>\n";
								  $this->year= "0001";
								  $this->month="01";
								  $this->day= "01";
								  return false;
								} 
						}  
                }
            }
        ////////////////////////////////////////////////
		function get_full_data()
			{
			  return $this->year."-".$this->month."-".$this->day;
			}    
        ////////////////////////////////////////////////
        function set_date_range_start($new_range_start)
        		{
				  $this->data_range_start= $new_range_start;
				}
        ////////////////////////////////////////////////
        function set_date_range_stop($new_range_stop)
        		{
				  $this->data_range_stop= $new_range_stop;
				}

        /////////////////////////////////////////////////
       function popPostVar($varName)
			{
			  //по идее эта функция выбирает параметы которые были переданы форме//
				$result=false;
				if (!empty($_POST[$varName]))
				$result= $_POST[$varName];
				return $result;
			}
		////////////////////////////////////////////////
		function cath_event()
			{
			    if($this->popPostVar($this->name))
				{ 
				$change_event=   $this->popPostVar($this->name);
				//echo $change_event,"<br>\n";
				//echo $change_event["day_"]."<br>\n";
				$this->set_day($change_event["day_"]);
				//echo $change_event["month_"]."<br>\n";
				$this->set_month($change_event["month_"]);
				//echo $change_event["year_"]."<br>\n";	
				$this->set_year($change_event["year_"]);
				
                    		if(!checkdate($this->month, $this->day, $this->year))
								{
								  echo "Неправильная дата<br>\n";
								  $this->year= "0001";
								  $this->month="01";
								  $this->day= "01";
								  return false;
								} 				
				}		
			}
		/////////////////////////////////////////////////
		function show_day()
			{
			  echo "\n<select size=\"1\" name=\"".$this->name."[day_]\">\n";
			  for($i = 1; $i <= 31; $i++)
			  {
			    if($i!= $this->day) { echo "<option>$i</option>\n"; }
			    else                { echo "<option selected>$i</option>\n"; }
			  }
			  echo "</select>\n"; 
			}
		//////////////////////////////////////////////////
		function show_month()
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
                        
                echo "\n<select size=\"1\" name=\"".$this->name."[month_]\">\n";
				for($i = 1; $i <= 12; $i++)
					{
					  if($i!= $this->month ){ echo "<option value= $i>$month_list[$i] ($i)</option>\n"; }
                      else { echo "<option value= $i selected>$month_list[$i] ($i)</option>\n"; }
					}
				echo "</select>\n";	        
			} 
		///////////////////////////////////////////////////
		function show_year()
			{
			  echo "\n<select size=\"1\" name=\"".$this->name."[year_]\">\n";
			  for($i = $this->data_range_start; $i <= $this->data_range_stop; $i++)
			  	{
				    if($i!= $this->year) { echo "<option>$i</option>\n"; }
				    else                 { echo "<option selected>$i</option>\n"; }
				}
			  echo "</select>\n";
			}
		//////////////////////////////////////////////////////
		function to_html()
			{
			  	echo "<table border=\"0\" style=\"border-collapse: collapse\" \n>";
				echo "	<tr>\n";
				echo "		<td>"; $this->show_day();   echo"</td>\n";
				echo "		<td>"; $this->show_month(); echo"</td>\n";
				echo "		<td>"; $this->show_year();  echo"</td>\n";
				echo "	</tr>\n";
			  	echo "</table>\n";
			}         
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class adv_select_year extends select
	{
	  //
	  //set_name($new_name)
	  //get_name()
	  //on_change()
	  //set_default($new_default)
	  //var $name;
	  //var $default_value;
	  var $on_click="";
	  
	  function set_onclick($new_on_click)
	  	{
		    $this->on_click= $new_on_click;
		}
	  
	  function to_html()
        {
         if($this->default_value== "current") {$this->default_value= date("Y");}//добавляем текущую дату

         echo "<select size=\"1\" name=\"".$this->name."\"  ".$this->on_click." >\n";
         for($i = 1900; $i <= 2020; $i++)
            {
             if($i!= $this->default_value){ print "<option>$i</option>\n"; }
             else {print "<option selected>$i</option>\n"; }
            }
         echo "</select>";
        }
        
        function adv_select_year($new_name, $new_deafult, $new_on_click)
        		{
				  //
				  $this->set_name($new_name);
				  $this->set_default($new_deafult);
				  $this->set_onclick($new_on_click);
				  $this->to_html();
				  
				  
				}
        		
	}
        
?>
