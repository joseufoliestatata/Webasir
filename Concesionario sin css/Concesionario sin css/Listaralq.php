<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
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
    echo "<header><h1>Coches Alquilados</h1></header>";
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
<dvi class="centro" ><a href="Index.php">Volver a inicio</a></dvi>

</body>
</html>
