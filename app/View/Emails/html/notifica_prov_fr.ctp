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
<h2 style="font-family:Arial;">Informations sur le traitement des données</h2>
</div>

<br /><br />
<?php 
$style_p = "font-family:Arial;color:#727272;line-height: 1.2em;text-align:justify;padding-left:20px;padding-right:20px;padding-bottom:10px;";
?>


<p style="<?=$style_p;?>">Cher usager,</p>

<p style="<?=$style_p;?>">Depuis Corma SCCL, nous vous informons que nous traitons vos données afin de vous informer de ses produits et services. <strong>Et nous souhaitons continuer à le faire!</strong></p>
<p style="<?=$style_p;?>">Le nouveau règlement général sur la protection des données (règlement (UE) 2016/679) requiert le consentement explicite pour ce type de traitement de données. Pour cette raison, nous vous demandons, au cas où vous souhaiteriez continuer à figurer dans notre liste de distribution d'informations, de le confirmer.</p>

<br /><br />
<p>
	<div style="text-align:center">
	
	<?php 

	$style = "text-decoration: none;font-weight: bold;color:#ffffff;text-align: center;letter-spacing: 0px;background-color: #009969;padding:14px;font-family:Arial;";
	echo "<a href='".$url."/intranet/providers/confirm/".$hash."' style='".$style."' class='boton' target='blank'>J'ACCEPTE DE CONTINUER A RECEVOIR DES INFORMATIONS</a>";
	?>


</div>
</p>
<br /><br />
<p>
	<div style="text-align:center">
	
<?php 
	$style = "font-family:Arial;text-decoration: none;color:#2c9ab7;";
	echo "<a href='".$url."/intranet/providers/cancel/".$hash."' target='blank' style='".$style."'>Je souhaite annuler l'abonnement</a>";
?>
</div>

</p>


<br /><br />

<p style="font-family:Arial;font-size:10px;text-decoration: underline;line-height: 1.2em;color:#727272">Informations de base sur la protection des données personnelles</p>

<?php $style= "font-family:Arial;font-size:10px;line-height: 1.2em;color:#727272;";?>
<p style="<?=$style;?>">Responsable du traitement: Corma SCCL, Camí del mig, 20, de Premià de Dalt (CP 08338). Tél .: 937549000, corma@corma.es.</p>
<p style="<?=$style;?>">Objectif: envoi des informations Corma.</p>
<p style="<?=$style;?>">Légitimation: consentement de la personne concernée. L'intéressé peut révoquer le consentement à tout moment.</p>
<p style="<?=$style;?>">Destinataires: aucune donnée n'est communiquée à d'autres personnes.</p>
<p style="<?=$style;?>">Droits des personnes intéressées: vous pouvez exercer les droits d'accès, de rectification, de suppression, d'opposition au traitement et de demande de limitation, en contactant Corma.</p>








 













