
<link rel="stylesheet" id="tp-open-sans-css" href="https://fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C600%2C700%2C800&amp;ver=4.3.1" type="text/css" media="all">
<link rel="stylesheet" id="cff-font-awesome-css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=4.7.0" type="text/css" media="all">
<style>

h2 {
	 font-family: 'Open Sans', sans-serif;
	 text-align: center;
}

</style>

<?php if ($user['show_muntador']) {

	if (count($cashorderdetails) == 0) {

		?>

		<br /><br /><br />




		<h2>

			<i class="fa fa-building-o fa-5x"></i><br /><br />
		<?php echo __('Sin artículos seleccionados');?>
	</h2>

		<?php

	} else {


		$articlesComanda = array();

		$lote = 0;
		foreach ($cashorderdetails as $key) {
			$lote++;

			if ($key['granel'] == 'S' ) {
				$cajas = intval($key['real_unities']);
			} else {
				/*if ($key['unidad_Servicio'] =='U' ) {
					$cajas = intval($key['real_unities']);
				} else {
					if ($key['unidad_Servicio'] =='P' ) {*/
						if ($key['es_piso']) {
							$cajas = $key['real_unities'];
						} else {
							$cajas = intval($key['real_unities'] / $key['unidades_caja']);
						}
					/*} else {
						$cajas = intval($key['real_unities'] / $key['unidades_caja']);
					}
				}*/
			}

			$pisos = round($key['real_unities'] / ($key['unidades_caja'] * $key['cajas_piso']),2);


			$articlesComanda[] = array('articulo'=>$key['ArticleCode'],
										'unidad_servicio'=>$key['unidad_Servicio'],
										'almacen'=>'0061',
										'embalaje'=>$key['embalaje'],
										'desc_articulo'=>$key['name'],
										'lote'=>$lote,
										'cantidad_us'=>intval($key['units']),
										'cantidad'=>intval($key['real_unities']),
										'num_cajas'=>intval($cajas),
										'num_pisos'=>floatval($pisos),
										'altura'=>intval($key['altura']), 
										'longitud'=>floatval($key['longitud']), 
										'profundidad'=>floatval($key['profundidad']),
										'granel'=>$key['granel']);
		}


		$arrayJSON =  array(
							'pedido_id'=>$cash_order,
							'cliente'=>$user['code'],
							'nombre_cliente'=>$user['name'],
							'altura_carro'=>intval($user['Catalogue']['altura_carri']),
							'articulos'=>$articlesComanda);

		//print_r(json_encode($arrayJSON)).die;

	



/*
{"pedido_id":"79966","cliente":"00013763","nombre_cliente":"BRUGUERA PARULL MIRIAM","altura_carro":"240","articulos":[{"articulo":"BEGON5N","unidad_servicio":"K","almacen":"0061","embalaje":"PT15X4","desc_articulo":"BEGON 10,5","lote":1,"cantidad_us":1,"cantidad":540,"num_cajas":36,"altura":30,"longitud":32,"profundidad":54.5}]}

*/



		$json_merge = json_encode($arrayJSON);




		$json_pedido = "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"json_pedido\"\r\n\r\n".$json_merge."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--";



	    $ch = curl_init();
	  

		curl_setopt($ch, CURLOPT_URL,"http://195.77.113.131:8090/distribucion/distri_cliente");
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_pedido);				
		
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"cache-control: no-cache",
				"content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW")

	    );



	    $result = curl_exec($ch);

		print_r($result);

		echo "<br /><br /><br />";


		print_r($json_merge);
	}
}
	?>