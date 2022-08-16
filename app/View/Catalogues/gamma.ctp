<?php
//debug($user);
$cataleg = $user['Catalogue'];


echo $this->Html->script(array(
  'calculaimporte',
  'fancybox'
), array('inline' => false));

?>
<link href="https://fonts.googleapis.com/css?family=Oswald:400,700,300&effect=outline|3d|3d-float|putting-green|wallpaper" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700|Gloria+Hallelujah|Indie+Flower|Open+Sans:700,400" rel="stylesheet" type="text/css">



<?php

//print_r($_SERVER['HTTP_HOST']);
//print_r($_SERVER['REQUEST_URI']);
//$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$urlBase = $this->get('urlActual');
//$urlBase = $_SERVER['HTTP_HOST'];

//print_r($this->get('urlActual'));
//$link = $urlBase."?t=".$plant_type_id."&prod=".$product['id'];

//$url = 'http://81.46.212.35'.$urlBase.'/Catalogues/index/gamma';



$urlCorma = 'https://';
$url = ($_SERVER['HTTP_HOST'] == '81.46.196.226') ? '/corma/' : '/';
$urlCorma .= $_SERVER['HTTP_HOST'].$url.'intranet/Catalogues/index/gamma';



//print_r($url);
$link = $urlCorma;

echo "<div class='forceright'>";


if ($actual_page > 1 ) {
	echo "<div class='paginator'>";
	echo $this->element('paginator', array('total' => $total_registers,'actual_page' => $actual_page, 'limit' => $limit, 'requestUri' => $requestUri, 'link' => $link, 'type'=>'private', 'filterid'=>$filterid));
	echo "</div>";
}



echo "</div>";
?>


<?php
$aCells = array();
$tableHtml = '';

foreach ($articles as $group => $allArticles) { 
	$tableHtml .= '<table class="col-md-12 table-striped table-condensed cf tableCorma">';
	$tableHtml .= '<thead class="cf gamma"><tr><th colspan=4>';
	$tableHtml .= '<span class="tituloClasificacion font-effect-3d-float">'.$articles[$group]['parent_name'].'</span>';
	$tableHtml .= '<span class="tituloSubClasificacion  font-effect-3d-float">'.strtoupper($group).'</span>';
	$tableHtml .= '</th></tr></thead><tbody></tbody>';

	$tableHtml .= '<thead class="detalle"><tr><th class="col-md-2 col-sm-2 col-xs-5">'.__('Fotografía / Estado actual').'</th>';
	$tableHtml .= '<th class="col-xs-7 col-md-4 col-sm-4">'.__('Información planta').'</th>';
	$tableHtml .= '<th class="col-md-3 col-sm-3 col-xs-12">'.__('Observaciones Corma').'</th>';
	$tableHtml .= '<th class="col-md-3 col-sm-3 col-xs-12">'.__('Su pedido / Sus comentarios').'</th>';
	$tableHtml .= '</tr><tbody>';
	
	foreach ($allArticles as $article) {
		//debug($article['Article']).die;
		if (!empty($article) && is_array($article)) {
			$hasArticleDetail = array();
			foreach($cashorderdetails as $cashorderdetail) {
				$hasArticleDetail = array();
				if (isset($article['Article']['id'])) {
					if ($cashorderdetail['article_id'] == $article['Article']['id']) {
						$hasArticleDetail = $cashorderdetail;
						break;
					}
				}
			}
			$tableHtml .= '<tr class="rowArticle">'.$this->element('fila',array('article' => $article,'orderdetail' => $hasArticleDetail, 'option'=>'disponible')).'</tr>';
		}
	}
	
	$tableHtml .= '</tbody></table>';
}
//echo $this->Html->div(false, $tableHtml, array('id' => 'no-more-tables'));
echo $this->Html->div(false, $tableHtml);
echo '</div>';

echo "<div class='paginator'>";
echo $this->element('paginator', array('total' => $total_registers,'actual_page' => $actual_page, 'limit' => $limit, 'requestUri' => $requestUri, 'link' => $link, 'type'=>'private', 'filterid'=>$filterid));
echo "</div>";

?>