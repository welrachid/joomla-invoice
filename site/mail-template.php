<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

$mainframe = JFactory::getApplication('site');

$paramsLang = JComponentHelper::getParams('com_languages');
$frontend_lang = $paramsLang->get('site', 'en-GB');
$language = JLanguage::getInstance($frontend_lang);
$lang = $language->getTag();

$params = JComponentHelper::getParams('com_epay');

$language = JFactory::getLanguage();
$language->load('com_epay', JPATH_BASE, $lang, true);

$body = "
<table cellspacing=\"0\" cellpadding=\"0\" style=\"width: 100%;\">
	<tr>
		<td style=\"vertical-align: top; padding: 10px;\">
			<table cellpadding=\"0\" cellspacing=\"0\" style=\"width: 750px;\">
				<tr>
					<td>
						<table cellspacing=\"0\" cellpadding=\"0\" style=\"width: 750px;\">
							<tr>
								<td style=\"vertical-align: top; padding: 20px; font-family: verdana, arial;\">
									<h1>" . JText::_('COM_EPAY_PAYMENT_APPROVED') . "</h1>
									<table cellspacing=\"0\" cellpadding=\"0\">
										<tr>
											<td style=\"font-size: 14px; padding: 4px; font-family: verdana, arial;\" colspan=\"2\">
												<b>" . JText::_('COM_EPAY_ORDER_INFORMATION') . "</b>
											</td>
										</tr>";
										
										if(strlen($params->get('epay_company')) > 0)
										{
											$body .= "
											<tr>
												<td style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
													" . JText::_('COM_EPAY_COMPANY') . "
												</td>
												<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 350px; font-family: verdana, arial; font-size: 13px;\">
													[company]
												</td>
											</tr>";
										}
										
										$body .= "
										<tr>
											<td style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
												" . JText::_('COM_EPAY_DATE_TIME') . "
											</td>
											<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 350px; font-family: verdana, arial; font-size: 13px;\">
												[date] [time]
											</td>
										</tr>
										<tr>
											<td style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
												" . JText::_('COM_EPAY_TRANSACTION_ID') . "
											</td>
											<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 350px; font-family: verdana, arial; font-size: 13px;\">
												[tid]
											</td>
										</tr>
										<tr>
											<td style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
		 										" . JText::_('COM_EPAY_INVOICE') . "
											</td>
											<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 350px; font-family: verdana, arial; font-size: 13px;\">[orderid]</td>
										</tr>
										<tr>
											<td style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
												" . JText::_('COM_EPAY_AMOUNT') . "
											</td>
											<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
												[amount] [cur]
											</td>
										</tr>
										<tr>
										<td style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
		 										" . JText::_('COM_EPAY_CARD') . "
											</td>
											<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
												XXXX XXXX XXXX [cardnopostfix]
											</td>
										</tr>
										<tr>
											<td style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
												" . JText::_('COM_EPAY_TRANSACTION_FEE') . "
											</td>
											<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
												[transfee] [cur]
											</td>
										</tr>";

										if($params->get('epay_showemail') == 1 or $params->get('epay_showname') == 1 or $params->get('epay_showaddress') == 1 or $params->get('epay_showcountry') == 1 or $params->get('epay_showphone') == 1 or $params->get('epay_showcomment') == 1)
										{
											$body .= "
											<tr>
												<td style=\"font-size: 14px; padding: 4px; padding-top: 20px; font-family: verdana, arial;\" colspan=\"2\"><b>
												" . JText::_('COM_EPAY_CUSTOMER_INFORMATION') . "
												</b></td>
											</tr>";
										}

										if($params->get('epay_showemail') == 1)
										{
											$body .= "
											<tr>
												<td style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 150px; font-family: verdana, arial; font-size: 13px;\" >
												" . JText::_('COM_EPAY_EMAIL') . "
												</td>
												<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 350px; font-family: verdana, arial; font-size: 13px;\">
													[cemail]
												</td>
											</tr>";
										}

										if($params->get('epay_showname') == 1)
										{
											$body .= "
											<tr>
												<td style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
													" . JText::_('COM_EPAY_NAME') . "
												</td>
												<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
													[cname]
												</td>
											</tr>";
										}

										if($params->get('epay_showaddress') == 1)
										{
											$body .= "
											<tr>
												<td valign=\"top\" style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px; vertical-align: top;\">
													". JText::_('COM_EPAY_ADDRESS') . "
												</td>
												<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
													[caddress]
												</td>
											</tr>";
										}

										if($params->get('epay_showcountry') == 1)
										{
											
											$body .= "
											<tr>
												<td style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
													" . JText::_('COM_EPAY_COUNTRY') . "
												</td>
												<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
													[ccountry]
												</td>
											</tr>";
										}

										if($params->get('epay_showphone') == 1)
										{
											$body .= "
											<tr>
												<td style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
													" . JText::_('COM_EPAY_PHONE') . "
												</td>
												<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
													[cphone]
												</td>
											</tr>";
										}

										if($params->get('epay_showcomment') == 1)
										{
											$body .= "
											<tr>
												<td valign=\"top\" style=\"background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px; vertical-align: top;\">
													" . JText::_('COM_EPAY_COMMENT') . "
												</td>
												<td style=\"background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; font-family: verdana, arial; font-size: 13px;\">
													[ccomment]
												</td>
											</tr>";
										}

									$body .= "
									</table>
								</td>
							</tr>		
							<tr>
								<td style=\"padding: 20px;\">";
									$mycom_folder = JURI::base();

									$body .= "
									<table cellspacing=\"0\" cellpadding=\"0\">
										<tr>
											<td style=\"vertical-align: top; padding-right: 20px;\"><a href=\"http://www.epay.dk/\" target=\"_blank\"><img src=\"" . $mycom_folder . "/images/epay.gif\" style=\"border: 0px;\" alt=\"ePay | Dit Online Betalingssystem\" /></a></td>
											<td style=\"vertical-align: top; font-size: 11px; color: #000000; font-family: verdana, arial; font-size: 12px;\">
												<div style=\"padding-bottom: 12px; font-weight: bold; font-size: 13px;\">
												" . JText::_('COM_EPAY_SECURE_PAYMENT') . "
												</div>
												" . JText::_('COM_EPAY_EPAY_PAYMENT_SOLUTIONS') . "
											</td>  
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>";