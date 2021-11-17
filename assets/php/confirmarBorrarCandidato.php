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
                <button><a href="../../buscarCandidatos.php">Buscar candidatos</a></button>
            </nav>
        </header>
        <?php
            // No muestra los errores como posibles "undefined" de campos que no han sido rellenados
            //error_reporting(E_ERROR | E_PARSE);

            //Variable que recibimos de buscarCandidatos
            $telefono = $_GET['tln'];

            // Importamos los datos de conexión:
            require("datosConexion.php");

            //COMPROBAMOS SI HAY SESIÓN INICIADA
            session_start();

            if(!isset($_COOKIE["usuario"])){
                header("Location: ../../index.html");
            }

            // Se especifica y ejecuta la query para saber qué perfil podemos borrar
            $queryCandidato = "SELECT * from `datos` WHERE TELEFONO = '$telefono'";

            $resultadoDatos = mysqli_query($conexion, $queryCandidato);
            
            
            $fila = mysqli_fetch_array($resultadoDatos, MYSQLI_ASSOC);
            echo "<div><p>¿Estás seguro de querer borrar al candidato ". $fila['NOMBRE'] . " " . $fila['APELLIDOS'] ." ? </p></div>";
            echo "<div><button><a href='../php/borrarCandidato.php?tln=$telefono'>BORRAR</a></button><button><a href='../php/perfilCandidato.php?tln=$telefono' >Volver al perfil</a></button></div>";
            
            // Cerramos la conexión
            mysqli_close($conexion);
        ?>
    </body>
</html>