<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

//$cakeDescription = __d('cake_dev', 'Disponible - CORMA');
//$cakeVersion = __d('cake_dev', 'Disponible CORMA')
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<link rel="apple-touch-icon" sizes="57x57" href="/img/icon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/img/icon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/img/icon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/img/icon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/img/icon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/img/icon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/img/icon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/img/icon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/img/icon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/img/icon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/img/icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/img/icon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/img/icon/favicon-16x16.png">
	<link rel="manifest" href="/img/icon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/img/icon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	

	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout;?></title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('limitless','widgets','font-awesome.min','font-awesome-ie7.min','estilo'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>

<div class="theme-header col-md-12">
	<div id="top-bar" style="" class="clearfix  header-cons-static header-construtor">
		<div class="skeleton auto_align clearfix" itemscope="" itemtype="http://schema.org/SiteNavigationElement">
			<div class="col-md-2 col-xs-6 sectionlogo">
				<?php echo $this->Html->image('logo_corma_150px.jpg', array('class'=>'logo'));?>
			</div>

			<div class="col-md-8 col-xs-12 top_layers right clearfix">
				<?php if (!empty($catalogue)) {
					echo $this->element('menu_top',array('cataleg' => $catalogue[0]['Catalogue']));
				?>
			</div>


			<div class="col-md-12 col-sm-12 col-xs-12">			
				<div class="col-md-offset-7 col-md-5 col-sm-offset-4 col-sm-8 col-xs-12">
					<div class="col-md-3 col-sm-3 col-xs-8">
						<strong><?php echo __('Total €');?></strong>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-4">
						<span id="tdImpTotalVisible"><?php echo str_replace('.',',', number_format($total['importTotal'],2));?></span> €
						<span id="tdImpTotal" class="invisible"><?php echo str_replace('.',',', $total['importTotal']);?></span>
					</div>
					<div class="col-md-5 col-sm-4 col-xs-8">
						<strong><?php echo __('Total carris teòrics');?></strong>
					</div>
					<div class="col-md-1 col-sm-2 col-xs-4">
						<span id="tdCarris"><?php echo str_replace('.',',', $total['carrisTotal']);?></span>
					</div>
				</div>
			</div>
			<?php }?>
		</div>

	<div class="col-md-12 col-xs-12">
		<div class="col-md-2">
			<?php
			if (!empty($catalogue)) {
				echo $this->element('menu_left',array('cataleg' => $catalogue[0]['Catalogue']));
			}
			?>
		</div>
		<div class="col-md-10">
			<div id="container">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</div>


	<div id="footer">
		<?php /*echo $this->Html->link(
				$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
				'http://www.cakephp.org/',
				array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
			);*/
		?>
		<p>
			<?php //echo $cakeVersion; ?>
		</p>
	</div>
	<?php // echo $this->element('sql_dump'); ?>
</body>
<style>
.agent {
	background-color: #eee;
	padding: 10px;
	-webkit-box-shadow: 7px 4px 6px -3px #333333;
    -moz-box-shadow: 7px 4px 6px -3px #333333;
    box-shadow: 7px 4px 6px -3px #333333;
    border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
}
.client {
	background-color: #eee;
	padding: 10px;
	-webkit-box-shadow: 7px 4px 6px -3px #333333;
    -moz-box-shadow: 7px 4px 6px -3px #333333;
    box-shadow: 7px 4px 6px -3px #333333;
    border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
}
</style>
</html>
