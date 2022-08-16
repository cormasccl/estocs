<?php


//$url = "http://cormaweb.site";
$url = "https://www.corma.es";


?>

<style>

.boton {
	font-family:'Arial';
	text-decoration: none;
	font-weight: bold;
	color:#ffffff;
	text-align: center;letter-spacing: 0px;background-color: #009969;padding:14px;
}
a {
	font-family: "Arial";
}
</style>

<img src="https://www.corma.es/logo.png"><br />
<img src="https://www.corma.es/banner.png" width="100%"><br />


<div style="text-align:center">
<h2 style="font-family:Arial;">Información sobre el tratamiento de datos</h2>
</div>

<br /><br />
<?php 
$style_p = "font-family:Arial;color:#727272;line-height: 1.2em;text-align:justify;padding-left:20px;padding-right:20px;padding-bottom:10px;";
?>


<p style="<?=$style_p;?>">Bienvenido, bienvenida,</p>

<p style="<?=$style_p;?>">Corma SCCL le informa que trata sus datos con el fin de informarles de sus productos y servicios. <strong>¡Queremos seguir haciéndolo!</strong></p>
<p style="<?=$style_p;?>">El nuevo Reglamento General de Protección de Datos (Reglamento (UE) 2016/679) exige disponer del consentimiento explícito para esta clase de tratamiento de datos. Por este motivo le solicitamos que, en caso de que estén interesados en seguir figurando en nuestra lista de distribución de información, nos lo confirme.</p>

<br /><br />
<p>
	<div style="text-align:center">
	
	<?php 

	$style = "text-decoration: none;font-weight: bold;color:#ffffff;text-align: center;letter-spacing: 0px;background-color: #009969;padding:14px;font-family:Arial;font-size:12px;";
	echo "<a href='".$url."/intranet/contacts/confirm/".$hash."' style='".$style."' class='boton' target='blank'>ACEPTO SEGUIR RECIBIENDO INFORMACIÓN</a>";
	?>


</div>
</p>
<br /><br />
<p>
	<div style="text-align:center">
	
<?php 
	$style = "font-family:Arial;text-decoration: none;color:#2c9ab7;";
	echo "<a href='".$url."/intranet/contacts/cancel/".$hash."' target='blank' style='".$style."'>Quiero cancelar la subscripción</a>";
?>
</div>

</p>


<br /><br />

<p style="font-family:Arial;font-size:10px;text-decoration: underline;line-height: 1.2em;color:#727272">Información básica de protección de datos personales</p>

<?php $style= "font-family:Arial;font-size:10px;line-height: 1.2em;color:#727272;";?>
<p style="<?=$style;?>">Responsable del tratamiento: Corma SCCL, Camí del mig, 20, de Premià de Dalt (CP 08338). Tel. 937549000, corma@corma.es.</p>
<p style="<?=$style;?>">Finalidad: envío de información de Corma.</p>
<p style="<?=$style;?>">Legitimación: consentimiento de la persona interesada. La persona interesada puede revocar el consentimiento en cualquier momento.</p>
<p style="<?=$style;?>">Destinatarios: no se comunican datos a otras personas.</p>
<p style="<?=$style;?>">Derechos de las personas interesadas: puede ejercer los derechos de acceso, rectificación, supresión, oposición al tratamiento y solicitud de limitación, dirigiéndose a Corma.</p>



