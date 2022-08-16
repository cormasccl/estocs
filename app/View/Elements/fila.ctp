<?php 


if ($option == 'disponible') {
	$ficha = $article['CatalogueArticle'];
} else {
	$ficha = $article['SeasonCatalogueArticle'];
	$producte = $article['Product'];
}


$ArticuloBotanico = ($article['Family']['code'] == 'BOTANI');

//debug($article).die;
//debug($article['Product']).die;

$aCell = '';



$urlCorma = 'https://';
$url = ($_SERVER['HTTP_HOST'] == '81.46.196.226') ? '/corma/' : '/';
$urlCorma .= $_SERVER['HTTP_HOST'].$url;


$urlBase = $this->get('urlActual');


if ($option == 'disponible') {
	$Image = $article[0]['Photo'];
	//$columna1 = '<img src="'.$article['Photo'].'" width=100px />';
} else {

	if (empty($ficha['image'])) {
		$Image = "sinfoto.png";
		//$columna1 = '<img src="/img/articles/thumbs/sinfoto.png" width=100px />';
	} else {
		$Image = $ficha['image'];
		//$columna1 = $this->Html->image('articles/thumbs/'.$ficha['image'], array('width' => 100));
	}
}


$titleImage = $article['Product']['description'];
if (!empty($article['i18n']['common_name'])) {
	$titleImage .= '\n'.$article['i18n']['common_name'];
}
$urlImage = $urlBase.'/img/articles/'.$Image;
//$urlImage = 'http://corma.site/img/articles/'.$Image;


$urlThumbs = 'articles/thumbs/'.$Image;

$columna1 = "<a class='fancybox-thumb' title='".$titleImage."' rel='fancybox-thumb' href='".$urlImage."'>".$this->Html->image($urlThumbs, array('max-width' => 100)).'</a>';



//echo "<a class='various' data-fancybox-type='iframe' href='".$urlBase."/Products/view/".$producte['id']."'>";

$url = $urlCorma."intranet/Products/index/".$article['Product']['id'].'/';

