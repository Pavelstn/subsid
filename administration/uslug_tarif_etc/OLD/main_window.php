<?php

function show_main_window()
{
	


	
	echo "<input type=\"submit\" value=\"����\" name=\"click[edit_org]\">\n";
	echo "�������������� �����������\n";
	
	echo "<hr width= \"30%\" align=\"left\">\n";

	echo "<form method=\"POST\" action=\"edit_group_uslug.php\" >  \n";
	echo "<input type=\"submit\" value=\"����\" name=\"click[edit_group_uslug]\">\n";
	echo "�������������� ����� �����\n";
	echo "	</form>\n";
	echo "<hr width= \"30%\" align=\"left\">\n";
	
	echo "<form method=\"POST\" action=\"edit_uslug.php\" >\n";
	echo "<input type=\"submit\" value=\"����\" name=\"click[edit_uslug]\">\n";
	echo "�������������� �����\n";
	echo "</form>\n";
	echo "<hr width= \"30%\" align=\"left\">\n";

	echo "<form method=\"POST\" action=\"sezon.php\" >\n";
	echo "<input type=\"submit\" value=\"����\" name=\"click[edit_sezon]\">\n";
	echo "�������������� �������\n";
	echo "</form>";
	echo "<hr width= \"30%\" align=\"left\">\n";
	
	echo "<form method=\"POST\" action=\"tarif_net.php\" >  \n";
	echo "<input type=\"submit\" value=\"����\" name=\"click[edit_tarif_net]\">\n";
	
	echo "�������������� �������� �����\n";
	echo "</form>\n";
	
	echo "<hr width= \"30%\" align=\"left\">\n";
	echo "<form method=\"POST\" action=\"self_test.php\" >  \n";
	echo "<input type=\"submit\" value=\"����\" name=\"click[edit_sezon]\">\n";
	echo "����������������\n";
	echo "</form>\n";
}






?>