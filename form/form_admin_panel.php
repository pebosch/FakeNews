<!--/******************************************************************************************************************/
/********************************************** REDALONE STYLE v.3.0 **********************************************/
/* Desarrollo por Pedro Fernández Bosch y David Rojas Quesada */
/* Adaptación para Reddelsur Control Panel v.2.0 */
/* 31/05/2010 */
/* https://github.com/pebosch/fakenews */
/* Esta obra está bajo una licencia GNU LGPLv3 */
/******************************************************************************************************************/-->

<?php
include_once 'func/func_authentication.php';
include_once 'func/func_utils.php';
include_once 'func/func_conexion.php';

if (checkAuthentication() == true) {
    $dbh = new Conexion();
    $idusuario = $_SESSION["id_usr"];
    $fase = $dbh->getFase();
    $output = "";
    $output .= "<div class='login-box-large'>";
    $output .= "<p>Hola <b>" . $_SESSION["login_usr"] . "</b>!  - Panel de control </p> <br>";
    $output .= "<p><b>Panel de Control - Fase actual: " . $fase . "</b></p>";
    $output .= "<form id='form_fase' action='../index.php?seccion=5' method='post' onsubmit='return valida(this)' >";

    if ($fase == 1) {
        $output .= "	<input type='radio' name='fase_opt' value='1' onclick='show1();' checked />Fase 1: No formación<br>";
    } else {
        $output .= "	<input type='radio' name='fase_opt' value='1' onclick='show1();' />Fase 1: No formación<br>";
    }

    if ($fase == 2) {
        $output .= "<input type='radio' name='fase_opt' value='2' onclick='show2();' checked />Fase 2: Con formación<br>";
    } else {
        $output .= "<input type='radio' name='fase_opt' value='2' onclick='show2();' />Fase 2: Con formación<br>";
    }

    $output .= "                     
						<br>
                        <button type='submit' value='Submit'>Guardar</button>
                    </form>
                ";

    $output .= "</div>";
} else {
    redirect("index.php?seccion=1");
}
echo $output;
?>