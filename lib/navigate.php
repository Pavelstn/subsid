<?php
///функции для навигации по системе//
function link($to_link)
	{
	  //
	  //echo "press_link";
	  echo "\n<script language=JavaScript>\n";
	  echo "location.href=\"$to_link\"\n";
	  echo "</script>\n";
	}
?>