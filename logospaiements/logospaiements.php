<?php

if (!defined('_PS_VERSION_'))
	exit;


class LogosPaiements extends Module {
	public function __construct()
	{
		$this->name = 'logospaiements';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Rainbow Channel';
		$this->need_instance = 0;
		$this->dependencies = array('blockcart');

		parent::__construct();

		$this->displayName = $this->l('Logos de paiement');
		$this->description = $this->l('Affiche un petit bloc dans le footer avec les logos de paiement');

		$this->confirmUninstall = $this->l('Êtes-vous sur de vouloir désinstaller le module?');

		if (!Configuration::get('LOGOS_PAIEMENT'))
			$this->warning = $this->l('No name provided');
	}

	public function install()
	{
		if (Shop::isFeatureActive())
			Shop::setContext(Shop::CONTEXT_ALL);

		return parent::install() &&
			$this->registerHook('displayFooter') &&
			$this->registerHook('header') &&
			Configuration::updateValue('LOGOS_PAIEMENT', 'my friend');
	}
	
	public function hookDisplayFooter($params)
	{		
		
		return $this->display(__FILE__, 'logospaiements.tpl');
	}

	public function uninstall()
	{
		if (!parent::uninstall() ||
			!Configuration::deleteByName('LOGOS_PAIEMENT'))
			return false;
		return true;
	}



	public function hookDisplayHeader()
	{
		$this->context->controller->addCSS($this->_path.'css/logospaiements.css', 'all');
	}

	
}