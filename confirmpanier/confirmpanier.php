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
			/* $this->registerHook('backOfficeHeader') && */
			Configuration::updateValue('DISPLAY_LOGO', '1') &&
			Configuration::updateValue('HEADER_FOOTER_COLOR', '#ecd078') &&
			Configuration::updateValue('CONTENT_COLOR', '#ffffff') &&
			Configuration::updateValue('TEXT_COLOR', '#000000') &&
			Configuration::updateValue('PRICE_COLOR', '#C86438') &&
			Configuration::updateValue('BUTTON_BG_COLOR', '#53777a') &&
			Configuration::updateValue('BUTTON_TEXT_COLOR', '#DEC49C') &&
			Configuration::updateValue('CONFIRM_PANIER', 'my friend');
	}
	
/*
	public function hookDisplayBackOfficeHeader($params) {
		$this->context->controller->addJS($this->_path.'js/colorpicker/js/colorpicker.js');
		$this->context->controller->addCSS($this->_path.'js/colorpicker/css/colorpicker.css', 'all');
	}
*/
	

	
	public function hookDisplayFooter($params)
	{		
		$this->context->smarty->assign(
	        array(
	            'DISPLAY_LOGO' => Configuration::get('DISPLAY_LOGO'),
	            'HEADER_FOOTER_COLOR' => Configuration::get('HEADER_FOOTER_COLOR'),
	            'CONTENT_COLOR' => Configuration::get('CONTENT_COLOR'),
	            'TEXT_COLOR' => Configuration::get('TEXT_COLOR'),
	            'PRICE_COLOR' => Configuration::get('PRICE_COLOR'),
	            'BUTTON_BG_COLOR' => Configuration::get('BUTTON_BG_COLOR'),
	            'BUTTON_TEXT_COLOR' => Configuration::get('BUTTON_TEXT_COLOR')
	        )
	    );
		
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
	

	
	
	public function getContent()
	{
	
	    $output = null;
	    if (Tools::isSubmit('submit'.$this->name))
	    {
	        $displayLogo = strval(Tools::getValue('displayLogo'));
	        $headerFooterColor = strval(Tools::getValue('headerFooterColor'));
	        $contentColor = strval(Tools::getValue('contentColor'));
	        $textColor = strval(Tools::getValue('textColor'));
	        $priceColor = strval(Tools::getValue('priceColor'));
	        $buttonBgColor = strval(Tools::getValue('buttonBgColor'));
	        $buttonTextColor = strval(Tools::getValue('buttonTextColor'));
	        
	        
	        if ((($displayLogo != '0' ) && ($displayLogo != '1' )) || !Validate::isGenericName($displayLogo))
	            $output .= $this->displayError( $this->l('Invalid Configuration value') );
	        else
	        {
	      	  Configuration::updateValue('HEADER_FOOTER_COLOR', $headerFooterColor);
	      	  Configuration::updateValue('CONTENT_COLOR', $contentColor);
	      	  Configuration::updateValue('TEXT_COLOR', $textColor);
	      	  Configuration::updateValue('PRICE_COLOR', $priceColor);
	      	  Configuration::updateValue('BUTTON_BG_COLOR', $buttonBgColor);
	      	  Configuration::updateValue('BUTTON_TEXT_COLOR', $buttonTextColor);
	        	
	        	if ($displayLogo == '1')
	        		Configuration::updateValue('DISPLAY_LOGO', $displayLogo);
	        	else
	        		Configuration::updateValue('DISPLAY_LOGO', 0);
	            $output .= $this->displayConfirmation($this->l('Settings updated'));
	        }
    	}
    	return $output.$this->displayForm();
	}

	public function displayForm()
	{
	
	    return '
	    <form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
		    <fieldset>
					<legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
	    <label>'.$this->l('Display logo').'</label>

					<div class="margin-form">
						<input type="radio" name="displayLogo" id="dhtml_on" value="1" '.(Tools::getValue('displayLogo', Configuration::get('DISPLAY_LOGO')) ? 'checked="checked" ' : '').'/>
						<label class="t" for="displayLogo_on"> '.$this->l('Enabled').'</label>
						<input type="radio" name="displayLogo" id="dhtml_off" value="0" '.(!Tools::getValue('displayLogo', Configuration::get('DISPLAY_LOGO')) ? 'checked="checked" ' : '').'/>
						<label class="t" for="displayLogo_on"> '.$this->l('Disabled').'</label>
						<p class="clear">'.$this->l('Display the shop logo on the confirmation box.').'</p>
					</div>
					<label for="headerFooterColor"> '.$this->l('Header and footer box color').'</label>
					<div class="margin-form">
						<input type="text" id="headerFooterColor" name="headerFooterColor" value="' .Configuration::get('HEADER_FOOTER_COLOR').'" size="20" />
						<p class="clear">'.$this->l('(Example : #000000 for black)').'</p>
					</div>
					<label for="contentColor"> '.$this->l('Content box color').'</label>
					<div class="margin-form">
						<input type="text" id="contentColor" name="contentColor" value="' .Configuration::get('CONTENT_COLOR').'" size="20" />
						<p class="clear">'.$this->l('(Example : #ffffff for white)').'</p>
					</div>
					<label for="textColor"> '.$this->l('Text color').'</label>
					<div class="margin-form">
						<input type="text" id="textColor" name="textColor" value="' .Configuration::get('TEXT_COLOR').'" size="20" />
						<p class="clear">'.$this->l('(Example : #000000 for black)').'</p>
					</div>
					<label for="priceColor"> '.$this->l('Price color').'</label>
					<div class="margin-form">
						<input type="text" id="priceColor" name="priceColor" value="' .Configuration::get('PRICE_COLOR').'" size="20" />
						<p class="clear">'.$this->l('(Example : #AA0000 for red)').'</p>
					</div>
					<label for="buttonBgColor"> '.$this->l('Button background color').'</label>
					<div class="margin-form">
						<input type="text" id="buttonBgColor" name="buttonBgColor" value="' .Configuration::get('BUTTON_BG_COLOR').'" size="20" />
						<p class="clear">'.$this->l('(Example : #000000 for black)').'</p>
					</div>
					<label for="buttonTextColor"> '.$this->l('Button text color').'</label>
					<div class="margin-form">
						<input type="text" id="buttonTextColor" name="buttonTextColor" value="' .Configuration::get('BUTTON_TEXT_COLOR').'" size="20" />
						<p class="clear">'.$this->l('(Example : #ffffff for white)').'</p>
					</div>

				<center><input type="submit" name="submitconfirmpanier" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>
	    ';
	    
	}

	
}