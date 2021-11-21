<?php
include ("settings/bd.php");

function clear($var) {
		$var = mb_strtolower($var, "UTF-8");
		$var = trim($var);
        $var = strip_tags($var);
        $var = htmlentities($var, ENT_IGNORE, "UTF-8");
        $var = stripcslashes($var);
        $var = str_replace('ӏ','Ӏ',$var);
        $var = str_replace('І','Ӏ',$var);
        $var = str_replace('I','Ӏ',$var);
        $var = str_replace('i','Ӏ',$var);
        $var = str_replace('1','Ӏ',$var);
        return $var;
        // return mysqli_real_escape_string($db, $var);
}

if (isset($_POST['dict'])) {
	$dicts = array();
	$result_dict = mysqli_query($db,"SELECT * FROM dict_names");
	while ($row_dict = mysqli_fetch_assoc($result_dict)) {
		$dicts[] = $row_dict;
	}
	echo json_encode($dicts);
}

if (isset($_POST['word'])) {
	$word = clear($_POST['word']);
	$lang = clear($_POST['lang']);
	$mass = array();
	$word_len = mb_strlen($word,"utf-8");
	$word_start = mb_substr($word,0,1,"utf-8");
	$word_end = mb_substr($word,$word_len-1,1,"utf-8");
	if ($word_start == "и") $word_i = "ы" . mb_substr($word, 1, $word_len-1,"utf-8");
	if ($word_end == "а") $word_a = mb_substr($word, 0, $word_len-1,"utf-8");
	if ($word_end == "н") $word_n = mb_substr($word, 0, $word_len-1,"utf-8");
	if ($lang == "ce") {$dict_name_col = 'name_ce';}
	elseif ($lang == "ru") {$dict_name_col = 'name_ru';}
	$cf = '[0-9,;.: \*-]';
	$result_dict = mysqli_query($db,"SELECT * FROM dict_names");
	while ($row_dict = mysqli_fetch_assoc($result_dict)) {
			$pf = '^$';
			$sf = '^$';
			$table = $row_dict["dict_table_name"];
			$dict_name = $row_dict[$dict_name_col];
			$col = "word";

			if ($table == 'maciev_ce_ru' || $table == 'karasaev_maciev_ru_ce' || $table == 'ru_ce_ce_ru_computer') $col = 'word1'; 
            
            if ($table == 'ismailov_ce_ru' && $word == 'а') $query = "SELECT * FROM $table WHERE $col REGEXP '^$word$cf$' ORDER BY word";
			else $query = "SELECT * FROM $table WHERE $col LIKE '$word' ORDER BY word";
			$result = mysqli_query($db,$query);
			while ($row = mysqli_fetch_assoc($result)) {
					$mass[$table][] = $row;
				}

			if ($word_len > 2) {
				if (($table == "maciev_ce_ru" || $table == "ce_ru_anatomy" || $table == "baisultanov_ce_ru" || $table == "ismailov_ce_ru") && mysqli_num_rows($result) > 0) {
					$pf = '(тӀе|тӀера|сехьа|дехьа|дӀа|схьа|чу|чуьра|кӀел|кӀелхьара|ара|чекх|дӀаса|дӀасхьа|хьала|охьа|юха|юкъа|ирх|буха|улле|сов|тӀех|хьалха|тӀаьхьа|тӀекӀел|тӀеттӀа|чучча|вовшах)';
					$sf = '(дала|дан|далийта|р|иг|ниг|хо|рхо|м|гӀа|лла|ан|аран|е|о)';
				}
				elseif (($table == "karasaev_maciev_ru_ce" || $table == "ru_ce_anatomy" || $table == "ismailov_ru_ce" || $table == "aslahanov_ru_ce") && mysqli_num_rows($result) > 0) {
					$pf = '(а|ан|анти|без|безъ|безо|бес|благо|в|въ|верхне|вз|вза|взаимо|взо|вне|внутри|во|воз|возо|вос|вс|все|вы|гипер|де|диз|дис|до|ев|еже|за|ко|к|кое|кой|контр|ку|любо|меж|межъ|междо|между|мимо|на|над|надъ|надо|наи|наружно|не|небез|небезъ|небезо|небес|недо|ни|низ|низо|нис|о|об|объ|обез|обезъ|обезо|обес|оби|обо|обще|около|от|отъ|ото|па|пере|по|под|пода|подо|поза|после|пра|пре|пред|предъ|преди|предо|при|про|против|противо|раз|разъ|разо|рас|роз|розъ|рос|с|съ|сверх|сверхъ|со|среди|су|супер|сыз|тре|у|через|черес|чрез|эв|экзо|эндо|внутри|эпи|эу)';
					$sf = '(аж|анец|анин|ант|ация|ач|е|ев|ева|евич|евна|ек|ёк|емость|енка|ёнок|ент|енька|ец|ецо|ечк|и|иеье|изм|ик|ина|инична|ист|итель|ица|ице|ич|ична|ишка|ишко|ища|ище|к|ка|л|ло|лка|льня|льник|льщик|льщица|мость|н|ник|ник|ница|ность|ов|ова|овец|ович|овна|ок|онка|онок|оньк|онька|ость|очка|ск|ство|ество|сь|ся|тель|тель|ти|тор|тор|ть|ура|ушк|ушка|ушко|фикация|це|цо|чанин|чик|чица|чь|ша|щик|щица|ыш|ышка|ышко|юшко|юшка|янец|янин|янт|яция)';
				}
				elseif (($table == "umarhadjiev_ahmatukaev_ce_ru_ru_ce" || $table == "abdurashidov_ce_ru_ru_ce" || $table == 'ru_ce_ce_ru_computer') && mysqli_num_rows($result) > 0) {
					$pf = '(тӀе|тӀера|сехьа|дехьа|дӀа|схьа|чу|чуьра|кӀел|кӀелхьара|ара|чекх|дӀаса|дӀасхьа|хьала|охьа|юха|юкъа|ирх|буха|улле|сов|тӀех|хьалха|тӀаьхьа|тӀекӀел|тӀеттӀа|чучча|вовшах|а|ан|анти|без|безъ|безо|бес|благо|в|въ|верхне|вз|вза|взаимо|взо|вне|внутри|во|воз|возо|вос|вс|все|вы|гипер|де|диз|дис|до|ев|еже|за|ко|к|кое|кой|контр|ку|любо|меж|межъ|междо|между|мимо|на|над|надъ|надо|наи|наружно|не|небез|небезъ|небезо|небес|недо|ни|низ|низо|нис|о|об|объ|обез|обезъ|обезо|обес|оби|обо|обще|около|от|отъ|ото|па|пере|по|под|пода|подо|поза|после|пра|пре|пред|предъ|преди|предо|при|про|против|противо|раз|разъ|разо|рас|роз|розъ|рос|с|съ|сверх|сверхъ|со|среди|су|супер|сыз|тре|у|через|черес|чрез|эв|экзо|эндо|внутри|эпи|эу)';
					$sf = '(дала|дан|далийта|р|иг|ниг|хо|рхо|м|гӀа|лла|ан|аран|е|о|аж|анец|анин|ант|ация|ач|е|ев|ева|евич|евна|ек|ёк|емость|енка|ёнок|ент|енька|ец|ецо|ечк|и|иеье|изм|ик|ина|инична|ист|итель|ица|ице|ич|ична|ишка|ишко|ища|ище|к|ка|л|ло|лка|льня|льник|льщик|льщица|мость|н|ник|ник|ница|ность|ов|ова|овец|ович|овна|ок|онка|онок|оньк|онька|ость|очка|ск|ство|ество|сь|ся|тель|тель|ти|тор|тор|ть|ура|ушк|ушка|ушко|фикация|це|цо|чанин|чик|чица|чь|ша|щик|щица|ыш|ышка|ышко|юшко|юшка|янец|янин|янт|яция)';
				}

				$regexp = array("^$word$cf","$cf$word$","$cf$word$cf","^$pf$word$","^$pf$word$cf","^$word$sf$","^$word$sf$cf","^$pf$word$sf$","^$pf$word$sf$cf");
				if ($table == "maciev_ce_ru" & isset($word_a)) {
					$sf_a = '(ийта|ин|о)';
					$regexp[] = "^$word_a$sf_a$";
					$regexp[] = "^$word_a$sf_a$cf";
					$regexp[] = "^$pf$word_a$sf_a$";
					$regexp[] = "^$pf$word_a$sf_a$cf";
				}
				if ($table == "maciev_ce_ru" & isset($word_n)) {
					$sf_n = '(йта|р|лла)';
					$regexp[] = "^$word_n$sf_n$";
					$regexp[] = "^$word_n$sf_n$cf";
					$regexp[] = "^$pf$word_n$sf_n$";
					$regexp[] = "^$pf$word_n$sf_n$cf";
				}
				if ($table == "karasaev_maciev_ru_ce" & isset($word_i)) {
					$pf_i = '(без|воз|из|под|пред|раз|с)';
					$regexp[] = "^$pf_i$word_i$";
					$regexp[] = "^$pf_i$word_i$$cf";
					$regexp[] = "^$pf_i$word_i$sf$";
					$regexp[] = "^$pf_i$word_i$sf$cf";
				}
				foreach ($regexp as $regexp_word) {
					$query = "SELECT * FROM $table WHERE LOWER($col) REGEXP '$regexp_word' ORDER BY word";
					$result = mysqli_query($db,$query);
					while ($row = mysqli_fetch_assoc($result)) {
						$mass[$table][] = $row;
					}
				}
			}

	}

	if (count($mass) > 0) {
		// sort($mass);
		$mass = json_encode($mass);
		echo $mass;
	} 
	else echo 0;
	
}

?>