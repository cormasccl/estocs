<div class="articleNovelties form">
<?php echo $this->Form->create('ArticleNovelty'); ?>
	<fieldset>
		<legend><?php echo __('Edit Article Novelty'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('article_id');
		echo $this->Form->input('active');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ArticleNovelty.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ArticleNovelty.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Article Novelties'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
	</ul>
</div>
