<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="" />
        <title>Gestor de Candidatos</title>
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="icon" type="image/x-icon" href="../images/Gestor_Candidatos_Icon.png">
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
                <button><a href="../../buscarCandidatos.php">Buscar candidatos</a></button>
            </nav>
        </header>

        <?php
            $telefono = htmlspecialchars($_GET["tln"]);

            // No muestra los errores como posibles "undefined" de campos que no han sido rellenados
            error_reporting(E_ERROR | E_PARSE);

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
            $queryDatos = "SELECT * FROM `datos` WHERE TELEFONO = '$telefono'";
            $querySoftwares="SELECT * FROM `softwares` WHERE TELEFONO = '$telefono'";

            $resultadoDatos = mysqli_query($conexion, $queryDatos);
            $resultadoSoftware = mysqli_query($conexion, $querySoftwares);

            $i=1;
            while(($fila = mysqli_fetch_array($resultadoSoftware, MYSQLI_ASSOC))){
                $software[$i] = $fila['SOFTWARE'];
                $experiencia[$i] = $fila['EXPERIENCIA'];
                $i++;
            };
            
            if($resultadoDatos == false){
                echo "Error al insertar el candidato " . mysqli_error($conexion);
            } else {
                while(($fila = mysqli_fetch_array($resultadoDatos, MYSQLI_ASSOC))){

                    $telefonoCandidato = $fila['TELEFONO'];
                    echo"
                        <nav class='nav-busqueda' id='nav-editar-perfil'>
                            <button id='eliminar-perfil'><a href='#'>Eliminar Perfil</a></button>
                        </nav>
                        <form action='../php/guardarCambios.php?tln=$telefonoCandidato' method='post'>
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
                                                    <select name='titulo' class='programa general'>
                                                        <option value='".$fila['TITULO']."' selected>".$fila['TITULO']."</option>";
                                                        include 'partials/options-titulo.php';
                        echo"                       </select>
                                                </div>
                                                <div id='sector-box'>
                                                    <label for='sector'>Sector:</label>
                                                    <select class='programa general' name='sector' >
                                                        <option value='".$fila['SECTOR']."' selected>".$fila['SECTOR']."</option>";
                                                        include 'partials/options-sector.php';
                        echo"                       </select>
                                                </div>
                                            </div>
                                            <div id='div-titulo-sector'>
                                                <div id='titulo-box'>
                                                <label for='sector'>Inglés:</label>
                                                <select class='programa general' name='ingles'>
                                                    <option value='".$fila['INGLES']."' selected>".$fila['INGLES']."</option>";
                                                    include 'partials/options-idiomas.php';
                        echo"                   </select>
                                                </div>
                                                <div id='sector-box'>
                                                <label for='sector'>Alemán:</label>
                                                <select class='programa general' name='aleman'>
                                                    <option value='".$fila['ALEMAN']."' selected>".$fila['ALEMAN']."</option>";
                                                    include 'partials/options-idiomas.php';
                        echo"                   </select>
                                            </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class='div-notas'>
                                        <fieldset>
                                            <legend>Notas:</legend>
                                            <textarea id='notas' name='notas' rows='16' placeholder='Escribe aquí tus comentarios' >".$fila['NOTAS']."</textarea>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>     
                            <div id='bloque-programas'>
                                <fieldset>
                                    <div class='seleccionar-especialidad'>
                                        <select name= 'departamento' class='especialidad' >
                                            <option value='".$fila['DEPARTAMENTO']."' selected  hidden>".$fila['DEPARTAMENTO']."</option>";
                                            include 'partials/options-departamento.php';
                        echo"           </select>
                                        <select name= 'perfil' class='especialidad' >
                                            <option value='".$fila['PERFIL']."' selected  hidden>".$fila['PERFIL']."</option>";
                                            include 'partials/options-perfil.php';
                        echo"           </select>
                                    </div>
                                    
                                        <div class='especialidad'>
                                            <div class='programa-row-left'>
                                                <select name= 'software1' class='programa general' >
                                                    <option value='".$software[1]."' selected  hidden>".$software[1]."</option>";
                                                    include 'partials/options-softwares.php';
                        echo"                   </select>
                                                <select name= 'experiencia1' class='experiencia' >
                                                    <option value='".$experiencia[1]."' selected  hidden>".$experiencia[1]."</option>";
                                                    include 'partials/options-exp.php';
                        echo"                   </select>
                                            </div>
                                            <div class='programa-row-right'>
                                                <select name= 'software2' class='programa general' >
                                                    <option value='".$software[2]."' selected  hidden>".$software[2]."</option>";
                                                    include 'partials/options-softwares.php';
                        echo"                   </select>
                                                <select name= 'experiencia2' class='experiencia' >
                                                    <option value='".$experiencia[2]."' selected  hidden>".$experiencia[2]."</option>";
                                                    include 'partials/options-exp.php';
                        echo"                   </select>
                                            </div>
                                        </div>
                                        <div class='especialidad'>
                                            <div class='programa-row-left'>
                                                <select name= 'software3' class='programa general' >
                                                    <option value='".$software[3]."' selected  hidden>".$software[3]."</option>";
                                                    include 'partials/options-softwares.php';
                        echo"                   </select>
                                                <select name= 'experiencia3' class='experiencia' >
                                                    <option value='".$experiencia[3]."' selected  hidden>".$experiencia[3]."</option>";
                                                    include 'partials/options-exp.php';
                        echo"                   </select>
                                            </div>
                                            <div class='programa-row-right'>
                                                <select name= 'software4' class='programa general' >
                                                    <option value='".$software[4]."' selected  hidden>".$software[4]."</option>";
                                                    include 'partials/options-softwares.php';
                        echo"                        </select>
                                                <select name= 'experiencia4' class='experiencia' >
                                                    <option value='".$experiencia[4]."' selected  hidden>".$experiencia[4]."</option>";
                                                    include 'partials/options-exp.php';
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
(NOMBRE, APELLIDOS, EMAIL, TELEFONO, NOTAS, TITULO, SECTOR, ESPECIALIDAD, PERFIL, INGLES, ALEMAN) VALUES ('$nombre', '$apellidos', '$email', '$telefono', '$notas', '$titulo', '$sector', '$especialidad', '$perfil', '$ingles', $aleman); INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software1', '$experiencia1');
INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software2', '$experiencia2');
INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software3', '$experiencia3');
INSERT INTO `softwares` (TELEFONO, SOFTWARE, EXPERIENCIA) VALUES ('$telefono', '$software4', '$experiencia4');";
            ?>