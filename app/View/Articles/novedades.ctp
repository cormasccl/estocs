<!--<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->

<?php
	/*echo $this->Html->meta('icon');

	echo $this->Html->css(array('limitless','widgets','sprites/stylesheets/layout','sprites/stylesheets/responsive','font-awesome.min','font-awesome-ie7.min','estilo','jquery.fancybox.css?v=2.1.5'));


		echo $this->Html->script(array('jquery.fancybox.pack.js?v=2.1.5'));*>
 	 ?>

<!--<link href="http://fonts.googleapis.com/css?family=Raleway:400,800,300" rel="stylesheet" type="text/css">-->

<?php 
/*
echo $this->Html->script(array('bootstrap.min'));


echo $this->Html->css(array('chosen.min','estilo','zoe'));
	echo $this->Html->script(array(
		'chosen.jquery.min'
		), array('inline' => false));


	echo $this->Html->script(array(
  'fancybox'
), array('inline' => false));

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');

*/


?>
<style>
	.borderPhoto {
		border:2px white solid;
	}
	.boxArticle {
		box-sizing: border-box;
    border: 1px solid #e6e6e6;
    background: #fff;
		margin:10px;
		padding:5px;
	}
.novedades {
	width:80%;
	margin-left:10%;
	margin-right:10%;
}
</style>


<div class="page-wrapper page">
	<div class="skeleton clearfix auto_align">

<?php

//$urlBase = $this->get('urlActual');
$urlBase = "https://www.corma.es/intranet";
//debug($novedades);


	foreach ($novedades as $article) {	
		?>

		<div class="col-md-4 boxArticle">

			

			<div class="row mutual-content-wrap">
				<div class="col-md-4">

					<?php
					$urlImage = $urlBase.'/img/articles/'.$article['Article']['image'];
					$urlImageThumb = $urlBase.'/img/articles/thumbs/'.$article['Article']['image'];
					?>

					<a href="<?=$urlImage;?>" class="various fancybox.ajax" >

						<?php 
						echo $this->Html->Image($urlImageThumb, array('height'=>150, 'class'=>'borderPhoto'));
						?>

					</a>
					<p><?php echo $article['Article']['description_novelty'];?></p>
				</div>
				<div class="col-md-6 magic-list-wrapper">
					<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
						<li class="clearfix chain-link">
							<div class="desc-area">
							    <h4 itemprop="name">
							    	<?php echo $article['Article']['name'];?>
								</h4>
						        <div itemprop="description" class="clearfix desc">
						            <p><?php echo $article['Product']['description'];?></p>
						            <p><?php echo $article['Product']['common_name'];?></p>
		                  		</div>
			            	</div>
			            </li>
		            	<li class="clearfix chain-link">
							<div class="desc-area">			                	
		                 		<div itemprop="description" class="clearfix desc">
			                  		<p><?php
					            		echo $this->Html->image($article['Product']['Exposition']['image'], array('alt'=>$article['Product']['Exposition']['description'], 'title'=>$article['Product']['Exposition']['description'], 'width'=>'20'));
					            		?><span class="space"></span>
			                  			<?php echo $article['Product']['Exposition']['description'];?>
			                  		</p>
		                  		</div>
			            	</div>
			            </li>
			            <li class="clearfix chain-link">
							<div class="desc-area">			                	
		                 		<div itemprop="description" class="clearfix desc">
			                  		<p><?php
					            		echo $this->Html->image($article['Product']['Irrigation']['image'], array('alt'=>$article['Product']['Irrigation']['description'], 'title'=>$article['Product']['Irrigation']['description'], 'width'=>'20'));
					            		?><span class="space"></span>
			                  			<?php echo $article['Product']['Irrigation']['description'];?>
			                  		</p>
		                  		</div>
			            	</div>
			            </li>

			            <li class="clearfix chain-link">
							<div class="desc-area">			                	
		                 		<div itemprop="description" class="clearfix desc">
			                  		<p><?php
					            		echo $this->Html->image($article['Product']['Temperature']['image'], array('alt'=>$article['Product']['Temperature']['name'], 'title'=>$article['Product']['Temperature']['name'], 'width'=>'20'));
					            		?><span class="space"></span>
			                  			<?php echo $article['Product']['temperature'];?>
			                  		</p>
		                  		</div>
			            	</div>
			            </li>
					            		
					            		
					</ul>					
				</div>
			</div>
		</div>


		<?php
	}

?>

</div>
</div>