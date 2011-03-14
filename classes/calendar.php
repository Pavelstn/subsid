<?
include_once("input.php");


class calendar extends input
{
            //set_name($new_name)
  			//get_name()
  			//set_value($new_value)
  			//get_value()
  			//set_init_method($new_init_method)
  			//get_init_method()
  			//popPostVar($varName)//��������� �������//
  
  
  var $day;
  var $month;
  var $year;
//  var $name="";
  var $data_range_start= 1900;
  var $data_range_stop=  2020;
  
  

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
                    if(strlen($new_data)!=10) { echo "������������ ������ ����<br>\n"; return false; }
                    else
                    	{
						    $this->year= $new_data[0].$new_data[1].$new_data[2].$new_data[3];
                    		$this->month= $new_data[5].$new_data[6];
                    		$this->day= $new_data[8].$new_data[9];
                    		if(!checkdate($this->month, $this->day, $this->year))
								{
								  echo "������������ ����<br>\n";
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
								  echo "������������ ����<br>\n";

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
			    $month_list[1]=  "������";
                $month_list[2]=  "�������";
                $month_list[3]=  "�����";
                $month_list[4]=  "������";
                $month_list[5]=  "���";
                $month_list[6]=  "����";
                $month_list[7]=  "����";
                $month_list[8]=  "�������";
                $month_list[9]=  "��������";
                $month_list[10]= "�������";
                $month_list[11]= "������";
                $month_list[12]= "�������";
                        
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
			  
			  echo "\n<select size=\"1\" name=\"".$this->name."[year_]\"  >\n";
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
		function calendar($new_name)
				{
				  $this->name= $new_name;
				  $this->cath_event();
				}       
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
