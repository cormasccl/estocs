
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>

body {
	background-color: #ffffff;
	font-family: verdana;
}
span {
	font-size: 10px;
	text-align: center;
}
.contenedor {
	margin:10px;
}
.imatge {
	text-align: center;
}
</style>
</head>
<body>

<div class="contenedor">
<?php





$cont = 0;
$url = "https://www.corma.es/intranet/img/products/thumbs/";

echo "<form id='changeThumbs'>";
foreach ($imatges as $img) {
	$cont++;
	echo "<div class='col-md-2 imatge'>";
	echo "<img src='".$url.$img['product_images']['image']."'><br />";
	//echo "<input type='radio' name='imgDefault' value='".$img['product_images']['image']."'>   <span>".$cont."</span>";


	echo "<label class='radio-inline'>";
	echo "  <input type='radio' name='inlineRadioOptions' id='inlineRadio1' value='".$img['product_images']['image']."'> ".$cont;
	echo "</label>";


	echo "</div>";
}
echo "<br />";
echo "<input type='submit' value='Cambiar imagen defecto'>";
echo "</form>";


?>

</div>

</body>