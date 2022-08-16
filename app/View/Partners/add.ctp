<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <div class="x_content">
                <?php echo $this->Form->create('Partner'); ?>

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
                <div class="form-group">
                    <?php

                    $valors = array(0 => 'No', 1 => 'Si');





                        echo $this->Form->input('change_stock', array('options' => $valors,'class'=>'form-control','label'=>__('Modificar estoc'), 'required'=>'true'));
                    ?>
                </div>
                <?= $this->Form->button('<i class="fa fa-floppy-o" aria-hidden="true"></i> '.__('Guardar'), array('class'=>'btn btn-primary')) ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>




