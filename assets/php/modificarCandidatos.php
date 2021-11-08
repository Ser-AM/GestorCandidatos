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
            $telefono = htmlspecialchars($_GET["tln"]);
            echo $telefono;

            // No muestra los errores como posibles "undefined" de campos que no han sido rellenados
            error_reporting(E_ERROR | E_PARSE);

            //Variable que recibimos de buscarCandidatos
            $telefono = $_GET['telefono'];

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

            // Se especifica y ejecuta la query
            $queryInsertarCandidato = "SELECT * FROM `datos` WHERE TELEFONO = '$telefono';
            SELECT * FROM `softwares` WHERE TELEFONO = '$telefono'";

            $resultados = mysqli_query($conexion, $queryInsertarCandidato);
        ?>
    </body>
</html>

<?php

$queryInsertarCandidato = "INSERT INTO `datos` 
(NOMBRE, APELLIDOS, EMAIL, TELEFONO, NOTAS, TITULO, SECTOR, ESPECIALIDAD) VALUES ('$nombre', '$apellidos', '$email', '$telefono', '$notas', '$titulo', '$sector', '$especialidad'); INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software1', '$experiencia1');
INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software2', '$experiencia2');
INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software3', '$experiencia3');
INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software4', '$experiencia4');
INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software5', '$experiencia5'); 
INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software6', '$experiencia6')";
            ?>