<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="" />
        <title>Gestor de Candidatos</title>
        <link rel="icon" type="image/x-icon" href="../images/Gestor_Candidatos_Icon.png">
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
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];

            $titulo = $_POST['titulo'];
            $sector = $_POST['sector'];
            $departamento = $_POST['departamento'];
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
            $queryBuscarDatosCandidato = "SELECT * FROM `datos` WHERE 
                NOMBRE LIKE '%$nombre%'AND
                APELLIDOS LIKE '%$apellidos%' AND
                EMAIL LIKE '%$email%' AND
                TELEFONO LIKE '%$telefono%' AND 
                NOTAS LIKE '%$notas%'
                ORDER BY NOMBRE";

            $resultadosDatos = mysqli_query($conexion, $queryBuscarDatosCandidato);
            //echo "<div>Se han encontrado " . mysqli_num_rows($resultadosDatos) . " resultados. </div>";
            if($resultadosDatos == false){
                echo "Error al encontrar los candidatos. ";// . mysqli_error($conexion);
            } else {
                // div contenedor
                while(($fila = mysqli_fetch_array($resultadosDatos, MYSQLI_ASSOC))){
                    
                    
                    $telefonoCandidato = $fila['TELEFONO'];

                    echo "<div class='resultadoCandidato'>
                            <div class='contenedorResultado'>
                                <h1>". $fila['NOMBRE'] . " " . $fila['APELLIDOS']."</h1>
                                <h3>Telefono: ".$fila['TELEFONO']."</h3>
                                <div>
                                    <div id='datos-en-busqueda'>
                                        <p><b>Departamento: </b>".$fila['DEPARTAMENTO']."</p>
                                        <p><b>Perfil: </b>" .$fila['PERFIL']. "</p>
                                        <p><b>Titulo: </b>" .$fila['TITULO']. "</p>
                                        <p><b>Sector: </b>" .$fila['SECTOR']. "</p>
                                        <br>
                                        <p><b>Ingles: </b>" .$fila['INGLES']. "</p>
                                        <p><b>Aleman: </b>" .$fila['ALEMAN']. "</p>
                                    </div>
                                    <div class='softwareExperiencia'>
                                        <br>
                                        <h3>Softwares: </h3>";
                    

                                        $queryBuscarSoftwareCandidato = "SELECT * FROM `softwares` WHERE TELEFONO = '$telefonoCandidato'";
                                        $resultadosSoftware = mysqli_query($conexion, $queryBuscarSoftwareCandidato);

                                        if($resultadosSoftware == false){
                                            echo "No se han encontrado softwares para este candidato";
                                        }else{
                                            while(($fila2 = mysqli_fetch_array($resultadosSoftware, MYSQLI_ASSOC))){
                                            echo   "<p>".$fila2['SOFTWARE']."  ".$fila2['EXPERIENCIA']."</p>";
                                            }
                                        }
                                        
                        echo        "</div>
                                </div>
                            </div>
                            <div class='contenedorResultado'>
                                <div class='botones-candidato'>
                                    <button id='boton-ver-cv'><a href='../../rutacv.html?tln=$telefonoCandidato' target='_blank'>Ver CV</a></button>
                                    <button id='boton-ver-perfil'><a href='perfilCandidato.php?tln=$telefonoCandidato' target='_self'>Ver perfil</button></a>
                                </div>
                                <div class='notas-candidato-resultado'>
                                    <h5>Notas: </h5>
                                    <p>  ". $fila['NOTAS'] ."</p>
                                </div>
                            </div>
                        </div>";
                }
            }
            // Cerramos la conexión
            mysqli_close($conexion);

            //
        ?>
    </body>
</html>