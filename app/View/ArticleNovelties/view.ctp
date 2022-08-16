<div class="articleNovelties view">
<h2><?php echo __('Article Novelty'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($articleNovelty['ArticleNovelty']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($articleNovelty['ArticleNovelty']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($articleNovelty['ArticleNovelty']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article'); ?></dt>
		<dd>
			<?php echo $this->Html->link($articleNovelty['Article']['name'], array('controller' => 'articles', 'action' => 'view', $articleNovelty['Article']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($articleNovelty['ArticleNovelty']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($articleNovelty['ArticleNovelty']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Article Novelty'), array('action' => 'edit', $articleNovelty['ArticleNovelty']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Article Novelty'), array('action' => 'delete', $articleNovelty['ArticleNovelty']['id']), array(), __('Are you sure you want to delete # %s?', $articleNovelty['ArticleNovelty']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Article Novelties'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article Novelty'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
	</ul>
</div>
