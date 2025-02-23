<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url(img/inicio.jpg);
          
        }

        .marca{

        	display: block;
        	position: relative ;
        	bottom: 200px;
        	font-family: "EB Garamond", serif; 
        }

        .formulario {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding-right: 35px;
            display: block;
            top: 150px;
            position: relative;
        }
        .formulario h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .formulario input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .formulario button {
            width: 100%;
            padding: 10px;
            background-color: #86f555;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
        .formulario button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
	<div class="marca"><h1 id="marca"><u>Concesionario Skibidi</u></h1><br><br><div>


    <div class="formulario">
        <h2>Iniciar Sesión</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
        <form method="POST" action="usuario.php">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contra" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>



