<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class EPayViewEPay extends JViewLegacy
{
	function display($tpl = null) 
	{
		$this->params = JComponentHelper::getParams('com_epay');
 
		parent::display($tpl);
	}
}
