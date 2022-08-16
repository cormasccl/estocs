
<?php
if (count($ficha['Article'])>0) {
	?>
	<div class="col-md-12">
		<div class="track slider1">
			<div class="power-title"><h5><?php echo __('Presentaciones');?></h5><span class="spacer"></span></div>
			<div class="inner">
				<div class="view-port">
					<div class="slider-container">
						<?php
						foreach ($ficha['Article'] as $article) {
							if (!empty($article['image'])) {
								echo "<div class='item'>";

								$urlThumbs = '/img/articles/thumbs/'.$article['image'];
								//$urlThumbs = 'http://www.corma.es/intranet/img/articles/thumbs/'.$article['image'];
								$urlImage = '/intranet/img/articles/'.$article['image'];
								//$urlImage = 'http://www.corma.es/intranet/img/articles/'.$article['image'];
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
<?php 
}
?>