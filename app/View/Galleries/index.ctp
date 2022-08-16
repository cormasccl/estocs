

<script>

//var validaImatge = function(event) {
    

function validaImatge(f) {

    var canviada = f.elements['change_image'];

    console.log(canviada);

    if (canviada.value == "N") {
        return false;
    }
    $('#spinner').removeClass('invisible');
    $('#btnEnviar').attr("disabled","disabled");
    return true;
};


var changeImage = function(event) {
	console.log("entro");
    var input = event.target;



    var reader = new FileReader();
    reader.onload = function(){
    var dataURL = reader.result;


    var output = document.getElementById('imatge');
    output.src = dataURL;
    document.getElementById('change_image').value = 'S';

    //console.log(input.files[0]['name']);
    document.getElementsByName('imatge')[0].value = input.files[0]['name'];
        


    };
    reader.readAsDataURL(input.files[0]);
  };

</script>


<?php 


$article = $detail['Article']['name'];
$creixement = $detail['Growing']['Creixement'];

$floracio = $detail['Flowering']['Floracio'];


if ($creixement == '-') {
    $titol = $article;
} else {
    $titol = $article.' ('.$creixement.' - '.$floracio.' ) ';
}




?>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <p class="titol_article"><?php echo $titol;?></p>
    </div>
</div>

<div class="spacing"></div>



<?php 


echo "<div class='row'>";


foreach ($Galleries as $gallery) 
{

	$valor = $gallery['Gallery'];
	
	
    if ($valor['image_uploaded'] == 1) {
        $image = 'https://www.corma.es/articles/'.$valor['image'];
        $imageThumbs = 'https://www.corma.es/articles/thumbs/'.$valor['image'];
    } else {
        $image = SERVER . 'uploads/'.$valor['image'];
        $imageThumbs = $image;
    }

    ?>

    <div class="col-xs-12 col-md-4">
        <div class="row thumbnail <?php if ($valor['principal'] == 1) echo 'principal';?>">
            <div class='col-xs-2'>
                <?php if ($valor['quality'] == 1) { ?>
                <span class="dept_qualitat">
                   <i class="star_quality fa fa-star" aria-hidden="true"></i> <strong><?=__('Dep. Calidad');?></strong>
                </span>
                
                <?php } ?>
            </div>
            <div class="col-xs-8">
                <a href="<?=$image;?>" data-fancybox="images">
                    <img src="<?=$imageThumbs;?>" style="height:150px" />
                </a> 
                <div class="caption" style="text-align:center">
                    <?php
                    if ($valor['principal'] == 0) {       
                        echo "<p><a href='".SERVER."Galleries/principal/".$valor['id']."' class='btn btn-success' role='button'><i class='fa fa-thumb-tack' aria-hidden='true'></i></a>";
                        if ($valor['quality'] == 0 ) {
                            echo " <a href='".SERVER."Galleries/delete/".$valor['id']."' class='btn btn-default' role='button' onclick='return confirm(\"'.__('Estas seguro').'?\");'><i class='fa fa-trash' aria-hidden='true'></i></a></p>";
                        }
                    } else {
                        //echo "          <p class='btn_principal'><i class='fa fa-thumb-tack' aria-hidden='true'></i> Principal";
                        echo "          <p><a href='".SERVER."Galleries/principal/".$valor['id']."' class='btn btn-default disabled' role='button'><i class='fa fa-thumb-tack' aria-hidden='true'></i> Principal</a>";
                        if ($valor['quality'] == 0 ) {
                            echo " <a href='".SERVER."Galleries/delete/".$valor['id']."' class='btn btn-default' role='button' onclick='return confirm(\"Estas segur?\");'><i class='fa fa-trash' aria-hidden='true'></i></a></p>";
                        } 
                    }
                    ?>
                </div>
            </div>
            <div class="col-xs-2"></div>
        </div>
    </div>


<?php
}

?>



    <div class="col-xs-12 col-md-4">
        <div class="row thumbnail">
            <div class="spinner invisible" id="spinner">
                <img src="/intranet/img/Spinner-1s-200px.gif" width="150px" >
            </div>



            <img id="imatge" name="imatge" src="https://www.corma.es/articles/no_foto.jpg" style="height:150px" />

            <div class="caption" style="text-align:center">
                
                <?php

                echo $this->Form->create('Gallery', ['enctype' => 'multipart/form-data', 'url'=>SERVER.'Galleries/add', 'onsubmit'=>'return validaImatge(this);']);
                echo $this->Form->hidden('id');
                echo $this->Form->hidden('detail_id',array('value'=>$detail_id));
                echo $this->Form->hidden('image_published');
                echo $this->Form->hidden('image_uploaded');
                echo $this->Form->hidden('principal', array('value'=>0));
                echo $this->Form->hidden('change_image',array('value' => 'N', 'id'=>'change_image'));

                ?>
                <p class="btn btn-file">
                    <label for="select_image"><?=__('Selecciona una imagen ... ');?></label>
                    <input type="file" name="select_image" id="select_image" class="btn btn-default" onchange="changeImage(event)" accept="image/*">
                </p>


                <?php
                echo $this->Form->button('<i class="fa fa-floppy-o" aria-hidden="true"></i>', array('id'=>'btnEnviar','class'=>'btn btn-success'));
                echo $this->Form->end();
                ?>

            </div>
        </div>
    </div>        
    
</div>

<div class="spacing"></div>
<div class="row">
    <div class="col-md-6 col-xs-6">
        <a href="<?=SERVER;?>Details/index/<?=$detail['Stock']['id'];?>" class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> <?=__('Volver');?></a>
    </div>
    
    
    
</div>




<script>

$('[data-fancybox="images"]').fancybox({
        toolbar : true,     
        buttons : [
            'slideShow',
            'fullScreen',
            'thumbs',
            'share',
            'download',
            'zoom',
            'close'
        ],
        infobar : true,
        animationEffect : "zoom"
});




</script>