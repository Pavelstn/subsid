<?php
//работа с базами данных

class database_work
{
  var $database= "subsid";
  var $user= "";
  var $user_password= "";
  var $db;
  var $debug_mode= false;
  
  function base_log($flag)
  	{
	    //
	    
	    if($flag=="C")
	    	{
	    	  if(!($fp= fopen("./con_log.log", "a+"))) die ("Не могу записать файл<br>\n");
			  fwrite($fp,"1. Соединение\n");
			}
	    if($flag=="D")
	    	{
	    	  if(!($fp= fopen("./dis_log.log", "a+"))) die ("Не могу записать файл<br>\n");
			  fwrite($fp,"2. Отключение\n");
			}
	    fclose($fp);
	}
//////////////////////////////////////////////////////  
function mysql_status($db)
{
if(!mysql_ping($db))
$db=mysql_connect("localhost","","");
$res=mysql_query("show status",$db);

while (list($key,$value)=mysql_fetch_array($res))
$sql[$key]=$value;

 echo  "Connections=>".$sql["Connections"]."<br>\n";
// echo  "Threads=>".$sql["Threads"]."<br>\n";
// echo  "Questions=>".$sql[2]."<br>\n";
// echo  "Slow queries=>".$sql[3]."<br>\n";
// echo  "Opens".$sql[4]."<br>\n";
// echo  "Flush tablesv=>".$sql[5]."<br>\n";
// echo  "Open tables=>".$sql[6]."<br>\n";
// echo  "Queries per second avg=>".$sql[7]."<br>\n";
// //return $sql;

		while (list ($key, $val) = each ($sql) ) :
		echo $key."=>".$val."<br>\n";
		endwhile;
}  
///////////////////////////////////////////////////////////  
  function set_database($database)
  	{
	    $this->database= $database;
	}
  
  function set_user_data($user_name, $user_password)
  	{
	    $this->user= $user_name;
	    $this->user_password= $user_password;
	}
  
  function connect_db()
         {
           
          $this->db= mysql_connect($this->database, $this->user, $this->user_password) or die("erorr connect to database");
          
		 // echo "<hr>\n";
		// $this->mysql_status($this->db);
		 // echo "<hr>\n";
		  
		  if(mysql_ping($this->db))
		  
		  mysql_select_db($this->database, $this->db) or die ("not find base");
          if($this->debug_mode)
          {
		   echo "Connected successfully<br>\n";  
           $this->base_log("C");
		 }

         }
  function dis_connect_db()
  	{
	    mysql_close($this->db);
	    if($this->debug_mode) echo "dis_connect YES!!<br>\n";
	    $this->base_log("D");
	}        
}


?>