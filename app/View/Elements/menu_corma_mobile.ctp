<?php
//$urlBase = "http://corma.es/";

$urlWordpress = 'https://';
$url = ($_SERVER['HTTP_HOST'] == '81.46.196.226') ? '/corma/' : '/';
$urlWordpress .= $_SERVER['HTTP_HOST'].$url;


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




<div class="mobile-head">			    
    <a href="" class=" ioa-front-icon menuicon- mobile-menu"></a>
    <a href="<?=$urlWordpress;?>" id="mobile-logo" class="center" style="max-width:80px">
                <img alt="logo" srcset="<?=$urlWordpress;?>wp-content/uploads/logo_corma_120x120.jpg, <?=$urlWordpress;?>wp-content/uploads/logo_corma_120x120@2x.jpg 2x">
    </a> 
   <a href="" class="majax-search-trigger search-3icon- ioa-front-icon"></a>
</div>

<ul id="mobile-menu" class="menu clearfix" style="display: none;">
	<li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-has-children menu-item-130"><a href="<?=$urlWordpress;?>">Corma</a>
		<ul class="sub-menu">
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
		</ul>
		<i class="ioa-front-icon plus-2icon-"></i>
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