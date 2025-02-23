<?php
$conexion = mysqli_connect("localhost", "root", "rootroot")
    or die("No se puede conectar con el servidor");

mysqli_select_db($conexion, "concesionario")
    or die("No se puede seleccionar la base de datos");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $saldo = $_POST['saldo'];
    $password = $_POST['password'];

    $instruccion = "INSERT INTO usuarios (nombre, apellidos, dni, saldo, password) 
                    VALUES ('$nombre', '$apellidos', '$dni', '$saldo', '$password')";
    
    $consulta = mysqli_query($conexion, $instruccion)
        or die("Fallo en la consulta");

    echo "Usuario añadido correctamente.";
}

mysqli_close($conexion);
?>

<html lang="es">
<head>
    <title>Añadir Usuario</title>
</head>
<body>
    <h1>Añadir Usuario</h1>
    <form method="POST" action="Añadiruser.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required><br><br>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" required><br><br>

        <label for="saldo">Saldo:</label>
        <input type="number" name="saldo" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Añadir Usuario</button>
    </form>

    <br><a href="conce.html">Volver a inicio</a>
</body>
</html>
