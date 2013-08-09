<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

function epay_get_code($code)
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
	//
	// As default return 208 for Danish Kroner
	//
	return 'DKK';
}

define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);

if (file_exists(dirname(__FILE__) . '/defines.php')) {
	include_once dirname(__FILE__) . '/defines.php';
}

if (!defined('_JDEFINES')) {
	define('JPATH_BASE', dirname(__FILE__) . '/../..');
	require_once JPATH_BASE.'/includes/defines.php';
}

require_once JPATH_BASE.'/includes/framework.php';

$mainframe = JFactory::getApplication('site');

$params = JComponentHelper::getParams('com_epay');
$var = "";

foreach ($_GET as $key => $value)
{
    if($key != "hash")
    {
        $var .= utf8_decode($value);
    }
}

$genstamp = md5($var . $params->get('epay_md5key'));

if(strlen($params->get('epay_md5key')) == 0 or $genstamp == $_GET["hash"])
{
	$db = JFactory::getDBO();
	
	$query = "SELECT * FROM #__epay WHERE tid = '" . $_REQUEST["txnid"] . "'";
	$db->setQuery($query);
	$db->Query();
	
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
	
	if($db->getNumRows() == 0)
	{
		$query = "INSERT INTO #__epay (tid, orderid, amount, cur, date, time, fraud, transfee, cardid, cardnopostfix, email, name, address, country, phone, comment) VALUES ('" . $_REQUEST["txnid"] . "', '" . $_REQUEST["orderid"] . "', '" . $_REQUEST["amount"] . "', '" . $_REQUEST["currency"] . "', '" . $_REQUEST["date"] . "', '" . $_REQUEST["time"] . "', '" . $_REQUEST["fraud"] . "', '" . $_REQUEST["txnfee"] . "', '" . $_REQUEST["paymenttype"] . "', '" . $_REQUEST["cardno"] . "', '" . $_REQUEST["cemail"] . "', '" . $_REQUEST["cname"] . "', '" . $_REQUEST["caddress"] . "', '" . $_REQUEST["ccountry"] . "', '" . $_REQUEST["cphone"] . "', '" . $_REQUEST["ccomment"] . "')";
		$db->setQuery($query);
		$result = $db->query();
	}
	
	include ("mail-template.php");
	
	$body = @str_replace("[tid]", $_REQUEST["txnid"], $body);
	$body = @str_replace("[orderid]", $_REQUEST["orderid"], $body);
	$body = @str_replace("[amount]", number_format($_REQUEST["amount"] / 100, 2, ',', '.'), $body);
	$body = @str_replace("[cardnopostfix]", $_REQUEST["cardno"], $body);
	$body = @str_replace("[cur]", epay_get_code($_REQUEST["currency"]), $body);
	$body = @str_replace("[transfee]", number_format($_REQUEST["txnfee"] / 100, 2, ',', '.'), $body);
	
	$body = @str_replace("[company]", $params->get('epay_company'), $body);
	
	$body = @str_replace("[date]", date("Y-m-d", strtotime($_REQUEST["date"])), $body);
	$body = @str_replace("[time]", date("H:i", strtotime($_REQUEST["time"])), $body);
	
	$body = @str_replace("[cemail]", $_REQUEST["cemail"], $body);
	$body = @str_replace("[cname]", $_REQUEST["cname"], $body);
	$body = @str_replace("[caddress]", str_replace("\n", "<br>", $_REQUEST["caddress"]), $body);
	$body = @str_replace("[ccountry]", $_REQUEST["ccountry"], $body);
	$body = @str_replace("[cphone]", $_REQUEST["cphone"], $body);
	$body = @str_replace("[ccomment]", str_replace("\n", "<br>", $_REQUEST["ccomment"]), $body);
	
	$from = $params->get('epay_companyemail');
	$fromname = $params->get('epay_company');
	
	$subject = JText::_('Payment confirmation');
	
	$mailer = JFactory::getMailer();
	$mailer->setSender(array($from, $fromname));
	$mailer->addRecipient($_REQUEST["cemail"]);
	$mailer->setSubject($subject);
	$mailer->isHTML(true);
	$mailer->Encoding = 'base64';
	$mailer->setBody($body);
	
	$mailer->Send();
	
	$paymentconfirmation = explode(";", $params->get('epay_paymentconfirmation'));
	
	if($paymentconfirmation)
	{
		foreach ($paymentconfirmation as $email)
		{
			$mailer = JFactory::getMailer();
			$mailer->setSender(array($from, $fromname));
			$mailer->addRecipient($email);
			$mailer->setSubject($subject);
			$mailer->isHTML(true);
			$mailer->Encoding = 'base64';
			$mailer->setBody($body);
			
			$mailer->Send();
		}
	}
	echo "OK";
}
else
{
	echo "MD5 Error";
}
?>
