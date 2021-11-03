<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="" />
        <meta name="author" content="Ser-AM" />
        <title>Gestor de Candidatos</title>
        <link rel="stylesheet" href="../css/style.css"/>
        <script src="assets/js/jquery.min.js"></script>
    	<script src="assets/js/funciones.js"></script>
        <style>
            .resultadoCandidato{
                flex-direction: column;
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
            $especialidad = $_POST['especialidad'];
            $software1 = $_POST['software1'];
            $experiencia1 = $_POST['experiencia1'];
            $software2 = $_POST['software2'];
            $experiencia2 = $_POST['experiencia2'];
            $notas = $_POST['notas'];

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
            $queryInsertarCandidato = "SELECT * FROM `candidatos` WHERE ESPECIALIDAD LIKE '%$especialidad%' AND SOFTWARE1 LIKE '%$software1%' AND EXPERIENCIA1 LIKE '%$experiencia1%' AND SOFTWARE2 LIKE '%$software2%' AND EXPERIENCIA2 LIKE '%$experiencia2%' AND NOTAS LIKE '%$notas%'";

            $resultados = mysqli_query($conexion, $queryInsertarCandidato);

            if($resultados == false){
                echo "Error al encontrar los candidatos. " . mysqli_error($conexion);
            } else {
                while(($fila = mysqli_fetch_array($resultados, MYSQLI_ASSOC))){

                echo "<div class='resultadoCandidato'>";
                echo "<h4>Candidato: </h4>" . $fila['NOMBRE'] . " " . $fila['APELLIDOS'];
                echo "<div class='contenedorResultado'>";
                echo "<div class='softwareExperiencia'>";
                echo "<p>Especialidad: ".$fila['ESPECIALIDAD']."</p><br>";
                echo "<br><p>Software: ".$fila['SOFTWARE1']." nivel ".$fila['EXPERIENCIA1']."</p>";
                echo "<br><p>Software: ".$fila['SOFTWARE2']." nivel ".$fila['EXPERIENCIA2']."</p>";
                echo "</div> <br>";
                echo "<div><h5>Notas: </h5><p>  ". $fila['NOTAS'] ."</p> </div>";
                echo "<div><h5>Currículum => </h5><a href='../../cvs/CV".$fila['TELEFONO'].".pdf' target='_blank'>CV ". $fila['NOMBRE']."</a></div>";
                echo "<form action='./perfilCandidato.php' method='post'><div><p>Ir al perfil completo</p><input type='submit' name='telefono' value='".$fila['TELEFONO']."'></input></div></form>";
                echo "</div></div>";
                }
            }

            // Cerramos la conexión
            mysqli_close($conexion);
        ?>
    </body>
</html>