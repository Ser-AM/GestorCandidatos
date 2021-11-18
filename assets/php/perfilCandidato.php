<!DOCTYPE html>
<html lang="en">
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
                <button><a href="../../buscarCandidatos.php">Buscar candidatos</a></button>
            </nav>
        </header>
        <?php
            // No muestra los errores como posibles "undefined" de campos que no han sido rellenados
            error_reporting(E_ERROR | E_PARSE);

            //Variable que recibimos de buscarCandidatos
            $telefono = $_GET['tln'];

            // Importamos los datos de conexión:
            require("datosConexion.php");

            //COMPROBAMOS SI HAY SESIÓN INICIADA
            session_start();

            if(!isset($_COOKIE["usuario"])){
                header("Location: ../../index.html");
            }

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
                        <button id='editar-perfil'><a href='modificarCandidatos.php?tln=$telefonoCandidato'>Editar Perfil</a></button>
                        <button id='eliminar-perfil'><a href='confirmarBorrarCandidato.php?tln=$telefonoCandidato'>Eliminar Perfil</a></button>
                    </nav>
                    <form action='assets/php/insertarCandidato.php' method='post'>
                        <div class='ficha ver-perfil'>
                            <div id='datos-notas'>
                                <div class='datos'>
                                    <fieldset>
                                        <legend>Datos Personales:</legend>
                                        <input type='text' name='nombre' value='".$fila['NOMBRE']."' disabled placeholder='Nombre...'>
                                        <input type='text' name='apellidos' value='".$fila['APELLIDOS']."' disabled placeholder='Apellidos...'>                  
                                        <input type='email' name='email'value='".$fila['EMAIL']."' disabled  placeholder='Email...'>
                                        <input type='tel' name='telefono' value='".$fila['TELEFONO']."' disabled placeholder='Teléfono...' required>
                                        <div id='div-titulo-sector'>
                                            <div id='titulo-box'>
                                                <label for='Titulo'>Título:</label>
                                                <select name='titulo' class='programa general' disabled>
                                                    <option value='".$fila['TITULO']."' selected>".$fila['TITULO']."</option>
                                                </select>
                                            </div>
                                            <div id='sector-box'>
                                                <label for='sector'>Sector:</label>
                                                <select class='programa general' name='sector' disabled>
                                                    <option value='".$fila['SECTOR']."' selected>".$fila['SECTOR']."</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id='div-titulo-sector'>
                                            <div id='titulo-box'>
                                            <label for='ingles'>Inglés:</label>
                                            <select name='ingles'  class='programa general' disabled>
                                                    <option value='".$fila['INGLES']."' selected>".$fila['INGLES']."</option>
                                                </select>
                                            </div>
                                            <div id='sector-box'>
                                                <label for='sector'>Alemán:</label>
                                                <select class='programa general' name='aleman' disabled>
                                                    <option value='".$fila['ALEMAN']."' selected>".$fila['ALEMAN']."</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class='div-notas'>
                                    <fieldset>
                                        <legend>Notas:</legend>
                                        <textarea id='notas' name='notas' rows='14' placeholder='Escribe aquí tus comentarios' disabled>".$fila['NOTAS']."</textarea>
                                        <button id='boton-ver-cv' type='submit' formaction='../../cvs/CV".$fila['TELEFONO'].".pdf' formtarget='_blank'>Ver CV</button>
                                    </fieldset>
                                </div>
                            </div>
                        </div>     
                        <div id='bloque-programas'>
                            <fieldset>
                                <div class='seleccionar-especialidad'>
                                    <select name= 'departamento' class='especialidad' disabled>
                                        <option value='".$fila['DEPARTAMENTO']."' selected disabled hidden>".$fila['DEPARTAMENTO']."</option>
                                    </select>
                                    <select name= 'perfil' class='especialidad' disabled>
                                        <option value='".$fila['PERFIL']."' selected disabled hidden>".$fila['PERFIL']."</option>
                                    </select>
                                </div>
                                    <div class='especialidad'>
                                        <div class='programa-row-left'>
                                            <select name= 'software1' class='programa general' disabled>
                                                <option value='".$software[1]."' selected disabled hidden>".$software[1]."</option>
                                            </select>
                                            <select name= 'experiencia1' class='experiencia' disabled>
                                                <option value='".$experiencia[1]."' selected disabled hidden>".$experiencia[1]."</option>
                                            </select>
                                        </div>
                                        <div class='programa-row-right'>
                                            <select name= 'software2' class='programa general' disabled>
                                                <option value='".$software[2]."' selected disabled hidden>".$software[2]."</option>
                                            </select>
                                            <select name= 'experiencia2' class='experiencia' disabled>
                                                <option value='".$experiencia[2]."' selected disabled hidden>".$experiencia[2]."</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class='especialidad'>
                                        <div class='programa-row-left'>
                                            <select name= 'software3' class='programa general' disabled>
                                                <option value='".$software[3]."' selected disabled hidden>".$software[3]."</option>
                                            </select>
                                            <select name= 'experiencia3' class='experiencia' disabled>
                                                <option value='".$experiencia[3]."' selected disabled hidden>".$experiencia[3]."</option>
                                            </select>
                                        </div>
                                        <div class='programa-row-right'>
                                            <select name= 'software4' class='programa general' disabled>
                                                <option value='".$software[4]."' selected disabled hidden>".$software[4]."</option>
                                            </select>
                                            <select name= 'experiencia4' class='experiencia' disabled>
                                                <option value='".$experiencia[4]."' selected disabled hidden>".$experiencia[4]."</option>
                                            </select>
                                        </div>
                                    </div>                               
                            </fieldset>                            
                        </div>
                    </form>
                " ;
                }
            }

            // Cerramos la conexión
            mysqli_close($conexion);
            ?>
    </body>
</html>

<!--CREAR EXCEPCION AL ERROR DE QUE EL NUMERO YA EXISTE PARA PODER GUARDAR LOS DATOS EDITADOS-->

