#!/usr/bin/php
<?php
// CodeIgniter language check&clean v1.0

define('BASEPATH', TRUE);
define('LANG_DIR', './system/language');
define('LANG_DEFAULT', 'english');
define('LANG_CANSAVE', 'polish');
define('EXT_OLD', '.bak');
define('COL_ERR', "\033[31m");
define('COL_INF', "\033[36m");
define('COL_DEF', "\033[0m");
define('EOL', "\n");
define('SLASH', '/');

define('TPL_HEADER', "<?php
/**
 * CodeIgniter Polish language pack
 *
 * @package		CodeIgniter
 * @author		patwork@gmail.com (originally sin@sinsoft.pl)
 * @license		http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link		https://github.com/patwork/CodeIgniter-PL
 * @since		Version 1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');".EOL.EOL);
define('TPL_FOOTER', EOL."/* End of file %s */".EOL."/* Location: %s */".EOL);
define('TPL_LINE', "\$lang['%s'] %s= '%s';".EOL);

// ==========================================================================
function cleanstring($str)
{
	return trim(preg_replace('/\s\s+/', ' ', str_replace("'", "\\'", $str)));
}

// ==========================================================================
function loadlang($filename)
{
	$lang = array();
	include $filename;
	if (empty($lang)) {
		echo COL_ERR.'! '.$filename.' is empty or damaged'.COL_DEF.EOL;
	}
	return $lang;
}

// ==========================================================================
function savelang($default, $check, $filename)
{
	$maxkeylen = 0;
	foreach($default as $key => $val) {
		if (strlen($key) > $maxkeylen) {
			$maxkeylen = strlen($key);
		}
	}

	$tmpname = tempnam('.', '.clean');
	$tmp = fopen($tmpname, 'w');
	fwrite($tmp, TPL_HEADER);
	foreach($default as $key => $val) {
		fwrite($tmp, sprintf(TPL_LINE, $key, str_repeat(' ', $maxkeylen - strlen($key)), cleanstring($check[$key])));
	}
	fwrite($tmp, sprintf(TPL_FOOTER, basename($filename), $filename));
	fclose($tmp);

	$oldname = $filename.EXT_OLD;
	if (file_exists($oldname)) {
		unlink($oldname);
	}
	rename($filename, $oldname);
	rename($tmpname, $filename);
	chmod($filename, fileperms($oldname));
}

// ==========================================================================
function comparelang($default, $check)
{
	$status = TRUE;
	foreach($default as $key => $val) {
		if (!isset($check[$key])) {
			echo COL_ERR.'! missing translation of "'.$key.'" :: '.$val.COL_DEF.EOL;
			$status = FALSE;
		} else {
			unset($check[$key]);
		}
	}
	if (!empty($check)) {
		foreach($check as $key => $val) {
			echo COL_ERR.'! obsolete translation of "'.$key.'" :: '.$val.COL_DEF.EOL;
		}
		$status = FALSE;
	}
	return $status;
}

// ==========================================================================
function checkfile($dir, $filename)
{
	echo '* '.$filename.EOL;

	if (!file_exists(LANG_DIR.SLASH.LANG_DEFAULT.SLASH.$filename)) {
		echo COL_ERR.'! missing '.LANG_DEFAULT.' language file '.$filename.COL_DEF.EOL;
		return;
	}

	$lang_default = loadlang(LANG_DIR.SLASH.LANG_DEFAULT.SLASH.$filename);
	$lang_check = loadlang(LANG_DIR.SLASH.$dir.SLASH.$filename);
	if (empty($lang_default) || empty($lang_check)) {
		return;
	}

	if (comparelang($lang_default, $lang_check) && $dir === LANG_CANSAVE) {
		savelang($lang_default, $lang_check, LANG_DIR.SLASH.$dir.SLASH.$filename);
	}
}

// ==========================================================================
function checklang($dir, $defaults)
{
	echo COL_INF.'* checking '.$dir.' language...'.COL_DEF.EOL;

	$dh = opendir(LANG_DIR.SLASH.$dir);
	while(($filename = readdir($dh)) !== FALSE) {
		if (strtolower(substr($filename, -4)) === '.php') {
			unset($defaults[$filename]);
			checkfile($dir, $filename);
		}
	}
	closedir($dh);

	if (!empty($defaults)) {
		foreach($defaults as $key => $val) {
			echo COL_ERR.'! missing translation of file '.$key.COL_DEF.EOL;
		}
	}
}

// ==========================================================================
function runme()
{
	if (!is_dir(LANG_DIR)) {
		echo COL_ERR.'! directory '.LANG_DIR.' not found!'.COL_DEF.EOL;
		return 1;
	}

	if (!is_dir(LANG_DIR.SLASH.LANG_DEFAULT)) {
		echo COL_ERR.'! '.LANG_DEFAULT.' language directory not found!'.COL_DEF.EOL;
		return 2;
	}

	$defaults = array();
	$dh = opendir(LANG_DIR.SLASH.LANG_DEFAULT);
	while(($filename = readdir($dh)) !== FALSE) {
		if (strtolower(substr($filename, -4)) === '.php') {
			$defaults[$filename] = TRUE;
		}
	}
	closedir($dh);

	if (empty($defaults)) {
		echo COL_ERR.'! '.LANG_DEFAULT.' language directory is empty!'.COL_DEF.EOL;
		return 3;
	}

	$dh = opendir(LANG_DIR);
	while(($dirname = readdir($dh)) !== FALSE) {
		if (is_dir(LANG_DIR.SLASH.$dirname) && $dirname[0] != '.' && $dirname != LANG_DEFAULT) {
			checklang($dirname, $defaults);
		}
	}
	closedir($dh);

	return 0;
}

// ==========================================================================
exit(runme());

// EoF
