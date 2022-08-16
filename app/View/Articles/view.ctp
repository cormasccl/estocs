<?php

$ficha = $article['Product'];
?>

<div class="col-md-3">
	<?php
	echo "<img src='https://www.corma.es/articles/".$article['Article']['image']."' width='200px'>";
	?>
</div>
<div class="col-md-9">
<h2><?php echo $article['Article']['name'];?></h2>
<h4><?php 
echo $ficha['description'];
if (!empty($ficha['common_name'])) {
	echo ' ('.$ficha['common_name'].')';
}
?></h4>
<p><?php 
echo '<strong>',__('Exposición').': </strong>';
echo $ficha['Exposition']['description'].'&nbsp;&nbsp;&nbsp;&nbsp;';
echo $this->Html->image($ficha['Exposition']['image'], array('alt'=>$ficha['Exposition']['description'], 'title'=>$ficha['Exposition']['description']));
?></p>

<p><?php 
echo '<strong>',__('Riego').': </strong>';
echo $ficha['Irrigation']['description'].'&nbsp;&nbsp;&nbsp;&nbsp;';
echo $this->Html->image($ficha['Irrigation']['image'], array('alt'=>$ficha['Irrigation']['description'], 'title'=>$ficha['Irrigation']['description']));
?></p>

<p><?php 
echo '<strong>',__('Temperatura').': </strong>';
echo $ficha['temperature'].'&nbsp;&nbsp;&nbsp;&nbsp;';
echo $this->Html->image($ficha['Temperature']['image'], array('alt'=>$ficha['Temperature']['name'], 'title'=>$ficha['Temperature']['name']));
?></p>

</div>



<?php


//debug($article);

?>