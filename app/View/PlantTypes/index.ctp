
<!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	

	<?php echo $this->Html->charset(); ?>
	<title><?php //echo $title_for_layout; ?></title>
	<?php 
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('limitless','widgets','sprites/stylesheets/layout','sprites/stylesheets/responsive','font-awesome.min','font-awesome-ie7.min','estilo'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
-->
<p>
	<?php echo __('Busca lo que te haga falta. Y hazlo como te sea más conveniente: por nombre, por tipología, por utilización…Escoge en función de lo que necesites. Seguro que lo encuentras. Pero si, a pesar de todo, no fuera así, estaremos a tu lado para lo que sea necesario.  ')."<a href='https://".$_SERVER['HTTP_HOST']."/corma/contacto/'>".__('Llama o envía un correo...').'</a> '.__('Te responderemos enseguida. Como te mereces.');
	?>
</p>

<style>
.planttype {
	background-color: #000;
    opacity: 0.6;
    color: rgb(255, 255, 255);
    text-align: center;
}
p.planttype {
	width:100%;
	margin-left:0px !important;
	margin-right:0px !important;
	margin-top: 50% !important;
}
.tipologies {
	width:80%;
	margin-left:10%;
	margin-right:10%;
}
</style>


<div class="tipologies">
	<?php 

	foreach ($plantTypes as $plantType) {		
		
		$imatge = "https://www.corma.es/intranet/img/plant_types/".$plantType['PlantType']['id'].".jpg";	

		echo '<div class="col-md-3 col-sm-4 col-xs-6" style="background-image: url('.$imatge.'); height: 180px;padding:0px">';

			$link = "https://www.corma.es/lista-productos/?t=".$plantType['PlantType']['id'];
			$title = $plantType['PlantType']['description'];
			echo "<a href='".$link."'><p class='planttype'>".$title."</p></a>";
		echo '</div>';
	} 
	?>
</div>