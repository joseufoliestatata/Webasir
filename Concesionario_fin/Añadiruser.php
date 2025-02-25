<?php
session_start();
?>
<?php
if (isset($_POST['regis'])) {

    if ($_POST['saldo'] > 999999) {
        $_SESSION['error'] = "Saldo demasiado alto";
        header("Location: Añadiruser.php");
        exit();
    } else {

        $conexion = mysqli_connect("localhost", "root", "rootroot")
            or die("No se puede conectar con el servidor");

        mysqli_select_db($conexion, "concesionario")
            or die("No se puede seleccionar la base de datos");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $dni = $_POST['dni'];
            $saldo = $_POST['saldo'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Contraseña encriptada

            $comp = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
            $res = mysqli_query($conexion, $comp);

            if (mysqli_num_rows($res) > 0) {
                $_SESSION['error'] = "Ya hay un usuario con este nombre";
                header("Location: Añadiruser.php");
                exit();
            }
            $instruccion = "INSERT INTO usuarios (nombre, apellidos, dni, saldo, password) 
                            VALUES ('$nombre', '$apellidos', '$dni', '$saldo', '$password')";

            $consulta = mysqli_query($conexion, $instruccion)
                or die("Fallo en la consulta");

            $_SESSION['confirm'] = "Se añadió correctamente el usuario";
            header("Location: Añadiruser.php");
            exit();
        }

        mysqli_close($conexion);
    }
}
?>


<html lang="es">
<head>
    <title>Añadir Usuario</title>
    <link rel="stylesheet" href="css/paginas.css">
    <style type="text/css">
        
    </style>
</head>
<body>
    <main>
        <h1 align="center">Registra un usuario</h1>
        <form method="POST" action="Añadiruser.php">
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" required><br><br>

            <label for="apellidos">Apellidos:</label><br>
            <input type="text" name="apellidos" required><br><br>

            <label for="dni">DNI:</label><br>
            <input type="text" name="dni" required placeholder="Solo +18"><br><br>

            <label for="saldo">Saldo:</label><br>
            <input type="number" name="saldo" required placeholder="Se realista"><br><br>
            <?php
            if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p><br>";
            unset($_SESSION['error']);}
            ?>

            <label for="password">Contraseña:</label><br>
            <input type="password" name="password" required><br><br>

            <button type="submit" name="regis">Añadir Usuario</button>
        </form><br>
        <?php
            if (isset($_SESSION['confirm'])) {
            echo "<p color='green'>" . $_SESSION['confirm'] . "</p><br>";
            unset($_SESSION['confirm']);}
            ?>
        <br><a href="Index.php">Volver a inicio</a>
    </main>   
</body>
</html>
