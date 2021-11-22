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
            table{
                align-items: center;
                display: inline;
            }
            .resultadoCandidato{
                display: flex;
                flex-direction: column;
            }
        </style>
    </head>
    <body>
        <header>
            <div>
                <button><a href="../../crearCandidato.php">Añadir candidatos</a></button>
                <button><a href="../../buscarCandidatos.php">Buscar candidatos</a></button>
            </div>
            <div>
                <img src="assets/images/Gestor_Candidatos.png" alt="">
            </div>
        </header>
        <?php
            // No muestra los errores como posibles "undefined" de campos que no han sido rellenados
            error_reporting(E_ERROR | E_PARSE);
            
            // Variables que recibimos del formulario de insertarCandidato
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $notas = $_POST['notas'];
            $titulo = $_POST['titulo'];
            $sector = $_POST['sector'];
            $departamento = $_POST['departamento'];
            $software1 = $_POST['software1'];
            $experiencia1 = $_POST['experiencia1'];
            $software2 = $_POST['software2'];
            $experiencia2 = $_POST['experiencia2'];
            $software3 = $_POST['software3'];
            $experiencia3 = $_POST['experiencia3'];
            $software4 = $_POST['software4'];
            $experiencia4 = $_POST['experiencia4'];
            $ingles = $_POST['ingles'];
            $aleman = $_POST['aleman'];

            // Importamos los datos de conexión:
            require("datosConexion.php");

            //COMPROBAMOS SI HAY SESIÓN INICIADA
            session_start();

            if(!isset($_COOKIE["usuario"])){
                header("Location: ../../index.html");
            }

            // Se especifica y ejecuta la query
            $queryInsertarDatos = "INSERT INTO `datos` (NOMBRE, APELLIDOS, EMAIL, TELEFONO, NOTAS, TITULO, SECTOR, DEPARTAMENTO, INGLES, ALEMAN) VALUES ('$nombre', '$apellidos', '$email', '$telefono', '$notas', '$titulo', '$sector', '$departamento', '$ingles', '$aleman')";
            $queryInsertarSoftware1 = "INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software1', '$experiencia1')";
            $queryInsertarSoftware2 = "INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software2', '$experiencia2')";
            $queryInsertarSoftware3 = "INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software3', '$experiencia3')";
            $queryInsertarSoftware4 = "INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software4', '$experiencia4')";
            
            
            $resultados  = mysqli_query($conexion, $queryInsertarDatos);
            
            // Turn off all error reporting
            error_reporting(E_ERROR | E_PARSE);

            if(mysqli_errno($conexion) == 1062){
                echo "<div>El número de teléfono introducido ya existe en la base de datos</div>";
            }else if($resultados == false){
                echo "<div>Error al insertar el candidato: " . mysqli_error($conexion) . " </div>";
            } else {

                mysqli_query($conexion, $queryInsertarSoftware1);
                mysqli_query($conexion, $queryInsertarSoftware2);
                mysqli_query($conexion, $queryInsertarSoftware3);
                mysqli_query($conexion, $queryInsertarSoftware4);

                header("Location: perfilCandidato.php?tln=$telefono");
                
            }



            // Cerramos la conexión
            mysqli_close($conexion);

        ?>
    </body>
</html>