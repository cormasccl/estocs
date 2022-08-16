<?php
/*
'ImagesQuality' => array(
			'id' => '4467',
			'article_id' => '84',
			'growing_id' => '2',
			'flowering_id' => '4',
			'image' => 'PENSA5N_C2_F3_02.jpg',
			'created' => '2018-01-19',
			'modified' => '2018-01-19'
		),
		'Article' => array(
			'id' => '84',
			'name' => 'PENSA 10,5',
			'ean' => '8429282011450',
			'code' => 'PENSA5N',
			'product_id' => '435',
			'image' => 'PENSA5N_CP_F3.jpg',
			'price' => '0.57',
			'price_madrid' => '0.68',
			'height' => '20'
		),
		'Growing' => array(
			'id' => '2',
			'created' => '2015-10-28 09:10:53',
			'modified' => '2015-10-28 09:10:53',
			'code' => 'C2',
			'name' => 'Estado óptimo',
			'sorting' => '1'
		),
		'Flowering' => array(
			'id' => '4',
			'created' => '2015-10-28 09:10:53',
			'modified' => '2015-10-28 09:10:53',
			'code' => 'F3',
			'name' => 'Botones Florales con alguna flor abierta',
			'sorting' => '3'
		)

*/





?>


<div class="row">
    <div class="col-md-12 col-xs-12">
        <p class="titol_article"><?php echo $article['name'];?></p>
    </div>
</div>

<div class="spacing"></div>

<div class="row">

<?php
foreach ($imagesQuality as $row) {


	if ($row['ImagesQuality']['upload'] == 0) {
        $image = "https://www.corma.es/intranet/img/articles/".$row['ImagesQuality']['image'];
		$imageThumbs = "https://www.corma.es/intranet/img/articles/thumbs/".$row['ImagesQuality']['image'];
    } else {
        $image = SERVER . 'uploads/'.$row['ImagesQuality']['image'];
        $imageThumbs = $image;
    }
	
	?>

	<div class="col-xs-12 col-md-4">
        <div class="row thumbnail">
        	<div class="col-xs-12">
        	 	<a href="<?=$image;?>" data-fancybox="images">
                    <img src="<?=$imageThumbs;?>" style="height:150px" />

                </a> 

                <div class="caption" style="text-align:center">
                	<strong><?php echo $row['Growing']['code'].' - '.$row['Flowering']['code'];?></strong>&nbsp;&nbsp;&nbsp;

					<a href="<?=SERVER?>ImagesQualities/edit/<?=$row['ImagesQuality']['id'];?>" class="btn btn-default" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php
	

}


?>
</div>


<div class="spacing"></div>
<div class="row">
    <div class="col-md-6 col-xs-6">
        <a href="<?=SERVER;?>Articles/selection" class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> <?=__('Volver');?></a>
    </div>
    
    <div class="col-md-6 col-xs-6">
        <a href="<?=SERVER?>ImagesQualities/add/<?=$article['id'];?>" class="btn btn-primary" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=__('Nueva calidad');?></a>
    </div>
    
</div>