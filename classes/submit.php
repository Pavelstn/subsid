<?php
///submit
include_once("input.php");

class submit extends input
{
  //
  //set_name($new_name)
  //get_name()
  //set_value($new_value)
  //get_value()
  //set_init_method($new_init_method)
  //get_init_method()
  //popPostVar($varName)//обработка событий//
  
  var $disabled= false;
  var $alert= false;
  var $alert_text= "alert_text";
  var $onclick= false;
  
  function set_disabled($new_disabled)
  	{
	    $this->disabled= $new_disabled;
	}
  function set_alert($new_alert)
  	{
	    $this->alert= $new_alert;
	}
 function set_alert_text($new_alert_text)
 	{
	   $this->alert_text= $new_alert_text;
	}
	
 function get_onclick()
 	{
	   return $this->onclick;
	}	
	
   function to_html()
   	{
		echo "<input type=\"submit\" ";
		echo "value=\"".$this->get_value()."\" "; 
		if($this->alert) echo "onclick=\"return confirm('".$this->alert_text."')\" "; 
		echo "name=\"".$this->get_name()."\"";
		if($this->disabled) echo "disabled ";
		echo " >\n";
	}
	
  function cath_event()
  	{
	    $event= $this->popPostVar($this->get_name());
	    if($event)
			{
				$this->onclick= true;
			}
	}


	function submit($name, $value)
		{
		  $this->set_name($name);
		  $this->set_value($value);
		  $this->cath_event();
		}
		
		

	function help()
	{
	  ?>
		<style type="text/css">
		<!--
		body { color: #000000; background-color: #A2A79E; }
		.php1-comment { color: #FF8000; }
		.php1-identifier { color: #0000BB; }
		.php1-number { }
		.php1-reservedword { color: #007700; }
		.php1-space { }
		.php1-string { color: #DD0000; }
		.php1-symbol { color: #000000; }
		.php1-variable { color: #0000BB; }
		-->
		</style>
		</head>
		<body>
		<!--StartFragment--><pre><code><span class="php1-variable">$aa</span><span class="php1-symbol">= </span><span class="php1-reservedword">new</span><span class="php1-space"> </span><span class="php1-identifier">submit</span><span class="php1-symbol">;

		</span><span class="php1-variable">$aa</span><span class="php1-symbol">-&gt;</span><span class="php1-identifier">set_name</span><span class="php1-symbol">(</span><span class="php1-string">&quot;qaz&quot;</span><span class="php1-symbol">);
		</span><span class="php1-variable">$aa</span><span class="php1-symbol">-&gt;</span><span class="php1-identifier">set_value</span><span class="php1-symbol">(</span><span class="php1-string">&quot;test&quot;</span><span class="php1-symbol">);
		</span><span class="php1-variable">$aa</span><span class="php1-symbol">-&gt;</span><span class="php1-identifier">set_alert</span><span class="php1-symbol">(</span><span class="php1-reservedword">true</span><span class="php1-symbol">);

		</span><span class="php1-variable">$aa</span><span class="php1-symbol">-&gt;</span><span class="php1-identifier">set_alert_text</span><span class="php1-symbol">(</span><span class="php1-string">'Вы действительно хотите удалить эту запись?'</span><span class="php1-symbol">);
		</span><span class="php1-variable">$aa</span><span class="php1-symbol">-&gt;</span><span class="php1-identifier">to_html</span><span class="php1-symbol">();
		</span><span class="php1-variable">$aa</span><span class="php1-symbol">-&gt;</span><span class="php1-identifier">help</span><span class="php1-symbol">();

		</span></code></pre><!--EndFragment--></body>
      <?
	}
}

?>