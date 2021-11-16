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

        if(!isset($_SESSION["usuario"])){
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
                            <select name= "especialidad" class="especialidad-busqueda">
                                <option value=" " selected hidden disabled>Especialidad</option>
                                <option value="mecanica">Mecánica</option>
                                <option value="arquitectura">Arquitectura</option>
                                <option value="obra-civil">Obra Civil</option>
                                <option value="industrial">Industrial</option>
                                <option value="otros"> Otros</option>
                            </select>
                            <div id="div-titulo-sector">
                                <div id="titulo-box">
                                    <label for="Titulo">Título:</label>
                                    <select name="titulo" id="titulo">
                                        <option value=" " selected>No procede</option>
                                        <option value="Arquitecto">Arquitecto</option>
                                        <option value="IngenieroCivil">Ing. Civil</option>
                                        <option value="IngenieroElectrico">Ing. Eléctrico</option>
                                        <option value="IngenieroMecanico">Ing. Mecánico</option>
                                    </select>
                                </div>
                                <div id="sector-box">
                                    <label for="sector">Sector:</label>
                                    <select id="sector" name="sector">
                                        <option value=" " selected>No procede</option>
                                        <option value="Aguas">Aguas</option>
                                        <option value="Oil&Gas">Oil&Gas</option>
                                        <option value="Renovables">Renovables</option>
                                        <option value="Fotovoltaica">Fotovoltaica</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-busqueda">
                            <div class="especialidad busqueda general">
                                <div class="programa-row busqueda">
                                    <select name= "software1" class="programa general">
                                        <option value=" " selected disabled hidden>Programa general</option>
                                    <optgroup label="Mecánica">
                                        <option value="SOLIDWORKS">SOLIDWORKS</option>
                                        <option value="SOLIDEDGE">SOLIDEDGE</option>
                                        <option value="CATIA">CATIA</option>
                                        <option value="INVENTOR">INVENTOR</option>
                                        <option value="CREO (PRO ENGINEER)">CREO (PRO ENGINEER)</option>
                                        <option value="AUTOCAD 2D">AUTOCAD 2D</option>
                                        <option value="AUTOCAD CÁLCULO">AUTOCAD CÁLCULO</option>
                                        <option value="AUTOCAD MECHANICAL">AUTOCAD MECHANICAL</option>
                                        <option value="ANSYS">ANSYS</option>
                                        <option value="TOP SOLID">TOP SOLID</option>
                                    </optgroup>
                                    <optgroup label="Arquitectura">
                                        <option value="REVIT">REVIT</option>
                                        <option value="REVIT ARQ">REVIT ARQ</option>
                                        <option value="REVIT MEP">REVIT MEP</option>
                                        <option value="REVIT STRUC">REVIT STRUC</option>
                                        <option value="AECOSIM">AECOSIM</option>
                                        <option value="AUTOCAD 2D / 3D">AUTOCAD 2D / 3D</option>
                                        <option value="SKETCH UP">SKETCH UP</option>
                                        <option value="NAVISWORKS">NAVISWORKS</option>
                                    </optgroup>
                                    <optgroup label="Obra Civil">
                                        <option value="TEKLA">TEKLA</option>
                                        <option value="ARMACAD">ARMACAD</option>
                                        <option value="AUTOCAD CIVIL 3D">AUTOCAD CIVIL 3D</option>
                                        <option value="CYPE">CYPE</option>
                                        <option value="SAP2000">SAP2000</option>
                                        <option value="STAAD PRO">STAAD PRO</option>
                                        <option value="TRICALC">TRICALC</option>
                                        <option value="PRESTO">PRESTO</option>
                                        <option value="MENFIS">MENFIS</option>
                                        <option value="ARQUÍMEDES">ARQUÍMEDES</option>
                                        <option value="ArchiCAD">ArchiCAD</option>
                                        <option value="MICROSTATION">MICROSTATION</option>
                                        <option value="ISPOL">ISPOL</option>
                                    </optgroup>
                                    <optgroup label="Industrial">
                                        <option value="AUTOCAD PLANT 3D">AUTOCAD PLANT 3D</option>
                                        <option value="SMART PLANT 3D">SMART PLANT 3D</option>
                                        <option value="SMART PLANT P&ID">SMART PLANT P&ID</option>
                                        <option value="PDMS">PDMS</option>
                                        <option value="PDS">PDS</option>
                                        <option value="PDS FRAMEWORKS">PDS FRAMEWORKS</option>
                                        <option value="NAVISWORKS">NAVISWORKS</option>
                                    </optgroup>
                                </select>
            <!--    Comentado el select de experiencia, para que solo aparezca programa en la pagina de busqueda
                                <select name= "experiencia1" class="experiencia busqueda" disabled>
                                    <option value="" selected disabled hidden>Experiencia</option>
                                    <option value="1">1. Sólo Formación</option>
                                    <option value="2">2. Formación + Proyectos Puntuales</option>
                                    <option value="3">3. Avanzado (Tiempo sin usarlo)</option>
                                    <option value="4">4. Muy Avanzado (Uso diario + de 2 años)</option>
                                    <option value="5">5. Nivel Administrador</option>
                                </select>
                            </div>
                            <div class="programa-row busqueda">
                                <select name= "software2" class="programa general" disabled>
                                    <option value="" selected disabled hidden>Programa general</option>
                                    <optgroup label="Mecánica">
                                        <option value="SOLIDWORKS">SOLIDWORKS</option>
                                        <option value="SOLIDEDGE">SOLIDEDGE</option>
                                        <option value="CATIA">CATIA</option>
                                        <option value="INVENTOR">INVENTOR</option>
                                        <option value="CREO (PRO ENGINEER)">CREO (PRO ENGINEER)</option>
                                        <option value="AUTOCAD 2D">AUTOCAD 2D</option>
                                        <option value="AUTOCAD CÁLCULO">AUTOCAD CÁLCULO</option>
                                        <option value="AUTOCAD MECHANICAL">AUTOCAD MECHANICAL</option>
                                        <option value="ANSYS">ANSYS</option>
                                        <option value="TOP SOLID">TOP SOLID</option>
                                    </optgroup>
                                    <optgroup label="Arquitectura">
                                        <option value="REVIT">REVIT</option>
                                        <option value="REVIT ARQ">REVIT ARQ</option>
                                        <option value="REVIT MEP">REVIT MEP</option>
                                        <option value="REVIT STRUC">REVIT STRUC</option>
                                        <option value="AECOSIM">AECOSIM</option>
                                        <option value="AUTOCAD 2D / 3D">AUTOCAD 2D / 3D</option>
                                        <option value="SKETCH UP">SKETCH UP</option>
                                        <option value="NAVISWORKS">NAVISWORKS</option>
                                    </optgroup>
                                    <optgroup label="Obra Civil">
                                        <option value="TEKLA">TEKLA</option>
                                        <option value="ARMACAD">ARMACAD</option>
                                        <option value="AUTOCAD CIVIL 3D">AUTOCAD CIVIL 3D</option>
                                        <option value="CYPE">CYPE</option>
                                        <option value="SAP2000">SAP2000</option>
                                        <option value="STAAD PRO">STAAD PRO</option>
                                        <option value="TRICALC">TRICALC</option>
                                        <option value="PRESTO">PRESTO</option>
                                        <option value="MENFIS">MENFIS</option>
                                        <option value="ARQUÍMEDES">ARQUÍMEDES</option>
                                        <option value="ArchiCAD">ArchiCAD</option>
                                        <option value="MICROSTATION">MICROSTATION</option>
                                        <option value="ISPOL">ISPOL</option>
                                    </optgroup>
                                    <optgroup label="Industrial">
                                        <option value="AUTOCAD PLANT 3D">AUTOCAD PLANT 3D</option>
                                        <option value="SMART PLANT 3D">SMART PLANT 3D</option>
                                        <option value="SMART PLANT P&ID">SMART PLANT P&ID</option>
                                        <option value="PDMS">PDMS</option>
                                        <option value="PDS">PDS</option>
                                        <option value="PDS FRAMEWORKS">PDS FRAMEWORKS</option>
                                        <option value="NAVISWORKS">NAVISWORKS</option>
                                    </optgroup>
                                </select>
                                <select name= "experiencia2" class="experiencia busqueda" disabled>
                                <option value="" selected disabled hidden>Experiencia</option>
                                    <option value="1">1. Sólo Formación</option>
                                    <option value="2">2. Formación + Proyectos Puntuales</option>
                                    <option value="3">3. Avanzado (Tiempo sin usarlo)</option>
                                    <option value="4">4. Muy Avanzado (Uso diario + de 2 años)</option>
                                    <option value="5">5. Nivel Administrador</option>
                                </select>-->
                            </div>


                            <input type="text" name="notas" placeholder="Buscar en notas">
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="buscarCandidato" value="Buscar">
                </form>
            </div>
        </div>  
    </body>
</html>
