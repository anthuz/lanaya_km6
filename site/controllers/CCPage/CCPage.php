<?php
/**
* A page controller to display a page, for example an about-page, displays content labelled as "page".
*
* @package LanayaControllers
*/
class CCPage extends CObject implements IController {


	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}


	/**
	 * Display an empty page.
	 */
	public function Index() {
		$content = new CMContent();
    	$this->views->SetTitle('Page');
        $this->views->AddInclude(LANAYA_VIEWS_PATH . '/page.php', array(
			'content' => null,
		));
	}


	/**
	 * Display a page.
	 *
	 * @param $id integer the id of the page.
	 */
	public function View($id=null) {
		$content = new CMContent($id);
    	$this->views->SetTitle('Page: '. $content['title']);
        $this->views->AddInclude(LANAYA_VIEWS_PATH . '/page.php', array(
			'content' => $content,
		));
	}
} 