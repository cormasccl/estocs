<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="page-header"><?= __('Editar socio / almacén') ?></h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <?php echo $this->Form->create('Partner'); ?>

                <?php
                        echo $this->Form->hidden('id'); 
                    ?>

                <div class="form-group">
                    <?php
                    echo $this->Form->input('code', array('class'=>'form-control','label'=>__('Código'), 'required'=>'true')); 
                    ?>
                </div>
                <div class="form-group">
                    <?php
                        echo $this->Form->input('name', array('class'=>'form-control','label'=>__('Nombre'), 'required'=>'true'));
                    ?>
                </div>
                <?= $this->Form->button('<i class="fa fa-floppy-o" aria-hidden="true"></i> '.__('Guardar'), array('class'=>'btn btn-primary')) ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
