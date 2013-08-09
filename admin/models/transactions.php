<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modellist');

class EPayModelTransactions extends JModelList
{
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState('id', 'DESC');
	}
	
    public function __construct($config = array())
	{
		$config['filter_fields'] = array
		(
			'cardid',
			'tid',
			'orderid',
			'cur',
			'amount',
			'time',
			'transfee',
			'fraud',
			'id'
		);
		parent::__construct($config);
	}
	
    protected function getListQuery()
    {      
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__epay');
		
		$query->order($db->escape($this->getState('list.ordering', 'id')) . ' ' . $db->escape($this->getState('list.direction', 'DESC')));
		
        return $query;
    }
}