<?php
    // LOCAL
    /*$db_host = "localhost";
    $db_nombre = "adyd_rrhh";
    $db_usuario = "root";
    $db_password = "";*/

    // WEBHOST
    /*$db_host = "localhost";
    $db_nombre = "id17846945_gestorcandidatos";
    $db_usuario = "id17846945_cristianurba";
    $db_password = "vFE6xC9RPD&z+~(s";*/

    // ADYDCANDIDATOS
    $db_host = "mysql-5706.dinaserver.com";
    $db_nombre = "adydcand";
    $db_usuario = "adydcandidatos";
    $db_password = "]N4w^830RAE?";

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

?>