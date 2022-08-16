<div class="imagesQualities index">
	<h2><?php echo __('Images Qualities'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('article_id'); ?></th>
			<th><?php echo $this->Paginator->sort('growing_id'); ?></th>
			<th><?php echo $this->Paginator->sort('flowering_id'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($imagesQualities as $imagesQuality): ?>
	<tr>
		<td><?php echo h($imagesQuality['ImagesQuality']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($imagesQuality['Article']['name'], array('controller' => 'articles', 'action' => 'view', $imagesQuality['Article']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($imagesQuality['Growing']['name'], array('controller' => 'growings', 'action' => 'view', $imagesQuality['Growing']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($imagesQuality['Flowering']['name'], array('controller' => 'flowerings', 'action' => 'view', $imagesQuality['Flowering']['id'])); ?>
		</td>
		<td><?php echo h($imagesQuality['ImagesQuality']['image']); ?>&nbsp;</td>
		<td><?php echo h($imagesQuality['ImagesQuality']['created']); ?>&nbsp;</td>
		<td><?php echo h($imagesQuality['ImagesQuality']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $imagesQuality['ImagesQuality']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $imagesQuality['ImagesQuality']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $imagesQuality['ImagesQuality']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $imagesQuality['ImagesQuality']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Images Quality'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Growings'), array('controller' => 'growings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Growing'), array('controller' => 'growings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Flowerings'), array('controller' => 'flowerings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Flowering'), array('controller' => 'flowerings', 'action' => 'add')); ?> </li>
	</ul>
</div>
