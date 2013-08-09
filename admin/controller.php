<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');
 
class EPayController extends JControllerLegacy
{
	function display($cachable = false, $urlparams = false) 
	{
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'Transactions'));

		parent::display($cachable);
	}
		
	function show($cachable = false, $urlparams = false)
	{
        $input = JFactory::getApplication()->input;
        $input->set('view', $input->getCmd('view', 'Payment'));

        parent::display($cachable);
	}
	
	function handleorder($cachable = false, $urlparams = false)
	{
		if(JRequest::getVar('type') == "capture")
			$this->capturePayment(JRequest::getVar('cid'), JRequest::getVar('amount'));
		elseif(JRequest::getVar('type') == "credit")
			$this->creditPayment(JRequest::getVar('cid'), JRequest::getVar('amount'));
		elseif(JRequest::getVar('type') == "delete")
			$this->removePayment(JRequest::getVar('cid'), true);
			
        $this->show($cachable);
	}
	
	function capture($cachable = false, $urlparams = false)
	{
		$this->capturePayment(JRequest::getVar('cid'), JRequest::getVar('amount'));
	}
	
	function credit($cachable = false, $urlparams = false)
	{
		$this->creditPayment(JRequest::getVar('cid'), JRequest::getVar('amount'));
	}
	
	function delete($cachable = false, $urlparams = false)
	{
		$this->deletePayment(JRequest::getVar('cid'));
	}
	
	function remove($cachable = false, $urlparams = false)
	{
		$this->removePayment(JRequest::getVar('cid'));
	}
	
	function capturePayment(&$cid, $amount = false)
	{
		$params =  & JComponentHelper::getParams('com_epay');
		global $app;
		
		$numCap = 0;
		
		$db =  & JFactory::getDBO();
		
		if(!is_array($cid))
		{
			$cid = array($cid);
		}
		
		$merchantnumber = $params->get('epay_merchant');
		
		foreach ($cid as  & $value)
		{
			$query = "SELECT * FROM #__epay WHERE id = " . $value;
			$db->setQuery($query);
			$row = $db->loadAssoc();
			
			if($amount == false)
			{
				$amount = $row["amount"];
			}
			
			$returnVal = false;

			try
			{
				$client = new SoapClient('https://ssl.ditonlinebetalingssystem.dk/remote/payment.asmx?WSDL');
			}
			catch(Exception $ex)
			{
				$returnMsg .= '<li>' . $e->getMessage() . '</li>';
			}
			
			$param = array('merchantnumber' => $merchantnumber, 'transactionid' => $row["tid"], 'amount' => $amount, 'pbsResponse' => -1, 'epayresponse' => -1);
			$result = $client->capture($param);

			if($result->captureResult == 'true')
			{
				$numCap = $numCap + 1;
				$returnMsg .= "<li>" . $row["tid"] . ": Payment captured</li>";
			}
			else
			{
				$returnMsg .= "<li>" . $row["tid"] . ": Payment could NOT be captured: ePay: " . $result->epayresponse . " PBS: " . $result->pbsResponse . "<br>";
			}
			
		}
		
		if($amount == false)
		{
			$app->redirect("index.php?option=com_epay&task=show&cid=" . $cid[0], $returnMsg);
		}
		else
		{
			$returnMsg = $numCap . " of " . count($cid) . " payment(s) successfully captured:</li>" . $returnMsg;
			$app->redirect("index.php?option=com_epay", $returnMsg);
		}
	}
	
	function deletePayment( &$cid, $redirect=false )
	{
		$params =  & JComponentHelper::getParams('com_epay');
		global $app;
		$numDel = 0;
		
		$db = JFactory::getDBO();
		
		$merchantnumber = $params->get('epay_merchant');
		
		if(!is_array($cid))
			$cid = array($cid);
		
		foreach ($cid as  & $value)
		{
			
			$query = "SELECT * FROM #__epay WHERE id = " . $value;
			$db->setQuery($query);
			$row = $db->loadAssoc();
			
			$returnVal = false;

			try
			{
				$client = new SoapClient('https://ssl.ditonlinebetalingssystem.dk/remote/payment.asmx?WSDL');
			}
			catch(Exception $ex)
			{
				echo '<h2>Constructor error</h2><pre>' . $e->getMessage() . '</pre>';
			}

			$param = array('merchantnumber' => $merchantnumber, 'transactionid' => $row["tid"], 'epayresponse' => -1);
			
			$result = $client->delete($param);
		
			if($result->deleteResult == 'true')
			{
				$numDel = $numDel + 1;
				$returnMsg .= "<li>" . $row["tid"] . ": Payment deleted</li>";
			}
			else
			{
				$returnMsg .= "<li>" . $row["tid"] . ": Payment could NOT be deleted: " . $result->epayresponse . "<br>";
			}

		}
		
		if($redirect == true)
		{
			$app->redirect("index.php?option=com_epay&task=show&cid=" . $cid[0], $returnMsg);
			exit;
		}
		else
		{
			$returnMsg = $numDel . " of " . count($cid) . " payment(s) successfully deleted:</li>" . $returnMsg;
			return $returnMsg;
		}
	}

	function creditPayment( &$cid, $amount = false )
	{
		$params =  & JComponentHelper::getParams('com_epay');
		global $app;
		
		$numCre = 0;
		
		$db =  & JFactory::getDBO();
		
		if(!is_array($cid))
			$cid = array($cid);
		
		$merchantnumber = $params->get('epay_merchant');
		
		foreach ($cid as  & $value)
		{
			$query = "SELECT * FROM #__epay WHERE id = " . $value;
			$db->setQuery($query);
			$row = $db->loadAssoc();
			
			if($amount == false)
				$amount = $row["amount"];
			
			$returnVal = false;
			
			try
			{
				$client = new SoapClient('https://ssl.ditonlinebetalingssystem.dk/remote/payment.asmx?WSDL');
			}
			catch(Exception $ex)
			{
				echo '<h2>Constructor error</h2><pre>' . $e->getMessage() . '</pre>';
			}

			$param = array('merchantnumber' => $merchantnumber, 'transactionid' => $row["tid"], 'amount' => $amount, 'pbsresponse' => -1, 'epayresponse' => -1);
			$result = $client->credit($param);

			if($result->creditResult == 'true')
			{
				$numCre = $numCre + 1;
				$returnMsg .= "<li>" . $row["tid"] . ": Payment credited</li>";
			}
			else
				$returnMsg .= "<li>" . $row["tid"] . ": Payment could NOT be credited: ePay: " . $result->epayresponse . " PBS: " . $result->pbsresponse . "<br>";
				
		}
		
		if($amount == false)
			$app->redirect("index.php?option=com_epay&task=show&cid=" . $cid[0], $returnMsg);
		else
		{
			$returnMsg = $numCre . " of " . count($cid) . " payment(s) successfully credited:</li>" . $returnMsg;
			$app->redirect("index.php?option=com_epay", $returnMsg);
		}
	}
	
	function removePayment( &$cid, $redirect_remove=false )
	{
		global $app;
		$db =  & JFactory::getDBO();
		$params =  & JComponentHelper::getParams('com_epay');
		
		if(!is_array($cid))
			$cid = array($cid);
		
		$returnMsg = "";
		if($params->get('epay_useapi') == 1)
			$returnMsg .= $this->deletePayment($cid, false);

		if(count($cid))
		{
			$cids = implode(',', $cid);
			$query = ' DELETE FROM #__epay'  . ' WHERE id IN ( ' . $cids . ' )';
			$db->setQuery($query);
			if(!$db->query())
			{
				$returnMsg .= "<li>" . $db->getErrorMsg(true) . "</li>";
				if($redirect == true)
				{
					$app->redirect("index.php?option=com_epay&task=show&cid=" . $cid[0], "<span>" . $returnMsg . "</span>");
					exit;
				}
			}
			else
			{
				$returnMsg .= "<li>" . count($cid) . " payment(s) successfully removed" . "</li>";
			}
		}
		if($redirect == true)
		{
			$app->redirect("index.php?option=com_epay", "<span>" . $returnMsg . "</span>");
			exit;
		}
		else
		{
			$app->redirect("index.php?option=com_epay", "<span>" . $returnMsg . "</span>");
			exit;
		}
	}
}