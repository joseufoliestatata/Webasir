<?php
$conec = mysqli_connect("localhost", "root", "rootroot", "concesionario");

if (!$conec) {
    exit("Error de conexión con la base de datos.");
}

if (isset($_POST['delete_ids']) && is_array($_POST['delete_ids'])) {
    $ids = $_POST['delete_ids'];

    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM usuarios WHERE id_usuario IN ($placeholders)";
    
    $stmt = mysqli_prepare($conec, $sql);
    
    if ($stmt) {
        $types = str_repeat('i', count($ids));
        mysqli_stmt_bind_param($stmt, $types, ...$ids);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

header("Location: Borraruser.php");
exit();
?>
