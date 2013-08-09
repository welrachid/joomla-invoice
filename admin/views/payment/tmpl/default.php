<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die('Restricted Access');
JHtml::_('behavior.tooltip');
?>

<div style="float: left; width: 60%;">
	<fieldset class="adminform">	
		<legend><?php echo JText::_( 'COM_EPAY_PAYMENT' ); ?></legend>
		<table class="admintable">
			<tr>
				<td class="key">
					<?php echo JText::_( 'COM_EPAY_TRANSACTION_ID' ); ?>:
				</td>
				<td>
					<?php echo $this->item['tid']; ?>
				</td>
			</tr>
			<tr>
				<td class="key">
						<?php echo JText::_( 'COM_EPAY_INVOICE' ); ?>:
				</td>
				<td>
					<?php echo $this->item['orderid']; ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_( 'COM_EPAY_AMOUNT' ); ?>:
				</td>
				<td >
					<?php echo EPayHelper::epay_get_code($this->item['cur']); ?> <?php echo number_format($this->item['amount']/100, 2, ',', '.'); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_( 'COM_EPAY_CARD' ); ?>:
				</td>
				<td>
					<?php echo $this->item['cardnopostfix']; ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_( 'COM_EPAY_DATE_TIME' ); ?>:
				</td>
				<td >
					<?php echo date("Y-m-d", strtotime($this->item['date'])); ?> <?php echo date("H:i", strtotime($this->item['time'])); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_( 'COM_EPAY_TRANSACTION_FEE' ); ?>:
				</td>
				<td >
					<?php echo EPayHelper::epay_get_code($this->item['cur']); ?> <?php echo number_format($this->item['transfee']/100, 2, ',', '.'); ?>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'COM_EPAY_CUSTOMER_INFO' ); ?></legend>
		<table class="admintable">
			<tr>
				<td class="key">
					<?php echo JText::_( 'COM_EPAY_EMAIL' ); ?>:
				</td>
				<td>	
					<?php echo $this->item['email']; ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_( 'COM_EPAY_NAME' ); ?>:
				</td>
				<td>	
					<?php echo $this->item['name']; ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_( 'COM_EPAY_ADDRESS' ); ?>:
				</td>
				<td>	
					<?php echo str_replace("\n", "<br>", $this->item['address']); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_( 'COM_EPAY_COUNTRY' ); ?>:
				</td>
				<td>	
					<?php echo $this->item['country']; ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_( 'COM_EPAY_PHONE' ); ?>:
				</td>
				<td>	
					<?php echo $this->item['phone']; ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_( 'COM_EPAY_COMMENT' ); ?>:
				</td>
				<td>	
					<?php echo str_replace("\n", "<br>", $this->item['comment']); ?>
				</td>
			</tr>
		</table>
	</fieldset>
	<form name="adminForm">
		<input type="hidden" checked="true" name="boxchecked">
		<input type="hidden" id="cb0" name="cid[]" value="1" checked="true" />	
		<input type="hidden" name="option" value="com_epay" />
		<input type="hidden" name="task" value="back" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="epay.tid" />
		<input type="hidden" name="filter_order_Dir" value="desc" />
	</form>		
