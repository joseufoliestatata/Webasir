<?php
session_start();

if (!isset($_SESSION['tipo'])) {
    $_SESSION['tipo'] = '';
}
?>
<!DOCTYPE html>
<html>
<header>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style type="text/css">
        body{
            background-image: url('img/fondoneg.jpg');
        }
    </style>
 </header>   

<body>
    
    <?php
            if($_SESSION['tipo'] === 'comp')
            {
                echo" 
            <header> <h1>Concesionario de Vehículos</h1>
        <nav>
            <ul>
                <li><a href='Listarcoc.php'>Ver coches</a></li>
                <li><a href='Buscarcoc.php'>Buscar coches</a></li>
                <li><a href='Listaralq.php'>Alquilar</a></li>
            </ul>
        </nav></header>
        <main>
            <h2>Hola, ".$_SESSION['user']."</h2>
            <p>Encantados de tenerte por aquí viendo coches.</p>
            <span class='cerrar'><a href=cerrar.php >Cerrar mi sesión</a></span>
                </main>
            <div class='cont'>
                <div class='cont1'>
                    <h2>Hola, comprador</h2><hr><br>
                    <p>Como comprador puedes ver los coches disponibles y usar la opción de buscar para poder ver los coches que desees.<br>
                    Además podrás alquilar los coches disponibles si tienes el saldo suficiente como para hacerlo, recuerda que puedes recargarlo en cualquier momento.</p>
                </div>
                <div class='cont1'>
                    <h2>Opción de buscar</h2><hr><br>
                    <p>Puedes usar nuestro buscador para filtrar los coches por numerosas características: color, nombre, marca,etc...<br><br>
                    <a href='Buscarcoc.php'>¡Busca Ya!</a><br></p>
                </div>
                <div class='cont1'>
                    <h2>Ver los alquileres</h2><hr><br>
                    <p>Has alquilado algún coche pero no has recibido noticias? Entra y comprueba el estado de tus alquileres, podrás ver la fecha, el dinero y el estado de tu alquiler..<br>
                    Si crees que tu producto esta tardando en ser confirmado sientete libre de cancelar tu alquiler en cualquier momento antes de la confirmación sin gastos adicionales.</p>
                </div>";
            }





            elseif($_SESSION['tipo'] === 'vend')
            {
        echo" 
            <header> <h1>Concesionario de Vehículos</h1>
        <nav>
            <ul>
                <li><a href='Listarcoc.php'>Ver coches</a></li>
                <li><a href='Buscarcoc.php'>Busca coches</a></li>
                <li><a href='Añadircoc.php'>Añade un alquiler</a></li>
            </ul>
        </nav></header>
        <main>
            <h2>Bienvenido ".$_SESSION['user']."</h2>
            <p>Encantados de tenerte por aquí..</p>
            <span class='cerrar'><a href=cerrar.php >Cerrar mi sesión</a></span>
                </main>
            <div class='cont'>
                <div class='cont1'>
                    <h2>Bienvenido</h2><hr><br>
                    <p>Este es un concesionario mazo molón y tenemos los coches más coche del undo, no roquen, ustedes saben que aquí somos full.<br>
                    Puede alquilar, poner en alquiler y ver los mejores carrosa del mundo mundial, tenemos el Lincon XII primera edición y tambien tenemos el Bananoche BMW x Lambergamber.</p>
                </div>
                <div class='cont1'>
                    <h2>Inicia Sesión</h2><hr><br>
                    <p>Inicia sesión u comprueba tus alquileres, tu saldo y datos personales, si eres bandero le sabes.<br><br>
                    <a href='Inicio.php'>Iniciar Sesión</a><br>
                    Sujeto a terminos y condiciones de uso</p>
                </div>
                <div class='cont1'>
                    <h2>Registrate ya.</h2><hr><br>
                    <p>Si quieres adquirir, alquilar o arrendar tus carros necesitas una cuenta en nuestra BBDD porque si no pues vaya basura de sistema de alquiler.<br>
                    Registrate y forma parte de este grupo radicalista de crimen organizado ¡YA!</p>
                    <a href'*.php'>Registrarme</a></p>
                </div>";
            }





            elseif($_SESSION['tipo'] === 'adm')
            {
                {
        echo" 
            <header> <h1>Concesionario de Vehículos</h1>
        <nav>
            <ul>
                <li><a href='coches.html'>Opciones coches</a></li>
                <li><a href='Usuarios.html'>Opciones usuarios</a></li>
                <li><a href='Alquileres.html'>Opciones alquileres</a></li>
            </ul>
        </nav></header>
        <main>
            <h2>MODO ADMINISTRADOR</h2>
            <p>Seleccione una de las secciones del menú para continuar.</p>
            <span class='cerrar'><a href=cerrar.php >Salir del modo adm</a></span>
                </main>
            <div class='cont'>
                <div class='cont1'>
                    <h2>Estas en modo ADMINISTRADOR</h2><hr><br>
                    <p>Puedes modificar toda al información disponible de la página.
                    Borrar alquileres, modificar, añadir y borrar usuarios.</p>
                </div>";
                }
            }
            else 
            {
            echo" 
            <header> <h1>Concesionario de Vehículos</h1>
        <nav>
            <ul>
                <li><a href='Listarcoc.php'>Ver coches</a></li>
            </ul>
        </nav></header>
        <main>
            <h2>Bienvenido a nuestro Concesionario</h2>
            <p>Seleccione una de las secciones del menú para continuar.</p>
                </main>
            <div class='cont'>
                <div class='cont1'>
                    <h2>Bienvenido</h2><hr><br>
                    <p>Este es un concesionario mazo molón y tenemos los coches más coche del mundo, no ronquen, ustedes saben que aquí somos full.<br>
                    Puede alquilar, poner en alquiler y ver los mejores carrosa del mundo mundial, tenemos el Lincon XII primera edición y tambien tenemos el Bananoche BMW x Lambergamber.</p>
                </div>
                <div class='cont1'>
                    <h2>Inicia Sesión</h2><hr><br>
                    <p>Inicia sesión y comprueba tus alquileres, tu saldo y datos personales, si eres bandero le sabes.<br><br>
                    <a href='Inicio.php'>Iniciar Sesión</a><br>
                    Sujeto a terminos y condiciones de uso</p>
                </div>
                <div class='cont1'>
                    <h2>Registrate ya.</h2><hr><br>
                    <p>Si quieres adquirir, alquilar o arrendar tus carros necesitas una cuenta en nuestra BBDD porque si no pues vaya basura de sistema de alquiler.<br>
                    Registrate y forma parte de este grupo radicalista de crimen organizado ¡YA!</p>
                    <a href=Añadiruser.php>Registrarme</a></p>
                </div>";
            }
        ?>

</body>
</html>

