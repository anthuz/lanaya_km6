<?php
/**
* Standard controller layout.
*
* @package LanayaControllers
*/
class CCIndex extends CObject implements IController {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}
   
   /**
    * Implementing interface IController. All controllers must have an index action.
    */
	public function Index() {
		$this->views->SetTitle('Index Controller');
    	$this->views->AddInclude(LANAYA_VIEWS_PATH . '/index.php', array('menu'=>$this->Menu()));
	}
    
	/**
	 * A menu that shows all available controllers/methods
	 */
	private function Menu() {
		$items = array();
		foreach($this->config['controllers'] as $key => $val) {
			if($val['enabled']) {
				$rc = new ReflectionClass($val['class']);
				$items[] = $key;
				$methods = $rc->getMethods(ReflectionMethod::IS_PUBLIC);
				
				foreach($methods as $method) {
					if($method->name != '__construct' && $method->name != '__destruct' && $method->name != 'Index') {
						$items[] = "$key/" . mb_strtolower($method->name);
					}
				}
			}
		}
		return $items;
	}
    
    /**
     * Old Index()
     * @see IController::Index()
     */
    /*public function Index() {
    	$this->data['title'] = "The Index Controller";
      	$this->data['main'] = "<h2>Welcome to Lanaya framework!</h2><br/><img src='http://athu.se/lanaya_dota2.jpg' alt='Lanaya' height='700' width='400' />";
      	$this->data['footer'] = "© Lanaya by Andreas Thuresson";
    }*/

} 