<!-- RESULTAT BÚSQUEDA -->


	<script language="javascript" >
	function canviaImatge(novaImatge) {
		document.getElementById("imgPrincipal").src='/intranet/img/products/'+novaImatge;

	}
	function neteja() {
		j('#product_selected').val(null);
		j('#actual_page').val(null);
		j('#productUtilization').find('option:selected').removeAttr('selected');
	}
	function changeProduct(producte) {
		j('#product_selected').val(producte);
		j('#productSearch').click();
	}
	function changePlantType(planttype) {
		j('#productReset').click();
		
		j('#actual_page').val(1);
		
		j('#product_selected').val(0);
		
		j('#plant_type_id').val(planttype);
		j('#productSearch').click();
		
	}
	function changePage(pagina) {
		j('#actual_page').val(pagina);
		j('#product_selected').val(null);
		j('#productSearch').click();
	}



	j("#productReset").click(function(){
		console.log('entro');
		j('#productUtilization').find('option:selected').removeAttr('selected');
            j('#productUtilization').empty(); //remove all child nodes
            var newOption = j('<option value=""></option>');
            j('#productUtilization').append(newOption);
            j('#productUtilization').trigger("chosen:updated");
        });

	j = jQuery.noConflict();
	j(document).ready(function() {
		j(".fancybox-thumb").fancybox({
	        afterLoad: function () {
	            var aux = this.title;
	            var res = aux.replace("\\n", "<br>");

	            this.title = '<center>' + res + '</center>';
	        },
	        helpers: {
	            title: {
	                type: 'inside',
	                position: 'bottom'
	            },
	            overlay: {
	                showEarly: true,
	                speedIn: 200,
	                speedOut: 200
	            },
	            thumbs: {
	                width: 50,
	                height: 50
	            }
	        }
	    });
	});


	</script>

	<style>
	.imagenLink {
		cursor:pointer;
	}
	.carousel-inner > .item > img,
  	.carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
	</style>

	<script>
	j = jQuery.noConflict();
    j(function() {
      j.responsiveHub({
        layouts: {
          480:  "phone",
          481:  "small-tablet",
          731:  "tablet",
          981:  "web"
        },
        defaultLayout: "web"
      });
    });
  </script>
<!--
<div class="row">
	<div class="col-md-12 plantTypeTitle">
		<h2><?php echo $ficha['PlantType']['description'];?></h2>
	</div>
</div>
-->

<?php

