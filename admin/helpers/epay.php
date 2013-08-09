<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die;

class EPayHelper
{
	public static function getTransaction($merchantnumber, $transactionid)
	{
		$params = JComponentHelper::getParams('com_epay');
		global $app;
		$returnVal = false;
		
		try
		{
			$client = new SoapClient('https://ssl.ditonlinebetalingssystem.dk/remote/payment.asmx?WSDL');
		}
		catch(Exception $ex)
		{
			echo '<h2>Constructor error</h2><pre>' . $e->getMessage() . '</pre>';
		}
		
		$param = array('merchantnumber' => $merchantnumber, 'transactionid' => $transactionid, 'epayresponse' => - 1);
		
		$result = $client->gettransaction($param);
		
		if($result->gettransactionResult == 'true')
			$returnVal = $result;
		else
			$app->redirect("index.php?option=com_epay", "An error occured during webservice: " . $result->epayresponse);
		
		return $returnVal;
	}
	
	public static function epay_get_code($code)
	{
		switch($code)
		{
			case '036':
				return 'AED';
				break;
			case '124':
				return 'CAD';
				break;
			case '208':
				return 'DKK';
				break;
			case '344':
				return 'HKD';
				break;
			case '352':
				return 'ISK';
				break;
			case '392':
				return 'JPY';
				break;
			case '484':
				return 'MXN';
				break;
			case '554':
				return 'NZD';
				break;
			case '578':
				return 'NOK';
				break;
			case '702':
				return 'SGD';
				break;
			case '710':
				return 'ZAR';
				break;
			case '752':
				return 'SEK';
				break;
			case '756':
				return 'CHF';
				break;
			case '826':
				return 'GBP';
				break;
			case '840':
				return 'USD';
				break;
			case '949':
				return 'TRY';
				break;
			case '978':
				return 'EUR';
				break;
			case '985':
				return 'PLN';
				break;
		}
		return 'DKK';
	}
}