</div>

	<?php
	if($this->params->get('epay_useapi') == 1)
	{
	?>
	<div style="float: left; width: 40%;">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'COM_EPAY_PAYMENT_DETAILS' ); ?></legend>
		<?php
		$paymentdetails = EPayHelper::getTransaction($this->params->get('epay_merchant'), $this->item['tid']);
		?>
		<table class="admintable">
		<tr>
			<td class="key">
				<?php echo JText::_( 'COM_EPAY_STATUS' ); ?>:
			</td>
			<td>	
				<?php echo JText::_('COM_EPAY_'.$paymentdetails->transactionInformation->status); ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'COM_EPAY_ACQUIRER' ); ?>:
			</td>
			<td>	
				<?php echo $paymentdetails->transactionInformation->acquirer; ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'COM_EPAY_CURRENCY' ); ?>:
			</td>
			<td>	
				<?php echo $paymentdetails->transactionInformation->currency; ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Splitpayment' ); ?>:
			</td>
			<td>	
				<?php echo JText::_($paymentdetails->transactionInformation->splitpayment); ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'COM_EPAY_COMMENT' ); ?>:
			</td>
			<td>	
				<?php echo $paymentdetails->transactionInformation->description; ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'COM_EPAY_CARDHOLDER' ); ?>:
			</td>
			<td>	
				<?php echo $paymentdetails->transactionInformation->cardholder; ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'COM_EPAY_AUTH_AMOUNT' ); ?>:
			</td>
			<td>	
				<?php echo EPayHelper::epay_get_code($this->item['cur']); ?> <?php echo number_format(($paymentdetails->transactionInformation->authamount)/100, 2, ',', '.');?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'COM_EPAY_CAPTURED_AMOUNT' ); ?>:
			</td>
			<td>	
				<?php echo EPayHelper::epay_get_code($this->item['cur']); ?> <?php echo number_format(($paymentdetails->transactionInformation->capturedamount)/100, 2, ',', '.');?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'COM_EPAY_CREDITED_AMOUNT' ); ?>:
			</td>
			<td>	
				<?php echo EPayHelper::epay_get_code($this->item['cur']); ?> <?php echo number_format(($paymentdetails->transactionInformation->creditedamount)/100, 2, ',', '.');?>
			</td>
		</tr>
		</table>
	</fieldset>
	<script type="text/javascript">
		var blnMinorUnit = 0;
		
		function goPayment(type){
			
			var objForm = document.getElementById("ePay");
			var objAmount = objForm.useramount;
			var amount = trimString(objAmount.value)
		
			if(blnMinorUnit == "0")
			amount = parseInt(amount) * 100;
			
				objForm.amount.value = amount;
					
			objForm.type.value = type;
			
			objForm.submit();
		}
		
		function trimString(str)
		{
			blnMinorUnit = 0;
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
						blnMinorUnit = 1;	
				}
			}	
			
			return returnVal;
		}
	</script>
	<form id="ePay" name="ePay" method="GET" action="index.php">
		<input type="hidden" name="type">
		<input type="hidden" name="cid" value="<?php echo $this->item['id']; ?>">
		<input type="hidden" name="amount">
		<input type="hidden" name="option" value="com_epay">  
		<input type="hidden" name="task" value="handleorder">  
		
		<?php
		//print_r($paymentdetails['transactionInformation']);
		if($paymentdetails->transactionInformation->deleteddate == "0001-01-01T00:00:00")
		{
		?>
		<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_EPAY_HANDLE_ORDER' ); ?></legend>
			<table class="admintable">
				<tr>
					<td class="key">
						<label for="amount">
							<?php echo JText::_( 'COM_EPAY_AMOUNT' ); ?>:
						</label>
					</td>
					<td >	
						<?php echo EPayHelper::epay_get_code($this->item['cur']); ?> <input type="text" name="useramount" value="<?php echo number_format(($this->item['transfee']+$this->item['amount'])/100, 2, ',', '.'); ?>">
					</td>
				</tr>
				<tr>
					<td class="key">
						<?php echo JText::_( 'COM_EPAY_ACTION' ); ?>:
					</td>
					<td>
						<div class="toolbar" id="toolbar">
							<table class="toolbar">
								<tr>
									<?php
									if($paymentdetails->transactionInformation->capturedamount == 0 or ($paymentdetails->transactionInformation->authamount > $paymentdetails->transactionInformation->capturedamount and $paymentdetails->transactionInformation->splitpayment == true))
									{
									?>
										<td class="button" id="toolbar-apply">
											<a href="#" onclick="goPayment('capture')" class="toolbar">
												<span class="icon-32-apply" title="Capture">
												</span>
												<?php echo JText::_('COM_EPAY_CAPTURE'); ?>
											</a>
										</td>
									<?php
									}
									?>

									<?php
									if($paymentdetails->transactionInformation->capturedamount > 0 and $paymentdetails->transactionInformation->creditedamount == 0)
									{
									?>	
										<td class="button" id="toolbar-back">
										<a href="#" onclick="goPayment('credit')" class="toolbar">
										<span class="icon-32-back" title="Credit">
										</span>
											<?php echo JText::_( 'COM_EPAY_CREDIT' ); ?>
										</a>
										</td>
									<?php
									}
									?>
						
									<?php 
									if($paymentdetails->transactionInformation->capturedamount == 0)
									{
									?>
										<td class="button" id="toolbar-delete">
											<a href="#" onclick="goPayment('delete')" class="toolbar">
												<span class="icon-32-delete" title="Delete">
												</span>
												<?php echo JText::_( 'COM_EPAY_DELETE' ); ?>
											</a>
										</td>
									<?php
									}
									?>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
	<?php
	}
	?>
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'COM_EPAY_PAYMENT_HISTORY' ); ?></legend>
		<?php
		$history = $paymentdetails->transactionInformation->history->TransactionHistoryInfo;
		if(!array_key_exists(0, $history))
			$history = array($history);
		?>
		<table class="admintable">
		<?php
		if(is_array($history))
		{
			asort($history);
			foreach($history as $value)
			{
			?>
				<tr>
					<td class="key">
						<?php echo date("Y-m-d H:i", strtotime($value->created)); ?>:
					</td>
					<td>	
						<?php echo $value->eventMsg; ?>
					</td>
				</tr>
			<?php
			}
		}
		?>
		</table>
	</fieldset>
</div>

<?php
}