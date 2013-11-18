<?php

if (!defined('_PS_VERSION_'))
	exit;


class ConfirmPanier extends Module {
	public function __construct()
	{
		$this->name = 'confirmpanier';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Rainbow Channel';
		$this->need_instance = 0;
		$this->dependencies = array('blockcart');

		parent::__construct();

		$this->displayName = $this->l('Confirmer Panier');
		$this->description = $this->l('Permet à l\'utilisateur de confirmer l\'ajout d\'un article à son panier');

		$this->confirmUninstall = $this->l('Êtes-vous sur de vouloir désinstaller le module?');

		if (!Configuration::get('CONFIRM_PANIER'))
			$this->warning = $this->l('No name provided');
	}

	public function install()
	{
		if (Shop::isFeatureActive())
			Shop::setContext(Shop::CONTEXT_ALL);

		return parent::install() &&
			$this->registerHook('displayFooter') &&
			$this->registerHook('header') &&
			Configuration::updateValue('CONFIRM_PANIER', 'my friend');
	}
	
	public function hookDisplayFooter($params)
	{		
		
		return $this->display(__FILE__, 'confirmpanier.tpl');
	}

	public function uninstall()
	{
		if (!parent::uninstall() ||
			!Configuration::deleteByName('CONFIRM_PANIER'))
			return false;
		return true;
	}



	public function hookDisplayHeader()
	{
		$this->context->controller->addCSS($this->_path.'css/confirmpanier.css', 'all');
		$this->context->controller->addJS($this->_path.'js/ajax-cart.js');
		$this->context->controller->addJS($this->_path.'js/confirmpanier.js');
	}

	
}