if (!empty($product_list)) {
	?>

	<div class="page-wrapper page">
		<div class="skeleton clearfix auto_align">
			<div class="col-md-4 col-sm-2">
				<div class="sidebar left-sidebar" id="sidebar">
					<div class="dynamic-wrap widget widget_nav_menu sidebar-wrap clearfix">
						<div class="menu-features-menu-container">
							<ul id="menu-features-menu" class="menu">
								<?php
								foreach ($product_list as $product) {

									$class =  ($product['Product']['id'] == $ficha['Product']['id']) ? 'current-menu-item' : '';
										

									echo "<li class='menu-item ".$class."'>";
									//echo "<a href='/corma/intranet/Products/search/".$actual_page."/".$plant_type_id.'/'.$product['id']."'>";
									
									echo "<a href='javascript:changeProduct(".$product['Product']['id'].");'>";
									echo  ucfirst(strtolower($product['Product']['description']))."</a>";
									echo "</li>";
								} ?>
							</ul>
							<?php

								echo $this->element('paginator_ajax', array('total' => $total_registers,'actual_page' => $actual_page, 'limit' => $limit));

						
							?>						
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 col-sm-10">
				<div class="mutual-content-wrap sidebar-layout has-sidebar has-left-sidebar">
					<div class="power-title">
					<?php echo "<h1>".ucfirst(strtolower($ficha['Product']['description'])).'</h1>'; ?>
					<span class="spacer"></span>
					</div>
					<div class="row fila0">
						<div class="col-md-4">
							<div class="magic-list-wrapper">
								<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">

									<?php if (!empty($ficha['Product']['common_name'])) { ?>
										<li class="clearfix chain-link">
											<div class="desc-area">
							                	<h4 itemprop="name"><?php echo __('Nombre popular');?></h4>
						                 		<div itemprop="description" class="clearfix desc">
						                  		<p><?php echo $ficha['Product']['common_name'];?></p>
						                  		</div>
							            	</div>
										</li>
									<?php } ?>

									<li class="clearfix chain-link">
										<div class="desc-area">
						                	<h4 itemprop="name"><?php echo __('Tipología');?></h4>
					                 		<div itemprop="description" class="clearfix desc">
					                  		<p><?php echo $ficha['PlantType']['description'];?></p>
					                  		</div>
						            	</div>
									</li>

									<li class="clearfix chain-link">
										<div class="desc-area">
						                	<h4 itemprop="name"><?php echo __('Utilización');?></h4>
					                 		<div itemprop="description" class="clearfix desc">
					                  		<p>
												<?php
												$strText = '';
												foreach ($ficha['Utilization'] as $utilization) {
													$strText .= $utilization['description'].', ';
												}
												echo substr($strText,0,strlen($strText)-2);
												?>
					                  		</p>
					                  		</div>
						            	</div>
									</li>

									<li class="clearfix chain-link">
										<div class="desc-area">
						                	<h4 itemprop="name"><?php echo __('Exposición');?></h4>
					                 		<div itemprop="description" class="clearfix desc">
					                  		<p><?php echo $ficha['Exposition']['description'];?></p>
					                  		</div>
						            	</div>
						            		
						            		<?php
						            		echo $this->Html->image($ficha['Exposition']['image'], array('alt'=>$ficha['Exposition']['description'], 'title'=>$ficha['Exposition']['description']));
						            		?>
						            </li>

									<li class="clearfix chain-link">
										<div class="desc-area">
						                	<h4 itemprop="name"><?php echo __('Riego');?></h4>
					                 		<div itemprop="description" class="clearfix desc">
					                  		<p><?php echo $ficha['Irrigation']['description'];?></p>
					                  		</div>
						            	</div>
						            		
						            		<?php
						            		echo $this->Html->image($ficha['Irrigation']['image'], array('alt'=>$ficha['Irrigation']['description'], 'title'=>$ficha['Irrigation']['description']));
						            		?>
						       		</li>

						       		<li class="clearfix chain-link">
										<div class="desc-area">
						                	<h4 itemprop="name"><?php echo __('Temperatura');?></h4>
					                 		<div itemprop="description" class="clearfix desc">
					                  		<p><?php echo $ficha['Product']['temperature'];?></p>
					                  		</div>
						            	</div>
						            		
						            		<?php
						            		echo $this->Html->image($ficha['Temperature']['image'], array('alt'=>$ficha['Temperature']['name'], 'title'=>$ficha['Temperature']['name']));
						            		?>
						            </li>

						            <li class="clearfix chain-link">
										<div class="desc-area">
						                	<h4 itemprop="name"><?php echo __('Fragancia');?></h4>
					                 		<div itemprop="description" class="clearfix desc">
						                  		<p>
						                  			<?php
								                  		if ($ficha['Product']['fragrance'] =='S') {
															echo __('Si');
														} else {
															echo __('No');
														}
													?>
												</p>
					                  		</div>
						            	</div>
									</li>

									<li class="clearfix chain-link">
										<div class="desc-area">
						                	<h4 itemprop="name"><?php echo __('Desarrollo máximo');?></h4>
					                 		<div itemprop="description" class="clearfix desc">
						                  		<p>
						                  			<?php
								                  		echo empty($ficha['Product']['max_width']) ? '-' : $ficha['Product']['max_width'].' - ';
														echo empty($ficha['Product']['max_height']) ? '-' : $ficha['Product']['max_height'];
													?>
												</p>
					                  		</div>
						            	</div>
									</li>

									<li class="clearfix chain-link">
										<div class="desc-area">
						                	<h4 itemprop="name"><?php echo __('Meses floración');?></h4>
					                 		<div itemprop="description" class="clearfix desc">
						                  		<p>
						                  			<?php
								                  		echo $ficha['Product']['initial_flowering'].' - '.$ficha['Product']['final_flowering'];
													?>
												</p>
					                  		</div>
						            	</div>
									</li>

									<li class="clearfix chain-link">
										<div class="desc-area">
						                	<h4 itemprop="name"><?php echo __('Coloración flor');?></h4>
					                 		<div itemprop="description" class="clearfix desc">
						                  		<p>
						                  			<?php
								                  		
								                  		

														foreach ($ficha['FlowerColour'] as $flower_colour) {
							                  				$img = 'flower_colour/'.$flower_colour['code'].'.jpg';
															echo $this->Html->image($img, array('alt'=>$flower_colour['description'],'title'=>$flower_colour['description']));
														}
													?>
												</p>
					                  		</div>
					                  		
						            	</div>
									</li>

									<li class="clearfix chain-link">
										<div class="desc-area">
						                	<h4 itemprop="name"><?php echo __('Coloración hoja');?></h4>
					                 		<div itemprop="description" class="clearfix desc">
						                  		<p>
						                  			<?php
								                  		
								                  		foreach ($ficha['SheetColour'] as $sheet_colour) {
															
															$img = 'sheet_colour/'.$sheet_colour['code'].'.jpg';

															echo $this->Html->image($img, array('alt'=>$sheet_colour['description'],'title'=>$sheet_colour['description']));
														}
													?>
												</p>
					                  		</div>
						            	</div>
									</li>
								</ul>
							</div>				
						</div>
						<div class="col-md-8">
							<div class="col-md-10">
								<?php
								$imagen = empty($ficha['Product']['image']) ? 'no_photo.jpg' : $ficha['Product']['image'];

								echo $this->Html->image('products/'.$imagen, array('id'=>'imgPrincipal','alt'=>ucfirst(strtolower($ficha['Product']['description'])),'title'=>ucfirst(strtolower($ficha['Product']['description']))));
								echo "<br /><br /><br />";

								?>
							</div>
							<div class="col-md-2">
								<?php
								foreach ($ficha['ProductImage'] as $image) {
									echo $this->Html->image('products/'.$image['image'], array('width'=>'100','class'=>'imagenLink', 'onclick'=>'canviaImatge("'.$image['image'].'")', 'onmouseover'=>'canviaImatge("'.$image['image'].'")'));
								}

								?>
							</div>
						</div>
						<div class="col-md-8">
							<div class="track slider1">
								<h4 itemprop="name"><?php echo __('Presentaciones');?></h4>
								<div class="inner">
									<div class="view-port">
										<div class="slider-container">
											<?php
											foreach ($ficha['Article'] as $article) {
												if (!empty($article['image'])) {
													echo "<div class='item'>";

													$urlThumbs = '/img/articles/thumbs/'.$article['image'];
													$urlImage = '/intranet/img/articles/'.$article['image'];
													echo "<a class='fancybox-thumb' title='".$article['name']."' rel='fancybox-thumb' href='".$urlImage."'>".$this->Html->image($urlThumbs, array('width' => 75)).'</a>';
													echo "<p>".$article['name']."</p>";
													echo "</div>";
												}

											}

											?>
										</div>
									</div>

									<div class="bullet-pagination"></div>
							    </div>

							    <div class="pagination_slider">
							      <a href="#" class="prev disabled"></a>
							      <a href="#" class="next disabled"></a>
							    </div>
							</div>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>

	<?php
	}
	?>




