<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class EPayViewTransactions extends JViewLegacy
{
	protected function populateState($ordering = null, $direction = null) {
	    parent::populateState('id', 'ASC');
	}

    function display($tpl = null)
	{		
		JToolBarHelper::title(JText::_('ePay Payment Solutions'), 'generic.png');
		$params = JComponentHelper::getParams('com_epay');
		
		if($params->get('epay_useapi') == 1)
		{
			JToolBarHelper::custom('capture', 'publish', 'publish', 'COM_EPAY_CAPTURE');
			JToolBarHelper::custom('credit', 'unpublish', 'unpublish', 'COM_EPAY_CREDIT');
		}
		
		JToolBarHelper::deleteList();
		JToolBarHelper::preferences('com_epay', '500');

		$items = $this->get('Items');
		$state = $this->get('State');
		
		$this->sortDirection = $state->get('list.direction');
        $this->sortColumn = $state->get('list.ordering');
		
		$pagination = $this->get('Pagination');
		
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		$this->items = $items;
		$this->pagination = $pagination;

		parent::display($tpl);
	}
}