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
                <button><a href="../../buscarCandidatos.php">Buscar candidatos</a></button>
            </nav>
        </header>
        <?php
            // No muestra los errores como posibles "undefined" de campos que no han sido rellenados
            error_reporting(E_ERROR | E_PARSE);

            // Variables que recibimos del formulario de insertarCandidato
            
            //$telefono = $_POST['telefono'];
            $titulo = $_POST['titulo'];
            $sector = $_POST['sector'];
            $departamento = $_POST['departamento'];
            $perfil = $_POST['perfil'];
            $ingles = $_POST['ingles'];
            $aleman = $_POST['aleman'];
            $software1 = $_POST['software1'];
            $experiencia1 = $_POST['experiencia1'];
            $notas = $_POST['notas'];

            // Importamos los datos de conexión:
            require("datosConexion.php");

            /*
            //COMPROBAMOS SI HAY SESIÓN INICIADA
            session_start();

            if(!isset($_COOKIE["usuario"])){
                header("Location: ../../index.html");
            }
            */

            // Se especifica y ejecuta la query
            $queryDatosCandidato = "SELECT * FROM `datos` JOIN `softwares` ON 
                    datos.TELEFONO = softwares.TELEFONO WHERE
                    DEPARTAMENTO LIKE '%$departamento%' AND
                    PERFIL LIKE '%$perfil%' AND
                    TITULO LIKE '%$titulo%' AND
                    SECTOR LIKE '%$sector%' AND
                    INGLES LIKE '%$ingles%' AND
                    ALEMAN LIKE '%$aleman%' AND
                    SOFTWARE LIKE '%$software1%' AND
                    NOTAS LIKE '%$notas%'
                    ORDER BY datos.TELEFONO";

            $resultadosDatos = mysqli_query($conexion, $queryDatosCandidato);
            $nombreCandidato = " ";
            if($resultadosDatos == false){
                echo "Error al encontrar los candidatos. " . mysqli_error($conexion);
            } else {
                while(($fila = mysqli_fetch_array($resultadosDatos, MYSQLI_ASSOC))){
                    $telefonoCandidato = $fila['TELEFONO'];
                    if($nombreCandidato != $fila['NOMBRE']){
                    $nombreCandidato = $fila['NOMBRE'];

                echo "<div class='resultadoCandidato'>";
                echo    "<div class='contenedorResultado'>";
                echo        "<h1>". $fila['NOMBRE'] . " " . $fila['APELLIDOS']."</h1>";
                echo        "<p>".$fila['TELEFONO']."</p>";
                echo        "<h3>Departamento: ".$fila['DEPARTAMENTO']."</h3>";
                echo        "<h3>Perfil: " .$fila['PERFIL']."</h3>";
                echo        "<div class='softwareExperiencia'>";
                

                $queryBuscarSoftwareCandidato = "SELECT * FROM `softwares` WHERE TELEFONO = '$telefonoCandidato'";
                $resultadosSoftware = mysqli_query($conexion, $queryBuscarSoftwareCandidato);

                // NO FUNCIONA BIEN ASÍ. SE INSERTAN EN EL PRIMER CANDIDATO QUE APAREZCA TODOS LOS SOFTWARES QUE ENCUENTRA
                if($resultadosSoftware == false){
                    echo "No se han encontrado softwares para este candidato";
                }else{
                    while(($fila2 = mysqli_fetch_array($resultadosSoftware, MYSQLI_ASSOC))){
                    echo   "<p>".$fila2['SOFTWARE']."  ".$fila2['EXPERIENCIA']."</p>";
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
                
                }};
            }

            // Cerramos la conexión
            mysqli_close($conexion);

        ?>
    </body> 
</html>