<?php

$urlBase = $this->get('urlActual');

?>


	<div class="col-md-12 col-xs-12 col-sm-12">
		<div class="col-md-8 col-xs-8 col-sm-8" style="line-height: 12px;">
			<strong><?php echo __('Total €');?></strong>
		</div>
		<div class="col-md-4 col-xs-4 col-xs-4" style="line-height: 12px;">
			<span id="tdImpTotalVisible"><?php echo str_replace('.',',', number_format($total['importTotal'],2));?></span> €
			<span id="tdImpTotal" class="invisible"><?php echo str_replace('.',',', $total['importTotal']);?></span>
		</div>
	</div>

	<div class="col-md-12 col-xs-12 col-sm-12">
		<div class="col-md-8 col-sm-8 col-xs-8" style="line-height: 12px;">
			<strong><?php echo __('Total carris teòrics');?></strong>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4" style="line-height: 12px;">
			<span id="tdCarris"><?php echo str_replace('.',',', $total['carrisTotal']);?></span>
		</div>
	</div>

	
	<div class="col-md-12 col-xs-12 col-sm-12">
		<ul class="menu clearfix menu3">
			<li id="menu-item-pdf" class="menu-item menu-item-type-custom menu-item-object-custommenu-item-home relative">
				<?php 
				//$urlPDF = "http://www.corma.es/pdf/".$cataleg['id'].".pdf";
				if (empty($cataleg['tariff'])) {
						$urlPDF = "http://www.corma.es/pdf/".$cataleg['code'].'_'.$cataleg['last_week'].'_'.$cataleg['last_year'].".pdf";
					} else {
						$urlPDF = "http://www.corma.es/pdf/".$cataleg['code'].'_'.$cataleg['tariff'].'_'.$cataleg['last_week'].'_'.$cataleg['last_year'].".pdf";
					}
				?>


				<a href="<?php echo $urlPDF;?>" alt="<?php echo __('Descargar disponible en pdf');?>" title="<?php echo __('Descargar disponible en pdf');?>" target="_blank"><i class="btn btn-default fa fa-file-pdf-o"></i></a>
			</li>
			<li id="menu-item-articulos" class="menu-item menu-item-type-custom menu-item-object-custommenu-item-home relative">
	  			<a href="<?php echo $urlBase;?>/Catalogues/index/cart"><i class="btn btn-default fa fa-eye"><span><?php echo '  '.__('Modificar / Visualizar');?></span></i></a>
	  		</li>

	  	

		
	<?php
	  	if ($filter=="preview") {
	  	?>
	  		<li id="menu-item-carrito" class="menu-item menu-item-type-custom menu-item-object-custommenu-item-home relative">
		  		<a href="#"><i class="btn btn-success fa fa-shopping-cart" onclick="frmPreview.submit()"><span><?php echo '  '.__('Finalizar y enviar pedido');?></span></i></a>

		  	</li>
		<?php
		} 
		else 
		{
		?>
			<li id="menu-item-carrito" class="menu-item menu-item-type-custom menu-item-object-custommenu-item-home relative">
		  		<a href="<?php echo $urlBase;?>/Catalogues/index/preview"><i class="btn btn-default fa fa-shopping-cart"><strong><span><?php echo '  '.__('Continuar compra');?></span></strong></i></a>
		  	</li>
		<?php
		}
		?>
		</ul>
	</div>