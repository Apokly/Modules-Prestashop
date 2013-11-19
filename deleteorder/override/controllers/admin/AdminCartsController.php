<?php

if (!defined('_PS_VERSION_'))
	exit;

class AdminCartsController extends AdminCartsControllerCore {


	function displayDeleteLink($token = null, $id, $name = null)
	{
		return $this->helper->displayDeleteLink($token, $id, $name);
	}

}
?>