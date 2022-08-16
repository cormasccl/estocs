<?php
echo $this->Html->script(array(
  'fancybox'
));


?>

<style>
	.borderPhoto {
		border:2px white solid;
	}
	.boxArticle {
		box-sizing: border-box;
    	border: 1px solid #e6e6e6;
    	background: #fff;
		margin:5px;
		
	}
	.novedades {
		width:80%;
		margin-left:10%;
		margin-right:10%;
	}
	.boxArticle td {
		padding:0px;
	}
</style>


<div class="page-wrapper page">
	<div class="skeleton clearfix auto_align">

	<?php

	$urlBase = "https://www.corma.es/intranet";

	foreach ($articleNovelty as $row) {	
		$article = $row['Article']['Article'];
		$product = $row['Article']['Product'];

		?>

		<div class="col-md-4 boxArticle">
			<table>
				<tr>
					<td width="30%">
						<?php
						$urlImage = $urlBase.'/img/articles/'.$article['image'];
						$urlImageThumb = $urlBase.'/img/articles/thumbs/'.$article['image'];
						?>

						<a class='fancybox-thumb' rel='fancybox-thumb' href="<?=$urlImage;?>" >

							<?php 
							echo $this->Html->Image($urlImageThumb, array( 'class'=>'borderPhoto'));
							?>

						</a>
						<p><?php echo $row['description'];?></p>
					</td>
					<td class="magic-list-wrapper" style="padding-top: 10px;">			
						<ul class="clearfix magic-list" itemscope="" itemtype="http://schema.org/ItemList">
							<li class="clearfix chain-link">
								<div class="desc-area">
								    <h4 itemprop="name">
								    	<?php echo $article['name'];?>
									</h4>
							        <div itemprop="description" class="clearfix desc">
							            <p><?php echo $product['Product']['description'];?></p>
							            <p><?php echo $product['Product']['common_name'];?></p>
			                  		</div>
				            	</div>
				            </li>
			            	<li class="clearfix chain-link">
								<div class="desc-area">			                	
			                 		<div itemprop="description" class="clearfix desc">
				                  		<p><?php
						            		echo $this->Html->image($product['Exposition']['image'], array('alt'=>$product['Exposition']['description'], 'title'=>$product['Exposition']['description'], 'width'=>'20'));
						            		?><span class="space"></span>
				                  			<?php echo $product['Exposition']['description'];?>
				                  		</p>
			                  		</div>
				            	</div>
				            </li>
				            <li class="clearfix chain-link">
								<div class="desc-area">			                	
			                 		<div itemprop="description" class="clearfix desc">
				                  		<p><?php
						            		echo $this->Html->image($product['Irrigation']['image'], array('alt'=>$product['Irrigation']['description'], 'title'=>$product['Irrigation']['description'], 'width'=>'20'));
						            		?><span class="space"></span>
				                  			<?php echo $product['Irrigation']['description'];?>
				                  		</p>
			                  		</div>
				            	</div>
				            </li>

				            <li class="clearfix chain-link">
								<div class="desc-area">			                	
			                 		<div itemprop="description" class="clearfix desc">
				                  		<p><?php
						            		echo $this->Html->image($product['Temperature']['image'], array('alt'=>$product['Temperature']['name'], 'title'=>$product['Temperature']['name'], 'width'=>'20'));
						            		?><span class="space"></span>
				                  			<?php echo $product['Product']['temperature'];?>
				                  		</p>
			                  		</div>
				            	</div>
				            </li> 		
						</ul>
					</td>
				</tr>
			</table>
		</div>

		<?php
	}

?>

</div>
</div>