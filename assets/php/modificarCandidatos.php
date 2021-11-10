<!DOCTYPE html>
<html lang="es">
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
            $queryDatos = "SELECT * FROM `datos` WHERE TELEFONO = '$telefono'";
            $querySoftwares="SELECT * FROM `softwares` WHERE TELEFONO = '$telefono'";

            $resultadoDatos = mysqli_query($conexion, $queryDatos);
            $resultadoSoftware = mysqli_query($conexion, $querySoftwares);

            while(($fila = mysqli_fetch_array($resultadoSoftware, MYSQLI_ASSOC))){
                for($i = 0; $i < sizeof($resultadoSoftware);$i++){
                $software.$i = $fila['SOFTWARE'];
                }
            };
            if($resultados == false){
                echo "Error al insertar el candidato " . mysqli_error($conexion);
            } else {
                while(($fila = mysqli_fetch_array($resultadoDatos, MYSQLI_ASSOC))){

                    $telefonoCandidato = $fila['TELEFONO'];
                    echo"
                        <nav class='nav-busqueda' id='nav-editar-perfil'>
                            <button id='eliminar-perfil'><a href='#'>Eliminar Perfil</a></button>
                        </nav>
                        <form action='assets/php/insertarCandidato.php' method='post'>
                            <div class='ficha ver-perfil'>
                                <div id='datos-notas'>
                                    <div class='datos'>
                                        <fieldset>
                                            <legend>Datos Personales:</legend>
                                            <input type='text' name='nombre' value='".$fila['NOMBRE']."'  placeholder='Nombre...'>
                                            <input type='text' name='apellidos' value='".$fila['APELLIDOS']."'  placeholder='Apellidos...'>                  
                                            <input type='email' name='email'value='".$fila['EMAIL']."'   placeholder='Email...'>
                                            <input type='tel' name='telefono' value='".$fila['TELEFONO']."'  placeholder='Teléfono...' required>
                                            <div id='div-titulo-sector'>
                                                <div id='titulo-box'>
                                                    <label for='Titulo'>Título:</label>
                                                    <select name='titulo' id='titulo' >
                                                        <option value='".$fila['TITULO']."' selected>".$fila['TITULO']."</option>
                                                        <option value='Arquitecto'>Arquitecto</option>
                                                        <option value='IngenieroCivil'>Ing. Civil</option>
                                                        <option value='IngenieroElectrico'>Ing. Eléctrico</option>
                                                        <option value='IngenieroMecanico'>Ing. Mecánico</option>
                                                    </select>
                                                </div>
                                                <div id='sector-box'>
                                                    <label for='sector'>Sector:</label>
                                                    <select id='sector' name='sector' >
                                                        <option value='".$fila['SECTOR']."' selected>".$fila['SECTOR']."</option>
                                                        <option value='Aguas'>Aguas</option>
                                                        <option value='Oil&Gas'>Oil&Gas</option>
                                                        <option value='Renovables'>Renovables</option>
                                                        <option value='Fotovoltaica'>Fotovoltaica</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class='div-notas'>
                                        <fieldset>
                                            <legend>Notas:</legend>
                                            <textarea id='notas' name='notas' rows='16' placeholder='Escribe aquí tus comentarios' >".$fila['NOTAS']."</textarea>
                                            <button id='boton-ver-cv' type='submit' formaction='../../cvs/CV".$fila['TELEFONO'].".pdf' formtarget='_blank'>Ver CV</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>     
                            <div id='bloque-programas'>
                                <fieldset>
                                    <div class='seleccionar-especialidad'>
                                        <select name= 'especialidad' class='especialidad' >
                                            <option value='".$fila['ESPECIALIDAD']."' selected  hidden>".$fila['ESPECIALIDAD']."</option>
                                            <option value='mecanica'>Mecánica</option>
                                            <option value='arquitectura'>Arquitectura</option>
                                            <option value='obra-civil'>Obra Civil</option>
                                            <option value='industrial'>Industrial</option>
                                            <option value='otros'>Otros</option>
                                        </select>
                                    </div>
                                    
                                        <div class='especialidad'>
                                            <div class='programa-row-left'>
                                                <select name= 'software1' class='programa general' >
                                                    <option value='".$fila['software1']."' selected  hidden>".$fila['software1']."</option>";
                                                    require 'partials/options-softwares.php';
                        echo"                   </select>
                                                <select name= 'experiencia1' class='experiencia' >
                                                    <option value='".$fila['$experiencia1']."' selected  hidden>".$fila['$experiencia1']."</option>";
                                                    require 'partials/options-exp.php';
                        echo"                   </select>
                                            </div>
                                            <div class='programa-row-right'>
                                                <select name= 'software2' class='programa general' >
                                                    <option value='".$fila['APP_2']."' selected  hidden>".$fila['APP_2']."</option>";
                                                    require 'partials/options-softwares.php';
                        echo"                   </select>
                                                <select name= 'experiencia2' class='experiencia' >
                                                    <option value='".$fila['$experiencia2']."' selected  hidden>".$fila['$experiencia2']."</option>";
                                                    require 'partials/options-exp.php';
                        echo"                   </select>
                                            </div>
                                        </div>
                                        <div class='especialidad'>
                                            <div class='programa-row-left'>
                                                <select name= 'software3' class='programa general' >
                                                    <option value='".$fila['APP_3']."' selected  hidden>".$fila['APP_3']."</option>";
                                                    require 'partials/options-softwares.php';
                        echo"                   </select>
                                                <select name= 'experiencia3' class='experiencia' >
                                                    <option value='".$fila['$experiencia3']."' selected  hidden>".$fila['$experiencia3']."</option>";
                                                    require 'partials/options-exp.php';
                        echo"                   </select>
                                            </div>
                                            <div class='programa-row-right'>
                                                <select name= 'software4' class='programa general' >
                                                    <option value='".$fila['APP_4']."' selected  hidden>".$fila['APP_4']."</option>";
                                                    require 'partials/options-softwares.php';
                        echo"                        </select>
                                                <select name= 'experiencia4' class='experiencia' >
                                                    <option value='".$fila['$experiencia4']."' selected  hidden>".$fila['$experiencia4']."</option>";
                                                    require 'partials/options-exp.php';
                        echo"                   </select>
                                            </div>
                                        </div>
                                        <div class='especialidad'>
                                            <div class='programa-row-left'>
                                                <select name= 'software5' class='programa general' >
                                                    <option value='".$fila['APP_5']."' selected  hidden>".$fila['APP_5']."</option>";
                                                    require 'partials/options-softwares.php';
                        echo"                        </select>
                                                <select name= 'experiencia5' class='experiencia' >
                                                    <option value='".$fila['$experiencia5']."' selected  hidden>".$fila['$experiencia5']."</option>";
                                                    require 'partials/options-exp.php';
                        echo"                   </select>
                                            </div>
                                            <div class='programa-row-right'>
                                                <select name= 'software6' class='programa general' >
                                                    <option value='".$fila['APP_6']."' selected  hidden>".$fila['APP_6']."</option>";
                                                    require 'partials/options-softwares.php';
                        echo"                        </select>
                                                <select name= 'experiencia6' class='experiencia' >
                                                    <option value='".$fila['$experiencia6']."' selected  hidden>".$fila['$experiencia6']."</option>";
                                                    require 'partials/options-exp.php';
                        echo"                   </select>
                                            </div>
                                        </div>
                                    
                                </fieldset>
                                <br>
                                <input type='submit' name='enviaFormulario' value='Guardar Cambios'>
                            </div>
                        </form>
                    " ;
                    }
                }

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