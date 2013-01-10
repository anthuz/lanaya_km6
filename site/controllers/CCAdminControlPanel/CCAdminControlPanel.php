<?php
/**
 * A guestbook controller as an example to show off some basic controller and model-stuff.
 *
 * @package LanayaControllers
 */
class CCAdminControlPanel extends CObject implements IController {

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
  		if($this->user->IsAuthenticated()) {
  			$this->views->SetTitle('Lanaya ACP');
    		$this->views->AddInclude(LANAYA_VIEWS_PATH . '/acp.php');
  		} else {
  			
  		}
  	}
 
} 