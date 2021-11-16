<?php

try{
    require("datosConexion.php");

    $usuarioPOST = $_POST['usuario'];
    $passwordPOST = $_POST['password'];

    $queryUsuario = "SELECT * FROM `usuarios` WHERE USUARIO = '$usuarioPOST' AND PASSWORD = '$passwordPOST'";
    $resultado = mysqli_query($conexion, $queryUsuario);

    // Comprobamos si hay resultados, este número será 0 o 1
    $numResult = mysqli_num_rows($resultado);

    if($numResult > 0){
        session_start();
        $_SESSION["usuario"] = $usuarioPOST;
        header("Location: ../../crearCandidato.php");
    }else{
        header("Location: ../../index.html");
    }
}catch(Exception $e){
    die("Error: " . $e->getMessage());
}

?>