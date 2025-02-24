<?php
session_start();
?>

<?php

$conec = mysqli_connect("localhost", "root", "rootroot", "concesionario");

if (!$conec) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_ids'])) {
    $delete_ids = $_POST['delete_ids'];

    foreach ($delete_ids as $id_coche) {
        $borrar_coche = "DELETE FROM coches WHERE id_coche = '$id_coche'";
        $consulta_borrar = mysqli_query($conec, $borrar_coche);

        if (!$consulta_borrar) {
            die("Error al borrar el coche con ID $id_coche: " . mysqli_error($conec));
        }
    }

    $_SESSION['confirm'] = "Coches eliminados correctamente.";
} else {
    $_SESSION['error'] = "No seleccionaste ningún coche para eliminar.";
}

mysqli_close($conec);
header("Location: Borrarcoc.php");
exit();
?>

