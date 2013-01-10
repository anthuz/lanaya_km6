<?php
/**
 * A form to login the user profile.
 *
 * @package LanayaHelpers
 */
class CFormUserLogin extends CForm {

  	/**
	 * Constructor
	 */
  	public function __construct($object) {
    	parent::__construct();
    	$this->AddElement(new CFormElementText('acronym'))
         	 ->AddElement(new CFormElementPassword('password'))
         	 ->AddElement(new CFormElementSubmit('login', array('callback'=>array($object, 'DoLogin'), 'class'=>'btn btn-primary')));
    	
    	$this->SetValidation('acronym', array('not_empty'))
    		 ->SetValidation('password', array('not_empty'));
  	}
  
}