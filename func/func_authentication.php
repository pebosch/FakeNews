<!--/******************************************************************************************************************/
/********************************************** REDALONE STYLE v.3.0 **********************************************/
/* Desarrollo por Pedro Fernández Bosch y David Rojas Quesada */
/* Adaptación para Reddelsur Control Panel v.2.0 */
/* 31/05/2010 */
/* https://github.com/pebosch/fakenews */
/* Esta obra está bajo una licencia GNU LGPLv3 */
/******************************************************************************************************************/-->

<?php

function startAuthentication() {
    if (!isset($_SESSION["login_usr"])) {
        $_SESSION["login_usr"] = 0;
        header("Location: index.php?seccion=1");
    }
}

function checkAuthentication() {
    if ($_SESSION["login_usr"] != 0 || $_SESSION["login_usr"] != "") {
        return true;
    } else {
        return false;
    }
}
