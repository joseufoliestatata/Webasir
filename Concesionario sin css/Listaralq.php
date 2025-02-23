<?php

$conexion = mysqli_connect("localhost", "root", "rootroot")
    or die("No se puede conectar con el servidor");

mysqli_select_db($conexion, "concesionario")
    or die("No se puede seleccionar la base de datos");

$instruccion = "SELECT * FROM coches WHERE alquilado = 1";
$consulta = mysqli_query($conexion, $instruccion)
    or die("Fallo en la consulta");

$nfilas = mysqli_num_rows($consulta);

if ($nfilas > 0) {
    echo "<h1>Coches Alquilados</h1>";
    echo "<table border=1>";
    echo "<tr><th>Id</th><th>Modelo</th><th>Marca</th><th>Color</th><th>Precio</th><th>Alquilado</th><th>Foto</th></tr>";

    while ($row = mysqli_fetch_assoc($consulta)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id_coche']) . "</td>";
        echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
        echo "<td>" . htmlspecialchars($row['color']) . "</td>";
        echo "<td>" . htmlspecialchars($row['precio']) . "</td>";
        echo "<td>" . htmlspecialchars($row['alquilado']) . "</td>";
        echo "<td>" . htmlspecialchars($row['foto']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<h1>No hay coches alquilados</h1>";
}

mysqli_close($conexion);

?>

<a href="conce.html">Volver a inicio</a>
