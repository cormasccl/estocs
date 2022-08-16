<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stock $stock
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Stock'), ['action' => 'edit', $stock->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Stock'), ['action' => 'delete', $stock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stock->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stocks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stocks Detail'), ['controller' => 'Details', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stocks Detail'), ['controller' => 'Details', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stocks view large-9 medium-8 columns content">
    <h3><?= h($stock->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Article') ?></th>
            <td><?= $stock->has('article') ? $this->Html->link($stock->article->name, ['controller' => 'Articles', 'action' => 'view', $stock->article->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($stock->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id') ?></th>
            <td><?= $this->Number->format($stock->user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($stock->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($stock->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Stocks Detail') ?></h4>
        <?php if (!empty($stock->Details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Stock Id') ?></th>
                <th scope="col"><?= __('Growing Id') ?></th>
                <th scope="col"><?= __('Flowering Id') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Unities') ?></th>
                <th scope="col"><?= __('Observations') ?></th>
                <th scope="col"><?= __('Published') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($stock->Details as $Details): ?>
            <tr>
                <td><?= h($Details->id) ?></td>
                <td><?= h($Details->stock_id) ?></td>
                <td><?= h($Details->growing_id) ?></td>
                <td><?= h($Details->flowering_id) ?></td>
                <td><?= h($Details->image) ?></td>
                <td><?= h($Details->unities) ?></td>
                <td><?= h($Details->observations) ?></td>
                <td><?= h($Details->published) ?></td>
                <td><?= h($Details->created) ?></td>
                <td><?= h($Details->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Details', 'action' => 'view', $Details->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Details', 'action' => 'edit', $Details->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Details', 'action' => 'delete', $Details->id], ['confirm' => __('Are you sure you want to delete # {0}?', $Details->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
