<script language="javascript">

    function imageDefault(imageId) {

        var imgSeleccionar = document.getElementById('img'+imageId);


        var seleccionats = document.getElementsByClassName("img-qualitat-selected");


        if (seleccionats.length > 0) {
            for (var i = 0; i < seleccionats.length; i+=1) {
              seleccionats[i].className="img-qualitat img-thumbnail";
            }
        }

        imgSeleccionar.className="img-qualitat img-thumbnail img-qualitat-selected";



        //document.getElementById('ImagesQualityImatgeQualitat').value = imageId;

        document.getElementById('ImagesQualityGrowingId').value = document.getElementById('growing'+imageId).value;
        document.getElementById('ImagesQualityFloweringId').value = document.getElementById('flowering'+imageId).value;
        
    }



function validaImatge(f) {

    var canviada = f.elements['change_image'];

    console.log(canviada);


    if (canviada.value == "N") {
        return false;
    }

    return true;
};


var changeImage = function(event) {

    //document.getElementById('ImagesQualityImatgeQualitat').value = null;

    var input = event.target;



    var reader = new FileReader();
    reader.onload = function(){
    var dataURL = reader.result;


    var output = document.getElementById('imatge');

    //console.log(dataUrl);
    output.src = dataURL;
    document.getElementById('change_image').value = 'S';

    console.log(input.files[0]['name']);
    document.getElementsByName('imatge')[0].value = input.files[0]['name'];
        


    };
    reader.readAsDataURL(input.files[0]);
  };

</script>

<?php



echo $this->Form->create('ImagesQuality', ['enctype' => 'multipart/form-data', 'onsubmit'=>'return validaImatge(this);']);
?>

<div class="row">

        <div class="col-md-12">
        <?php


        echo $this->Form->hidden('id');
        echo $this->Form->hidden('article_id', array('value'=>$article_id));
        
      
        ?>



            <div class="col-md-6 col-sm-6 col-xs-12">

                <?php if (count($imgQuality) > 0) { ?>
                    <div class="row box_images">
                        <p style="text-align: center"><strong>Imatges actuals</strong></p>

                        <br />
                        <?php


                        foreach ($imgQuality as $imgQ) {
                        	
                        	if ($imgQ['ImagesQuality']['upload'] == 0) {
       							$url = "https://www.corma.es/intranet/img/articles/thumbs/";
                            	$imatge = $url.'thumbs/'.$imgQ['ImagesQuality']['image'];
						    } else {
						        $url = SERVER . 'uploads/';
						        $imatge = $url.$imgQ['ImagesQuality']['image'];
						    }




                            
                            echo "<div class='col-md-3 col-sm-6 col-xs-6'>";
                            $id = $imgQ['ImagesQuality']['id'];

                            echo "<img id = 'img".$id."' onclick ='javascript:imageDefault(".$id.");' src='".$url.$imgQ['ImagesQuality']['image']."' class='img-qualitat img-thumbnail'>";
                            echo "<p class='titol-qualitat'>".$imgQ['Growing']['code'].' - '.$imgQ['Flowering']['code']."</p>";

                            echo "</div>";


                            echo "<input type='hidden' id='growing".$id."' value='".$imgQ['ImagesQuality']['growing_id']."'>";
                            echo "<input type='hidden' id='flowering".$id."' value='".$imgQ['ImagesQuality']['flowering_id']."'>";

                

                        }

                        ?>                
                    </div>

                <?php } ?>

                <div class="row box_images">

                    <p style="text-align: center"><strong>Afegeix una nova imatge</strong></p>

                    <br />

                    <p style="text-align: center">
                        <img id="imatge" name="imatge" src="https://www.corma.es/intranet/img/articles/no_foto.jpg" style="height:150px" />
                    </p>

                    <div class="caption" style="text-align:center">
                        
                        <?php

                        echo $this->Form->hidden('id');
                        echo $this->Form->hidden('image_uploaded');
                        echo $this->Form->hidden('change_image',array('value' => 'N', 'id'=>'change_image'));

                        ?>
                        <p class="btn btn-file">
                            <label for="select_image">Selecciona una imatge ... </label>
                            <input type="file" name="select_image" id="select_image" class="btn btn-default" onchange="changeImage(event)" accept="image/*">
                        </p>


                    
                    </div>
                </div>
            </div>



            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <?php 

                    echo $this->Form->input('article_name',array('disabled'=>'disabled', 'class'=>'form-control','value'=>$article_name,'label'=>__('Artículo')));

                    ?>
                </div>

                <div class="form-group">
                    <?php 
                    echo $this->Form->input('growing_id',array( 'class'=>'form-control','label'=>__('Crecimiento')));

                    ?>
                </div>



                <div class="form-group">
                    <?php 
                    echo $this->Form->input('flowering_id',array( 'class'=>'form-control','label'=>__('Floración')));
                    
                    ?>
                </div> 
                              
            </div>

        </div>
    </div>

    <div class="row">

        <div class="col-md-6 col-sm-6 col-xs-6">
            <a href="<?=SERVER;?>ImagesQualities/show/<?=$article_id;?>" class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> <?=__('Volver');?> </a>
        </div>  

        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right">
            <?= $this->Form->button('<i class="fa fa-floppy-o" aria-hidden="true"></i> '.__('Guardar'), array('class'=>'btn btn-success btn-md')) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>