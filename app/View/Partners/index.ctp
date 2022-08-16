


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?=SERVER;?>partners/add" class="btn btn-primary">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> <?=__('Añadir almacén');?></a>
                    </div>
                </div>
            </div>

            <hr />

            <div class="x_content">


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="headings">
                                <th class="column-title"><?= $this->Paginator->sort('id') ?></th>
                                <th class="column-title"><?= $this->Paginator->sort('code', 'Código') ?></th>
                                <th class="column-title"><?= $this->Paginator->sort('name', 'Nombre') ?></th>
                                <th class="column-title"><?= $this->Paginator->sort('change_stock', 'Modificar estoc') ?></th>
                                <th class="column-title actions"><?= __('Actions', 'Acciones') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($partners as $partner): ?>
                            <tr  class="odd pointer">
                                <td><?= $this->Number->format($partner['Partner']['id']) ?></td>
                                <td><?= h($partner['Partner']['code']) ?></td>
                                <td><?= h($partner['Partner']['name']) ?></td>
                                <td><?= h($partner['Partner']['change_stock']) ?></td>
                                

                                <td class="actions">
                                    <?= $this->Html->link(__("<i class='fa fa-edit'></i>"), ['action' => 'edit', $partner['Partner']['id']], ['escape' => false]); ?>
                                    <?= $this->Html->link(__("<i class='fa fa-trash-o'></i>"), ['action' => 'delete', $partner['Partner']['id']], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $partner['Partner']['id'])]); ?>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
