<?php

if (!defined('_PS_VERSION_'))
	exit;

class AdminOrdersController extends AdminOrdersControllerCore {

	
	function AdminOrdersController()
	{
		parent::__construct();
		if (Configuration::get('DELETE_ORDER'))
		{
			$this->addRowAction('delete');
		}
	}

}
?>