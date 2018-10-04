<!--/******************************************************************************************************************/
/********************************************** REDALONE STYLE v.3.0 **********************************************/
/* Desarrollo por Pedro Fernández Bosch y David Rojas Quesada */
/* Adaptación para Reddelsur Control Panel v.2.0 */
/* 31/05/2010 */
/* https://github.com/pebosch/fakenews */
/* Esta obra está bajo una licencia GNU LGPLv3 */
/******************************************************************************************************************/-->

<?php
include_once 'func/func_conexion.php';
include_once 'func/func_utils.php';
if (checkAuthentication() == true) {
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    $dbh = new Conexion();
    $fase = $_POST['fase_opt'];
    $dbh->changeFase($fase);

//redirigimos al panel de administracion
    redirect("index.php?seccion=4");
} else {
    redirect("index.php?seccion=1");
}
//echo $output;
?>