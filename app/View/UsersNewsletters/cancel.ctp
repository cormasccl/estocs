


<div class="row">

	<div class="col-md-12">

<?php


if ($resultado =='ok') {
	if ($idioma == 'es') {
		$mensaje = 'Gracias por confiar en Corma. Se ha realizado correctamente tu petición de baja.';
	} else {
		$mensaje = 'Corma vous remercie de votre confiance. Votre désinscription a été correctement effectuée.';
	}
} else {
	if ($idioma == 'es') {
		$mensaje = 'No ha sido posible cancelar la subscripción. Email incorrecto.';
	} else {
		$mensaje = "Il n'a pas été possible d'annuler l'abonnement. Email incorrect.";
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