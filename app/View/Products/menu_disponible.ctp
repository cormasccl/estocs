<?php
echo $this->Html->script(array(
  'guardapedido','/i18n_js/js/i18n_js','fancybox'
));


$extra = '';

/*if ($_SERVER['HTTP_HOST'] == 'corma.site') {
	$urlBase = "http://corma.site";
} elseif ($_SERVER['HTTP_HOST'] == 'cormaweb:8080') { 
	$urlBase = "http://cormaweb:8080";
} else {
	$urlBase = "http://corma.es/intranet";
}*/
$urlBase = $this->get('urlActual');
?>

<script language="javascript">
function enviarPedido()
{
	document.getElementById('enviarPedido').submit();

}

</script>


<div class="col-md-7 col-sm-7 col-xs-7">
<?php //if ($mostrar_titulo =='yes') {
					echo "<p class='titulo'>".$title_for_layout."</p>";
					//}
				?>
</div>

<div class="col-md-5 col-xs-5 col-sm-5 boxCarris">			
	<div class="col-md-12 col-xs-12 col-sm-12">
		<div class="col-md-7 col-xs-7 col-sm-7" style="line-height: 12px;">
			<strong><?php echo __('Total €');?></strong>
		</div>
		<div class="col-md-5 col-xs-5 col-xs-5" style="line-height: 12px;">
			<span id="tdImpTotalVisible"><?php echo str_replace('.',',', number_format($total['importTotal'],2));?></span> €
			<span id="tdImpTotal" class="invisible"><?php echo str_replace('.',',', $total['importTotal']);?></span>
		</div>
	</div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-7 col-sm-7 col-xs-7">
			<strong><?php echo __('Total carris teòrics');?></strong>
		</div>
		<div class="col-md-5 col-sm-5 col-xs-5">
			<span id="tdCarris"><?php echo str_replace('.',',', $total['carrisTotal']);?></span>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
			<ul class="menu clearfix menu3">
				<li id="menu-item-pdf" class="menu-item menu-item-type-custom menu-item-object-custommenu-item-home relative">
					<?php 
					$urlPDF = "https://www.corma.es/pdf/".$cataleg['id'].".pdf";
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
		
</div>


