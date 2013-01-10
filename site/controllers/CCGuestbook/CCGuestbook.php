<?php
/**
 * A guestbook controller as an example to show off some basic controller and model-stuff.
 *
 * @package LanayaControllers
 */
class CCGuestbook extends CObject implements IController {

	private $pageTitle = 'Lanaya Guestbook';
	private $guestbookModel;

   	/**
   	 * Constructor
  	 */
  	public function __construct() {
    	parent::__construct();
    	$this->guestbookModel = new CMGuestbook();
  	}
 
  	/**
  	 * Implementing interface IController. All controllers must have an index action.
  	 */
  	public function Index() {   
  		$this->views->SetTitle('Lanaya Guestbook Example');
    	$this->views->AddInclude(LANAYA_VIEWS_PATH . '/guestbook.php', array(
      		'entries'=>$this->guestbookModel->ReadAll(),
      		'form_action'=>$this->request->CreateUrl('guestbook/handler')
    	));
  	}
  	
  	/**
  	 * Handle posts from the form and take appropriate action.
  	 */
	public function Handler() {
    	if(isset($_POST['doAdd'])) {
      		$this->guestbookModel->Add(strip_tags($_POST['name']), strip_tags($_POST['message']));
    	}
    	elseif(isset($_POST['doClear'])) {
      		$this->guestbookModel->DeleteAll();
    	}
    	elseif(isset($_POST['doCreate'])) {
      		$this->guestbookModel->Init();
    	}           
    	$this->RedirectTo($this->request->CreateUrl($this->request->controller));
  	}
 
} 