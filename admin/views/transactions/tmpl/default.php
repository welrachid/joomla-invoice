<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die('Restricted Access');
JHtml::_('behavior.tooltip');
?>

<form action="<?php echo JRoute::_('index.php?option=com_epay'); ?>" method="post" name="adminForm" id="adminForm">
    <table class="adminlist" width="100%">
        <thead><?php echo $this->loadTemplate('head');?></thead>
        <tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
        <tbody><?php echo $this->loadTemplate('body');?></tbody>
    </table>
	<div>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="boxchecked" value="0">
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>">
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>">
</form>