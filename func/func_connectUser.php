<!--/******************************************************************************************************************/
/********************************************** REDALONE STYLE v.3.0 **********************************************/
/* Desarrollo por Pedro Fernández Bosch y David Rojas Quesada */
/* Adaptación para Reddelsur Control Panel v.2.0 */
/* 31/05/2010 */
/* https://github.com/pebosch/fakenews */
/* Esta obra está bajo una licencia GNU LGPLv3 */
/******************************************************************************************************************/-->

<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

include_once 'func_conexion.php';
$user = "usr";
$passwordMd5 = "pass";
$result = 0;
$consulta = null;
if (empty($_POST["username"])) {
    header("Location: ../index.php");
} else {
//Abrimos conexion con el servidor
    $dbh = new Conexion();
    $passwordMd5 = md5($_POST["password"]);
    $user = $_POST["username"];
    $consulta = "SELECT id,login,passwd FROM `users` WHERE login = '$user' and passwd = '$passwordMd5' Limit 1;";
    $result = $dbh->consulta($consulta) or die('No se ha podido acceder a la base de datos, consulte con su administrador:' . mysql_error());

    if ($result->num_rows > 0) {
        // output data of each row
        session_start();
        while ($row = $result->fetch_assoc()) {
            $_SESSION["login_usr"] = $row["login"];
            $_SESSION["pass_usr"] = $row["passwd"];
            $_SESSION["id_usr"] = $row["id"];
        }
        if ($user == 'admin') {
            header("Location: ../index.php?seccion=4");
        } else {
            header("Location: ../index.php?seccion=2");
        }
    } else {//No hay resultados
        header("Location: ../index.php?seccion=1");
    }

//    $num=mysql_num_rows($result);
//    
//    
//    if ($num == 1) {
//        session_start();
//        $_SESSION["login_usr"] = $user;
//        $_SESSION["pass_usr"] = $passwordMd5;
//        $_SESSION["id_usr"] = ;
//        header("Location: ../index.php?seccion=2"); 
//        
//    } else {
//        header("Location: ../index.php?seccion=1");
//    }
}
?>