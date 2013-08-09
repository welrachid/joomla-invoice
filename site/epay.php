<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');
 
$controller = JControllerLegacy::getInstance('EPay');

require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/epay.php';
 
$controller->execute(JRequest::getCmd('task'));
 
$controller->redirect();