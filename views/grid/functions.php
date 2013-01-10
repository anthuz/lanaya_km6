<?php
/**
* Helpers for the template file.
*/
$lanaya->data['footer'] = <<<EOD
<p>Lanaya &copy; by Andreas Thuresson</p>

<p class="links">Tools:
<a href="http://validator.w3.org/check/referer">html5</a>
<a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">css3</a>
<a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css21">css21</a>
<a href="http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance">unicorn</a>
<a href="http://validator.w3.org/checklink?uri={$lanaya->request->current_url}">links</a>
<a href="http://qa-dev.w3.org/i18n-checker/index?async=false&amp;docAddr={$lanaya->request->current_url}">i18n</a>
<!-- <a href="link?">http-header</a> -->
<a href="http://csslint.net/">css-lint</a>
<a href="http://jslint.com/">js-lint</a>
<a href="http://jsperf.com/">js-perf</a>
<a href="http://www.workwithcolor.com/hsl-color-schemer-01.htm">colors</a>
<a href="http://dbwebb.se/style">style</a>
</p>

EOD;


/**
* Print debuginformation from the framework.
*/
function get_debug() {
  	$lanaya = CLanaya::Instance(); 
  	$html = null;
  	if(isset($lanaya->config['debug']['db-num-queries']) && $lanaya->config['debug']['db-num-queries'] && isset($lanaya->db)) {
    	$html .= "<p>Database made " . $lanaya->db->GetNumQueries() . " queries.</p>";
  	}   
  	if(isset($lanaya->config['debug']['db-queries']) && $lanaya->config['debug']['db-queries'] && isset($lanaya->db)) {
    	$html .= "<p>Database made the following queries.</p><pre>" . implode('<br/><br/>', $lanaya->db->GetQueries()) . "</pre>";
  	}   
  	if(isset($lanaya->config['debug']['lanaya']) && $lanaya->config['debug']['lanaya']) {
    	$html .= "<hr><h3>Debuginformation</h3><p>The content of CLanaya:</p><pre>" . htmlent(print_r($lanaya, true)) . "</pre>";
  	}   
  	return $html;
}

/**
* Create a url by prepending the base_url.
*/
function base_url($url) {
  	return CLanaya::Instance()->request->base_url . trim($url, '/');
}

/**
 * Create a url to an internal resource.
 *
 * @param string the whole url or the controller. Leave empty for current controller.
 * @param string the method when specifying controller as first argument, else leave empty.
 * @param string the extra arguments to the method, leave empty if not using method.
 */
function create_url($urlOrController=null, $method=null, $arguments=null) {
	return CLanaya::Instance()->request->CreateUrl($urlOrController, $method, $arguments);
}

/**
 * Prepend the theme_url, which is the url to the current theme directory.
 */
function theme_url($url) {
	$lanaya = CLanaya::Instance();
	return "{$lanaya->request->base_url}themes/{$lanaya->config['theme']['name']}/{$url}";
}


/**
 * Return the current url.
 */
function current_url() {
	return CLanaya::Instance()->request->current_url;
}

/**
* Render all views.
*
* @param $region string the region to draw the content in.
*/
function render_views($region='default') {
  return CLanaya::Instance()->views->Render($region);
}

/**
 * Get messages stored in flash-session.
 */
function get_messages_from_session() {
	$messages = CLanaya::Instance()->session->GetMessages();
	$html = null;
	if(!empty($messages)) {
		foreach($messages as $val) {
			$valid = array('info', 'success', 'error', 'block');
			$class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
			$html .= "<div class='alert alert-$class'>{$val['message']}</div>\n";
		}
	}
	return $html;
}

/**
 * Login menu. Creates a menu which reflects if user is logged in or not.
 */
function login_menu() {
	$lanaya = CLanaya::Instance();
	if($lanaya->user->IsAuthenticated()) {
		$items = '<img src="' . get_gravatar(30) . '" alt="Gravatar"/>';
		$items .= "<a href='" . create_url('user/profile') . "'>" . $lanaya->user->GetAcronym() . "</a> ";
		if($lanaya->user->IsAdministrator()) {
			$items .= "<a href='" . create_url('acp') . "'>acp</a> ";
		}
		$items .= "<a href='" . create_url('user/logout') . "'>logout</a> ";
	} else {
		$items = "<a href='" . create_url('user/login') . "'>login</a> ";
	}
	
	return "<nav>$items</nav>";
}

/**
 * Login menu. Creates a menu which reflects if user is logged in or not.
 */
function login_bootstrap_menu() {	
	$lanaya = CLanaya::Instance();
	if($lanaya->user->IsAuthenticated()) {
		$items = '<li><img class="img-rounded" src="' . get_gravatar(55) . '" alt="Gravatar"/></li>';
		$items .= "<li><a href='" . create_url('user/profile') . "'>" . $lanaya->user->GetAcronym() . "</a></li>";
		$items .= '<span class="icon-bar"></span>';
		if($lanaya->user->IsAdministrator()) {
			$items .= "<li><a href='" . create_url('acp') . "'>acp</a></li>";
		}
		$items .= "<li><a href='" . create_url('user/logout') . "'>logout</a></li>";
	} else {
		$items = "<li><a href='" . create_url('user/login') . "'>login</a></li>";
	}

	return "$items";
}

/**
 * Check if region has views. Accepts variable amount of arguments as regions.
 *
 * @param $region string the region to draw the content in.
 */
function region_has_content($region='default' /*...*/) {
	return CLanaya::Instance()->views->RegionHasView(func_get_args());
}

/**
 * Get a gravatar based on the user's email.
 */
function get_gravatar($size=null) {
	return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim(CLanaya::Instance()->user['email']))) . '.jpg?' . ($size ? "s=$size" : null);
}

/**
 * Escape data to make it safe to write in the browser.
 *
 * @param $str string to escape.
 * @returns string the escaped string.
 */
function esc($str) {
	return htmlEnt($str);
}


/**
 * Filter data according to a filter. Uses CMContent::Filter()
 *
 * @param $data string the data-string to filter.
 * @param $filter string the filter to use.
 * @returns string the filtered string.
 */
function filter_data($data, $filter) {
	return CMContent::Filter($data, $filter);
}