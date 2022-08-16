
<br />
<br />
<br />
<div class="col-md-12">
<?php


echo '<p>'.__('Se ha duplicado correctamente el pedido.').' Se han añadido los siguientes artículos: </p>';
echo "<ul>";
foreach ($articlesAfegits as $art) {
	echo "<li>".$art['name']."</li>";
}
echo "</ul>";

if (count($articlesNoAfegits)>0) {
	echo '<p>'.__('Los siguientes artículos no se han añadido debido a que esta semana ya no están disponibles:').'</p>';
	echo "<ul>";
	foreach ($articlesNoAfegits as $art) {
		echo "<li>".$art['name']."</li>";
	}
	echo "</ul>";
}


$url = $this->get('urlActual');
?>

<a href="<?=$url;?>/Catalogues/index" class="btn btn-success buttonsLeftCustomer" ><i class="fa fa-shopping-cart"></i><span><?php echo '   '.__('Continuar');?></span></a>


</div>