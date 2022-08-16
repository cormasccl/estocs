<?php


//$urlBase = 'http://'.$_SERVER['HTTP_HOST'].'/';//"http://corma.es/";


//print_r($_SERVER['HTTP_HOST']);
//print_r("<br />");
$urlWordpress = 'https://';
$url = ($_SERVER['HTTP_HOST'] == '81.46.196.226') ? '/corma/' : '/';
$urlWordpress .= $_SERVER['HTTP_HOST'].$url;


//print_r($urlWordpress);

/*print_r($this->get('urlActual'));
print_r("<br>");
print_r($_SERVER['HTTP_HOST']);

print_r("<br>");
print_r($_SERVER['REQUEST_URI']);


urlActual				/corma/intranet
$_SERVER['HTTP_HOST']	81.46.212.35
$_SERVER['REQUEST_URI']	/corma/intranet/Catalogues/


urlActual				/intranet
$_SERVER['HTTP_HOST']	corma.es
$_SERVER['REQUEST_URI']	/intranet/Catalogues/


urlActual				/intranet
$_SERVER['HTTP_HOST']	localhost
$_SERVER['REQUEST_URI']	/corma_servidor/Catalogues

*/

$idioma = $this->Session->read('Config.language');

switch ($idioma) {
	case 'cat':
		$prefix = 'ca/';
		break;
	case 'fra':
		$prefix = 'fr/';
		break;
	case 'ale':
		$prefix = 'de/';
		break;
	case 'ing':
		$prefix = 'en/';
		break;
	default:
		$prefix = '';
		break;
}


?>

