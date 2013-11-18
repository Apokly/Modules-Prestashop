<?php

if (!defined('_PS_VERSION_'))
	exit;


class Ganalytics extends Module {
	public function __construct()
	{
		$this->name = 'ganalytics';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Fabien Dobat';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = $this->l('Google Analytics');
		$this->description = $this->l('Permet à l\'utilisateur de suivre son site sur Google analytics');

		$this->confirmUninstall = $this->l('Êtes-vous sur de vouloir désinstaller le module?');

		if (!Configuration::get('G_ANALYTICS'))
			$this->warning = $this->l('No name provided');
	}

	public function install()
	{
		if (Shop::isFeatureActive())
			Shop::setContext(Shop::CONTEXT_ALL);

		return parent::install() &&
			$this->registerHook('header') &&
			Configuration::updateValue('G_ANALYTICS', 'my friend');
	}
	
	public function hookDisplayFooter($params)
	{		
		
		return $this->display(__FILE__, 'ganalytics.tpl');
	}

	public function uninstall()
	{
		if (!parent::uninstall() ||
			!Configuration::deleteByName('G_ANALYTICS'))
			return false;
		return true;
	}



	public function hookDisplayHeader()
	{
		//$this->context->controller->addCSS($this->_path.'css/confirmpanier.css', 'all');
		//$this->context->controller->addJS($this->_path.'js/ajax-cart.js');
		//$this->context->controller->addJS($this->_path.'js/confirmpanier.js');
	}

	
}