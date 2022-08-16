<div class="seasonCatalogues form">
<?php echo $this->Form->create('SeasonCatalogue'); ?>
	<fieldset>
		<legend><?php echo __('Edit Season Catalogue'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('description');
		echo $this->Form->input('code');
		echo $this->Form->input('transportation_included_price');
		echo $this->Form->input('tariff');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SeasonCatalogue.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('SeasonCatalogue.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Season Catalogues'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Catalogues'), array('controller' => 'catalogues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Catalogue'), array('controller' => 'catalogues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Season Catalogue Articles'), array('controller' => 'season_catalogue_articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Season Catalogue Article'), array('controller' => 'season_catalogue_articles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Season Catalogue Classifications'), array('controller' => 'season_catalogue_classifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Season Catalogue Classification'), array('controller' => 'season_catalogue_classifications', 'action' => 'add')); ?> </li>
	</ul>
</div>
