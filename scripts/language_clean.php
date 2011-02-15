#!/usr/bin/php
<?php
// CodeIgniter language clean v1.0
// wto, 15 lut 2011

define('DEF_LANGUAGE', 'polish');
define('DIR_LANGUAGE', '../system/language/'.DEF_LANGUAGE);
runme();

function showspaces($count)
{
	$str = '';
	if ($count) {
		for($i = 0; $i < $count; $i++) {
			$str .= ' ';
		}
	}
	return $str;
}

function cleanstring($str)
{
	return trim(preg_replace('/\s\s+/', '', $str));
}

function loadlang($filename)
{
	$lang = array();
	include $filename;
	if (empty($lang)) {
		echo "\033[36m! brak wpisów w pliku $filename\033[0m\n";
	}
	return $lang;
}

function cleanfile($filename)
{
	$arr = loadlang($filename);
	if (empty($arr)) {
		return;
	}
	ksort($arr);

	echo "* $filename\n";

	$maxlen = 0;
	foreach($arr as $key => $val) {
		if (strlen($key) > $maxlen) {
			$maxlen	= strlen($key);
		}
	}

	$tmpname = tempnam('.', '.clean');
	$tmp = fopen($tmpname, 'w');
	fwrite($tmp, "<?php\n\n");

	foreach($arr as $key => $val) {
		fwrite($tmp, sprintf("\$lang['%s'] %s= \"%s\";\n", $key, showspaces($maxlen - strlen($key)), addslashes(cleanstring($val))));
	}

	fwrite($tmp, "\n/* End of file $filename */\n");
	fwrite($tmp, "/* Location: ./system/language/".DEF_LANGUAGE."/$filename */\n");
	fclose($tmp);

	$oldname = $filename.'.old';
	if (file_exists($oldname)) {
		unlink($oldname);
	}
	rename($filename, $oldname);
	rename($tmpname, $filename);
	chmod($filename, fileperms($oldname));
}

function runme()
{
	if (!is_dir(DIR_LANGUAGE)) {
		echo "brak katalogu ".DIR_LANGUAGE."\n";
		die;
	}
	chdir(DIR_LANGUAGE);

	$dh = opendir('.');
	while(($filename = readdir($dh)) !== FALSE) {
		if (substr($filename, -4) == '.php') {
			cleanfile($filename);
		}
	}
	closedir($dh);
}

?>
