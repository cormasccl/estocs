<!--<html>
<head>

	<link href="http://62.141.37.177/corma/wp-content/themes/Sterling/style.css" rel="stylesheet" type="text/css" media="screen">
<link href="http://62.141.37.177/corma/wp-content/themes/Sterling/css/primary-green.css" rel="stylesheet" type="text/css" media="screen">
<link href="http://62.141.37.177/corma/wp-content/themes/Sterling/css/_mobile.css" rel="stylesheet" type="text/css" media="screen">

-->

<?php
/*echo $this->Html->css('slider');

echo "<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js' />";

echo $this->Html->script(array(
    'jquery-easing-1.3.0',
    'modernizr.mediaqueries.transforms3d',
    'responsive-hub',
    'jquery.silver_track',
    'jquery.placeholder.min',
    'jquery.silver_track_recipes',
    'plugins/jquery.silver_track.navigator',
    'plugins/jquery.silver_track.bullet_navigator',
    'plugins/jquery.silver_track.responsive_hub_connector',
    'slider',
), array('inline' => false));*/

?>


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

<div class="track slider1">
	<div class="inner">
		<div class="view-port">
			<div class="slider-container">
				<?php
				foreach ($product_list as $producte) {
					$image = (empty($producte['image'])) ? 'no_photo.jpg' : $producte['image'];
					echo "<div class='item'>";
					echo "<a href='http://corma.es/lista-productos/?col=".$collection['id']."&prod=".$producte['id']."'>";

					echo "<img src='http://corma.es/intranet/img/products/".$image."' width=100px>";
					echo "<p>".$producte['description']."</p></a>";
					echo "</div>";
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
