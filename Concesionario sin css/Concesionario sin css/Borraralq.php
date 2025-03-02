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

$conexion = mysqli_connect("localhost", "root", "rootroot")
    or die("No se puede conectar con el servidor");

mysqli_select_db($conexion, "concesionario")
    or die("No se puede seleccionar la base de datos");

$instruccion = "SELECT * FROM alquileres";
$consulta = mysqli_query($conexion, $instruccion)
    or die("Fallo en la consulta");

$nfilas = mysqli_num_rows($consulta);

if ($nfilas > 0) {
    echo "<h1>Listado de Alquileres</h1>";
    echo "<form action='Borraralq.php' method='post'>";
    echo "<table border=1>";
    echo "<tr><th>Seleccionar</th><th>ID Alquiler</th><th>Id Usuario</th><th>Id Coche</th><th>Prestado</th><th>Devuelto</th></tr>";

    while ($row = mysqli_fetch_assoc($consulta)) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='delete_ids[]' value='" . $row['id_alquiler'] . "'></td>";
        echo "<td>" . htmlspecialchars($row['id_alquiler']) . "</td>";
        echo "<td>" . htmlspecialchars($row['id_usuario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['id_coche']) . "</td>";
        echo "<td>" . htmlspecialchars($row['prestado']) . "</td>";
        echo "<td>" . htmlspecialchars($row['devuelto']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br>";
    echo "<div class=centro><input type='submit' value='Eliminar Alquileres Seleccionados'></div>";
    echo "</form>";
} else {
    echo "<h1>No hay alquileres registrados</h1>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_ids'])) {
    $delete_ids = $_POST['delete_ids'];

    foreach ($delete_ids as $id_alquiler) {
        $borrar_alquiler = "DELETE FROM alquileres WHERE id_alquiler = '$id_alquiler'";
        $consulta_borrar = mysqli_query($conexion, $borrar_alquiler)
            or die("Fallo al borrar el alquiler");

            header('location: Borraralq.php');

            echo "<div class=cont1><p>Alquiler con ID $id_alquiler eliminado correctamente.</p></div><br>";
    }
}

mysqli_close($conexion);

?>

<div class="centro"><a href="Index.php">Volver a inicio</a></div>
</body>
</html>



