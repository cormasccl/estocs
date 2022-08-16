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

j(document).ready(function() {
    	j('.various').fancybox({
		fitToView	: true,
		width		: '950',
		height		: '400',
		autoSize	: true,
		closeClick	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
		closeBtn    : true
	});
});    	
  </script>


<div class="track slider1">
	<div class="inner">
		<div class="view-port">
			<div class="slider-container artcol">
				<?php

				foreach ($llista_articles as $article) {

					


					if (!empty($article['Article']['image'])) {

						$image = $article['Article']['image'];

						echo "<div class='item'>";

							/*$url2 = 'lista-productos/';
						switch ($this->Session->read('Config.language')) {
							case 'cat':
								$url2 = 'ca/llista-productes/';
								break;
							case 'fra':
								$url2 = 'fr/liste-produits/';
								break;
						}*/
						$urlBase = 'https://corma.es/intranet/';

						//$urlBase = 'http://corma.site/';

						/*echo "<a href='".$url."?t=".$producte['plant_type_id']."&prod=".$producte['id']."'>";*/

						echo "<a class='various fancybox.ajax' href='".$urlBase.'Articles/view/'.$article['Article']['id']."'>";


						echo "<img src='https://corma.es/intranet/img/articles/thumbs/".$image."' width=100px>";
						
						//echo "<img src='/corma/intranet/img/articles/".$image."' width=100px>";
						echo "<p>".$article['Article']['name']."</p>";
						echo "<p>".$article['Article']['Product']['description']."</p>";
						echo "</a>";
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


<!--

<script type="text/javascript">
var track = $(".slider-container").silverTrack();

// install the plugins you want
track.install(new SilverTrack.Plugins.Navigator({
  prev: $("a.prev", parent),
  next: $("a.next", parent)
}));

track.start();
</script>
-->