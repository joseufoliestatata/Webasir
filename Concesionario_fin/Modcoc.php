<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modificar Coche</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<?php
$conexion = mysqli_connect("localhost", "root", "rootroot", "concesionario");

if (!$conexion) {
    die("No se puede conectar con la base de datos: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_coche']) && isset($_POST['actualizar'])) {
    $id_coche = $_POST['id_coche'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $color = $_POST['color'];
    $precio = $_POST['precio'];
    $alquilado = $_POST['alquilado'];
    $foto = $_POST['foto'];

    $instruccion = "UPDATE coches SET 
                    modelo = '$modelo', 
                    marca = '$marca', 
                    color = '$color', 
                    precio = '$precio', 
                    alquilado = '$alquilado', 
                    foto = '$foto' 
                    WHERE id_coche = $id_coche";

    if (mysqli_query($conexion, $instruccion)) {
        echo "<h1>Coche actualizado correctamente</h1>";
    } else {
        echo "<h1>Error al actualizar el coche: " . mysqli_error($conexion) . "</h1>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $color = $_POST['color'];

    $query = "SELECT * FROM coches WHERE 1=1";

    if (!empty($modelo)) {
        $query .= " AND modelo LIKE '%$modelo%'";
    }
    if (!empty($marca)) {
        $query .= " AND marca LIKE '%$marca%'";
    }
    if (!empty($color)) {
        $query .= " AND color LIKE '%$color%'";
    }

    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<h1>Resultados de la búsqueda</h1>";
        echo "<form action='Modcoc.php' method='POST'>";
        echo "<table border=1>";
        echo "<tr><th>Seleccionar</th><th>Id</th><th>Modelo</th><th>Marca</th><th>Color</th><th>Precio</th><th>Alquilado</th><th>Foto</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><input type='radio' name='id_coche' value='". $row['id_coche'] ."'></td>";
            echo "<td>" . htmlspecialchars($row['id_coche']) . "</td>";
            echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
            echo "<td>" . htmlspecialchars($row['color']) . "</td>";
            echo "<td>" . htmlspecialchars($row['precio']) . "</td>";
            echo "<td>" . htmlspecialchars($row['alquilado']) . "</td>";
            echo "<td>" . htmlspecialchars($row['foto']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<br><button type='submit' name='modificar'>Modificar coche seleccionado</button>";
        echo "</form>";
    } else {
        echo "<h1>No se encontraron coches con esos criterios</h1>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar']) && isset($_POST['id_coche'])) {
    $id_coche = $_POST['id_coche'];
    $query = "SELECT * FROM coches WHERE id_coche = $id_coche";
    $result = mysqli_query($conexion, $query);
    $coche = mysqli_fetch_assoc($result);
}
?>

<h1>Buscar Coche</h1>
<form method="POST" action="Modcoc.php">
    <label for="modelo">Modelo:</label>
    <input type="text" id="modelo" name="modelo"><br><br>
    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="marca"><br><br>
    <label for="color">Color:</label>
    <input type="text" id="color" name="color"><br><br>
    <button type="submit" name="buscar">Buscar</button>
</form>

<?php if (isset($coche)) { ?>
    <h1>Modificar Coche</h1>
    <form action="Modcoc.php" method="POST">
        <input type="hidden" name="id_coche" value="<?php echo $coche['id_coche']; ?>">
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" value="<?php echo $coche['modelo']; ?>" required><br><br>
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" value="<?php echo $coche['marca']; ?>" required><br><br>
        <label for="color">Color:</label>
        <input type="text" id="color" name="color" value="<?php echo $coche['color']; ?>" required><br><br>
        <label for="precio">Precio:</label>
        <input type="number" step="0.01" id="precio" name="precio" value="<?php echo $coche['precio']; ?>" required><br><br>
        <label for="alquilado">Alquilado (1 = sí, 0 = no):</label>
        <input type="number" id="alquilado" name="alquilado" value="<?php echo $coche['alquilado']; ?>" required><br><br>
        <label for="foto">Foto:</label>
        <input type="text" id="foto" name="foto" value="<?php echo $coche['foto']; ?>"><br><br>
        <button type="submit" name="actualizar">Actualizar Coche</button>
    </form>
<?php } ?>

<div class="centro"><a href="Index.php">Volver a inicio</a></div>
</body>
</html>







