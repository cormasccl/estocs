<?php

$seasoncatalogue = $user['SeasonCatalogue'];


?>
<link href="http://fonts.googleapis.com/css?family=Oswald:400,700,300&effect=outline|3d|3d-float|putting-green|wallpaper" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Josefin+Sans:400,700|Gloria+Hallelujah|Indie+Flower|Open+Sans:700,400" rel="stylesheet" type="text/css">



<?php



//$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$urlBase = '/'.$this->get('urlActual');

//$link = $url."?t=".$plant_type_id."&prod=".$product['id'];
$link = $urlBase;
echo $this->element('paginator', array('total' => $total_registers,'actual_page' => $actual_page, 'limit' => $limit, 'requestUri' => $requestUri, 'link' => $link, 'type'=>'private', 'filterid'=>$filterid));
?>


<?php

echo $this->Html->script(array(
  'fancybox'
), array('inline' => false));



$aCells = array();
$tableHtml = '';

//debug($articles).die;
foreach ($articles as $group => $allArticles) { 



	?>

	<?php 
	$tableHtml .= '<table class="col-md-12 table-striped table-condensed cf tableCorma">';
	$tableHtml .= '<thead class="cf gamma"><tr><th colspan=4>';
	$tableHtml .= '<span class="tituloClasificacion font-effect-3d-float">'.$allArticles[0]['SeasonCatalogueClassification']['parent_name'].'</span>';
	$tableHtml .= '<span class="tituloSubClasificacion  font-effect-3d-float">'.strtoupper($group).'</span>';
	$tableHtml .= '</th></tr></thead><tbody></tbody>';
	$tableHtml .= '<thead class="detalle"><tr><th class="col-md-2 col-sm-2 col-xs-5">'.__('Fotografía / Estat actual').'</th>';
	$tableHtml .= '<th class="col-xs-7 col-md-4 col-sm-4">'.__('Informació planta').'</th>';
	$tableHtml .= '<th class="col-md-4 col-sm-4 col-xs-12">'.__('Observacions Corma').'</th>';
	$tableHtml .= '</tr><tbody>';
	foreach ($allArticles as $article) {
		if (!empty($article)) {
			
			$tableHtml .= '<tr class="rowArticle">'.$this->element('fila',array('article' => $article, 'option'=>'catalogo')).'</tr>';
		}
	}
	$tableHtml .= '</tbody></table>';
}
echo $this->Html->div(false, $tableHtml, array('id' => 'no-more-tables'));
echo '</div>';

?>
