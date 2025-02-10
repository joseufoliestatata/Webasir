<?php

$conec = mysqli_connect("localhost","root","rootroot","concesionario");

if (!$conec) {
	die("conexion fallida" . mysqli_connect_error());
}


$sql = "SELECT * FROM coches;";
$resul = mysqli_query($conec,$sql);

if (mysqli_num_rows($resul) > 0) {
	echo "<h1>Listado de pisos</h1>";
	echo "<form action='Borrarmejor.php' method='post'>";
	echo "<table border = 1>";
	echo "<tr><th>Seleccionar</th><th>Id</th><th>Modelo</th><th>Marca</th><th>Color</th><th>Precio</th><th>Alquilado</th><th>Foto</th></tr>";

	while ($row = mysqli_fetch_assoc($resul)) {
		echo "<tr>";
		echo "<td><input type='checkbox' name='delete_ids[]' value='". $row['id_coche'] ."'></td>";
		echo "<td>" .htmlspecialchars($row['id_coche']). "</td>";
		echo "<td>".htmlspecialchars($row['modelo']). "</td>";
		echo "<td>".htmlspecialchars($row['marca']). "</td>";
		echo "<td>".htmlspecialchars($row['color']). "</td>";
		echo "<td>".htmlspecialchars($row['precio']). "</td>";
		echo "<td>".htmlspecialchars($row['alquilado']). "</td>";
		echo "<td>".htmlspecialchars($row['foto']). "</td>";
		echo "</tr>";
	}
	echo"</table>";
	echo"<br>";
	echo"<button type='submit'>Eliminar seleccionados</button>";
	echo"</form>";
}
else{
	echo "<h1>No quedan pisosn disponibles</h1>";
}

?>