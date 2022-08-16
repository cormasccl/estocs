<div class="seasonCatalogues view">
<h2><?php echo __('Season Catalogue'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($seasonCatalogue['SeasonCatalogue']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($seasonCatalogue['SeasonCatalogue']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($seasonCatalogue['SeasonCatalogue']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transportation Included Price'); ?></dt>
		<dd>
			<?php echo h($seasonCatalogue['SeasonCatalogue']['transportation_included_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tariff'); ?></dt>
		<dd>
			<?php echo h($seasonCatalogue['SeasonCatalogue']['tariff']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($seasonCatalogue['SeasonCatalogue']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($seasonCatalogue['SeasonCatalogue']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Season Catalogue'), array('action' => 'edit', $seasonCatalogue['SeasonCatalogue']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Season Catalogue'), array('action' => 'delete', $seasonCatalogue['SeasonCatalogue']['id']), array(), __('Are you sure you want to delete # %s?', $seasonCatalogue['SeasonCatalogue']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Season Catalogues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Season Catalogue'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Catalogues'), array('controller' => 'catalogues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Catalogue'), array('controller' => 'catalogues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Season Catalogue Articles'), array('controller' => 'season_catalogue_articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Season Catalogue Article'), array('controller' => 'season_catalogue_articles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Season Catalogue Classifications'), array('controller' => 'season_catalogue_classifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Season Catalogue Classification'), array('controller' => 'season_catalogue_classifications', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Catalogues'); ?></h3>
	<?php if (!empty($seasonCatalogue['Catalogue'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Listname'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th><?php echo __('Transportation Included Price'); ?></th>
		<th><?php echo __('Tariff'); ?></th>
		<th><?php echo __('Textsup'); ?></th>
		<th><?php echo __('Reference'); ?></th>
		<th><?php echo __('Last Week'); ?></th>
		<th><?php echo __('Last Year'); ?></th>
		<th><?php echo __('Season Catalogue Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($seasonCatalogue['Catalogue'] as $catalogue): ?>
		<tr>
			<td><?php echo $catalogue['id']; ?></td>
			<td><?php echo $catalogue['code']; ?></td>
			<td><?php echo $catalogue['created']; ?></td>
			<td><?php echo $catalogue['modified']; ?></td>
			<td><?php echo $catalogue['listname']; ?></td>
			<td><?php echo $catalogue['language']; ?></td>
			<td><?php echo $catalogue['transportation_included_price']; ?></td>
			<td><?php echo $catalogue['tariff']; ?></td>
			<td><?php echo $catalogue['textsup']; ?></td>
			<td><?php echo $catalogue['reference']; ?></td>
			<td><?php echo $catalogue['last_week']; ?></td>
			<td><?php echo $catalogue['last_year']; ?></td>
			<td><?php echo $catalogue['season_catalogue_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'catalogues', 'action' => 'view', $catalogue['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'catalogues', 'action' => 'edit', $catalogue['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'catalogues', 'action' => 'delete', $catalogue['id']), array(), __('Are you sure you want to delete # %s?', $catalogue['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Catalogue'), array('controller' => 'catalogues', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Season Catalogue Articles'); ?></h3>
	<?php if (!empty($seasonCatalogue['SeasonCatalogueArticle'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Season Catalogue Id'); ?></th>
		<th><?php echo __('Article Id'); ?></th>
		<th><?php echo __('Season Catalogue Classification Id'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Motora'); ?></th>
		<th><?php echo __('Per Box'); ?></th>
		<th><?php echo __('Boxes Per Floor'); ?></th>
		<th><?php echo __('Carri Floor'); ?></th>
		<th><?php echo __('Show Unities'); ?></th>
		<th><?php echo __('Show Boxes'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($seasonCatalogue['SeasonCatalogueArticle'] as $seasonCatalogueArticle): ?>
		<tr>
			<td><?php echo $seasonCatalogueArticle['id']; ?></td>
			<td><?php echo $seasonCatalogueArticle['season_catalogue_id']; ?></td>
			<td><?php echo $seasonCatalogueArticle['article_id']; ?></td>
			<td><?php echo $seasonCatalogueArticle['season_catalogue_classification_id']; ?></td>
			<td><?php echo $seasonCatalogueArticle['price']; ?></td>
			<td><?php echo $seasonCatalogueArticle['motora']; ?></td>
			<td><?php echo $seasonCatalogueArticle['per_box']; ?></td>
			<td><?php echo $seasonCatalogueArticle['boxes_per_floor']; ?></td>
			<td><?php echo $seasonCatalogueArticle['carri_floor']; ?></td>
			<td><?php echo $seasonCatalogueArticle['show_unities']; ?></td>
			<td><?php echo $seasonCatalogueArticle['show_boxes']; ?></td>
			<td><?php echo $seasonCatalogueArticle['created']; ?></td>
			<td><?php echo $seasonCatalogueArticle['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'season_catalogue_articles', 'action' => 'view', $seasonCatalogueArticle['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'season_catalogue_articles', 'action' => 'edit', $seasonCatalogueArticle['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'season_catalogue_articles', 'action' => 'delete', $seasonCatalogueArticle['id']), array(), __('Are you sure you want to delete # %s?', $seasonCatalogueArticle['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Season Catalogue Article'), array('controller' => 'season_catalogue_articles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Season Catalogue Classifications'); ?></h3>
	<?php if (!empty($seasonCatalogue['SeasonCatalogueClassification'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Orden'); ?></th>
		<th><?php echo __('Season Catalogue Classification Id'); ?></th>
		<th><?php echo __('Season Catalogue Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($seasonCatalogue['SeasonCatalogueClassification'] as $seasonCatalogueClassification): ?>
		<tr>
			<td><?php echo $seasonCatalogueClassification['id']; ?></td>
			<td><?php echo $seasonCatalogueClassification['description']; ?></td>
			<td><?php echo $seasonCatalogueClassification['code']; ?></td>
			<td><?php echo $seasonCatalogueClassification['orden']; ?></td>
			<td><?php echo $seasonCatalogueClassification['season_catalogue_classification_id']; ?></td>
			<td><?php echo $seasonCatalogueClassification['season_catalogue_id']; ?></td>
			<td><?php echo $seasonCatalogueClassification['created']; ?></td>
			<td><?php echo $seasonCatalogueClassification['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'season_catalogue_classifications', 'action' => 'view', $seasonCatalogueClassification['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'season_catalogue_classifications', 'action' => 'edit', $seasonCatalogueClassification['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'season_catalogue_classifications', 'action' => 'delete', $seasonCatalogueClassification['id']), array(), __('Are you sure you want to delete # %s?', $seasonCatalogueClassification['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Season Catalogue Classification'), array('controller' => 'season_catalogue_classifications', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
