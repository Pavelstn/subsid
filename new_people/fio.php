<?php
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();
//echo $session_id;
//echo "<br>\n";

echo "<body bgcolor=\"#6699FF\">\n";

include_once("../classes/submit.php");
include_once("../lib/navigate.php");
include_once("../classes/text.php");
include_once("../classes/db_select.php");
include_once("../classes/calendar.php");


$people_fio= new submit("ppl_fio","Ф.И.О.");
$people_fio->set_disabled(true);
$people_udostover= new submit("ppl_udstvr","Удостоверения");
$people_dohod= new submit("ppl_dhd","Доходы");


$people_write= new submit("wrt_all","Записать");
$people_del= new submit("dl_all","&nbspУдалить");

$people_del->set_alert(true);
$people_del->set_alert_text("Вы действительно хотите удалить эту запись? ВНИМАНИЕ данные невозможно будет восстановить.");
////////////////////////////////////////////////////////////////////////////////

$familia= new text("fml_");
	$familia->set_size("50");
$imya= new text("imya_name_");
	$imya->set_size("50");	
$otchestvo= new text("otchstv_");
	$otchestvo->set_size("50");
	
$sex_= new db_select("slct_sx", "sprav_sex", "id_sex", "name_sex");

$birth_day= new calendar("brth_d");
$prog_min= new db_select("prg_mn", "prog_min", "id_prog_min", "name_soc_kat");

$vid_passport= new db_select("vd_pssprt", "sprav_vid_pasprt", "id_pasprt", "name_psprt");
$passport_serial= new text("pssprt_srl");
	$passport_serial->set_size("10");
$passport_nomer= new text("pssprt_nmr");
	$passport_nomer->set_size("10");
$passport_data_vid= new calendar("pssprt_dt_vd");
$passport_kto_vid= new text("pssprt_kt_vd");
	$passport_kto_vid->set_size("50");
	
$bank_sheet= new text("bnk_sht");
$bank_filial= new db_select("bnk_fll", "sprav_bank_filial", "id_bank", "bank_name");

$subsid_pravo= new db_select("subsid_pravo", "sprav_subsid_pravo", "id_pravo", "name_pravo");
$subsid_osnovanie= new text("sbsd_osnvn");
///////////////////////////////////////////////////////////////////////////////
$all_people= $_SESSION['_all_people_'];
/////////////////////////////////////////
$familia->set_value($all_people['familia']);
	$familia->cath_event();
$imya->set_value($all_people['imya']);
	$imya->cath_event();
$otchestvo->set_value($all_people['otchestvo']);
	$otchestvo->cath_event();

//echo $sex_->get_value();	
//echo "<br>\n";


$sex_->set_value($all_people['sex']);	
$sex_->cath_event();


	
$birth_day->set_full_data($all_people['birth_day']);
	$birth_day->cath_event();
$prog_min->set_value($all_people['prog_min']);
	$prog_min->cath_event();
$vid_passport->set_value($all_people['vid_passport']);
	$vid_passport->cath_event();
$passport_serial->set_value($all_people['passport_serial']);
	$passport_serial->cath_event();
$passport_nomer->set_value($all_people['passport_nomer']);
	$passport_nomer->cath_event();
$passport_data_vid->set_full_data($all_people['passport_data_vid']);
	$passport_data_vid->cath_event();
$passport_kto_vid->set_value($all_people['passport_kto_vid']);
	$passport_kto_vid->cath_event();	
$bank_sheet->set_value($all_people['bank_sheet']);
	$bank_sheet->cath_event();
$bank_filial->set_value($all_people['bank_filial']);
	$bank_filial->cath_event();
$subsid_pravo->set_value($all_people['subsid_pravo']);
	$subsid_pravo->cath_event();
$subsid_osnovanie->set_value($all_people['subsid_osnovanie']);
	$subsid_osnovanie->cath_event();
////////////обновление данных из серии////////////
$all_people['familia']= 			$familia->get_value();
$all_people['imya']= 				$imya->get_value();
$all_people['otchestvo']= 			$otchestvo->get_value();

