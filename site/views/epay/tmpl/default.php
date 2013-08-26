<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die('Restricted access');

$mycom_folder = JURI::base() . 'components/com_epay';

if(@$_REQUEST['accept'] == 1)
{
	$getparams = $_GET;
	$var = "";
	
	foreach ($getparams as $key => $value)
	{
		if($key != "hash" && $key != "Itemid" && $key != "option" && $key != "view")
		{
			$var .= $value;
		}
		
		if($key == "hash")
			break;
	}
	
	$genstamp = md5($var . $this->params->get('epay_md5key'));
	
	if($genstamp == $_GET["hash"])
	{
	?>
    <table cellspacing="0" cellpadding="0">
        <tr>
            <td style="vertical-align: top; padding: 20px;">
                <h1><?php echo JText::_('COM_EPAY_PAYMENT_APPROVED'); ?></h1>
				<table cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="font-size: 12px; padding: 4px;"><b><?php echo JText::_('COM_EPAY_ORDER_INFORMATION'); ?>:</b></td>
                    </tr>
					<?php
						if(strlen($this->params->get('epay_company')) > 0){
					?>
					<tr>
                        <td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_COMPANY'); ?></td>
                        <td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 350px;"><?php echo $this->params->get('epay_company') ?></td>
                    </tr>
					<?php
						}
					?>
					<tr>
                        <td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_DATE_TIME'); ?></td>
                        <td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 350px;"><?php echo date("Y-m-d", strtotime($_REQUEST['date'])); ?> <?php echo date("H:i", strtotime($_REQUEST['time'])); ?></td>
                    </tr>
					<tr>
                        <td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_TRANSACTION_ID'); ?></td>
                        <td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 350px;"><?php echo $_REQUEST['txnid'] ?></td>
                    </tr>
                    <tr>
                        <td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_INVOICE'); ?></td>
                        <td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 350px;"><?php echo $_REQUEST['orderid'] ?></td>
                    </tr>
                    <tr>
                        <td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_AMOUNT'); ?></td>
                        <td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;">
							<?php echo number_format($_REQUEST['amount']/100, 2, ',', '.'); ?>
							<?php echo EPayHelper::epay_get_code($_REQUEST['currency']) ?>
						</td>
                    </tr>
                    <tr>
                        <td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_CARD'); ?></td>
                        <td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;">
							<?php echo $_REQUEST['cardno'] ?>
						</td>
                    </tr>
					<tr>
                        <td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_TRANSACTION_FEE'); ?></td>
                        <td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;">
							<?php echo number_format($_REQUEST['txnfee']/100, 2, ',', '.'); ?>
							<?php echo EPayHelper::epay_get_code($_REQUEST['currency']) ?>
						</td>
                    </tr>
					<?php
						if($this->params->get('epay_showemail') == 1 or $this->params->get('epay_showname') == 1 or $this->params->get('epay_showaddress') == 1 or $this->params->get('epay_showcountry') == 1 or $this->params->get('epay_showphone') == 1 or $this->params->get('epay_showcomment') == 1){
					?>
                    <tr>
                        <td style=" padding: 4px; padding-top: 20px; font-size: 12px;font-size: 12px;"><b><?php echo JText::_('COM_EPAY_CUSTOMER_INFORMATION'); ?>:</b></td>
                    </tr>
					<?php
						}
					?>
                   	<?php
						if($this->params->get('epay_showemail') == 1){
					?>
							<tr>
								<td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 150px;" ><?php echo JText::_('COM_EPAY_EMAIL'); ?></td>
								<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px; width: 350px;"><?php echo $_REQUEST['cemail'] ?></td>
				
							</tr>
					<?php
						}
					?>
					<?php
						if($this->params->get('epay_showname') == 1){
					?>
							<tr>
								<td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_NAME'); ?></td>
								<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo $_REQUEST['cname'] ?></td>
					
							</tr>
					<?php
						}
					?>
					<?php
						if($this->params->get('epay_showaddress') == 1){
					?>
							<tr>
								<td valign="top" style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_ADDRESS'); ?></td>
								<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo str_replace("\n", "<br>", $_REQUEST['caddress']) ?></td>
			
							</tr>
					<?php
						}
					?>
					<?php
						if($this->params->get('epay_showcountry') == 1){
					?>
							<tr>
								<td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_COUNTRY'); ?></td>
								<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo $_REQUEST['ccountry'] ?></td>
						
							</tr>
					<?php
						}
					?>
					<?php
						if($this->params->get('epay_showphone') == 1){
					?>
							<tr>
								<td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_PHONE'); ?></td>
								<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo $_REQUEST['cphone'] ?></td>
						
							</tr>
					<?php
						}
					?>
								<?php
						if($this->params->get('epay_showcomment') == 1){
					?>
							<tr>
								<td valign="top" style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_COMMENT'); ?></td>
								<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo str_replace("\n", "<br>", $_REQUEST['ccomment']) ?></td>
						
							</tr>
					<?php
						}
					?>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="vertical-align: top; padding-right: 20px;"><span style="height:49px;width:100%;float:left;" id="epay_logos">Logo</span></td>
                        <td style="vertical-align: top; font-size: 11px; color: #000000;">
                            <div style="padding-bottom: 8px; font-weight: bold;"><?php echo JText::_('COM_EPAY_SECURE_PAYMENT'); ?></div>
                            <?php echo JText::_('COM_EPAY_EPAY_PAYMENT_SOLUTIONS'); ?>
                        </td>  
                    </tr>
                </table>
            </td>
        </tr>
    </table>	
	<script type="text/javascript" src="https://relay.ditonlinebetalingssystem.dk/integration/paymentlogos/PaymentLogos.aspx?merchantnumber=<?php echo $this->params->get('epay_merchant') ?>&direction=1&padding=0&cols=1&logo=1&showdivs=0&showcards=0&enablelink=0&divid=epay_logos"></script>
	<?php
		}else{
			echo "<h1>MD5 Error</h1>";
		}
	}else{
	?>
	<script type="text/javascript" src="https://ssl.ditonlinebetalingssystem.dk/integration/ewindow/paymentwindow.js" charset="UTF-8">
	</script>
	<script type="text/javascript">	
		var iMinorUnit = 0;
		var hashcalculated = false;
		var hash = "";
		
		function Decimals(x, dec_sep)
		{
			var tmp=new String();
			tmp=x;
			if (tmp.indexOf(dec_sep)>-1)
			return tmp.length-tmp.indexOf(dec_sep)-1;
			else
			return 0;
		} 

	    function startPayment()
	    {
	        var objForm = document.getElementById("ePayForm");
	        var objAmount = objForm.useramount;
				
	        if (objForm.orderid.value.length == 0) 
	        {
                alert("<?php echo JText::_('COM_EPAY_PLEASE_ENTER_A_INVOICE_NUMBER_CORRECTLY'); ?>.");
                objForm.orderid.focus();
                return false;
            }
	        
	        if (objAmount.value.length < 1 || objAmount.value == "") {
	            alert("<?php echo JText::_('COM_EPAY_YOU_NEED_TO_ENTER_THE_AMOUNT'); ?>!");
	            objAmount.focus();
	            return false;
	        }
	        else if (objAmount.value.indexOf(".") > -1 || Decimals(objAmount.value, ",") > 2) {
	            alert("<?php echo JText::_('COM_EPAY_THE_AMOUNT_MAY_NOT_CONTAIN') ?>");
	            objAmount.focus();
	            return false;
	        }
			<?php
				if($this->params->get('epay_showemail') == 1){
			?>
			
				var mailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	
				if (!mailreg.test(objForm.email.value)) {
					alert("<?php echo JText::_('COM_EPAY_PLEASE_ENTER_YOUR_EMAIL_ADDRESS') ?>");
					objForm.email.focus();
					return false;
				}
			
			<?php
				}
			?>
			
	        var amount = trimString(objAmount.value);

	        if (iMinorUnit == "-1") {
	            alert("<?php echo JText::_('COM_EPAY_YOU_ENTERED_AN_INVALID_AMOUNT') ?>");
	            objAmount.focus();
	            return false;
	        }
	        else if (iMinorUnit == "0")
	            amount = parseInt(amount) * 100;

			<?php
			if($this->params->get('epay_terms') and $this->params->get('epay_acceptterms')) {
			?>
				if (!objForm.terms.checked) {
					alert("<?php echo JText::_('COM_EPAY_ACCEPT_TERMS') ?>");
					return false;
				}
			<?php
			}
			?>
			
			var epayOrderID = objForm.orderid.value;
			var epayAmount = amount;
			var epayCurrency = objForm.currency.value;
			var epayMerchantnumber = "<?php echo $this->params->get('epay_merchant') ?>";
			var epayWindowID = "<?php echo $this->params->get('epay_windowid') ?>";
			var epayAccepturl = "<?php echo JURI::current(); ?>?accept=1";
			var epayCallbackurl = "<?php echo $mycom_folder ?>/callback.php";
			var epayDeclineurl = "<?php echo JURI::current(); ?>?<?php echo http_build_query(JRequest::get( 'get' )); ?>";
			var epayDescription= "";
			var epayOwnreceipt = "1";
			var epayCms = "joomla_invoice";
			var epayGroup = "<?php echo $this->params->get('epay_group') ?>";
			var epayInstantcapture = "<?php echo $this->params->get('epay_instantcapture') ?>";
			var epayAuthsms = "<?php echo $this->params->get('epay_authsms') ?>";
			var epayAuthmail = "<?php echo $this->params->get('epay_authmail') ?>";
			var epayWindowstate = "<?php echo $this->params->get('epay_windowstate') ?>";
			
			epayAccepturl = epayAccepturl + ("&cemail=" + objForm.email.value + "&cname=" + objForm.name.value + "&caddress=" + objForm.address.value + "&ccountry=" + objForm.country.value + "&cphone=" + objForm.phone.value + "&ccomment=" + objForm.comment.value);
	        epayCallbackurl = epayCallbackurl + "?" + ("cemail=" + objForm.email.value + "&cname=" + objForm.name.value + "&caddress=" + objForm.address.value + "&ccountry=" + objForm.country.value + "&cphone=" + objForm.phone.value + "&ccomment=" + objForm.comment.value);
			
			var hashstring = epayOrderID + 
				epayAmount + 
				epayCurrency +
				epayMerchantnumber + 
				<?php ($this->params->get('epay_windowid') ? "epayWindowID  + " : "") ?>
				encodeURI(epayAccepturl) + 
				encodeURI(epayCallbackurl) + 
				epayDeclineurl + 
				epayDescription +
				epayOwnreceipt +
				epayCms +
				epayGroup +
				epayInstantcapture +
				epayAuthsms +
				epayAuthmail +
				epayWindowstate;
			
			paymentwindow = new PaymentWindow({
				'orderid': epayOrderID,
				'amount': epayAmount,
				'currency': epayCurrency,
				'merchantnumber': epayMerchantnumber,
				<?php ($this->params->get('epay_windowid') ? "'windowid': epayWindowID," : "") ?>
				'accepturl': encodeURI(epayAccepturl),
				'callbackurl': encodeURI(epayCallbackurl),
				'cancelurl': epayDeclineurl,
				'description': epayDescription,
				'ownreceipt': epayOwnreceipt,
				'cms': epayCms,
				'group': epayGroup,
				'instantcapture': epayInstantcapture,
				'smsreceipt': epayAuthsms,
				'mailreceipt': epayAuthmail,
				'windowstate': epayWindowstate
            });
			
			var objPoll = document.createElement("script");
			objPoll.type = "text/javascript";
			objPoll.src = "<?php echo $mycom_folder ?>/md5.php?md5string="+encodeURIComponent(hashstring);
			document.body.appendChild(objPoll);
	    }		
		
		function openPayment()
		{
			paymentwindow.options['hash'] = hash;
			paymentwindow.open();
		}

	    function trimString(str)
	    {
		    iMinorUnit = 0;
		    var tmp = String(str);
		    var returnVal = "";
		    var cVal = "";

		    if (tmp != "")
		    {
			    for (var i = 0; i < tmp.length; i++)
			    {
				    cVal = tmp.substr(i, 1);
    				
				    if(!isNaN(cVal))
					    returnVal = returnVal + cVal;
				    else
				    {
					    if(cVal != ",")
					    {
					        iMinorUnit = -1;
					        break;
					    }
					    else
					        iMinorUnit = 1;	
                    }					    
			    }
		    }	
    		
		    return returnVal;
		}
    </script>
	
	<?php
		$pre_invoice = JRequest::getVar('set_invoice');
		$pre_amount = JRequest::getVar('set_amount');
		$pre_currency = JRequest::getVar('set_currency');
		$pre_email = JRequest::getVar('set_email');
	?>	
    <form id="ePayForm" onsubmit="return startPayment();">    
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td style="vertical-align: top; padding: 20px;">
                    <h1><?php echo JText::_('COM_EPAY_EPAY_PAYMENT_SOLUTIONS_HEADER'); ?></h1>
                    
					<table cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="font-size: 12px; padding: 4px;"><b><?php echo JText::_('COM_EPAY_ORDER_INFORMATION'); ?>:</b></td>
                        </tr>
                        <tr>
                            <td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_INVOICE'); ?></td>
                            <td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><input type="text" <?php if(strlen($pre_invoice) > 0){ echo "value=\"".$pre_invoice."\""; } ?> name="orderid" style="width: 140px;" maxlength="20" /></td>
                        </tr>
                        <tr>
                            <td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_AMOUNT'); ?></td>
                            <td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;">
								<input type="text" name="useramount" style="width: 77px;" maxlength="12" <?php if($pre_amount > 0){ echo "value=\"".number_format($pre_amount/100, 2, ',', '') ."\""; } ?> />
								<?php 
									$epay_currencies = $this->params->get('epay_currencies');
									if(is_array($epay_currencies) && count($epay_currencies) > 1){
										?>
										<select name="currency" style="width: 60px;">
											<?php
											foreach($epay_currencies as &$value){
											?>
												<option <?php if($pre_currency == $value){ echo "selected=\"1\""; } ?> value="<?php echo $value ?>"><?php echo EPayHelper::epay_get_code($value) ?></option>
											<?php
											}
											?>
										</select>
										<?php
									}else{
										if(is_array($epay_currencies))
											$epay_currencies = $epay_currencies[0];
										
										if($epay_currencies == ""){
											$epay_currencies = 208;
										}
										
										echo EPayHelper::epay_get_code($epay_currencies);
										?>
											<input type="hidden" name="currency" value="<?php echo $epay_currencies ?>">
										<?php
									}
								?>
							</td>
                        </tr>
						<?php
							if($this->params->get('epay_showemail') == 1){
						?>
								<tr>
									<td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_EMAIL'); ?></td>
									<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><input type="text" name="email" <?php if(strlen($pre_email) > 0){ echo "value=\"".$pre_email."\""; } ?>  style="width: 350px;"/></td>
					
								</tr>
						<?php
							}else{
						?>
								<input type="hidden" name="email"/>
						<?php
							}
						?>
						<?php
							if($this->params->get('epay_showname') == 1){
						?>
							<tr>
								<td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_NAME'); ?></td>
								<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><input type="text" name="name" style="width: 350px;"/></td>
							</tr>
						<?php
							}else{
						?>
							<input type="hidden" name="name"/>
						<?php
							}
						?>
						<?php
							if($this->params->get('epay_showaddress') == 1){
						?>
							<tr>
								<td valign="top" style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_ADDRESS'); ?></td>
								<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><textarea name="address" style="width: 350px; height: 70px;"/></textarea></td>
							</tr>
						<?php
							}else{
						?>
								<input type="hidden" name="address"/>
						<?php
							}
						?>
						<?php
							if($this->params->get('epay_showcountry') == 1){
						?>
							<tr>
								<td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_COUNTRY'); ?></td>
								<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><input type="text" name="country" style="width: 350px;"/></td>
							</tr>
						<?php
							}else{
						?>
							<input type="hidden" name="country"/>
						<?php
							}
						?>
						<?php
							if($this->params->get('epay_showphone') == 1){
						?>
							<tr>
								<td style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_PHONE'); ?></td>
								<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><input type="text" name="phone" style="width: 350px;"/></td>
							</tr>
						<?php
							}else{
						?>
							<input type="hidden" name="phone"/>
						<?php
							}
						?>
						<?php
							if($this->params->get('epay_showcomment') == 1){
						?>
							<tr>
								<td valign="top" style="background-color: #EEEEEE; border-right: 3px solid #FFFFFF; border-bottom: 3px solid #FFFFFF; padding: 4px;"><?php echo JText::_('COM_EPAY_COMMENT'); ?></td>
								<td style="background-color: #EEEEEE; border-bottom: 3px solid #FFFFFF; padding: 4px;"><textarea name="comment" style="width: 350px; height: 70px;"/></textarea></td>
							</tr>
						<?php
							}else{
						?>
							<input type="hidden" name="comment"/>
						<?php
							}
						?>
						<?php
						if($this->params->get('epay_terms') )
						{
							$db = JFactory::getDBO();
							$query = "SELECT * FROM #__menu WHERE id = '".$this->params->get('epay_terms')."'";
							$db->setQuery($query);
							$row = $db->loadAssoc();
							
							if($this->params->get('epay_acceptterms')){
							?>
							<tr>
								<td>&nbsp;</td>
								<td colspan="2">
									<table cellspacing="0" cellpadding="2">
										<tr>
											<td style="padding-right: 5px;"><input type="checkbox" name="terms" style="border: 0px;" /></td>
											<td><a href="<?php echo $row['link'] ?>" target="_blank" title="<?php echo JText::_('Open in new window') ?>"><?php echo JText::_('COM_EPAY_ACCEPT_TERMS') ?>.</a></td>
										</tr>
									</table>
								</td>
							</tr>
							<?php
							}else{
							?>
							<tr>
								<td>&nbsp;</td>
								<td colspan="2">
									<a href="<?php echo $row['link'] ?>" target="_blank" title="<?php echo JText::_('Open in new window') ?>"><?php echo JText::_('COM_EPAY_READ_TERMS'); ?></a>
								</td>
							</tr>
							<?php
							}
						}
						?>
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan="2">
								<input type="button" value="<?php echo JText::_('COM_EPAY_GO_TO_PAYMENT'); ?> &gt;" class="button" style="width: 200px;" onclick="startPayment();" />
							</td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top; padding-top: 20px; padding-right: 20px; text-align: right;">
					<span style="width:100%; float: left;" id="epay_card_logos">Cards</span>
                </td>
            </tr>
            <tr>
                <td style="padding: 20px;">
                    <table cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="vertical-align: top; padding-right: 20px;"><span style="height:49px;width:100%;float:left;" id="epay_logos">Logo</span></td>
                            <td style="vertical-align: top; font-size: 11px; color: #000000;">
                                <div style="padding-bottom: 8px; font-weight: bold;"><?php echo JText::_('COM_EPAY_SECURE_PAYMENT'); ?></div>
                                <?php echo JText::_('COM_EPAY_EPAY_PAYMENT_SOLUTIONS'); ?>
                            </td>  
                        </tr>
                    </table>
                </td>
            </tr>
        </table>  
	</form>
	<script type="text/javascript" src="https://relay.ditonlinebetalingssystem.dk/integration/paymentlogos/PaymentLogos.aspx?merchantnumber=<?php echo $this->params->get('epay_merchant') ?>&direction=1&padding=2&cols=1&logo=0&showdivs=0&divid=epay_card_logos"></script>
	<script type="text/javascript" src="https://relay.ditonlinebetalingssystem.dk/integration/paymentlogos/PaymentLogos.aspx?merchantnumber=<?php echo $this->params->get('epay_merchant') ?>&direction=1&padding=0&cols=1&logo=1&showdivs=0&showcards=0&enablelink=0&divid=epay_logos"></script>
<?php
}
?>