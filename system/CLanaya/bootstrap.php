<?php
/**
 * Bootstrapping, setting up and loading the core.
 *
 * @package LanayaSystem
 */

/**
 * Enable auto-load of class declarations.
 */
function autoload($aClassName) {
  	$classFile = "/{$aClassName}/{$aClassName}.php";
   	$file1 = LANAYA_INSTALL_PATH . "/system/" . $classFile;
   	$file2 = LANAYA_SITE_PATH . "/helpers/" . $classFile;
   	$file3 = LANAYA_SITE_PATH . "/controllers/" . $classFile;
   	$file4 = LANAYA_SITE_PATH . "/models/" . $classFile;
   	if(is_file($file1)) {
      	require_once($file1);
   	} elseif(is_file($file2)) {
      	require_once($file2);
   	} elseif(is_file($file3)) {
      	require_once($file3);
   	} elseif(is_file($file4)) {
      	require_once($file4);
   	} 
}
spl_autoload_register('autoload');

/**
 * Set a default exception handler and enable logging in it.
 */
function exception_handler($e) {
	echo "Lanaya: Uncaught exception: <p>" . $e->getMessage() . "</p><pre>" . $e->getTraceAsString(), "</pre>";
}
set_exception_handler('exception_handler');

/**
 * Helper, include a file and store it in a string. Make $vars available to the included file.
 */
function getIncludeContents($filename, $vars=array()) {
	if (is_file($filename)) {
		ob_start();
		extract($vars);
		include $filename;
		return ob_get_clean();
	}
	return false;
}

/**
 * Helper, wrap html_entites with correct character encoding
 */
function htmlent($str, $flags = ENT_COMPAT) {
	return htmlentities($str, $flags, CLanaya::Instance()->config['character_encoding']);
}

/**
 * Helper, make clickable links from URLs in text.
 */
function makeClickable($text) {
	return preg_replace_callback(
			'#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
			create_function(
					'$matches',
					'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
			),
			$text
	);
}

/**
 * Helper, BBCode formatting converting to HTML.
 *
 * @param string text The text to be converted.
 * @returns string the formatted text.
 */
function bbcode2html($text) {
	$search = array(
			'/\[b\](.*?)\[\/b\]/is',
			'/\[i\](.*?)\[\/i\]/is',
			'/\[u\](.*?)\[\/u\]/is',
			'/\[img\](https?.*?)\[\/img\]/is',
			'/\[url\](https?.*?)\[\/url\]/is',
			'/\[url=(https?.*?)\](.*?)\[\/url\]/is'
	);
	$replace = array(
			'<strong>$1</strong>',
			'<em>$1</em>',
			'<u>$1</u>',
			'<img src="$1" />',
			'<a href="$1">$1</a>',
			'<a href="$1">$2</a>'
	);
	return preg_replace($search, $replace, $text);
}
