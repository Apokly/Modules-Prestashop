<?php

if (!defined('_PS_VERSION_'))
	exit;

class AdminCartsController extends AdminCartsControllerCore {


	function displayDeleteLink($token = null, $id, $name = null)
	{
		if (Configuration::get('DELETE_ORDER'))
		{
			return $this->helper->displayDeleteLink($token, $id, $name);
		}
		else
			parent::displayDeleteLink($token = null, $id, $name = null);
	}

}
?>