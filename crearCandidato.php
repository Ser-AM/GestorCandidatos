<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content=""/>
        <title>Crear Candidato</title>
        <link rel="icon" type="image/x-icon" href="assets/images/Gestor_Candidatos_Icon.png">
        <link rel="stylesheet" href="assets/css/style.css"/>
        <script src="assets/js/jquery.min.js"></script>
    	<script src="assets/js/funciones.js"></script>
    </head>
    <body>

    <?php 
        //COMPROBAMOS SI HAY SESIÓN INICIADA
        //session_start();

        if(!isset($_COOKIE["usuario"])){
            header("Location: index.html");
        }

    ?>

        <header>
            <div class="header">
                <div id="logo">
                    <img src="assets/images/Gestor_Candidatos.png" alt="">
                </div>
            </div>
                <nav>
                    <button><a href="crearCandidato.php">Añadir candidato</a></button>
                    <button><a href="buscarCandidatos.php">Buscar candidatos</a></button>
                </nav>
        </header>
        <form action="assets/php/insertarCandidato.php" method="post">
            <div class="ficha">
                <div id="datos-notas">
                    <div class="datos">
                        <fieldset>
                            <legend>Datos Personales:</legend>
                            <input type="text" name="nombre" placeholder="Nombre...">
                            <input type="text" name="apellidos" placeholder="Apellidos...">                  
                            <input type="email" name="email" placeholder="Email...">
                            <input type="tel" name="telefono" placeholder="Teléfono..." required>
                            <div id="div-titulo-sector">
                                <div id="titulo-box">
                                    <label for="Titulo">Título:</label>
                                    <select name="titulo" class="programa general" >
                                        <option value=" " selected>No procede</option>
                                        <?php include "assets/php/partials/options-titulo.php"?>
                                    </select>
                                </div>
                                <div id="sector-box">
                                <label for="sector">Sector:</label>
                                    <select  class="programa general" name="sector">
                                        <option value=" " selected>No procede</option>
                                        <?php include "assets/php/partials/options-sector.php"?>
                                    </select>                            
                                </div>
                            </div>
                            <div id="div-titulo-sector">
                                <div id="titulo-box">
                                <label for="ingles">Inglés:</label>
                                    <select name="ingles"  class="programa general">
                                        <option value=" " selected>No procede</option>
                                        <?php include "assets/php/partials/options-idiomas.php"?>
                                    </select>
                                </div>
                                <div id="sector-box">
                                    <label for="aleman">Alemán:</label>
                                    <select  class="programa general" name="aleman">
                                        <option value=" " selected>No procede</option>
                                        <?php include "assets/php/partials/options-idiomas.php"?>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="div-notas">
                        <fieldset>
                            <legend>Notas:</legend>
                            <textarea id="notas" name="notas" rows="16" placeholder="Escribe aquí tus comentarios"></textarea>
                        </fieldset>
                    </div>
                </div>
            </div>       
            <div id="bloque-programas">
                <fieldset>
                <div class="seleccionar-especialidad">
                        <select name= "departamento" class="especialidad">
                            <option selected disabled hidden>Departamento</option>
                            <?php include "assets/php/partials/options-departamento.php"?>
                        </select>

                        <select name= "perfil" class="especialidad">
                            <option selected disabled hidden>Perfil</option>
                            <?php include "assets/php/partials/options-perfil.php"?>
                            </select>
                    </div>
                    
                        <div class="especialidad">                                                          <!--Abrimos los divde forma normal-->
                            <div class="programa-row-left">                                                 <!--el select tambien lo abrimos desde aqui para que el "name" no se repita-->
                                <select name= "software1" class="programa general">                         <!--esta linea la dejamos, porque para la hoja de editar el candidato se meteran por php en value y entre las etiquetas la opcion que ya tiene el candidato-->
                                    <option value="SW1 No introducido" selected disabled hidden>Programa</option>     <!--meterla en value es para que si se sobreescribe porque ese campo no se ha editado, lo haga con la misma informacion-->
                                    <?php include "assets/php/partials/options-softwares.php"?>             <!--Esta linea importa desde ese archivo todo el contenido de los select (los option y los optgroup)-->
                                </select>                                                                   <!--el select lo cerramos desde aqui, al hacerlo de esta forma, los archivos que tienen el contenido no solo los reutilizamos en este documento, tambien en el del perfil del candidato-->
                                <select name= "experiencia1" class="experiencia">
                                    <option value="EXP1 No introducido" selected disabled hidden>Experiencia</option>
                                    <?php include "assets/php/partials/options-exp.php"?>                   <!--Igual que el anterior, pero enlaza al documento de la experiencia-->
                                </select>
                            </div>
                            <div class="programa-row-right">
                                <select name= "software2" class="programa general">
                                    <option value="SW2 No introducido" selected disabled hidden>Programa</option>
                                    <?php include "assets/php/partials/options-softwares.php"?>
                                </select>
                                <select name= "experiencia2" class="experiencia">
                                    <option value="EXP2 No introducido" selected disabled hidden>Experiencia</option>
                                    <?php include "assets/php/partials/options-exp.php"?>
                                </select>
                            </div>
                        </div>
                        <div class="especialidad">
                            <div class="programa-row-left">
                                <select name= "software3" class="programa general">
                                    <option value="SW3 No introducido" selected disabled hidden>Programa</option>
                                    <?php include "assets/php/partials/options-softwares.php"?>
                                </select>
                                <select name= "experiencia3" class="experiencia">
                                    <option value="EXP3 No introducido" selected disabled hidden>Experiencia</option>
                                    <?php include "assets/php/partials/options-exp.php"?>
                                </select>
                            </div>
                            <div class="programa-row-right">
                                <select name= "software4" class="programa general">
                                    <option value="SW4 No introducido" selected disabled hidden>Programa</option>
                                    <?php include "assets/php/partials/options-softwares.php"?>
                                </select>
                                <select name= "experiencia4" class="experiencia">
                                    <option value="EXP4 No introducido" selected disabled hidden>Experiencia</option>
                                    <?php include "assets/php/partials/options-exp.php"?>
                                </select>
                            </div>
                        </div>
                </fieldset>
                <br>
                <input type="submit" name="enviaFormulario" value="Insertar">
            </div>
        </form>      
    </body>
</html>