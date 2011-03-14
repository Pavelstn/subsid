<?php
//db_exec_query
include_once("database_work.php");

class db_login extends database_work
{
  //
  var $query="";
  var $user_data;
  var $login_name;
  var $login_passwrod;
  

  function get_login($login_name, $login_passwrod )
  	{
	    $this->login_name= $login_name;
	    $this->login_passwrod= $login_passwrod;
	}

  
  function run()
  	{
	    //
	    $this->query= "SELECT  * FROM users WHERE user_name='$this->login_name' AND password= '$this->login_passwrod' ";
	    $this->connect_db();
	    $this->user_data["id_group"]="0";
	    $this->user_data["user_name"]= "0";
		$result= mysql_query($this->query) or die (mysql_error());
	      while($row= mysql_fetch_array($result))
      		{
         		$this->user_data["id_group"]= $row["id_group"];
         		$this->user_data["user_name"]= $row["user_name"];
      		}
	}
	function get_id_group()
		{
		  return $this->user_data["id_group"];
		}
	function get_user_name()
		{
		  return $this->user_data["user_name"];
		}
		
	function db_login($login_name, $login_passwrod)
		{
		  $this->get_login($login_name, $login_passwrod );
		  $this->run();
		}		
}

?>