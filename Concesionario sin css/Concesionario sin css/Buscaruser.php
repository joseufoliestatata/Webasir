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

    if (in_array($campo, ['nombre', 'apellidos', 'dni', 'saldo'])) {
        $query = "SELECT * FROM Usuarios WHERE $campo LIKE ?";
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
    <title>Buscar Usuarios</title>
</head>
<body>
    <h1>Buscar Usuarios</h1>

    <form action="Buscaruser.php" method="get">
        <select name="campo" required>
            <option value="nombre">Nombre</option>
            <option value="apellidos">Apellidos</option>
            <option value="dni">DNI</option>
            <option value="saldo">Saldo</option>
        </select>
        
        <input type="text" name="buscar" value="<?= htmlspecialchars($buscar) ?>" required>

        <button type="submit">Buscar</button>
    </form>

    <?php if (!empty($resultados)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID Usuario</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $usuario): ?>
                    <tr>
                        <td><?= $usuario['id_usuario'] ?></td>
                        <td><?= $usuario['nombre'] ?></td>
                        <td><?= $usuario['apellidos'] ?></td>
                        <td><?= $usuario['dni'] ?></td>
                        <td><?= $usuario['saldo'] ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($buscar != ''): ?>
        <p>No se encontraron usuarios que coincidan con la búsqueda.</p>
    <?php endif; ?>
    <a href="conce.html">Volver a inicio</a>
</body>
</html>
