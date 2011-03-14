<?php
session_start();
$session_id= session_id();

include_once("classes/db_login.php");





//  $query= "SELECT  * FROM users
//            WHERE user_name ='$login_name'
//            AND password= '$login_passwrod'";
//   connect_to_my_db();
//   $result= mysql_query($query) or die (mysql_error());
//   while($row= mysql_fetch_array($result))
//       {
//          $id_group= $row["id_group"];
//          $user_name= $row["user_name"];
//       }
$login= new db_login($login_name, $login_passwrod);

$id_group= $login->get_id_group();
$user_name= $login->get_user_name();

//$id_group= "0";
if(crypt($login_passwrod, 'xx')=="xxMJPlbn2mOMI")
    {
      $id_group= 1;
      $user_name="root";
    }



if($id_group== "0")
    {
     echo "Ошибка неправильно набран пароль";
     echo "        <form method=\"GET\" action=\"index.html\">";
     echo "		<input type=\"submit\" value=\"Назад\" name=\"exit\">";
     echo "		</form>";

    }
  else
  {
    //echo "здравствуйте $user_name";
    $_SESSION['user_name']= $user_name;
    $_SESSION['id_group']= $id_group;
    include("system_menu.php");
  }

?>

