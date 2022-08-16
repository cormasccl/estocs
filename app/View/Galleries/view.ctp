<div class="galleries view">
<h2><?php echo __('Gallery'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Detail'); ?></dt>
		<dd>
			<?php echo $this->Html->link($gallery['Detail']['id'], array('controller' => 'details', 'action' => 'view', $gallery['Detail']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Principal'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['principal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image Published'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['image_published']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Gallery'), array('action' => 'edit', $gallery['Gallery']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Gallery'), array('action' => 'delete', $gallery['Gallery']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $gallery['Gallery']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Galleries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gallery'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Details'), array('controller' => 'details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detail'), array('controller' => 'details', 'action' => 'add')); ?> </li>
	</ul>
</div>
