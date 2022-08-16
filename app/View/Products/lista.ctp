<?php

echo $this->Html->script(array(
  'fancybox'
), array('inline' => false));
	
?>

	<script language="javascript" >
	function canviaImatge(novaImatge) {
		document.getElementById("imgPrincipal").src='/corma/intranet/img/products/'+novaImatge;

	}
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

<div class="row">
	<div class="col-md-12 plantTypeTitle">
		<h2><?php echo $ficha['PlantType']['description'];?></h2>
	</div>
</div>

<div class="page-wrapper page">
	<div class="skeleton clearfix auto_align">
		<div class="col-md-4 col-sm-2">
			<div class="sidebar left-sidebar" id="sidebar">
				<div class="dynamic-wrap widget widget_nav_menu sidebar-wrap clearfix">
					<div class="menu-features-menu-container">
						<ul id="menu-features-menu" class="menu">
							<?php
							foreach ($product_list as $product) {			
								echo "<li class='menu-item'>";
								echo "<a href='/corma/intranet/Products/search/".$actual_page."/".$plant_type_id.'/'.$product['id']."'>";
								echo  ucfirst(strtolower($product['description']))."</a>";
								echo "</li>";
							} ?>
						</ul>
						<?php
							
							$url = 'https://81.46.196.226'.$this->get('urlActual').'/products/lista';
							$link = $url;
							$filterid = $plant_type_id.'/'.$product['id'];
							echo $this->element('paginator', array('total' => $total_registers,'actual_page' => $actual_page, 'limit' => $limit, 'requestUri' => $requestUri, 'link' => $link, 'type'=>'private', 'filterid'=>$filterid));

						?>						
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-sm-10">
			<div class="mutual-content-wrap sidebar-layout has-sidebar has-left-sidebar">
				<div class="power-title">
				<?php echo "<h3>".ucfirst(strtolower($ficha['Product']['description'])).'</h3>'; ?>
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
														echo $this->Html->image($flower_colour['image'], array('alt'=>$flower_colour['description'],'title'=>$flower_colour['description']));
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
														echo $this->Html->image($sheet_colour['image'], array('alt'=>$sheet_colour['description'],'title'=>$sheet_colour['description']));
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
							<?php
							echo '<h4 itemprop="name">'.__('Presentaciones').'</h4>';
?>
							<div class="inner">
								<div class="view-port">
									<div class="slider-container">
										<?php

										foreach ($ficha['Article'] as $article) {
											if (!empty($article['image'])) {
												echo "<div class='item'>";

												$urlThumbs = '/img/articles/thumbs/'.$article['image'];
												$urlImage = '/corma/intranet/img/articles/'.$article['image'];



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

