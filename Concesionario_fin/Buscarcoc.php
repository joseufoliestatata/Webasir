<?php
$conexion = mysqli_connect("localhost", "root", "rootroot") 
    or die("No se puede conectar con el servidor");

mysqli_select_db($conexion, "concesionario") 
    or die("No se puede seleccionar la base de datos");

$buscar = '';
$campo = '';
$resultados = [];

if (isset($_GET['buscar']) && isset($_GET['campo'])) {
    $buscar = $_GET['buscar'];
    $campo = $_GET['campo'];

    if (in_array($campo, ['modelo', 'marca', 'color', 'precio'])) {
        $query = "SELECT * FROM Coches WHERE $campo LIKE ?";
        $stmt = mysqli_prepare($conexion, $query);
        
        $param_buscar = "%$buscar%";
        mysqli_stmt_bind_param($stmt, 's', $param_buscar);
        
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $resultados[] = $row;
        }
        
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Coches</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Buscar Coches</h1>

    <form action="Buscarcoc.php" method="get">
        <select name="campo" required>
            <option value="modelo">Modelo</option>
            <option value="marca">Marca</option>
            <option value="color">Color</option>
            <option value="precio">Precio</option>
        </select>
        
        <input type="text" name="buscar" value="<?= htmlspecialchars($buscar) ?>" required>

        <button type="submit">Buscar</button>
    </form>

    <?php if (!empty($resultados)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID Coche</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Alquilado</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $coche): ?>
                    <tr>
                        <td><?= $coche['id_coche'] ?></td>
                        <td><?= $coche['modelo'] ?></td>
                        <td><?= $coche['marca'] ?></td>
                        <td><?= $coche['color'] ?></td>
                        <td><?= $coche['precio'] ?> €</td>
                        <td><?= $coche['alquilado'] ? 'Sí' : 'No' ?></td>
                        <td><img src="<?= $coche['foto'] ?>" width="100"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($buscar != ''): ?>
        <div class="aviso"><p>No se encontraron coches que coincidan con la búsqueda.</p></div>
    <?php endif; ?>
    <div class="centro"><a href="Index.php">Volver a inicio</a></div>
</body>
</html>
