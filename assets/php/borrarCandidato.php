<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="" />
        <title>Gestor de Candidatos</title>
        <link rel="stylesheet" href="../css/style.css"/>
        <script src="../js/jquery.min.js"></script>
    	<script src="../js/funciones.js"></script>
    </head>
    <body>
    <header>
            <div class="header">
                <div id="logo">
                    <img src="../images/Gestor_Candidatos.png" alt="">
                </div>
            </div>
            <nav>
                <button><a href="../../crearCandidato.php">Añadir candidato</a></button>
                <button><a href="../../buscarCandidatos.html">Buscar candidatos</a></button>
            </nav>
        </header>
        <?php
            // No muestra los errores como posibles "undefined" de campos que no han sido rellenados
            //error_reporting(E_ERROR | E_PARSE);

            //Variable que recibimos de buscarCandidatos
            $telefono = $_GET['tln'];

            // Importamos los datos de conexión:
            require("datosConexion.php");

            // Abrimos la conexión:
            $conexion = mysqli_connect($db_host, $db_usuario, $db_password);

            // Capturamos el posible error de conexión y lo mostramos por pantalla:
            if(mysqli_connect_errno()){
                print "Fallo al intentar conectar con la base de datos";

                exit;
            }

            // Seleccionamos la base de datos con la que queremos interactuar
            mysqli_select_db($conexion, $db_nombre) or die("No se encontró la base de datos");

            // Convertimos a formato UTF8 los caracteres de la conexión:
            mysqli_set_charset($conexion, "UTF8");

            // Se especifica y ejecuta la query para borrar toda la información del candidato
            $queryDatosCandidato = "DELETE FROM `datos` WHERE TELEFONO = '$telefono'";
            $querySoftwaresCandidato = "DELETE FROM `softwares` WHERE TELEFONO = '$telefono'";

            mysqli_query($conexion, $queryDatosCandidato);
            mysqli_query($conexion, $querySoftwaresCandidato);

            echo "<div><p>El candidato ha sido eliminado correctamente</p></div>";

            // Cerramos la conexión
            mysqli_close($conexion);
        ?>
    </body>
</html>