$entities = array(' ','', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
$replacements = array('-','!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
$slug = str_replace($entities, $replacements, strtolower($article['Product']['description']));

$url = $url.$slug;

//$url = $url.myUrlEncode($article['Product']['description']);


$columna1 .= '<p class="fichatecnica"><a class="various" data-fancybox-type="iframe" href="'.$url.'"><i class="fa fa-file-image-o"></i> '.__('Ver ficha técnica').'</a></p>';
/*$columna1 .= '<p class="fichatecnica"><a class="various" data-fancybox-type="iframe" href="'.$urlCorma.'intranet/Products/view/'.$article['Product']['id'].'/esp"><i class="fa fa-file-image-o"></i> '.__('Ver ficha técnica').'</a></p>';*/



/*$columna1 .= '<p class="fichatecnica"><a class="various fancybox.ajax" href="'.$urlCorma.'intranet/Products/view/'.$article['Product']['id'].'/esp"><i class="fa fa-file-image-o"></i> '.__('Ver ficha técnica').'</a></p>';*/

//debug($columna1).die;

$columna2 = '<ul class="detallsArticle">';

if (!empty($article['Product'])) {
	$columna2 .= '<p class="article">'.$article['Product']['description'].'</p>';
	$columna2 .= '<p class="article">'.$article['i18n']['common_name'].'</p>';	
}

$columna2 .= '<p class="article">'.$article['Article']['name'].'</p>';

if ($ArticuloBotanico) {
	$columna2 .= '<p class="carries_text">';
	if ($ficha['show_boxes'] == 1 ) {
		$columna2 .= $ficha['per_box'].'/'.__('caixa').' ';
	}


	$columna2 .= $ficha['per_box']*$ficha['boxes_per_floor'].'/'.__('pis').' '.$ficha['per_box']*$ficha['boxes_per_floor']*$ficha['carri_floor'].'/'.__('carri').'</p>';
}
$columna2 .= '<p class="ean_text">'.$article['Article']['ean'].'</p>';
if (!empty($article['CatalogueArticle']['customer_code'])) {
$columna2 .= '<p class="ean_text">Ref. '.$article['CatalogueArticle']['customer_code'].'</p>';
}
$columna2 .= '<p class="price">'.str_replace('.',',',$ficha['price']).' €';

if ($option == 'disponible') {
	if ($ficha['base_price'] > $ficha['price']) {
		$columna2 .= '&nbsp;&nbsp;<span class="base_price">&nbsp;'.str_replace('.',',',$ficha['base_price']).' €&nbsp;</span>';
	}
}

$columna2 .= '</p>';



$columna2 .= '</ul>';
if ($option == 'disponible') 
{

	if ($article['CatalogueArticle']['novelty'] == 1 ) {
		$columna3 ="<p>". $this->Html->image('new_icon.png')."</p>";
		$columna4 = empty($ficha['observations']) ? '&nbsp;' : $ficha['observations'];
	} else {
		$columna3 = empty($ficha['observations']) ? '&nbsp;' : $ficha['observations'];
	}


	
} else {




	$columna3 = "<p>".__('Exposición: ');
	$columna3 .= $this->Html->image($producte['Exposition']['image'], array('alt'=>$producte['Exposition']['description'], 'title'=>$producte['Exposition']['description']));
	$columna3 .= $producte['Exposition']['description']."</p>";

	$columna3 .= "<p>".__('Riego: ');
	$columna3 .= $this->Html->image($producte['Irrigation']['image'], array('alt'=>$producte['Irrigation']['description'], 'title'=>$producte['Irrigation']['description']));
	$columna3 .= $producte['Irrigation']['description']."</p>";

	$columna3 .= "<p>".__('Temperatura: ');
	$columna3 .= $this->Html->image($producte['Temperature']['image'], array('alt'=>$producte['Temperature']['name'], 'title'=>$producte['Temperature']['name']));
	$columna3 .= $producte['Temperature']['name']."</p>";
					            	

}

$idArticle = $article['Article']['id'];

if ($option == 'disponible') 
{
	$functionOnBlur = "CalculaImport('Unities".$idArticle."','UnitiesServices".$idArticle."','price".$idArticle."',";
	$functionOnBlur .= "'perbox".$idArticle."','boxesfloor".$idArticle."','carrifloor".$idArticle."',";
	$functionOnBlur .= "'realunities".$idArticle."','import".$idArticle."','carrisarticle".$idArticle."','import".$idArticle."','".$idArticle."','".$cash_order."','customerobservations".$idArticle."')";

	$unities = $realunities = $import = $carriProducte = 0;
	$serviceUnitId = 'P';
	$observations = '';

	if (!empty($orderdetail)) {
		$unities = $orderdetail['units'];

		$carriProducte = $orderdetail['carris_article'];
		$realunities   = $orderdetail['real_unities'];
		switch ($orderdetail['services_unit_id']) {
			case '1':
				$serviceUnitId = 'U';
				break;
			case '2':
				$serviceUnitId = 'C';
				break;
			case '3':
				$serviceUnitId = 'P';
				break;
			case '4':
				$serviceUnitId = 'K';
				break;
		}
		$import = str_replace('.',',',$realunities*$ficha['price']);

		$observations = $orderdetail['observations'];
	}

	$unities = ($unities == 0 ? null : $unities );
	

	if ($ArticuloBotanico == false ) {
		$ficha['boxes_per_floor'] = 0;
		$ficha['carri_floor'] = 0;
		$ficha['per_box'] = 0;
		$carriProducte = 0;
	}
	$columnaUnidades = "<div class='col-md-12 col-sm-6 col-xs-6'>".
	$this->Form->input('Unities',array('class'=>'unidades','div'=>false,'onkeypress' => 'validaEntero(event)','onblur'=>$functionOnBlur,'label' => false, 'id' => 'Unities'.$idArticle, 'name'=>'Unities'.$idArticle, 'value' => $unities, 'placeholder'=> 0)).
	$this->Form->input('boxes_per_floor',array('id' => 'boxesfloor'.$idArticle,'type' => 'hidden', 'value' => $ficha['boxes_per_floor'])).
	$this->Form->input('carri_floor',array('id' => 'carrifloor'.$idArticle,'type' => 'hidden', 'value' => $ficha['carri_floor'])).
	$this->Form->input('perbox',array('id' => 'perbox'.$idArticle,'type' => 'hidden', 'value' => $ficha['per_box'])).
	$this->Form->input('article_id',array('id' => 'articleId'.$idArticle,'type' => 'hidden', 'value' => $idArticle)).
	$this->Form->input('price',array('id' => 'price'.$idArticle,'type' => 'hidden', 'value' => $ficha['price'])).
	$this->Form->input('carrisarticle',array('id' => 'carrisarticle'.$idArticle,'type' => 'hidden', 'value' => $carriProducte)).
	$this->Form->input('cashorderdetail',array('id' => 'cashorderdetail'.$idArticle,'type' => 'hidden', 'value' => 0)).
	$this->Form->input('cash_order',array('id' => 'cash_order'.$idArticle,'type' => 'hidden', 'value' => $cash_order));

	

	$optionAdd = array();

	if ($ArticuloBotanico) {
		
		if ($ficha['show_unities'] == 1) {
			$optionAdd['U'] = __('Unidades');
		}
		if ($ficha['show_boxes'] == 1) {
			$optionAdd['C'] = __('Cajas');
		}
		$optionAdd['P'] = __('Pisos');
		$optionAdd['K'] = __('Carris');
	} else
	{
		$optionAdd['U'] = __('Unidades');
	}



	$columnaUnidades .= $this->Form->input('UnitiesServices',array('onchange'=>$functionOnBlur,'class'=>'unidadesServicio','div'=>false,'id' => 'UnitiesServices'.$idArticle,'label' => false,'options' => $optionAdd,'selected' => $serviceUnitId));

	$columnaUnidades .= "</div><div class='col-md-12 col-sm-6 col-xs-6'>";
	$columnaUnidades .= $this->Form->input('realunities',array('readonly' => 'readonly','class'=>'unidades','div'=>false,'label' => false,'placeholder' => '0','id' => 'realunities'.$idArticle, 'value' => $realunities));
	$columnaUnidades .= $this->Form->input('import',array('readonly' => 'readonly','class'=>'importe','div'=>false,'label' => false, 'id' => 'import'.$idArticle,'placeholder' => $import, 'value' => $import));
	//$columnaUnidades .= "</div><div class='observacionesLinea'>";
	$columnaUnidades .= "</div><div class='col-md-12 col-sm-12 col-xs-12'>".$this->Form->input('customerobservations'.$idArticle,array('type' => 'textarea','div'=>false, 'cols' => '20','rows' => '2','label' => false,'onblur'=>$functionOnBlur, 'value' => $observations))."</div>";


	if ($article['CatalogueArticle']['novelty'] == 1 ) {
		$columna5 = $columnaUnidades;
	} else {
		$columna4 = $columnaUnidades;
	}

}

/*$tableHtml .= '<thead class="detalle"><tr><th class="col-md-4 col-sm-4 col-xs-5">'.__('Fotografía / Estat actual').'</th>';
$tableHtml .= '<th class="col-xs-7 col-md-4 col-sm-4">'.__('Informació planta').'</th>';
$tableHtml .= '<th class="col-md-4 col-sm-4 col-xs-12">'.__('Observacions Corma').'</th>';

$tableHtml .= '</tr></thead><tbody>';*/





if ($option == 'disponible') 
{
	if ($article['CatalogueArticle']['novelty'] == 1 ) {
		$aCell = '<td colspan=4><div class="col-md-2 col-sm-2 col-xs-5" style="text-align: center;">'.$columna1.'</div><div class="col-xs-5 col-md-3 col-sm-3">'.$columna2.'</div><div class="col-xs-2 col-md-1 col-sm-1">'.$columna3.'</div><div class="col-md-3 col-sm-3 col-xs-12 observations">'.$columna4.'</div><div class="col-md-3 col-sm-3 col-xs-12 tdComanda">'.$columna5.'</div></td>';
	}
	else {
	$aCell = '<td colspan=4><div class="col-md-2 col-sm-2 col-xs-5" style="text-align: center;">'.$columna1.'</div><div class="col-xs-7 col-md-4 col-sm-4">'.$columna2.'</div><div class="col-md-3 col-sm-3 col-xs-12 observations">'.$columna3.'</div><div class="col-md-3 col-sm-3 col-xs-12 tdComanda">'.$columna4.'</div></td>';
	}
}
else {
//	$aCell = 'aaa';
	$aCell = '<td colspan=3><div class="col-md-4 col-sm-4 col-xs-5">'.$columna1.'</div><div class="col-xs-7 col-md-4 col-sm-4">'.$columna2.'</div><div class="col-md-4 col-sm-4 col-xs-12 observations">'.$columna3.'</div></td>';	
}
echo $aCell;


/*

function myUrlEncode($string) {
    $entities = array(' ','', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
    $replacements = array('-','!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, strtolower($string));
}*/