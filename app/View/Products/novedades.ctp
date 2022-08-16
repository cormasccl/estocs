<?php

$urlBase = $this->get('urlActual');

?>
<script type="text/javascript">

j = jQuery.noConflict();
j(document).ready(function() {
	j('.various').fancybox({
		fitToView	: true,
		width		: '850px',
		/*height		: '150px',*/
		closeClick	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
		closeBtn    : true,
	    iframe : {
	      preload : false
	    }
	});
});
</script>


<div class="track slider1">
	<div class="inner">
		<div class="view-port">
			<div class="slider-container">
				<?php

				foreach ($product_list as $producte) {


					if (empty($producte['image'])) {
						$image = 'no_photo.jpg';
					} else {
						$image = $producte['image'];
					}
					echo "<div class='item'>";

					$url = $urlBase."/Products/index/".$producte['id'].'/';
					$url = $url.myUrlEncode($producte['description']);


					//echo "<a class='various' data-fancybox-type='iframe' href='".$urlBase."/Products/view/".$producte['id']."'>";
					echo "<a class='various' data-fancybox-type='iframe' href='".$url."'>";

					echo "<img src='/intranet/img/products/thumbs/".$image."' height=100px alt='".$producte['description']."' title='".$producte['description']."'>";
					
					//echo "<img src='/corma/intranet/img/products/".$image."' width=100px>";
					echo "<p>".$producte['description']."</p></a>";
					echo "</div>";
					
					//echo parse_url($producte['description']);
				
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





<?php
function myUrlEncode($string) {
    $entities = array(' ','', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
    $replacements = array('-','!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    $string = str_replace($replacements,$entities,  strtolower($string));

    return str_replace(" ","-", $string);
}

?>