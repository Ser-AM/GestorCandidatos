<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="" />
        <title>Gestor de Candidatos</title>
        <link rel="stylesheet" href="../css/style.css"/>
        <script src="assets/js/jquery.min.js"></script>
    	<script src="assets/js/funciones.js"></script>
        <style>
            .resultadoCandidato{
                display: flex;
                flex-direction: column;
            }
            .resultadoCandidato p{
                display: inline-block;
                vertical-align: middle;
                line-height: normal;
            }
        </style>
    </head>
    <body>

        <header>
            <div>
                <button><a href="../../index.html">Añadir candidatos</a></button>
                <button><a href="../../buscarCandidatos.html">Buscar candidatos</a></button>
            </div>
            <div>
                <img src="assets/images/Gestor_Candidatos.png" alt="">
            </div>
        </header>
        <?php
            // No muestra los errores como posibles "undefined" de campos que no han sido rellenados
            error_reporting(E_ERROR | E_PARSE);

            // Variables que recibimos del formulario de insertarCandidato
            $telefono = $_POST['telefono'];

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
            $queryInsertarCandidato = "SELECT * FROM `candidatos` WHERE TELEFONO = '$telefono'";

            $resultados = mysqli_query($conexion, $queryInsertarCandidato);

            if($resultados == false){
                echo "Error al insertar el candidato " . mysqli_error($conexion);
            } else {
                while(($fila = mysqli_fetch_array($resultados, MYSQLI_ASSOC))){

                echo "<div class='resultadoCandidato'>";
                echo "<h4>Candidato: </h4>" . $fila['NOMBRE'] . " " . $fila['APELLIDOS'] . "<br>";
                echo $fila['EMAIL'] . "<br>";
                echo "Número de teléfono: " . $fila['TELEFONO'] . "<br>";
                echo "<br>Especialidad: " . $fila['ESPECIALIDAD'] . "<br>";
                echo "Titulación: " . $fila['TITULO'] . "<br>";
                echo "Sector: " . $fila['SECTOR'];
                echo "<br>Aplicaciones informáticas: <br>";
                echo $fila['APP_1'] . "   nivel " . $fila['EXP_1'];
                echo "<div class='contenedorResultado'>";
                echo "<table><tr><td>Notas: </td><td>". $fila['NOTAS'] ."</td>";
                echo "<td><div></div></td>";
                echo "<td>Currículum => </td><td><a href='../../cvs/CV".$fila['TELEFONO'].".pdf' target='_blank'>CV ". $fila['NOMBRE']."</a></td></tr></table>";
                echo "";
                echo "</div></div>";
                }
            }

            // Cerramos la conexión
            mysqli_close($conexion);
        ?>
    </body>
</html>