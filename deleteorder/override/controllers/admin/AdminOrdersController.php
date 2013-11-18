<?php

if (!defined('_PS_VERSION_'))
	exit;


class AdminOrdersController extends AdminOrdersControllerCore {
	public function __construct()
	{
		parent::__construct();
		$this->addRowAction('delete');
	}

}