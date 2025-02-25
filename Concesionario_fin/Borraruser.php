<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Borrar</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<?php

$conec = mysqli_connect("localhost", "root", "rootroot", "concesionario");

if (!$conec) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$sql = "SELECT * FROM usuarios;";
$resul = mysqli_query($conec, $sql);

if (mysqli_num_rows($resul) > 0) {
    echo "<h1>Listado de Usuarios</h1>";
    echo "<form action='Borrarusuario.php' method='post'>";
    echo "<table border = 1>";
    echo "<tr><th>Seleccionar</th><th>Id</th><th>Nombre</th><th>Apellidos</th><th>DNI</th><th>Saldo</th></tr>";

    while ($row = mysqli_fetch_assoc($resul)) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='delete_ids[]' value='". $row['id_usuario'] ."'></td>";
        echo "<td>" . htmlspecialchars($row['id_usuario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['apellidos']) . "</td>";
        echo "<td>" . htmlspecialchars($row['dni']) . "</td>";
        echo "<td>" . htmlspecialchars($row['saldo']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    echo "<button type='submit'>Eliminar seleccionados</button>";
    echo "</form>";
} else {
    echo "<h1>No hay usuarios registrados</h1>";
}

?>
<div class="centro"><a href="Index.php">Volver a inicio</a></div>
</body>
</html>



