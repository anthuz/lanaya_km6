<?php
/**
* Site configuration, this file is changed by user per site.
*
*/

/*
* Set level of error reporting
*/
error_reporting(-1);
ini_set('display_errors', 1);

/*
* Define session name
*/
$lanaya->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);

/*
* Define server timezone
*/
$lanaya->config['timezone'] = 'Europe/Stockholm';

/*
* Define internal character encoding
*/
$lanaya->config['character_encoding'] = 'UTF-8';

/*
* Define language
*/
$lanaya->config['language'] = 'en';

/**
* Define the controllers, their classname and enable/disable them.
*
* The array-key is matched against the url, for example:
* the url 'developer/dump' would instantiate the controller with the key "developer", that is
* CCDeveloper and call the method "dump" in that class. This process is managed in:
* $lanaya->FrontControllerRoute();
* which is called in the frontcontroller phase from index.php.
*/
$lanaya->config['controllers'] = array(
	'index'     => array('enabled' => true, 'class' => 'CCIndex'),
  	'guestbook' => array('enabled' => true, 'class' => 'CCGuestbook'),
	'user' => array('enabled' => true, 'class' => 'CCUser'),
	'acp' => array('enabled' => true, 'class' => 'CCAdminControlPanel'),
	'content' => array('enabled' => true, 'class' => 'CCContent'),
	'blog' => array('enabled' => true, 'class' => 'CCBlog'),
	'page' => array('enabled' => true, 'class' => 'CCPage'),
	'theme' => array('enabled' => true, 'class' => 'CCTheme'),
);

/**
* Settings for the theme.
*/
$lanaya->config['theme'] = array(
  	'name'        	=> 'grid',        // The name of the theme in the theme directory
  	'stylesheet'  	=> 'style.php',   // Main stylesheet to include in template files
  	'template_file'	=> 'index.tpl.php',   // Default template file, else use default.tpl.php
	'regions' => array(
			'header','content','sidebar','footer',
	),
	'data' => array(
		'header' => 'Lanaya',
		'slogan' => 'A PHP-based MVC-inspired CMF',
		'favicon' => '',
		'logo' => '',
		'logo_width'  => 80,
		'logo_height' => 80,
		'footer' => '<p>Lanaya &copy; by Andreas Thuresson</p>',
	),
);

/**
* Set a base_url to use another than the default calculated
*/
$lanaya->config['base_url'] = null;

/**
* What type of urls should be used?
*
* default      = 0      => index.php/controller/method/arg1/arg2/arg3
* clean        = 1      => controller/method/arg1/arg2/arg3
* querystring  = 2      => index.php?q=controller/method/arg1/arg2/arg3
*/
$lanaya->config['url_type'] = 2;

/**
 * Set database(s).
 */
$lanaya->config['database'][0]['dsn'] = 'sqlite:' . LANAYA_SITE_PATH . '/data/.ht.sqlite';

/**
 * Set what to show as debug or developer information in the get_debug() theme helper.
 */
$lanaya->config['debug']['lanaya'] = false;
$lanaya->config['debug']['db-num-queries'] = true;
$lanaya->config['debug']['db-queries'] = false;

/**
 * Session key
 */
$lanaya->config['session_key']  = 'lanaya';

/**
 * How to hash password of new users, choose from: plain, md5salt, md5, sha1salt, sha1.
 */
$lanaya->config['hashing_algorithm'] = 'sha1salt';

/**
 * Allow or disallow creation of new user accounts.
 */
$lanaya->config['create_new_users'] = true;