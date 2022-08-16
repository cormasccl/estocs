
<div class="row">
	<div class="col-md-12 plantTypeTitle">
		<h2></h2>
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
							if (!empty($products)) {
							foreach ($products as $product) {
								echo "<li class='menu-item'>";
								$url2 = 'lista-productos/';
								switch ($this->Session->read('Config.language')) {
									case 'cat':
										$url2 = 'ca/llista-productes/';
										break;
									case 'fra':
										$url2 = 'fr/liste-produits/';
										break;
								
								}
								$url = '/corma/'.$url2;
								$plant_type_id = (!empty($plant_type_id)) ? $plant_type_id : $product['PlantType']['id'];
								$actual_page = 1;
								echo "<a href='".$url."?t=".$plant_type_id."&prod=".$product['Product']['id']."&pag=".$actual_page."'>";
								//echo "<a href='/Products/lista/".$plant_type_id.'/'.$product['id']."'>";
								$nameToShow = (!empty($product['Product']['common_name'])) ? 
									$product['Product']['common_name'] : 
									$product['Product']['description'];
								echo  ucfirst(strtolower($nameToShow))."</a>";
								echo "</li>";
							}
							$ficha = $products[0]; 
							?>
						</ul>
						<?php
							$total_registers = count($products);
							$limit = 10;
							$link = $url."?t=".$plant_type_id."&prod=".$product['Product']['id'];
							echo $this->element('paginator', array('total' => $total_registers,'actual_page' => $actual_page, 'limit' => $limit, 'requestUri' => $requestUri, 'link' => $link, 'type'=>'public'));
						?>

						<!--<div class="paginacio">
							<ul>
						        <?php
						        
						        echo $this->Paginator->first('<i class="fa fa-angle-double-left"></i>', ['escape' => false, 'tag' => 'li']);
						        //
						        //
						                echo $this->Paginator->prev('<span><i class="fa fa-angle-left"></i></span>', [
						            'class' => 'prev enabled',
						            'tag' => 'li',
						            'escape' => false,
						        ], null, [
						            'class' => 'prev disabled',
						            'tag' => 'li',
						            'escape' => false,
						        ]);
						        echo $this->Paginator->numbers(
						        [
						            'separator' => '',
						            'tag' => 'li',
						            'modulus' => 5,
						            'escape' => false,
						            'currentTag' => 'span',
						            'currentClass' => 'active'
						        ]);
						        
						        echo $this->Paginator->next('<span><i class="fa fa-angle-right"></i></span>', [
						            'class' => 'next enabled',
						            'tag' => 'li',
						            'escape' => false,
						        ], null, [
						            'class' => 'next disabled',
						            'tag' => 'li',
						            'escape' => false,
						        ]);
						        echo $this->Paginator->last('<i class="fa fa-angle-double-right"></i>', ['escape' => false, 'tag' => 'li']);

						       
						        ?>

						    </ul>
						    <div class="pull-right paginacioCounter">
						        <?php
						        echo $this->Paginator->counter(
						        [
						            'class' => 'pull-right',
						            'format' => __('Página %s de %s', array('{:page}','{:pages}')),
						        ]);
						        ?>          
						    </div>

						</div>
					-->
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-sm-10">
		<?php if (!empty($products)) {?>
			<div class="mutual-content-wrap sidebar-layout has-sidebar has-left-sidebar">
				<div class="power-title">
				<?php echo "<h3>".ucfirst(strtolower($ficha['Product']['description'])).'</h3>'; ?>
				<span class="spacer"></span>
				</div>
				<div class="row fila0">
					<div class="col-md-4">

						<div class="magic-list-wrapper">
							<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
								<li class="clearfix chain-link">
									<div class="desc-area">
					                	<h4 itemprop="name"><?php echo __('Nombre popular');?></h4>
				                 		<div itemprop="description" class="clearfix desc">
				                  		<p><?php echo $ficha['Product']['common_name'];?></p>
				                  		</div>
					            	</div>
								</li>

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

								

							</ul>
						</div>				
					</div>
					<div class="col-md-8">
					<?php
						$imagen = empty($ficha['Product']['image']) ? 'no_photo.jpg' : $ficha['Product']['image'];

						echo $this->Html->image('products/'.$imagen, array('alt'=>ucfirst(strtolower($ficha['Product']['description'])),'title'=>ucfirst(strtolower($ficha['Product']['description']))));

					?>
					</div>
				</div>
				<div class="row fila1">
					<div class="col-md-4">

						<div class="magic-list-wrapper">
							<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
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
							</ul>
						</div>
					</div>

					<div class="col-md-4">
						<div class="magic-list-wrapper">
							<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
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
							</ul>
						</div>
					</div>

					<div class="col-md-4">
						<div class="magic-list-wrapper">
							<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
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
							</ul>
						</div>
					</div>
				</div>
				<!-- INICI FILA 2 -->
				<div class="row fila2">
					<!-- INICI COL 1 -->
					<div class="col-md-4">
						<div class="magic-list-wrapper">
							<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
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
							</ul>
						</div>
					</div>
					<!-- FI COL 1 -->
					<!-- INICI COL 2 -->
					<div class="col-md-4">
						<div class="magic-list-wrapper">
							<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
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
							</ul>
						</div>
					</div>
					<!-- FI COL 2 -->

					<!-- INICI COL 3 -->
					<div class="col-md-4">
						<div class="magic-list-wrapper">
							<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
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
					<!-- FI COL 3 -->
				</div>
				<!-- FI FILA 2 -->
			</div>
		<?php } else { ?>
			<p><?php echo __('No hay resultados para la búsqueda realizada');?></p>
			<p><?php echo $this->Html->link(
			    __('Volver a Buscar'),
			    'http://corma.es/nuestra-gama/',
			    array('class' => 'button', 'target' => '_top')
			);?></p>
		<?php }?>
		</div>
	</div>
</div>

