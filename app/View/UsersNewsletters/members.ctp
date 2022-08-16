<?php

//debug($datos).die;

?>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>ID</th>
			<th>EMAIL</th>
			<th>ESTAT</th>
			<th> </th>
		</tr> </thead>

<?php

//https://corma.us14.list-manage.com/subscribe?u=aaeefcbd5658413393ff33513&id=292d139b4b

foreach ($datos as $usuario) {
	echo "<tr>";
	echo "<td>".$usuario->id."</td>";
	echo "<td>".$usuario->email_address."</td>";
	echo "<td>".$usuario->status."</td>";
	echo "<td><a href='/intranet/mailchimp/subscribe/".$usuario->list_id."/".$usuario->id."'>Subscripción</a></td>";
	echo "</tr>";
	//echo "https://corma.us14.list-manage.com/subscribe/confirm?u=".$usuario->id."&"
}


?>
</table>