<?php

if (!defined('_PS_VERSION_'))
	exit;


class DeleteOrder extends Module {
	public function __construct()
	{
		$this->name = 'deleteorder';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Fabien Dobat';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = $this->l('Delete order');
		$this->description = $this->l('Allow to user to delete customer shopping cart and commands');

		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

		if (!Configuration::get('DELETE_ORDER'))
			$this->warning = $this->l('No name provided');
	}

	public function install()
	{
		if (Shop::isFeatureActive())
			Shop::setContext(Shop::CONTEXT_ALL);

		return parent::install() &&
			Configuration::updateValue('DELETE_ORDER', 'my friend');
	}

	public function uninstall()
	{
		if (!parent::uninstall() ||
			!Configuration::deleteByName('DELETE_ORDER'))
			return false;
		return true;
	}


}