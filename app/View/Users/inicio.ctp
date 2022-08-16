<?php
//debug($user);
$cataleg = $user['Catalogue'];
?>
<div class="col-md-12 redcolor"><?php echo strtoupper($titleName).' ';//.__('(PREUS NETS I DEFINITIUS)');?></div>
<table class="table">
<?php

echo $this->Html->tableHeaders(array(__('Fotografía / Estat actual'), __('Informació planta'), __('Observacions Corma'),__('La vostra comanda / Els seus comentaris')));
$aCells = array();
foreach ($articles as $article) {
	if (!empty($article)) {
		$aCell = unserialize($this->element('fila',array('article' => $article)));
		$aCells[] = $aCell;
	}
}
echo $this->Html->tableCells($aCells);
//debug($articles);



//debug($user);
?>
</table>
</div>
<style>
.redcolor {
	background-color: #e8076f;
	border-radius: 4px 4px 0px 0px;
	text-align: center;
	color: #fff;
	font-size: 2em;
	text-shadow: 2px 2px #000;
    -webkit-transition: -webkit-transform .1s ease-in;
}
.carries_text {
	font-size: 0.8em;
	color: #e8076f;
}
.ean_text {
	font-size: 0.8em;
}
.price {
	color: #e8076f;
	font-weight: bold;
}
.base_price {
	color: #999;
	font-weight: bold;
	text-decoration:line-through;
}
th {
	background-color: #000;
	color: #fff;
	font-size: 0.8em;
}
</style>
