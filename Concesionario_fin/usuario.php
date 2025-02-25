<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "rootroot", "concesionario")
    or die("No se puede conectar con el servidor");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $pass = $_POST['contra'];

    $con = "SELECT password, saldo FROM usuarios WHERE nombre = ?";
    $stmt = mysqli_prepare($conexion, $con);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $user); 
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultado)) {
            $hashAlmacenado = $row['password'];

            if (password_verify($pass, $hashAlmacenado)) {
                $_SESSION['user'] = $user;

                if ($user == 'admin') {
                    $_SESSION['tipo'] = 'adm';
                    $_SESSION['saldo'] = '99999999999';
                } else {
                    $_SESSION['usuario'] = $user;
                    $_SESSION['saldo'] = $row['saldo']; // Guardar saldo en la sesión
                    $_SESSION['tipo'] = $_POST['tipo'] ?? 'usuario';
                }

                header("Location: Index.php");
                exit();
            } else {
                $_SESSION['error'] = "Contraseña incorrecta";
            }
        } else {
            $_SESSION['error'] = "Usuario no encontrado";
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "Error al preparar la consulta.";
    }

    mysqli_close($conexion);
    header("Location: Inicio.php");
    exit();
}
?>






