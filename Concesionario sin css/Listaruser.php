<HTML LANG="es">
<HEAD>
</HEAD>

<BODY>

<H1>Usuarios Registrados</H1>

<?PHP

      $conexion = mysqli_connect("localhost", "root", "rootroot")
         or die("No se puede conectar con el servidor");
       
      mysqli_select_db($conexion,"concesionario")
         or die("No se puede seleccionar la base de datos");

      $instruccion = "SELECT * FROM usuarios";
      $consulta = mysqli_query($conexion, $instruccion)
         or die("Fallo en la consulta");

      $nfilas = mysqli_num_rows($consulta);
      if ($nfilas > 0)
      {
         print ("<TABLE border=1>\n");
         print ("<TR>\n");
         print ("<TH>id</TH>\n");
         print ("<TH>nombre</TH>\n");
         print ("<TH>apellidos</TH>\n");
         print ("<TH>dni</TH>\n");
         print ("<TH>saldo</TH>\n");
        
         print ("</TR>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mysqli_fetch_array($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado['id_usuario'] . "</TD>\n");
            print ("<TD>" . $resultado['nombre'] . "</TD>\n");
            print ("<TD>" . $resultado['apellidos'] . "</TD>\n");
            print ("<TD>" . $resultado['dni'] . "</TD>\n");
            print ("<TD>" . $resultado['saldo'] . "</TD>\n");

            print ("</TR>\n");
         }

         print ("</TABLE>\n");
      }
      else
         print ("No hay usuarios registrados");

mysqli_close($conexion);

?>

<a href="conce.html">Volver a inicio</a>
</BODY>
</HTML>