<div data-offset-top="0" class="top-area-wrapper  header-cons-static">
	<div class="top-area  header-construtor" style="">
		<div class="clearfix <?php echo ($layout == 'public') ? 'skeleton' : '';?> auto_align" itemscope="" itemtype="http://schema.org/SiteNavigationElement">

			<div class="menu_layers left clearfix boxLogo">
				<a href="<?=$urlWordpress;?>" id="logo" class="forceleft" style="max-width:80px">
					<?php echo $this->Html->image('logo_corma_150px.jpg', array('class'=>'logo'));?>
				</a>
				<div class="top-text left" style=""><?php echo __('Cultivamos confianza');?></div>
				<?php /*if ($mostrar_titulo =='yes') {
					echo "<p class='titulo'>".$title_for_layout."</p>";
					}*/
				?>
            </div>
            
			<div class="menu_layers  right clearfix">
				<div class="menu-wrapper right" data-effect="None" style=""> 
					<div class="menu-bar">
                        <div class="clearfix">

                        	<!-- INICI MENÚ -->
                            <ul id="menu-menu" class="menu clearfix">
                            	<li id="menu-item-130" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-7898   rel      hasDropDown relative">
                            		<a href="#">
                            			<?php echo __('Corma');?>
                            			<span class="spacer" style="border-color:"></span>
                            			<span class="menu-tail"></span>
                            			<span class="menu-arrow ioa-front-icon down-diricon-"></span>
                            		</a>                            		 
                            		<div class="hoverdir-wrap">
                            			<span style="background:" class="hoverdir"></span>
                            		</div> 
									<ul class="sub-menu  clearfix">  
										<li id="menu-item-37" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-37   rel">

											<?php 
											switch ($idioma) 
											{
												case 'cat':
													echo "<a href='".$urlWordpress.$prefix.'la-cooperativa'."'>";
													break;
												case 'fra':
													echo "<a href='".$urlWordpress.$prefix.'la-cooperative'."'>";
													break;
												case 'ing':
													echo "<a href='".$urlWordpress.$prefix.'the-cooperative'."'>";
													break;
												case 'ale':
													echo "<a href='".$urlWordpress.$prefix.'die-kooperative'."'>";
													break;
												default:
													echo "<a href='".$urlWordpress.$prefix.'la-cooperativa'."'>";
													break;
											}
												echo __('La cooperativa');?>
												<span class="spacer" style="border-color:"></span>
											</a>
											<div class="hoverdir-wrap">
												<span style="background:" class="hoverdir"></span>
											</div>
										</li>


										<li id="menu-item-504" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-504 rel">
											<?php 
											switch ($idioma) 
											{
												case 'cat':
													echo "<a href='".$urlWordpress.$prefix.'corma-didactica'."'>";
													break;
												case 'fra':
													echo "<a href='".$urlWordpress.$prefix.'corma-didactique'."'>";
													break;
												case 'ale':
													echo "<a href='".$urlWordpress.$prefix.'lernen-bei-corma'."'>";
													break;
												case 'ing':
													echo "<a href='".$urlWordpress.$prefix.'didactic-corma'."'>";
													break;
												default:
													echo "<a href='".$urlWordpress.$prefix.'corma-didactica'."'>";
													break;
											}
												echo __('Corma didáctica');?>
												<span class="spacer" style="border-color:"></span>
											</a>
											<div class="hoverdir-wrap">
												<span style="background:" class="hoverdir"></span>
											</div>
										</li>
										<li id="menu-item-528" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-528   rel     ">
											<?php 
											switch ($idioma) 
											{
												case 'cat':
													echo "<a href='".$urlWordpress.$prefix.'regio-de-cultiu'."'>";
													break;
												case 'fra':
													echo "<a href='".$urlWordpress.$prefix.'region-de-culture'."'>";
													break;
												case 'ale':
													echo "<a href='".$urlWordpress.$prefix.'anbauregion'."'>";
													break;
												case 'ing':
													echo "<a href='".$urlWordpress.$prefix.'crop-region'."'>";
													break;
												default:
													echo "<a href='".$urlWordpress.$prefix.'region-de-cultivo'."'>";
													break;
											}
												echo __('Región de cultivo');?>
												<span class="spacer" style="border-color:"></span>
											</a>
											<div class="hoverdir-wrap">
												<span style="background:" class="hoverdir"></span>
											</div>
										</li>
										<li id="menu-item-584" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-584   rel">
											<?php 
											switch ($idioma) 
											{
												case 'cat':
													echo "<a href='".$urlWordpress.$prefix.'els-nostres-productors'."'>";
													break;
												case 'fra':
													echo "<a href='".$urlWordpress.$prefix.'nos-producteurs'."'>";
													break;
												case 'ale':
													echo "<a href='".$urlWordpress.$prefix.'unsere-erzeuger'."'>";
													break;
												case 'ing':
													echo "<a href='".$urlWordpress.$prefix.'our-producers'."'>";
													break;
												default:
													echo "<a href='".$urlWordpress.$prefix.'nuestros-productores'."'>";
													break;
											}

											echo __('Nuestros productores');?>
												<span class="spacer" style="border-color:"></span>
											</a>
											<div class="hoverdir-wrap">
												<span style="background:" class="hoverdir"></span>
											</div>
										</li>
										<li id="menu-item-601" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-601 rel">
											<?php 
											switch ($idioma) 
											{
												case 'cat':
													echo "<a href='".$urlWordpress.$prefix.'medi-ambient'."'>";
													break;
												case 'fra':
													echo "<a href='".$urlWordpress.$prefix.'environnement'."'>";
													break;
												case 'ale':
													echo "<a href='".$urlWordpress.$prefix.'umweltschutz'."'>";
													break;
												case 'ing':
													echo "<a href='".$urlWordpress.$prefix.'environment'."'>";
													break;
												default:
													echo "<a href='".$urlWordpress.$prefix.'medioambiente'."'>";
													break;
											}

											
												echo __('Medioambiente');?>
												<span class="spacer" style="border-color:"></span>
											</a>
											<div class="hoverdir-wrap">
												<span style="background:" class="hoverdir"></span>
											</div>
										</li>
										<span class="faux-holder"></span>
									</ul>
								</li>
								<li id="menu-item-333" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-333 rel">
									<?php 
										switch ($idioma) 
										{
											case 'cat':
												echo "<a href='".$urlWordpress.$prefix.'servei'."'>";
												break;
											case 'fra':
												echo "<a href='".$urlWordpress.$prefix.'service'."'>";
												break;
											case 'ale':
												echo "<a href='".$urlWordpress.$prefix.'service'."'>";
												break;
											case 'ing':
												echo "<a href='".$urlWordpress.$prefix.'service'."'>";
												break;
											default:
												echo "<a href='".$urlWordpress.$prefix.'servicio'."'>";
												break;
										}

										echo __('Servicio');?>
										<span class="spacer" style="border-color:"></span>
									</a>
									<div class="hoverdir-wrap">
										<span style="background:" class="hoverdir"></span>
									</div> 
								</li>
								<li id="menu-item-696" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-696   rel      hasDropDown relative">
									<a href="#">
										<?php echo __('Productos');?>
										<span class="spacer" style="border-color:"></span>
										<span class="menu-tail"></span>
										<span class="menu-arrow ioa-front-icon down-diricon-"></span>
									</a>
									<div class="hoverdir-wrap">
										<span style="display: block; left: -100%; top: 0px; transition: all 300ms ease;" class="hoverdir"></span>
									</div> 
									<ul class="sub-menu clearfix" style="display: none;">  
										<li id="menu-item-485" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-485   rel">
											<a href="<?php echo $urlWordpress;?>intranet/products/search">
												<?php echo __('Buscador de plantas');?>
												<span class="spacer" style="border-color:"></span>
											</a>
											<div class="hoverdir-wrap">
												<span style="display: block; left: -100%; top: 0px; transition: all 300ms ease;" class="hoverdir"></span>
											</div> 
										</li>
										<li id="menu-item-328" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-328   rel     ">
											<?php 
											switch ($idioma) 
											{
												case 'cat':
													echo "<a href='".$urlWordpress.$prefix.'les-nostres-coleccions'."'>";
													break;
												case 'fra':
													echo "<a href='".$urlWordpress.$prefix.'nos-collections'."'>";
													break;
												case 'ale':
													echo "<a href='".$urlWordpress.$prefix.'unsere-kollektionen'."'>";
													break;
												case 'ing':
													echo "<a href='".$urlWordpress.$prefix.'our-collections'."'>";
													break;
												default:
													echo "<a href='".$urlWordpress.$prefix.'nuestras-colecciones'."'>";
													break;
											}

											echo __('Nuestras colecciones');?>
												<span class="spacer" style="border-color:"></span>
											</a>
											<div class="hoverdir-wrap">
												<span style="background:" class="hoverdir"></span>
											</div>
										</li>

										<li id="menu-item-13644" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-13644   rel     ">
											<?php 
											switch ($idioma) 
											{
												case 'cat':
													echo "<a href='".$urlWordpress.$prefix.'cataleg-jardineria'."'>";
													break;
												case 'fra':
													echo "<a href='".$urlWordpress.$prefix.'catalogue-paysagisme'."'>";
													break;
												case 'ale':
													echo "<a href='".$urlWordpress.$prefix.'gartenkatalog'."'>";
													break;
												case 'ing':
													echo "<a href='".$urlWordpress.$prefix.'gardening-catalogue'."'>";
													break;
												default:
													echo "<a href='".$urlWordpress.$prefix.'catalogo-de-jardineria'."'>";
													break;
											}
											echo __('Catálogo jardinería');?>
											<span class="spacer" style="border-color:"></span>
											</a>
											<div class="hoverdir-wrap">
												<span style="background:" class="hoverdir"></span>
											</div>
										</li>
										
										

										<span class="faux-holder"></span>
									</ul>
								</li>

								<li id="menu-item-13643" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-13643 rel">
									<?php 
										switch ($idioma) 
											{
												case 'cat':
													echo "<a href='".$urlWordpress.$prefix.'cataleg-jardineria'."'>";
													break;
												case 'fra':
													echo "<a href='".$urlWordpress.$prefix.'catalogue-paysagisme'."'>";
													break;
												case 'ale':
													echo "<a href='".$urlWordpress.$prefix.'gartenkatalog'."'>";
													break;
												case 'ing':
													echo "<a href='".$urlWordpress.$prefix.'gardening-catalogue'."'>";
													break;
												default:
													echo "<a href='".$urlWordpress.$prefix.'catalogo-de-jardineria'."'>";
													break;
											}

										echo __('Catálogo jardinería');?>
										<span class="spacer" style="border-color:"></span>
									</a>
									<div class="hoverdir-wrap">
										<span style="background:" class="hoverdir"></span>
									</div> 
								</li>


								<li id="menu-item-629" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-629 rel hasDropDown relative">
									<a href="#">
										<?php echo __('Contacto');?>
										<span class="spacer" style="border-color:"></span>
										<span class="menu-tail"></span>
										<span class="menu-arrow ioa-front-icon down-diricon-"></span>
									</a>
									<div class="hoverdir-wrap">
										<span style="background:" class="hoverdir"></span>
									</div> 
									<ul class="sub-menu  clearfix">  
										<li id="menu-item-97" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-97 rel">
										
												<?php 
											switch ($idioma) 
											{
												case 'cat':
													echo "<a href='".$urlWordpress.$prefix.'adreces'."'>";
													break;
												case 'fra':
													echo "<a href='".$urlWordpress.$prefix.'addresses'."'>";
													break;
												case 'ale':
													echo "<a href='".$urlWordpress.$prefix.'adresse'."'>";
													break;
												case 'ing':
													echo "<a href='".$urlWordpress.$prefix.'addresses'."'>";
													break;
												default:
													echo "<a href='".$urlWordpress.$prefix.'direcciones'."'>";
													break;
											}
											 echo __('Direcciones');?>
												<span class="spacer" style="border-color:"></span>
											</a>
											<div class="hoverdir-wrap">
												<span style="background:" class="hoverdir"></span>
											</div>
										</li>
										<li id="menu-item-690" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-690 rel">
											<?php 
											switch ($idioma) 
											{
												case 'cat':
													echo "<a href='".$urlWordpress.$prefix.'contactans'."'>";
													break;
												case 'fra':
													echo "<a href='".$urlWordpress.$prefix.'contact'."'>";
													break;
												case 'ale':
													echo "<a href='".$urlWordpress.$prefix.'kontaktieren-sie-uns'."'>";
													break;
												case 'ing':
													echo "<a href='".$urlWordpress.$prefix.'get-in-touch'."'>";
													break;
												default:
													echo "<a href='".$urlWordpress.$prefix.'contactanos'."'>";
													break;
											}

											echo __('Contáctanos');?>
												<span class="spacer" style="border-color:"></span>
											</a>
											<div class="hoverdir-wrap">
												<span style="background:" class="hoverdir"></span>
											</div>
										</li>
										<span class="faux-holder"></span>
									</ul>
								</li>
								<li id="menu-item-711" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-711 rel">
										<?php
										$action = 'login';
										$text   = __('Área privada de clientes');
										
										$user = $this->Session->read('User.logged');
										$imInCatalog = $this->Session->read('imInCatalog');