<div class="col-md-12 col-sm-6 col-xs-7 header-cons-area">


	<div data-offset-top="0" class="col-md-9 top-area-wrapper  header-cons-static">
		<div class="top-area  header-construtor" style="">
			<div class="clearfix  auto_align" itemscope="" itemtype="http://schema.org/SiteNavigationElement">
				<?php //if ($mostrar_titulo =='yes') {
					//echo "<p class='titulo'>".$title_for_layout."</p>";
					//}
				?>
				<div class="menu_layers">					
					<div class="menu-bar menu-disponible">
                        <div class="clearfix">
                        	
                            <ul id="menu-main-menu" class="menu clearfix menu2">
								<?php
								if (!empty($filter)) {
									$extra = '';
							  		if ($filter == 'discount') {
							  			//$extra = 'current-menu-ancestor';
							  			$extra = 'current-menu-item';
							  		}
								}
						  		?>

                            	<li id="menu-item-ofertes" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home relative <?php echo $extra;?>">
							  		<a href="<?php echo $urlBase;?>/Catalogues/index"><?php echo __('Ofertes');?><span class="menu-tail"></span></a>
							  		<div class="hoverdir-wrap"><span class="hoverdir" style="display: block; left: 0px; top: 100%; transition: all 300ms ease;"></span></div>
							  	</li>

							  	<?php
							  	if (!empty($filter)) {
									$extra = '';
							  		if ($filter == 'motora') {
							  			$extra = 'current-menu-item';
							  		}
							  	}
						  		?>
							  	<li id="menu-item-motores" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home relative <?php echo $extra;?>">
							  		<a href="<?php echo $urlBase;?>/Catalogues/index/motora"><?php echo __('Plantes motores');?><span class="spacer"></span><span class="menu-tail"></span></a>
							  		<div class="hoverdir-wrap"><span class="hoverdir" style="display: block; left: 0px; top: 100%; transition: all 300ms ease;"></span></div>
							  	</li>
							  	<?php
							  	if (!empty($filter)) {
									$extra = '';
							  		if ($filter == 'suggestion') {
							  			$extra = 'current-menu-item';
							  		}
							  	}
						  		?>
								<li id="menu-item-suggerencies" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home relative <?php echo $extra;?>">
							  		<a href="<?php echo $urlBase;?>/Catalogues/index/suggestion"><?php echo __('Sugerencias');?><span class="spacer"></span><span class="menu-tail"></span></a>
							  		<div class="hoverdir-wrap"><span class="hoverdir" style="display: block; left: 0px; top: 100%; transition: all 300ms ease;"></span></div>
							  	</li>
							  	<?php
							  	if (!empty($filter)) {
									$extra = '';
							  		if ($filter == 'collection') {
							  			$extra = 'current-menu-item';
							  		}
							  	}
						  		?>
							  	<li id="menu-item-coleccions" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home relative <?php echo $extra;?>">
							  		<a href="<?php echo $urlBase;?>/Catalogues/index/collection">
							  			<?php echo __('Col·leccions exclusives');?>
							  			<span class="spacer"></span>
							  			<span class="menu-tail"></span>
							  		</a>
							  		<div class="hoverdir-wrap">
							  			<span class="hoverdir" style="display: block; left: 0px; top: 100%; transition: all 300ms ease;"></span>
							  		</div>


							  		<ul class="sub-menu  sub-menu2 clearfix">
							  			<?php
										foreach ($collections as $col) {
											$url = $urlBase."/Catalogues/index/collection/1/".$col['Collection']['id'];
											$nom = $col['Collection']['description'];

											echo "<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-37   rel'><a href='".$url."'>".$nom."</a>";
											echo '<div class="hoverdir-wrap"><span style="background:" class="hoverdir"></span></div>';
											echo "</li>";
										}
										?>
							  		</ul>
							  	</li>

							  	<?php
								if (!empty($filter)) {
									$extra = '';
							  		if ($filter == 'compositions') {
							  			//$extra = 'current-menu-ancestor';
							  			$extra = 'current-menu-item';
							  		}
								}
						  		?>

                            	<li id="menu-item-ofertes" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home relative <?php echo $extra;?>">
							  		<a href="<?php echo $urlBase;?>/Catalogues/index/compositions"><?php echo __('Composiciones Corma');?><span class="menu-tail"></span></a>
							  		<div class="hoverdir-wrap"><span class="hoverdir" style="display: block; left: 0px; top: 100%; transition: all 300ms ease;"></span></div>
							  	</li>





							  	<?php
							  	if (!empty($filter)) {
									$extra = '';
							  		if ($filter == 'gamma') {
							  			$extra = 'current-menu-item';
							  		}
							  	}
						  		?>
							  	<li id="menu-item-gamma" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-has-children relative <?php echo $extra;?>">
							  		<?php $url = $urlBase.'/Catalogues/index/gamma';?>
							  		<a href="<?php echo $url?>">
							  			<?php echo __('Gamma');?>
							  			<span class="spacer"></span>
							  			<span class="menu-tail"></span>
							  		</a>
							  		<div class="hoverdir-wrap"><span class="hoverdir" style="display: block; left: 0px; top: 100%; transition: all 300ms ease;"></span></div>

							  		<ul class="sub-menu  sub-menu2 clearfix">
							  			<?php
							  			foreach ($classificacions as $classificacio) {
							  				
											//if ($classificacio['catalogue_classification_id'] == null) {
//debug($classificacio);

												$url = $urlBase."/Catalogues/index/gamma/1/".$classificacio['CatalogueClassification']['id'];

												$nom = ucfirst(mb_strtolower($classificacio['CatalogueClassification']['description'],'UTF-8'));

												echo "<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-37   rel'><a href='".$url."'>".$nom."</a>";
												echo '<div class="hoverdir-wrap"><span style="background:" class="hoverdir"></span></div>';

												echo "<ul class='sub-menu sub-menu2 clearfix'>";

												foreach($classificacio['SubClassificacio'] as  $subclassificacio) {
													/*$nom = utf8_encode(ucfirst(strtolower($subclassificacio['description'])));*/
													$nom =  ucfirst(mb_strtolower($subclassificacio['description'],'UTF-8'));


													$url = $urlBase."/Catalogues/index/gamma/1/".$subclassificacio['id'];
													echo "<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-37   rel '><a href='".$url."'>".$nom."</a></li>";
												}
												echo "</ul></li>";
											//}
										}
										?>
							  		</ul>
							  	</li>
							  	
							</ul>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-3" style="margin-top: 7px;">
		<?php
		echo $this->element('search');
		?>
	</div>

</div>





