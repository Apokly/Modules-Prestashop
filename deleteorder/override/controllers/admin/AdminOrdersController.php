<?php

if (!defined('_PS_VERSION_'))
	exit;

class AdminOrdersController extends AdminOrdersControllerCore {

	
	function AdminOrdersController()
	{
		parent::__construct();
		$this->addRowAction('delete');
	}

}
?>