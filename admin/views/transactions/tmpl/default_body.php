<?php
/*
  Copyright (c) 2013. All rights reserved ePay - www.epay.dk.

  This program is free software. You are allowed to use the software but NOT allowed to modify the software. 
  It is also not legal to do any changes to the software and distribute it in your own name / brand. 
*/

defined('_JEXEC') or die('Restricted Access');
?>

<?php foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td align="center"> 
			<?php echo JHtml::_('grid.id', $i, $item->id); ?>
		</td>
		<td align="center">
			<img src="<?php echo JURI::root();?>administrator/components/com_epay/images/cards/<?php echo $item->cardid; ?>.png">
		</td>
		<td align="center">
			<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EPAY_PAYMENT_DETAILS' );?>::<?php echo $item->tid; ?>">
				<a href="<?php echo JRoute::_('index.php?option=com_epay&task=show&cid=' . $item->id); ?>">
					<?php echo $item->tid; ?>
				</a>
			</span>
		</td>
		<td class="order">
			<?php echo $item->orderid; ?>
		</td>
		<td align="center">
			<?php echo EPayHelper::epay_get_code($item->cur); ?>
		</td>
		<td align="center">
			<?php echo number_format($item->amount/100, 2, ',', '.'); ?>
		</td>
		<td align="center">
			<?php echo date("Y-m-d", strtotime($item->date)); ?> <?php echo date("H:i", strtotime($item->time)); ?>
		</td>
		<td align="center">
			<?php echo number_format($item->transfee/100, 2, ',', '.'); ?>
		</td>
		<td align="center">
				<?php
				if($item->fraud == 1){
					echo JText::_( 'Potential fraud' ); 
				}else{
					echo JText::_( 'No fraud detected' ); 
				}
				?>
		</td>
		<td align="center">
			<?php echo $item->id; ?>
		</td>
	</tr>
<?php endforeach; ?>