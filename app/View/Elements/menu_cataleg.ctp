<?php

$extra = '';
/*
if ($_SERVER['HTTP_HOST'] == 'corma.site') {
	$urlBase = "http://corma.site";
} elseif ($_SERVER['HTTP_HOST'] == 'cormaweb:8080') { 
	$urlBase = "http://cormaweb:8080";
} else {
	$urlBase = "http://81.46.212.35/corma/intranet";
}*/
$urlBase = $this->get('urlActual');
?>

<style>
.menu-disponible {
	background-color: #ffffff !important;
	
}
.top-area-wrapper div.top-area .menu2>li>a {
	color:#6E6B67 !important;
	font-size:12px !important;
}
.top-area-wrapper div.top-area .menu-bar .menu2 li:hover>a {
	color:#ffffff !important;
	text-decoration: underline;
	border-radius: 4px !important;

}

.menu_disponible {
	list-style: none;
	
}
.top-area-wrapper div.top-area .menu-bar .menu2>li.current-menu-item>a {
	background-color: #6E6B67 !important;
	color:#ffffff !important;
	text-decoration: none !important;
	border-radius: 4px;

}
.top-area-wrapper div.top-area .menu-bar .sub-menu2 li a {
    color: #6e6b67 !important;
}
.top-area-wrapper div.top-area .menu-bar .sub-menu2 li:hover>a {
    color: #6e6b67 !important;
}
ul.menu_disponible{
	width:100% !important;
}
div.theme-header .menu-bar .menu li a {
	font-family: "Open Sans";
}
</style>


<div class="col-md-12 col-xs-12 header-cons-area" style="z-index:-1">
	<div data-offset-top="0" class="top-area-wrapper  header-cons-static">
		<div class="top-area  header-construtor" style="">
			<div class="clearfix skeleton  auto_align" itemscope="" itemtype="http://schema.org/SiteNavigationElement">
				<div class="menu_layers  right clearfix">
					<div class="menu-wrapper right" data-effect="None" style=""> 
						<div class="menu-bar menu-disponible">
                            <div class="clearfix">
                                <ul id="menu-main-menu" class="menu clearfix menu2" style="z-index:100">
									<?php
								  	if (!empty($filter)) {
										$extra = '';
								  		if ($filter == 'motora') {
								  			$extra = 'current-menu-item';
								  		}
								  	}
							  		?>
								  	<li id="menu-item-motores" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home relative <?php echo $extra;?>">
								  		<a href="<?=$urlBase;?>/SeasonCatalogues/index/motora"><?php echo __('Plantes motores');?><span class="spacer"></span><span class="menu-tail"></span></a>
								  		<div class="hoverdir-wrap"><span class="hoverdir" style="display: block; left: 0px; top: 100%; transition: all 300ms ease;"></span></div>
								  	</li>
									<?php
								  	if (!empty($filter)) {
										$extra = '';
								  		if ($filter == 'collection') {
								  			$extra = 'current-menu-item';
								  		}
								  	}
							  		?>
								  	<li id="menu-item-coleccions" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home relative <?php echo $extra;?>">
								  		<a href="<?=$urlBase;?>/SeasonCatalogues/index/collection">
								  			<?php echo __('Col·leccions exclusives');?>
								  			<span class="spacer"></span>
								  			<span class="menu-tail"></span>
								  		</a>
								  		<div class="hoverdir-wrap">
								  			<span class="hoverdir" style="display: block; left: 0px; top: 100%; transition: all 300ms ease;"></span>
								  		</div>
								  		<ul class="sub-menu  sub-menu2 clearfix">
								  			<?php
											foreach ($collections as $col) {
												$url = $urlBase.'/SeasonCatalogues/index/collection/1/'.$col['id'];
												$nom = $col['description'];

												echo "<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-37   rel'><a href='".$url."'>".$nom."</a>";
												echo '<div class="hoverdir-wrap"><span style="background:" class="hoverdir"></span></div>';
												echo "</li>";
											}
											?>
								  		</ul>
								  	</li>
								  	<?php
								  	if (!empty($filter)) {
										$extra = '';
								  		if ($filter == 'gamma') {
								  			$extra = 'current-menu-item';
								  		}
								  	}
							  		?>
								  	<li id="menu-item-gamma" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-has-children relative <?php echo $extra;?>">
								  		<a href="<?php echo $urlBase;?>/SeasonCatalogues/index/gamma">
								  			<?php echo __('Gamma');?>
								  			<span class="spacer"></span>
								  			<span class="menu-tail"></span>
								  		</a>
								  		<div class="hoverdir-wrap"><span class="hoverdir" style="display: block; left: 0px; top: 100%; transition: all 300ms ease;"></span></div>

								  		<ul class="sub-menu  sub-menu2 clearfix">
								  			<?php

								  			foreach ($classificacions as $classificacio) {
												if ($classificacio['season_catalogue_classification_id'] == null) {


													$url = $urlBase."/SeasonCatalogues/index/gamma/1/".$classificacio['id'];



													$nom = ucfirst(mb_strtolower($classificacio['description'],'UTF-8'));


													echo "<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-37   rel'><a href='".$url."'>".$nom."</a>";
													echo '<div class="hoverdir-wrap"><span style="background:" class="hoverdir"></span></div>';


													echo "<ul class='sub-menu sub-menu2 clearfix'>";
													foreach ($classificacio['SeasonCatalogueClassification'] as $subclassificacio) {

														/*$nom = utf8_encode(ucfirst(strtolower($subclassificacio['description'])));*/
														$nom =  ucfirst(mb_strtolower($subclassificacio['description'],'UTF-8'));


														$url = $urlBase."/SeasonCatalogues/index/gamma/1/".$subclassificacio['id'];
														echo "<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-37   rel '><a href='".$url."'>".$nom."</a></li>";
													}
													echo "</ul></li>";
												}
											}
											?>
								  		</ul>
								  	</li>
								 </ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>