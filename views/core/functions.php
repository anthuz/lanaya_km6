<?php
/**
* Helpers for the template file.
*/
$lanaya->data['footer'] = '<p>&copy; Lanaya by Andreas Thuresson</h1>';


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
 */
function render_views() {
	return CLanaya::Instance()->views->Render();
}

/**
 * Get messages stored in flash-session.
 */
function get_messages_from_session() {
	$messages = CLanaya::Instance()->session->GetMessages();
	$html = null;
	if(!empty($messages)) {
		foreach($messages as $val) {
			$valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
			$class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
			$html .= "<div class='$class'>{$val['message']}</div>\n";
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
		$items .= "  <a href='" . create_url('user/profile') . "'>" . $lanaya->user->GetAcronym() . "</a> ";
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