$imInIntranet = $this->Session->read('imInIntranet');


										if ($imInIntranet) {  
											$action = 'logout';
											$text   = __('Cerrar sesión');
										}
										?>
										<a href="<?php echo $urlWordpress;?>intranet/users/<?php echo $action;?>">
										<?php echo $text;?>
										<span class="spacer" style="border-color:"></span>
									</a>
									<div class="hoverdir-wrap">
										<span style="background:" class="hoverdir"></span>
									</div>
								</li>								
							</ul> 
							<!-- FI MENU -->

						</div>
                    </div>
                </div>
                <?php if ($layout =='public') {
                	?>
                <div class="wpml-selector forceright" style="padding:10px 0px 0px 20px;">
					<a href="<?php echo $urlWordpress;?>ca/" alt="Català" title="Català">  Català</a> | 
					<a href="<?php echo $urlWordpress;?>de/" alt="Deutsch" title="Deutsch">  Deutsch</a> | 
					<a href="<?php echo $urlWordpress;?>en/" alt="English" title="English">  English</a> | 
					<a href="<?php echo $urlWordpress;?>" alt="Español" title="Español">  Español</a> | 
					<a href="<?php echo $urlWordpress;?>fr/" alt="Français" title="Français">  Français</a>                              
				</div>

				<ul class="top-area-social-list clearfix default" style="">
                                      <li><a target="_BLANK" class="facebook" href="https://www.facebook.com/corma.sccl?sk=info&amp;tab=overview"> <span class="proxy-color"><img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/facebook.png" alt="social icon"></span> <img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/inv/facebook.png" alt="social icon"></a></li><li><a target="_BLANK" class="twitter" href="https://twitter.com/cormasccl"> <span class="proxy-color"><img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/twitter.png" alt="social icon"></span> <img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/inv/twitter.png" alt="social icon"></a></li><li><a target="_BLANK" class="youtube" href="https://www.youtube.com/channel/UCNTLxyocYmpwhmHPE0V_5cw"> <span class="proxy-color"><img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/youtube.png" alt="social icon"></span> <img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/inv/youtube.png" alt="social icon"></a></li><li><a target="_BLANK" class="google-plus" href="https://plus.google.com/u/0/113235695376407180621"> <span class="proxy-color" style="opacity: 0;"><img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/google-plus.png" alt="social icon"></span> <img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/inv/google-plus.png" alt="social icon"></a></li><li><a target="_BLANK" class="pinterest" href="https://www.pinterest.com/corma_sccl/"> <span class="proxy-color"><img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/pinterest.png" alt="social icon"></span> <img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/inv/pinterest.png" alt="social icon"></a></li><li><a target="_BLANK" class="instagram" href="https://instagram.com/corma_sccl"> <span class="proxy-color"><img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/instagram.png" alt="social icon"></span> <img src="https://www.corma.es/wp-content/themes/limitless/sprites/i/sc/inv/instagram.png" alt="social icon"></a></li>                                    </ul>
				<div style="padding:5px 0px 0px 0px;" data-url="https://www.corma.es/wp-admin/admin-ajax.php" class="ajax-search right">
                                      
                                      <a href="" class="ajax-search-trigger ioa-front-icon search-3icon-"></a>
                                      <div class="ajax-search-pane">
                                         <a href="" class="ajax-search-close ioa-front-icon cancel-2icon-"></a>
                                         <span href="" class="up-dir-1icon- ioa-front-icon tip"></span>
                                          
                                          <div class="form">
                                             <form role="search" method="get" action="https://www.corma.es/">
                                                <div>
                                                    <input type="text" autocomplete="off" name="s" class="live_search" value="Introduzca el texto a buscar...">
                                                    <input type="submit" value="Search">
                                                    <span class="search-loader"></span>
                                                </div>
                                            </form>
                                          </div>
                                          <div class="search-results clearfix">
                                            <ul>
                                             
                                            </ul>
                                          </div>
                                      </div>

                                  </div>

                                  
				<?php
			}
			?>

			</div>
		</div>  
	</div>
</div> 
