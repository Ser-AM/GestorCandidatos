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
    </head>
    <body>
        <header>
            <div>
                <img src="../images/Gestor_Candidatos.png" alt="">
            </div>
            <div>
                <button><a href="../../crearCandidato.php">Añadir candidatos</a></button>
                <button><a href="../../buscarCandidatos.php">Buscar candidatos</a></button>
            </div>
        </header>
        <?php
            // No muestra los errores como posibles "undefined" de campos que no han sido rellenados
            error_reporting(E_ERROR | E_PARSE);
            
            // Variables que recibimos del formulario de modificarCandidatos.php
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $notas = $_POST['notas'];
            $titulo = $_POST['titulo'];
            $sector = $_POST['sector'];
            $departamento = $_POST['departamento'];
            $ingles = $_POST['ingles'];
            $aleman = $_POST['aleman'];
            $software1 = $_POST['software1'];
            $experiencia1 = $_POST['experiencia1'];
            $software2 = $_POST['software2'];
            $experiencia2 = $_POST['experiencia2'];
            $software3 = $_POST['software3'];
            $experiencia3 = $_POST['experiencia3'];
            $software4 = $_POST['software4'];
            $experiencia4 = $_POST['experiencia4'];

            // Por la URL recibimos el telefono antiguo del candidato
            $telefonoAntiguo = $_GET["tln"];

            // Importamos los datos de conexión:
            require("datosConexion.php");

            //COMPROBAMOS SI HAY SESIÓN INICIADA
            session_start();

            if(!isset($_COOKIE["usuario"])){
                header("Location: ../../index.html");
            }

            // Se especifica y ejecuta la query

                //Primero borramos todos los registros asociados al teléfono
                $queryBorrarDatos = "DELETE FROM `datos` WHERE TELEFONO = '$telefonoAntiguo'";
                $queryBorrarSoftwares = "DELETE FROM softwares WHERE TELEFONO = '$telefonoAntiguo'";

                mysqli_query($conexion, $queryBorrarDatos);
                mysqli_query($conexion, $queryBorrarSoftwares);                

                //Ahora insertamos los nuevos datos y softwares del Candidato

                $queryInsertarDatos = "INSERT INTO `datos` (NOMBRE, APELLIDOS, EMAIL, TELEFONO, NOTAS, TITULO, SECTOR, DEPARTAMENTO, INGLES, ALEMAN) VALUES ('$nombre', '$apellidos', '$email', '$telefono', '$notas', '$titulo', '$sector', '$departamento', '$ingles', '$aleman')";
                $queryInsertarSoftware1 = "INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software1', '$experiencia1')";
                $queryInsertarSoftware2 = "INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software2', '$experiencia2')";
                $queryInsertarSoftware3 = "INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software3', '$experiencia3')";
                $queryInsertarSoftware4 = "INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software4', '$experiencia4')";

                $resultados  = mysqli_query($conexion, $queryInsertarDatos);
                
                if(mysqli_errno($conexion) == 1062){
                    echo "<div>El número de teléfono introducido ya existe en la base de datos</div>";
                }else if($resultados == false){
                    echo "<div>Error al insertar el candidato: " . mysqli_error($conexion) . " </div>";
                } else {

                    mysqli_query($conexion, $queryInsertarSoftware1);
                    mysqli_query($conexion, $queryInsertarSoftware2);
                    mysqli_query($conexion, $queryInsertarSoftware3);
                    mysqli_query($conexion, $queryInsertarSoftware4);
                    
                    echo "<div>
                        <p>Información de $nombre $apellidos actualizada correctamente</p><br>
                        <div><button><a href=perfilCandidato.php?tln=$telefono>Volver al perfil del candidato</a></button></div>
                    </div>";
            };



            // Cerramos la conexión
            mysqli_close($conexion);

        ?>
    </body>
</html>