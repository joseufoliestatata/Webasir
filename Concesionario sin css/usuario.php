<?php

session_start();

$conexion = mysqli_connect("localhost", "root", "rootroot", "concesionario")
    or die("No se puede conectar con el servidor");

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $pass = mysqli_real_escape_string($conexion, $_POST['contra']);

    $con = "SELECT * FROM usuarios WHERE nombre = ? AND password = ?"; 
    $stmt = mysqli_prepare($conexion, $con);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $user, $pass); 
        mysqli_stmt_execute($stmt);
        
        $resultado = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($resultado) > 0) {
                if (isset($_POST['tipo'])) {
                    if ($user == 'admin') {
                        $_SESSION['tipo']='adm';}
                    else{
                        $tipo = $_POST['tipo'];
                        $_SESSION['tipo'] = $tipo; 
                    }
            }
            $_SESSION['user'] = $user;
            header("Location: Index.php");
            exit();
        } else {
            $_SESSION['error'] = "Datos incorrectos";
            header("Location: Inicio.php");
            exit();
        }
        
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "Error al preparar la consulta.";
        header("Location: Inicio.php");
        exit();
    }

    mysqli_close($conexion);
}
?>





