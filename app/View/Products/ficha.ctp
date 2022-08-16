<style>
.imgThumb img{
	margin-bottom:10px;
}

p {
	color:#000;
	line-height: 0.2;
}
.fitxa {
	width:756px;
	
}
.FitxaNomBotanic {
	font-size: 22px;
	font-weight: 700;
	
}
.FitxaNomComu {
	font-size: 19;
	font-weight: 600;
}
.FitxaTipusPlanta {
	font-size: 19;
}


</style>

<br />

<br /><br /><br />
<div class="fitxa">
	<div class="col-md-12">
		<div class="col-md-3">
			<img src="https://www.corma.es/logo.png">
		</div>
		<div class="col-md-9">
			<p class="FitxaNomBotanic"><?php echo $ficha['Product']['description'];?></p>
			<p class="FitxaNomComu"><?php echo $ficha['Product']['common_name'];?></p>
			<p class="FitxaTipusPlanta"><?php echo $ficha['PlantType']['description'];?></p>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4">
			<?php
				$imagen = empty($ficha['Product']['image']) ? 'no_photo.jpg' : $ficha['Product']['image'];

				echo $this->Html->image('products/'.$imagen, array('width'=>'250px','alt'=>ucfirst(strtolower($ficha['Product']['description'])),'title'=>ucfirst(strtolower($ficha['Product']['description']))));
			?>
		</div>
		<div class="col-md-8">
			<div class="col-md-6">
				<div class="col-md-3">
					<?php
			            echo $this->Html->image($ficha['Exposition']['image'], array('alt'=>$ficha['Exposition']['description'], 'title'=>$ficha['Exposition']['description']));
			        ?>
			    </div>
			    <div class="col-md-9">
				    <?php		            		
				        echo $ficha['Exposition']['description'];
					?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="col-md-3">
					
			    </div>
			    <div class="col-md-9">
				    <?php
                  		echo empty($ficha['Product']['max_width']) ? '-' : $ficha['Product']['max_width'].' - ';
						echo empty($ficha['Product']['max_height']) ? '-' : $ficha['Product']['max_height'];
					?>
				</div>
			</div>

			<div class="col-md-6">
				<div class="col-md-3">
					<?php
            		echo $this->Html->image($ficha['Irrigation']['image'], array('alt'=>$ficha['Irrigation']['description'], 'title'=>$ficha['Irrigation']['description']));
            		?>
			    </div>
			    <div class="col-md-9">
				    <?php echo $ficha['Irrigation']['description'];?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="col-md-3">
					
			    </div>
			    <div class="col-md-9">
				    <?php
                  		echo $ficha['Product']['initial_flowering'].' - '.$ficha['Product']['final_flowering'];
					?>
				</div>
			</div>

			<div class="col-md-6">
				<div class="col-md-3">
					<?php
            		echo $this->Html->image($ficha['Temperature']['image'], array('alt'=>$ficha['Temperature']['name'], 'title'=>$ficha['Temperature']['name']));
            		?>
			    </div>
			    <div class="col-md-9">
				    <?php echo $ficha['Product']['temperature'];?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="col-md-3">
					
			    </div>
			    <div class="col-md-9">
				    
				</div>
			</div>
		</div>
	</div>
</div>
<br /><br /><br /><br />
*********************** ANTIC *********************

<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="row power-title">
		<?php echo "<h3><strong>".ucfirst(strtolower($ficha['Product']['description'])).'</strong></h3>'; ?>
		<span class="spacer"></span>
	</div>


	<div class="row fila0">
		<div class="col-md-4 col-sm-5">
			<div class="magic-list-wrapper">
				<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
					<li class="clearfix chain-link">
						<div class="desc-area">
							<br />
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


		<div class="col-md-6 col-sm-3">
		<?php
			$imagen = empty($ficha['Product']['image']) ? 'no_photo.jpg' : $ficha['Product']['image'];

			echo $this->Html->image('products/'.$imagen, array('width'=>'250px','alt'=>ucfirst(strtolower($ficha['Product']['description'])),'title'=>ucfirst(strtolower($ficha['Product']['description']))));
		?>
		</div>
	</div>
	<div class="row fila1">
		<div class="col-md-4 col-sm-3">
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

		<div class="col-md-4 col-sm-3">
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

		<div class="col-md-4 col-sm-4">
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
		<div class="col-md-4 col-sm-3">
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
		<div class="col-md-4 col-sm-3">
			<div class="magic-list-wrapper">
				<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
					<li class="clearfix chain-link">
						<div class="desc-area">
		                	<h4 itemprop="name"><?php echo __('Coloración flor');?></h4>
	                 		<div itemprop="description" class="clearfix desc">
		                  		<p>
		                  			<?php
				                  		
				                  		foreach ($ficha['FlowerColour'] as $flower_colour) {
											echo $this->Html->image('flower_colour/'.$flower_colour['code'].'.jpg', array('alt'=>$flower_colour['description'],'title'=>$flower_colour['description']));
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
		<div class="col-md-4 col-sm-4">
			<div class="magic-list-wrapper">
				<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
					<li class="clearfix chain-link">
						<div class="desc-area">
		                	<h4 itemprop="name"><?php echo __('Coloración hoja');?></h4>
	                 		<div itemprop="description" class="clearfix desc">
		                  		<p>
		                  			<?php
				                  		
				                  		foreach ($ficha['SheetColour'] as $sheet_colour) {
											echo $this->Html->image('sheet_colour/'.$sheet_colour['code'].'.jpg', array('alt'=>$sheet_colour['description'],'title'=>$sheet_colour['description']));
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