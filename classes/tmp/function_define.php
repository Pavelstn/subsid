<?php
// ���� �������� ������������ ����� �������� ��������� �������
//include_once("classes/lib.php");
//$servername= "http://192.168.2.1";
//$servername= "http://subsid_nt";
$servername= "http://subsid";
$_SESSION['$servername']= $servername;

$_SESSION['bgcolor']= "#6699FF";
$_SESSION['bgcolor_for_list']= "#339966";

////////////////////////������� ����������� � ���� ������///////////////////////////
function connect_to_my_db()
         {
          $db= mysql_connect("subsid", "", "") or die("erorr connect to database");
          mysql_select_db("subsid", $db) or die ("not find base");
         }
////////////////////////////////////////////////////////////////////////////////////////////////////
function select_kladr_region($form_name, $value_default, $add_value)
         {
          connect_to_my_db();
          $query=  "select * from kladr where code REGEXP '^[0-9]+[0-9]+000000000' order by 'code'" ;
          $result= mysql_query($query) or die (mysql_error());
          echo "<select size=\"1\" name=\"$form_name\" $add_value >\n";
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
function select_kladr_departament($form_name, $kladr_code, $value_default, $add_value)
         {
          connect_to_my_db();

/*           echo "<br>form_name",$form_name;
           echo "<br>kladr_code:",$kladr_code;
           echo "<br>value_default:",$value_default;
           echo "<br>add_value:",$add_value;
           echo "<br>";
 */
          $query=  "select * from kladr where code REGEXP '^".$kladr_code[0].$kladr_code[1].
                   "+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+000' AND code NOT REGEXP '^".$kladr_code[0].$kladr_code[1]. "000000000' ";
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
///////////////////////////////////////////////////////////////////////////////////////////////////////
function select_kladr_village($form_name, $kladr_code, $value_default, $add_value)
         {
           connect_to_my_db();
 /*          echo "<br>form_name",$form_name;
           echo "<br>kladr_code:",$kladr_code;
           echo "<br>value_default:",$value_default;
           echo "<br>add_value:",$add_value;
           echo "<br>"; */
           $query="select * from kladr where code REGEXP '^".$kladr_code[0].$kladr_code[1]./*������ ��� �������*/
                            /*������ ��� ������*/            $kladr_code[2].$kladr_code[3].$kladr_code[4].
                            /*������ ��� ������*/            $kladr_code[5].$kladr_code[6].$kladr_code[7].
                   /*�������� ��� ���������� �������*/       "+[0-9]+[0-9]+[0-9]'  AND code NOT REGEXP '^".
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function select_kladr_street($form_name, $kladr_code, $value_default, $add_value)
         {
         $query=  "select * from street where code REGEXP '^".$kladr_code.
                  "+[0-9]+[0-9]+[0-9]+[0-9]'order by 'name'";
         $result= mysql_query($query) or die (mysql_error());
         echo "\n<select size=\"1\" name=\"$form_name\" $add_value >\n";
         while($row= mysql_fetch_array($result))
          {
           if($row["code"]!= $value_default) //���������� �������� ����
             echo "<option value=",$row["code"],">",$row["socr"], " ", $row["name"],"</opton>\n";
           else
             echo "<option value=",$row["code"]," selected >",$row["socr"], " ", $row["name"],"</opton>\n";
          }
          echo "</select>";
         }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function select_sprav_dohod()
         {
          connect_to_my_db();
          $query=  "select * from sprav_dohod ORDER BY 'id_dohod' ";
          $result= mysql_query($query) or die (mysql_error());
          echo "\n<select size=\"1\" name=\"id_dohod\"  >\n";
          while($row= mysql_fetch_array($result))
               {
                 echo "<option value=".$row["id_dohod"].">".$row["dohod_name"]."</opton>\n";
               }
         echo "</select>";
         }



///////////////////////////////////////////////////////////////////////////////////////////
function select_sprav_uslug()
         {
           connect_to_my_db();
           $query=  "select * from sprav_uslug ORDER BY 'id_uslug' ";
           $result= mysql_query($query) or die (mysql_error());
           echo "\n<select size=\"1\" name=\"id_uslug\"  >\n";
           while($row= mysql_fetch_array($result))
               {
                 echo "<option value=".$row["id_uslug"].">".$row["uslug_name"]."</opton>\n";
               }
           echo "</select>";
         }
///////////////////////////////////////////////////////////////////////////////////////////
function select_adv_sprav_uslug($form_name, $value_default, $add_value)
         {
           connect_to_my_db();
           $query=  "select * from sprav_uslug ORDER BY 'id_uslug' ";
           $result= mysql_query($query) or die (mysql_error());
           echo "\n<select size=\"1\" name=\"".$form_name."\" $add_value >\n";
           echo "<option value= 0 >�������� ������</option>";
           while($row= mysql_fetch_array($result))
               {
               if($row["id_uslug"]!= $value_default)
                  echo "<option value=".$row["id_uslug"].">".$row["uslug_name"]."  (".$row["ed_izm"].")"."</opton>\n";
               else
                {
                   $ed_izm= $row["ed_izm"];
                  echo "<option value=".$row["id_uslug"]." selected>".$row["uslug_name"]."  (".$row["ed_izm"].")"."</opton>\n";
               
                }
               }
           echo "</select>";
         // return $ed_izm;
         }
///////////////////////////////////////////////////////////////////////////////////////////
function select_adv_sprav_uslug_which_org($form_name, $default_org, $value_default, $add_value)
         {
           connect_to_my_db();
 ////////////////////////////////////////////////////////////////////////////////////////////
               $query="SELECT * FROM org_vs_uslug,sprav_uslug
                      WHERE org_vs_uslug.id_uslug= sprav_uslug.id_uslug
                      AND  org_vs_uslug.id_org= '$default_org'
                      ORDER BY 'org_vs_uslug.count'";

///////////////////////////////////////////////////////////////////////////////////////////////
           $result= mysql_query($query) or die (mysql_error());
           echo "\n<select size=\"1\" name=\"".$form_name."\" $add_value >\n";
           echo "<option value= 0 >�������� ������</option>";
           while($row= mysql_fetch_array($result))
               {
               if($row["id_uslug"]!= $value_default)
                  echo "<option value=".$row["id_uslug"].">".$row["uslug_name"]."  (".$row["ed_izm"].")"."</opton>\n";
               else
                { 
                   $ed_izm= $row["ed_izm"];
                    if(!isset($ed_izm)) {$ed_izm="0";}
                  echo "<option value=".$row["id_uslug"]." selected>".$row["uslug_name"]."  (".$ed_izm.")"."</opton>\n";

                }
               }
           echo "</select>";
           if(!isset($ed_izm)) {$ed_izm="0";}
          return $ed_izm;
         }
///////////////////////////////////////////////////////////////////////////////////////////
function select_vid_psprt($name, $default_psprt)
        {
          $query=  "select * from  sprav_vid_pasprt";
          connect_to_my_db();
          
              
        echo "<select size=\"1\" name=\"".$name."\">\n";
        $result= mysql_query($query) or die (mysql_error());
        while($row= mysql_fetch_array($result))
        {
            $code_doc= $row["code_doc"];
             if($code_doc!= $default_psprt) { print "<option value=\"".$code_doc."\">".$row["name_psprt"]."</option>\n"; }
                 else        { print "<option value=\"".$code_doc."\" selected>".$row["name_psprt"]."</option>\n"; }
         }
        echo "</select>\n";
        }

///////////////////////////////////////////////////////////////////////////////////////////
function select_adv_sprav_org_vs_usl ($form_name, $value_default, $add_value)
         {
           connect_to_my_db();
           $query=  "select * from sprav_org ORDER BY 'id_org' ";
           $result= mysql_query($query) or die (mysql_error());
           echo "\n<select size=\"1\" name=\"".$form_name."\" $add_value >\n";
           echo "<option>�������� �����������</option>";
           while($row= mysql_fetch_array($result))
               {
               if($row["id_org"]!= $value_default)
                  echo "<option value=".$row["id_org"].">".$row["name_org"]."</opton>\n";
               else
                //  echo "<option value=".$row["id_uslug"]." selected >".$row["uslug_name"]."</opton>\n";
                echo "<option value=".$row["id_org"]." selected>".$row["name_org"]."</opton>\n";
               }
           echo "</select>";
         }
///////////////////////////////////////////////////////////////////////////////////////////

function select_day($name, $default_day)
        {
          if($default_day== "current") {$default_day= date("d");}//��������� ������� ����
        echo "<select size=\"1\" name=\"".$name."\">\n";
        for($i = 1; $i <= 31; $i++)
           {
             if($i!= $default_day) { print "<option>$i</option>\n"; }
             else                  { print "<option selected>$i</option>\n"; }
            }
        echo "</select>\n";
        }
////////////////////////////////////////////////////////////////////////////////////////////
function select_month($name, $default_month)
         {
          echo "<select size=\"1\" name=\"".$name."\">";
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
         for($i = 1; $i <= 12; $i++)
             {
              if($i!= $default_month ){ print "<option value= $i>$month_list[$i] ($i)</option>\n"; }
              else { print "<option value= $i selected>$month_list[$i] ($i)</option>\n"; }
             }
         echo "</select>\n";
         }
/////////////////////////////////////////////////////////////////////////////////////////////////
function select_year ($name, $default_year)
        {
         if($default_year== "current") {$default_year= date("Y");}//��������� ������� ����

         echo "<select size=\"1\" name=\"".$name."\">";
         for($i = 1900; $i <= 2020; $i++)
            {
             if($i!= $default_year){ print "<option>$i</option>\n"; }
             else {print "<option selected>$i</option>\n"; }
            }
         echo "</select>";
        }
///////////////////////////////////////////////////////////////////////////////////////////
function get_year($date)
        {
          $year= $date[0].$date[1].$date[2].$date[3];
          return $year;
        }
/////////////////////////////////////////////////////
function get_month($date)
         {
           return $date[5].$date[6];
         }
/////////////////////////////////////////////////////
function get_day($date)
         {
           return $date[8].$date[9];
         }
///////////////////////////////////////////////////////////////////////////////////////////
function select_people_for_owner_house($name, $session_id, $count_id_home, $default)
         {
              echo "<select size=\"1\" name=\"".$name."\">";
            $query=  "SELECT * FROM people
                               WHERE id_home= '$count_id_home'";
            connect_to_my_db();
            $result= mysql_query($query) or die (mysql_error());
            while($row= mysql_fetch_array($result))
                {
                  $id_people= $row["id_people"];
                  $familia= $row["familia"];      
                  $imya= $row["imya"];
                  $otchestvo= $row["otchestvo"];
                  if($id_people!=$default) {echo "<option value=".$id_people.">".$familia." ".$imya." ".$otchestvo."</option>\n";}
                  else {echo "<option value=".$id_people." selected>".$familia." ".$imya." ".$otchestvo."</option>\n";}
                }
             echo "</select>";

         }
         
///////////////////////////////////////////////////////////////////////////////////////////
function select_people_for_owner_house_for_list($name,$count_id_home, $default)
         {

              echo "<select size=\"1\" name=\"".$name."\">";
            $query=  "SELECT * FROM people
                               WHERE id_home= '$count_id_home'";
            connect_to_my_db();
            $result= mysql_query($query) or die (mysql_error());
            while($row= mysql_fetch_array($result))
                {
                  $id_people= $row["id_people"];
                  $familia= $row["familia"];
                  $imya= $row["imya"];
                  $otchestvo= $row["otchestvo"];
                  if($id_people!=$default) {echo "<option value=".$id_people.">".$familia." ".$imya." ".$otchestvo."</option>\n";}
                  else {echo "<option value=".$id_people." selected>".$familia." ".$imya." ".$otchestvo."</option>\n";}
               // echo "<option value=".$id_people.">".$familia." ".$imya." ".$otchestvo."</option>\n";
                }
             echo "</select>";

         }
/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
function count_row ($session_id, $table_name, $column_name)
        {
           connect_to_my_db();
           $count= 0;
           $test= 0;
           $query= "SELECT * from $table_name
                    WHERE session_id='$session_id'
                    ORDER BY $column_name";
           $result= mysql_query($query) or die (mysql_error());
           while($row= mysql_fetch_array($result))
               {
                $count++;
                 if($row["$column_name"] > $test)
                    {
                     $test= $row["$column_name"];
                     }


               }

         return $test;
        }
///////////////////////////////////////////////////////////////////////////////////////////
function ordinary_count_row ($table_name, $column_name)
        {
           connect_to_my_db();
           $count= 0;
           $test= 0;
           $query= "SELECT * from $table_name";

           $result= mysql_query($query) or die (mysql_error());
           while($row= mysql_fetch_array($result))
               {
                $count++;
                 if($row["$column_name"] > $test)
                    {
                     $test= $row["$column_name"];
                     }


               }

         return $test;
        }
/////////////////////////////////////////////////////////////////////////
function convert_kladr_to_adres($code_street, $nomer_doma, $nomer_korpusa, $nomer_kvartiri)
         {
         connect_to_my_db();
         if($code_street== "" OR $code_street== "0" )
            {
              echo "<font color=\"#FF0000\"> ����� �� ���������</font>\n";
              return ;
            }
         $code_kladr= $code_street[0].$code_street[1].$code_street[2].$code_street[3].$code_street[4].$code_street[5].$code_street[6].$code_street[7].$code_street[8].$code_street[9].$code_street[10].$code_street[11].$code_street[12];

              //    echo $code_street;
              //    echo " ";
              //    echo $code_kladr;
              //    echo " ";

         $query= "SELECT * from kladr WHERE code= '$code_kladr'";
         $result= mysql_query($query) or die (mysql_error());
            while($row= mysql_fetch_array($result))
                {

                  echo $row["socr"];
                  echo " ";
                  echo $row["name"];
                }
            echo " ";
         ////////////////////////////////////////////////////////////////////////
         
         
         $query= "SELECT * from street WHERE code= '$code_street'";
         $result= mysql_query($query) or die (mysql_error());
            while($row= mysql_fetch_array($result))
                {

                  echo $row["socr"];
                  echo " ";
                  echo $row["name"];
                }
            if($nomer_doma!="" AND $nomer_doma!="0") echo " ��� ",$nomer_doma;
            if($nomer_korpusa!="" AND $nomer_korpusa!="0") echo " ������ ",$nomer_korpusa;
            if($nomer_kvartiri!="" AND $nomer_kvartiri!="0") echo " ��. ", $nomer_kvartiri;


         }
////////////////////////////////////////////////////////////////////////////
function del_from_table($table_name, $session_id)
         {
           $query= "DELETE FROM  $table_name
                           WHERE session_id= '$session_id'";
          connect_to_my_db();
          $result= mysql_query($query) or die (mysql_error());

         }
/////////////////////////////////////////////////////////////////////////////////
function select_social_kat($name,$default_value, $add_value)
            {


            $query="SELECT * FROM soc_kat ORDER BY 'count'";
              echo "<select size=\"1\" name=\"$name\" $add_value>\n";
            connect_to_my_db();
            $result= mysql_query($query) or die (mysql_error());
            while($row= mysql_fetch_array($result))
                {
                  //
                if($row["count"]!= $default_value){echo "<option value=\"".$row["count"]."\">".$row["soc_kat"]."</option>\n";}
                else {echo "<option value=\"".$row["count"]."\" selected>".$row["soc_kat"]."</option>\n";}
                }
              echo "</select>\n";
            }
/////////////////////////////////////////////////////////////////////////////////
function is_date($date)
	{
	  //
	  if(strlen($date)!=10) {return false;}
	  	else
	  		{
			    //
			    $year= get_year($date);
			    $month= get_month($date);
			    $day= get_day($date);
			    if(!checkdate($month, $day, $year)) { return false;}
			    else { return true;}
			}
	}
////////////////////////////////////////////////////////////////////////////////
function date_to_str($date)
	{
	  if(is_date($date)) 
	   
	  	{
		    $year= get_year($date);
		    $month= get_month($date);
		    $day= get_day($date);
		    
		    
					  $month_list["01"]="���";
					  $month_list["02"]="���";
					  $month_list["03"]="���";
					  $month_list["04"]="���";
					  $month_list["05"]="���";
					  $month_list["06"]="����";
					  $month_list["07"]="����";
					  $month_list["08"]="���";
					  $month_list["09"]="���";
					  $month_list["10"]="���";
					  $month_list["11"]="����";
					  $month_list["12"]="���";
					  
					  $strok= $day.".".$month_list[$month].".".$year;
					  return $strok;
					  
					  
				
		}
	  	
	}
?>