<!-- FI RESULTAT BÚSQUEDA -->

<!-- FORMULARI BÚSQUEDA -->
<div class="col-md-12">
	<div class='col-md-7'>
		<!--<form action="/intranet/Products/search" class="contact-form" accept-charset="utf-8" id="ProductResultForm" method="post">-->
		<form action="/Products/search" class="contact-form" accept-charset="utf-8" id="ProductResultForm" method="post">
		
		<input type="hidden" id="mostrarResultats" name="mostrarResultats" value="S" />

		<?php 
		if (empty($product_selected)) {$product_selected = 0;}
		if (empty($actual_page)) {$actual_page = 0;}
		
		?>

		<input type="hidden" id="product_selected" name="product_selected" value = "<?=$product_selected;?>" />
		<input type="hidden" id="actual_page" name="actual_page" value = "<?=$actual_page;?>" />

		<?php 

		echo $this->Form->input('description',array('type' => 'text','label' => __('Nombre Botánico:'),'class' => 'cerca'));
		echo $this->Form->input('common_name',array('type' => 'text','label' => __('Nombre Popular:'),'class' => 'cerca'));

		echo $this->Form->input('plant_type_id',array('label' => __('Tipología:'), 'empty' => '', 'class'=>'cerca'));




		echo "<div class='input select'><label for='ProductUtilizationId'>".__('Utilización:')."</label>";
		echo "<select  class='chosen-select cerca' name='Product[utilization][]' multiple='' data-placeholder='".__('Seleccione una utilización')."'>";
		echo "<option value=''></option>";
		foreach ($utilizations as $key => $utilit) {	
			if (!empty($product_utilization)) {
				$trobat = false;
				foreach ($product_utilization as $filtreUtilitzacio) {
					if ($filtreUtilitzacio == $key) { $trobat = true;}
				}
				$selected = ($trobat == true) ? 'selected' : '';
					
			}
			echo "<option value='".$key."' ".$selected.">".$utilit."</option>";
		}
		echo "</select></div>";

		echo $this->Form->input('irrigation_id',array('label' => __('Riego:'), 'empty' => '', 'class'=>'cerca'));
		echo $this->Form->input('exposition_id',array('label' => __('Exposición:'), 'empty' => '', 'class'=>'cerca'));

		echo "<div class='input select'><label for='ProductFlorationId'>".__('Floración:')."</label>";
		 $months = array(
		 	1 => __('Enero'),
		 	2 => __('Febrero'),
		 	3 => __('Marzo'),
		 	4 => __('Abril'),
		 	5 =>__('Mayo'),
		 	6 => __('Junio'),
		 	7 => __('Julio'),
		 	8 => __('Agosto'),
		 	9 => __('Septiembre'),
		 	10 => __('Octubre'),
		 	11 => __('Noviembre'),
		 	12 => __('Diciembre')
		);
		echo "<select class='chosen-select cerca' name='Product[floration][]' multiple='' data-placeholder='".__('Seleccione meses')."'>";
		echo "<option value=''></option>";
		foreach ($months as $key => $month) {
			echo "<option value='".$key."'>".$month."</option>";
		}
		echo "</select></div>";

		echo "<div class='input select'><label for='ProductDisponibilidadId'>".__('Disponibilidad:')."</label>";
		
		echo "<select class='chosen-select cerca' name='Product[availability][]' multiple='' data-placeholder='".__('Seleccione meses')."'>";
		echo "<option value=''></option>";
		foreach ($months as $key => $month) {
			echo "<option value='".$key."'>".$month."</option>";
		}
		echo "</select></div>";

		echo "<div class='input select'><label for='ProductFlowerColourId'>".__('Coloración flor:')."</label>";
		echo "<select class='chosen-select cerca' name = 'Product[FlowerColour][]' multiple='' data-placeholder='".__('Seleccione coloración flor')."'>";
		echo "<option value=''></option>";
		foreach ($flowerColours as $key => $name) {
			if (!empty($product_flowercolours)) {
				$trobat = false;
				foreach ($product_flowercolours as $filtreFlowerColour) {
					if ($filtreFlowerColour == $key) { $trobat = true;}
				}
				$selected = ($trobat == true) ? 'selected' : '';

			}
			echo "<option value='".$key."' ".$selected.">".$name."</option>";

		}
		echo "</select></div>";

		//echo $this->Form->input('SheetColour',array('label' => __('Coloración hoja:')));
		echo "<div class='input select'><label for='ProductSheetColourId'>".__('Coloración hoja:')."</label>";
		echo "<select class='chosen-select cerca' name = 'Product[SheetColour][]' multiple='' data-placeholder='".__('Seleccione coloración hoja')."'>";
		echo "<option value=''></option>";

	
		foreach ($sheetColours as $key => $name) {
			if (!empty($product_sheetcolours)) {
				$trobat = false;
				foreach ($product_sheetcolours as $filtreSheetColour) {
					if ($filtreSheetColour == $key) { $trobat = true;}
				}
				$selected = ($trobat == true) ? 'selected' : '';

			}
			echo "<option value='".$key."' ".$selected.">".$name."</option>";

		}
		echo "</select></div>";

		echo $this->Form->input('temperature',array('label' => __('Temperatura:')));

		$values = array(''=>'','S' => __('Si'), 'N' => __('No'));

		echo $this->Form->input('fragrance',array('label' => __('Fragancia:'), 'options' => $values, 'default' => ''));
		?>
		
		<!--<input class="tt-form-submit" type="reset" name="productReset" id="productReset" value = "<?php echo __('Limpiar formulario');?>" />-->
		<input class="tt-form-submit" type="submit" value = "<?php echo __('Buscar');?>" onclick="javascript:neteja();"/>

		<input class="tt-form-submit" name="productSearch" id="productSearch" type="submit" style="display:none" />
		
		</form>
	</div>
	<div class='col-md-5'>
		<?php 


		foreach ($plantTypes as $idPlantType => $plantType ) {	

			/*if ($_SERVER['HTTP_HOST'] == 'corma.site') {
				$imatge = "http://81.46.212.35/corma/intranet/img/plant_types/".$idPlantType.".jpg";
			} else {
				$imatge = "http://81.46.212.35/corma/intranet/img/plant_types/".$idPlantType.".jpg";
			}*/
			$imatge = $this->get('urlActual').'/img/plant_types/'.$idPlantType.'.jpg';


			$link = "javascript:changePlantType(".$idPlantType.");";


			//$link = "/corma/lista-productos/?t=".$idPlantType;
			//$link = "/corma/intranet/products/lista/1/".$idPlantType;
			$title = $plantType;
				
			/*echo "<div class='col-md-4 grid'>";
			echo "<figure class='effect-zoe'>";
			echo "<a href='".$link."'><img src='".$imatge."' alt='".$title."' title='".$title."'>";
			echo "	<figcaption>".$title."	</figcaption></a>";
			echo "</figure>";	
			echo "</div>";	*/



			echo "<div class='col-md-4 col-sm-4 col-xs-4 grid'>";
			echo "		<figure class='effect-lily'>";
			echo "			<a href='".$link."'><img src='".$imatge."' alt='".$title."' title='".$title."'>";
			echo "			<figcaption>";
			echo "				<div>";
			echo "					<h2><span>".$title."</span></h2>";
			echo "				</div>";
			echo "			</figcaption></a>	";		
			echo "		</figure>";
			echo "</div>";

		
		} 
		?>
	</div>
	
</div>



<br />
<br />

<style>
.month {
	cursor: hand;
}
.cerca {
	width:40% !important;
}
.planttype {
	background-color: #000;
    opacity: 0.6;
    color: rgb(255, 255, 255);
    text-align: center;
}
p.planttype {
	width:100%;
	margin-left:0px !important;
	margin-right:0px !important;
	margin-top: 50% !important;
}
.tipologies {
	width:80%;
	margin-left:10%;
	margin-right:10%;
}
</style>
