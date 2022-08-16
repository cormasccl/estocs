<?php

$urlBase = $this->get('urlActual');


?>

<div class="col-md-6">

	<br /><br /><br />
	<?php
		$messageGood = $this->Session->flash('send_ok');
		$messageBad  = $this->Session->flash('send_error');

		if ($messageGood) {
		    echo "<div class='alert alert-success'>";
		    echo $messageGood;
		    echo "</div>";
		}

		if ($messageBad) {
		    echo "<div class='alert alert-danger'>";
		    echo $messageBad;
		    echo "</div>";
		}
	?>
	<a href="<?php echo $urlBase;?>/Customers">
		<i class="btn btn-default fa fa-shopping-cart">
			<span><?php echo '  '.__('Volver al disponible semanal');?></span>
		</i>
	</a>


</div>

<div class="col-md-6">
<?php
echo $this->Html->Image('almacen.jpg', array('class'=>'sombra'));
?>
</div>
