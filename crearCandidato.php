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
                            <option value=" "selected disabled hidden>Departamento</option>
                            <?php include "assets/php/partials/options-departamento.php"?>
                        </select>

                        <select name= "perfil" class="especialidad">
                            <option selected disabled hidden>Perfil</option>
                            <?php include "assets/php/partials/options-perfil.php"?>
                            </select>
                    </div>
                    
                        <div class="especialidad">
                            <div class="programa-row-left">
                                <select name= "software1" class="programa general">
                                    <option value="PROG-1" selected hidden>Programa</option>
                                    <?php include "assets/php/partials/options-softwares.php"?>
                                </select>
                                <select name= "experiencia1" class="experiencia">
                                    <option value="EXP-1" selected hidden>Experiencia</option>
                                    <?php include "assets/php/partials/options-exp.php"?>
                                </select>
                            </div>
                            <div class="programa-row-right">
                                <select name= "software2" class="programa general">
                                    <option value="PROG-2" selected hidden>Programa</option>
                                    <?php include "assets/php/partials/options-softwares.php"?>
                                </select>
                                <select name= "experiencia2" class="experiencia">
                                    <option value="EXP-2" selected hidden>Experiencia</option>
                                    <?php include "assets/php/partials/options-exp.php"?>
                                </select>
                            </div>
                        </div>
                        <div class="especialidad">
                            <div class="programa-row-left">
                                <select name= "software3" class="programa general">
                                    <option value="PROG-3" selected hidden>Programa</option>
                                    <?php include "assets/php/partials/options-softwares.php"?>
                                </select>
                                <select name= "experiencia3" class="experiencia">
                                    <option value="EXP-3" selected hidden>Experiencia</option>
                                    <?php include "assets/php/partials/options-exp.php"?>
                                </select>
                            </div>
                            <div class="programa-row-right">
                                <select name= "software4" class="programa general">
                                    <option value="PROG-4" selected hidden>Programa</option>
                                    <?php include "assets/php/partials/options-softwares.php"?>
                                </select>
                                <select name= "experiencia4" class="experiencia">
                                    <option value="EXP-4" selected hidden>Experiencia</option>
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