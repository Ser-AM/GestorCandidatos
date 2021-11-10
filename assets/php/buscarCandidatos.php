<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="" />
        <title>Gestor de Candidatos</title>
        <link rel="icon" type="image/x-icon" href="assets/images/Gestor_Candidatos_Icon.png">
        <link rel="stylesheet" href="../css/style.css"/>
        <script src="assets/js/jquery.min.js"></script>
    	<script src="assets/js/funciones.js"></script>
    </head>
    <body>
        <header>
            <div>
                <img src="../images/Gestor_Candidatos.png" alt="">
            </div>
            <nav>
                <button><a href="../../crearCandidato.php">Añadir candidato</a></button>
                <button><a href="../../buscarCandidatos.html">Buscar candidatos</a></button>
            </nav>
        </header>
        <?php
            // No muestra los errores como posibles "undefined" de campos que no han sido rellenados
            error_reporting(E_ERROR | E_PARSE);

            // Variables que recibimos del formulario de insertarCandidato
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];

            $titulo = $_POST['titulo'];
            $sector = $_POST['sector'];
            $especialidad = $_POST['especialidad'];
            $software1 = $_POST['software1'];
            $experiencia1 = $_POST['experiencia1'];
            $notas = $_POST['notas'];

            // A la espera de ver la forma de buscar diferentes softwares y experiencias asociadas sin tener una query tan larga

            /*$experiencia1 = $_POST['experiencia1'];
            $software2 = $_POST['software2'];
            $experiencia2 = $_POST['experiencia2'];*/
            

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
            $queryBuscarDatosCandidato = "SELECT * FROM `datos` WHERE 
                NOMBRE LIKE '%$nombre%' AND
                APELLIDOS LIKE '%$apellidos%' AND
                EMAIL LIKE '%$email%' AND
                TELEFONO LIKE '%$telefono%' AND 
                NOTAS LIKE '%$notas%' AND
                ESPECIALIDAD LIKE '%$especialidad%' AND
                TITULO LIKE '%$titulo%' AND
                SECTOR LIKE '%$sector%'";

            $queryBuscarSoftwareCandidato = "SELECT * FROM `softwares` WHERE
                TELEFONO LIKE '%$telefono%' AND
                SOFTWARE LIKE '%$software1%'";

            
            $resultadosDatos = mysqli_query($conexion, $queryBuscarDatosCandidato);
            $resultadosSoftware = mysqli_query($conexion, $queryBuscarSoftwareCandidato);

            if($resultadosDatos == false){
                echo "Error al encontrar los candidatos. " . mysqli_error($conexion);
            } else {
                // div contenedor
                while(($fila = mysqli_fetch_array($resultadosDatos, MYSQLI_ASSOC))){

                    $telefonoCandidato = $fila['TELEFONO'];

                echo "<div class='resultadoCandidato'>";
                echo    "<div class='contenedorResultado'>";
                echo        "<h1>". $fila['NOMBRE'] . " " . $fila['APELLIDOS']."</h1>";
                echo        "<p>".$fila['TELEFONO']."</p>";
                echo        "<h3>Especialidad: ".$fila['ESPECIALIDAD']."</h3>";
                echo        "<div class='softwareExperiencia'>";
                

                // NO FUNCIONA BIEN ASÍ. SE INSERTAN EN EL PRIMER CANDIDATO QUE APAREZCA TODOS LOS SOFTWARES QUE ENCUENTRA
                if($resultadosSoftware == false){
                    echo "No se han encontrado softwares para este candidato";
                }else{
                    while(($fila2 = mysqli_fetch_array($resultadosSoftware, MYSQLI_ASSOC))){
                    echo            "<p>Software: ".$fila2['SOFTWARE']." nivel ".$fila2['EXPERIENCIA']."</p>";
                    }
                }

                echo        "</div>";
                echo    "</div>";
                echo    "<div class='contenedorResultado'>";
                echo        "<div class='botones-candidato'>";
                echo        "<button id='boton-ver-cv'><a href='../../cvs/CV".$fila['TELEFONO']."' target='_blank'>Ver CV</a></button>";
                echo        "<button id='boton-ver-perfil'><a href='perfilCandidato.php?tln=$telefonoCandidato' target='_self'>Ver perfil</button></a>"; 
                echo        "</div>";
                echo        "<div class='notas-candidato-resultado'>";
                echo            "<h5>Notas: </h5>";
                echo            "<p>  ". $fila['NOTAS'] ."</p>";
                echo        "</div>";
                echo    "</div>";
                echo "</div>";
                }
            }
            // Cerramos la conexión
            mysqli_close($conexion);

            //
        ?>
    </body>
</html>