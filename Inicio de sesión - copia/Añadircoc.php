<?php
$conexion = mysqli_connect("localhost", "root", "rootroot")
    or die("No se puede conectar con el servidor");

mysqli_select_db($conexion, "concesionario")
    or die("No se puede seleccionar la base de datos");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $color = $_POST['color'];
    $precio = $_POST['precio'];
    $alquilado = isset($_POST['alquilado']) ? 1 : 0;
    $foto = $_POST['foto'];

    $instruccion = "INSERT INTO coches (modelo, marca, color, precio, alquilado, foto) 
                    VALUES ('$modelo', '$marca', '$color', '$precio', '$alquilado', '$foto')";
    
    $consulta = mysqli_query($conexion, $instruccion)
        or die("Fallo en la consulta");

    echo "Coche añadido correctamente.";
}

mysqli_close($conexion);
?>

<html lang="es">
<head>
    <title>Añadir Coche</title>
</head>
<body>
    <h1>Añadir Coche</h1>
    <form method="POST" action="Añadircoc.php">
        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" required><br><br>

        <label for="marca">Marca:</label>
        <input type="text" name="marca" required><br><br>

        <label for="color">Color:</label>
        <input type="text" name="color" required><br><br>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" required><br><br>

        <label for="alquilado">Alquilado:</label>
        <input type="checkbox" name="alquilado"><br><br>

        <label for="foto">Foto (URL):</label>
        <input type="text" name="foto"><br><br>

        <button type="submit">Añadir Coche</button>
    </form>

    <br><a href="Listarcoc.php">Volver a inicio</a>
</body>
</html>
