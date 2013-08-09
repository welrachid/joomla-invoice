<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
 
class EPayViewPayment extends JViewLegacy
{
    function display($tpl = null)
	{
		JToolBarHelper::title(JText::_('ePay Payment Solutions'), 'generic.png');
		JToolBarHelper::back('COM_EPAY_BACK');

		$item = $this->get('Item');
		
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		$this->item = $item;
		$this->params = JComponentHelper::getParams('com_epay');
		
		parent::display($tpl);
	}
}