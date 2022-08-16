<div class="imagesQualities view">
<h2><?php echo __('Images Quality'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($imagesQuality['ImagesQuality']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article'); ?></dt>
		<dd>
			<?php echo $this->Html->link($imagesQuality['Article']['name'], array('controller' => 'articles', 'action' => 'view', $imagesQuality['Article']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Growing'); ?></dt>
		<dd>
			<?php echo $this->Html->link($imagesQuality['Growing']['name'], array('controller' => 'growings', 'action' => 'view', $imagesQuality['Growing']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flowering'); ?></dt>
		<dd>
			<?php echo $this->Html->link($imagesQuality['Flowering']['name'], array('controller' => 'flowerings', 'action' => 'view', $imagesQuality['Flowering']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($imagesQuality['ImagesQuality']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($imagesQuality['ImagesQuality']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($imagesQuality['ImagesQuality']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Images Quality'), array('action' => 'edit', $imagesQuality['ImagesQuality']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Images Quality'), array('action' => 'delete', $imagesQuality['ImagesQuality']['id']), array(), __('Are you sure you want to delete # %s?', $imagesQuality['ImagesQuality']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Images Qualities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Images Quality'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Growings'), array('controller' => 'growings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Growing'), array('controller' => 'growings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Flowerings'), array('controller' => 'flowerings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Flowering'), array('controller' => 'flowerings', 'action' => 'add')); ?> </li>
	</ul>
</div>
