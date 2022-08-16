
<table class="table table-bordered">
	<thead>
		<tr>
			<th>ID</th>
			<th>NOM</th>
			<th>Nº usuaris</th>
			<th> </th>
		</tr> </thead>
<?php


foreach ($datos as $lista) {
	echo '<tr>';


	echo "<td>".$lista->id."</td>";
	echo "<td>".$lista->name."</td>";
	echo "<td>".$lista->stats->member_count."</td>";
	echo "<td><a href='/intranet/usersnewsletters/members/".$lista->id."'><i class='fa fa-users' aria-hidden='true'></i></a></td>";


	echo "</tr>";


}

?>

</table>
