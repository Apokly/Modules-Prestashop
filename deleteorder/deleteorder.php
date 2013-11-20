<?php

if (!defined('_PS_VERSION_'))
	exit;


class DeleteOrder extends Module {
	public function __construct()
	{
		$this->name = 'deleteorder';
		$this->tab = 'administration';
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
		Configuration::updateValue('DELETE_STATUS', '1') &&
			Configuration::updateValue('DELETE_ORDER', 'my friend');
	}

	public function uninstall()
	{
		if (!parent::uninstall() ||
			!Configuration::deleteByName('DELETE_ORDER'))
			return false;
		return true;
	}

	public function getContent()
	{
	    $output = null;
	 
	    if (Tools::isSubmit('submit'.$this->name))
	    {
	        $deleteStatus = strval(Tools::getValue('deleteStatus'));
	        if ((($deleteStatus != '0' ) && ($deleteStatus != '1' )) || !Validate::isGenericName($deleteStatus))
	            $output .= $this->displayError( $this->l('Invalid Configuration value') );
	        else
	        {
	        	if ($deleteStatus == '1')
	        		Configuration::updateValue('DELETE_STATUS', $deleteStatus);
	        	else
	        		Configuration::deleteByName('DELETE_ORDER');
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
	    <label>'.$this->l('Remove button').'</label>

					<div class="margin-form">
						<input type="radio" name="deleteStatus" id="dhtml_on" value="1" '.(Tools::getValue('deleteStatus', Configuration::get('DELETE_STATUS')) ? 'checked="checked" ' : '').'/>
						<label class="t" for="deleteStatus_on"> '.$this->l('Enabled').'</label>
						<input type="radio" name="deleteStatus" id="dhtml_off" value="0" '.(!Tools::getValue('deleteStatus', Configuration::get('DELETE_STATUS')) ? 'checked="checked" ' : '').'/>
						<label class="t" for="deleteStatus_on"> '.$this->l('Disabled').'</label>
						<p class="clear">'.$this->l('Activate remove button for customer cart and commands').'</p>
					</div>
				<center><input type="submit" name="submitdeleteorder" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>
	    ';
	}


}