$all_people['sex']= $sex_->get_value();
//echo $all_people['sex'];

$all_people['birth_day']= 			$birth_day->get_full_data();
$all_people['prog_min']= 			$prog_min->get_value();
$all_people['vid_passport']= 		$vid_passport->get_value();
$all_people['passport_serial']= 	$passport_serial->get_value();
$all_people['passport_nomer']= 		$passport_nomer->get_value();
$all_people['passport_data_vid']= 	$passport_data_vid->get_full_data();
$all_people['passport_kto_vid']= 	$passport_kto_vid->get_value();
$all_people['bank_sheet']= 			$bank_sheet->get_value();
$all_people['bank_filial']= 		$bank_filial->get_value();
$all_people['subsid_pravo']= 		$subsid_pravo->get_value();
$all_people['subsid_osnovanie']= 	$subsid_osnovanie->get_value();
        $_SESSION['_all_people_']= 	$all_people;
	
/////////////////////////////////////////////////////////////////////////
if($people_fio->get_onclick()) 		  link("../new_people/fio.php");
if($people_udostover->get_onclick())  link("../new_people/udostover.php");
if($people_dohod->get_onclick())      link("../new_people/dohod.php");

if($people_write->get_onclick())    link("../new_people/write_all.php");
if($people_del->get_onclick())      link("../new_people/del_all.php");


echo "<form method=\"POST\"  action=\"fio.php\">\n";
echo "	<table border=\"0\" id=\"table1\" bgcolor=\"#C0C0C0\" style=\"border-collapse: collapse\">\n";
//	<table border="0" id="table1" style="border-collapse: collapse">
echo "		<tr>\n";
echo "			<td>\n";
				$people_fio->to_html();
echo "          </td>\n";
echo "			<td>\n";
				$people_udostover->to_html();
echo "          </td>\n";
echo "			<td>\n";
                $people_dohod->to_html();
echo "          </td>\n";
echo "			<td bgcolor=\"#00FF00\">&nbsp;";
				$people_write->to_html();
echo "          &nbsp;</td>\n";
echo "			<td bgcolor=\"#FF0066\">&nbsp;";
				$people_del->to_html();
echo "          &nbsp;</td>\n";
echo "		</tr>\n";
echo "	</table>\n";
/////////////////////////////////////////////////////////
// echo "	<table border=\"0\" style=\"border-collapse: collapse\">\n";
// echo "		<tr>\n";
// echo "			<td>Фамилия</td>\n";
// echo "			<td>\n";
// 				$familia->to_html();
// echo "          </td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>Имя</td>\n";
// echo "			<td>\n";
// 				$imya->to_html();
// echo "          </td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>Отчество</td>\n";
// echo "			<td>\n";
// 				$otchestvo->to_html();
// echo "          </td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>Пол</td>\n";
// echo "			<td>\n";
// 				$sex->to_html();
// echo "          </td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>Дата рождения</td>\n";
// echo "			<td>\n";
// 				$birth_day->to_html();
// echo "          </td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>Прожиточный минимум</td>\n";
// echo "			<td>\n";
// 				$prog_min->to_html();
// echo "          </td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>Документ удостоверяющий<br>\n личность</td>\n";
// echo "			<td>\n";
// 				$vid_passport->to_html();
// echo "          </td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>\n";
// echo "			<table border=\"0\"  style=\"border-collapse: collapse\">\n";
// echo "				<tr>\n";
// echo "					<td>Серия&nbsp;&nbsp;</td>\n";
// echo "					<td>\n";
// 						$passport_serial->to_html();
// echo "                  </td>\n";
// echo "				</tr>\n";
// echo "			</table>\n";
// echo "			</td>\n";
// echo "			<td>\n";
// echo "			<table border=\"0\"  style=\"border-collapse: collapse\">\n";
// echo "				<tr>\n";
// echo "					<td>Номер&nbsp;&nbsp;</td>\n";
// echo "					<td>\n";
// 						$passport_nomer->to_html();
// echo "                  </td>\n";
// echo "				</tr>\n";
// echo "			</table>\n";
// echo "			</td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>Когда выдан</td>\n";
// echo "			<td>\n";
// 				$passport_data_vid->to_html();
// echo "          </td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>Кем выдан</td>\n";
// echo "			<td>\n";
// 				$passport_kto_vid->to_html();
// echo "          </td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>Лицевой счет</td>\n";
// echo "			<td>\n";
// 				$bank_sheet->to_html();
// echo "          </td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>Филиал</td>\n";
// echo "			<td>\n";
// 				$bank_filial->to_html();
// echo "          </td>\n";
// echo "		</tr>\n";
// echo "		<tr>\n";
// echo "			<td>\n";
// echo "			<table border=\"0\" style=\"border-collapse: collapse\">\n";
// echo "				<tr>\n";
// echo "					<td>\n";
// 						$subsid_pravo->to_html();
// echo "                  </td>\n";
// echo "				</tr>\n";
// echo "			</table>\n";
// echo "			</td>\n";
// echo "			<td>\n";
// echo "			<table border=\"0\" style=\"border-collapse: collapse\">\n";
// echo "				<tr>\n";
// echo "					<td>основание:</td>\n";
// echo "					<td>\n";
// 						$subsid_osnovanie->to_html();
// echo "                  </td>\n";
// echo "				</tr>\n";
// echo "			</table>\n";
// echo "			</td>\n";
// echo "		</tr>\n";
// echo "	</table>\n";

