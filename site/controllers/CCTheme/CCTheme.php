<?php
/**
* A test controller for themes.
*
* @package LydiaCore
*/
class CCTheme extends CObject implements IController {

  	/**
   	 * Constructor
   	 */
  	public function __construct() { parent::__construct(); }


  	/**
   	 * Display what can be done with this controller.
   	 */
  	public function Index() {
    	$this->views->SetTitle('Theme');
		$this->views->AddInclude(LANAYA_VIEWS_PATH . '/theme.php', array(
			'theme_name' => $this->config['theme']['name'],
		));
  	}
  
  	/**
  	 * Put content in some regions.
  	 */
  	public function SomeRegions() {
  		$this->views->SetTitle('Theme display content for some regions');
  		$this->views->AddString('<h1>This is the primary region</h1>', array(), 'content');
  		 
  		if(func_num_args()) {
  			foreach(func_get_args() as $val) {
  				$this->views->AddString("This is region: $val", array(), $val);
  				$this->views->AddStyle('#'.$val.'{background-color:hsla(0,0%,90%,0.5);}');
  			}
  		}
  	}

  	/**
  	 * Put content in all regions.
  	 */
  	public function AllRegions() {
  		$this->views->SetTitle('Theme display content for all regions');
  		foreach($this->config['theme']['regions'] as $val) {
  			$this->views->AddString("This is region: $val", array(), $val);
  		}
  	}
  	
} 