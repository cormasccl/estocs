<?php

$cataleg = $user['Catalogue'];


echo $this->Html->script(array(
  'calculaimporte',
  'fancybox'
), array('inline' => false));


?>


<link href="https://fonts.googleapis.com/css?family=Oswald:400,700,300&effect=outline|3d|3d-float|putting-green|wallpaper" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700|Gloria+Hallelujah|Indie+Flower|Open+Sans:700,400" rel="stylesheet" type="text/css">

<?php



?>

<div class="col-md-12 redcolor"><span class='font-effect-3d-float'><?php echo strtoupper($titleName);?></span></div>
<?php



$aCells = array();
$tableHtml = '<table class="col-md-12 table-striped table-condensed cf detalle">';

	$tableHtml .= '<thead class="detalle"><tr><th class="col-md-2 col-sm-2 col-xs-5">'.__('Fotografía / Estat actual').'</th>';
	$tableHtml .= '<th class="col-xs-7 col-md-4 col-sm-4">'.__('Informació planta').'</th>';
	$tableHtml .= '<th class="col-md-3 col-sm-3 col-xs-12">'.__('Observacions Corma').'</th>';

	$tableHtml .= '<th class="col-md-3 col-sm-3 col-xs-12">'.__('La vostra comanda / Els seus comentaris').'</th>';
	$tableHtml .= '</tr></thead><tbody>';

$tableHtml .= '</tr></thead><tbody>';





foreach ($articles as $article) {

	
	
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

echo $this->Html->div(false, $tableHtml);

?>
</table>
</div>
