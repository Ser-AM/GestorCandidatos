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
            //error_reporting(E_ERROR | E_PARSE);

            // Variables que recibimos del formulario de insertarCandidato
            
            //$telefono = $_POST['telefono'];
            $titulo = $_POST['titulo'];
            $sector = $_POST['sector'];
            $especialidad = $_POST['especialidad'];
            $software1 = $_POST['software1'];
            $experiencia1 = $_POST['experiencia1'];
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
            
            $queryDatosCandidato = "SELECT * FROM `datos` JOIN `softwares` ON 
                datos.TELEFONO = softwares.TELEFONO WHERE
                /*ESPECIALIDAD LIKE '%$especialidad%' AND*/
                TITULO LIKE '%$titulo%'/* AND
                SECTOR LIKE '%$sector%' AND
                NOTAS LIKE '%$notas%' AND
                SOFTWARE LIKE '$software1'*/";

            //$querySoftwareCandidato = "SELECT * FROM `softwares` WHERE
              //  SOFTWARE = '$software1'";

            $resultadosDatos = mysqli_query($conexion, $queryDatosCandidato);
            
            if($resultadosDatos == false){
                echo "Error al encontrar los candidatos. " . mysqli_error($conexion);
            } else {
                while(($fila = mysqli_fetch_array($resultadosDatos, MYSQLI_ASSOC))){
                    echo $fila['NOMBRE'] . " " . $fila['APELLIDOS'] . " " . $fila['EMAIL'] . " " . $fila['TITULO'] . " " . $fila['SOFTWARE'];
                };
            }



            // Cerramos la conexión
            mysqli_close($conexion);

        ?>
    </body> 
</html>