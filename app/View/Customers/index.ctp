<link href="https://fonts.googleapis.com/css?family=Oswald:400,700,300&effect=outline|3d|3d-float|putting-green|wallpaper" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700|Gloria+Hallelujah|Indie+Flower|Open+Sans:700,400" rel="stylesheet" type="text/css">

<?php

$urlBase = $this->get('urlActual');

?>


<div class="col-sm-12 col-xs-12 col-md-12" style="margin-top:35px;text-align:center;">
	<div class="col-md-6">
		<div class="row">
			<span class="messageCustomer"><?php echo __('Bienvenido a la área privada de Corma, seleccione la opción que desee realizar').' :';?></span>
		</div>
		<div class="row">
			<?php
				if ($catalogue_id != 0) {
				?>
				<a href="<?=$urlBase;?>/Catalogues/index" class="btn btn-success buttonsCustomer">
					<i class="fa fa-shopping-cart"></i><span><?php echo '       '.__('QUIERO COMPRAR (DISPONIBLE SEMANAL)');?></span>
				</a>
				<?php
			}
			?>
			<br />
			<?php
			if ($season_catalogue_id != 0 ) {
				?>
				<a href="<?=$urlBase;?>/SeasonCatalogues/index" class="btn btn-success buttonsCustomer">
					<i class="fa fa-file-text-o"></i><span><?php echo '       '.__('QUIERO CONSULTAR EL CATÁLOGO');?></span>
				</a>
			<?php
			}
			?>
		</div>
	</div>
	<div class="col-md-6">
		<?php 
		echo $this->Html->image('venta.jpg', array('width' => 400, 'class'=>'sombra'));

		?>
	</div>
</div>
