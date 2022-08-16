<script>
  /*var openFile = function(event) {
    var input = event.target;

    var reader = new FileReader();
    reader.onload = function(){
      var dataURL = reader.result;
      var output = document.getElementById('inputImatge');

     // console.log("output:");
      //console.log(output);


      console.log("dataURL:");
      console.log(dataURL);
      output.src = dataURL;

      //output.attr('width', '100px');

      document.getElementById('change_image').value = 'S';
    

    };
    reader.readAsDataURL(input.files[0]);
  };*/




var changeImage = function(event) {
    var input = event.target;

    var reader = new FileReader();
    reader.onload = function(){
    var dataURL = reader.result;


    var output = document.getElementById('imatge');
    output.src = dataURL;
    document.getElementById('change_image').value = 'S';


    document.getElementsByName('image')[0].value = input.files[0].name;
        


    };
    reader.readAsDataURL(input.files[0]);
  };


function changeUnities()
{

    estocDisponible = document.getElementById('DetailAvailableUnities').value;
    estocCompromes = document.getElementById('DetailReservedUnities').value;
    estocFisic = document.getElementById('DetailUnities').value;


    nouEstocDisponible = estocFisic - estocCompromes;

    
}

function checkUnities() 
{
    var elem = document.getElementById('DetailUnities');
    var estocFisic = Number(elem.value);
    var estocCompromes = Number(document.getElementById('DetailReservedUnities').value);


    var invalid = (estocFisic < estocCompromes);

    nouEstocDisponible = estocFisic - estocCompromes;
    document.getElementById('DetailAvailableUnities').value = nouEstocDisponible;
    document.getElementById('estocDisponible').value = nouEstocDisponible;

    

    if (invalid) {
        elem.setAttribute("aria-invalid", "true");
        document.getElementById("errorMessage").className="alert alert-danger";
        return false;
        //ºalert("L'estoc físic no pot ser inferior al estoc compromès");
    } else {
        elem.setAttribute("aria-invalid", "false");
        document.getElementById("errorMessage").className="alert alert-danger invisible";
        return true;
    }



    
}


function validateForm() {
    return checkUnities();
}

</script>



    <?php 

    $change_stock = ($this->request->data['Stock']['Partner']['change_stock'] == 1);


    $estocCompromes = $this->request->data['Detail']['reserved_unities'];
    $estocDisponible = $this->request->data['Detail']['available_unities'];

    echo $this->Form->create('Detail', array('onsubmit'=>'return validateForm()'));


    echo $this->Form->hidden('Stock.article_id');
    echo $this->Form->hidden('stock_id');
    echo $this->Form->hidden('id');
    echo $this->Form->hidden('image');
    echo $this->Form->hidden('unities_published');
    echo $this->Form->hidden('reserved_unities');
    echo $this->Form->hidden('available_unities');


    $stock_id = $this->request->data['Detail']['stock_id'];

     ?>


    <div class="col-md-12">
        <div class="form-group">
            <?php 
            echo $this->Form->input('Stock.Article.name',array('disabled'=>'disabled', 'class'=>'form-control','label'=>__('Artículo')));

            ?>

        </div>

        <div class="form-group">
            <?php 
            echo $this->Form->input('growing_id',array('disabled'=>'disabled', 'class'=>'form-control','label'=>__('Crecimiento')));
            ?>
        </div>
        <div class="form-group">
            <?php 
            echo $this->Form->input('flowering_id',array('disabled'=>'disabled', 'class'=>'form-control','label'=>__('Floración')));
            ?>
        </div> 

        <div class="form-group row">            
            <div class="col-xs-4">
                <?php 
                if  ($change_stock) {
                    echo $this->Form->input('unities',array('class'=>'form-control',
                        'label'=>__('Estoc <br />físico'), 
                        'aria-invalid'=>'false',
                        'onchange' => 'checkUnities();'));
                } else {
                    echo $this->Form->input('unities',array('class'=>'form-control',
                        'label'=>__('Estoc <br />físico'), 
                        'aria-invalid'=>'false',
                        'disabled'=>'true'));
                }
                
                ?>
            </div>
            <div class="col-xs-4">
                <label for="estocCompromes"><?=__('Estoc <br />comprometido');?></label>
                <input id="estocCompromes" disabled class="form-control" value="<?=$estocCompromes;?>">
            </div>
            <div class="col-xs-4">
               <label for="estocDisponible"><?=__('Estoc <br />disponible');?></label>
                <input id="estocDisponible" disabled class="form-control" value="<?=$estocDisponible;?>">
            </div>
        </div>



        <div id="errorMessage" class="alert alert-danger invisible">
            <?=__("El estoc disponible no puede ser negativo");?>
        </div>

        

        <div class="form-group">
           <label for="observations"><?=__('Observaciones');?></label>
           <?php 
            if  ($change_stock) {
                echo $this->Form->textarea('observations', ['rows' => '3', 'class' => 'form-control']);
                }
                else {
                    echo $this->Form->textarea('observations', ['rows' => '3', 'class' => 'form-control', 'disabled'=>'true']);
                }

            ?>
        </div>

        <!--<input id="inputSoci" type="hidden" name="inputSoci" value='"<?=$detall['soci'];?>"'>-->
        

        <div class="centre">
        <?php 
        if  ($change_stock) {
        echo $this->Form->button('<i class="fa fa-floppy-o" aria-hidden="true"></i> '.__('Guardar'), array('class'=>'btn btn-success btn-md'));
    }
         ?>
        </div>

    </div>
        
    <?= $this->Form->end() ?>




<div class="spacing"></div>


<div class="row">
    <div class="col-md-12 col-xs-12">
        <a href="<?=SERVER;?>Details/index/<?=$stock_id;?>" class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> <?=__('Volver');?> </a>
    </div>    
</div>
