<?php
//debug($user);
$cataleg = $user['Catalogue'];


echo $this->Html->script(array(
  'calculaimporte',
  'fancybox'
), array('inline' => false));

?>
<link href="https://fonts.googleapis.com/css?family=Oswald:400,700,300&amp;effect=outline|3d|3d-float|putting-green|wallpaper" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:700,400" rel="stylesheet" type="text/css">


<?php



//$url = 'https://www.corma.es/intranet/Catalogues/index/collection';

$urlCorma = 'https://';
$url = ($_SERVER['HTTP_HOST'] == '81.46.196.226') ? '/corma/' : '/';
$urlCorma .= $_SERVER['HTTP_HOST'].$url.'intranet/Catalogues/index/collection';



//print_r($url);
$link = $urlCorma;

//$link = $url;
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

//debug($articles);
foreach ($articles as $group => $allArticles) { 


	$tableHtml .= '<table class="col-md-12 table-striped table-condensed cf">';
	$tableHtml .= '<thead class="cf collection"><tr><th colspan=4 class="caixaTitolColeccio">';
	$tableHtml .= '<span class="font-effect-putting-green">'.strtoupper($group).'</span>';
	$tableHtml .= '</th></tr></thead><tbody></tbody>';
	$tableHtml .= '<thead class="detalle"><tr><th class="col-md-2 col-sm-2 col-xs-5">'.__('Fotografía / Estado actual').'</th>';
	$tableHtml .= '<th class="col-xs-7 col-md-4 col-sm-4">'.__('Información planta').'</th>';
	$tableHtml .= '<th class="col-md-3 col-sm-3 col-xs-12">'.__('Observaciones Corma').'</th>';
	$tableHtml .= '<th class="col-md-3 col-sm-3 col-xs-12">'.__('Su pedido / Sus comentarios').'</th>';
	$tableHtml .= '</tr><tbody>';
	foreach ($allArticles as $article) {
		if (!empty($article)) {
			$hasArticleDetail = array();
			foreach($cashorderdetails as $cashorderdetail) {
				$hasArticleDetail = array();
				if ($cashorderdetail['article_id'] == $article['Article']['id']) {
					$hasArticleDetail = $cashorderdetail;
					break;
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