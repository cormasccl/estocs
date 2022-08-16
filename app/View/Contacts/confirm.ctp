







<div class="row">

	<div class="col-md-12">

<?php


if ($resultado =='ok') {
	if ($idioma == 'es') {
		$mensaje = 'Gracias por confirmar tu suscripción a Corma';
	} else {
		$mensaje = 'Merci de confirmer votre inscription à Corma';
	}
} else {
	if ($idioma == 'es') {
		$mensaje = 'No ha sido posible confirmar la suscripción. Email incorrecto.';
	} else {
		$mensaje = "Il n'a pas été possible de confirmer l'abonnement. Email incorrect.";
	}
}



if ($resultado == 'ok') {
	echo "<div class='alert alert-success' role='alert'>".$mensaje."</div>";
} else {
	echo "<div class='alert alert-danger' role='alert'>".$mensaje."</div>";
}
?>

</div>
</div>