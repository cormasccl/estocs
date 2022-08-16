<style>
.imgThumb img{
	margin-bottom:10px;
}
.ProductTitle h1 {
  font-size:30px !important;
}
</style>

<script>
	j = jQuery.noConflict();
    j(function() {
      j.responsiveHub({
        layouts: {
          480:  "phone",
          481:  "small-tablet",
          731:  "tablet",
          981:  "web"
        },
        defaultLayout: "web"
      });
    });
  </script>

<br />



<?php
$urlBase = $this->get('urlActual');
?>

<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="row ProductTitle">
		<?php echo "<h1><strong>".ucfirst(strtolower($ficha['Product']['description'])).'</strong></h1>'; ?>
		<span class="spacer"></span>
	</div>


<?php
	echo $this->element('ficha', array('ficha', $ficha));
	?>
</div>





<?php
function myUrlEncode($string) {
    $entities = array(' ','', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
    $replacements = array('-','!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    $string = str_replace($replacements,$entities,  strtolower($string));

    return str_replace(" ","-", $string);
}

?>