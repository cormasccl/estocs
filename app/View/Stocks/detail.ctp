



<div class="row">
    <div class="col-md-12 col-xs-12">
        <p class="titol_article"><?php echo $titol;?></p>
        <?php if ($filter_by == 1 ) { ?>
        <p class="titol_preu"><?php echo $preu_article;?></p>
        <?php } ?>
    </div>
</div>

<div class="spacing"></div>





<?php

//SELECCIÓ PER ARTICLE
if ($filter_by == 1 ) {
	
	$sociAnterior = '0';

	foreach ($datos as $img) {



		if ( $sociAnterior != $img['Partners']['code']) {
			
			if ($sociAnterior != '0')
				echo '</div>';



			echo "<div class='row'><div class='col-md-12 row_title'>";
			echo $img['Partners']['name'];
			echo "</div></div>";
			echo "<div class='row'>";

		} 

		if ($img['Galleries']['image_uploaded'] == 1) {
	        $image = 'https://www.corma.es/articles/'.$img['Galleries']['image'];
	        $imageThumbs = 'https://www.corma.es/articles/thumbs/'.$img['Galleries']['image'];
	    } else {
	        $image = SERVER . 'uploads/'.$img['Galleries']['image'];
	        $imageThumbs = $image;
	    }

	    if (!isset($img['Galleries']['image'])) {
	    	$image = 'https://www.corma.es/articles/no_foto.jpg';
	    	$imageThumbs = $image;
	    }

		echo '<div class="col-xs-12 col-md-3">';
	    echo '	<div class="row thumbnail">';
	    echo '		<div class="col-xs-12">';
	$caption = $titol;
	if ($img['Growings']['Creixement'] != '-') {
		$caption .= " (".$img['Growings']['Creixement']." - ".$img['Flowerings']['Floracio'].") ";
	}


	    echo '			<a href="'.$image.'" data-caption = "'.$caption.'" data-fancybox="images">';
	    echo '				<img src="'.$imageThumbs.'" style="height:150px" />';
	    echo '			</a>'; 
	    echo '			<div class="caption" style="text-align:center">';
	    if ($img['Details']['stock_reserved'] == 1) { $stock_reserved = ' (RESERVA)';} else {$stock_reserved ='';}

	    if ($img['Growings']['Creixement'] != '-') {
	    	echo '			<p>'.$img['Growings']['Creixement'].' - '.$img['Flowerings']['Floracio'].$stock_reserved.'</p>';    
	    }
	    echo '				<p>'.__('Estoc disponible').': '.$img['Details']['available_unities'].'</p>';
	    echo '			</div>';
		echo '		</div>';
		echo '	</div>';
		echo '</div>';

		//echo "<div class='col-md-3'>".


		$sociAnterior = $img['Partners']['code'];		

	}

	

} else {


	?>


	<nav class="navbar navbar-default">
    <div class="container-fluid">
        <?php
        echo $this->Form->create('Stocks', array('type'=>'get','class'=>'navbar-form navbar-left'));
        ?>
            <div class="form-group">
                <label for="StocksFilterName"></label>
                <input name="data[Stocks][filter_name]" placeholder="<?=__('Buscar');?>..." class="form-control" type="text" id="StocksFilterName" value="<?=$filter_name;?>">
            
                <label for="StocksFilterStock"></label>
                <select name="data[Stocks][filter_stock]" class="form-control" id="StocksFilterStock">
                <option value="T" <?php if ($filter_stock == "T") {echo "selected";}?>><?=__('Todos los artículos');?></option>
                <option value="S" <?php if ($filter_stock == "S") {echo "selected";}?>><?=__('Artículos con estoc');?></option>
                <option value="N" <?php if ($filter_stock == "N") {echo "selected";}?>><?=__('Artículos sin estoc');?></option>
                </select>
                 
            </div>
            <button type="submit" class="btn btn-default"><?=__('Buscar');?></button>
            <?php 
            
                echo $this->Form->end();
            ?>

    </div>
</nav>

<?php


	//SELECCIÓ PER SOCI

	$articleAnterior = "0";

	

	foreach ($datos as $img) {


		if ( $articleAnterior != $img['Articles']['id']) {
			
			if ($articleAnterior != 0)
				echo '</div>';


				?>
			<div class="row">
				<div class="row_title col-md-12 col-xs-12">
					<div class="col-md-10 col-xs-12">
						<?php echo $img['Articles']['name']." - ".$img['Products']['description']; ?>
					</div>
					<div class="col-md-2 col-xs-12" style="float:right">
						<?php 
						if ($filter_price == 'T') {
							echo str_replace(".",",",$img['Articles']['price'])." €";
							echo " / ".str_replace(".",",",$img['Articles']['price_madrid'])." €";
						}
						if ($filter_price == 'P') {
							echo str_replace(".",",",$img['Articles']['price'])." €";
						}
						if ($filter_price == 'M') {
							echo str_replace(".",",",$img['Articles']['price_madrid'])." €";
						}

						 ?>
					</div>
				</div>
			</div>
			<div class='row'>
				<?php

		} 


		if ($img['Galleries']['image_uploaded'] == 1) {
	        $image = 'https://www.corma.es/articles/'.$img['Galleries']['image'];
	        $imageThumbs = 'https://www.corma.es/articles/thumbs/'.$img['Galleries']['image'];
	    } else {
	        $image = SERVER . 'uploads/'.$img['Galleries']['image'];
	        $imageThumbs = $image;
	    }


	    if (!isset($img['Galleries']['image'])) {
	    	$image = 'https://www.corma.es/articles/no_foto.jpg';
	    	$imageThumbs = $image;
	    }

		echo '<div class="col-xs-12 col-md-3">';
	    echo '	<div class="row thumbnail">';
	    echo '		<div class="col-xs-12">';
		$caption = $img['Articles']['name'];
		if ($img['Growings']['Creixement'] != '-') {
			$caption .= " (".$img['Growings']['Creixement']." - ".$img['Flowerings']['Floracio'].") ";
		}


	    echo '			<a href="'.$image.'" data-caption = "'.$caption.'" data-fancybox="images">';
	    echo '				<img src="'.$imageThumbs.'" style="height:150px" />';
	    echo '			</a>'; 
	    echo '			<div class="caption" style="text-align:center">';

	    if ($img['Details']['stock_reserved'] == 1) { $stock_reserved = ' (RESERVA)';} else {$stock_reserved ='';}

	    if ($img['Growings']['Creixement'] != '-') {
	    	echo '			<p>'.$img['Growings']['Creixement'].' - '.$img['Flowerings']['Floracio'].$stock_reserved.'</p>';    
	    }
	    //echo '				<p>'.$img['Articles']['name'].'</p>';
	    echo '				<p>'.__('Estoc disponible').': '.$img['Details']['available_unities'].'</p>';
	    echo '			</div>';
		echo '		</div>';
		echo '	</div>';
		echo '</div>';

		$articleAnterior = $img['Articles']['id'];		

	}

	
}


?>




<div class="spacing"></div>
<div class="row">
    <div class="col-md-12 col-xs-6 col-xs-offset-4">
        <a href="<?=SERVER?>Stocks/home" class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> <?=__('Volver');?></a>
    </div>
    
    
    
</div>




<script>

$('[data-fancybox="images"]').fancybox({
		toolbar : true,		
		buttons : [
	        'slideShow',
	        'fullScreen',
	        'thumbs',
	        'download',
	        'zoom',
	        'close'
	    ],

	    
  caption : function( instance, item ) {
    var caption = $(this).data('caption') || '';
    
    return ( caption.length ? caption + '<br />' : '' ) + 'Image <span data-fancybox-index></span> of <span data-fancybox-count></span>';
  },

	    infobar : false,
	    animationEffect : "zoom"
});




</script>