////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
	<table border="0" id="table1" style="border-collapse: collapse">
		<tr>
			<td>Фамилия</td>
			<td><? $familia->to_html();   ?></td>
		</tr>
		<tr>
			<td>Имя</td>
			<td><? $imya->to_html(); ?></td>
		</tr>
		<tr>
			<td>Отчество</td>
			<td><? $otchestvo->to_html(); ?></td>
		</tr>

		<tr>
			<td>Пол</td>
			<td><? $sex_->to_html(); ?></td>
		</tr>
		<tr>
			<td>Дата рождения</td>
			<td><? $birth_day->to_html(); ?></td>
		</tr>
		<tr>
			<td>Прожиточный минимум</td>
			<td><? $prog_min->to_html(); ?></td>
		</tr>
	</table>
	
	<table border="0"  style="border-collapse: collapse">
		<tr>
			<td>Документ удостоверяющий личность</td>
			<td><?$vid_passport->to_html(); ?></td>
		</tr>
	</table>
	<table border="0" id="table4" style="border-collapse: collapse">
		<tr>
			<td>Серия&nbsp;</td>
			<td><? $passport_serial->to_html(); ?></td>
			<td>
			<table style="border-collapse: collapse;" border="0" id="table5">
			</table>
			<table style="border-collapse: collapse;" border="0" id="table6">
				<tr>
					<td>Номер</td>
				</tr>
			</table>
			</td>
			<td><? $passport_nomer->to_html(); ?></td>
		</tr>
	</table>
	<table border="0"  style="border-collapse: collapse">
		<tr>
			<td>Когда выдан</td>
			<td><? $passport_data_vid->to_html(); ?></td>
		</tr>
		<tr>
			<td>Кем выдан</td>
			<td><? $passport_kto_vid->to_html(); ?></td>
		</tr>
		<tr>
			<td>Лицевой счет</td>
			<td><? $bank_sheet->to_html(); ?></td>
		</tr>
		<tr>
			<td>Отделение банка</td>
			<td><? $bank_filial->to_html(); ?></td>
		</tr>
	</table>
	<table border="0" id="table8" style="border-collapse: collapse">
		<tr>
			<td><? $subsid_pravo->to_html(); ?></td>
			<td>основание:</td>
			<td><? $subsid_osnovanie->to_html(); ?></td>
		</tr>
	</table>
<?
////////////////////////////////////////////////
echo "</form>";
echo "</body>\n";
?>