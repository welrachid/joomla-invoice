<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die('Restricted Access');
?>
<tr>
	<th width="10" class="title">
		<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
	</th>
	<th class="title">
		<?php echo JHTML::_('grid.sort',   'COM_EPAY_CARD', 'cardid', $this->sortDirection, $this->sortColumn); ?>
	</th>
	<th class="title">
		<?php echo JHTML::_('grid.sort',   'COM_EPAY_TRANSACTION_ID', 'tid', $this->sortDirection, $this->sortColumn); ?>
	</th>
	<th class="title" nowrap="nowrap">
		<?php echo JHTML::_('grid.sort',   'COM_EPAY_INVOICE', 'orderid', $this->sortDirection, $this->sortColumn); ?>
	</th>
	<th class="title" nowrap="nowrap">
		<?php echo JHTML::_('grid.sort',   'COM_EPAY_CURRENCY', 'cur', $this->sortDirection, $this->sortColumn); ?>
	</th>
	<th class="title" nowrap="nowrap">
		<?php echo JHTML::_('grid.sort',   'COM_EPAY_AMOUNT', 'amount', $this->sortDirection, $this->sortColumn); ?>
	</th>
	<th class="title" nowrap="nowrap">
		<?php echo JHTML::_('grid.sort',   'COM_EPAY_DATE_TIME', 'time', $this->sortDirection, $this->sortColumn); ?>
	</th>
	<th class="title" nowrap="nowrap">
		<?php echo JHTML::_('grid.sort',   'COM_EPAY_TRANSACTION_FEE', 'transfee', $this->sortDirection, $this->sortColumn); ?>
	</th>
	<th class="title" nowrap="nowrap">
		<?php echo JHTML::_('grid.sort',   'COM_EPAY_FRAUD', 'fraud', $this->sortDirection, $this->sortColumn); ?>
	</th>
	<th nowrap="nowrap">
		<?php echo JHTML::_('grid.sort',   'ID', 'id', $this->sortDirection, $this->sortColumn); ?>
	</th>
</tr>