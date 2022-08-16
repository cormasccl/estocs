

<div class="sidebar-wrap widget widget_categories clearfix">
	<ul style="list-style-type: none;">
		<li class="cat-item cat-item-52"><a style="text-decoration:none" href="#1"><?php echo __('Gestión de pedidos');?></a>
		<i style="float:left" class="ioa-front-icon  angle-righticon- w-pin"></i></li>
		<li class="cat-item cat-item-53"><a style="text-decoration:none" href="#2"><?php echo __('Consulta de pedidos');?></a>
		<i style="float:left" class="ioa-front-icon  angle-righticon- w-pin"></i></li>
		<li class="cat-item cat-item-43"><a style="text-decoration:none" href="#3"><?php echo __('Consulta de facturas');?></a>
		<i style="float:left" class="ioa-front-icon  angle-righticon- w-pin"></i></li>
		<li class="cat-item cat-item-55"><a style="text-decoration:none" href="#4"><?php echo __('Consulta de pagos');?></a>
		<i style="float:left"  class="ioa-front-icon  angle-righticon- w-pin"></i></li>
	</ul>
</div>
<div class="agent hidden-sm">	
	<p>
		<strong>&nbsp;<?php echo __('Agente comercial');?> :</strong></p>
		<i class="fa fa-user">&nbsp;<?php echo $user['Agent']['name'];?></i>
		<i class="fa fa-envelope">&nbsp;<?php echo $user['Agent']['email']?></i>
		<i class="fa fa-phone">&nbsp;<?php echo $user['Agent']['phone']?></i>
		<i class="fa fa-print">&nbsp;<?php echo str_replace('.','',$user['Agent']['fax'])?></i>
	</p>
	<p>
		<?php 
		$username = (empty($user['name'])) ? __('Dato no rellenado') : $user['name'];
		$contactmail = (empty($user['contact_mail'])) ? __('Dato no rellenado') : $user['contact_mail'];
		?>
		<strong>&nbsp;<?php echo __('Sus datos de cliente');?> :</strong></p>
		<i class="fa fa-user">&nbsp;<?php echo $username;?></i>
		<i class="fa fa-envelope">&nbsp;<?php echo $contactmail?></i>
	</p>
</div>
<hr />

<style>
@media only screen and (max-width:767px){
	.hidden-sm {
		display: none;
	}
}
</style>