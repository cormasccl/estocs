<?php

$cataleg = $user['Catalogue'];

echo $this->Html->script(array(
  'selectcatalog'
), array('inline' => false));
?>
<link href="https://fonts.googleapis.com/css?family=Oswald:400,700,300&effect=outline|3d|3d-float|putting-green|wallpaper" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700|Gloria+Hallelujah|Indie+Flower|Open+Sans:700,400" rel="stylesheet" type="text/css">
</table>
<div class="col-sm-12 col-xs-12 col-md-12">
	<?php echo __('Bienvenido a la área privada, seleccione lo que quiere hacer').' :';?>
	<div style="margin-top:30px;" class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-md-9 col-sm-9 col-xs-9">
		<button type="button" onclick="selectCatalog(this)" id="btncompra" class="btn btn-info no-gutter"><?php echo __('QUIERO<br />COMPRAR');?></button>
		&nbsp;
		<button type="button" onclick="selectCatalog(this)" id="btncatalogo" class="btn btn-info no-gutter"><?php echo __('QUIERO CONSULTAR<br />CATÁLOGO');?></button>
	</div>
</div>
