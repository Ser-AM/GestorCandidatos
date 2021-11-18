<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="" />
        <title>Buscar Candidatos</title>
        <link rel="icon" type="image/x-icon" href="assets/images/Gestor_Candidatos_Icon.png">
        <link rel="stylesheet" href="assets/css/style.css"/>
        <script src="assets/js/jquery.min.js"></script>
    	<script src="assets/js/funciones.js"></script>
    </head>
    <body>

    <?php 
        //COMPROBAMOS SI HAY SESIÓN INICIADA
        session_start();

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
        <nav class="nav-busqueda">
            <button><a id="buscar-por-datos" href="#">Buscar por datos</a></button>
            <button id="buscar-por-programas"><a href="#">Buscar por programas</a></button>
        </nav>
        <div id="cuadro-busquedas">
            <div id="busqueda-datos"> <!--Buscar candidatos en la BBDD introduciendo datos personales-->
                <form id="form-busqueda" action="assets/php/buscarDatosCandidatos.php" method="post">
                    <div id="area-busqueda">
                        <div class="form-busqueda">
                            <input type="text" name="nombre" placeholder="Nombre...">
                            <input type="text" name="apellidos" placeholder="Apellidos...">                  
                            <input type="tel" name="telefono" placeholder="Teléfono...">
                        </div>
                        <div class="form-busqueda">
                            <div class="especialidad busqueda general">
                            </div>
                            <input type="text" name="email" placeholder="Email...">
                            <input type="text" name="notas" placeholder="Buscar en notas">
                            <input type="submit" name="buscarCandidato" value="Buscar">
                        </div>
                    </div>
                </form>
            </div>
            <div id="busqueda-programas"> <!--Buscar candidatos en la BBDD introduciendo programas y experiencia-->
                <form id="form-busqueda" action="assets/php/buscarSoftwareCandidatos.php" method="post">
                    <div id="area-busqueda">
                        <div class="form-busqueda">
                            <div id="div-titulo-sector">
                                <div id="titulo-box">
                                    <select name="departamento" id="titulo">
                                        <option value=" " selected>Departamento</option>
                                        <?php include "assets/php/partials/options-departamento.php"?>
                                    </select>
                                </div>
                                <div id="sector-box">
                                    <select id="sector" name="perfil">
                                        <option value=" " selected>Perfil</option>
                                        <?php include "assets/php/partials/options-sector.php"?>
                                    </select>
                                </div>
                            </div>
                            
                            <div id="div-titulo-sector">
                                <div id="titulo-box">
                                    <label for="Titulo">Inglés:</label>
                                    <select name="ingles" id="titulo">
                                        <option value=" " selected>No procede</option>
                                        <?php include "assets/php/partials/options-idiomas.php"?>
                                    </select>
                                </div>
                                <div id="sector-box">
                                    <label for="sector">Alemán:</label>
                                    <select id="sector" name="aleman">
                                        <option value=" " selected>No procede</option>
                                        <?php include "assets/php/partials/options-idiomas.php"?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-busqueda">
                            
                            <div class="especialidad busqueda general">
                                <div class="programa-row busqueda">
                                    <select name= "software1">
                                        <option value=" " selected disabled hidden>Programa</option>
                                        <?php include "assets/php/partials/options-softwares.php"?>
                                </select>
            <!--    Comentado el select de experiencia, para que solo aparezca programa en la pagina de busqueda
                                <select name= "experiencia1" class="experiencia busqueda" disabled>
FALTA APERTURA Y CIERRE PHP     include "assets/php/partials/options-exp.php"
                                </select>
                            </div>
                            <div class="programa-row busqueda">
                                <select name= "software2" class="programa general" disabled>
                                    <option value="" selected disabled hidden>Programa general</option>
FALTA APERTURA Y CIERRE PHP     include "assets/php/partials/options-softwares.php"
                                </select>
                                <select name= "experiencia2" class="experiencia busqueda" disabled>
                                <option value="" selected disabled hidden>Experiencia</option>
FALTA APERTURA Y CIERRE PHP     include "assets/php/partials/options-exp.php"
                                </select>-->
                            </div>
                            <div id="div-titulo-sector">
                                <div id="titulo-box">
                                    <label for="Titulo">Título:</label>
                                    <select name="titulo" id="titulo">
                                        <option value=" " selected>No procede</option>
                                        <?php include "assets/php/partials/options-titulo.php"?>
                                    </select>
                                </div>
                                <div id="sector-box">
                                    <label for="sector">Sector:</label>
                                    <select id="sector" name="sector">
                                        <option value=" " selected>No procede</option>
                                        <?php include "assets/php/partials/options-sector.php"?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            <label for="Titulo">Notas:</label>
                            <input type="text" name="notas" placeholder="Buscar en notas">
                            
                    <input type="submit" name="buscarCandidato" value="Buscar">
                </form>
            </div>
        </div>  
    </body>
</html>
