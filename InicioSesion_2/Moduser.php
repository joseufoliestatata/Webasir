<?php

$conexion = mysqli_connect("localhost", "root", "rootroot")
    or die("No se puede conectar con el servidor");

mysqli_select_db($conexion, "concesionario")
    or die("No se puede seleccionar la base de datos");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $saldo = $_POST['saldo'];

    $instruccion = "UPDATE usuarios SET password = '$password', nombre = '$nombre', apellidos = '$apellidos', dni = '$dni', saldo = '$saldo' WHERE id_usuario = $id_usuario";
    $consulta = mysqli_query($conexion, $instruccion)
        or die("Error al actualizar el usuario");

    echo "<h1>Usuario actualizado correctamente</h1>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];

    $query = "SELECT * FROM usuarios WHERE 1";

    if ($nombre != "") {
        $query .= " AND nombre LIKE '%$nombre%'";
    }
    if ($apellidos != "") {
        $query .= " AND apellidos LIKE '%$apellidos%'";
    }
    if ($dni != "") {
        $query .= " AND dni LIKE '%$dni%'";
    }

    $result = mysqli_query($conexion, $query) or die("Error en la consulta");

    if (mysqli_num_rows($result) > 0) {
        echo "<h1>Resultados de la búsqueda</h1>";
        echo "<form action='Moduser.php' method='POST'>";
        echo "<table border=1>";
        echo "<tr><th>Seleccionar</th><th>Id</th><th>Nombre</th><th>Apellidos</th><th>DNI</th><th>Saldo</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><input type='radio' name='id_usuario' value='". $row['id_usuario'] ."'></td>";
            echo "<td>" . $row['id_usuario'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['apellidos'] . "</td>";
            echo "<td>" . $row['dni'] . "</td>";
            echo "<td>" . $row['saldo'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<br><button type='submit'>Modificar usuario seleccionado</button>";
        echo "</form>";
    } else {
        echo "<h1>No se encontraron usuarios con esos criterios</h1>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];

    $instruccion = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
    $consulta = mysqli_query($conexion, $instruccion)
        or die("Error al obtener los datos del usuario");

    $usuario = mysqli_fetch_assoc($consulta);
}

?>

<h1>Modificar Usuario</h1>

<form method="POST" action="Moduser.php">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre"><br><br>
    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos"><br><br>
    <label for="dni">DNI:</label>
    <input type="text" id="dni" name="dni"><br><br>
    <button type="submit" name="buscar">Buscar</button>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_usuario'])) { ?>
    <form action="Moduser.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
        <label for="password">Contraseña:</label>
        <input type="text" id="password" name="password" value="<?php echo $usuario['password']; ?>" required><br><br>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required><br><br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $usuario['apellidos']; ?>" required><br><br>
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" value="<?php echo $usuario['dni']; ?>" required><br><br>
        <label for="saldo">Saldo:</label>
        <input type="number" step="0.01" id="saldo" name="saldo" value="<?php echo $usuario['saldo']; ?>" required><br><br>
        <button type="submit">Actualizar Usuario</button>
    </form>
<?php } ?>

<a href="conce.html">Volver a inicio</a>
