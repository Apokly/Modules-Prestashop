<?php

if (!defined('_PS_VERSION_'))
	exit;


class ContactInfo extends Module {
	public function __construct()
	{
		$this->name = 'contactinfo';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Rainbow Channel';
		$this->need_instance = 0;
		$this->dependencies = array('blockcart');

		parent::__construct();

		$this->displayName = $this->l('Informations de contact');
		$this->description = $this->l('Affiche un bloc d\'informations de contact dans la colonne de gauche.');

		$this->confirmUninstall = $this->l('Êtes-vous sur de vouloir désinstaller le module?');

		if (!Configuration::get('CONTACT_INFO'))
			$this->warning = $this->l('No name provided');
	}

	public function install()
	{
		if (Shop::isFeatureActive())
			Shop::setContext(Shop::CONTEXT_ALL);

		return parent::install() &&
			$this->registerHook('displayLeftColumn') &&
			$this->registerHook('header') &&
			Configuration::updateValue('CONTACT_INFO', 'my friend');
	}
	
	public function hookLeftColumn($params)
	{		
		
		return $this->display(__FILE__, 'contactinfo.tpl');
	}

	public function uninstall()
	{
		if (!parent::uninstall() ||
			!Configuration::deleteByName('CONTACT_INFO'))
			return false;
		return true;
	}



	public function hookDisplayHeader()
	{
		$this->context->controller->addCSS($this->_path.'css/contactinfo.css', 'all');

	}

	
}