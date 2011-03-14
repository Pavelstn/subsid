<?php


function create_table($data)
	{
	  echo "<table border= 1>\n";
	  reset($data);
	  $value= current($data);
	  while($value)
	  	{
		    echo "<tr><td>$value</td></tr>\n";
		    $value= next($data);
		}
	  echo "</table>";
	}

$test= array("11111","2222", "3333");

create_table($test);
echo "<hr>\n";
echo "<center>пример 2</center>\n";


class table1
{
  var $data;
  
  function to_html()
  	{
	{
	  echo "<table border= 1>\n";
	  reset($this->data);
	  $value= current($this->data);
	  while($value)
	  	{
		    echo "<tr><td>$value</td></tr>\n";
		    $value= next($this->data);
		}
	  echo "</table>";
	}
	}
}

class table2
{
  var $data= array("11111","2222", "3333");
  
  function to_html()
  	{
	    //
	    echo "<table border= 1>\n";
	  //  reset($data);
	   // $value= current($data);
	  //  while($value)
	  	while($value= each($this->data))
	    	{
			  echo "<tr><td>";
			 // $value->to_html();
			 echo $value->to_html();
			  echo "</td></tr>\n";
			  //$value= next($data);
			}
		echo "</table>";
	}
}

$t1= new table1;
$t2= new table1;
$t3= new table1;

$t4= new table2;

$t1->data= array("11111","2222", "3333");
$t2->data= array("44444","5555", "6666");
$t3->data= array("7777","8888", "9999");

$t4->data= array($t1,$t2, $t3);
//$t4->to_html();

echo "<hr>\n";




?>