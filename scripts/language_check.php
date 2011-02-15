#!/usr/bin/php
<?php
// CodeIgniter language check v1.0
// wto, 15 lut 2011

define('DIR_LANGUAGE', '../system/language');
define('DEF_LANGUAGE', 'english');
runme();

function loadlang($filename)
{
	$lang = array();
	include $filename;
	if (empty($lang)) {
		echo "\033[36m! brak wpisów w pliku $filename\033[0m\n";
	}
	return $lang;
}

function checkfile($dirname, $filename)
{
	if (!file_exists(DEF_LANGUAGE.'/'.$filename)) {
		echo "\033[36m! brak pliku $filename do porównania w katalogu z domyślnym językiem\033[0m\n";
		return;
	}

	echo "* plik $dirname/$filename\n";

	$lang_def = loadlang(DEF_LANGUAGE.'/'.$filename);
	$lang_chk = loadlang($dirname.'/'.$filename);

	foreach($lang_def as $key => $val) {
		if (empty($lang_chk[$key])) {
			echo "\033[31m@ brak tłumaczenia wpisu $key w $dirname/$filename\033[0m\n";
		}
		unset($lang_chk[$key]);
	}

	if (!empty($lang_chk)) {
		foreach($lang_chk as $key => $val) {
			echo "\033[35m@ niewykorzystany wpis $key w $dirname/$filename\033[0m\n";
		}
	}
}

function checkdir($dirname, $defaults)
{
	echo "* katalog $dirname\n";

	$dh = opendir($dirname);
	while(($filename = readdir($dh)) !== FALSE) {
		if (substr($filename, -4) == '.php') {
			checkfile($dirname, $filename);
		}
		unset($defaults[$filename]);
	}
	closedir($dh);

	if (!empty($defaults)) {
		foreach($defaults as $key => $val) {
			echo "\033[36m! brakuje pliku $key w $dirname\033[0m\n";
		}
	}
}

function runme()
{
	if (!is_dir(DIR_LANGUAGE)) {
		echo "brak katalogu ".DIR_LANGUAGE."\n";
		die;
	}
	chdir(DIR_LANGUAGE);

	if (!is_dir(DEF_LANGUAGE)) {
		echo "brak katalogu ".DEF_LANGUAGE." z domyślnym językiem\n";
		die;
	}

	$dh = opendir(DEF_LANGUAGE);
	$defaults = array();
	while(($filename = readdir($dh)) !== FALSE) {
		$defaults[$filename] = TRUE;
	}
	closedir($dh);

	$dh = opendir('.');
	while(($dirname = readdir($dh)) !== FALSE) {
		if (is_dir($dirname) && $dirname[0] != '.' && $dirname != DEF_LANGUAGE) {
			checkdir($dirname, $defaults);
		}
	}
	closedir($dh);
}

?>
