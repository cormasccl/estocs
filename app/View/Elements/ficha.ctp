<style>

.fichaTecnica {
	font-size: 12px;
}
</style>


<script language="javascript" >
function canviaImatge(novaImatge) {
		document.getElementById("imgPrincipal").src='/intranet/img/products/'+novaImatge;

	}
</script>


<div class="row">
	<div class="col-md-5 col-md-offset-1 col-xs-12 col-sm-5">
		<div class="row">
		<?php
		$imagen = empty($ficha['Product']['image']) ? 'no_photo.jpg' : $ficha['Product']['image'];



		echo "<img itemprop='image' src='/intranet/img/products/".$imagen."' id='imgPrincipal' alt='".ucfirst(strtolower($ficha['Product']['description']))."' title=".ucfirst(strtolower($ficha['Product']['description']))."' style='max-width:100%'/>";





		/*echo $this->Html->image('products/'.$imagen, array('id'=>'imgPrincipal','alt'=>ucfirst(strtolower($ficha['Product']['description'])),'title'=>ucfirst(strtolower($ficha['Product']['description'])),'style'=>'max-width:100%'));*/
		echo "<br /><br /><br />";

		?></div>
		<div class="row">
		<?php
		foreach ($ficha['ProductImage'] as $image) {
			echo $this->Html->image('products/'.$image['image'], array('width'=>'90','class'=>'imagenLink', 'onclick'=>'canviaImatge("'.$image['image'].'")', 'onmouseover'=>'canviaImatge("'.$image['image'].'")'));
			echo ' ';
		}
		?>
		</div>
	</div>


	<div class="col-md-5 col-xs-12 col-sm-5">
		<div class="power-title">
			<h4><?php echo __('Ficha técnica');?></h4>
			<span class="spacer"></span>
		</div>
		<table class="table table-striped fichaTecnica">
			<tbody>
				<?php if (!empty($ficha['Product']['common_name'])) { ?>
					<tr>
						<td><strong itemprop="description"><?php echo __('Nombre popular');?></strong></td>
						<td><?php echo $ficha['Product']['common_name'];?></td>
					</tr>
				<?php } ?>

				<tr>
					<td><strong><?php echo __('Tipología');?></strong></td>
					<td><?php echo $ficha['PlantType']['description'];?></td>
				</tr>
				<tr>
					<td><strong><?php echo __('Utilizaciones');?></strong></td>
					<td><?php
						$strText = '';
						foreach ($ficha['Utilization'] as $utilization) {
							$strText .= $utilization['description'].', ';
						}
						echo substr($strText,0,strlen($strText)-2);
						?>
					</td>
				</tr>
				<tr>
					<td><strong><?php echo __('Características especiales');?></strong></td>
					<td><?php
						$strText = '';
						foreach ($ficha['Characteristic'] as $characteristic) {
							$strText .= $characteristic['description'].', ';
						}
						echo substr($strText,0,strlen($strText)-2);
						?>
					</td>
				</tr>

				<tr>
					<td><strong><?php echo __('Exposición');?></strong></td>
					<td><?php echo $this->Html->image($ficha['Exposition']['image'], array('alt'=>$ficha['Exposition']['description'],'height'=>'20px', 'title'=>$ficha['Exposition']['description']));?> <?php echo $ficha['Exposition']['description'];?></td>
					
				</tr>

				<tr>
					<td><strong><?php echo __('Riego');?></strong></td>
					<td><?php echo $this->Html->image($ficha['Irrigation']['image'], array('alt'=>$ficha['Irrigation']['description'],'height'=>'20px', 'title'=>$ficha['Irrigation']['description'])); ?> <?php echo $ficha['Irrigation']['description'];?></td>
				</tr>

				<tr>
					<td><strong><?php echo __('Temperatura');?></strong></td>
					<td><?php echo $this->Html->image($ficha['Temperature']['image'], array('alt'=>$ficha['Temperature']['name'],'height'=>'20px', 'title'=>$ficha['Temperature']['name'])); ?> <?php echo $ficha['Product']['temperature'];?>
					</td>
				</tr>

				<tr>
					<td><strong><?php echo __('Fragancia');?></strong></td>
					<td><?php
		          		if ($ficha['Product']['fragrance'] =='S') {
							echo __('Si');
						} else {
							echo __('No');
						}
						?>
					</td>
				</tr>

				<tr>
					<td><strong><?php echo __('Desarrollo máximo');?></strong></td>
					<td><?php
					echo empty($ficha['Product']['max_width']) ? '-' : $ficha['Product']['max_width'].' - ';
					echo empty($ficha['Product']['max_height']) ? '-' : $ficha['Product']['max_height'];
					?>
					</td>
				</tr>

				<tr>
					<td><strong><?php echo __('Meses floración');?></strong></td>
					<td><?php echo $ficha['Product']['initial_flowering'].' - '.$ficha['Product']['final_flowering']; ?>
					</td>
				</tr>

				<tr>
					<td><strong><?php echo __('Coloración flor');?></strong></td>
					<td>
						<?php
						foreach ($ficha['FlowerColour'] as $flower_colour) {
		      				$img = 'flower_colour/'.$flower_colour['code'].'.jpg';
							echo $this->Html->image($img, array('alt'=>$flower_colour['description'],'title'=>$flower_colour['description']));
						}
						?>
					</td>
				</tr>

				<tr>
					<td><strong><?php echo __('Coloración hoja');?></strong></td>
					<td>
						<?php
						foreach ($ficha['SheetColour'] as $sheet_colour) {					
							$img = 'sheet_colour/'.$sheet_colour['code'].'.jpg';
							echo $this->Html->image($img, array('alt'=>$sheet_colour['description'],'title'=>$sheet_colour['description']));
						}
						?>
					</td>
				</tr>
			</tbody>							
											
		</table>
	</div>
</div>
